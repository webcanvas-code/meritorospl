<?php
// Fallback template — redirects to front-page.php for the homepage,
// or renders a basic loop for other pages.
get_header();

if (have_posts()) :
    while (have_posts()) : the_post(); ?>
        <main class="max-w-[1400px] mx-auto px-6 lg:px-12 py-24">
            <h1 class="text-3xl font-bold mb-6"><?php the_title(); ?></h1>
            <div class="prose max-w-none"><?php the_content(); ?></div>
        </main>
    <?php endwhile;
endif;

get_footer();
