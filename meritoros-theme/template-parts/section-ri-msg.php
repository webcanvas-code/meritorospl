<?php
$title = __( mer_field('ri_msg_title', 'Ogłoszenia w Monitorze Sądowym i Gospodarczym'), 'meritoros' );

// Pozycje – 10 osobnych grup ACF (ri_msg_item_1 … ri_msg_item_10)
$items = [];
for ($i = 1; $i <= 10; $i++) {
    $item = get_field("ri_msg_item_{$i}");
    if (!empty($item['label'])) $items[] = $item;
}
?>

<section class="py-10 md:py-14 bg-white">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 mb-10">
            <?php echo mer_esc($title); ?>
        </h2>

        <?php if (empty($items)) : ?>
            <p class="text-sm font-bold text-slate-800"><?php echo mer_esc(mer_t('ri_brak', 'Brak')); ?></p>
        <?php else : ?>
            <div class="flex flex-col gap-3">
                <?php foreach ($items as $item) :
                    $label    = $item['label']       ?? '';
                    $file_url = $item['file']['url'] ?? '';
                ?>
                    <div class="mer-btn mer-btn--secondary bg-slate-50 rounded-2xl px-6 py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <span class="text-slate-800 font-medium"><?php echo mer_esc($label); ?></span>
                        <?php if ($file_url) : ?>
                            <a href="<?php echo esc_url($file_url); ?>"
                               target="_blank"
                               rel="noopener"
                               class="mer-btn mer-btn--white inline-flex items-center gap-2 bg-white text-slate-700 border border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-sm font-medium px-5 py-2.5 rounded-full transition-colors shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                <?php echo mer_esc(mer_t('ri_pobierz_dokument', 'Pobierz dokument')); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
