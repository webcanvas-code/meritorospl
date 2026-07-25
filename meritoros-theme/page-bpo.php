<?php
/* Template Name: BPO */
get_header();
?>
<main class="bg-white text-slate-900 antialiased">
    <?php get_template_part('template-parts/section', 'bpo-hero'); ?>
    <?php get_template_part('template-parts/section', 'bpo-info'); ?>
    <?php get_template_part('template-parts/section', 'bpo-obszary'); ?>
    <?php get_template_part('template-parts/section', 'bpo-kadrowe'); ?>
    <?php get_template_part('template-parts/section', 'bpo-ksiegowe'); ?>
    <?php get_template_part('template-parts/section', 'bpo-cta'); ?>
    <?php get_template_part('template-parts/section', 'bpo-cyfrowa'); ?>
    <?php get_template_part('template-parts/section', 'bpo-dlaczego'); ?>
    <?php get_template_part('template-parts/section', 'bpo-model'); ?>
    <?php get_template_part('template-parts/section', 'bpo-wspolpraca'); ?>
    <?php get_template_part('template-parts/section', 'case-studies'); ?>
    <?php get_template_part('template-parts/section', 'bpo-systemy'); ?>
    <?php get_template_part('template-parts/section', 'blog'); ?>
    <?php get_template_part('template-parts/section', 'newsletter'); ?>
</main>
<?php get_footer(); ?>
