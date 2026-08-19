<?php
defined('ABSPATH') || exit;

$front_page_location = [[['param' => 'page_type', 'operator' => '==', 'value' => 'front_page']]];

/* ==================================================================
   1. NAWIGACJA
================================================================== */
acf_add_local_field_group([
    'key'      => 'group_mer_nav',
    'title'    => '🧭 Nawigacja',
    'fields'   => [
        [
            'key'           => 'field_mer_nav_cta_text',
            'label'         => 'Tekst przycisku CTA',
            'name'          => 'nav_cta_text',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Skontaktuj się',
        ],
        [
            'key'           => 'field_mer_nav_cta_url',
            'label'         => 'Link przycisku CTA',
            'name'          => 'nav_cta_url',
            'type'          => 'text',
            'default_value' => '#kontakt',
        ],
        [
            'key'          => 'field_mer_nav_items',
            'label'        => 'Elementy menu',
            'name'         => 'nav_items',
            'type'         => 'repeater',
            'button_label' => 'Dodaj element',
            'sub_fields'   => [
                [
                    'key'   => 'field_mer_nav_item_label',
                    'label' => 'Etykieta',
                    'name'  => 'label',
                    'type'  => 'textarea',
                    'rows'  => 1,
                ],
                [
                    'key'   => 'field_mer_nav_item_url',
                    'label' => 'Link (opcjonalnie)',
                    'name'  => 'url',
                    'type'  => 'text',
                ],
                [
                    'key'   => 'field_mer_nav_item_has_dropdown',
                    'label' => 'Ma dropdown?',
                    'name'  => 'has_dropdown',
                    'type'  => 'true_false',
                    'ui'    => 1,
                ],
                [
                    'key'                => 'field_mer_nav_item_dropdown',
                    'label'              => 'Linki w dropdown',
                    'name'               => 'dropdown_links',
                    'type'               => 'repeater',
                    'button_label'       => 'Dodaj link',
                    'conditional_logic'  => [[['field' => 'field_mer_nav_item_has_dropdown', 'operator' => '==', 'value' => '1']]],
                    'sub_fields'         => [
                        [
                            'key'   => 'field_mer_nav_dd_label',
                            'label' => 'Etykieta',
                            'name'  => 'label',
                            'type'  => 'textarea',
                            'rows'  => 1,
                        ],
                        [
                            'key'   => 'field_mer_nav_dd_url',
                            'label' => 'Link',
                            'name'  => 'url',
                            'type'  => 'text',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'location'   => $front_page_location,
    'menu_order' => 0,
    'position'   => 'normal',
]);

/* ==================================================================
   2. HERO
================================================================== */
acf_add_local_field_group([
    'key'      => 'group_mer_hero',
    'title'    => '🏠 Hero',
    'fields'   => [
        [
            'key'           => 'field_mer_hero_bg',
            'label'         => 'Zdjęcie tła',
            'name'          => 'hero_bg_image',
            'type'          => 'image',
            'return_format' => 'array',
            'preview_size'  => 'medium',
        ],
        [
            'key'           => 'field_mer_hero_headline',
            'label'         => 'Nagłówek główny',
            'name'          => 'hero_headline',
            'type'          => 'textarea',
            'rows'          => 3,
            'instructions'  => 'Każda linia tekstu będzie wyświetlona w nowej linii.',
            'default_value' => "Eksperci w księgowości.\nTechnologia i pewność\nw działaniu.",
        ],
        [
            'key'           => 'field_mer_hero_subheadline',
            'label'         => 'Podtytuł',
            'name'          => 'hero_subheadline',
            'type'          => 'textarea',
            'rows'          => 3,
            'new_lines'     => 'br',
            'default_value' => 'Zapewniamy księgowość kadry i outsourcing procesów w standardzie, który daje firmom spokój i bezpieczeństwo. Przejmujemy odpowiedzialność za jakość, terminowość i ciągłość obsługi.',
        ],
        [
            'key'           => 'field_mer_hero_btn1_text',
            'label'         => 'Przycisk 1 — tekst',
            'name'          => 'hero_btn1_text',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Poznaj ofertę',
        ],
        [
            'key'           => 'field_mer_hero_btn1_url',
            'label'         => 'Przycisk 1 — link',
            'name'          => 'hero_btn1_url',
            'type'          => 'text',
            'default_value' => '#uslugi',
        ],
        [
            'key'           => 'field_mer_hero_btn2_text',
            'label'         => 'Przycisk 2 — tekst',
            'name'          => 'hero_btn2_text',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Porozmawiajmy',
        ],
        [
            'key'           => 'field_mer_hero_btn2_url',
            'label'         => 'Przycisk 2 — link',
            'name'          => 'hero_btn2_url',
            'type'          => 'text',
            'default_value' => '#kontakt',
        ],
        [
            'key'           => 'field_mer_hero_trust_text',
            'label'         => 'Tekst pod paskiem klientów',
            'name'          => 'hero_trust_text',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Zaufało nam ponad <span class="text-white">1200 klientów</span>',
            'instructions'  => 'Możesz użyć HTML np. <span class="text-white">...',
        ],
        ['key' => 'field_mer_hero_logo_1', 'label' => 'Logo klienta 1 (domyślnie Streamsoft)', 'name' => 'hero_logo_1', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'instructions' => 'PNG z ciemnym logo na przezroczystym tle. Wyświetlane białe (filtr invert).'],
        ['key' => 'field_mer_hero_logo_2', 'label' => 'Logo klienta 2 (domyślnie SITECH)',     'name' => 'hero_logo_2', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_mer_hero_logo_3', 'label' => 'Logo klienta 3 (domyślnie Arco)',       'name' => 'hero_logo_3', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_mer_hero_logo_4', 'label' => 'Logo klienta 4 (domyślnie ROFA)',       'name' => 'hero_logo_4', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
    ],
    'location'   => $front_page_location,
    'menu_order' => 10,
    'position'   => 'normal',
]);

/* ==================================================================
   3. WARTOŚCI (Bento Grid)
================================================================== */
acf_add_local_field_group([
    'key'      => 'group_mer_values',
    'title'    => '🎯 Wartości (Bento Grid)',
    'fields'   => [
        [
            'key'           => 'field_mer_val_label',
            'label'         => 'Etykieta sekcji',
            'name'          => 'values_label',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Nasze Wartości',
        ],
        [
            'key'           => 'field_mer_val_title',
            'label'         => 'Tytuł sekcji',
            'name'          => 'values_title',
            'type'          => 'textarea',
            'rows'          => 2,
            'default_value' => "Dlaczego Meritoros to spokój\nw Twoim biznesie?",
        ],
        // Karta 1
        [
            'key'           => 'field_mer_val_c1_icon',
            'label'         => 'Karta 1 — Ikona (Lucide)',
            'name'          => 'val_c1_icon',
            'type'          => 'text',
            'default_value' => 'infinity',
        ],
        [
            'key'           => 'field_mer_val_c1_title',
            'label'         => 'Karta 1 — Tytuł',
            'name'          => 'val_c1_title',
            'type'          => 'textarea',
            'rows'          => 2,
            'default_value' => "Skala i ciągłość\nobsługi",
        ],
        [
            'key'           => 'field_mer_val_c1_desc',
            'label'         => 'Karta 1 — Opis',
            'name'          => 'val_c1_desc',
            'type'          => 'textarea',
            'default_value' => 'Pracujemy zespołowo i procesowo, dzięki czemu obsługa nie zależy od jednej osoby. Zapewniamy zastępowalność i ciągłość pracy – bez przestojów.',
        ],
        // Karta 2 — zdjęcie
        [
            'key'           => 'field_mer_val_img',
            'label'         => 'Karta 2 — Zdjęcie (środek)',
            'name'          => 'val_img',
            'type'          => 'image',
            'return_format' => 'array',
            'preview_size'  => 'medium',
        ],
        [
            'key'           => 'field_mer_val_img_hover',
            'label'         => 'Karta 2 — Tekst hover',
            'name'          => 'val_img_hover_text',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Współpracuj z profesjonalistami',
        ],
        // Karta 3 — ciemna
        [
            'key'           => 'field_mer_val_c3_icon',
            'label'         => 'Karta 3 — Ikona',
            'name'          => 'val_c3_icon',
            'type'          => 'text',
            'default_value' => 'shield-check',
        ],
        [
            'key'           => 'field_mer_val_c3_title',
            'label'         => 'Karta 3 — Tytuł',
            'name'          => 'val_c3_title',
            'type'          => 'textarea',
            'rows'          => 2,
            'default_value' => "Bezpieczeństwo\ni compliance",
        ],
        [
            'key'           => 'field_mer_val_c3_desc',
            'label'         => 'Karta 3 — Opis',
            'name'          => 'val_c3_desc',
            'type'          => 'textarea',
            'default_value' => 'Działamy zgodnie z obowiązującymi regulacjami i standardami bezpieczeństwa danych. Dbamy o poufność informacji oraz jasne zasady współpracy - bez "skrótów" i ryzyk.',
        ],
        // Karta 4 — zielona
        [
            'key'           => 'field_mer_val_c4_icon',
            'label'         => 'Karta 4 — Ikona',
            'name'          => 'val_c4_icon',
            'type'          => 'text',
            'default_value' => 'bot',
        ],
        [
            'key'           => 'field_mer_val_c4_title',
            'label'         => 'Karta 4 — Tytuł',
            'name'          => 'val_c4_title',
            'type'          => 'textarea',
            'rows'          => 2,
            'default_value' => "Technologia\ni automatyzacja",
        ],
        [
            'key'           => 'field_mer_val_c4_desc',
            'label'         => 'Karta 4 — Opis',
            'name'          => 'val_c4_desc',
            'type'          => 'textarea',
            'default_value' => 'Wykorzystujemy narzędzia i automatyzację (RPA), które porządkują obieg dokumentów, ograniczają ryzyko błędów i usprawniają pracę zespołów.',
        ],
        // Karta 5 — nagrody
        [
            'key'           => 'field_mer_val_c5_title',
            'label'         => 'Karta 5 — Tytuł',
            'name'          => 'val_c5_title',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Nagrody i wyróżnienia',
        ],
        [
            'key'           => 'field_mer_val_c5_desc',
            'label'         => 'Karta 5 — Opis',
            'name'          => 'val_c5_desc',
            'type'          => 'textarea',
            'default_value' => 'Wyróżnienia są efektem tego, jak rozwijamy Meritoros: konsekwentnie i procesowo. Trzymamy standard, który ma działać w praktyce - codziennie.',
        ],
        [
            'key'          => 'field_mer_val_awards',
            'label'        => 'Karta 5 — Nagrody',
            'name'         => 'val_awards',
            'type'         => 'repeater',
            'button_label' => 'Dodaj nagrodę',
            'sub_fields'   => [
                [
                    'key'   => 'field_mer_val_award_label',
                    'label' => 'Nazwa nagrody',
                    'name'  => 'label',
                    'type'  => 'textarea',
                    'rows'  => 1,
                ],
            ],
        ],
        // Karta 6 — jakość
        [
            'key'           => 'field_mer_val_c6_icon',
            'label'         => 'Karta 6 — Ikona',
            'name'          => 'val_c6_icon',
            'type'          => 'text',
            'default_value' => 'award',
        ],
        [
            'key'           => 'field_mer_val_c6_title',
            'label'         => 'Karta 6 — Tytuł',
            'name'          => 'val_c6_title',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Jakość potwierdzona standardami',
        ],
        [
            'key'           => 'field_mer_val_c6_desc',
            'label'         => 'Karta 6 — Opis',
            'name'          => 'val_c6_desc',
            'type'          => 'textarea',
            'default_value' => 'Mamy wdrożone procedury kontroli jakości i weryfikacji danych. Dostarczamy spójne dane dla zarządu.',
        ],
        [
            'key'           => 'field_mer_val_c6_cert_label',
            'label'         => 'Karta 6 — Etykieta certyfikatu',
            'name'          => 'val_c6_cert_label',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Certyfikat',
        ],
        [
            'key'           => 'field_mer_val_c6_cert',
            'label'         => 'Karta 6 — Nazwa certyfikatu',
            'name'          => 'val_c6_cert',
            'type'          => 'text',
            'default_value' => 'ISO 9001:2015',
        ],
    ],
    'location'   => $front_page_location,
    'menu_order' => 20,
    'position'   => 'normal',
]);

/* ==================================================================
   4. USŁUGI
================================================================== */
acf_add_local_field_group([
    'key'      => 'group_mer_services',
    'title'    => '⚙️ Usługi',
    'fields'   => [
        [
            'key'           => 'field_mer_svc_label',
            'label'         => 'Etykieta sekcji',
            'name'          => 'services_label',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Nasze Kompetencje',
        ],
        [
            'key'           => 'field_mer_svc_title',
            'label'         => 'Tytuł sekcji',
            'name'          => 'services_title',
            'type'          => 'textarea',
            'rows'          => 2,
            'default_value' => 'Obszary, w których przejmujemy odpowiedzialność',
        ],
        [
            'key'           => 'field_mer_svc_desc',
            'label'         => 'Opis sekcji',
            'name'          => 'services_desc',
            'type'          => 'textarea',
            'default_value' => 'Nasze doświadczenie obejmuje rozliczanie firm o różnorodnych profilach działalności, takich jak CIT Estoński, Fundacje Rodzinne, Spółki ASI, e-commerce, VAT OSS, Intrastat oraz rozliczenia delegacji pracowniczych.',
        ],
        ['key' => 'field_mer_svc_tab_1',   'label' => '◆ Usługa 1', 'name' => 'svc_tab_1', 'type' => 'tab'],
        ['key' => 'field_mer_svc_1_icon',  'label' => 'Ikona (Lucide)',  'name' => 'service_1_icon',  'type' => 'text',     'default_value' => 'calculator',      'instructions' => 'np. calculator, network, file-text, heart-handshake, cpu'],
        ['key' => 'field_mer_svc_1_title', 'label' => 'Tytuł',           'name' => 'service_1_title', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Usługi Rachunkowe'],
        ['key' => 'field_mer_svc_1_desc',  'label' => 'Opis',            'name' => 'service_1_desc',  'type' => 'textarea', 'rows' => 2, 'default_value' => 'Kompleksowa obsługa księgowa firm o różnej skali działalności.'],
        ['key' => 'field_mer_svc_1_url',   'label' => 'Link',            'name' => 'service_1_url',   'type' => 'text',     'default_value' => '#'],

        ['key' => 'field_mer_svc_tab_2',   'label' => '◆ Usługa 2', 'name' => 'svc_tab_2', 'type' => 'tab'],
        ['key' => 'field_mer_svc_2_icon',  'label' => 'Ikona (Lucide)',  'name' => 'service_2_icon',  'type' => 'text',     'default_value' => 'network'],
        ['key' => 'field_mer_svc_2_title', 'label' => 'Tytuł',           'name' => 'service_2_title', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'BPO'],
        ['key' => 'field_mer_svc_2_desc',  'label' => 'Opis',            'name' => 'service_2_desc',  'type' => 'textarea', 'rows' => 2, 'default_value' => 'Outsourcing wybranych lub pełnych procesów finansowych i administracyjnych dla większych firm.'],
        ['key' => 'field_mer_svc_2_url',   'label' => 'Link',            'name' => 'service_2_url',   'type' => 'text',     'default_value' => '#'],

        ['key' => 'field_mer_svc_tab_3',   'label' => '◆ Usługa 3', 'name' => 'svc_tab_3', 'type' => 'tab'],
        ['key' => 'field_mer_svc_3_icon',  'label' => 'Ikona (Lucide)',  'name' => 'service_3_icon',  'type' => 'text',     'default_value' => 'file-text'],
        ['key' => 'field_mer_svc_3_title', 'label' => 'Tytuł',           'name' => 'service_3_title', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Usługi Kadrowe'],
        ['key' => 'field_mer_svc_3_desc',  'label' => 'Opis',            'name' => 'service_3_desc',  'type' => 'textarea', 'rows' => 2, 'default_value' => 'Obsługa kadrowo-płacowa dopasowana do potrzeb organizacji.'],
        ['key' => 'field_mer_svc_3_url',   'label' => 'Link',            'name' => 'service_3_url',   'type' => 'text',     'default_value' => '#'],

        ['key' => 'field_mer_svc_tab_4',   'label' => '◆ Usługa 4', 'name' => 'svc_tab_4', 'type' => 'tab'],
        ['key' => 'field_mer_svc_4_icon',  'label' => 'Ikona (Lucide)',  'name' => 'service_4_icon',  'type' => 'text',     'default_value' => 'heart-handshake'],
        ['key' => 'field_mer_svc_4_title', 'label' => 'Tytuł',           'name' => 'service_4_title', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Fundacje rodzinne'],
        ['key' => 'field_mer_svc_4_desc',  'label' => 'Opis',            'name' => 'service_4_desc',  'type' => 'textarea', 'rows' => 2, 'default_value' => 'Obsługa rachunkowa fundacji z uwzględnieniem specyfiki regulacyjnej.'],
        ['key' => 'field_mer_svc_4_url',   'label' => 'Link',            'name' => 'service_4_url',   'type' => 'text',     'default_value' => '#'],

        ['key' => 'field_mer_svc_tab_5',   'label' => '◆ Usługa 5', 'name' => 'svc_tab_5', 'type' => 'tab'],
        ['key' => 'field_mer_svc_5_icon',  'label' => 'Ikona (Lucide)',  'name' => 'service_5_icon',  'type' => 'text',     'default_value' => 'cpu'],
        ['key' => 'field_mer_svc_5_title', 'label' => 'Tytuł',           'name' => 'service_5_title', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Transformacja Cyfrowa'],
        ['key' => 'field_mer_svc_5_desc',  'label' => 'Opis',            'name' => 'service_5_desc',  'type' => 'textarea', 'rows' => 2, 'default_value' => 'Wsparcie we wdrażaniu narzędzi, automatyzacji i usprawnianiu procesów biznesowych.'],
        ['key' => 'field_mer_svc_5_url',   'label' => 'Link',            'name' => 'service_5_url',   'type' => 'text',     'default_value' => '#'],

        ['key' => 'field_mer_svc_tab_cta', 'label' => '◆ Karta CTA', 'name' => 'svc_tab_cta', 'type' => 'tab'],
        [
            'key'           => 'field_mer_svc_cta_title',
            'label'         => 'Karta CTA — Tytuł',
            'name'          => 'services_cta_title',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Zapytaj o ofertę',
        ],
        [
            'key'           => 'field_mer_svc_cta_sub',
            'label'         => 'Karta CTA — Podtytuł',
            'name'          => 'services_cta_sub',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Skontaktuj się z nami',
        ],
        [
            'key'           => 'field_mer_svc_cta_url',
            'label'         => 'Karta CTA — Link',
            'name'          => 'services_cta_url',
            'type'          => 'text',
            'default_value' => '#kontakt',
        ],
    ],
    'location'   => $front_page_location,
    'menu_order' => 30,
    'position'   => 'normal',
]);

/* ==================================================================
   5. CASE STUDIES
================================================================== */
acf_add_local_field_group([
    'key'      => 'group_mer_homepage_cs',
    'title'    => '📊 Case Studies',
    'fields'   => [
        [
            'key'           => 'field_mer_cs_label',
            'label'         => 'Etykieta sekcji',
            'name'          => 'cs_label',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Case Studies',
        ],
        [
            'key'           => 'field_mer_cs_title',
            'label'         => 'Tytuł sekcji',
            'name'          => 'cs_title',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Historie naszych klientów',
        ],
        [
            'key'           => 'field_mer_cs_subtitle',
            'label'         => 'Podtytuł sekcji',
            'name'          => 'cs_subtitle',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Krótkie historie firm, którym pomagamy uporządkować finanse i procesy. Przesuń palcem lub użyj strzałek.',
        ],
        ['key' => 'field_mer_cs_tab_1', 'label' => '◆ Slajd 1', 'name' => 'cs_tab_1', 'type' => 'tab'],
        ['key' => 'field_mer_cs_1_name',     'label' => 'Nazwa klienta',       'name' => 'cs_1_client_name',  'type' => 'textarea', 'rows' => 1, 'default_value' => 'HPC'],
        ['key' => 'field_mer_cs_1_logo',     'label' => 'Logo klienta (HTML)', 'name' => 'cs_1_logo_html',    'type' => 'textarea', 'rows' => 2, 'instructions' => 'np. <span class="text-2xl font-bold text-[#0f4c81]">HPC</span>'],
        ['key' => 'field_mer_cs_1_ind',      'label' => 'Branże',              'name' => 'cs_1_industries',   'type' => 'text',     'default_value' => 'Geologia inżynierska, Ochrona środowiska', 'instructions' => 'Oddzielone przecinkiem'],
        ['key' => 'field_mer_cs_1_stitle',   'label' => 'Zakres — Tytuł',      'name' => 'cs_1_scope_title',  'type' => 'textarea', 'rows' => 1, 'default_value' => 'Usługi rachunkowe, obszar kadr i płac, wsparcie w audytach'],
        ['key' => 'field_mer_cs_1_sdesc',    'label' => 'Zakres — Opis',       'name' => 'cs_1_scope_desc',   'type' => 'textarea', 'rows' => 3, 'default_value' => 'Po kilku zmianach głównej księgowej spółka potrzebowała szybkiego uporządkowania księgowości i bezpiecznego zamknięcia roku obrotowego. Wdrożyliśmy usprawnienia procesowe.'],
        ['key' => 'field_mer_cs_1_img',      'label' => 'Zdjęcie',             'name' => 'cs_1_image',        'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],
        ['key' => 'field_mer_cs_1_vlabel',   'label' => 'Opis wideo',                    'name' => 'cs_1_video_label',  'type' => 'textarea', 'rows' => 1, 'default_value' => 'Nasz wpływ na operacje HPC'],
        ['key' => 'field_mer_cs_1_vdur',     'label' => 'Czas wideo',                    'name' => 'cs_1_video_dur',    'type' => 'text',  'default_value' => '03:45'],
        ['key' => 'field_mer_cs_1_vfile',    'label' => 'Plik wideo (mp4/webm)',          'name' => 'cs_1_video_file',   'type' => 'file',  'return_format' => 'array', 'mime_types' => 'mp4,webm'],
        ['key' => 'field_mer_cs_1_vurl',     'label' => 'URL wideo (YouTube / Vimeo)',    'name' => 'cs_1_video_url',    'type' => 'text',  'instructions' => 'Używane tylko gdy nie wgrano pliku.'],
        ['key' => 'field_mer_cs_1_cta',      'label' => 'Link przycisku',   'name' => 'cs_1_cta_url',      'type' => 'text',     'instructions' => 'Puste lub # — kieruje na stronę „Historie naszych klientów”.', 'default_value' => ''],

        ['key' => 'field_mer_cs_tab_2', 'label' => '◆ Slajd 2', 'name' => 'cs_tab_2', 'type' => 'tab'],
        ['key' => 'field_mer_cs_2_name',     'label' => 'Nazwa klienta',       'name' => 'cs_2_client_name',  'type' => 'textarea', 'rows' => 1, 'default_value' => 'Printbox'],
        ['key' => 'field_mer_cs_2_logo',     'label' => 'Logo klienta (HTML)', 'name' => 'cs_2_logo_html',    'type' => 'textarea', 'rows' => 2],
        ['key' => 'field_mer_cs_2_ind',      'label' => 'Branże',              'name' => 'cs_2_industries',   'type' => 'text',     'default_value' => 'Technologia druku, E-commerce B2B', 'instructions' => 'Oddzielone przecinkiem'],
        ['key' => 'field_mer_cs_2_stitle',   'label' => 'Zakres — Tytuł',      'name' => 'cs_2_scope_title',  'type' => 'textarea', 'rows' => 1, 'default_value' => 'Pełna obsługa BPO, rozliczenia międzynarodowe VAT OSS'],
        ['key' => 'field_mer_cs_2_sdesc',    'label' => 'Zakres — Opis',       'name' => 'cs_2_scope_desc',   'type' => 'textarea', 'rows' => 3, 'default_value' => 'Przy dynamicznym wzroście sprzedaży cross-border firma potrzebowała partnera gotowego na złożone rozliczenia VAT OSS w wielu krajach UE. Przejęliśmy całość obsługi finansowej.'],
        ['key' => 'field_mer_cs_2_img',      'label' => 'Zdjęcie',             'name' => 'cs_2_image',        'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],
        ['key' => 'field_mer_cs_2_vlabel',   'label' => 'Opis wideo',                    'name' => 'cs_2_video_label',  'type' => 'textarea', 'rows' => 1, 'default_value' => 'Jak Printbox skaluje finanse globalnie'],
        ['key' => 'field_mer_cs_2_vdur',     'label' => 'Czas wideo',                    'name' => 'cs_2_video_dur',    'type' => 'text',  'default_value' => '04:10'],
        ['key' => 'field_mer_cs_2_vfile',    'label' => 'Plik wideo (mp4/webm)',          'name' => 'cs_2_video_file',   'type' => 'file',  'return_format' => 'array', 'mime_types' => 'mp4,webm'],
        ['key' => 'field_mer_cs_2_vurl',     'label' => 'URL wideo (YouTube / Vimeo)',    'name' => 'cs_2_video_url',    'type' => 'text',  'instructions' => 'Używane tylko gdy nie wgrano pliku.'],
        ['key' => 'field_mer_cs_2_cta',      'label' => 'Link przycisku',   'name' => 'cs_2_cta_url',      'type' => 'text',     'instructions' => 'Puste lub # — kieruje na stronę „Historie naszych klientów”.', 'default_value' => ''],

        ['key' => 'field_mer_cs_tab_3', 'label' => '◆ Slajd 3', 'name' => 'cs_tab_3', 'type' => 'tab'],
        ['key' => 'field_mer_cs_3_name',     'label' => 'Nazwa klienta',       'name' => 'cs_3_client_name',  'type' => 'textarea', 'rows' => 1, 'default_value' => 'SITECH'],
        ['key' => 'field_mer_cs_3_logo',     'label' => 'Logo klienta (HTML)', 'name' => 'cs_3_logo_html',    'type' => 'textarea', 'rows' => 2],
        ['key' => 'field_mer_cs_3_ind',      'label' => 'Branże',              'name' => 'cs_3_industries',   'type' => 'text',     'default_value' => 'Budownictwo, Inżynieria', 'instructions' => 'Oddzielone przecinkiem'],
        ['key' => 'field_mer_cs_3_stitle',   'label' => 'Zakres — Tytuł',      'name' => 'cs_3_scope_title',  'type' => 'textarea', 'rows' => 1, 'default_value' => 'Kadry, płace, Intrastat, rozliczenia delegacji zagranicznych'],
        ['key' => 'field_mer_cs_3_sdesc',    'label' => 'Zakres — Opis',       'name' => 'cs_3_scope_desc',   'type' => 'textarea', 'rows' => 3, 'default_value' => 'Firma realizowała kontrakty w kilku krajach jednocześnie. Meritoros przejął obsługę kadrową i rozliczenia Intrastat, odciążając zarząd od złożoności administracyjnej.'],
        ['key' => 'field_mer_cs_3_img',      'label' => 'Zdjęcie',             'name' => 'cs_3_image',        'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],
        ['key' => 'field_mer_cs_3_vlabel',   'label' => 'Opis wideo',                    'name' => 'cs_3_video_label',  'type' => 'textarea', 'rows' => 1, 'default_value' => 'Obsługa kadrowa na skalę międzynarodową'],
        ['key' => 'field_mer_cs_3_vdur',     'label' => 'Czas wideo',                    'name' => 'cs_3_video_dur',    'type' => 'text',  'default_value' => '05:22'],
        ['key' => 'field_mer_cs_3_vfile',    'label' => 'Plik wideo (mp4/webm)',          'name' => 'cs_3_video_file',   'type' => 'file',  'return_format' => 'array', 'mime_types' => 'mp4,webm'],
        ['key' => 'field_mer_cs_3_vurl',     'label' => 'URL wideo (YouTube / Vimeo)',    'name' => 'cs_3_video_url',    'type' => 'text',  'instructions' => 'Używane tylko gdy nie wgrano pliku.'],
        ['key' => 'field_mer_cs_3_cta',      'label' => 'Link przycisku',   'name' => 'cs_3_cta_url',      'type' => 'text',     'instructions' => 'Puste lub # — kieruje na stronę „Historie naszych klientów”.', 'default_value' => ''],

        ['key' => 'field_mer_cs_tab_4', 'label' => '◆ Slajd 4', 'name' => 'cs_tab_4', 'type' => 'tab'],
        ['key' => 'field_mer_cs_4_name',     'label' => 'Nazwa klienta',       'name' => 'cs_4_client_name',  'type' => 'textarea', 'rows' => 1, 'default_value' => 'ROFA'],
        ['key' => 'field_mer_cs_4_logo',     'label' => 'Logo klienta (HTML)', 'name' => 'cs_4_logo_html',    'type' => 'textarea', 'rows' => 2, 'instructions' => 'Zostaw puste, aby użyć domyślnego szablonu (jak w prototypie). Wyczyść nazwę klienta, aby ukryć slajd 4.'],
        ['key' => 'field_mer_cs_4_ind',      'label' => 'Branże',              'name' => 'cs_4_industries',   'type' => 'text',     'default_value' => 'Produkcja przemysłowa, Eksport', 'instructions' => 'Oddzielone przecinkiem'],
        ['key' => 'field_mer_cs_4_stitle',   'label' => 'Zakres — Tytuł',      'name' => 'cs_4_scope_title',  'type' => 'textarea', 'rows' => 1, 'default_value' => 'Pełna księgowość, fundacja rodzinna, compliance'],
        ['key' => 'field_mer_cs_4_sdesc',    'label' => 'Zakres — Opis',       'name' => 'cs_4_scope_desc',   'type' => 'textarea', 'rows' => 3, 'default_value' => 'Właściciel grupy produkcyjnej chciał oddzielić majątek prywatny od firmowego poprzez fundację rodzinną. Meritoros poprowadził cały proces prawno-księgowy od podstaw.'],
        ['key' => 'field_mer_cs_4_img',      'label' => 'Zdjęcie',             'name' => 'cs_4_image',        'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],
        ['key' => 'field_mer_cs_4_vlabel',   'label' => 'Opis wideo',                    'name' => 'cs_4_video_label',  'type' => 'textarea', 'rows' => 1, 'default_value' => 'Fundacja rodzinna krok po kroku'],
        ['key' => 'field_mer_cs_4_vdur',     'label' => 'Czas wideo',                    'name' => 'cs_4_video_dur',    'type' => 'text',  'default_value' => '06:08'],
        ['key' => 'field_mer_cs_4_vfile',    'label' => 'Plik wideo (mp4/webm)',          'name' => 'cs_4_video_file',   'type' => 'file',  'return_format' => 'array', 'mime_types' => 'mp4,webm'],
        ['key' => 'field_mer_cs_4_vurl',     'label' => 'URL wideo (YouTube / Vimeo)',    'name' => 'cs_4_video_url',    'type' => 'text',  'instructions' => 'Używane tylko gdy nie wgrano pliku.'],
        ['key' => 'field_mer_cs_4_cta',      'label' => 'Link przycisku',   'name' => 'cs_4_cta_url',      'type' => 'text',     'instructions' => 'Puste lub # — kieruje na stronę „Historie naszych klientów”.', 'default_value' => ''],
    ],
    'location'   => [
        [['param' => 'page_type',     'operator' => '==', 'value' => 'front_page']],
        [['param' => 'page_template', 'operator' => '==', 'value' => 'page-bpo.php']],
    ],
    'menu_order' => 40,
    'position'   => 'normal',
]);

/* ==================================================================
   6. OPINIE
================================================================== */
acf_add_local_field_group([
    'key'      => 'group_mer_testimonials',
    'title'    => '⭐ Opinie klientów',
    'fields'   => [
        [
            'key'           => 'field_mer_test_label',
            'label'         => 'Etykieta sekcji',
            'name'          => 'testimonials_label',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Opinie klientów',
        ],
        [
            'key'           => 'field_mer_test_title',
            'label'         => 'Tytuł sekcji',
            'name'          => 'testimonials_title',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Sprawdź, co mówią o nas inni',
        ],
        ['key' => 'field_mer_test_tab_1', 'label' => '◆ Opinia 1', 'name' => 'test_tab_1', 'type' => 'tab'],
        ['key' => 'field_mer_t1_company', 'label' => 'Firma',                    'name' => 'test_1_company',     'type' => 'textarea',  'rows' => 1, 'default_value' => 'HPC'],
        ['key' => 'field_mer_t1_logo',    'label' => 'Logo firmy (HTML)',         'name' => 'test_1_logo_html',   'type' => 'textarea',  'rows' => 2, 'instructions' => 'Opcjonalnie. Jeśli puste — wyświetlana jest nazwa firmy.'],
        ['key' => 'field_mer_t1_quote',   'label' => 'Treść opinii',             'name' => 'test_1_quote',       'type' => 'textarea',  'rows' => 3, 'default_value' => 'Mam księgowość w bezpiecznych rękach i wiem, że nie muszę się o to już martwić.'],
        ['key' => 'field_mer_t1_author',  'label' => 'Imię i nazwisko',          'name' => 'test_1_author',      'type' => 'textarea',  'rows' => 1, 'default_value' => 'Sebastian Wiśniewski'],
        ['key' => 'field_mer_t1_role',    'label' => 'Stanowisko / firma',       'name' => 'test_1_role',        'type' => 'textarea',  'rows' => 1, 'default_value' => 'HP Cepolgol S.A.'],
        ['key' => 'field_mer_t1_init',    'label' => 'Inicjały (awatar, 2 znaki)','name' => 'test_1_initials',   'type' => 'text',      'default_value' => 'SW'],
        ['key' => 'field_mer_t1_hl',      'label' => 'Wyróżniona karta (zielona)','name' => 'test_1_highlighted','type' => 'true_false','ui' => 1, 'default_value' => 0],

        ['key' => 'field_mer_test_tab_2', 'label' => '◆ Opinia 2', 'name' => 'test_tab_2', 'type' => 'tab'],
        ['key' => 'field_mer_t2_company', 'label' => 'Firma',                    'name' => 'test_2_company',     'type' => 'textarea',  'rows' => 1, 'default_value' => 'Printbox'],
        ['key' => 'field_mer_t2_logo',    'label' => 'Logo firmy (HTML)',         'name' => 'test_2_logo_html',   'type' => 'textarea',  'rows' => 2],
        ['key' => 'field_mer_t2_quote',   'label' => 'Treść opinii',             'name' => 'test_2_quote',       'type' => 'textarea',  'rows' => 3, 'default_value' => 'Meritoros dostarczył nam stabilność i pewność, w trudnych momentach zawsze mamy właściwe odpowiedzi.'],
        ['key' => 'field_mer_t2_author',  'label' => 'Imię i nazwisko',          'name' => 'test_2_author',      'type' => 'textarea',  'rows' => 1, 'default_value' => 'Michał Czaicki'],
        ['key' => 'field_mer_t2_role',    'label' => 'Stanowisko / firma',       'name' => 'test_2_role',        'type' => 'textarea',  'rows' => 1, 'default_value' => 'CEO & Co-Founder, Printbox'],
        ['key' => 'field_mer_t2_init',    'label' => 'Inicjały (awatar, 2 znaki)','name' => 'test_2_initials',   'type' => 'text',      'default_value' => 'MC'],
        ['key' => 'field_mer_t2_hl',      'label' => 'Wyróżniona karta (zielona)','name' => 'test_2_highlighted','type' => 'true_false','ui' => 1, 'default_value' => 1],

        ['key' => 'field_mer_test_tab_3', 'label' => '◆ Opinia 3', 'name' => 'test_tab_3', 'type' => 'tab'],
        ['key' => 'field_mer_t3_company', 'label' => 'Firma',                    'name' => 'test_3_company',     'type' => 'textarea',  'rows' => 1, 'default_value' => 'SITECH'],
        ['key' => 'field_mer_t3_logo',    'label' => 'Logo firmy (HTML)',         'name' => 'test_3_logo_html',   'type' => 'textarea',  'rows' => 2],
        ['key' => 'field_mer_t3_quote',   'label' => 'Treść opinii',             'name' => 'test_3_quote',       'type' => 'textarea',  'rows' => 3, 'default_value' => 'Profesjonalizm na każdym kroku. Polecamy Meritoros każdej firmie, która ceni sobie bezpieczeństwo i jakość obsługi.'],
        ['key' => 'field_mer_t3_author',  'label' => 'Imię i nazwisko',          'name' => 'test_3_author',      'type' => 'textarea',  'rows' => 1, 'default_value' => 'Anna Kowalczyk'],
        ['key' => 'field_mer_t3_role',    'label' => 'Stanowisko / firma',       'name' => 'test_3_role',        'type' => 'textarea',  'rows' => 1, 'default_value' => 'Dyrektor Finansowy, SITECH'],
        ['key' => 'field_mer_t3_init',    'label' => 'Inicjały (awatar, 2 znaki)','name' => 'test_3_initials',   'type' => 'text',      'default_value' => 'AK'],
        ['key' => 'field_mer_t3_hl',      'label' => 'Wyróżniona karta (zielona)','name' => 'test_3_highlighted','type' => 'true_false','ui' => 1, 'default_value' => 0],

        ['key' => 'field_mer_test_tab_stats', 'label' => '◆ Statystyki', 'name' => 'test_tab_stats', 'type' => 'tab'],
        ['key' => 'field_mer_ts1_val',  'label' => 'Statystyka 1 — Wartość',  'name' => 'test_stat_1_value', 'type' => 'text',      'default_value' => '1200+'],
        ['key' => 'field_mer_ts1_lbl',  'label' => 'Statystyka 1 — Etykieta', 'name' => 'test_stat_1_label', 'type' => 'textarea',  'rows' => 1, 'default_value' => 'Obsługiwanych klientów'],
        ['key' => 'field_mer_ts1_acc',  'label' => 'Statystyka 1 — Zielony',  'name' => 'test_stat_1_accent','type' => 'true_false','ui' => 1, 'default_value' => 0],
        ['key' => 'field_mer_ts2_val',  'label' => 'Statystyka 2 — Wartość',  'name' => 'test_stat_2_value', 'type' => 'text',      'default_value' => '18+'],
        ['key' => 'field_mer_ts2_lbl',  'label' => 'Statystyka 2 — Etykieta', 'name' => 'test_stat_2_label', 'type' => 'textarea',  'rows' => 1, 'default_value' => 'Lat na rynku'],
        ['key' => 'field_mer_ts2_acc',  'label' => 'Statystyka 2 — Zielony',  'name' => 'test_stat_2_accent','type' => 'true_false','ui' => 1, 'default_value' => 0],
        ['key' => 'field_mer_ts3_val',  'label' => 'Statystyka 3 — Wartość',  'name' => 'test_stat_3_value', 'type' => 'text',      'default_value' => '98%'],
        ['key' => 'field_mer_ts3_lbl',  'label' => 'Statystyka 3 — Etykieta', 'name' => 'test_stat_3_label', 'type' => 'textarea',  'rows' => 1, 'default_value' => 'Klientów poleca nas dalej'],
        ['key' => 'field_mer_ts3_acc',  'label' => 'Statystyka 3 — Zielony',  'name' => 'test_stat_3_accent','type' => 'true_false','ui' => 1, 'default_value' => 1],
        ['key' => 'field_mer_ts4_val',  'label' => 'Statystyka 4 — Wartość',  'name' => 'test_stat_4_value', 'type' => 'text',      'default_value' => '35+'],
        ['key' => 'field_mer_ts4_lbl',  'label' => 'Statystyka 4 — Etykieta', 'name' => 'test_stat_4_label', 'type' => 'textarea',  'rows' => 1, 'default_value' => 'Ekspertów w zespole'],
        ['key' => 'field_mer_ts4_acc',  'label' => 'Statystyka 4 — Zielony',  'name' => 'test_stat_4_accent','type' => 'true_false','ui' => 1, 'default_value' => 0],
    ],
    'location'   => $front_page_location,
    'menu_order' => 50,
    'position'   => 'normal',
]);

/* ==================================================================
   7. SKUP BIUR / BANER
================================================================== */
acf_add_local_field_group([
    'key'      => 'group_mer_buyout',
    'title'    => '🏢 Skup biur rachunkowych',
    'fields'   => [
        [
            'key'           => 'field_mer_buy_label',
            'label'         => 'Etykieta sekcji',
            'name'          => 'buyout_label',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Dla biur rachunkowych',
        ],
        [
            'key'           => 'field_mer_buy_title',
            'label'         => 'Tytuł',
            'name'          => 'buyout_title',
            'type'          => 'textarea',
            'rows'          => 2,
            'default_value' => "Kupimy Biuro\nRachunkowe",
        ],
        [
            'key'           => 'field_mer_buy_desc',
            'label'         => 'Opis',
            'name'          => 'buyout_desc',
            'type'          => 'textarea',
            'default_value' => 'Od lat współpracujemy z biurami rachunkowymi, które stoją przed decyzją o zmianie, sprzedaży lub dalszym rozwoju. Oferujemy wsparcie na każdym etapie — od wyceny po finalne ustalenia.',
        ],
        [
            'key'           => 'field_mer_buy_cta_text',
            'label'         => 'Przycisk — tekst',
            'name'          => 'buyout_cta_text',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Wyceń wartość biura',
        ],
        [
            'key'           => 'field_mer_buy_cta_url',
            'label'         => 'Przycisk — link',
            'name'          => 'buyout_cta_url',
            'type'          => 'text',
            'default_value' => '#kontakt',
        ],
        [
            'key'           => 'field_mer_buy_bg',
            'label'         => 'Zdjęcie tła banera',
            'name'          => 'buyout_bg_image',
            'type'          => 'image',
            'return_format' => 'array',
            'preview_size'  => 'medium',
        ],
        ['key' => 'field_mer_buy_tab_stats', 'label' => '◆ Statystyki', 'name' => 'buy_tab_stats', 'type' => 'tab'],
        ['key' => 'field_mer_bs1_icon',  'label' => 'Karta 1 — Ikona (Lucide)',    'name' => 'buyout_stat_1_icon',  'type' => 'text',      'default_value' => 'trending-up'],
        ['key' => 'field_mer_bs1_val',   'label' => 'Karta 1 — Wartość',           'name' => 'buyout_stat_1_value', 'type' => 'text',      'default_value' => '100%'],
        ['key' => 'field_mer_bs1_lbl',   'label' => 'Karta 1 — Etykieta',          'name' => 'buyout_stat_1_label', 'type' => 'textarea',  'rows' => 1, 'default_value' => 'Przejrzystych warunków'],
        ['key' => 'field_mer_bs1_acc',   'label' => 'Karta 1 — Zielone tło',       'name' => 'buyout_stat_1_accent','type' => 'true_false','ui' => 1, 'default_value' => 0],
        ['key' => 'field_mer_bs2_icon',  'label' => 'Karta 2 — Ikona (Lucide)',    'name' => 'buyout_stat_2_icon',  'type' => 'text',      'default_value' => 'handshake'],
        ['key' => 'field_mer_bs2_val',   'label' => 'Karta 2 — Wartość',           'name' => 'buyout_stat_2_value', 'type' => 'text',      'default_value' => '20+'],
        ['key' => 'field_mer_bs2_lbl',   'label' => 'Karta 2 — Etykieta',          'name' => 'buyout_stat_2_label', 'type' => 'textarea',  'rows' => 1, 'default_value' => 'Przejętych biur'],
        ['key' => 'field_mer_bs2_acc',   'label' => 'Karta 2 — Zielone tło',       'name' => 'buyout_stat_2_accent','type' => 'true_false','ui' => 1, 'default_value' => 0],
        ['key' => 'field_mer_bs3_icon',  'label' => 'Karta 3 — Ikona (Lucide)',    'name' => 'buyout_stat_3_icon',  'type' => 'text',      'default_value' => 'clock'],
        ['key' => 'field_mer_bs3_val',   'label' => 'Karta 3 — Wartość',           'name' => 'buyout_stat_3_value', 'type' => 'text',      'default_value' => '14 dni'],
        ['key' => 'field_mer_bs3_lbl',   'label' => 'Karta 3 — Etykieta',          'name' => 'buyout_stat_3_label', 'type' => 'textarea',  'rows' => 1, 'default_value' => 'Do wstępnej wyceny'],
        ['key' => 'field_mer_bs3_acc',   'label' => 'Karta 3 — Zielone tło',       'name' => 'buyout_stat_3_accent','type' => 'true_false','ui' => 1, 'default_value' => 0],
        ['key' => 'field_mer_bs4_icon',  'label' => 'Karta 4 — Ikona (Lucide)',    'name' => 'buyout_stat_4_icon',  'type' => 'text',      'default_value' => 'shield-check'],
        ['key' => 'field_mer_bs4_val',   'label' => 'Karta 4 — Wartość',           'name' => 'buyout_stat_4_value', 'type' => 'text',      'default_value' => 'NDA'],
        ['key' => 'field_mer_bs4_lbl',   'label' => 'Karta 4 — Etykieta',          'name' => 'buyout_stat_4_label', 'type' => 'textarea',  'rows' => 1, 'default_value' => 'Pełna poufność'],
        ['key' => 'field_mer_bs4_acc',   'label' => 'Karta 4 — Zielone tło',       'name' => 'buyout_stat_4_accent','type' => 'true_false','ui' => 1, 'default_value' => 1],

        // Tech logos
        ['key' => 'field_mer_buy_tab_tech', 'label' => '◆ Logotypy ERP', 'name' => 'buy_tab_tech', 'type' => 'tab'],
        [
            'key'           => 'field_mer_tech_label',
            'label'         => 'Etykieta sekcji logotypów ERP',
            'name'          => 'tech_label',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Obsługujemy systemy ERP i finansowe wiodących dostawców',
        ],
        ['key' => 'field_mer_tech_logo_1', 'label' => 'Logo systemu 1 (domyślnie Comarch ERP Optima)', 'name' => 'tech_logo_1', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'instructions' => 'PNG z przezroczystym tłem. Wyświetlane w oryginalnych kolorach.'],
        ['key' => 'field_mer_tech_logo_2', 'label' => 'Logo systemu 2 (domyślnie Enova 365)',         'name' => 'tech_logo_2', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_mer_tech_logo_3', 'label' => 'Logo systemu 3 (domyślnie Symfonia)',          'name' => 'tech_logo_3', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_mer_tech_logo_4', 'label' => 'Logo systemu 4 (domyślnie SAP)',               'name' => 'tech_logo_4', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_mer_tech_logo_5', 'label' => 'Logo systemu 5 (domyślnie Comarch ERP XL)',    'name' => 'tech_logo_5', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
    ],
    'location'   => $front_page_location,
    'menu_order' => 60,
    'position'   => 'normal',
]);

/* ==================================================================
   8. BLOG (sekcja na stronie głównej)
================================================================== */
acf_add_local_field_group([
    'key'      => 'group_mer_blog',
    'title'    => '📝 Blog (sekcja główna)',
    'fields'   => [
        [
            'key'           => 'field_mer_blog_label',
            'label'         => 'Etykieta sekcji',
            'name'          => 'blog_label',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Wiedza i aktualności',
        ],
        [
            'key'           => 'field_mer_blog_title',
            'label'         => 'Tytuł sekcji',
            'name'          => 'blog_title',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Blog',
        ],
        [
            'key'           => 'field_mer_blog_link_text',
            'label'         => 'Link — tekst',
            'name'          => 'blog_link_text',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Wszystkie wpisy',
        ],
        [
            'key'           => 'field_mer_blog_link_url',
            'label'         => 'Link — adres',
            'name'          => 'blog_link_url',
            'type'          => 'text',
            'default_value' => '/blog',
        ],
    ],
    'location'   => $front_page_location,
    'menu_order' => 70,
    'position'   => 'normal',
]);

// Custom field for reading time on posts
acf_add_local_field_group([
    'key'      => 'group_mer_post_meta',
    'title'    => 'Metadane artykułu',
    'fields'   => [
        [
            'key'           => 'field_mer_reading_time',
            'label'         => 'Czas czytania (np. "5 min")',
            'name'          => 'reading_time',
            'type'          => 'text',
            'default_value' => '5 min czytania',
        ],
    ],
    'location'   => [[['param' => 'post_type', 'operator' => '==', 'value' => 'post']]],
    'menu_order' => 0,
    'position'   => 'side',
]);

/* ==================================================================
   9. NEWSLETTER
================================================================== */
acf_add_local_field_group([
    'key'      => 'group_mer_newsletter',
    'title'    => '📧 Newsletter',
    'fields'   => [
        [
            'key'           => 'field_mer_nl_label',
            'label'         => 'Etykieta sekcji',
            'name'          => 'nl_label',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Newsletter',
        ],
        [
            'key'           => 'field_mer_nl_title',
            'label'         => 'Tytuł (lewa strona)',
            'name'          => 'nl_title',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Bądź na bieżąco ze zmianami podatkowymi',
        ],
        [
            'key'           => 'field_mer_nl_desc',
            'label'         => 'Opis (lewa strona)',
            'name'          => 'nl_desc',
            'type'          => 'textarea',
            'default_value' => 'Interesują Cię zmiany podatkowe? Szukasz pracy w obszarze księgowości lub kadr? Zapisz się i otrzymuj to, co ważne.',
        ],
        ['key' => 'field_mer_nl_benefit_1', 'label' => 'Korzyść 1', 'name' => 'nl_benefit_1', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Miesięczne podsumowania zmian podatkowych'],
        ['key' => 'field_mer_nl_benefit_2', 'label' => 'Korzyść 2', 'name' => 'nl_benefit_2', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Aktualne oferty pracy z obszaru finansów i kadr'],
        ['key' => 'field_mer_nl_benefit_3', 'label' => 'Korzyść 3', 'name' => 'nl_benefit_3', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Praktyczne wskazówki i komentarze ekspertów'],
        ['key' => 'field_mer_nl_benefit_4', 'label' => 'Korzyść 4', 'name' => 'nl_benefit_4', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Możliwość wypisania się w dowolnym momencie'],
        [
            'key'           => 'field_mer_nl_sub_count',
            'label'         => 'Liczba subskrybentów',
            'name'          => 'nl_subscriber_count',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => '2 400+ czytelników',
        ],
        [
            'key'           => 'field_mer_nl_sub_label',
            'label'         => 'Etykieta subskrybentów',
            'name'          => 'nl_subscriber_label',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'dołączyło do naszego newslettera',
        ],
        [
            'key'           => 'field_mer_nl_form_title',
            'label'         => 'Tytuł formularza',
            'name'          => 'nl_form_title',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Zapisz się bezpłatnie',
        ],
        [
            'key'           => 'field_mer_nl_form_sub',
            'label'         => 'Podtytuł formularza',
            'name'          => 'nl_form_sub',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Dołącz do ponad 2 400 specjalistów finansowych.',
        ],
        ['key' => 'field_mer_nl_topic_1', 'label' => 'Checkbox 1', 'name' => 'nl_topic_1', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Zmiany podatkowe i księgowe'],
        ['key' => 'field_mer_nl_topic_2', 'label' => 'Checkbox 2', 'name' => 'nl_topic_2', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Oferty pracy (kadry, płace, finanse)'],
        [
            'key'           => 'field_mer_nl_rodo',
            'label'         => 'Tekst RODO',
            'name'          => 'nl_rodo',
            'type'          => 'textarea',
            'default_value' => 'Administratorem danych jest Meritoros SA, Aleja Pokoju 62/8, Kraków. Dane przetwarzane są wyłącznie w celu wysyłki newslettera. Możesz wypisać się w każdej chwili.',
        ],
        [
            'key'           => 'field_mer_nl_privacy_url',
            'label'         => 'Link Polityki Prywatności',
            'name'          => 'nl_privacy_url',
            'type'          => 'text',
            'default_value' => '/polityka-prywatnosci',
        ],
        [
            'key'           => 'field_mer_nl_terms_url',
            'label'         => 'Link Regulaminu',
            'name'          => 'nl_terms_url',
            'type'          => 'text',
            'default_value' => '/regulamin-newslettera',
        ],
        [
            'key'          => 'field_mer_nl_cf7_id',
            'label'        => 'ID formularza CF7 (Newsletter)',
            'name'         => 'nl_cf7_id',
            'type'         => 'number',
            'instructions' => 'ID formularza Contact Form 7 zintegrowanego z Mailchimp (MC4WP: Mailchimp for WordPress).',
            'min'          => 0,
        ],
    ],
    'location'   => $front_page_location,
    'menu_order' => 80,
    'position'   => 'normal',
]);

/* ==================================================================
   10. STOPKA
================================================================== */
acf_add_local_field_group([
    'key'      => 'group_mer_footer',
    'title'    => '🔚 Stopka',
    'fields'   => [
        [
            'key'           => 'field_mer_footer_cta_label',
            'label'         => 'CTA — Etykieta',
            'name'          => 'footer_cta_label',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Zacznij teraz',
        ],
        [
            'key'           => 'field_mer_footer_cta_title',
            'label'         => 'CTA — Tytuł',
            'name'          => 'footer_cta_title',
            'type'          => 'textarea',
            'rows'          => 2,
            'default_value' => "Dołącz do grona naszych\nklientów i rozwijaj biznes",
        ],
        [
            'key'           => 'field_mer_footer_cta_accent',
            'label'         => 'CTA — Akcentowany fragment (zielony)',
            'name'          => 'footer_cta_accent',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'bez stresu',
        ],
        [
            'key'           => 'field_mer_footer_btn1_text',
            'label'         => 'Przycisk 1 — tekst',
            'name'          => 'footer_btn1_text',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Umów rozmowę',
        ],
        [
            'key'           => 'field_mer_footer_btn1_url',
            'label'         => 'Przycisk 1 — link',
            'name'          => 'footer_btn1_url',
            'type'          => 'text',
            'default_value' => '#kontakt',
        ],
        [
            'key'           => 'field_mer_footer_btn2_text',
            'label'         => 'Przycisk 2 — tekst',
            'name'          => 'footer_btn2_text',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Poznaj ofertę',
        ],
        [
            'key'           => 'field_mer_footer_btn2_url',
            'label'         => 'Przycisk 2 — link',
            'name'          => 'footer_btn2_url',
            'type'          => 'text',
            'default_value' => '#uslugi',
        ],
        [
            'key'           => 'field_mer_footer_tagline',
            'label'         => 'Tagline (pod logo)',
            'name'          => 'footer_tagline',
            'type'          => 'textarea',
            'rows'          => 2,
            'default_value' => 'Profesjonalne biuro rachunkowe i BPO dla firm z ambicjami.',
        ],
        ['key' => 'field_mer_footer_tab_social', 'label' => '◆ Social media', 'name' => 'footer_tab_social', 'type' => 'tab'],
        ['key' => 'field_mer_social_1_icon', 'label' => 'Social 1 — Ikona (Lucide)', 'name' => 'footer_social_1_icon', 'type' => 'text', 'default_value' => 'facebook',  'instructions' => 'np. facebook, instagram, linkedin, youtube, twitter'],
        ['key' => 'field_mer_social_1_url',  'label' => 'Social 1 — Link',           'name' => 'footer_social_1_url',  'type' => 'text', 'default_value' => '#'],
        ['key' => 'field_mer_social_2_icon', 'label' => 'Social 2 — Ikona (Lucide)', 'name' => 'footer_social_2_icon', 'type' => 'text', 'default_value' => 'instagram'],
        ['key' => 'field_mer_social_2_url',  'label' => 'Social 2 — Link',           'name' => 'footer_social_2_url',  'type' => 'text', 'default_value' => '#'],
        ['key' => 'field_mer_social_3_icon', 'label' => 'Social 3 — Ikona (Lucide)', 'name' => 'footer_social_3_icon', 'type' => 'text', 'default_value' => 'linkedin'],
        ['key' => 'field_mer_social_3_url',  'label' => 'Social 3 — Link',           'name' => 'footer_social_3_url',  'type' => 'text', 'default_value' => '#'],
        ['key' => 'field_mer_social_4_icon', 'label' => 'Social 4 — Ikona (Lucide)', 'name' => 'footer_social_4_icon', 'type' => 'text', 'default_value' => 'youtube'],
        ['key' => 'field_mer_social_4_url',  'label' => 'Social 4 — Link',           'name' => 'footer_social_4_url',  'type' => 'text', 'default_value' => '#'],
        ['key' => 'field_mer_footer_tab_contact', 'label' => '◆ Kontakt', 'name' => 'footer_tab_contact', 'type' => 'tab'],
        [
            'key'           => 'field_mer_footer_address',
            'label'         => 'Adres',
            'name'          => 'footer_address',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Aleja Pokoju 62/8, Kraków',
        ],
        [
            'key'           => 'field_mer_footer_phone',
            'label'         => 'Telefon',
            'name'          => 'footer_phone',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => '+48 000 000 000',
        ],
        [
            'key'           => 'field_mer_footer_email',
            'label'         => 'E-mail',
            'name'          => 'footer_email',
            'type'          => 'email',
            'default_value' => 'biuro@meritoros.pl',
        ],
        [
            'key'           => 'field_mer_footer_copyright',
            'label'         => 'Copyright',
            'name'          => 'footer_copyright',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => '© 2026 Meritoros SA. Wszelkie prawa zastrzeżone.',
        ],
        [
            'key'           => 'field_mer_footer_credit_text',
            'label'         => 'Projekt i realizacja — tekst',
            'name'          => 'footer_credit_text',
            'type'          => 'text',
            'default_value' => 'Web-Canvas',
        ],
        [
            'key'           => 'field_mer_footer_credit_url',
            'label'         => 'Projekt i realizacja — link',
            'name'          => 'footer_credit_url',
            'type'          => 'text',
            'default_value' => 'https://web-canvas.pl',
        ],
    ],
    'location'   => $front_page_location,
    'menu_order' => 90,
    'position'   => 'normal',
]);

/* ==================================================================
   STRONA BPO
================================================================== */
$bpo_page_location = [
    [['param' => 'page_slug',     'operator' => '==', 'value' => 'bpo']],
    [['param' => 'page_template', 'operator' => '==', 'value' => 'page-bpo.php']],
];

acf_add_local_field_group([
    'key'    => 'group_mer_bpo',
    'title'  => '💼 Strona BPO',
    'fields' => [

        // ── TAB: Hero ─────────────────────────────────────────────
        ['key' => 'field_bpo_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_bpo_hero_title_normal', 'label' => 'Tytuł — czarna część',  'name' => 'bpo_hero_title_normal', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Rozwiązania BPO'],
        ['key' => 'field_bpo_hero_title_green',  'label' => 'Tytuł — zielona część', 'name' => 'bpo_hero_title_green',  'type' => 'textarea', 'rows' => 1, 'default_value' => 'dla większych organizacji'],
        ['key' => 'field_bpo_hero_subtitle',     'label' => 'Podtytuł',              'name' => 'bpo_hero_subtitle',     'type' => 'textarea', 'rows' => 3, 'new_lines' => 'br', 'default_value' => 'Zapewniamy kompleksową obsługę kadrowo-płacową firm o różnej skali działalności.'],
        ['key' => 'field_bpo_hero_btn1_text',    'label' => 'Przycisk 1 — tekst',    'name' => 'bpo_hero_btn1_text',    'type' => 'textarea', 'rows' => 1, 'default_value' => 'Poznaj ofertę'],
        ['key' => 'field_bpo_hero_btn1_url',     'label' => 'Przycisk 1 — link',     'name' => 'bpo_hero_btn1_url',     'type' => 'text',     'default_value' => '#'],
        ['key' => 'field_bpo_hero_btn2_text',    'label' => 'Przycisk 2 — tekst',    'name' => 'bpo_hero_btn2_text',    'type' => 'textarea', 'rows' => 1, 'default_value' => 'Porozmawiajmy'],
        ['key' => 'field_bpo_hero_btn2_url',     'label' => 'Przycisk 2 — link',     'name' => 'bpo_hero_btn2_url',     'type' => 'text',     'default_value' => '/kontakt/'],
        ['key' => 'field_bpo_hero_logos_title',  'label' => 'Tekst nad logotypami',  'name' => 'bpo_hero_logos_title',  'type' => 'textarea', 'rows' => 1, 'default_value' => 'Zaufało nam ponad 1200 klientów'],
        ['key' => 'field_bpo_hero_logo_1',       'label' => 'Logo klienta 1',        'name' => 'bpo_hero_logo_1',       'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_bpo_hero_logo_2',       'label' => 'Logo klienta 2',        'name' => 'bpo_hero_logo_2',       'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_bpo_hero_logo_3',       'label' => 'Logo klienta 3',        'name' => 'bpo_hero_logo_3',       'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_bpo_hero_logo_4',       'label' => 'Logo klienta 4',        'name' => 'bpo_hero_logo_4',       'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail'],

        // ── TAB: Info & Nagrody ───────────────────────────────────
        ['key' => 'field_bpo_tab_info', 'label' => 'Info & Nagrody', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_bpo_info_title',    'label' => 'Tytuł sekcji',          'name' => 'bpo_info_title',    'type' => 'textarea', 'rows' => 2, 'default_value' => "Stabilne procesy. Rzetelne\ndane. Spokój zarządu."],
        ['key' => 'field_bpo_info_text',     'label' => 'Opis',                  'name' => 'bpo_info_text',     'type' => 'textarea', 'rows' => 4],
        ['key' => 'field_bpo_info_items',    'label' => 'Lista punktów (1 = 1 linia)', 'name' => 'bpo_info_items', 'type' => 'textarea', 'rows' => 4, 'default_value' => "raportowanie zarządcze i sprawozdawcze dopasowane do potrzeb organizacji\ncyfrowy obieg dokumentów i uporządkowane procesy\npełna zastępowalność i ciągłość obsługi oraz gotowość do skalowania"],
        ['key' => 'field_bpo_awards_title',  'label' => 'Nagrody — tytuł',       'name' => 'bpo_awards_title',  'type' => 'textarea', 'rows' => 1, 'default_value' => 'Nagrody i wyróżnienia'],
        ['key' => 'field_bpo_awards_text',   'label' => 'Nagrody — opis',        'name' => 'bpo_awards_text',   'type' => 'textarea', 'rows' => 2],
        ['key' => 'field_bpo_awards_logo1',  'label' => 'Nagrody — Logo 1',      'name' => 'bpo_awards_logo1',  'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_bpo_awards_logo2',  'label' => 'Nagrody — Logo 2',      'name' => 'bpo_awards_logo2',  'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_bpo_stat1_image',   'label' => 'Karta 1 — Odznaka ISO', 'name' => 'bpo_stat1_image',   'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail', 'instructions' => 'Logo ISO 27001'],
        ['key' => 'field_bpo_stat1_text',    'label' => 'Karta 1 — Tekst',       'name' => 'bpo_stat1_text',    'type' => 'textarea', 'rows' => 1, 'default_value' => "Bezpieczeństwo\ni compliance"],
        ['key' => 'field_bpo_stat2_image',   'label' => 'Karta 2 — Odznaka ISO', 'name' => 'bpo_stat2_image',   'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail', 'instructions' => 'Logo ISO 9001'],
        ['key' => 'field_bpo_stat2_text',    'label' => 'Karta 2 — Tekst',       'name' => 'bpo_stat2_text',    'type' => 'textarea', 'rows' => 1, 'default_value' => "Jakość potwierdzona\nstandardami"],
        ['key' => 'field_bpo_stat3_text',    'label' => 'Karta 3 — Tekst',       'name' => 'bpo_stat3_text',    'type' => 'textarea', 'rows' => 1, 'default_value' => "Ponad 170\nexpertów"],

        // ── TAB: Obszary współpracy ───────────────────────────────
        ['key' => 'field_bpo_tab_obszary', 'label' => 'Obszary współpracy', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_bpo_areas_title',   'label' => 'Tytuł sekcji',   'name' => 'bpo_areas_title',   'type' => 'textarea', 'rows' => 1, 'default_value' => 'Obszar współpracy'],
        ['key' => 'field_bpo_area1_title',   'label' => 'Karta 1 — Tytuł',  'name' => 'bpo_area1_title',  'type' => 'textarea', 'rows' => 1, 'default_value' => 'Rozwiązania kadrowe'],
        ['key' => 'field_bpo_area1_desc',    'label' => 'Karta 1 — Opis',   'name' => 'bpo_area1_desc',   'type' => 'textarea', 'rows' => 2, 'default_value' => 'Kompleksowa obsługa kadrowo-płacowa – od umów i list płac po rozliczenia z ZUS i US, z pełną zastępowalnością zespołu.'],
        ['key' => 'field_bpo_area1_image',   'label' => 'Karta 1 — Zdjęcie','name' => 'bpo_area1_image',  'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],
        ['key' => 'field_bpo_area1_url',     'label' => 'Karta 1 — Link',   'name' => 'bpo_area1_url',    'type' => 'url'],
        ['key' => 'field_bpo_area2_title',   'label' => 'Karta 2 — Tytuł',  'name' => 'bpo_area2_title',  'type' => 'textarea', 'rows' => 1, 'default_value' => 'Rozwiązania księgowe'],
        ['key' => 'field_bpo_area2_desc',    'label' => 'Karta 2 — Opis',   'name' => 'bpo_area2_desc',   'type' => 'textarea', 'rows' => 2, 'default_value' => 'Pełna księgowość, raportowanie zarządcze i sprawozdawcze – terminowo i zgodnie ze standardami, bez zakłóceń operacyjnych.'],
        ['key' => 'field_bpo_area2_image',   'label' => 'Karta 2 — Zdjęcie','name' => 'bpo_area2_image',  'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],
        ['key' => 'field_bpo_area2_url',     'label' => 'Karta 2 — Link',   'name' => 'bpo_area2_url',    'type' => 'url'],
        ['key' => 'field_bpo_area3_title',   'label' => 'Karta 3 — Tytuł',  'name' => 'bpo_area3_title',  'type' => 'textarea', 'rows' => 1, 'default_value' => 'Transformacja cyfrowa'],
        ['key' => 'field_bpo_area3_desc',    'label' => 'Karta 3 — Opis',   'name' => 'bpo_area3_desc',   'type' => 'textarea', 'rows' => 2, 'default_value' => 'Wdrożenie RPA, e-teczek i elektronicznego obiegu dokumentów – automatyzujemy procesy, żeby organizacja działała sprawniej.'],
        ['key' => 'field_bpo_area3_image',   'label' => 'Karta 3 — Zdjęcie','name' => 'bpo_area3_image',  'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],
        ['key' => 'field_bpo_area3_url',     'label' => 'Karta 3 — Link',   'name' => 'bpo_area3_url',    'type' => 'url'],

        // ── TAB: BPO Kadrowe ──────────────────────────────────────
        ['key' => 'field_bpo_tab_kad', 'label' => 'BPO Kadrowe', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_bpo_kad_title',     'label' => 'Tytuł (zielony fragment)', 'name' => 'bpo_kad_title_suffix', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Rozwiązania Kadrowe'],
        ['key' => 'field_bpo_kad_text',      'label' => 'Opis',                    'name' => 'bpo_kad_text',         'type' => 'textarea', 'rows' => 4],
        ['key' => 'field_bpo_kad_items',     'label' => 'Usługi (1 linia = 1 kafelek)', 'name' => 'bpo_kad_items',  'type' => 'textarea', 'rows' => 10],
        ['key' => 'field_bpo_kad_btn1_text', 'label' => 'Przycisk 1 — tekst',      'name' => 'bpo_kad_btn1_text',    'type' => 'textarea', 'rows' => 1, 'default_value' => 'Dlaczego BPO z nami'],
        ['key' => 'field_bpo_kad_btn1_url',  'label' => 'Przycisk 1 — link',       'name' => 'bpo_kad_btn1_url',     'type' => 'text',     'default_value' => '#'],
        ['key' => 'field_bpo_kad_btn2_text', 'label' => 'Przycisk 2 — tekst',      'name' => 'bpo_kad_btn2_text',    'type' => 'textarea', 'rows' => 1, 'default_value' => 'Sprawdź rozwiązania kadrowe'],
        ['key' => 'field_bpo_kad_btn2_url',  'label' => 'Przycisk 2 — link',       'name' => 'bpo_kad_btn2_url',     'type' => 'text',     'default_value' => '/kontakt/'],

        // ── TAB: BPO Księgowe ─────────────────────────────────────
        ['key' => 'field_bpo_tab_ks', 'label' => 'BPO Księgowe', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_bpo_ks_title',    'label' => 'Tytuł (zielony fragment)', 'name' => 'bpo_ks_title_suffix', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Rozwiązania księgowe'],
        ['key' => 'field_bpo_ks_text',     'label' => 'Opis',                    'name' => 'bpo_ks_text',         'type' => 'textarea', 'rows' => 4],
        ['key' => 'field_bpo_ks_items',    'label' => 'Usługi (1 linia = 1 kafelek)', 'name' => 'bpo_ks_items',  'type' => 'textarea', 'rows' => 10],
        ['key' => 'field_bpo_ks_btn_text', 'label' => 'Przycisk — tekst',        'name' => 'bpo_ks_btn_text',     'type' => 'textarea', 'rows' => 1, 'default_value' => 'Dlaczego BPO z nami'],
        ['key' => 'field_bpo_ks_btn_url',  'label' => 'Przycisk — link',         'name' => 'bpo_ks_btn_url',      'type' => 'text',     'default_value' => '#'],

        // ── TAB: CTA baner ────────────────────────────────────────
        ['key' => 'field_bpo_tab_cta', 'label' => 'CTA Baner', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_bpo_cta_title',    'label' => 'Tytuł banera',   'name' => 'bpo_cta_title',    'type' => 'textarea', 'rows' => 2, 'default_value' => 'Porozmawiajmy o obsłudze księgowej dla Twojej firmy'],
        ['key' => 'field_bpo_cta_subtitle', 'label' => 'Podtytuł',       'name' => 'bpo_cta_subtitle', 'type' => 'textarea', 'rows' => 1],
        ['key' => 'field_bpo_cta_btn_text', 'label' => 'Przycisk — tekst','name' => 'bpo_cta_btn_text', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Umów się na rozmowę'],
        ['key' => 'field_bpo_cta_btn_url',  'label' => 'Przycisk — link', 'name' => 'bpo_cta_btn_url',  'type' => 'text',     'default_value' => '/kontakt/'],

        // ── TAB: Transformacja cyfrowa ────────────────────────────
        ['key' => 'field_bpo_tab_td', 'label' => 'Transformacja cyfrowa', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_bpo_td_title', 'label' => 'Tytuł',                          'name' => 'bpo_td_title', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Transformacja Cyfrowa'],
        ['key' => 'field_bpo_td_text',  'label' => 'Opis',                           'name' => 'bpo_td_text',  'type' => 'textarea', 'rows' => 4],
        ['key' => 'field_bpo_td_bg',    'label' => 'Zdjęcie tła (ciemne)',           'name' => 'bpo_td_bg',    'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],
        ['key' => 'field_bpo_td_items', 'label' => 'Lista punktów (1 linia = 1 pkt)','name' => 'bpo_td_items', 'type' => 'textarea', 'rows' => 6, 'default_value' => "Robotyzacja RPA\nE-teczki\nOptymalizacja procesów\nElektroniczny obieg dokumentów\nAutomatyzacja raportowania"],

        // ── TAB: Dlaczego BPO ─────────────────────────────────────
        ['key' => 'field_bpo_tab_dlaczego', 'label' => 'Dlaczego BPO', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_bpo_dlaczego_title', 'label' => 'Tytuł sekcji', 'name' => 'bpo_dlaczego_title', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Dlaczego BPO z Meritoros?'],
        [
            'key' => 'field_bpo_d1', 'label' => 'Karta 1', 'name' => 'bpo_d1', 'type' => 'group',
            'sub_fields' => [
                ['key' => 'field_bpo_d1_icon',  'label' => 'Ikona (Lucide)', 'name' => 'icon',  'type' => 'text',     'default_value' => 'trending-up'],
                ['key' => 'field_bpo_d1_title', 'label' => 'Tytuł',          'name' => 'title', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Efektywność kosztowa'],
                ['key' => 'field_bpo_d1_text',  'label' => 'Opis',           'name' => 'text',  'type' => 'textarea', 'rows' => 3],
            ],
        ],
        [
            'key' => 'field_bpo_d2', 'label' => 'Karta 2', 'name' => 'bpo_d2', 'type' => 'group',
            'sub_fields' => [
                ['key' => 'field_bpo_d2_icon',  'label' => 'Ikona (Lucide)', 'name' => 'icon',  'type' => 'text',     'default_value' => 'clock'],
                ['key' => 'field_bpo_d2_title', 'label' => 'Tytuł',          'name' => 'title', 'type' => 'textarea', 'rows' => 1, 'default_value' => "Uwolnienie czasu\ni usprawnienie procesów"],
                ['key' => 'field_bpo_d2_text',  'label' => 'Opis',           'name' => 'text',  'type' => 'textarea', 'rows' => 3],
            ],
        ],
        [
            'key' => 'field_bpo_d3', 'label' => 'Karta 3', 'name' => 'bpo_d3', 'type' => 'group',
            'sub_fields' => [
                ['key' => 'field_bpo_d3_icon',  'label' => 'Ikona (Lucide)', 'name' => 'icon',  'type' => 'text',     'default_value' => 'expand'],
                ['key' => 'field_bpo_d3_title', 'label' => 'Tytuł',          'name' => 'title', 'type' => 'textarea', 'rows' => 1, 'default_value' => "Elastyczność i skalowanie\noperacji"],
                ['key' => 'field_bpo_d3_text',  'label' => 'Opis',           'name' => 'text',  'type' => 'textarea', 'rows' => 3],
            ],
        ],

        // ── TAB: Model współpracy ─────────────────────────────────
        ['key' => 'field_bpo_tab_model', 'label' => 'Model współpracy', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_bpo_model_title',    'label' => 'Tytuł sekcji', 'name' => 'bpo_model_title',    'type' => 'textarea', 'rows' => 1, 'default_value' => 'Model współpracy'],
        ['key' => 'field_bpo_model_subtitle', 'label' => 'Opis',         'name' => 'bpo_model_subtitle', 'type' => 'textarea', 'rows' => 2],
        [
            'key' => 'field_bpo_model1', 'label' => 'Karta 1 (biała)', 'name' => 'bpo_model1', 'type' => 'group',
            'sub_fields' => [
                ['key' => 'field_bpo_m1_icon',  'label' => 'Ikona (Lucide)', 'name' => 'icon',  'type' => 'text',     'default_value' => 'network'],
                ['key' => 'field_bpo_m1_title', 'label' => 'Tytuł',          'name' => 'title', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Kompleksowa obsługa'],
                ['key' => 'field_bpo_m1_text',  'label' => 'Opis (tył karty)','name' => 'text',  'type' => 'textarea', 'rows' => 3],
            ],
        ],
        [
            'key' => 'field_bpo_model2', 'label' => 'Karta 2 (ze zdjęciem)', 'name' => 'bpo_model2', 'type' => 'group',
            'sub_fields' => [
                ['key' => 'field_bpo_m2_image', 'label' => 'Zdjęcie tła', 'name' => 'image', 'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],
                ['key' => 'field_bpo_m2_title', 'label' => 'Tytuł',       'name' => 'title', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Outsourcing wybranych\nprocesów"],
                ['key' => 'field_bpo_m2_text',  'label' => 'Opis (tył)',   'name' => 'text',  'type' => 'textarea', 'rows' => 3],
            ],
        ],

        // ── TAB: Jak wygląda współpraca ───────────────────────────
        ['key' => 'field_bpo_tab_wsp', 'label' => 'Jak wygląda współpraca', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_bpo_wsp_title',    'label' => 'Tytuł sekcji',    'name' => 'bpo_wsp_title',    'type' => 'textarea', 'rows' => 1, 'default_value' => 'Jak wygląda bieżąca współpraca'],
        ['key' => 'field_bpo_wsp_btn_text', 'label' => 'Przycisk — tekst','name' => 'bpo_wsp_btn_text', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Poznaj więcej historii'],
        ['key' => 'field_bpo_wsp_btn_url',  'label' => 'Przycisk — link', 'name' => 'bpo_wsp_btn_url',  'type' => 'text', 'default_value' => '#'],
        [
            'key' => 'field_bpo_wsp_step_1', 'label' => 'Krok 01', 'name' => 'bpo_wsp_step_1', 'type' => 'group',
            'sub_fields' => [
                ['key' => 'field_bpo_wsp1_title', 'label' => 'Tytuł', 'name' => 'title', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Indywidualna organizacja pracy'],
                ['key' => 'field_bpo_wsp1_lead',  'label' => 'Intro', 'name' => 'lead',  'type' => 'textarea', 'rows' => 1, 'default_value' => 'W zależności od potrzeb możemy pracować:'],
                ['key' => 'field_bpo_wsp1_items', 'label' => 'Punkty (1 linia = 1 pkt)', 'name' => 'items', 'type' => 'textarea', 'rows' => 3, 'default_value' => "na bieżąco – obsługując codzienne procesy\nw cyklach tygodniowych\nw innych ustalonych odstępach czasu"],
            ],
        ],
        [
            'key' => 'field_bpo_wsp_step_2', 'label' => 'Krok 02', 'name' => 'bpo_wsp_step_2', 'type' => 'group',
            'sub_fields' => [
                ['key' => 'field_bpo_wsp2_title', 'label' => 'Tytuł', 'name' => 'title', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Elastyczne zamknięcie miesiąca'],
                ['key' => 'field_bpo_wsp2_lead',  'label' => 'Intro', 'name' => 'lead',  'type' => 'textarea', 'rows' => 2],
                ['key' => 'field_bpo_wsp2_items', 'label' => 'Punkty (1 linia = 1 pkt)', 'name' => 'items', 'type' => 'textarea', 'rows' => 3, 'default_value' => "część firm potrzebuje raportów do 20. dnia miesiąca\ninne wymagają wyników już w 3. lub 4. dniu roboczym"],
            ],
        ],
        [
            'key' => 'field_bpo_wsp_step_3', 'label' => 'Krok 03', 'name' => 'bpo_wsp_step_3', 'type' => 'group',
            'sub_fields' => [
                ['key' => 'field_bpo_wsp3_title', 'label' => 'Tytuł', 'name' => 'title', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Zakres i częstotliwość raportowania ustalamy indywidualnie.'],
                ['key' => 'field_bpo_wsp3_lead',  'label' => 'Intro', 'name' => 'lead',  'type' => 'textarea', 'rows' => 1, 'default_value' => 'W standardzie klient otrzymuje:'],
                ['key' => 'field_bpo_wsp3_items', 'label' => 'Punkty (1 linia = 1 pkt)', 'name' => 'items', 'type' => 'textarea', 'rows' => 3, 'default_value' => "rachunek zysków i strat\nbilans\nzestawienie należności i zobowiązań"],
            ],
        ],

        // ── TAB: Historie klientów ────────────────────────────────
        ['key' => 'field_bpo_tab_hist', 'label' => 'Historie klientów', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_bpo_hist_title',    'label' => 'Tytuł sekcji',   'name' => 'bpo_hist_title',    'type' => 'textarea', 'rows' => 1, 'default_value' => 'Historie naszych klientów'],
        ['key' => 'field_bpo_hist_btn_text', 'label' => 'Przycisk — tekst','name' => 'bpo_hist_btn_text', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Poznaj więcej historii'],
        ['key' => 'field_bpo_hist_btn_url',  'label' => 'Przycisk — link', 'name' => 'bpo_hist_btn_url',  'type' => 'text', 'default_value' => '#'],
        [
            'key' => 'field_bpo_hist_1', 'label' => 'Slajd 1', 'name' => 'bpo_hist_1', 'type' => 'group',
            'sub_fields' => [
                ['key' => 'field_bpo_h1_logo',       'label' => 'Logo firmy',                        'name' => 'logo',       'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail'],
                ['key' => 'field_bpo_h1_industries', 'label' => 'Branże (1 linia = 1 tag)',          'name' => 'industries', 'type' => 'textarea', 'rows' => 2],
                ['key' => 'field_bpo_h1_scope',      'label' => 'Zakres współpracy',                 'name' => 'scope',      'type' => 'textarea', 'rows' => 2],
                ['key' => 'field_bpo_h1_text',       'label' => 'Opis sytuacji',                     'name' => 'text',       'type' => 'textarea', 'rows' => 3],
                ['key' => 'field_bpo_h1_video_file', 'label' => 'Wideo — własny plik (mp4/webm)',     'name' => 'video_file', 'type' => 'file',     'return_format' => 'array', 'mime_types' => 'mp4,webm,mov', 'instructions' => 'Wgraj plik wideo. Ma pierwszeństwo przed linkiem YouTube/Vimeo.'],
                ['key' => 'field_bpo_h1_video_url',  'label' => 'Wideo — link YouTube / Vimeo',     'name' => 'video_url',  'type' => 'text',     'instructions' => 'Używane gdy nie wgrano pliku. Np. https://www.youtube.com/watch?v=...', 'placeholder' => 'https://www.youtube.com/watch?v='],
                ['key' => 'field_bpo_h1_image',      'label' => 'Miniatura (opcjonalna)',            'name' => 'image',      'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium', 'instructions' => 'Jeśli puste — dla YouTube pobierany jest automatyczny podgląd z URL wideo.'],
                ['key' => 'field_bpo_h1_url',        'label' => 'Link do historii (przycisk)',       'name' => 'url',        'type' => 'text'],
            ],
        ],
        [
            'key' => 'field_bpo_hist_2', 'label' => 'Slajd 2', 'name' => 'bpo_hist_2', 'type' => 'group',
            'sub_fields' => [
                ['key' => 'field_bpo_h2_logo',       'label' => 'Logo firmy',                        'name' => 'logo',       'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail'],
                ['key' => 'field_bpo_h2_industries', 'label' => 'Branże (1 linia = 1 tag)',          'name' => 'industries', 'type' => 'textarea', 'rows' => 2],
                ['key' => 'field_bpo_h2_scope',      'label' => 'Zakres współpracy',                 'name' => 'scope',      'type' => 'textarea', 'rows' => 2],
                ['key' => 'field_bpo_h2_text',       'label' => 'Opis sytuacji',                     'name' => 'text',       'type' => 'textarea', 'rows' => 3],
                ['key' => 'field_bpo_h2_video_file', 'label' => 'Wideo — własny plik (mp4/webm)',     'name' => 'video_file', 'type' => 'file',     'return_format' => 'array', 'mime_types' => 'mp4,webm,mov', 'instructions' => 'Wgraj plik wideo. Ma pierwszeństwo przed linkiem YouTube/Vimeo.'],
                ['key' => 'field_bpo_h2_video_url',  'label' => 'Wideo — link YouTube / Vimeo',     'name' => 'video_url',  'type' => 'text',     'instructions' => 'Używane gdy nie wgrano pliku. Np. https://www.youtube.com/watch?v=...', 'placeholder' => 'https://www.youtube.com/watch?v='],
                ['key' => 'field_bpo_h2_image',      'label' => 'Miniatura (opcjonalna)',            'name' => 'image',      'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium', 'instructions' => 'Jeśli puste — dla YouTube pobierany jest automatyczny podgląd z URL wideo.'],
                ['key' => 'field_bpo_h2_url',        'label' => 'Link do historii (przycisk)',       'name' => 'url',        'type' => 'text'],
            ],
        ],

        // ── TAB: Systemy ERP ──────────────────────────────────────
        ['key' => 'field_bpo_tab_sys', 'label' => 'Systemy ERP', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_bpo_sys_title',  'label' => 'Tytuł sekcji', 'name' => 'bpo_sys_title',  'type' => 'textarea', 'rows' => 2, 'default_value' => "Obsługa wielu systemów\nksięgowych"],
        ['key' => 'field_bpo_sys_text',   'label' => 'Opis',          'name' => 'bpo_sys_text',   'type' => 'textarea', 'rows' => 2],
        ['key' => 'field_bpo_sys_logo1',  'label' => 'Logo systemu 1','name' => 'bpo_sys_logo1',  'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_bpo_sys_logo2',  'label' => 'Logo systemu 2','name' => 'bpo_sys_logo2',  'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_bpo_sys_logo3',  'label' => 'Logo systemu 3','name' => 'bpo_sys_logo3',  'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_bpo_sys_logo4',  'label' => 'Logo systemu 4','name' => 'bpo_sys_logo4',  'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail'],
    ],
    'location'   => $bpo_page_location,
    'menu_order' => 0,
    'position'   => 'normal',
]);

/* ==================================================================
   STRONA O NAS
================================================================== */
$onas_page_location = [
    [['param' => 'page_slug',     'operator' => '==', 'value' => 'o-nas']],
    [['param' => 'page_template', 'operator' => '==', 'value' => 'page-o-nas.php']],
];

acf_add_local_field_group([
    'key'    => 'group_mer_onas',
    'title'  => '🏢 Strona O nas',
    'fields' => [

        // ── TAB: Hero ─────────────────────────────────────────────
        ['key' => 'field_onas_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_onas_hero_bg',       'label' => 'Zdjęcie tła (Hero)',    'name' => 'onas_hero_bg',       'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],
        ['key' => 'field_onas_hero_title',     'label' => 'Nagłówek H1',          'name' => 'onas_hero_title',     'type' => 'textarea', 'rows' => 3, 'default_value' => "Poznaj nasze biuro rachunkowe\ni wartości które stoją za naszą\ncodzienną pracą"],
        ['key' => 'field_onas_hero_sub',       'label' => 'Podtytuł',             'name' => 'onas_hero_sub',       'type' => 'textarea', 'rows' => 2, 'new_lines' => 'br', 'default_value' => 'Pracujemy tak, by być dumni z jakości informacji dostarczanych naszym klientom.'],
        ['key' => 'field_onas_hero_btn1_text', 'label' => 'Przycisk 1 — tekst',  'name' => 'onas_hero_btn1_text', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Poznaj ofertę'],
        ['key' => 'field_onas_hero_btn1_url',  'label' => 'Przycisk 1 — link',   'name' => 'onas_hero_btn1_url',  'type' => 'text',     'default_value' => '#'],
        ['key' => 'field_onas_hero_btn2_text', 'label' => 'Przycisk 2 — tekst',  'name' => 'onas_hero_btn2_text', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Porozmawiamy'],
        ['key' => 'field_onas_hero_btn2_url',  'label' => 'Przycisk 2 — link',   'name' => 'onas_hero_btn2_url',  'type' => 'text',     'default_value' => '/kontakt/'],

        // ── TAB: Kim jesteśmy ─────────────────────────────────────
        ['key' => 'field_onas_tab_kim', 'label' => 'Kim jesteśmy', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_onas_kim_title', 'label' => 'Tytuł sekcji', 'name' => 'onas_kim_title', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Kim jesteśmy'],
        ['key' => 'field_onas_kim_text',  'label' => 'Tekst opisu',  'name' => 'onas_kim_text',  'type' => 'textarea', 'rows' => 4, 'default_value' => 'Od ponad 20 lat wspieramy firmy w prowadzeniu księgowości, kadr i procesów finansowych. Pracujemy w modelu zespołowym i procesowym, z jasno określoną odpowiedzialnością, standaryzacją działań i nadzorem nad jakością.'],

        ['key' => 'field_onas_tab_stats', 'label' => '◆ Statystyki / ikony', 'name' => '', 'type' => 'tab'],
        [
            'key' => 'field_onas_stat_1', 'label' => 'Ikona 1', 'name' => 'onas_stat_1', 'type' => 'group',
            'sub_fields' => [
                ['key' => 'field_onas_s1_icon', 'label' => 'Ikona (Lucide)', 'name' => 'icon', 'type' => 'text', 'default_value' => 'monitor'],
                ['key' => 'field_onas_s1_text', 'label' => 'Tekst',          'name' => 'text', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Wewnętrzny\ndział IT i RPA"],
            ],
        ],
        [
            'key' => 'field_onas_stat_2', 'label' => 'Ikona 2', 'name' => 'onas_stat_2', 'type' => 'group',
            'sub_fields' => [
                ['key' => 'field_onas_s2_icon', 'label' => 'Ikona (Lucide)', 'name' => 'icon', 'type' => 'text', 'default_value' => 'globe'],
                ['key' => 'field_onas_s2_text', 'label' => 'Tekst',          'name' => 'text', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Certyfikacja ISO\n9001 i ISO/IEC 27001"],
            ],
        ],
        [
            'key' => 'field_onas_stat_3', 'label' => 'Ikona 3', 'name' => 'onas_stat_3', 'type' => 'group',
            'sub_fields' => [
                ['key' => 'field_onas_s3_icon', 'label' => 'Ikona (Lucide)', 'name' => 'icon', 'type' => 'text', 'default_value' => 'database'],
                ['key' => 'field_onas_s3_text', 'label' => 'Tekst',          'name' => 'text', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Ubezpieczenie\ndo 3 mln PLN"],
            ],
        ],
        [
            'key' => 'field_onas_stat_4', 'label' => 'Ikona 4', 'name' => 'onas_stat_4', 'type' => 'group',
            'sub_fields' => [
                ['key' => 'field_onas_s4_icon', 'label' => 'Ikona (Lucide)', 'name' => 'icon', 'type' => 'text', 'default_value' => 'user-check'],
                ['key' => 'field_onas_s4_text', 'label' => 'Tekst',          'name' => 'text', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Ponad 170\nexpertów na pokładzie"],
            ],
        ],
        [
            'key' => 'field_onas_stat_5', 'label' => 'Ikona 5', 'name' => 'onas_stat_5', 'type' => 'group',
            'sub_fields' => [
                ['key' => 'field_onas_s5_icon', 'label' => 'Ikona (Lucide)', 'name' => 'icon', 'type' => 'text', 'default_value' => 'users'],
                ['key' => 'field_onas_s5_text', 'label' => 'Tekst',          'name' => 'text', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Ponad 1200\nklientów"],
            ],
        ],
        [
            'key' => 'field_onas_stat_6', 'label' => 'Ikona 6', 'name' => 'onas_stat_6', 'type' => 'group',
            'sub_fields' => [
                ['key' => 'field_onas_s6_icon', 'label' => 'Ikona (Lucide)', 'name' => 'icon', 'type' => 'text', 'default_value' => 'map-pin'],
                ['key' => 'field_onas_s6_text', 'label' => 'Tekst',          'name' => 'text', 'type' => 'textarea', 'rows' => 2, 'default_value' => "7 oddziałów\nw Polsce oraz\noddziały wirtualne"],
            ],
        ],

        // ── TAB: Jak pracujemy ────────────────────────────────────
        ['key' => 'field_onas_tab_jak', 'label' => 'Jak pracujemy', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_onas_jak_title', 'label' => 'Tytuł sekcji',      'name' => 'onas_jak_title', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Jak pracujemy?'],
        ['key' => 'field_onas_jak_photo', 'label' => 'Zdjęcie (prawa strona)', 'name' => 'onas_jak_photo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'],
        [
            'key' => 'field_onas_jak_1', 'label' => 'Punkt 1', 'name' => 'onas_jak_1', 'type' => 'group',
            'sub_fields' => [
                ['key' => 'field_onas_j1_icon',  'label' => 'Ikona (Lucide)', 'name' => 'icon',  'type' => 'text',     'default_value' => 'users-round'],
                ['key' => 'field_onas_j1_title', 'label' => 'Tytuł',          'name' => 'title', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Dedykowany zespół'],
                ['key' => 'field_onas_j1_text',  'label' => 'Opis',           'name' => 'text',  'type' => 'textarea', 'rows' => 3, 'default_value' => 'Każdy klient współpracuje z przypisanym zespołem specjalistów oraz Liderem odpowiedzialnym za jakość i terminowość.'],
            ],
        ],
        [
            'key' => 'field_onas_jak_2', 'label' => 'Punkt 2', 'name' => 'onas_jak_2', 'type' => 'group',
            'sub_fields' => [
                ['key' => 'field_onas_j2_icon',  'label' => 'Ikona (Lucide)', 'name' => 'icon',  'type' => 'text',     'default_value' => 'workflow'],
                ['key' => 'field_onas_j2_title', 'label' => 'Tytuł',          'name' => 'title', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Podejście procesowe'],
                ['key' => 'field_onas_j2_text',  'label' => 'Opis',           'name' => 'text',  'type' => 'textarea', 'rows' => 3, 'default_value' => 'Wszystkie działania opieramy na udokumentowanych procesach z określonymi SLA, checklistami i punktami kontroli jakości.'],
            ],
        ],
        [
            'key' => 'field_onas_jak_3', 'label' => 'Punkt 3', 'name' => 'onas_jak_3', 'type' => 'group',
            'sub_fields' => [
                ['key' => 'field_onas_j3_icon',  'label' => 'Ikona (Lucide)', 'name' => 'icon',  'type' => 'text',     'default_value' => 'repeat-2'],
                ['key' => 'field_onas_j3_title', 'label' => 'Tytuł',          'name' => 'title', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Pełna zastępowalność'],
                ['key' => 'field_onas_j3_text',  'label' => 'Opis',           'name' => 'text',  'type' => 'textarea', 'rows' => 3, 'default_value' => 'Procesy są tak zorganizowane, by urlopy i rotacja kadry nie wpływały na ciągłość obsługi.'],
            ],
        ],
        [
            'key' => 'field_onas_jak_4', 'label' => 'Punkt 4', 'name' => 'onas_jak_4', 'type' => 'group',
            'sub_fields' => [
                ['key' => 'field_onas_j4_icon',  'label' => 'Ikona (Lucide)', 'name' => 'icon',  'type' => 'text',     'default_value' => 'handshake'],
                ['key' => 'field_onas_j4_title', 'label' => 'Tytuł',          'name' => 'title', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Elastyczność współpracy'],
                ['key' => 'field_onas_j4_text',  'label' => 'Opis',           'name' => 'text',  'type' => 'textarea', 'rows' => 3, 'default_value' => 'Dopasowujemy zakres, terminy raportowania i sposób komunikacji do realnych potrzeb firmy.'],
            ],
        ],

        // ── TAB: Nasze Wartości ───────────────────────────────────
        ['key' => 'field_onas_tab_wartosci', 'label' => 'Nasze Wartości', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_onas_w_label', 'label' => 'Etykieta sekcji', 'name' => 'onas_w_label', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Nasze Wartości'],
        ['key' => 'field_onas_w_title', 'label' => 'Tytuł sekcji',    'name' => 'onas_w_title', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Dlaczego Meritoros to spokój\nw Twoim biznesie?"],

        ['key' => 'field_onas_w1_icon',  'label' => 'Karta 1 — Ikona',        'name' => 'onas_w1_icon',  'type' => 'text',     'default_value' => 'infinity'],
        ['key' => 'field_onas_w1_title', 'label' => 'Karta 1 — Tytuł',        'name' => 'onas_w1_title', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Skala i ciągłość\nobsługi"],
        ['key' => 'field_onas_w1_text',  'label' => 'Karta 1 — Opis',         'name' => 'onas_w1_text',  'type' => 'textarea', 'rows' => 3, 'default_value' => 'Pracujemy zespołowo i procesowo, dzięki czemu obsługa nie zależy od jednej osoby.'],

        ['key' => 'field_onas_w2_image', 'label' => 'Karta 2 — Zdjęcie',      'name' => 'onas_w2_image', 'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],
        ['key' => 'field_onas_w2_hover', 'label' => 'Karta 2 — Tekst hover',  'name' => 'onas_w2_hover', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Współpracuj z profesjonalistami'],
        ['key' => 'field_onas_w2_url',   'label' => 'Karta 2 — Link',         'name' => 'onas_w2_url',   'type' => 'text',     'default_value' => '/kontakt/'],

        ['key' => 'field_onas_w3_icon',  'label' => 'Karta 3 — Ikona',        'name' => 'onas_w3_icon',  'type' => 'text',     'default_value' => 'shield-check'],
        ['key' => 'field_onas_w3_title', 'label' => 'Karta 3 — Tytuł',        'name' => 'onas_w3_title', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Bezpieczeństwo\ni compliance"],
        ['key' => 'field_onas_w3_text',  'label' => 'Karta 3 — Opis',         'name' => 'onas_w3_text',  'type' => 'textarea', 'rows' => 3, 'default_value' => 'Działamy zgodnie z obowiązującymi regulacjami i standardami bezpieczeństwa danych.'],
        ['key' => 'field_onas_w3_badge', 'label' => 'Karta 3 — Odznaka ISO',  'name' => 'onas_w3_badge', 'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail', 'instructions' => 'Logo ISO 27001'],

        ['key' => 'field_onas_w4_icon',  'label' => 'Karta 4 — Ikona',        'name' => 'onas_w4_icon',  'type' => 'text',     'default_value' => 'bot'],
        ['key' => 'field_onas_w4_title', 'label' => 'Karta 4 — Tytuł',        'name' => 'onas_w4_title', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Technologia\ni automatyzacja"],
        ['key' => 'field_onas_w4_text',  'label' => 'Karta 4 — Opis',         'name' => 'onas_w4_text',  'type' => 'textarea', 'rows' => 3, 'default_value' => 'Wykorzystujemy narzędzia i automatyzację (RPA), które porządkują obieg dokumentów.'],

        ['key' => 'field_onas_w5_title', 'label' => 'Karta 5 — Tytuł',        'name' => 'onas_w5_title', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Nagrody i wyróżnienia'],
        ['key' => 'field_onas_w5_text',  'label' => 'Karta 5 — Opis',         'name' => 'onas_w5_text',  'type' => 'textarea', 'rows' => 2, 'default_value' => 'Wyróżnienia są efektem tego, jak rozwijamy Meritoros: konsekwentnie i procesowo.'],
        ['key' => 'field_onas_w5_logo1', 'label' => 'Karta 5 — Logo 1',       'name' => 'onas_w5_logo1', 'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_onas_w5_logo2', 'label' => 'Karta 5 — Logo 2',       'name' => 'onas_w5_logo2', 'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail'],

        ['key' => 'field_onas_w6_icon',  'label' => 'Karta 6 — Ikona',        'name' => 'onas_w6_icon',  'type' => 'text',     'default_value' => 'award'],
        ['key' => 'field_onas_w6_title', 'label' => 'Karta 6 — Tytuł',        'name' => 'onas_w6_title', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Jakość potwierdzona\nstandardami"],
        ['key' => 'field_onas_w6_text',  'label' => 'Karta 6 — Opis',         'name' => 'onas_w6_text',  'type' => 'textarea', 'rows' => 2, 'default_value' => 'Mamy wdrożone procedury kontroli jakości i weryfikacji danych.'],
        ['key' => 'field_onas_w6_badge', 'label' => 'Karta 6 — Odznaka ISO',  'name' => 'onas_w6_badge', 'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail', 'instructions' => 'Logo ISO 9001'],

        // ── TAB: Gdzie działamy ───────────────────────────────────
        ['key' => 'field_onas_tab_mapa', 'label' => 'Gdzie działamy', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_onas_mapa_title', 'label' => 'Tytuł sekcji',        'name' => 'onas_mapa_title', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Gdzie działamy'],
        ['key' => 'field_onas_mapa_text',  'label' => 'Opis pod tytułem',    'name' => 'onas_mapa_text',  'type' => 'textarea', 'rows' => 2, 'default_value' => 'Posiadamy 7 oddziałów stacjonarnych w miastach Polski oraz oddziały wirtualne, dzięki czemu obsługujemy firmy niezależnie od ich lokalizacji:'],
        ['key' => 'field_onas_mapa_image', 'label' => 'Mapa Polski (SVG/PNG)','name' => 'onas_mapa_image', 'type' => 'file',  'return_format' => 'array', 'library' => 'all'],
        ['key' => 'field_onas_mapa_cities','label' => 'Lista miast (jeden wpis = jedna linia)', 'name' => 'onas_mapa_cities', 'type' => 'textarea', 'rows' => 10, 'default_value' => "Kraków (siedziba główna oraz 3 oddziały)\nWarszawa\nKatowice\nRzeszów\nWrocław\nŁódź\nBytom\n2 oddziały wirtualne działające w pełni online"],

        // ── TAB: Zespół ───────────────────────────────────────────
        ['key' => 'field_onas_tab_zespol', 'label' => 'Zespół', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_onas_team_title', 'label' => 'Tytuł sekcji', 'name' => 'onas_team_title', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Zespół'],
        [
            'key' => 'field_onas_member_1', 'label' => 'Osoba 1', 'name' => 'onas_member_1', 'type' => 'group',
            'sub_fields' => [
                ['key' => 'field_onas_m1_photo', 'label' => 'Zdjęcie',    'name' => 'photo', 'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],
                ['key' => 'field_onas_m1_name',  'label' => 'Imię i nazwisko', 'name' => 'name', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Maciej Paraszczak'],
                ['key' => 'field_onas_m1_role',  'label' => 'Stanowisko',  'name' => 'role', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'prezes zarządu, CEO'],
                ['key' => 'field_onas_m1_bio',   'label' => 'Biogram',     'name' => 'bio',  'type' => 'textarea', 'rows' => 3],
                ['key' => 'field_onas_m1_url',   'label' => 'Link "Czytaj więcej"', 'name' => 'url', 'type' => 'text'],
            ],
        ],
        [
            'key' => 'field_onas_member_2', 'label' => 'Osoba 2', 'name' => 'onas_member_2', 'type' => 'group',
            'sub_fields' => [
                ['key' => 'field_onas_m2_photo', 'label' => 'Zdjęcie',    'name' => 'photo', 'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],
                ['key' => 'field_onas_m2_name',  'label' => 'Imię i nazwisko', 'name' => 'name', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Agnieszka Tomczyk-Pieniądz'],
                ['key' => 'field_onas_m2_role',  'label' => 'Stanowisko',  'name' => 'role', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'członek zarządu, COO'],
                ['key' => 'field_onas_m2_bio',   'label' => 'Biogram',     'name' => 'bio',  'type' => 'textarea', 'rows' => 3],
                ['key' => 'field_onas_m2_url',   'label' => 'Link "Czytaj więcej"', 'name' => 'url', 'type' => 'text'],
            ],
        ],
        [
            'key' => 'field_onas_member_3', 'label' => 'Osoba 3', 'name' => 'onas_member_3', 'type' => 'group',
            'sub_fields' => [
                ['key' => 'field_onas_m3_photo', 'label' => 'Zdjęcie',    'name' => 'photo', 'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],
                ['key' => 'field_onas_m3_name',  'label' => 'Imię i nazwisko', 'name' => 'name', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Krzysztof Gargas'],
                ['key' => 'field_onas_m3_role',  'label' => 'Stanowisko',  'name' => 'role', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'członek zarządu, COO'],
                ['key' => 'field_onas_m3_bio',   'label' => 'Biogram',     'name' => 'bio',  'type' => 'textarea', 'rows' => 3],
                ['key' => 'field_onas_m3_url',   'label' => 'Link "Czytaj więcej"', 'name' => 'url', 'type' => 'text'],
            ],
        ],
        [
            'key' => 'field_onas_member_4', 'label' => 'Osoba 4', 'name' => 'onas_member_4', 'type' => 'group',
            'sub_fields' => [
                ['key' => 'field_onas_m4_photo', 'label' => 'Zdjęcie',    'name' => 'photo', 'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],
                ['key' => 'field_onas_m4_name',  'label' => 'Imię i nazwisko', 'name' => 'name', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Joanna Małek'],
                ['key' => 'field_onas_m4_role',  'label' => 'Stanowisko',  'name' => 'role', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'członek zarządu, COO'],
                ['key' => 'field_onas_m4_bio',   'label' => 'Biogram',     'name' => 'bio',  'type' => 'textarea', 'rows' => 3],
                ['key' => 'field_onas_m4_url',   'label' => 'Link "Czytaj więcej"', 'name' => 'url', 'type' => 'text'],
            ],
        ],
    ],
    'location'   => $onas_page_location,
    'menu_order' => 0,
    'position'   => 'normal',
]);

/* ==================================================================
   STRONA KONTAKT
================================================================== */
$contact_page_location = [
    [['param' => 'page_slug',     'operator' => '==', 'value' => 'kontakt']],
    [['param' => 'page_template', 'operator' => '==', 'value' => 'page-kontakt.php']],
];

acf_add_local_field_group([
    'key'    => 'group_mer_kontakt',
    'title'  => '📞 Strona Kontakt',
    'fields' => [

        // ── TAB: Hero & Formularz ──────────────────────────────────
        [
            'key'   => 'field_kon_tab_hero',
            'label' => 'Hero & Formularz',
            'name'  => '',
            'type'  => 'tab',
        ],
        [
            'key'           => 'field_kon_title_green',
            'label'         => 'Tytuł — zielona część',
            'name'          => 'kon_title_green',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Umów rozmowę',
        ],
        [
            'key'           => 'field_kon_title_dark',
            'label'         => 'Tytuł — ciemna część',
            'name'          => 'kon_title_dark',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'i sprawdź, jak możemy pomóc',
        ],
        [
            'key'           => 'field_kon_subtitle',
            'label'         => 'Podtytuł',
            'name'          => 'kon_subtitle',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Wysłuchamy, przeanalizujemy sytuację i zaproponujemy kolejne kroki.',
        ],
        [
            'key'           => 'field_kon_submit_text',
            'label'         => 'Tekst przycisku "Wyślij"',
            'name'          => 'kon_submit_text',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Wyślij wiadomość',
        ],
        [
            'key'           => 'field_kon_area_options',
            'label'         => 'Opcje obszaru wsparcia (jedna per linia)',
            'name'          => 'kon_area_options',
            'type'          => 'textarea',
            'rows'          => 6,
            'default_value' => "Usługi księgowe\nKadry i płace\nFundacje rodzinne\nBPO\nInne",
        ],
        [
            'key'           => 'field_kon_rodo',
            'label'         => 'Tekst zgody RODO',
            'name'          => 'kon_rodo',
            'type'          => 'textarea',
            'rows'          => 3,
            'default_value' => 'Tak, przeczytałem/am i akceptuję politykę prywatności dotyczącą przetwarzania danych osobowych, którą wypełniający formularz wyraża zgodę na przekazywanie podanych danych osobowych firmie Meritoros oraz na ich przetwarzanie do celów marketingowych.',
        ],
        [
            'key'           => 'field_kon_privacy_url',
            'label'         => 'Link do polityki prywatności',
            'name'          => 'kon_privacy_url',
            'type'          => 'text',
            'default_value' => '/polityka-prywatnosci',
        ],
        [
            'key'           => 'field_kon_email_to',
            'label'         => 'E-mail odbiorcy formularza',
            'name'          => 'kon_email_to',
            'type'          => 'email',
            'default_value' => 'biuro@meritoros.pl',
        ],
        [
            'key'          => 'field_kon_cf7_id',
            'label'        => 'ID formularza CF7',
            'name'         => 'kon_cf7_id',
            'type'         => 'number',
            'instructions' => 'Wklej ID formularza Contact Form 7 (widoczny w WP Admin → Kontakt).',
            'min'          => 0,
        ],

        // ── TAB: Kroki procesu ────────────────────────────────────
        [
            'key'   => 'field_kon_tab_steps',
            'label' => 'Kroki procesu',
            'name'  => '',
            'type'  => 'tab',
        ],
        [
            'key'        => 'field_kon_step_1',
            'label'      => 'Krok 1',
            'name'       => 'kon_step_1',
            'type'       => 'group',
            'layout'     => 'table',
            'sub_fields' => [
                ['key' => 'field_kon_step_1_label',  'label' => 'Etykieta',          'name' => 'label',  'type' => 'textarea',   'rows' => 1, 'default_value' => 'Analiza potrzeb'],
                ['key' => 'field_kon_step_1_active', 'label' => 'Aktywny (zielony)?','name' => 'active', 'type' => 'true_false', 'ui' => 1, 'default_value' => 1],
            ],
        ],
        [
            'key'        => 'field_kon_step_2',
            'label'      => 'Krok 2',
            'name'       => 'kon_step_2',
            'type'       => 'group',
            'layout'     => 'table',
            'sub_fields' => [
                ['key' => 'field_kon_step_2_label',  'label' => 'Etykieta',          'name' => 'label',  'type' => 'textarea',   'rows' => 1, 'default_value' => 'Propozycja rozwiązania'],
                ['key' => 'field_kon_step_2_active', 'label' => 'Aktywny (zielony)?','name' => 'active', 'type' => 'true_false', 'ui' => 1, 'default_value' => 1],
            ],
        ],
        [
            'key'        => 'field_kon_step_3',
            'label'      => 'Krok 3',
            'name'       => 'kon_step_3',
            'type'       => 'group',
            'layout'     => 'table',
            'sub_fields' => [
                ['key' => 'field_kon_step_3_label',  'label' => 'Etykieta',          'name' => 'label',  'type' => 'textarea',   'rows' => 1, 'default_value' => 'Wdrożenie'],
                ['key' => 'field_kon_step_3_active', 'label' => 'Aktywny (zielony)?','name' => 'active', 'type' => 'true_false', 'ui' => 1, 'default_value' => 1],
            ],
        ],
        [
            'key'        => 'field_kon_step_4',
            'label'      => 'Krok 4',
            'name'       => 'kon_step_4',
            'type'       => 'group',
            'layout'     => 'table',
            'sub_fields' => [
                ['key' => 'field_kon_step_4_label',  'label' => 'Etykieta',          'name' => 'label',  'type' => 'textarea',   'rows' => 1, 'default_value' => 'Stałe wsparcie'],
                ['key' => 'field_kon_step_4_active', 'label' => 'Aktywny (zielony)?','name' => 'active', 'type' => 'true_false', 'ui' => 1, 'default_value' => 0],
            ],
        ],

        // ── TAB: Dane kontaktowe ──────────────────────────────────
        [
            'key'   => 'field_kon_tab_contact',
            'label' => 'Dane kontaktowe',
            'name'  => '',
            'type'  => 'tab',
        ],
        [
            'key'           => 'field_kon_phone_label',
            'label'         => 'Nagłówek karty telefon',
            'name'          => 'kon_phone_label',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Zadzwoń do nas!',
        ],
        [
            'key'           => 'field_kon_phone',
            'label'         => 'Numer telefonu (wyświetlany)',
            'name'          => 'kon_phone',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => '(+48) 12 423 52 99',
        ],
        [
            'key'           => 'field_kon_phone_tel',
            'label'         => 'Numer telefonu (format tel:, bez spacji)',
            'name'          => 'kon_phone_tel',
            'type'          => 'text',
            'default_value' => '+48124235299',
        ],
        [
            'key'           => 'field_kon_phone_desc',
            'label'         => 'Opis pod numerem telefonu',
            'name'          => 'kon_phone_desc',
            'type'          => 'textarea',
            'rows'          => 2,
            'default_value' => "Nasi specjaliści są do dyspozycji w godzinach pracy biura.\nOdpowiemy na wszystkie Twoje pytania.",
        ],
        [
            'key'           => 'field_kon_company_name',
            'label'         => 'Nazwa firmy',
            'name'          => 'kon_company_name',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Meritoros SA',
        ],
        [
            'key'           => 'field_kon_address',
            'label'         => 'Adres siedziby',
            'name'          => 'kon_address',
            'type'          => 'textarea',
            'rows'          => 2,
            'default_value' => "Aleja Pokoju 62/8\n31-564 Kraków",
        ],
        [
            'key'           => 'field_kon_email_admin',
            'label'         => 'E-mail administracja',
            'name'          => 'kon_email_admin',
            'type'          => 'email',
            'default_value' => 'biuro@meritoros.pl',
        ],
        [
            'key'           => 'field_kon_email_offers',
            'label'         => 'E-mail oferty',
            'name'          => 'kon_email_offers',
            'type'          => 'email',
            'default_value' => 'oferty@meritoros.pl',
        ],
        [
            'key'           => 'field_kon_edelivery',
            'label'         => 'Adres do e-doręczeń',
            'name'          => 'kon_edelivery',
            'type'          => 'text',
            'default_value' => 'AE:PL-49846-54459-JWEFS-17',
        ],
        [
            'key'           => 'field_kon_nip',
            'label'         => 'NIP',
            'name'          => 'kon_nip',
            'type'          => 'text',
            'default_value' => 'PL 6792963176',
        ],
        [
            'key'           => 'field_kon_regon',
            'label'         => 'REGON',
            'name'          => 'kon_regon',
            'type'          => 'text',
            'default_value' => '120618773',
        ],
        [
            'key'           => 'field_kon_krs_court',
            'label'         => 'Sąd KRS',
            'name'          => 'kon_krs_court',
            'type'          => 'textarea',
            'rows'          => 2,
            'default_value' => "Sąd Rejonowy dla Krakowa-Śródmieścia w Krakowie\nWydział XI Gospodarczy Krajowego Rejestru Sądowego",
        ],
        [
            'key'           => 'field_kon_krs_number',
            'label'         => 'Nr KRS',
            'name'          => 'kon_krs_number',
            'type'          => 'text',
            'default_value' => '0000935021',
        ],

        // ── TAB: Oddziały ─────────────────────────────────────────
        [
            'key'   => 'field_kon_tab_offices',
            'label' => 'Oddziały',
            'name'  => '',
            'type'  => 'tab',
        ],
        [
            'key'           => 'field_kon_offices_title',
            'label'         => 'Tytuł sekcji',
            'name'          => 'kon_offices_title',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => "Miasta w których\nmamy oddziały",
        ],
        [
            'key'               => 'field_kon_map_image',
            'label'             => 'Mapa Polski (SVG/PNG)',
            'name'              => 'kon_map_image',
            'type'              => 'file',
            'return_format'     => 'array',
            'library'           => 'all',
            'mime_types'        => 'svg, png, jpg',
        ],
        ['key' => 'field_kon_office_1', 'label' => 'Oddział 1 — Kraków',   'name' => 'kon_office_1', 'type' => 'group', 'layout' => 'table', 'sub_fields' => [
            ['key' => 'field_kon_off1_city', 'label' => 'Miasto', 'name' => 'city',    'type' => 'text',     'default_value' => 'Kraków'],
            ['key' => 'field_kon_off1_addr', 'label' => 'Adres',  'name' => 'address', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Aleja Pokoju 62/8\n31-564 Kraków"],
        ]],
        ['key' => 'field_kon_office_2', 'label' => 'Oddział 2 — Warszawa', 'name' => 'kon_office_2', 'type' => 'group', 'layout' => 'table', 'sub_fields' => [
            ['key' => 'field_kon_off2_city', 'label' => 'Miasto', 'name' => 'city',    'type' => 'text',     'default_value' => 'Warszawa'],
            ['key' => 'field_kon_off2_addr', 'label' => 'Adres',  'name' => 'address', 'type' => 'textarea', 'rows' => 2, 'default_value' => "ul. Złota 22 AR, 204\n00-400 Warszawa"],
        ]],
        ['key' => 'field_kon_office_3', 'label' => 'Oddział 3 — Katowice', 'name' => 'kon_office_3', 'type' => 'group', 'layout' => 'table', 'sub_fields' => [
            ['key' => 'field_kon_off3_city', 'label' => 'Miasto', 'name' => 'city',    'type' => 'text',     'default_value' => 'Katowice'],
            ['key' => 'field_kon_off3_addr', 'label' => 'Adres',  'name' => 'address', 'type' => 'textarea', 'rows' => 2, 'default_value' => "ul. Przykładowa 6/3\n40-002 Katowice"],
        ]],
        ['key' => 'field_kon_office_4', 'label' => 'Oddział 4 — Rzeszów',  'name' => 'kon_office_4', 'type' => 'group', 'layout' => 'table', 'sub_fields' => [
            ['key' => 'field_kon_off4_city', 'label' => 'Miasto', 'name' => 'city',    'type' => 'text',     'default_value' => 'Rzeszów'],
            ['key' => 'field_kon_off4_addr', 'label' => 'Adres',  'name' => 'address', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Ulica Targowa 61\n38-025 Rzeszów"],
        ]],
        ['key' => 'field_kon_office_5', 'label' => 'Oddział 5 — Wrocław',  'name' => 'kon_office_5', 'type' => 'group', 'layout' => 'table', 'sub_fields' => [
            ['key' => 'field_kon_off5_city', 'label' => 'Miasto', 'name' => 'city',    'type' => 'text',     'default_value' => 'Wrocław'],
            ['key' => 'field_kon_off5_addr', 'label' => 'Adres',  'name' => 'address', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Rybnicka 77/34\n53-656 Wrocław"],
        ]],
        ['key' => 'field_kon_office_6', 'label' => 'Oddział 6 — Łódź',     'name' => 'kon_office_6', 'type' => 'group', 'layout' => 'table', 'sub_fields' => [
            ['key' => 'field_kon_off6_city', 'label' => 'Miasto', 'name' => 'city',    'type' => 'text',     'default_value' => 'Łódź'],
            ['key' => 'field_kon_off6_addr', 'label' => 'Adres',  'name' => 'address', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Dębina 8\n92-014 Łódź"],
        ]],
        ['key' => 'field_kon_office_7', 'label' => 'Oddział 7 — Bytom',    'name' => 'kon_office_7', 'type' => 'group', 'layout' => 'table', 'sub_fields' => [
            ['key' => 'field_kon_off7_city', 'label' => 'Miasto', 'name' => 'city',    'type' => 'text',     'default_value' => 'Bytom'],
            ['key' => 'field_kon_off7_addr', 'label' => 'Adres',  'name' => 'address', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Mazowieckiego 51\n41-900 Bytom"],
        ]],
        [
            'key'           => 'field_kon_virtual_label',
            'label'         => 'Karta wirtualna — etykieta',
            'name'          => 'kon_virtual_label',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => "Oddziały\nWirtualne",
        ],
        [
            'key'           => 'field_kon_virtual_desc',
            'label'         => 'Karta wirtualna — opis',
            'name'          => 'kon_virtual_desc',
            'type'          => 'textarea',
            'rows'          => 1,
            'default_value' => 'Obsługujemy klientów zdalnie w całej Polsce',
        ],
    ],
    'location'   => $contact_page_location,
    'menu_order' => 10,
    'position'   => 'normal',
]);

/* ==================================================================
   FUNDACJE RODZINNE
================================================================== */
$fr_page_location = [
    [['param' => 'page_slug',     'operator' => '==', 'value' => 'fundacje-rodzinne']],
    [['param' => 'page_template', 'operator' => '==', 'value' => 'page-fundacje-rodzinne.php']],
];

acf_add_local_field_group([
    'key'      => 'group_mer_fr',
    'title'    => '🏛️ Fundacje rodzinne',
    'fields'   => [

        // ── TAB: Hero ────────────────────────────────────────────
        ['key' => 'field_fr_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_fr_hero_title_normal', 'label' => 'Nagłówek — część 1 (czarna)', 'name' => 'fr_hero_title_normal', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Fundacja rodzinna'],
        ['key' => 'field_fr_hero_title_green',  'label' => 'Nagłówek — wyróżnienie (zielone)', 'name' => 'fr_hero_title_green', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'bez stresu'],
        ['key' => 'field_fr_hero_title_line2',  'label' => 'Nagłówek — linia 2', 'name' => 'fr_hero_title_line2', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'księgowość pod kontrolą'],
        ['key' => 'field_fr_hero_subtitle',     'label' => 'Podtytuł', 'name' => 'fr_hero_subtitle', 'type' => 'textarea', 'rows' => 3, 'new_lines' => 'br', 'default_value' => 'Prowadzimy pełną obsługę księgową fundacji rodzinnych. Zajmujemy się ewidencją, sprawozdawczością i terminami, żebyś mógł skupić się na tym, co ważne.'],
        ['key' => 'field_fr_hero_btn1_text', 'label' => 'Przycisk 1 — tekst', 'name' => 'fr_hero_btn1_text', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Umów konsultację'],
        ['key' => 'field_fr_hero_btn1_url',  'label' => 'Przycisk 1 — link',  'name' => 'fr_hero_btn1_url',  'type' => 'text', 'default_value' => '/kontakt/'],
        ['key' => 'field_fr_hero_btn2_text', 'label' => 'Przycisk 2 — tekst', 'name' => 'fr_hero_btn2_text', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Poznaj ofertę'],
        ['key' => 'field_fr_hero_btn2_url',  'label' => 'Przycisk 2 — link',  'name' => 'fr_hero_btn2_url',  'type' => 'text', 'default_value' => '#oferta'],

        // ── TAB: Obsługa ─────────────────────────────────────────
        ['key' => 'field_fr_tab_obsluga', 'label' => 'Obsługa', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_fr_obs_title', 'label' => 'Tytuł sekcji', 'name' => 'fr_obs_title', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Obsługa księgowa fundacji rodzinnej dla właścicieli myślących długoterminowo'],
        ['key' => 'field_fr_obs_text',  'label' => 'Tekst',        'name' => 'fr_obs_text',  'type' => 'textarea', 'rows' => 4, 'default_value' => 'Prowadzimy księgowość fundacji rodzinnych dla przedsiębiorców, którzy chcą uporządkować kwestie majątku i sukcesji w sposób bezpieczny, transparentny i zgodny z przepisami. Bierzemy na siebie bieżącą obsługę, sprawozdawczość i kontrolę terminów, tak aby fundacja działała stabilnie.'],
        ['key' => 'field_fr_obs_image', 'label' => 'Zdjęcie',      'name' => 'fr_obs_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'],

        // ── TAB: Oferta ──────────────────────────────────────────
        ['key' => 'field_fr_tab_oferta', 'label' => 'Oferta', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_fr_oferta_title',    'label' => 'Tytuł',    'name' => 'fr_oferta_title',    'type' => 'textarea', 'rows' => 1, 'default_value' => 'Poznaj naszą ofertę'],
        ['key' => 'field_fr_oferta_subtitle', 'label' => 'Podtytuł', 'name' => 'fr_oferta_subtitle', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Zapewniamy kompleksową obsługę księgową i podatkową, która porządkuje finanse fundacji i daje poczucie bezpieczeństwa jej fundatorom.'],
        ['key' => 'field_fr_oferta_items',    'label' => 'Elementy listy (1 linia = 1 kafelek)', 'name' => 'fr_oferta_items', 'type' => 'textarea', 'rows' => 8, 'instructions' => 'Każda linia to oddzielny kafelek w siatce.', 'default_value' => "Prowadzenie ksiąg rachunkowych\nRozliczanie i składanie deklaracji podatkowych\nPrzygotowywanie sprawozdań finansowych\nAsystowanie podczas badania sprawozdania finansowego oraz kontroli urzędów\nRaportowanie na cele zarządcze\nSporządzanie polityki rachunkowości"],
        ['key' => 'field_fr_oferta_btn_text', 'label' => 'Przycisk — tekst', 'name' => 'fr_oferta_btn_text', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Wyceń usługę'],
        ['key' => 'field_fr_oferta_btn_url',  'label' => 'Przycisk — link',  'name' => 'fr_oferta_btn_url',  'type' => 'text', 'default_value' => '/kontakt/'],

        // ── TAB: Co zyskujesz ────────────────────────────────────
        ['key' => 'field_fr_tab_zyski', 'label' => 'Co zyskujesz', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_fr_zysk_title', 'label' => 'Tytuł sekcji', 'name' => 'fr_zysk_title', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Co zyskujesz, gdy księgowość\nfundacji jest poukładana"],

        ['key' => 'field_fr_zysk_1', 'label' => 'Karta 1', 'name' => 'fr_zysk_1', 'type' => 'group', 'layout' => 'table', 'sub_fields' => [
            ['key' => 'field_fr_zysk1_icon',  'label' => 'Ikona (lucide)',  'name' => 'icon',  'type' => 'text', 'default_value' => 'shield-check'],
            ['key' => 'field_fr_zysk1_title', 'label' => 'Tytuł',          'name' => 'title', 'type' => 'textarea', 'rows' => 1, 'default_value' => "Bezpieczne zarządzanie\nmajątkiem"],
            ['key' => 'field_fr_zysk1_text',  'label' => 'Opis',           'name' => 'text',  'type' => 'textarea', 'rows' => 3, 'default_value' => 'Porządek w danych i dokumentach, jasna sprawozdawczość i kontrola nad obowiązkami.'],
        ]],

        ['key' => 'field_fr_zysk_2', 'label' => 'Karta 2', 'name' => 'fr_zysk_2', 'type' => 'group', 'layout' => 'table', 'sub_fields' => [
            ['key' => 'field_fr_zysk2_icon',  'label' => 'Ikona (lucide)',  'name' => 'icon',  'type' => 'text', 'default_value' => 'clipboard-list'],
            ['key' => 'field_fr_zysk2_title', 'label' => 'Tytuł',          'name' => 'title', 'type' => 'textarea', 'rows' => 1, 'default_value' => "Sukcesja na trwałych\nregułach"],
            ['key' => 'field_fr_zysk2_text',  'label' => 'Opis',           'name' => 'text',  'type' => 'textarea', 'rows' => 3, 'default_value' => 'Przejrzyste zasady i przewidywalność – tak, aby rozwiązanie działało długoterminowo.'],
        ]],

        ['key' => 'field_fr_zysk_3', 'label' => 'Karta 3', 'name' => 'fr_zysk_3', 'type' => 'group', 'layout' => 'table', 'sub_fields' => [
            ['key' => 'field_fr_zysk3_icon',  'label' => 'Ikona (lucide)',  'name' => 'icon',  'type' => 'text', 'default_value' => 'calendar-check'],
            ['key' => 'field_fr_zysk3_title', 'label' => 'Tytuł',          'name' => 'title', 'type' => 'textarea', 'rows' => 1, 'default_value' => "Spokój w kwestiach\nformalnych"],
            ['key' => 'field_fr_zysk3_text',  'label' => 'Opis',           'name' => 'text',  'type' => 'textarea', 'rows' => 3, 'default_value' => 'Dopilnujemy terminów i obowiązków sprawozdawczych, żeby nic „nie wyskakiwało" w ostatniej chwili.'],
        ]],

        ['key' => 'field_fr_zysk_4', 'label' => 'Karta 4', 'name' => 'fr_zysk_4', 'type' => 'group', 'layout' => 'table', 'sub_fields' => [
            ['key' => 'field_fr_zysk4_icon',  'label' => 'Ikona (lucide)',  'name' => 'icon',  'type' => 'text', 'default_value' => 'badge-check'],
            ['key' => 'field_fr_zysk4_title', 'label' => 'Tytuł',          'name' => 'title', 'type' => 'textarea', 'rows' => 1, 'default_value' => "Mniej ryzyk,\nmniej poprawek"],
            ['key' => 'field_fr_zysk4_text',  'label' => 'Opis',           'name' => 'text',  'type' => 'textarea', 'rows' => 3, 'default_value' => 'Praca procesowa, weryfikacja danych i standardy, które ograniczają błędy.'],
        ]],

        // ── TAB: Dlaczego ────────────────────────────────────────
        ['key' => 'field_fr_tab_dlaczego', 'label' => 'Dlaczego', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_fr_dlaczego_title', 'label' => 'Tytuł sekcji', 'name' => 'fr_dlaczego_title', 'type' => 'textarea', 'rows' => 1, 'default_value' => 'Dlaczego warto nam zaufać?'],

        ['key' => 'field_fr_d1_title', 'label' => 'Karta 1 — tytuł', 'name' => 'fr_d1_title', 'type' => 'text', 'default_value' => "Bezpieczeństwo\ni compliance"],
        ['key' => 'field_fr_d1_text',  'label' => 'Karta 1 — opis',  'name' => 'fr_d1_text',  'type' => 'textarea', 'rows' => 4, 'default_value' => 'Działamy zgodnie z obowiązującymi regulacjami i standardami bezpieczeństwa danych. Dbamy o poufność informacji oraz jasne zasady współpracy – bez „skrótów" i ryzyk.'],
        ['key' => 'field_fr_d1_logo',  'label' => 'Karta 1 — logo (np. ISO 27001)', 'name' => 'fr_d1_logo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'instructions' => 'Logo wyświetlane w stopce karty. Jeśli puste — pokazana zostanie ikona tarczy.'],

        ['key' => 'field_fr_d2_title', 'label' => 'Karta 2 — tytuł', 'name' => 'fr_d2_title', 'type' => 'text', 'default_value' => "Jakość potwierdzona\nstandardami"],
        ['key' => 'field_fr_d2_text',  'label' => 'Karta 2 — opis',  'name' => 'fr_d2_text',  'type' => 'textarea', 'rows' => 4, 'default_value' => 'Mamy wdrożone procedury kontroli jakości i weryfikacji danych. Dostarczamy informacje finansowe kompletne, spójne i użyteczne dla zarządu.'],
        ['key' => 'field_fr_d2_logo',  'label' => 'Karta 2 — logo (np. ISO 9001)', 'name' => 'fr_d2_logo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'instructions' => 'Logo wyświetlane w stopce karty. Jeśli puste — pokazana zostanie ikona nagrody.'],

        ['key' => 'field_fr_d3_title', 'label' => 'Karta 3 — tytuł', 'name' => 'fr_d3_title', 'type' => 'text', 'default_value' => 'Ponad 170 ekspertów'],
        ['key' => 'field_fr_d3_text',  'label' => 'Karta 3 — opis',  'name' => 'fr_d3_text',  'type' => 'textarea', 'rows' => 4, 'default_value' => 'Jakość potwierdzona standardami. Mamy wdrożone procedury kontroli jakości i weryfikacji danych. Dostarczamy informacje finansowe kompletne, spójne i użyteczne dla zarządu.'],

        // ── TAB: Model współpracy ────────────────────────────────
        ['key' => 'field_fr_tab_model', 'label' => 'Model współpracy', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_fr_model_title',    'label' => 'Tytuł sekcji', 'name' => 'fr_model_title',    'type' => 'text',     'default_value' => 'Model współpracy'],
        ['key' => 'field_fr_model_subtitle', 'label' => 'Podtytuł',    'name' => 'fr_model_subtitle', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Możesz powierzyć nam całość procesów księgowych lub wybrane obszary wymagające uporządkowania. Dopasowujemy zakres wsparcia do realnej sytuacji Twojej firmy.'],

        ['key' => 'field_fr_model1', 'label' => 'Karta 1 — Kompleksowa obsługa', 'name' => 'fr_model1', 'type' => 'group', 'layout' => 'table', 'sub_fields' => [
            ['key' => 'field_fr_model1_icon',  'label' => 'Ikona (lucide)', 'name' => 'icon',  'type' => 'text', 'default_value' => 'network'],
            ['key' => 'field_fr_model1_title', 'label' => 'Tytuł',         'name' => 'title', 'type' => 'text', 'default_value' => 'Kompleksowa obsługa'],
            ['key' => 'field_fr_model1_text',  'label' => 'Opis (tył karty)', 'name' => 'text', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Obsługujemy proces end-to-end: od bieżącej ewidencji po zamknięcie miesiąca i raporty. Pracujesz z zespołem, który zapewnia zastępowalność i stały standard.'],
        ]],

        ['key' => 'field_fr_model2', 'label' => 'Karta 2 — Outsourcing wybranych procesów', 'name' => 'fr_model2', 'type' => 'group', 'layout' => 'table', 'sub_fields' => [
            ['key' => 'field_fr_model2_image', 'label' => 'Zdjęcie tła', 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'],
            ['key' => 'field_fr_model2_title', 'label' => 'Tytuł',       'name' => 'title', 'type' => 'text', 'default_value' => "Outsourcing wybranych\nprocesów"],
            ['key' => 'field_fr_model2_text',  'label' => 'Opis (tył karty)', 'name' => 'text', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Przejmujemy konkretne procesy i dowozimy je w ustalonym standardzie i harmonogramie. To rozwiązanie dla firm, które chcą wzmocnić wewnętrzny dział finansów bez rozbudowy etatów.'],
        ]],

    ],
    'location'   => $fr_page_location,
    'menu_order' => 10,
    'position'   => 'normal',
]);

/* ==================================================================
   USŁUGI KSIĘGOWE
================================================================== */
$uk_page_location = [
    [['param' => 'page_slug',     'operator' => '==', 'value' => 'uslugi-ksiegowe']],
    [['param' => 'page_template', 'operator' => '==', 'value' => 'page-uslugi-ksiegowe.php']],
];

acf_add_local_field_group([
    'key'    => 'group_mer_uk',
    'title'  => '📒 Usługi księgowe',
    'fields' => [

        // ── TAB: Hero ────────────────────────────────────────────
        ['key' => 'field_uk_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_uk_hero_title_before', 'label' => 'Nagłówek — przed zieloną częścią', 'name' => 'uk_hero_title_before', 'type' => 'text',     'default_value' => 'Rozwiązania księgowe dla firm, które'],
        ['key' => 'field_uk_hero_title_green',  'label' => 'Nagłówek — zielona część',         'name' => 'uk_hero_title_green',  'type' => 'text',     'default_value' => 'chcą mieć porządek'],
        ['key' => 'field_uk_hero_title_after',  'label' => 'Nagłówek — po zielonej części',    'name' => 'uk_hero_title_after',  'type' => 'text',     'default_value' => 'i spokój w biznesie'],
        ['key' => 'field_uk_hero_subtitle',     'label' => 'Podtytuł',                         'name' => 'uk_hero_subtitle',     'type' => 'textarea', 'rows' => 3, 'new_lines' => 'br', 'default_value' => 'Zapewniamy kompleksową obsługę księgową firm o różnej skali działalności. Przejmujemy odpowiedzialność za poprawność, terminowość i ciągłość procesów księgowych, aby nasi klienci mogli skupić się na prowadzeniu i rozwoju biznesu.'],
        ['key' => 'field_uk_hero_btn1_text', 'label' => 'Przycisk 1 — tekst', 'name' => 'uk_hero_btn1_text', 'type' => 'text', 'default_value' => 'Poznaj ofertę'],
        ['key' => 'field_uk_hero_btn1_url',  'label' => 'Przycisk 1 — link',  'name' => 'uk_hero_btn1_url',  'type' => 'text', 'default_value' => '#oferta'],
        ['key' => 'field_uk_hero_btn2_text', 'label' => 'Przycisk 2 — tekst', 'name' => 'uk_hero_btn2_text', 'type' => 'text', 'default_value' => 'Porozmawiajmy'],
        ['key' => 'field_uk_hero_btn2_url',  'label' => 'Przycisk 2 — link',  'name' => 'uk_hero_btn2_url',  'type' => 'text', 'default_value' => '/kontakt/'],

        // ── TAB: Twoja księgowość ────────────────────────────────
        ['key' => 'field_uk_tab_ks', 'label' => 'Twoja księgowość', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_uk_ks_title1',      'label' => 'Nagłówek — linia 1',          'name' => 'uk_ks_title1',      'type' => 'text',     'default_value' => 'Twoja księgowość'],
        ['key' => 'field_uk_ks_title2',      'label' => 'Nagłówek — linia 2 (przed zielonym)', 'name' => 'uk_ks_title2', 'type' => 'text', 'default_value' => 'w'],
        ['key' => 'field_uk_ks_title_green', 'label' => 'Nagłówek — zielona część',    'name' => 'uk_ks_title_green', 'type' => 'text',     'default_value' => 'dobrych rękach'],
        ['key' => 'field_uk_ks_text1',       'label' => 'Akapit 1',                    'name' => 'uk_ks_text1',       'type' => 'textarea', 'rows' => 4, 'default_value' => 'Oferujemy kompleksową obsługę księgową działalności i spółek zarówno w zakresie prowadzenia pełnych ksiąg rachunkowych, jak i uproszczonych form ewidencji. Klienci mogą powierzyć nam całość procesów księgowych lub wybrane obszary wymagające wsparcia.'],
        ['key' => 'field_uk_ks_text2',       'label' => 'Akapit 2 (pogrubiony)',       'name' => 'uk_ks_text2',       'type' => 'textarea', 'rows' => 2, 'default_value' => 'Zakres współpracy dopasowujemy do skali działalności i stopnia złożoności operacji finansowych.'],
        ['key' => 'field_uk_ks_btn_text',    'label' => 'Przycisk — tekst',            'name' => 'uk_ks_btn_text',    'type' => 'text',     'default_value' => 'Sprawdź jak wygląda współpraca'],
        ['key' => 'field_uk_ks_btn_url',     'label' => 'Przycisk — link',             'name' => 'uk_ks_btn_url',     'type' => 'text',     'default_value' => '/kontakt/'],
        ['key' => 'field_uk_ks_image',       'label' => 'Zdjęcie',                     'name' => 'uk_ks_image',       'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],

        // ── TAB: Oferta ──────────────────────────────────────────
        ['key' => 'field_uk_tab_oferta', 'label' => 'Oferta', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_uk_oferta_title',      'label' => 'Tytuł',                          'name' => 'uk_oferta_title',      'type' => 'text',     'default_value' => 'Oferta rozwiązań księgowych'],
        ['key' => 'field_uk_oferta_sub_pre1',   'label' => 'Podtytuł — część 1',             'name' => 'uk_oferta_sub_pre1',   'type' => 'text',     'default_value' => 'Obsługujemy firmy na różnych formach rozliczeń zarówno w'],
        ['key' => 'field_uk_oferta_sub_green1', 'label' => 'Podtytuł — zielona część 1',     'name' => 'uk_oferta_sub_green1', 'type' => 'text',     'default_value' => 'pełnej księgowości (spółki)'],
        ['key' => 'field_uk_oferta_sub_pre2',   'label' => 'Podtytuł — część 2',             'name' => 'uk_oferta_sub_pre2',   'type' => 'text',     'default_value' => ', jak i w'],
        ['key' => 'field_uk_oferta_sub_green2', 'label' => 'Podtytuł — zielona część 2',     'name' => 'uk_oferta_sub_green2', 'type' => 'text',     'default_value' => 'uproszczonych formach ewidencji (np. KPiR)'],
        ['key' => 'field_uk_oferta_sub_note',   'label' => 'Drobny tekst pod podtytułem',    'name' => 'uk_oferta_sub_note',   'type' => 'text',     'default_value' => 'Poniżej pokazujemy przykładowy zakres działań. Jeśli potrzebujesz innej usługi chętnie porozmawiamy.'],
        ['key' => 'field_uk_oferta_items',      'label' => 'Elementy listy (1 linia = 1 kafelek)', 'name' => 'uk_oferta_items', 'type' => 'textarea', 'rows' => 10, 'instructions' => 'Każda linia to oddzielny kafelek w siatce 3-kolumnowej.', 'default_value' => "Prowadzenie ksiąg rachunkowych\nObliczanie podatków i składanie deklaracji podatkowych\nBieżące rozliczanie wyciągów i kontrolowanie rozrachunków\nRaportowanie zarządcze i sprawozdawcze\nRaportowanie do instytucji publicznych\nSporządzanie sprawozdań finansowych oraz deklaracji rocznych\nReprezentowanie podczas kontroli i czynności sprawdzających\nObsługa niestandardowych rozliczeń\nAsystowanie i wsparcie podczas audytu"],
        ['key' => 'field_uk_oferta_btn1_text',  'label' => 'Przycisk 1 — tekst', 'name' => 'uk_oferta_btn1_text', 'type' => 'text', 'default_value' => 'Sprawdź również rozwiązania kadrowe'],
        ['key' => 'field_uk_oferta_btn1_url',   'label' => 'Przycisk 1 — link',  'name' => 'uk_oferta_btn1_url',  'type' => 'text', 'default_value' => '/kadry-i-place/'],
        ['key' => 'field_uk_oferta_btn2_text',  'label' => 'Przycisk 2 — tekst', 'name' => 'uk_oferta_btn2_text', 'type' => 'text', 'default_value' => 'Oszacuj wstępną wycenę'],
        ['key' => 'field_uk_oferta_btn2_url',   'label' => 'Przycisk 2 — link',  'name' => 'uk_oferta_btn2_url',  'type' => 'text', 'default_value' => '/kontakt/'],

        // ── TAB: CTA Banner ──────────────────────────────────────
        ['key' => 'field_uk_tab_cta', 'label' => 'CTA Banner', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_uk_cta_title',    'label' => 'Tytuł',    'name' => 'uk_cta_title',    'type' => 'textarea', 'rows' => 2, 'default_value' => 'Porozmawiajmy o obsłudze księgowej dla Twojej firmy'],
        ['key' => 'field_uk_cta_text',     'label' => 'Tekst',    'name' => 'uk_cta_text',     'type' => 'text',     'default_value' => 'Skontaktuj się z nami i dowiedz się, jak możemy wesprzeć Twoją firmę.'],
        ['key' => 'field_uk_cta_btn_text', 'label' => 'Przycisk — tekst', 'name' => 'uk_cta_btn_text', 'type' => 'text', 'default_value' => 'Umów się na rozmowę'],
        ['key' => 'field_uk_cta_btn_url',  'label' => 'Przycisk — link',  'name' => 'uk_cta_btn_url',  'type' => 'text', 'default_value' => '/kontakt/'],

        // ── TAB: Model współpracy ────────────────────────────────
        ['key' => 'field_uk_tab_model', 'label' => 'Model współpracy', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_uk_model_title',    'label' => 'Tytuł',    'name' => 'uk_model_title',    'type' => 'text',     'default_value' => 'Model współpracy'],
        ['key' => 'field_uk_model_subtitle', 'label' => 'Podtytuł', 'name' => 'uk_model_subtitle', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Możesz powierzyć nam całość procesów księgowych lub wybrane obszary wymagające uporządkowania. Dopasowujemy zakres wsparcia do realnej sytuacji Twojej firmy.'],

        ['key' => 'field_uk_model1', 'label' => 'Karta 1 — Kompleksowa obsługa', 'name' => 'uk_model1', 'type' => 'group', 'layout' => 'table', 'sub_fields' => [
            ['key' => 'field_uk_model1_icon',  'label' => 'Ikona (lucide)', 'name' => 'icon',  'type' => 'text',     'default_value' => 'network'],
            ['key' => 'field_uk_model1_title', 'label' => 'Tytuł',         'name' => 'title', 'type' => 'text',     'default_value' => 'Kompleksowa obsługa'],
            ['key' => 'field_uk_model1_text',  'label' => 'Opis (tył)',     'name' => 'text',  'type' => 'textarea', 'rows' => 3, 'default_value' => 'Obsługujemy proces end-to-end: od bieżącej ewidencji po zamknięcie miesiąca i raporty. Pracujesz z zespołem, który zapewnia zastępowalność i stały standard.'],
        ]],
        ['key' => 'field_uk_model2', 'label' => 'Karta 2 — Outsourcing', 'name' => 'uk_model2', 'type' => 'group', 'layout' => 'table', 'sub_fields' => [
            ['key' => 'field_uk_model2_image', 'label' => 'Zdjęcie tła', 'name' => 'image', 'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],
            ['key' => 'field_uk_model2_title', 'label' => 'Tytuł',       'name' => 'title', 'type' => 'text',     'default_value' => "Outsourcing wybranych\nprocesów"],
            ['key' => 'field_uk_model2_text',  'label' => 'Opis (tył)',   'name' => 'text',  'type' => 'textarea', 'rows' => 3, 'default_value' => 'Przejmujemy konkretne procesy i dowozimy je w ustalonym standardzie i harmonogramie. To rozwiązanie dla firm, które chcą wzmocnić wewnętrzny dział finansów bez rozbudowy etatów.'],
        ]],

        // ── TAB: Jak wygląda współpraca ──────────────────────────
        ['key' => 'field_uk_tab_wsp', 'label' => 'Jak wygląda współpraca', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_uk_wsp_title', 'label' => 'Tytuł sekcji', 'name' => 'uk_wsp_title', 'type' => 'text', 'default_value' => 'Jak wygląda bieżąca współpraca'],

        ['key' => 'field_uk_wsp_step1', 'label' => 'Krok 01', 'name' => 'uk_wsp_step1', 'type' => 'group', 'layout' => 'block', 'sub_fields' => [
            ['key' => 'field_uk_wsp_s1_title', 'label' => 'Tytuł',              'name' => 'title', 'type' => 'text',     'default_value' => 'Indywidualna organizacja pracy'],
            ['key' => 'field_uk_wsp_s1_lead',  'label' => 'Tekst wprowadzający','name' => 'lead',  'type' => 'text',     'default_value' => 'W zależności od potrzeb możemy pracować:'],
            ['key' => 'field_uk_wsp_s1_items', 'label' => 'Punkty (1 linia = 1 punkt)', 'name' => 'items', 'type' => 'textarea', 'rows' => 4, 'default_value' => "na bieżąco – obsługując codzienne procesy księgowe lub kadrowe\nw cyklach tygodniowych\nw innych ustalonych odstępach czasu"],
        ]],
        ['key' => 'field_uk_wsp_step2', 'label' => 'Krok 02', 'name' => 'uk_wsp_step2', 'type' => 'group', 'layout' => 'block', 'sub_fields' => [
            ['key' => 'field_uk_wsp_s2_title', 'label' => 'Tytuł',              'name' => 'title', 'type' => 'text',     'default_value' => 'Elastyczne zamknięcie miesiąca'],
            ['key' => 'field_uk_wsp_s2_lead',  'label' => 'Tekst wprowadzający','name' => 'lead',  'type' => 'textarea', 'rows' => 3, 'default_value' => 'Terminy zamknięcia miesiąca ustalamy indywidualnie z każdą firmą, uwzględniając jej wewnętrzne potrzeby raportowe oraz obowiązujące terminy podatkowe.'],
            ['key' => 'field_uk_wsp_s2_items', 'label' => 'Punkty (1 linia = 1 punkt)', 'name' => 'items', 'type' => 'textarea', 'rows' => 3, 'default_value' => "część firm potrzebuje raportów finansowych do 20. dnia miesiąca\ninne wymagają wyników już w 3. lub 4. dniu roboczym nowego miesiąca"],
        ]],
        ['key' => 'field_uk_wsp_step3', 'label' => 'Krok 03', 'name' => 'uk_wsp_step3', 'type' => 'group', 'layout' => 'block', 'sub_fields' => [
            ['key' => 'field_uk_wsp_s3_title', 'label' => 'Tytuł',              'name' => 'title', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Zakres i częstotliwość raportowania\nustalamy indywidualnie z każdym klientem."],
            ['key' => 'field_uk_wsp_s3_lead',  'label' => 'Tekst wprowadzający','name' => 'lead',  'type' => 'text',     'default_value' => 'W standardzie klient otrzymuje:'],
            ['key' => 'field_uk_wsp_s3_items', 'label' => 'Punkty (1 linia = 1 punkt)', 'name' => 'items', 'type' => 'textarea', 'rows' => 4, 'default_value' => "rachunek zysków i strat\nbilans\nzestawienie należności i zobowiązań"],
            ['key' => 'field_uk_wsp_s3_note',  'label' => 'Tekst pod punktami', 'name' => 'note',  'type' => 'textarea', 'rows' => 2, 'default_value' => 'W zależności od potrzeb przygotowujemy również dodatkowe raporty księgowe, finansowe lub kadrowo-płacowe.'],
        ]],
        ['key' => 'field_uk_wsp_btn_text', 'label' => 'Przycisk — tekst', 'name' => 'uk_wsp_btn_text', 'type' => 'text', 'default_value' => 'Poznaj więcej historii'],
        ['key' => 'field_uk_wsp_btn_url',  'label' => 'Przycisk — link',  'name' => 'uk_wsp_btn_url',  'type' => 'text', 'default_value' => '/blog/'],

        // ── TAB: Dlaczego ────────────────────────────────────────
        ['key' => 'field_uk_tab_dlaczego', 'label' => 'Dlaczego', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_uk_dlaczego_title', 'label' => 'Tytuł sekcji', 'name' => 'uk_dlaczego_title', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Dlaczego firmy wybierają nasze\nrozwiązania księgowe"],

        ['key' => 'field_uk_dlaczego_1', 'label' => 'Karta 1', 'name' => 'uk_dlaczego_1', 'type' => 'group', 'layout' => 'table', 'sub_fields' => [
            ['key' => 'field_uk_dl1_icon',  'label' => 'Ikona',        'name' => 'icon',        'type' => 'text',      'default_value' => 'badge-check'],
            ['key' => 'field_uk_dl1_title', 'label' => 'Tytuł',        'name' => 'title',       'type' => 'text',      'default_value' => "Jakość potwierdzona\nstandardami"],
            ['key' => 'field_uk_dl1_text',  'label' => 'Opis',         'name' => 'text',        'type' => 'textarea',  'rows' => 3, 'default_value' => 'Pracujemy zgodnie z normą ISO 9001 — systematyczne procesy, kontrola jakości i ciągłe doskonalenie usług.'],
            ['key' => 'field_uk_dl1_hl',    'label' => 'Karta zielona?','name' => 'highlighted', 'type' => 'true_false','default_value' => 0, 'ui' => 1],
        ]],
        ['key' => 'field_uk_dlaczego_2', 'label' => 'Karta 2', 'name' => 'uk_dlaczego_2', 'type' => 'group', 'layout' => 'table', 'sub_fields' => [
            ['key' => 'field_uk_dl2_icon',  'label' => 'Ikona',        'name' => 'icon',        'type' => 'text',      'default_value' => 'file-text'],
            ['key' => 'field_uk_dl2_title', 'label' => 'Tytuł',        'name' => 'title',       'type' => 'text',      'default_value' => "Nowoczesne i elastyczne\npodejście"],
            ['key' => 'field_uk_dl2_text',  'label' => 'Opis',         'name' => 'text',        'type' => 'textarea',  'rows' => 3, 'default_value' => 'Dopasowujemy narzędzia i zakres współpracy do realnych potrzeb Twojej firmy – bez zbędnej biurokracji.'],
            ['key' => 'field_uk_dl2_hl',    'label' => 'Karta zielona?','name' => 'highlighted', 'type' => 'true_false','default_value' => 1, 'ui' => 1],
        ]],
        ['key' => 'field_uk_dlaczego_3', 'label' => 'Karta 3', 'name' => 'uk_dlaczego_3', 'type' => 'group', 'layout' => 'table', 'sub_fields' => [
            ['key' => 'field_uk_dl3_icon',  'label' => 'Ikona',        'name' => 'icon',        'type' => 'text',      'default_value' => 'refresh-cw'],
            ['key' => 'field_uk_dl3_title', 'label' => 'Tytuł',        'name' => 'title',       'type' => 'text',      'default_value' => 'Business continuity'],
            ['key' => 'field_uk_dl3_text',  'label' => 'Opis',         'name' => 'text',        'type' => 'textarea',  'rows' => 3, 'default_value' => 'Zespołowy model pracy gwarantuje ciągłość obsługi — urlopy i rotacja pracowników nie wpływają na jakość Twojej księgowości.'],
            ['key' => 'field_uk_dl3_hl',    'label' => 'Karta zielona?','name' => 'highlighted', 'type' => 'true_false','default_value' => 0, 'ui' => 1],
        ]],
        ['key' => 'field_uk_dlaczego_4', 'label' => 'Karta 4', 'name' => 'uk_dlaczego_4', 'type' => 'group', 'layout' => 'table', 'sub_fields' => [
            ['key' => 'field_uk_dl4_icon',  'label' => 'Ikona',        'name' => 'icon',        'type' => 'text',      'default_value' => 'shield-check'],
            ['key' => 'field_uk_dl4_title', 'label' => 'Tytuł',        'name' => 'title',       'type' => 'text',      'default_value' => 'Bezpieczeństwo danych'],
            ['key' => 'field_uk_dl4_text',  'label' => 'Opis',         'name' => 'text',        'type' => 'textarea',  'rows' => 3, 'default_value' => 'Dane klientów chronimy zgodnie z normą ISO 27001 — wdrożone procedury, szyfrowanie i regularne audyty bezpieczeństwa.'],
            ['key' => 'field_uk_dl4_hl',    'label' => 'Karta zielona?','name' => 'highlighted', 'type' => 'true_false','default_value' => 0, 'ui' => 1],
        ]],

        // ── TAB: Kalkulator ──────────────────────────────────────
        ['key' => 'field_uk_tab_kalk', 'label' => 'Kalkulator', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_uk_kalk_title',      'label' => 'Tytuł',      'name' => 'uk_kalk_title',      'type' => 'textarea', 'rows' => 2, 'default_value' => 'Kalkulator – oszacuj wstępnie koszt obsługi'],
        ['key' => 'field_uk_kalk_desc',       'label' => 'Opis',       'name' => 'uk_kalk_desc',       'type' => 'textarea', 'rows' => 3, 'default_value' => 'Oszacuj wstępny koszt usług księgowych w kilka chwil. Wprowadź podstawowe informacje o swojej działalności, a my przygotujemy orientacyjną wycenę dopasowaną do Twoich potrzeb i skali biznesu.'],
        ['key' => 'field_uk_kalk_disclaimer', 'label' => 'Zastrzeżenie pod kalkulatorem', 'name' => 'uk_kalk_disclaimer', 'type' => 'text', 'default_value' => '* to jest wstępny szacunek, każda oferta jest jednak indywidualnie rozpatrywana i odpowiednio wyceniana.'],

        // ── TAB: Historie klientów ───────────────────────────────
        ['key' => 'field_uk_tab_hist', 'label' => 'Historie klientów', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_uk_hist_title',    'label' => 'Tytuł sekcji', 'name' => 'uk_hist_title',    'type' => 'text', 'default_value' => 'Historie naszych klientów'],
        ['key' => 'field_uk_hist_btn_text', 'label' => 'Przycisk — tekst', 'name' => 'uk_hist_btn_text', 'type' => 'text', 'default_value' => 'Poznaj więcej historii'],
        ['key' => 'field_uk_hist_btn_url',  'label' => 'Przycisk — link',  'name' => 'uk_hist_btn_url',  'type' => 'text', 'default_value' => '/blog/'],

        ['key' => 'field_uk_hist_1', 'label' => 'Historia 1', 'name' => 'uk_hist_1', 'type' => 'group', 'layout' => 'block', 'sub_fields' => [
            ['key' => 'field_uk_h1_logo',       'label' => 'Logo klienta',           'name' => 'logo',       'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail'],
            ['key' => 'field_uk_h1_industries', 'label' => 'Branże (1 linia = 1 tag)', 'name' => 'industries', 'type' => 'textarea', 'rows' => 3, 'default_value' => "Geologia inżynierska\nOchrona środowiska"],
            ['key' => 'field_uk_h1_scope',      'label' => 'Zakres współpracy',      'name' => 'scope',      'type' => 'text',     'default_value' => 'Usługi rachunkowe, kadry i płace, wsparcie w procesie audytu'],
            ['key' => 'field_uk_h1_desc',       'label' => 'Opis',                   'name' => 'desc',       'type' => 'textarea', 'rows' => 3, 'default_value' => 'Po kilku zmianach głównej księgowej spółka potrzebowała szybkiego uporządkowania księgowości i bezpiecznego zamknięcia roku obrotowego.'],
            ['key' => 'field_uk_h1_image',      'label' => 'Miniatura (opcjonalna)', 'name' => 'image',      'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium', 'instructions' => 'Jeśli puste — dla YouTube pobierany jest automatyczny podgląd.'],
            ['key' => 'field_uk_h1_video_file', 'label' => 'Wideo — własny plik (mp4/webm)', 'name' => 'video_file', 'type' => 'file', 'return_format' => 'array', 'mime_types' => 'mp4,webm,mov', 'instructions' => 'Ma pierwszeństwo przed linkiem YouTube/Vimeo.'],
            ['key' => 'field_uk_h1_video_url',  'label' => 'Wideo — link YouTube / Vimeo',   'name' => 'video_url',  'type' => 'text', 'instructions' => 'Używane gdy nie wgrano pliku.'],
        ]],
        ['key' => 'field_uk_hist_2', 'label' => 'Historia 2', 'name' => 'uk_hist_2', 'type' => 'group', 'layout' => 'block', 'sub_fields' => [
            ['key' => 'field_uk_h2_logo',       'label' => 'Logo klienta',           'name' => 'logo',       'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail'],
            ['key' => 'field_uk_h2_industries', 'label' => 'Branże (1 linia = 1 tag)', 'name' => 'industries', 'type' => 'textarea', 'rows' => 3, 'default_value' => "E-commerce\nTechnologia"],
            ['key' => 'field_uk_h2_scope',      'label' => 'Zakres współpracy',      'name' => 'scope',      'type' => 'text',     'default_value' => 'Pełna księgowość, raportowanie zarządcze, wsparcie podczas audytu'],
            ['key' => 'field_uk_h2_desc',       'label' => 'Opis',                   'name' => 'desc',       'type' => 'textarea', 'rows' => 3, 'default_value' => 'Dynamicznie rosnąca spółka technologiczna potrzebowała partnera, który zapewni rzetelną sprawozdawczość i gotowość do pozyskania inwestora.'],
            ['key' => 'field_uk_h2_image',      'label' => 'Miniatura (opcjonalna)', 'name' => 'image',      'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],
            ['key' => 'field_uk_h2_video_file', 'label' => 'Wideo — własny plik (mp4/webm)', 'name' => 'video_file', 'type' => 'file', 'return_format' => 'array', 'mime_types' => 'mp4,webm,mov'],
            ['key' => 'field_uk_h2_video_url',  'label' => 'Wideo — link YouTube / Vimeo',   'name' => 'video_url',  'type' => 'text'],
        ]],

        // ── TAB: Systemy księgowe ────────────────────────────────
        ['key' => 'field_uk_tab_sys', 'label' => 'Systemy księgowe', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_uk_sys_title', 'label' => 'Tytuł',  'name' => 'uk_sys_title', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Obsługa wielu systemów\nksiągowych"],
        ['key' => 'field_uk_sys_text',  'label' => 'Tekst',  'name' => 'uk_sys_text',  'type' => 'textarea', 'rows' => 3, 'default_value' => 'Nasz zespół obsługuje wiele systemów księgowych, m.in. Comarch Optima, SAP czy Enova. Współpracę dostosowujemy do istniejących narzędzi i procesów oraz wymagań klienta. Istnieje także możliwość pracy na preferowanych przez klienta programach księgowych.'],
        ['key' => 'field_uk_sys_logo1', 'label' => 'Logo 1', 'name' => 'uk_sys_logo1', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_uk_sys_logo2', 'label' => 'Logo 2', 'name' => 'uk_sys_logo2', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_uk_sys_logo3', 'label' => 'Logo 3', 'name' => 'uk_sys_logo3', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_uk_sys_logo4', 'label' => 'Logo 4', 'name' => 'uk_sys_logo4', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_uk_sys_logo5', 'label' => 'Logo 5', 'name' => 'uk_sys_logo5', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_uk_sys_logo6', 'label' => 'Logo 6', 'name' => 'uk_sys_logo6', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],

    ],
    'location'   => $uk_page_location,
    'menu_order' => 10,
    'position'   => 'normal',
]);

/* ==================================================================
   KADRY I PŁACE
================================================================== */
$kp_page_location = [
    [['param' => 'page_slug',     'operator' => '==', 'value' => 'kadry-i-place']],
    [['param' => 'page_template', 'operator' => '==', 'value' => 'page-kadry-i-place.php']],
];

acf_add_local_field_group([
    'key'    => 'group_mer_kp',
    'title'  => '👥 Kadry i płace',
    'fields' => [

        // ── TAB: Hero ────────────────────────────────────────────
        ['key' => 'field_kp_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_kp_hero_line1',  'label' => 'Nagłówek — linia 1',         'name' => 'kp_hero_title_line1', 'type' => 'text',     'default_value' => 'Kadry i płace, które dają'],
        ['key' => 'field_kp_hero_green',  'label' => 'Nagłówek — zielone słowo',   'name' => 'kp_hero_title_green', 'type' => 'text',     'default_value' => 'spokój'],
        ['key' => 'field_kp_hero_line2',  'label' => 'Nagłówek — linia 2',         'name' => 'kp_hero_title_line2', 'type' => 'text',     'default_value' => 'organizacji'],
        ['key' => 'field_kp_hero_sub',    'label' => 'Podtytuł',                   'name' => 'kp_hero_subtitle',    'type' => 'textarea', 'rows' => 3, 'new_lines' => 'br', 'default_value' => 'Zapewniamy kompleksową obsługę kadrowo-płacową firm o różnej skali działalności. Przejmujemy odpowiedzialność za poprawność, terminowość i ciągłość procesów, aby organizacja mogła działać stabilnie i bez zakłóceń.'],
        ['key' => 'field_kp_hero_b1t',   'label' => 'Przycisk 1 — tekst', 'name' => 'kp_hero_btn1_text', 'type' => 'text', 'default_value' => 'Poznaj ofertę'],
        ['key' => 'field_kp_hero_b1u',   'label' => 'Przycisk 1 — link',  'name' => 'kp_hero_btn1_url',  'type' => 'text', 'default_value' => '#oferta'],
        ['key' => 'field_kp_hero_b2t',   'label' => 'Przycisk 2 — tekst', 'name' => 'kp_hero_btn2_text', 'type' => 'text', 'default_value' => 'Porozmawiajmy'],
        ['key' => 'field_kp_hero_b2u',   'label' => 'Przycisk 2 — link',  'name' => 'kp_hero_btn2_url',  'type' => 'text', 'default_value' => '/kontakt/'],

        // ── TAB: Twoja obsługa ───────────────────────────────────
        ['key' => 'field_kp_tab_obs', 'label' => 'Twoja obsługa', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_kp_obs_title1',      'label' => 'Nagłówek — linia 1',      'name' => 'kp_obs_title1',      'type' => 'text',     'default_value' => 'Twoje kadry'],
        ['key' => 'field_kp_obs_title2',      'label' => 'Nagłówek — linia 2',      'name' => 'kp_obs_title2',      'type' => 'text',     'default_value' => 'i płace'],
        ['key' => 'field_kp_obs_title_green', 'label' => 'Nagłówek — zielona część','name' => 'kp_obs_title_green', 'type' => 'text',     'default_value' => 'pod kontrolą'],
        ['key' => 'field_kp_obs_text1',       'label' => 'Akapit 1',                'name' => 'kp_obs_text1',       'type' => 'textarea', 'rows' => 4, 'default_value' => 'Oferujemy pełną obsługę kadrowo-płacową przedsiębiorstw – od prowadzenia dokumentacji pracowniczej po naliczanie wynagrodzeń i rozliczenia z instytucjami publicznymi. Klienci mogą powierzyć nam całość procesów kadrowych i płacowych lub wybrane obszary wymagające wsparcia.'],
        ['key' => 'field_kp_obs_text2',       'label' => 'Akapit 2 (pogrubiony)',   'name' => 'kp_obs_text2',       'type' => 'textarea', 'rows' => 2, 'default_value' => 'Zakres współpracy dopasowujemy do wielkości i struktury organizacji.'],
        ['key' => 'field_kp_obs_btn_text',    'label' => 'Przycisk — tekst',        'name' => 'kp_obs_btn_text',    'type' => 'text',     'default_value' => 'Oszacuj wstępną wycenę'],
        ['key' => 'field_kp_obs_btn_url',     'label' => 'Przycisk — link',         'name' => 'kp_obs_btn_url',     'type' => 'text',     'default_value' => '#kalkulator'],
        ['key' => 'field_kp_obs_image',       'label' => 'Zdjęcie',                 'name' => 'kp_obs_image',       'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],

        // ── TAB: Oferta ──────────────────────────────────────────
        ['key' => 'field_kp_tab_oferta', 'label' => 'Oferta', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_kp_oferta_title',    'label' => 'Tytuł',    'name' => 'kp_oferta_title',    'type' => 'text',     'default_value' => 'Oferta rozwiązań kadrowych'],
        ['key' => 'field_kp_oferta_subtitle', 'label' => 'Podtytuł', 'name' => 'kp_oferta_subtitle', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Przejmujemy całość lub wybrane obszary, które wymagają uporządkowania i stałego nadzoru.'],
        ['key' => 'field_kp_oferta_items',    'label' => 'Elementy listy (1 linia = 1 kafelek)', 'name' => 'kp_oferta_items', 'type' => 'textarea', 'rows' => 10, 'default_value' => "Prowadzenie dokumentacji kadrowej\nNaliczanie wynagrodzeń i świadczeń\nObsługa umów o pracę i umów cywilnoprawnych\nRozliczenia z ZUS i instytucjami publicznymi\nSporządzanie deklaracji podatkowych\nKontrolowanie limitów urlopowych, terminów badań lekarskich, szkoleń BHP oraz wygasających umów\nReprezentowanie podczas kontroli i czynności sprawdzających\nZarządzanie programami PPK i PPE\nPlatforma pracownicza z dostępem do wniosków urlopowych i dokumentów online"],
        ['key' => 'field_kp_oferta_btn1t',    'label' => 'Przycisk 1 — tekst', 'name' => 'kp_oferta_btn1_text', 'type' => 'text', 'default_value' => 'Wyceń usługę'],
        ['key' => 'field_kp_oferta_btn1u',    'label' => 'Przycisk 1 — link',  'name' => 'kp_oferta_btn1_url',  'type' => 'text', 'default_value' => '#kalkulator'],
        ['key' => 'field_kp_oferta_btn2t',    'label' => 'Przycisk 2 — tekst', 'name' => 'kp_oferta_btn2_text', 'type' => 'text', 'default_value' => 'Sprawdź również rozwiązania księgowe'],
        ['key' => 'field_kp_oferta_btn2u',    'label' => 'Przycisk 2 — link',  'name' => 'kp_oferta_btn2_url',  'type' => 'text', 'default_value' => '/uslugi-ksiegowe/'],

        // ── TAB: CTA Banner ──────────────────────────────────────
        ['key' => 'field_kp_tab_cta', 'label' => 'CTA Banner', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_kp_cta_title',    'label' => 'Tytuł',    'name' => 'kp_cta_title',    'type' => 'textarea', 'rows' => 2, 'default_value' => 'Porozmawiajmy o obsłudze kadrowej dla Twojej firmy'],
        ['key' => 'field_kp_cta_text',     'label' => 'Tekst',    'name' => 'kp_cta_text',     'type' => 'text',     'default_value' => 'Skontaktuj się z nami i dowiedz się, jak możemy wesprzeć Twój dział HR i płac.'],
        ['key' => 'field_kp_cta_btn_text', 'label' => 'Przycisk — tekst', 'name' => 'kp_cta_btn_text', 'type' => 'text', 'default_value' => 'Umów się na rozmowę'],
        ['key' => 'field_kp_cta_btn_url',  'label' => 'Przycisk — link',  'name' => 'kp_cta_btn_url',  'type' => 'text', 'default_value' => '/kontakt/'],

        // ── TAB: Model współpracy ────────────────────────────────
        ['key' => 'field_kp_tab_model', 'label' => 'Model współpracy', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_kp_model_title',    'label' => 'Tytuł',    'name' => 'kp_model_title',    'type' => 'text',     'default_value' => 'Model współpracy'],
        ['key' => 'field_kp_model_subtitle', 'label' => 'Podtytuł', 'name' => 'kp_model_subtitle', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Możesz powierzyć nam całość procesów kadrowych lub wybrane obszary wymagające uporządkowania. Dopasowujemy zakres wsparcia do realnej sytuacji Twojej firmy.'],

        ['key' => 'field_kp_model1', 'label' => 'Karta 1 — Kompleksowa obsługa', 'name' => 'kp_model1', 'type' => 'group', 'layout' => 'block', 'sub_fields' => [
            ['key' => 'field_kp_m1_icon',     'label' => 'Ikona (lucide)', 'name' => 'icon',     'type' => 'text',     'default_value' => 'users-round'],
            ['key' => 'field_kp_m1_title',    'label' => 'Tytuł',         'name' => 'title',    'type' => 'text',     'default_value' => 'Kompleksowa obsługa'],
            ['key' => 'field_kp_m1_text',     'label' => 'Opis (tył)',     'name' => 'text',     'type' => 'textarea', 'rows' => 4, 'default_value' => 'Przejmujemy pełną obsługę kadr i płac: dokumentację pracowniczą, naliczanie wynagrodzeń oraz rozliczenia i zgłoszenia do instytucji (m.in. ZUS). Pracujesz z dedykowanym zespołem i masz pewność terminowości oraz zgodności z przepisami.'],
            ['key' => 'field_kp_m1_btn_text', 'label' => 'Przycisk — tekst', 'name' => 'btn_text', 'type' => 'text', 'default_value' => 'Zobacz'],
            ['key' => 'field_kp_m1_btn_url',  'label' => 'Przycisk — link',  'name' => 'btn_url',  'type' => 'text', 'default_value' => '/kontakt/'],
        ]],
        ['key' => 'field_kp_model2', 'label' => 'Karta 2 — Outsourcing', 'name' => 'kp_model2', 'type' => 'group', 'layout' => 'block', 'sub_fields' => [
            ['key' => 'field_kp_m2_image',    'label' => 'Zdjęcie tła', 'name' => 'image',    'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],
            ['key' => 'field_kp_m2_title',    'label' => 'Tytuł',       'name' => 'title',    'type' => 'text',     'default_value' => "Outsourcing wybranych\nprocesów"],
            ['key' => 'field_kp_m2_text',     'label' => 'Opis (tył)',   'name' => 'text',     'type' => 'textarea', 'rows' => 4, 'default_value' => 'Wspieramy wybrane obszary, które wymagają uporządkowania lub odciążenia zespołu np. same płace, obsługę dokumentacji, rozliczenia z ZUS czy raportowanie. Ustalamy standard i harmonogram działania, a zakres współpracy możesz elastycznie rozszerzać.'],
            ['key' => 'field_kp_m2_btn_text', 'label' => 'Przycisk — tekst', 'name' => 'btn_text', 'type' => 'text', 'default_value' => 'Zobacz'],
            ['key' => 'field_kp_m2_btn_url',  'label' => 'Przycisk — link',  'name' => 'btn_url',  'type' => 'text', 'default_value' => '/kontakt/'],
        ]],

        // ── TAB: Jak wygląda współpraca ──────────────────────────
        ['key' => 'field_kp_tab_wsp', 'label' => 'Jak wygląda współpraca', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_kp_wsp_title', 'label' => 'Tytuł sekcji', 'name' => 'kp_wsp_title', 'type' => 'text', 'default_value' => 'Jak wygląda bieżąca współpraca'],
        ['key' => 'field_kp_wsp_step1', 'label' => 'Krok 01', 'name' => 'kp_wsp_step1', 'type' => 'group', 'layout' => 'block', 'sub_fields' => [
            ['key' => 'field_kp_s1_title', 'label' => 'Tytuł',  'name' => 'title', 'type' => 'text',     'default_value' => 'Indywidualna organizacja pracy'],
            ['key' => 'field_kp_s1_lead',  'label' => 'Lead',   'name' => 'lead',  'type' => 'text',     'default_value' => 'W zależności od potrzeb możemy pracować:'],
            ['key' => 'field_kp_s1_items', 'label' => 'Punkty', 'name' => 'items', 'type' => 'textarea', 'rows' => 4, 'default_value' => "na bieżąco – obsługując codzienne procesy kadrowe i płacowe\nw cyklach tygodniowych\nw innych ustalonych odstępach czasu"],
        ]],
        ['key' => 'field_kp_wsp_step2', 'label' => 'Krok 02', 'name' => 'kp_wsp_step2', 'type' => 'group', 'layout' => 'block', 'sub_fields' => [
            ['key' => 'field_kp_s2_title', 'label' => 'Tytuł',  'name' => 'title', 'type' => 'text',     'default_value' => 'Terminowe naliczanie wynagrodzeń'],
            ['key' => 'field_kp_s2_lead',  'label' => 'Lead',   'name' => 'lead',  'type' => 'textarea', 'rows' => 3, 'default_value' => 'Terminy przetwarzania listy płac ustalamy indywidualnie z każdą firmą, uwzględniając jej wewnętrzny harmonogram wypłat oraz terminy rozliczeń z ZUS i US.'],
            ['key' => 'field_kp_s2_items', 'label' => 'Punkty', 'name' => 'items', 'type' => 'textarea', 'rows' => 3, 'default_value' => "listy płac gotowe z odpowiednim wyprzedzeniem przed dniem wypłaty\nterminowe przelewy składek ZUS i zaliczek PIT"],
        ]],
        ['key' => 'field_kp_wsp_step3', 'label' => 'Krok 03', 'name' => 'kp_wsp_step3', 'type' => 'group', 'layout' => 'block', 'sub_fields' => [
            ['key' => 'field_kp_s3_title', 'label' => 'Tytuł',          'name' => 'title', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Zakres raportowania ustalamy\nindywidualnie z każdym klientem."],
            ['key' => 'field_kp_s3_lead',  'label' => 'Lead',           'name' => 'lead',  'type' => 'text',     'default_value' => 'W standardzie klient otrzymuje:'],
            ['key' => 'field_kp_s3_items', 'label' => 'Punkty',         'name' => 'items', 'type' => 'textarea', 'rows' => 4, 'default_value' => "zestawienie listy płac\npaski wynagrodzeń dla pracowników\npotwierdzenia rozliczeń ZUS i US"],
            ['key' => 'field_kp_s3_note',  'label' => 'Tekst pod punktami', 'name' => 'note', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'W zależności od potrzeb przygotowujemy również dodatkowe raporty kadrowe, płacowe i zarządcze.'],
        ]],
        ['key' => 'field_kp_wsp_btn_text', 'label' => 'Przycisk — tekst', 'name' => 'kp_wsp_btn_text', 'type' => 'text', 'default_value' => 'Poznaj więcej historii'],
        ['key' => 'field_kp_wsp_btn_url',  'label' => 'Przycisk — link',  'name' => 'kp_wsp_btn_url',  'type' => 'text', 'default_value' => '/blog/'],

        // ── TAB: Dlaczego ────────────────────────────────────────
        ['key' => 'field_kp_tab_dlaczego', 'label' => 'Dlaczego', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_kp_dlaczego_title', 'label' => 'Tytuł sekcji', 'name' => 'kp_dlaczego_title', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Dlaczego firmy wybierają nasze\nrozwiązania kadrowe"],

        ['key' => 'field_kp_dlaczego_1', 'label' => 'Karta 1', 'name' => 'kp_dlaczego_1', 'type' => 'group', 'layout' => 'table', 'sub_fields' => [
            ['key' => 'field_kp_dl1_icon',  'label' => 'Ikona', 'name' => 'icon',  'type' => 'text',     'default_value' => 'award'],
            ['key' => 'field_kp_dl1_title', 'label' => 'Tytuł', 'name' => 'title', 'type' => 'text',     'default_value' => "Jakość potwierdzona\nstandardami"],
            ['key' => 'field_kp_dl1_text',  'label' => 'Opis',  'name' => 'text',  'type' => 'textarea', 'rows' => 3, 'default_value' => 'Realizujemy usługi w oparciu o certyfikat ISO 9001'],
        ]],
        ['key' => 'field_kp_dlaczego_2', 'label' => 'Karta 2', 'name' => 'kp_dlaczego_2', 'type' => 'group', 'layout' => 'table', 'sub_fields' => [
            ['key' => 'field_kp_dl2_icon',  'label' => 'Ikona', 'name' => 'icon',  'type' => 'text',     'default_value' => 'file-text'],
            ['key' => 'field_kp_dl2_title', 'label' => 'Tytuł', 'name' => 'title', 'type' => 'text',     'default_value' => "Nowoczesne i elastyczne\npodejście"],
            ['key' => 'field_kp_dl2_text',  'label' => 'Opis',  'name' => 'text',  'type' => 'textarea', 'rows' => 3, 'default_value' => 'Przygotowujemy raporty finansowe dopasowane do potrzeb zarządu i wspierające podejmowanie decyzji biznesowych.'],
        ]],
        ['key' => 'field_kp_dlaczego_3', 'label' => 'Karta 3', 'name' => 'kp_dlaczego_3', 'type' => 'group', 'layout' => 'table', 'sub_fields' => [
            ['key' => 'field_kp_dl3_icon',  'label' => 'Ikona', 'name' => 'icon',  'type' => 'text',     'default_value' => 'shield-check'],
            ['key' => 'field_kp_dl3_title', 'label' => 'Tytuł', 'name' => 'title', 'type' => 'text',     'default_value' => 'Bezpieczeństwo danych'],
            ['key' => 'field_kp_dl3_text',  'label' => 'Opis',  'name' => 'text',  'type' => 'textarea', 'rows' => 3, 'default_value' => 'Stosujemy rozwiązania zgodne z normą ISO/IEC 27001, zapewniające poufność, integralność i bezpieczeństwo danych pracowniczych.'],
        ]],
        ['key' => 'field_kp_dlaczego_4', 'label' => 'Karta 4', 'name' => 'kp_dlaczego_4', 'type' => 'group', 'layout' => 'table', 'sub_fields' => [
            ['key' => 'field_kp_dl4_icon',  'label' => 'Ikona', 'name' => 'icon',  'type' => 'text',     'default_value' => 'refresh-cw'],
            ['key' => 'field_kp_dl4_title', 'label' => 'Tytuł', 'name' => 'title', 'type' => 'text',     'default_value' => 'Business continuity'],
            ['key' => 'field_kp_dl4_text',  'label' => 'Opis',  'name' => 'text',  'type' => 'textarea', 'rows' => 3, 'default_value' => 'Usługi realizuje cały zespół specjalistów, dlatego urlopy i rotacja pracowników nie wpływają na terminowość i ciągłość obsługi Twojej firmy.'],
        ]],

        // ── TAB: Kalkulator ──────────────────────────────────────
        ['key' => 'field_kp_tab_kalk', 'label' => 'Kalkulator', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_kp_kalk_title',      'label' => 'Tytuł',        'name' => 'kp_kalk_title',       'type' => 'textarea', 'rows' => 2, 'default_value' => 'Kalkulator – oszacuj wstępnie koszt obsługi'],
        ['key' => 'field_kp_kalk_desc',       'label' => 'Opis',         'name' => 'kp_kalk_desc',        'type' => 'textarea', 'rows' => 3, 'default_value' => 'Oszacuj wstępny koszt obsługi kadrowo-płacowej w kilka chwil. Wprowadź podstawowe informacje o swojej działalności, a my przygotujemy orientacyjną wycenę dopasowaną do Twoich potrzeb i skali zatrudnienia.'],
        ['key' => 'field_kp_kalk_disclaimer', 'label' => 'Zastrzeżenie', 'name' => 'kp_kalk_disclaimer', 'type' => 'text',     'default_value' => '* to jest wstępny szacunek, każda oferta jest jednak indywidualnie rozpatrywana i odpowiednio wyceniana.'],
        ['key' => 'field_kp_kalk_rate_kp',    'label' => 'Stawka: Kadry i płace (zł/os/wypłatę)', 'name' => 'kp_kalk_rate_kp',  'type' => 'number', 'default_value' => 75, 'min' => 0],
        ['key' => 'field_kp_kalk_rate_k',     'label' => 'Stawka: Same kadry (zł/os/wypłatę)',    'name' => 'kp_kalk_rate_k',   'type' => 'number', 'default_value' => 52, 'min' => 0],
        ['key' => 'field_kp_kalk_rate_p',     'label' => 'Stawka: Same płace (zł/os/wypłatę)',    'name' => 'kp_kalk_rate_p',   'type' => 'number', 'default_value' => 52, 'min' => 0],
        ['key' => 'field_kp_kalk_rate_sub',   'label' => 'Stawka: Podwykonawcy (zł/os/wypłatę)',  'name' => 'kp_kalk_rate_sub', 'type' => 'number', 'default_value' => 42, 'min' => 0],

        // ── TAB: Historie klientów ───────────────────────────────
        ['key' => 'field_kp_tab_hist', 'label' => 'Historie klientów', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_kp_hist_title',    'label' => 'Tytuł sekcji',   'name' => 'kp_hist_title',    'type' => 'text', 'default_value' => 'Historie naszych klientów'],
        ['key' => 'field_kp_hist_btn_text', 'label' => 'Przycisk — tekst', 'name' => 'kp_hist_btn_text', 'type' => 'text', 'default_value' => 'Poznaj więcej historii'],
        ['key' => 'field_kp_hist_btn_url',  'label' => 'Przycisk — link',  'name' => 'kp_hist_btn_url',  'type' => 'text', 'default_value' => '/blog/'],

        ['key' => 'field_kp_hist_1', 'label' => 'Historia 1', 'name' => 'kp_hist_1', 'type' => 'group', 'layout' => 'block', 'sub_fields' => [
            ['key' => 'field_kp_h1_logo',       'label' => 'Logo klienta',          'name' => 'logo',       'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail'],
            ['key' => 'field_kp_h1_industries', 'label' => 'Branże (1 linia = 1 tag)', 'name' => 'industries', 'type' => 'textarea', 'rows' => 3, 'default_value' => "Geologia inżynierska\nOchrona środowiska"],
            ['key' => 'field_kp_h1_scope',      'label' => 'Zakres współpracy',     'name' => 'scope',      'type' => 'text',     'default_value' => 'Kadry i płace, wsparcie w procesie audytu kadrowego'],
            ['key' => 'field_kp_h1_desc',       'label' => 'Opis',                  'name' => 'desc',       'type' => 'textarea', 'rows' => 3, 'default_value' => 'Po kilku zmianach w dziale HR spółka potrzebowała szybkiego uporządkowania dokumentacji kadrowej i bezpiecznego zamknięcia roku.'],
            ['key' => 'field_kp_h1_image',      'label' => 'Miniatura (opcjonalna)','name' => 'image',      'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],
            ['key' => 'field_kp_h1_video_file', 'label' => 'Wideo — własny plik',   'name' => 'video_file', 'type' => 'file',     'return_format' => 'array', 'mime_types' => 'mp4,webm,mov'],
            ['key' => 'field_kp_h1_video_url',  'label' => 'Wideo — YouTube/Vimeo', 'name' => 'video_url',  'type' => 'text'],
        ]],
        ['key' => 'field_kp_hist_2', 'label' => 'Historia 2', 'name' => 'kp_hist_2', 'type' => 'group', 'layout' => 'block', 'sub_fields' => [
            ['key' => 'field_kp_h2_logo',       'label' => 'Logo klienta',          'name' => 'logo',       'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail'],
            ['key' => 'field_kp_h2_industries', 'label' => 'Branże (1 linia = 1 tag)', 'name' => 'industries', 'type' => 'textarea', 'rows' => 3, 'default_value' => "E-commerce\nTechnologia"],
            ['key' => 'field_kp_h2_scope',      'label' => 'Zakres współpracy',     'name' => 'scope',      'type' => 'text',     'default_value' => 'Pełna obsługa kadrowo-płacowa, raportowanie HR, wsparcie podczas audytu'],
            ['key' => 'field_kp_h2_desc',       'label' => 'Opis',                  'name' => 'desc',       'type' => 'textarea', 'rows' => 3, 'default_value' => 'Dynamicznie rosnąca spółka technologiczna potrzebowała partnera, który zapewni sprawne naliczanie płac i gotowość dokumentacyjną na każdym etapie wzrostu.'],
            ['key' => 'field_kp_h2_image',      'label' => 'Miniatura (opcjonalna)','name' => 'image',      'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],
            ['key' => 'field_kp_h2_video_file', 'label' => 'Wideo — własny plik',   'name' => 'video_file', 'type' => 'file',     'return_format' => 'array', 'mime_types' => 'mp4,webm,mov'],
            ['key' => 'field_kp_h2_video_url',  'label' => 'Wideo — YouTube/Vimeo', 'name' => 'video_url',  'type' => 'text'],
        ]],

        // ── TAB: Systemy ─────────────────────────────────────────
        ['key' => 'field_kp_tab_sys', 'label' => 'Systemy', 'name' => '', 'type' => 'tab'],

        ['key' => 'field_kp_sys_title', 'label' => 'Tytuł', 'name' => 'kp_sys_title', 'type' => 'textarea', 'rows' => 2, 'default_value' => "Obsługa wielu systemów\nksiągowych"],
        ['key' => 'field_kp_sys_text',  'label' => 'Tekst', 'name' => 'kp_sys_text',  'type' => 'textarea', 'rows' => 3, 'default_value' => 'Nasz zespół obsługuje wiele systemów księgowych, m.in. Comarch Optima, SAP czy Enova. Współpracę dostosowujemy do istniejących narzędzi i procesów oraz wymagań klienta. Istnieje także możliwość pracy na preferowanych przez klienta programach księgowych.'],
        ['key' => 'field_kp_sys_logo1', 'label' => 'Logo 1', 'name' => 'kp_sys_logo1', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_kp_sys_logo2', 'label' => 'Logo 2', 'name' => 'kp_sys_logo2', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_kp_sys_logo3', 'label' => 'Logo 3', 'name' => 'kp_sys_logo3', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_kp_sys_logo4', 'label' => 'Logo 4', 'name' => 'kp_sys_logo4', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_kp_sys_logo5', 'label' => 'Logo 5', 'name' => 'kp_sys_logo5', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_kp_sys_logo6', 'label' => 'Logo 6', 'name' => 'kp_sys_logo6', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],

    ],
    'location'   => $kp_page_location,
    'menu_order' => 10,
    'position'   => 'normal',
]);

/* ==================================================================
   KARIERA
================================================================== */
$kar_page_location = [
    [['param' => 'page_slug',     'operator' => '==', 'value' => 'kariera']],
    [['param' => 'page_template', 'operator' => '==', 'value' => 'page-kariera.php']],
];

acf_add_local_field_group([
    'key'   => 'group_mer_kariera',
    'title' => '💼 Kariera',
    'fields' => [

        // ── HERO ──────────────────────────────────────────────────────
        ['key' => 'field_kar_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_kar_hero_bg',       'label' => 'Zdjęcie tła',   'name' => 'kar_hero_bg',       'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],
        ['key' => 'field_kar_hero_title',    'label' => 'Tytuł',         'name' => 'kar_hero_title',    'type' => 'textarea', 'rows' => 2, 'default_value' => "Dołącz do\nnaszego zespołu"],
        ['key' => 'field_kar_hero_text',     'label' => 'Opis',          'name' => 'kar_hero_text',     'type' => 'textarea', 'rows' => 3, 'new_lines' => 'br', 'default_value' => "Budujemy uporządkowane procesy i dobrą atmosferę.\nJeśli cenisz jasne zasady, rozwój i pracę zespołową – sprawdź,\nczy mamy ofertę dla Ciebie."],
        ['key' => 'field_kar_hero_btn_text', 'label' => 'Tekst przycisku', 'name' => 'kar_hero_btn_text', 'type' => 'text', 'default_value' => 'Aktualne oferty pracy'],
        ['key' => 'field_kar_hero_btn_url',  'label' => 'Link przycisku',  'name' => 'kar_hero_btn_url',  'type' => 'text', 'default_value' => '#oferty'],

        // ── JAKOŚĆ ────────────────────────────────────────────────────
        ['key' => 'field_kar_tab_jakosc', 'label' => 'Twórz z nami jakość', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_kar_jakosc_title', 'label' => 'Tytuł',          'name' => 'kar_jakosc_title', 'type' => 'text',     'default_value' => 'Twórz z nami jakość'],
        ['key' => 'field_kar_jakosc_green', 'label' => 'Tekst zielony',  'name' => 'kar_jakosc_green', 'type' => 'text',     'default_value' => '#Meritoros'],
        ['key' => 'field_kar_jakosc_text1', 'label' => 'Akapit 1',       'name' => 'kar_jakosc_text1', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'W Meritoros wspieramy firmy w księgowości, kadrach i płacach oraz procesach back-office od 2004 roku. Pracujemy tak, żeby być dumni z jakości informacji, które dostarczamy.'],
        ['key' => 'field_kar_jakosc_text2', 'label' => 'Akapit 2',       'name' => 'kar_jakosc_text2', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Jednocześnie wiemy, że dobre wyniki robią ludzie: dbamy o partnerską współpracę, szacunek i realne wsparcie w zespole. Pracujemy w zadaniowym z elastycznością, która działa wtedy, gdy idzie w parze z odpowiedzialnością i dotrzymywaniem ustaleń.'],
        ['key' => 'field_kar_jakosc_img1',  'label' => 'Slider – zdjęcie 1', 'name' => 'kar_jakosc_img1', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_kar_jakosc_img2',  'label' => 'Slider – zdjęcie 2', 'name' => 'kar_jakosc_img2', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_kar_jakosc_img3',  'label' => 'Slider – zdjęcie 3', 'name' => 'kar_jakosc_img3', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_kar_jakosc_img4',  'label' => 'Slider – zdjęcie 4', 'name' => 'kar_jakosc_img4', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_kar_jakosc_card1', 'label' => 'Karta wartości 1', 'name' => 'kar_jakosc_card1', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_jc1_icon', 'label' => 'Ikona (lucide)', 'name' => 'icon', 'type' => 'text', 'default_value' => 'award'],
            ['key' => 'field_kar_jc1_text', 'label' => 'Tekst',          'name' => 'text', 'type' => 'text', 'default_value' => 'Jakość i standard'],
        ]],
        ['key' => 'field_kar_jakosc_card2', 'label' => 'Karta wartości 2', 'name' => 'kar_jakosc_card2', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_jc2_icon', 'label' => 'Ikona (lucide)', 'name' => 'icon', 'type' => 'text', 'default_value' => 'handshake'],
            ['key' => 'field_kar_jc2_text', 'label' => 'Tekst',          'name' => 'text', 'type' => 'text', 'default_value' => 'Szacunek i współpraca'],
        ]],
        ['key' => 'field_kar_jakosc_card3', 'label' => 'Karta wartości 3', 'name' => 'kar_jakosc_card3', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_jc3_icon', 'label' => 'Ikona (lucide)', 'name' => 'icon', 'type' => 'text', 'default_value' => 'users-round'],
            ['key' => 'field_kar_jc3_text', 'label' => 'Tekst',          'name' => 'text', 'type' => 'text', 'default_value' => 'Elastyczność i odpowiedzialność'],
        ]],

        // ── DLACZEGO ──────────────────────────────────────────────────
        ['key' => 'field_kar_tab_dlaczego', 'label' => 'Dlaczego warto', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_kar_dlaczego_title', 'label' => 'Tytuł', 'name' => 'kar_dlaczego_title', 'type' => 'text', 'default_value' => 'Dlaczego warto do nas dołączyć?'],
        ['key' => 'field_kar_dlaczego_1', 'label' => 'Karta 1', 'name' => 'kar_dlaczego_1', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_d1_title', 'label' => 'Tytuł',   'name' => 'title', 'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_kar_d1_text',  'label' => 'Tekst',   'name' => 'text',  'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_kar_d1_tag',   'label' => 'Tag',     'name' => 'tag',   'type' => 'text'],
            ['key' => 'field_kar_d1_image', 'label' => 'Zdjęcie', 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ]],
        ['key' => 'field_kar_dlaczego_2', 'label' => 'Karta 2', 'name' => 'kar_dlaczego_2', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_d2_title', 'label' => 'Tytuł',   'name' => 'title', 'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_kar_d2_text',  'label' => 'Tekst',   'name' => 'text',  'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_kar_d2_tag',   'label' => 'Tag',     'name' => 'tag',   'type' => 'text'],
            ['key' => 'field_kar_d2_image', 'label' => 'Zdjęcie', 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ]],
        ['key' => 'field_kar_dlaczego_3', 'label' => 'Karta 3', 'name' => 'kar_dlaczego_3', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_d3_title', 'label' => 'Tytuł',   'name' => 'title', 'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_kar_d3_text',  'label' => 'Tekst',   'name' => 'text',  'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_kar_d3_tag',   'label' => 'Tag',     'name' => 'tag',   'type' => 'text'],
            ['key' => 'field_kar_d3_image', 'label' => 'Zdjęcie', 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ]],
        ['key' => 'field_kar_dlaczego_4', 'label' => 'Karta 4', 'name' => 'kar_dlaczego_4', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_d4_title', 'label' => 'Tytuł',   'name' => 'title', 'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_kar_d4_text',  'label' => 'Tekst',   'name' => 'text',  'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_kar_d4_tag',   'label' => 'Tag',     'name' => 'tag',   'type' => 'text'],
            ['key' => 'field_kar_d4_image', 'label' => 'Zdjęcie', 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ]],

        // ── BENEFITY ──────────────────────────────────────────────────
        ['key' => 'field_kar_tab_ben', 'label' => 'Benefity', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_kar_ben_title', 'label' => 'Tytuł sekcji', 'name' => 'kar_ben_title', 'type' => 'text', 'default_value' => 'Nasze benefity'],
        ['key' => 'field_kar_ben_1', 'label' => 'Benefit 1', 'name' => 'kar_ben_1', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_b1_icon',  'label' => 'Ikona (nazwa Lucide, np. clock)',  'name' => 'icon',  'type' => 'text', 'default_value' => 'clock'],
            ['key' => 'field_kar_b1_image', 'label' => 'Własna ikonka (zastępuje pole Ikona)', 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
            ['key' => 'field_kar_b1_title', 'label' => 'Tytuł (bold)','name' => 'title', 'type' => 'text'],
            ['key' => 'field_kar_b1_text',  'label' => 'Opis drobny', 'name' => 'text',  'type' => 'text'],
        ]],
        ['key' => 'field_kar_ben_2', 'label' => 'Benefit 2', 'name' => 'kar_ben_2', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_b2_icon',  'label' => 'Ikona (nazwa Lucide, np. dumbbell)', 'name' => 'icon',  'type' => 'text', 'default_value' => 'dumbbell'],
            ['key' => 'field_kar_b2_image', 'label' => 'Własna ikonka (zastępuje pole Ikona)', 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
            ['key' => 'field_kar_b2_title', 'label' => 'Tytuł (bold)','name' => 'title', 'type' => 'text'],
            ['key' => 'field_kar_b2_text',  'label' => 'Opis drobny', 'name' => 'text',  'type' => 'text'],
        ]],
        ['key' => 'field_kar_ben_3', 'label' => 'Benefit 3', 'name' => 'kar_ben_3', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_b3_icon',  'label' => 'Ikona (nazwa Lucide, np. heart-pulse)', 'name' => 'icon',  'type' => 'text', 'default_value' => 'heart-pulse'],
            ['key' => 'field_kar_b3_image', 'label' => 'Własna ikonka (zastępuje pole Ikona)', 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
            ['key' => 'field_kar_b3_title', 'label' => 'Tytuł (bold)','name' => 'title', 'type' => 'text'],
            ['key' => 'field_kar_b3_text',  'label' => 'Opis drobny', 'name' => 'text',  'type' => 'text'],
        ]],
        ['key' => 'field_kar_ben_4', 'label' => 'Benefit 4', 'name' => 'kar_ben_4', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_b4_icon',  'label' => 'Ikona (nazwa Lucide, np. sun)', 'name' => 'icon',  'type' => 'text', 'default_value' => 'sun'],
            ['key' => 'field_kar_b4_image', 'label' => 'Własna ikonka (zastępuje pole Ikona)', 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
            ['key' => 'field_kar_b4_title', 'label' => 'Tytuł (bold)','name' => 'title', 'type' => 'text'],
            ['key' => 'field_kar_b4_text',  'label' => 'Opis drobny', 'name' => 'text',  'type' => 'text'],
        ]],
        ['key' => 'field_kar_ben_5', 'label' => 'Benefit 5', 'name' => 'kar_ben_5', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_b5_icon',  'label' => 'Ikona (nazwa Lucide, np. presentation)', 'name' => 'icon',  'type' => 'text', 'default_value' => 'presentation'],
            ['key' => 'field_kar_b5_image', 'label' => 'Własna ikonka (zastępuje pole Ikona)', 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
            ['key' => 'field_kar_b5_title', 'label' => 'Tytuł (bold)','name' => 'title', 'type' => 'text'],
            ['key' => 'field_kar_b5_text',  'label' => 'Opis drobny', 'name' => 'text',  'type' => 'text'],
        ]],
        ['key' => 'field_kar_ben_6', 'label' => 'Benefit 6', 'name' => 'kar_ben_6', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_b6_icon',  'label' => 'Ikona (nazwa Lucide, np. wallet)', 'name' => 'icon',  'type' => 'text', 'default_value' => 'wallet'],
            ['key' => 'field_kar_b6_image', 'label' => 'Własna ikonka (zastępuje pole Ikona)', 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
            ['key' => 'field_kar_b6_title', 'label' => 'Tytuł (bold)','name' => 'title', 'type' => 'text'],
            ['key' => 'field_kar_b6_text',  'label' => 'Opis drobny', 'name' => 'text',  'type' => 'text'],
        ]],
        ['key' => 'field_kar_ben_7', 'label' => 'Benefit 7', 'name' => 'kar_ben_7', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_b7_icon',  'label' => 'Ikona (nazwa Lucide, np. languages)', 'name' => 'icon',  'type' => 'text', 'default_value' => 'languages'],
            ['key' => 'field_kar_b7_image', 'label' => 'Własna ikonka (zastępuje pole Ikona)', 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
            ['key' => 'field_kar_b7_title', 'label' => 'Tytuł (bold)','name' => 'title', 'type' => 'text'],
            ['key' => 'field_kar_b7_text',  'label' => 'Opis drobny', 'name' => 'text',  'type' => 'text'],
        ]],
        ['key' => 'field_kar_ben_8', 'label' => 'Benefit 8', 'name' => 'kar_ben_8', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_b8_icon',  'label' => 'Ikona (nazwa Lucide, np. heart-handshake)', 'name' => 'icon',  'type' => 'text', 'default_value' => 'heart-handshake'],
            ['key' => 'field_kar_b8_image', 'label' => 'Własna ikonka (zastępuje pole Ikona)', 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
            ['key' => 'field_kar_b8_title', 'label' => 'Tytuł (bold)','name' => 'title', 'type' => 'text'],
            ['key' => 'field_kar_b8_text',  'label' => 'Opis drobny', 'name' => 'text',  'type' => 'text'],
        ]],

        // ── OFERTY PRACY ──────────────────────────────────────────────
        ['key' => 'field_kar_tab_oferty', 'label' => 'Oferty pracy', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_kar_oferty_title', 'label' => 'Tytuł sekcji', 'name' => 'kar_oferty_title', 'type' => 'text', 'default_value' => 'Aktualne oferty'],
        ['key' => 'field_kar_oferta_1', 'label' => 'Oferta 1', 'name' => 'kar_oferta_1', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_o1_title',   'label' => 'Stanowisko', 'name' => 'title',  'type' => 'text'],
            ['key' => 'field_kar_o1_salary',  'label' => 'Wynagrodzenie / lokalizacja', 'name' => 'salary', 'type' => 'text'],
            ['key' => 'field_kar_o1_cat',     'label' => 'Kategoria (ksiegowosc / kadry / it / inne / praktyki)', 'name' => 'cat', 'type' => 'text'],
            ['key' => 'field_kar_o1_traffit', 'label' => 'Link do oferty w Traffit (przycisk "Aplikuj teraz")', 'name' => 'traffit_url', 'type' => 'url'],
            ['key' => 'field_kar_o1_url',     'label' => 'Link do szczegółów oferty (opcjonalnie)', 'name' => 'url', 'type' => 'url'],
        ]],
        ['key' => 'field_kar_oferta_2', 'label' => 'Oferta 2', 'name' => 'kar_oferta_2', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_o2_title',   'label' => 'Stanowisko', 'name' => 'title',  'type' => 'text'],
            ['key' => 'field_kar_o2_salary',  'label' => 'Wynagrodzenie / lokalizacja', 'name' => 'salary', 'type' => 'text'],
            ['key' => 'field_kar_o2_cat',     'label' => 'Kategoria', 'name' => 'cat', 'type' => 'text'],
            ['key' => 'field_kar_o2_traffit', 'label' => 'Link do oferty w Traffit (przycisk "Aplikuj teraz")', 'name' => 'traffit_url', 'type' => 'url'],
            ['key' => 'field_kar_o2_url',     'label' => 'Link do szczegółów oferty (opcjonalnie)', 'name' => 'url', 'type' => 'url'],
        ]],
        ['key' => 'field_kar_oferta_3', 'label' => 'Oferta 3', 'name' => 'kar_oferta_3', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_o3_title',   'label' => 'Stanowisko', 'name' => 'title',  'type' => 'text'],
            ['key' => 'field_kar_o3_salary',  'label' => 'Wynagrodzenie / lokalizacja', 'name' => 'salary', 'type' => 'text'],
            ['key' => 'field_kar_o3_cat',     'label' => 'Kategoria', 'name' => 'cat', 'type' => 'text'],
            ['key' => 'field_kar_o3_traffit', 'label' => 'Link do oferty w Traffit (przycisk "Aplikuj teraz")', 'name' => 'traffit_url', 'type' => 'url'],
            ['key' => 'field_kar_o3_url',     'label' => 'Link do szczegółów oferty (opcjonalnie)', 'name' => 'url', 'type' => 'url'],
        ]],
        ['key' => 'field_kar_oferta_4', 'label' => 'Oferta 4', 'name' => 'kar_oferta_4', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_o4_title',   'label' => 'Stanowisko', 'name' => 'title',  'type' => 'text'],
            ['key' => 'field_kar_o4_salary',  'label' => 'Wynagrodzenie / lokalizacja', 'name' => 'salary', 'type' => 'text'],
            ['key' => 'field_kar_o4_cat',     'label' => 'Kategoria', 'name' => 'cat', 'type' => 'text'],
            ['key' => 'field_kar_o4_traffit', 'label' => 'Link do oferty w Traffit (przycisk "Aplikuj teraz")', 'name' => 'traffit_url', 'type' => 'url'],
            ['key' => 'field_kar_o4_url',     'label' => 'Link do szczegółów oferty (opcjonalnie)', 'name' => 'url', 'type' => 'url'],
        ]],
        ['key' => 'field_kar_oferta_5', 'label' => 'Oferta 5', 'name' => 'kar_oferta_5', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_o5_title',   'label' => 'Stanowisko', 'name' => 'title',  'type' => 'text'],
            ['key' => 'field_kar_o5_salary',  'label' => 'Wynagrodzenie / lokalizacja', 'name' => 'salary', 'type' => 'text'],
            ['key' => 'field_kar_o5_cat',     'label' => 'Kategoria', 'name' => 'cat', 'type' => 'text'],
            ['key' => 'field_kar_o5_traffit', 'label' => 'Link do oferty w Traffit (przycisk "Aplikuj teraz")', 'name' => 'traffit_url', 'type' => 'url'],
            ['key' => 'field_kar_o5_url',     'label' => 'Link do szczegółów oferty (opcjonalnie)', 'name' => 'url', 'type' => 'url'],
        ]],
        ['key' => 'field_kar_oferta_6', 'label' => 'Oferta 6', 'name' => 'kar_oferta_6', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_o6_title',   'label' => 'Stanowisko', 'name' => 'title',  'type' => 'text'],
            ['key' => 'field_kar_o6_salary',  'label' => 'Wynagrodzenie / lokalizacja', 'name' => 'salary', 'type' => 'text'],
            ['key' => 'field_kar_o6_cat',     'label' => 'Kategoria', 'name' => 'cat', 'type' => 'text'],
            ['key' => 'field_kar_o6_traffit', 'label' => 'Link do oferty w Traffit (przycisk "Aplikuj teraz")', 'name' => 'traffit_url', 'type' => 'url'],
            ['key' => 'field_kar_o6_url',     'label' => 'Link do szczegółów oferty (opcjonalnie)', 'name' => 'url', 'type' => 'url'],
        ]],

        // ── FORMULARZ CV ──────────────────────────────────────────────
        ['key' => 'field_kar_tab_cv', 'label' => 'Formularz CV', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_kar_cv_title',       'label' => 'Tytuł',          'name' => 'kar_cv_title',       'type' => 'textarea', 'rows' => 2, 'default_value' => "Chcesz do nas dołączyć?\nZostaw swoje CV"],
        ['key' => 'field_kar_cv_rodo',        'label' => 'Treść RODO',     'name' => 'kar_cv_rodo',        'type' => 'textarea', 'rows' => 3, 'default_value' => 'Wyrażam zgodę na przetwarzanie moich danych osobowych przez Meritoros SA w celu przeprowadzenia procesu rekrutacji, zgodnie z obowiązującymi przepisami o ochronie danych osobowych (RODO).'],
        ['key' => 'field_kar_cv_btn_text',    'label' => 'Tekst przycisku', 'name' => 'kar_cv_btn_text',    'type' => 'text',     'default_value' => 'Wyślij wiadomość'],
        ['key' => 'field_kar_cv_tag_text',    'label' => 'Tag na zdjęciu',  'name' => 'kar_cv_tag_text',    'type' => 'text',     'default_value' => 'Dołącz do nas!'],
        ['key' => 'field_kar_cf7_id', 'label' => 'ID formularza CF7', 'name' => 'kar_cf7_id', 'type' => 'number', 'instructions' => 'ID formularza Contact Form 7 do wysyłki CV.', 'min' => 0],
        ['key' => 'field_kar_cv_photo',       'label' => 'Zdjęcie',        'name' => 'kar_cv_photo',       'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],

        // ── REKRUTACJA ────────────────────────────────────────────────
        ['key' => 'field_kar_tab_rek', 'label' => 'Proces rekrutacji', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_kar_rek_title',    'label' => 'Tytuł',   'name' => 'kar_rek_title',    'type' => 'text',     'default_value' => 'Jak wygląda nasz proces rekrutacji'],
        ['key' => 'field_kar_rek_subtitle', 'label' => 'Podtytuł','name' => 'kar_rek_subtitle', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Zależy nam na przejrzystości — dlatego chcemy, żebyś wiedział/-a, czego się spodziewać na każdym etapie.'],
        ['key' => 'field_kar_rek_1', 'label' => 'Krok 1', 'name' => 'kar_rek_1', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_r1_icon',  'label' => 'Ikona', 'name' => 'icon',  'type' => 'text', 'default_value' => 'file-text'],
            ['key' => 'field_kar_r1_title', 'label' => 'Tytuł', 'name' => 'title', 'type' => 'text'],
            ['key' => 'field_kar_r1_text',  'label' => 'Opis',  'name' => 'text',  'type' => 'textarea', 'rows' => 2],
        ]],
        ['key' => 'field_kar_rek_2', 'label' => 'Krok 2', 'name' => 'kar_rek_2', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_r2_icon',  'label' => 'Ikona', 'name' => 'icon',  'type' => 'text', 'default_value' => 'phone-call'],
            ['key' => 'field_kar_r2_title', 'label' => 'Tytuł', 'name' => 'title', 'type' => 'text'],
            ['key' => 'field_kar_r2_text',  'label' => 'Opis',  'name' => 'text',  'type' => 'textarea', 'rows' => 2],
        ]],
        ['key' => 'field_kar_rek_3', 'label' => 'Krok 3', 'name' => 'kar_rek_3', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_r3_icon',  'label' => 'Ikona', 'name' => 'icon',  'type' => 'text', 'default_value' => 'video'],
            ['key' => 'field_kar_r3_title', 'label' => 'Tytuł', 'name' => 'title', 'type' => 'text'],
            ['key' => 'field_kar_r3_text',  'label' => 'Opis',  'name' => 'text',  'type' => 'textarea', 'rows' => 2],
        ]],
        ['key' => 'field_kar_rek_4', 'label' => 'Krok 4', 'name' => 'kar_rek_4', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_r4_icon',  'label' => 'Ikona', 'name' => 'icon',  'type' => 'text', 'default_value' => 'clipboard-check'],
            ['key' => 'field_kar_r4_title', 'label' => 'Tytuł', 'name' => 'title', 'type' => 'text'],
            ['key' => 'field_kar_r4_text',  'label' => 'Opis',  'name' => 'text',  'type' => 'textarea', 'rows' => 2],
        ]],

        // ── OPINIE ────────────────────────────────────────────────────
        ['key' => 'field_kar_tab_opinie', 'label' => 'Opinie', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_kar_opinie_title', 'label' => 'Tytuł sekcji', 'name' => 'kar_opinie_title', 'type' => 'text', 'default_value' => 'Co mówią nasi pracownicy'],
        ['key' => 'field_kar_opinia_1', 'label' => 'Opinia 1', 'name' => 'kar_opinia_1', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_op1_quote', 'label' => 'Cytat',    'name' => 'quote', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_kar_op1_name',  'label' => 'Imię',     'name' => 'name',  'type' => 'text'],
            ['key' => 'field_kar_op1_role',  'label' => 'Stanowisko','name' => 'role',  'type' => 'text'],
            ['key' => 'field_kar_op1_photo', 'label' => 'Zdjęcie',  'name' => 'photo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ]],
        ['key' => 'field_kar_opinia_2', 'label' => 'Opinia 2', 'name' => 'kar_opinia_2', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_op2_quote', 'label' => 'Cytat',    'name' => 'quote', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_kar_op2_name',  'label' => 'Imię',     'name' => 'name',  'type' => 'text'],
            ['key' => 'field_kar_op2_role',  'label' => 'Stanowisko','name' => 'role',  'type' => 'text'],
            ['key' => 'field_kar_op2_photo', 'label' => 'Zdjęcie',  'name' => 'photo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ]],
        ['key' => 'field_kar_opinia_3', 'label' => 'Opinia 3', 'name' => 'kar_opinia_3', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_op3_quote', 'label' => 'Cytat',    'name' => 'quote', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_kar_op3_name',  'label' => 'Imię',     'name' => 'name',  'type' => 'text'],
            ['key' => 'field_kar_op3_role',  'label' => 'Stanowisko','name' => 'role',  'type' => 'text'],
            ['key' => 'field_kar_op3_photo', 'label' => 'Zdjęcie',  'name' => 'photo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ]],
        ['key' => 'field_kar_opinia_4', 'label' => 'Opinia 4', 'name' => 'kar_opinia_4', 'type' => 'group', 'layout' => 'row', 'sub_fields' => [
            ['key' => 'field_kar_op4_quote', 'label' => 'Cytat',    'name' => 'quote', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_kar_op4_name',  'label' => 'Imię',     'name' => 'name',  'type' => 'text'],
            ['key' => 'field_kar_op4_role',  'label' => 'Stanowisko','name' => 'role',  'type' => 'text'],
            ['key' => 'field_kar_op4_photo', 'label' => 'Zdjęcie',  'name' => 'photo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ]],

        // ── CULTUREBOOK ───────────────────────────────────────────────
        ['key' => 'field_kar_tab_cult', 'label' => 'Culturebook', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_kar_cult_title',    'label' => 'Tytuł',          'name' => 'kar_cult_title',    'type' => 'text',     'default_value' => 'Poznaj nasz Culturebook'],
        ['key' => 'field_kar_cult_text1',    'label' => 'Akapit 1',       'name' => 'kar_cult_text1',    'type' => 'textarea', 'rows' => 3, 'default_value' => 'Culturebook powstał po to, żebyśmy wszyscy w Meritoros w ten sam sposób rozumieli, kim jesteśmy, dokąd zmierzamy i jakie wartości są dla nas ważne. Opisuje naszą misję, sposób działania i standard współpracy – wewnątrz zespołu i z klientami.'],
        ['key' => 'field_kar_cult_text2',    'label' => 'Akapit 2 (pogrubiony)', 'name' => 'kar_cult_text2', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Jeśli chcesz lepiej poznać nasz styl pracy, pobierz Culturebook i sprawdź, czy to podejście jest Ci bliskie'],
        ['key' => 'field_kar_cult_btn_text', 'label' => 'Tekst przycisku',         'name' => 'kar_cult_btn_text',      'type' => 'text', 'default_value' => 'Pobierz plik'],
        ['key' => 'field_kar_cult_cover',    'label' => 'Okładka (ekran laptopa)', 'name' => 'kar_cult_cover',         'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        [
            'key'           => 'field_kar_cult_pdf',
            'label'         => 'Plik PDF (Culturebook)',
            'name'          => 'kar_cult_pdf',
            'type'          => 'file',
            'return_format' => 'array',
            'mime_types'    => 'pdf',
            'instructions'  => 'Plik PDF wysyłany na e-mail użytkownika po wypełnieniu formularza.',
        ],
        [
            'key'           => 'field_kar_cult_email_subject',
            'label'         => 'Temat wiadomości e-mail',
            'name'          => 'kar_cult_email_subject',
            'type'          => 'text',
            'default_value' => 'Twój Culturebook od Meritoros',
        ],
        [
            'key'          => 'field_kar_cult_notify_email',
            'label'        => 'E-mail powiadomień (opcjonalnie)',
            'name'         => 'kar_cult_notify_email',
            'type'         => 'email',
            'instructions' => 'Jeśli podany, na ten adres trafi kopia powiadomienia o każdym pobraniu.',
        ],
        [
            'key'           => 'field_kar_cult_consent',
            'label'         => 'Tekst zgody pod formularzem',
            'name'          => 'kar_cult_consent',
            'type'          => 'textarea',
            'rows'          => 3,
            'default_value' => 'Klikając przycisk, zgadzasz się, że Meritoros może wykorzystać te dane, aby kontaktować się z Tobą w związku z materiałami i usługami, które mogą Cię zainteresować. Możesz zrezygnować w każdej chwili. Więcej informacji znajdziesz w naszej Polityce Prywatności.',
        ],

        // ── WIDEO ─────────────────────────────────────────────────────
        ['key' => 'field_kar_tab_vid', 'label' => 'Wideo', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_kar_vid_title',     'label' => 'Tytuł',             'name' => 'kar_vid_title',     'type' => 'text', 'default_value' => 'Sprawdź jak się u nas pracuje'],
        ['key' => 'field_kar_vid_thumbnail', 'label' => 'Miniatura (thumb)', 'name' => 'kar_vid_thumbnail', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'],
        ['key' => 'field_kar_vid_file',      'label' => 'Plik wideo (mp4/webm)', 'name' => 'kar_vid_file', 'type' => 'file', 'return_format' => 'array', 'mime_types' => 'mp4,webm'],
        ['key' => 'field_kar_vid_url',       'label' => 'URL wideo (YouTube/Vimeo) – alternatywnie', 'name' => 'kar_vid_url', 'type' => 'text'],

        // ── PYTANIA ───────────────────────────────────────────────────
        ['key' => 'field_kar_tab_pyt', 'label' => 'Kontakt HR', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_kar_pyt_title',    'label' => 'Tytuł',          'name' => 'kar_pyt_title',    'type' => 'text', 'default_value' => 'Masz pytania? Chętnie odpowiemy'],
        ['key' => 'field_kar_pyt_name',     'label' => 'Imię i nazwisko','name' => 'kar_pyt_name',     'type' => 'text', 'default_value' => 'Anna Kowalska'],
        ['key' => 'field_kar_pyt_role',     'label' => 'Stanowisko',     'name' => 'kar_pyt_role',     'type' => 'text', 'default_value' => 'Marketing manager'],
        ['key' => 'field_kar_pyt_phone',    'label' => 'Telefon (wyświetlany)', 'name' => 'kar_pyt_phone', 'type' => 'text', 'default_value' => '(+48) 12 423 32 99'],
        ['key' => 'field_kar_pyt_btn_text', 'label' => 'Tekst przycisku', 'name' => 'kar_pyt_btn_text', 'type' => 'text', 'default_value' => 'Wyślij zapytanie'],
        ['key' => 'field_kar_pyt_btn_url',  'label' => 'Link przycisku',  'name' => 'kar_pyt_btn_url',  'type' => 'text'],
        ['key' => 'field_kar_pyt_photo',    'label' => 'Zdjęcie osoby',   'name' => 'kar_pyt_photo',    'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'],

        // ── FAQ ──────────────────────────────────────────────────────────────
        ['key' => 'field_kar_tab_faq', 'label' => 'FAQ', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_kar_faq_title', 'label' => 'Tytuł sekcji', 'name' => 'kar_faq_title', 'type' => 'text', 'default_value' => 'Najczęściej zadawane pytania'],

        ['key' => 'field_kar_faq_1', 'label' => 'Pytanie 1', 'name' => 'kar_faq_1', 'type' => 'group', 'layout' => 'block', 'sub_fields' => [
            ['key' => 'field_kar_faq_1_q', 'label' => 'Pytanie', 'name' => 'question', 'type' => 'text', 'default_value' => 'Jak wygląda proces rekrutacji w Meritoros?'],
            ['key' => 'field_kar_faq_1_a', 'label' => 'Odpowiedź', 'name' => 'answer', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Nasz proces rekrutacji składa się z kilku etapów: przeglądu CV, rozmowy telefonicznej, spotkania rekrutacyjnego i decyzji. Staramy się, aby cały proces trwał nie dłużej niż 2–3 tygodnie.'],
        ]],
        ['key' => 'field_kar_faq_2', 'label' => 'Pytanie 2', 'name' => 'kar_faq_2', 'type' => 'group', 'layout' => 'block', 'sub_fields' => [
            ['key' => 'field_kar_faq_2_q', 'label' => 'Pytanie', 'name' => 'question', 'type' => 'text', 'default_value' => 'Czy oferujecie pracę zdalną lub hybrydową?'],
            ['key' => 'field_kar_faq_2_a', 'label' => 'Odpowiedź', 'name' => 'answer', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Pracujemy w modelu hybrydowym – część tygodnia w biurze, część zdalnie. Dokładny podział zależy od stanowiska i jest ustalany indywidualnie.'],
        ]],
        ['key' => 'field_kar_faq_3', 'label' => 'Pytanie 3', 'name' => 'kar_faq_3', 'type' => 'group', 'layout' => 'block', 'sub_fields' => [
            ['key' => 'field_kar_faq_3_q', 'label' => 'Pytanie', 'name' => 'question', 'type' => 'text', 'default_value' => 'Jakie są możliwości rozwoju zawodowego?'],
            ['key' => 'field_kar_faq_3_a', 'label' => 'Odpowiedź', 'name' => 'answer', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Stawiamy na ciągły rozwój naszych pracowników. Oferujemy szkolenia wewnętrzne, dofinansowanie kursów zewnętrznych oraz możliwość awansu wewnątrz organizacji.'],
        ]],
        ['key' => 'field_kar_faq_4', 'label' => 'Pytanie 4', 'name' => 'kar_faq_4', 'type' => 'group', 'layout' => 'block', 'sub_fields' => [
            ['key' => 'field_kar_faq_4_q', 'label' => 'Pytanie', 'name' => 'question', 'type' => 'text', 'default_value' => 'Czy potrzebuję doświadczenia, żeby aplikować?'],
            ['key' => 'field_kar_faq_4_a', 'label' => 'Odpowiedź', 'name' => 'answer', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'Zależy od stanowiska – część ofert skierowana jest do osób bez doświadczenia, które chcą się uczyć. Każdą ofertę pracy opisujemy dokładnie pod kątem wymagań.'],
        ]],
        ['key' => 'field_kar_faq_5', 'label' => 'Pytanie 5', 'name' => 'kar_faq_5', 'type' => 'group', 'layout' => 'block', 'sub_fields' => [
            ['key' => 'field_kar_faq_5_q', 'label' => 'Pytanie', 'name' => 'question', 'type' => 'text'],
            ['key' => 'field_kar_faq_5_a', 'label' => 'Odpowiedź', 'name' => 'answer', 'type' => 'textarea', 'rows' => 3],
        ]],
        ['key' => 'field_kar_faq_6', 'label' => 'Pytanie 6', 'name' => 'kar_faq_6', 'type' => 'group', 'layout' => 'block', 'sub_fields' => [
            ['key' => 'field_kar_faq_6_q', 'label' => 'Pytanie', 'name' => 'question', 'type' => 'text'],
            ['key' => 'field_kar_faq_6_a', 'label' => 'Odpowiedź', 'name' => 'answer', 'type' => 'textarea', 'rows' => 3],
        ]],
        ['key' => 'field_kar_faq_7', 'label' => 'Pytanie 7', 'name' => 'kar_faq_7', 'type' => 'group', 'layout' => 'block', 'sub_fields' => [
            ['key' => 'field_kar_faq_7_q', 'label' => 'Pytanie', 'name' => 'question', 'type' => 'text'],
            ['key' => 'field_kar_faq_7_a', 'label' => 'Odpowiedź', 'name' => 'answer', 'type' => 'textarea', 'rows' => 3],
        ]],
        ['key' => 'field_kar_faq_8', 'label' => 'Pytanie 8', 'name' => 'kar_faq_8', 'type' => 'group', 'layout' => 'block', 'sub_fields' => [
            ['key' => 'field_kar_faq_8_q', 'label' => 'Pytanie', 'name' => 'question', 'type' => 'text'],
            ['key' => 'field_kar_faq_8_a', 'label' => 'Odpowiedź', 'name' => 'answer', 'type' => 'textarea', 'rows' => 3],
        ]],

    ],
    'location'   => $kar_page_location,
    'menu_order' => 10,
    'position'   => 'normal',
]);

/* ==================================================================
   HISTORIE KLIENTÓW
================================================================== */
$hk_page_location = [
    [['param' => 'page_slug',     'operator' => '==', 'value' => 'historie-klientow']],
    [['param' => 'page_template', 'operator' => '==', 'value' => 'page-historie-klientow.php']],
];

acf_add_local_field_group([
    'key'   => 'group_mer_hk',
    'title' => '📖 Historie klientów',
    'fields' => [

        ['key' => 'field_hk_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_hk_hero_title',    'label' => 'Tytuł',          'name' => 'hk_hero_title',    'type' => 'textarea', 'rows' => 2, 'default_value' => 'Historie klientów'],
        ['key' => 'field_hk_hero_text',     'label' => 'Opis',           'name' => 'hk_hero_text',     'type' => 'textarea', 'rows' => 2, 'new_lines' => 'br', 'default_value' => 'Konkretne przypadki. Konkretny efekt. Zobacz, jak pomagamy firmom działać stabilnie i bezpiecznie.'],
        ['key' => 'field_hk_hero_btn_text', 'label' => 'Tekst przycisku','name' => 'hk_hero_btn_text', 'type' => 'text',     'default_value' => 'Poznaj więcej'],
        ['key' => 'field_hk_hero_btn_url',  'label' => 'Link przycisku', 'name' => 'hk_hero_btn_url',  'type' => 'text',     'default_value' => '#hk-video-section'],

        ['key' => 'field_hk_tab_wsp', 'label' => 'Współpraca', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_hk_wsp_title_pre',   'label' => 'Tytuł – linia 1',        'name' => 'hk_wsp_title_pre',   'type' => 'text',     'default_value' => 'Współpraca, która'],
        ['key' => 'field_hk_wsp_title_green', 'label' => 'Tytuł – linia 2 (zielona)', 'name' => 'hk_wsp_title_green', 'type' => 'text', 'default_value' => 'daje spokój operacyjny'],
        ['key' => 'field_hk_wsp_text',        'label' => 'Opis',                   'name' => 'hk_wsp_text',        'type' => 'textarea', 'rows' => 3, 'default_value' => 'W Meritoros pracujemy tak, aby odciążyć zespół klienta i zapewnić ciągłość obsługi. Działamy elastycznie, dopasowując model współpracy do realiów organizacji, ale trzymamy stały standard jakości, terminowości i bezpieczeństwa danych.'],
        ['key' => 'field_hk_wsp_bold_text',   'label' => 'Tekst pogrubiony',       'name' => 'hk_wsp_bold_text',   'type' => 'textarea', 'rows' => 2, 'default_value' => 'Dzięki temu klienci mogą skupić się na biznesie, a nie na „gaszeniu tematów" w księgowości czy kadrach'],
        ['key' => 'field_hk_wsp_thumbnail',   'label' => 'Miniatura wideo',        'name' => 'hk_wsp_thumbnail',   'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'],
        ['key' => 'field_hk_wsp_video_file',  'label' => 'Plik wideo (mp4/webm)',  'name' => 'hk_wsp_video_file',  'type' => 'file',  'return_format' => 'array', 'mime_types' => 'mp4,webm'],
        ['key' => 'field_hk_wsp_video_url',   'label' => 'URL wideo (YouTube/Vimeo)', 'name' => 'hk_wsp_video_url', 'type' => 'text'],

        // ── SEKCJA WIDEO ─────────────────────────────────────────────────
        ['key' => 'field_hk_tab_vid',   'label' => 'Sekcja Wideo',         'name' => '',            'type' => 'tab'],
        ['key' => 'field_hk_vid_label', 'label' => 'Label nad nagłówkiem', 'name' => 'hk_vid_label','type' => 'text', 'default_value' => 'Historie klientów'],
        ['key' => 'field_hk_vid_title', 'label' => 'Nagłówek sekcji',      'name' => 'hk_vid_title','type' => 'text', 'default_value' => 'Posłuchaj, co mówią nasi klienci'],
        ['key' => 'field_hk_vid_load_more', 'label' => 'Tekst przycisku „Wczytaj więcej"', 'name' => 'hk_vid_load_more', 'type' => 'text', 'default_value' => 'Wczytaj więcej'],

        // ── CTA BANNER ───────────────────────────────────────────────────
        ['key' => 'field_hk_tab_cta', 'label' => 'Baner CTA', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_hk_cta_title',    'label' => 'Tytuł (każda linia = enter)',  'name' => 'hk_cta_title',    'type' => 'textarea', 'rows' => 2, 'default_value' => "Porozmawiajmy o rozwiązaniach\ndla Twojego biznesu"],
        ['key' => 'field_hk_cta_text',     'label' => 'Opis',                         'name' => 'hk_cta_text',     'type' => 'textarea', 'rows' => 2, 'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.'],
        ['key' => 'field_hk_cta_btn_text', 'label' => 'Tekst przycisku',              'name' => 'hk_cta_btn_text', 'type' => 'text',     'default_value' => 'Wyślij zapytanie'],
        ['key' => 'field_hk_cta_btn_url',  'label' => 'Link przycisku',               'name' => 'hk_cta_btn_url',  'type' => 'text'],
        ['key' => 'field_hk_cta_bg',       'label' => 'Zdjęcie tła',                  'name' => 'hk_cta_bg',       'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'],

        // ── LOGOS ─────────────────────────────────────────────────────────
        ['key' => 'field_hk_tab_logos', 'label' => 'Logotypy klientów', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_hk_logos_text_pre',  'label' => 'Tekst przed liczbą', 'name' => 'hk_logos_text_pre',  'type' => 'text', 'default_value' => 'Zaufało nam ponad'],
        ['key' => 'field_hk_logos_number',    'label' => 'Liczba klientów',    'name' => 'hk_logos_number',    'type' => 'text', 'default_value' => '1200'],
        ['key' => 'field_hk_logos_text_post', 'label' => 'Tekst po liczbie',   'name' => 'hk_logos_text_post', 'type' => 'text', 'default_value' => 'klientów'],
        ['key' => 'field_hk_logos_logo1', 'label' => 'Logotyp 1 (opcjonalny – domyślnie Streamsoft)', 'name' => 'hk_logos_logo1', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_hk_logos_logo2', 'label' => 'Logotyp 2 (opcjonalny – domyślnie Sitech)',     'name' => 'hk_logos_logo2', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_hk_logos_logo3', 'label' => 'Logotyp 3 (opcjonalny – domyślnie Arco)',       'name' => 'hk_logos_logo3', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_hk_logos_logo4', 'label' => 'Logotyp 4 (opcjonalny – domyślnie ROFA)',       'name' => 'hk_logos_logo4', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],

    ],
    'location'   => $hk_page_location,
    'menu_order' => 0,
    'position'   => 'normal',
]);

// Sekcja wideo pobiera dane z CPT customer-story (pola cs_video_url, cs_thumbnail itp.)

// Pola dla CPT "Historia klienta" → inc/acf-fields-customer-story.php

/* ==================================================================
   STRONA: KUPIMY BIURO RACHUNKOWE
================================================================== */
acf_add_local_field_group([
    'key'      => 'group_mer_kupimy',
    'title'    => '🏢 Kupimy biuro rachunkowe',
    'location' => [
        [['param' => 'page_template', 'operator' => '==', 'value' => 'page-kupimy-biuro-rachunkowe.php']],
        [['param' => 'page_slug',     'operator' => '==', 'value' => 'kupimy-biuro-rachunkowe']],
    ],
    'menu_order' => 10,
    'position'   => 'normal',
    'fields'   => [

        // ── TAB: Hero ─────────────────────────────────────────────
        ['key' => 'field_kupimy_tab_hero',     'label' => 'Hero',     'name' => '', 'type' => 'tab'],
        ['key' => 'field_kupimy_hero_image',    'label' => 'Zdjęcie w tle', 'name' => 'kupimy_hero_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'],
        ['key' => 'field_kupimy_hero_heading',  'label' => 'Nagłówek',    'name' => 'kupimy_hero_heading',  'type' => 'textarea', 'rows' => 2, 'default_value' => 'Myślisz o sprzedaży swojego biura rachunkowego?'],
        ['key' => 'field_kupimy_hero_subtitle', 'label' => 'Podtytuł',    'name' => 'kupimy_hero_subtitle', 'type' => 'textarea', 'rows' => 2, 'new_lines' => 'br', 'default_value' => 'Oferujemy dwa modele współpracy: całkowitą sprzedaż biura rachunkowego albo partnerstwo kapitałowe z zachowaniem operacyjnej autonomii.'],
        ['key' => 'field_kupimy_hero_btn_text', 'label' => 'Przycisk — tekst', 'name' => 'kupimy_hero_btn_text', 'type' => 'text', 'default_value' => 'Kontakt'],
        ['key' => 'field_kupimy_hero_btn_url',  'label' => 'Przycisk — link',  'name' => 'kupimy_hero_btn_url',  'type' => 'text'],
        ['key' => 'field_kupimy_hero_intro',    'label' => 'Akapit wstępny',   'name' => 'kupimy_hero_intro',    'type' => 'textarea', 'rows' => 3, 'new_lines' => 'br', 'default_value' => 'Właściciele biur rachunkowych zgłaszają się do nas z różnymi potrzebami. Jedni chcą całkowicie wyjść z biznesu i sprzedać firmę, inni szukają partnera, który pomoże im dalej rozwijać biuro. W Meritoros rozmawiamy o obu scenariuszach.'],

        // ── TAB: Modele ───────────────────────────────────────────
        ['key' => 'field_kupimy_tab_modele',       'label' => 'Modele współpracy', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_kupimy_model1_title',     'label' => 'Kafelek 1 — tytuł', 'name' => 'kupimy_model1_title', 'type' => 'text',     'default_value' => 'Całkowita sprzedaż biura'],
        ['key' => 'field_kupimy_model1_desc',      'label' => 'Kafelek 1 — opis',  'name' => 'kupimy_model1_desc',  'type' => 'textarea', 'rows' => 3],
        ['key' => 'field_kupimy_model1_image',     'label' => 'Kafelek 1 — zdjęcie', 'name' => 'kupimy_model1_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'],
        ['key' => 'field_kupimy_model2_title',     'label' => 'Kafelek 2 — tytuł', 'name' => 'kupimy_model2_title', 'type' => 'text',     'default_value' => 'Sprzedaż części udziałów'],
        ['key' => 'field_kupimy_model2_desc',      'label' => 'Kafelek 2 — opis',  'name' => 'kupimy_model2_desc',  'type' => 'textarea', 'rows' => 3],
        ['key' => 'field_kupimy_model2_image',     'label' => 'Kafelek 2 — zdjęcie', 'name' => 'kupimy_model2_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'],
        ['key' => 'field_kupimy_modele_btn_text',  'label' => 'Przycisk — tekst',  'name' => 'kupimy_modele_btn_text', 'type' => 'text', 'default_value' => 'Porozmawiajmy o możliwym modelu współpracy'],
        ['key' => 'field_kupimy_modele_btn_url',   'label' => 'Przycisk — link',   'name' => 'kupimy_modele_btn_url',  'type' => 'text'],

        // ── TAB: Kryteria (całkowita sprzedaż) ───────────────────
        ['key' => 'field_kupimy_tab_kryt',        'label' => 'Kryteria — sprzedaż', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_kupimy_kryt_label',      'label' => 'Label',          'name' => 'kupimy_kryt_label',   'type' => 'text',     'default_value' => 'Całkowita sprzedaż biura'],
        ['key' => 'field_kupimy_kryt_heading',    'label' => 'Nagłówek',       'name' => 'kupimy_kryt_heading', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Obecnie najczęściej rozmawiamy z biurami, które spełniają poniższe kryteria:'],
        ['key' => 'field_kupimy_kryt_subtitle',   'label' => 'Podtytuł',       'name' => 'kupimy_kryt_subtitle','type' => 'textarea', 'rows' => 2],
        ['key' => 'field_kupimy_kryt_items',      'label' => 'Lista kryteriów (każde w nowej linii)', 'name' => 'kupimy_kryt_items', 'type' => 'textarea', 'rows' => 5],
        ['key' => 'field_kupimy_kryt_cta_pre',    'label' => 'Tekst nad przyciskiem', 'name' => 'kupimy_kryt_cta_pre',  'type' => 'text', 'default_value' => 'Spełniasz powyższe kryteria?'],
        ['key' => 'field_kupimy_kryt_btn_text',   'label' => 'Przycisk — tekst',      'name' => 'kupimy_kryt_btn_text', 'type' => 'text', 'default_value' => 'Umów się na rozmowę'],
        ['key' => 'field_kupimy_kryt_btn_url',    'label' => 'Przycisk — link',       'name' => 'kupimy_kryt_btn_url',  'type' => 'text'],
        ['key' => 'field_kupimy_kryt_photo',      'label' => 'Zdjęcie',               'name' => 'kupimy_kryt_photo',    'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'],

        // ── TAB: Model partnerski ─────────────────────────────────
        ['key' => 'field_kupimy_tab_part',              'label' => 'Model partnerski',    'name' => '', 'type' => 'tab'],
        ['key' => 'field_kupimy_part_label',            'label' => 'Label',               'name' => 'kupimy_part_label',   'type' => 'text',     'default_value' => 'W przypadku modelu partnerskiego'],
        ['key' => 'field_kupimy_part_heading',          'label' => 'Nagłówek',            'name' => 'kupimy_part_heading', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Model partnerski kierujemy przede wszystkim do biur, które:'],
        ['key' => 'field_kupimy_part_items',            'label' => 'Lista (każdy w nowej linii)', 'name' => 'kupimy_part_items', 'type' => 'textarea', 'rows' => 5],
        ['key' => 'field_kupimy_part_photo',            'label' => 'Zdjęcie',             'name' => 'kupimy_part_photo',   'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'],
        ['key' => 'field_kupimy_part_benefits_title',   'label' => 'Nagłówek — korzyści', 'name' => 'kupimy_part_benefits_title', 'type' => 'text', 'default_value' => 'Co zyskujesz jako Partner Meritoros?'],
        ['key' => 'field_kupimy_part_benefits',         'label' => 'Korzyści (każda w nowej linii)', 'name' => 'kupimy_part_benefits', 'type' => 'textarea', 'rows' => 7],
        ['key' => 'field_kupimy_part_banner_title',     'label' => 'Banner — nagłówek',   'name' => 'kupimy_part_banner_title', 'type' => 'text',     'default_value' => 'Spełniasz wszystkie kryteria?'],
        ['key' => 'field_kupimy_part_banner_desc',      'label' => 'Banner — opis',       'name' => 'kupimy_part_banner_desc',  'type' => 'textarea', 'rows' => 2, 'default_value' => 'Warto się odezwać — chętnie sprawdzimy, czy widzimy przestrzeń do współpracy.'],
        ['key' => 'field_kupimy_part_banner_btn',       'label' => 'Banner — przycisk tekst', 'name' => 'kupimy_part_banner_btn',     'type' => 'text', 'default_value' => 'Umów się na rozmowę'],
        ['key' => 'field_kupimy_part_banner_btn_url',   'label' => 'Banner — przycisk link',  'name' => 'kupimy_part_banner_btn_url', 'type' => 'text'],

        // ── TAB: Formularz kontaktowy ─────────────────────────────
        ['key' => 'field_kupimy_tab_form',        'label' => 'Formularz kontaktowy', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_kupimy_form_heading',    'label' => 'Nagłówek',     'name' => 'kupimy_form_heading',  'type' => 'text',     'default_value' => 'Porozmawiajmy'],
        ['key' => 'field_kupimy_form_subtitle',   'label' => 'Podtytuł',     'name' => 'kupimy_form_subtitle', 'type' => 'textarea', 'rows' => 2],
        ['key' => 'field_kupimy_form_btn_text',   'label' => 'Przycisk — tekst', 'name' => 'kupimy_form_btn_text', 'type' => 'text', 'default_value' => 'Wyślij wiadomość'],
        ['key' => 'field_kupimy_form_rodo',       'label' => 'Treść zgody RODO', 'name' => 'kupimy_form_rodo', 'type' => 'textarea', 'rows' => 3],
        ['key' => 'field_kupimy_form_photo',      'label' => 'Zdjęcie',          'name' => 'kupimy_form_photo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'],
        ['key' => 'field_kupimy_cf7_id', 'label' => 'ID formularza CF7', 'name' => 'kupimy_cf7_id', 'type' => 'number', 'instructions' => 'ID formularza Contact Form 7.', 'min' => 0],

        // ── TAB: Wycena ───────────────────────────────────────────
        ['key' => 'field_kupimy_tab_wycena',         'label' => 'Wycena',           'name' => '', 'type' => 'tab'],
        ['key' => 'field_kupimy_wycena_heading',     'label' => 'Nagłówek',         'name' => 'kupimy_wycena_heading',    'type' => 'textarea', 'rows' => 2, 'default_value' => 'Od czego zależy wycena biura rachunkowego?'],
        ['key' => 'field_kupimy_wycena_desc',        'label' => 'Opis',             'name' => 'kupimy_wycena_desc',       'type' => 'textarea', 'rows' => 3],
        ['key' => 'field_kupimy_wycena_list_label',  'label' => 'Label listy',      'name' => 'kupimy_wycena_list_label', 'type' => 'text',     'default_value' => 'Na wycenę wpływają m.in.:'],
        ['key' => 'field_kupimy_wycena_items',       'label' => 'Lista (każdy w nowej linii)', 'name' => 'kupimy_wycena_items', 'type' => 'textarea', 'rows' => 5],

        // ── TAB: Wideo ────────────────────────────────────────────
        ['key' => 'field_kupimy_tab_wideo',       'label' => 'Wideo',            'name' => '', 'type' => 'tab'],
        ['key' => 'field_kupimy_wideo_heading',   'label' => 'Nagłówek',         'name' => 'kupimy_wideo_heading',   'type' => 'textarea', 'rows' => 2, 'default_value' => 'Jak wygląda sprzedaż biura rachunkowego w praktyce?'],
        ['key' => 'field_kupimy_wideo_desc',      'label' => 'Opis',             'name' => 'kupimy_wideo_desc',      'type' => 'textarea', 'rows' => 2],
        ['key' => 'field_kupimy_wideo_url',       'label' => 'URL wideo (YouTube / Vimeo)', 'name' => 'kupimy_wideo_url', 'type' => 'text', 'instructions' => 'Wklej link do YouTube lub Vimeo. Miniatura zostanie pobrana automatycznie z YouTube.'],
        ['key' => 'field_kupimy_wideo_thumbnail', 'label' => 'Miniatura wideo (opcjonalne nadpisanie)', 'name' => 'kupimy_wideo_thumbnail', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium', 'instructions' => 'Wypełnij tylko jeśli chcesz zastąpić miniaturę auto-pobieraną z YouTube. Przy filmach Vimeo wymagane.'],

        // ── TAB: Kalkulator ───────────────────────────────────────
        ['key' => 'field_kupimy_tab_kalk',       'label' => 'Kalkulator',       'name' => '', 'type' => 'tab'],
        ['key' => 'field_kupimy_kalk_heading',   'label' => 'Nagłówek',         'name' => 'kupimy_kalk_heading',  'type' => 'textarea', 'rows' => 2, 'default_value' => 'Kalkulator orientacyjnej wyceny biura rachunkowego'],
        ['key' => 'field_kupimy_kalk_btn_text',  'label' => 'Przycisk — tekst', 'name' => 'kupimy_kalk_btn_text', 'type' => 'text',     'default_value' => 'Sprawdź wycenę'],
        ['key' => 'field_kupimy_kalk_btn_url',   'label' => 'Przycisk — link',  'name' => 'kupimy_kalk_btn_url',  'type' => 'text'],
        ['key' => 'field_kupimy_kalk_photo',     'label' => 'Zdjęcie w tle',    'name' => 'kupimy_kalk_photo',    'type' => 'image', 'return_format' => 'array', 'preview_size' => 'large'],
    ],
]);

/* ==================================================================
   STRONA: RELACJE INWESTORSKIE
================================================================== */
acf_add_local_field_group([
    'key'        => 'group_mer_ri',
    'title'      => 'Relacje inwestorskie',
    'location'   => [
        [['param' => 'page_slug',     'operator' => '==', 'value' => 'relacje-inwestorskie']],
        [['param' => 'page_template', 'operator' => '==', 'value' => 'page-relacje-inwestorskie.php']],
    ],
    'menu_order' => 0,
    'position'   => 'normal',
    'fields'     => [

        // ── TAB: Hero ─────────────────────────────────────────────
        ['key' => 'field_ri_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_ri_hero_title', 'label' => 'Naglowek H1',        'name' => 'ri_hero_title', 'type' => 'textarea', 'rows' => 2, 'default_value' => 'Relacje inwestorskie'],
        ['key' => 'field_ri_hero_text',  'label' => 'Tekst pod naglowkiem','name' => 'ri_hero_text',  'type' => 'textarea', 'rows' => 3, 'new_lines' => 'br', 'default_value' => 'Ponizej udostepniamy kluczowe informacje i dokumenty dotyczace Meritoros SA, w tym sprawozdania finansowe i raporty okresowe.'],
        ['key' => 'field_ri_hero_image', 'label' => 'Zdjecie w tle',      'name' => 'ri_hero_image', 'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],

        // ── TAB: Informacje o spolce ───────────────────────────────
        ['key' => 'field_ri_tab_info',    'label' => 'Informacje o spolce', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_ri_info_title',  'label' => 'Naglowek sekcji',     'name' => 'ri_info_title',  'type' => 'textarea', 'rows' => 2],
        ['key' => 'field_ri_info_text',   'label' => 'Tresc (akapity oddzielone pusta linia)', 'name' => 'ri_info_text', 'type' => 'textarea', 'rows' => 12],
        ['key' => 'field_ri_info_photo',  'label' => 'Zdjecie prawa kolumna', 'name' => 'ri_info_photo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'],
        ['key' => 'field_ri_award_title', 'label' => 'Nagrody — tytul',    'name' => 'ri_award_title', 'type' => 'text',     'default_value' => 'Nagrody i wyroznienia'],
        ['key' => 'field_ri_award_text',  'label' => 'Nagrody — opis',     'name' => 'ri_award_text',  'type' => 'textarea', 'rows' => 3],
        ['key' => 'field_ri_award_logo1', 'label' => 'Nagrody — logo 1',   'name' => 'ri_award_logo1', 'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail'],
        ['key' => 'field_ri_award_logo2', 'label' => 'Nagrody — logo 2',   'name' => 'ri_award_logo2', 'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail'],

        // ── TAB: Rośniemy ─────────────────────────────────────────
        ['key' => 'field_ri_tab_rosniemy',   'label' => 'Rosniemy',        'name' => '',                  'type' => 'tab'],
        ['key' => 'field_ri_rosniemy_title', 'label' => 'Naglowek H2',     'name' => 'ri_rosniemy_title', 'type' => 'text',     'default_value' => 'Rośniemy'],
        ['key' => 'field_ri_rosniemy_text',  'label' => 'Tekst',           'name' => 'ri_rosniemy_text',  'type' => 'textarea', 'rows' => 3],
        ['key' => 'field_ri_rosniemy_photo', 'label' => 'Zdjecie / wykres','name' => 'ri_rosniemy_photo', 'type' => 'image',    'return_format' => 'array', 'preview_size' => 'medium'],

        // ── TAB: Zarząd ───────────────────────────────────────────
        ['key' => 'field_ri_tab_zarzad',   'label' => 'Zarzad',      'name' => '',              'type' => 'tab'],
        ['key' => 'field_ri_zarzad_title', 'label' => 'Naglowek H2', 'name' => 'ri_zarzad_title', 'type' => 'text', 'default_value' => 'Zarząd'],
        ['key' => 'field_ri_zarzad_m1', 'label' => 'Czlonek 1', 'name' => 'ri_zarzad_member_1', 'type' => 'group', 'sub_fields' => [
            ['key' => 'field_ri_zarzad_m1_name',  'label' => 'Imie i nazwisko', 'name' => 'name',  'type' => 'text'],
            ['key' => 'field_ri_zarzad_m1_role',  'label' => 'Stanowisko',      'name' => 'role',  'type' => 'text'],
            ['key' => 'field_ri_zarzad_m1_bio',   'label' => 'Bio',             'name' => 'bio',   'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_ri_zarzad_m1_photo', 'label' => 'Zdjecie',         'name' => 'photo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'],
        ]],
        ['key' => 'field_ri_zarzad_m2', 'label' => 'Czlonek 2', 'name' => 'ri_zarzad_member_2', 'type' => 'group', 'sub_fields' => [
            ['key' => 'field_ri_zarzad_m2_name',  'label' => 'Imie i nazwisko', 'name' => 'name',  'type' => 'text'],
            ['key' => 'field_ri_zarzad_m2_role',  'label' => 'Stanowisko',      'name' => 'role',  'type' => 'text'],
            ['key' => 'field_ri_zarzad_m2_bio',   'label' => 'Bio',             'name' => 'bio',   'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_ri_zarzad_m2_photo', 'label' => 'Zdjecie',         'name' => 'photo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'],
        ]],
        ['key' => 'field_ri_zarzad_m3', 'label' => 'Czlonek 3', 'name' => 'ri_zarzad_member_3', 'type' => 'group', 'sub_fields' => [
            ['key' => 'field_ri_zarzad_m3_name',  'label' => 'Imie i nazwisko', 'name' => 'name',  'type' => 'text'],
            ['key' => 'field_ri_zarzad_m3_role',  'label' => 'Stanowisko',      'name' => 'role',  'type' => 'text'],
            ['key' => 'field_ri_zarzad_m3_bio',   'label' => 'Bio',             'name' => 'bio',   'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_ri_zarzad_m3_photo', 'label' => 'Zdjecie',         'name' => 'photo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'],
        ]],
        ['key' => 'field_ri_zarzad_m4', 'label' => 'Czlonek 4', 'name' => 'ri_zarzad_member_4', 'type' => 'group', 'sub_fields' => [
            ['key' => 'field_ri_zarzad_m4_name',  'label' => 'Imie i nazwisko', 'name' => 'name',  'type' => 'text'],
            ['key' => 'field_ri_zarzad_m4_role',  'label' => 'Stanowisko',      'name' => 'role',  'type' => 'text'],
            ['key' => 'field_ri_zarzad_m4_bio',   'label' => 'Bio',             'name' => 'bio',   'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_ri_zarzad_m4_photo', 'label' => 'Zdjecie',         'name' => 'photo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'],
        ]],

        // ── Podsekcje w lewej kolumnie ────────────────────────────
        ['key' => 'field_ri_sub1_title', 'label' => 'Podsekcja 1 — naglowek', 'name' => 'ri_sub1_title', 'type' => 'text',     'default_value' => 'Profil działalności'],
        ['key' => 'field_ri_sub1_text',  'label' => 'Podsekcja 1 — tresc',    'name' => 'ri_sub1_text',  'type' => 'textarea', 'rows' => 4],
        ['key' => 'field_ri_sub2_title', 'label' => 'Podsekcja 2 — naglowek', 'name' => 'ri_sub2_title', 'type' => 'text',     'default_value' => 'Skala działalności'],
        ['key' => 'field_ri_sub2_text',  'label' => 'Podsekcja 2 — tresc',    'name' => 'ri_sub2_text',  'type' => 'textarea', 'rows' => 4],
        ['key' => 'field_ri_sub3_title',     'label' => 'Podsekcja 3 — naglowek',          'name' => 'ri_sub3_title',     'type' => 'text',     'default_value' => 'Zasięg i grupa kapitałowa'],
        ['key' => 'field_ri_sub3_text',      'label' => 'Podsekcja 3 — tresc',             'name' => 'ri_sub3_text',      'type' => 'textarea', 'rows' => 4],
        ['key' => 'field_ri_sub3_companies', 'label' => 'Podsekcja 3 — spółki (każda w osobnej linii)', 'name' => 'ri_sub3_companies', 'type' => 'textarea', 'rows' => 4],
        ['key' => 'field_ri_sub4_title', 'label' => 'Podsekcja 4 — naglowek', 'name' => 'ri_sub4_title', 'type' => 'text',     'default_value' => 'Strategia rozwoju'],
        ['key' => 'field_ri_sub4_text',  'label' => 'Podsekcja 4 — tresc',    'name' => 'ri_sub4_text',  'type' => 'textarea', 'rows' => 4],

        // ── TAB: O nas — Statystyki ───────────────────────────────
        ['key' => 'field_ri_tab_stats', 'label' => '◆ O nas — Statystyki', 'name' => '', 'type' => 'tab'],

        // ── Statystyki (4 liczby pod zdjęciem) ────────────────────
        ['key' => 'field_ri_stat1', 'label' => 'Statystyka 1', 'name' => 'ri_stat_1', 'type' => 'group', 'sub_fields' => [
            ['key' => 'field_ri_stat1_val',   'label' => 'Wartosc',  'name' => 'value', 'type' => 'text', 'default_value' => '2004'],
            ['key' => 'field_ri_stat1_label', 'label' => 'Opis',     'name' => 'label', 'type' => 'text', 'default_value' => 'Początek działalności'],
        ]],
        ['key' => 'field_ri_stat2', 'label' => 'Statystyka 2', 'name' => 'ri_stat_2', 'type' => 'group', 'sub_fields' => [
            ['key' => 'field_ri_stat2_val',   'label' => 'Wartosc',  'name' => 'value', 'type' => 'text', 'default_value' => '1200+'],
            ['key' => 'field_ri_stat2_label', 'label' => 'Opis',     'name' => 'label', 'type' => 'text', 'default_value' => 'Klientów'],
        ]],
        ['key' => 'field_ri_stat3', 'label' => 'Statystyka 3', 'name' => 'ri_stat_3', 'type' => 'group', 'sub_fields' => [
            ['key' => 'field_ri_stat3_val',   'label' => 'Wartosc',  'name' => 'value', 'type' => 'text', 'default_value' => '180+'],
            ['key' => 'field_ri_stat3_label', 'label' => 'Opis',     'name' => 'label', 'type' => 'text', 'default_value' => 'Specjalistów'],
        ]],
        ['key' => 'field_ri_stat4', 'label' => 'Statystyka 4', 'name' => 'ri_stat_4', 'type' => 'group', 'sub_fields' => [
            ['key' => 'field_ri_stat4_val',   'label' => 'Wartosc',  'name' => 'value', 'type' => 'text', 'default_value' => '7'],
            ['key' => 'field_ri_stat4_label', 'label' => 'Opis',     'name' => 'label', 'type' => 'text', 'default_value' => 'lokalizacji'],
            ['key' => 'field_ri_stat4_sub',   'label' => 'Podpis (opcjonalnie)', 'name' => 'sublabel', 'type' => 'text', 'default_value' => '(ale ciągle rośniemy)'],
        ]],

        // ── TAB: Dane finansowe ────────────────────────────────────
        ['key' => 'field_ri_tab_dane',  'label' => 'Dane finansowe', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_ri_dane_title','label' => 'Naglowek sekcji', 'name' => 'ri_dane_title', 'type' => 'text', 'default_value' => 'Wybrane dane finansowe'],
        ['key' => 'field_ri_dane_years','label' => 'Lata (oddzielone przecinkami)', 'name' => 'ri_dane_years', 'type' => 'text', 'default_value' => '2012,2013,2014,2015,2016,2017,2018,2019,2020,2021,2022,2023,2024', 'instructions' => 'Np. 2012,2013,2014. Liczba lat musi zgadzac sie z liczba wartosci w kazdym wierszu.'],
        ['key' => 'field_ri_dane_r1',  'label' => 'Wiersz 1',  'name' => 'ri_dane_row_1',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_dane_r1_label',  'label' => 'Nazwa pozycji', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_dane_r1_values',  'label' => 'Wartosci (przecinkami)', 'name' => 'values', 'type' => 'text']]],
        ['key' => 'field_ri_dane_r2',  'label' => 'Wiersz 2',  'name' => 'ri_dane_row_2',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_dane_r2_label',  'label' => 'Nazwa pozycji', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_dane_r2_values',  'label' => 'Wartosci (przecinkami)', 'name' => 'values', 'type' => 'text']]],
        ['key' => 'field_ri_dane_r3',  'label' => 'Wiersz 3',  'name' => 'ri_dane_row_3',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_dane_r3_label',  'label' => 'Nazwa pozycji', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_dane_r3_values',  'label' => 'Wartosci (przecinkami)', 'name' => 'values', 'type' => 'text']]],
        ['key' => 'field_ri_dane_r4',  'label' => 'Wiersz 4',  'name' => 'ri_dane_row_4',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_dane_r4_label',  'label' => 'Nazwa pozycji', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_dane_r4_values',  'label' => 'Wartosci (przecinkami)', 'name' => 'values', 'type' => 'text']]],
        ['key' => 'field_ri_dane_r5',  'label' => 'Wiersz 5',  'name' => 'ri_dane_row_5',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_dane_r5_label',  'label' => 'Nazwa pozycji', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_dane_r5_values',  'label' => 'Wartosci (przecinkami)', 'name' => 'values', 'type' => 'text']]],
        ['key' => 'field_ri_dane_r6',  'label' => 'Wiersz 6',  'name' => 'ri_dane_row_6',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_dane_r6_label',  'label' => 'Nazwa pozycji', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_dane_r6_values',  'label' => 'Wartosci (przecinkami)', 'name' => 'values', 'type' => 'text']]],
        ['key' => 'field_ri_dane_r7',  'label' => 'Wiersz 7',  'name' => 'ri_dane_row_7',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_dane_r7_label',  'label' => 'Nazwa pozycji', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_dane_r7_values',  'label' => 'Wartosci (przecinkami)', 'name' => 'values', 'type' => 'text']]],
        ['key' => 'field_ri_dane_r8',  'label' => 'Wiersz 8',  'name' => 'ri_dane_row_8',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_dane_r8_label',  'label' => 'Nazwa pozycji', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_dane_r8_values',  'label' => 'Wartosci (przecinkami)', 'name' => 'values', 'type' => 'text']]],
        ['key' => 'field_ri_dane_r9',  'label' => 'Wiersz 9',  'name' => 'ri_dane_row_9',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_dane_r9_label',  'label' => 'Nazwa pozycji', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_dane_r9_values',  'label' => 'Wartosci (przecinkami)', 'name' => 'values', 'type' => 'text']]],
        ['key' => 'field_ri_dane_r10', 'label' => 'Wiersz 10', 'name' => 'ri_dane_row_10', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_dane_r10_label', 'label' => 'Nazwa pozycji', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_dane_r10_values', 'label' => 'Wartosci (przecinkami)', 'name' => 'values', 'type' => 'text']]],

        // ── TAB: Rada nadzorcza (slider) ──────────────────────────
        ['key' => 'field_ri_tab_rada',   'label' => 'Rada nadzorcza', 'name' => '',             'type' => 'tab'],
        ['key' => 'field_ri_rada_title', 'label' => 'Naglowek H2',   'name' => 'ri_rada_title', 'type' => 'text', 'default_value' => 'Rada nadzorcza'],
        ['key' => 'field_ri_rada_c1', 'label' => 'Czlonek 1', 'name' => 'ri_rada_card_1', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rada_c1_name', 'label' => 'Imie i nazwisko', 'name' => 'name', 'type' => 'text'], ['key' => 'field_ri_rada_c1_role', 'label' => 'Rola', 'name' => 'role', 'type' => 'text'], ['key' => 'field_ri_rada_c1_desc', 'label' => 'Opis', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3]]],
        ['key' => 'field_ri_rada_c2', 'label' => 'Czlonek 2', 'name' => 'ri_rada_card_2', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rada_c2_name', 'label' => 'Imie i nazwisko', 'name' => 'name', 'type' => 'text'], ['key' => 'field_ri_rada_c2_role', 'label' => 'Rola', 'name' => 'role', 'type' => 'text'], ['key' => 'field_ri_rada_c2_desc', 'label' => 'Opis', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3]]],
        ['key' => 'field_ri_rada_c3', 'label' => 'Czlonek 3', 'name' => 'ri_rada_card_3', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rada_c3_name', 'label' => 'Imie i nazwisko', 'name' => 'name', 'type' => 'text'], ['key' => 'field_ri_rada_c3_role', 'label' => 'Rola', 'name' => 'role', 'type' => 'text'], ['key' => 'field_ri_rada_c3_desc', 'label' => 'Opis', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3]]],
        ['key' => 'field_ri_rada_c4', 'label' => 'Czlonek 4', 'name' => 'ri_rada_card_4', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rada_c4_name', 'label' => 'Imie i nazwisko', 'name' => 'name', 'type' => 'text'], ['key' => 'field_ri_rada_c4_role', 'label' => 'Rola', 'name' => 'role', 'type' => 'text'], ['key' => 'field_ri_rada_c4_desc', 'label' => 'Opis', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3]]],
        ['key' => 'field_ri_rada_c5', 'label' => 'Czlonek 5', 'name' => 'ri_rada_card_5', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rada_c5_name', 'label' => 'Imie i nazwisko', 'name' => 'name', 'type' => 'text'], ['key' => 'field_ri_rada_c5_role', 'label' => 'Rola', 'name' => 'role', 'type' => 'text'], ['key' => 'field_ri_rada_c5_desc', 'label' => 'Opis', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3]]],
        ['key' => 'field_ri_rada_c6', 'label' => 'Czlonek 6', 'name' => 'ri_rada_card_6', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rada_c6_name', 'label' => 'Imie i nazwisko', 'name' => 'name', 'type' => 'text'], ['key' => 'field_ri_rada_c6_role', 'label' => 'Rola', 'name' => 'role', 'type' => 'text'], ['key' => 'field_ri_rada_c6_desc', 'label' => 'Opis', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3]]],
        ['key' => 'field_ri_rada_c7', 'label' => 'Czlonek 7', 'name' => 'ri_rada_card_7', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rada_c7_name', 'label' => 'Imie i nazwisko', 'name' => 'name', 'type' => 'text'], ['key' => 'field_ri_rada_c7_role', 'label' => 'Rola', 'name' => 'role', 'type' => 'text'], ['key' => 'field_ri_rada_c7_desc', 'label' => 'Opis', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3]]],
        ['key' => 'field_ri_rada_c8', 'label' => 'Czlonek 8', 'name' => 'ri_rada_card_8', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rada_c8_name', 'label' => 'Imie i nazwisko', 'name' => 'name', 'type' => 'text'], ['key' => 'field_ri_rada_c8_role', 'label' => 'Rola', 'name' => 'role', 'type' => 'text'], ['key' => 'field_ri_rada_c8_desc', 'label' => 'Opis', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3]]],
        ['key' => 'field_ri_rada_c9', 'label' => 'Czlonek 9', 'name' => 'ri_rada_card_9', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rada_c9_name', 'label' => 'Imie i nazwisko', 'name' => 'name', 'type' => 'text'], ['key' => 'field_ri_rada_c9_role', 'label' => 'Rola', 'name' => 'role', 'type' => 'text'], ['key' => 'field_ri_rada_c9_desc', 'label' => 'Opis', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3]]],

        // ── TAB: Lista nadzorcza ───────────────────────────────────
        ['key' => 'field_ri_tab_lista',  'label' => 'Lista nadzorcza', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_ri_lista_title','label' => 'Naglowek sekcji', 'name' => 'ri_lista_title', 'type' => 'text', 'default_value' => 'Lista nadzorcza'],
        ['key' => 'field_ri_lista_c1',  'label' => 'Czlonek 1', 'name' => 'ri_lista_card_1', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_lista_c1_name', 'label' => 'Imie i nazwisko', 'name' => 'name', 'type' => 'text'], ['key' => 'field_ri_lista_c1_role', 'label' => 'Rola / stanowisko', 'name' => 'role', 'type' => 'text'], ['key' => 'field_ri_lista_c1_desc', 'label' => 'Opis', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3]]],
        ['key' => 'field_ri_lista_c2',  'label' => 'Czlonek 2', 'name' => 'ri_lista_card_2', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_lista_c2_name', 'label' => 'Imie i nazwisko', 'name' => 'name', 'type' => 'text'], ['key' => 'field_ri_lista_c2_role', 'label' => 'Rola / stanowisko', 'name' => 'role', 'type' => 'text'], ['key' => 'field_ri_lista_c2_desc', 'label' => 'Opis', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3]]],
        ['key' => 'field_ri_lista_c3',  'label' => 'Czlonek 3', 'name' => 'ri_lista_card_3', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_lista_c3_name', 'label' => 'Imie i nazwisko', 'name' => 'name', 'type' => 'text'], ['key' => 'field_ri_lista_c3_role', 'label' => 'Rola / stanowisko', 'name' => 'role', 'type' => 'text'], ['key' => 'field_ri_lista_c3_desc', 'label' => 'Opis', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3]]],
        ['key' => 'field_ri_lista_c4',  'label' => 'Czlonek 4', 'name' => 'ri_lista_card_4', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_lista_c4_name', 'label' => 'Imie i nazwisko', 'name' => 'name', 'type' => 'text'], ['key' => 'field_ri_lista_c4_role', 'label' => 'Rola / stanowisko', 'name' => 'role', 'type' => 'text'], ['key' => 'field_ri_lista_c4_desc', 'label' => 'Opis', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3]]],
        ['key' => 'field_ri_lista_c5',  'label' => 'Czlonek 5', 'name' => 'ri_lista_card_5', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_lista_c5_name', 'label' => 'Imie i nazwisko', 'name' => 'name', 'type' => 'text'], ['key' => 'field_ri_lista_c5_role', 'label' => 'Rola / stanowisko', 'name' => 'role', 'type' => 'text'], ['key' => 'field_ri_lista_c5_desc', 'label' => 'Opis', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3]]],
        ['key' => 'field_ri_lista_c6',  'label' => 'Czlonek 6', 'name' => 'ri_lista_card_6', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_lista_c6_name', 'label' => 'Imie i nazwisko', 'name' => 'name', 'type' => 'text'], ['key' => 'field_ri_lista_c6_role', 'label' => 'Rola / stanowisko', 'name' => 'role', 'type' => 'text'], ['key' => 'field_ri_lista_c6_desc', 'label' => 'Opis', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3]]],
        ['key' => 'field_ri_lista_c7',  'label' => 'Czlonek 7', 'name' => 'ri_lista_card_7', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_lista_c7_name', 'label' => 'Imie i nazwisko', 'name' => 'name', 'type' => 'text'], ['key' => 'field_ri_lista_c7_role', 'label' => 'Rola / stanowisko', 'name' => 'role', 'type' => 'text'], ['key' => 'field_ri_lista_c7_desc', 'label' => 'Opis', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3]]],
        ['key' => 'field_ri_lista_c8',  'label' => 'Czlonek 8', 'name' => 'ri_lista_card_8', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_lista_c8_name', 'label' => 'Imie i nazwisko', 'name' => 'name', 'type' => 'text'], ['key' => 'field_ri_lista_c8_role', 'label' => 'Rola / stanowisko', 'name' => 'role', 'type' => 'text'], ['key' => 'field_ri_lista_c8_desc', 'label' => 'Opis', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3]]],
        ['key' => 'field_ri_lista_c9',  'label' => 'Czlonek 9', 'name' => 'ri_lista_card_9', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_lista_c9_name', 'label' => 'Imie i nazwisko', 'name' => 'name', 'type' => 'text'], ['key' => 'field_ri_lista_c9_role', 'label' => 'Rola / stanowisko', 'name' => 'role', 'type' => 'text'], ['key' => 'field_ri_lista_c9_desc', 'label' => 'Opis', 'name' => 'desc', 'type' => 'textarea', 'rows' => 3]]],

        // ── TAB: Akcjonariat ───────────────────────────────────────
        ['key' => 'field_ri_tab_akcjonariat',    'label' => 'Akcjonariat', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_ri_akcjonariat_title',  'label' => 'Naglowek sekcji',   'name' => 'ri_akcjonariat_title',    'type' => 'text',     'default_value' => 'Informacje o strukturze akcjonariatu'],
        ['key' => 'field_ri_akcjonariat_subtitle','label' => 'Tekst pod naglowkiem','name' => 'ri_akcjonariat_subtitle','type' => 'textarea', 'rows' => 2, 'default_value' => 'Kapital zakladowy spolki wynosi 120 000 PLN i dzieli sie na 1 200 000 akcji serii A o wartosci nominalnej 0,10 PLN.'],
        ['key' => 'field_ri_akcjonariat_col1',   'label' => 'Naglowek kolumny 1','name' => 'ri_akcjonariat_col1',    'type' => 'text',     'default_value' => 'Akcjonariusz'],
        ['key' => 'field_ri_akcjonariat_col2',   'label' => 'Naglowek kolumny 2','name' => 'ri_akcjonariat_col2',    'type' => 'text',     'default_value' => 'Laczna liczba posiadanych akcji'],
        ['key' => 'field_ri_akcjonariat_col3',   'label' => 'Naglowek kolumny 3','name' => 'ri_akcjonariat_col3',    'type' => 'text',     'default_value' => 'Udzial w lacznej liczbie glosow'],
        ['key' => 'field_ri_akc_r1',  'label' => 'Akcjonariusz 1',  'name' => 'ri_akcjonariat_row_1',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_akc_r1_sh',  'label' => 'Akcjonariusz',     'name' => 'shareholder', 'type' => 'text'], ['key' => 'field_ri_akc_r1_sh2',  'label' => 'Liczba akcji',     'name' => 'shares',      'type' => 'text'], ['key' => 'field_ri_akc_r1_v',  'label' => 'Udzial w glosach', 'name' => 'votes', 'type' => 'text']]],
        ['key' => 'field_ri_akc_r2',  'label' => 'Akcjonariusz 2',  'name' => 'ri_akcjonariat_row_2',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_akc_r2_sh',  'label' => 'Akcjonariusz',     'name' => 'shareholder', 'type' => 'text'], ['key' => 'field_ri_akc_r2_sh2',  'label' => 'Liczba akcji',     'name' => 'shares',      'type' => 'text'], ['key' => 'field_ri_akc_r2_v',  'label' => 'Udzial w glosach', 'name' => 'votes', 'type' => 'text']]],
        ['key' => 'field_ri_akc_r3',  'label' => 'Akcjonariusz 3',  'name' => 'ri_akcjonariat_row_3',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_akc_r3_sh',  'label' => 'Akcjonariusz',     'name' => 'shareholder', 'type' => 'text'], ['key' => 'field_ri_akc_r3_sh2',  'label' => 'Liczba akcji',     'name' => 'shares',      'type' => 'text'], ['key' => 'field_ri_akc_r3_v',  'label' => 'Udzial w glosach', 'name' => 'votes', 'type' => 'text']]],
        ['key' => 'field_ri_akc_r4',  'label' => 'Akcjonariusz 4',  'name' => 'ri_akcjonariat_row_4',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_akc_r4_sh',  'label' => 'Akcjonariusz',     'name' => 'shareholder', 'type' => 'text'], ['key' => 'field_ri_akc_r4_sh2',  'label' => 'Liczba akcji',     'name' => 'shares',      'type' => 'text'], ['key' => 'field_ri_akc_r4_v',  'label' => 'Udzial w glosach', 'name' => 'votes', 'type' => 'text']]],
        ['key' => 'field_ri_akc_r5',  'label' => 'Akcjonariusz 5',  'name' => 'ri_akcjonariat_row_5',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_akc_r5_sh',  'label' => 'Akcjonariusz',     'name' => 'shareholder', 'type' => 'text'], ['key' => 'field_ri_akc_r5_sh2',  'label' => 'Liczba akcji',     'name' => 'shares',      'type' => 'text'], ['key' => 'field_ri_akc_r5_v',  'label' => 'Udzial w glosach', 'name' => 'votes', 'type' => 'text']]],
        ['key' => 'field_ri_akc_r6',  'label' => 'Akcjonariusz 6',  'name' => 'ri_akcjonariat_row_6',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_akc_r6_sh',  'label' => 'Akcjonariusz',     'name' => 'shareholder', 'type' => 'text'], ['key' => 'field_ri_akc_r6_sh2',  'label' => 'Liczba akcji',     'name' => 'shares',      'type' => 'text'], ['key' => 'field_ri_akc_r6_v',  'label' => 'Udzial w glosach', 'name' => 'votes', 'type' => 'text']]],
        ['key' => 'field_ri_akc_r7',  'label' => 'Akcjonariusz 7',  'name' => 'ri_akcjonariat_row_7',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_akc_r7_sh',  'label' => 'Akcjonariusz',     'name' => 'shareholder', 'type' => 'text'], ['key' => 'field_ri_akc_r7_sh2',  'label' => 'Liczba akcji',     'name' => 'shares',      'type' => 'text'], ['key' => 'field_ri_akc_r7_v',  'label' => 'Udzial w glosach', 'name' => 'votes', 'type' => 'text']]],
        ['key' => 'field_ri_akc_r8',  'label' => 'Akcjonariusz 8',  'name' => 'ri_akcjonariat_row_8',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_akc_r8_sh',  'label' => 'Akcjonariusz',     'name' => 'shareholder', 'type' => 'text'], ['key' => 'field_ri_akc_r8_sh2',  'label' => 'Liczba akcji',     'name' => 'shares',      'type' => 'text'], ['key' => 'field_ri_akc_r8_v',  'label' => 'Udzial w glosach', 'name' => 'votes', 'type' => 'text']]],
        ['key' => 'field_ri_akc_r9',  'label' => 'Akcjonariusz 9',  'name' => 'ri_akcjonariat_row_9',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_akc_r9_sh',  'label' => 'Akcjonariusz',     'name' => 'shareholder', 'type' => 'text'], ['key' => 'field_ri_akc_r9_sh2',  'label' => 'Liczba akcji',     'name' => 'shares',      'type' => 'text'], ['key' => 'field_ri_akc_r9_v',  'label' => 'Udzial w glosach', 'name' => 'votes', 'type' => 'text']]],
        ['key' => 'field_ri_akc_r10', 'label' => 'Akcjonariusz 10', 'name' => 'ri_akcjonariat_row_10', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_akc_r10_sh', 'label' => 'Akcjonariusz',     'name' => 'shareholder', 'type' => 'text'], ['key' => 'field_ri_akc_r10_sh2', 'label' => 'Liczba akcji',     'name' => 'shares',      'type' => 'text'], ['key' => 'field_ri_akc_r10_v', 'label' => 'Udzial w glosach', 'name' => 'votes', 'type' => 'text']]],

        // ── TAB: Sprawozdania finansowe ────────────────────────────
        ['key' => 'field_ri_tab_spr',   'label' => 'Sprawozdania finansowe', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_ri_spr_title', 'label' => 'Naglowek sekcji', 'name' => 'ri_spr_title', 'type' => 'text', 'default_value' => 'Sprawozdania finansowe spolki'],
        ['key' => 'field_ri_spr_i1',  'label' => 'Pozycja 1',  'name' => 'ri_spr_item_1',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_spr_i1_label',  'label' => 'Nazwa',      'name' => 'label',    'type' => 'text'], ['key' => 'field_ri_spr_i1_pdf',  'label' => 'Plik PDF',  'name' => 'url_pdf',  'type' => 'file', 'return_format' => 'array'], ['key' => 'field_ri_spr_i1_xlsx',  'label' => 'Plik XLSX', 'name' => 'url_xlsx', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_spr_i2',  'label' => 'Pozycja 2',  'name' => 'ri_spr_item_2',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_spr_i2_label',  'label' => 'Nazwa',      'name' => 'label',    'type' => 'text'], ['key' => 'field_ri_spr_i2_pdf',  'label' => 'Plik PDF',  'name' => 'url_pdf',  'type' => 'file', 'return_format' => 'array'], ['key' => 'field_ri_spr_i2_xlsx',  'label' => 'Plik XLSX', 'name' => 'url_xlsx', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_spr_i3',  'label' => 'Pozycja 3',  'name' => 'ri_spr_item_3',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_spr_i3_label',  'label' => 'Nazwa',      'name' => 'label',    'type' => 'text'], ['key' => 'field_ri_spr_i3_pdf',  'label' => 'Plik PDF',  'name' => 'url_pdf',  'type' => 'file', 'return_format' => 'array'], ['key' => 'field_ri_spr_i3_xlsx',  'label' => 'Plik XLSX', 'name' => 'url_xlsx', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_spr_i4',  'label' => 'Pozycja 4',  'name' => 'ri_spr_item_4',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_spr_i4_label',  'label' => 'Nazwa',      'name' => 'label',    'type' => 'text'], ['key' => 'field_ri_spr_i4_pdf',  'label' => 'Plik PDF',  'name' => 'url_pdf',  'type' => 'file', 'return_format' => 'array'], ['key' => 'field_ri_spr_i4_xlsx',  'label' => 'Plik XLSX', 'name' => 'url_xlsx', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_spr_i5',  'label' => 'Pozycja 5',  'name' => 'ri_spr_item_5',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_spr_i5_label',  'label' => 'Nazwa',      'name' => 'label',    'type' => 'text'], ['key' => 'field_ri_spr_i5_pdf',  'label' => 'Plik PDF',  'name' => 'url_pdf',  'type' => 'file', 'return_format' => 'array'], ['key' => 'field_ri_spr_i5_xlsx',  'label' => 'Plik XLSX', 'name' => 'url_xlsx', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_spr_i6',  'label' => 'Pozycja 6',  'name' => 'ri_spr_item_6',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_spr_i6_label',  'label' => 'Nazwa',      'name' => 'label',    'type' => 'text'], ['key' => 'field_ri_spr_i6_pdf',  'label' => 'Plik PDF',  'name' => 'url_pdf',  'type' => 'file', 'return_format' => 'array'], ['key' => 'field_ri_spr_i6_xlsx',  'label' => 'Plik XLSX', 'name' => 'url_xlsx', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_spr_i7',  'label' => 'Pozycja 7',  'name' => 'ri_spr_item_7',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_spr_i7_label',  'label' => 'Nazwa',      'name' => 'label',    'type' => 'text'], ['key' => 'field_ri_spr_i7_pdf',  'label' => 'Plik PDF',  'name' => 'url_pdf',  'type' => 'file', 'return_format' => 'array'], ['key' => 'field_ri_spr_i7_xlsx',  'label' => 'Plik XLSX', 'name' => 'url_xlsx', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_spr_i8',  'label' => 'Pozycja 8',  'name' => 'ri_spr_item_8',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_spr_i8_label',  'label' => 'Nazwa',      'name' => 'label',    'type' => 'text'], ['key' => 'field_ri_spr_i8_pdf',  'label' => 'Plik PDF',  'name' => 'url_pdf',  'type' => 'file', 'return_format' => 'array'], ['key' => 'field_ri_spr_i8_xlsx',  'label' => 'Plik XLSX', 'name' => 'url_xlsx', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_spr_i9',  'label' => 'Pozycja 9',  'name' => 'ri_spr_item_9',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_spr_i9_label',  'label' => 'Nazwa',      'name' => 'label',    'type' => 'text'], ['key' => 'field_ri_spr_i9_pdf',  'label' => 'Plik PDF',  'name' => 'url_pdf',  'type' => 'file', 'return_format' => 'array'], ['key' => 'field_ri_spr_i9_xlsx',  'label' => 'Plik XLSX', 'name' => 'url_xlsx', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_spr_i10', 'label' => 'Pozycja 10', 'name' => 'ri_spr_item_10', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_spr_i10_label', 'label' => 'Nazwa',      'name' => 'label',    'type' => 'text'], ['key' => 'field_ri_spr_i10_pdf', 'label' => 'Plik PDF',  'name' => 'url_pdf',  'type' => 'file', 'return_format' => 'array'], ['key' => 'field_ri_spr_i10_xlsx', 'label' => 'Plik XLSX', 'name' => 'url_xlsx', 'type' => 'file', 'return_format' => 'array']]],

        // ── TAB: Sprawozdania zarządu ────────────────────────────
        ['key' => 'field_ri_tab_szar',   'label' => 'Sprawozdania zarządu', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_ri_szar_title', 'label' => 'Nagłówek sekcji', 'name' => 'ri_szar_title', 'type' => 'text', 'default_value' => 'Sprawozdania z działalności zarządu spółki'],
        ['key' => 'field_ri_szar_i1',  'label' => 'Pozycja 1',  'name' => 'ri_szar_item_1',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_szar_i1_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_szar_i1_pdf',  'label' => 'Plik PDF', 'name' => 'url_pdf', 'type' => 'file', 'return_format' => 'array', 'mime_types' => 'pdf']]],
        ['key' => 'field_ri_szar_i2',  'label' => 'Pozycja 2',  'name' => 'ri_szar_item_2',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_szar_i2_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_szar_i2_pdf',  'label' => 'Plik PDF', 'name' => 'url_pdf', 'type' => 'file', 'return_format' => 'array', 'mime_types' => 'pdf']]],
        ['key' => 'field_ri_szar_i3',  'label' => 'Pozycja 3',  'name' => 'ri_szar_item_3',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_szar_i3_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_szar_i3_pdf',  'label' => 'Plik PDF', 'name' => 'url_pdf', 'type' => 'file', 'return_format' => 'array', 'mime_types' => 'pdf']]],
        ['key' => 'field_ri_szar_i4',  'label' => 'Pozycja 4',  'name' => 'ri_szar_item_4',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_szar_i4_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_szar_i4_pdf',  'label' => 'Plik PDF', 'name' => 'url_pdf', 'type' => 'file', 'return_format' => 'array', 'mime_types' => 'pdf']]],
        ['key' => 'field_ri_szar_i5',  'label' => 'Pozycja 5',  'name' => 'ri_szar_item_5',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_szar_i5_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_szar_i5_pdf',  'label' => 'Plik PDF', 'name' => 'url_pdf', 'type' => 'file', 'return_format' => 'array', 'mime_types' => 'pdf']]],
        ['key' => 'field_ri_szar_i6',  'label' => 'Pozycja 6',  'name' => 'ri_szar_item_6',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_szar_i6_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_szar_i6_pdf',  'label' => 'Plik PDF', 'name' => 'url_pdf', 'type' => 'file', 'return_format' => 'array', 'mime_types' => 'pdf']]],
        ['key' => 'field_ri_szar_i7',  'label' => 'Pozycja 7',  'name' => 'ri_szar_item_7',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_szar_i7_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_szar_i7_pdf',  'label' => 'Plik PDF', 'name' => 'url_pdf', 'type' => 'file', 'return_format' => 'array', 'mime_types' => 'pdf']]],
        ['key' => 'field_ri_szar_i8',  'label' => 'Pozycja 8',  'name' => 'ri_szar_item_8',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_szar_i8_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_szar_i8_pdf',  'label' => 'Plik PDF', 'name' => 'url_pdf', 'type' => 'file', 'return_format' => 'array', 'mime_types' => 'pdf']]],
        ['key' => 'field_ri_szar_i9',  'label' => 'Pozycja 9',  'name' => 'ri_szar_item_9',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_szar_i9_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_szar_i9_pdf',  'label' => 'Plik PDF', 'name' => 'url_pdf', 'type' => 'file', 'return_format' => 'array', 'mime_types' => 'pdf']]],
        ['key' => 'field_ri_szar_i10', 'label' => 'Pozycja 10', 'name' => 'ri_szar_item_10', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_szar_i10_label', 'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_szar_i10_pdf', 'label' => 'Plik PDF', 'name' => 'url_pdf', 'type' => 'file', 'return_format' => 'array', 'mime_types' => 'pdf']]],

        // ── TAB: Ogłoszenia WZA ───────────────────────────────────
        ['key' => 'field_ri_tab_ogl',   'label' => 'Ogłoszenia WZA', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_ri_ogl_title', 'label' => 'Naglowek sekcji', 'name' => 'ri_ogl_title', 'type' => 'text', 'default_value' => 'Ogloszenia o zwolaniu Walnego Zgromadzenia Akcjonariuszy'],
        ['key' => 'field_ri_ogl_i1',  'label' => 'Ogloszenie 1',  'name' => 'ri_ogl_item_1',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_ogl_i1_label',  'label' => 'Nazwa',     'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_ogl_i1_file',  'label' => 'Plik dokumentu', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_ogl_i2',  'label' => 'Ogloszenie 2',  'name' => 'ri_ogl_item_2',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_ogl_i2_label',  'label' => 'Nazwa',     'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_ogl_i2_file',  'label' => 'Plik dokumentu', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_ogl_i3',  'label' => 'Ogloszenie 3',  'name' => 'ri_ogl_item_3',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_ogl_i3_label',  'label' => 'Nazwa',     'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_ogl_i3_file',  'label' => 'Plik dokumentu', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_ogl_i4',  'label' => 'Ogloszenie 4',  'name' => 'ri_ogl_item_4',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_ogl_i4_label',  'label' => 'Nazwa',     'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_ogl_i4_file',  'label' => 'Plik dokumentu', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_ogl_i5',  'label' => 'Ogloszenie 5',  'name' => 'ri_ogl_item_5',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_ogl_i5_label',  'label' => 'Nazwa',     'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_ogl_i5_file',  'label' => 'Plik dokumentu', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_ogl_i6',  'label' => 'Ogloszenie 6',  'name' => 'ri_ogl_item_6',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_ogl_i6_label',  'label' => 'Nazwa',     'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_ogl_i6_file',  'label' => 'Plik dokumentu', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_ogl_i7',  'label' => 'Ogloszenie 7',  'name' => 'ri_ogl_item_7',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_ogl_i7_label',  'label' => 'Nazwa',     'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_ogl_i7_file',  'label' => 'Plik dokumentu', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_ogl_i8',  'label' => 'Ogloszenie 8',  'name' => 'ri_ogl_item_8',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_ogl_i8_label',  'label' => 'Nazwa',     'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_ogl_i8_file',  'label' => 'Plik dokumentu', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_ogl_i9',  'label' => 'Ogloszenie 9',  'name' => 'ri_ogl_item_9',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_ogl_i9_label',  'label' => 'Nazwa',     'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_ogl_i9_file',  'label' => 'Plik dokumentu', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_ogl_i10', 'label' => 'Ogloszenie 10', 'name' => 'ri_ogl_item_10', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_ogl_i10_label', 'label' => 'Nazwa',     'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_ogl_i10_file', 'label' => 'Plik dokumentu', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],

        // ── TAB: Opinie biegłego rewidenta ────────────────────────
        ['key' => 'field_ri_tab_rew',   'label' => 'Opinie biegłego rewidenta', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_ri_rew_title', 'label' => 'Naglowek sekcji', 'name' => 'ri_rew_title', 'type' => 'text', 'default_value' => 'Opinie bieglego rewidenta'],
        ['key' => 'field_ri_rew_i1',  'label' => 'Opinia 1',  'name' => 'ri_rew_item_1',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rew_i1_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rew_i1_file',  'label' => 'Plik PDF', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rew_i2',  'label' => 'Opinia 2',  'name' => 'ri_rew_item_2',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rew_i2_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rew_i2_file',  'label' => 'Plik PDF', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rew_i3',  'label' => 'Opinia 3',  'name' => 'ri_rew_item_3',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rew_i3_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rew_i3_file',  'label' => 'Plik PDF', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rew_i4',  'label' => 'Opinia 4',  'name' => 'ri_rew_item_4',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rew_i4_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rew_i4_file',  'label' => 'Plik PDF', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rew_i5',  'label' => 'Opinia 5',  'name' => 'ri_rew_item_5',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rew_i5_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rew_i5_file',  'label' => 'Plik PDF', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rew_i6',  'label' => 'Opinia 6',  'name' => 'ri_rew_item_6',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rew_i6_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rew_i6_file',  'label' => 'Plik PDF', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rew_i7',  'label' => 'Opinia 7',  'name' => 'ri_rew_item_7',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rew_i7_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rew_i7_file',  'label' => 'Plik PDF', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rew_i8',  'label' => 'Opinia 8',  'name' => 'ri_rew_item_8',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rew_i8_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rew_i8_file',  'label' => 'Plik PDF', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rew_i9',  'label' => 'Opinia 9',  'name' => 'ri_rew_item_9',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rew_i9_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rew_i9_file',  'label' => 'Plik PDF', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rew_i10', 'label' => 'Opinia 10', 'name' => 'ri_rew_item_10', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rew_i10_label', 'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rew_i10_file', 'label' => 'Plik PDF', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],

        // ── TAB: Monitor Sądowy i Gospodarczy ─────────────────────
        ['key' => 'field_ri_tab_msg',   'label' => 'Monitor Sadowy i Gospodarczy', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_ri_msg_title', 'label' => 'Naglowek sekcji', 'name' => 'ri_msg_title', 'type' => 'text', 'default_value' => 'Ogloszenia w Monitorze Sadowym i Gospodarczym'],
        ['key' => 'field_ri_msg_i1',  'label' => 'Ogloszenie MSG 1',  'name' => 'ri_msg_item_1',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_msg_i1_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_msg_i1_file',  'label' => 'Plik dokumentu', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_msg_i2',  'label' => 'Ogloszenie MSG 2',  'name' => 'ri_msg_item_2',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_msg_i2_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_msg_i2_file',  'label' => 'Plik dokumentu', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_msg_i3',  'label' => 'Ogloszenie MSG 3',  'name' => 'ri_msg_item_3',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_msg_i3_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_msg_i3_file',  'label' => 'Plik dokumentu', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_msg_i4',  'label' => 'Ogloszenie MSG 4',  'name' => 'ri_msg_item_4',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_msg_i4_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_msg_i4_file',  'label' => 'Plik dokumentu', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_msg_i5',  'label' => 'Ogloszenie MSG 5',  'name' => 'ri_msg_item_5',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_msg_i5_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_msg_i5_file',  'label' => 'Plik dokumentu', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_msg_i6',  'label' => 'Ogloszenie MSG 6',  'name' => 'ri_msg_item_6',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_msg_i6_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_msg_i6_file',  'label' => 'Plik dokumentu', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_msg_i7',  'label' => 'Ogloszenie MSG 7',  'name' => 'ri_msg_item_7',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_msg_i7_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_msg_i7_file',  'label' => 'Plik dokumentu', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_msg_i8',  'label' => 'Ogloszenie MSG 8',  'name' => 'ri_msg_item_8',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_msg_i8_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_msg_i8_file',  'label' => 'Plik dokumentu', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_msg_i9',  'label' => 'Ogloszenie MSG 9',  'name' => 'ri_msg_item_9',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_msg_i9_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_msg_i9_file',  'label' => 'Plik dokumentu', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_msg_i10', 'label' => 'Ogloszenie MSG 10', 'name' => 'ri_msg_item_10', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_msg_i10_label', 'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_msg_i10_file', 'label' => 'Plik dokumentu', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],

        // ── TAB: Uchwały WZA ──────────────────────────────────────
        ['key' => 'field_ri_tab_uch',   'label' => 'Uchwaly WZA', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_ri_uch_title', 'label' => 'Naglowek sekcji', 'name' => 'ri_uch_title', 'type' => 'text', 'default_value' => 'Uchwaly podejmowane przez Zgromadzenie Akcjonariuszy'],
        ['key' => 'field_ri_uch_i1',  'label' => 'Uchwala 1',  'name' => 'ri_uch_item_1',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_uch_i1_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_uch_i1_file',  'label' => 'Plik PDF', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_uch_i2',  'label' => 'Uchwala 2',  'name' => 'ri_uch_item_2',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_uch_i2_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_uch_i2_file',  'label' => 'Plik PDF', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_uch_i3',  'label' => 'Uchwala 3',  'name' => 'ri_uch_item_3',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_uch_i3_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_uch_i3_file',  'label' => 'Plik PDF', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_uch_i4',  'label' => 'Uchwala 4',  'name' => 'ri_uch_item_4',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_uch_i4_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_uch_i4_file',  'label' => 'Plik PDF', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_uch_i5',  'label' => 'Uchwala 5',  'name' => 'ri_uch_item_5',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_uch_i5_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_uch_i5_file',  'label' => 'Plik PDF', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_uch_i6',  'label' => 'Uchwala 6',  'name' => 'ri_uch_item_6',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_uch_i6_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_uch_i6_file',  'label' => 'Plik PDF', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_uch_i7',  'label' => 'Uchwala 7',  'name' => 'ri_uch_item_7',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_uch_i7_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_uch_i7_file',  'label' => 'Plik PDF', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_uch_i8',  'label' => 'Uchwala 8',  'name' => 'ri_uch_item_8',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_uch_i8_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_uch_i8_file',  'label' => 'Plik PDF', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_uch_i9',  'label' => 'Uchwala 9',  'name' => 'ri_uch_item_9',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_uch_i9_label',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_uch_i9_file',  'label' => 'Plik PDF', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_uch_i10', 'label' => 'Uchwala 10', 'name' => 'ri_uch_item_10', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_uch_i10_label', 'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_uch_i10_file', 'label' => 'Plik PDF', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],

        // ── TAB: Raporty kwartalne ─────────────────────────────────
        ['key' => 'field_ri_tab_rap_kw',   'label' => 'Raporty kwartalne', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_ri_rap_kw_title', 'label' => 'Naglowek sekcji', 'name' => 'ri_rap_kw_title', 'type' => 'text', 'default_value' => 'Raporty kwartalne spolki'],
        ['key' => 'field_ri_rap_kw_i1',  'label' => 'Raport KW 1',  'name' => 'ri_rap_kw_item_1',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_kw_i1_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_kw_i1_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_kw_i2',  'label' => 'Raport KW 2',  'name' => 'ri_rap_kw_item_2',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_kw_i2_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_kw_i2_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_kw_i3',  'label' => 'Raport KW 3',  'name' => 'ri_rap_kw_item_3',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_kw_i3_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_kw_i3_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_kw_i4',  'label' => 'Raport KW 4',  'name' => 'ri_rap_kw_item_4',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_kw_i4_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_kw_i4_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_kw_i5',  'label' => 'Raport KW 5',  'name' => 'ri_rap_kw_item_5',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_kw_i5_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_kw_i5_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_kw_i6',  'label' => 'Raport KW 6',  'name' => 'ri_rap_kw_item_6',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_kw_i6_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_kw_i6_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_kw_i7',  'label' => 'Raport KW 7',  'name' => 'ri_rap_kw_item_7',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_kw_i7_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_kw_i7_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_kw_i8',  'label' => 'Raport KW 8',  'name' => 'ri_rap_kw_item_8',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_kw_i8_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_kw_i8_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_kw_i9',  'label' => 'Raport KW 9',  'name' => 'ri_rap_kw_item_9',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_kw_i9_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_kw_i9_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_kw_i10', 'label' => 'Raport KW 10', 'name' => 'ri_rap_kw_item_10', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_kw_i10_l', 'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_kw_i10_f', 'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],

        // ── TAB: Raporty EBI/ESPI ─────────────────────────────────
        ['key' => 'field_ri_tab_rap_ebi',   'label' => 'Raporty EBI/ESPI', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_ri_rap_ebi_title', 'label' => 'Naglowek sekcji', 'name' => 'ri_rap_ebi_title', 'type' => 'text', 'default_value' => 'Raporty EBI/ESPI'],
        ['key' => 'field_ri_rap_ebi_i1',  'label' => 'EBI/ESPI 1',  'name' => 'ri_rap_ebi_item_1',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_ebi_i1_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_ebi_i1_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_ebi_i2',  'label' => 'EBI/ESPI 2',  'name' => 'ri_rap_ebi_item_2',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_ebi_i2_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_ebi_i2_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_ebi_i3',  'label' => 'EBI/ESPI 3',  'name' => 'ri_rap_ebi_item_3',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_ebi_i3_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_ebi_i3_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_ebi_i4',  'label' => 'EBI/ESPI 4',  'name' => 'ri_rap_ebi_item_4',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_ebi_i4_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_ebi_i4_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_ebi_i5',  'label' => 'EBI/ESPI 5',  'name' => 'ri_rap_ebi_item_5',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_ebi_i5_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_ebi_i5_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_ebi_i6',  'label' => 'EBI/ESPI 6',  'name' => 'ri_rap_ebi_item_6',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_ebi_i6_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_ebi_i6_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_ebi_i7',  'label' => 'EBI/ESPI 7',  'name' => 'ri_rap_ebi_item_7',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_ebi_i7_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_ebi_i7_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_ebi_i8',  'label' => 'EBI/ESPI 8',  'name' => 'ri_rap_ebi_item_8',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_ebi_i8_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_ebi_i8_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_ebi_i9',  'label' => 'EBI/ESPI 9',  'name' => 'ri_rap_ebi_item_9',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_ebi_i9_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_ebi_i9_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_ebi_i10', 'label' => 'EBI/ESPI 10', 'name' => 'ri_rap_ebi_item_10', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_ebi_i10_l', 'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_ebi_i10_f', 'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],

        // ── TAB: Animator Rynku ────────────────────────────────────
        ['key' => 'field_ri_tab_rap_an',   'label' => 'Animator Rynku', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_ri_rap_an_title', 'label' => 'Naglowek sekcji', 'name' => 'ri_rap_an_title', 'type' => 'text', 'default_value' => 'Animator Rynku'],
        ['key' => 'field_ri_rap_an_i1',  'label' => 'AN 1',  'name' => 'ri_rap_an_item_1',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_an_i1_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_an_i1_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_an_i2',  'label' => 'AN 2',  'name' => 'ri_rap_an_item_2',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_an_i2_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_an_i2_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_an_i3',  'label' => 'AN 3',  'name' => 'ri_rap_an_item_3',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_an_i3_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_an_i3_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_an_i4',  'label' => 'AN 4',  'name' => 'ri_rap_an_item_4',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_an_i4_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_an_i4_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_an_i5',  'label' => 'AN 5',  'name' => 'ri_rap_an_item_5',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_an_i5_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_an_i5_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_an_i6',  'label' => 'AN 6',  'name' => 'ri_rap_an_item_6',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_an_i6_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_an_i6_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_an_i7',  'label' => 'AN 7',  'name' => 'ri_rap_an_item_7',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_an_i7_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_an_i7_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_an_i8',  'label' => 'AN 8',  'name' => 'ri_rap_an_item_8',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_an_i8_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_an_i8_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_an_i9',  'label' => 'AN 9',  'name' => 'ri_rap_an_item_9',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_an_i9_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_an_i9_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_an_i10', 'label' => 'AN 10', 'name' => 'ri_rap_an_item_10', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_an_i10_l', 'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_an_i10_f', 'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],

        // ── TAB: Autoryzowany Doradca ──────────────────────────────
        ['key' => 'field_ri_tab_rap_ad',   'label' => 'Autoryzowany Doradca', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_ri_rap_ad_title', 'label' => 'Naglowek sekcji', 'name' => 'ri_rap_ad_title', 'type' => 'text', 'default_value' => 'Autoryzowany Doradca'],
        ['key' => 'field_ri_rap_ad_i1',  'label' => 'AD 1',  'name' => 'ri_rap_ad_item_1',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_ad_i1_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_ad_i1_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_ad_i2',  'label' => 'AD 2',  'name' => 'ri_rap_ad_item_2',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_ad_i2_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_ad_i2_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_ad_i3',  'label' => 'AD 3',  'name' => 'ri_rap_ad_item_3',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_ad_i3_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_ad_i3_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_ad_i4',  'label' => 'AD 4',  'name' => 'ri_rap_ad_item_4',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_ad_i4_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_ad_i4_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_ad_i5',  'label' => 'AD 5',  'name' => 'ri_rap_ad_item_5',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_ad_i5_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_ad_i5_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_ad_i6',  'label' => 'AD 6',  'name' => 'ri_rap_ad_item_6',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_ad_i6_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_ad_i6_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_ad_i7',  'label' => 'AD 7',  'name' => 'ri_rap_ad_item_7',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_ad_i7_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_ad_i7_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_ad_i8',  'label' => 'AD 8',  'name' => 'ri_rap_ad_item_8',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_ad_i8_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_ad_i8_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_ad_i9',  'label' => 'AD 9',  'name' => 'ri_rap_ad_item_9',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_ad_i9_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_ad_i9_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_ad_i10', 'label' => 'AD 10', 'name' => 'ri_rap_ad_item_10', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_ad_i10_l', 'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_ad_i10_f', 'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],

        // ── TAB: Pytania i odpowiedzi ──────────────────────────────
        ['key' => 'field_ri_tab_rap_qa',   'label' => 'Pytania i odpowiedzi', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_ri_rap_qa_title', 'label' => 'Naglowek sekcji', 'name' => 'ri_rap_qa_title', 'type' => 'text', 'default_value' => 'Pytania i odpowiedzi'],
        ['key' => 'field_ri_rap_qa_i1',  'label' => 'QA 1',  'name' => 'ri_rap_qa_item_1',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_qa_i1_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_qa_i1_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_qa_i2',  'label' => 'QA 2',  'name' => 'ri_rap_qa_item_2',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_qa_i2_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_qa_i2_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_qa_i3',  'label' => 'QA 3',  'name' => 'ri_rap_qa_item_3',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_qa_i3_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_qa_i3_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_qa_i4',  'label' => 'QA 4',  'name' => 'ri_rap_qa_item_4',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_qa_i4_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_qa_i4_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_qa_i5',  'label' => 'QA 5',  'name' => 'ri_rap_qa_item_5',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_qa_i5_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_qa_i5_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_qa_i6',  'label' => 'QA 6',  'name' => 'ri_rap_qa_item_6',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_qa_i6_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_qa_i6_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_qa_i7',  'label' => 'QA 7',  'name' => 'ri_rap_qa_item_7',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_qa_i7_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_qa_i7_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_qa_i8',  'label' => 'QA 8',  'name' => 'ri_rap_qa_item_8',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_qa_i8_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_qa_i8_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_qa_i9',  'label' => 'QA 9',  'name' => 'ri_rap_qa_item_9',  'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_qa_i9_l',  'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_qa_i9_f',  'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],
        ['key' => 'field_ri_rap_qa_i10', 'label' => 'QA 10', 'name' => 'ri_rap_qa_item_10', 'type' => 'group', 'sub_fields' => [['key' => 'field_ri_rap_qa_i10_l', 'label' => 'Nazwa', 'name' => 'label', 'type' => 'text'], ['key' => 'field_ri_rap_qa_i10_f', 'label' => 'Plik', 'name' => 'file', 'type' => 'file', 'return_format' => 'array']]],

    ],
]);


// ============================================================
// OFERTA PRACY – szczegóły (szablon: page-oferta-pracy.php)
// ============================================================
acf_add_local_field_group([
    'key'   => 'group_mer_oferta_pracy',
    'title' => '📋 Oferta pracy – szczegóły',
    'fields' => [

        // ── TAB: Hero ─────────────────────────────────────────
        ['key' => 'field_op_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_op_title',    'label' => 'Tytuł stanowiska (h1)', 'name' => 'op_title',    'type' => 'text',  'instructions' => 'Np. Księgowa / Księgowy z językiem ukraińskim'],
        ['key' => 'field_op_salary',   'label' => 'Wynagrodzenie',         'name' => 'op_salary',   'type' => 'text',  'default_value' => '6 500 – 7 500 zł brutto'],
        ['key' => 'field_op_location', 'label' => 'Lokalizacja / tryb',    'name' => 'op_location', 'type' => 'text',  'default_value' => 'Praca zdalna'],
        ['key' => 'field_op_category', 'label' => 'Dział',                 'name' => 'op_category', 'type' => 'text',  'default_value' => 'Księgowość'],
        ['key' => 'field_op_hero_bg',  'label' => 'Zdjęcie tła hero',      'name' => 'op_hero_bg',  'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],

        // ── TAB: Wstęp ───────────────────────────────────────
        ['key' => 'field_op_tab_intro', 'label' => 'Wstęp (opcjonalny)', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_op_intro', 'label' => 'Akapit wstępny', 'name' => 'op_intro', 'type' => 'textarea',
         'instructions' => 'Opcjonalny akapit wyświetlany nad zakresem obowiązków i wymaganiami. Zostaw puste, jeśli nie potrzebujesz.',
         'rows' => 6, 'new_lines' => 'br'],
        ['key' => 'field_op_team_info', 'label' => 'Informacje o zespole', 'name' => 'op_team_info', 'type' => 'textarea',
         'instructions' => 'Opcjonalny akapit o zespole, wyświetlany pod wstępem. Zostaw puste, jeśli nie potrzebujesz.',
         'rows' => 5, 'new_lines' => 'br'],

        // ── TAB: Obowiązki ────────────────────────────────────
        ['key' => 'field_op_tab_duty', 'label' => 'Zakres obowiązków', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_op_duty_1',  'label' => 'Obowiązek 1',  'name' => 'op_duty_1',  'type' => 'text'],
        ['key' => 'field_op_duty_2',  'label' => 'Obowiązek 2',  'name' => 'op_duty_2',  'type' => 'text'],
        ['key' => 'field_op_duty_3',  'label' => 'Obowiązek 3',  'name' => 'op_duty_3',  'type' => 'text'],
        ['key' => 'field_op_duty_4',  'label' => 'Obowiązek 4',  'name' => 'op_duty_4',  'type' => 'text'],
        ['key' => 'field_op_duty_5',  'label' => 'Obowiązek 5',  'name' => 'op_duty_5',  'type' => 'text'],
        ['key' => 'field_op_duty_6',  'label' => 'Obowiązek 6',  'name' => 'op_duty_6',  'type' => 'text'],
        ['key' => 'field_op_duty_7',  'label' => 'Obowiązek 7',  'name' => 'op_duty_7',  'type' => 'text'],
        ['key' => 'field_op_duty_8',  'label' => 'Obowiązek 8',  'name' => 'op_duty_8',  'type' => 'text'],
        ['key' => 'field_op_duty_9',  'label' => 'Obowiązek 9',  'name' => 'op_duty_9',  'type' => 'text'],
        ['key' => 'field_op_duty_10', 'label' => 'Obowiązek 10', 'name' => 'op_duty_10', 'type' => 'text'],
        ['key' => 'field_op_duty_11', 'label' => 'Obowiązek 11', 'name' => 'op_duty_11', 'type' => 'text'],
        ['key' => 'field_op_duty_12', 'label' => 'Obowiązek 12', 'name' => 'op_duty_12', 'type' => 'text'],

        // ── TAB: Wymagania ────────────────────────────────────
        ['key' => 'field_op_tab_req', 'label' => 'Wymagania', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_op_req_1',  'label' => 'Wymaganie 1',  'name' => 'op_req_1',  'type' => 'text'],
        ['key' => 'field_op_req_2',  'label' => 'Wymaganie 2',  'name' => 'op_req_2',  'type' => 'text'],
        ['key' => 'field_op_req_3',  'label' => 'Wymaganie 3',  'name' => 'op_req_3',  'type' => 'text'],
        ['key' => 'field_op_req_4',  'label' => 'Wymaganie 4',  'name' => 'op_req_4',  'type' => 'text'],
        ['key' => 'field_op_req_5',  'label' => 'Wymaganie 5',  'name' => 'op_req_5',  'type' => 'text'],
        ['key' => 'field_op_req_6',  'label' => 'Wymaganie 6',  'name' => 'op_req_6',  'type' => 'text'],
        ['key' => 'field_op_req_7',  'label' => 'Wymaganie 7',  'name' => 'op_req_7',  'type' => 'text'],
        ['key' => 'field_op_req_8',  'label' => 'Wymaganie 8',  'name' => 'op_req_8',  'type' => 'text'],
        ['key' => 'field_op_req_9',  'label' => 'Wymaganie 9',  'name' => 'op_req_9',  'type' => 'text'],
        ['key' => 'field_op_req_10', 'label' => 'Wymaganie 10', 'name' => 'op_req_10', 'type' => 'text'],
        ['key' => 'field_op_req_11', 'label' => 'Wymaganie 11', 'name' => 'op_req_11', 'type' => 'text'],
        ['key' => 'field_op_req_12', 'label' => 'Wymaganie 12', 'name' => 'op_req_12', 'type' => 'text'],

        // ── TAB: Środowisko technologiczne ───────────────────
        ['key' => 'field_op_tab_tech', 'label' => 'Środowisko technologiczne', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_op_tech_1', 'label' => 'Narzędzie / technologia 1', 'name' => 'op_tech_1', 'type' => 'text'],
        ['key' => 'field_op_tech_2', 'label' => 'Narzędzie / technologia 2', 'name' => 'op_tech_2', 'type' => 'text'],
        ['key' => 'field_op_tech_3', 'label' => 'Narzędzie / technologia 3', 'name' => 'op_tech_3', 'type' => 'text'],
        ['key' => 'field_op_tech_4', 'label' => 'Narzędzie / technologia 4', 'name' => 'op_tech_4', 'type' => 'text'],
        ['key' => 'field_op_tech_5', 'label' => 'Narzędzie / technologia 5', 'name' => 'op_tech_5', 'type' => 'text'],
        ['key' => 'field_op_tech_6', 'label' => 'Narzędzie / technologia 6', 'name' => 'op_tech_6', 'type' => 'text'],

        // ── TAB: Mile widziane ───────────────────────────────
        ['key' => 'field_op_tab_nice', 'label' => 'Mile widziane', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_op_nice_1', 'label' => 'Mile widziane 1', 'name' => 'op_nice_1', 'type' => 'text'],
        ['key' => 'field_op_nice_2', 'label' => 'Mile widziane 2', 'name' => 'op_nice_2', 'type' => 'text'],
        ['key' => 'field_op_nice_3', 'label' => 'Mile widziane 3', 'name' => 'op_nice_3', 'type' => 'text'],
        ['key' => 'field_op_nice_4', 'label' => 'Mile widziane 4', 'name' => 'op_nice_4', 'type' => 'text'],
        ['key' => 'field_op_nice_5', 'label' => 'Mile widziane 5', 'name' => 'op_nice_5', 'type' => 'text'],
        ['key' => 'field_op_nice_6', 'label' => 'Mile widziane 6', 'name' => 'op_nice_6', 'type' => 'text'],

        // ── TAB: Aplikuj ──────────────────────────────────────
        ['key' => 'field_op_tab_apply', 'label' => 'Aplikuj', 'name' => '', 'type' => 'tab'],
        ['key' => 'field_op_cv_url', 'label' => 'Link do aplikowania (Traffit)', 'name' => 'op_cv_url', 'type' => 'url',
         'default_value' => '', 'instructions' => 'Wklej link do tej oferty w Traffit. Przycisk "Wyślij CV" otworzy go w nowej karcie.'],

    ],
    'location' => [
        [['param' => 'page_template', 'operator' => '==', 'value' => 'page-oferta-pracy.php']],
    ],
    'menu_order' => 10,
    'position'   => 'normal',
]);


