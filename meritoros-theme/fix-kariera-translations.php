<?php
defined('ABSPATH') || exit;
add_action('init', function () {
    if (empty($_GET['fix-kariera']) || !current_user_can('manage_options')) return;
    header('Content-Type: text/plain; charset=utf-8');

    $pages = get_pages(['meta_key' => '_wp_page_template', 'meta_value' => 'page-kariera.php']);
    if (empty($pages)) { echo "Brak strony Kariera!\n"; exit; }
    $pl_id = $pages[0]->ID;
    echo "PL page ID: {$pl_id}\n";

    $lang_ids = [];
    foreach (['en', 'uk', 'ru'] as $lang) {
        $id = apply_filters('wpml_object_id', $pl_id, 'page', false, $lang);
        $lang_ids[$lang] = $id;
        echo "{$lang} page ID: " . ($id ?: 'BRAK') . "\n";
    }

    // Tryb debug — pokaż aktualne oferty z PL
    if ($_GET['fix-kariera'] === 'debug') {
        echo "\n=== Oferty na PL ===\n";
        for ($i = 1; $i <= 6; $i++) {
            $g = get_field("kar_oferta_{$i}", $pl_id);
            if (!is_array($g) || empty($g['title'])) {
                echo "kar_oferta_{$i}: (puste)\n";
                continue;
            }
            echo "kar_oferta_{$i}: title={$g['title']} | salary={$g['salary']} | cat={$g['cat']}\n";
        }
        echo "\nkar_oferty_title: " . get_field('kar_oferty_title', $pl_id) . "\n";

        foreach (['en', 'uk', 'ru'] as $lang) {
            $id = $lang_ids[$lang];
            if (!$id) continue;
            echo "\n=== Oferty na {$lang} (page {$id}) ===\n";
            for ($i = 1; $i <= 6; $i++) {
                $title = get_post_meta($id, "kar_oferta_{$i}_title", true);
                echo "kar_oferta_{$i}_title: " . ($title ?: '(puste)') . "\n";
            }
            echo "kar_oferty_title: " . (get_post_meta($id, 'kar_oferty_title', true) ?: '(puste)') . "\n";
        }
        exit;
    }

    // Tłumaczenia
    $translations = [
        'kar_oferty_title' => [
            'en' => 'Current job offers', 'uk' => 'Актуальні вакансії', 'ru' => 'Актуальные вакансии',
        ],
    ];

    // Skopiuj oferty z PL do EN/UK/RU (te same dane — oferty pracy pozostają po polsku,
    // ale kopiujemy żeby sekcja się wyświetlała)
    echo "\n=== Kopiowanie ofert z PL ===\n";
    $sub_fields = ['title', 'salary', 'cat', 'traffit_url', 'url'];
    for ($i = 1; $i <= 6; $i++) {
        foreach ($sub_fields as $sf) {
            $meta_key = "kar_oferta_{$i}_{$sf}";
            $pl_val = get_post_meta($pl_id, $meta_key, true);
            if ($pl_val === '' || $pl_val === false) continue;

            foreach (['en', 'uk', 'ru'] as $lang) {
                $page_id = $lang_ids[$lang] ?? null;
                if (!$page_id) continue;

                $existing = get_post_meta($page_id, $meta_key, true);
                if ($existing === '' || $existing === false) {
                    update_post_meta($page_id, $meta_key, $pl_val);
                    // ACF key reference
                    $acf_key = get_post_meta($page_id, "_{$meta_key}", true);
                    if (!$acf_key) {
                        $pl_key = get_post_meta($pl_id, "_{$meta_key}", true);
                        if ($pl_key) update_post_meta($page_id, "_{$meta_key}", $pl_key);
                    }
                    echo "COPY {$meta_key} [{$lang}]: " . mb_substr($pl_val, 0, 50) . "\n";
                } else {
                    echo "SKIP {$meta_key} [{$lang}]: already set\n";
                }
            }
        }
    }

    // Wpisz tłumaczenia tytułu sekcji
    echo "\n=== Tłumaczenia ===\n";
    $updated = 0;
    foreach ($translations as $meta_key => $lang_values) {
        foreach ($lang_values as $lang => $value) {
            $page_id = $lang_ids[$lang] ?? null;
            if (!$page_id) continue;
            update_post_meta($page_id, $meta_key, $value);
            $acf_key = get_post_meta($page_id, "_{$meta_key}", true);
            if (!$acf_key) {
                $pl_key = get_post_meta($pl_id, "_{$meta_key}", true);
                if ($pl_key) update_post_meta($page_id, "_{$meta_key}", $pl_key);
            }
            echo "OK {$meta_key} [{$lang}]: {$value}\n";
            $updated++;
        }
    }

    echo "\nUpdated: {$updated}\nGotowe. Usuń ten plik.\n";
    exit;
}, 1);
