<?php
$title    = mer_field('bpo_ks_title_suffix', 'Rozwiązania księgowe');
$text     = mer_field('bpo_ks_text', 'Outsourcing księgowości pozwala na znaczne obniżenie kosztów operacyjnych. Możemy dostarczyć wysokiej jakości usługi księgowe, eliminując potrzebę zatrudniania wewnętrznych ekspertów. Dzięki nowoczesnej technologii i dużej skali obsługiwanych przez nas operacji oszczędności sięgają 20-30% lub więcej w porównaniu do prowadzenia księgowości wewnętrznie. Dzięki digitalizacji obiegu dokumentów oraz sprawnym procesom możemy dostarczać raporty w czasie rzeczywistym.');
$btn_text = mer_field('bpo_ks_btn_text', 'Dlaczego BPO z nami');
$btn_url  = mer_field('bpo_ks_btn_url',  home_url('/bpo/#bpo-dlaczego'));

$items_raw = mer_field('bpo_ks_items', "Prowadzenie ksiąg rachunkowych\n\nObliczanie podatków i składanie deklaracji podatkowych\n\nBieżące rozliczanie wyciągów i kontrolowanie rozrachunków\n\nRaportowanie zarządcze i sprawozdawcze\n\nRaportowanie do instytucji publicznoprawnych, w tym NBP, GUS, INTRASTAT\n\nSporządzanie sprawozdań finansowych oraz deklaracji rocznych\n\nReprezentowanie podczas kontroli i czynności sprawdzających\n\nObsługa niestandardowych rozliczeń, w tym VAT OSS, CIT Estoński, SSE, VAT marża, itp.\n\nAsystowanie i wsparcie podczas audytu sprawozdania finansowego");
$items = array_values(array_filter(array_map('trim', preg_split('/(\r?\n){2,}/', $items_raw))));
?>

<section id="bpo-ksiegowe" class="py-12 md:py-24 bg-white relative overflow-hidden">
    <div class="absolute bottom-1/4 left-0 w-[500px] h-[500px] bg-emerald-200/40 rounded-full blur-[100px] -translate-x-1/4 pointer-events-none"></div>

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
                    <div class="flex items-start gap-4 p-5 md:block md:p-8<?php echo $border; ?> border-slate-200 hover:bg-slate-50 transition-colors">
                        <div class="w-8 h-8 md:w-10 md:h-10 rounded-full border border-emerald-200 flex items-center justify-center shrink-0 md:mb-6">
                            <i data-lucide="check" stroke-width="2" class="w-4 h-4 md:w-5 md:h-5 text-[#00d084]"></i>
                        </div>
                        <h3 class="text-sm md:text-xl font-bold text-slate-900 leading-snug"><?php echo mer_esc($item); ?></h3>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="flex justify-center">
            <a href="<?php echo esc_url($btn_url); ?>" class="px-8 py-3 rounded-full border border-slate-300 text-slate-700 text-base font-medium hover:bg-slate-50 transition-colors">
                <?php echo mer_esc($btn_text); ?>
            </a>
        </div>
    </div>
</section>
