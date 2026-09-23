<?php
/**
 * Import WPML String Translations - Footer, Header, Newsletter
 *
 * Rejestruje stringi z __()/_e() w footer/header/newsletter
 * i dodaje tlumaczenia EN/RU/UK.
 *
 * Uzycie: otworz w przegladarce jako zalogowany admin:
 *   https://meritoros.pl/?import-wpml-fhn=1
 *
 * Po imporcie ten plik mozna usunac.
 */
defined('ABSPATH') || exit;

add_action('init', function () {
    if (empty($_GET['import-wpml-fhn']) || !current_user_can('manage_options')) {
        return;
    }

    if (!function_exists('icl_register_string') || !function_exists('icl_add_string_translation')) {
        wp_die('WPML String Translation nie jest aktywny.');
    }

    $context = 'meritoros';

    // PL string => [en => ..., ru => ..., uk => ...]
    $strings = [
        // --- Footer: naglowki kolumn ---
        'Usługi' => [
            'en' => 'Services',
            'ru' => 'Услуги',
            'uk' => 'Послуги',
        ],
        'Informacje' => [
            'en' => 'Information',
            'ru' => 'Информация',
            'uk' => 'Інформація',
        ],
        'Kontakt' => [
            'en' => 'Contact',
            'ru' => 'Контакт',
            'uk' => 'Контакт',
        ],

        // --- Footer: linki uslug ---
        'Usługi księgowe' => [
            'en' => 'Accounting services',
            'ru' => 'Бухгалтерские услуги',
            'uk' => 'Бухгалтерські послуги',
        ],
        'Kadry i płace' => [
            'en' => 'HR & Payroll',
            'ru' => 'Кадры и зарплаты',
            'uk' => 'Кадри і зарплати',
        ],
        'Fundacje rodzinne' => [
            'en' => 'Family foundations',
            'ru' => 'Семейные фонды',
            'uk' => 'Сімейні фонди',
        ],
        'Skup biur rachunkowych' => [
            'en' => 'Buying accounting firms',
            'ru' => 'Покупка бухгалтерий',
            'uk' => 'Купівля бухгалтерій',
        ],

        // --- Footer: linki informacyjne ---
        'Polityka prywatności' => [
            'en' => 'Privacy policy',
            'ru' => 'Политика конфиденциальности',
            'uk' => 'Політика конфіденційності',
        ],
        'Regulamin newslettera' => [
            'en' => 'Newsletter terms',
            'ru' => 'Условия рассылки',
            'uk' => 'Умови розсилки',
        ],
        'Wiedza i poradniki' => [
            'en' => 'Knowledge & guides',
            'ru' => 'Знания и советы',
            'uk' => 'Знання та поради',
        ],

        // --- Footer: stopka ---
        'Projekt i realizacja:' => [
            'en' => 'Design & development:',
            'ru' => 'Дизайн и разработка:',
            'uk' => 'Дизайн і розробка:',
        ],

        // --- Header ---
        'Panel klienta' => [
            'en' => 'Client portal',
            'ru' => 'Панель клиента',
            'uk' => 'Панель клієнта',
        ],
        'Menu główne' => [
            'en' => 'Main menu',
            'ru' => 'Главное меню',
            'uk' => 'Головне меню',
        ],
        'Otwórz menu' => [
            'en' => 'Open menu',
            'ru' => 'Открыть меню',
            'uk' => 'Відкрити меню',
        ],
        'Zamknij menu' => [
            'en' => 'Close menu',
            'ru' => 'Закрыть меню',
            'uk' => 'Закрити меню',
        ],
        'Menu' => [
            'en' => 'Menu',
            'ru' => 'Меню',
            'uk' => 'Меню',
        ],

        // --- Newsletter: checkboxy ---
        'Informacje podatkowo-księgowe' => [
            'en' => 'Tax & accounting news',
            'ru' => 'Налоговая информация',
            'uk' => 'Податкова інформація',
        ],
        'Oferty pracy' => [
            'en' => 'Job offers',
            'ru' => 'Вакансии',
            'uk' => 'Вакансії',
        ],

        // --- Newsletter: komunikat admin ---
        'Przypisz formularz CF7 w ustawieniach strony głównej (zakładka Newsletter → ID formularza CF7).' => [
            'en' => 'Assign a CF7 form in the homepage settings (Newsletter tab → CF7 form ID).',
            'ru' => 'Назначьте форму CF7 в настройках главной страницы (вкладка Newsletter → ID формы CF7).',
            'uk' => 'Призначте форму CF7 в налаштуваннях головної сторінки (вкладка Newsletter → ID форми CF7).',
        ],

        // --- RI: sekcje dokumentow ---
        'Brak' => [
            'en' => 'None',
            'ru' => 'Нет',
            'uk' => 'Немає',
        ],
        'Pobierz dokument' => [
            'en' => 'Download document',
            'ru' => 'Скачать документ',
            'uk' => 'Завантажити документ',
        ],

        // --- Model wspolpracy ---
        'Pełny zakres' => [
            'en' => 'Full scope',
            'ru' => 'Полный объём',
            'uk' => 'Повний обсяг',
        ],
        'Wybrany zakres' => [
            'en' => 'Selected scope',
            'ru' => 'Выбранный объём',
            'uk' => 'Обраний обсяг',
        ],
        'Zapytaj o wycenę' => [
            'en' => 'Request a quote',
            'ru' => 'Запросить расчёт',
            'uk' => 'Запитати розрахунок',
        ],

        // --- Case studies / Media ---
        'Poznaj historię' => [
            'en' => 'Read the story',
            'ru' => 'Узнать историю',
            'uk' => 'Дізнатися історію',
        ],

        // --- Fundacje rodzinne ---
        'myślących długoterminowo' => [
            'en' => 'thinking long-term',
            'ru' => 'мыслящих долгосрочно',
            'uk' => 'що мислять довгостроково',
        ],

        // --- Kupimy: kryteria ---
        'Spotkanie' => [
            'en' => 'Meeting',
            'ru' => 'Встреча',
            'uk' => 'Зустріч',
        ],
    ];

    global $wpdb;

    $registered = 0;
    $translated = 0;
    $errors     = [];

    echo '<html><head><meta charset="utf-8"><title>Import WPML - Footer/Header/Newsletter</title></head><body>';
    echo '<h1>Import stringow Footer / Header / Newsletter</h1>';
    echo '<p>Kontekst: <code>' . esc_html($context) . '</code></p>';
    echo '<p>Stringow do importu: <strong>' . count($strings) . '</strong></p>';

    foreach ($strings as $pl_string => $lang_translations) {
        $name = (mb_strlen($pl_string) > 160)
            ? mb_substr($pl_string, 0, 140) . '_' . md5($pl_string)
            : $pl_string;

        icl_register_string($context, $name, $pl_string);
        $registered++;

        // Pobierz ID stringa
        $string_id = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM {$wpdb->prefix}icl_strings WHERE context = %s AND value = %s",
            $context,
            $pl_string
        ));

        if (!$string_id) {
            $errors[] = 'Nie znaleziono ID dla: ' . mb_substr($pl_string, 0, 80);
            continue;
        }

        foreach ($lang_translations as $lang => $translation) {
            if (!empty($translation)) {
                icl_add_string_translation($string_id, $lang, $translation, ICL_STRING_TRANSLATION_COMPLETE);
                $translated++;
            }
        }

        echo '<p>&#10003; <code>' . esc_html(mb_substr($pl_string, 0, 60)) . '</code> &rarr; '
            . count($lang_translations) . ' tlumaczen</p>';
    }

    echo '<h2>Wynik</h2>';
    echo '<ul>';
    echo '<li>Zarejestrowanych: <strong>' . $registered . '</strong></li>';
    echo '<li>Tlumaczen dodanych: <strong>' . $translated . '</strong></li>';
    echo '</ul>';

    if ($errors) {
        echo '<h2>Bledy (' . count($errors) . ')</h2><ul>';
        foreach ($errors as $err) {
            echo '<li>' . esc_html($err) . '</li>';
        }
        echo '</ul>';
    }

    echo '<p style="color:green;font-weight:bold;">Import zakonczony. Sprawdz WPML &gt; String Translation.</p>';
    echo '</body></html>';
    exit;
}, 20);
