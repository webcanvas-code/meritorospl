<?php
$label    = mer_field('values_label', 'Nasze Wartości');
$title    = mer_field('values_title', "Dlaczego Meritoros to spokój\nw Twoim biznesie?");

// Card 1
$c1_icon  = mer_field('val_c1_icon', 'infinity');
$c1_title = mer_field('val_c1_title', "Skala i ciągłość\nobsługi");
$c1_desc  = mer_field('val_c1_desc', 'Pracujemy zespołowo i procesowo, dzięki czemu obsługa nie zależy od jednej osoby. Zapewniamy zastępowalność i ciągłość pracy – bez przestojów.');

// Card 2 — image
$img_arr  = get_field('val_img');
$img_url  = is_array($img_arr) ? esc_url($img_arr['url']) : 'https://images.unsplash.com/photo-1573164713988-8665fc963095?auto=format&fit=crop&w=1469&q=80';
$img_alt  = is_array($img_arr) ? esc_attr($img_arr['alt']) : 'Team';
$img_w    = is_array($img_arr) ? intval($img_arr['width'])  : 1469;
$img_h    = is_array($img_arr) ? intval($img_arr['height']) : 979;
$img_hover= mer_field('val_img_hover_text', 'Współpracuj z profesjonalistami');

// Card 3
$c3_icon  = mer_field('val_c3_icon', 'shield-check');
$c3_title = mer_field('val_c3_title', "Bezpieczeństwo\ni compliance");
$c3_desc  = mer_field('val_c3_desc', 'Działamy zgodnie z obowiązującymi regulacjami i standardami bezpieczeństwa danych. Dbamy o poufność informacji oraz jasne zasady współpracy - bez "skrótów" i ryzyk.');

// Card 4
$c4_icon  = mer_field('val_c4_icon', 'bot');
$c4_title = mer_field('val_c4_title', "Technologia\ni automatyzacja");
$c4_desc  = mer_field('val_c4_desc', 'Wykorzystujemy narzędzia i automatyzację (RPA), które porządkują obieg dokumentów, ograniczają ryzyko błędów i usprawniają pracę zespołów.');

// Card 5 — awards (loga pobierane ze strony BPO)
$c5_title  = mer_field('val_c5_title', 'Nagrody i wyróżnienia');
$c5_desc   = mer_field('val_c5_desc', 'Wyróżnienia są efektem tego, jak rozwijamy Meritoros: konsekwentnie i procesowo. Trzymamy standard, który ma działać w praktyce - codziennie.');
$_bpo_pages = get_posts(['post_type' => 'page', 'meta_key' => '_wp_page_template', 'meta_value' => 'page-bpo.php', 'posts_per_page' => 1, 'fields' => 'ids']);
$_bpo_id    = !empty($_bpo_pages) ? $_bpo_pages[0] : 0;
$_img       = get_template_directory_uri() . '/images/';
$val_logo1  = ($_bpo_id ? get_field('bpo_awards_logo1', $_bpo_id) : null) ?: ['url' => $_img . 'forbes.png',      'alt' => 'Forbes'];
$val_logo2  = ($_bpo_id ? get_field('bpo_awards_logo2', $_bpo_id) : null) ?: ['url' => $_img . 'logo_gazele.png', 'alt' => 'Gazele Biznesu'];

// Card 6 — quality
$c6_icon       = mer_field('val_c6_icon', 'award');
$c6_title      = mer_field('val_c6_title', 'Jakość potwierdzona standardami');
$c6_desc       = mer_field('val_c6_desc', 'Mamy wdrożone procedury kontroli jakości i weryfikacji danych. Dostarczamy spójne dane dla zarządu.');
$c6_cert_label = mer_field('val_c6_cert_label', 'Certyfikat');
$c6_cert       = mer_field('val_c6_cert', 'ISO 9001:2015');
?>

<style>
    .val-iso27001 { width: 52px; height: 55px; }
    .val-iso9001  { width: 42px; height: 43px; }
    @media (min-width: 640px) {
        .val-iso27001 { width: 65px;    height: 69px; }
        .val-iso9001  { width: 52.95px; height: 53px; }
    }
