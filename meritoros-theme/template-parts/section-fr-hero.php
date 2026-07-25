<?php
$title_normal = mer_field('fr_hero_title_normal', 'Fundacja rodzinna');
$title_green  = mer_field('fr_hero_title_green',  'bez stresu');
$title_line2  = mer_field('fr_hero_title_line2',  'księgowość pod kontrolą');
$subtitle     = mer_field('fr_hero_subtitle', 'Fundacja rodzinna wymaga szczególnej staranności w obszarze księgowości i podatków. Zapewniamy rozwiązania, które chronią interes fundatorów i wspierają długoterminową strukturę majątkową.');
$btn1_text    = mer_field('fr_hero_btn1_text', 'Poznaj ofertę');
$btn1_url     = mer_field('fr_hero_btn1_url',  '#');
$btn2_text    = mer_field('fr_hero_btn2_text', 'Porozmawiajmy');
$btn2_url     = mer_field('fr_hero_btn2_url',  home_url('/kontakt/'));
?>

<section class="relative bg-emerald-50 overflow-hidden pt-36 pb-16">

    <!-- Decorative SVG illustration -->
    <div class="absolute right-0 top-1/2 -translate-y-1/2 w-[520px] h-[520px] opacity-10 pointer-events-none pr-12 hidden lg:flex items-center justify-center">
        <svg viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full stroke-emerald-500" stroke-width="3.5">
            <path d="M150 40 L260 120 L260 260 L40 260 L40 120 Z" stroke-linejoin="round"/>
            <path d="M150 40 L40 120" stroke-linecap="round"/>
            <path d="M150 40 L260 120" stroke-linecap="round"/>
            <rect x="118" y="190" width="64" height="70" rx="32"/>
            <path d="M150 155 C150 155 118 132 118 112 C118 100 128 90 140 94 C145 96 150 101 150 101 C150 101 155 96 160 94 C172 90 182 100 182 112 C182 132 150 155 150 155Z"/>
            <circle cx="95" cy="185" r="12"/>
            <path d="M75 240 C75 215 115 215 115 240" stroke-linecap="round"/>
            <circle cx="205" cy="185" r="12"/>
            <path d="M185 240 C185 215 225 215 225 240" stroke-linecap="round"/>
            <path d="M150 70 L170 80 L170 100 C170 112 160 122 150 126 C140 122 130 112 130 100 L130 80 Z"/>
        </svg>
    </div>

    <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-emerald-200/40 rounded-full blur-3xl translate-x-1/3 -translate-y-1/4 pointer-events-none"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">

        <div class="flex items-center gap-2 text-sm text-slate-400 mb-6">
            <span><?php esc_html_e('Strona główna', 'meritoros'); ?></span>
            <span>/</span>
            <span>Biuro rachunkowe</span>
            <span>/</span>
            <span class="text-slate-600 font-medium"><?php echo mer_esc(get_the_title()); ?></span>
        </div>

        <div class="max-w-4xl">
            <h1 class="text-pretty text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight mb-6 leading-[1.1] text-slate-900">
                <?php echo mer_esc($title_normal); ?> <span class="text-[#48c279]"><?php echo mer_esc($title_green); ?></span><br>
                <?php echo mer_esc($title_line2); ?>
            </h1>
            <p class="text-base sm:text-lg text-slate-500 mb-8 leading-relaxed max-w-5xl">
                <?php echo wp_kses_post($subtitle); ?>
            </p>
            <div class="flex flex-wrap items-center gap-4">
                <a href="<?php echo esc_url($btn1_url); ?>" class="px-7 py-3.5 rounded-full border border-slate-300 text-slate-700 text-base font-semibold hover:bg-white transition-colors">
                    <?php echo mer_esc($btn1_text); ?>
                </a>
                <a href="<?php echo esc_url($btn2_url); ?>" class="px-7 py-3.5 rounded-full bg-[#48c279] text-white text-base font-semibold hover:bg-[#3ea868] transition-colors">
                    <?php echo mer_esc($btn2_text); ?>
                </a>
            </div>
        </div>

    </div>
</section>
