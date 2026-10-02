<?php
/**
 * Sekcja: slider logotypów klientów (JS marquee)
 * Używana na: page-historie-klientow.php
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
?>

<section id="hk-logos" style="padding:40px 0; background:#f1f5f9; border-top:1px solid #e2e8f0; overflow:hidden;">
    <div style="max-width:1280px; margin:0 auto; padding:0 24px 32px;">
        <p style="font-size:16px; color:#64748b; font-weight:500; margin:0;">
            <?php echo esc_html($text_pre); ?>
            <strong style="color:#334155;"><?php echo esc_html($number); ?></strong>
            <?php echo esc_html($text_post); ?>
        </p>
    </div>

    <div id="hk-logos-slider" style="display:flex; align-items:center; gap:48px;">
        <?php foreach ($logos as $logo) : ?>
            <img src="<?php echo esc_url($logo['url']); ?>"
                 alt="<?php echo esc_attr($logo['alt'] ?: __('Logo klienta', 'meritoros')); ?>"
                 loading="eager"
                 decoding="async"
                 style="height:44px; width:auto; max-width:160px; flex-shrink:0; display:block; object-fit:contain;">
        <?php endforeach; ?>
    </div>
</section>

<script>
(function() {
    var slider = document.getElementById('hk-logos-slider');
    if (!slider) return;

    // Duplikuj loga dla ciągłej pętli
    var original = slider.innerHTML;
    slider.innerHTML = original + original;

    var pos = 0;
    var speed = 0.5;
    var paused = false;
    var half = 0;

    slider.addEventListener('mouseenter', function() { paused = true; });
    slider.addEventListener('mouseleave', function() { paused = false; });

    function measure() {
        half = slider.scrollWidth / 2;
    }

    function tick() {
        if (!paused && half > 0) {
            pos -= speed;
            if (Math.abs(pos) >= half) pos = 0;
            slider.style.transform = 'translateX(' + pos + 'px)';
        }
        requestAnimationFrame(tick);
    }

    // Poczekaj na załadowanie obrazków
    window.addEventListener('load', function() {
        measure();
        requestAnimationFrame(tick);
    });
})();
</script>
