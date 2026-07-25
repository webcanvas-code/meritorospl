<?php
defined('ABSPATH') || exit;

add_action('init', function () {
    register_post_type('media-article', [
        'labels' => [
            'name'               => 'Artykuły medialne',
            'singular_name'      => 'Artykuł medialny',
            'add_new'            => 'Dodaj nowy',
            'add_new_item'       => 'Dodaj nowy artykuł',
            'edit_item'          => 'Edytuj artykuł',
            'new_item'           => 'Nowy artykuł',
            'view_item'          => 'Zobacz artykuł',
            'search_items'       => 'Szukaj artykułów',
            'not_found'          => 'Nie znaleziono artykułów',
            'not_found_in_trash' => 'Brak artykułów w koszu',
            'menu_name'          => 'Artykuły medialne',
        ],
        'public'        => true,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'has_archive'   => false,
        'rewrite'       => ['slug' => 'artykul-medialny', 'with_front' => false],
        'supports'      => ['title'],
        'show_in_rest'  => false,
        'menu_position' => 6,
        'menu_icon'     => 'dashicons-megaphone',
    ]);
});
