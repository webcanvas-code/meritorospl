<?php
defined('ABSPATH') || exit;
add_action('init', function () {
    if (empty($_GET['fix-kupimy-btn']) || !current_user_can('manage_options')) return;
    header('Content-Type: text/plain; charset=utf-8');

    $pages = get_pages(['meta_key' => '_wp_page_template', 'meta_value' => 'page-kupimy-biuro-rachunkowe.php']);
    if (empty($pages)) { echo "Brak strony!\n"; exit; }
    $pl_id = $pages[0]->ID;

    // Sprawdź co jest na PL
    echo "PL btn1: " . get_post_meta($pl_id, 'kupimy_hero_btn1_text', true) . "\n";
    echo "PL btn2: " . get_post_meta($pl_id, 'kupimy_hero_btn2_text', true) . "\n\n";

    $translations = [
        'kupimy_hero_btn1_text' => [
            'en' => 'Send inquiry',
            'uk' => 'Надіслати запит',
            'ru' => 'Отправить запрос',
        ],
        'kupimy_hero_btn2_text' => [
            'en' => 'Our criteria',
            'uk' => 'Наші критерії',
            'ru' => 'Наши критерии',
        ],
    ];

    foreach (['en', 'uk', 'ru'] as $lang) {
        $id = apply_filters('wpml_object_id', $pl_id, 'page', false, $lang);
        if (!$id) { echo "SKIP {$lang}: brak strony\n"; continue; }
        foreach ($translations as $key => $vals) {
            update_post_meta($id, $key, $vals[$lang]);
            $acf_key = get_post_meta($id, "_{$key}", true);
            if (!$acf_key) {
                $pl_key = get_post_meta($pl_id, "_{$key}", true);
                if ($pl_key) update_post_meta($id, "_{$key}", $pl_key);
            }
            echo "OK {$key} [{$lang}]: {$vals[$lang]}\n";
        }
    }
    echo "\nGotowe.\n";
    exit;
}, 1);
