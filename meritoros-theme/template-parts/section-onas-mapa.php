<?php
$mapa_title = mer_field('onas_mapa_title', 'Gdzie działamy');
$mapa_text  = mer_field('onas_mapa_text',  'Posiadamy 7 oddziałów stacjonarnych w miastach Polski oraz oddziały wirtualne, dzięki czemu obsługujemy firmy niezależnie od ich lokalizacji:');
$mapa_image = get_field('onas_mapa_image');
$mapa_raw   = mer_field('onas_mapa_cities', "Kraków (siedziba główna oraz 3 oddziały)\nWarszawa\nKatowice\nRzeszów\nWrocław\nŁódź\nBytom\n2 oddziały wirtualne działające w pełni online");
$mapa_items = array_filter(array_map('trim', explode("\n", $mapa_raw)));

// Map image source
if (is_array($mapa_image) && !empty($mapa_image['url'])) {
    $map_src = esc_url($mapa_image['url']);
    $map_alt = esc_attr($mapa_image['title'] ?: 'Mapa Polski z oddziałami');
} else {
    $map_src = esc_url(get_template_directory_uri() . '/images/mapaPL.svg');
    $map_alt = 'Mapa Polski z oddziałami';
}
?>

<section class="py-12 md:py-24 bg-white relative">

    <div class="hidden md:block absolute -right-40 top-1/2 -translate-y-1/2 w-[500px] h-[500px] rounded-full border-[60px] border-emerald-100 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

            <div class="w-full flex items-center justify-center">
                <img src="<?php echo $map_src; ?>" alt="<?php echo $map_alt; ?>" class="max-w-[480px] w-full h-auto" loading="lazy">
            </div>

            <div>
                <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 mb-5"><?php echo mer_esc($mapa_title); ?></h2>
                <p class="text-base sm:text-lg text-slate-500 leading-relaxed mb-10 max-w-md">
                    <?php echo mer_esc($mapa_text); ?>
                </p>

                <ul class="space-y-4">
                    <?php foreach ($mapa_items as $item) : ?>
                        <li class="flex items-center gap-3">
                            <i data-lucide="circle-check" stroke-width="1.5" class="w-6 h-6 text-[#2d8650] shrink-0"></i>
                            <span class="text-base text-slate-700"><?php echo mer_esc($item); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>
    </div>
</section>
