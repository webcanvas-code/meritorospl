<?php
$title = mer_field('bpo_sys_title', "Obsługa wielu systemów\nksięgowych");
$text  = mer_field('bpo_sys_text',  'Nasz zespół obsługuje wiele systemów księgowych, m.in. Comarch Optima, SAP czy Enova. Współpracę dostosowujemy do istniejących narzędzi i procesów oraz wymagań klienta. Istnieje także możliwość pracy na preferowanych przez klienta programach księgowych.');

$logo_defaults = [
    ['url' => get_template_directory_uri() . '/images/erp optima.png', 'alt' => 'Comarch ERP Optima'],
    ['url' => get_template_directory_uri() . '/images/sap.png',        'alt' => 'SAP'],
    ['url' => get_template_directory_uri() . '/images/enova.png',      'alt' => 'Enova'],
    ['url' => get_template_directory_uri() . '/images/erp xl.png',     'alt' => 'Comarch ERP XL'],
    ['url' => get_template_directory_uri() . '/images/symfonia.png',   'alt' => 'Symfonia'],
];

$logos = [];
for ($i = 1; $i <= 4; $i++) {
    $logos[] = get_field("bpo_sys_logo{$i}");
}
$valid_logos = array_values(array_filter($logos, 'is_array'));
if (empty($valid_logos)) {
    $valid_logos = $logo_defaults;
}
?>

<section class="py-12 md:py-24 border-t border-slate-100 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight mb-6 text-slate-900"><?php echo nl2br(esc_html($title)); ?></h2>
        <p class="text-lg text-slate-600 mb-16 leading-relaxed max-w-4xl"><?php echo mer_esc($text); ?></p>
        <?php if (!empty($valid_logos)) : ?>
        <div class="flex flex-wrap items-center justify-between gap-y-8">
            <?php foreach ($valid_logos as $logo) : ?>
                <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt'] ?: 'System ERP'); ?>" class="h-11 w-auto object-contain" loading="lazy">
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
