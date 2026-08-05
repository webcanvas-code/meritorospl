<?php
$_page_id = get_the_ID();
$_orig_id = apply_filters('wpml_object_id', $_page_id, get_post_type(), true, apply_filters('wpml_default_language', null));

$title = mer_field('kp_dlaczego_title', "Dlaczego firmy wybierają nasze\nrozwiązania kadrowe");

$card_defaults = [
    ['icon' => 'award',        'title' => "Jakość potwierdzona\nstandardami",      'text' => 'Realizujemy usługi w oparciu o certyfikat ISO 9001'],
    ['icon' => 'file-text',    'title' => "Nowoczesne i elastyczne\npodejście",     'text' => 'Przygotowujemy raporty finansowe dopasowane do potrzeb zarządu i wspierające podejmowanie decyzji biznesowych.'],
    ['icon' => 'shield-check', 'title' => 'Bezpieczeństwo danych',                  'text' => 'Stosujemy rozwiązania zgodne z normą ISO/IEC 27001, zapewniające poufność, integralność i bezpieczeństwo danych pracowniczych.'],
    ['icon' => 'refresh-cw',   'title' => 'Business continuity',                    'text' => 'Usługi realizuje cały zespół specjalistów, dlatego urlopy i rotacja pracowników nie wpływają na terminowość i ciągłość obsługi Twojej firmy.'],
];

$cards = [];
for ($i = 1; $i <= 4; $i++) {
    $g = get_field("kp_dlaczego_{$i}") ?: ($_orig_id !== $_page_id ? get_field("kp_dlaczego_{$i}", $_orig_id) : null);
    $d = $card_defaults[$i - 1];
    $cards[] = [
        'icon'  => is_array($g) && !empty($g['icon'])  ? $g['icon']  : $d['icon'],
        'title' => is_array($g) && !empty($g['title']) ? $g['title'] : $d['title'],
        'text'  => is_array($g) && !empty($g['text'])  ? $g['text']  : $d['text'],
    ];
}
?>

<section class="py-10 md:py-20 bg-white relative">
    <div class="max-w-7xl mx-auto px-6 mb-10 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900">
            <?php echo nl2br(esc_html($title)); ?>
        </h2>
        <div class="hidden sm:flex items-center gap-2 shrink-0">
            <button id="kp-dlaczego-prev" type="button" class="w-12 h-12 rounded-full bg-white border border-slate-200 flex items-center justify-center shadow-sm hover:bg-slate-50 transition-colors" style="opacity:0.35;pointer-events:none">
                <i data-lucide="chevron-left" class="w-5 h-5 text-slate-700 stroke-[2]"></i>
            </button>
            <button id="kp-dlaczego-next" type="button" class="w-12 h-12 rounded-full bg-[#00d084] flex items-center justify-center shadow-md hover:bg-[#00b872] transition-colors">
                <i data-lucide="chevron-right" class="w-5 h-5 text-white stroke-[2]"></i>
            </button>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6">
        <div class="overflow-hidden">
        <div id="kp-dlaczego-track" class="flex gap-4 transition-transform duration-500 ease-in-out">
            <?php foreach ($cards as $card) : ?>
            <div class="bg-white rounded-2xl p-8 flex flex-col min-w-[85%] sm:min-w-[calc(50%-12px)] lg:w-[400px] lg:min-w-[400px] lg:h-[325px] border border-emerald-200">
                <i data-lucide="<?php echo esc_attr($card['icon']); ?>" stroke-width="1" class="w-14 h-14 text-[#00d084] mb-8"></i>
                <h3 class="text-xl md:text-2xl font-bold text-slate-900 mb-3 leading-snug"><?php echo nl2br(esc_html($card['title'])); ?></h3>
                <p class="text-base md:text-lg text-slate-500 leading-relaxed"><?php echo mer_esc($card['text']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 mt-6">
        <div class="flex items-center gap-4 sm:justify-center">
            <button id="kp-dlaczego-prev-m" class="sm:hidden w-12 h-12 rounded-full bg-white border border-slate-200 flex items-center justify-center shadow-sm hover:bg-slate-50 transition-colors" style="opacity:0.35;pointer-events:none">
                <i data-lucide="chevron-left" class="w-5 h-5 text-slate-700 stroke-[2]"></i>
            </button>
            <div class="flex flex-1 sm:flex-none items-center justify-center gap-2" id="kp-dlaczego-dots">
                <?php foreach ($cards as $idx => $card) : ?>
                <button class="rounded-full transition-all duration-300 <?php echo $idx === 0 ? 'w-6 h-2 bg-[#00d084]' : 'w-2 h-2 bg-slate-300'; ?>" data-i="<?php echo $idx; ?>"></button>
                <?php endforeach; ?>
            </div>
            <button id="kp-dlaczego-next-m" class="sm:hidden w-12 h-12 rounded-full bg-[#00d084] flex items-center justify-center shadow-md hover:bg-[#00b872] transition-colors">
                <i data-lucide="chevron-right" class="w-5 h-5 text-white stroke-[2]"></i>
            </button>
        </div>
    </div>
</section>

<script>
(function () {
    var track   = document.getElementById('kp-dlaczego-track');
    var nextBtn = document.getElementById('kp-dlaczego-next');
    var prevBtn = document.getElementById('kp-dlaczego-prev');
    var prevBtnM = document.getElementById('kp-dlaczego-prev-m');
    var nextBtnM = document.getElementById('kp-dlaczego-next-m');
    var dots    = document.querySelectorAll('#kp-dlaczego-dots button');
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
        var cardWidth = cards[0].offsetWidth + 16;
        var visible   = Math.max(1, Math.round(track.parentElement.offsetWidth / cardWidth));
        return Math.max(0, total - visible);
    }

    function update() {
        var max = getMax();
        if (current > max) current = max;
        var cardWidth = cards[0].offsetWidth + 16;
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
})();
</script>
