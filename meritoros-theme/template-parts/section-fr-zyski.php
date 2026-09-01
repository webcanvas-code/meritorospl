<?php
$_page_id = get_the_ID();

$title = __( mer_field('fr_zysk_title', "Co zyskujesz, gdy księgowość\nfundacji jest poukładana"), 'meritoros' );

$card_defaults = [
    ['icon' => 'shield-check',   'title' => __("Bezpieczne zarządzanie\nmajątkiem",  'meritoros'), 'text' => __('Porządek w danych i dokumentach, jasna sprawozdawczość i kontrola nad obowiązkami.',                                        'meritoros')],
    ['icon' => 'clipboard-list', 'title' => __("Sukcesja na trwałych\nregułach",     'meritoros'), 'text' => __('Przejrzyste zasady i przewidywalność – tak, aby rozwiązanie działało długoterminowo.',                                     'meritoros')],
    ['icon' => 'calendar-check', 'title' => __("Spokój w kwestiach\nformalnych",     'meritoros'), 'text' => __('Dopilnujemy terminów i obowiązków sprawozdawczych, żeby nic „nie wyskakiwało" w ostatniej chwili.',                        'meritoros')],
    ['icon' => 'badge-check',    'title' => __("Mniej ryzyk,\nmniej poprawek",       'meritoros'), 'text' => __('Praca procesowa, weryfikacja danych i standardy, które ograniczają błędy.',                                              'meritoros')],
];

$cards = [];
for ($i = 1; $i <= 4; $i++) {
    $g = get_field("fr_zysk_{$i}");
    $d = $card_defaults[$i - 1];
    $cards[] = [
        'icon'  => is_array($g) && !empty($g['icon'])  ? $g['icon']  : $d['icon'],
        'title' => is_array($g) && !empty($g['title']) ? __($g['title'], 'meritoros') : $d['title'],
        'text'  => is_array($g) && !empty($g['text'])  ? __($g['text'],  'meritoros') : $d['text'],
    ];
}
?>

<section class="py-10 md:py-16 bg-emerald-50 relative">

    <!-- Okrąg lewy — większy -->
    <div class="absolute -left-40 top-1/2 -translate-y-1/2 w-[500px] h-[500px] rounded-full border-[52px] border-emerald-300/40 pointer-events-none" aria-hidden="true"></div>

    <!-- Okrąg prawy — mniejszy, u góry -->
    <div class="absolute -right-20 top-0 w-[260px] h-[260px] rounded-full border-[40px] border-emerald-300/40 pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-6 mb-10 relative z-10 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 max-w-2xl leading-tight">
            <?php echo nl2br(esc_html($title)); ?>
        </h2>
        <div class="flex items-center gap-2 shrink-0">
            <button id="zysk-prev" type="button" class="w-12 h-12 rounded-full bg-white border border-slate-200 flex items-center justify-center shadow-sm hover:bg-slate-50 transition-colors" style="opacity:0.35;pointer-events:none">
                <i data-lucide="chevron-left" class="w-5 h-5 text-slate-700 stroke-[2]"></i>
            </button>
            <button id="zysk-next" type="button" class="w-12 h-12 rounded-full bg-[#00d084] flex items-center justify-center shadow-md hover:bg-[#00b872] transition-colors">
                <i data-lucide="chevron-right" class="w-5 h-5 text-white stroke-[2]"></i>
            </button>
        </div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="overflow-hidden">
        <div id="zysk-track" class="flex gap-4 transition-transform duration-500 ease-in-out">
            <?php foreach ($cards as $card) : ?>
            <div class="bg-white rounded-2xl p-8 flex flex-col min-w-[85%] sm:min-w-[calc(50%-12px)] lg:w-[400px] lg:min-w-[400px] lg:h-[325px] border border-emerald-200">
                <i data-lucide="<?php echo esc_attr($card['icon']); ?>" stroke-width="1" class="w-14 h-14 text-[#00d084] mb-8"></i>
                <?php
                $raw = $card['title'];
                if ( strpos($raw, "\n") !== false ) {
                    $title_parts = explode("\n", $raw, 2);
                } else {
                    // Podziel przy ostatniej spacji przed połową stringa
                    $mid = (int) ceil( mb_strlen($raw) / 2 );
                    $pos = mb_strrpos( mb_substr($raw, 0, $mid + 6), ' ' );
                    $title_parts = $pos !== false
                        ? [ mb_substr($raw, 0, $pos), mb_substr($raw, $pos + 1) ]
                        : [ $raw, '' ];
                }
                ?>
                <h3 class="text-xl md:text-2xl font-bold text-slate-900 mb-3 leading-snug">
                    <span class="block"><?php echo mer_esc($title_parts[0]); ?></span>
                    <?php if ( ! empty($title_parts[1]) ) : ?>
                    <span class="block text-slate-500 font-medium"><?php echo mer_esc($title_parts[1]); ?></span>
                    <?php endif; ?>
                </h3>
                <p class="text-base md:text-lg text-slate-500 leading-relaxed"><?php echo mer_esc($card['text']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 mt-6 flex items-center justify-center gap-2 relative z-10" id="zysk-dots">
        <?php foreach ($cards as $idx => $card) : ?>
        <button class="rounded-full transition-all duration-300 <?php echo $idx === 0 ? 'w-6 h-2 bg-[#00d084]' : 'w-2 h-2 bg-slate-300'; ?>" data-i="<?php echo $idx; ?>"></button>
        <?php endforeach; ?>
    </div>
</section>

<script>
(function () {
    var track   = document.getElementById('zysk-track');
    var nextBtn = document.getElementById('zysk-next');
    var prevBtn = document.getElementById('zysk-prev');
    var dots    = document.querySelectorAll('#zysk-dots button');
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
})();
</script>
