<?php
defined('ABSPATH') || exit;

add_action('init', function () {
    register_post_type('customer-story', [
        'labels' => [
            'name'               => 'Historie klientów',
            'singular_name'      => 'Historia klienta',
            'add_new'            => 'Dodaj nową',
            'add_new_item'       => 'Dodaj nową historię',
            'edit_item'          => 'Edytuj historię',
            'new_item'           => 'Nowa historia',
            'view_item'          => 'Zobacz historię',
            'search_items'       => 'Szukaj historii',
            'not_found'          => 'Nie znaleziono historii',
            'not_found_in_trash' => 'Brak historii w koszu',
            'menu_name'          => 'Historie klientów',
        ],
        'public'        => true,
        'has_archive'   => false,
        'rewrite'       => ['slug' => 'historia-klienta', 'with_front' => false],
        'supports'      => ['title', 'thumbnail'],
        'show_in_rest'  => false,
        'menu_position' => 5,
        'menu_icon'     => 'dashicons-book-alt',
        'show_ui'       => true,
        'show_in_menu'  => true,
    ]);
});
