<?php
$btn_text     = mer_field('hk_vid_load_more', 'Wczytaj więcej');
$section_label = mer_field('hk_vid_label', 'Historie klientów');
$section_title = mer_field('hk_vid_title', 'Posłuchaj, co mówią nasi klienci');
$per_page = 6;

$cs_posts = get_posts([
    'post_type'      => 'customer-story',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
]);

$videos = [];
foreach ($cs_posts as $post) {
    $video_url  = get_field('cs_video_url',  $post->ID) ?: '';
    $video_file = get_field('cs_video_file', $post->ID);
    $thumbnail  = get_field('cs_thumbnail',  $post->ID);
    $logo        = get_field('cs_logo',        $post->ID);
    $logo_size   = get_field('cs_logo_size',  $post->ID) ?: 'h-14';
    $cover_image = get_field('cs_cover_image', $post->ID);
    $tags_raw   = get_field('cs_tags',       $post->ID) ?: '';
    $quote      = get_field('cs_video_desc', $post->ID) ?: '';
    $is_general = get_field('cs_is_general', $post->ID);

    // Resolve play source
    $play_src  = '';
    $play_type = '';
    $yt_id     = '';
    if (is_array($video_file) && !empty($video_file['url'])) {
        $play_src  = esc_url($video_file['url']);
        $play_type = 'file';
    } elseif ($video_url) {
        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/', $video_url, $m)) {
            $yt_id    = $m[1];
            $play_src = esc_attr('https://www.youtube.com/embed/' . $yt_id . '?autoplay=1&rel=0');
        } elseif (preg_match('/vimeo\.com\/(\d+)/', $video_url, $m)) {
            $play_src = esc_attr('https://player.vimeo.com/video/' . $m[1] . '?autoplay=1');
        } else {
            $play_src = esc_attr($video_url);
        }
        $play_type = 'embed';
    }

    // Thumbnail: YouTube → z YouTube, inne wideo → cs_thumbnail, brak wideo → cs_cover_image
    if ($yt_id) {
        $thumb_url = 'https://img.youtube.com/vi/' . $yt_id . '/hqdefault.jpg';
    } elseif (is_array($thumbnail) && !empty($thumbnail['url'])) {
        $thumb_url = esc_url($thumbnail['url']);
    } elseif (is_array($cover_image) && !empty($cover_image['url'])) {
        $thumb_url = esc_url($cover_image['url']);
    } else {
        $thumb_url = '';
    }

    $tags = array_values(array_filter(array_map('trim', explode("\n", $tags_raw))));

    $videos[] = [
        'thumb_url'   => $thumb_url,
        'logo'        => $logo,
        'logo_size'   => $logo_size,
        'tags'        => $tags,
        'title'       => get_the_title($post),
        'desc'        => $quote,
        'play_src'    => $play_src,
        'play_type'   => $play_type,
        'story_url'   => get_permalink($post),
        'is_general'  => $is_general,
        'yt_id'       => $yt_id,
        'upload_date' => get_the_date('c', $post),
        'file_url'    => ($play_type === 'file') ? ($play_src ?? '') : '',
    ];
}

$total = count($videos);
if ($total === 0) return;
?>

