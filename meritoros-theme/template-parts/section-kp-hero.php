<?php
$title_line1  = mer_field('kp_hero_title_line1', 'Kadry i płace, które dają');
$title_green  = mer_field('kp_hero_title_green', 'spokój');
$title_line2  = mer_field('kp_hero_title_line2', 'organizacji');
$subtitle     = mer_field('kp_hero_subtitle',    'Zapewniamy kompleksową obsługę kadrowo-płacową firm o różnej skali działalności. Przejmujemy odpowiedzialność za poprawność, terminowość i ciągłość procesów, aby organizacja mogła działać stabilnie i bez zakłóceń.');
$btn1_text    = mer_field('kp_hero_btn1_text',   'Poznaj ofertę');
$btn1_url     = mer_field('kp_hero_btn1_url',    '#oferta');
$btn2_text    = mer_field('kp_hero_btn2_text',   'Porozmawiajmy');
$btn2_url     = mer_field('kp_hero_btn2_url',    home_url('/kontakt/'));
?>

<section class="relative bg-emerald-50 overflow-hidden pt-36 pb-16">

    <div class="absolute right-0 top-1/2 -translate-y-1/2 w-[460px] h-[460px] opacity-10 pointer-events-none pr-12 hidden lg:flex items-center justify-center">
        <svg viewBox="0 0 300 280" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full stroke-emerald-600" stroke-width="3">
            <rect x="50" y="20" width="200" height="240" rx="12"/>
            <rect x="50" y="20" width="200" height="40" rx="12" fill="none"/>
            <line x1="50" y1="60" x2="250" y2="60"/>
            <circle cx="90" cy="40" r="12"/>
            <line x1="115" y1="32" x2="200" y2="32" stroke-linecap="round"/>
            <line x1="115" y1="46" x2="180" y2="46" stroke-linecap="round"/>
            <line x1="70" y1="85" x2="230" y2="85" stroke-linecap="round"/>
            <line x1="70" y1="105" x2="210" y2="105" stroke-linecap="round"/>
            <line x1="70" y1="125" x2="220" y2="125" stroke-linecap="round"/>
            <line x1="70" y1="145" x2="195" y2="145" stroke-linecap="round"/>
            <rect x="70" y="165" width="60" height="14" rx="4"/>
            <rect x="70" y="190" width="90" height="14" rx="4"/>
            <rect x="70" y="215" width="45" height="14" rx="4"/>
            <circle cx="215" cy="220" r="20"/>
            <polyline points="205,220 212,228 226,212" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>

    <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-emerald-200/40 rounded-full blur-3xl translate-x-1/3 -translate-y-1/4 pointer-events-none"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">

        <div class="flex items-center gap-2 text-sm text-slate-400 mb-6">
            <span><?php esc_html_e('Strona główna', 'meritoros'); ?></span>
            <span>/</span>
            <span>Biuro rachunkowe</span>
            <span>/</span>
            <span class="text-slate-600 font-medium">Kadry i płace</span>
        </div>

        <div class="max-w-4xl">
            <h1 class="text-pretty text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight mb-6 leading-[1.1] text-slate-900">
                <?php echo mer_esc($title_line1); ?><br>
                <span class="text-[#2d8650]"><?php echo mer_esc($title_green); ?></span> <?php echo mer_esc($title_line2); ?>
            </h1>
            <p class="text-base sm:text-lg text-slate-500 mb-8 leading-relaxed max-w-5xl">
                <?php echo wp_kses_post($subtitle); ?>
            </p>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="<?php echo esc_url($btn2_url); ?>" class="px-7 py-3.5 rounded-full bg-[#2d8650] text-white text-base font-semibold hover:bg-[#246e41] transition-colors flex items-center justify-center">
                    <?php echo mer_esc($btn2_text); ?>
                </a>
                <a href="<?php echo esc_url($btn1_url); ?>" class="px-7 py-3.5 rounded-full border border-slate-300 text-slate-700 text-base font-semibold hover:bg-white transition-colors flex items-center justify-center">
                    <?php echo mer_esc($btn1_text); ?>
                </a>
            </div>
        </div>
    </div>
</section>
