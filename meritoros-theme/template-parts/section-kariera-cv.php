<?php
$title       = mer_field('kar_cv_title',    __("Chcesz do nas dołączyć?\nSprawdź aktualne oferty", 'meritoros'));
$desc        = mer_field('kar_cv_desc',     '');
$btn_text    = mer_field('kar_cv_btn_text', __('Aplikuj teraz', 'meritoros'));
$traffit_url = trim(mer_field('kar_traffit_url', ''));
?>

<section id="zostaw-cv" class="py-16 md:py-24 bg-emerald-50">
    <div class="max-w-3xl mx-auto px-6 text-center">

        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 mb-6 leading-tight">
            <?php echo nl2br(esc_html($title)); ?>
        </h2>

        <?php if ($desc) : ?>
        <p class="text-lg text-slate-600 leading-relaxed mb-10">
            <?php echo mer_esc($desc); ?>
        </p>
        <?php endif; ?>

        <?php if ($traffit_url) : ?>
        <a href="<?php echo esc_url($traffit_url); ?>" target="_blank" rel="noopener noreferrer"
           class="mer-btn mer-btn--primary inline-flex items-center gap-3 px-8 py-4 rounded-full bg-[#00d084] text-white text-lg font-semibold hover:bg-[#00b872] transition-colors duration-200">
            <?php echo mer_esc($btn_text); ?>
            <i data-lucide="arrow-right" class="w-5 h-5 stroke-[2]"></i>
        </a>
        <?php else : ?>
        <p class="text-slate-400 text-sm italic"><?php esc_html_e('Ustaw link Traffit w ustawieniach strony (zakładka Formularz CV → Link Traffit).', 'meritoros'); ?></p>
        <?php endif; ?>

    </div>
</section>
