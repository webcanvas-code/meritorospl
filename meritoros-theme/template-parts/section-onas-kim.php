<?php
$kim_title = __( mer_field('onas_kim_title', 'Kim jesteśmy'), 'meritoros' );
$kim_text  = __( mer_field('onas_kim_text', 'Od ponad 20 lat wspieramy firmy w prowadzeniu księgowości, kadr i procesów finansowych. Pracujemy w modelu zespołowym i procesowym, z jasno określoną odpowiedzialnością, standaryzacją działań i nadzorem nad jakością. Łączymy doświadczenie z nowoczesnymi technologiami oraz automatyzacją, aby zapewnić naszym klientom rzetelne dane, bezpieczeństwo operacyjne i stabilność, której potrzebują, by rozwijać swój biznes.'), 'meritoros' );

// 6 stats — each is a group with 'icon' and 'text'
$stat_defaults = [
    ['icon' => 'monitor',    'text' => __("Wewnętrzny\ndział IT i RPA",                    'meritoros')],
    ['icon' => 'globe',      'text' => __("Certyfikacja ISO\n9001 i ISO/IEC\n27001",        'meritoros')],
    ['icon' => 'database',   'text' => __("Ubezpieczenie\ndo 3 mln PLN",                   'meritoros')],
    ['icon' => 'user-check', 'text' => __("Ponad 170\nexpertów na\npokładzie",              'meritoros')],
    ['icon' => 'users',      'text' => __("Ponad 1200\nklientów",                           'meritoros')],
    ['icon' => 'map-pin',    'text' => __("7 oddziałów\nw Polsce oraz\noddziały wirtualne", 'meritoros')],
];

$stats = [];
for ($i = 1; $i <= 6; $i++) {
    $s = get_field("onas_stat_{$i}");
    if (!empty($s['icon']) || !empty($s['text'])) {
        $stats[] = [
            'icon' => !empty($s['icon']) ? $s['icon'] : $stat_defaults[$i - 1]['icon'],
            'text' => !empty($s['text']) ? __($s['text'], 'meritoros') : $stat_defaults[$i - 1]['text'],
        ];
    } else {
        $stats[] = $stat_defaults[$i - 1];
    }
}
?>

<section class="py-12 md:py-24 bg-white">
    <div class="max-w-[1400px] mx-auto px-6 lg:px-12">

        <div class="grid lg:grid-cols-2 gap-12 lg:gap-24 mb-20">
            <div>
                <h2 class="text-pretty text-5xl lg:text-6xl font-bold tracking-tight text-slate-900 leading-tight">
                    <?php echo mer_esc($kim_title); ?>
                </h2>
            </div>
            <div class="flex items-center">
                <p class="text-base sm:text-lg text-slate-600 leading-relaxed">
                    <?php echo mer_esc($kim_text); ?>
                </p>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 divide-y md:divide-y-0 divide-x-0 md:divide-x divide-slate-200">
            <?php foreach ($stats as $stat) : ?>
                <div class="flex flex-col items-center text-center px-6 py-8 gap-5">
                    <i data-lucide="<?php echo esc_attr($stat['icon']); ?>" stroke-width="1" class="w-16 h-16 text-[#00d084]"></i>
                    <p class="text-sm text-slate-600 leading-snug"><?php echo nl2br(esc_html($stat['text'])); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
