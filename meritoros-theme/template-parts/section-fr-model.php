<?php
$_page_id = get_the_ID();
$_orig_id = apply_filters('wpml_object_id', $_page_id, get_post_type(), true, apply_filters('wpml_default_language', null));

$title    = mer_field('fr_model_title',    'Model współpracy');
$subtitle = mer_field('fr_model_subtitle', "Możesz powierzyć nam całość procesów księgowych lub wybrane obszary wymagające uporządkowania.\nDopasowujemy zakres wsparcia do realnej sytuacji Twojej firmy.");

$m1 = get_field('fr_model1') ?: ($_orig_id !== $_page_id ? get_field('fr_model1', $_orig_id) : null);
$m1_icon  = is_array($m1) && !empty($m1['icon'])  ? $m1['icon']  : 'network';
$m1_title = is_array($m1) && !empty($m1['title']) ? $m1['title'] : 'Kompleksowa obsługa';
$m1_text  = is_array($m1) && !empty($m1['text'])  ? $m1['text']  : 'Obsługujemy proces end-to-end: od bieżącej ewidencji po zamknięcie miesiąca i raporty. Pracujesz z zespołem, który zapewnia zastępowalność i stały standard.';

$m2 = get_field('fr_model2') ?: ($_orig_id !== $_page_id ? get_field('fr_model2', $_orig_id) : null);
$m2_image = is_array($m2) && !empty($m2['image']) ? $m2['image'] : null;
$m2_title = is_array($m2) && !empty($m2['title']) ? $m2['title'] : "Outsourcing wybranych\nprocesów";
$m2_text  = is_array($m2) && !empty($m2['text'])  ? $m2['text']  : 'Przejmujemy konkretne procesy i dowozimy je w ustalonym standardzie i harmonogramie. To rozwiązanie dla firm, które chcą wzmocnić wewnętrzny dział finansów bez rozbudowy etatów.';

$m2_img_url = is_array($m2_image) ? esc_url($m2_image['url']) : 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=800';
$m2_img_alt = is_array($m2_image) ? esc_attr($m2_image['alt'] ?: 'Outsourcing') : 'Outsourcing';
?>

<style>
.mer-model-panel {
    transform: translateY(100%);
    transition: transform 0.4s cubic-bezier(.4,0,.2,1);
}
@media (hover: hover) {
    .mer-model-card:hover .mer-model-panel { transform: translateY(0); }
}
.mer-model-card.open .mer-model-panel { transform: translateY(0); }
</style>

<section class="py-12 md:py-24 bg-emerald-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-8 md:mb-16">
            <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight mb-6"><?php echo mer_esc($title); ?></h2>
            <p class="text-base md:text-lg text-slate-500 max-w-4xl mx-auto"><?php echo nl2br(esc_html($subtitle)); ?></p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">

            <!-- Karta 1: biała z ikoną -->
            <div class="mer-model-card relative rounded-3xl overflow-hidden h-[420px] bg-white border border-slate-200 cursor-pointer">

                <!-- Warstwa domyślna -->
                <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-10">
                    <i data-lucide="<?php echo esc_attr($m1_icon); ?>" stroke-width="1" class="w-20 h-20 text-[#00d084] opacity-80 mb-6"></i>
                    <h3 class="text-3xl font-bold text-slate-900"><?php echo mer_esc($m1_title); ?></h3>
                </div>

                <!-- Panel hover -->
                <div class="mer-model-panel absolute inset-x-0 bottom-0 h-full bg-white p-10 flex flex-col justify-center">
                    <i data-lucide="<?php echo esc_attr($m1_icon); ?>" stroke-width="0.5" class="absolute right-6 top-6 w-32 h-32 text-slate-100 pointer-events-none"></i>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4"><?php echo mer_esc($m1_title); ?></h3>
                    <p class="text-lg text-slate-500 leading-relaxed"><?php echo mer_esc($m1_text); ?></p>
                </div>

            </div>

            <!-- Karta 2: ze zdjęciem -->
            <div class="mer-model-card relative rounded-3xl overflow-hidden h-[420px] cursor-pointer">

                <img src="<?php echo $m2_img_url; ?>" alt="<?php echo $m2_img_alt; ?>" class="absolute inset-0 w-full h-full object-cover" loading="lazy">

                <!-- Overlay domyślny -->
                <div class="absolute inset-0 bg-slate-900/45"></div>

                <!-- Warstwa domyślna -->
                <div class="absolute inset-0 flex items-center justify-center text-center p-10">
                    <h3 class="text-3xl font-bold text-white"><?php echo nl2br(esc_html($m2_title)); ?></h3>
                </div>

                <!-- Panel hover -->
                <div class="mer-model-panel absolute inset-x-0 bottom-0 h-full flex flex-col justify-end p-10">
                    <div class="absolute inset-0 bg-slate-900/75"></div>
                    <div class="relative z-10">
                        <h3 class="text-2xl font-bold text-white mb-4"><?php echo nl2br(esc_html($m2_title)); ?></h3>
                        <p class="text-lg text-white/80 leading-relaxed"><?php echo mer_esc($m2_text); ?></p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

<script>
document.querySelectorAll('.mer-model-card').forEach(function(card) {
    card.addEventListener('click', function() { this.classList.toggle('open'); });
});
</script>
