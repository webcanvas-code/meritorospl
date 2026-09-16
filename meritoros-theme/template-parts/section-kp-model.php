<?php
$_page_id = get_the_ID();
$_orig_id = apply_filters('wpml_object_id', $_page_id, get_post_type(), true, apply_filters('wpml_default_language', null));

$title    = __( mer_field('kp_model_title',    'Model współpracy'), 'meritoros' );
$subtitle = __( mer_field('kp_model_subtitle', "Możesz powierzyć nam całość procesów kadrowych lub wybrane obszary wymagające uporządkowania.\nDopasowujemy zakres wsparcia do realnej sytuacji Twojej firmy."), 'meritoros' );

$m1 = get_field('kp_model1') ?: ($_orig_id !== $_page_id ? get_field('kp_model1', $_orig_id) : null);
$m1_icon     = is_array($m1) && !empty($m1['icon'])     ? $m1['icon']     : 'users-round';
$m1_title    = __( is_array($m1) && !empty($m1['title'])    ? $m1['title']    : 'Kompleksowa obsługa', 'meritoros' );
$m1_text     = __( is_array($m1) && !empty($m1['text'])     ? $m1['text']     : 'Przejmujemy pełną obsługę kadrowo-płacową. Dedykowany zespół, terminowość i zgodność z przepisami.', 'meritoros' );
$m1_btn_text = __( is_array($m1) && !empty($m1['btn_text']) ? $m1['btn_text'] : 'Zapytaj o wycenę', 'meritoros' );
$m1_btn_url  = is_array($m1) && !empty($m1['btn_url'])  ? $m1['btn_url']  : home_url('/kontakt/');

$m2 = get_field('kp_model2') ?: ($_orig_id !== $_page_id ? get_field('kp_model2', $_orig_id) : null);
$m2_icon     = is_array($m2) && !empty($m2['icon'])     ? $m2['icon']     : 'pen-line';
$m2_title    = __( is_array($m2) && !empty($m2['title'])    ? $m2['title']    : 'Outsourcing wybranych procesów', 'meritoros' );
$m2_text     = __( is_array($m2) && !empty($m2['text'])     ? $m2['text']     : 'Wspieramy wybrane obszary dopasowane do Twoich potrzeb. Elastyczny zakres, który możesz rozszerzać.', 'meritoros' );
$m2_btn_text = __( is_array($m2) && !empty($m2['btn_text']) ? $m2['btn_text'] : 'Zapytaj o wycenę', 'meritoros' );
$m2_btn_url  = is_array($m2) && !empty($m2['btn_url'])  ? $m2['btn_url']  : home_url('/kontakt/');

$m1_items = [
    __('Dokumentacja pracownicza', 'meritoros'),
    __('Naliczanie wynagrodzeń', 'meritoros'),
    __('Rozliczenia i zgłoszenia do ZUS', 'meritoros'),
    __('Dedykowany opiekun', 'meritoros'),
    __('Raportowanie miesięczne', 'meritoros'),
];

$m2_items = [
    __('Obsługa samych płac', 'meritoros'),
    __('Rozliczenia z ZUS', 'meritoros'),
    __('Obsługa dokumentacji', 'meritoros'),
    __('Elastyczny zakres współpracy', 'meritoros'),
    __('Możliwość rozszerzenia zakresu', 'meritoros'),
];
?>

<section id="kp-model" class="py-12 md:py-24 bg-white">
    <div class="max-w-5xl mx-auto px-6">
        <div class="text-center mb-8 md:mb-12">
            <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight mb-4 text-slate-900"><?php echo mer_esc($title); ?></h2>
            <p class="text-base md:text-lg text-slate-500 max-w-2xl mx-auto"><?php echo nl2br(esc_html($subtitle)); ?></p>
        </div>

        <div class="grid md:grid-cols-2 gap-6">

            <!-- Karta 1: Pełny zakres -->
            <div class="rounded-3xl border-2 border-slate-200 p-8 flex flex-col hover:border-[#00d084] hover:shadow-lg hover:shadow-emerald-100 transition-all duration-300">
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <div class="text-xs font-bold uppercase tracking-widest text-[#00d084] mb-1"><?php _e('Pełny zakres', 'meritoros'); ?></div>
                        <h3 class="text-2xl font-bold text-slate-900"><?php echo mer_esc($m1_title); ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-[#00d084] shrink-0">
                        <i data-lucide="<?php echo esc_attr($m1_icon); ?>" class="w-5 h-5" stroke-width="1.5"></i>
                    </div>
                </div>
                <p class="text-slate-500 text-sm leading-relaxed mb-6"><?php echo mer_esc($m1_text); ?></p>
                <ul class="space-y-2.5 mb-8 flex-1">
                    <?php foreach ($m1_items as $item): ?>
                    <li class="flex items-start gap-3 text-sm text-slate-700">
                        <i data-lucide="check" class="w-4 h-4 text-[#00d084] shrink-0 mt-0.5" stroke-width="2.5"></i>
                        <?php echo esc_html($item); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?php echo esc_url($m1_btn_url); ?>" class="mer-btn w-full text-center inline-block px-6 py-3 rounded-full bg-[#00d084] text-white text-sm font-semibold hover:bg-[#00b872] transition-colors">
                    <?php echo mer_esc($m1_btn_text); ?>
                </a>
            </div>

            <!-- Karta 2: Wybrany zakres -->
            <div class="rounded-3xl border-2 border-slate-200 p-8 flex flex-col hover:border-[#00d084] hover:shadow-lg hover:shadow-emerald-100 transition-all duration-300">
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <div class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-1"><?php _e('Wybrany zakres', 'meritoros'); ?></div>
                        <h3 class="text-2xl font-bold text-slate-900"><?php echo mer_esc($m2_title); ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-[#00d084] shrink-0">
                        <i data-lucide="<?php echo esc_attr($m2_icon); ?>" class="w-5 h-5" stroke-width="1.5"></i>
                    </div>
                </div>
                <p class="text-slate-500 text-sm leading-relaxed mb-6"><?php echo mer_esc($m2_text); ?></p>
                <ul class="space-y-2.5 mb-8 flex-1">
                    <?php foreach ($m2_items as $item): ?>
                    <li class="flex items-start gap-3 text-sm text-slate-700">
                        <i data-lucide="check" class="w-4 h-4 text-[#00d084] shrink-0 mt-0.5" stroke-width="2.5"></i>
                        <?php echo esc_html($item); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?php echo esc_url($m2_btn_url); ?>" class="mer-btn mer-btn--white w-full text-center inline-block px-6 py-3 rounded-full border border-slate-200 text-slate-700 text-sm font-semibold hover:bg-slate-50 hover:border-slate-300 transition-colors">
                    <?php echo mer_esc($m2_btn_text); ?>
                </a>
            </div>

        </div>
    </div>
</section>
