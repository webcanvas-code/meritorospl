<?php
defined('ABSPATH') || exit;

/* ------------------------------------------------------------------
   PDF Document URLs
------------------------------------------------------------------ */
define('MER_PRIVACY_PDF', get_template_directory_uri() . '/docs/Polityka-prywatnosci.pdf');
define('MER_TERMS_PDF',   get_template_directory_uri() . '/docs/Regulamin_newsletter.pdf');

/* ------------------------------------------------------------------
   Theme Setup
------------------------------------------------------------------ */
function meritoros_setup(): void {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'gallery', 'caption', 'script', 'style']);
    add_theme_support('custom-logo');

    load_theme_textdomain('meritoros', get_template_directory() . '/languages');

    register_nav_menus([
        'primary' => __('Menu główne', 'meritoros'),
        'footer'  => __('Menu stopki', 'meritoros'),
    ]);
}
add_action('after_setup_theme', 'meritoros_setup');

/* ------------------------------------------------------------------
   Auto-create Primary nav menu if missing or incomplete
------------------------------------------------------------------ */
function mer_create_primary_menu(): void {
    // Sprawdź czy Primary ma menu z co najmniej 2 pozycjami
    $locations = get_nav_menu_locations();
    if (!empty($locations['primary'])) {
        $existing_obj   = wp_get_nav_menu_object($locations['primary']);
        $existing_items = $existing_obj ? wp_get_nav_menu_items($existing_obj->term_id) : [];
        if (count(array_filter($existing_items, fn($i) => !$i->menu_item_parent)) >= 2) {
            return; // Menu jest OK — nie ruszamy
        }
    }

    // Utwórz (lub znajdź) menu o nazwie "Menu główne"
    $menu_name = 'Menu główne';
    $menu_obj  = wp_get_nav_menu_object($menu_name);
    $menu_id   = $menu_obj ? $menu_obj->term_id : wp_create_nav_menu($menu_name);
    if (is_wp_error($menu_id)) return;

    // Usuń stare pozycje żeby zacząć od czystego stanu
    foreach (wp_get_nav_menu_items($menu_id) ?: [] as $old) {
        wp_delete_post($old->ID, true);
    }

    // Helper: dodaj pozycję do menu
    $add = function (string $title, string $url, int $parent = 0) use ($menu_id): int {
        return (int) wp_update_nav_menu_item($menu_id, 0, [
            'menu-item-title'     => $title,
            'menu-item-url'       => $url,
            'menu-item-status'    => 'publish',
            'menu-item-type'      => 'custom',
            'menu-item-parent-id' => $parent,
        ]);
    };

    // Buduj strukturę menu
    $biuro   = $add('Biuro rachunkowe', '#');
                $add('Usługi księgowe',   home_url('/uslugi-ksiegowe/'),          $biuro);
                $add('Kadry i płace',     home_url('/kadry-i-place/'),            $biuro);
                $add('Fundacje rodzinne', home_url('/fundacje-rodzinne/'),        $biuro);

    $add('BPO', home_url('/bpo/'));

    $onas    = $add('O nas', home_url('/o-nas/'));
                $add('O nas',                    home_url('/o-nas/'),                     $onas);
                $add('Kupimy biuro rachunkowe',  home_url('/kupimy-biuro-rachunkowe/'),   $onas);
                $add('Relacje inwestorskie',      home_url('/relacje-inwestorskie/'),      $onas);

    $odkryj  = $add('Odkryj', '#');
                $add('Wiedza i poradniki', home_url('/blog/'),              $odkryj);
                $add('Media i newsroom',   home_url('/media/'),             $odkryj);
                $add('Historie klientów',  home_url('/historie-klientow/'), $odkryj);

    $add('Kariera', home_url('/kariera/'));

    // Przypisz do lokalizacji Primary
    $locs            = get_nav_menu_locations();
    $locs['primary'] = $menu_id;
    set_theme_mod('nav_menu_locations', $locs);
}
add_action('init', 'mer_create_primary_menu');

