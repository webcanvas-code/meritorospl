<?php
$bg_img    = get_field('hero_bg_image');
$bg_url    = is_array($bg_img) ? esc_url($bg_img['url']) : 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=2070&q=80';
$bg_alt    = is_array($bg_img) ? esc_attr($bg_img['alt']) : 'Team meeting';
$headline  = __( mer_field('hero_headline', "Eksperci w księgowości.\nTechnologia i pewność\nw działaniu."), 'meritoros' );
$sub       = __( mer_field('hero_subheadline', 'Zapewniamy księgowość kadry i outsourcing procesów w standardzie, który daje firmom spokój i bezpieczeństwo.'), 'meritoros' );
$btn1_text = __( mer_field('hero_btn1_text', 'Poznaj ofertę'), 'meritoros' );
$btn1_url  = mer_field('hero_btn1_url', '#uslugi');
$btn2_text = __( mer_field('hero_btn2_text', 'Porozmawiajmy'), 'meritoros' );
$btn2_url  = mer_field('hero_btn2_url', '#kontakt');
?>

<section id="hero" class="relative min-h-screen min-h-[100svh] flex flex-col overflow-hidden px-6 lg:px-12">
    <!-- Background -->
    <div class="absolute inset-0 z-0 bg-slate-900">
        <img src="<?php echo $bg_url; ?>" alt="<?php echo $bg_alt; ?>"
             style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center;">
        <div class="absolute inset-0 bg-slate-900/50 sm:bg-slate-900/25 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/40 via-slate-900/20 to-slate-900/70 sm:bg-gradient-to-r sm:from-slate-900/80 sm:via-slate-900/40 sm:to-transparent"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 max-w-[1400px] mx-auto w-full flex flex-col flex-1 pt-36 pb-16">
        <div class="max-w-3xl w-full flex flex-col justify-center flex-1">

            <h1 class="text-pretty text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white leading-[1.1] mb-5 drop-shadow-md">
                <?php echo mer_esc_bold($headline); ?>
            </h1>

            <p class="text-base sm:text-lg font-light text-slate-200 mb-8 max-w-4xl leading-relaxed">
                <?php echo wp_kses_post($sub); ?>
            </p>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="<?php echo esc_url($btn2_url); ?>"
                   class="mer-btn mer-btn--primary bg-[#00d084] text-white px-7 py-3 rounded-full text-base font-semibold hover:bg-[#00b872] hover:shadow-lg hover:shadow-[#00d084]/30 transition-all duration-300 flex items-center justify-center">
                    <?php echo mer_esc($btn2_text); ?>
                </a>
                <a href="<?php echo esc_url($btn1_url); ?>"
                   class="mer-btn mer-btn--ghost bg-white/10 backdrop-blur-md border border-white/20 text-white px-7 py-3 rounded-full text-base font-semibold hover:bg-white/20 hover:border-white/30 transition-all duration-300 flex items-center justify-center">
                    <?php echo mer_esc($btn1_text); ?>
                </a>
            </div>
        </div>

    </div>
</section>
