<?php
defined('ABSPATH') || exit;

$heading  = __( mer_field('kupimy_form_heading',  'Porozmawiajmy'), 'meritoros' );
$subtitle = __( mer_field('kupimy_form_subtitle', 'Pierwsza rozmowa jest niezobowiązująca. Ustalimy, jaki model ma sens i czy jest przestrzeń do współpracy.'), 'meritoros' );
$cf7_id   = intval(mer_field('kupimy_cf7_id', 0));
$photo    = mer_field('kupimy_form_photo');
$photo_url = is_array($photo) ? $photo['url'] : 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=900&q=80';
$photo_alt = is_array($photo) ? ($photo['alt'] ?: 'Porozmawiajmy') : 'Porozmawiajmy';
?>

<section id="porozmawiajmy" class="py-14 md:py-20 bg-white relative">

    <!-- Dekoracyjny okrąg po lewej -->
    <div class="absolute -left-48 bottom-0 w-[480px] h-[480px] rounded-full border-[48px] border-emerald-100 pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-start">

            <!-- Lewa kolumna: formularz -->
            <div>
                <h2 class="text-pretty text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 mb-3">
                    <?php echo mer_esc($heading); ?>
                </h2>
                <p class="text-base sm:text-lg text-slate-500 leading-relaxed mb-8">
                    <?php echo mer_esc($subtitle); ?>
                </p>

                <?php if ($cf7_id) : ?>
                    <?php echo do_shortcode('[contact-form-7 id="' . $cf7_id . '"]'); ?>
                <?php else : ?>
                    <p class="text-slate-400 text-sm italic">Przypisz formularz CF7 w ustawieniach strony (zakładka Formularz kontaktowy → ID formularza CF7).</p>
                <?php endif; ?>
            </div>

            <!-- Prawa kolumna: zdjęcie -->
            <div class="relative">
                <div class="rounded-3xl overflow-hidden shadow-sm">
                    <img src="<?php echo esc_url($photo_url); ?>"
                         alt="<?php echo esc_attr($photo_alt); ?>"
                         class="w-full object-cover aspect-[4/5]" loading="lazy">
                </div>
                <!-- Dekoracyjny okrąg na zdjęciu -->
                <div class="absolute top-1/3 -right-6 w-24 h-24 rounded-full border-[12px] border-emerald-500 pointer-events-none" aria-hidden="true"></div>
            </div>

        </div>
    </div>
</section>