/* ------------------------------------------------------------------
   Enqueue Scripts & Styles
------------------------------------------------------------------ */
function meritoros_scripts(): void {
    $dir = get_template_directory();
    $uri = get_template_directory_uri();

    // Host Grotesk — self-hosted (brak zewnętrznego requesta do Google)
    wp_enqueue_style(
        'meritoros-fonts',
        $uri . '/assets/css/fonts.css',
        [],
        filemtime($dir . '/assets/css/fonts.css')
    );

    // Tailwind — skompilowany build (zamiast CDN ~400 KB)
    wp_enqueue_style(
        'meritoros-tailwind',
        $uri . '/assets/css/tailwind.build.css',
        [],
        filemtime($dir . '/assets/css/tailwind.build.css')
    );

    // Niestandardowe style motywu (CF7, animacje, overrides)
    wp_enqueue_style(
        'meritoros-style',
        get_stylesheet_uri(),
        ['meritoros-tailwind'],
        filemtime($dir . '/style.css')
    );

    // Lucide icons (lokalnie — brak zależności od zewnętrznego CDN)
    wp_enqueue_script('lucide', $uri . '/assets/js/lucide.min.js', [], '0.511.0', true);

    // Main theme script
    wp_enqueue_script(
        'meritoros-main',
        $uri . '/assets/js/main.js',
        ['lucide'],
        filemtime($dir . '/assets/js/main.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'meritoros_scripts');

/* ------------------------------------------------------------------
   SVG upload support
------------------------------------------------------------------ */
add_filter('upload_mimes', function (array $mimes): array {
    $mimes['svg']  = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
});

add_filter('wp_check_filetype_and_ext', function (array $data, string $file, string $filename): array {
    if (str_ends_with(strtolower($filename), '.svg')) {
        $data['ext']  = 'svg';
        $data['type'] = 'image/svg+xml';
    }
    return $data;
}, 10, 3);



/* ------------------------------------------------------------------
   CF7 — disable auto-paragraph wrapping
------------------------------------------------------------------ */
add_filter('wpcf7_autop_or_not', '__return_false');

/* ------------------------------------------------------------------
   CF7 — auto-create forms & assign IDs to ACF fields
------------------------------------------------------------------ */
add_action('init', 'mer_maybe_setup_cf7_forms', 20);

function mer_maybe_setup_cf7_forms(): void {
    if (!class_exists('WPCF7_ContactForm')) return;
    if (!function_exists('update_field'))    return;
    if (get_option('mer_cf7_setup_v1'))      return;
    mer_setup_cf7_forms();
}

function mer_setup_cf7_forms(): void {
    $privacy_url = MER_PRIVACY_PDF;
    $terms_url   = MER_TERMS_PDF;
    $admin_email = get_option('admin_email');
    $site_name   = get_bloginfo('name');

    $forms = [
        [
            'title'       => '[Meritoros] Formularz kontaktowy',
            'form'        => mer_cf7_body_kontakt($privacy_url),
            'mail_subject'=> '[Meritoros] Nowe zapytanie od [your-name]',
            'mail_body'   => "Imię i nazwisko: [your-name]\nE-mail: [your-email]\nTelefon: [your-phone]\nObszar: [your-area]\n\nWiadomość:\n[your-message]",
            'reply_to'    => '[your-email]',
            'attachments' => '[your-attachment]',
            'template'    => 'page-kontakt.php',
            'acf_field'   => 'kon_cf7_id',
            'option_key'  => 'mer_cf7_kontakt_id',
        ],
        [
            'title'       => '[Meritoros] Formularz — Kupimy biuro rachunkowe',
            'form'        => mer_cf7_body_kupimy($privacy_url),
            'mail_subject'=> '[Meritoros] Nowe zapytanie — Kupimy biuro rachunkowe od [your-name]',
            'mail_body'   => "Imię i nazwisko: [your-name]\nE-mail: [your-email]\n\nWiadomość:\n[your-message]",
            'reply_to'    => '[your-email]',
            'attachments' => '',
            'template'    => 'page-kupimy-biuro-rachunkowe.php',
            'acf_field'   => 'kupimy_cf7_id',
            'option_key'  => 'mer_cf7_kupimy_id',
        ],
        [
            'title'       => '[Meritoros] Formularz CV — Kariera',
            'form'        => mer_cf7_body_cv($privacy_url),
            'mail_subject'=> '[Meritoros] Nowe CV od [your-name]',
            'mail_body'   => "Imię i nazwisko: [your-name]\nE-mail: [your-email]\nTelefon: [your-phone]\n\nWiadomość:\n[your-message]",
            'reply_to'    => '[your-email]',
            'attachments' => '[your-cv]',
            'template'    => 'page-kariera.php',
            'acf_field'   => 'kar_cf7_id',
            'option_key'  => 'mer_cf7_kariera_id',
        ],
        [
            'title'       => '[Meritoros] Newsletter',
            'form'        => mer_cf7_body_newsletter($privacy_url, $terms_url),
            'mail_subject'=> '[Meritoros] Nowy zapis do newslettera',
            'mail_body'   => "Nowy zapis do newslettera.\nE-mail: [your-email]",
            'reply_to'    => '',
            'attachments' => '',
            'template'    => '', // front page
            'acf_field'   => 'nl_cf7_id',
            'option_key'  => 'mer_cf7_newsletter_id',
        ],
    ];

    $all_ok = true;
    foreach ($forms as $config) {
        $stored_id = (int) get_option($config['option_key']);
        if ($stored_id && get_post_status($stored_id) === 'publish') {
            mer_cf7_assign_field($config);
            continue;
        }

        $form_id = mer_cf7_create(
            $config['title'],
            $config['form'],
            $config['mail_subject'],
            $config['mail_body'],
            $config['reply_to'],
            $config['attachments'],
            $admin_email,
            $site_name
        );

        if ($form_id) {
            update_option($config['option_key'], $form_id);
            mer_cf7_assign_field($config, $form_id);
        } else {
            $all_ok = false;
        }
    }

    if ($all_ok) {
        update_option('mer_cf7_setup_v1', true);
    }
}

function mer_cf7_create(
    string $title,
    string $form_body,
    string $mail_subject,
    string $mail_body,
    string $reply_to,
    string $attachments,
    string $admin_email,
    string $site_name
): int {
    $post_id = wp_insert_post([
        'post_title'  => wp_slash($title),
        'post_status' => 'publish',
        'post_type'   => 'wpcf7_contact_form',
        'post_name'   => sanitize_title($title),
    ]);

    if (is_wp_error($post_id) || !$post_id) return 0;

    update_post_meta($post_id, '_form', $form_body);
    update_post_meta($post_id, '_mail', [
        'subject'            => $mail_subject,
        'sender'             => "{$site_name} <{$admin_email}>",
        'recipient'          => $admin_email,
        'body'               => $mail_body,
        'additional_headers' => $reply_to ? "Reply-To: {$reply_to}" : '',
        'attachments'        => $attachments,
        'use_html'           => false,
        'exclude_blank'      => false,
    ]);
    update_post_meta($post_id, '_mail_2', [
        'active'             => false,
        'subject'            => '',
        'sender'             => "{$site_name} <{$admin_email}>",
        'recipient'          => '',
        'body'               => '',
        'additional_headers' => '',
        'attachments'        => '',
        'use_html'           => false,
        'exclude_blank'      => false,
    ]);
    update_post_meta($post_id, '_messages',            []);
    update_post_meta($post_id, '_additional_settings', '');

    return $post_id;
}

function mer_cf7_assign_field(array $config, ?int $form_id = null): void {
    if (!function_exists('update_field')) return;

    $form_id = $form_id ?? (int) get_option($config['option_key']);
    if (!$form_id) return;

    if ($config['template']) {
        $pages = get_posts([
            'post_type'      => 'page',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'meta_query'     => [[
                'key'   => '_wp_page_template',
                'value' => $config['template'],
            ]],
        ]);
        $page_id = $pages[0]->ID ?? 0;
    } else {
        $page_id = (int) get_option('page_on_front');
    }

    if ($page_id) {
        update_field($config['acf_field'], $form_id, $page_id);
    }
}

/* -- CF7 form bodies -- */

function mer_cf7_body_kontakt(string $privacy_url): string {
    return '<div class="space-y-4">
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
[text* your-name placeholder "Imię i nazwisko"]
[email* your-email placeholder "Adres e-mail"]
[tel your-phone placeholder "Numer telefonu"]
</div>
[select* your-area "Usługi księgowe" "Kadry i płace" "Fundacje rodzinne" "BPO" "Inne"]
[textarea your-message rows:5 placeholder "Treść wiadomości"]
<div class="space-y-1">
<label class="text-xs text-slate-500 font-medium">Załącznik (opcjonalny · maks. 10 MB · pdf, doc, docx, jpg, png)</label>
[file your-attachment limit:10mb filetypes:pdf|doc|docx|jpg|png]
</div>
<label class="flex items-start gap-3 cursor-pointer">
[acceptance your-consent] <span class="text-xs text-slate-400 leading-relaxed">Wyrażam zgodę na przetwarzanie moich danych osobowych przez Meritoros SA w celu odpowiedzi na przesłane zapytanie, zgodnie z <a href="' . esc_url($privacy_url) . '" target="_blank" rel="noopener" class="underline hover:text-slate-600">Polityką Prywatności</a>.</span>[/acceptance]
</label>
[submit "Wyślij wiadomość"]
</div>';
}

function mer_cf7_body_kupimy(string $privacy_url): string {
    return '<div class="flex flex-col gap-4">
[text* your-name placeholder "Imię i nazwisko"]
[email* your-email placeholder "E-mail"]
[textarea your-message rows:6 placeholder "Wiadomość"]
<label class="flex items-start gap-3 cursor-pointer">
[acceptance your-consent] <span class="text-xs text-slate-500 leading-relaxed">Wyrażam zgodę na przetwarzanie moich danych osobowych przez Meritoros sp. z o.o. w celu odpowiedzi na przesłane zapytanie, zgodnie z <a href="' . esc_url($privacy_url) . '" target="_blank" rel="noopener" class="underline hover:text-slate-700">Polityką Prywatności</a>.</span>[/acceptance]
</label>
[submit "Wyślij wiadomość"]
</div>';
}


function mer_cf7_body_cv(string $privacy_url): string {
    return '<div class="flex flex-col gap-4">
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
[text* your-name placeholder "Imię i nazwisko"]
[email* your-email placeholder "E-mail"]
</div>
[tel your-phone placeholder "Numer telefonu"]
[textarea your-message rows:4 placeholder "Wiadomość"]
[file* your-cv limit:5mb filetypes:pdf|doc|docx]
<label class="flex items-start gap-3 cursor-pointer">
[acceptance your-consent] <span class="text-xs text-slate-400 leading-relaxed">Wyrażam zgodę na przetwarzanie moich danych osobowych przez Meritoros SA w celu przeprowadzenia procesu rekrutacji, zgodnie z obowiązującymi przepisami o ochronie danych osobowych (RODO) oraz <a href="' . esc_url($privacy_url) . '" target="_blank" rel="noopener" class="underline hover:text-slate-600">Polityką Prywatności</a>.</span>[/acceptance]
</label>
[submit "Wyślij wiadomość"]
</div>';
}

function mer_cf7_body_newsletter(string $privacy_url, string $terms_url): string {
    return '<div class="flex flex-col gap-5">
[email* your-email placeholder "Twój adres e-mail"]
[submit "Zapisuję się"]
<p class="text-xs text-slate-400 leading-relaxed font-light">Administratorem danych jest Meritoros SA, Aleja Pokoju 62/8, Kraków. Dane przetwarzane są wyłącznie w celu wysyłki newslettera. <a href="' . esc_url($privacy_url) . '" target="_blank" rel="noopener" class="underline hover:text-slate-600">Polityka Prywatności</a> · <a href="' . esc_url($terms_url) . '" target="_blank" rel="noopener" class="underline hover:text-slate-600">Regulamin Newslettera</a></p>
</div>';
}

/* ------------------------------------------------------------------
   CF7 — jednorazowa aktualizacja v2: dodanie pola załącznika do formularza kontaktowego
------------------------------------------------------------------ */
add_action('admin_init', 'mer_cf7_update_v2_attachment');
function mer_cf7_update_v2_attachment(): void {
    if (!class_exists('WPCF7_ContactForm')) return;
    if (get_option('mer_cf7_v2_attachment'))  return;

    $form_id = (int) get_option('mer_cf7_kontakt_id');
    if (!$form_id || get_post_status($form_id) !== 'publish') return;

    update_post_meta($form_id, '_form', mer_cf7_body_kontakt(MER_PRIVACY_PDF));

    $mail = get_post_meta($form_id, '_mail', true);
    if (is_array($mail)) {
        $mail['attachments'] = '[your-attachment]';
        update_post_meta($form_id, '_mail', $mail);
    }

    update_option('mer_cf7_v2_attachment', true);
}

/* ------------------------------------------------------------------
   Preload czcionki Host Grotesk (latin-ext — strona po polsku)
   Musi być wyżej niż enqueue, żeby tag <link rel="preload"> trafił
   przed <link rel="stylesheet"> w <head>
------------------------------------------------------------------ */
add_action('wp_head', function (): void {
    $uri = get_template_directory_uri();
    echo '<link rel="preload" href="' . esc_url($uri . '/assets/css/fonts/host-grotesk-latin-ext.woff2') . '" as="font" type="font/woff2" crossorigin>' . "\n";
    echo '<link rel="preload" href="' . esc_url($uri . '/assets/css/fonts/host-grotesk-latin.woff2') . '" as="font" type="font/woff2" crossorigin>' . "\n";
}, 1);

/* ------------------------------------------------------------------
   Performance
------------------------------------------------------------------ */
require_once get_template_directory() . '/inc/performance.php';

/* ------------------------------------------------------------------
   Narzędzie: wypełnij pola ACF domyślnymi wartościami (WP Admin → Narzędzia)
------------------------------------------------------------------ */
if (is_admin()) {
    require_once get_template_directory() . '/inc/populate-acf-defaults.php';
    require_once get_template_directory() . '/inc/ri-dane-metabox.php';
}

/* ------------------------------------------------------------------
   Security Hardening
------------------------------------------------------------------ */
require_once get_template_directory() . '/inc/security.php';

/* ------------------------------------------------------------------
   Structured Data (JSON-LD)
------------------------------------------------------------------ */
require_once get_template_directory() . '/inc/structured-data.php';

/* ------------------------------------------------------------------
   Custom Post Types
------------------------------------------------------------------ */
require_once get_template_directory() . '/inc/cpt-customer-stories.php';
require_once get_template_directory() . '/inc/cpt-media-article.php';

/* ------------------------------------------------------------------
   ACF Field Groups
------------------------------------------------------------------ */
add_action('acf/init', function () {
    require get_template_directory() . '/inc/acf-fields.php';
    require get_template_directory() . '/inc/acf-fields-customer-story.php';
    require get_template_directory() . '/inc/acf-fields-relacje-inwestorskie.php';
    _mer_register_media_fields();
    _mer_register_media_article_fields();
    _mer_register_media_zapytania_fields();
    _mer_register_blog_page_fields();
});

function _mer_register_blog_page_fields(): void {
    if (!function_exists('acf_add_local_field_group')) return;
    acf_add_local_field_group([
        'key'      => 'group_mer_blog_page',
        'title'    => '📚 Wiedza i poradniki',
        'location' => [[['param' => 'page_template', 'operator' => '==', 'value' => 'page-blog.php']]],
        'fields'   => [

            // ── Tab: Hero ──────────────────────────────────────────────
            ['key' => 'field_blog_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab'],
            ['key' => 'field_blog_hero_title',    'label' => 'Tytuł hero',        'name' => 'blog_hero_title',    'type' => 'textarea', 'rows' => 2, 'default_value' => 'Wiedza i poradniki'],
            ['key' => 'field_blog_hero_desc',     'label' => 'Opis hero',         'name' => 'blog_hero_desc',     'type' => 'textarea', 'rows' => 3, 'default_value' => 'Publikujemy treści dotyczące księgowości, kadr, BPO i zmian, które mają realny wpływ na prowadzenie firmy. Znajdziesz tu zarówno materiały eksperckie, jak i aktualności dotyczące rynku oraz działalności Meritoros.'],
            ['key' => 'field_blog_btn1_text',     'label' => 'Przycisk 1 — tekst','name' => 'blog_btn1_text',     'type' => 'text',     'default_value' => 'Pobierz e-book'],
            ['key' => 'field_blog_btn1_url',      'label' => 'Przycisk 1 — link', 'name' => 'blog_btn1_url',      'type' => 'text'],
            ['key' => 'field_blog_btn2_text',     'label' => 'Przycisk 2 — tekst','name' => 'blog_btn2_text',     'type' => 'text',     'default_value' => 'Porozmawiajmy'],
            ['key' => 'field_blog_btn2_url',      'label' => 'Przycisk 2 — link', 'name' => 'blog_btn2_url',      'type' => 'text',     'default_value' => '#kontakt'],

            // ── Tab: Wideoinstruktaże ──────────────────────────────────
            ['key' => 'field_blog_tab_wi', 'label' => 'Wideoinstruktaże', 'name' => '', 'type' => 'tab'],
            ['key' => 'field_wi_label', 'label' => 'Etykieta',     'name' => 'wi_label', 'type' => 'text', 'default_value' => 'Wideo'],
            ['key' => 'field_wi_title', 'label' => 'Tytuł sekcji', 'name' => 'wi_title', 'type' => 'text', 'default_value' => 'Wideoinstruktaże'],
            ['key' => 'field_wi_desc',  'label' => 'Opis sekcji',  'name' => 'wi_desc',  'type' => 'textarea', 'rows' => 2, 'default_value' => 'Praktyczne instruktaże wideo z zakresu księgowości, podatków i kadr.'],
            ['key' => 'field_wi_1t',  'label' => '▶ Film 1 — Tytuł',    'name' => 'wi_1_title', 'type' => 'text'],
            ['key' => 'field_wi_1u',  'label' => '▶ Film 1 — Link YT',  'name' => 'wi_1_url',   'type' => 'text', 'instructions' => 'np. https://www.youtube.com/watch?v=ABC123'],
            ['key' => 'field_wi_2t',  'label' => '▶ Film 2 — Tytuł',    'name' => 'wi_2_title', 'type' => 'text'],
            ['key' => 'field_wi_2u',  'label' => '▶ Film 2 — Link YT',  'name' => 'wi_2_url',   'type' => 'text', 'instructions' => 'np. https://www.youtube.com/watch?v=ABC123'],
            ['key' => 'field_wi_3t',  'label' => '▶ Film 3 — Tytuł',    'name' => 'wi_3_title', 'type' => 'text'],
            ['key' => 'field_wi_3u',  'label' => '▶ Film 3 — Link YT',  'name' => 'wi_3_url',   'type' => 'text', 'instructions' => 'np. https://www.youtube.com/watch?v=ABC123'],
            ['key' => 'field_wi_4t',  'label' => '▶ Film 4 — Tytuł',    'name' => 'wi_4_title', 'type' => 'text'],
            ['key' => 'field_wi_4u',  'label' => '▶ Film 4 — Link YT',  'name' => 'wi_4_url',   'type' => 'text', 'instructions' => 'np. https://www.youtube.com/watch?v=ABC123'],
            ['key' => 'field_wi_5t',  'label' => '▶ Film 5 — Tytuł',    'name' => 'wi_5_title', 'type' => 'text'],
            ['key' => 'field_wi_5u',  'label' => '▶ Film 5 — Link YT',  'name' => 'wi_5_url',   'type' => 'text', 'instructions' => 'np. https://www.youtube.com/watch?v=ABC123'],
            ['key' => 'field_wi_6t',  'label' => '▶ Film 6 — Tytuł',    'name' => 'wi_6_title', 'type' => 'text'],
            ['key' => 'field_wi_6u',  'label' => '▶ Film 6 — Link YT',  'name' => 'wi_6_url',   'type' => 'text', 'instructions' => 'np. https://www.youtube.com/watch?v=ABC123'],
            ['key' => 'field_wi_7t',  'label' => '▶ Film 7 — Tytuł',    'name' => 'wi_7_title', 'type' => 'text'],
            ['key' => 'field_wi_7u',  'label' => '▶ Film 7 — Link YT',  'name' => 'wi_7_url',   'type' => 'text', 'instructions' => 'np. https://www.youtube.com/watch?v=ABC123'],
            ['key' => 'field_wi_8t',  'label' => '▶ Film 8 — Tytuł',    'name' => 'wi_8_title', 'type' => 'text'],
            ['key' => 'field_wi_8u',  'label' => '▶ Film 8 — Link YT',  'name' => 'wi_8_url',   'type' => 'text', 'instructions' => 'np. https://www.youtube.com/watch?v=ABC123'],
            ['key' => 'field_wi_9t',  'label' => '▶ Film 9 — Tytuł',    'name' => 'wi_9_title', 'type' => 'text'],
            ['key' => 'field_wi_9u',  'label' => '▶ Film 9 — Link YT',  'name' => 'wi_9_url',   'type' => 'text', 'instructions' => 'np. https://www.youtube.com/watch?v=ABC123'],
            ['key' => 'field_wi_10t', 'label' => '▶ Film 10 — Tytuł',   'name' => 'wi_10_title', 'type' => 'text'],
            ['key' => 'field_wi_10u', 'label' => '▶ Film 10 — Link YT', 'name' => 'wi_10_url',   'type' => 'text', 'instructions' => 'np. https://www.youtube.com/watch?v=ABC123'],

            // ── Tab: Ebook ─────────────────────────────────────────────
            ['key' => 'field_blog_tab_ebook', 'label' => 'Sekcja Ebook', 'name' => '', 'type' => 'tab'],
            ['key' => 'field_ebook_label',    'label' => 'Etykieta',     'name' => 'ebook_label',    'type' => 'text',     'default_value' => 'Darmowy materiał'],
            ['key' => 'field_ebook_title',    'label' => 'Tytuł',        'name' => 'ebook_title',    'type' => 'text',     'default_value' => 'Pobierz nasz darmowy Ebook'],
            ['key' => 'field_ebook_subtitle', 'label' => 'Podtytuł',     'name' => 'ebook_subtitle', 'type' => 'text'],
            ['key' => 'field_ebook_desc',     'label' => 'Opis',         'name' => 'ebook_desc',     'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_ebook_btn_text', 'label' => 'Tekst przycisku', 'name' => 'ebook_btn_text', 'type' => 'text', 'default_value' => 'Pobierz materiał'],
            [
                'key'           => 'field_ebook_pdf',
                'label'         => 'Plik PDF (ebook)',
                'name'          => 'ebook_pdf',
                'type'          => 'file',
                'return_format' => 'array',
                'mime_types'    => 'pdf',
                'instructions'  => 'Wgraj plik PDF, który zostanie wysłany na e-mail użytkownika.',
            ],
            [
                'key'           => 'field_ebook_mockup',
                'label'         => 'Grafika / mockup (prawa strona)',
                'name'          => 'ebook_mockup',
                'type'          => 'image',
                'return_format' => 'array',
                'instructions'  => 'Grafika tabletu, okładki ebooka itp. wyświetlana po prawej stronie sekcji.',
            ],
            [
                'key'           => 'field_ebook_email_subject',
                'label'         => 'Temat wiadomości e-mail',
                'name'          => 'ebook_email_subject',
                'type'          => 'text',
                'default_value' => 'Twój darmowy ebook od Meritoros',
            ],
            [
                'key'          => 'field_ebook_notify_email',
                'label'        => 'E-mail powiadomień (opcjonalnie)',
                'name'         => 'ebook_notify_email',
                'type'         => 'email',
                'instructions' => 'Jeśli podany, na ten adres zostanie wysłana kopia powiadomienia o nowym pobraniu.',
            ],
        ],
    ]);
}

/* ── AJAX: wyślij ebook na e-mail ─────────────────────────────────────── */
add_action('wp_ajax_mer_ebook',        'mer_ajax_send_ebook');
add_action('wp_ajax_nopriv_mer_ebook', 'mer_ajax_send_ebook');

function mer_ajax_send_ebook(): void {
    if (!check_ajax_referer('mer_ebook_nonce', 'nonce', false)) {
        wp_send_json_error('Błąd bezpieczeństwa. Odśwież stronę i spróbuj ponownie.');
    }

    $email   = sanitize_email(wp_unslash($_POST['email'] ?? ''));
    $page_id = absint($_POST['page_id'] ?? 0);

    if (!is_email($email)) {
        wp_send_json_error('Podaj prawidłowy adres e-mail.');
    }

    if (!$page_id) {
        wp_send_json_error('Nie znaleziono strony.');
    }

    $pdf = get_field('ebook_pdf', $page_id);
    if (empty($pdf['id'])) {
        wp_send_json_error('Plik PDF nie został jeszcze skonfigurowany.');
    }

    $file_path = get_attached_file($pdf['id']);
    if (!$file_path || !file_exists($file_path)) {
        wp_send_json_error('Nie można odnaleźć pliku PDF. Skontaktuj się z nami bezpośrednio.');
    }

    $subject     = get_field('ebook_email_subject', $page_id) ?: 'Twój darmowy ebook od Meritoros';
    $notify_mail = get_field('ebook_notify_email',  $page_id) ?: '';
    $from_name   = get_bloginfo('name');
    $from_email  = get_option('admin_email');

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $from_name . ' <' . $from_email . '>',
    ];

    $body = '
    <div style="font-family:sans-serif;max-width:600px;margin:0 auto;color:#334155">
        <p style="font-size:16px">Dziękujemy za zainteresowanie naszym ebookiem!</p>
        <p style="font-size:16px">W załączniku znajdziesz plik PDF, który zamówiłeś/aś.</p>
        <p style="font-size:14px;color:#64748b">Zespół ' . esc_html($from_name) . '</p>
    </div>';

    $sent = wp_mail($email, $subject, $body, $headers, [$file_path]);

    if (!$sent) {
        wp_send_json_error('Nie udało się wysłać wiadomości. Spróbuj ponownie później.');
    }

    // Opcjonalne powiadomienie dla admina
    if ($notify_mail && is_email($notify_mail)) {
        wp_mail(
            $notify_mail,
            '[Meritoros] Nowe pobranie ebooka',
            '<p>Adres e-mail: <strong>' . esc_html($email) . '</strong></p>',
            ['Content-Type: text/html; charset=UTF-8', 'From: ' . $from_name . ' <' . $from_email . '>']
        );
    }

    wp_send_json_success('OK');
}

/* ── AJAX: wyślij Culturebook na e-mail ───────────────────────────────── */
add_action('wp_ajax_mer_przeczytaj',        'mer_ajax_load_przeczytaj');
add_action('wp_ajax_nopriv_mer_przeczytaj', 'mer_ajax_load_przeczytaj');

function mer_ajax_load_przeczytaj(): void {
    check_ajax_referer('mer_przeczytaj_nonce', 'nonce');

    $offset   = max(0, (int) ($_POST['offset'] ?? 0));
    $per_page = 12;

    $posts = get_posts([
        'post_type'      => 'media-article',
        'posts_per_page' => $per_page,
        'offset'         => $offset,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order date',
        'order'          => 'ASC',
    ]);

    $total = (int) (new WP_Query([
        'post_type'      => 'media-article',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'fields'         => 'ids',
    ]))->found_posts;

    $html = '';
    foreach ($posts as $p) {
        $photo     = get_field('ma_photo', $p->ID);
        $photo_url = is_array($photo) ? ($photo['url'] ?? '') : '';
        $photo_alt = is_array($photo) ? ($photo['alt'] ?? get_the_title($p)) : get_the_title($p);
        $text      = get_field('ma_text',     $p->ID) ?: '';
        $btn_text  = get_field('ma_btn_text', $p->ID) ?: 'Przeczytaj artykuł';
        $btn_url   = get_field('ma_btn_url',  $p->ID) ?: get_permalink($p->ID);

        ob_start(); ?>
        <div class="mprz-card flex-shrink-0 flex flex-col">
            <div class="mprz-img rounded-2xl overflow-hidden aspect-[4/3] mb-4 bg-white border border-slate-100 flex items-center justify-center p-4">
                <?php if ($photo_url) : ?>
                    <img src="<?php echo esc_url($photo_url); ?>" alt="<?php echo esc_attr($photo_alt); ?>" class="w-full h-full object-contain" loading="lazy">
                <?php endif; ?>
            </div>
            <div class="mprz-body flex flex-col flex-1">
                <h3 class="text-base md:text-lg font-semibold text-slate-900 leading-snug mb-2"><?php echo esc_html(get_the_title($p)); ?></h3>
                <?php if ($text) : ?>
                    <p class="mprz-desc text-base sm:text-lg text-slate-500 leading-relaxed mb-3"><?php echo esc_html($text); ?></p>
                <?php endif; ?>
                <a href="<?php echo esc_url($btn_url); ?>" class="mt-auto inline-block text-sm font-semibold text-slate-900 border-b-2 border-emerald-500 pb-0.5 hover:text-emerald-700 hover:border-emerald-700 transition-colors w-fit"><?php echo esc_html($btn_text); ?></a>
            </div>
        </div>
        <?php $html .= ob_get_clean();
    }

    wp_send_json_success([
        'html'     => $html,
        'has_more' => ($offset + $per_page) < $total,
        'next_offset' => $offset + $per_page,
    ]);
}

add_action('wp_ajax_mer_culturebook',        'mer_ajax_send_culturebook');
add_action('wp_ajax_nopriv_mer_culturebook', 'mer_ajax_send_culturebook');

function mer_ajax_send_culturebook(): void {
    if (!check_ajax_referer('mer_culturebook_nonce', 'nonce', false)) {
        wp_send_json_error('Błąd bezpieczeństwa. Odśwież stronę i spróbuj ponownie.');
    }

    $email   = sanitize_email(wp_unslash($_POST['email'] ?? ''));
    $page_id = absint($_POST['page_id'] ?? 0);

    if (!is_email($email)) {
        wp_send_json_error('Podaj prawidłowy adres e-mail.');
    }
    if (!$page_id) {
        wp_send_json_error('Nie znaleziono strony.');
    }

    $pdf = get_field('kar_cult_pdf', $page_id);
    if (empty($pdf['id'])) {
        wp_send_json_error('Plik PDF nie został jeszcze skonfigurowany.');
    }

    $file_path = get_attached_file($pdf['id']);
    if (!$file_path || !file_exists($file_path)) {
        wp_send_json_error('Nie można odnaleźć pliku PDF. Skontaktuj się z nami bezpośrednio.');
    }

    $subject      = get_field('kar_cult_email_subject', $page_id) ?: 'Twój Culturebook od Meritoros';
    $notify_mail  = get_field('kar_cult_notify_email',  $page_id) ?: '';
    $from_name    = get_bloginfo('name');
    $from_email   = get_option('admin_email');

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $from_name . ' <' . $from_email . '>',
    ];

    $body = '
    <div style="font-family:sans-serif;max-width:600px;margin:0 auto;color:#334155">
        <p style="font-size:16px">Dziękujemy za zainteresowanie naszym Culturebookiem!</p>
        <p style="font-size:16px">W załączniku znajdziesz plik PDF, który zamówiłeś/aś.</p>
        <p style="font-size:14px;color:#64748b">Zespół ' . esc_html($from_name) . '</p>
    </div>';

    $sent = wp_mail($email, $subject, $body, $headers, [$file_path]);

    if (!$sent) {
        wp_send_json_error('Nie udało się wysłać wiadomości. Spróbuj ponownie później.');
    }

    if ($notify_mail && is_email($notify_mail)) {
        wp_mail(
            $notify_mail,
            '[Meritoros] Nowe pobranie Culturebooka',
            '<p>Adres e-mail: <strong>' . esc_html($email) . '</strong></p>',
            ['Content-Type: text/html; charset=UTF-8', 'From: ' . $from_name . ' <' . $from_email . '>']
        );
    }

    wp_send_json_success('OK');
}

function _mer_register_media_fields(): void {
    if ( ! function_exists('acf_add_local_field_group') ) return;

    acf_add_local_field_group([
        'key'      => 'group_mer_media',
        'title'    => '📰 Media i newsroom',
        'location' => [
            [['param' => 'page_template', 'operator' => '==', 'value' => 'page-media.php']],
            [['param' => 'page_slug',     'operator' => '==', 'value' => 'media']],
        ],
        'menu_order' => 0,
        'position'   => 'normal',
        'fields'     => [

            /* ── Hero ── */
            ['key' => 'field_media_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab', 'placement' => 'top'],
            [
                'key'           => 'field_media_hero_title',
                'label'         => 'Tytuł',
                'name'          => 'media_hero_title',
                'type'          => 'textarea',
                'rows'          => 2,
                'default_value' => 'Media i informacje firmowe',
            ],
            [
                'key'           => 'field_media_hero_text',
                'label'         => 'Opis',
                'name'          => 'media_hero_text',
                'type'          => 'textarea',
                'rows'          => 2,
                'default_value' => 'Najważniejsze wydarzenia z życia firmy: rozwój, nowe inicjatywy, wyróżnienia i ogłoszenia.',
            ],

            /* ── Wyróżniony artykuł ── */
            ['key' => 'field_media_tab_art', 'label' => 'Wyróżniony artykuł', 'name' => '', 'type' => 'tab', 'placement' => 'top'],
            [
                'key'           => 'field_media_art_photo',
                'label'         => 'Zdjęcie',
                'name'          => 'media_art_photo',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
                'library'       => 'all',
            ],
            [
                'key'           => 'field_media_art_title',
                'label'         => 'Tytuł artykułu',
                'name'          => 'media_art_title',
                'type'          => 'text',
                'default_value' => 'Maciej Paraszczak dla Pulsu Biznesu',
            ],
            [
                'key'           => 'field_media_art_quote',
                'label'         => 'Cytat (kursywa)',
                'name'          => 'media_art_quote',
                'type'          => 'textarea',
                'rows'          => 3,
                'default_value' => 'Dla wielu naszych klientów jesteśmy nie tylko biurem rachunkowym, ale partnerem operacyjnym, który realnie usprawnia ich procesy biznesowe – podkreśla Maciej Paraszczak, prezes zarządu spółki Meritoros.',
            ],
            [
                'key'           => 'field_media_art_bold_text',
                'label'         => 'Tekst pogrubiony',
                'name'          => 'media_art_bold_text',
                'type'          => 'textarea',
                'rows'          => 3,
                'default_value' => 'Wywiad z Maciejem Paraszczakiem dla Pulsu Biznesu o tym, jak wygląda nowoczesna księgowość w praktyce i dlaczego standard oraz procesy mają dziś kluczowe znaczenie.',
            ],
            [
                'key'           => 'field_media_art_btn_text',
                'label'         => 'Tekst przycisku',
                'name'          => 'media_art_btn_text',
                'type'          => 'text',
                'default_value' => 'Czytaj więcej',
            ],
            [
                'key'   => 'field_media_art_btn_url',
                'label' => 'Link przycisku',
                'name'  => 'media_art_btn_url',
                'type'  => 'text',
            ],

            /* ── Sekcja wideo ── */
            ['key' => 'field_media_tab_vid', 'label' => 'Sekcja wideo', 'name' => '', 'type' => 'tab', 'placement' => 'top'],
            [
                'key'           => 'field_media_vid_title',
                'label'         => 'Tytuł',
                'name'          => 'media_vid_title',
                'type'          => 'text',
                'default_value' => 'Jak z MINIMALNYM ryzykiem zacząć własny biznes? Sebastian Rafalik wspomina Meritoros.',
            ],
            [
                'key'           => 'field_media_vid_text',
                'label'         => 'Opis',
                'name'          => 'media_vid_text',
                'type'          => 'textarea',
                'rows'          => 3,
                'default_value' => 'Sebastian Rafalik (POL–FRA) w wywiadzie dla „Zaprojektuj Swoje Życie" mówi o tym, jak uporządkowanie księgowości i kadr z Meritoros pomogło mu odblokować skalowanie biznesu.',
            ],
            [
                'key'           => 'field_media_vid_btn_text',
                'label'         => 'Tekst przycisku',
                'name'          => 'media_vid_btn_text',
                'type'          => 'text',
                'default_value' => 'Posłuchaj wywiadu',
            ],
            [
                'key'          => 'field_media_vid_btn_url',
                'label'        => 'Link przycisku (fallback gdy brak wideo)',
                'name'         => 'media_vid_btn_url',
                'type'         => 'text',
                'instructions' => 'Uzupełnij gdy wideo niedostępne.',
            ],
            [
                'key'           => 'field_media_vid_thumbnail',
                'label'         => 'Miniatura wideo',
                'name'          => 'media_vid_thumbnail',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
                'library'       => 'all',
                'instructions'  => 'Jeśli puste — miniatura pobierana automatycznie z YouTube.',
            ],
            [
                'key'          => 'field_media_vid_url',
                'label'        => 'URL wideo (YouTube / Vimeo)',
                'name'         => 'media_vid_url',
                'type'         => 'text',
                'instructions' => 'Wklej link YouTube lub Vimeo.',
            ],
            [
                'key'           => 'field_media_vid_file',
                'label'         => 'Plik wideo (mp4 / webm)',
                'name'          => 'media_vid_file',
                'type'          => 'file',
                'return_format' => 'array',
                'mime_types'    => 'mp4,webm',
                'library'       => 'all',
                'instructions'  => 'Alternatywnie: wgraj plik zamiast podawać URL.',
            ],
        ],
    ]);
}




function _mer_register_media_zapytania_fields(): void {
    if ( ! function_exists('acf_add_local_field_group') ) return;

    acf_add_local_field_group([
        'key'        => 'group_mer_media_zapytania',
        'title'      => '📰 Media – Zapytania medialne',
        'location'   => [
            [['param' => 'page_template', 'operator' => '==', 'value' => 'page-media.php']],
            [['param' => 'page_slug',     'operator' => '==', 'value' => 'media']],
        ],
        'menu_order' => 2,
        'position'   => 'normal',
        'fields'     => [
            ['key' => 'field_media_tab_zap', 'label' => 'Zapytania medialne', 'name' => '', 'type' => 'tab', 'placement' => 'top'],
            ['key' => 'field_media_zap_title',         'label' => 'Tytuł',                  'name' => 'media_zap_title',         'type' => 'text',     'default_value' => 'Zapytania medialne'],
            ['key' => 'field_media_zap_text',          'label' => 'Opis',                   'name' => 'media_zap_text',          'type' => 'textarea', 'rows' => 3, 'default_value' => 'W sprawach publikacji, komentarzy eksperckich i współpracy medialnej prosimy o kontakt.'],
            ['key' => 'field_media_zap_email', 'label' => 'Adres e-mail kontaktowy', 'name' => 'media_zap_email', 'type' => 'text',
             'default_value' => 'aleksandra.pawelec@meritoros.pl',
             'instructions'  => 'Klikalny adres e-mail wyświetlany zamiast formularza.'],
            [
                'key'           => 'field_media_zap_photo',
                'label'         => 'Zdjęcie',
                'name'          => 'media_zap_photo',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
                'library'       => 'all',
            ],
        ],
    ]);
}

function _mer_register_media_article_fields(): void {
    if ( ! function_exists('acf_add_local_field_group') ) return;

    $fields = [
        // ── Tab: Podstawowe ──────────────────────────────────────────
        ['key' => 'field_ma_tab_basic', 'label' => 'Podstawowe', 'name' => '', 'type' => 'tab'],
        [
            'key'           => 'field_ma_photo',
            'label'         => 'Zdjęcie / grafika',
            'name'          => 'ma_photo',
            'type'          => 'image',
            'return_format' => 'array',
            'preview_size'  => 'medium',
            'library'       => 'all',
        ],
        [
            'key'   => 'field_ma_source',
            'label' => 'Źródło (np. Puls Biznesu)',
            'name'  => 'ma_source',
            'type'  => 'text',
        ],
        [
            'key'          => 'field_ma_author',
            'label'        => 'Autor',
            'name'         => 'ma_author',
            'type'         => 'text',
            'instructions' => 'Imię i nazwisko autora artykułu.',
        ],
        [
            'key'          => 'field_ma_date_label',
            'label'        => 'Data publikacji (opcjonalnie)',
            'name'         => 'ma_date_label',
            'type'         => 'text',
            'instructions' => 'Jeśli puste, używana jest data wpisu WordPress.',
            'placeholder'  => 'np. 12 maja 2025',
        ],
        [
            'key'           => 'field_ma_btn_text',
            'label'         => 'Tekst linku (karta na liście)',
            'name'          => 'ma_btn_text',
            'type'          => 'text',
            'default_value' => 'Przeczytaj artykuł',
        ],
        [
            'key'          => 'field_ma_btn_url',
            'label'        => 'URL źródłowego artykułu (opcjonalnie)',
            'name'         => 'ma_btn_url',
            'type'         => 'text',
            'instructions' => 'Jeśli podany, karta na liście kieruje do tego URL zamiast do strony wpisu.',
        ],
        [
            'key'          => 'field_ma_video_url',
            'label'        => 'URL wideo (YouTube / Vimeo)',
            'name'         => 'ma_video_url',
            'type'         => 'text',
            'instructions' => 'Wklej link do YouTube lub Vimeo. Miniatura zostanie pobrana automatycznie jeśli nie wgrasz zdjęcia. Karta na blogu (kategoria Filmy) odtworzy wideo w oknie popup.',
        ],
        [
            'key'           => 'field_ma_show_article_link',
            'label'         => 'Pokaż przycisk „Czytaj artykuł"',
            'name'          => 'ma_show_article_link',
            'type'          => 'true_false',
            'default_value' => 1,
            'ui'            => 1,
            'instructions'  => 'Odznacz jeśli film nie ma powiązanego artykułu do przeczytania.',
        ],
        [
            'key'     => 'field_ma_article_category',
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
                'mowia'       => 'Mówią o nas (sekcja na stronie Media)',
                'przeczytaj'  => 'Przeczytaj również (sekcja na stronie Media)',
            ],
            'layout' => 'horizontal',
        ],

        // ── Tab: Treść ────────────────────────────────────────────────
        ['key' => 'field_ma_tab_content', 'label' => 'Treść', 'name' => '', 'type' => 'tab'],
        [
            'key'          => 'field_ma_text',
            'label'        => 'Lead / opis skrócony',
            'name'         => 'ma_text',
            'type'         => 'textarea',
            'rows'         => 3,
            'instructions' => 'Widoczny pod tytułem na stronie artykułu i jako opis na karcie listy.',
        ],
    ];

    for ( $i = 1; $i <= 8; $i++ ) {
        $fields[] = [
            'key'        => 'field_ma_section_' . $i,
            'label'      => 'Sekcja ' . $i,
            'name'       => 'ma_section_' . $i,
            'type'       => 'group',
            'layout'     => 'block',
            'sub_fields' => [
                [
                    'key'   => 'field_ma_s' . $i . '_heading',
                    'label' => 'Nagłówek sekcji',
                    'name'  => 'heading',
                    'type'  => 'text',
                ],
                [
                    'key'           => 'field_ma_s' . $i . '_level',
                    'label'         => 'Poziom nagłówka',
                    'name'          => 'heading_level',
                    'type'          => 'select',
                    'choices'       => ['h2' => 'H2 — główny', 'h3' => 'H3 — podsekcja', 'h4' => 'H4 — dodatkowy'],
                    'default_value' => 'h2',
                    'allow_null'    => 0,
                ],
                [
                    'key'          => 'field_ma_s' . $i . '_body',
                    'label'        => 'Treść sekcji',
                    'name'         => 'body',
                    'type'         => 'wysiwyg',
                    'toolbar'      => 'full',
                    'media_upload' => 1,
                ],
            ],
        ];
    }

    acf_add_local_field_group([
        'key'        => 'group_mer_media_article',
        'title'      => '📰 Artykuł medialny',
        'location'   => [[['param' => 'post_type', 'operator' => '==', 'value' => 'media-article']]],
        'menu_order' => 0,
        'position'   => 'normal',
        'fields'     => $fields,
    ]);
}

