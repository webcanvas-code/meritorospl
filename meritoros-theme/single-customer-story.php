<?php
defined('ABSPATH') || exit;
get_header();

if ( ! have_posts() ) {
    get_footer();
    exit;
}
the_post();

/* ── ACF pola ────────────────────────────────────────────────────── */
$tags    = array_values(array_filter(array_map('trim', explode("\n", get_field('cs_tags') ?: ''))));
$lead    = get_field('cs_video_desc');
$logo     = get_field('cs_logo');
$logo_url = get_field('cs_logo_url');

$client_sec_title = get_field('cs_client_sec_title') ?: __('Informacje o kliencie:', 'meritoros');
$client_info      = get_field('cs_client_info');

$challenge_sec_title = get_field('cs_challenge_sec_title') ?: __('Wyzwanie', 'meritoros');
$challenge           = get_field('cs_challenge');

$cta_title    = get_field('cs_cta_title')    ?: __("Oddaj księgowość\nw ręce ekspertów", 'meritoros');
$cta_btn_text = get_field('cs_cta_btn_text') ?: __('Umów się na rozmowę', 'meritoros');
$cta_btn_url  = get_field('cs_cta_btn_url')  ?: get_permalink(get_page_by_path('kontakt'));

$thumbnail   = get_field('cs_thumbnail');
$cover_image = get_field('cs_cover_image');
$video_url   = get_field('cs_video_url') ?: '';
$video_file = get_field('cs_video_file');

$solution_sec_title = get_field('cs_solution_sec_title') ?: __('Rozwiązanie', 'meritoros');
$solution_text      = get_field('cs_solution_text');
$solution_items     = array_values(array_filter(array_map('trim', explode("\n", get_field('cs_solution_items') ?: ''))));
$solution_extra     = get_field('cs_solution_extra');

$how_sec_title = get_field('cs_how_sec_title') ?: __('Jak to zrobiliśmy?', 'meritoros');
$how           = get_field('cs_how');

$effects_sec_title = get_field('cs_effects_sec_title') ?: __('Efekt wdrożenia i korzyści', 'meritoros');
$effects_intro     = get_field('cs_effects_intro');
$effects_sub_title = get_field('cs_effects_sub_title') ?: __('Najważniejsze efekty:', 'meritoros');
$effects_items     = array_values(array_filter(array_map('trim', explode("\n", get_field('cs_effects_items') ?: ''))));

$testimonial        = get_field('cs_testimonial_text');
$testimonial_author = get_field('cs_testimonial_author');

$benefits_title = get_field('cs_benefits_title') ?: __('Wdrożenie przyniosło również konkretne, mierzalne korzyści:', 'meritoros');
$benefits = [];
for ( $i = 1; $i <= 8; $i++ ) {
    $b = get_field("cs_benefit_{$i}");
    if ( ! empty($b['label']) || ! empty($b['value']) ) {
        $benefits[] = $b;
    }
}

/* ── Wideo: źródło ───────────────────────────────────────────────── */
$play_src  = '';
$play_type = '';
$yt_id     = '';
if ( is_array($video_file) && ! empty($video_file['url']) ) {
    $play_src  = esc_url($video_file['url']);
    $play_type = 'file';
} elseif ( $video_url ) {
    if ( preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $video_url, $m) ) {
        $yt_id    = $m[1];
        $play_src = 'https://www.youtube.com/embed/' . $yt_id . '?autoplay=1&rel=0';
    } elseif ( preg_match('/vimeo\.com\/(\d+)/', $video_url, $m) ) {
        $play_src = 'https://player.vimeo.com/video/' . $m[1] . '?autoplay=1';
    } else {
        $play_src = $video_url;
    }
    $play_type = 'embed';
}
// Miniatura: YouTube → z YouTube, inne wideo → cs_thumbnail, brak wideo → cs_cover_image
if ( $yt_id ) {
    $thumb_url = 'https://img.youtube.com/vi/' . $yt_id . '/maxresdefault.jpg';
} elseif ( is_array($thumbnail) && ! empty($thumbnail['url']) ) {
    $thumb_url = $thumbnail['url'];
} elseif ( is_array($cover_image) && ! empty($cover_image['url']) ) {
    $thumb_url = $cover_image['url'];
} else {
    $thumb_url = '';
}

