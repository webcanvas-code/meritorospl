<?php
/**
 * Metaboksa: Dane finansowe (tabela) – Relacje inwestorskie
 *
 * Dane zapisywane jako JSON w post meta "_ri_dane_table".
 * Sekcja section-ri-dane.php odczytuje ten JSON (z fallbackiem na stare pola ACF).
 */
defined('ABSPATH') || exit;

/* ── Rejestracja metaboksy ────────────────────────────────────────── */
add_action('add_meta_boxes', function () {
    add_meta_box(
        'ri_dane_table_mb',
        'Dane finansowe – tabela',
        '_ri_dane_mb_render',
        'page',
        'normal',
        'high'
    );
});

/* ── Render ──────────────────────────────────────────────────────── */
function _ri_dane_mb_render(WP_Post $post): void {
    $template = get_post_meta($post->ID, '_wp_page_template', true);
    if ($template !== 'page-relacje-inwestorskie.php') {
        echo '<p style="color:#aaa;font-style:italic">Aktywna tylko na stronie Relacje inwestorskie.</p>';
        return;
    }

    wp_nonce_field('ri_dane_mb_save', 'ri_dane_mb_nonce');

    /* Domyślne dane */
    $def_years = ['2012','2013','2014','2015','2016','2017','2018','2019','2020','2021','2022','2023','2024'];
    $def_rows  = [
        'Przychody ze sprzedaży',
        'Zysk brutto ze sprzedaży',
        'Zysk z działalności operacyjnej',
        'EBITDA',
        'Zysk netto',
        'Aktywa trwałe',
        'Aktywa obrotowe',
        'Aktywa razem',
        'Kapitał własny',
        'Zobowiązania razem',
    ];

    /* Wczytaj zapisane dane */
    $raw  = get_post_meta($post->ID, '_ri_dane_table', true);
    $data = $raw ? json_decode($raw, true) : [];

    $years = !empty($data['years']) ? $data['years'] : $def_years;
    $rows  = [];
    if (!empty($data['rows'])) {
        foreach ($data['rows'] as $r) {
            $vals = array_pad((array)($r['values'] ?? []), count($years), '');
            $rows[] = ['label' => $r['label'] ?? '', 'values' => $vals];
        }
    } else {
        foreach ($def_rows as $lbl) {
            $rows[] = ['label' => $lbl, 'values' => array_fill(0, count($years), '')];
        }
    }
    ?>

    <style>
    #ri-dane-wrap { overflow-x: auto; margin: 0 -12px; padding: 0 12px 4px; }
    #ri-dane-tbl  { border-collapse: collapse; font-size: 13px; }
    #ri-dane-tbl th,
    #ri-dane-tbl td { border: 1px solid #ddd; padding: 0; }
    #ri-dane-tbl thead th { background: #00d084; color: #fff; }
    #ri-dane-tbl thead th:first-child { min-width: 200px; }
    #ri-dane-tbl tbody td:first-child { background: #f8fafc; }
    #ri-dane-tbl input[type=text] {
        display: block; width: 100%; min-width: 72px; border: none;
        background: transparent; padding: 6px 8px; font-size: 13px;
        box-sizing: border-box; outline: none;
    }
    #ri-dane-tbl input[type=text]:focus { background: #fffbeb; }
    #ri-dane-tbl thead input[type=text] { color: #fff; font-weight: 700; text-align: center; min-width: 60px; }
    #ri-dane-tbl thead input[type=text]::placeholder { color: rgba(255,255,255,.55); }
    #ri-dane-tbl tbody td:not(:first-child) input { text-align: center; }
    #ri-dane-tbl tbody tr:hover td { background: #f0fdf4; }
    #ri-dane-tbl tbody tr:hover td:first-child { background: #dcfce7; }
    .ri-dane-actions { margin-top: 10px; display: flex; gap: 8px; align-items: center; flex-wrap: wrap; }
    .ri-dane-actions button { cursor: pointer; }
    .ri-dane-del-row { background: none; border: none; color: #ef4444; cursor: pointer;
        font-size: 15px; padding: 4px 6px; line-height: 1; }
    .ri-dane-del-row:hover { color: #b91c1c; }
    </style>

    <div id="ri-dane-wrap">
        <table id="ri-dane-tbl">
            <thead>
                <tr>
                    <th style="text-align:left; padding:6px 8px;">Wskaźnik / Rok →</th>
                    <?php foreach ($years as $y) : ?>
                    <th><input type="text" class="ri-year" value="<?php echo esc_attr($y); ?>" placeholder="Rok"></th>
                    <?php endforeach; ?>
                    <th style="background:#00b872; min-width:32px;"></th><!-- kolumna na przycisk del-col -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row) : ?>
                <tr>
                    <td><input type="text" class="ri-label" value="<?php echo esc_attr($row['label']); ?>" placeholder="Nazwa wskaźnika"></td>
                    <?php foreach ($row['values'] as $v) : ?>
                    <td><input type="text" class="ri-cell" value="<?php echo esc_attr($v); ?>" placeholder="—"></td>
                    <?php endforeach; ?>
                    <td style="background:#fef2f2; text-align:center;">
                        <button type="button" class="ri-dane-del-row" title="Usuń wiersz">✕</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="ri-dane-actions">
        <button type="button" id="ri-dane-add-row" class="button">+ Dodaj wiersz</button>
        <button type="button" id="ri-dane-add-col" class="button">+ Dodaj rok (kolumnę)</button>
        <span id="ri-dane-status" style="color:#666;font-size:12px;margin-left:8px;"></span>
    </div>

    <input type="hidden" name="ri_dane_json" id="ri-dane-json" value="<?php echo esc_attr($raw ?: ''); ?>">

    <script>
    (function () {
        var tbl    = document.getElementById('ri-dane-tbl');
        var jInput = document.getElementById('ri-dane-json');
        var status = document.getElementById('ri-dane-status');

        /* ── Serializacja → JSON ── */
        function serialize() {
            var years = [], rows = [];
            tbl.querySelectorAll('thead .ri-year').forEach(function (i) {
                years.push(i.value.trim());
            });
            tbl.querySelectorAll('tbody tr').forEach(function (tr) {
                var label  = tr.querySelector('.ri-label').value.trim();
                var values = [];
                tr.querySelectorAll('.ri-cell').forEach(function (i) { values.push(i.value.trim()); });
                rows.push({ label: label, values: values });
            });
            // Zamień \uXXXX na literalne UTF-8 — wp_unslash po stronie PHP usuwa backslashe
            // z takich sekwencji, co niszczy polskie znaki przy zapisie.
            var json = JSON.stringify({ years: years, rows: rows });
            json = json.replace(/\\u([0-9a-fA-F]{4})/g, function (_, hex) {
                return String.fromCharCode(parseInt(hex, 16));
            });
            jInput.value = json;
            if (status) status.textContent = 'Gotowe do zapisania.';
        }

        /* Serializuj od razu po załadowaniu */
        serialize();

        /* Serializuj na bieżąco przy każdej zmianie w tabeli (Gutenberg + klasyczny edytor) */
        tbl.addEventListener('input', serialize);

        /* Dodatkowy fallback: submit klasycznego formularza */
        var form = document.getElementById('post');
        if (form) form.addEventListener('submit', serialize);

        /* ── Dodaj wiersz ── */
        document.getElementById('ri-dane-add-row').addEventListener('click', function () {
            var colCount = tbl.querySelectorAll('thead .ri-year').length;
            var tr = document.createElement('tr');
            var td0 = document.createElement('td');
            td0.innerHTML = '<input type="text" class="ri-label" placeholder="Nazwa wskaźnika">';
            tr.appendChild(td0);
            for (var i = 0; i < colCount; i++) {
                var td = document.createElement('td');
                td.innerHTML = '<input type="text" class="ri-cell" placeholder="—">';
                tr.appendChild(td);
            }
            var tdDel = document.createElement('td');
            tdDel.style.cssText = 'background:#fef2f2;text-align:center';
            tdDel.innerHTML = '<button type="button" class="ri-dane-del-row" title="Usuń wiersz">✕</button>';
            tr.appendChild(tdDel);
            tbl.querySelector('tbody').appendChild(tr);
        });

        /* ── Dodaj kolumnę (rok) ── */
        document.getElementById('ri-dane-add-col').addEventListener('click', function () {
            var headRow = tbl.querySelector('thead tr');
            /* Wstaw przed ostatnią kolumną (przycisk del-col) */
            var lastTh = headRow.lastElementChild;
            var th = document.createElement('th');
            th.innerHTML = '<input type="text" class="ri-year" placeholder="Rok">';
            headRow.insertBefore(th, lastTh);
            tbl.querySelectorAll('tbody tr').forEach(function (tr) {
                var lastTd = tr.lastElementChild;
                var td = document.createElement('td');
                td.innerHTML = '<input type="text" class="ri-cell" placeholder="—">';
                tr.insertBefore(td, lastTd);
            });
        });

        /* ── Usuń wiersz (delegacja) ── */
        tbl.querySelector('tbody').addEventListener('click', function (e) {
            if (e.target.classList.contains('ri-dane-del-row')) {
                if (confirm('Usunąć ten wiersz?')) {
                    e.target.closest('tr').remove();
                }
            }
        });
    })();
    </script>
    <?php
}

/* ── Zapis ───────────────────────────────────────────────────────── */
add_action('save_post', function (int $post_id): void {
    if (!isset($_POST['ri_dane_mb_nonce'])) return;
    if (!wp_verify_nonce($_POST['ri_dane_mb_nonce'], 'ri_dane_mb_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $json = isset($_POST['ri_dane_json']) ? wp_unslash($_POST['ri_dane_json']) : '';
    if (!$json) return;

    $data = json_decode($json, true);
    if (!is_array($data) || empty($data['years']) || empty($data['rows'])) return;

    /* Sanityzacja */
    $data['years'] = array_map('sanitize_text_field', $data['years']);
    foreach ($data['rows'] as &$row) {
        $row['label']  = sanitize_text_field($row['label'] ?? '');
        $row['values'] = array_map('sanitize_text_field', (array)($row['values'] ?? []));
    }
    unset($row);

    update_post_meta($post_id, '_ri_dane_table', wp_json_encode($data, JSON_UNESCAPED_UNICODE));
});
