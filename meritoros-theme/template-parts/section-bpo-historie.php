<?php
defined('ABSPATH') || exit;

$_bpo_id = apply_filters('wpml_object_id', get_the_ID(), 'page', true);

$section_title = __( get_field('bpo_hist_title', $_bpo_id) ?: 'Jak wyglada BPO w praktyce?', 'meritoros' );
$btn_text      = __( get_field('bpo_hist_btn_text', $_bpo_id) ?: 'Poznaj wiecej historii', 'meritoros' );
$btn_url       = get_field('bpo_hist_btn_url', $_bpo_id) ?: home_url('/historie-klientow/');

$slide_defaults = [
    1 => [
        'logo'         => null,
        'logo_alt'     => 'Dentity',
        'industries'   => "Stomatologia\nOchrona zdrowia",
        'scope'        => 'Pelna obsluga BPO dla sieci gabinetow stomatologicznych',
        'text'         => 'Dynamicznie rozwijajaca sie siec gabinetow Dentity potrzebowala partnera, ktory przejmie caly obszar finansowo-ksiegowy i kadrowy, odciazajac zarzad od administracji.',
        'points'       => "Ksiegowosc pelna i kadrowo-placowa dla kilku podmiotow\nMiesieczna analiza rentownosci na poziomie gabinetu\nObsluga rozliczen z NFZ i podmiotami powiazanymi",
        'stat1_val'    => '',
        'stat1_label'  => '',
        'stat2_val'    => '',
        'stat2_label'  => '',
        'stat3_val'    => '',
        'stat3_label'  => '',
        'quote'        => '',
        'quote_author' => '',
        'image'        => null,
        'url'          => '#',
    ],
    2 => [
        'logo'         => null,
        'logo_alt'     => '',
        'industries'   => '',
        'scope'        => '',
        'text'         => '',
        'points'       => '',
        'stat1_val'    => '',
        'stat1_label'  => '',
        'stat2_val'    => '',
        'stat2_label'  => '',
        'stat3_val'    => '',
        'stat3_label'  => '',
        'quote'        => '',
        'quote_author' => '',
        'image'        => null,
        'url'          => '#',
    ],
];

$slides = [];
for ($i = 1; $i <= 2; $i++) {
    $s   = get_field("bpo_hist_{$i}", $_bpo_id);
    $def = $slide_defaults[$i];

    $heading = trim(is_array($s) && !empty($s['scope']) ? $s['scope'] : $def['scope']);
    if ($i > 1 && $heading === '') continue; // slajd 2+ ukryj jesli brak naglowka

    $logo_img  = is_array($s) && !empty($s['logo'])  ? $s['logo']  : $def['logo'];
    $slide_img = is_array($s) && !empty($s['image']) ? $s['image'] : $def['image'];

    $industries_raw = is_array($s) && isset($s['industries']) && $s['industries'] !== ''
        ? $s['industries'] : $def['industries'];
    $industries = array_values(array_filter(array_map('trim', explode("\n", $industries_raw))));

    $points_raw = is_array($s) && isset($s['points']) && $s['points'] !== ''
        ? $s['points'] : $def['points'];
    $points = array_values(array_filter(array_map('trim', explode("\n", $points_raw))));

    $stats = [];
    foreach ([1, 2, 3] as $n) {
        $val   = trim(is_array($s) && !empty($s["stat{$n}_val"])   ? $s["stat{$n}_val"]   : $def["stat{$n}_val"]);
        $label = trim(is_array($s) && !empty($s["stat{$n}_label"]) ? $s["stat{$n}_label"] : $def["stat{$n}_label"]);
        if ($val !== '') {
            $stats[] = ['val' => $val, 'label' => $label];
        }
    }

    $quote        = trim(is_array($s) && !empty($s['quote'])        ? $s['quote']        : $def['quote']);
    $quote_author = trim(is_array($s) && !empty($s['quote_author']) ? $s['quote_author'] : $def['quote_author']);

    $slides[] = [
        'logo'         => $logo_img,
        'logo_alt'     => is_array($logo_img) ? esc_attr($logo_img['alt'] ?: $def['logo_alt']) : esc_attr($def['logo_alt']),
        'industries'   => $industries,
        'heading'      => __($heading, 'meritoros'),
        'text'         => __( is_array($s) && !empty($s['text']) ? $s['text'] : $def['text'], 'meritoros' ),
        'points'       => $points,
        'stats'        => $stats,
        'quote'        => $quote,
        'quote_author' => $quote_author,
        'image'        => $slide_img,
        'url'          => is_array($s) && !empty($s['url']) ? $s['url'] : $def['url'],
        'btn_text'     => $btn_text,
    ];
}

$total = count($slides);
if ($total === 0) return;
?>

