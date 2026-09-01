<?php
$w_label = __( mer_field('onas_w_label', 'Nasze Wartości'), 'meritoros' );
$w_title = __( mer_field('onas_w_title', "Dlaczego Meritoros to spokój\nw Twoim biznesie?"), 'meritoros' );

// Card 1 — white
$w1_icon  = mer_field('onas_w1_icon',  'infinity');
$w1_title = __( mer_field('onas_w1_title', "Skala i ciągłość\nobsługi"), 'meritoros' );
$w1_text  = __( mer_field('onas_w1_text',  'Pracujemy zespołowo i procesowo, dzięki czemu obsługa nie zależy od jednej osoby. Zapewniamy zastępowalność i ciągłość pracy – bez przestojów.'), 'meritoros' );

// Card 2 — image
$w2_image = get_field('onas_w2_image');
$w2_hover = __( mer_field('onas_w2_hover', 'Współpracuj z profesjonalistami'), 'meritoros' );
$w2_url   = mer_field('onas_w2_url',   home_url('/kontakt/'));

// Card 3 — dark
$w3_icon  = mer_field('onas_w3_icon',  'shield-check');
$w3_title = __( mer_field('onas_w3_title', "Bezpieczeństwo\ni compliance"), 'meritoros' );
$w3_text  = __( mer_field('onas_w3_text',  'Działamy zgodnie z obowiązującymi regulacjami i standardami bezpieczeństwa danych. Dbamy o poufność informacji oraz jasne zasady współpracy - bez "skrótów" i ryzyk.'), 'meritoros' );
$w3_badge = get_field('onas_w3_badge');

// Card 4 — green (accent)
$w4_icon  = mer_field('onas_w4_icon',  'bot');
$w4_title = __( mer_field('onas_w4_title', "Technologia\ni automatyzacja"), 'meritoros' );
$w4_text  = __( mer_field('onas_w4_text',  'Wykorzystujemy narzędzia i automatyzację (RPA), które porządkują obieg dokumentów, ograniczają ryzyko błędów i usprawniają pracę zespołów.'), 'meritoros' );

// Card 5 — awards (loga pobierane tak samo jak na homepage — ze strony BPO)
$w5_title  = __( mer_field('onas_w5_title', 'Nagrody i wyróżnienia'), 'meritoros' );
$w5_text   = __( mer_field('onas_w5_text',  'Wyróżnienia są efektem tego, jak rozwijamy Meritoros: konsekwentnie i procesowo. Trzymamy standard, który ma działać w praktyce - codziennie.'), 'meritoros' );
$_bpo_pages = get_posts(['post_type' => 'page', 'meta_key' => '_wp_page_template', 'meta_value' => 'page-bpo.php', 'posts_per_page' => 1, 'fields' => 'ids']);
$_bpo_id    = !empty($_bpo_pages) ? $_bpo_pages[0] : 0;

// Card 6 — quality
$w6_icon  = mer_field('onas_w6_icon',  'award');
$w6_title = __( mer_field('onas_w6_title', "Jakość potwierdzona\nstandardami"), 'meritoros' );
$w6_text  = __( mer_field('onas_w6_text',  'Mamy wdrożone procedury kontroli jakości i weryfikacji danych. Dostarczamy spójne dane dla zarządu.'), 'meritoros' );
$w6_badge = get_field('onas_w6_badge');

$w2_img_url = is_array($w2_image) ? esc_url($w2_image['url']) : '';
$w2_img_alt = is_array($w2_image) ? esc_attr($w2_image['alt'] ?: __('Zespół Meritoros', 'meritoros')) : __('Zespół Meritoros', 'meritoros');

$_img         = get_template_directory_uri() . '/images/';
$_w5_l1       = ($_bpo_id ? get_field('bpo_awards_logo1', $_bpo_id) : null) ?: ['url' => $_img . 'forbes.png',      'alt' => 'Forbes'];
$_w5_l2       = ($_bpo_id ? get_field('bpo_awards_logo2', $_bpo_id) : null) ?: ['url' => $_img . 'logo_gazele.png', 'alt' => 'Gazele Biznesu'];
$_iso27_url   = is_array($w3_badge) ? esc_url($w3_badge['url']) : esc_url($_img . 'ISO27001.png');
$_iso9_url    = is_array($w6_badge) ? esc_url($w6_badge['url']) : esc_url($_img . 'ISO9001.png');
?>

<style>
    .val-iso27001 { width: 52px; height: 55px; }
    .val-iso9001  { width: 42px; height: 43px; }
    @media (min-width: 640px) {
        .val-iso27001 { width: 65px;    height: 69px; }
        .val-iso9001  { width: 52.95px; height: 53px; }
    }
</style>

