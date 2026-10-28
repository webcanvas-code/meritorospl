<?php
// Czytaj pola zawsze ze strony głównej — ACFML zwróci wersję w aktualnym języku
$_test_id = (int) get_option('page_on_front');

$label = __( get_field('testimonials_label', $_test_id) ?: 'Opinie klientów',              'meritoros' );
$title = __( get_field('testimonials_title', $_test_id) ?: 'Sprawdź, co mówią o nas inni', 'meritoros' );

$test_defaults = [
    1 => ['company' => 'HPC',      'logo_html' => '<span class="text-xl font-bold tracking-tight text-[#5ba3d0]">HPC</span>',         'quote' => __('Mam księgowość w bezpiecznych rękach i wiem, że nie muszę się o to już martwić.',                                                          'meritoros'), 'author' => 'Sebastian Wiśniewski', 'role' => __('HP Cepolgol S.A.',              'meritoros'), 'initials' => 'SW', 'highlighted' => false, 'industry' => ''],
    2 => ['company' => 'Printbox', 'logo_html' => '<span class="text-lg font-bold tracking-tight text-white">Printbox</span>',        'quote' => __('Meritoros dostarczył nam stabilność i pewność, w trudnych momentach zawsze mamy właściwe odpowiedzi.',                                 'meritoros'), 'author' => 'Michał Czaicki',       'role' => __('CEO & Co-Founder, Printbox', 'meritoros'), 'initials' => 'MC', 'highlighted' => true,  'industry' => ''],
    3 => ['company' => 'SITECH',   'logo_html' => '<span class="text-lg font-bold tracking-tight text-slate-900">SITECH</span>',      'quote' => __('Profesjonalizm na każdym kroku. Polecamy Meritoros każdej firmie, która ceni sobie bezpieczeństwo i jakość obsługi.',                   'meritoros'), 'author' => 'Anna Kowalczyk',       'role' => __('Dyrektor Finansowy, SITECH', 'meritoros'), 'initials' => 'AK', 'highlighted' => false, 'industry' => ''],
    4 => ['company' => '', 'logo_html' => '', 'quote' => '', 'author' => '', 'role' => '', 'initials' => '', 'highlighted' => false, 'industry' => ''],
    5 => ['company' => '', 'logo_html' => '', 'quote' => '', 'author' => '', 'role' => '', 'initials' => '', 'highlighted' => false, 'industry' => ''],
    6 => ['company' => '', 'logo_html' => '', 'quote' => '', 'author' => '', 'role' => '', 'initials' => '', 'highlighted' => false, 'industry' => ''],
];

$items = [];
for ($i = 1; $i <= 6; $i++) {
    $def          = $test_defaults[$i];
    $_company_acf = get_field("test_{$i}_company",  $_test_id);
    $_logo_acf    = get_field("test_{$i}_logo_html", $_test_id);
    $quote        = __( get_field("test_{$i}_quote", $_test_id) ?: $def['quote'], 'meritoros' );
    if (!$quote) continue;
    $items[] = [
        'company'           => $_company_acf ?: $def['company'],
        'company_logo_html' => $_logo_acf ?: ($_company_acf ? esc_html($_company_acf) : $def['logo_html']),
        'quote'             => $quote,
        'author'            => (get_field("test_{$i}_author",   $_test_id) ?: $def['author']),
        'role'              => __( get_field("test_{$i}_role",   $_test_id) ?: $def['role'], 'meritoros' ),
        'initials'          => (get_field("test_{$i}_initials", $_test_id) ?: $def['initials']),
        'highlighted'       => (bool) (get_field("test_{$i}_highlighted", $_test_id) ?: $def['highlighted']),
        'industry'          => __( get_field("test_{$i}_industry", $_test_id) ?: $def['industry'], 'meritoros' ),
    ];
}

$stat_defaults = [
    1 => ['value' => '1200+', 'label' => __('Obsługiwanych klientów',    'meritoros'), 'accent' => false],
    2 => ['value' => '18+',   'label' => __('Lat na rynku',              'meritoros'), 'accent' => false],
    3 => ['value' => '98%',   'label' => __('Klientów poleca nas dalej', 'meritoros'), 'accent' => true],
    4 => ['value' => '35+',   'label' => __('Ekspertów w zespole',       'meritoros'), 'accent' => false],
];

$stats = [];
for ($i = 1; $i <= 4; $i++) {
    $def     = $stat_defaults[$i];
    $stats[] = [
        'value'  => (get_field("test_stat_{$i}_value",  $_test_id) ?: $def['value']),
        'label'  => __( get_field("test_stat_{$i}_label",  $_test_id) ?: $def['label'], 'meritoros' ),
        'accent' => (bool) (get_field("test_stat_{$i}_accent", $_test_id) ?: $def['accent']),
    ];
}
?>

