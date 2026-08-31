<?php
$title    = mer_field('kar_hero_title',    "Dołącz do\nnaszego zespołu");
$text     = mer_field('kar_hero_text',     "Budujemy uporządkowane procesy i dobrą atmosferę.\nJeśli cenisz jasne zasady, rozwój i pracę zespołową – sprawdź,\nczy mamy ofertę dla Ciebie.");
$btn_text = mer_field('kar_hero_btn_text', 'Aktualne oferty pracy');
$btn_url  = mer_field('kar_hero_btn_url',  '#oferty');
$bg       = get_field('kar_hero_bg');
$bg_url   = is_array($bg) ? esc_url($bg['url']) : 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=1600&q=80';
?>

<section class="relative overflow-hidden" style="min-height:100vh;">
    <img src="<?php echo $bg_url; ?>" alt="" class="absolute inset-0 w-full h-full object-cover object-center" loading="eager">
    <div class="absolute inset-0 bg-gradient-to-r from-slate-900/85 via-slate-900/60 to-slate-900/10"></div>
    <div class="absolute -left-40 top-1/2 -translate-y-1/2 w-64 h-64 rounded-full border-[40px] border-[#00d084]/70 pointer-events-none"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 flex flex-col justify-center" style="min-height:100vh; padding-top:7rem;">
        <div class="flex items-center gap-2 text-sm text-white/60 mb-6">
            <span><?php esc_html_e('Strona główna', 'meritoros'); ?></span>
            <span>/</span>
            <span class="text-white/90 font-medium"><?php esc_html_e('Kariera', 'meritoros'); ?></span>
        </div>
        <div class="max-w-2xl">
            <h1 class="text-pretty text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white leading-[1.1] mb-6">
                <?php echo nl2br(esc_html($title)); ?>
            </h1>
            <p class="text-base sm:text-lg text-white/75 leading-relaxed mb-10 max-w-3xl">
                <?php echo wp_kses_post($text); ?>
            </p>
            <a href="<?php echo esc_url($btn_url); ?>" class="mer-btn mer-btn--primary inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-[#00d084] text-white text-base font-semibold hover:bg-[#00b872] transition-colors">
                <?php echo mer_esc($btn_text); ?>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>
    </div>
</section>
