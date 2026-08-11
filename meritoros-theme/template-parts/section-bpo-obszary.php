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
        'url'   => mer_field("bpo_area{$i}_url",   ''),
    ];
}
?>

<style>
/* Flip card — click toggle dla urządzeń dotykowych */
[data-flip-card].is-flipped > .mer-flip-inner {
    transform: rotateY(180deg);
}
</style>

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
                <!-- Outer: perspective + group dla hover -->
                <div class="aspect-[3/2] md:aspect-[4/5] [perspective:1000px] group cursor-pointer" data-flip-card>

                    <!-- Inner: obraca się -->
                    <div class="mer-flip-inner relative w-full h-full transition-transform duration-700 [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)]">

                        <!-- FRONT -->
                        <div class="absolute inset-0 [backface-visibility:hidden] rounded-2xl overflow-hidden bg-slate-700 shadow-xl">
                            <?php if ($img_url) : ?>
                                <img src="<?php echo $img_url; ?>" alt="<?php echo $img_alt; ?>"
                                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                            <?php endif; ?>

                            <div class="absolute inset-0 pointer-events-none" style="background: linear-gradient(to top, rgba(15,23,42,0.85) 0%, rgba(15,23,42,0.25) 60%, transparent 100%);"></div>

                            <div class="absolute inset-0 flex flex-col items-center justify-end p-6 md:p-8 text-center">
                                <h3 class="text-xl md:text-2xl font-bold tracking-tight text-white mb-4">
                                    <?php echo mer_esc($card['title']); ?>
                                </h3>
                                <!-- Indykator interaktywności -->
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold uppercase tracking-wider text-white rounded-full px-4 py-1.5" style="background: rgba(255,255,255,0.18); border: 1px solid rgba(255,255,255,0.35); backdrop-filter: blur(6px);">
                                    Sprawdź więcej
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </span>
                            </div>
                        </div>

                        <!-- BACK -->
                        <div class="absolute inset-0 [backface-visibility:hidden] [transform:rotateY(180deg)] rounded-2xl overflow-hidden shadow-xl flex flex-col items-center justify-center p-8 md:p-10 text-center" style="background: linear-gradient(135deg, #2d8650 0%, #1f6b3c 100%);">
                            <!-- Dekoracyjne kółko w tle -->
                            <div class="absolute top-0 right-0 w-48 h-48 rounded-full pointer-events-none" style="background: rgba(255,255,255,0.06); transform: translate(30%, -30%);"></div>
                            <div class="absolute bottom-0 left-0 w-40 h-40 rounded-full pointer-events-none" style="background: rgba(255,255,255,0.06); transform: translate(-30%, 30%);"></div>

                            <div class="relative z-10">
                                <h3 class="text-xl md:text-2xl font-bold tracking-tight text-white mb-4">
                                    <?php echo mer_esc($card['title']); ?>
                                </h3>
                                <p class="text-sm md:text-base leading-relaxed" style="color: rgba(255,255,255,0.88);">
                                    <?php echo mer_esc($card['desc']); ?>
                                </p>
                                <?php if (!empty($card['url'])) : ?>
                                <a href="<?php echo esc_url($card['url']); ?>"
                                   class="inline-flex items-center gap-2 mt-6 text-sm font-semibold text-white border border-white/40 rounded-full px-5 py-2 hover:bg-white/20 transition-colors duration-200"
                                   onclick="event.stopPropagation()">
                                    Przejdź
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
(function () {
    // Klik-toggle dla urządzeń dotykowych (brak hover)
    var isTouchDevice = window.matchMedia('(hover: none)').matches;
    if (!isTouchDevice) return;

    document.querySelectorAll('[data-flip-card]').forEach(function (card) {
        card.addEventListener('click', function () {
            this.classList.toggle('is-flipped');
        });
    });
}());
</script>
