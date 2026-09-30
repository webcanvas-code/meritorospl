<?php
$page_id   = get_queried_object_id();
$text_pre  = __( get_field('hk_logos_text_pre',  $page_id) ?: 'Zaufało nam ponad', 'meritoros' );
$number    = get_field('hk_logos_number',    $page_id) ?: '1200';
$text_post = __( get_field('hk_logos_text_post', $page_id) ?: 'klientów', 'meritoros' );

$_img = get_template_directory_uri() . '/images/';
$_defaults = [
    1 => ['url' => $_img . 'streamsoft.png', 'alt' => 'Streamsoft'],
    2 => ['url' => $_img . 'sitech.png',     'alt' => 'Sitech'],
    3 => ['url' => $_img . 'arco.svg',       'alt' => 'Arco'],
    4 => ['url' => $_img . 'rofa.png',       'alt' => 'ROFA'],
];

$logos = [];
for ($i = 1; $i <= 20; $i++) {
    $acf = get_field("hk_logos_logo{$i}", $page_id);
    if (is_array($acf) && !empty($acf['url'])) {
        $logos[] = ['url' => $acf['url'], 'alt' => $acf['alt'] ?: ''];
    } elseif (isset($_defaults[$i])) {
        $logos[] = $_defaults[$i];
    }
}

if (empty($logos)) return;

$duped = array_merge($logos, $logos);
?>

<section id="hk-logos" class="py-10 md:py-14 bg-white border-t border-slate-100 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 mb-8">
        <p class="text-base md:text-lg text-slate-500 font-medium">
            <?php echo esc_html($text_pre); ?> <strong class="text-slate-700"><?php echo esc_html($number); ?></strong> <?php echo esc_html($text_post); ?>
        </p>
    </div>

    <style>
        .hk-logos-track {
            display: flex;
            align-items: center;
            gap: 1rem;
            width: max-content;
            animation: hk-marquee 40s linear infinite;
        }
        .hk-logos-track:hover {
            animation-play-state: paused;
        }
        @keyframes hk-marquee {
            from { transform: translateX(0); }
            to   { transform: translateX(-50%); }
        }
        .hk-logo-card {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 20px;
            height: 68px;
            min-width: 120px;
            flex-shrink: 0;
            transition: border-color .25s ease, background .25s ease;
        }
        .hk-logo-card:hover {
            background: #fff;
            border-color: #cbd5e1;
        }
        .hk-logo-card img {
            height: 36px;
            width: auto;
            max-width: 120px;
            object-fit: contain;
            filter: grayscale(100%) opacity(0.65);
            transition: filter .25s ease;
            display: block;
        }
        .hk-logo-card:hover img {
            filter: grayscale(0%) opacity(1);
        }
        @media (prefers-reduced-motion: reduce) {
            .hk-logos-track { animation: none; }
        }
    </style>

    <div class="relative">
        <div class="pointer-events-none absolute inset-y-0 left-0 w-20 z-10" style="background: linear-gradient(to right, #fff, transparent);"></div>
        <div class="pointer-events-none absolute inset-y-0 right-0 w-20 z-10" style="background: linear-gradient(to left, #fff, transparent);"></div>

        <div class="hk-logos-track">
            <?php foreach ($duped as $logo) : ?>
                <div class="hk-logo-card">
                    <img src="<?php echo esc_url($logo['url']); ?>"
                         alt="<?php echo esc_attr($logo['alt'] ?: __('Logo klienta', 'meritoros')); ?>"
                         loading="lazy">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
