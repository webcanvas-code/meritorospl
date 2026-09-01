<?php
$title    = __( mer_field('ri_akcjonariat_title',    'Informacje o strukturze akcjonariatu'), 'meritoros' );
$subtitle = __( mer_field('ri_akcjonariat_subtitle', 'Kapitał zakładowy spółki wynosi 120 000 PLN i dzieli się na 1 200 000 akcji serii A o wartości nominalnej 0,10 PLN.'), 'meritoros' );

$col1 = __( mer_field('ri_akcjonariat_col1', 'Akcjonariusz'), 'meritoros' );
$col2 = __( mer_field('ri_akcjonariat_col2', 'Łączna liczba posiadanych akcji'), 'meritoros' );
$col3 = __( mer_field('ri_akcjonariat_col3', 'Udział w łącznej liczbie głosów'), 'meritoros' );

// Wiersze – 10 osobnych grup ACF (ri_akcjonariat_row_1 … ri_akcjonariat_row_10)
$rows = [];
for ($i = 1; $i <= 10; $i++) {
    $r = get_field("ri_akcjonariat_row_{$i}");
    if (!empty($r['shareholder'])) $rows[] = $r;
}
if (empty($rows)) {
    $rows = [
        ['shareholder' => 'Maciej Paraszczak',                         'shares' => '357 641', 'votes' => '29,80%'],
        ['shareholder' => 'Oldpara Capital ASI (zal. od M.Paraszczak)', 'shares' => '600 000', 'votes' => '50,00%'],
        ['shareholder' => 'Agnieszka Tomczyk-Pieniądz',                'shares' => '86 400',  'votes' => '7,20%'],
        ['shareholder' => 'Krzysztof Gargas',                          'shares' => '57 200',  'votes' => '4,77%'],
        ['shareholder' => 'Pozostali',                                  'shares' => '98 759',  'votes' => '8,23%'],
    ];
}
?>

<section id="ri-akcjonariat" class="py-10 md:py-14 bg-white">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 mb-4">
            <?php echo mer_esc($title); ?>
        </h2>
        <?php if ($subtitle) : ?>
            <p class="text-sm text-slate-500 mb-10 max-w-3xl"><?php echo mer_esc($subtitle); ?></p>
        <?php endif; ?>

        <div class="overflow-x-auto rounded-2xl shadow-sm">
            <table class="w-full border-collapse text-sm">

                <!-- Nagłówek -->
                <thead>
                    <tr class="bg-[#00d084] text-white">
                        <th class="mer-btn mer-btn--secondary text-left px-6 py-4 font-medium rounded-tl-2xl w-1/2"><?php echo mer_esc($col1); ?></th>
                        <th class="text-left px-6 py-4 font-medium"><?php echo mer_esc($col2); ?></th>
                        <th class="mer-btn mer-btn--secondary text-left px-6 py-4 font-medium rounded-tr-2xl"><?php echo mer_esc($col3); ?></th>
                    </tr>
                </thead>

                <!-- Wiersze -->
                <tbody class="bg-white">
                    <?php foreach ($rows as $ri => $row) :
                        $shareholder = is_array($row) ? ($row['shareholder'] ?? '') : '';
                        $shares      = is_array($row) ? ($row['shares']      ?? '') : '';
                        $votes       = is_array($row) ? ($row['votes']       ?? '') : '';
                        $is_last     = ($ri === count($rows) - 1);
                    ?>
                        <tr class="<?php echo $is_last ? '' : 'border-b border-slate-100'; ?> hover:bg-slate-50 transition-colors">
                            <td class="mer-btn mer-btn--secondary px-6 py-4 font-semibold text-slate-800<?php echo $is_last ? ' rounded-bl-2xl' : ''; ?>"><?php echo mer_esc($shareholder); ?></td>
                            <td class="px-6 py-4 text-slate-500"><?php echo mer_esc($shares); ?></td>
                            <td class="mer-btn mer-btn--secondary px-6 py-4 text-slate-500<?php echo $is_last ? ' rounded-br-2xl' : ''; ?>"><?php echo mer_esc($votes); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>

    </div>
</section>
