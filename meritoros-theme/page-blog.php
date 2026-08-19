<?php
/*
 * Template Name: Wiedza i poradniki
 */

get_header();

/* ── Capture page ID before any WP_Query loops overwrite $post ─── */
$blog_page_id = get_the_ID();

/* ── ACF hero fields ───────────────────────────────────────────── */
$hero_title  = get_field('blog_hero_title')  ?: __('Wiedza i poradniki', 'meritoros');
$hero_desc   = get_field('blog_hero_desc')   ?: __('Publikujemy treści dotyczące księgowości, kadr, BPO i zmian, które mają realny wpływ na prowadzenie firmy. Znajdziesz tu zarówno materiały eksperckie, jak i aktualności dotyczące rynku oraz działalności Meritoros.', 'meritoros');
$btn1_text   = get_field('blog_btn1_text')   ?: __('Pobierz e-book', 'meritoros');
$btn1_url    = get_field('blog_btn1_url')    ?: '';
$btn2_text   = get_field('blog_btn2_text')   ?: __('Porozmawiajmy', 'meritoros');
$btn2_url    = get_field('blog_btn2_url')    ?: '#kontakt';

/* ── Query both CPTs ───────────────────────────────────────────── */
$all_posts = [];

$ma_query = new WP_Query([
    'post_type'      => 'media-article',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
]);
if ($ma_query->have_posts()) {
    foreach ($ma_query->posts as $post) {
        $all_posts[] = ['post' => $post, 'cpt' => 'media-article'];
    }
}

$cs_query = new WP_Query([
    'post_type'      => 'customer-story',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
]);
if ($cs_query->have_posts()) {
    foreach ($cs_query->posts as $post) {
        $all_posts[] = ['post' => $post, 'cpt' => 'customer-story'];
    }
}

/* ── Query regular WP posts (imported from old site) ──────────── */
$wp_query = new WP_Query([
    'post_type'      => 'post',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
]);
if ($wp_query->have_posts()) {
    foreach ($wp_query->posts as $post) {
        $all_posts[] = ['post' => $post, 'cpt' => 'post'];
    }
}

/* ── Map old WP category slugs → new filter slugs ────────────── */
function mer_map_category_to_filter(array $cats): array {
    $map = [
        'bpo'                          => 'bpo',
        'blog-podatkowo-ksiegowe'      => 'podatkowe',
        'informacje-podatkowo-ksiegowe'=> 'podatkowe',
        'podatkowe'                    => 'podatkowe',
        'rynek-biur-rachunkowych'      => 'rynek',
        'rynek'                        => 'rynek',
        'case-studies'                 => 'historie',
        'case-study'                   => 'historie',
        'blog-wolontariat'             => 'medialne',
        'wolontariat'                  => 'medialne',
        'blog-inne'                    => 'medialne',
        'inne'                         => 'medialne',
    ];
    $result = [];
    foreach ($cats as $cat) {
        $slug = $cat->slug;
        $result[] = isset($map[$slug]) ? $map[$slug] : 'medialne';
    }
    return $result ?: ['medialne'];
}

/* Sort all posts by date DESC */
usort($all_posts, function ($a, $b) {
    return strtotime($b['post']->post_date) - strtotime($a['post']->post_date);
});
?>

<!-- ══════════════════════════════════════════════════════════════
     HERO
