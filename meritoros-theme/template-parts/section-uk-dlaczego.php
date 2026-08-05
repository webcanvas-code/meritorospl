<?php
$_page_id = get_the_ID();
$_orig_id = apply_filters('wpml_object_id', $_page_id, get_post_type(), true, apply_filters('wpml_default_language', null));

$title = mer_field('uk_dlaczego_title', "Dlaczego firmy wybierają nasze\nrozwiązania księgowe");

$card_defaults = [
    ['icon' => 'badge-check',  'title' => "Jakość potwierdzona\nstandardami",        'text' => 'Pracujemy zgodnie z normą ISO 9001 — systematyczne procesy, kontrola jakości i ciągłe doskonalenie usług.', 'highlighted' => false],
    ['icon' => 'file-text',    'title' => "Nowoczesne i elastyczne podejście",           'text' => 'Dopasowujemy narzędzia i zakres współpracy do realnych potrzeb Twojej firmy – bez zbędnej biurokracji.', 'highlighted' => true],
    ['icon' => 'refresh-cw',   'title' => 'Business continuity',                       'text' => 'Zespołowy model pracy gwarantuje ciągłość obsługi — urlopy i rotacja pracowników nie wpływają na jakość Twojej księgowości.', 'highlighted' => false],
    ['icon' => 'shield-check', 'title' => "Bezpieczeństwo danych",                     'text' => 'Dane klientów chronimy zgodnie z normą ISO 27001 — wdrożone procedury, szyfrowanie i regularne audyty bezpieczeństwa.', 'highlighted' => false],
];

$cards = [];
for ($i = 1; $i <= 4; $i++) {
    $g = get_field("uk_dlaczego_{$i}") ?: ($_orig_id !== $_page_id ? get_field("uk_dlaczego_{$i}", $_orig_id) : null);
    $d = $card_defaults[$i - 1];
    $cards[] = [
        'icon'        => is_array($g) && !empty($g['icon'])  ? $g['icon']  : $d['icon'],
        'title'       => is_array($g) && !empty($g['title']) ? $g['title'] : $d['title'],
        'text'        => is_array($g) && !empty($g['text'])  ? $g['text']  : $d['text'],
        'highlighted' => is_array($g) && isset($g['highlighted']) ? (bool)$g['highlighted'] : $d['highlighted'],
    ];
}
?>

<section class="py-10 md:py-20 bg-white relative">
    <div class="max-w-7xl mx-auto px-6 mb-10 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900">
            <?php echo nl2br(esc_html($title)); ?>
        </h2>
        <div class="hidden sm:flex items-center gap-2 shrink-0">
            <button id="uk-dlaczego-prev" type="button" class="w-12 h-12 rounded-full bg-white border border-slate-200 flex items-center justify-center shadow-sm hover:bg-slate-50 transition-colors" style="opacity:0.35;pointer-events:none">
                <i data-lucide="chevron-left" class="w-5 h-5 text-slate-700 stroke-[2]"></i>
            </button>
            <button id="uk-dlaczego-next" type="button" class="w-12 h-12 rounded-full bg-[#00d084] flex items-center justify-center shadow-md hover:bg-[#00b872] transition-colors">
                <i data-lucide="chevron-right" class="w-5 h-5 text-white stroke-[2]"></i>
            </button>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6">
        <div class="overflow-hidden">
        <div id="uk-dlaczego-track" class="flex gap-4 transition-transform duration-500 ease-in-out">
            <?php foreach ($cards as $card) :
                $is_green = $card['highlighted'];
                $bg       = $is_green ? 'bg-[#00d084]' : 'bg-white border border-slate-200';
                $icon_cls = $is_green ? 'text-white/80' : 'text-[#00d084]';
                $title_cls = $is_green ? 'text-white' : 'text-slate-900';
                $text_cls  = $is_green ? 'text-white/75' : 'text-slate-500';
            ?>
            <div class="<?php echo $bg; ?> rounded-2xl p-8 flex flex-col min-w-[85%] sm:min-w-[calc(50%-12px)] lg:w-[400px] lg:min-w-[400px] lg:h-[325px]">
                <i data-lucide="<?php echo esc_attr($card['icon']); ?>" stroke-width="1" class="w-14 h-14 <?php echo $icon_cls; ?> mb-8"></i>
                <h3 class="text-xl md:text-2xl font-bold <?php echo $title_cls; ?> mb-3 leading-snug"><?php echo nl2br(esc_html($card['title'])); ?></h3>
                <p class="text-base md:text-lg <?php echo $text_cls; ?> leading-relaxed"><?php echo mer_esc($card['text']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 mt-6">
        <div class="flex items-center gap-4 sm:justify-center">
            <button id="uk-dlaczego-prev-m" class="sm:hidden w-12 h-12 rounded-full bg-white border border-slate-200 flex items-center justify-center shadow-sm hover:bg-slate-50 transition-colors" style="opacity:0.35;pointer-events:none">
                <i data-lucide="chevron-left" class="w-5 h-5 text-slate-700 stroke-[2]"></i>
            </button>
            <div class="flex flex-1 sm:flex-none items-center justify-center gap-2" id="uk-dlaczego-dots">
                <?php foreach ($cards as $idx => $card) : ?>
                <button class="rounded-full transition-all duration-300 <?php echo $idx === 0 ? 'w-6 h-2 bg-[#00d084]' : 'w-2 h-2 bg-slate-300'; ?>" data-i="<?php echo $idx; ?>"></button>
                <?php endforeach; ?>
            </div>
            <button id="uk-dlaczego-next-m" class="sm:hidden w-12 h-12 rounded-full bg-[#00d084] flex items-center justify-center shadow-md hover:bg-[#00b872] transition-colors">
                <i data-lucide="chevron-right" class="w-5 h-5 text-white stroke-[2]"></i>
            </button>
        </div>
    </div>
</section>

<script>
(function () {
    var track   = document.getElementById('uk-dlaczego-track');
    var nextBtn = document.getElementById('uk-dlaczego-next');
    var prevBtn = document.getElementById('uk-dlaczego-prev');
    var prevBtnM = document.getElementById('uk-dlaczego-prev-m');
    var nextBtnM = document.getElementById('uk-dlaczego-next-m');
    var dots    = document.querySelectorAll('#uk-dlaczego-dots button');
    if (!track) return;
    var cards   = track.querySelectorAll(':scope > div');
    var total   = cards.length;
    var current = 0;

    function getMax() {
        var cardWidth = cards[0].offsetWidth + 16;
        var visible   = Math.max(1, Math.round(track.parentElement.offsetWidth / cardWidth));
        return Math.max(0, total - visible);
    }

    function updateDots(max) {
        dots.forEach(function (d, i) {
            d.className = 'rounded-full transition-all duration-300 ' + (i === current ? 'w-6 h-2 bg-[#00d084]' : 'w-2 h-2 bg-slate-300');
            d.style.display = i <= max ? '' : 'none';
        });
    }

    function update() {
        var max = getMax();
        if (current > max) current = max;
        var cardWidth = cards[0].offsetWidth + 16;
        track.style.transform = 'translateX(-' + (current * cardWidth) + 'px)';
        [prevBtn, prevBtnM].forEach(function(b) { if (b) { b.style.opacity = current === 0  ? '0.35' : '1'; b.style.pointerEvents = current === 0  ? 'none' : ''; } });
        [nextBtn, nextBtnM].forEach(function(b) { if (b) { b.style.opacity = current >= max ? '0.35' : '1'; b.style.pointerEvents = current >= max ? 'none' : ''; } });
        updateDots(max);
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
})();
</script>
