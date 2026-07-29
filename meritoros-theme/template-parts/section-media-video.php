<?php
$title      = mer_field('media_vid_title',    'Jak z MINIMALNYM ryzykiem zacząć własny biznes? Sebastian Rafalik wspomina Meritoros.');
$text       = mer_field('media_vid_text',     'Sebastian Rafalik (POL–FRA) w wywiadzie dla „Zaprojektuj Swoje Życie" mówi o tym, jak uporządkowanie księgowości i kadr z Meritoros pomogło mu odblokować skalowanie biznesu i zdjąć z siebie „wąskie gardło".');
$btn_text   = mer_field('media_vid_btn_text', 'Posłuchaj wywiadu');
$btn_url    = mer_field('media_vid_btn_url',  '#');
$video_url  = mer_field('media_vid_url',      '');
$video_file = get_field('media_vid_file');
$thumbnail  = get_field('media_vid_thumbnail');

// Resolve thumbnail URL
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

// Resolve play source
$play_src  = '';
$play_type = '';
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
}
?>

<section class="py-16 md:py-24 bg-white relative overflow-hidden">

    <!-- Decorative circle -->
    <div class="absolute -left-16 top-1/2 -translate-y-1/2 w-[260px] h-[260px] rounded-full border-[32px] border-emerald-300/30 pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col lg:flex-row items-center gap-10 lg:gap-16">

            <!-- Content -->
            <div class="flex-1 max-w-lg">
                <h2 class="text-pretty text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-slate-900 leading-snug mb-5">
                    <?php echo mer_esc($title); ?>
                </h2>
                <p class="text-base sm:text-lg text-slate-500 leading-relaxed mb-8">
                    <?php echo mer_esc($text); ?>
                </p>
                <?php if ($play_src) : ?>
                    <button class="mvid-open inline-flex items-center gap-2 px-8 py-4 rounded-full bg-[#2d8650] text-white text-base font-medium hover:bg-[#246e41] transition-colors"
                            data-src="<?php echo $play_src; ?>"
                            data-type="<?php echo esc_attr($play_type); ?>">
                        <?php echo mer_esc($btn_text); ?>
                    </button>
                <?php else : ?>
                    <a href="<?php echo esc_url($btn_url); ?>"
                       class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-[#2d8650] text-white text-base font-medium hover:bg-[#246e41] transition-colors">
                        <?php echo mer_esc($btn_text); ?>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Video thumbnail -->
            <div class="w-full lg:w-[520px] xl:w-[580px] flex-shrink-0">
                <?php if ($thumb_url) : ?>
                    <div class="relative rounded-3xl overflow-hidden aspect-video group <?php echo $play_src ? 'cursor-pointer mvid-open' : ''; ?>"
                         <?php if ($play_src) : ?>data-src="<?php echo $play_src; ?>" data-type="<?php echo esc_attr($play_type); ?>"<?php endif; ?>>
                        <img src="<?php echo $thumb_url; ?>"
                             alt="<?php echo esc_attr($title); ?>"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-slate-900/30 group-hover:bg-slate-900/20 transition-colors duration-300"></div>
                        <?php if ($play_src) : ?>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-20 h-20 rounded-full bg-[#2d8650] flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform duration-300">
                                    <i data-lucide="play" fill="#fff" class="w-8 h-8 text-white ml-1" stroke-width="0"></i>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else : ?>
                    <div class="w-full aspect-video rounded-3xl bg-emerald-50 border-2 border-emerald-100 flex items-center justify-center">
                        <div class="w-20 h-20 rounded-full bg-emerald-100 flex items-center justify-center">
                            <i data-lucide="play" class="w-8 h-8 text-emerald-300 ml-1"></i>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        </div>

        <!-- Divider -->
        <div class="mt-16 border-t border-slate-200"></div>
    </div>
</section>

<?php
if ($thumb_url && $text) {
    $embed_url  = $yt_id ? 'https://www.youtube.com/embed/' . $yt_id : '';
    $file_url   = ($play_type === 'file') ? esc_url_raw($play_src) : '';
    $dur        = $yt_id ? mer_youtube_duration($yt_id) : '';
    mer_output_video_object([
        'name'          => $title,
        'description'   => $text,
        'thumbnail_url' => $thumb_url,
        'upload_date'   => get_the_date('c'),
        'embed_url'     => $embed_url,
        'content_url'   => $file_url,
        'duration'      => $dur,
    ]);
}
?>

<?php if ($play_src) : ?>
<!-- Modal wideo -->
<div id="mvid-modal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 md:p-10">
    <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm" id="mvid-backdrop"></div>
    <div class="relative w-full max-w-4xl z-10">
        <button id="mvid-close" class="absolute -top-10 right-0 text-white/80 hover:text-white transition-colors flex items-center gap-1.5 text-sm">
            <i data-lucide="x" class="w-5 h-5"></i> Zamknij
        </button>
        <div id="mvid-embed-wrap" class="relative w-full hidden" style="padding-bottom:56.25%">
            <iframe id="mvid-iframe" class="absolute inset-0 w-full h-full rounded-2xl" src="" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
        </div>
        <div id="mvid-file-wrap" class="hidden">
            <video id="mvid-file" controls autoplay playsinline class="w-full rounded-2xl bg-black max-h-[80vh]" src=""></video>
        </div>
    </div>
</div>

<script>
(function () {
    var modal     = document.getElementById('mvid-modal');
    var backdrop  = document.getElementById('mvid-backdrop');
    var closeBtn  = document.getElementById('mvid-close');
    var embedWrap = document.getElementById('mvid-embed-wrap');
    var fileWrap  = document.getElementById('mvid-file-wrap');
    var iframe    = document.getElementById('mvid-iframe');
    var videoEl   = document.getElementById('mvid-file');

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

    document.querySelectorAll('.mvid-open').forEach(function (el) {
        el.addEventListener('click', function () {
            openModal(el.dataset.src, el.dataset.type);
        });
    });
    backdrop.addEventListener('click', closeModal);
    closeBtn.addEventListener('click', closeModal);
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModal(); });
})();
</script>
<?php endif; ?>
