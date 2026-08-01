<?php
$title     = mer_field('kp_oferta_title',    'Oferta rozwiązań kadrowych');
$subtitle  = mer_field('kp_oferta_subtitle', 'Przejmujemy całość lub wybrane obszary, które wymagają uporządkowania i stałego nadzoru.');
$btn1_text = mer_field('kp_oferta_btn1_text', 'Wyceń usługę');
$btn1_url  = mer_field('kp_oferta_btn1_url',  '#kalkulator');
$btn2_text = mer_field('kp_oferta_btn2_text', 'Sprawdź również rozwiązania księgowe');
$btn2_url  = mer_field('kp_oferta_btn2_url',  home_url('/uslugi-ksiegowe/'));

$items_raw = mer_field('kp_oferta_items', "Prowadzenie dokumentacji kadrowej\n\nNaliczanie wynagrodzeń i świadczeń\n\nObsługa umów o pracę i umów cywilnoprawnych\n\nRozliczenia z ZUS i instytucjami publicznymi\n\nSporządzanie deklaracji podatkowych\n\nKontrolowanie limitów urlopowych, terminów badań lekarskich, szkoleń BHP oraz wygasających umów\n\nReprezentowanie podczas kontroli i czynności sprawdzających\n\nZarządzanie programami PPK i PPE\n\nPlatforma pracownicza z dostępem do wniosków urlopowych i dokumentów online");
$items = array_values(array_filter(array_map('trim', preg_split('/(\r?\n){2,}/', $items_raw))));
?>

<section class="py-8 md:py-14 bg-white relative">
    <div class="hidden md:block absolute -right-40 top-1/2 -translate-y-1/2 w-[380px] h-[380px] rounded-full border-[50px] border-emerald-100 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 mb-3"><?php echo mer_esc($title); ?></h2>
        <p class="text-base text-slate-500 leading-relaxed mb-8 max-w-2xl"><?php echo nl2br(esc_html($subtitle)); ?></p>

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
                    <div class="flex items-start gap-4 p-4 md:block md:p-6<?php echo $border; ?> border-slate-200 hover:bg-slate-50 transition-colors">
                        <div class="w-8 h-8 rounded-full border border-emerald-200 flex items-center justify-center shrink-0 md:mb-4">
                            <i data-lucide="check" stroke-width="2" class="w-4 h-4 text-[#2d8650]"></i>
                        </div>
                        <h3 class="text-sm md:text-base font-bold text-slate-900 leading-snug"><?php echo mer_esc($item); ?></h3>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="flex flex-wrap justify-center gap-4">
            <a href="<?php echo esc_url($btn1_url); ?>" class="px-7 py-3.5 rounded-full border border-slate-300 text-slate-700 text-base font-semibold hover:bg-slate-50 transition-colors">
                <?php echo mer_esc($btn1_text); ?>
            </a>
            <a href="<?php echo esc_url($btn2_url); ?>" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-slate-900 text-white text-base font-semibold hover:bg-slate-700 transition-colors">
                <?php echo mer_esc($btn2_text); ?>
                <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
            </a>
        </div>
    </div>
</section>
