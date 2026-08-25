<?php
function kp_video_embed_url(string $url): string {
    if (!$url) return '';
    if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url, $m)) {
        return 'https://www.youtube.com/embed/' . $m[1] . '?autoplay=1&rel=0';
    }
    if (preg_match('/vimeo\.com\/(\d+)/', $url, $m)) {
        return 'https://player.vimeo.com/video/' . $m[1] . '?autoplay=1';
    }
    return $url;
}
function kp_video_thumbnail(string $url): string {
    if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url, $m)) {
        return 'https://img.youtube.com/vi/' . $m[1] . '/maxresdefault.jpg';
    }
    return '';
}

$_fp_id   = (int) get_option('page_on_front');
$title    = (get_field('hist_title',    $_fp_id) ?: 'Historie naszych klientów');
$btn_text = (get_field('hist_btn_text', $_fp_id) ?: 'Poznaj więcej historii');
$btn_url  = (get_field('hist_btn_url',  $_fp_id) ?: home_url('/historie-klientow/'));

$slide_defaults = [
    1 => [
        'logo_alt'   => 'HPC',
        'industries' => "Geologia inżynierska\nOchrona środowiska",
        'scope'      => 'Kadry i płace, wsparcie w procesie audytu kadrowego',
        'desc'       => 'Po kilku zmianach w dziale HR spółka potrzebowała szybkiego uporządkowania dokumentacji kadrowej i bezpiecznego zamknięcia roku.',
        'img'        => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=1200',
    ],
    2 => [
        'logo_alt'   => 'Printbox',
        'industries' => "E-commerce\nTechnologia",
        'scope'      => 'Pełna obsługa kadrowo-płacowa, raportowanie HR, wsparcie podczas audytu',
        'desc'       => 'Dynamicznie rosnąca spółka technologiczna potrzebowała partnera, który zapewni sprawne naliczanie płac i gotowość dokumentacyjną na każdym etapie wzrostu.',
        'img'        => 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=1200',
    ],
];

$slides = [];
for ($i = 1; $i <= 2; $i++) {
    $g = get_field("hist_{$i}", $_fp_id);
    $d = $slide_defaults[$i];

    $logo           = is_array($g) && !empty($g['logo'])       ? $g['logo']       : null;
    $industries_raw = is_array($g) && !empty($g['industries']) ? $g['industries'] : $d['industries'];
    $scope          = is_array($g) && !empty($g['scope'])      ? $g['scope']      : $d['scope'];
    $desc           = is_array($g) && !empty($g['desc'])       ? $g['desc']       : $d['desc'];
    $image          = is_array($g) && !empty($g['image'])      ? $g['image']      : null;
    $video_file     = is_array($g) && !empty($g['video_file']) ? $g['video_file'] : null;
    $video_url      = is_array($g) && !empty($g['video_url'])  ? $g['video_url']  : '';

    $img_url = is_array($image) ? esc_url($image['url']) : (kp_video_thumbnail($video_url) ?: $d['img']);
    $img_alt = is_array($image) ? esc_attr($image['alt'] ?: $d['logo_alt']) : $d['logo_alt'];

    if (is_array($video_file) && !empty($video_file['url'])) {
        $play_src  = esc_url($video_file['url']);
        $play_type = 'file';
    } elseif ($video_url) {
        $play_src  = esc_attr(kp_video_embed_url($video_url));
        $play_type = 'embed';
    } else {
        $play_src  = '';
        $play_type = '';
    }

    $industries = array_values(array_filter(array_map('trim', explode("\n", $industries_raw))));
    $slides[] = compact('logo', 'industries', 'scope', 'desc', 'img_url', 'img_alt', 'play_src', 'play_type', 'd');
}
?>

