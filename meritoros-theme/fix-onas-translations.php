<?php
/**
 * Jednorazowy skrypt: wpisuje tłumaczenia ACF na stronach "Poznaj nas" (EN/UK/RU)
 * Użycie: ?fix-onas=1 (jako admin)
 * ?fix-onas=debug — pokaż co jest w bazie
 * Po uruchomieniu: usuń ten plik.
 */
defined('ABSPATH') || exit;

add_action('init', function () {
    if (empty($_GET['fix-onas']) || !current_user_can('manage_options')) {
        return;
    }

    header('Content-Type: text/plain; charset=utf-8');
    global $wpdb;

    // Znajdź stronę PL "Poznaj nas"
    $pages = get_pages(['meta_key' => '_wp_page_template', 'meta_value' => 'page-o-nas.php']);
    if (empty($pages)) {
        echo "Nie znaleziono strony Poznaj nas!\n";
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

    // ============================================================
    // DEBUG MODE — pokaż co jest w postmeta
    // ============================================================
    if ($_GET['fix-onas'] === 'debug') {
        echo "\n=== DEBUG: postmeta na stronie EN (ID={$lang_ids['en']}) ===\n";
        $en_id = $lang_ids['en'];
        $fields = ['onas_jak_1_text', 'onas_jak_2_text', 'onas_jak_3_text', 'onas_jak_4_text', 'onas_mapa_cities'];
        foreach ($fields as $f) {
            $val = get_post_meta($en_id, $f, true);
            echo "{$f}: " . ($val ? mb_substr($val, 0, 80) : '(puste)') . "\n";

            // Sprawdź też ACF field key reference
            $key = get_post_meta($en_id, "_{$f}", true);
            echo "  _key: " . ($key ?: '(brak)') . "\n";
        }

        // Sprawdź co get_field zwraca
        echo "\n=== get_field() na EN page ===\n";
        for ($i = 1; $i <= 4; $i++) {
            $g = get_field("onas_jak_{$i}", $en_id);
            echo "onas_jak_{$i}: " . (is_array($g) ? "title=" . mb_substr($g['title'] ?? '', 0, 40) . " | text=" . mb_substr($g['text'] ?? '', 0, 60) : '(nie tablica)') . "\n";
        }
        $cities = get_field('onas_mapa_cities', $en_id);
        echo "onas_mapa_cities: " . mb_substr((string)$cities, 0, 80) . "\n";

        // Sprawdź mer_field
        echo "\n=== mer_field() (current page context) ===\n";
        echo "Aktualny język: " . apply_filters('wpml_current_language', null) . "\n";

        exit;
    }

    // ============================================================
    // Tłumaczenia do wpisania
    // ============================================================
    $translations = [
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
        'onas_mapa_cities' => [
            'en' => "Kraków (headquarters and 3 offices)\nWarsaw\nKatowice\nRzeszów\nWrocław\nŁódź\nBytom\n2 virtual offices operating fully online",
            'uk' => "Краків (головний офіс та 3 відділення)\nВаршава\nКатовіце\nЖешув\nВроцлав\nЛодзь\nБитом\n2 віртуальні офіси, що працюють повністю онлайн",
            'ru' => "Краков (головной офис и 3 отделения)\nВаршава\nКатовице\nЖешув\nВроцлав\nЛодзь\nБытом\n2 виртуальных офиса, работающих полностью онлайн",
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

            // Bezpośrednio do postmeta
            update_post_meta($page_id, $meta_key, $value);

            // Sprawdź czy ACF field key reference istnieje
            $acf_key = get_post_meta($page_id, "_{$meta_key}", true);
            if (!$acf_key) {
                // Skopiuj klucz z PL strony
                $pl_key = get_post_meta($pl_id, "_{$meta_key}", true);
                if ($pl_key) {
                    update_post_meta($page_id, "_{$meta_key}", $pl_key);
                    echo "  + skopiowano ACF key reference: _{$meta_key} = {$pl_key}\n";
                }
            }

            // Weryfikacja
            $check = get_post_meta($page_id, $meta_key, true);
            $ok = ($check === $value) ? 'OK' : 'FAIL';
            echo "{$ok} {$meta_key} [{$lang}] (page {$page_id}): " . mb_substr($value, 0, 60) . "\n";
            $updated++;
        }
    }

    // ============================================================
    // WPML String Translation — rejestracja PL stringów + tłumaczenia
    // ============================================================
    if (function_exists('icl_register_string')) {
        echo "\n=== Rejestracja w WPML String Translation ===\n";
        $context = 'meritoros';

        $st_data = [
            'Każdy klient współpracuje z przypisanym zespołem specjalistów oraz Liderem odpowiedzialnym za jakość i terminowość.' => [
                'en' => 'Every client works with a dedicated team of specialists and a Leader responsible for quality and timeliness.',
                'uk' => 'Кожен клієнт працює з виділеною командою спеціалістів та Лідером, відповідальним за якість і своєчасність.',
                'ru' => 'Каждый клиент работает с выделенной командой специалистов и Лидером, ответственным за качество и своевременность.',
            ],
            'Wszystkie działania opieramy na udokumentowanych procesach z określonymi SLA, checklistami i punktami kontroli jakości — tak by każda operacja była przewidywalna i powtarzalna.' => [
                'en' => 'All activities are based on documented processes with defined SLAs, checklists and quality control points — so that every operation is predictable and repeatable.',
                'uk' => 'Усі дії базуються на задокументованих процесах із визначеними SLA, чек-листами та контрольними точками якості — щоб кожна операція була передбачуваною та повторюваною.',
                'ru' => 'Все действия основаны на задокументированных процессах с определёнными SLA, чек-листами и точками контроля качества — чтобы каждая операция была предсказуемой и повторяемой.',
            ],
            'Procesy są tak zorganizowane, by urlopy i rotacja kadry nie wpływały na ciągłość obsługi. Klient zawsze ma kogoś do dyspozycji i nie odczuwa zmian personalnych.' => [
                'en' => 'Processes are organized so that vacations and staff rotation do not affect service continuity. The client always has someone available and does not feel personnel changes.',
                'uk' => 'Процеси організовані так, щоб відпустки та ротація кадрів не впливали на безперервність обслуговування. Клієнт завжди має когось у розпорядженні та не відчуває кадрових змін.',
                'ru' => 'Процессы организованы так, чтобы отпуска и ротация кадров не влияли на непрерывность обслуживания. У клиента всегда есть кто-то в распоряжении, и он не ощущает кадровых изменений.',
            ],
            'Dopasowujemy zakres, terminy raportowania i sposób komunikacji do realnych potrzeb firmy — niezależnie od jej wielkości czy etapu rozwoju.' => [
                'en' => 'We adapt the scope, reporting deadlines and communication methods to the real needs of the company — regardless of its size or stage of development.',
                'uk' => 'Ми адаптуємо обсяг, терміни звітності та спосіб комунікації до реальних потреб компанії — незалежно від її розміру чи етапу розвитку.',
                'ru' => 'Мы адаптируем объём, сроки отчётности и способ коммуникации к реальным потребностям компании — независимо от её размера или этапа развития.',
            ],
            'Kraków (siedziba główna)' => [
                'en' => 'Kraków (headquarters)',
                'uk' => 'Краків (головний офіс)',
                'ru' => 'Краков (головной офис)',
            ],
            "Kraków (siedziba główna oraz 3 oddziały)" => [
                'en' => 'Kraków (headquarters and 3 offices)',
                'uk' => 'Краків (головний офіс та 3 відділення)',
                'ru' => 'Краков (головной офис и 3 отделения)',
            ],
            '2 oddziały wirtualne działające w pełni online' => [
                'en' => '2 virtual offices operating fully online',
                'uk' => '2 віртуальні офіси, що працюють повністю онлайн',
                'ru' => '2 виртуальных офиса, работающих полностью онлайн',
            ],
        ];

        foreach ($st_data as $pl => $lang_translations) {
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

            foreach ($lang_translations as $lang => $translation) {
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
                echo "ST [{$lang}]: " . mb_substr($pl, 0, 40) . " => " . mb_substr($translation, 0, 40) . "\n";
            }
        }
    }

    echo "\n=== WYNIK ===\n";
    echo "ACF postmeta updated: {$updated}\n";
    echo "\nGotowe. Odpal ?fix-onas=debug aby zweryfikować.\n";
    echo "Potem usuń ten plik z serwera.\n";

    exit;
}, 1);
