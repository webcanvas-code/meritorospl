<?php
$_page_id = get_the_ID();
$_orig_id = apply_filters('wpml_object_id', $_page_id, get_post_type(), true, apply_filters('wpml_default_language', null));

$title    = __( mer_field('fr_model_title',    'Model współpracy'), 'meritoros' );
$subtitle = __( mer_field('fr_model_subtitle', "Możesz powierzyć nam całość procesów księgowych lub wybrane obszary wymagające uporządkowania.\nDopasowujemy zakres wsparcia do realnej sytuacji Twojej firmy."), 'meritoros' );

$m1 = get_field('fr_model1') ?: ($_orig_id !== $_page_id ? get_field('fr_model1', $_orig_id) : null);
$m1_icon  = is_array($m1) && !empty($m1['icon'])  ? $m1['icon']  : 'network';
$m1_title = __( is_array($m1) && !empty($m1['title']) ? $m1['title'] : 'Kompleksowa obsługa', 'meritoros' );
$m1_text  = __( is_array($m1) && !empty($m1['text'])  ? $m1['text']  : 'Obsługujemy proces end-to-end: od bieżącej ewidencji po zamknięcie miesiąca i raporty. Pracujesz z zespołem, który zapewnia zastępowalność i stały standard.', 'meritoros' );

$m2 = get_field('fr_model2') ?: ($_orig_id !== $_page_id ? get_field('fr_model2', $_orig_id) : null);
$m2_icon  = is_array($m2) && !empty($m2['icon'])  ? $m2['icon']  : 'pen-line';
$m2_title = __( is_array($m2) && !empty($m2['title']) ? $m2['title'] : 'Outsourcing wybranych procesów', 'meritoros' );
$m2_text  = __( is_array($m2) && !empty($m2['text'])  ? $m2['text']  : 'Przejmujemy konkretne procesy i dowozimy je w ustalonym standardzie i harmonogramie. To rozwiązanie dla firm, które chcą wzmocnić wewnętrzny dział finansów bez rozbudowy etatów.', 'meritoros' );

$btn_text = __('Zapytaj o wycenę', 'meritoros');
$btn_url  = home_url('/kontakt/');
?>

<section id="fr-model" class="py-12 md:py-24 bg-emerald-50">
    <div class="max-w-5xl mx-auto px-6">
        <div class="text-center mb-8 md:mb-12">
            <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight mb-4 text-slate-900"><?php echo mer_esc($title); ?></h2>
            <p class="text-base md:text-lg text-slate-500 max-w-2xl mx-auto"><?php echo nl2br(esc_html($subtitle)); ?></p>
        </div>

        <div class="grid md:grid-cols-2 gap-6">

            <!-- Karta 1: biała -->
            <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm flex flex-col">
                <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center mb-6 text-[#00d084]">
                    <i data-lucide="<?php echo esc_attr($m1_icon); ?>" class="w-7 h-7" stroke-width="1.5"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-3"><?php echo mer_esc($m1_title); ?></h3>
                <p class="text-slate-500 leading-relaxed flex-1"><?php echo mer_esc($m1_text); ?></p>
                <div class="mt-6">
                    <a href="<?php echo esc_url($btn_url); ?>" class="mer-btn mer-btn--white inline-flex px-6 py-2.5 rounded-full border border-slate-200 text-slate-700 text-sm font-medium hover:bg-slate-50 transition-colors">
                        <?php echo mer_esc($btn_text); ?>
                    </a>
                </div>
            </div>

            <!-- Karta 2: ciemna -->
            <div class="bg-slate-900 rounded-3xl p-8 flex flex-col">
                <div class="w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center mb-6 text-[#00d084]">
                    <i data-lucide="<?php echo esc_attr($m2_icon); ?>" class="w-7 h-7" stroke-width="1.5"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-3"><?php echo mer_esc($m2_title); ?></h3>
                <p class="text-white/60 leading-relaxed flex-1"><?php echo mer_esc($m2_text); ?></p>
                <div class="mt-6">
                    <a href="<?php echo esc_url($btn_url); ?>" class="mer-btn mer-btn--ghost inline-flex px-6 py-2.5 rounded-full border border-white/20 text-white text-sm font-medium hover:bg-white/10 transition-colors">
                        <?php echo mer_esc($btn_text); ?>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
