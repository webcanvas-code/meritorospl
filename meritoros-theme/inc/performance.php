<?php
defined('ABSPATH') || exit;

/* ------------------------------------------------------------------
   decoding="async" na wszystkich obrazach WordPress
   Przeglądarka dekoduje obraz w tle — nie blokuje głównego wątku
   Filter działa na wp_get_attachment_image() i get_the_post_thumbnail()
------------------------------------------------------------------ */
add_filter('wp_get_attachment_image_attributes', function (array $attr): array {
    if (!isset($attr['decoding'])) {
        $attr['decoding'] = 'async';
    }
    return $attr;
});

/* ------------------------------------------------------------------
   Wyłącz zbędne style Gutenberga ładowane na froncie
   (blokowy edytor nie jest używany w tym motywie)
   Uwaga: już obsługiwane w security.php przez wp_dequeue_style,
   ale upewniamy się też na poziomie add_theme_support
------------------------------------------------------------------ */
add_action('after_setup_theme', function (): void {
    // Wyłącz domyślne style bloków — motyw używa Tailwind zamiast
    remove_theme_support('core-block-patterns');
}, 11);

/* ------------------------------------------------------------------
   Usuń zbędne style oEmbed / Dashicons na froncie
   (Dashicons ładuje się tylko gdy zalogowany — WP to obsługuje,
   ale oEmbed styles są niepotrzebne na tym motywie)
------------------------------------------------------------------ */
add_action('wp_enqueue_scripts', function (): void {
    wp_dequeue_style('wp-embed');
}, 100);

/* ------------------------------------------------------------------
   Dodaj `defer` do Lucide icons — ładuje się po DOMContentLoaded
   Bez tego blokuje parsowanie HTML
------------------------------------------------------------------ */
add_filter('script_loader_tag', function (string $tag, string $handle): string {
    if ($handle === 'lucide') {
        return str_replace(' src=', ' defer src=', $tag);
    }
    return $tag;
}, 10, 2);
