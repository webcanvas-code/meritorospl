<?php
$title    = mer_field('bpo_model_title', 'Model współpracy');
$subtitle = mer_field('bpo_model_subtitle', "Możesz powierzyć nam całość procesów księgowych lub wybrane obszary wymagające uporządkowania.\nDopasowujemy zakres wsparcia do realnej sytuacji Twojej firmy.");

$m1 = get_field('bpo_model1');
$m1_icon  = is_array($m1) && !empty($m1['icon'])  ? $m1['icon']  : 'network';
$m1_title = is_array($m1) && !empty($m1['title']) ? $m1['title'] : 'Kompleksowa obsługa';
$m1_text  = is_array($m1) && !empty($m1['text'])  ? $m1['text']  : 'Obsługujemy proces end-to-end: od bieżącej ewidencji po zamknięcie miesiąca i raporty. Pracujesz z zespołem, który zapewnia zastępowalność i stały standard.';

$m2 = get_field('bpo_model2');
$m2_image = is_array($m2) && !empty($m2['image']) ? $m2['image'] : null;
$m2_title = is_array($m2) && !empty($m2['title']) ? $m2['title'] : "Outsourcing wybranych\nprocesów";
$m2_text  = is_array($m2) && !empty($m2['text'])  ? $m2['text']  : 'Przejmujemy konkretne procesy i dowozimy je w ustalonym standardzie i harmonogramie. To rozwiązanie dla firm, które chcą wzmocnić wewnętrzny dział finansów bez rozbudowy etatów.';

$m2_img_url = is_array($m2_image) ? esc_url($m2_image['url']) : 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=800';
$m2_img_alt = is_array($m2_image) ? esc_attr($m2_image['alt'] ?: 'Outsourcing') : 'Outsourcing';
?>

<style>
    .flip-card { perspective: 1000px; cursor: pointer; }
    .flip-card-inner { position: relative; width: 100%; height: 100%; transform-style: preserve-3d; transition: transform 0.65s cubic-bezier(.4,0,.2,1); }
    @media (hover: hover) {
        .flip-card:hover .flip-card-inner { transform: rotateY(180deg); }
    }
    .flip-card.flipped .flip-card-inner { transform: rotateY(180deg); }
    .flip-card-front, .flip-card-back { position: absolute; inset: 0; backface-visibility: hidden; -webkit-backface-visibility: hidden; border-radius: 1.5rem; overflow: hidden; }
    .flip-card-back { transform: rotateY(180deg); }
    .flip-hint { display: none; }
    @media (hover: none) { .flip-hint { display: flex; } }
</style>

<section class="py-12 md:py-24 bg-emerald-50 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="text-center mb-8 md:mb-16">
            <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight mb-6"><?php echo mer_esc($title); ?></h2>
            <p class="text-base md:text-lg text-slate-500 max-w-4xl mx-auto"><?php echo nl2br(esc_html($subtitle)); ?></p>
        </div>

        <div class="grid md:grid-cols-2 gap-6 md:gap-8">

            <!-- Card 1 -->
            <div class="flip-card h-[320px] md:h-[380px]">
                <div class="flip-card-inner">
                    <div class="flip-card-front bg-white border border-slate-200 flex flex-col items-center justify-center text-center p-8 md:p-12">
                        <i data-lucide="<?php echo esc_attr($m1_icon); ?>" stroke-width="1" class="w-16 h-16 md:w-24 md:h-24 text-[#00d084] mb-5 md:mb-8 opacity-80"></i>
                        <h3 class="text-2xl md:text-3xl font-bold tracking-tight text-slate-900"><?php echo mer_esc($m1_title); ?></h3>
                        <span class="flip-hint items-center gap-1.5 mt-4 text-xs text-slate-400">
                            <i data-lucide="hand-metal" class="w-3.5 h-3.5"></i> Dotknij, aby zobaczyć więcej
                        </span>
                    </div>
                    <div class="flip-card-back bg-white border border-slate-200 flex flex-col justify-center p-8 md:p-12 relative">
                        <i data-lucide="<?php echo esc_attr($m1_icon); ?>" stroke-width="0.5" class="absolute right-6 top-6 w-28 md:w-36 h-28 md:h-36 text-emerald-100 pointer-events-none"></i>
                        <h3 class="text-xl md:text-2xl font-bold tracking-tight text-slate-900 mb-4 md:mb-5"><?php echo mer_esc($m1_title); ?></h3>
                        <p class="text-sm md:text-base text-slate-500 leading-relaxed"><?php echo mer_esc($m1_text); ?></p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="flip-card h-[320px] md:h-[380px]">
                <div class="flip-card-inner">
                    <div class="flip-card-front relative flex flex-col items-center justify-center text-center">
                        <img src="<?php echo $m2_img_url; ?>" alt="<?php echo $m2_img_alt; ?>" class="absolute inset-0 w-full h-full object-cover" loading="lazy">
                        <div class="absolute inset-0 bg-slate-900/50"></div>
                        <h3 class="text-2xl md:text-3xl font-bold tracking-tight text-white relative z-10 px-8"><?php echo nl2br(esc_html($m2_title)); ?></h3>
                        <span class="flip-hint relative z-10 items-center gap-1.5 mt-4 text-xs text-white/60">
                            <i data-lucide="hand-metal" class="w-3.5 h-3.5"></i> Dotknij, aby zobaczyć więcej
                        </span>
                    </div>
                    <div class="flip-card-back relative flex flex-col justify-center p-8 md:p-12">
                        <img src="<?php echo $m2_img_url; ?>" alt="<?php echo $m2_img_alt; ?>" class="absolute inset-0 w-full h-full object-cover" loading="lazy">
                        <div class="absolute inset-0 bg-slate-900/70"></div>
                        <div class="relative z-10">
                            <h3 class="text-xl md:text-2xl font-bold tracking-tight text-white mb-4 md:mb-5"><?php echo nl2br(esc_html($m2_title)); ?></h3>
                            <p class="text-sm md:text-base text-white/80 leading-relaxed"><?php echo mer_esc($m2_text); ?></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
document.querySelectorAll('.flip-card').forEach(function (card) {
    card.addEventListener('click', function () {
        this.classList.toggle('flipped');
    });
});
</script>
