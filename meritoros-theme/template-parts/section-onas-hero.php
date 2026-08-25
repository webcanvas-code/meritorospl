<?php
$hero_bg    = get_field('onas_hero_bg');
$hero_title = mer_field('onas_hero_title', 'Poznaj nasze biuro rachunkowe i wartości, które stoją za naszą codzienną pasją.');
$hero_sub   = mer_field('onas_hero_sub', 'Pracujemy tak, by być dumni z jakości informacji dostarczanych naszym klientom.');
$btn1_text  = mer_field('onas_hero_btn1_text', 'Poznaj ofertę');
$btn1_url   = mer_field('onas_hero_btn1_url', '#');
$btn2_text  = mer_field('onas_hero_btn2_text', 'Porozmawiamy');
$btn2_url   = mer_field('onas_hero_btn2_url', home_url('/kontakt/'));

$bg_url = is_array($hero_bg) ? esc_url($hero_bg['url']) : '';
?>

<section class="relative overflow-hidden pt-36 pb-16">
    <div class="absolute inset-0 z-0 bg-slate-900">
        <?php if ($bg_url) : ?>
            <img src="<?php echo $bg_url; ?>" alt="" aria-hidden="true"
                 style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center;">
        <?php endif; ?>
        <div class="absolute inset-0 bg-slate-900/65"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">

        <div class="flex items-center gap-2 text-sm text-white/60 mb-6">
            <span><?php esc_html_e('Strona główna', 'meritoros'); ?></span>
            <span>/</span>
            <span class="text-white/90 font-medium"><?php echo mer_esc(get_the_title()); ?></span>
        </div>

        <div class="max-w-4xl">
            <h1 class="text-pretty text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight mb-6 leading-[1.1] text-white">
                <?php echo nl2br(esc_html($hero_title)); ?>
            </h1>
            <p class="text-base sm:text-lg text-white/70 mb-10 leading-relaxed max-w-5xl">
                <?php echo wp_kses_post($hero_sub); ?>
            </p>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="<?php echo esc_url($btn2_url); ?>"
                    class="mer-btn mer-btn--primary px-7 py-3.5 rounded-full bg-[#00d084] text-white text-base font-semibold hover:bg-[#00b872] transition-colors flex items-center justify-center">
                    <?php echo mer_esc($btn2_text); ?>
                </a>
                <a href="<?php echo esc_url($btn1_url); ?>"
                    class="mer-btn mer-btn--ghost px-7 py-3.5 rounded-full border border-white/40 text-white text-base font-semibold hover:bg-white/10 transition-colors flex items-center justify-center">
                    <?php echo mer_esc($btn1_text); ?>
                </a>
            </div>
        </div>

    </div>
</section>
