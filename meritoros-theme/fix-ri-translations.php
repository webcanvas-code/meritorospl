<?php
defined('ABSPATH') || exit;
add_action('init', function () {
    if (empty($_GET['fix-ri']) || !current_user_can('manage_options')) return;
    header('Content-Type: text/plain; charset=utf-8');

    $pl_page = get_page_by_path('relacje-inwestorskie');
    if (!$pl_page) { echo "Brak strony RI!\n"; exit; }
    $pl_id = $pl_page->ID;
    echo "PL page ID: {$pl_id}\n";

    $lang_ids = [];
    foreach (['en', 'uk', 'ru'] as $lang) {
        $id = apply_filters('wpml_object_id', $pl_id, 'page', false, $lang);
        $lang_ids[$lang] = $id;
        echo "{$lang} page ID: " . ($id ?: 'BRAK') . "\n";
    }

    $translations = [
        // Rośniemy
        'ri_rosniemy_title' => [
            'en' => 'We are growing',
            'uk' => 'Ми зростаємо',
            'ru' => 'Мы растём',
        ],
        'ri_rosniemy_text' => [
            'en' => 'The development of Meritoros SA is reflected in the systematic growth of the scale of operations and revenues over recent years.',
            'uk' => 'Розвиток Meritoros SA відображається в систематичному зростанні масштабів діяльності та доходів протягом останніх років.',
            'ru' => 'Развитие Meritoros SA отражается в систематическом росте масштабов деятельности и доходов на протяжении последних лет.',
        ],
        // Zarząd — title
        'ri_zarzad_title' => [
            'en' => 'Board of Directors',
            'uk' => 'Правління',
            'ru' => 'Правление',
        ],
        // Zarząd — member 1
        'ri_zarzad_member_1_role' => [
            'en' => 'Chairman of the Board, CEO',
            'uk' => 'голова правління, CEO',
            'ru' => 'председатель правления, CEO',
        ],
        'ri_zarzad_member_1_bio' => [
            'en' => 'Founder and main shareholder of Meritoros SA, certified accountant (Ministry of Finance Certificate No. 1840/2003). Graduate in Management with a specialization in Finance and Accounting.',
            'uk' => 'Засновник і головний акціонер Meritoros SA, сертифікований бухгалтер (Сертифікат Мін. Фінансів №1840/2003). Випускник напряму Менеджмент зі спеціалізацією Фінанси та Бухгалтерський облік.',
            'ru' => 'Основатель и главный акционер Meritoros SA, сертифицированный бухгалтер (Сертификат Мин. Финансов №1840/2003). Выпускник направления Менеджмент со специализацией Финансы и Бухгалтерский учёт.',
        ],
        // Zarząd — member 2
        'ri_zarzad_member_2_role' => [
            'en' => 'Board Member, COO',
            'uk' => 'член правління, COO',
            'ru' => 'член правления, COO',
        ],
        'ri_zarzad_member_2_bio' => [
            'en' => 'Shareholder of Meritoros SA, certified accountant (Ministry of Finance Certificate No. 54055/2011). Graduate of Management at AGH University, supplemented her education with postgraduate studies.',
            'uk' => 'Акціонер Meritoros SA, сертифікований бухгалтер (Сертифікат Мін. Фінансів №54055/2011). Випускниця напряму Менеджмент в AGH, доповнила свою освіту післядипломними студіями.',
            'ru' => 'Акционер Meritoros SA, сертифицированный бухгалтер (Сертификат Мин. Финансов №54055/2011). Выпускница направления Менеджмент в AGH, дополнила образование аспирантурой.',
        ],
        // Zarząd — member 3
        'ri_zarzad_member_3_role' => [
            'en' => 'Board Member, COO',
            'uk' => 'член правління, COO',
            'ru' => 'член правления, COO',
        ],
        'ri_zarzad_member_3_bio' => [
            'en' => 'Shareholder of Meritoros SA, certified accountant (Ministry of Finance Certificate No. 62092/2013). Graduate of Finance and Accounting at Cracow University of Economics with a specialization in corporate finance.',
            'uk' => 'Акціонер Meritoros SA, сертифікований бухгалтер (Сертифікат Мін. Фінансів №62092/2013). Випускник напряму Фінанси та Бухгалтерський облік в UEK зі спеціалізацією фінанси підприємств.',
            'ru' => 'Акционер Meritoros SA, сертифицированный бухгалтер (Сертификат Мин. Финансов №62092/2013). Выпускник направления Финансы и Бухгалтерский учёт в UEK со специализацией корпоративные финансы.',
        ],
        // Zarząd — member 4
        'ri_zarzad_member_4_role' => [
            'en' => 'Board Member, COO',
            'uk' => 'член правління, COO',
            'ru' => 'член правления, COO',
        ],
        'ri_zarzad_member_4_bio' => [
            'en' => 'Accountant (Ministry of Finance Certificate 55068/2012) with many years of experience. She built her career in accounting firms and as chief accountant at one of the international companies.',
            'uk' => 'Бухгалтер (Сертифікат Мін. Фінансів 55068/2012) з багаторічним досвідом. Свою кар\'єру будувала в бухгалтерських бюро та як головний бухгалтер в одній з міжнародних компаній.',
            'ru' => 'Бухгалтер (Сертификат Мин. Финансов 55068/2012) с многолетним опытом. Строила карьеру в бухгалтерских бюро и в качестве главного бухгалтера в одной из международных компаний.',
        ],
    ];

    echo "\n=== Wpisywanie tłumaczeń ===\n";
    $updated = 0;

    foreach ($translations as $meta_key => $lang_values) {
        foreach ($lang_values as $lang => $value) {
            $page_id = $lang_ids[$lang] ?? null;
            if (!$page_id) { echo "SKIP {$meta_key} [{$lang}]\n"; continue; }

            update_post_meta($page_id, $meta_key, $value);

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
            echo "{$ok} {$meta_key} [{$lang}]: " . mb_substr($value, 0, 60) . "\n";
            $updated++;
        }
    }

    echo "\nUpdated: {$updated}\nGotowe. Usuń ten plik.\n";
    exit;
}, 1);
