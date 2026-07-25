<?php
defined('ABSPATH') || exit;

/**
 * Meritoros — Structured Data (JSON-LD)
 *
 * Outputs schema.org markup for:
 *  - AccountingService (Organization) — all pages
 *  - WebSite — homepage only
 *  - BreadcrumbList — all non-homepage pages
 *
 * Data is pulled from ACF footer fields stored on the front page,
 * so phone / email / address stay in sync with the footer.
 */

add_action('wp_head', 'mer_output_structured_data', 5);

function mer_output_structured_data(): void {
    $graphs = [];

    $graphs[] = mer_sd_organization();

    if (is_front_page()) {
        $graphs[] = mer_sd_website();
    } else {
        $breadcrumb = mer_sd_breadcrumb();
        if ($breadcrumb) {
            $graphs[] = $breadcrumb;
        }
    }

    // Remove nulls and output
    $graphs = array_filter($graphs);
    if (empty($graphs)) return;

    foreach ($graphs as $graph) {
        echo "\n" . '<script type="application/ld+json">' . "\n";
        echo wp_json_encode($graph, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        echo "\n" . '</script>' . "\n";
    }
}

/* ------------------------------------------------------------------
   AccountingService / Organization
------------------------------------------------------------------ */
function mer_sd_organization(): array {
    $fp_id   = (int) get_option('page_on_front');
    $address = get_field('footer_address', $fp_id) ?: 'Aleja Pokoju 62/8, Kraków';
    $phone   = get_field('footer_phone',   $fp_id) ?: '';
    $email   = get_field('footer_email',   $fp_id) ?: 'biuro@meritoros.pl';

    // Parse "Street, City" — simple split on last comma
    $address_parts   = array_map('trim', explode(',', $address));
    $street          = $address_parts[0] ?? $address;
    $city            = $address_parts[1] ?? 'Kraków';

    // Social URLs from footer fields
    $same_as = [];
    for ($i = 1; $i <= 4; $i++) {
        $url = get_field("footer_social_{$i}_url", $fp_id);
        if ($url && $url !== '#') {
            $same_as[] = esc_url_raw($url);
        }
    }

    $logo_url = get_template_directory_uri() . '/images/logo.svg';

    $schema = [
        '@context' => 'https://schema.org',
        '@type'    => 'AccountingService',
        'name'     => get_bloginfo('name') ?: 'Meritoros',
        'url'      => home_url('/'),
        'logo'     => [
            '@type' => 'ImageObject',
            'url'   => $logo_url,
        ],
        'address'  => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => $street,
            'addressLocality' => $city,
            'addressCountry'  => 'PL',
        ],
        'areaServed'       => 'PL',
        'knowsLanguage'    => ['pl', 'en'],
        'priceRange'       => '$$',
    ];

    if ($phone) {
        $schema['telephone'] = $phone;
    }
    if ($email) {
        $schema['email'] = $email;
    }
    if (!empty($same_as)) {
        $schema['sameAs'] = $same_as;
    }

    return $schema;
}

/* ------------------------------------------------------------------
   WebSite (homepage only)
------------------------------------------------------------------ */
function mer_sd_website(): array {
    return [
        '@context' => 'https://schema.org',
        '@type'    => 'WebSite',
        'name'     => get_bloginfo('name') ?: 'Meritoros',
        'url'      => home_url('/'),
    ];
}

/* ------------------------------------------------------------------
   BreadcrumbList (non-homepage pages)
------------------------------------------------------------------ */
function mer_sd_breadcrumb(): ?array {
    $items   = [];
    $items[] = [
        '@type'    => 'ListItem',
        'position' => 1,
        'name'     => get_bloginfo('name') ?: 'Meritoros',
        'item'     => home_url('/'),
    ];

    $position = 2;

    if (is_singular()) {
        $post = get_post();

        // If post has a parent page, add it
        if ($post && $post->post_parent) {
            $parent = get_post($post->post_parent);
            if ($parent) {
                $items[] = [
                    '@type'    => 'ListItem',
                    'position' => $position++,
                    'name'     => get_the_title($parent->ID),
                    'item'     => get_permalink($parent->ID),
                ];
            }
        }

        // Current page
        $items[] = [
            '@type'    => 'ListItem',
            'position' => $position,
            'name'     => get_the_title(),
            'item'     => get_permalink(),
        ];

    } elseif (is_archive()) {
        $items[] = [
            '@type'    => 'ListItem',
            'position' => $position,
            'name'     => get_the_archive_title(),
            'item'     => get_post_type_archive_link(get_post_type()) ?: get_home_url(),
        ];

    } elseif (is_search()) {
        $items[] = [
            '@type'    => 'ListItem',
            'position' => $position,
            'name'     => sprintf(__('Wyniki wyszukiwania: %s', 'meritoros'), get_search_query()),
            'item'     => get_search_link(),
        ];
    }

    // Need at least homepage + one more item
    if (count($items) < 2) return null;

    return [
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $items,
    ];
}

/* ------------------------------------------------------------------
   VideoObject helper
   Outputs a <script type="application/ld+json"> block inline.
   Google accepts JSON-LD anywhere in the document (head or body).

   @param array $args {
     string name          Required. Video title.
     string description   Required. Short description.
     string thumbnail_url Required. Absolute thumbnail URL.
     string upload_date   Required. ISO 8601 date, e.g. get_the_date('c').
     string embed_url     Optional. YouTube/Vimeo embed URL.
     string content_url   Optional. Direct file URL.
     string duration      Optional. Formatted "M:SS" or "H:MM:SS".
   }
------------------------------------------------------------------ */
function mer_output_video_object(array $args): void {
    $name      = sanitize_text_field($args['name']        ?? '');
    $desc      = sanitize_text_field($args['description'] ?? '');
    $thumb     = esc_url_raw($args['thumbnail_url']       ?? '');
    $date      = sanitize_text_field($args['upload_date'] ?? '');
    $embed_url = esc_url_raw($args['embed_url']           ?? '');
    $content   = esc_url_raw($args['content_url']         ?? '');
    $dur_raw   = sanitize_text_field($args['duration']    ?? '');

    if (!$name || !$desc || !$thumb || !$date) return;

    $schema = [
        '@context'     => 'https://schema.org',
        '@type'        => 'VideoObject',
        'name'         => $name,
        'description'  => $desc,
        'thumbnailUrl' => $thumb,
        'uploadDate'   => $date,
    ];

    if ($embed_url) $schema['embedUrl']   = $embed_url;
    if ($content)   $schema['contentUrl'] = $content;

    // Convert "M:SS" or "H:MM:SS" → ISO 8601 PT#H#M#S
    if ($dur_raw) {
        $parts = explode(':', $dur_raw);
        if (count($parts) === 3) {
            $schema['duration'] = sprintf('PT%dH%dM%dS', (int)$parts[0], (int)$parts[1], (int)$parts[2]);
        } elseif (count($parts) === 2) {
            $schema['duration'] = sprintf('PT%dM%dS', (int)$parts[0], (int)$parts[1]);
        }
    }

    echo "\n" . '<script type="application/ld+json">' . "\n";
    echo wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    echo "\n" . '</script>' . "\n";
}