<section id="testimonials" class="overflow-hidden px-6 lg:px-12 bg-slate-50 py-16 md:py-24">
    <div class="max-w-[1400px] mx-auto w-full">

        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
            <div>
                <span class="text-[#00d084] uppercase tracking-widest text-base font-bold mb-4 block">
                    <?php echo mer_esc($label); ?>
                </span>
                <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900">
                    <?php echo mer_esc($title); ?>
                </h2>
            </div>
            <div class="flex items-center gap-4 shrink-0">
            <?php if (empty($args['hide_cs_link'])) : ?>
            <a href="<?php echo esc_url(home_url('/historie-klientow/')); ?>"
               class="inline-flex items-center gap-2 text-[#00d084] hover:text-[#00b872] transition-colors group text-base font-medium shrink-0">
                <?php esc_html_e('Historie klientów', 'meritoros'); ?>
                <i data-lucide="arrow-up-right" class="w-5 h-5 stroke-[1.5] group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform"></i>
            </a>
            <?php endif; ?>
            <?php if (count($items) > 1) : ?>
                <div class="hidden sm:flex items-center gap-2">
                    <button id="test-prev" aria-label="<?php esc_attr_e('Poprzednia opinia', 'meritoros'); ?>" class="w-12 h-12 rounded-full bg-white border border-slate-200 flex items-center justify-center shadow-sm hover:bg-slate-50 transition-colors" style="opacity:0.35;pointer-events:none">
                        <i data-lucide="chevron-left" class="w-5 h-5 text-slate-700 stroke-[2]"></i>
                    </button>
                    <button id="test-next" aria-label="<?php esc_attr_e('Następna opinia', 'meritoros'); ?>" class="w-12 h-12 rounded-full bg-[#00d084] flex items-center justify-center shadow-md hover:bg-[#00b872] transition-colors">
                        <i data-lucide="chevron-right" class="w-5 h-5 text-white stroke-[2]"></i>
                    </button>
                </div>
            <?php endif; ?>
            </div>
        </div>

        <div class="overflow-hidden">
        <div id="test-track" class="flex gap-4 transition-transform duration-500 ease-in-out">
            <?php foreach ($items as $item) :
                $highlighted = !empty($item['highlighted']);
                $logo_html   = wp_kses($item['company_logo_html'] ?? esc_html($item['company'] ?? ''), [
                    'span' => ['class' => []],
                    'div'  => ['class' => []],
                ]);
                $quote    = mer_esc($item['quote'] ?? '');
                $author   = mer_esc($item['author'] ?? '');
                $role     = mer_esc($item['role'] ?? '');
                $initials = esc_html($item['initials'] ?? mb_substr($item['author'] ?? 'XX', 0, 2));
                $industry = mer_esc($item['industry'] ?? '');
            ?>
                <div class="test-card shrink-0 w-full bg-white border border-slate-200 rounded-[2rem] p-5 sm:p-6 lg:p-8 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-1 mb-6">
                            <?php for ($s = 0; $s < 5; $s++) : ?>
                                <i data-lucide="star" class="w-5 h-5 fill-[#00d084] text-[#00d084] stroke-none"></i>
                            <?php endfor; ?>
                        </div>
                        <p class="text-lg italic font-light text-slate-600 leading-relaxed mb-5">
                            &ldquo;<?php echo $quote; ?>&rdquo;
                        </p>
                    </div>
                    <div class="flex items-start gap-3 pt-4 border-t border-slate-100">
                        <i data-lucide="building-2" class="w-10 h-10 text-slate-300 flex-shrink-0"></i>
                        <div class="space-y-0.5">
                            <p class="text-slate-900 font-semibold text-sm"><?php echo $author; ?></p>
                            <?php if ($role) : ?>
                                <p class="text-slate-500 text-xs"><?php echo $role; ?></p>
                            <?php endif; ?>
                            <?php if ($industry) : ?>
                                <p class="text-slate-500 text-xs"><?php echo $industry; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        </div>

        <?php if (count($items) > 1) : ?>
            <div class="mt-6">
                <div class="flex items-center gap-4 sm:justify-center">
                    <button id="test-prev-m" aria-label="<?php esc_attr_e('Poprzednia opinia', 'meritoros'); ?>" class="sm:hidden w-12 h-12 rounded-full bg-white border border-slate-200 flex items-center justify-center shadow-sm hover:bg-slate-50 transition-colors" style="opacity:0.35;pointer-events:none">
                        <i data-lucide="chevron-left" class="w-5 h-5 text-slate-700 stroke-[2]"></i>
                    </button>
                    <div class="flex flex-1 sm:flex-none items-center justify-center gap-2" id="test-dots">
                        <?php foreach ($items as $idx => $item) : ?>
                            <button class="test-dot rounded-full transition-all duration-300 <?php echo $idx === 0 ? 'w-6 h-2 bg-[#00d084]' : 'w-2 h-2 bg-slate-300'; ?>" data-i="<?php echo $idx; ?>"></button>
                        <?php endforeach; ?>
                    </div>
                    <button id="test-next-m" aria-label="<?php esc_attr_e('Następna opinia', 'meritoros'); ?>" class="sm:hidden w-12 h-12 rounded-full bg-[#00d084] flex items-center justify-center shadow-md hover:bg-[#00b872] transition-colors">
                        <i data-lucide="chevron-right" class="w-5 h-5 text-white stroke-[2]"></i>
                    </button>
                </div>
            </div>
        <?php endif; ?>

        <!-- Stats bar -->
        <?php if (!empty($stats)) : ?>
            <div class="mt-8 pt-6 border-t border-slate-200 grid grid-cols-2 md:grid-cols-4 gap-6">
                <?php foreach ($stats as $stat) :
                    $val    = mer_esc($stat['value'] ?? '');
                    $slabel = mer_esc($stat['label'] ?? '');
                    $accent = !empty($stat['accent']);
                ?>
                    <div class="text-center">
                        <p class="text-5xl font-bold <?php echo $accent ? 'text-[#00d084]' : 'text-slate-900'; ?> mb-1">
                            <?php echo $val; ?>
                        </p>
                        <p class="text-slate-500 text-base font-medium"><?php echo $slabel; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php if (count($items) > 1) : ?>