<section id="bpo-historie" class="py-16 md:py-24 bg-white border-t border-slate-100">
    <div class="max-w-6xl mx-auto px-6">

        <!-- Naglowek sekcji -->
        <div class="flex items-end justify-between gap-4 mb-10">
            <div>
                <p class="text-[#00d084] uppercase tracking-widest text-sm font-bold mb-3">
                    <?php esc_html_e('Historie klientow BPO', 'meritoros'); ?>
                </p>
                <h2 class="text-pretty text-3xl sm:text-4xl font-bold tracking-tight text-slate-900">
                    <?php echo mer_esc($section_title); ?>
                </h2>
            </div>
            <?php if ($total > 1) : ?>
            <div class="hidden sm:flex items-center gap-2 shrink-0">
                <button id="bpoh-prev" type="button"
                        class="w-11 h-11 rounded-full border border-slate-200 bg-white flex items-center justify-center text-slate-500 hover:bg-slate-50 transition-colors"
                        aria-label="<?php esc_attr_e('Poprzednia historia', 'meritoros'); ?>">
                    <i data-lucide="chevron-left" class="w-5 h-5 stroke-[2]"></i>
                </button>
                <button id="bpoh-next" type="button"
                        class="w-11 h-11 rounded-full bg-[#00d084] flex items-center justify-center text-white hover:bg-[#00b872] transition-colors"
                        aria-label="<?php esc_attr_e('Nastepna historia', 'meritoros'); ?>">
                    <i data-lucide="chevron-right" class="w-5 h-5 stroke-[2]"></i>
                </button>
            </div>
            <?php endif; ?>
        </div>

        <!-- Slider -->
        <div class="overflow-hidden rounded-3xl bg-white border border-slate-100 shadow-sm">
            <div id="bpoh-track" class="flex transition-transform duration-500 ease-out will-change-transform">

                <?php foreach ($slides as $slide) :
                    $logo_url  = is_array($slide['logo']) ? esc_url($slide['logo']['url']) : '';
                    $img_url   = is_array($slide['image']) ? esc_url($slide['image']['url']) : '';
                    $img_alt   = is_array($slide['image']) ? esc_attr($slide['image']['alt'] ?: $slide['logo_alt']) : esc_attr($slide['logo_alt']);
                    $has_stats = !empty($slide['stats']);
                ?>
                <article class="min-w-full grid grid-cols-1 lg:grid-cols-2">

                    <!-- Lewa: tresc -->
                    <div class="flex flex-col justify-center p-8 sm:p-10 xl:p-12 gap-5">

                        <!-- Logo lub nazwa -->
                        <?php if ($logo_url) : ?>
                            <img src="<?php echo $logo_url; ?>" alt="<?php echo $slide['logo_alt']; ?>"
                                 class="h-8 w-auto object-contain object-left" loading="lazy">
                        <?php elseif ($slide['logo_alt']) : ?>
                            <p class="text-xl font-black text-slate-900"><?php echo esc_html($slide['logo_alt']); ?></p>
                        <?php endif; ?>

                        <!-- Branze -->
                        <?php if (!empty($slide['industries'])) : ?>
                        <div class="flex flex-wrap gap-2">
                            <?php foreach ($slide['industries'] as $ind) : ?>
                                <span class="inline-flex rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600">
                                    <?php echo mer_esc($ind); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>

                        <!-- Naglowek + opis w ramce -->
                        <div class="rounded-2xl bg-slate-50 p-5">
                            <h3 class="text-lg sm:text-xl font-bold text-slate-900 leading-snug mb-2">
                                <?php echo mer_esc($slide['heading']); ?>
                            </h3>
                            <?php if ($slide['text']) : ?>
                            <p class="text-sm text-slate-600 leading-relaxed">
                                <?php echo mer_esc($slide['text']); ?>
                            </p>
                            <?php endif; ?>
                        </div>

                        <!-- Punkty -->
                        <?php if (!empty($slide['points'])) : ?>
                        <ul class="space-y-2.5">
                            <?php foreach ($slide['points'] as $point) : ?>
                            <li class="flex items-start gap-3">
                                <span class="mt-0.5 w-5 h-5 rounded-full bg-[#00d084]/15 flex items-center justify-center shrink-0">
                                    <i data-lucide="check" class="w-3 h-3 text-[#00d084]" stroke-width="3"></i>
                                </span>
                                <span class="text-sm text-slate-700 leading-relaxed"><?php echo mer_esc($point); ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

                        <!-- Statystyki (opcjonalne) -->
                        <?php if ($has_stats) : ?>
                        <div class="grid grid-cols-<?php echo count($slide['stats']); ?> gap-3">
                            <?php foreach ($slide['stats'] as $stat) : ?>
                            <div class="rounded-xl bg-slate-50 p-3 text-center">
                                <p class="text-2xl font-black text-[#00d084]"><?php echo esc_html($stat['val']); ?></p>
                                <?php if ($stat['label']) : ?>
                                <p class="text-[11px] text-slate-500 mt-0.5 leading-tight"><?php echo esc_html($stat['label']); ?></p>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>

                        <!-- Cytat (opcjonalny) -->
                        <?php if ($slide['quote']) : ?>
                        <blockquote class="border-l-4 border-[#00d084] pl-4">
                            <p class="text-sm text-slate-700 italic leading-relaxed">"<?php echo mer_esc($slide['quote']); ?>"</p>
                            <?php if ($slide['quote_author']) : ?>
                            <footer class="mt-1.5 text-xs text-slate-400 font-semibold"><?php echo esc_html($slide['quote_author']); ?></footer>
                            <?php endif; ?>
                        </blockquote>
                        <?php endif; ?>

                        <!-- CTA -->
                        <div class="pt-1">
                            <a href="<?php echo esc_url($slide['url']); ?>"
                               class="mer-btn mer-btn--white inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:border-slate-300 hover:bg-slate-50 transition-colors">
                                <?php echo mer_esc($slide['btn_text']); ?>
                                <i data-lucide="arrow-right" class="w-4 h-4 stroke-[2]"></i>
                            </a>
                        </div>

                    </div>

                    <!-- Prawa: zdjecie -->
                    <div class="p-6 lg:p-8 flex items-center order-first lg:order-last">
                        <div class="w-full aspect-[4/3] rounded-2xl overflow-hidden bg-slate-100 relative">
                            <?php if ($img_url) : ?>
                                <img src="<?php echo $img_url; ?>" alt="<?php echo $img_alt; ?>"
                                     class="absolute inset-0 w-full h-full object-cover"
                                     loading="lazy">
                            <?php else : ?>
                                <div class="absolute inset-0 flex items-center justify-center bg-slate-100">
                                    <i data-lucide="image" class="w-12 h-12 text-slate-300"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </article>
                <?php endforeach; ?>

            </div>
        </div>

        <!-- Nawigacja kropki (tylko gdy >1 slajd) -->
        <?php if ($total > 1) : ?>
        <div class="mt-6 flex items-center justify-between gap-4">
            <div id="bpoh-dots" class="flex items-center gap-2">
                <?php for ($i = 0; $i < $total; $i++) : ?>
                <button type="button" data-i="<?php echo $i; ?>"
                        class="rounded-full transition-all duration-300 <?php echo $i === 0 ? 'w-6 h-2 bg-[#00d084]' : 'w-2 h-2 bg-slate-300'; ?>"
                        aria-label="<?php printf(esc_attr__('Historia %d', 'meritoros'), $i + 1); ?>">
                </button>
                <?php endfor; ?>
            </div>
            <div class="sm:hidden flex items-center gap-2">
                <button id="bpoh-prev-m" type="button"
                        class="w-11 h-11 rounded-full border border-slate-200 bg-white flex items-center justify-center text-slate-500">
                    <i data-lucide="chevron-left" class="w-5 h-5 stroke-[2]"></i>
                </button>
                <button id="bpoh-next-m" type="button"
                        class="w-11 h-11 rounded-full bg-[#00d084] flex items-center justify-center text-white">
                    <i data-lucide="chevron-right" class="w-5 h-5 stroke-[2]"></i>
                </button>
            </div>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php if ($total > 1) : ?>
