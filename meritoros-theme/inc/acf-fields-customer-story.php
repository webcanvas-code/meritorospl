<?php
defined('ABSPATH') || exit;

/* ── Kafelki efektów (wstawiane w tab Efekty) ── */
$effect_tile_fields = [];
for ($i = 1; $i <= 6; $i++) {
    $effect_tile_fields[] = [
        'key'        => 'field_cs_effect_tile_' . $i,
        'label'      => 'Kafelek efektu ' . $i,
        'name'       => 'cs_effect_tile_' . $i,
        'type'       => 'group',
        'layout'     => 'row',
        'sub_fields' => [
            ['key' => 'field_cs_effect_tile_' . $i . '_label', 'label' => 'Naglowek kafelka', 'name' => 'label', 'type' => 'text'],
            ['key' => 'field_cs_effect_tile_' . $i . '_desc',  'label' => 'Opis',             'name' => 'desc',  'type' => 'textarea', 'rows' => 2],
        ],
    ];
}

/* ── Korzyści (wstawiane w tab Korzyści) ── */
$benefit_fields = [];
for ($i = 1; $i <= 8; $i++) {
    $benefit_fields[] = [
        'key'        => 'field_cs_benefit_' . $i,
        'label'      => 'Korzysc ' . $i,
        'name'       => 'cs_benefit_' . $i,
        'type'       => 'group',
        'layout'     => 'row',
        'sub_fields' => [
            ['key' => 'field_cs_benefit_' . $i . '_value', 'label' => 'Wartosc (np. 6%)', 'name' => 'value', 'type' => 'text'],
            ['key' => 'field_cs_benefit_' . $i . '_label', 'label' => 'Etykieta',         'name' => 'label', 'type' => 'text'],
            ['key' => 'field_cs_benefit_' . $i . '_desc',  'label' => 'Opis',             'name' => 'desc',  'type' => 'textarea', 'rows' => 2],
        ],
    ];
}

