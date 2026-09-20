<?php
$_ri_pl  = get_page_by_path('relacje-inwestorskie');
$_ri_pid = $_ri_pl ? (int) $_ri_pl->ID : get_the_ID();

$title    = __( get_field('ri_hero_title',    $_ri_pid) ?: 'Relacje inwestorskie', 'meritoros' );
$text     = __( get_field('ri_hero_text',     $_ri_pid) ?: 'Poniżej udostępniamy kluczowe informacje i dokumenty dotyczące Meritoros SA, w tym sprawozdania finansowe i raporty okresowe.', 'meritoros' );
$image    = get_field('ri_hero_image', $_ri_pid);

$img_url = is_array($image) ? esc_url($image['url']) : 'https://images.unsplash.com/photo-1521791136064-7986c2920216?auto=format&fit=crop&q=80&w=1600';
$img_alt = is_array($image) ? esc_attr($image['alt'] ?: 'Relacje inwestorskie') : 'Relacje inwestorskie';
?>

<section id="ri-hero" class="relative overflow-hidden pt-36 pb-16">

    <!-- Zdjęcie w tle -->
    <div class="absolute inset-0">
        <img src="<?php echo $img_url; ?>" alt="<?php echo $img_alt; ?>" class="w-full h-full object-cover" loading="eager">
        <div class="absolute inset-0 bg-slate-900/60"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">

        <!-- Breadcrumb -->
        <div class="flex items-center flex-wrap gap-1 text-xs sm:text-sm text-white/60 mb-6">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-white transition-colors"><?php echo __('Strona główna', 'meritoros'); ?></a>
            <span>/</span>
            <span class="text-white/90 font-medium"><?php echo mer_esc($title); ?></span>
        </div>

        <div class="max-w-3xl">
            <h1 class="text-pretty text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white leading-[1.1] mb-6">
                <?php echo nl2br(esc_html($title)); ?>
            </h1>
            <p class="text-base sm:text-lg text-white/75 leading-relaxed max-w-4xl">
                <?php echo wp_kses_post($text); ?>
            </p>
        </div>

    </div>
</section>
