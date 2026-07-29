<?php
$bg_img    = get_field('hero_bg_image');
$bg_url    = is_array($bg_img) ? esc_url($bg_img['url']) : 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=2070&q=80';
$bg_alt    = is_array($bg_img) ? esc_attr($bg_img['alt']) : 'Team meeting';
$headline  = mer_field('hero_headline', "Eksperci w księgowości.\nTechnologia i pewność\nw działaniu.");
$sub       = mer_field('hero_subheadline', 'Zapewniamy księgowość kadry i outsourcing procesów w standardzie, który daje firmom spokój i bezpieczeństwo.');
$btn1_text = mer_field('hero_btn1_text', 'Poznaj ofertę');
$btn1_url  = mer_field('hero_btn1_url', '#uslugi');
$btn2_text = mer_field('hero_btn2_text', 'Porozmawiajmy');
$btn2_url  = mer_field('hero_btn2_url', '#kontakt');
$trust_text= mer_field('hero_trust_text', 'Zaufało nam ponad <span class="text-white">1200 klientów</span>');
$clients   = mer_field('hero_clients', []);

if (empty($clients)) {
    $clients = [
        ['name' => 'Streamsoft'],
        ['name' => 'SITECH'],
        ['name' => 'arco'],
        ['name' => 'ROFA'],
    ];
}
?>

<section class="relative min-h-screen min-h-[100svh] flex flex-col overflow-hidden px-6 lg:px-12">
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
                <?php echo nl2br(esc_html($headline)); ?>
            </h1>

            <p class="text-base sm:text-lg font-light text-slate-200 mb-8 max-w-4xl leading-relaxed">
                <?php echo wp_kses_post($sub); ?>
            </p>

            <div class="flex flex-wrap items-center gap-4">
                <a href="<?php echo esc_url($btn1_url); ?>"
                   class="bg-[#2d8650] text-white px-7 py-3 rounded-full text-base font-semibold hover:bg-[#246e41] hover:shadow-lg hover:shadow-[#2d8650]/30 transition-all duration-300 flex items-center gap-2 group">
                    <?php echo mer_esc($btn1_text); ?>
                    <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="<?php echo esc_url($btn2_url); ?>"
                   class="bg-white/10 backdrop-blur-md border border-white/20 text-white px-7 py-3 rounded-full text-base font-semibold hover:bg-white/20 hover:border-white/30 transition-all duration-300 flex items-center gap-2">
                    <?php echo mer_esc($btn2_text); ?>
                    <i data-lucide="message-square" class="w-5 h-5 opacity-70"></i>
                </a>
            </div>
        </div>

        <!-- Trust banner -->
        <div class="mt-auto pt-5 border-t border-white/15">
            <p class="text-xs uppercase tracking-widest text-slate-400 mb-3 font-semibold">
                <?php echo wp_kses($trust_text, ['span' => ['class' => []]]); ?>
            </p>
            <style>
                @keyframes mer-marquee {
                    from { transform: translateX(0); }
                    to   { transform: translateX(-50%); }
                }
                .mer-marquee-wrap {
                    overflow: hidden;
                    -webkit-mask-image: linear-gradient(to right, transparent, black 12%, black 88%, transparent);
                    mask-image: linear-gradient(to right, transparent, black 12%, black 88%, transparent);
                }
                .mer-marquee-track {
                    display: flex;
                    align-items: center;
                    gap: 3.5rem;
                    width: max-content;
                    animation: mer-marquee 40s linear infinite;
                }
                .mer-marquee-track:hover { animation-play-state: paused; }
                .mer-marquee-track img {
                    height: 36px;
                    width: auto;
                    object-fit: contain;
                    filter: brightness(0) invert(1);
                    opacity: 0.85;
                    flex-shrink: 0;
                }
            </style>
            <?php
            $_fp = (int) get_option('page_on_front');
            $_hero_logo_defaults = [
                1 => ['src' => get_template_directory_uri() . '/images/streamsoft.png', 'alt' => 'Streamsoft'],
                2 => ['src' => get_template_directory_uri() . '/images/sitech.png',     'alt' => 'SITECH'],
                3 => ['src' => get_template_directory_uri() . '/images/arco.svg',       'alt' => 'Arco'],
                4 => ['src' => get_template_directory_uri() . '/images/rofa.png',       'alt' => 'ROFA'],
            ];
            $logo_items = [];
            for ($i = 1; $i <= 4; $i++) {
                $acf = get_field("hero_logo_{$i}", $_fp);
                if (is_array($acf) && !empty($acf['url'])) {
                    $logo_items[] = ['src' => $acf['url'], 'alt' => $acf['alt'] ?: "Logo klienta {$i}"];
                } else {
                    $logo_items[] = $_hero_logo_defaults[$i];
                }
            }
            ?>
            <div class="mer-marquee-wrap">
                <div class="mer-marquee-track">
                    <?php for ($r = 0; $r < 4; $r++) : foreach ($logo_items as $l) : ?>
                        <img src="<?php echo esc_url($l['src']); ?>" alt="<?php echo esc_attr($l['alt']); ?>" loading="eager">
                    <?php endforeach; endfor; ?>
                    <?php for ($r = 0; $r < 4; $r++) : foreach ($logo_items as $l) : ?>
                        <img src="<?php echo esc_url($l['src']); ?>" alt="" aria-hidden="true" loading="eager">
                    <?php endforeach; endfor; ?>
                </div>
            </div>
        </div>
    </div>
</section>
