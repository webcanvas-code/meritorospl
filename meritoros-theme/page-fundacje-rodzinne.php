<?php
/* Template Name: Fundacje rodzinne */
get_header();
?>
<main class="bg-white text-slate-900 antialiased">
    <?php get_template_part('template-parts/section', 'fr-hero'); ?>
    <?php get_template_part('template-parts/section', 'fr-obsluga'); ?>
    <?php get_template_part('template-parts/section', 'fr-oferta'); ?>
    <?php get_template_part('template-parts/section', 'fr-zyski'); ?>
    <?php get_template_part('template-parts/section', 'fr-dlaczego'); ?>
    <?php get_template_part('template-parts/section', 'fr-model'); ?>
    <?php get_template_part('template-parts/section', 'blog'); ?>
    <?php get_template_part('template-parts/section', 'newsletter'); ?>
</main>
<?php get_footer(); ?>
