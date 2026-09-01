<?php
$page_id   = get_queried_object_id();
$text_pre  = __( get_field('hk_logos_text_pre',  $page_id) ?: 'Zaufało nam ponad', 'meritoros' );
$number    = get_field('hk_logos_number',    $page_id) ?: '1200';
$text_post = __( get_field('hk_logos_text_post', $page_id) ?: 'klientów', 'meritoros' );

$_img = get_template_directory_uri() . '/images/';
$_defaults = [
    ['url' => $_img . 'streamsoft.png', 'alt' => 'Streamsoft'],
    ['url' => $_img . 'sitech.png',     'alt' => 'Sitech'],
    ['url' => $_img . 'arco.svg',       'alt' => 'Arco'],
    ['url' => $_img . 'rofa.png',       'alt' => 'ROFA'],
];

$logos = [];
for ($i = 1; $i <= 4; $i++) {
    $acf = get_field("hk_logos_logo{$i}", $page_id);
    $logos[] = is_array($acf) && !empty($acf['url']) ? $acf : $_defaults[$i - 1];
}
?>

<section class="py-12 md:py-16 bg-white border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-6">

        <p class="text-base md:text-lg text-slate-500 font-medium mb-6">
            <?php echo mer_esc($text_pre); ?> <?php echo mer_esc($number); ?> <?php echo mer_esc($text_post); ?>
        </p>

        <style>
            .hk-logos { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.25rem; align-items: center; }
            .hk-logos img { width: auto; height: auto; max-height: 36px; max-width: 100%; object-fit: contain; }
            @media (min-width: 640px) {
                .hk-logos { display: flex; justify-content: space-between; align-items: center; gap: 1rem; }
                .hk-logos img { max-height: none; }
                .hk-logos img:nth-child(1) { width: 207px;    height: 41.99px; }
                .hk-logos img:nth-child(2) { width: 139px;    height: 48px; }
                .hk-logos img:nth-child(3) { width: 156px;    height: 35px; }
                .hk-logos img:nth-child(4) { width: 129.21px; height: 59.87px; }
            }
        </style>
        <div class="hk-logos">
            <?php foreach ($logos as $logo) :
                if (!is_array($logo)) continue;
            ?>
                <img src="<?php echo esc_url($logo['url']); ?>"
                     alt="<?php echo esc_attr($logo['alt'] ?: __('Logo klienta', 'meritoros')); ?>"
                     loading="lazy">
            <?php endforeach; ?>
        </div>

    </div>
</section>
