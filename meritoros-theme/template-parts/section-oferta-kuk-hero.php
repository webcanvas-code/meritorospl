<?php
$title    = mer_field('op_title',    get_the_title());
$salary   = mer_field('op_salary',   '');
$location = mer_field('op_location', '');
$category = mer_field('op_category', '');
$bg       = get_field('op_hero_bg');
$bg_url   = is_array($bg) ? esc_url($bg['url']) : 'https://images.unsplash.com/photo-1521737711867-e3b97375f902?w=1600&q=80';

$kariera_url = home_url('/kariera/');
?>

<section class="relative overflow-hidden" style="min-height:75vh;">
    <img src="<?php echo $bg_url; ?>" alt="" class="absolute inset-0 w-full h-full object-cover object-center" loading="eager">
    <div class="absolute inset-0 bg-gradient-to-r from-slate-900/95 via-slate-900/80 to-slate-900/50"></div>

    <!-- Dekoracyjne kółko (spójność z resztą serwisu) -->
    <div class="absolute -left-40 top-1/2 -translate-y-1/2 w-64 h-64 rounded-full border-[40px] border-[#48c279]/60 pointer-events-none"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 flex flex-col justify-center" style="min-height:75vh; padding-top:7rem; padding-bottom:4rem;">

        <!-- Breadcrumb -->
        <div class="flex items-center flex-wrap gap-2 text-sm text-white/80 mb-8">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Strona główna', 'meritoros'); ?></a>
            <span>/</span>
            <a href="<?php echo esc_url($kariera_url); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Kariera', 'meritoros'); ?></a>
            <span>/</span>
            <span class="text-white font-medium"><?php echo mer_esc($title ?: get_the_title()); ?></span>
        </div>

        <!-- Tagi -->
        <div class="flex flex-wrap gap-3 mb-6">
            <?php if ($category) : ?>
            <span class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#48c279]/20 text-[#48c279] text-base font-semibold border border-[#48c279]/40">
                <i data-lucide="briefcase" class="w-4 h-4"></i>
                <?php echo mer_esc($category); ?>
            </span>
            <?php endif; ?>
            <?php if ($location) : ?>
            <span class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white/10 text-white/80 text-base font-medium border border-white/20">
                <i data-lucide="map-pin" class="w-4 h-4"></i>
                <?php echo mer_esc($location); ?>
            </span>
            <?php endif; ?>
            <?php if ($salary) : ?>
            <span class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white/10 text-white/80 text-base font-medium border border-white/20">
                <i data-lucide="banknote" class="w-4 h-4"></i>
                <?php echo mer_esc($salary); ?>
            </span>
            <?php endif; ?>
        </div>

        <!-- Nagłówek -->
        <h1 class="text-pretty text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white leading-[1.1] mb-8 max-w-3xl">
            <?php echo nl2br(esc_html($title)); ?>
        </h1>

        <!-- CTA -->
        <a href="#aplikuj" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-[#48c279] text-white text-base font-semibold hover:bg-[#3ea868] transition-colors self-start">
            <?php esc_html_e('Aplikuj teraz', 'meritoros'); ?>
            <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </a>

    </div>
</section>
