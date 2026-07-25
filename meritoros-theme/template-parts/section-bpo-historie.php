<?php
$_fp_id = (int) get_option('page_on_front');
$title  = (get_field('hist_title',    $_fp_id) ?: 'Historie naszych klientów');
$btn_t  = (get_field('hist_btn_text', $_fp_id) ?: 'Poznaj więcej historii');
$btn_u  = (get_field('hist_btn_url',  $_fp_id) ?: home_url('/historie-klientow/'));

$slide_defaults = [
    [
        'logo'       => null,
        'logo_alt'   => 'HPC',
        'industries' => "Geologia inżynierska\nOchrona środowiska",
        'scope'      => 'Usługi rachunkowe, kadry i płace, wsparcie w procesie audytu',
        'text'       => 'Po kilku zmianach głównej księgowej spółka potrzebowała szybkiego uporządkowania księgowości i bezpiecznego zamknięcia roku obrotowego.',
        'image'      => null,
        'video_url'  => '',
    ],
    [
        'logo'       => null,
        'logo_alt'   => 'Printbox',
        'industries' => "E-commerce\nTechnologia",
        'scope'      => 'Pełna księgowość, raportowanie zarządcze, wsparcie podczas audytu',
        'text'       => 'Dynamicznie rosnąca spółka technologiczna potrzebowała partnera, który zapewni rzetelną sprawozdawczość i gotowość do pozyskania inwestora.',
        'image'      => null,
        'video_url'  => '',
    ],
];

/**
 * Convert a YouTube or Vimeo URL to an embeddable iframe src.
 */
function bpo_video_embed_url(string $url): string {
    if (!$url) return '';
    // YouTube watch or short URL
    if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url, $m)) {
        return 'https://www.youtube.com/embed/' . $m[1] . '?autoplay=1&rel=0';
    }
    // Vimeo
    if (preg_match('/vimeo\.com\/(\d+)/', $url, $m)) {
        return 'https://player.vimeo.com/video/' . $m[1] . '?autoplay=1';
    }
    return $url;
}

/**
 * Return a thumbnail URL from a YouTube link (auto-fetched poster).
 */
function bpo_video_thumbnail(string $url): string {
    if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url, $m)) {
        return 'https://img.youtube.com/vi/' . $m[1] . '/maxresdefault.jpg';
    }
    return '';
}

$slides = [];
for ($i = 1; $i <= 2; $i++) {
    $s = get_field("hist_{$i}", $_fp_id);
    $d = $slide_defaults[$i - 1];
    $logo_img   = is_array($s) && !empty($s['logo'])       ? $s['logo']       : $d['logo'];
    $slide_img  = is_array($s) && !empty($s['image'])      ? $s['image']      : $d['image'];
    $video_file = is_array($s) && !empty($s['video_file']) ? $s['video_file'] : null;
    $video_url  = is_array($s) && !empty($s['video_url'])  ? trim($s['video_url']) : $d['video_url'];

    // Uploaded file takes priority over external URL
    if (is_array($video_file) && !empty($video_file['url'])) {
        $play_src  = esc_url($video_file['url']);
        $play_type = 'file';
    } elseif ($video_url) {
        $play_src  = bpo_video_embed_url($video_url);
        $play_type = 'embed';
    } else {
        $play_src  = '';
        $play_type = '';
    }

    $slides[] = [
        'logo'       => $logo_img,
        'logo_alt'   => is_array($logo_img) ? esc_attr($logo_img['alt'] ?: $d['logo_alt']) : esc_attr($d['logo_alt']),
        'industries' => array_filter(array_map('trim', explode("\n", is_array($s) && !empty($s['industries']) ? $s['industries'] : $d['industries']))),
        'scope'      => is_array($s) && !empty($s['scope']) ? $s['scope'] : $d['scope'],
        'text'       => is_array($s) && !empty($s['text'])  ? $s['text']  : $d['text'],
        'image'      => $slide_img,
        'video_url'  => $video_url,
        'play_src'   => $play_src,
        'play_type'  => $play_type,
        'slide_url'  => is_array($s) && !empty($s['url'])   ? $s['url']   : '#',
        'btn_text'   => $btn_t,
    ];
}
?>

