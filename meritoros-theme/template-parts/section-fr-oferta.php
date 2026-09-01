<?php
$title    = __( mer_field('fr_oferta_title',    'Poznaj naszą ofertę'), 'meritoros' );
$subtitle = __( mer_field('fr_oferta_subtitle', 'Zapewniamy kompleksową obsługę księgową i podatkową, która porządkuje finanse fundacji i daje poczucie bezpieczeństwa jej fundatorom.'), 'meritoros' );
$btn_text = __( mer_field('fr_oferta_btn_text', 'Wyceń usługę'), 'meritoros' );
$btn_url  = mer_field('fr_oferta_btn_url',  home_url('/kontakt/'));

$items_raw = __( mer_field('fr_oferta_items', "Prowadzenie ksiąg rachunkowych\n\nRozliczanie i składanie deklaracji podatkowych\n\nPrzygotowywanie sprawozdań finansowych\n\nAsystowanie podczas badania sprawozdania finansowego oraz kontroli urzędów\n\nRaportowanie na cele zarządcze\n\nSporządzanie polityki rachunkowości"), 'meritoros' );
$items = array_values(array_filter(array_map('trim', preg_split('/(\r?\n){2,}/', $items_raw))));
?>

<section class="py-8 md:py-14 bg-white relative">

    <div class="hidden md:block absolute -right-40 top-1/2 -translate-y-1/2 w-[400px] h-[400px] rounded-full border-[50px] border-emerald-100 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 mb-3"><?php echo mer_esc($title); ?></h2>
        <p class="text-base text-slate-500 leading-relaxed mb-8"><?php echo nl2br(esc_html($subtitle)); ?></p>

        <div class="rounded-2xl border border-slate-200 overflow-hidden mb-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($items as $idx => $item) :
                    $count = count($items);
                    $col   = $idx % 3;
                    $row   = intdiv($idx, 3);
                    $rows  = intdiv($count - 1, 3);
                    $last_row = ($row === $rows);
                    $border  = '';
                    $border .= $last_row ? '' : ' border-b';
                    if ($col === 0) $border .= ' md:border-r';
                    if ($col === 1) $border .= ' lg:border-r';
                ?>
                    <div class="flex items-start gap-4 p-4 md:block md:p-6<?php echo $border; ?> border-slate-200">
                        <div class="w-8 h-8 rounded-full border border-emerald-200 flex items-center justify-center shrink-0 md:mb-4">
                            <i data-lucide="check" stroke-width="2" class="w-4 h-4 md:w-5 md:h-5 text-[#00d084]"></i>
                        </div>
                        <h3 class="text-sm md:text-base font-bold text-slate-900 leading-snug"><?php echo mer_esc($item); ?></h3>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="flex justify-center">
            <a href="<?php echo esc_url($btn_url); ?>" class="mer-btn mer-btn--secondary px-8 py-3.5 rounded-full border border-slate-300 text-slate-700 text-base font-medium hover:bg-slate-50 transition-colors">
                <?php echo mer_esc($btn_text); ?>
            </a>
        </div>
    </div>
</section>
