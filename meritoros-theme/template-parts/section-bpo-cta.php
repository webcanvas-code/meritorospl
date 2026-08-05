<?php
$title    = mer_field('bpo_cta_title', 'Porozmawiajmy o obsłudze księgowej dla Twojej firmy');
$subtitle = mer_field('bpo_cta_subtitle', 'Skontaktuj się z nami i dowiedz się, jak możemy wesprzeć Twoją organizację.');
$btn_text = mer_field('bpo_cta_btn_text', 'Umów się na rozmowę');
$btn_url  = mer_field('bpo_cta_btn_url',  home_url('/kontakt/'));
?>

<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="bg-[#00d084] rounded-2xl p-10 md:p-14 flex flex-col md:flex-row items-center justify-between gap-8 text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-10" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, #ffffff 10px, #ffffff 11px);"></div>

            <div class="flex items-center gap-6 relative z-10">
                <div class="w-20 h-20 shrink-0 hidden md:flex items-center justify-center bg-white/10 rounded-2xl">
                    <i data-lucide="message-square-text" stroke-width="1.5" class="w-10 h-10 text-white"></i>
                </div>
                <div>
                    <h3 class="text-3xl font-bold tracking-tight mb-2"><?php echo nl2br(esc_html($title)); ?></h3>
                    <p class="text-emerald-50 text-lg"><?php echo mer_esc($subtitle); ?></p>
                </div>
            </div>
            <div class="relative z-10 shrink-0">
                <a href="<?php echo esc_url($btn_url); ?>" class="px-8 py-4 rounded-full bg-white text-[#00d084] text-base font-medium hover:bg-emerald-50 transition-colors inline-block">
                    <?php echo mer_esc($btn_text); ?>
                </a>
            </div>
        </div>
    </div>
</section>
