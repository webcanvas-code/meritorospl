<?php
$title    = mer_field('kp_cta_title',    'Porozmawiajmy o obsłudze kadrowej dla Twojej firmy');
$text     = mer_field('kp_cta_text',     'Skontaktuj się z nami i dowiedz się, jak możemy wesprzeć Twój dział HR i płac.');
$btn_text = mer_field('kp_cta_btn_text', 'Umów się na rozmowę');
$btn_url  = mer_field('kp_cta_btn_url',  home_url('/kontakt/'));
?>

<section class="py-10 md:py-12 px-6 lg:px-12 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="bg-[#2d8650] rounded-2xl px-8 py-8 md:px-12 md:py-10 flex flex-col md:flex-row items-center gap-8">
            <div class="shrink-0 text-white opacity-90">
                <svg width="72" height="60" viewBox="0 0 72 60" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="20" cy="38" r="8"/>
                    <path d="M6 56c0-7.732 6.268-14 14-14"/>
                    <circle cx="52" cy="38" r="8"/>
                    <path d="M66 56c0-7.732-6.268-14-14-14"/>
                    <rect x="4" y="4" width="28" height="18" rx="6"/>
                    <path d="M14 22v6l6-6"/>
                    <rect x="40" y="4" width="28" height="18" rx="6"/>
                    <path d="M58 22v6l-6-6"/>
                </svg>
            </div>
            <div class="flex-1 text-white text-center md:text-left">
                <h3 class="text-xl md:text-2xl font-bold tracking-tight mb-1"><?php echo nl2br(esc_html($title)); ?></h3>
                <p class="text-white/75 text-lg mt-2"><?php echo mer_esc($text); ?></p>
            </div>
            <a href="<?php echo esc_url($btn_url); ?>" class="shrink-0 px-7 py-3.5 rounded-full bg-white text-slate-900 text-base font-semibold hover:bg-slate-100 transition-colors whitespace-nowrap">
                <?php echo mer_esc($btn_text); ?>
            </a>
        </div>
    </div>
</section>