<section class="py-10 md:py-20 bg-white relative">
    <div class="max-w-7xl mx-auto px-6 mb-10 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900"><?php echo mer_esc($title); ?></h2>
        <div class="hidden sm:flex items-center gap-2 shrink-0">
            <button id="kp-historie-prev" type="button" class="w-12 h-12 rounded-full bg-white border border-slate-200 flex items-center justify-center shadow-sm hover:bg-slate-50 transition-colors" style="opacity:0.35;pointer-events:none">
                <i data-lucide="chevron-left" class="w-5 h-5 text-slate-700 stroke-[2]"></i>
            </button>
            <button id="kp-historie-next" type="button" class="w-12 h-12 rounded-full bg-[#00d084] flex items-center justify-center shadow-md hover:bg-[#00b872] transition-colors">
                <i data-lucide="chevron-right" class="w-5 h-5 text-white stroke-[2]"></i>
            </button>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6">
        <div class="overflow-hidden">
        <div id="kp-historie-track" class="flex gap-6 transition-transform duration-500 ease-in-out">
            <?php foreach ($slides as $slide) : ?>
                <div class="min-w-[85%] sm:min-w-[calc(50%-12px)] lg:w-[400px] lg:min-w-[400px] rounded-2xl overflow-hidden border border-slate-200 flex flex-col">
                    <div class="relative h-[155px] shrink-0">
                        <img src="<?php echo $slide['img_url']; ?>" alt="<?php echo $slide['img_alt']; ?>" class="absolute inset-0 w-full h-full object-cover" loading="lazy">
                        <div class="absolute inset-0 bg-slate-900/20"></div>
                        <?php if ($slide['play_src']) : ?>
                        <button class="absolute inset-0 flex items-center justify-center group kp-play-btn"
                            data-src="<?php echo $slide['play_src']; ?>"
                            data-type="<?php echo $slide['play_type']; ?>"
                            aria-label="<?php echo esc_attr(__('Odtwórz film', 'meritoros')); ?>">
                        <?php else : ?>
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <?php endif; ?>
                            <div class="w-12 h-12 rounded-full bg-[#00d084] flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform duration-200">
                                <i data-lucide="play" fill="#fff" class="w-4 h-4 text-white ml-0.5" stroke-width="0"></i>
                            </div>
                        <?php if ($slide['play_src']) : ?>
                        </button>
                        <?php else : ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <?php if (is_array($slide['logo'])) : ?>
                            <img src="<?php echo esc_url($slide['logo']['url']); ?>" alt="<?php echo esc_attr($slide['logo']['alt'] ?: $slide['d']['logo_alt']); ?>" class="h-7 w-auto object-contain object-left mb-3" loading="lazy">
                        <?php else : ?>
                            <p class="text-sm font-bold text-slate-800 mb-3"><?php echo mer_esc($slide['d']['logo_alt']); ?></p>
                        <?php endif; ?>
                        <div class="flex flex-wrap gap-1 mb-3">
                            <?php foreach ($slide['industries'] as $ind) : ?>
                            <span class="mer-btn mer-btn--secondary px-2 py-0.5 rounded-full border border-slate-300 text-[10px] text-slate-600"><?php echo mer_esc($ind); ?></span>
                            <?php endforeach; ?>
                        </div>
                        <p class="text-xs text-slate-500 leading-relaxed line-clamp-3 mb-3"><?php echo mer_esc($slide['desc']); ?></p>
                        <a href="<?php echo esc_url($btn_url); ?>" class="mer-btn mer-btn--white mt-auto inline-flex px-5 py-2.5 rounded-full bg-white text-slate-700 text-xs font-semibold border border-slate-200 hover:border-slate-300 hover:bg-slate-50 transition-colors self-start">
                            <?php echo mer_esc($btn_text); ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 mt-6">
        <div class="flex items-center gap-4 sm:justify-center">
            <button id="kp-historie-prev-m" class="sm:hidden w-12 h-12 rounded-full bg-white border border-slate-200 flex items-center justify-center shadow-sm hover:bg-slate-50 transition-colors" style="opacity:0.35;pointer-events:none">
                <i data-lucide="chevron-left" class="w-5 h-5 text-slate-700 stroke-[2]"></i>
            </button>
            <div class="flex flex-1 sm:flex-none items-center justify-center gap-2" id="kp-historie-dots">
                <?php foreach ($slides as $idx => $slide) : ?>
                <button class="rounded-full transition-all duration-300 <?php echo $idx === 0 ? 'w-6 h-2 bg-[#00d084]' : 'w-2 h-2 bg-slate-300'; ?>" data-i="<?php echo $idx; ?>"></button>
                <?php endforeach; ?>
            </div>
            <button id="kp-historie-next-m" class="sm:hidden w-12 h-12 rounded-full bg-[#00d084] flex items-center justify-center shadow-md hover:bg-[#00b872] transition-colors">
                <i data-lucide="chevron-right" class="w-5 h-5 text-white stroke-[2]"></i>
            </button>
        </div>
    </div>
