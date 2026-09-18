<?php
defined('ABSPATH') || exit;

$heading  = __( mer_field('kupimy_hero_heading',  'Myślisz o sprzedaży swojego biura rachunkowego?'), 'meritoros' );
$subtitle = __( mer_field('kupimy_hero_subtitle', 'Oferujemy dwa modele współpracy: całkowitą sprzedaż biura rachunkowego albo partnerstwo kapitałowe z zachowaniem operacyjnej autonomii.'), 'meritoros' );
$btn1_text = __( mer_field('kupimy_hero_btn1_text', 'Porozmawiajmy'), 'meritoros' );
$btn1_url  = mer_field('kupimy_hero_btn1_url',  '#porozmawiajmy');
$btn2_text = __( mer_field('kupimy_hero_btn2_text', 'Poznaj modele'), 'meritoros' );
$btn2_url  = mer_field('kupimy_hero_btn2_url',  '#kupimy-modele');
$intro    = __( mer_field('kupimy_hero_intro',    'Właściciele biur rachunkowych zgłaszają się do nas z różnymi potrzebami. Jedni chcą całkowicie wyjść z biznesu i sprzedać firmę, inni szukają partnera, który pomoże im dalej rozwijać biuro. W Meritoros rozmawiamy o obu scenariuszach.'), 'meritoros' );

$image   = get_field('kupimy_hero_image');
$img_url = is_array($image) ? esc_url($image['url']) : 'https://images.unsplash.com/photo-1521791136064-7986c2920216?auto=format&fit=crop&q=80&w=1600';
$img_alt = is_array($image) ? esc_attr($image['alt'] ?: __('Kupimy biuro rachunkowe', 'meritoros')) : __('Kupimy biuro rachunkowe', 'meritoros');
?>

<!-- ── Hero ──────────────────────────────────────────────────────── -->
<section id="kupimy-hero" class="relative overflow-hidden pt-36 pb-16">

    <!-- Zdjęcie w tle -->
    <div class="absolute inset-0">
        <img src="<?php echo $img_url; ?>" alt="<?php echo $img_alt; ?>" class="w-full h-full object-cover" loading="eager">
        <div class="absolute inset-0 bg-slate-900/60"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">

        <!-- Breadcrumbs -->
        <div class="flex items-center flex-wrap gap-1 text-xs sm:text-sm text-white/60 mb-6">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('Strona główna', 'meritoros'); ?></a>
            <span>/</span>
            <span class="text-white/90 font-medium"><?php esc_html_e('Kupimy biuro rachunkowe', 'meritoros'); ?></span>
        </div>

        <div class="max-w-3xl">
            <h1 class="text-pretty text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white leading-[1.1] mb-6">
                <?php echo nl2br(esc_html($heading)); ?>
            </h1>
            <p class="text-base sm:text-lg text-white/75 leading-relaxed mb-8 max-w-5xl">
                <?php echo wp_kses_post($subtitle); ?>
            </p>
            <div class="flex flex-wrap items-center gap-4">
                <a href="<?php echo esc_url($btn1_url); ?>"
                   class="mer-btn mer-btn--primary inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-[#00d084] hover:bg-[#00b872] text-white text-base font-semibold transition-colors duration-200">
                    <?php echo mer_esc($btn1_text); ?>
                </a>
                <?php if ($btn2_text) : ?>
                <a href="<?php echo esc_url($btn2_url); ?>"
                   class="mer-btn mer-btn--secondary inline-flex items-center gap-2 px-7 py-3.5 rounded-full border border-white/30 text-white text-base font-semibold hover:bg-white/10 transition-colors duration-200">
                    <?php echo mer_esc($btn2_text); ?>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- ── Akapit wstępny ─────────────────────────────────────────────── -->
<?php if ( $intro ) : ?>
<section class="py-10 md:py-12 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <p class="text-base sm:text-lg text-slate-700 leading-relaxed max-w-5xl font-semibold">
            <?php echo wp_kses_post($intro); ?>
        </p>
    </div>
</section>
<?php endif; ?>
