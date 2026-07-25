<?php
// 5 podsekcji – każda z własnym tytułem i listą plików (do 10 pozycji)
// Naprzemienne tło: white / #eef8f2

$subsections = [
    [
        'title_field' => 'ri_rap_kw_title',
        'title_default' => 'Raporty kwartalne spółki',
        'item_prefix' => 'ri_rap_kw_item',
        'bg' => 'bg-white',
        'row_bg' => 'bg-slate-50',
    ],
    [
        'title_field' => 'ri_rap_ebi_title',
        'title_default' => 'Raporty EBI/ESPI',
        'item_prefix' => 'ri_rap_ebi_item',
        'bg' => 'bg-emerald-50',
        'row_bg' => 'bg-white',
    ],
    [
        'title_field' => 'ri_rap_an_title',
        'title_default' => 'Animator Rynku',
        'item_prefix' => 'ri_rap_an_item',
        'bg' => 'bg-white',
        'row_bg' => 'bg-slate-50',
    ],
    [
        'title_field' => 'ri_rap_ad_title',
        'title_default' => 'Autoryzowany Doradca',
        'item_prefix' => 'ri_rap_ad_item',
        'bg' => 'bg-emerald-50',
        'row_bg' => 'bg-white',
    ],
    [
        'title_field' => 'ri_rap_qa_title',
        'title_default' => 'Pytania i odpowiedzi',
        'item_prefix' => 'ri_rap_qa_item',
        'bg' => 'bg-white',
        'row_bg' => 'bg-slate-50',
    ],
];
?>

<?php foreach ($subsections as $sub) :
    $title = mer_field($sub['title_field'], $sub['title_default']);
    $items = [];
    for ($i = 1; $i <= 10; $i++) {
        $item = get_field("{$sub['item_prefix']}_{$i}");
        if (!empty($item['label'])) $items[] = $item;
    }
?>
<section class="py-10 md:py-14 <?php echo $sub['bg']; ?>">
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
                    <div class="<?php echo $sub['row_bg']; ?> rounded-2xl px-6 py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <span class="text-slate-800 font-medium"><?php echo mer_esc($label); ?></span>
                        <?php if ($file_url) : ?>
                            <a href="<?php echo esc_url($file_url); ?>"
                               target="_blank"
                               rel="noopener"
                               class="inline-flex items-center gap-2 bg-[#48c279] hover:bg-[#3ea868] text-white text-sm font-medium px-5 py-2.5 rounded-full transition-colors shrink-0">
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
<?php endforeach; ?>
