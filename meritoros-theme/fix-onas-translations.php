<?php
/**
 * Jednorazowy skrypt: wpisuje tłumaczenia ACF na stronach "Poznaj nas" (EN/UK/RU)
 * Użycie: ?fix-onas=1 (jako admin)
 * Po uruchomieniu: usuń ten plik.
 */
defined('ABSPATH') || exit;

add_action('init', function () {
    if (empty($_GET['fix-onas']) || !current_user_can('manage_options')) {
        return;
    }

    header('Content-Type: text/plain; charset=utf-8');

    // Znajdź stronę PL "Poznaj nas" (template: page-o-nas.php)
    $pages = get_pages(['meta_key' => '_wp_page_template', 'meta_value' => 'page-o-nas.php']);
    if (empty($pages)) {
        echo "Nie znaleziono strony Poznaj nas!\n";
        exit;
    }
    $pl_id = $pages[0]->ID;
    echo "PL page ID: {$pl_id}\n";

    // Pobierz ID stron EN/UK/RU
    $langs = ['en', 'uk', 'ru'];
    $lang_ids = [];
    foreach ($langs as $lang) {
        $id = apply_filters('wpml_object_id', $pl_id, 'page', false, $lang);
        $lang_ids[$lang] = $id;
        echo "{$lang} page ID: " . ($id ?: 'BRAK') . "\n";
    }

    // ============================================================
    // Jak pracujemy — texty (tytuły tłumaczą się przez __())
    // ============================================================
    $jak_texts = [
        'onas_jak_1_text' => [
            'en' => 'Every client works with a dedicated team of specialists and a Leader responsible for quality and timeliness.',
            'uk' => 'Кожен клієнт працює з виділеною командою спеціалістів та Лідером, відповідальним за якість і своєчасність.',
            'ru' => 'Каждый клиент работает с выделенной командой специалистов и Лидером, ответственным за качество и своевременность.',
        ],
        'onas_jak_2_text' => [
            'en' => 'All activities are based on documented processes with defined SLAs, checklists and quality control points — so that every operation is predictable and repeatable.',
            'uk' => 'Усі дії базуються на задокументованих процесах із визначеними SLA, чек-листами та контрольними точками якості — щоб кожна операція була передбачуваною та повторюваною.',
            'ru' => 'Все действия основаны на задокументированных процессах с определёнными SLA, чек-листами и точками контроля качества — чтобы каждая операция была предсказуемой и повторяемой.',
        ],
        'onas_jak_3_text' => [
            'en' => 'Processes are organized so that vacations and staff rotation do not affect service continuity. The client always has someone available and does not feel personnel changes.',
            'uk' => 'Процеси організовані так, щоб відпустки та ротація кадрів не впливали на безперервність обслуговування. Клієнт завжди має когось у розпорядженні та не відчуває кадрових змін.',
            'ru' => 'Процессы организованы так, чтобы отпуска и ротация кадров не влияли на непрерывность обслуживания. У клиента всегда есть кто-то в распоряжении, и он не ощущает кадровых изменений.',
        ],
        'onas_jak_4_text' => [
            'en' => 'We adapt the scope, reporting deadlines and communication methods to the real needs of the company — regardless of its size or stage of development.',
            'uk' => 'Ми адаптуємо обсяг, терміни звітності та спосіб комунікації до реальних потреб компанії — незалежно від її розміру чи етапу розвитку.',
            'ru' => 'Мы адаптируем объём, сроки отчётности и способ коммуникации к реальным потребностям компании — независимо от её размера или этапа развития.',
        ],
    ];

    // ============================================================
    // Gdzie działamy — lista miast
    // ============================================================
    $mapa_cities = [
        'onas_mapa_cities' => [
            'en' => "Kraków (headquarters and 3 offices)\nWarsaw\nKatowice\nRzeszów\nWrocław\nŁódź\nBytom\n2 virtual offices operating fully online",
            'uk' => "Краків (головний офіс та 3 відділення)\nВаршава\nКатовіце\nЖешув\nВроцлав\nЛодзь\nБитом\n2 віртуальні офіси, що працюють повністю онлайн",
            'ru' => "Краков (головной офис и 3 отделения)\nВаршава\nКатовице\nЖешув\nВроцлав\nЛодзь\nБытом\n2 виртуальных офиса, работающих полностью онлайн",
        ],
    ];

    $all_fields = array_merge($jak_texts, $mapa_cities);

    echo "\n=== Wpisywanie tłumaczeń ACF ===\n";
    $updated = 0;
    $skipped = 0;

    foreach ($all_fields as $field_name => $translations) {
        foreach ($translations as $lang => $value) {
            $page_id = $lang_ids[$lang] ?? null;
            if (!$page_id) {
                echo "SKIP {$field_name} [{$lang}]: brak strony\n";
                $skipped++;
                continue;
            }

            update_field($field_name, $value, $page_id);
            echo "OK {$field_name} [{$lang}] (page {$page_id}): " . mb_substr($value, 0, 60) . "...\n";
            $updated++;
        }
    }

    // ============================================================
    // Zarejestruj też stringi w WPML ST (dla __() fallbacku)
    // ============================================================
    if (function_exists('icl_register_string')) {
        echo "\n=== Rejestracja w WPML String Translation ===\n";
        $context = 'meritoros';

        // Teksty PL do rejestracji
        $pl_strings = [
            'Wszystkie działania opieramy na udokumentowanych procesach z określonymi SLA, checklistami i punktami kontroli jakości — tak by każda operacja była przewidywalna i powtarzalna.',
            'Procesy są tak zorganizowane, by urlopy i rotacja kadry nie wpływały na ciągłość obsługi. Klient zawsze ma kogoś do dyspozycji i nie odczuwa zmian personalnych.',
            'Dopasowujemy zakres, terminy raportowania i sposób komunikacji do realnych potrzeb firmy — niezależnie od jej wielkości czy etapu rozwoju.',
            'Kraków (siedziba główna)',
            '2 oddziały wirtualne działające w pełni online',
        ];

        $st_translations = [
            // jak_2 text
            0 => [
                'en' => 'All activities are based on documented processes with defined SLAs, checklists and quality control points — so that every operation is predictable and repeatable.',
                'uk' => 'Усі дії базуються на задокументованих процесах із визначеними SLA, чек-листами та контрольними точками якості — щоб кожна операція була передбачуваною та повторюваною.',
                'ru' => 'Все действия основаны на задокументированных процессах с определёнными SLA, чек-листами и точками контроля качества — чтобы каждая операция была предсказуемой и повторяемой.',
            ],
            // jak_3 text
            1 => [
                'en' => 'Processes are organized so that vacations and staff rotation do not affect service continuity. The client always has someone available and does not feel personnel changes.',
                'uk' => 'Процеси організовані так, щоб відпустки та ротація кадрів не впливали на безперервність обслуговування. Клієнт завжди має когось у розпорядженні та не відчуває кадрових змін.',
                'ru' => 'Процессы организованы так, чтобы отпуска и ротация кадров не влияли на непрерывность обслуживания. У клиента всегда есть кто-то в распоряжении, и он не ощущает кадровых изменений.',
            ],
            // jak_4 text
            2 => [
                'en' => 'We adapt the scope, reporting deadlines and communication methods to the real needs of the company — regardless of its size or stage of development.',
                'uk' => 'Ми адаптуємо обсяг, терміни звітності та спосіб комунікації до реальних потреб компанії — незалежно від її розміру чи етапу розвитку.',
                'ru' => 'Мы адаптируем объём, сроки отчётности и способ коммуникации к реальным потребностям компании — независимо от её размера или этапа развития.',
            ],
            // mapa: Kraków
            3 => [
                'en' => 'Kraków (headquarters)',
                'uk' => 'Краків (головний офіс)',
                'ru' => 'Краков (головной офис)',
            ],
            // mapa: 2 oddziały
            4 => [
                'en' => '2 virtual offices operating fully online',
                'uk' => '2 віртуальні офіси, що працюють повністю онлайн',
                'ru' => '2 виртуальных офиса, работающих полностью онлайн',
            ],
        ];

        global $wpdb;
        foreach ($pl_strings as $idx => $pl) {
            $name = 'theme_' . md5($pl);
            icl_register_string($context, $name, $pl);

            $string_id = $wpdb->get_var($wpdb->prepare(
                "SELECT id FROM {$wpdb->prefix}icl_strings WHERE context = %s AND name = %s",
                $context, $name
            ));

            if (!$string_id) {
                echo "ERR: nie zarejestrowano: " . mb_substr($pl, 0, 50) . "\n";
                continue;
            }

            foreach ($st_translations[$idx] as $lang => $translation) {
                $existing = $wpdb->get_var($wpdb->prepare(
                    "SELECT id FROM {$wpdb->prefix}icl_string_translations WHERE string_id = %d AND language = %s",
                    $string_id, $lang
                ));

                if ($existing) {
                    $wpdb->update(
                        $wpdb->prefix . 'icl_string_translations',
                        ['value' => $translation, 'status' => ICL_STRING_TRANSLATION_COMPLETE],
                        ['id' => $existing]
                    );
                } else {
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
                echo "ST {$lang}: " . mb_substr($pl, 0, 40) . " => " . mb_substr($translation, 0, 40) . "\n";
            }
        }
    }

    echo "\n=== WYNIK ===\n";
    echo "ACF updated: {$updated}\n";
    echo "ACF skipped: {$skipped}\n";
    echo "\nGotowe. Usuń ten plik z serwera.\n";

    exit;
}, 1);
