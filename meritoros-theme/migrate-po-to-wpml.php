<?php
/**
 * Migracja tłumaczeń z .po/.mo na WPML String Translation
 *
 * Parsuje pliki .po (en_US, uk, ru_RU), rejestruje stringi PL w WPML
 * i dodaje tłumaczenia EN/UK/RU.
 *
 * Użycie (jako zalogowany admin):
 *   https://meritoros.web-canvas.pl/?migrate-po-to-wpml=1
 *
 * Po migracji:
 * 1. Sprawdź WPML > String Translation — stringi powinny być widoczne
 * 2. Usuń ten plik z serwera
 * 3. Usuń load_theme_textdomain() z functions.php (już usunięte)
 * 4. Usuń pliki .po/.mo z languages/ (opcjonalnie, jako backup)
 */
defined('ABSPATH') || exit;

add_action('init', function () {
    if (empty($_GET['migrate-po-to-wpml']) || !current_user_can('manage_options')) {
        return;
    }

    if (!function_exists('icl_register_string') || !function_exists('icl_add_string_translation')) {
        wp_die('WPML String Translation nie jest aktywny.');
    }

    header('Content-Type: text/plain; charset=utf-8');

    $theme_dir = get_template_directory();
    $context   = 'meritoros';

    // Mapowanie plików .po na kody językowe WPML
    $po_files = [
        'en' => $theme_dir . '/languages/en_US.po',
        'uk' => $theme_dir . '/languages/uk.po',
        'ru' => $theme_dir . '/languages/ru_RU.po',
    ];

    // Parsuj wszystkie pliki .po
    $all_translations = []; // [msgid_pl => ['en' => msgstr, 'uk' => msgstr, 'ru' => msgstr]]

    foreach ($po_files as $lang => $file) {
        if (!file_exists($file)) {
            echo "SKIP: brak pliku {$file}\n";
            continue;
        }

        $entries = parse_po_file($file);
        echo "Parsed {$file}: " . count($entries) . " entries\n";

        foreach ($entries as $msgid => $msgstr) {
            if ($msgid === '' || $msgstr === '') continue;
            if (!isset($all_translations[$msgid])) {
                $all_translations[$msgid] = [];
            }
            $all_translations[$msgid][$lang] = $msgstr;
        }
    }

    echo "\n=== Unikalne stringi PL: " . count($all_translations) . " ===\n\n";

    // Rejestruj i dodaj tłumaczenia
    $registered = 0;
    $translated = 0;
    $errors     = 0;

    foreach ($all_translations as $pl_string => $lang_translations) {
        // Generuj stabilną nazwę klucza
        $name = 'theme_' . md5($pl_string);

        // Rejestruj string PL w WPML
        $result = icl_register_string($context, $name, $pl_string);

        // Pobierz string_id
        global $wpdb;
        $string_id = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM {$wpdb->prefix}icl_strings WHERE context = %s AND name = %s",
            $context, $name
        ));

        if (!$string_id) {
            echo "ERR: nie udało się zarejestrować: " . mb_substr($pl_string, 0, 60) . "...\n";
            $errors++;
            continue;
        }

        $registered++;

        // Dodaj tłumaczenia dla każdego języka
        foreach ($lang_translations as $lang => $translation) {
            if (empty($translation)) continue;

            // Sprawdź czy tłumaczenie już istnieje
            $existing = $wpdb->get_var($wpdb->prepare(
                "SELECT id FROM {$wpdb->prefix}icl_string_translations WHERE string_id = %d AND language = %s",
                $string_id, $lang
            ));

            if ($existing) {
                // Aktualizuj istniejące
                $wpdb->update(
                    $wpdb->prefix . 'icl_string_translations',
                    [
                        'value'  => $translation,
                        'status' => ICL_STRING_TRANSLATION_COMPLETE,
                    ],
                    ['id' => $existing]
                );
            } else {
                // Wstaw nowe
                $wpdb->insert(
                    $wpdb->prefix . 'icl_string_translations',
                    [
                        'string_id' => $string_id,
                        'language'  => $lang,
                        'value'     => $translation,
                        'status'    => ICL_STRING_TRANSLATION_COMPLETE,
                    ]
                );
            }

            $translated++;
        }
    }

    echo "\n=== WYNIK ===\n";
    echo "Zarejestrowane stringi: {$registered}\n";
    echo "Dodane tłumaczenia:     {$translated}\n";
    echo "Błędy:                  {$errors}\n";
    echo "\nMigracja zakończona.\n";
    echo "Teraz sprawdź WPML > String Translation (context: meritoros).\n";
    echo "Jeśli OK — usuń ten plik z serwera.\n";

    exit;
}, 1);

/**
 * Parsuje plik .po linia po linii i zwraca tablicę [msgid => msgstr]
 */
function parse_po_file(string $filepath): array {
    $lines = file($filepath, FILE_IGNORE_NEW_LINES);
    if (!$lines) return [];

    $entries = [];
    $msgid   = '';
    $msgstr  = '';
    $state   = ''; // 'msgid' lub 'msgstr'

    foreach ($lines as $line) {
        // Normalizuj CRLF
        $line = rtrim($line, "\r");

        // Pomiń komentarze
        if (isset($line[0]) && $line[0] === '#') continue;

        // Pusta linia — nic nie rób (wpisy wieloliniowe mogą zawierać puste linie)
        // Zamiast tego opieramy się na wykryciu nowego msgid

        if (str_starts_with($line, 'msgid ')) {
            // Zapisz poprzedni wpis
            if ($state === 'msgstr' && $msgid !== '') {
                $entries[stripcslashes($msgid)] = stripcslashes($msgstr);
            }
            // Nowy wpis
            $msgid = extract_po_string($line, 'msgid ');
            $msgstr = '';
            $state = 'msgid';
        } elseif (str_starts_with($line, 'msgstr ')) {
            $msgstr = extract_po_string($line, 'msgstr ');
            $state = 'msgstr';
        } elseif (isset($line[0]) && $line[0] === '"' && $state !== '') {
            // Kontynuacja wieloliniowego msgid/msgstr
            $continued = extract_po_quoted($line);
            if ($state === 'msgid') {
                $msgid .= $continued;
            } else {
                $msgstr .= $continued;
            }
        } elseif (trim($line) === '') {
            // Pusta linia — ignoruj, nie resetuj stanu
        }
    }

    // Ostatni wpis
    if ($state === 'msgstr' && $msgid !== '') {
        $entries[stripcslashes($msgid)] = stripcslashes($msgstr);
    }

    return $entries;
}

function extract_po_string(string $line, string $prefix): string {
    $val = substr($line, strlen($prefix));
    return extract_po_quoted($val);
}

function extract_po_quoted(string $val): string {
    $val = trim($val);
    if (strlen($val) >= 2 && $val[0] === '"' && $val[strlen($val) - 1] === '"') {
        return substr($val, 1, -1);
    }
    return $val;
}
