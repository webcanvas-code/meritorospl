<?php
$title      = mer_field('kar_vid_title', __('Sprawdź jak się u nas pracuje', 'meritoros'));
$video_file = get_field('kar_vid_file');
$video_url  = mer_field('kar_vid_url',  '');
$thumbnail  = get_field('kar_vid_thumbnail');

$thumb_url = '';
$yt_id     = '';
if (is_array($thumbnail) && !empty($thumbnail['url'])) {
    $thumb_url = esc_url($thumbnail['url']);
}
if ($video_url && preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $video_url, $m)) {
    $yt_id = $m[1];
    if (!$thumb_url) {
        $thumb_url = 'https://img.youtube.com/vi/' . $yt_id . '/maxresdefault.jpg';
    }
}
if (!$thumb_url) {
    $thumb_url = 'https://images.unsplash.com/photo-1515187029135-18ee286d815b?w=1400&h=700&fit=crop';
}

if (is_array($video_file) && !empty($video_file['url'])) {
    $play_src  = esc_url($video_file['url']);
    $play_type = 'file';
} elseif ($video_url) {
    if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $video_url, $m)) {
        $play_src = esc_attr('https://www.youtube.com/embed/' . $m[1] . '?autoplay=1&rel=0');
    } elseif (preg_match('/vimeo\.com\/(\d+)/', $video_url, $m)) {
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

<section class="bg-white">
    <div class="px-6 lg:px-12 pt-12 sm:pt-16 pb-4 max-w-7xl mx-auto">
        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 text-center mb-8"><?php echo mer_esc($title); ?></h2>
    </div>

    <div class="relative overflow-hidden cursor-pointer group aspect-[16/9] sm:aspect-auto sm:h-[520px]" id="kar-video-container">
        <img src="<?php echo $thumb_url; ?>" alt="<?php echo esc_attr($title); ?>" class="w-full h-full object-cover object-center">
        <div class="absolute inset-0 bg-black/45 group-hover:bg-black/35 transition-colors duration-300"></div>
        <?php if ($play_src) : ?>
        <button id="kar-play-btn"
            class="absolute inset-0 flex items-center justify-center"
            data-src="<?php echo $play_src; ?>"
            data-type="<?php echo esc_attr($play_type); ?>"
            aria-label="<?php esc_attr_e('Odtwórz wideo', 'meritoros'); ?>">
        <?php else : ?>
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
        <?php endif; ?>
            <div class="w-20 h-20 rounded-full bg-[#00d084] flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform duration-300">
                <i data-lucide="play" fill="#fff" class="w-8 h-8 text-white ml-1"></i>
            </div>
        <?php if ($play_src) : ?>
        </button>
        <?php else : ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php
// Opis wymagany przez VideoObject — pobierz z ACF lub użyj meta opisu strony
$kar_vid_desc = mer_field('kar_vid_desc', '')
    ?: mer_field('kar_hero_text', '')
    ?: get_bloginfo('description');

if ($thumb_url && $kar_vid_desc) {
    $embed_url = $yt_id ? 'https://www.youtube.com/embed/' . $yt_id : '';
    $file_url  = ($play_type === 'file') ? esc_url_raw($play_src) : '';
    $dur       = $yt_id ? mer_youtube_duration($yt_id) : '';
    mer_output_video_object([
        'name'          => $title,
        'description'   => $kar_vid_desc,
        'thumbnail_url' => $thumb_url,
        'upload_date'   => get_the_date('c'),
        'embed_url'     => $embed_url,
        'content_url'   => $file_url,
        'duration'      => $dur,
    ]);
}
?>

<?php if ($play_src) : ?>
<div id="kar-video-modal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 md:p-10">
    <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm" id="kar-modal-backdrop"></div>
    <div class="relative w-full max-w-4xl z-10">
        <button id="kar-modal-close" class="absolute -top-10 right-0 text-white/80 hover:text-white transition-colors flex items-center gap-1.5 text-sm">
            <i data-lucide="x" class="w-5 h-5"></i> <?php esc_html_e('Zamknij', 'meritoros'); ?>
        </button>
        <div id="kar-embed-wrap" class="relative w-full hidden" style="padding-bottom:56.25%">
            <iframe id="kar-video-iframe" class="absolute inset-0 w-full h-full rounded-2xl" src="" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
        </div>
        <div id="kar-file-wrap" class="hidden">
            <video id="kar-video-file" controls autoplay playsinline class="w-full rounded-2xl bg-black max-h-[80vh]" src=""></video>
        </div>
    </div>
</div>

<script>
(function () {
    var playBtn    = document.getElementById('kar-play-btn');
    var modal      = document.getElementById('kar-video-modal');
    var backdrop   = document.getElementById('kar-modal-backdrop');
    var closeBtn   = document.getElementById('kar-modal-close');
    var embedWrap  = document.getElementById('kar-embed-wrap');
    var fileWrap   = document.getElementById('kar-file-wrap');
    var iframe     = document.getElementById('kar-video-iframe');
    var videoEl    = document.getElementById('kar-video-file');
    if (!playBtn) return;

    function openModal(src, type) {
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
