<?php
/**
 * Skrypt jednorazowy: wstawia tlumaczenia EN/UK/RU dla:
 * - bpo_hist_label (etykieta sekcji historie BPO)
 * - kon_step_*_label (kroki kontakt)
 * - stringi PHP: newsletter checkboxy, kalkulator labels
 *
 * Uzycie: otworz w przegladarce jako zalogowany admin, np.
 *   https://meritoros.web-canvas.pl/wp-content/themes/meritoros-theme/fix-translations-2026-10-14.php
 *
 * Po uzyciu USUN ten plik z serwera.
 */

if ( ! defined('ABSPATH') ) {
    $wp_load = dirname(__FILE__) . '/../../../wp-load.php';
    if ( file_exists($wp_load) ) {
        require_once $wp_load;
    } else {
        die('Nie znaleziono wp-load.php.');
    }
}

if ( ! current_user_can('manage_options') ) {
    wp_die('Brak uprawnien.');
}

// ---- Konfiguracja ----

$front_page_id = (int) get_option('page_on_front');

// Znajdz strony BPO i Kontakt po slugu
$_default_lang = apply_filters('wpml_default_language', null);
do_action('wpml_switch_language', $_default_lang);
$bpo_page     = get_page_by_path('bpo');
$kontakt_page = get_page_by_path('kontakt');
do_action('wpml_switch_language', null);

$bpo_page_id     = $bpo_page     ? $bpo_page->ID     : 0;
$kontakt_page_id = $kontakt_page ? $kontakt_page->ID : 0;

// Tlumaczenia pol ACF na stronie BPO
$bpo_translations = [
    'bpo_hist_label' => [
        'pl' => 'Historie klientów BPO',
        'en' => 'BPO client stories',
        'uk' => 'Історії клієнтів BPO',
        'ru' => 'Истории клиентов BPO',
    ],
];

// Tlumaczenia pol ACF na stronie Kontakt
$kontakt_translations = [
    'kon_step_1_label' => [
        'pl' => 'Analiza potrzeb',
        'en' => 'Needs analysis',
        'uk' => 'Аналіз потреб',
        'ru' => 'Анализ потребностей',
    ],
    'kon_step_2_label' => [
        'pl' => 'Propozycja rozwiązania',
        'en' => 'Proposed solution',
        'uk' => 'Пропозиція рішення',
        'ru' => 'Предложение решения',
    ],
    'kon_step_3_label' => [
        'pl' => 'Wdrożenie',
        'en' => 'Implementation',
        'uk' => 'Впровадження',
        'ru' => 'Внедрение',
    ],
    'kon_step_4_label' => [
        'pl' => 'Stałe wsparcie',
        'en' => 'Ongoing support',
        'uk' => 'Постійна підтримка',
        'ru' => 'Постоянная поддержка',
    ],
];

// Stringi PHP (__() / esc_html_e()) - WPML String Translation
$string_translations = [
    // Newsletter checkboxy
    'Chcę otrzymywać miesięczne podsumowania zmian podatkowych' => [
        'en' => 'I want to receive monthly tax law updates',
        'uk' => 'Хочу отримувати щомісячні підсумки податкових змін',
        'ru' => 'Хочу получать ежемесячные обзоры налоговых изменений',
    ],
    'Chcę otrzymywać oferty pracy' => [
        'en' => 'I want to receive job offers',
        'uk' => 'Хочу отримувати пропозиції роботи',
        'ru' => 'Хочу получать предложения работы',
    ],
    // Kalkulator - labels KP
    'Same kadry' => [
        'en' => 'HR only',
        'uk' => 'Тільки кадри',
        'ru' => 'Только кадры',
    ],
    'Same płace' => [
        'en' => 'Payroll only',
        'uk' => 'Тільки зарплати',
        'ru' => 'Только зарплаты',
    ],
    'Rozliczenie umów (podwykonawcy)' => [
        'en' => 'Contract settlement (subcontractors)',
        'uk' => 'Розрахунок договорів (субпідрядники)',
        'ru' => 'Расчёт договоров (субподрядчики)',
    ],
    'Liczba podwykonawców' => [
        'en' => 'Number of subcontractors',
        'uk' => 'Кількість субпідрядників',
        'ru' => 'Количество субподрядчиков',
    ],
    'Liczba pracowników' => [
        'en' => 'Number of employees',
        'uk' => 'Кількість працівників',
        'ru' => 'Количество сотрудников',
    ],
    // BPO historie label (fallback string)
    'Historie klientów BPO' => [
        'en' => 'BPO client stories',
        'uk' => 'Історії клієнтів BPO',
        'ru' => 'Истории клиентов BPO',
    ],
];

