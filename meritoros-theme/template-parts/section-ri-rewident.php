<?php
$title = mer_field('ri_rew_title', 'Opinie biegłego rewidenta');

// Pozycje – 10 osobnych grup ACF (ri_rew_item_1 … ri_rew_item_10)
$items = [];
for ($i = 1; $i <= 10; $i++) {
    $item = get_field("ri_rew_item_{$i}");
    if (!empty($item['label'])) $items[] = $item;
}
if (empty($items)) {
    $items = [
        ['label' => 'Sprawozdanie finansowe za 2024 rok', 'file' => null],
        ['label' => 'Sprawozdanie finansowe za 2023 rok', 'file' => null],
        ['label' => 'Sprawozdanie finansowe za 2022 rok', 'file' => null],
        ['label' => 'Sprawozdanie finansowe za 2021 rok', 'file' => null],
    ];
}
?>

<section id="ri-rewident" class="py-10 md:py-14 bg-emerald-50 relative overflow-hidden">

    <!-- Dekoracyjny okrąg lewy -->
    <div class="absolute -left-32 top-1/2 -translate-y-1/2 w-[400px] h-[400px] rounded-full border-[60px] border-emerald-300/30 pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">

        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 mb-10">
            <?php echo mer_esc($title); ?>
        </h2>

        <div class="flex flex-col gap-3">
            <?php foreach ($items as $item) :
                $label    = $item['label']       ?? '';
                $file_url = $item['file']['url'] ?? '';
            ?>
                <div class="bg-white rounded-2xl px-6 py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <span class="text-slate-800 font-medium"><?php echo mer_esc($label); ?></span>
                    <?php if ($file_url) : ?>
                        <a href="<?php echo esc_url($file_url); ?>"
                           target="_blank"
                           rel="noopener"
                           class="inline-flex items-center gap-2 bg-white text-slate-700 border border-slate-200 hover:border-slate-300 hover:bg-slate-50 text-sm font-medium px-5 py-2.5 rounded-full transition-colors shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            <?php echo mer_esc(mer_t('ri_pobierz_pdf', 'Pobierz PDF')); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