</style>
<section class="py-16 md:py-24 px-6 lg:px-12 max-w-[1400px] mx-auto">
    <div class="text-center mb-6">
        <span class="text-[#2d8650] uppercase tracking-widest text-base font-bold mb-2 block">
            <?php echo mer_esc($label); ?>
        </span>
        <h2 class="text-pretty text-2xl md:text-3xl lg:text-4xl font-bold tracking-tight max-w-3xl mx-auto text-slate-900">
            <?php echo nl2br(esc_html($title)); ?>
        </h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        <!-- Card 1: White -->
        <div class="bg-white border border-slate-200 rounded-[2rem] p-5 lg:p-6 col-span-1 flex flex-col">
            <div class="w-12 h-12 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center mb-4 text-[#2d8650]">
                <i data-lucide="<?php echo esc_attr($c1_icon); ?>" class="w-6 h-6 stroke-[1.5]"></i>
            </div>
            <h3 class="text-lg lg:text-xl font-bold tracking-tight mb-2 text-slate-900">
                <?php echo nl2br(esc_html($c1_title)); ?>
            </h3>
            <p class="text-base text-slate-600 leading-relaxed font-light">
                <?php echo mer_esc($c1_desc); ?>
            </p>
        </div>

        <!-- Card 2: Image -->
        <div class="sm:col-span-2 lg:col-span-2 rounded-[2rem] overflow-hidden min-h-[200px] lg:min-h-[240px] relative h-full shadow-sm">
            <img src="<?php echo $img_url; ?>" alt="<?php echo $img_alt; ?>"
                 class="w-full h-full object-cover absolute inset-0"
                 loading="lazy" width="<?php echo $img_w; ?>" height="<?php echo $img_h; ?>">
        </div>

        <!-- Card 3: Dark -->
        <div class="bg-slate-900 rounded-[2rem] p-5 lg:p-6 text-white col-span-1 flex flex-col relative overflow-hidden">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-[#2d8650]/20 blur-3xl rounded-full"></div>
            <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center mb-4 text-[#2d8650]">
                <i data-lucide="<?php echo esc_attr($c3_icon); ?>" class="w-6 h-6 stroke-[1.5]"></i>
            </div>
            <h3 class="text-lg lg:text-xl font-bold tracking-tight mb-2">
                <?php echo nl2br(esc_html($c3_title)); ?>
            </h3>
            <p class="text-base text-slate-300 leading-relaxed font-light relative z-10">
                <?php echo mer_esc($c3_desc); ?>
            </p>
            <div class="mt-auto pt-4 relative z-10">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/ISO27001.png'); ?>"
                     alt="ISO 27001"
                     class="val-iso27001 object-contain"
                     loading="lazy">
            </div>
        </div>

        <!-- Card 4: Green -->
        <div class="bg-[#2d8650] rounded-[2rem] p-5 lg:p-6 text-white col-span-1 flex flex-col overflow-hidden relative">
            <div class="absolute -right-6 -bottom-6 opacity-10">
                <i data-lucide="cpu" class="w-40 h-40 stroke-[1]"></i>
            </div>
            <div class="w-fit bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-4 text-white relative z-10 p-3">
                <i data-lucide="<?php echo esc_attr($c4_icon); ?>" class="w-6 h-6 stroke-[1.5]"></i>
            </div>
            <h3 class="text-lg lg:text-xl font-bold tracking-tight mb-2 relative z-10">
                <?php echo nl2br(esc_html($c4_title)); ?>
            </h3>
            <p class="text-base text-white leading-relaxed font-light relative z-10">
                <?php echo mer_esc($c4_desc); ?>
            </p>
        </div>

        <!-- Card 5: Awards -->
        <div class="bg-white border border-slate-200 rounded-[2rem] p-5 lg:p-6 sm:col-span-2 lg:col-span-2 flex flex-col justify-between">
            <div>
                <h3 class="text-lg lg:text-xl font-bold tracking-tight mb-2 text-slate-900">
                    <?php echo mer_esc($c5_title); ?>
                </h3>
                <p class="text-base text-slate-600 leading-relaxed max-w-lg font-light">
                    <?php echo mer_esc($c5_desc); ?>
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-6 mt-6">
                <?php if (is_array($val_logo1)) : ?>
                    <img src="<?php echo esc_url($val_logo1['url']); ?>" alt="<?php echo esc_attr($val_logo1['alt'] ?: 'Nagroda'); ?>" class="object-contain" style="width:110px;height:95px;" loading="lazy">
                <?php endif; ?>
                <?php if (is_array($val_logo2)) : ?>
                    <img src="<?php echo esc_url($val_logo2['url']); ?>" alt="<?php echo esc_attr($val_logo2['alt'] ?: 'Nagroda'); ?>" class="h-16 w-auto object-contain" loading="lazy">
                <?php endif; ?>
            </div>
        </div>

        <!-- Card 6: Quality -->
        <div class="bg-[#2d8650] rounded-[2rem] p-5 lg:p-6 col-span-1 flex flex-col overflow-hidden relative">
            <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mb-4 text-white">
                <i data-lucide="<?php echo esc_attr($c6_icon); ?>" class="w-6 h-6 stroke-[1.5]"></i>
            </div>
            <h3 class="text-lg lg:text-xl font-bold tracking-tight mb-2 text-white">
                <?php echo mer_esc($c6_title); ?>
            </h3>
            <p class="text-base text-white leading-relaxed font-light">
                <?php echo mer_esc($c6_desc); ?>
            </p>
            <div class="mt-auto pt-4">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/ISO9001.png'); ?>" alt="ISO 9001" class="val-iso9001 object-contain" loading="lazy">
            </div>
        </div>

    </div>
</section>
