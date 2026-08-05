<?php
$title = mer_field('ri_dane_title', 'Wybrane dane finansowe');

// Próbuj nowego formatu (metaboksa tabelaryczna → JSON)
$_ri_json = get_post_meta(get_the_ID(), '_ri_dane_table', true);
$_ri_data = $_ri_json ? json_decode($_ri_json, true) : null;

// Naprawa danych uszkodzonych przez wp_unslash, który usuwał backslash z \uXXXX w JSON.
// Objaw: "sprzedau017cy" zamiast "sprzedaży" — sekwencje uXXXX bez backslasha.
if ( is_array($_ri_data) ) {
    array_walk($_ri_data['rows'], function (&$row) {
        if ( isset($row['label']) ) {
            $row['label'] = preg_replace_callback(
                '/u([0-9a-fA-F]{4})/i',
                function ($m) {
                    $code = hexdec($m[1]);
                    return $code >= 0x0080
                        ? mb_convert_encoding(pack('n', $code), 'UTF-8', 'UTF-16BE')
                        : $m[0];
                },
                $row['label']
            );
        }
    });
}

if (!empty($_ri_data['years']) && !empty($_ri_data['rows'])) {
    $years = array_map('trim', $_ri_data['years']);
    // Zachowaj values jako tablicę — nie joinuj, żeby nie rozbijać liczb z przecinkiem dziesiętnym
    $rows  = array_map(function ($r) {
        return [
            'label'  => $r['label'] ?? '',
            'cells'  => array_map('trim', (array)($r['values'] ?? [])),
        ];
    }, $_ri_data['rows']);
} else {
    // Fallback: stare pola ACF (przecinkowe) — lata nie zawierają przecinka dziesiętnego
    $years_str = mer_field('ri_dane_years', '2012,2013,2014,2015,2016,2017,2018,2019,2020,2021,2022,2023,2024');
    $years     = array_values(array_filter(array_map('trim', explode(',', $years_str))));
    $rows      = [];
    for ($i = 1; $i <= 10; $i++) {
        $r = get_field("ri_dane_row_{$i}");
        if (!empty($r['label'])) {
            $rows[] = [
                'label' => $r['label'],
                'cells' => array_map('trim', explode(',', $r['values'] ?? '')),
            ];
        }
    }
    if (empty($rows)) {
        $rows = [
            ['label' => 'Przychody ze sprzedaży',           'cells' => []],
            ['label' => 'Zysk brutto ze sprzedaży',         'cells' => []],
            ['label' => 'Zysk z działalności operacyjnej',  'cells' => []],
            ['label' => 'EBITDA',                            'cells' => []],
            ['label' => 'Zysk netto',                        'cells' => []],
            ['label' => 'Aktywa trwałe',                     'cells' => []],
            ['label' => 'Aktywa obrotowe',                   'cells' => []],
            ['label' => 'Aktywa razem',                      'cells' => []],
            ['label' => 'Kapitał własny',                    'cells' => []],
            ['label' => 'Zobowiązania razem',                'cells' => []],
        ];
    }
}

$col_count = count($years);
?>

<section id="ri-dane" class="py-10 md:py-14 bg-emerald-50 relative">

    <!-- Dekoracyjny okrąg lewy -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
        <div class="absolute -left-40 top-1/2 -translate-y-1/2 w-[480px] h-[480px] rounded-full border-[60px] border-emerald-300/30"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">

        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 mb-10">
            <?php echo mer_esc($title); ?>
        </h2>

        <!-- Tabela z poziomym przewijaniem -->
        <div class="rounded-2xl shadow-sm ri-table-scroll" style="overflow-x: scroll;">
            <table class="border-collapse text-sm" style="min-width: 1400px; width: max-content;">

                <!-- Nagłówek -->
                <thead>
                    <tr class="bg-[#00d084] text-white">
                        <th class="text-left px-6 py-4 font-medium rounded-tl-2xl whitespace-nowrap">
                            <?php echo mer_esc(mer_t('ri_dane_naglowek', 'Dane finansowe (tys. PLN)')); ?>
                        </th>
                        <?php foreach ($years as $i => $year) : ?>
                            <th class="px-4 py-4 font-medium text-center whitespace-nowrap<?php echo ($i === $col_count - 1) ? ' rounded-tr-2xl' : ''; ?>">
                                <?php echo mer_esc($year); ?>
                            </th>
                        <?php endforeach; ?>
                    </tr>
                </thead>

                <!-- Wiersze -->
                <tbody class="bg-white">
                    <?php foreach ($rows as $ri => $row) :
                        $label   = is_array($row) ? ($row['label'] ?? '') : '';
                        $cells   = is_array($row) ? ($row['cells'] ?? []) : [];
                        $is_last = ($ri === count($rows) - 1);
                    ?>
                        <tr class="<?php echo $is_last ? '' : 'border-b border-slate-100'; ?> hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 text-slate-700 font-medium whitespace-nowrap<?php echo $is_last ? ' rounded-bl-2xl' : ''; ?>">
                                <?php echo mer_esc($label); ?>
                            </td>
                            <?php foreach ($years as $ci => $year) :
                                $val = isset($cells[$ci]) ? $cells[$ci] : '—';
                                $is_last_col = ($ci === $col_count - 1);
                            ?>
                                <td class="px-4 py-4 text-center text-slate-500 whitespace-nowrap<?php echo ($is_last && $is_last_col) ? ' rounded-br-2xl' : ''; ?>">
                                    <?php echo mer_esc($val); ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>

    </div>
</section>
