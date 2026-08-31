<?php
$_page_id = get_the_ID();
$_orig_id = apply_filters('wpml_object_id', $_page_id, get_post_type(), true, apply_filters('wpml_default_language', null));

$title = mer_field('bpo_dlaczego_title', __('Dlaczego BPO z Meritoros?', 'meritoros'));

$card_defaults = [
    ['icon' => 'trending-up',  'title' => __('Efektywność kosztowa', 'meritoros'),                 'text' => __('Outsourcing biznesowy pozwala na znaczne obniżenie kosztów operacyjnych. Dzięki nowoczesnej technologii i dużej skali obsługiwanych przez nas operacji oszczędności sięgają 20% lub więcej w porównaniu do obsługi procesów za pomocą własnych pracowników.', 'meritoros')],
    ['icon' => 'clock',        'title' => __("Uwolnienie czasu\ni usprawnienie procesów", 'meritoros'), 'text' => __('Przekazując odpowiedzialność za pewne procesy wsparcia, Zarząd i kluczowi menedżerowie przedsiębiorstwa mogą skupić się na rozwoju rynkowym i strategicznym zarządzaniu swoim biznesem.', 'meritoros')],
    ['icon' => 'expand',       'title' => __("Elastyczność i skalowanie\noperacji", 'meritoros'),     'text' => __('Elastyczność i indywidualne podejście pozwalają nam szybko dopasować się do zmieniających się potrzeb klientów i wspomóc ich na ścieżce skalowania swojej organizacji.', 'meritoros')],
    ['icon' => 'shield-check', 'title' => __("Bezpieczeństwo\ni compliance", 'meritoros'),            'text' => __('Działamy zgodnie z normami ISO 9001 i ISO/IEC 27001. Zapewniamy poufność danych, ciągłość obsługi i pełną zgodność z obowiązującymi przepisami prawa.', 'meritoros')],
];

$cards = [];
for ($i = 1; $i <= 4; $i++) {
    $g = get_field("bpo_d{$i}");
    $d = $card_defaults[$i - 1];
    $cards[] = [
        'icon'  => is_array($g) && !empty($g['icon'])  ? $g['icon']  : $d['icon'],
        'title' => is_array($g) && !empty($g['title']) ? $g['title'] : $d['title'],
        'text'  => is_array($g) && !empty($g['text'])  ? $g['text']  : $d['text'],
    ];
}
?>

<section id="bpo-dlaczego" class="py-10 md:py-16 bg-emerald-50 relative">

    <!-- Okrąg lewy -->
    <div class="absolute -left-40 top-1/2 -translate-y-1/2 w-[500px] h-[500px] rounded-full border-[52px] border-emerald-300/40 pointer-events-none" aria-hidden="true"></div>

    <!-- Okrąg prawy -->
    <div class="absolute -right-20 top-0 w-[260px] h-[260px] rounded-full border-[40px] border-emerald-300/40 pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-6 mb-10 relative z-10 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 max-w-2xl leading-tight">
            <?php echo mer_esc($title); ?>
        </h2>
        <div class="hidden sm:flex items-center gap-2 shrink-0">
            <button id="bpo-dlaczego-prev" type="button" class="w-12 h-12 rounded-full bg-white border border-slate-200 flex items-center justify-center shadow-sm hover:bg-slate-50 transition-colors" style="opacity:0.35;pointer-events:none">
                <i data-lucide="chevron-left" class="w-5 h-5 text-slate-700 stroke-[2]"></i>
            </button>
            <button id="bpo-dlaczego-next" type="button" class="w-12 h-12 rounded-full bg-[#00d084] flex items-center justify-center shadow-md hover:bg-[#00b872] transition-colors">
                <i data-lucide="chevron-right" class="w-5 h-5 text-white stroke-[2]"></i>
            </button>
        </div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="overflow-hidden">
        <div id="bpo-dlaczego-track" class="flex gap-4 transition-transform duration-500 ease-in-out">
            <?php foreach ($cards as $card) :
                $raw = $card['title'];
                if (strpos($raw, "\n") !== false) {
                    $title_parts = explode("\n", $raw, 2);
                } else {
                    $mid = (int) ceil(mb_strlen($raw) / 2);
                    $pos = mb_strrpos(mb_substr($raw, 0, $mid + 6), ' ');
                    $title_parts = $pos !== false
                        ? [mb_substr($raw, 0, $pos), mb_substr($raw, $pos + 1)]
                        : [$raw, ''];
                }
            ?>
            <div class="bg-white rounded-2xl p-8 flex flex-col min-w-[85%] sm:min-w-[calc(50%-12px)] lg:w-[400px] lg:min-w-[400px] lg:h-[325px] border border-emerald-200">
                <i data-lucide="<?php echo esc_attr($card['icon']); ?>" stroke-width="1" class="w-14 h-14 text-[#00d084] mb-8"></i>
                <h3 class="text-xl md:text-2xl font-bold text-slate-900 mb-3 leading-snug">
                    <span class="block"><?php echo mer_esc($title_parts[0]); ?></span>
                    <?php if (!empty($title_parts[1])) : ?>
                    <span class="block text-slate-500 font-medium"><?php echo mer_esc($title_parts[1]); ?></span>
                    <?php endif; ?>
                </h3>
                <p class="text-base md:text-lg text-slate-500 leading-relaxed"><?php echo mer_esc($card['text']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 mt-6 relative z-10">
        <div class="flex items-center gap-4 sm:justify-center">
            <button id="bpo-dlaczego-prev-m" class="sm:hidden w-12 h-12 rounded-full bg-white border border-slate-200 flex items-center justify-center shadow-sm hover:bg-slate-50 transition-colors" style="opacity:0.35;pointer-events:none">
                <i data-lucide="chevron-left" class="w-5 h-5 text-slate-700 stroke-[2]"></i>
            </button>
            <div class="flex flex-1 sm:flex-none items-center justify-center gap-2" id="bpo-dlaczego-dots">
                <?php foreach ($cards as $idx => $card) : ?>
                <button class="rounded-full transition-all duration-300 <?php echo $idx === 0 ? 'w-6 h-2 bg-[#00d084]' : 'w-2 h-2 bg-slate-300'; ?>" data-i="<?php echo $idx; ?>"></button>
                <?php endforeach; ?>
            </div>
            <button id="bpo-dlaczego-next-m" class="sm:hidden w-12 h-12 rounded-full bg-[#00d084] flex items-center justify-center shadow-md hover:bg-[#00b872] transition-colors">
                <i data-lucide="chevron-right" class="w-5 h-5 text-white stroke-[2]"></i>
            </button>
        </div>
    </div>
</section>

<script>
(function () {
    var track   = document.getElementById('bpo-dlaczego-track');
    var nextBtn = document.getElementById('bpo-dlaczego-next');
    var prevBtn = document.getElementById('bpo-dlaczego-prev');
    var prevBtnM = document.getElementById('bpo-dlaczego-prev-m');
    var nextBtnM = document.getElementById('bpo-dlaczego-next-m');
    var dots    = document.querySelectorAll('#bpo-dlaczego-dots button');
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
