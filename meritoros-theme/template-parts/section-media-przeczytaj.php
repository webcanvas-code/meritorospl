<?php
$title = __( mer_field('media_prz_title', 'Przeczytaj również'), 'meritoros' );

$posts = get_posts([
    'post_type'      => 'media-article',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
]);

if (empty($posts)) return;
?>

<section class="py-14 md:py-20 bg-emerald-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Nagłówek z przyciskami nawigacji -->
        <div class="flex items-center justify-between mb-10">
            <h2 class="text-pretty text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-slate-900">
                <?php echo mer_esc($title); ?>
            </h2>
            <div class="flex items-center gap-2">
                <button id="mprz-prev"
                        class="w-11 h-11 rounded-full bg-white border border-slate-200 hover:border-emerald-400 hover:text-[#00d084] flex items-center justify-center text-slate-500 transition-colors duration-200 shadow-sm"
                        aria-label="<?php echo esc_attr(__('Poprzedni', 'meritoros')); ?>">
                    <i data-lucide="chevron-left" class="w-5 h-5"></i>
                </button>
                <button id="mprz-next"
                        class="w-11 h-11 rounded-full bg-[#00d084] hover:bg-[#00b872] flex items-center justify-center text-white transition-colors duration-200 shadow-sm"
                        aria-label="<?php echo esc_attr(__('Następny', 'meritoros')); ?>">
                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </button>
            </div>
        </div>

        <!-- Slider -->
        <div id="mprz-track"
             class="flex gap-6 overflow-x-auto snap-x snap-mandatory scroll-smooth pb-2"
             style="-ms-overflow-style:none; scrollbar-width:none;">

            <?php foreach ($posts as $p) :
                $photo     = get_field('ma_photo', $p->ID);
                $photo_url = is_array($photo) ? ($photo['url'] ?? '') : '';
                $photo_alt = is_array($photo) ? ($photo['alt'] ?? get_the_title($p)) : get_the_title($p);
                $source    = get_field('ma_source',   $p->ID) ?: '';
                $text      = get_field('ma_text',     $p->ID) ?: '';
                $btn_text  = __( get_field('ma_btn_text', $p->ID) ?: 'Przeczytaj artykuł', 'meritoros' );
                $btn_url   = get_field('ma_btn_url',  $p->ID) ?: get_permalink($p->ID);
            ?>
                <article class="flex-shrink-0 w-[300px] sm:w-[360px] lg:w-[400px] snap-start flex flex-col">
                    <a href="<?php echo esc_url($btn_url); ?>"
                       class="group flex flex-col h-full bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200">

                        <!-- Miniatura -->
                        <div class="relative aspect-video bg-slate-100 overflow-hidden">
                            <?php if ($photo_url) : ?>
                                <img src="<?php echo esc_url($photo_url); ?>"
                                     alt="<?php echo esc_attr($photo_alt); ?>"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                     loading="lazy">
                            <?php else : ?>
                                <div class="w-full h-full bg-emerald-50 flex items-center justify-center">
                                    <i data-lucide="newspaper" class="w-10 h-10 text-emerald-200"></i>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Treść -->
                        <div class="p-6 flex flex-col flex-1">
                            <?php if ($source) : ?>
                                <span class="text-xs font-semibold text-[#00d084] uppercase tracking-wide mb-2 block">
                                    <?php echo mer_esc($source); ?>
                                </span>
                            <?php endif; ?>
                            <p class="text-base font-semibold text-slate-900 leading-snug mb-2 line-clamp-3">
                                <?php echo mer_esc(get_the_title($p)); ?>
                            </p>
                            <?php if ($text) : ?>
                                <p class="text-sm text-slate-500 leading-relaxed line-clamp-3">
                                    <?php echo mer_esc($text); ?>
                                </p>
                            <?php endif; ?>
                            <span class="mer-btn mer-btn--secondary mt-auto pt-4 inline-block text-sm font-semibold text-slate-900 border border-slate-300 rounded-full px-4 py-1.5 group-hover:border-emerald-500 group-hover:text-emerald-700 transition-colors w-fit">
                                <?php echo mer_esc($btn_text); ?>
                            </span>
                        </div>

                    </a>
                </article>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<script>
(function () {
    var track = document.getElementById('mprz-track');
    var prev  = document.getElementById('mprz-prev');
    var next  = document.getElementById('mprz-next');
    if (!track) return;
    var step = function () {
        var card = track.querySelector('article');
        return card ? card.offsetWidth + 24 : 324;
    };
    prev.addEventListener('click', function () { track.scrollBy({ left: -step(), behavior: 'smooth' }); });
    next.addEventListener('click', function () { track.scrollBy({ left:  step(), behavior: 'smooth' }); });
})();
</script>
