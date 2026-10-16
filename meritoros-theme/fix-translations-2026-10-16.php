<?php
/**
 * Jednorazowy skrypt: rejestracja brakujących tłumaczeń w WPML String Translation.
 * Dotyczy: newsletter checkboxy, kalkulator kontakt, formularz CF7 consent, RODO.
 *
 * Uruchomienie: wp-admin → Narzędzia → wklej URL:
 * /wp-admin/admin.php?mer_fix_translations_2026_10_16=1
 */
add_action('admin_init', function () {
    if (empty($_GET['mer_fix_translations_2026_10_16']) || !current_user_can('manage_options')) {
        return;
    }

    if (!function_exists('icl_add_string_translation') || !function_exists('icl_get_string_id')) {
        wp_die('WPML String Translation nie jest aktywne.');
    }

    $context = 'meritoros';

    $strings = [
        // ── Newsletter checkboxy i UI ──
        'Chcę otrzymywać miesięczne podsumowania zmian podatkowych' => [
            'en' => 'I want to receive monthly tax change summaries',
        ],
        'Chcę otrzymywać oferty pracy' => [
            'en' => 'I want to receive job offers',
        ],
        'Zapisz się' => [
            'en' => 'Subscribe',
        ],
        'Twój adres e-mail' => [
            'en' => 'Your email address',
        ],
        'Administratorem danych jest Meritoros SA, Aleja Pokoju 62/8, Kraków. Dane przetwarzane są w celu wysyłki newslettera. Więcej informacji w' => [
            'en' => 'Data controller is Meritoros SA, Aleja Pokoju 62/8, Krakow. Data is processed for the purpose of sending the newsletter. More information in',
        ],
        'Polityce Prywatności' => [
            'en' => 'Privacy Policy',
        ],
        'i' => [
            'en' => 'and',
        ],
        'Regulaminie Newslettera' => [
            'en' => 'Newsletter Terms',
        ],
        'Prawie gotowe! Sprawdź skrzynkę e-mail i potwierdź subskrypcję.' => [
            'en' => 'Almost done! Check your email and confirm your subscription.',
        ],
        'Wystąpił błąd. Spróbuj ponownie.' => [
            'en' => 'An error occurred. Please try again.',
        ],

        // ── Kalkulator kontakt ──
        'Sprawdź orientacyjny koszt obsługi' => [
            'en' => 'Check approximate service cost',
        ],
        'Podaj kilka liczb — my podamy orientacyjną cenę.' => [
            'en' => 'Enter a few numbers and we will give you an approximate price.',
        ],
        'Kadry i płace' => [
            'en' => 'Payroll & HR',
        ],
        'Usługi księgowe' => [
            'en' => 'Accounting services',
        ],
        'Wybierz zakres' => [
            'en' => 'Select scope',
        ],
        'Same kadry' => [
            'en' => 'HR only',
        ],
        'Same płace' => [
            'en' => 'Payroll only',
        ],
        'Rozliczenie umów (podwykonawcy)' => [
            'en' => 'Contract settlements (subcontractors)',
        ],
        'Liczba pracowników' => [
            'en' => 'Number of employees',
        ],
        'Ilość wypłat / mies.' => [
            'en' => 'Payrolls / month',
        ],
        'Wybierz typ księgowości' => [
            'en' => 'Select accounting type',
        ],
        'Księgowość uproszczona (KPiR, ryczałt)' => [
            'en' => 'Simplified accounting (KPiR, flat-rate)',
        ],
        'Pełna księgowość (KH)' => [
            'en' => 'Full accounting (KH)',
        ],
        'Liczba dokumentów miesięcznie' => [
            'en' => 'Number of documents per month',
        ],
        'Oblicz kwotę obsługi' => [
            'en' => 'Calculate service cost',
        ],
        'Orientacyjna cena netto' => [
            'en' => 'Approximate net price',
        ],
        '* to jest wstępny szacunek, każda oferta jest indywidualnie rozpatrywana i odpowiednio wyceniana.' => [
            'en' => '* This is a preliminary estimate. Each offer is individually assessed and priced accordingly.',
        ],
        'Liczba podwykonawców' => [
            'en' => 'Number of subcontractors',
        ],

        // ── Kontakt hero ──
        'Analiza potrzeb' => [
            'en' => 'Needs analysis',
        ],
        'Propozycja rozwiązania' => [
            'en' => 'Solution proposal',
        ],
        'Wdrożenie' => [
            'en' => 'Implementation',
        ],
        'Stałe wsparcie' => [
            'en' => 'Ongoing support',
        ],

        // ── Kontakt info ──
        'Adres' => [
            'en' => 'Address',
        ],
        'Administracja' => [
            'en' => 'Administration',
        ],
        'Zapytaj o ofertę' => [
            'en' => 'Request a quote',
        ],
        'Adres do e-doręczeń' => [
            'en' => 'E-delivery address',
        ],
        'Siedziba główna' => [
            'en' => 'Headquarters',
        ],
        'Kraków' => [
            'en' => 'Krakow',
        ],
        'Krajowy Rejestr Sądowy (KRS)' => [
            'en' => 'National Court Register (KRS)',
        ],
        'Nr KRS:' => [
            'en' => 'KRS No.:',
        ],
        'Mapa Polski z oddziałami' => [
            'en' => 'Map of Poland with branches',
        ],
    ];

    $added   = 0;
    $updated = 0;
    $skipped = 0;

    foreach ($strings as $original => $translations) {
        // Rejestruj string
        do_action('wpml_register_single_string', $context, md5($original), $original);

        $string_id = icl_get_string_id($original, $context);
        if (!$string_id) {
            $string_id = icl_get_string_id($original, $context, md5($original));
        }

        if (!$string_id) {
            $skipped++;
            continue;
        }

        foreach ($translations as $lang => $translation) {
            $result = icl_add_string_translation($string_id, $lang, $translation, ICL_TM_COMPLETE);
            if ($result) {
                $added++;
            } else {
                $updated++;
            }
        }
    }

    wp_die(
        "<h2>Tłumaczenia zaktualizowane</h2>
         <p>Dodane: <strong>{$added}</strong></p>
         <p>Zaktualizowane: <strong>{$updated}</strong></p>
         <p>Pominięte (nie znaleziono ID): <strong>{$skipped}</strong></p>
         <p><a href='" . admin_url('admin.php?page=wpml-string-translation%2Fmenu%2Fstring-translation.php&context=meritoros') . "'>→ Sprawdź w WPML String Translation</a></p>",
        'Fix translations 2026-10-16',
        ['back_link' => true]
    );
});
