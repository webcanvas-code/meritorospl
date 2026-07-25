<?php /* Template Name: Media i Newsroom */ get_header(); ?>
<main class="bg-white text-slate-900 antialiased">
    <?php get_template_part('template-parts/section', 'media-hero'); ?>
    <?php get_template_part('template-parts/section', 'media-artykul'); ?>
    <?php get_template_part('template-parts/section', 'media-video'); ?>
    <?php get_template_part('template-parts/section', 'media-mowia'); ?>
    <?php get_template_part('template-parts/section', 'media-przeczytaj'); ?>
    <?php get_template_part('template-parts/section', 'media-zapytania'); ?>
    <?php get_template_part('template-parts/section', 'newsletter'); ?>
</main>
<?php get_footer(); ?>
