<?php
/**
 * Front Page Template — Meritoros
 * All sections are fully editable via ACF.
 */
get_header();
?>

<main class="bg-slate-50 text-slate-900 antialiased selection:bg-[#2d8650] selection:text-white">

    <?php get_template_part('template-parts/section', 'hero'); ?>
    <?php get_template_part('template-parts/section', 'values'); ?>
    <?php get_template_part('template-parts/section', 'services'); ?>
    <?php get_template_part('template-parts/section', 'case-studies'); ?>
    <?php get_template_part('template-parts/section', 'testimonials'); ?>
    <?php get_template_part('template-parts/section', 'buyout'); ?>
    <?php get_template_part('template-parts/section', 'blog'); ?>
    <?php get_template_part('template-parts/section', 'newsletter'); ?>

</main>

<?php get_footer(); ?>