<script>
(function () {
    var track    = document.getElementById('test-track');
    var prevBtn  = document.getElementById('test-prev');
    var nextBtn  = document.getElementById('test-next');
    var prevBtnM = document.getElementById('test-prev-m');
    var nextBtnM = document.getElementById('test-next-m');
    var dots     = document.querySelectorAll('#test-dots .test-dot');
    if (!track) return;
    var cards   = track.querySelectorAll('.test-card');
    var total   = cards.length;
    var current = 0;
    var GAP     = 16;

    function setCardWidths() {
        var cw      = track.parentElement.offsetWidth;
        var perView = window.innerWidth >= 1024 ? 3 : (window.innerWidth >= 768 ? 2 : 1);
        var w       = Math.floor((cw - GAP * (perView - 1)) / perView);
        cards.forEach(function (c) {
            c.style.width    = w + 'px';
            c.style.minWidth = w + 'px';
        });
    }

    function getMax() {
        var cardWidth = cards[0].offsetWidth + GAP;
        var visible   = Math.max(1, Math.round((track.parentElement.offsetWidth + GAP) / cardWidth));
        return Math.max(0, total - visible);
    }

    function updateDots(max) {
        dots.forEach(function (d, i) {
            d.className = 'test-dot rounded-full transition-all duration-300 ' + (i === current ? 'w-6 h-2 bg-[#00d084]' : 'w-2 h-2 bg-slate-300');
            d.style.display = i <= max ? '' : 'none';
        });
    }

    function update() {
        var max = getMax();
        if (current > max) current = max;
        var cardWidth = cards[0].offsetWidth + GAP;
        track.style.transform = 'translateX(-' + (current * cardWidth) + 'px)';
        [prevBtn, prevBtnM].forEach(function (b) { if (b) { b.style.opacity = current === 0  ? '0.35' : '1'; b.style.pointerEvents = current === 0  ? 'none' : ''; } });
        [nextBtn, nextBtnM].forEach(function (b) { if (b) { b.style.opacity = current >= max ? '0.35' : '1'; b.style.pointerEvents = current >= max ? 'none' : ''; } });
        updateDots(max);
    }

    function next() { if (current < getMax()) { current++; update(); } }
    function prev() { if (current > 0)        { current--; update(); } }

    [nextBtn, nextBtnM].forEach(function (b) { if (b) b.addEventListener('click', next); });
    [prevBtn, prevBtnM].forEach(function (b) { if (b) b.addEventListener('click', prev); });
    dots.forEach(function (d) {
        d.addEventListener('click', function () { current = parseInt(d.dataset.i); update(); });
    });

    var touchX = null;
    track.addEventListener('touchstart', function (e) { touchX = e.touches[0].clientX; }, { passive: true });
    track.addEventListener('touchend', function (e) {
        if (touchX === null) return;
        var dx = e.changedTouches[0].clientX - touchX;
        if (Math.abs(dx) > 50) { dx < 0 ? next() : prev(); }
        touchX = null;
    });

    window.addEventListener('resize', function () { current = 0; setCardWidths(); update(); });
    (function tryInit() {
        if (track.parentElement.offsetWidth > 0) { setCardWidths(); update(); }
        else { requestAnimationFrame(tryInit); }
    })();
})();
</script>
<?php endif; ?>
