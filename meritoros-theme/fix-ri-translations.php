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

    // ============================================================
    // RI Info — "O nas"
    // ============================================================
    $info_translations = [
        'ri_info_title' => [
            'en' => 'About us', 'uk' => 'Про нас', 'ru' => 'О нас',
        ],
        'ri_sub1_title' => [
            'en' => 'Business profile', 'uk' => 'Профіль діяльності', 'ru' => 'Профиль деятельности',
        ],
        'ri_sub1_text' => [
            'en' => 'We have been operating since 2004. In 2007, we transformed into a capital company, and in 2021 into a joint-stock company. We direct our offer to both SME enterprises and large entities.',
            'uk' => 'Ми працюємо на ринку з 2004 року. У 2007 році ми перетворилися на капітальну компанію, а у 2021 році — на акціонерне товариство. Свою пропозицію ми спрямовуємо як підприємствам сектора МСП, так і великим суб\'єктам.',
            'ru' => 'Мы работаем на рынке с 2004 года. В 2007 году мы преобразовались в капитальную компанию, а в 2021 году — в акционерное общество. Наше предложение направлено как предприятиям сектора МСП, так и крупным субъектам.',
        ],
        'ri_sub2_title' => [
            'en' => 'Scale of operations', 'uk' => 'Масштаб діяльності', 'ru' => 'Масштаб деятельности',
        ],
        'ri_sub2_text' => [
            'en' => 'We serve over 1,200 entities, and our team comprises over 180 specialists in accounting, payroll and HR, IT and RPA.',
            'uk' => 'Ми обслуговуємо понад 1200 суб\'єктів, а команду складають понад 180 спеціалістів у сферах бухгалтерії, кадрів і зарплат, IT та RPA.',
            'ru' => 'Мы обслуживаем более 1200 субъектов, а команду составляют более 180 специалистов в областях бухгалтерии, кадров и зарплат, IT и RPA.',
        ],
        'ri_sub3_title' => [
            'en' => 'Reach and capital group', 'uk' => 'Охоплення та капітальна група', 'ru' => 'Охват и капитальная группа',
        ],
        'ri_sub3_companies' => [
            'en' => "Taxaide Sp. z o.o. based in Wrocław, KRS: 0000811046\nBluematica Sp. z o.o. based in Rzeszów, KRS: 0000994219",
            'uk' => "Taxaide Sp. z o.o. з місцезнаходженням у Вроцлаві, KRS: 0000811046\nBluematica Sp. z o.o. з місцезнаходженням у Жешуві, KRS: 0000994219",
            'ru' => "Taxaide Sp. z o.o. с местонахождением во Вроцлаве, KRS: 0000811046\nBluematica Sp. z o.o. с местонахождением в Жешуве, KRS: 0000994219",
        ],
        'ri_sub4_title' => [
            'en' => 'Growth strategy', 'uk' => 'Стратегія розвитку', 'ru' => 'Стратегия развития',
        ],
        'ri_sub4_text' => [
            'en' => 'Our strategy involves organic growth and growth through acquisitions of entities in the industry. The goal of Meritoros SA is to achieve a leading position in accounting outsourcing as well as payroll and HR for the SME sector and large entities in the Polish market. In parallel, we invest in technologies supporting the development of complementary services, with particular emphasis on Robotic Process Automation.',
            'uk' => 'Наша стратегія передбачає органічне зростання та зростання через придбання суб\'єктів галузі. Метою Meritoros SA є досягнення лідерської позиції в аутсорсингу бухгалтерії та кадрів і зарплат для сектора МСП та великих суб\'єктів на польському ринку. Паралельно ми інвестуємо в технології, що підтримують розвиток комплементарних послуг, з особливим акцентом на Robotic Process Automation.',
            'ru' => 'Наша стратегия предполагает органический рост и рост через приобретение субъектов отрасли. Целью Meritoros SA является достижение лидирующей позиции в аутсорсинге бухгалтерии, а также кадров и зарплат для сектора МСП и крупных субъектов на польском рынке. Параллельно мы инвестируем в технологии, поддерживающие развитие комплементарных услуг, с особым акцентом на Robotic Process Automation.',
        ],
        // Stats
        'ri_stat_1_label' => [
            'en' => 'Start of operations', 'uk' => 'Початок діяльності', 'ru' => 'Начало деятельности',
        ],
        'ri_stat_2_label' => [
            'en' => 'Clients', 'uk' => 'Клієнтів', 'ru' => 'Клиентов',
        ],
        'ri_stat_3_label' => [
            'en' => 'Specialists', 'uk' => 'Спеціалістів', 'ru' => 'Специалистов',
        ],
        'ri_stat_4_label' => [
            'en' => 'locations', 'uk' => 'локацій', 'ru' => 'локаций',
        ],
        'ri_stat_4_sublabel' => [
            'en' => '(and still growing)', 'uk' => '(і ми продовжуємо рости)', 'ru' => '(и мы продолжаем расти)',
        ],
        // Award
        'ri_award_title' => [
            'en' => 'Awards and distinctions', 'uk' => 'Нагороди та відзнаки', 'ru' => 'Награды и отличия',
        ],
        'ri_award_text' => [
            'en' => 'Awards are the result of how we develop Meritoros: consistently and process-driven. We maintain a standard that is meant to work in practice — every day.',
            'uk' => 'Відзнаки є результатом того, як ми розвиваємо Meritoros: послідовно та процесно. Ми тримаємо стандарт, який має працювати на практиці — щодня.',
            'ru' => 'Награды являются результатом того, как мы развиваем Meritoros: последовательно и процессно. Мы держим стандарт, который должен работать на практике — каждый день.',
        ],
    ];

    echo "\n=== RI Info — O nas ===\n";
    foreach ($info_translations as $meta_key => $lang_values) {
        foreach ($lang_values as $lang => $value) {
            $page_id = $lang_ids[$lang] ?? null;
            if (!$page_id) continue;
            update_post_meta($page_id, $meta_key, $value);
            $acf_key = get_post_meta($page_id, "_{$meta_key}", true);
            if (!$acf_key) {
                $pl_key = get_post_meta($pl_id, "_{$meta_key}", true);
                if ($pl_key) update_post_meta($page_id, "_{$meta_key}", $pl_key);
            }
            echo "OK {$meta_key} [{$lang}]: " . mb_substr($value, 0, 60) . "\n";
            $updated++;
        }
    }

    echo "\nUpdated: {$updated}\nGotowe. Usuń ten plik.\n";
    exit;
}, 1);
