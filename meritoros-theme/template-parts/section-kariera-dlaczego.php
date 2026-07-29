<?php
$title = mer_field('kar_dlaczego_title', __('Dlaczego warto do nas dołączyć?', 'meritoros'));

$card_defaults = [
    1 => [
        'title' => __("Ciągły Rozwój jest wpisany\nw nasze DNA", 'meritoros'),
        'text'  => __('Nie stoimy w miejscu. Rozwój i doskonalenie to część naszej codziennej pracy. Szukamy osób, które chcą mieć realny wpływ na usprawnianie procesów i lubią środowisko, w którym można się uczyć i rosnąć.', 'meritoros'),
        'tag'   => __('Szkolenia i wsparcie', 'meritoros'),
        'img'   => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=800&q=80',
    ],
    2 => [
        'title' => __("Stabilne zatrudnienie\ni jasne zasady", 'meritoros'),
        'text'  => __('Oferujemy umowę o pracę, przewidywalny zakres obowiązków i przejrzyste ścieżki wynagradzania. Wiemy, że komfort i bezpieczeństwo to fundament dobrej pracy.', 'meritoros'),
        'tag'   => __('Umowa o pracę', 'meritoros'),
        'img'   => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=800&q=80',
    ],
    3 => [
        'title' => __("Praca w zgranym\nzespole specjalistów", 'meritoros'),
        'text'  => __('Dołączysz do ludzi, którzy naprawdę rozumieją swoją dziedzinę i chętnie dzielą się wiedzą. Cenimy atmosferę wzajemnego szacunku i dobrej komunikacji.', 'meritoros'),
        'tag'   => __('Dobra atmosfera', 'meritoros'),
        'img'   => 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=800&q=80',
    ],
    4 => [
        'title' => __("Elastyczność dopasowana\ndo Twojego stylu pracy", 'meritoros'),
        'text'  => __('Hybrydowy model pracy, elastyczne godziny i nowoczesne narzędzia pozwalają skupić się na tym, co ważne — bez zbędnych przeszkód.', 'meritoros'),
        'tag'   => __('Model hybrydowy', 'meritoros'),
        'img'   => 'https://images.unsplash.com/photo-1560472355-536de3962603?w=800&q=80',
    ],
];

$_kar_page_id = get_the_ID();
$_kar_orig_id = apply_filters('wpml_object_id', $_kar_page_id, get_post_type(), true, apply_filters('wpml_default_language', null));

$cards = [];
for ($i = 1; $i <= 4; $i++) {
    $g = get_field("kar_dlaczego_{$i}") ?: ($_kar_orig_id !== $_kar_page_id ? get_field("kar_dlaczego_{$i}", $_kar_orig_id) : null);
    $d = $card_defaults[$i];
    $img = is_array($g) && !empty($g['image']) ? $g['image'] : null;
    $cards[] = [
        'title'   => is_array($g) && !empty($g['title']) ? $g['title'] : $d['title'],
        'text'    => is_array($g) && !empty($g['text'])  ? $g['text']  : $d['text'],
        'tag'     => is_array($g) && !empty($g['tag'])   ? $g['tag']   : $d['tag'],
        'img_url' => is_array($img) ? esc_url($img['url']) : $d['img'],
        'img_alt' => is_array($img) ? esc_attr($img['alt'] ?: '') : '',
    ];
}
?>

