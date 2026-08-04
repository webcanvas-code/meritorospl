<?php
defined('ABSPATH') || exit;

$heading  = mer_field('kupimy_hero_heading',  'Myślisz o sprzedaży swojego biura rachunkowego?');
$subtitle = mer_field('kupimy_hero_subtitle', 'Oferujemy dwa modele współpracy: całkowitą sprzedaż biura rachunkowego albo partnerstwo kapitałowe z zachowaniem operacyjnej autonomii.');
$btn_text = mer_field('kupimy_hero_btn_text', 'Kontakt');
$btn_url  = mer_field('kupimy_hero_btn_url',  get_permalink(get_page_by_path('kontakt')));
$intro    = mer_field('kupimy_hero_intro',    'Właściciele biur rachunkowych zgłaszają się do nas z różnymi potrzebami. Jedni chcą całkowicie wyjść z biznesu i sprzedać firmę, inni szukają partnera, który pomoże im dalej rozwijać biuro. W Meritoros rozmawiamy o obu scenariuszach.');

$image   = get_field('kupimy_hero_image');
$img_url = is_array($image) ? esc_url($image['url']) : 'https://images.unsplash.com/photo-1521791136064-7986c2920216?auto=format&fit=crop&q=80&w=1600';
$img_alt = is_array($image) ? esc_attr($image['alt'] ?: 'Kupimy biuro rachunkowe') : 'Kupimy biuro rachunkowe';
?>

<!-- ── Hero ──────────────────────────────────────────────────────── -->
<section class="relative overflow-hidden pt-36 pb-16">

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
            <span class="text-white/90 font-medium">Kupimy biuro rachunkowe</span>
        </div>

        <div class="max-w-3xl">
            <h1 class="text-pretty text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white leading-[1.1] mb-6">
                <?php echo nl2br(esc_html($heading)); ?>
            </h1>
            <p class="text-base sm:text-lg text-white/75 leading-relaxed mb-8 max-w-5xl">
                <?php echo wp_kses_post($subtitle); ?>
            </p>
            <a href="#porozmawiajmy"
               class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-[#2d8650] hover:bg-[#246e41] text-white text-base font-semibold transition-colors duration-200">
                <?php echo mer_esc($btn_text); ?>
            </a>
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
