<?php
/**
 * Sekcja: slider logotypów klientów (marquee)
 * Używana na: page-historie-klientow.php
 * ACF pola: hk_logos_text_pre, hk_logos_number, hk_logos_text_post, hk_logos_logo1..20
 */
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

$count = count($logos);
$speed = max(20, $count * 4);
?>

<section id="hk-logos" class="py-10 md:py-14 bg-slate-50 border-t border-slate-100 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 mb-8">
        <p class="text-base md:text-lg text-slate-500 font-medium">
            <?php echo esc_html($text_pre); ?>
            <strong class="text-slate-700"><?php echo esc_html($number); ?></strong>
            <?php echo esc_html($text_post); ?>
        </p>
    </div>

    <div class="hk-marquee" style="--hk-speed: <?php echo $speed; ?>s;">
        <div class="hk-marquee__track">
            <?php for ($r = 0; $r < 2; $r++) : ?>
                <?php foreach ($logos as $logo) : ?>
                    <div class="hk-marquee__item">
                        <img src="<?php echo esc_url($logo['url']); ?>"
                             alt="<?php echo esc_attr($logo['alt'] ?: __('Logo klienta', 'meritoros')); ?>"
                             loading="lazy"
                             decoding="async">
                    </div>
                <?php endforeach; ?>
            <?php endfor; ?>
        </div>
    </div>
</section>

<style>
.hk-marquee {
    position: relative;
    -webkit-mask-image: linear-gradient(90deg, transparent, #000 8%, #000 92%, transparent);
    mask-image: linear-gradient(90deg, transparent, #000 8%, #000 92%, transparent);
}
.hk-marquee__track {
    display: flex;
    align-items: center;
    gap: 2.5rem;
    width: max-content;
    animation: hk-scroll var(--hk-speed, 40s) linear infinite;
}
.hk-marquee:hover .hk-marquee__track {
    animation-play-state: paused;
}
@keyframes hk-scroll {
    0%   { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
.hk-marquee__item {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 48px;
}
.hk-marquee__item img {
    display: block;
    height: 100%;
    width: auto;
    max-width: 160px;
    object-fit: contain;
}
@media (prefers-reduced-motion: reduce) {
    .hk-marquee__track { animation-play-state: paused; }
}
</style>
