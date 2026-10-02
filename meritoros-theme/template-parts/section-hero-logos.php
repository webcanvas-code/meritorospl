<?php
/**
 * Sekcja: marquee slider logotypów klientów (pod hero, biała)
 * ACF pola: hero_logo_1..24, hero_trust_text (z front page)
 */
$_fp  = (int) get_option('page_on_front');
$number    = get_field('hero_trust_number', $_fp) ?: '1200';
$_img = get_template_directory_uri() . '/images/';

$_defaults = [
    1 => ['src' => $_img . 'streamsoft.png', 'alt' => 'Streamsoft'],
    2 => ['src' => $_img . 'sitech.png',     'alt' => 'SITECH'],
    3 => ['src' => $_img . 'arco.svg',       'alt' => 'Arco'],
    4 => ['src' => $_img . 'rofa.png',       'alt' => 'ROFA'],
];

$logos = [];
for ($i = 1; $i <= 24; $i++) {
    $acf = get_field("hero_logo_{$i}", $_fp);
    if (is_array($acf) && !empty($acf['url'])) {
        $logos[] = ['src' => $acf['url'], 'alt' => $acf['alt'] ?: ''];
    } elseif (isset($_defaults[$i])) {
        $logos[] = $_defaults[$i];
    }
}

if (empty($logos)) return;
?>

<section id="hero-logos" class="bg-slate-50 py-10 md:py-12 overflow-hidden border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-6 mb-8 text-center">
        <p class="text-3xl md:text-4xl font-bold text-slate-800 mb-1">
            <?php echo esc_html($number); ?>+
        </p>
        <p class="text-sm uppercase tracking-widest text-slate-400 font-medium">
            <?php echo esc_html(__('firm nam zaufało', 'meritoros')); ?>
        </p>
    </div>

    <style>
        @keyframes mer-marquee {
            from { transform: translateX(0); }
            to   { transform: translateX(-50%); }
        }
        .mer-marquee-wrap {
            overflow: hidden;
            -webkit-mask-image: linear-gradient(90deg, transparent, #000 6%, #000 94%, transparent);
            mask-image: linear-gradient(90deg, transparent, #000 6%, #000 94%, transparent);
        }
        .mer-marquee-track {
            display: flex;
            align-items: center;
            gap: 3rem;
            width: max-content;
            animation: mer-marquee 50s linear infinite;
        }
        .mer-marquee-track:hover { animation-play-state: paused; }
        .mer-marquee-track img {
            flex-shrink: 0;
            display: block;
            height: 36px;
            width: auto;
            max-width: 140px;
            object-fit: contain;
            filter: grayscale(100%);
            opacity: 0.5;
            transition: filter .3s ease, opacity .3s ease;
        }
        .mer-marquee-track img:hover {
            filter: grayscale(0%);
            opacity: 1;
        }
        @media (prefers-reduced-motion: reduce) {
            .mer-marquee-track { animation-play-state: paused; }
        }
    </style>

    <div class="mer-marquee-wrap">
        <div class="mer-marquee-track">
            <?php for ($r = 0; $r < 2; $r++) : foreach ($logos as $l) : ?>
                <img src="<?php echo esc_url($l['src']); ?>"
                     alt="<?php echo esc_attr($l['alt'] ?: __('Logo klienta', 'meritoros')); ?>"
                     loading="eager">
            <?php endforeach; endfor; ?>
        </div>
    </div>
</section>
