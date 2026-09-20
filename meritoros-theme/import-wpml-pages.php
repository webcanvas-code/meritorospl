<?php
/**
 * Import WPML Page Translations
 *
 * Tworzy kopie stron w EN/UK/RU za pomocą WPML API.
 * WPML automatycznie skopiuje pola ACF zadeklarowane w wpml-config.xml.
 *
 * Użycie: otwórz w przeglądarce jako zalogowany admin:
 *   https://domena.pl/?import-wpml-pages=1
 *
 * Tryb podglądu (domyślny) - wyświetla co zostanie zrobione:
 *   https://domena.pl/?import-wpml-pages=1
 *
 * Tryb wykonania - tworzy strony:
 *   https://domena.pl/?import-wpml-pages=1&execute=1
 *
 * Po imporcie ten plik można usunąć.
 */
defined('ABSPATH') || exit;

add_action('init', function () {
    if (empty($_GET['import-wpml-pages']) || !current_user_can('manage_options')) {
        return;
    }

    // Sprawdź czy WPML jest aktywny
    if (!function_exists('wpml_get_default_language') || !defined('ICL_LANGUAGE_CODE')) {
        wp_die('WPML nie jest aktywny lub nie jest w pełni załadowany.');
    }

    $execute      = !empty($_GET['execute']);
    $default_lang = apply_filters('wpml_default_language', null); // 'pl'
    $target_langs = ['en', 'uk', 'ru'];

    echo '<html><head><meta charset="utf-8"><title>Import WPML Pages</title></head><body>';
    echo '<h1>Import stron do WPML</h1>';
    echo '<p>Język domyślny: <code>' . esc_html($default_lang) . '</code></p>';
    echo '<p>Języki docelowe: <code>' . implode(', ', $target_langs) . '</code></p>';
    echo $execute
        ? '<p style="color:orange;font-weight:bold;">TRYB WYKONANIA - tworzenie stron</p>'
        : '<p style="color:blue;font-weight:bold;">TRYB PODGLĄDU - bez zmian. Dodaj &amp;execute=1 do URL aby utworzyć strony.</p>';

    // Pobierz wszystkie opublikowane strony w domyślnym języku
    $pages = get_posts([
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'suppress_filters' => false,
    ]);

    // Filtruj do stron w domyślnym języku
    $source_pages = [];
    foreach ($pages as $page) {
        $page_lang = apply_filters('wpml_element_language_code', null, [
            'element_id'   => $page->ID,
            'element_type' => 'post_page',
        ]);

        if ($page_lang === $default_lang || empty($page_lang)) {
            $source_pages[] = $page;
        }
    }

    echo '<p>Znaleziono <strong>' . count($source_pages) . '</strong> stron w języku PL.</p>';
    echo '<table border="1" cellpadding="6" cellspacing="0" style="border-collapse:collapse;margin:20px 0;">';
    echo '<tr><th>ID</th><th>Tytuł</th><th>Slug</th><th>EN</th><th>UK</th><th>RU</th></tr>';

    $created = 0;
    $skipped = 0;

    foreach ($source_pages as $page) {
        $trid = apply_filters('wpml_element_trid', null, $page->ID, 'post_page');

        echo '<tr>';
        echo '<td>' . $page->ID . '</td>';
        echo '<td>' . esc_html($page->post_title) . '</td>';
        echo '<td>' . esc_html($page->post_name) . '</td>';

        foreach ($target_langs as $lang) {
            // Sprawdź czy tłumaczenie już istnieje
            $existing = apply_filters('wpml_object_id', $page->ID, 'page', false, $lang);

            if ($existing) {
                echo '<td style="background:#d4edda;">Istnieje (ID: ' . $existing . ')</td>';
                $skipped++;
                continue;
            }

            if ($execute) {
                // Utwórz kopię strony
                $new_page_data = [
                    'post_title'    => $page->post_title, // zostanie przetłumaczony w WPML
                    'post_content'  => $page->post_content,
                    'post_status'   => 'publish',
                    'post_type'     => 'page',
                    'post_name'     => $page->post_name . '-' . $lang,
                    'post_parent'   => 0,
                    'page_template' => get_page_template_slug($page->ID),
                ];

                $new_id = wp_insert_post($new_page_data);

                if (is_wp_error($new_id)) {
                    echo '<td style="background:#f8d7da;">Błąd: ' . esc_html($new_id->get_error_message()) . '</td>';
                    continue;
                }

                // Połącz z WPML jako tłumaczenie
                $set_language_args = [
                    'element_id'           => $new_id,
                    'element_type'         => 'post_page',
                    'trid'                 => $trid,
                    'language_code'        => $lang,
                    'source_language_code' => $default_lang,
                ];
                do_action('wpml_set_element_language_details', $set_language_args);

                // Skopiuj pola ACF ze strony źródłowej
                $acf_fields = get_fields($page->ID);
                if (is_array($acf_fields)) {
                    foreach ($acf_fields as $field_name => $field_value) {
                        update_field($field_name, $field_value, $new_id);
                    }
                }

                // Skopiuj page template
                $template = get_post_meta($page->ID, '_wp_page_template', true);
                if ($template) {
                    update_post_meta($new_id, '_wp_page_template', $template);
                }

                echo '<td style="background:#cce5ff;">Utworzono (ID: ' . $new_id . ')</td>';
                $created++;
            } else {
                echo '<td style="background:#fff3cd;">Do utworzenia</td>';
            }
        }
        echo '</tr>';
    }

    echo '</table>';

    echo '<h2>Podsumowanie</h2>';
    echo '<ul>';
    echo '<li>Stron źródłowych: <strong>' . count($source_pages) . '</strong></li>';
    if ($execute) {
        echo '<li>Utworzonych tłumaczeń: <strong>' . $created . '</strong></li>';
        echo '<li>Pominiętych (już istnieją): <strong>' . $skipped . '</strong></li>';
    } else {
        echo '<li style="color:blue;">Uruchom z <code>&amp;execute=1</code> aby utworzyć strony.</li>';
    }
    echo '</ul>';

    if ($execute && $created > 0) {
        echo '<p style="color:green;font-weight:bold;">Import zakończony. Przejdź do WPML &gt; Translation Management aby zarządzać tłumaczeniami stron.</p>';
    }

    echo '</body></html>';
    exit;
}, 20);
