<?php /* Template Name: Historie klientów */ get_header(); ?>
<main class="bg-white text-slate-900 antialiased">
    <?php get_template_part('template-parts/section', 'hk-hero'); ?>
    <?php get_template_part('template-parts/section', 'hk-wspolpraca'); ?>
    <?php get_template_part('template-parts/section', 'hk-video'); ?>
    <?php get_template_part('template-parts/section', 'testimonials', ['hide_cs_link' => true]); ?>
    <?php get_template_part('template-parts/section', 'hk-cta'); ?>
    <?php get_template_part('template-parts/section', 'hk-logos'); ?>
</main>
<?php get_footer(); ?>
