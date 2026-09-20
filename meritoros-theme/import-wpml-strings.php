<?php
/**
 * Import WPML String Translations
 *
 * Rejestruje wszystkie stringi z languages/en.php, uk.php, ru.php
 * w WPML String Translation i dodaje tłumaczenia.
 *
 * Użycie: otwórz w przeglądarce jako zalogowany admin:
 *   https://domena.pl/?import-wpml-strings=1
 *
 * Po imporcie ten plik można usunąć.
 */
defined('ABSPATH') || exit;

add_action('init', function () {
    if (empty($_GET['import-wpml-strings']) || !current_user_can('manage_options')) {
        return;
    }

    // Sprawdź czy WPML String Translation jest aktywny
    if (!function_exists('icl_register_string') || !function_exists('icl_add_string_translation')) {
        wp_die('WPML String Translation nie jest aktywny. Zainstaluj i aktywuj wtyczkę WPML String Translation.');
    }

    $theme_dir = get_template_directory();
    $context   = 'meritoros';

    // Załaduj pliki tłumaczeń
    $translations = [];
    foreach (['en', 'uk', 'ru'] as $lang) {
        $file = $theme_dir . '/languages/' . $lang . '.php';
        if (file_exists($file)) {
            $raw = include $file;
            if (is_array($raw)) {
                // Normalizuj CRLF
                $translations[$lang] = [];
                foreach ($raw as $k => $v) {
                    $translations[$lang][str_replace("\r\n", "\n", $k)] = $v;
                }
            }
        }
    }

    if (empty($translations)) {
        wp_die('Brak plików tłumaczeń w languages/.');
    }

    // Zbierz unikalne klucze PL (oryginalne stringi)
    $all_keys = [];
    foreach ($translations as $lang => $map) {
        foreach (array_keys($map) as $key) {
            $all_keys[$key] = true;
        }
    }

    $registered = 0;
    $translated = 0;
    $errors     = [];

    echo '<html><head><meta charset="utf-8"><title>Import WPML Strings</title></head><body>';
    echo '<h1>Import stringów do WPML String Translation</h1>';
    echo '<p>Kontekst: <code>' . esc_html($context) . '</code></p>';
    echo '<p>Znaleziono <strong>' . count($all_keys) . '</strong> unikalnych stringów PL.</p>';

    foreach ($all_keys as $pl_string => $_) {
        // Rejestruj string PL w WPML
        // Nazwa = sam string (bo klucz = wartość PL)
        $result = icl_register_string($context, $pl_string, $pl_string);
        $registered++;

        // Pobierz ID zarejestrowanego stringa
        global $wpdb;
        $string_id = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM {$wpdb->prefix}icl_strings WHERE context = %s AND name = %s",
            $context,
            $pl_string
        ));

        if (!$string_id) {
            $errors[] = 'Nie znaleziono ID dla: ' . mb_substr($pl_string, 0, 60);
            continue;
        }

        // Dodaj tłumaczenia EN/UK/RU
        foreach (['en', 'uk', 'ru'] as $lang) {
            if (isset($translations[$lang][$pl_string]) && $translations[$lang][$pl_string] !== '') {
                $wpml_lang = $lang; // WPML language codes
                icl_add_string_translation($string_id, $wpml_lang, $translations[$lang][$pl_string], ICL_STRING_TRANSLATION_COMPLETE);
                $translated++;
            }
        }
    }

    echo '<h2>Wynik</h2>';
    echo '<ul>';
    echo '<li>Zarejestrowanych stringów PL: <strong>' . $registered . '</strong></li>';
    echo '<li>Dodanych tłumaczeń: <strong>' . $translated . '</strong></li>';
    echo '</ul>';

    if ($errors) {
        echo '<h2>Błędy (' . count($errors) . ')</h2><ul>';
        foreach ($errors as $err) {
            echo '<li>' . esc_html($err) . '</li>';
        }
        echo '</ul>';
    }

    echo '<p style="color:green;font-weight:bold;">Import zakończony. Sprawdź WPML &gt; String Translation.</p>';
    echo '</body></html>';
    exit;
}, 20);
