<?php
$title       = mer_field('kar_cv_title',    __("Chcesz do nas dołączyć?\nZostaw swoje CV", 'meritoros'));
$tag_text    = mer_field('kar_cv_tag_text', __('Dołącz do nas!', 'meritoros'));
$btn_text    = mer_field('kar_cv_btn_text', __('Aplikuj teraz', 'meritoros'));
$traffit_url = trim(mer_field('kar_traffit_url', ''));
$photo       = get_field('kar_cv_photo');
$photo_url   = is_array($photo) ? esc_url($photo['url']) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=800&q=80';
$photo_alt   = is_array($photo) ? esc_attr($photo['alt'] ?: '') : '';
?>

<section id="zostaw-cv" class="py-16 md:py-24 bg-emerald-50">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 text-center mb-12 leading-tight">
            <?php echo nl2br(esc_html($title)); ?>
        </h2>

        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            <div class="flex flex-col gap-6">
                <?php if ($traffit_url) : ?>
                <a href="<?php echo esc_url($traffit_url); ?>" target="_blank" rel="noopener noreferrer"
                   class="mer-btn mer-btn--primary inline-flex items-center gap-3 self-start px-8 py-4 rounded-full bg-[#00d084] text-white text-lg font-semibold hover:bg-[#00b872] transition-colors duration-200">
                    <?php echo mer_esc($btn_text); ?>
                    <i data-lucide="arrow-right" class="w-5 h-5 stroke-[2]"></i>
                </a>
                <?php else : ?>
                <p class="text-slate-400 text-sm italic"><?php esc_html_e('Ustaw link Traffit w ustawieniach strony (zakładka Formularz CV → Link Traffit).', 'meritoros'); ?></p>
                <?php endif; ?>
            </div>

            <div class="relative hidden lg:block">
                <div class="absolute -top-8 -left-8 w-20 h-20 rounded-full border-[8px] border-emerald-400 z-10"></div>
                <div class="relative rounded-2xl overflow-hidden">
                    <img src="<?php echo $photo_url; ?>" alt="<?php echo $photo_alt; ?>" class="w-full object-cover aspect-[4/3]" loading="lazy">
                </div>
                <a href="<?php echo $traffit_url ? esc_url($traffit_url) : '#zostaw-cv'; ?>" class="mer-btn mer-btn--white absolute -bottom-4 right-4 bg-white text-slate-700 border border-slate-200 text-sm font-semibold px-6 py-3 rounded-xl shadow-lg rotate-[-2deg] hover:bg-slate-50 transition-colors duration-200">
                    <?php echo mer_esc($tag_text); ?>
                </a>
            </div>

        </div>
    </div>
</section>
