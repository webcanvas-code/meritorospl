<?php
$_page_id = get_the_ID();
$_orig_id = apply_filters('wpml_object_id', $_page_id, get_post_type(), true, apply_filters('wpml_default_language', null));

$title    = mer_field('kp_model_title',    'Model współpracy');
$subtitle = mer_field('kp_model_subtitle', "Możesz powierzyć nam całość procesów kadrowych lub wybrane obszary wymagające uporządkowania.\nDopasowujemy zakres wsparcia do realnej sytuacji Twojej firmy.");

$m1 = get_field('kp_model1') ?: ($_orig_id !== $_page_id ? get_field('kp_model1', $_orig_id) : null);
$m1_icon     = is_array($m1) && !empty($m1['icon'])     ? $m1['icon']     : 'users-round';
$m1_title    = is_array($m1) && !empty($m1['title'])    ? $m1['title']    : 'Kompleksowa obsługa';
$m1_text     = is_array($m1) && !empty($m1['text'])     ? $m1['text']     : 'Przejmujemy pełną obsługę kadr i płac: dokumentację pracowniczą, naliczanie wynagrodzeń oraz rozliczenia i zgłoszenia do instytucji (m.in. ZUS). Pracujesz z dedykowanym zespołem i masz pewność terminowości oraz zgodności z przepisami.';
$m1_btn_text = is_array($m1) && !empty($m1['btn_text']) ? $m1['btn_text'] : 'Zobacz';
$m1_btn_url  = is_array($m1) && !empty($m1['btn_url'])  ? $m1['btn_url']  : home_url('/kontakt/');

$m2 = get_field('kp_model2') ?: ($_orig_id !== $_page_id ? get_field('kp_model2', $_orig_id) : null);
$m2_image    = is_array($m2) && !empty($m2['image'])    ? $m2['image']    : null;
$m2_title    = is_array($m2) && !empty($m2['title'])    ? $m2['title']    : "Outsourcing wybranych\nprocesów";
$m2_text     = is_array($m2) && !empty($m2['text'])     ? $m2['text']     : 'Wspieramy wybrane obszary, które wymagają uporządkowania lub odciążenia zespołu np. same płace, obsługę dokumentacji, rozliczenia z ZUS czy raportowanie. Ustalamy standard i harmonogram działania, a zakres współpracy możesz elastycznie rozszerzać.';
$m2_btn_text = is_array($m2) && !empty($m2['btn_text']) ? $m2['btn_text'] : 'Zobacz';
$m2_btn_url  = is_array($m2) && !empty($m2['btn_url'])  ? $m2['btn_url']  : home_url('/kontakt/');

$m2_img_url = is_array($m2_image) ? esc_url($m2_image['url']) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=900';
$m2_img_alt = is_array($m2_image) ? esc_attr($m2_image['alt'] ?: 'Outsourcing') : 'Outsourcing';
?>

<style>
    .kp-flip-card { perspective: 1000px; cursor: pointer; }
    .kp-flip-card-inner { position: relative; width: 100%; height: 100%; transform-style: preserve-3d; transition: transform 0.65s cubic-bezier(.4,0,.2,1); }
    @media (hover: hover) {
        .kp-flip-card:hover .kp-flip-card-inner { transform: rotateY(180deg); }
    }
    .kp-flip-card.flipped .kp-flip-card-inner { transform: rotateY(180deg); }
    .kp-flip-card-front, .kp-flip-card-back { position: absolute; inset: 0; backface-visibility: hidden; -webkit-backface-visibility: hidden; border-radius: 1.5rem; overflow: hidden; }
    .kp-flip-card-back { transform: rotateY(180deg); }
    .kp-flip-hint { display: none; }
    @media (hover: none) { .kp-flip-hint { display: flex; } }
</style>

