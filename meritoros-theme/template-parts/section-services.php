<?php
$label     = mer_field('services_label', 'Nasze Kompetencje');
$title     = mer_field('services_title', 'Obszary, w których przejmujemy odpowiedzialność');
$desc      = mer_field('services_desc', 'Nasze doświadczenie obejmuje rozliczanie firm o różnorodnych profilach działalności, takich jak CIT Estoński, Fundacje Rodzinne, Spółki ASI, e-commerce, VAT OSS, Intrastat oraz rozliczenia delegacji pracowniczych.');
$cta_title = mer_field('services_cta_title', 'Zapytaj o ofertę');
$cta_sub   = mer_field('services_cta_sub', 'Skontaktuj się z nami');
$cta_url   = mer_field('services_cta_url', '#kontakt');

$service_defaults = [
    1 => ['icon' => 'calculator',      'title' => 'Usługi Rachunkowe',    'description' => 'Kompleksowa obsługa księgowa firm o różnej skali działalności.',                              'url' => '#'],
    2 => ['icon' => 'network',         'title' => 'BPO',                  'description' => 'Outsourcing wybranych lub pełnych procesów finansowych i administracyjnych dla większych firm.', 'url' => '#'],
    3 => ['icon' => 'file-text',       'title' => 'Usługi Kadrowe',       'description' => 'Obsługa kadrowo-płacowa dopasowana do potrzeb organizacji.',                                  'url' => '#'],
    4 => ['icon' => 'heart-handshake', 'title' => 'Fundacje rodzinne',    'description' => 'Obsługa rachunkowa fundacji z uwzględnieniem specyfiki regulacyjnej.',                         'url' => '#'],
    5 => ['icon' => 'cpu',             'title' => 'Transformacja Cyfrowa','description' => 'Wsparcie we wdrażaniu narzędzi, automatyzacji i usprawnianiu procesów biznesowych.',           'url' => '#'],
];

$items = [];
for ($i = 1; $i <= 5; $i++) {
    $def     = $service_defaults[$i];
    $items[] = [
        'icon'        => mer_field("service_{$i}_icon", $def['icon']),
        'title'       => mer_field("service_{$i}_title", $def['title']),
        'description' => mer_field("service_{$i}_desc", $def['description']),
        'url'         => mer_field("service_{$i}_url", $def['url']),
    ];
}

$icon_classes = ['rotate-3', '-rotate-3', 'rotate-3', '-rotate-3', 'rotate-3'];
?>

<section class="py-16 md:py-24 px-6 lg:px-12 bg-slate-50 border-t border-slate-100">
    <div class="max-w-[1400px] mx-auto">
        <div class="bg-white rounded-3xl p-8 lg:p-10 shadow-sm">

        <div class="mb-6">
            <span class="text-[#2d8650] uppercase tracking-widest text-base font-bold mb-2 block">
                <?php echo mer_esc($label); ?>
            </span>
            <h2 class="text-pretty text-3xl lg:text-4xl font-bold tracking-tight mb-3 text-slate-900">
                <?php echo mer_esc($title); ?>
            </h2>
            <?php if ($desc) : ?>
                <p class="text-base text-slate-600 leading-relaxed font-light max-w-4xl">
                    <?php echo mer_esc($desc); ?>
                </p>
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

            <?php foreach ($items as $i => $item) :
                $icon     = esc_attr($item['icon'] ?? 'briefcase');
                $s_title  = esc_html($item['title'] ?? '');
                $s_desc   = esc_html($item['description'] ?? '');
                $s_url    = esc_url($item['url'] ?? '#');
                $rot      = $icon_classes[$i % count($icon_classes)];
            ?>
                <a href="<?php echo $s_url; ?>"
                   class="bg-white border border-slate-200 rounded-[2rem] p-4 lg:p-6 hover:-translate-y-1 hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300 flex flex-col min-h-[180px] lg:min-h-[220px] group relative overflow-hidden">
                    <div class="w-10 h-10 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center mb-4 text-[#2d8650] group-hover:scale-110 group-hover:<?php echo $rot; ?> transition-all duration-300">
                        <i data-lucide="<?php echo $icon; ?>" class="w-6 h-6 stroke-[1.5]"></i>
                    </div>
                    <div class="absolute top-6 right-6 w-10 h-10 rounded-full border border-slate-100 bg-slate-50 flex items-center justify-center opacity-0 -translate-x-4 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 text-slate-400 group-hover:text-[#2d8650]">
                        <i data-lucide="arrow-right" class="w-5 h-5 stroke-[2]"></i>
                    </div>
                    <h3 class="text-lg lg:text-xl font-bold tracking-tight mb-3 mt-auto text-slate-900"><?php echo $s_title; ?></h3>
                    <p class="text-base text-slate-600 font-light leading-relaxed"><?php echo $s_desc; ?></p>
                </a>
            <?php endforeach; ?>

            <!-- CTA Card -->
            <a href="<?php echo esc_url($cta_url); ?>"
               class="bg-[#2d8650] rounded-[2rem] p-4 lg:p-6 hover:-translate-y-1 hover:shadow-xl hover:shadow-[#2d8650]/30 transition-all duration-300 flex flex-col items-center justify-center text-center text-white min-h-[180px] lg:min-h-[220px] group relative overflow-hidden">
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-700 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-white/20 via-transparent to-transparent"></div>
                <div class="relative w-12 h-12 mb-4">
                    <i data-lucide="plus-circle" class="w-12 h-12 stroke-[1.5] absolute inset-0 opacity-100 group-hover:scale-50 group-hover:opacity-0 transition-all duration-500"></i>
                    <i data-lucide="arrow-right" class="w-12 h-12 stroke-[1.5] absolute inset-0 opacity-0 scale-50 group-hover:scale-100 group-hover:-rotate-45 group-hover:opacity-100 transition-all duration-500"></i>
                </div>
                <h3 class="text-lg lg:text-xl font-bold tracking-tight relative z-10"><?php echo mer_esc($cta_title); ?></h3>
                <p class="text-white/80 mt-2 text-base font-light relative z-10"><?php echo mer_esc($cta_sub); ?></p>
            </a>

        </div>
        </div>
    </div>
</section>