<section class="py-16 md:py-24 bg-white" id="hk-video-section">
    <div class="max-w-7xl mx-auto px-6">

        <div class="mb-10">
            <span class="text-[#48c279] uppercase tracking-widest text-base font-bold mb-4 block">
                <?php echo mer_esc($section_label); ?>
            </span>
            <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900">
                <?php echo mer_esc($section_title); ?>
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" id="hk-vid-grid">
            <?php foreach ($videos as $idx => $vid) : ?>
            <div class="hk-vid-card flex flex-col h-full<?php echo $idx >= $per_page ? ' hidden' : ''; ?>">

                <!-- Miniatura / wideo -->
                <div class="relative rounded-2xl overflow-hidden aspect-video mb-4 group <?php echo $vid['play_src'] ? 'cursor-pointer hk-vid-thumb' : ''; ?>"
                     <?php if ($vid['play_src']) : ?>
                     data-src="<?php echo $vid['play_src']; ?>"
                     data-type="<?php echo esc_attr($vid['play_type']); ?>"
                     <?php endif; ?>>
                    <?php if ($vid['thumb_url']) : ?>
                        <img src="<?php echo $vid['thumb_url']; ?>" alt="<?php echo esc_attr($vid['title']); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-slate-900/30 group-hover:bg-slate-900/20 transition-colors duration-300"></div>
                    <?php else : ?>
                        <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                            <i data-lucide="play-circle" class="w-12 h-12 text-slate-300"></i>
                        </div>
                    <?php endif; ?>
                    <?php if ($vid['play_src']) : ?>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-14 h-14 rounded-full bg-[#48c279] flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform duration-300">
                            <i data-lucide="play" fill="#fff" class="w-5 h-5 text-white ml-0.5" stroke-width="0"></i>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Tytuł historii -->
                <h3 class="text-base font-bold text-slate-900 mb-3">
                    <?php echo esc_html($vid['title']); ?>
                </h3>

                <!-- Tagi -->
                <?php if ($vid['tags']) : ?>
                <div class="flex flex-wrap gap-1.5 mb-3">
                    <?php foreach ($vid['tags'] as $tag) : ?>
                    <span class="text-xs text-slate-500 border border-slate-200 rounded-full px-2.5 py-0.5"><?php echo mer_esc($tag); ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Lead -->
                <?php if ($vid['desc']) : ?>
                <p class="text-base text-slate-500 leading-relaxed mb-4 line-clamp-3"><?php echo mer_esc($vid['desc']); ?></p>
                <?php endif; ?>

                <a href="<?php echo esc_url($vid['story_url']); ?>"
                   class="mt-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-full bg-[#48c279] hover:bg-[#3ea868] text-white text-sm font-semibold transition-colors duration-200 group/link">
                    Czytaj historię
                    <i data-lucide="arrow-right" class="w-4 h-4 transition-transform duration-200 group-hover/link:translate-x-1"></i>
                </a>

            </div>
            <?php endforeach; ?>
        </div>

        <?php if ($total > $per_page) : ?>
        <div class="flex justify-center mt-14" id="hk-vid-loadmore-wrap">
            <button id="hk-vid-loadmore"
                class="px-8 py-3.5 rounded-full border border-emerald-500 text-[#48c279] text-sm font-medium hover:bg-[#48c279] hover:text-white transition-colors duration-200">
                <?php echo mer_esc($btn_text); ?>
            </button>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php
foreach ($videos as $vid) {
    if (!$vid['thumb_url'] || !$vid['desc']) continue;
    $embed = $vid['yt_id']
        ? 'https://www.youtube.com/embed/' . $vid['yt_id']
        : '';
    $dur = $vid['yt_id'] ? mer_youtube_duration($vid['yt_id']) : '';
    mer_output_video_object([
        'name'          => $vid['title'],
        'description'   => $vid['desc'],
        'thumbnail_url' => $vid['thumb_url'],
        'upload_date'   => $vid['upload_date'],
        'embed_url'     => $embed,
        'content_url'   => $vid['file_url'],
        'duration'      => $dur,
    ]);
}
?>

<!-- Modal wideo -->
<div id="hk-vid-modal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 md:p-10">
    <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm" id="hk-vid-backdrop"></div>
    <div class="relative w-full max-w-4xl z-10">
        <button id="hk-vid-close" class="absolute -top-10 right-0 text-white/80 hover:text-white transition-colors flex items-center gap-1.5 text-sm">
            <i data-lucide="x" class="w-5 h-5"></i> Zamknij
        </button>
        <div id="hk-vid-embed-wrap" class="relative w-full hidden" style="padding-bottom:56.25%">
            <iframe id="hk-vid-iframe" class="absolute inset-0 w-full h-full rounded-2xl" src="" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
        </div>
        <div id="hk-vid-file-wrap" class="hidden">
            <video id="hk-vid-file" controls autoplay playsinline class="w-full rounded-2xl bg-black max-h-[80vh]" src=""></video>
        </div>
    </div>
</div>

<script>
(function () {
    var perPage  = <?php echo $per_page; ?>;
    var shown    = perPage;
    var cards    = document.querySelectorAll('.hk-vid-card');
    var loadBtn  = document.getElementById('hk-vid-loadmore');
    var loadWrap = document.getElementById('hk-vid-loadmore-wrap');

    if (loadBtn) {
        loadBtn.addEventListener('click', function () {
            var count = 0;
            cards.forEach(function (card) {
                if (card.classList.contains('hidden') && count < perPage) {
                    card.classList.remove('hidden');
                    if (window.lucide) lucide.createIcons({ nodes: [card] });
                    count++;
                    shown++;
                }
            });
            if (shown >= cards.length) loadWrap.classList.add('hidden');
        });
    }

    var modal     = document.getElementById('hk-vid-modal');
    var backdrop  = document.getElementById('hk-vid-backdrop');
    var closeBtn  = document.getElementById('hk-vid-close');
    var embedWrap = document.getElementById('hk-vid-embed-wrap');
    var fileWrap  = document.getElementById('hk-vid-file-wrap');
    var iframe    = document.getElementById('hk-vid-iframe');
    var videoEl   = document.getElementById('hk-vid-file');

    function openModal(src, type) {
        if (!src) return;
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

    document.querySelectorAll('.hk-vid-thumb').forEach(function (el) {
        el.addEventListener('click', function () {
            openModal(el.dataset.src, el.dataset.type);
        });
    });
    if (backdrop) backdrop.addEventListener('click', closeModal);
    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModal(); });
})();
</script>
