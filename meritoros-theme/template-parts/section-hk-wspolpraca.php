<?php
$title_pre   = mer_field('hk_wsp_title_pre',   'Współpraca, która');
$title_green = mer_field('hk_wsp_title_green',  'daje spokój operacyjny');
$text        = mer_field('hk_wsp_text',         'W Meritoros pracujemy tak, aby odciążyć zespół klienta i zapewnić ciągłość obsługi. Działamy elastycznie, dopasowując model współpracy do realiów organizacji, ale trzymamy stały standard jakości, terminowości i bezpieczeństwa danych.');
$bold_text   = mer_field('hk_wsp_bold_text',    'Dzięki temu klienci mogą skupić się na biznesie, a nie na „gaszeniu tematów" w księgowości czy kadrach');

$video_file  = get_field('hk_wsp_video_file');
$video_url   = mer_field('hk_wsp_video_url',    '');
$thumbnail   = get_field('hk_wsp_thumbnail');

// Wyodrębnij YouTube ID raz, użyj w miniaturze i play src
$yt_id = '';
if ($video_url && preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $video_url, $m)) {
    $yt_id = $m[1];
}

// Miniatura: przy YouTube zawsze z YouTube, dla innych z pola ACF
$thumb_url = '';
$thumb_alt = '';
if ($yt_id) {
    $thumb_url = 'https://img.youtube.com/vi/' . $yt_id . '/maxresdefault.jpg';
    $thumb_alt = esc_attr(mer_field('hk_wsp_title_pre', 'Historia klienta Meritoros') . ' ' . mer_field('hk_wsp_title_green', '') . ' — wideo');
} elseif (is_array($thumbnail) && !empty($thumbnail['url'])) {
    $thumb_url = esc_url($thumbnail['url']);
    $thumb_alt = esc_attr($thumbnail['alt'] ?: mer_field('hk_wsp_title_pre', 'Historia klienta Meritoros') . ' ' . mer_field('hk_wsp_title_green', ''));
} else {
    $thumb_url = 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=900&q=80';
    $thumb_alt = esc_attr('Historia klienta Meritoros — wideo');
}

if (is_array($video_file) && !empty($video_file['url'])) {
    $play_src  = esc_url($video_file['url']);
    $play_type = 'file';
} elseif ($yt_id) {
    $play_src  = esc_attr('https://www.youtube.com/embed/' . $yt_id . '?autoplay=1&rel=0');
    $play_type = 'embed';
} elseif ($video_url) {
    if (preg_match('/vimeo\.com\/(\d+)/', $video_url, $m)) {
        $play_src = esc_attr('https://player.vimeo.com/video/' . $m[1] . '?autoplay=1');
    } else {
        $play_src = esc_attr($video_url);
    }
    $play_type = 'embed';
} else {
    $play_src  = '';
    $play_type = '';
}
?>

<section class="py-16 md:py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            <!-- Lewa kolumna: tekst -->
            <div>
                <h2 class="text-pretty text-3xl sm:text-4xl md:text-5xl font-bold tracking-tight leading-tight text-slate-900 mb-8">
                    <?php echo mer_esc($title_pre); ?><br>
                    <span class="text-[#00d084]"><?php echo mer_esc($title_green); ?></span>
                </h2>
                <p class="text-base sm:text-lg text-slate-500 leading-relaxed mb-6">
                    <?php echo mer_esc($text); ?>
                </p>
                <p class="text-base font-semibold text-slate-900 leading-relaxed">
                    <?php echo mer_esc($bold_text); ?>
                </p>
            </div>

            <!-- Prawa kolumna: wideo -->
            <div class="relative rounded-2xl overflow-hidden aspect-video cursor-pointer group" id="hk-wsp-container">
                <img src="<?php echo $thumb_url; ?>" alt="<?php echo $thumb_alt; ?>" class="w-full h-full object-cover" loading="lazy">
                <div class="absolute inset-0 bg-slate-900/30 group-hover:bg-slate-900/20 transition-colors duration-300"></div>
                <?php if ($play_src) : ?>
                <button id="hk-wsp-play-btn"
                    class="absolute inset-0 flex items-center justify-center"
                    data-src="<?php echo $play_src; ?>"
                    data-type="<?php echo esc_attr($play_type); ?>"
                    aria-label="Odtwórz film">
                <?php else : ?>
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                <?php endif; ?>
                    <div class="w-16 h-16 rounded-full bg-[#00d084] flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="play" fill="#fff" class="w-6 h-6 text-white ml-1"></i>
                    </div>
                <?php if ($play_src) : ?>
                </button>
                <?php else : ?>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>

<?php if ($play_src) : ?>
<div id="hk-wsp-modal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 md:p-10">
    <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm" id="hk-wsp-backdrop"></div>
    <div class="relative w-full max-w-4xl z-10">
        <button id="hk-wsp-close" class="absolute -top-10 right-0 text-white/80 hover:text-white transition-colors flex items-center gap-1.5 text-sm">
            <i data-lucide="x" class="w-5 h-5"></i> Zamknij
        </button>
        <div id="hk-wsp-embed-wrap" class="relative w-full hidden" style="padding-bottom:56.25%">
            <iframe id="hk-wsp-iframe" class="absolute inset-0 w-full h-full rounded-2xl" src="" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
        </div>
        <div id="hk-wsp-file-wrap" class="hidden">
            <video id="hk-wsp-video" controls autoplay playsinline class="w-full rounded-2xl bg-black max-h-[80vh]" src=""></video>
        </div>
    </div>
</div>

<script>
(function () {
    var playBtn   = document.getElementById('hk-wsp-play-btn');
    var modal     = document.getElementById('hk-wsp-modal');
    var backdrop  = document.getElementById('hk-wsp-backdrop');
    var closeBtn  = document.getElementById('hk-wsp-close');
    var embedWrap = document.getElementById('hk-wsp-embed-wrap');
    var fileWrap  = document.getElementById('hk-wsp-file-wrap');
    var iframe    = document.getElementById('hk-wsp-iframe');
    var videoEl   = document.getElementById('hk-wsp-video');
    if (!playBtn) return;

    function openModal(src, type) {
        modal.classList.remove('hidden'); modal.classList.add('flex');
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
        modal.classList.add('hidden'); modal.classList.remove('flex');
        document.body.style.overflow = '';
        iframe.src = ''; videoEl.pause(); videoEl.src = '';
    }

    playBtn.addEventListener('click', function () { openModal(playBtn.dataset.src, playBtn.dataset.type); });
    backdrop.addEventListener('click', closeModal);
    closeBtn.addEventListener('click', closeModal);
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModal(); });
})();
</script>
<?php endif; ?>
