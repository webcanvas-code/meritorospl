<?php
$karty = [
    [
        'icon'  => 'clock',
        'title' => __('Work-life balance', 'meritoros'),
        'items' => [
            __('Elastyczne godziny rozpoczęcia pracy (7:00–10:00)', 'meritoros'),
            __('Zadaniowy system organizacji pracy', 'meritoros'),
            __('Możliwość wyjść prywatnych w ciągu dnia', 'meritoros'),
        ],
    ],
    [
        'icon'  => 'graduation-cap',
        'title' => __('Rozwój zawodowy', 'meritoros'),
        'items' => [
            __('Szkolenia, webinary i dostęp do materiałów branżowych', 'meritoros'),
            __('Lekcje języka angielskiego w godzinach pracy', 'meritoros'),
            __('Grupy dopasowane do poziomu zaawansowania', 'meritoros'),
        ],
    ],
    [
        'icon'  => 'heart-pulse',
        'title' => __('Pakiet benefitów', 'meritoros'),
        'items' => [
            __('Prywatna opieka medyczna Allianz', 'meritoros'),
            __('Karta Multisport', 'meritoros'),
            __('Możliwość objęcia benefitami członków rodziny', 'meritoros'),
            __('Wolontariat pracowniczy i integracje zespołowe', 'meritoros'),
        ],
    ],
    [
        'icon'  => 'sun',
        'title' => __('Dodatkowe urlopy', 'meritoros'),
        'items' => [
            __('5 dodatkowych dni urlopu po okresie próbnym', 'meritoros'),
            __('15 dni po 3 latach stażu pracy', 'meritoros'),
            __('Wczasy pod gruszą', 'meritoros'),
        ],
    ],
];
?>

<section class="py-16 md:py-24 bg-slate-50 relative overflow-hidden">
    <div class="absolute -left-24 bottom-0 w-[300px] h-[300px] rounded-full border-[40px] border-[#00d084]/8 pointer-events-none"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">

        <div class="mb-12">
            <h2 class="text-pretty text-4xl md:text-5xl font-bold text-slate-900 mb-3"><?php esc_html_e('Co oferujemy', 'meritoros'); ?></h2>
            <p class="text-slate-500 text-lg max-w-xl"><?php esc_html_e('Dołączając do Meritoros, zyskujesz więcej niż tylko pracę.', 'meritoros'); ?></p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($karty as $karta) : ?>
            <div class="bg-white rounded-2xl p-8 border border-slate-200 flex flex-col gap-5">
                <span class="w-12 h-12 rounded-xl bg-[#00d084]/10 flex items-center justify-center flex-shrink-0">
                    <i data-lucide="<?php echo esc_attr($karta['icon']); ?>" class="w-6 h-6 text-[#00d084]"></i>
                </span>
                <h3 class="text-xl font-bold text-slate-900"><?php echo mer_esc($karta['title']); ?></h3>
                <ul class="space-y-2.5 mt-auto">
                    <?php foreach ($karta['items'] as $item) : ?>
                    <li class="flex items-start gap-2 text-lg text-slate-600 leading-snug">
                        <i data-lucide="check" class="w-4 h-4 text-[#00d084] flex-shrink-0 mt-0.5"></i>
                        <?php echo mer_esc($item); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