/* ------------------------------------------------------------------
   Helpers
------------------------------------------------------------------ */

/**
 * Escape text for HTML output, converting newlines to <br> tags.
 * Use instead of esc_html() for any content that may contain intentional line breaks.
 */
function mer_esc(string $text): string {
    return nl2br(esc_html($text));
}

/**
 * Get ACF field with optional fallback.
 */
function mer_field(string $name, $fallback = ''): mixed {
    $value = get_field($name);
    return ($value !== null && $value !== false && $value !== '') ? $value : $fallback;
}

/**
 * Register a UI string with WPML and return its translation.
 * Falls back to $default when WPML is not active.
 */
function mer_t(string $name, string $default): string {
    do_action('wpml_register_single_string', 'meritoros-theme', $name, $default);
    return function_exists('icl_t') ? (string) icl_t('meritoros-theme', $name, $default) : $default;
}

/**
 * Get ACF sub-field with optional fallback.
 */
function mer_sub(string $name, $fallback = ''): mixed {
    $value = get_sub_field($name);
    return ($value !== null && $value !== false && $value !== '') ? $value : $fallback;
}

/**
 * Output escaped text or nl2br textarea.
 */
function mer_text(string $name, string $fallback = '', bool $nl2br = false): void {
    $val = mer_field($name, $fallback);
    $val = esc_html($val);
    echo $nl2br ? nl2br($val) : $val;
}