<section class="py-10 md:py-20 bg-white relative">
    <div class="max-w-7xl mx-auto px-6 mb-10 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900"><?php echo mer_esc($title); ?></h2>
        <div class="flex items-center gap-2 shrink-0">
            <button id="historie-prev" type="button" class="w-12 h-12 rounded-full bg-white border border-slate-200 flex items-center justify-center shadow-sm hover:bg-slate-50 transition-colors" style="opacity:0.35;pointer-events:none">
                <i data-lucide="chevron-left" class="w-5 h-5 text-slate-700 stroke-[2]"></i>
            </button>
            <button id="historie-next" type="button" class="w-12 h-12 rounded-full bg-[#48c279] flex items-center justify-center shadow-md hover:bg-[#3ea868] transition-colors">
                <i data-lucide="chevron-right" class="w-5 h-5 text-white stroke-[2]"></i>
            </button>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6">
        <div class="overflow-hidden">
        <div id="historie-track" class="flex gap-6 transition-transform duration-500 ease-in-out">

            <?php foreach ($slides as $slide) :
                if (is_array($slide['image'])) {
                    $thumb_url = esc_url($slide['image']['url']);
                    $thumb_alt = esc_attr($slide['image']['alt'] ?: __('Zdjęcie klienta', 'meritoros'));
                } elseif ($slide['video_url'] && $auto = bpo_video_thumbnail($slide['video_url'])) {
                    $thumb_url = esc_url($auto);
                    $thumb_alt = __('Miniatura wideo', 'meritoros');
                } else {
                    $thumb_url = 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=1200';
                    $thumb_alt = __('Zdjęcie klienta', 'meritoros');
                }
                $logo_url  = is_array($slide['logo']) ? esc_url($slide['logo']['url']) : '';
                $has_video = !empty($slide['play_src']);
            ?>
                <div class="min-w-[85%] sm:min-w-[calc(50%-12px)] lg:w-[400px] lg:min-w-[400px] rounded-2xl overflow-hidden border border-slate-200 flex flex-col">
                    <div class="relative h-[155px] shrink-0">
                        <img src="<?php echo $thumb_url; ?>" alt="<?php echo $thumb_alt; ?>" class="absolute inset-0 w-full h-full object-cover" loading="lazy">
                        <div class="absolute inset-0 bg-slate-900/20"></div>
                        <?php if ($has_video) : ?>
                        <button class="bpo-play-btn absolute inset-0 flex items-center justify-center group"
                                data-src="<?php echo esc_attr($slide['play_src']); ?>"
                                data-type="<?php echo esc_attr($slide['play_type']); ?>"
                                aria-label="<?php echo esc_attr(__('Odtwórz film', 'meritoros')); ?>">
                        <?php else : ?>
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <?php endif; ?>
                            <div class="w-12 h-12 rounded-full bg-[#48c279] flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform duration-200">
                                <i data-lucide="play" fill="#fff" class="w-4 h-4 text-white ml-0.5" stroke-width="0"></i>
                            </div>
                        <?php if ($has_video) : ?>
                        </button>
                        <?php else : ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <?php if ($logo_url) : ?>
                            <img src="<?php echo $logo_url; ?>" alt="<?php echo $slide['logo_alt']; ?>" class="h-7 w-auto object-contain object-left mb-3" loading="lazy">
                        <?php else : ?>
                            <p class="text-sm font-bold text-slate-800 mb-3"><?php echo $slide['logo_alt']; ?></p>
                        <?php endif; ?>
                        <div class="flex flex-wrap gap-1 mb-3">
                            <?php foreach ($slide['industries'] as $ind) : ?>
                                <span class="px-2 py-0.5 rounded-full border border-slate-300 text-[10px] text-slate-600"><?php echo mer_esc($ind); ?></span>
                            <?php endforeach; ?>
                        </div>
                        <p class="text-xs text-slate-500 leading-relaxed line-clamp-3 mb-3"><?php echo mer_esc($slide['text']); ?></p>
                        <a href="<?php echo esc_url($slide['slide_url']); ?>" class="mt-auto inline-flex px-5 py-2.5 rounded-full bg-[#48c279] text-white text-xs font-semibold hover:bg-[#3ea868] transition-colors self-start">
                            <?php echo mer_esc($slide['btn_text']); ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 mt-6 flex items-center justify-center gap-2" id="historie-dots">
        <?php foreach ($slides as $idx => $slide) : ?>
        <button class="rounded-full transition-all duration-300 <?php echo $idx === 0 ? 'w-6 h-2 bg-[#48c279]' : 'w-2 h-2 bg-slate-300'; ?>" data-i="<?php echo $idx; ?>"></button>
        <?php endforeach; ?>
    </div>
</section>

