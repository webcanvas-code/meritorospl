<?php
$title    = mer_field('uk_cta_title',    'Porozmawiajmy o obsłudze księgowej dla Twojej firmy');
$text     = mer_field('uk_cta_text',     'Skontaktuj się z nami i dowiedz się, jak możemy wesprzeć Twoją firmę.');
$btn_text = mer_field('uk_cta_btn_text', 'Umów się na rozmowę');
$btn_url  = mer_field('uk_cta_btn_url',  home_url('/kontakt/'));
?>

<section class="py-8 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="bg-[#00d084] rounded-2xl px-10 py-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-6">
                <div class="shrink-0 hidden sm:block">
                    <i data-lucide="message-square-text" stroke-width="1" class="w-16 h-16 text-white opacity-90"></i>
                </div>
                <div>
                    <h3 class="text-xl md:text-2xl font-bold text-white mb-1"><?php echo nl2br(esc_html($title)); ?></h3>
                    <p class="text-white/75 text-lg"><?php echo mer_esc($text); ?></p>
                </div>
            </div>
            <a href="<?php echo esc_url($btn_url); ?>" class="shrink-0 px-7 py-3.5 rounded-full bg-white text-slate-800 text-base font-semibold hover:bg-emerald-50 transition-colors whitespace-nowrap">
                <?php echo mer_esc($btn_text); ?>
            </a>
        </div>
    </div>
</section>