// ---- Logika ----

echo '<pre style="font-family:monospace; font-size:13px;">';
echo "=== Fix translations 2026-10-14 ===\n\n";

$default_lang = apply_filters('wpml_default_language', null);
echo "Default language: {$default_lang}\n";
echo "Front page ID (PL): {$front_page_id}\n";
echo "BPO page ID (PL): {$bpo_page_id}\n";
echo "Kontakt page ID (PL): {$kontakt_page_id}\n\n";

// Helper: przetlumacz pola ACF na danej stronie
function _mer_fix_acf_fields($page_id, $translations) {
    if ( ! $page_id ) {
        echo "  BLAD: page_id = 0, pomijam\n";
        return;
    }

    foreach ($translations as $field_name => $lang_values) {
        echo "--- Field: {$field_name} (page {$page_id}) ---\n";

        // Upewnij sie, ze pole PL ma wartosc
        $current_pl = get_field($field_name, $page_id);
        if ( empty($current_pl) ) {
            update_field($field_name, $lang_values['pl'], $page_id);
            echo "  [PL] Ustawiono wartosc: {$lang_values['pl']}\n";
        } else {
            echo "  [PL] Juz ustawione: {$current_pl}\n";
        }

        // Dla kazdego jezyka przetlumacz
        foreach (['en', 'uk', 'ru'] as $lang) {
            if ( ! isset($lang_values[$lang]) ) continue;

            $translated_page_id = apply_filters('wpml_object_id', $page_id, 'page', false, $lang);
            if ( ! $translated_page_id ) {
                echo "  [{$lang}] Brak przetlumaczonej strony - POMIJAM\n";
                continue;
            }

            do_action('wpml_switch_language', $lang);
            $current_val = get_field($field_name, $translated_page_id);

            if ( empty($current_val) || $current_val === $lang_values['pl'] ) {
                update_field($field_name, $lang_values[$lang], $translated_page_id);
                echo "  [{$lang}] Zaktualizowano (page {$translated_page_id}): {$lang_values[$lang]}\n";
            } else {
                echo "  [{$lang}] Juz przetlumaczone (page {$translated_page_id}): {$current_val}\n";
            }
            do_action('wpml_switch_language', null);
        }
        echo "\n";
    }
}

echo "=== Pola ACF: BPO ===\n";
_mer_fix_acf_fields($bpo_page_id, $bpo_translations);

echo "=== Pola ACF: Kontakt ===\n";
_mer_fix_acf_fields($kontakt_page_id, $kontakt_translations);

// ---- Rejestracja i tlumaczenie stringow PHP ----

echo "=== Rejestracja stringow PHP w WPML String Translation ===\n";

foreach ($string_translations as $original => $langs) {
    do_action('wpml_register_single_string', 'meritoros', $original, $original);
    echo "\n--- \"{$original}\" ---\n";
    echo "  Zarejestrowano w WPML String Translation\n";

    foreach ($langs as $lang => $translation) {
        $existing = apply_filters('wpml_translate_single_string', $original, 'meritoros', $original, $lang);
        if ( $existing !== $original ) {
            echo "  [{$lang}] Juz przetlumaczone: {$existing}\n";
        } else {
            global $wpdb;
            $string_id = $wpdb->get_var( $wpdb->prepare(
                "SELECT id FROM {$wpdb->prefix}icl_strings WHERE context = %s AND name = %s LIMIT 1",
                'meritoros', $original
            ));
            if ( $string_id ) {
                $exists = $wpdb->get_var( $wpdb->prepare(
                    "SELECT id FROM {$wpdb->prefix}icl_string_translations WHERE string_id = %d AND language = %s LIMIT 1",
                    $string_id, $lang
                ));
                if ( $exists ) {
                    $wpdb->update(
                        "{$wpdb->prefix}icl_string_translations",
                        ['value' => $translation, 'status' => 10],
                        ['id' => $exists]
                    );
                } else {
                    $wpdb->insert(
                        "{$wpdb->prefix}icl_string_translations",
                        ['string_id' => $string_id, 'language' => $lang, 'value' => $translation, 'status' => 10]
                    );
                }
                echo "  [{$lang}] Wstawiono: {$translation}\n";
            } else {
                echo "  [{$lang}] BLAD: nie znaleziono string_id w bazie\n";
            }
        }
    }
}

echo "\n=== GOTOWE ===\n";
echo '</pre>';