<section class="py-16 md:py-20 bg-emerald-50">
    <div class="max-w-7xl mx-auto px-6 mb-10 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900"><?php echo mer_esc($title); ?></h2>
        <div class="flex items-center gap-2 shrink-0">
            <button id="dkar-prev" class="w-12 h-12 rounded-full bg-white border border-slate-200 flex items-center justify-center shadow-sm hover:bg-slate-50 transition-colors" style="opacity:0.35;pointer-events:none">
                <i data-lucide="chevron-left" class="w-5 h-5 text-slate-700 stroke-[2]"></i>
            </button>
            <button id="dkar-next" class="w-12 h-12 rounded-full bg-[#2d8650] flex items-center justify-center shadow-md hover:bg-[#246e41] transition-colors">
                <i data-lucide="chevron-right" class="w-5 h-5 text-white stroke-[2]"></i>
            </button>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6">
        <div class="overflow-hidden">
            <div id="dkar-track" class="flex gap-4 transition-transform duration-500 ease-in-out">
                <?php foreach ($cards as $card) : ?>
                <div class="dkar-card shrink-0">
                    <div class="flex flex-col sm:flex-row rounded-2xl overflow-hidden sm:h-[400px] group h-full">

                        <!-- Panel tekstowy (55%) -->
                        <div class="sm:w-[55%] bg-[#2d8650] p-7 sm:p-10 flex flex-col relative overflow-hidden min-h-[220px] sm:min-h-0">
                            <div class="absolute -bottom-14 -right-14 w-56 h-56 rounded-full bg-white/10 pointer-events-none"></div>
                            <div class="absolute -top-8 -left-8 w-32 h-32 rounded-full bg-white/5 pointer-events-none"></div>

                            <span class="text-xs font-bold text-white/60 uppercase tracking-widest mb-8 relative z-10">
                                <?php echo mer_esc($card['tag']); ?>
                            </span>

                            <div class="relative z-10">
                                <h3 class="text-2xl font-bold text-white leading-snug mb-4" style="min-height:3.75rem">
                                    <?php echo nl2br(esc_html($card['title'])); ?>
                                </h3>
                                <p class="text-white/80 text-base leading-relaxed">
                                    <?php echo mer_esc($card['text']); ?>
                                </p>
                            </div>
                        </div>

                        <!-- Panel ze zdjęciem (45%) -->
                        <div class="sm:w-[45%] h-56 sm:h-auto relative overflow-hidden">
                            <img src="<?php echo $card['img_url']; ?>"
                                 alt="<?php echo $card['img_alt']; ?>"
                                 class="absolute inset-0 w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700"
                                 loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-r from-[#2d8650]/15 to-transparent pointer-events-none"></div>
                        </div>

                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 mt-6 flex items-center justify-center gap-2" id="dkar-dots">
        <?php foreach ($cards as $idx => $card) : ?>
        <button class="dkar-dot rounded-full transition-all duration-300 <?php echo $idx === 0 ? 'w-6 h-2 bg-[#2d8650]' : 'w-2 h-2 bg-slate-300'; ?>" data-i="<?php echo $idx; ?>"></button>
        <?php endforeach; ?>
    </div>
</section>

<script>
(function () {
    var track   = document.getElementById('dkar-track');
    var prevBtn = document.getElementById('dkar-prev');
    var nextBtn = document.getElementById('dkar-next');
    var dots    = document.querySelectorAll('#dkar-dots .dkar-dot');
    if (!track) return;
    var cards   = track.querySelectorAll('.dkar-card');
    var total   = cards.length;
    var current = 0;
    var GAP     = 16;

    function setCardWidths() {
        var cw      = track.parentElement.offsetWidth;
        var perView = window.innerWidth >= 640 ? 2 : 1;
        var w       = perView === 1 ? cw : Math.floor((cw - GAP) / 2);
        cards.forEach(function (c) {
            c.style.width    = w + 'px';
            c.style.minWidth = w + 'px';
        });
    }

    function updateDots() {
        dots.forEach(function (d, i) {
            d.className = 'dkar-dot rounded-full transition-all duration-300 ' + (i === current ? 'w-6 h-2 bg-[#2d8650]' : 'w-2 h-2 bg-slate-300');
        });
    }

    function getMax() {
        var cardWidth = cards[0].offsetWidth + GAP;
        var visible   = Math.max(1, Math.round(track.parentElement.offsetWidth / cardWidth));
        return Math.max(0, total - visible);
    }

    function update() {
        var max = getMax();
        if (current > max) current = max;
        var cardWidth = cards[0].offsetWidth + GAP;
        track.style.transform = 'translateX(-' + (current * cardWidth) + 'px)';
        prevBtn.style.opacity       = current === 0  ? '0.35' : '1';
        prevBtn.style.pointerEvents = current === 0  ? 'none' : '';
        nextBtn.style.opacity       = current >= max ? '0.35' : '1';
        nextBtn.style.pointerEvents = current >= max ? 'none' : '';
        updateDots();
    }

    nextBtn.addEventListener('click', function () { if (current < getMax()) { current++; update(); } });
    prevBtn.addEventListener('click', function () { if (current > 0)        { current--; update(); } });
    dots.forEach(function (d) {
        d.addEventListener('click', function () { current = parseInt(d.dataset.i); update(); });
    });
    window.addEventListener('resize', function () { current = 0; setCardWidths(); update(); });
    (function tryInit() {
        if (track.parentElement.offsetWidth > 0) { setCardWidths(); update(); }
        else { requestAnimationFrame(tryInit); }
    })();
})();
</script>
