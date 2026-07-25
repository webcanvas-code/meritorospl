<?php
// Czytaj pola zawsze ze strony głównej — ACFML zwróci wersję w aktualnym języku
$_nl_id = (int) get_option('page_on_front');
$nl_label      = (get_field('nl_label',            $_nl_id) ?: __('Newsletter', 'meritoros'));
$nl_title      = (get_field('nl_title',            $_nl_id) ?: __('Bądź na bieżąco ze zmianami podatkowymi', 'meritoros'));
$nl_desc       = (get_field('nl_desc',             $_nl_id) ?: __('Interesują Cię zmiany podatkowe? Szukasz pracy w obszarze księgowości lub kadr? Zapisz się i otrzymuj to, co ważne.', 'meritoros'));
$sub_count     = (get_field('nl_subscriber_count', $_nl_id) ?: __('2 400+ czytelników', 'meritoros'));
$sub_label     = (get_field('nl_subscriber_label', $_nl_id) ?: __('dołączyło do naszego newslettera', 'meritoros'));
$form_title    = (get_field('nl_form_title',       $_nl_id) ?: __('Zapisz się bezpłatnie', 'meritoros'));
$form_sub      = (get_field('nl_form_sub',         $_nl_id) ?: __('Dołącz do ponad 2 400 specjalistów finansowych.', 'meritoros'));
$cf7_id        = intval(get_field('nl_cf7_id',     $_nl_id) ?: 0);

$benefit_defaults = [
    1 => __('Miesięczne podsumowania zmian podatkowych', 'meritoros'),
    2 => __('Aktualne oferty pracy z obszaru finansów i kadr', 'meritoros'),
    3 => __('Praktyczne wskazówki i komentarze ekspertów', 'meritoros'),
    4 => __('Możliwość wypisania się w dowolnym momencie', 'meritoros'),
];
$benefits = [];
for ($i = 1; $i <= 4; $i++) {
    $text = (get_field("nl_benefit_{$i}", $_nl_id) ?: $benefit_defaults[$i]);
    if (!empty($text)) {
        $benefits[] = ['text' => $text];
    }
}
?>

<section class="py-16 md:py-24 px-6 lg:px-12 bg-white border-t border-slate-100">
    <div class="max-w-[1400px] mx-auto">
        <div class="bg-slate-900 rounded-2xl md:rounded-[3rem] overflow-hidden grid grid-cols-1 lg:grid-cols-2">

            <!-- Left: Branding + Benefits -->
            <div class="relative p-7 sm:p-10 lg:p-16 flex flex-col justify-between overflow-hidden">
                <div class="absolute -bottom-16 -left-16 w-72 h-72 rounded-full bg-[#48c279]/10 blur-3xl pointer-events-none"></div>
                <div class="absolute top-8 right-8 w-40 h-40 rounded-full bg-[#48c279]/5 blur-2xl pointer-events-none"></div>

                <div class="relative z-10">
                    <div class="flex items-center mb-8 lg:mb-12">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo.svg'); ?>" alt="<?php bloginfo('name'); ?>" class="h-8 w-auto brightness-0 invert" loading="lazy">
                    </div>

                    <span class="text-[#48c279] uppercase tracking-widest text-base font-bold mb-4 block">
                        <?php echo mer_esc($nl_label); ?>
                    </span>
                    <h2 class="text-pretty text-3xl lg:text-4xl xl:text-5xl font-bold tracking-tight text-white leading-snug mb-6">
                        <?php echo mer_esc($nl_title); ?>
                    </h2>
                    <p class="text-slate-400 text-base sm:text-lg font-light leading-relaxed mb-10 max-w-sm">
                        <?php echo mer_esc($nl_desc); ?>
                    </p>

                    <div class="flex flex-col gap-3">
                        <?php foreach ($benefits as $benefit) : ?>
                            <div class="flex items-center gap-3">
                                <div class="w-7 h-7 rounded-full bg-[#48c279]/20 flex items-center justify-center shrink-0">
                                    <i data-lucide="check" class="w-4 h-4 text-[#48c279] stroke-[2.5]"></i>
                                </div>
                                <span class="text-slate-300 text-sm font-medium">
                                    <?php echo mer_esc($benefit['text'] ?? ''); ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="relative z-10 mt-12 flex items-center gap-4">
                    <div class="flex -space-x-2">
                        <?php
                        $avatar_colors   = ['bg-[#48c279]', 'bg-blue-500', 'bg-purple-500', 'bg-slate-600'];
                        $avatar_initials = ['AK', 'MC', 'SW', '+'];
                        foreach ($avatar_colors as $i => $color) : ?>
                            <div class="w-9 h-9 rounded-full <?php echo $color; ?> border-2 border-slate-900 flex items-center justify-center text-white text-xs font-bold">
                                <?php echo mer_esc($avatar_initials[$i]); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div>
                        <p class="text-white font-bold text-sm"><?php echo mer_esc($sub_count); ?></p>
                        <p class="text-slate-500 text-xs"><?php echo mer_esc($sub_label); ?></p>
                    </div>
                </div>
            </div>

            <!-- Right: CF7 Form -->
            <div class="bg-white p-7 sm:p-10 lg:p-16 flex flex-col justify-center">
                <h3 class="text-2xl font-bold tracking-tight text-slate-900 mb-2">
                    <?php echo mer_esc($form_title); ?>
                </h3>
                <p class="text-slate-500 text-sm font-light mb-8">
                    <?php echo mer_esc($form_sub); ?>
                </p>

                <div class="mer-nl-form">
                    <?php if ($cf7_id) : ?>
                        <?php echo do_shortcode('[contact-form-7 id="' . $cf7_id . '"]'); ?>
                    <?php else : ?>
                        <p class="text-slate-400 text-sm italic"><?php esc_html_e('Przypisz formularz CF7 w ustawieniach strony głównej (zakładka Newsletter → ID formularza CF7).', 'meritoros'); ?></p>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>