/**
 * Output ACF image as <img> tag.
 *
 * @param string $name     Field name
 * @param string $class    CSS classes
 * @param string $alt      Fallback alt text
 * @param string $loading  "lazy" (default) or "eager"
 */
function mer_img(string $name, string $class = '', string $alt = '', string $loading = 'lazy'): void {
    $img = get_field($name);
    if (is_array($img)) {
        $src  = esc_url($img['url']);
        $alt  = esc_attr($img['alt'] ?: $alt);
        $w    = intval($img['width']);
        $h    = intval($img['height']);
        $dim  = ($w && $h) ? " width=\"{$w}\" height=\"{$h}\"" : '';
        echo "<img src=\"{$src}\" alt=\"{$alt}\" class=\"{$class}\" loading=\"{$loading}\"{$dim}>";
    } elseif ($alt) {
        echo '<img src="" alt="' . esc_attr($alt) . '" class="' . esc_attr($class) . '" loading="' . esc_attr($loading) . '">';
    }
}

/**
 * Output ACF image URL only.
 */
function mer_img_url(string $name, string $fallback = ''): string {
    $img = get_field($name);
    if (is_array($img)) {
        return esc_url($img['url']);
    }
    return esc_url($fallback);
}

/**
 * Return lucide <i> icon markup.
 */
