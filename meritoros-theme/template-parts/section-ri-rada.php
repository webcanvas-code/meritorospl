<?php
$title = mer_field('ri_rada_title', 'Rada nadzorcza');

$card_defaults = [
    ['name' => 'Lidia Olszowska',   'role' => 'przewodnicząca rady nadzorczej', 'desc' => "doradca podatkowy (certyfikat nr 00443)\nbył członek zarządu Małopolskiej Izby Doradców Podatkowych"],
    ['name' => 'Maria Gargas',      'role' => 'członek rady nadzorczej',         'desc' => "przedsiębiorca\nprezes zarządu Emka Sp. z o.o."],
    ['name' => 'Jacek Pieniądz',    'role' => 'członek rady nadzorczej',         'desc' => "przedsiębiorca\nczłonek zarządu Chata Sp. z o.o."],
    ['name' => 'Dominik Jaskulski', 'role' => 'członek rady nadzorczej',         'desc' => "przedsiębiorca\nwiceprezes zarządu Office Samurai Sp. z o.o."],
    ['name' => 'Michał Czaicki',    'role' => 'członek rady nadzorczej',         'desc' => "przedsiębiorca\nprezes zarządu Printbox Sp. z o.o."],
];

$cards = [];
for ($i = 1; $i <= 9; $i++) {
    $c = get_field("ri_rada_card_{$i}");
    if (is_array($c) && !empty($c['name'])) {
        $cards[] = $c;
    } elseif (isset($card_defaults[$i - 1])) {
        $cards[] = $card_defaults[$i - 1];
    }
}
?>

<style>
@media (min-width: 1024px) {
    .ri-rada-card { height: 198px; }
}
</style>

<section class="py-10 md:py-14 bg-white border-t border-slate-100">

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <h2 class="text-4xl md:text-5xl font-bold tracking-tight text-slate-900 mb-12">
            <?php echo mer_esc($title); ?>
        </h2>
    </div>

    <div class="relative">
        <!-- Track -->
        <div class="overflow-hidden pl-6 lg:pl-[max(24px,calc((100vw-1280px)/2+24px))]">
            <div id="ri-rada-track" class="flex gap-5 transition-transform duration-500 ease-in-out">
                <?php foreach ($cards as $card) :
                    $name = esc_html($card['name'] ?? '');
                    $role = esc_html($card['role'] ?? '');
                    $desc = esc_html($card['desc'] ?? '');
                ?>
                <div class="ri-rada-card border border-slate-200 rounded-2xl p-7 flex flex-col gap-4 min-w-[85%] sm:min-w-[calc(50%-10px)] lg:min-w-[30%] shrink-0">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900 mb-1"><?php echo $name; ?></h3>
                        <p class="text-sm text-slate-400"><?php echo $role; ?></p>
                    </div>
                    <p class="text-base text-slate-600 leading-relaxed whitespace-pre-line"><?php echo $desc; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Przyciski -->
        <button id="ri-rada-prev" class="absolute left-6 top-1/2 -translate-y-1/2 w-14 h-14 rounded-full bg-white text-slate-400 border border-slate-200 flex items-center justify-center shadow hover:bg-slate-50 transition-colors z-10 opacity-0 pointer-events-none" aria-label="Poprzedni">
            <i data-lucide="chevron-left" class="w-6 h-6 stroke-[2]"></i>
        </button>
        <button id="ri-rada-next" class="absolute right-6 top-1/2 -translate-y-1/2 w-14 h-14 rounded-full bg-[#00d084] text-white flex items-center justify-center shadow-lg hover:bg-[#00b872] transition-colors z-10" aria-label="Następny">
            <i data-lucide="chevron-right" class="w-6 h-6 stroke-[2]"></i>
        </button>
    </div>

</section>

<script>
(function () {
    var track   = document.getElementById('ri-rada-track');
    var nextBtn = document.getElementById('ri-rada-next');
    var prevBtn = document.getElementById('ri-rada-prev');
    if (!track) return;
    var cards   = track.querySelectorAll(':scope > div');
    var total   = cards.length;
    var current = 0;

    function getCardWidth() { return cards[0].offsetWidth + 20; }
    function getMax() {
        var visible = Math.max(1, Math.round(track.parentElement.offsetWidth / getCardWidth()));
        return Math.max(0, total - visible);
    }
    function update() {
        var max = getMax();
        if (current > max) current = max;
        track.style.transform = 'translateX(-' + (current * getCardWidth()) + 'px)';
        prevBtn.classList.toggle('opacity-0',          current === 0);
        prevBtn.classList.toggle('pointer-events-none', current === 0);
        nextBtn.classList.toggle('opacity-0',          current >= max);
        nextBtn.classList.toggle('pointer-events-none', current >= max);
    }
    nextBtn.addEventListener('click', function () { if (current < getMax()) { current++; update(); } });
    prevBtn.addEventListener('click', function () { if (current > 0)        { current--; update(); } });
    window.addEventListener('resize', update);
    (function tryInit() { if (cards[0] && cards[0].offsetWidth > 0) { update(); } else { requestAnimationFrame(tryInit); } })();
})();
</script>
