<?php
$label     = mer_field('buyout_label', 'Dla biur rachunkowych');
$title     = mer_field('buyout_title', "Kupimy Biuro\nRachunkowe");
$desc      = mer_field('buyout_desc', 'Od lat współpracujemy z biurami rachunkowymi, które stoją przed decyzją o zmianie, sprzedaży lub dalszym rozwoju.');
$cta_text  = mer_field('buyout_cta_text', 'Wyceń wartość biura');
$cta_url   = mer_field('buyout_cta_url', get_permalink(get_page_by_path('kupimy-biuro-rachunkowe')));
$bg_arr    = get_field('buyout_bg_image');
$bg_url    = is_array($bg_arr) ? esc_url($bg_arr['url']) : 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1470&q=80';
$bg_alt    = is_array($bg_arr) ? esc_attr($bg_arr['alt']) : 'Team';
$tech_label= mer_field('tech_label', 'Obsługujemy systemy ERP i finansowe wiodących dostawców');

$stat_defaults = [
    1 => ['icon' => 'trending-up',  'value' => '100%',  'label' => 'Przejrzystych warunków', 'accent' => false],
    2 => ['icon' => 'handshake',    'value' => '20+',    'label' => 'Przejętych biur',        'accent' => false],
    3 => ['icon' => 'clock',        'value' => '14 dni', 'label' => 'Do wstępnej wyceny',     'accent' => false],
    4 => ['icon' => 'shield-check', 'value' => 'NDA',    'label' => 'Pełna poufność',         'accent' => true],
];
$stats = [];
for ($i = 1; $i <= 4; $i++) {
    $def     = $stat_defaults[$i];
    $stats[] = [
        'icon'   => mer_field("buyout_stat_{$i}_icon",   $def['icon']),
        'value'  => mer_field("buyout_stat_{$i}_value",  $def['value']),
        'label'  => mer_field("buyout_stat_{$i}_label",  $def['label']),
        'accent' => (bool) mer_field("buyout_stat_{$i}_accent", $def['accent']),
    ];
}

$_tech_defaults = [
    1 => ['src' => get_template_directory_uri() . '/images/erp optima.png', 'alt' => 'Comarch ERP Optima'],
    2 => ['src' => get_template_directory_uri() . '/images/enova.png',      'alt' => 'Enova 365'],
    3 => ['src' => get_template_directory_uri() . '/images/symfonia.png',   'alt' => 'Symfonia'],
    4 => ['src' => get_template_directory_uri() . '/images/sap.png',        'alt' => 'SAP'],
    5 => ['src' => get_template_directory_uri() . '/images/erp xl.png',     'alt' => 'Comarch ERP XL'],
];
$tech_logos = [];
$_fp_buy = (int) get_option('page_on_front');
for ($i = 1; $i <= 5; $i++) {
    $acf = get_field("tech_logo_{$i}", $_fp_buy);
    if (is_array($acf) && !empty($acf['url'])) {
        $tech_logos[] = ['src' => $acf['url'], 'alt' => $acf['alt'] ?: "Logo systemu {$i}"];
    } else {
        $tech_logos[] = $_tech_defaults[$i];
    }
}
?>

<section id="wycen-biuro" class="py-16 md:py-24 px-6 lg:px-12 bg-white">
    <div class="max-w-[1400px] mx-auto">

        <!-- Buyout Banner -->
        <div class="relative rounded-2xl md:rounded-[3rem] overflow-hidden">
            <div class="absolute inset-0">
                <img src="<?php echo $bg_url; ?>" alt="<?php echo $bg_alt; ?>" class="w-full h-full object-cover" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-r from-slate-900/95 via-slate-900/80 to-slate-900/40"></div>
            </div>

            <div class="relative z-10 p-6 sm:p-10 lg:p-16 grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <div class="text-white">
                    <span class="text-[#00d084] uppercase tracking-widest text-base font-bold mb-4 block">
                        <?php echo mer_esc($label); ?>
                    </span>
                    <h2 class="text-pretty text-2xl sm:text-3xl md:text-5xl font-bold tracking-tight mb-4 lg:mb-6 leading-tight">
                        <?php echo nl2br(esc_html($title)); ?>
                    </h2>
                    <p class="text-sm sm:text-base lg:text-lg text-white/80 mb-8 leading-relaxed max-w-lg font-light">
                        <?php echo mer_esc($desc); ?>
                    </p>
                    <a href="<?php echo esc_url($cta_url); ?>"
                       class="mer-btn mer-btn--primary inline-flex items-center gap-2 bg-[#00d084] text-white px-6 py-3 lg:px-8 lg:py-4 rounded-full text-sm lg:text-base font-semibold hover:bg-[#00b872] hover:shadow-lg hover:shadow-[#00d084]/30 transition-all duration-300 group">
                        <?php echo mer_esc($cta_text); ?>
                        <i data-lucide="arrow-right" class="w-4 h-4 lg:w-5 lg:h-5 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <div class="grid grid-cols-2 gap-3 lg:gap-4">
                    <?php foreach ($stats as $stat) :
                        $icon   = esc_attr($stat['icon'] ?? 'check');
                        $val    = esc_html($stat['value'] ?? '');
                        $slabel = esc_html($stat['label'] ?? '');
                        $accent = !empty($stat['accent']);
                    ?>
                        <div class="bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/15 rounded-xl lg:rounded-2xl p-4 lg:p-6 transition-colors overflow-hidden min-w-0">
                            <div class="w-8 h-8 lg:w-10 lg:h-10 bg-[#00d084] rounded-lg lg:rounded-xl flex items-center justify-center mb-3 lg:mb-4 shrink-0">
                                <i data-lucide="<?php echo $icon; ?>" class="w-4 h-4 lg:w-5 lg:h-5 text-white stroke-[1.5]"></i>
                            </div>
                            <p class="text-sm sm:text-lg lg:text-2xl font-bold text-white mb-1 leading-tight break-words"><?php echo $val; ?></p>
                            <p class="text-[11px] sm:text-xs lg:text-sm text-white/60 font-light leading-snug mt-1"><?php echo $slabel; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Tech Logos -->
        <div class="mt-16">
            <p class="text-xs uppercase tracking-widest text-slate-400 font-bold text-center mb-10">
                <?php echo mer_esc($tech_label); ?>
            </p>
            <style>
                .mer-tech-logos { display: flex; flex-wrap: wrap; justify-content: center; align-items: center; gap: 2.5rem 4rem; }
                .mer-tech-logos img { height: 44px; width: auto; object-fit: contain; }
            </style>
            <div class="mer-tech-logos">
                <?php foreach ($tech_logos as $logo) : ?>
                    <img src="<?php echo esc_url($logo['src']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" loading="lazy">
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>