function mer_icon(string $name_field, string $fallback_icon, string $class = ''): string {
    $icon = esc_attr(mer_field($name_field, $fallback_icon));
    return "<i data-lucide=\"{$icon}\" class=\"{$class}\"></i>";
}

/**
 * Fetch YouTube video duration and return formatted MM:SS string.
 * Result is cached as a transient for 24 hours.
 */
function mer_youtube_duration(string $yt_id): string {
    if (empty($yt_id)) return '';

    $cache_key = 'mer_yt_dur_' . $yt_id;
    $cached    = get_transient($cache_key);
    if ($cached !== false) return (string) $cached;

    $response = wp_remote_get('https://www.youtube.com/watch?v=' . urlencode($yt_id), [
        'timeout'    => 5,
        'user-agent' => 'Mozilla/5.0 (compatible; WordPress)',
    ]);

    $duration = '';
    if (!is_wp_error($response)) {
        $body = wp_remote_retrieve_body($response);
        if (preg_match('/"lengthSeconds"\s*:\s*"(\d+)"/', $body, $m)) {
            $total   = (int) $m[1];
            $hours   = intdiv($total, 3600);
            $minutes = intdiv($total % 3600, 60);
            $seconds = $total % 60;
            $duration = $hours > 0
                ? sprintf('%d:%02d:%02d', $hours, $minutes, $seconds)
                : sprintf('%d:%02d', $minutes, $seconds);
        }
    }

    set_transient($cache_key, $duration, DAY_IN_SECONDS);
    return $duration;
}

/* ==================================================================
   ACF — Case Studies: mirror BPO ↔ strona główna
   Pola cs_* na stronie BPO ładują wartości z front page i zapisują
   z powrotem na front page, dzięki czemu treść jest zawsze wspólna.
================================================================== */
add_filter('acf/load_value', function ($value, $post_id, $field) {
    if (! str_starts_with($field['name'], 'cs_')) {
        return $value;
    }
    if (get_page_template_slug($post_id) !== 'page-bpo.php') {
        return $value;
    }
    return get_field($field['name'], (int) get_option('page_on_front'));
}, 10, 3);

add_action('acf/save_post', function ($post_id) {
    if (get_page_template_slug($post_id) !== 'page-bpo.php') {
        return;
    }
    if (empty($_POST['acf'])) {
        return;
    }
    $front_id = (int) get_option('page_on_front');
    foreach ($_POST['acf'] as $field_key => $field_value) {
        $field = acf_get_field($field_key);
        if ($field && str_starts_with($field['name'], 'cs_')) {
            update_field($field_key, $field_value, $front_id);
        }
    }
}, 5);

