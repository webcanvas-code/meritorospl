<?php
$title_normal = mer_field('bpo_hero_title_normal', 'Rozwiązania BPO');
$title_green  = mer_field('bpo_hero_title_green',  'dla większych organizacji');
$subtitle     = mer_field('bpo_hero_subtitle', 'Zapewniamy kompleksową obsługę kadrowo-płacową firm o różnej skali działalności. Przejmujemy odpowiedzialność za poprawność, terminowość i ciągłość procesów, aby organizacja mogła działać stabilnie i bez zakłóceń.');
$btn1_text    = mer_field('bpo_hero_btn1_text', 'Poznaj ofertę');
$btn1_url     = mer_field('bpo_hero_btn1_url',  '#');
$btn2_text    = mer_field('bpo_hero_btn2_text', 'Porozmawiajmy');
$btn2_url     = mer_field('bpo_hero_btn2_url',  home_url('/kontakt/'));
$logos_title  = mer_field('bpo_hero_logos_title', 'Zaufało nam ponad 1200 klientów');

$_img_base = get_template_directory_uri() . '/images/';
$_logo_defaults = [
    ['url' => $_img_base . 'streamsoft.png', 'alt' => 'Streamsoft'],
    ['url' => $_img_base . 'sitech.png',     'alt' => 'Sitech'],
    ['url' => $_img_base . 'arco.svg',       'alt' => 'Arco'],
    ['url' => $_img_base . 'rofa.png',       'alt' => 'ROFA'],
];
$logos = [];
for ($i = 1; $i <= 4; $i++) {
    $acf = get_field("bpo_hero_logo_{$i}");
    $logos[] = is_array($acf) ? $acf : $_logo_defaults[$i - 1];
}
?>

<section class="relative overflow-hidden bg-white">
    <div class="absolute top-0 right-0 z-0 w-[800px] h-[800px] bg-slate-50 rounded-full blur-3xl opacity-50 translate-x-1/3 -translate-y-1/4 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 z-0 w-[600px] h-[600px] bg-emerald-50 rounded-full blur-3xl opacity-30 -translate-x-1/3 translate-y-1/4 pointer-events-none"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 w-full pt-36 pb-16">

        <!-- Ikona dekoracyjna w tle -->
        <div class="absolute right-0 top-1/2 -translate-y-1/2 w-[460px] h-[460px] opacity-10 pointer-events-none pr-12 hidden lg:flex items-center justify-center" aria-hidden="true">
            <i data-lucide="landmark" class="w-full h-full text-emerald-600" stroke-width="1"></i>
        </div>

        <div class="flex items-center gap-2 text-sm text-slate-400 mb-6">
            <span><?php esc_html_e('Strona główna', 'meritoros'); ?></span>
            <span>/</span>
            <span class="text-slate-600 font-medium"><?php echo mer_esc(get_the_title()); ?></span>
        </div>

        <div class="max-w-4xl mb-12">
            <h1 class="text-pretty text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight mb-8 leading-[1.1]">
                <?php echo mer_esc($title_normal); ?><br>
                <span class="text-[#00d084]"><?php echo mer_esc($title_green); ?></span>
            </h1>
            <p class="text-base sm:text-lg text-slate-500 mb-10 leading-relaxed max-w-5xl">
                <?php echo wp_kses_post($subtitle); ?>
            </p>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="<?php echo esc_url($btn2_url); ?>" class="mer-btn mer-btn--primary px-7 py-3.5 rounded-full bg-[#00d084] text-white text-base font-semibold hover:bg-[#00b872] transition-colors flex items-center justify-center">
                    <?php echo mer_esc($btn2_text); ?>
                </a>
                <a href="<?php echo esc_url($btn1_url); ?>" class="mer-btn mer-btn--secondary px-7 py-3.5 rounded-full border border-slate-300 text-slate-700 text-base font-semibold hover:bg-slate-50 transition-colors flex items-center justify-center">
                    <?php echo mer_esc($btn1_text); ?>
                </a>
            </div>
        </div>

        <div class="pt-8 border-t border-slate-100">
            <p class="text-base md:text-lg text-slate-500 font-medium mb-6">
                <?php echo mer_esc($logos_title); ?>
            </p>
            <style>
                .bpo-hero-logos { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.25rem; align-items: center; }
                .bpo-hero-logos img { width: auto; height: auto; max-height: 36px; max-width: 100%; object-fit: contain; }
                @media (min-width: 640px) {
                    .bpo-hero-logos { display: flex; justify-content: space-between; align-items: center; gap: 1rem; }
                    .bpo-hero-logos img { max-height: none; }
                    .bpo-hero-logos img:nth-child(1) { width: 207px;    height: 41.99px; }
                    .bpo-hero-logos img:nth-child(2) { width: 139px;    height: 48px; }
                    .bpo-hero-logos img:nth-child(3) { width: 156px;    height: 35px; }
                    .bpo-hero-logos img:nth-child(4) { width: 129.21px; height: 59.87px; }
                }
            </style>
            <div class="bpo-hero-logos">
                <img src="<?php echo esc_url($logos[0]['url']); ?>" alt="<?php echo esc_attr($logos[0]['alt'] ?: 'Logo klienta'); ?>" loading="lazy">
                <img src="<?php echo esc_url($logos[1]['url']); ?>" alt="<?php echo esc_attr($logos[1]['alt'] ?: 'Logo klienta'); ?>" loading="lazy">
                <img src="<?php echo esc_url($logos[2]['url']); ?>" alt="<?php echo esc_attr($logos[2]['alt'] ?: 'Logo klienta'); ?>" loading="lazy">
                <img src="<?php echo esc_url($logos[3]['url']); ?>" alt="<?php echo esc_attr($logos[3]['alt'] ?: 'Logo klienta'); ?>" loading="lazy">
            </div>
        </div>

    </div>
</section>
