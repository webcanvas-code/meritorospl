<?php
$title      = mer_field('media_art_title',     'Maciej Paraszczak dla Pulsu Biznesu');
$quote      = mer_field('media_art_quote',     'Dla wielu naszych klientów jesteśmy nie tylko biurem rachunkowym, ale partnerem operacyjnym, który realnie usprawnia ich procesy biznesowe – podkreśla z Maciej Paraszczak, prezes zarządu spółki Meritoros.');
$bold_text  = mer_field('media_art_bold_text', 'Wywiad z Maciejem Paraszczakiem dla Pulsu Biznesu o tym, jak wygląda nowoczesna księgowość w praktyce i dlaczego standard oraz procesy mają dziś kluczowe znaczenie.');
$btn_text   = mer_field('media_art_btn_text',  'Czytaj więcej');
$btn_url    = mer_field('media_art_btn_url',   '#');
$photo      = mer_field('media_art_photo',     []);
$photo_url  = is_array($photo) ? ($photo['url'] ?? '') : '';
$photo_alt  = is_array($photo) ? ($photo['alt'] ?? $title) : $title;
?>

<section class="py-10 md:py-20 bg-white overflow-hidden relative">

    <!-- Dekoracyjny okrąg -->
    <div class="absolute -right-24 top-1/2 -translate-y-1/2 w-[420px] h-[420px] rounded-full border-[52px] border-emerald-300/30 pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            <div class="rounded-2xl overflow-hidden shadow-sm">
                <?php if ($photo_url) : ?>
                    <img src="<?php echo esc_url($photo_url); ?>"
                         alt="<?php echo esc_attr($photo_alt); ?>"
                         class="w-full h-full object-cover aspect-[4/3]" loading="lazy">
                <?php else : ?>
                    <div class="w-full aspect-[4/3] rounded-2xl bg-emerald-50 border-2 border-emerald-100"></div>
                <?php endif; ?>
            </div>

            <div>
                <h2 class="text-pretty text-4xl font-bold tracking-tight text-slate-900 mb-6 leading-tight">
                    <?php echo mer_esc($title); ?>
                </h2>
                <?php if ($quote) : ?>
                    <p class="text-base sm:text-lg text-slate-500 italic leading-relaxed mb-4">
                        <?php echo mer_esc($quote); ?>
                    </p>
                <?php endif; ?>
                <?php if ($bold_text) : ?>
                    <p class="text-base sm:text-lg text-slate-800 font-semibold leading-relaxed mb-8">
                        <?php echo mer_esc($bold_text); ?>
                    </p>
                <?php endif; ?>
                <a href="<?php echo esc_url($btn_url); ?>"
                   class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-[#00d084] text-white text-base font-medium hover:bg-[#00b872] transition-colors">
                    <?php echo mer_esc($btn_text); ?>
                </a>
            </div>

        </div>
    </div>

    <!-- Divider -->
    <div class="max-w-7xl mx-auto px-6">
        <div class="mt-16 border-t border-slate-200"></div>
    </div>
</section>
