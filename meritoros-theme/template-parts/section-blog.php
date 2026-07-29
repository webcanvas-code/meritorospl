<?php
// Czytaj pola zawsze ze strony głównej — ACFML zwróci wersję w aktualnym języku
$_blog_id      = (int) get_option('page_on_front');
$section_label = (get_field('blog_label',     $_blog_id) ?: 'Wiedza i aktualności');
$section_title = (get_field('blog_title',     $_blog_id) ?: 'Blog');
$link_text     = (get_field('blog_link_text', $_blog_id) ?: 'Wszystkie wpisy');
$link_url      = (get_field('blog_link_url',  $_blog_id) ?: get_permalink(get_option('page_for_posts')) ?: '/blog');

// Query 3 latest posts
$posts = new WP_Query([
    'posts_per_page' => 3,
    'post_status'    => 'publish',
    'no_found_rows'  => true,
]);

if (!$posts->have_posts()) return;
?>

<section class="py-16 md:py-24 px-6 lg:px-12 bg-slate-50 border-t border-slate-100">
    <div class="max-w-[1400px] mx-auto">

        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
            <div>
                <span class="text-[#2d8650] uppercase tracking-widest text-base font-bold mb-4 block">
                    <?php echo mer_esc($section_label); ?>
                </span>
                <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900">
                    <?php echo mer_esc($section_title); ?>
                </h2>
            </div>
            <a href="<?php echo esc_url($link_url); ?>"
               class="inline-flex items-center gap-2 text-base font-semibold text-slate-500 hover:text-[#2d8650] transition-colors group shrink-0">
                <?php echo mer_esc($link_text); ?>
                <i data-lucide="arrow-up-right" class="w-5 h-5 stroke-[2] group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">

            <?php while ($posts->have_posts()) : $posts->the_post();
                $post_id     = get_the_ID();
                $permalink   = esc_url(get_permalink());
                $post_title  = get_the_title();
                $excerpt     = wp_trim_words(get_the_excerpt(), 25, '…');
                $date        = get_the_date('j F Y');
                $cat         = get_the_category($post_id);
                $cat_name    = !empty($cat) ? esc_html($cat[0]->name) : '';
                $thumb_url   = get_the_post_thumbnail_url($post_id, 'large') ?: '';
                $thumb_alt   = get_the_title();
            ?>

                <article class="bg-white rounded-2xl overflow-hidden border border-slate-100 flex flex-col hover:shadow-md hover:shadow-black/5 transition-shadow duration-300">

                    <a href="<?php echo $permalink; ?>" class="block aspect-video overflow-hidden bg-emerald-50 group">
                        <?php if ($thumb_url) : ?>
                            <img src="<?php echo esc_url($thumb_url); ?>"
                                 alt="<?php echo esc_attr($thumb_alt); ?>"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                 loading="lazy">
                        <?php else : ?>
                            <div class="w-full h-full bg-emerald-50 flex items-center justify-center">
                                <i data-lucide="newspaper" class="w-10 h-10 text-emerald-200"></i>
                            </div>
                        <?php endif; ?>
                    </a>

                    <div class="p-6 flex flex-col flex-1 gap-3">
                        <?php if ($cat_name) : ?>
                            <span class="text-xs font-semibold text-[#2d8650] uppercase tracking-wide"><?php echo $cat_name; ?></span>
                        <?php endif; ?>

                        <h3 class="text-pretty font-semibold text-slate-900 text-base leading-snug line-clamp-3">
                            <a href="<?php echo $permalink; ?>" class="hover:text-emerald-700 transition-colors">
                                <?php echo esc_html($post_title); ?>
                            </a>
                        </h3>

                        <?php if ($excerpt) : ?>
                            <p class="text-slate-500 text-sm leading-relaxed line-clamp-2"><?php echo esc_html($excerpt); ?></p>
                        <?php endif; ?>

                        <div class="mt-auto flex items-center justify-between pt-4 border-t border-slate-100 gap-3">
                            <time class="text-xs text-slate-400 shrink-0"><?php echo esc_html($date); ?></time>
                            <a href="<?php echo $permalink; ?>"
                               class="text-sm font-medium text-slate-700 border-b-2 border-emerald-500 hover:text-emerald-700 transition-colors">
                                <?php esc_html_e('Przeczytaj artykuł', 'meritoros'); ?>
                            </a>
                        </div>
                    </div>

                </article>

            <?php endwhile; wp_reset_postdata(); ?>

        </div>
    </div>
</section>
