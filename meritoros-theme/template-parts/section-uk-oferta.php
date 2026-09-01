<?php
$title        = __( mer_field('uk_oferta_title',    'Oferta rozwiązań księgowych'), 'meritoros' );
$subtitle     = __( mer_field('uk_oferta_subtitle', "Obsługujemy firmy na różnych formach rozliczeń zarówno w pełnej księgowości (spółki),\njak i w uproszczonych formach ewidencji (np. KPiR)"), 'meritoros' );
$sub_note     = __( mer_field('uk_oferta_sub_note', 'Poniżej pokazujemy przykładowy zakres działań. Jeśli potrzebujesz innej usługi chętnie porozmawiamy.'), 'meritoros' );
$btn1_text    = __( mer_field('uk_oferta_btn1_text',   'Sprawdź również rozwiązania kadrowe'), 'meritoros' );
$btn1_url     = mer_field('uk_oferta_btn1_url',    home_url('/kadry-i-place/'));
$btn2_text    = __( mer_field('uk_oferta_btn2_text',   'Oszacuj wstępną wycenę'), 'meritoros' );
$btn2_url     = mer_field('uk_oferta_btn2_url',    home_url('/kontakt/'));

$items_raw = mer_field('uk_oferta_items', "Prowadzenie ksiąg rachunkowych\n\nObliczanie podatków i składanie deklaracji podatkowych\n\nBieżące rozliczanie wyciągów i kontrolowanie rozrachunków\n\nRaportowanie zarządcze i sprawozdawcze\n\nRaportowanie do instytucji publicznych\n\nSporządzanie sprawozdań finansowych oraz deklaracji rocznych\n\nReprezentowanie podczas kontroli i czynności sprawdzających\n\nObsługa niestandardowych rozliczeń\n\nAsystowanie i wsparcie podczas audytu");
$items = array_values(array_filter(array_map(function($s) { return __($s, 'meritoros'); }, array_map('trim', preg_split('/(\r?\n){2,}/', $items_raw)))));
?>

<section class="py-8 md:py-14 bg-white relative">
    <div class="hidden md:block absolute -right-40 top-1/2 -translate-y-1/2 w-[380px] h-[380px] rounded-full border-[50px] border-emerald-100 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 mb-4"><?php echo mer_esc($title); ?></h2>
        <p class="text-base text-slate-800 font-medium leading-relaxed mb-2 max-w-3xl"><?php echo nl2br(esc_html($subtitle)); ?></p>
        <p class="text-sm text-slate-600 mb-8"><?php echo mer_esc($sub_note); ?></p>

        <div class="rounded-2xl border border-slate-200 overflow-hidden mb-8">
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
                    <div class="flex items-start gap-4 p-4 md:block md:p-6<?php echo $border; ?> border-slate-200">
                        <div class="w-8 h-8 rounded-full border border-emerald-200 flex items-center justify-center shrink-0 md:mb-4">
                            <i data-lucide="check" stroke-width="2" class="w-4 h-4 text-[#00d084]"></i>
                        </div>
                        <h3 class="text-sm md:text-base font-bold text-slate-900 leading-snug"><?php echo mer_esc($item); ?></h3>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="flex flex-wrap justify-center gap-4">
            <a href="<?php echo esc_url($btn1_url); ?>" class="mer-btn mer-btn--secondary px-7 py-3.5 rounded-full border border-slate-300 text-slate-700 text-base font-semibold hover:bg-slate-50 transition-colors">
                <?php echo mer_esc($btn1_text); ?>
            </a>
            <a href="#kalkulator"
               class="mer-btn mer-btn--primary px-7 py-3.5 rounded-full bg-[#00d084] text-white text-base font-semibold hover:bg-[#00b872] transition-colors">
                <?php echo mer_esc($btn2_text); ?>
            </a>
        </div>
    </div>
</section>