═══════════════════════════════════════════════════════════════ -->
<section class="pt-36 pb-16 bg-[#f0faf4] relative overflow-hidden">

    <!-- Decorative circle -->
    <div class="absolute top-0 right-0 w-[480px] h-[480px] rounded-full bg-[#00d084]/10 -translate-y-1/4 translate-x-1/4 pointer-events-none" aria-hidden="true">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo.svg'); ?>"
             alt=""
             class="absolute inset-0 m-auto w-48 opacity-10" loading="eager" aria-hidden="true">
    </div>

    <div class="relative max-w-7xl mx-auto px-6">

        <!-- Breadcrumb -->
        <div class="flex items-center flex-wrap gap-1 text-xs sm:text-sm text-slate-400 mb-6">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-[#00d084] transition-colors"><?php esc_html_e('Strona główna', 'meritoros'); ?></a>
            <span>/</span>
            <span class="text-slate-600 font-medium"><?php echo mer_esc($hero_title); ?></span>
        </div>

        <div class="max-w-3xl">
            <h1 class="text-pretty text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-slate-900 mb-6 leading-[1.1]">
                <?php echo nl2br(esc_html($hero_title)); ?>
            </h1>
            <p class="text-slate-600 text-base leading-relaxed max-w-2xl mb-10">
                <?php echo mer_esc($hero_desc); ?>
            </p>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="<?php echo esc_url($btn2_url); ?>"
                   class="inline-flex items-center justify-center gap-2 bg-[#00d084] text-white rounded-full px-7 py-3.5 text-base font-semibold hover:bg-[#00b872] transition-colors duration-200">
                    <?php echo mer_esc($btn2_text); ?>
                </a>
                <?php if ($btn1_url || $btn1_text) : ?>
                    <a href="<?php echo esc_url($btn1_url ?: '#'); ?>"
                       class="inline-flex items-center justify-center gap-2 border border-slate-800 text-slate-800 rounded-full px-7 py-3.5 text-base font-semibold hover:bg-slate-800 hover:text-white transition-colors duration-200">
                        <?php echo mer_esc($btn1_text); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════════════
     FILTER TABS
═══════════════════════════════════════════════════════════════ -->
<div id="blog-filter-bar" class="sticky top-20 z-40 bg-white border-b border-slate-100 shadow-sm shadow-black/[0.03]">
    <div class="max-w-[1400px] mx-auto px-6 lg:px-12">
        <div class="flex items-center gap-2 overflow-x-auto py-4 scrollbar-hide -mx-1 px-1">
            <?php
            $filters = [
                'wszystkie' => __('Wszystkie', 'meritoros'),
                'bpo'       => 'BPO',
                'podatkowe' => __('Podatkowo-księgowe', 'meritoros'),
                'rynek'     => __('Rynek biur rachunkowych', 'meritoros'),
                'filmy'     => __('Filmy', 'meritoros'),
                'medialne'  => __('Artykuły medialne', 'meritoros'),
                'historie'  => __('Historie klientów', 'meritoros'),
            ];
            foreach ($filters as $slug => $label) :
                $is_active = ($slug === 'wszystkie');
            ?>
                <button
                    data-filter="<?php echo esc_attr($slug); ?>"
                    class="shrink-0 px-5 py-2 rounded-full text-sm font-medium whitespace-nowrap transition-colors duration-200 <?php echo $is_active ? 'bg-[#00d084] text-white border-transparent' : 'border border-slate-200 text-slate-700'; ?>">
                    <?php echo mer_esc($label); ?>
                </button>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════════════════════════════
     CARDS GRID
═══════════════════════════════════════════════════════════════ -->
<section class="py-14 md:py-20 bg-slate-50">
    <div class="max-w-[1400px] mx-auto px-6 lg:px-12">

        <?php if (empty($all_posts)) : ?>
            <p class="text-slate-500 text-center py-20"><?php esc_html_e('Brak opublikowanych artykułów.', 'meritoros'); ?></p>
        <?php else : ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            <?php foreach ($all_posts as $entry) :
                $post = $entry['post'];
                $cpt  = $entry['cpt'];
                setup_postdata($post);

                /* ── Pobierz kategorie dla karty ── */
                if ($cpt === 'post') {
                    $wp_cats  = get_the_category($post->ID);
                    $raw_cats = !empty($wp_cats) ? mer_map_category_to_filter($wp_cats) : ['medialne'];
                } else {
                    $raw_cats = get_field('article_category', $post->ID);
                    if (empty($raw_cats) || !is_array($raw_cats)) {
                        $raw_cats = ($cpt === 'customer-story') ? ['historie'] : ['medialne'];
                    }
                }
                $data_cats = implode(' ', array_map('sanitize_html_class', $raw_cats));

                /* ── Sprawdź czy to film ── */
                $is_film    = in_array('filmy', $raw_cats, true);
                $video_url  = $is_film ? (get_field('ma_video_url', $post->ID) ?: '') : '';

                /* ── Resolve embed src + auto-thumbnail ── */
                $embed_src  = '';
                $embed_type = '';
                $auto_thumb = '';
                if ($video_url) {
                    if (preg_match('/(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/', $video_url, $_ym)) {
                        $embed_src  = 'https://www.youtube.com/embed/' . $_ym[1] . '?autoplay=1&rel=0';
                        $auto_thumb = 'https://img.youtube.com/vi/' . $_ym[1] . '/hqdefault.jpg';
                        $embed_type = 'embed';
                    } elseif (preg_match('/vimeo\.com\/(\d+)/', $video_url, $_vm)) {
                        $embed_src  = 'https://player.vimeo.com/video/' . $_vm[1] . '?autoplay=1';
                        $embed_type = 'embed';
                    } else {
                        $embed_src  = $video_url;
                        $embed_type = 'file';
                    }
                }
            ?>

            <?php if ($cpt === 'media-article') : ?>

                <?php /* ═══════════ KARTA MEDIA-ARTICLE ═══════════ */ ?>
                <article class="blog-card bg-white rounded-2xl overflow-hidden border border-slate-100 flex flex-col hover:shadow-md hover:shadow-black/5 transition-shadow duration-300<?php echo !$is_film ? ' cursor-pointer' : ''; ?>"
                         data-cats="<?php echo esc_attr($data_cats); ?>"
                         <?php if (!$is_film) : ?>onclick="window.location.href='<?php echo esc_js($link); ?>'"<?php endif; ?>>

                    <?php
                    $photo     = get_field('ma_photo', $post->ID);
                    $source    = get_field('ma_source', $post->ID);
                    $ma_text   = get_field('ma_text', $post->ID);
                    $btn_url   = get_field('ma_btn_url', $post->ID);
                    $btn_text  = get_field('ma_btn_text', $post->ID) ?: __('Przeczytaj artykuł', 'meritoros');
                    $link      = $btn_url ?: get_permalink($post);
                    $post_date = get_the_date('j F Y', $post);

                    /* Thumbnail: uploaded photo takes priority; YouTube auto-thumb as fallback */
                    $thumb_url = ($photo && is_array($photo)) ? ($photo['url'] ?? '') : $auto_thumb;
                    $thumb_alt = ($photo && is_array($photo)) ? ($photo['alt'] ?? get_the_title($post)) : get_the_title($post);
                    ?>

                    <?php if ($is_film) : ?>
                        <!-- Film overlay -->
                        <?php if ($embed_src) : ?>
                        <div class="blog-play-trigger relative block aspect-video overflow-hidden bg-slate-900 group cursor-pointer"
                             data-src="<?php echo esc_attr($embed_src); ?>"
                             data-type="<?php echo esc_attr($embed_type); ?>">
                        <?php else : ?>
                        <a href="<?php echo esc_url($link); ?>" class="relative block aspect-video overflow-hidden bg-slate-900 group">
                        <?php endif; ?>
                            <?php if ($thumb_url) : ?>
                                <img src="<?php echo esc_url($thumb_url); ?>"
                                     alt="<?php echo esc_attr($thumb_alt); ?>"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                                <div class="absolute inset-0 bg-slate-900/30 group-hover:bg-slate-900/20 transition-colors duration-300"></div>
                            <?php else : ?>
                                <div class="w-full h-full bg-slate-800"></div>
                            <?php endif; ?>
                            <!-- Play button -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-16 h-16 rounded-full bg-[#00d084] flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform duration-300">
                                    <i data-lucide="play" fill="#fff" class="w-6 h-6 text-white ml-0.5" stroke-width="0"></i>
                                </div>
                            </div>
                            <!-- Badge Film -->
                            <span class="absolute top-3 left-3 bg-purple-500 text-white text-xs font-semibold px-3 py-1 rounded-full"><?php esc_html_e('Film', 'meritoros'); ?></span>
                        <?php if ($embed_src) : ?>
                        </div>
                        <?php else : ?>
                        </a>
                        <?php endif; ?>
                    <?php else : ?>
                        <!-- Regular photo -->
                        <?php
                        // Obsłuż oba formaty ACF (array lub integer ID) + fallback na Featured Image
                        $_ma_url = '';
                        $_ma_alt = get_the_title($post);
                        if (is_array($photo) && !empty($photo['url'])) {
                            $_ma_url = $photo['url'];
                            $_ma_alt = $photo['alt'] ?: $_ma_alt;
                        } elseif (is_numeric($photo) && (int) $photo > 0) {
                            $_ma_url = wp_get_attachment_url((int) $photo) ?: '';
                        }
                        if (!$_ma_url) {
                            $_ma_url = get_the_post_thumbnail_url($post, 'large') ?: '';
                        }
                        ?>
                        <div class="relative aspect-video overflow-hidden bg-emerald-50">
                            <?php if ($_ma_url) : ?>
                                <img src="<?php echo esc_url($_ma_url); ?>"
                                     alt="<?php echo esc_attr($_ma_alt); ?>"
                                     class="w-full h-full object-cover" loading="lazy">
                            <?php else : ?>
                                <div class="w-full h-full bg-emerald-50 flex items-center justify-center">
                                    <i data-lucide="newspaper" class="w-10 h-10 text-emerald-200"></i>
                                </div>
                            <?php endif; ?>
                            <time class="absolute bottom-3 left-3 bg-black/50 backdrop-blur-sm text-white text-xs font-medium px-2.5 py-1 rounded-full"><?php echo mer_esc($post_date); ?></time>
                        </div>
                    <?php endif; ?>

                    <div class="p-6 flex flex-col flex-1 gap-3">
                        <?php if ($source) : ?>
                            <span class="text-xs font-semibold text-[#00d084] uppercase tracking-wide"><?php echo mer_esc($source); ?></span>
                        <?php endif; ?>

                        <h2 class="text-pretty font-semibold text-slate-900 text-base leading-snug line-clamp-3">
                            <a href="<?php echo esc_url($is_film ? get_permalink($post) : $link); ?>" class="hover:text-emerald-700 transition-colors">
                                <?php echo mer_esc(get_the_title($post)); ?>
                            </a>
                        </h2>

                        <?php if ($ma_text) : ?>
                            <p class="text-slate-500 text-sm leading-relaxed line-clamp-2"><?php echo mer_esc($ma_text); ?></p>
                        <?php endif; ?>

                        <div class="mt-auto pt-4 border-t border-slate-100">
                            <?php if ($is_film && $embed_src) : ?>
                                <?php $show_article_link = get_field('ma_show_article_link', $post->ID); ?>
                                <?php if ($show_article_link) : ?>
                                    <a href="<?php echo esc_url(get_permalink($post)); ?>"
                                       class="text-sm font-medium text-slate-700 border-b-2 border-emerald-500 hover:text-emerald-700 transition-colors" onclick="event.stopPropagation()">
                                        <?php esc_html_e('Czytaj artykuł', 'meritoros'); ?>
                                    </a>
                                <?php endif; ?>
                            <?php else : ?>
                                <a href="<?php echo esc_url($link); ?>"
                                   class="text-sm font-medium text-slate-700 border-b-2 border-emerald-500 hover:text-emerald-700 transition-colors" onclick="event.stopPropagation()">
                                    <?php echo mer_esc($btn_text); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </article>

            <?php elseif ($cpt === 'customer-story') : ?>

                <?php /* ═══════════ KARTA CUSTOMER-STORY ═══════════ */ ?>
                <?php
                $cs_logo      = get_field('cs_logo',       $post->ID);
                $cs_thumb_acf = get_field('cs_thumbnail',  $post->ID);
                $cs_vid_url   = get_field('cs_video_url',  $post->ID) ?: '';
                $cs_vid_file  = get_field('cs_video_file', $post->ID);
                $cs_tags_raw  = get_field('cs_tags',       $post->ID);
                $cs_tags_arr  = $cs_tags_raw ? array_filter(array_map('trim', explode("\n", $cs_tags_raw))) : [];
                $cs_title     = get_the_title($post);
                $cs_link      = get_permalink($post);
                $initial      = mb_strtoupper(mb_substr($cs_title, 0, 1));

                // Resolve embed + auto-thumbnail for film cards
                $cs_embed_src  = '';
                $cs_embed_type = '';
                $cs_yt_id      = '';
                if ($is_film) {
                    if (is_array($cs_vid_file) && !empty($cs_vid_file['url'])) {
                        $cs_embed_src  = esc_url($cs_vid_file['url']);
                        $cs_embed_type = 'file';
                    } elseif ($cs_vid_url) {
                        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/', $cs_vid_url, $_cm)) {
                            $cs_yt_id     = $_cm[1];
                            $cs_embed_src = esc_attr('https://www.youtube.com/embed/' . $cs_yt_id . '?autoplay=1&rel=0');
                        } elseif (preg_match('/vimeo\.com\/(\d+)/', $cs_vid_url, $_cm)) {
                            $cs_embed_src = esc_attr('https://player.vimeo.com/video/' . $_cm[1] . '?autoplay=1');
                        } else {
                            $cs_embed_src = esc_attr($cs_vid_url);
                        }
                        $cs_embed_type = 'embed';
                    }
                    // Thumbnail: uploaded > YouTube auto-fetch
                    if (is_array($cs_thumb_acf) && !empty($cs_thumb_acf['url'])) {
                        $cs_thumb_url = $cs_thumb_acf['url'];
                    } elseif ($cs_yt_id) {
                        $cs_thumb_url = 'https://img.youtube.com/vi/' . $cs_yt_id . '/hqdefault.jpg';
                    } else {
                        $cs_thumb_url = '';
                    }
                }
                ?>
                <article class="blog-card bg-white rounded-2xl overflow-hidden border border-slate-100 flex flex-col hover:shadow-md hover:shadow-black/5 transition-shadow duration-300<?php echo !$is_film ? ' cursor-pointer' : ''; ?>"
                         data-cats="<?php echo esc_attr($data_cats); ?>"
                         <?php if (!$is_film) : ?>onclick="window.location.href='<?php echo esc_js($cs_link); ?>'"<?php endif; ?>>

                    <?php if ($is_film) : ?>
                        <!-- Film overlay -->
                        <?php if ($cs_embed_src) : ?>
                        <div class="blog-play-trigger relative block aspect-video overflow-hidden bg-slate-900 group cursor-pointer"
                             data-src="<?php echo esc_attr($cs_embed_src); ?>"
                             data-type="<?php echo esc_attr($cs_embed_type); ?>">
                        <?php else : ?>
                        <a href="<?php echo esc_url($cs_link); ?>" class="relative block aspect-video overflow-hidden bg-slate-900 group">
                        <?php endif; ?>
                            <?php if (!empty($cs_thumb_url)) : ?>
                                <img src="<?php echo esc_url($cs_thumb_url); ?>"
                                     alt="<?php echo esc_attr($cs_title); ?>"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                                <div class="absolute inset-0 bg-slate-900/30 group-hover:bg-slate-900/20 transition-colors duration-300"></div>
                            <?php else : ?>
                                <div class="w-full h-full bg-slate-800"></div>
                            <?php endif; ?>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-16 h-16 rounded-full bg-[#00d084] flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform duration-300">
                                    <i data-lucide="play" fill="#fff" class="w-6 h-6 text-white ml-0.5" stroke-width="0"></i>
                                </div>
                            </div>
                            <span class="absolute top-3 left-3 bg-purple-500 text-white text-xs font-semibold px-3 py-1 rounded-full"><?php esc_html_e('Film', 'meritoros'); ?></span>
                        <?php if ($cs_embed_src) : ?>
                        </div>
                        <?php else : ?>
                        </a>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php
                        // Priorytet: ACF thumbnail > YouTube auto-fetch > logo/placeholder
                        $cs_static_thumb = '';
                        $cs_static_alt   = $cs_title;
                        if (is_array($cs_thumb_acf) && !empty($cs_thumb_acf['url'])) {
                            $cs_static_thumb = $cs_thumb_acf['url'];
                            $cs_static_alt   = $cs_thumb_acf['alt'] ?: $cs_title;
                        } elseif ($cs_vid_url && preg_match('/(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/', $cs_vid_url, $_cm)) {
                            $cs_static_thumb = 'https://img.youtube.com/vi/' . $_cm[1] . '/hqdefault.jpg';
                        }
                        ?>
                        <?php if ($cs_static_thumb) : ?>
                            <!-- Miniatura (zdjęcie lub YouTube) -->
                            <div class="relative aspect-video overflow-hidden bg-slate-100">
                                <img src="<?php echo esc_url($cs_static_thumb); ?>"
                                     alt="<?php echo esc_attr($cs_static_alt); ?>"
                                     class="w-full h-full object-cover" loading="lazy">
                            </div>
                        <?php else : ?>
                            <!-- Logo / Placeholder -->
                            <div class="p-6 pb-0">
                                <?php if ($cs_logo && is_array($cs_logo)) : ?>
                                    <div class="bg-slate-50 rounded-xl p-4 inline-flex items-center justify-center">
                                        <img src="<?php echo esc_url($cs_logo['url']); ?>"
                                             alt="<?php echo esc_attr($cs_logo['alt'] ?: $cs_title); ?>"
                                             class="h-10 w-auto object-contain" loading="lazy">
                                    </div>
                                <?php else : ?>
                                    <div class="w-14 h-14 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 font-bold text-xl">
                                        <?php echo mer_esc($initial); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="p-6 flex flex-col flex-1 gap-3">
                        <!-- Badge -->
                        <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 text-xs font-semibold px-3 py-1 rounded-full w-fit">
                            <i data-lucide="users" class="w-3 h-3 stroke-2"></i>
                            <?php esc_html_e('Historia klienta', 'meritoros'); ?>
                        </span>

                        <!-- Tags -->
                        <?php if (!empty($cs_tags_arr)) : ?>
                            <div class="flex flex-wrap gap-2">
                                <?php foreach (array_slice($cs_tags_arr, 0, 3) as $tag) : ?>
                                    <span class="bg-slate-100 text-slate-600 text-xs font-medium px-2.5 py-1 rounded-full"><?php echo mer_esc($tag); ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <h2 class="text-pretty font-semibold text-slate-900 text-base leading-snug line-clamp-3">
                            <a href="<?php echo esc_url($is_film ? get_permalink($post) : $cs_link); ?>" class="hover:text-emerald-700 transition-colors">
                                <?php echo mer_esc($cs_title); ?>
                            </a>
                        </h2>

                        <div class="mt-auto pt-4 border-t border-slate-100">
                            <a href="<?php echo esc_url($cs_link); ?>"
                               class="text-sm font-medium text-slate-700 border-b-2 border-emerald-500 hover:text-emerald-700 transition-colors" onclick="event.stopPropagation()">
                                <?php esc_html_e('Czytaj historię', 'meritoros'); ?>
                            </a>
                        </div>
                    </div>
                </article>

            <?php elseif ($cpt === 'post') : ?>

                <?php /* ═══════════ KARTA ZWYKŁY POST WP ═══════════ */ ?>
                <?php
                $wp_thumb_url = get_the_post_thumbnail_url($post, 'large') ?: '';
                $wp_thumb_alt = get_the_title($post);
                $wp_excerpt   = wp_trim_words(get_the_excerpt($post), 25, '…');
                $wp_link      = get_permalink($post);
                $wp_date      = get_the_date('j F Y', $post);
                $wp_read_time = get_field('reading_time', $post->ID) ?: __('5 min czytania', 'meritoros');
                $wp_cat_name  = '';
                $_wpcats      = get_the_category($post->ID);
                if (!empty($_wpcats)) $wp_cat_name = $_wpcats[0]->name;
                ?>
                <article class="blog-card bg-white rounded-2xl overflow-hidden border border-slate-100 flex flex-col hover:shadow-md hover:shadow-black/5 transition-shadow duration-300 cursor-pointer"
                         data-cats="<?php echo esc_attr($data_cats); ?>"
                         onclick="window.location.href='<?php echo esc_js($wp_link); ?>'">

                    <div class="relative aspect-video overflow-hidden bg-emerald-50">
                        <?php if ($wp_thumb_url) : ?>
                            <img src="<?php echo esc_url($wp_thumb_url); ?>"
                                 alt="<?php echo esc_attr($wp_thumb_alt); ?>"
                                 class="w-full h-full object-cover" loading="lazy">
                        <?php else : ?>
                            <div class="w-full h-full bg-emerald-50 flex items-center justify-center">
                                <i data-lucide="newspaper" class="w-10 h-10 text-emerald-200"></i>
                            </div>
                        <?php endif; ?>
                        <time class="absolute bottom-3 left-3 bg-black/50 backdrop-blur-sm text-white text-xs font-medium px-2.5 py-1 rounded-full"><?php echo mer_esc($wp_date); ?></time>
                    </div>

                    <div class="p-6 flex flex-col flex-1 gap-3">
                        <?php if ($wp_cat_name) : ?>
                            <span class="text-xs font-semibold text-[#00d084] uppercase tracking-wide"><?php echo mer_esc($wp_cat_name); ?></span>
                        <?php endif; ?>

                        <h2 class="text-pretty font-semibold text-slate-900 text-base leading-snug line-clamp-3">
                            <a href="<?php echo esc_url($wp_link); ?>" class="hover:text-emerald-700 transition-colors" onclick="event.stopPropagation()">
                                <?php echo mer_esc(get_the_title($post)); ?>
                            </a>
                        </h2>

                        <?php if ($wp_excerpt) : ?>
                            <p class="text-slate-500 text-sm leading-relaxed line-clamp-2"><?php echo mer_esc($wp_excerpt); ?></p>
                        <?php endif; ?>

                        <div class="mt-auto pt-4 border-t border-slate-100">
                            <a href="<?php echo esc_url($wp_link); ?>"
                               class="text-sm font-medium text-slate-700 border-b-2 border-emerald-500 hover:text-emerald-700 transition-colors" onclick="event.stopPropagation()">
                                <?php esc_html_e('Przeczytaj artykuł', 'meritoros'); ?>
                            </a>
                        </div>
                    </div>
                </article>

            <?php endif; ?>

            <?php endforeach; wp_reset_postdata(); ?>
        </div>

        <!-- Empty state -->
        <div id="blog-empty" class="hidden py-20 text-center text-slate-400 text-base">
            <?php esc_html_e('Brak artykułów w tej kategorii.', 'meritoros'); ?>
        </div>

        <!-- Load more -->
        <div id="blog-load-more-wrap" class="mt-12 text-center">
            <button id="blog-load-more"
                    class="inline-flex items-center gap-2 border border-slate-300 text-slate-700 rounded-full px-8 py-3.5 text-sm font-semibold hover:border-[#00d084] hover:text-[#00d084] transition-colors duration-200">
                <?php esc_html_e('Załaduj więcej', 'meritoros'); ?>
                <i data-lucide="chevron-down" class="w-4 h-4 stroke-[2.5]"></i>
            </button>
        </div>

        <?php endif; ?>
    </div>
</section>

<?php get_template_part('template-parts/section', 'wideoinstruktaze', ['pid' => $blog_page_id]); ?>

<?php get_template_part('template-parts/section-ebook', null, ['pid' => $blog_page_id]); ?>

<!-- ══════════════════════════════════════════════════════════════
     VIDEO MODAL
═══════════════════════════════════════════════════════════════ -->
<div id="blog-vid-modal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 md:p-10">
    <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm" id="blog-vid-backdrop"></div>
    <div class="relative w-full max-w-4xl z-10">
        <button id="blog-vid-close" class="absolute -top-10 right-0 text-white/80 hover:text-white transition-colors flex items-center gap-1.5 text-sm">
            <i data-lucide="x" class="w-5 h-5"></i> <?php esc_html_e('Zamknij', 'meritoros'); ?>
        </button>
        <div id="blog-vid-embed-wrap" class="relative w-full hidden" style="padding-bottom:56.25%">
            <iframe id="blog-vid-iframe" class="absolute inset-0 w-full h-full rounded-2xl" src="" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
        </div>
        <div id="blog-vid-file-wrap" class="hidden">
            <video id="blog-vid-file" controls autoplay playsinline class="w-full rounded-2xl bg-black max-h-[80vh]" src=""></video>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════════════════════════════
     JS FILTER + PAGINATION + VIDEO
═══════════════════════════════════════════════════════════════ -->
<script>
(function() {
    var PER_PAGE   = 9;
    var btns       = document.querySelectorAll('[data-filter]');
    var cards      = Array.from(document.querySelectorAll('.blog-card'));
    var emptyEl    = document.getElementById('blog-empty');
    var loadMoreEl = document.getElementById('blog-load-more');
    var loadWrap   = document.getElementById('blog-load-more-wrap');
    var activeFilter = 'wszystkie';
    var visibleCount = 0;

    function getFilteredCards() {
        return cards.filter(function(card) {
            if (activeFilter === 'wszystkie') return true;
            var cats = card.dataset.cats ? card.dataset.cats.split(' ') : [];
            return cats.indexOf(activeFilter) !== -1;
        });
    }

    function applyPagination() {
        var filtered = getFilteredCards();
        cards.forEach(function(card) { card.style.display = 'none'; });
        filtered.slice(0, visibleCount).forEach(function(card) { card.style.display = ''; });
        emptyEl.style.display  = filtered.length === 0 ? '' : 'none';
        loadWrap.style.display = visibleCount >= filtered.length ? 'none' : '';
    }

    /* ── Filter tabs ── */
    btns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            activeFilter = btn.dataset.filter;
            visibleCount = PER_PAGE;
            btns.forEach(function(b) {
                b.classList.toggle('bg-[#00d084]', b === btn);
                b.classList.toggle('text-white', b === btn);
                b.classList.toggle('border-transparent', b === btn);
                b.classList.toggle('border-slate-200', b !== btn);
                b.classList.toggle('text-slate-700', b !== btn);
            });
            applyPagination();
        });
    });

    /* ── Load more ── */
    if (loadMoreEl) {
        loadMoreEl.addEventListener('click', function() {
            visibleCount += PER_PAGE;
            applyPagination();
        });
    }

    /* ── Init: show first 9 ── */
    visibleCount = PER_PAGE;
    applyPagination();

    /* ── Stick filter bar just below navbar ── */
    (function () {
        var header = document.getElementById('mer-header');
        var bar    = document.getElementById('blog-filter-bar');
        function updateTop() {
            if (!header || !bar) return;
            bar.style.top = header.getBoundingClientRect().bottom + 'px';
        }
        updateTop();
        window.addEventListener('resize', updateTop);
    })();

    /* ── Video modal ── */
    var modal      = document.getElementById('blog-vid-modal');
    var backdrop   = document.getElementById('blog-vid-backdrop');
    var closeBtn   = document.getElementById('blog-vid-close');
    var embedWrap  = document.getElementById('blog-vid-embed-wrap');
    var fileWrap   = document.getElementById('blog-vid-file-wrap');
    var iframe     = document.getElementById('blog-vid-iframe');
    var videoEl    = document.getElementById('blog-vid-file');

    function openModal(src, type) {
        if (!src) return;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
        if (type === 'file') {
            fileWrap.classList.remove('hidden'); embedWrap.classList.add('hidden');
            videoEl.src = src;
        } else {
            embedWrap.classList.remove('hidden'); fileWrap.classList.add('hidden');
            iframe.src = src;
        }
    }
    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
        iframe.src = '';
        videoEl.pause();
        videoEl.src = '';
    }

    document.querySelectorAll('.blog-play-trigger').forEach(function(el) {
        el.addEventListener('click', function() {
            openModal(el.dataset.src, el.dataset.type);
        });
    });
    backdrop.addEventListener('click', closeModal);
    closeBtn.addEventListener('click', closeModal);
    document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeModal(); });
})();
</script>

<?php get_footer(); ?>
