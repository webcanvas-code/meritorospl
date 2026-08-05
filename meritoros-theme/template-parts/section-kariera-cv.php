<?php
$title    = mer_field('kar_cv_title',    __("Chcesz do nas dołączyć?\nZostaw swoje CV", 'meritoros'));
$tag_text = mer_field('kar_cv_tag_text', __('Dołącz do nas!', 'meritoros'));
$cf7_id   = intval(mer_field('kar_cf7_id', 0));
$photo    = get_field('kar_cv_photo');
$photo_url = is_array($photo) ? esc_url($photo['url']) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=800&q=80';
$photo_alt = is_array($photo) ? esc_attr($photo['alt'] ?: '') : '';
?>

<section id="zostaw-cv" class="py-16 md:py-24 bg-emerald-50">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 text-center mb-12 leading-tight">
            <?php echo nl2br(esc_html($title)); ?>
        </h2>

        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            <div>
                <?php if ($cf7_id) : ?>
                    <?php echo do_shortcode('[contact-form-7 id="' . $cf7_id . '"]'); ?>
                <?php else : ?>
                    <p class="text-slate-400 text-sm italic"><?php esc_html_e('Przypisz formularz CF7 w ustawieniach strony (zakładka Formularz CV → ID formularza CF7).', 'meritoros'); ?></p>
                <?php endif; ?>
            </div>

            <div class="relative hidden lg:block">
                <div class="absolute -top-8 -left-8 w-20 h-20 rounded-full border-[8px] border-emerald-400 z-10"></div>
                <div class="relative rounded-2xl overflow-hidden">
                    <img src="<?php echo $photo_url; ?>" alt="<?php echo $photo_alt; ?>" class="w-full object-cover aspect-[4/3]" loading="lazy">
                </div>
                <a href="#zostaw-cv" class="absolute -bottom-4 right-4 bg-[#00d084] text-white text-sm font-semibold px-6 py-3 rounded-xl shadow-lg rotate-[-2deg] hover:bg-[#00b872] transition-colors duration-200">
                    <?php echo mer_esc($tag_text); ?>
                </a>
            </div>

        </div>
    </div>
</section>
