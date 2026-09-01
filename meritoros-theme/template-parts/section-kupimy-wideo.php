<?php
defined('ABSPATH') || exit;

$heading  = __( mer_field('kupimy_wideo_heading',  'Jak wygląda sprzedaż biura rachunkowego w praktyce?'), 'meritoros' );
$desc     = __( mer_field('kupimy_wideo_desc',     'Jeśli chcesz lepiej zrozumieć kulisy takiego procesu, zobacz materiał, w którym omawiamy najważniejsze kwestie związane ze sprzedażą firmy usługowej i przejęciem biura rachunkowego.'), 'meritoros' );
$video_url = mer_field('kupimy_wideo_url', '');
$thumbnail = mer_field('kupimy_wideo_thumbnail');

/* Wyciągnij ID z YouTube i zbuduj embed URL */
$yt_id     = '';
$play_src  = '';
$play_type = '';
if ( $video_url ) {
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

/*
 * Miniatura: kolejność priorytetu
 *  1. Auto z YouTube (maxresdefault → hqdefault jako srcset fallback)
 *  2. Ręcznie wgrane zdjęcie w ACF
 *  3. Domyślna grafika zastępcza
 */
if ( $yt_id ) {
    $thumb_url      = 'https://img.youtube.com/vi/' . $yt_id . '/maxresdefault.jpg';
    $thumb_url_hq   = 'https://img.youtube.com/vi/' . $yt_id . '/hqdefault.jpg';
} elseif ( is_array($thumbnail) ) {
    $thumb_url    = $thumbnail['url'];
    $thumb_url_hq = '';
} else {
    $thumb_url    = 'https://images.unsplash.com/photo-1560472355-536de3962603?w=900&q=80';
    $thumb_url_hq = '';
}
?>

<section class="py-14 md:py-20 bg-white relative">

    <!-- Dekoracyjny okrąg po prawej -->
    <div class="absolute right-4 top-1/2 -translate-y-1/2 w-40 h-40 rounded-full border-[16px] border-emerald-200 pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

            <!-- Lewa: wideo -->
            <div class="relative rounded-2xl overflow-hidden aspect-video bg-slate-100 group<?php echo $play_src ? ' cursor-pointer' : ''; ?>"
                 <?php if ( $play_src ) : ?>
                 data-play-src="<?php echo esc_attr($play_src); ?>"
                 data-play-type="<?php echo esc_attr($play_type); ?>"
                 onclick="kupimyOpenVideo(this)"
                 <?php endif; ?>>

                <img src="<?php echo esc_url($thumb_url); ?>"
                     alt="<?php echo esc_attr($heading); ?>"
                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                     loading="lazy"
                     <?php if ( $thumb_url_hq ) : ?>
                     onerror="this.onerror=null;this.src='<?php echo esc_js($thumb_url_hq); ?>'"
                     <?php endif; ?>>

                <div class="absolute inset-0 flex items-center justify-center bg-slate-900/25 group-hover:bg-slate-900/20 transition-colors duration-300">
                    <div class="w-20 h-20 rounded-full bg-[#00d084] flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform duration-300<?php echo ! $play_src ? ' pointer-events-none' : ''; ?>">
                        <i data-lucide="play" fill="#fff" class="w-8 h-8 text-white ml-0.5" stroke-width="0"></i>
                    </div>
                </div>
            </div>

            <!-- Prawa: tekst -->
            <div>
                <h2 class="text-pretty text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 leading-snug mb-5">
                    <?php echo mer_esc($heading); ?>
                </h2>
                <p class="text-base sm:text-lg text-slate-500 leading-relaxed">
                    <?php echo mer_esc($desc); ?>
                </p>
            </div>

        </div>
    </div>
</section>

<!-- Modal wideo -->
<div id="kupimy-video-modal"
     class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4">
    <div class="relative w-full max-w-4xl aspect-video bg-black rounded-2xl overflow-hidden shadow-2xl">
        <button onclick="kupimyCloseVideo()"
                class="absolute top-3 right-3 z-10 w-9 h-9 rounded-full bg-black/60 hover:bg-black/80 flex items-center justify-center text-white transition-colors">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
        <div id="kupimy-video-content" class="w-full h-full"></div>
    </div>
</div>

<script>
function kupimyOpenVideo(el) {
    var src  = el.dataset.playSrc;
    var type = el.dataset.playType;
    var content = document.getElementById('kupimy-video-content');
    var modal   = document.getElementById('kupimy-video-modal');
    if (!src) return;
    content.innerHTML = type === 'file'
        ? '<video src="' + src + '" controls autoplay class="w-full h-full object-contain"></video>'
        : '<iframe src="' + src + '" frameborder="0" allow="autoplay; fullscreen" allowfullscreen class="w-full h-full"></iframe>';
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}
function kupimyCloseVideo() {
    var modal   = document.getElementById('kupimy-video-modal');
    var content = document.getElementById('kupimy-video-content');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    content.innerHTML = '';
    document.body.style.overflow = '';
}
document.getElementById('kupimy-video-modal').addEventListener('click', function(e) {
    if (e.target === this) kupimyCloseVideo();
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') kupimyCloseVideo();
});
</script>
