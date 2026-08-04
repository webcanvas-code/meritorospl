<?php
$title_green = mer_field('kon_title_green', __('Umów rozmowę', 'meritoros'));
$title_dark  = mer_field('kon_title_dark',  __('i sprawdź, jak możemy pomóc', 'meritoros'));
$subtitle    = mer_field('kon_subtitle',    __('Wysłuchamy, przeanalizujemy sytuację i zaproponujemy kolejne kroki.', 'meritoros'));
$cf7_id      = intval(mer_field('kon_cf7_id', 0));

// Kroki — 4 osobne grupy ACF
$steps = [];
for ($i = 1; $i <= 4; $i++) {
    $step = get_field("kon_step_{$i}");
    if (!empty($step['label'])) {
        $steps[] = ['label' => $step['label'], 'active' => !empty($step['active'])];
    } elseif ($i === 1) {
        $steps = [
            ['label' => __('Analiza potrzeb', 'meritoros'),        'active' => true],
            ['label' => __('Propozycja rozwiązania', 'meritoros'), 'active' => true],
            ['label' => __('Wdrożenie', 'meritoros'),              'active' => true],
            ['label' => __('Stałe wsparcie', 'meritoros'),         'active' => false],
        ];
        break;
    }
}
?>

<!-- Hero + Form -->
<section class="pt-36 pb-16 bg-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-100/60 rounded-full blur-3xl translate-x-1/3 -translate-y-1/4 pointer-events-none"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">

        <!-- Breadcrumb -->
        <div class="flex items-center flex-wrap gap-1 text-xs sm:text-sm text-slate-400 mb-6">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-[#2d8650] transition-colors"><?php esc_html_e('Strona główna', 'meritoros'); ?></a>
            <span>/</span>
            <span class="text-slate-600 font-medium"><?php echo mer_esc(get_the_title()); ?></span>
        </div>

        <div class="max-w-3xl mb-6 sm:mb-8">
            <h1 class="text-pretty text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight mb-3 sm:mb-4 leading-[1.1] text-[#2d8650]">
                <?php echo mer_esc($title_green); ?><br>
                <span class="text-slate-900"><?php echo mer_esc($title_dark); ?></span>
            </h1>
            <p class="text-base sm:text-lg text-slate-500 leading-relaxed">
                <?php echo mer_esc($subtitle); ?>
            </p>
        </div>

        <!-- CF7 Form -->
        <div class="max-w-4xl">
            <?php if ($cf7_id) : ?>
                <?php echo do_shortcode('[contact-form-7 id="' . $cf7_id . '"]'); ?>
            <?php else : ?>
                <p class="text-slate-400 text-sm italic"><?php esc_html_e('Przypisz formularz CF7 w ustawieniach strony (zakładka Hero & Formularz → ID formularza CF7).', 'meritoros'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Process steps -->
<section class="py-6 sm:py-8 bg-[#f8f9fa] border-y border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-2 gap-x-2 gap-y-1 sm:flex sm:flex-row sm:items-center sm:justify-center sm:gap-0">
            <?php foreach ($steps as $i => $step) :
                $active = !empty($step['active']);
                $dot_border = $active ? 'border-emerald-400' : 'border-slate-300';
                $dot_fill   = $active ? 'bg-emerald-400' : 'bg-slate-300';
                $text_color = $active ? 'text-slate-700' : 'text-slate-400';
            ?>
                <?php if ($i > 0) : ?>
                    <i data-lucide="arrow-right" class="w-5 h-5 text-emerald-400 shrink-0 hidden sm:block stroke-[1.5]"></i>
                <?php endif; ?>
                <div class="flex items-center gap-2 sm:gap-3 px-3 py-3 sm:px-6 sm:py-4">
                    <div class="w-6 h-6 sm:w-7 sm:h-7 rounded-full border-2 <?php echo $dot_border; ?> flex items-center justify-center shrink-0">
                        <div class="w-2 h-2 sm:w-2.5 sm:h-2.5 rounded-full <?php echo $dot_fill; ?>"></div>
                    </div>
                    <span class="text-xs sm:text-sm font-medium <?php echo $text_color; ?> sm:whitespace-nowrap leading-tight">
                        <?php echo mer_esc($step['label']); ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