<section class="min-h-screen flex flex-col justify-center py-8 lg:py-12 px-6 lg:px-12 max-w-[1400px] mx-auto">
    <div class="text-center mb-6">
        <span class="text-[#00d084] uppercase tracking-widest text-base font-bold mb-2 block">
            <?php echo mer_esc($w_label); ?>
        </span>
        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight max-w-3xl mx-auto text-slate-900">
            <?php echo nl2br(esc_html($w_title)); ?>
        </h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        <!-- Card 1: white -->
        <div class="bg-white border border-slate-200 rounded-[2rem] p-5 lg:p-6 col-span-1 flex flex-col">
            <div class="w-12 h-12 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center mb-4 text-[#00d084]">
                <i data-lucide="<?php echo esc_attr($w1_icon); ?>" class="w-6 h-6 stroke-[1.5]"></i>
            </div>
            <h3 class="text-lg lg:text-xl font-bold tracking-tight mb-2 text-slate-900">
                <?php echo nl2br(esc_html($w1_title)); ?>
            </h3>
            <p class="text-base text-slate-600 leading-relaxed font-light">
                <?php echo mer_esc($w1_text); ?>
            </p>
        </div>

        <!-- Card 2: image (zdjęcie bez zmian) -->
        <div class="sm:col-span-2 lg:col-span-2 rounded-[2rem] overflow-hidden min-h-[200px] lg:min-h-[240px] relative group h-full cursor-pointer shadow-sm">
            <?php if ($w2_img_url) : ?>
                <img src="<?php echo $w2_img_url; ?>" alt="<?php echo $w2_img_alt; ?>"
                    class="w-full h-full object-cover absolute inset-0 group-hover:scale-105 transition-transform duration-700" loading="lazy">
            <?php else : ?>
                <div class="w-full h-full bg-slate-300 absolute inset-0"></div>
            <?php endif; ?>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent opacity-60 group-hover:opacity-90 transition-opacity duration-300"></div>
            <a href="<?php echo esc_url($w2_url); ?>"
                class="absolute bottom-8 left-8 right-8 z-10 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                <p class="text-white font-medium text-lg flex items-center gap-2">
                    <?php echo mer_esc($w2_hover); ?>
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </p>
            </a>
        </div>

        <!-- Card 3: dark -->
        <div class="bg-slate-900 rounded-[2rem] p-5 lg:p-6 text-white col-span-1 flex flex-col relative overflow-hidden">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-[#00d084]/20 blur-3xl rounded-full"></div>
            <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center mb-4 text-[#00d084]">
                <i data-lucide="<?php echo esc_attr($w3_icon); ?>" class="w-6 h-6 stroke-[1.5]"></i>
            </div>
            <h3 class="text-lg lg:text-xl font-bold tracking-tight mb-2">
                <?php echo nl2br(esc_html($w3_title)); ?>
            </h3>
            <p class="text-base text-slate-300 leading-relaxed font-light relative z-10">
                <?php echo mer_esc($w3_text); ?>
            </p>
            <div class="mt-auto pt-4 relative z-10">
                <img src="<?php echo $_iso27_url; ?>" alt="ISO 27001" class="val-iso27001 object-contain" loading="lazy">
            </div>
        </div>

        <!-- Card 4: green accent -->
        <div class="bg-[#00d084] rounded-[2rem] p-5 lg:p-6 text-white col-span-1 flex flex-col overflow-hidden relative">
            <div class="absolute -right-6 -bottom-6 opacity-10">
                <i data-lucide="cpu" class="w-40 h-40 stroke-[1]"></i>
            </div>
            <div class="w-fit bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-4 text-white relative z-10 p-3">
                <i data-lucide="<?php echo esc_attr($w4_icon); ?>" class="w-6 h-6 stroke-[1.5]"></i>
            </div>
            <h3 class="text-lg lg:text-xl font-bold tracking-tight mb-2 relative z-10">
                <?php echo nl2br(esc_html($w4_title)); ?>
            </h3>
            <p class="text-base text-white leading-relaxed font-light relative z-10">
                <?php echo mer_esc($w4_text); ?>
            </p>
        </div>

        <!-- Card 5: awards -->
        <div class="bg-white border border-slate-200 rounded-[2rem] p-5 lg:p-6 sm:col-span-2 lg:col-span-2 flex flex-col justify-between">
            <div>
                <h3 class="text-lg lg:text-xl font-bold tracking-tight mb-2 text-slate-900">
                    <?php echo mer_esc($w5_title); ?>
                </h3>
                <p class="text-base text-slate-600 leading-relaxed max-w-lg font-light">
                    <?php echo mer_esc($w5_text); ?>
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-6 mt-6">
                <img src="<?php echo esc_url($_w5_l1['url']); ?>" alt="<?php echo esc_attr($_w5_l1['alt'] ?: 'Nagroda'); ?>" class="object-contain" style="width:110px;height:95px;" loading="lazy">
                <img src="<?php echo esc_url($_w5_l2['url']); ?>" alt="<?php echo esc_attr($_w5_l2['alt'] ?: 'Nagroda'); ?>" class="h-16 w-auto object-contain" loading="lazy">
            </div>
        </div>

        <!-- Card 6: quality (green — jak na homepage) -->
        <div class="bg-[#00d084] rounded-[2rem] p-5 lg:p-6 col-span-1 flex flex-col overflow-hidden relative">
            <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mb-4 text-white">
                <i data-lucide="<?php echo esc_attr($w6_icon); ?>" class="w-6 h-6 stroke-[1.5]"></i>
            </div>
            <h3 class="text-lg lg:text-xl font-bold tracking-tight mb-2 text-white">
                <?php echo nl2br(esc_html($w6_title)); ?>
            </h3>
            <p class="text-base text-white leading-relaxed font-light">
                <?php echo mer_esc($w6_text); ?>
            </p>
            <div class="mt-auto pt-4">
                <img src="<?php echo $_iso9_url; ?>" alt="ISO 9001" class="val-iso9001 object-contain" loading="lazy">
            </div>
        </div>

    </div>
</section>
