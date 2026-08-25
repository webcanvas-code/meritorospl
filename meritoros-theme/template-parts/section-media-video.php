<?php
if (!function_exists('_mvid_resolve')) :
function _mvid_resolve($url_raw, $file_acf) {
    $play_src = ''; $play_type = ''; $yt_id = '';
    if (is_array($file_acf) && !empty($file_acf['url'])) {
        $play_src = esc_url($file_acf['url']); $play_type = 'file';
    } elseif ($url_raw) {
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url_raw, $m)) {
            $yt_id     = $m[1];
            $play_src  = esc_attr('https://www.youtube.com/embed/' . $m[1] . '?autoplay=1&rel=0');
            $play_type = 'embed';
        } elseif (preg_match('/vimeo\.com\/(\d+)/', $url_raw, $m)) {
            $play_src  = esc_attr('https://player.vimeo.com/video/' . $m[1] . '?autoplay=1');
            $play_type = 'embed';
        } else {
            $play_src = esc_attr($url_raw); $play_type = 'embed';
        }
    }
    return [$play_src, $play_type, $yt_id];
}
endif;

// ── Video 1 — legacy individual fields ──────────────────────────────────────
$v1_url_raw = mer_field('media_vid_url', '');
$v1_file    = get_field('media_vid_file');
$v1_thumb   = get_field('media_vid_thumbnail');
[$v1_play, $v1_type, $v1_yt] = _mvid_resolve($v1_url_raw, $v1_file);
$v1_thumb_url = (is_array($v1_thumb) && !empty($v1_thumb['url']))
    ? esc_url($v1_thumb['url'])
    : ($v1_yt ? 'https://img.youtube.com/vi/' . $v1_yt . '/maxresdefault.jpg' : '');

$videos = [[
    'title'     => mer_field('media_vid_title',    'Jak z MINIMALNYM ryzykiem zacząć własny biznes? Sebastian Rafalik wspomina Meritoros.'),
    'text'      => mer_field('media_vid_text',     'Sebastian Rafalik (POL–FRA) w wywiadzie dla „Zaprojektuj Swoje Życie" mówi o tym, jak uporządkowanie księgowości i kadr z Meritoros pomogło mu odblokować skalowanie biznesu i zdjąć z siebie „wąskie gardło".'),
    'btn_text'  => mer_field('media_vid_btn_text', 'Posłuchaj wywiadu'),
    'btn_url'   => mer_field('media_vid_btn_url',  '#'),
    'thumb_url' => $v1_thumb_url,
    'play_src'  => $v1_play,
    'play_type' => $v1_type,
    'yt_id'     => $v1_yt,
]];

// ── Videos 2–5 — group fields ────────────────────────────────────────────────
for ($i = 2; $i <= 5; $i++) {
    $g = get_field("media_vid_{$i}");
    if (!is_array($g)) continue;
    $g_url  = !empty($g['vid_url'])   ? $g['vid_url']   : '';
    $g_thumb_acf = !empty($g['thumbnail']) ? $g['thumbnail'] : null;
    [$g_play, $g_type, $g_yt] = _mvid_resolve($g_url, null);
    $g_thumb_url = (is_array($g_thumb_acf) && !empty($g_thumb_acf['url']))
        ? esc_url($g_thumb_acf['url'])
        : ($g_yt ? 'https://img.youtube.com/vi/' . $g_yt . '/maxresdefault.jpg' : '');
    if (!$g_thumb_url && !$g_play && empty($g['title'])) continue;
    $videos[] = [
        'title'     => !empty($g['title'])    ? $g['title']    : '',
        'text'      => !empty($g['text'])     ? $g['text']     : '',
        'btn_text'  => !empty($g['btn_text']) ? $g['btn_text'] : 'Obejrzyj materiał',
        'btn_url'   => '#',
        'thumb_url' => $g_thumb_url,
        'play_src'  => $g_play,
        'play_type' => $g_type,
        'yt_id'     => $g_yt,
    ];
}

$count     = count($videos);
$has_multi = $count > 1;
?>