$cs_fields = array_merge(
    [
        // ── Tab: Podstawowe ──────────────────────────────────────────
        ['key' => 'field_cs_tab_basic',   'label' => 'Podstawowe',                     'name' => '',             'type' => 'tab'],
        ['key' => 'field_cs_tags',        'label' => 'Tagi (każdy w nowej linii)',      'name' => 'cs_tags',      'type' => 'textarea', 'rows' => 3],
        ['key' => 'field_cs_logo',        'label' => 'Logo klienta',                   'name' => 'cs_logo',      'type' => 'image', 'return_format' => 'array', 'preview_size' => 'large'],
        ['key' => 'field_cs_logo_size',   'label' => 'Wielkość logo (na liście historii)', 'name' => 'cs_logo_size', 'type' => 'select', 'default_value' => 'h-14', 'choices' => ['h-10' => 'S (40px)', 'h-14' => 'M (56px)', 'h-16' => 'L (64px)', 'h-20' => 'XL (80px)', 'h-24' => 'XXL (96px)'], 'return_format' => 'value'],
        ['key' => 'field_cs_logo_url',    'label' => 'Link pod logo (np. strona klienta)',  'name' => 'cs_logo_url',  'type' => 'url', 'instructions' => 'Opcjonalny link wyświetlany pod logotypem na stronie historii.'],
        ['key' => 'field_cs_thumbnail',    'label' => 'Miniatura wideo',                      'name' => 'cs_thumbnail',   'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'],
        ['key' => 'field_cs_cover_image', 'label' => 'Okładka (gdy brak wideo)',              'name' => 'cs_cover_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium', 'instructions' => 'Zdjęcie wyświetlane na liście historii i na stronie historii, gdy nie ma wideo.'],
        ['key' => 'field_cs_video_url',   'label' => 'URL wideo (YouTube / Vimeo)',           'name' => 'cs_video_url', 'type' => 'text'],
        ['key' => 'field_cs_video_file',  'label' => 'Plik wideo (mp4 / webm)',        'name' => 'cs_video_file','type' => 'file', 'return_format' => 'array', 'mime_types' => 'mp4,webm'],
        ['key' => 'field_cs_video_desc',  'label' => 'Opis (pod miniaturą wideo)',      'name' => 'cs_video_desc','type' => 'textarea', 'rows' => 3, 'instructions' => 'Krótki opis wyświetlany pod miniaturą w sekcji wideo na stronie Historii klientów.'],
        [
            'key'     => 'field_cs_article_category',
            'label'   => 'Kategoria (Wiedza i poradniki)',
            'name'    => 'article_category',
            'type'    => 'checkbox',
            'choices' => [
                'bpo'       => 'BPO',
                'podatkowe' => 'Podatkowo-księgowe',
                'rynek'     => 'Rynek biur rachunkowych',
                'filmy'     => 'Filmy',
                'medialne'  => 'Artykuły medialne',
                'historie'  => 'Historie klientów',
            ],
            'layout' => 'horizontal',
        ],

        // ── Tab: Klient ──────────────────────────────────────────────
        ['key' => 'field_cs_tab_client',       'label' => 'Klient',          'name' => '',                   'type' => 'tab'],
        ['key' => 'field_cs_client_sec_title', 'label' => 'Nagłówek sekcji', 'name' => 'cs_client_sec_title','type' => 'text', 'default_value' => 'Informacje o kliencie:'],
        ['key' => 'field_cs_client_info',      'label' => 'Opis klienta',    'name' => 'cs_client_info',     'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0],

        // ── Tab: CTA (kafelek boczny) ─────────────────────────────────
        ['key' => 'field_cs_tab_cta',      'label' => 'CTA – kafelek boczny', 'name' => '',                'type' => 'tab'],
        ['key' => 'field_cs_cta_title',    'label' => 'Tytuł',                'name' => 'cs_cta_title',    'type' => 'textarea', 'rows' => 2, 'default_value' => "Oddaj ksiegowosc\nw rece ekspertow"],
        ['key' => 'field_cs_cta_btn_text', 'label' => 'Tekst przycisku',      'name' => 'cs_cta_btn_text', 'type' => 'text', 'default_value' => 'Umow sie na rozmowe'],
        ['key' => 'field_cs_cta_btn_url',  'label' => 'Link przycisku',       'name' => 'cs_cta_btn_url',  'type' => 'text'],

        // ── Tab: Wyzwanie ─────────────────────────────────────────────
        ['key' => 'field_cs_tab_challenge',       'label' => 'Wyzwanie',       'name' => '',                      'type' => 'tab'],
        ['key' => 'field_cs_challenge_sec_title', 'label' => 'Nagłówek sekcji','name' => 'cs_challenge_sec_title','type' => 'text', 'default_value' => 'Wyzwanie'],
        ['key' => 'field_cs_challenge',           'label' => 'Tresc',          'name' => 'cs_challenge',          'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0],

        // ── Tab: Rozwiązanie ──────────────────────────────────────────
        ['key' => 'field_cs_tab_solution',       'label' => 'Rozwiazanie',      'name' => '',                      'type' => 'tab'],
        ['key' => 'field_cs_solution_sec_title', 'label' => 'Naglowek sekcji',  'name' => 'cs_solution_sec_title', 'type' => 'text', 'default_value' => 'Rozwiazanie'],
        ['key' => 'field_cs_solution_text',      'label' => 'Opis rozwiazania', 'name' => 'cs_solution_text',      'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0],
        ['key' => 'field_cs_solution_items',     'label' => 'Lista punktow (kazdy w nowej linii)', 'name' => 'cs_solution_items', 'type' => 'textarea', 'rows' => 5],
        ['key' => 'field_cs_solution_extra',     'label' => 'Dodatkowy akapit (opcjonalnie)',      'name' => 'cs_solution_extra', 'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0],

        // ── Tab: Jak to zrobiliśmy ────────────────────────────────────
        ['key' => 'field_cs_tab_how',       'label' => 'Jak to zrobilismy', 'name' => '',                 'type' => 'tab'],
        ['key' => 'field_cs_how_sec_title', 'label' => 'Naglowek sekcji',   'name' => 'cs_how_sec_title', 'type' => 'text', 'default_value' => 'Jak to zrobilismy?'],
        ['key' => 'field_cs_how',           'label' => 'Tresc',             'name' => 'cs_how',           'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0],

        // ── Tab: Efekty wdrożenia ─────────────────────────────────────
        ['key' => 'field_cs_tab_effects',        'label' => 'Efekty wdrozenia',                    'name' => '',                      'type' => 'tab'],
        ['key' => 'field_cs_effects_sec_title',  'label' => 'Naglowek sekcji',                     'name' => 'cs_effects_sec_title',  'type' => 'text',     'default_value' => 'Efekt wdrozenia i korzysci'],
        ['key' => 'field_cs_effects_intro',      'label' => 'Akapit wstepny',                      'name' => 'cs_effects_intro',      'type' => 'textarea', 'rows' => 2],
        ['key' => 'field_cs_effects_sub_title',  'label' => 'Podtytul listy efektow',              'name' => 'cs_effects_sub_title',  'type' => 'text',     'default_value' => 'Najwazniejsze efekty:'],
        ['key' => 'field_cs_effects_items',      'label' => 'Lista efektow (kazdy w nowej linii)', 'name' => 'cs_effects_items',      'type' => 'textarea', 'rows' => 5],
        ['key' => 'field_cs_effects_tiles_title','label' => 'Naglowek kafelkow (opcjonalnie)',     'name' => 'cs_effects_tiles_title','type' => 'text'],
    ],
    $effect_tile_fields,
    [
        ['key' => 'field_cs_testimonial_text',   'label' => 'Cytat klienta', 'name' => 'cs_testimonial_text',   'type' => 'textarea', 'rows' => 3],
        ['key' => 'field_cs_testimonial_author', 'label' => 'Autor cytatu',  'name' => 'cs_testimonial_author', 'type' => 'text', 'placeholder' => 'Jan Kowalski, Prezes Zarzadu'],

        // ── Tab: Korzyści ─────────────────────────────────────────────
        ['key' => 'field_cs_tab_benefits',   'label' => 'Korzysci',        'name' => '',                  'type' => 'tab'],
        ['key' => 'field_cs_benefits_title', 'label' => 'Naglowek sekcji', 'name' => 'cs_benefits_title', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Wdrozenie przynioslo rowniez konkretne, mierzalne korzysci:'],
    ],
    $benefit_fields
);

acf_add_local_field_group([
    'key'        => 'group_mer_cs',
    'title'      => 'Historia klienta',
    'fields'     => $cs_fields,
    'location'   => [[['param' => 'post_type', 'operator' => '==', 'value' => 'customer-story']]],
    'menu_order' => 0,
    'position'   => 'normal',
]);
