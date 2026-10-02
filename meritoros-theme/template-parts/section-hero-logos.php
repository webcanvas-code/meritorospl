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

<section id="hero-logos" class="bg-white py-6 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row md:items-center gap-6 md:gap-10">

            <!-- Tekst po lewej -->
            <div class="flex items-center gap-4 flex-shrink-0">
                <span class="text-[#00d084] text-4xl font-black leading-none"><?php echo esc_html($number); ?>+</span>
                <span class="text-slate-500 text-sm font-medium leading-tight uppercase tracking-wide"><?php echo esc_html(__("zaufanych\nklientów", 'meritoros')); ?></span>
            </div>

            <div class="hidden md:block w-px h-10 bg-slate-200 flex-shrink-0"></div>

            <!-- Slider po prawej -->
            <style>
                @keyframes mer-marquee {
                    from { transform: translateX(0); }
                    to   { transform: translateX(-50%); }
                }
                .mer-marquee-wrap {
                    overflow: hidden;
                    flex: 1;
                    min-width: 0;
                    -webkit-mask-image: linear-gradient(90deg, transparent, #000 4%, #000 96%, transparent);
                    mask-image: linear-gradient(90deg, transparent, #000 4%, #000 96%, transparent);
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
                    max-width: 130px;
                    object-fit: contain;
                    opacity: 0.7;
                    transition: opacity .3s ease;
                }
                .mer-marquee-track img:hover {
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

        </div>
    </div>
</section>