/* ── Breadcrumbs ─────────────────────────────────────────────────── */
$hk_page = get_page_by_path('historie-klientow');
$hk_url  = $hk_page ? get_permalink($hk_page) : home_url('/historie-klientow/');
?>
<main class="bg-white text-slate-900 antialiased">

    <!-- ════════════════════════════════════════════════════════════
         HERO – breadcrumbs / tytuł / tagi
    ════════════════════════════════════════════════════════════════ -->
    <section class="relative pt-32 md:pt-44 pb-8">

        <!-- Dekoracyjny okrąg w tle -->
        <div class="absolute -right-20 top-1/2 -translate-y-1/2 w-[320px] h-[320px] rounded-full border-[40px] border-emerald-100 pointer-events-none" aria-hidden="true"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

            <!-- Breadcrumbs + przycisk wstecz -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-10">
                <nav class="flex items-center gap-1.5 text-base text-slate-400" aria-label="<?php esc_attr_e('Breadcrumb', 'meritoros'); ?>">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-[#2d8650] transition-colors"><?php esc_html_e('Strona główna', 'meritoros'); ?></a>
                    <span>/</span>
                    <a href="<?php echo esc_url($hk_url); ?>" class="hover:text-[#2d8650] transition-colors"><?php esc_html_e('Historie klientów', 'meritoros'); ?></a>
                    <span>/</span>
                    <span class="text-slate-600"><?php the_title(); ?></span>
                </nav>
                <a href="<?php echo esc_url($hk_url); ?>"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full border border-slate-200 bg-white text-slate-700 text-sm font-semibold hover:border-[#2d8650] hover:text-[#2d8650] transition-colors duration-200 self-start sm:self-auto shrink-0">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    <?php esc_html_e('Historie klientów', 'meritoros'); ?>
                </a>
            </div>

            <!-- Tytuł + Logo -->
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-6 mb-10">
                <h1 class="text-pretty text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-slate-900 leading-[1.1] max-w-3xl">
                    <?php the_title(); ?>
                </h1>
                <?php if ( $logo ) : ?>
                <div class="shrink-0 flex flex-col items-start sm:items-end gap-2 sm:pt-2">
                    <img src="<?php echo esc_url($logo['url']); ?>"
                         alt="<?php echo esc_attr($logo['alt'] ?: get_the_title()); ?>"
                         style="max-height:64px;max-width:180px;width:auto;height:auto;object-fit:contain;"
                         loading="lazy">
                    <?php if ( $logo_url ) : ?>
                    <a href="<?php echo esc_url($logo_url); ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="text-sm text-slate-400 hover:text-[#2d8650] transition-colors duration-200 flex items-center gap-1">
                        <?php echo esc_html(preg_replace('#^https?://(www\.)?#', '', rtrim($logo_url, '/'))); ?>
                        <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
                    </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Tagi -->
            <?php if ( $tags ) : ?>
            <div class="flex flex-wrap gap-3">
                <?php foreach ( $tags as $i => $tag ) : ?>
                <?php if ( $i === 0 ) : ?>
                <span class="inline-flex items-center px-6 py-2.5 rounded-full bg-[#2d8650] text-white text-base font-semibold">
                    <?php echo mer_esc($tag); ?>
                </span>
                <?php else : ?>
                <span class="inline-flex items-center px-6 py-2.5 rounded-full bg-white text-slate-700 text-base font-semibold border border-slate-300">
                    <?php echo mer_esc($tag); ?>
                </span>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- ════════════════════════════════════════════════════════════
         KLIENT + WIDEO  |  WYZWANIE + CTA
    ════════════════════════════════════════════════════════════════ -->
    <?php $has_video = $thumb_url || $play_src; ?>
    <section class="py-14 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <?php if ( $has_video ) : ?>
            <!-- Layout z wideo: 2 kolumny -->
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 lg:gap-20">

                <!-- Lewa kolumna: lead + info o kliencie + wyzwanie + wideo -->
                <div class="lg:col-span-3 flex flex-col gap-10">

                    <?php if ( $lead ) : ?>
                    <p class="text-xl text-slate-600 leading-relaxed">
                        <?php echo mer_esc($lead); ?>
                    </p>
                    <?php endif; ?>

                    <?php if ( $client_info ) : ?>
                    <div>
                        <h2 class="text-pretty text-2xl md:text-3xl font-bold text-slate-900 mb-5">
                            <?php echo mer_esc($client_sec_title); ?>
                        </h2>
                        <div class="prose prose-lg prose-slate max-w-none text-slate-600 leading-relaxed">
                            <?php echo wp_kses_post($client_info); ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if ( $challenge ) : ?>
                    <div>
                        <h2 class="text-pretty text-2xl md:text-3xl font-bold text-slate-900 mb-5">
                            <?php echo mer_esc($challenge_sec_title); ?>
                        </h2>
                        <div class="prose prose-lg prose-slate max-w-none text-slate-600 leading-relaxed">
                            <?php echo wp_kses_post($challenge); ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="relative rounded-2xl overflow-hidden bg-slate-100 aspect-video group<?php echo $play_src ? ' cursor-pointer' : ''; ?>"
                         <?php if ( $play_src ) : ?>
                         data-play-src="<?php echo esc_attr($play_src); ?>"
                         data-play-type="<?php echo esc_attr($play_type); ?>"
                         onclick="csOpenVideo(this)"
                         <?php endif; ?>>
                        <?php if ( $thumb_url ) : ?>
                        <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>"
                             class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-105" loading="lazy">
                        <?php endif; ?>
                        <div class="absolute inset-0 flex items-center justify-center bg-slate-900/25 group-hover:bg-slate-900/20 transition-colors duration-300">
                            <div class="w-20 h-20 rounded-full bg-[#2d8650] flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform duration-300<?php echo ! $play_src ? ' pointer-events-none' : ''; ?>">
                                <i data-lucide="play" fill="#fff" class="w-8 h-8 text-white ml-0.5" stroke-width="0"></i>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Prawa kolumna: CTA kafelek -->
                <div class="lg:col-span-2 flex flex-col gap-10">

                    <div class="mt-auto rounded-2xl bg-slate-900 p-6 relative overflow-hidden">
                        <div class="absolute -right-8 -top-8 w-32 h-32 bg-[#2d8650]/20 blur-2xl rounded-full pointer-events-none"></div>
                        <span class="text-[#2d8650] text-xs font-bold uppercase tracking-widest mb-3 block relative z-10">Skontaktuj się</span>
                        <p class="text-white text-lg font-bold leading-snug mb-5 relative z-10">
                            <?php echo mer_esc($cta_title); ?>
                        </p>
                        <a href="<?php echo esc_url($cta_btn_url ?: '#'); ?>"
                           class="relative z-10 inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#2d8650] text-white text-sm font-semibold hover:bg-[#246e41] transition-colors duration-200">
                            <?php echo mer_esc($cta_btn_text); ?>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>

                </div>
            </div>

        <?php else : ?>
            <!-- Layout bez wideo: jedna kolumna -->
            <div class="max-w-4xl flex flex-col gap-6">

                <?php if ( $client_info ) : ?>
                <div>
                    <h2 class="text-pretty text-2xl md:text-3xl font-bold text-slate-900 mb-5">
                        <?php echo mer_esc($client_sec_title); ?>
                    </h2>
                    <div class="prose prose-lg prose-slate max-w-none text-slate-600 leading-relaxed">
                        <?php echo wp_kses_post($client_info); ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( $challenge ) : ?>
                <div>
                    <h2 class="text-pretty text-2xl md:text-3xl font-bold text-slate-900 mb-5">
                        <?php echo mer_esc($challenge_sec_title); ?>
                    </h2>
                    <div class="prose prose-lg prose-slate max-w-none text-slate-600 leading-relaxed">
                        <?php echo wp_kses_post($challenge); ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="rounded-2xl bg-slate-900 p-8 relative overflow-hidden text-center">
                    <div class="absolute -right-8 -top-8 w-40 h-40 bg-[#2d8650]/20 blur-2xl rounded-full pointer-events-none"></div>
                    <div class="absolute -left-8 -bottom-8 w-40 h-40 bg-[#2d8650]/10 blur-2xl rounded-full pointer-events-none"></div>
                    <span class="text-[#2d8650] text-xs font-bold uppercase tracking-widest mb-3 block relative z-10">Skontaktuj się</span>
                    <p class="text-white text-xl md:text-2xl font-bold leading-snug mb-6 relative z-10">
                        <?php echo mer_esc($cta_title); ?>
                    </p>
                    <a href="<?php echo esc_url($cta_btn_url ?: '#'); ?>"
                       class="relative z-10 inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#2d8650] text-white text-base font-semibold hover:bg-[#246e41] transition-colors duration-200">
                        <?php echo mer_esc($cta_btn_text); ?>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>

            </div>
        <?php endif; ?>

        </div>
    </section>


    <!-- ════════════════════════════════════════════════════════════
         ROZWIĄZANIE
    ════════════════════════════════════════════════════════════════ -->
    <?php if ( $solution_text || $solution_items ) : ?>
    <section class="py-14 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl">

                <h2 class="text-pretty text-3xl md:text-4xl lg:text-5xl font-bold text-[#2d8650] mb-6">
                    <?php echo mer_esc($solution_sec_title); ?>
                </h2>

                <?php if ( $solution_text ) : ?>
                <div class="prose prose-lg prose-slate max-w-none text-slate-600 leading-relaxed mb-8">
                    <?php echo wp_kses_post($solution_text); ?>
                </div>
                <?php endif; ?>

                <?php if ( $solution_items ) : ?>
                <ul class="space-y-4 mb-8">
                    <?php foreach ( $solution_items as $item ) : ?>
                    <li class="flex items-start gap-4">
                        <span class="flex-shrink-0 mt-1 w-6 h-6 rounded-full bg-[#2d8650] flex items-center justify-center">
                            <i data-lucide="check" class="w-3.5 h-3.5 text-white" stroke-width="3"></i>
                        </span>
                        <span class="text-lg text-slate-700 leading-relaxed"><?php echo mer_esc($item); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>

                <?php if ( $solution_extra ) : ?>
                <div class="prose prose-lg prose-slate max-w-none text-slate-700 leading-relaxed">
                    <?php echo wp_kses_post($solution_extra); ?>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ════════════════════════════════════════════════════════════
         JAK TO ZROBILIŚMY
    ════════════════════════════════════════════════════════════════ -->
    <?php if ( $how ) : ?>
    <section class="py-14 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl">

                <h2 class="text-pretty text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 mb-6">
                    <?php echo mer_esc($how_sec_title); ?>
                </h2>

                <div class="prose prose-lg prose-slate max-w-none text-slate-600 leading-relaxed">
                    <?php echo wp_kses_post($how); ?>
                </div>

            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ════════════════════════════════════════════════════════════
         EFEKT WDROŻENIA I KORZYŚCI
    ════════════════════════════════════════════════════════════════ -->
    <?php if ( $effects_intro || $effects_items ) : ?>
    <section class="py-14 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl">

                <h2 class="text-pretty text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 mb-6">
                    <?php echo mer_esc($effects_sec_title); ?>
                </h2>

                <?php if ( $effects_intro ) : ?>
                <div class="prose prose-lg prose-slate max-w-none text-slate-600 leading-relaxed mb-8">
                    <?php echo mer_esc($effects_intro); ?>
                </div>
                <?php endif; ?>

                <?php if ( $effects_items ) : ?>
                <p class="text-lg font-bold text-slate-900 mb-5"><?php echo mer_esc($effects_sub_title); ?></p>

                <ul class="space-y-4">
                    <?php foreach ( $effects_items as $item ) : ?>
                    <li class="flex items-start gap-4">
                        <span class="flex-shrink-0 mt-1 w-6 h-6 rounded-full bg-[#2d8650] flex items-center justify-center">
                            <i data-lucide="check" class="w-3.5 h-3.5 text-white" stroke-width="3"></i>
                        </span>
                        <span class="text-lg text-slate-700 leading-relaxed"><?php echo mer_esc($item); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>

            </div>
        </div>

    </section>
    <?php endif; ?>

    <!-- ════════════════════════════════════════════════════════════
         KORZYŚCI
    ════════════════════════════════════════════════════════════════ -->
    <?php if ( $benefits ) : ?>
    <section class="py-14 md:py-20 relative">
        <div class="absolute -right-40 top-0 w-[500px] h-[500px] rounded-full border-[40px] border-emerald-100 pointer-events-none" aria-hidden="true"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

            <h2 class="text-pretty text-2xl md:text-3xl lg:text-4xl font-bold text-slate-900 mb-12 max-w-3xl leading-snug">
                <?php echo mer_esc($benefits_title); ?>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <?php foreach ( $benefits as $b ) : ?>
                <div class="rounded-2xl border border-slate-200 bg-white p-7 flex flex-col gap-5">
                    <i data-lucide="circle-check" class="w-7 h-7 text-[#2d8650] flex-shrink-0" stroke-width="1.5"></i>
                    <div>
                        <?php if ( ! empty($b['label']) ) : ?>
                        <p class="text-lg font-bold text-slate-900 leading-snug mb-3">
                            <?php echo mer_esc($b['label']); ?>
                        </p>
                        <?php endif; ?>
                        <?php if ( ! empty($b['desc']) ) : ?>
                        <p class="text-base text-slate-500 leading-relaxed">
                            <?php echo mer_esc($b['desc']); ?>
                        </p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>
    <?php endif; ?>

    <!-- ════════════════════════════════════════════════════════════
         CYTAT
    ════════════════════════════════════════════════════════════════ -->
    <?php if ( $testimonial ) : ?>
    <section class="py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <blockquote class="rounded-2xl border border-slate-200 bg-slate-50 px-10 py-10">
                <p class="text-xl md:text-2xl text-slate-600 italic leading-relaxed mb-5">
                    „<?php echo mer_esc($testimonial); ?>"
                </p>
                <?php if ( $testimonial_author ) : ?>
                <footer class="text-base font-bold text-slate-900">
                    <?php echo mer_esc($testimonial_author); ?>
                </footer>
                <?php endif; ?>
            </blockquote>
        </div>
    </section>
    <?php endif; ?>

    <!-- ════════════════════════════════════════════════════════════
         OPINIE KLIENTÓW
    ════════════════════════════════════════════════════════════════ -->
    <?php get_template_part('template-parts/section', 'testimonials'); ?>

    <!-- ════════════════════════════════════════════════════════════
         PRZECZYTAJ RÓWNIEŻ
    ════════════════════════════════════════════════════════════════ -->
    <?php get_template_part('template-parts/section', 'cs-related'); ?>

</main>

<!-- Modal wideo -->
<div id="cs-video-modal"
     class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4">
    <div class="relative w-full max-w-4xl aspect-video bg-black rounded-2xl overflow-hidden shadow-2xl">
        <button onclick="csCloseVideo()"
                class="absolute top-3 right-3 z-10 w-9 h-9 rounded-full bg-black/60 hover:bg-black/80 flex items-center justify-center text-white transition-colors">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
        <div id="cs-video-content" class="w-full h-full"></div>
    </div>
</div>

<script>
function csOpenVideo(el) {
    var src  = el.dataset.playSrc;
    var type = el.dataset.playType;
    var content = document.getElementById('cs-video-content');
    var modal   = document.getElementById('cs-video-modal');
    if (!src) return;
    content.innerHTML = type === 'file'
        ? '<video src="' + src + '" controls autoplay class="w-full h-full object-contain"></video>'
        : '<iframe src="' + src + '" frameborder="0" allow="autoplay; fullscreen" allowfullscreen class="w-full h-full"></iframe>';
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}
function csCloseVideo() {
    var modal   = document.getElementById('cs-video-modal');
    var content = document.getElementById('cs-video-content');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    content.innerHTML = '';
    document.body.style.overflow = '';
}
document.getElementById('cs-video-modal').addEventListener('click', function (e) {
    if (e.target === this) csCloseVideo();
});
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') csCloseVideo();
});
</script>

<?php get_footer(); ?>
