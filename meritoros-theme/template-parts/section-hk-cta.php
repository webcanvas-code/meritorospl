<?php
$page_id  = get_queried_object_id();
$title    = __( get_field('hk_cta_title',    $page_id) ?: "Porozmawiajmy o rozwiązaniach\ndla Twojego biznesu", 'meritoros' );
$text     = __( get_field('hk_cta_text',     $page_id) ?: 'Pierwsza rozmowa jest niezobowiązująca.', 'meritoros' );
$btn_text = __( get_field('hk_cta_btn_text', $page_id) ?: 'Wyślij zapytanie', 'meritoros' );
$btn_url  = get_field('hk_cta_btn_url',  $page_id) ?: home_url('/kontakt/');
$bg       = get_field('hk_cta_bg',       $page_id);
$bg_url   = is_array($bg) && !empty($bg['url']) ? esc_url($bg['url']) : 'https://images.unsplash.com/photo-1515187029135-18ee286d815b?w=1600&q=80';
?>

<section class="relative py-16 md:py-24 overflow-hidden">
    <img src="<?php echo $bg_url; ?>" alt="" class="absolute inset-0 w-full h-full object-cover object-center" loading="lazy">
    <div class="absolute inset-0 bg-slate-900/65"></div>

    <div class="relative z-10 max-w-3xl mx-auto px-6 text-center">
        <h2 class="text-pretty text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-white leading-tight mb-6">
            <?php echo nl2br(esc_html($title)); ?>
        </h2>
        <p class="text-base sm:text-lg text-white/70 leading-relaxed mb-10 max-w-lg mx-auto">
            <?php echo mer_esc($text); ?>
        </p>
        <a href="<?php echo esc_url($btn_url); ?>" class="mer-btn mer-btn--primary inline-flex items-center gap-2 px-8 py-4 rounded-full bg-[#00d084] text-white text-base font-semibold hover:bg-[#00b872] transition-colors">
            <?php echo mer_esc($btn_text); ?>
        </a>
    </div>
</section>
