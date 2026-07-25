<?php
defined('ABSPATH') || exit;

/* ------------------------------------------------------------------
   1. Ukryj wersję WordPressa
   Usuwa <meta name="generator">, wersje z URL-i CSS/JS i nagłówek HTTP
------------------------------------------------------------------ */
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', '__return_empty_string');

add_filter('style_loader_src', 'mer_remove_ver_query', 10, 2);
add_filter('script_loader_src', 'mer_remove_ver_query', 10, 2);
function mer_remove_ver_query(string $src): string {
    if (str_contains($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}

add_filter('wp_headers', function (array $headers): array {
    unset($headers['X-Powered-By']);
    return $headers;
});

/* ------------------------------------------------------------------
   2. Wyłącz niepotrzebne nagłówki w <head>
   RSD, WLW Manifest, shortlink, feeds, emoji
------------------------------------------------------------------ */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);

// Usuń emoji — zewnętrzny request do s.w.org i ~10 KB skryptów
remove_action('wp_head',             'print_emoji_detection_script', 7);
remove_action('wp_print_styles',     'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles',  'print_emoji_styles');
add_filter('emoji_svg_url', '__return_false');

// Usuń CSS Gutenberg Block Library (nie używamy edytora blokowego)
add_action('wp_enqueue_scripts', function (): void {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
}, 100);

/* ------------------------------------------------------------------
   3. Wyłącz XML-RPC
   Biuro rachunkowe nie potrzebuje pingbacków ani remote publishing
------------------------------------------------------------------ */
add_filter('xmlrpc_enabled', '__return_false');
add_filter('wp_headers', function (array $headers): array {
    unset($headers['X-Pingback']);
    return $headers;
});
remove_action('wp_head', 'wp_xmlrpc_meta');

/* ------------------------------------------------------------------
   4. Ukryj użytkowników przez REST API
   Bez tego: /wp-json/wp/v2/users ujawnia loginy adminów
------------------------------------------------------------------ */
add_filter('rest_endpoints', function (array $endpoints): array {
    unset(
        $endpoints['/wp/v2/users'],
        $endpoints['/wp/v2/users/(?P<id>[\d]+)']
    );
    return $endpoints;
});

/* ------------------------------------------------------------------
   5. Blokuj enumerację autorów przez ?author=1
   Bez tego: /?author=1 przekierowuje na /author/admin/ i ujawnia login
------------------------------------------------------------------ */
add_action('init', function (): void {
    if (!is_admin() && isset($_GET['author'])) {
        wp_die('Forbidden', 'Forbidden', ['response' => 403]);
    }
});

/* ------------------------------------------------------------------
   6. Ochrona przed brute-force: limit prób logowania (5 na 15 min / IP)
------------------------------------------------------------------ */
add_filter('authenticate', function ($user, string $username, string $password) {
    if (empty($username) || empty($password)) {
        return $user;
    }

    $ip          = sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '');
    $lockout_key = 'mer_login_' . md5($ip);
    $attempts    = (int) get_transient($lockout_key);

    if ($attempts >= 5) {
        return new WP_Error(
            'too_many_attempts',
            'Zbyt wiele nieudanych prób logowania. Spróbuj ponownie za 15 minut.'
        );
    }

    return $user;
}, 20, 3);

add_action('wp_login_failed', function (): void {
    $ip          = sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '');
    $lockout_key = 'mer_login_' . md5($ip);
    $attempts    = (int) get_transient($lockout_key);
    set_transient($lockout_key, $attempts + 1, 15 * MINUTE_IN_SECONDS);
});

add_action('wp_login', function (): void {
    $ip          = sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '');
    $lockout_key = 'mer_login_' . md5($ip);
    delete_transient($lockout_key);
});

/* ------------------------------------------------------------------
   7. Neutralny komunikat błędu logowania
   Nie ujawnia czy login czy hasło jest złe
------------------------------------------------------------------ */
add_filter('login_errors', function (): string {
    return 'Nieprawidłowy login lub hasło.';
});

/* ------------------------------------------------------------------
   8. Security headers HTTP
   Nie wysyłaj na admin ani REST — żeby nie blokować dashboardu
------------------------------------------------------------------ */
add_action('send_headers', function (): void {
    if (is_admin() || (defined('REST_REQUEST') && REST_REQUEST)) {
        return;
    }

    header('X-Frame-Options: SAMEORIGIN');
    header('X-Content-Type-Options: nosniff');
    header('X-XSS-Protection: 1; mode=block');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
});

/* ------------------------------------------------------------------
   9. Wyłącz edytor plików w dashboardzie
   Zapobiega edycji motywu/pluginów przez panel admina po włamaniu
------------------------------------------------------------------ */
if (!defined('DISALLOW_FILE_EDIT')) {
    define('DISALLOW_FILE_EDIT', true);
}

/* ------------------------------------------------------------------
   10. Wyłącz self-pingbacki (pingback do własnej domeny)
------------------------------------------------------------------ */
add_action('pre_ping', function (array &$links): void {
    $home = get_option('home');
    foreach ($links as $key => $link) {
        if (str_starts_with($link, $home)) {
            unset($links[$key]);
        }
    }
});

/* ------------------------------------------------------------------
   11. Ogranicz REST API dla niezalogowanych
   Blokuje /wp/v2/users, pozostawia CF7 i WPML
------------------------------------------------------------------ */
add_filter('rest_authentication_errors', function ($result) {
    if (!empty($result)) {
        return $result;
    }
    if (!is_user_logged_in()) {
        $allowed_namespaces = ['contact-form-7', 'wpml'];
        $route = $GLOBALS['wp']->query_vars['rest_route'] ?? '';
        foreach ($allowed_namespaces as $ns) {
            if (str_starts_with(ltrim($route, '/'), $ns)) {
                return $result;
            }
        }
        if (str_starts_with(ltrim($route, '/'), 'wp/v2/users')) {
            return new WP_Error('rest_forbidden', 'Brak dostępu.', ['status' => 403]);
        }
    }
    return $result;
});
