<?php
$title_before = mer_field('uk_hero_title_before', 'Rozwiązania księgowe dla firm, które');
$title_green  = mer_field('uk_hero_title_green',  'chcą mieć porządek');
$title_after  = mer_field('uk_hero_title_after',  'i spokój w biznesie');
$subtitle     = mer_field('uk_hero_subtitle', 'Zapewniamy kompleksową obsługę księgową firm o różnej skali działalności. Przejmujemy odpowiedzialność za poprawność, terminowość i ciągłość procesów księgowych, aby nasi klienci mogli skupić się na prowadzeniu i rozwoju biznesu.');
$btn1_text    = mer_field('uk_hero_btn1_text', 'Poznaj ofertę');
$btn1_url     = mer_field('uk_hero_btn1_url',  '#oferta');
$btn2_text    = mer_field('uk_hero_btn2_text', 'Porozmawiajmy');
$btn2_url     = mer_field('uk_hero_btn2_url',  home_url('/kontakt/'));
?>

<section class="relative bg-emerald-50 overflow-hidden pt-36 pb-16">

    <div class="absolute right-0 top-1/2 -translate-y-1/2 w-[460px] h-[460px] opacity-10 pointer-events-none pr-12 hidden lg:flex items-center justify-center">
        <svg viewBox="0 0 300 280" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full stroke-emerald-600" stroke-width="3">
            <rect x="40" y="20" width="220" height="240" rx="12"/>
            <line x1="40" y1="60" x2="260" y2="60"/>
            <line x1="120" y1="60" x2="120" y2="260"/>
            <line x1="190" y1="60" x2="190" y2="260"/>
            <line x1="40" y1="100" x2="260" y2="100"/>
            <line x1="40" y1="140" x2="260" y2="140"/>
            <line x1="40" y1="180" x2="260" y2="180"/>
            <line x1="40" y1="220" x2="260" y2="220"/>
            <rect x="133" y="72" width="20" height="20" rx="4"/>
            <polyline points="137,82 141,87 151,77"/>
            <rect x="133" y="112" width="20" height="20" rx="4"/>
            <rect x="133" y="152" width="20" height="20" rx="4"/>
            <polyline points="137,162 141,167 151,157"/>
            <rect x="133" y="192" width="20" height="20" rx="4"/>
            <rect x="203" y="72" width="20" height="20" rx="4"/>
            <rect x="203" y="112" width="20" height="20" rx="4"/>
            <polyline points="207,122 211,127 221,117"/>
            <rect x="203" y="152" width="20" height="20" rx="4"/>
            <rect x="203" y="192" width="20" height="20" rx="4"/>
            <polyline points="207,202 211,207 221,197"/>
            <line x1="55" y1="82" x2="105" y2="82" stroke-linecap="round"/>
            <line x1="55" y1="122" x2="100" y2="122" stroke-linecap="round"/>
            <line x1="55" y1="162" x2="108" y2="162" stroke-linecap="round"/>
            <line x1="55" y1="202" x2="95" y2="202" stroke-linecap="round"/>
            <line x1="55" y1="232" x2="110" y2="232" stroke-linecap="round"/>
        </svg>
    </div>

    <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-emerald-200/40 rounded-full blur-3xl translate-x-1/3 -translate-y-1/4 pointer-events-none"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">

        <div class="flex items-center gap-2 text-sm text-slate-400 mb-6">
            <span><?php esc_html_e('Strona główna', 'meritoros'); ?></span>
            <span>/</span>
            <span>Biuro rachunkowe</span>
            <span>/</span>
            <span class="text-slate-600 font-medium">Usługi księgowe</span>
        </div>

        <div class="max-w-4xl">
            <h1 class="text-pretty text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight mb-6 leading-[1.1] text-slate-900">
                <?php echo mer_esc($title_before); ?> <span class="text-[#00d084]"><?php echo mer_esc($title_green); ?></span> <?php echo mer_esc($title_after); ?>
            </h1>
            <p class="text-base sm:text-lg text-slate-500 mb-8 leading-relaxed max-w-5xl">
                <?php echo wp_kses_post($subtitle); ?>
            </p>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="<?php echo esc_url($btn2_url); ?>" class="mer-btn mer-btn--primary px-7 py-3.5 rounded-full bg-[#00d084] text-white text-base font-semibold hover:bg-[#00b872] transition-colors flex items-center justify-center">
                    <?php echo mer_esc($btn2_text); ?>
                </a>
                <a href="<?php echo esc_url($btn1_url); ?>" class="mer-btn mer-btn--white px-7 py-3.5 rounded-full border border-slate-300 text-slate-700 text-base font-semibold hover:bg-white transition-colors flex items-center justify-center">
                    <?php echo mer_esc($btn1_text); ?>
                </a>
            </div>
        </div>
    </div>
</section>