<section class="py-16 md:py-24 bg-white relative overflow-hidden">
    <div class="absolute -left-16 top-1/2 -translate-y-1/2 w-[260px] h-[260px] rounded-full border-[32px] border-emerald-300/30 pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-6">

        <?php if ($has_multi) : ?>
        <div class="flex items-center justify-end gap-2 mb-8">
            <button id="mvid-prev" class="w-12 h-12 rounded-full bg-white border border-slate-200 flex items-center justify-center hover:bg-slate-50 transition-colors">
                <i data-lucide="chevron-left" class="w-5 h-5 text-slate-700"></i>
            </button>
            <button id="mvid-next" class="w-12 h-12 rounded-full bg-[#48c279] flex items-center justify-center hover:bg-[#3aad68] transition-colors">
                <i data-lucide="chevron-right" class="w-5 h-5 text-white"></i>
            </button>
        </div>
        <?php endif; ?>

        <!-- Slider track -->
        <div id="mvid-slider" class="flex overflow-x-auto scroll-smooth snap-x snap-mandatory">
            <?php foreach ($videos as $vid) : ?>
            <div class="min-w-full snap-start flex flex-col lg:flex-row items-center gap-10 lg:gap-16">

                <!-- Content -->
                <div class="flex-1 max-w-lg">
                    <h2 class="text-pretty text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-slate-900 leading-snug mb-5">
                        <?php echo mer_esc($vid['title']); ?>
                    </h2>
                    <p class="text-base sm:text-lg text-slate-500 leading-relaxed mb-8">
                        <?php echo mer_esc($vid['text']); ?>
                    </p>
                    <?php if ($vid['play_src']) : ?>
                        <button class="mer-btn mer-btn--primary mvid-open inline-flex items-center gap-2 px-8 py-4 rounded-full bg-[#00d084] text-white text-base font-medium hover:bg-[#00b872] transition-colors"
                                data-src="<?php echo $vid['play_src']; ?>"
                                data-type="<?php echo esc_attr($vid['play_type']); ?>">
                            <?php echo mer_esc($vid['btn_text']); ?>
                        </button>
                    <?php elseif (!empty($vid['btn_url']) && $vid['btn_url'] !== '#') : ?>
                        <a href="<?php echo esc_url($vid['btn_url']); ?>"
                           class="mer-btn mer-btn--primary inline-flex items-center gap-2 px-8 py-4 rounded-full bg-[#00d084] text-white text-base font-medium hover:bg-[#00b872] transition-colors">
                            <?php echo mer_esc($vid['btn_text']); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Video thumbnail -->
                <div class="w-full lg:w-[520px] xl:w-[580px] flex-shrink-0">
                    <?php if ($vid['thumb_url']) : ?>
                        <div class="relative rounded-3xl overflow-hidden aspect-video group <?php echo $vid['play_src'] ? 'cursor-pointer mvid-open' : ''; ?>"
                             <?php if ($vid['play_src']) : ?>data-src="<?php echo $vid['play_src']; ?>" data-type="<?php echo esc_attr($vid['play_type']); ?>"<?php endif; ?>>
                            <img src="<?php echo $vid['thumb_url']; ?>"
                                 alt="<?php echo esc_attr($vid['title']); ?>"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-slate-900/30 group-hover:bg-slate-900/20 transition-colors duration-300"></div>
                            <?php if ($vid['play_src']) : ?>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="w-20 h-20 rounded-full bg-[#00d084] flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform duration-300">
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
            <?php endforeach; ?>
        </div>

        <!-- Dots -->
        <?php if ($has_multi) : ?>
        <div id="mvid-dots" class="flex justify-center gap-2 mt-8">
            <?php foreach ($videos as $idx => $vid) : ?>
            <button class="w-2.5 h-2.5 rounded-full transition-colors <?php echo $idx === 0 ? 'bg-[#00d084]' : 'bg-slate-200'; ?>"></button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Divider -->
        <div class="mt-16 border-t border-slate-200"></div>
    </div>
</section>

<?php
// Structured data for video 1
$v1 = $videos[0];
if ($v1['thumb_url'] && $v1['text']) {
    $embed_url = $v1['yt_id'] ? 'https://www.youtube.com/embed/' . $v1['yt_id'] : '';
    $file_url  = ($v1['play_type'] === 'file') ? esc_url_raw($v1['play_src']) : '';
    $dur       = $v1['yt_id'] ? mer_youtube_duration($v1['yt_id']) : '';
    mer_output_video_object([
        'name'          => $v1['title'],
        'description'   => $v1['text'],
        'thumbnail_url' => $v1['thumb_url'],
        'upload_date'   => get_the_date('c'),
        'embed_url'     => $embed_url,
        'content_url'   => $file_url,
        'duration'      => $dur,
    ]);
}
?>

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
    // ── Modal ────────────────────────────────────────────────────
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
        el.addEventListener('click', function () { openModal(el.dataset.src, el.dataset.type); });
    });
    backdrop.addEventListener('click', closeModal);
    closeBtn.addEventListener('click', closeModal);
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModal(); });

    // ── Slider ───────────────────────────────────────────────────
    var slider  = document.getElementById('mvid-slider');
    var prev    = document.getElementById('mvid-prev');
    var next    = document.getElementById('mvid-next');
    var dots    = document.querySelectorAll('#mvid-dots button');
    var count   = <?php echo (int) $count; ?>;
    var current = 0;

    if (!slider || count < 2) return;

    function goTo(idx) {
        current = Math.max(0, Math.min(count - 1, idx));
        slider.scrollTo({ left: current * slider.offsetWidth, behavior: 'smooth' });
        dots.forEach(function (d, i) {
            d.classList.toggle('bg-[#00d084]', i === current);
            d.classList.toggle('bg-slate-200',  i !== current);
        });
    }

    if (prev) prev.addEventListener('click', function () { goTo(current - 1); });
    if (next) next.addEventListener('click', function () { goTo(current + 1); });
    dots.forEach(function (d, i) { d.addEventListener('click', function () { goTo(i); }); });

    slider.addEventListener('scroll', function () {
        var idx = Math.round(slider.scrollLeft / slider.offsetWidth);
        if (idx !== current) {
            current = idx;
            dots.forEach(function (d, i) {
                d.classList.toggle('bg-[#00d084]', i === current);
                d.classList.toggle('bg-slate-200',  i !== current);
            });
        }
    }, { passive: true });
})();
</script>
