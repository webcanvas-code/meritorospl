<?php /* Template Name: Oferta pracy */ get_header(); ?>
<main class="bg-white text-slate-900 antialiased">
    <?php get_template_part('template-parts/section', 'oferta-kuk-hero'); ?>
    <?php get_template_part('template-parts/section', 'oferta-kuk-info'); ?>
    <?php if ( ! get_field('op_hide_oferta') ) : ?>
        <?php get_template_part('template-parts/section', 'oferta-kuk-oferta'); ?>
    <?php endif; ?>
    <?php get_template_part('template-parts/section', 'oferta-kuk-aplikuj'); ?>
    <?php get_template_part('template-parts/section', 'newsletter'); ?>
</main>
<?php get_footer(); ?>
