<?php
/* Template Name: Usługi księgowe */
get_header();
?>
<main class="bg-white text-slate-900 antialiased">
    <?php get_template_part('template-parts/section', 'uk-hero'); ?>
    <?php get_template_part('template-parts/section', 'uk-ksiegowosc'); ?>
    <?php get_template_part('template-parts/section', 'uk-oferta'); ?>
    <?php get_template_part('template-parts/section', 'uk-cta'); ?>
    <?php get_template_part('template-parts/section', 'uk-model'); ?>
    <?php get_template_part('template-parts/section', 'uk-wspolpraca'); ?>
    <?php get_template_part('template-parts/section', 'uk-dlaczego'); ?>
    <?php get_template_part('template-parts/section', 'uk-kalkulator'); ?>
    <?php get_template_part('template-parts/section', 'case-studies'); ?>
    <?php get_template_part('template-parts/section', 'uk-systemy'); ?>
    <?php get_template_part('template-parts/section', 'blog'); ?>
    <?php get_template_part('template-parts/section', 'newsletter'); ?>
</main>
<?php get_footer(); ?>
