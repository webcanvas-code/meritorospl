<?php
/* Template Name: Kupimy biuro rachunkowe */
get_header();
?>
<main class="bg-white text-slate-900 antialiased">
    <?php get_template_part('template-parts/section', 'kupimy-hero'); ?>
    <?php get_template_part('template-parts/section', 'kupimy-modele'); ?>
    <?php get_template_part('template-parts/section', 'kupimy-kryteria'); ?>
    <?php get_template_part('template-parts/section', 'kupimy-partnerski'); ?>
    <?php get_template_part('template-parts/section', 'kupimy-kontakt'); ?>
    <?php get_template_part('template-parts/section', 'kupimy-wycena'); ?>
    <?php get_template_part('template-parts/section', 'kupimy-wideo'); ?>
    <?php get_template_part('template-parts/section', 'kupimy-kalkulator'); ?>
</main>
<?php get_footer(); ?>
