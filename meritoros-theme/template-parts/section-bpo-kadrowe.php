<?php
$title   = __( mer_field('bpo_kad_title_suffix', 'Rozwiązania Kadrowe'), 'meritoros' );
$text    = __( mer_field('bpo_kad_text', 'Zapewniamy wsparcie w zakresie obsługi kadrowej i naliczania wynagrodzeń. Nasze kompleksowe rozwiązania w obszarze HR i payroll, dedykowane dla dużych przedsiębiorstw, zapewniają nie tylko zgodność z przepisami prawa, ale także optymalizację procesów kadrowych. Współpracujemy zarówno z firmami, które nie posiadają własnego działu HR, jak i z organizacjami potrzebującymi wsparcia przy wybranych procesach.'), 'meritoros' );
$btn1_t  = __( mer_field('bpo_kad_btn1_text', 'Dlaczego BPO z nami'), 'meritoros' );
$btn1_u  = mer_field('bpo_kad_btn1_url',  home_url('/bpo/#bpo-dlaczego'));
$btn2_t  = __( mer_field('bpo_kad_btn2_text', 'Sprawdź rozwiązania kadrowe'), 'meritoros' );
$btn2_u  = mer_field('bpo_kad_btn2_url',  home_url('/kadry-i-place/'));

$items_raw = __( mer_field('bpo_kad_items', "Prowadzenie dokumentacji kadrowej\n\nNaliczanie wynagrodzeń i świadczeń\n\nObsługa umów o pracę i umów cywilnoprawnych\n\nRozliczenia z ZUS i instytucjami publicznymi\n\nSporządzanie deklaracji podatkowych\n\nKontrolowanie limitów urlopowych, terminów badań lekarskich, szkoleń BHP oraz wygasających umów\n\nReprezentowanie podczas kontroli i czynności sprawdzających\n\nZarządzanie programami PPK i PPE\n\nPlatforma pracownicza z dostępem do wniosków urlopowych i dokumentów online"), 'meritoros' );
$items = array_values(array_filter(array_map('trim', preg_split('/(\r?\n){2,}/', $items_raw))));
?>

<section id="bpo-kadrowe" class="py-12 md:py-24 bg-white relative overflow-hidden">
    <div class="absolute top-1/4 right-0 w-[600px] h-[600px] bg-emerald-200/40 rounded-full blur-[100px] translate-x-1/4 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight mb-6">
            BPO: <span class="text-[#00d084]"><?php echo mer_esc($title); ?></span>
        </h2>
        <p class="text-base md:text-lg text-slate-500 mb-8 md:mb-16 max-w-4xl leading-relaxed">
            <?php echo mer_esc($text); ?>
        </p>

        <div class="rounded-2xl border border-slate-200 overflow-hidden mb-12">
            <div class="grid md:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($items as $idx => $item) :
                    $count    = count($items);
                    $col      = $idx % 3;
                    $row      = intdiv($idx, 3);
                    $rows     = intdiv($count - 1, 3);
                    $last_row = ($row === $rows);
                    $border   = $last_row ? '' : ' border-b';
                    if ($col === 0) $border .= ' md:border-r';
                    if ($col === 1) $border .= ' lg:border-r';
                ?>
                    <div class="flex items-start gap-4 p-5 md:block md:p-8<?php echo $border; ?> border-slate-200">
                        <div class="w-8 h-8 md:w-10 md:h-10 rounded-full border border-emerald-200 flex items-center justify-center shrink-0 md:mb-6">
                            <i data-lucide="check" stroke-width="2" class="w-4 h-4 md:w-5 md:h-5 text-[#00d084]"></i>
                        </div>
                        <h3 class="text-sm md:text-xl font-bold text-slate-900 leading-snug"><?php echo mer_esc($item); ?></h3>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row justify-center gap-3">
            <a href="<?php echo esc_url($btn1_u); ?>" class="mer-btn mer-btn--secondary text-center px-8 py-3 rounded-full border border-slate-300 text-slate-700 text-base font-medium hover:bg-slate-50 transition-colors">
                <?php echo mer_esc($btn1_t); ?>
            </a>
            <a href="<?php echo esc_url($btn2_u); ?>" class="mer-btn mer-btn--secondary text-center px-8 py-3 rounded-full border border-slate-300 text-slate-700 text-base font-medium hover:bg-slate-50 transition-colors">
                <?php echo mer_esc($btn2_t); ?>
            </a>
        </div>
    </div>
</section>
