<?php
/**
 * Sekcja: marquee slider logotypów klientów (pod hero, biała)
 * ACF pola: hero_logo_1..24 (z front page)
 */
$_fp = (int) get_option('page_on_front');
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

<section id="hero-logos" class="bg-white py-8 overflow-hidden">
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
            height: 40px;
            width: auto;
            max-width: 140px;
            object-fit: contain;
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
