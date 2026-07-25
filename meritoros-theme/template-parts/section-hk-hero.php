<?php
$title    = mer_field('hk_hero_title',    'Historie klientów');
$text     = mer_field('hk_hero_text',     'Konkretne przypadki. Konkretny efekt. Zobacz, jak pomagamy firmom działać stabilnie i bezpiecznie.');
$btn_text = mer_field('hk_hero_btn_text', 'Poznaj historie');
$btn_url  = mer_field('hk_hero_btn_url',  '#hk-video-section');
?>

<section class="pt-36 pb-16 bg-white relative">

    <!-- Video player illustration -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none select-none" aria-hidden="true">
    <div class="absolute right-8 top-1/2 -translate-y-1/2 hidden lg:flex flex-col items-end gap-5">
        <!-- Screen -->
        <div class="w-[520px] xl:w-[600px] aspect-video rounded-3xl border-2 border-emerald-100 bg-emerald-50/60 flex items-center justify-center">
            <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                <polygon points="24,14 24,66 66,40" fill="none" stroke="#a7f3d0" stroke-width="3" stroke-linejoin="round"/>
            </svg>
        </div>
        <!-- Progress bar -->
        <div class="w-[520px] xl:w-[600px] flex items-center px-2">
            <div class="flex-1 h-[1.5px] bg-emerald-100 relative">
                <div class="absolute left-[38%] -top-[7px] w-4 h-4 rounded-full bg-emerald-200 border-2 border-white shadow-sm"></div>
            </div>
        </div>
    </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="flex items-center gap-2 text-sm text-slate-400 mb-6">
            <span><?php esc_html_e('Strona główna', 'meritoros'); ?></span>
            <span>/</span>
            <span class="text-slate-600 font-medium">Historie klientów</span>
        </div>

        <div class="max-w-3xl">
            <h1 class="text-pretty text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-slate-900 leading-[1.1] mb-6">
                <?php echo nl2br(esc_html($title)); ?>
            </h1>
            <p class="text-lg sm:text-xl text-slate-500 leading-relaxed mb-10 max-w-4xl">
                <?php echo wp_kses_post($text); ?>
            </p>
            <a href="<?php echo esc_url($btn_url); ?>" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-[#48c279] text-white text-base font-semibold hover:bg-[#3ea868] transition-colors">
                <?php echo mer_esc($btn_text); ?>
            </a>
        </div>
    </div>
</section>
