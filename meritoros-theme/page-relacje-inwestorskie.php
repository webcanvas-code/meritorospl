<?php
/* Template Name: Relacje inwestorskie */
get_header();
?>
<main class="bg-white text-slate-900 antialiased">
    <?php get_template_part('template-parts/section', 'ri-hero'); ?>
    <?php get_template_part('template-parts/section', 'ri-toc'); ?>
    <?php get_template_part('template-parts/section', 'ri-info'); ?>
    <?php get_template_part('template-parts/section', 'ri-rosniemy'); ?>
    <?php get_template_part('template-parts/section', 'ri-zarzad'); ?>
    <?php get_template_part('template-parts/section', 'ri-dane'); ?>
    <?php get_template_part('template-parts/section', 'ri-lista'); ?>
    <?php get_template_part('template-parts/section', 'ri-akcjonariat'); ?>
    <?php get_template_part('template-parts/section', 'ri-sprawozdania'); ?>
    <?php get_template_part('template-parts/section', 'ri-sprawozdania-zarzadu'); ?>
    <?php get_template_part('template-parts/section', 'ri-rewident'); ?>
    <?php get_template_part('template-parts/section', 'ri-uchwaly'); ?>
</main>
<?php get_footer(); ?>
