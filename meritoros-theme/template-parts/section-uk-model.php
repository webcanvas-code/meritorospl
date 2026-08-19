<?php
$_page_id = get_the_ID();
$_orig_id = apply_filters('wpml_object_id', $_page_id, get_post_type(), true, apply_filters('wpml_default_language', null));

$title    = mer_field('uk_model_title',    'Model współpracy');
$subtitle = mer_field('uk_model_subtitle', "Możesz powierzyć nam całość procesów księgowych lub wybrane obszary wymagające uporządkowania.\nDopasowujemy zakres wsparcia do realnej sytuacji Twojej firmy.");

$m1 = get_field('uk_model1') ?: ($_orig_id !== $_page_id ? get_field('uk_model1', $_orig_id) : null);
$m1_icon  = is_array($m1) && !empty($m1['icon'])  ? $m1['icon']  : 'network';
$m1_title = is_array($m1) && !empty($m1['title']) ? $m1['title'] : 'Kompleksowa obsługa';
$m1_text  = is_array($m1) && !empty($m1['text'])  ? $m1['text']  : 'Obsługujemy proces end-to-end: od bieżącej ewidencji po zamknięcie miesiąca i raporty. Pracujesz z zespołem, który zapewnia zastępowalność i stały standard.';

$m2 = get_field('uk_model2') ?: ($_orig_id !== $_page_id ? get_field('uk_model2', $_orig_id) : null);
$m2_image = is_array($m2) && !empty($m2['image']) ? $m2['image'] : null;
$m2_title = is_array($m2) && !empty($m2['title']) ? $m2['title'] : "Outsourcing wybranych\nprocesów";
$m2_text  = is_array($m2) && !empty($m2['text'])  ? $m2['text']  : 'Przejmujemy konkretne procesy i dowozimy je w ustalonym standardzie i harmonogramie. To rozwiązanie dla firm, które chcą wzmocnić wewnętrzny dział finansów bez rozbudowy etatów.';

$m2_img_url = is_array($m2_image) ? esc_url($m2_image['url']) : 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=800';
$m2_img_alt = is_array($m2_image) ? esc_attr($m2_image['alt'] ?: 'Outsourcing') : 'Outsourcing';
?>

<style>
.mer-model-expand {
    display: grid;
    grid-template-rows: 0fr;
    transition: grid-template-rows 0.45s cubic-bezier(.4,0,.2,1);
}
.mer-model-expand > div { overflow: hidden; }
.mer-model-chevron { transition: transform 0.3s ease; }
@media (hover: hover) {
    .mer-model-card:hover .mer-model-expand { grid-template-rows: 1fr; }
    .mer-model-card:hover .mer-model-chevron { transform: rotate(180deg); }
}
.mer-model-card.open .mer-model-expand { grid-template-rows: 1fr; }
.mer-model-card.open .mer-model-chevron { transform: rotate(180deg); }
</style>

<section class="py-12 md:py-24 bg-emerald-50 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="text-center mb-8 md:mb-16">
            <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight mb-6"><?php echo mer_esc($title); ?></h2>
            <p class="text-base md:text-lg text-slate-500 max-w-4xl mx-auto"><?php echo nl2br(esc_html($subtitle)); ?></p>
        </div>

        <div class="grid md:grid-cols-2 gap-6 md:gap-8 items-start">

            <!-- Karta 1: biała z ikoną -->
            <div class="mer-model-card rounded-3xl bg-white border border-slate-200 p-8 md:p-10 cursor-pointer">
                <div class="flex flex-col items-center text-center">
                    <i data-lucide="<?php echo esc_attr($m1_icon); ?>" stroke-width="1" class="w-16 h-16 md:w-20 md:h-20 text-[#00d084] mb-6 opacity-80"></i>
                    <h3 class="text-2xl md:text-3xl font-bold tracking-tight text-slate-900"><?php echo mer_esc($m1_title); ?></h3>
                    <div class="mer-model-expand w-full mt-1">
                        <div>
                            <p class="text-base md:text-lg text-slate-500 leading-relaxed pt-4"><?php echo mer_esc($m1_text); ?></p>
                        </div>
                    </div>
                    <div class="mer-model-chevron mt-5">
                        <i data-lucide="chevron-down" class="w-5 h-5 text-slate-300 stroke-[2]"></i>
                    </div>
                </div>
            </div>

            <!-- Karta 2: ze zdjęciem -->
            <div class="mer-model-card rounded-3xl overflow-hidden relative cursor-pointer min-h-[280px]">
                <img src="<?php echo $m2_img_url; ?>" alt="<?php echo $m2_img_alt; ?>" class="absolute inset-0 w-full h-full object-cover" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/85 via-slate-900/25 to-transparent"></div>
                <div class="relative z-10 flex flex-col justify-end p-8 md:p-10 min-h-[280px]">
                    <h3 class="text-2xl md:text-3xl font-bold tracking-tight text-white"><?php echo nl2br(esc_html($m2_title)); ?></h3>
                    <div class="mer-model-expand mt-1">
                        <div>
                            <p class="text-base md:text-lg text-white/80 leading-relaxed pt-4"><?php echo mer_esc($m2_text); ?></p>
                        </div>
                    </div>
                    <div class="mer-model-chevron mt-4">
                        <i data-lucide="chevron-down" class="w-5 h-5 text-white/50 stroke-[2]"></i>
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