<script>
(function () {
    var track   = document.getElementById('bpoh-track');
    var dots    = document.querySelectorAll('#bpoh-dots button');
    var prevBtn = document.getElementById('bpoh-prev');
    var nextBtn = document.getElementById('bpoh-next');
    var prevBtnM = document.getElementById('bpoh-prev-m');
    var nextBtnM = document.getElementById('bpoh-next-m');
    var total   = <?php echo (int) $total; ?>;
    var current = 0;

    function updateDots() {
        dots.forEach(function (d, i) {
            d.className = 'rounded-full transition-all duration-300 ' + (i === current ? 'w-6 h-2 bg-[#00d084]' : 'w-2 h-2 bg-slate-300');
        });
    }

    function update() {
        track.style.transform = 'translateX(-' + (current * 100) + '%)';
        [prevBtn, prevBtnM].forEach(function (b) {
            if (!b) return;
            b.style.opacity      = current === 0          ? '0.35' : '1';
            b.style.pointerEvents = current === 0          ? 'none' : '';
        });
        [nextBtn, nextBtnM].forEach(function (b) {
            if (!b) return;
            b.style.opacity      = current >= total - 1 ? '0.35' : '1';
            b.style.pointerEvents = current >= total - 1 ? 'none' : '';
        });
        updateDots();
    }

    if (prevBtn) prevBtn.addEventListener('click', function () { if (current > 0) { current--; update(); } });
    if (nextBtn) nextBtn.addEventListener('click', function () { if (current < total - 1) { current++; update(); } });
    if (prevBtnM) prevBtnM.addEventListener('click', function () { if (current > 0) { current--; update(); } });
    if (nextBtnM) nextBtnM.addEventListener('click', function () { if (current < total - 1) { current++; update(); } });
    dots.forEach(function (d) {
        d.addEventListener('click', function () { current = parseInt(d.dataset.i); update(); });
    });

    update();
})();
</script>
<?php endif; ?>