<section class="py-12 md:py-24 bg-emerald-50 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="text-center mb-8 md:mb-16">
            <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight mb-6"><?php echo mer_esc($title); ?></h2>
            <p class="text-base sm:text-lg text-slate-500 max-w-4xl mx-auto"><?php echo nl2br(esc_html($subtitle)); ?></p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">

            <!-- Karta 1 -->
            <div class="kp-flip-card h-[420px]">
                <div class="kp-flip-card-inner">
                    <div class="kp-flip-card-front bg-white border border-slate-200 flex flex-col items-center justify-center text-center p-12">
                        <i data-lucide="<?php echo esc_attr($m1_icon); ?>" stroke-width="1" class="w-24 h-24 text-[#48c279] mb-8 opacity-80"></i>
                        <h3 class="text-3xl font-bold tracking-tight text-slate-900"><?php echo mer_esc($m1_title); ?></h3>
                        <span class="kp-flip-hint items-center gap-1.5 mt-4 text-xs text-slate-400">
                            <i data-lucide="hand-metal" class="w-3.5 h-3.5"></i> Dotknij, aby zobaczyć więcej
                        </span>
                    </div>
                    <div class="kp-flip-card-back bg-white border border-slate-200 flex flex-col justify-center p-12 relative">
                        <i data-lucide="<?php echo esc_attr($m1_icon); ?>" stroke-width="0.5" class="absolute right-6 top-6 w-36 h-36 text-emerald-100 pointer-events-none"></i>
                        <h3 class="text-2xl font-bold tracking-tight text-slate-900 mb-5"><?php echo mer_esc($m1_title); ?></h3>
                        <p class="text-base sm:text-lg text-slate-500 leading-relaxed mb-8"><?php echo mer_esc($m1_text); ?></p>
                        <a href="<?php echo esc_url($m1_btn_url); ?>" class="inline-flex px-7 py-3 rounded-full bg-[#48c279] text-white text-sm font-medium hover:bg-[#3ea868] transition-colors self-start">
                            <?php echo mer_esc($m1_btn_text); ?>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Karta 2 -->
            <div class="kp-flip-card h-[420px]">
                <div class="kp-flip-card-inner">
                    <div class="kp-flip-card-front relative flex items-center justify-center text-center">
                        <img src="<?php echo $m2_img_url; ?>" alt="<?php echo $m2_img_alt; ?>" class="absolute inset-0 w-full h-full object-cover" loading="lazy">
                        <div class="absolute inset-0 bg-slate-900/50"></div>
                        <div class="relative z-10 px-8">
                            <h3 class="text-3xl font-bold tracking-tight text-white"><?php echo nl2br(esc_html($m2_title)); ?></h3>
                            <span class="kp-flip-hint items-center gap-1.5 mt-4 text-xs text-white/60">
                                <i data-lucide="hand-metal" class="w-3.5 h-3.5"></i> Dotknij, aby zobaczyć więcej
                            </span>
                        </div>
                    </div>
                    <div class="kp-flip-card-back relative flex flex-col justify-center p-12">
                        <img src="<?php echo $m2_img_url; ?>" alt="<?php echo $m2_img_alt; ?>" class="absolute inset-0 w-full h-full object-cover" loading="lazy">
                        <div class="absolute inset-0 bg-slate-900/75"></div>
                        <div class="relative z-10">
                            <h3 class="text-2xl font-bold tracking-tight text-white mb-5"><?php echo nl2br(esc_html($m2_title)); ?></h3>
                            <p class="text-base sm:text-lg text-white/80 leading-relaxed mb-8"><?php echo mer_esc($m2_text); ?></p>
                            <a href="<?php echo esc_url($m2_btn_url); ?>" class="inline-flex px-7 py-3 rounded-full bg-[#48c279] text-white text-sm font-medium hover:bg-[#3ea868] transition-colors self-start">
                                <?php echo mer_esc($m2_btn_text); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
document.querySelectorAll('.kp-flip-card').forEach(function(card) {
    card.addEventListener('click', function() { this.classList.toggle('flipped'); });
});
</script>
