<?php
/* Template Name: O nas */
get_header();
?>
<main class="bg-white text-slate-900 antialiased">
    <?php get_template_part('template-parts/section', 'onas-hero'); ?>
    <?php get_template_part('template-parts/section', 'onas-kim'); ?>
    <?php get_template_part('template-parts/section', 'onas-jak'); ?>
    <?php get_template_part('template-parts/section', 'onas-wartosci'); ?>
    <?php get_template_part('template-parts/section', 'onas-mapa'); ?>
    <?php get_template_part('template-parts/section', 'onas-zespol'); ?>
    <?php get_template_part('template-parts/section', 'blog'); ?>
    <?php get_template_part('template-parts/section', 'newsletter'); ?>
</main>
<?php get_footer(); ?>