<!-- Video modal -->
<div id="bpo-video-modal" class="fixed inset-0 z-[200] flex items-center justify-center p-4" style="display:none!important" aria-modal="true" role="dialog">
    <div id="bpo-modal-backdrop" class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm"></div>
    <div class="relative z-10 w-full max-w-4xl">
        <!-- iframe for YouTube / Vimeo -->
        <div id="bpo-embed-wrap" class="relative w-full hidden" style="padding-bottom:56.25%">
            <iframe id="bpo-video-iframe" src="" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; fullscreen"
                allowfullscreen
                class="absolute inset-0 w-full h-full rounded-2xl bg-black"></iframe>
        </div>
        <!-- <video> for uploaded files -->
        <div id="bpo-file-wrap" class="hidden">
            <video id="bpo-video-file" controls autoplay playsinline
                class="w-full rounded-2xl bg-black max-h-[80vh]" src=""></video>
        </div>
        <button id="bpo-modal-close"
            class="absolute -top-12 right-0 w-10 h-10 rounded-full bg-white/20 hover:bg-white/40 text-white flex items-center justify-center transition-colors"
            aria-label="<?php echo esc_attr(__('Zamknij', 'meritoros')); ?>">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>
    </div>
</div>

<script>
(function () {
    // ── Slider ────────────────────────────────────────────────────
    var track   = document.getElementById('historie-track');
    var nextBtn = document.getElementById('historie-next');
    var prevBtn = document.getElementById('historie-prev');
    var dots    = document.querySelectorAll('#historie-dots button');
    if (!track) return;
    var cards   = track.querySelectorAll(':scope > div');
    var total   = cards.length;
    var current = 0;

    function updateDots() {
        dots.forEach(function (d, i) {
            d.className = 'rounded-full transition-all duration-300 ' + (i === current ? 'w-6 h-2 bg-[#48c279]' : 'w-2 h-2 bg-slate-300');
        });
    }

    function getMax() {
        var cardWidth = cards[0].offsetWidth + 24;
        var visible   = Math.max(1, Math.round(track.parentElement.offsetWidth / cardWidth));
        return Math.max(0, total - visible);
    }

    function update() {
        var max = getMax();
        if (current > max) current = max;
        var cardWidth = cards[0].offsetWidth + 24;
        track.style.transform = 'translateX(-' + (current * cardWidth) + 'px)';
        prevBtn.style.opacity = current === 0 ? '0.35' : '1';
        prevBtn.style.pointerEvents = current === 0 ? 'none' : '';
        nextBtn.style.opacity = current >= max ? '0.35' : '1';
        nextBtn.style.pointerEvents = current >= max ? 'none' : '';
        updateDots();
    }

    nextBtn.addEventListener('click', function () { if (current < getMax()) { current++; update(); } });
    prevBtn.addEventListener('click', function () { if (current > 0) { current--; update(); } });
    dots.forEach(function (d) {
        d.addEventListener('click', function () { current = parseInt(d.dataset.i); update(); });
    });
    window.addEventListener('resize', update);
    (function tryInit() { if (cards[0] && cards[0].offsetWidth > 0) { update(); } else { requestAnimationFrame(tryInit); } })();

    // ── Video modal ───────────────────────────────────────────────
    var modal      = document.getElementById('bpo-video-modal');
    var embedWrap  = document.getElementById('bpo-embed-wrap');
    var fileWrap   = document.getElementById('bpo-file-wrap');
    var iframe     = document.getElementById('bpo-video-iframe');
    var videoEl    = document.getElementById('bpo-video-file');
    var closeBtn   = document.getElementById('bpo-modal-close');
    var backdrop   = document.getElementById('bpo-modal-backdrop');

    function openModal(src, type) {
        if (type === 'file') {
            embedWrap.classList.add('hidden');
            fileWrap.classList.remove('hidden');
            videoEl.src = src;
            videoEl.play();
        } else {
            fileWrap.classList.add('hidden');
            embedWrap.classList.remove('hidden');
            iframe.src = src;
        }
        modal.style.cssText = '';
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.style.display = 'none';
        iframe.src = '';
        videoEl.pause();
        videoEl.src = '';
        document.body.style.overflow = '';
    }

    document.querySelectorAll('.bpo-play-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            openModal(this.dataset.src, this.dataset.type);
        });
    });
    if (closeBtn)  closeBtn.addEventListener('click', closeModal);
    if (backdrop)  backdrop.addEventListener('click', closeModal);
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeModal();
    });
})();
</script>