</section>

<div id="kp-video-modal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 md:p-10">
    <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm" id="kp-modal-backdrop"></div>
    <div class="relative w-full max-w-4xl z-10">
        <button id="kp-modal-close" class="absolute -top-10 right-0 text-white/80 hover:text-white transition-colors flex items-center gap-1.5 text-sm">
            <i data-lucide="x" class="w-5 h-5"></i> <?php echo esc_html__('Zamknij', 'meritoros'); ?>
        </button>
        <div id="kp-embed-wrap" class="relative w-full hidden" style="padding-bottom:56.25%">
            <iframe id="kp-video-iframe" class="absolute inset-0 w-full h-full rounded-2xl" src="" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
        </div>
        <div id="kp-file-wrap" class="hidden">
            <video id="kp-video-file" controls autoplay playsinline class="w-full rounded-2xl bg-black max-h-[80vh]" src=""></video>
        </div>
    </div>
</div>

<script>
(function () {
    var track   = document.getElementById('kp-historie-track');
    var nextBtn = document.getElementById('kp-historie-next');
    var prevBtn = document.getElementById('kp-historie-prev');
    var prevBtnM = document.getElementById('kp-historie-prev-m');
    var nextBtnM = document.getElementById('kp-historie-next-m');
    var dots    = document.querySelectorAll('#kp-historie-dots button');
    if (!track) return;
    var cards   = track.querySelectorAll(':scope > div');
    var total   = cards.length;
    var current = 0;

    function updateDots() {
        dots.forEach(function (d, i) {
            d.className = 'rounded-full transition-all duration-300 ' + (i === current ? 'w-6 h-2 bg-[#00d084]' : 'w-2 h-2 bg-slate-300');
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
        [prevBtn, prevBtnM].forEach(function(b) { if (b) { b.style.opacity = current === 0  ? '0.35' : '1'; b.style.pointerEvents = current === 0  ? 'none' : ''; } });
        [nextBtn, nextBtnM].forEach(function(b) { if (b) { b.style.opacity = current >= max ? '0.35' : '1'; b.style.pointerEvents = current >= max ? 'none' : ''; } });
        updateDots();
    }

    nextBtn.addEventListener('click', function () { if (current < getMax()) { current++; update(); } });
    prevBtn.addEventListener('click', function () { if (current > 0) { current--; update(); } });
    if (nextBtnM) nextBtnM.addEventListener('click', function () { if (current < getMax()) { current++; update(); } });
    if (prevBtnM) prevBtnM.addEventListener('click', function () { if (current > 0)        { current--; update(); } });
    dots.forEach(function (d) {
        d.addEventListener('click', function () { current = parseInt(d.dataset.i); update(); });
    });
    window.addEventListener('resize', update);
    (function tryInit() { if (cards[0] && cards[0].offsetWidth > 0) { update(); } else { requestAnimationFrame(tryInit); } })();

    var modal     = document.getElementById('kp-video-modal');
    var backdrop  = document.getElementById('kp-modal-backdrop');
    var closeBtn  = document.getElementById('kp-modal-close');
    var embedWrap = document.getElementById('kp-embed-wrap');
    var fileWrap  = document.getElementById('kp-file-wrap');
    var iframe    = document.getElementById('kp-video-iframe');
    var videoEl   = document.getElementById('kp-video-file');

    function openModal(src, type) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
        if (type === 'file') {
            fileWrap.classList.remove('hidden');
            embedWrap.classList.add('hidden');
            videoEl.src = src;
        } else {
            embedWrap.classList.remove('hidden');
            fileWrap.classList.add('hidden');
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

    document.querySelectorAll('.kp-play-btn').forEach(function (btn) {
        btn.addEventListener('click', function () { openModal(this.dataset.src, this.dataset.type); });
    });
    backdrop.addEventListener('click', closeModal);
    closeBtn.addEventListener('click', closeModal);
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModal(); });
})();
</script>
