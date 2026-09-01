<?php
defined('ABSPATH') || exit;

$heading  = __( mer_field('kupimy_kalk_heading',  'Kalkulator orientacyjnej wyceny biura rachunkowego'), 'meritoros' );
$btn_text = __( mer_field('kupimy_kalk_btn_text', 'Sprawdź wycenę'), 'meritoros' );
$btn_url  = mer_field('kupimy_kalk_btn_url',  '#');
$photo    = mer_field('kupimy_kalk_photo');
$photo_url = is_array($photo) ? $photo['url'] : 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1600&q=80';
?>

<section class="relative overflow-hidden">

    <!-- Zdjęcie w tle -->
    <div class="absolute inset-0">
        <img src="<?php echo esc_url($photo_url); ?>"
             alt=""
             class="w-full h-full object-cover"
             aria-hidden="true" loading="lazy">
        <div class="absolute inset-0 bg-[#00d084]/80"></div>
    </div>

    <!-- Treść -->
    <div class="relative py-24 md:py-32 px-4 sm:px-6 lg:px-8 flex flex-col items-center justify-center text-center">

        <h2 class="text-pretty text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-snug mb-10 max-w-2xl">
            <?php echo mer_esc($heading); ?>
        </h2>

        <a href="<?php echo esc_url(home_url('/#wycen-biuro')); ?>"
           class="mer-btn mer-btn--primary inline-flex items-center justify-center px-8 py-3.5 rounded-full bg-white text-slate-800 text-base font-semibold hover:bg-emerald-50 transition-colors duration-200">
            <?php echo mer_esc($btn_text); ?>
        </a>

    </div>
</section>
