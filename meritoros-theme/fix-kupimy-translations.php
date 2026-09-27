<?php
/**
 * Jednorazowy skrypt: tłumaczenia ACF na stronie "Kupimy biuro rachunkowe" (EN/UK/RU)
 * Użycie: ?fix-kupimy=1 (jako admin)
 * Po uruchomieniu: usuń ten plik.
 */
defined('ABSPATH') || exit;

add_action('init', function () {
    if (empty($_GET['fix-kupimy']) || !current_user_can('manage_options')) {
        return;
    }

    header('Content-Type: text/plain; charset=utf-8');

    $pages = get_pages(['meta_key' => '_wp_page_template', 'meta_value' => 'page-kupimy-biuro-rachunkowe.php']);
    if (empty($pages)) {
        echo "Nie znaleziono strony Kupimy!\n";
        exit;
    }
    $pl_id = $pages[0]->ID;
    echo "PL page ID: {$pl_id}\n";

    $lang_ids = [];
    foreach (['en', 'uk', 'ru'] as $lang) {
        $id = apply_filters('wpml_object_id', $pl_id, 'page', false, $lang);
        $lang_ids[$lang] = $id;
        echo "{$lang} page ID: " . ($id ?: 'BRAK') . "\n";
    }

    $translations = [
        'kupimy_hero_btn1_text' => [
            'en' => "Let's talk",
            'uk' => 'Поговоримо',
            'ru' => 'Поговорим',
        ],
        'kupimy_hero_btn2_text' => [
            'en' => 'See models',
            'uk' => 'Дізнатися моделі',
            'ru' => 'Узнать модели',
        ],
    ];

    echo "\n=== Wpisywanie tłumaczeń (update_post_meta) ===\n";
    $updated = 0;

    foreach ($translations as $meta_key => $lang_values) {
        foreach ($lang_values as $lang => $value) {
            $page_id = $lang_ids[$lang] ?? null;
            if (!$page_id) {
                echo "SKIP {$meta_key} [{$lang}]: brak strony\n";
                continue;
            }

            update_post_meta($page_id, $meta_key, $value);

            // Skopiuj ACF key reference z PL
            $acf_key = get_post_meta($page_id, "_{$meta_key}", true);
            if (!$acf_key) {
                $pl_key = get_post_meta($pl_id, "_{$meta_key}", true);
                if ($pl_key) {
                    update_post_meta($page_id, "_{$meta_key}", $pl_key);
                    echo "  + ACF key: _{$meta_key} = {$pl_key}\n";
                }
            }

            $check = get_post_meta($page_id, $meta_key, true);
            $ok = ($check === $value) ? 'OK' : 'FAIL';
            echo "{$ok} {$meta_key} [{$lang}] (page {$page_id}): {$value}\n";
            $updated++;
        }
    }

    echo "\n=== WYNIK ===\n";
    echo "Updated: {$updated}\n";
    echo "\nGotowe. Usuń ten plik z serwera.\n";

    exit;
}, 1);
