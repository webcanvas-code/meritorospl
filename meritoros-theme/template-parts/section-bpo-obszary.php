<?php
$title = mer_field('bpo_areas_title', 'Obszar współpracy');

$area_defaults = [
    ['title' => 'Rozwiązania kadrowe',   'desc' => 'Kompleksowa obsługa kadrowo-płacowa – od umów i list płac po rozliczenia z ZUS i US, z pełną zastępowalnością zespołu.'],
    ['title' => 'Rozwiązania księgowe',  'desc' => 'Pełna księgowość, raportowanie zarządcze i sprawozdawcze – terminowo i zgodnie ze standardami, bez zakłóceń operacyjnych.'],
    ['title' => 'Transformacja cyfrowa', 'desc' => 'Wdrożenie RPA, e-teczek i elektronicznego obiegu dokumentów – automatyzujemy procesy, żeby organizacja działała sprawniej.'],
];

$cards = [];
for ($i = 1; $i <= 3; $i++) {
    $img = get_field("bpo_area{$i}_image");
    $cards[] = [
        'title' => mer_field("bpo_area{$i}_title", $area_defaults[$i - 1]['title']),
        'desc'  => mer_field("bpo_area{$i}_desc",  $area_defaults[$i - 1]['desc']),
        'image' => is_array($img) ? $img : null,
    ];
}
?>

<section class="py-16 md:py-24 bg-emerald-50 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-white/60 rounded-full blur-[90px] -translate-x-1/4 -translate-y-1/4 pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-emerald-200/50 rounded-full blur-[100px] translate-x-1/4 translate-y-1/4 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 w-full relative z-10">
        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-center mb-8 md:mb-16"><?php echo mer_esc($title); ?></h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-8">
            <?php foreach ($cards as $card) :
                $img_url = $card['image'] ? esc_url($card['image']['url']) : '';
                $img_alt = $card['image'] ? esc_attr($card['image']['alt'] ?: $card['title']) : esc_attr($card['title']);
            ?>
                <div class="relative group rounded-2xl overflow-hidden aspect-[3/2] md:aspect-[4/5] bg-slate-700 shadow-xl cursor-default">

                    <?php if ($img_url) : ?>
                        <img src="<?php echo $img_url; ?>" alt="<?php echo $img_alt; ?>"
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                    <?php endif; ?>

                    <!-- Stan domyślny: ciemna nakładka + tytuł -->
                    <div class="absolute inset-0 pointer-events-none transition-opacity duration-300 group-hover:opacity-0" style="background: linear-gradient(to top, rgba(15,23,42,0.80) 0%, rgba(15,23,42,0.20) 60%, transparent 100%);"></div>
                    <div class="absolute bottom-0 left-0 w-full p-6 md:p-8 transition-opacity duration-200 group-hover:opacity-0">
                        <h3 class="text-xl md:text-2xl font-bold tracking-tight text-white text-center">
                            <?php echo mer_esc($card['title']); ?>
                        </h3>
                    </div>

                    <!-- Stan hover: zielona nakładka + tytuł + opis -->
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center p-8 text-center" style="background: rgba(72,194,121,0.88);">
                        <h3 class="text-xl md:text-2xl font-bold tracking-tight text-white mb-4">
                            <?php echo mer_esc($card['title']); ?>
                        </h3>
                        <p class="text-sm md:text-base leading-relaxed translate-y-3 group-hover:translate-y-0 transition-transform duration-300 delay-75" style="color: rgba(255,255,255,0.90);">
                            <?php echo mer_esc($card['desc']); ?>
                        </p>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
