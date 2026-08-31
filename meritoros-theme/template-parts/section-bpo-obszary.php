<?php
$title = mer_field('bpo_areas_title', __('Obszar współpracy', 'meritoros'));

$area_defaults = [
    ['title' => __('Rozwiązania kadrowe', 'meritoros'),   'desc' => __('Kompleksowa obsługa kadrowo-płacowa – od umów i list płac po rozliczenia z ZUS i US, z pełną zastępowalnością zespołu.', 'meritoros')],
    ['title' => __('Rozwiązania księgowe', 'meritoros'),  'desc' => __('Pełna księgowość, raportowanie zarządcze i sprawozdawcze – terminowo i zgodnie ze standardami, bez zakłóceń operacyjnych.', 'meritoros')],
    ['title' => __('Transformacja cyfrowa', 'meritoros'), 'desc' => __('Wdrożenie RPA, e-teczek i elektronicznego obiegu dokumentów – automatyzujemy procesy, żeby organizacja działała sprawniej.', 'meritoros')],
];

$scroll_targets = ['bpo-kadrowe', 'bpo-ksiegowe', 'bpo-cyfrowa'];

$cards = [];
for ($i = 1; $i <= 3; $i++) {
    $img = get_field("bpo_area{$i}_image");
    $cards[] = [
        'title'  => mer_field("bpo_area{$i}_title", $area_defaults[$i - 1]['title']),
        'desc'   => mer_field("bpo_area{$i}_desc",  $area_defaults[$i - 1]['desc']),
        'image'  => is_array($img) ? $img : null,
        'target' => $scroll_targets[$i - 1],
    ];
}
?>

<section class="py-16 md:py-24 bg-emerald-50 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-white/60 rounded-full blur-[90px] -translate-x-1/4 -translate-y-1/4 pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-emerald-200/50 rounded-full blur-[100px] translate-x-1/4 translate-y-1/4 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 w-full relative z-10">
        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-center mb-8 md:mb-16"><?php echo mer_esc($title); ?></h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
            <?php foreach ($cards as $card) :
                $img_url = $card['image'] ? esc_url($card['image']['url']) : '';
                $img_alt = $card['image'] ? esc_attr($card['image']['alt'] ?: $card['title']) : esc_attr($card['title']);
            ?>
                <button
                    type="button"
                    onclick="document.getElementById('<?php echo esc_js($card['target']); ?>').scrollIntoView({behavior:'smooth', block:'start'})"
                    class="group relative aspect-[4/3] rounded-2xl overflow-hidden bg-slate-700 shadow-lg hover:shadow-xl transition-shadow duration-300 cursor-pointer text-left w-full"
                >
                    <?php if ($img_url) : ?>
                        <img src="<?php echo $img_url; ?>" alt="<?php echo $img_alt; ?>"
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                    <?php endif; ?>

                    <div class="absolute inset-0 pointer-events-none" style="background: linear-gradient(to top, rgba(15,23,42,0.85) 0%, rgba(15,23,42,0.25) 60%, transparent 100%);"></div>

                    <div class="absolute inset-0 flex flex-col items-center justify-end p-6 text-center">
                        <h3 class="text-lg md:text-xl font-bold tracking-tight text-white mb-3">
                            <?php echo mer_esc($card['title']); ?>
                        </h3>
                        <span class="mer-btn mer-btn--ghost inline-flex items-center gap-1.5 text-xs font-semibold uppercase tracking-wider text-white rounded-full px-4 py-1.5 transition-colors duration-200 group-hover:bg-white/30" style="background: rgba(255,255,255,0.18); border: 1px solid rgba(255,255,255,0.35); backdrop-filter: blur(6px);">
                            Sprawdź
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><polyline points="19 12 12 19 5 12"/></svg>
                        </span>
                    </div>
                </button>
            <?php endforeach; ?>
        </div>
    </div>
</section>
