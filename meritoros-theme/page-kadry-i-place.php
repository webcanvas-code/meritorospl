<?php
/* Template Name: Kadry i płace */
get_header();
?>
<main class="bg-white text-slate-900 antialiased">
    <?php get_template_part('template-parts/section', 'kp-hero'); ?>
    <?php get_template_part('template-parts/section', 'kp-obsluga'); ?>
    <?php get_template_part('template-parts/section', 'kp-oferta'); ?>
    <?php get_template_part('template-parts/section', 'kp-cta'); ?>
    <?php get_template_part('template-parts/section', 'kp-model'); ?>
    <?php get_template_part('template-parts/section', 'kp-wspolpraca'); ?>
    <?php get_template_part('template-parts/section', 'kp-dlaczego'); ?>
    <?php get_template_part('template-parts/section', 'kp-kalkulator'); ?>
    <?php get_template_part('template-parts/section', 'case-studies'); ?>
    <?php get_template_part('template-parts/section', 'kp-systemy'); ?>
    <?php get_template_part('template-parts/section', 'blog'); ?>
    <?php get_template_part('template-parts/section', 'newsletter'); ?>
</main>
<?php get_footer(); ?>
