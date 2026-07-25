<?php
$_page_id = get_queried_object_id();
$title    = get_field('media_mowia_title', $_page_id) ?: 'Mówią o nas';

$posts = get_posts([
    'post_type'      => 'media-article',
    'posts_per_page' => 6,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
    'meta_query'     => [[
        'key'     => 'article_category',
        'value'   => '"mowia"',
        'compare' => 'LIKE',
    ]],
]);

if (empty($posts)) return;
?>

<section class="py-16 md:py-24 bg-emerald-50">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-pretty text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-slate-900 mb-10">
            <?php echo mer_esc($title); ?>
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($posts as $p) :
                $photo     = get_field('ma_photo', $p->ID);
                $photo_url = is_array($photo) ? ($photo['url'] ?? '') : '';
                $photo_alt = is_array($photo) ? ($photo['alt'] ?? get_the_title($p)) : get_the_title($p);
                $text      = get_field('ma_text',     $p->ID) ?: '';
                $btn_text  = get_field('ma_btn_text', $p->ID) ?: 'Przeczytaj artykuł';
                $btn_url   = get_field('ma_btn_url',  $p->ID) ?: get_permalink($p->ID);
            ?>
            <div class="flex flex-col">
                <div class="rounded-2xl overflow-hidden aspect-[4/3] mb-5">
                    <?php if ($photo_url) : ?>
                        <img src="<?php echo esc_url($photo_url); ?>"
                             alt="<?php echo esc_attr($photo_alt); ?>"
                             class="w-full h-full object-cover" loading="lazy">
                    <?php else : ?>
                        <div class="w-full h-full bg-emerald-100"></div>
                    <?php endif; ?>
                </div>

                <h3 class="text-lg font-semibold text-slate-900 leading-snug mb-2">
                    <?php echo mer_esc(get_the_title($p)); ?>
                </h3>
                <?php if ($text) : ?>
                    <p class="text-base sm:text-lg text-slate-500 leading-relaxed mb-4">
                        <?php echo mer_esc($text); ?>
                    </p>
                <?php endif; ?>

                <a href="<?php echo esc_url($btn_url); ?>"
                   class="mt-auto inline-block text-sm font-semibold text-slate-900 border-b-2 border-emerald-500 pb-0.5 hover:text-emerald-700 hover:border-emerald-700 transition-colors w-fit">
                    <?php echo mer_esc($btn_text); ?>
                </a>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
