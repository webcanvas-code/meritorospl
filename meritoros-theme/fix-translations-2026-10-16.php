<?php
/**
 * Jednorazowy skrypt: rejestracja WSZYSTKICH brakujących tłumaczeń w WPML String Translation.
 *
 * Uruchomienie: /wp-admin/admin.php?mer_fix_translations_2026_10_16=1
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

        // ══════════════════════════════════════════════
        // HEADER
        // ══════════════════════════════════════════════
        'Skontaktuj się'           => ['en' => 'Contact us'],
        'Panel klienta'            => ['en' => 'Client panel'],
        'Menu'                     => ['en' => 'Menu'],
        'Menu główne'              => ['en' => 'Main menu'],
        'Otwórz menu'              => ['en' => 'Open menu'],
        'Zamknij menu'             => ['en' => 'Close menu'],

        // ══════════════════════════════════════════════
        // FOOTER
        // ══════════════════════════════════════════════
        'Zacznij teraz'            => ['en' => 'Start now'],
        "Dołącz do grona naszych\nklientów i rozwijaj biznes" => ['en' => "Join our clients\nand grow your business"],
        'bez stresu'               => ['en' => 'stress-free'],
        'Umów rozmowę'             => ['en' => 'Book a call'],
        'Profesjonalne biuro rachunkowe i BPO dla firm z ambicjami.' => ['en' => 'Professional accounting and BPO services for ambitious companies.'],
        '© [YEAR] Meritoros SA. Wszelkie prawa zastrzeżone.' => ['en' => '© [YEAR] Meritoros SA. All rights reserved.'],
        'Usługi'                   => ['en' => 'Services'],
        'Informacje'               => ['en' => 'Information'],
        'Kontakt'                  => ['en' => 'Contact'],
        'Polityka Prywatności'     => ['en' => 'Privacy Policy'],
        'Media'                    => ['en' => 'Media'],
        'Biuro rachunkowe'         => ['en' => 'Accounting office'],
        'Regulamin newslettera'    => ['en' => 'Newsletter terms'],
        'Wiedza i poradniki'       => ['en' => 'Knowledge & guides'],
        'Projekt i realizacja:'    => ['en' => 'Design & development:'],

        // ══════════════════════════════════════════════
        // BREADCRUMBS (wiele plikow)
        // ══════════════════════════════════════════════
        'Strona główna'            => ['en' => 'Home'],
        'Kadry i płace'            => ['en' => 'Payroll & HR'],
        'Usługi księgowe'          => ['en' => 'Accounting services'],
        'Kariera'                  => ['en' => 'Careers'],
        'Historie klientów'        => ['en' => 'Client stories'],
        'Media i newsroom'         => ['en' => 'Media & newsroom'],
        'Kupimy biuro rachunkowe'  => ['en' => 'We buy accounting offices'],

        // ══════════════════════════════════════════════
        // 404
        // ══════════════════════════════════════════════
        'Strona nie istnieje'      => ['en' => 'Page not found'],
        'Strona, której szukasz, mogła zostać przeniesiona lub usunięta. Wróć na stronę główną lub skontaktuj się z nami.' => ['en' => 'The page you are looking for may have been moved or deleted. Go back to the homepage or contact us.'],

        // ══════════════════════════════════════════════
        // NEWSLETTER
        // ══════════════════════════════════════════════
        'Chcę otrzymywać miesięczne podsumowania zmian podatkowych' => ['en' => 'I want to receive monthly tax change summaries'],
        'Chcę otrzymywać oferty pracy'                              => ['en' => 'I want to receive job offers'],
        'Zapisz się'               => ['en' => 'Subscribe'],
        'Twój adres e-mail'        => ['en' => 'Your email address'],
        'Administratorem danych jest Meritoros SA, Aleja Pokoju 62/8, Kraków. Dane przetwarzane są w celu wysyłki newslettera. Więcej informacji w' => ['en' => 'Data controller is Meritoros SA, Aleja Pokoju 62/8, Krakow. Data is processed for the purpose of sending the newsletter. More information in'],
        'Polityce Prywatności'     => ['en' => 'Privacy Policy'],
        'i'                        => ['en' => 'and'],
        'Regulaminie Newslettera'  => ['en' => 'Newsletter Terms'],
        'Prawie gotowe! Sprawdź skrzynkę e-mail i potwierdź subskrypcję.' => ['en' => 'Almost done! Check your email and confirm your subscription.'],
        'Wystąpił błąd. Spróbuj ponownie.' => ['en' => 'An error occurred. Please try again.'],

        // ══════════════════════════════════════════════
        // KALKULATOR KONTAKT
        // ══════════════════════════════════════════════
        'Sprawdź orientacyjny koszt obsługi' => ['en' => 'Check approximate service cost'],
        'Podaj kilka liczb — my podamy orientacyjną cenę.' => ['en' => 'Enter a few numbers and we will give you an approximate price.'],
        'Wybierz zakres'           => ['en' => 'Select scope'],
        'Same kadry'               => ['en' => 'HR only'],
        'Same płace'               => ['en' => 'Payroll only'],
        'Rozliczenie umów (podwykonawcy)' => ['en' => 'Contract settlements (subcontractors)'],
        'Liczba pracowników'       => ['en' => 'Number of employees'],
        'Ilość wypłat / mies.'     => ['en' => 'Payrolls / month'],
        'Wybierz typ księgowości'  => ['en' => 'Select accounting type'],
        'Księgowość uproszczona (KPiR, ryczałt)' => ['en' => 'Simplified accounting (KPiR, flat-rate)'],
        'Pełna księgowość (KH)'    => ['en' => 'Full accounting (KH)'],
        'Liczba dokumentów miesięcznie' => ['en' => 'Number of documents per month'],
        'Oblicz kwotę obsługi'     => ['en' => 'Calculate service cost'],
        'Orientacyjna cena netto'  => ['en' => 'Approximate net price'],
        '* to jest wstępny szacunek, każda oferta jest indywidualnie rozpatrywana i odpowiednio wyceniana.' => ['en' => '* This is a preliminary estimate. Each offer is individually assessed and priced accordingly.'],
        'Liczba podwykonawców'     => ['en' => 'Number of subcontractors'],
        'Wybierz z listy'          => ['en' => 'Select from list'],
        'Ilość wypłat na miesiąc'  => ['en' => 'Payrolls per month'],
        'Księgowość uproszczona (KPiR, ewidencja ryczałtowa)' => ['en' => 'Simplified accounting (KPiR, flat-rate records)'],

        // ══════════════════════════════════════════════
        // KONTAKT HERO
        // ══════════════════════════════════════════════
        'Analiza potrzeb'          => ['en' => 'Needs analysis'],
        'Propozycja rozwiązania'   => ['en' => 'Solution proposal'],
        'Wdrożenie'                => ['en' => 'Implementation'],
        'Stałe wsparcie'           => ['en' => 'Ongoing support'],

        // ══════════════════════════════════════════════
        // KONTAKT INFO
        // ══════════════════════════════════════════════
        'Adres'                    => ['en' => 'Address'],
        'Administracja'            => ['en' => 'Administration'],
        'Zapytaj o ofertę'         => ['en' => 'Request a quote'],
        'Adres do e-doręczeń'      => ['en' => 'E-delivery address'],
        'Siedziba główna'          => ['en' => 'Headquarters'],
        'Kraków'                   => ['en' => 'Krakow'],
        'Krajowy Rejestr Sądowy (KRS)' => ['en' => 'National Court Register (KRS)'],
        'Nr KRS:'                  => ['en' => 'KRS No.:'],
        'Mapa Polski z oddziałami' => ['en' => 'Map of Poland with branches'],

        // ══════════════════════════════════════════════
        // BLOG / ARTYKULY
        // ══════════════════════════════════════════════
        'Brak opublikowanych artykułów.' => ['en' => 'No published articles.'],
        'Film'                     => ['en' => 'Video'],
        'Czytaj artykuł'           => ['en' => 'Read article'],
        'Historia klienta'         => ['en' => 'Client story'],
        'Czytaj historię'          => ['en' => 'Read story'],
        'Przeczytaj artykuł'       => ['en' => 'Read article'],
        'Brak artykułów w tej kategorii.' => ['en' => 'No articles in this category.'],
        'Załaduj więcej'           => ['en' => 'Load more'],
        'Zamknij'                  => ['en' => 'Close'],
        'Powrót do'                => ['en' => 'Back to'],
        'Powrót do Media i newsroom' => ['en' => 'Back to Media & newsroom'],
        'Spis treści'              => ['en' => 'Table of contents'],
        'Przeczytaj również'       => ['en' => 'Read also'],
        'Zakres współpracy:'       => ['en' => 'Scope of cooperation:'],
        'Zakres współpracy'        => ['en' => 'Scope of cooperation'],
        'Obejrzyj materiał'        => ['en' => 'Watch video'],
        'Case study'               => ['en' => 'Case study'],
        'Branża'                   => ['en' => 'Industry'],
        'Blog'                     => ['en' => 'Blog'],
        'Rynek biur rachunkowych'  => ['en' => 'Accounting firms market'],
        'Wszystkie wpisy'          => ['en' => 'All posts'],

        // ══════════════════════════════════════════════
        // CASE STUDIES / HISTORIE
        // ══════════════════════════════════════════════
        'Poprzednia historia'      => ['en' => 'Previous story'],
        'Następna historia'        => ['en' => 'Next story'],
        'Nawigacja slajdów'        => ['en' => 'Slide navigation'],
        'Odtwórz wideo'            => ['en' => 'Play video'],
        'Poznaj więcej historii'   => ['en' => 'Explore more stories'],
        'Poznaj historię'          => ['en' => 'Explore story'],

        // ══════════════════════════════════════════════
        // KARIERA
        // ══════════════════════════════════════════════
        'Pytania od kandydatów'    => ['en' => 'Questions from candidates'],
        'Rekrutacja'               => ['en' => 'Recruitment'],
        'Zainteresowana / Zainteresowany?' => ['en' => 'Interested?'],
        'Wyślij nam swoje CV'      => ['en' => 'Send us your CV'],
        'Prześlij swoje CV przez formularz na stronie Kariery. Rekrutacja odbywa się w kilku prostych krokach – skontaktujemy się z Tobą tak szybko, jak to możliwe.' => ['en' => 'Submit your CV through the form on the Careers page. Recruitment takes just a few simple steps - we will contact you as soon as possible.'],
        'Wyślij CV'                => ['en' => 'Send CV'],
        'Inne oferty pracy'        => ['en' => 'Other job offers'],
        'Co oferujemy'             => ['en' => 'What we offer'],
        'Dołączając do Meritoros, zyskujesz więcej niż tylko pracę.' => ['en' => 'By joining Meritoros, you gain more than just a job.'],
        'Aplikuj teraz'            => ['en' => 'Apply now'],
        'Poprzednie zdjęcie'       => ['en' => 'Previous photo'],
        'Następne zdjęcie'         => ['en' => 'Next photo'],
        'Czytaj więcej...'         => ['en' => 'Read more...'],

        // ══════════════════════════════════════════════
        // KUPIMY
        // ══════════════════════════════════════════════
        'Nie spełniasz wszystkich kryteriów?' => ['en' => "Don't meet all criteria?"],
        'Warto się odezwać — chętnie sprawdzimy, czy widzimy przestrzeń do współpracy.' => ['en' => "It's worth reaching out - we'll be happy to check if there is room for cooperation."],

        // ══════════════════════════════════════════════
        // BPO
        // ══════════════════════════════════════════════
        'Sprawdź'                  => ['en' => 'Learn more'],

        // ══════════════════════════════════════════════
        // TESTIMONIALS
        // ══════════════════════════════════════════════
        'Breadcrumb'               => ['en' => 'Breadcrumb'],

        // ══════════════════════════════════════════════
        // MENU (register_nav_menus)
        // ══════════════════════════════════════════════
        'Menu stopki'              => ['en' => 'Footer menu'],

        // ══════════════════════════════════════════════
        // EBOOK
        // ══════════════════════════════════════════════
        'Darmowy materiał'         => ['en' => 'Free resource'],

        // ══════════════════════════════════════════════
        // SINGLE POST
        // ══════════════════════════════════════════════
        'Nagroda'                  => ['en' => 'Award'],
        'Logo klienta'             => ['en' => 'Client logo'],

        // ══════════════════════════════════════════════
        // ZAUFANYCH KLIENTOW (hero-logos)
        // ══════════════════════════════════════════════
        "zaufanych\nklientów"      => ['en' => "trusted\nclients"],
    ];

    $added   = 0;
    $updated = 0;
    $skipped = 0;

    foreach ($strings as $original => $translations) {
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

    $total = count($strings);
    wp_die(
        "<h2>Tłumaczenia zaktualizowane</h2>
         <p>Stringów: <strong>{$total}</strong></p>
         <p>Dodane: <strong>{$added}</strong></p>
         <p>Zaktualizowane: <strong>{$updated}</strong></p>
         <p>Pominięte (nie znaleziono ID): <strong>{$skipped}</strong></p>
         <p><a href='" . admin_url('admin.php?page=wpml-string-translation%2Fmenu%2Fstring-translation.php&context=meritoros') . "'>→ Sprawdź w WPML String Translation</a></p>",
        'Fix translations 2026-10-16',
        ['back_link' => true]
    );
});
