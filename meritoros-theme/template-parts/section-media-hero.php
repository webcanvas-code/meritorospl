<?php
$title = __( mer_field('media_hero_title', 'Media i informacje firmowe'), 'meritoros' );
$text  = __( mer_field('media_hero_text',  'Najważniejsze wydarzenia z życia firmy: rozwój, nowe inicjatywy, wyróżnienia i ogłoszenia.'), 'meritoros' );
?>

<section class="pt-36 pb-16 bg-white relative overflow-hidden">

    <!-- Decorative illustration — stacked news cards, bleeds off right edge -->
    <div class="absolute -right-10 top-1/2 -translate-y-1/2 hidden lg:flex flex-col gap-4 pointer-events-none select-none" aria-hidden="true">
        <!-- Card 1 -->
        <div class="w-[480px] xl:w-[560px] h-[72px] rounded-2xl border-2 border-emerald-100 bg-emerald-50/50 flex items-center px-6 gap-4">
            <div class="w-8 h-8 rounded-lg border-2 border-emerald-100 flex items-center justify-center flex-shrink-0">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><polygon points="3,2 3,12 12,7" fill="none" stroke="#a7f3d0" stroke-width="1.5" stroke-linejoin="round"/></svg>
            </div>
            <div class="flex-1 flex flex-col gap-1.5">
                <div class="h-2 w-3/5 rounded-full bg-emerald-100/80"></div>
                <div class="h-1.5 w-2/5 rounded-full bg-emerald-100/50"></div>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="w-[480px] xl:w-[560px] h-[72px] rounded-2xl border-2 border-emerald-100 bg-emerald-50/50 flex items-center px-6 gap-4">
            <div class="w-8 h-8 rounded-lg border-2 border-emerald-100 flex items-center justify-center flex-shrink-0">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><polygon points="3,2 3,12 12,7" fill="none" stroke="#a7f3d0" stroke-width="1.5" stroke-linejoin="round"/></svg>
            </div>
            <div class="flex-1 flex flex-col gap-1.5">
                <div class="h-2 w-4/5 rounded-full bg-emerald-100/80"></div>
                <div class="h-1.5 w-1/3 rounded-full bg-emerald-100/50"></div>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="w-[480px] xl:w-[560px] h-[72px] rounded-2xl border-2 border-emerald-100 bg-emerald-50/50 flex items-center px-6 gap-4">
            <div class="w-8 h-8 rounded-lg border-2 border-emerald-100 flex items-center justify-center flex-shrink-0">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><polygon points="3,2 3,12 12,7" fill="none" stroke="#a7f3d0" stroke-width="1.5" stroke-linejoin="round"/></svg>
            </div>
            <div class="flex-1 flex flex-col gap-1.5">
                <div class="h-2 w-1/2 rounded-full bg-emerald-100/80"></div>
                <div class="h-1.5 w-2/5 rounded-full bg-emerald-100/50"></div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <!-- Breadcrumb -->
        <div class="flex items-center flex-wrap gap-1 text-xs sm:text-sm text-slate-400 mb-6">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-[#00d084] transition-colors"><?php esc_html_e('Strona główna', 'meritoros'); ?></a>
            <span>/</span>
            <span class="text-slate-600 font-medium"><?php esc_html_e('Media i newsroom', 'meritoros'); ?></span>
        </div>

        <div class="max-w-3xl">
            <h1 class="text-pretty text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-slate-900 leading-[1.1] mb-6">
                <?php echo nl2br(esc_html($title)); ?>
            </h1>
            <p class="text-base sm:text-lg text-slate-500 leading-relaxed max-w-3xl">
                <?php echo wp_kses_post($text); ?>
            </p>
        </div>
    </div>
</section>
