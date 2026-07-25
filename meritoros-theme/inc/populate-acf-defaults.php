<?php
/**
 * Narzędzie do jednorazowego wypełnienia pól ACF domyślnymi wartościami.
 * Dostępne w WP Admin → Narzędzia → Wypełnij pola ACF
 */

add_action('admin_menu', function () {
    add_management_page(
        'Wypełnij pola ACF',
        'Wypełnij pola ACF',
        'manage_options',
        'mer-populate-acf',
        'mer_populate_acf_render_page'
    );
});

function mer_populate_acf_render_page() {
    $result = null;
    if (isset($_POST['mer_populate_run']) && check_admin_referer('mer_populate_acf_nonce')) {
        $overwrite = !empty($_POST['mer_overwrite']);
        $result    = mer_run_populate_acf_defaults($overwrite);
    }
    ?>
    <div class="wrap">
        <h1>Wypełnij pola ACF domyślnymi wartościami</h1>
        <p>Kliknij przycisk, aby zapisać domyślne wartości tekstów do pól ACF dla wszystkich podstron. Pola już wypełnione zostaną <strong>pominięte</strong> (chyba że zaznaczysz nadpisywanie).</p>
        <?php if ($result !== null) : ?>
            <div class="notice notice-success is-dismissible">
                <p>
                    Zakończono. Zaktualizowano: <strong><?php echo (int) $result['updated']; ?></strong>,
                    pominięto: <strong><?php echo (int) $result['skipped']; ?></strong>,
                    błędów (brak strony): <strong><?php echo (int) $result['missing']; ?></strong>.
                </p>
            </div>
            <?php if (!empty($result['missing_pages'])) : ?>
            <div class="notice notice-warning is-dismissible">
                <p>Nie znaleziono stron (sprawdź slug): <code><?php echo implode(', ', array_map('esc_html', $result['missing_pages'])); ?></code></p>
            </div>
            <?php endif; ?>
        <?php endif; ?>
        <form method="post">
            <?php wp_nonce_field('mer_populate_acf_nonce'); ?>
            <table class="form-table">
                <tr>
                    <th>Nadpisuj istniejące wartości</th>
                    <td><label><input type="checkbox" name="mer_overwrite" value="1"> Zaznacz tylko jeśli chcesz przywrócić domyślne teksty (nadpisze Twoje zmiany!)</label></td>
                </tr>
            </table>
            <p><input type="submit" name="mer_populate_run" class="button button-primary" value="Wypełnij pola ACF domyślnymi wartościami"></p>
        </form>
    </div>
    <?php
}

function mer_run_populate_acf_defaults(bool $overwrite = false): array {
    if (!function_exists('update_field')) {
        return ['updated' => 0, 'skipped' => 0, 'missing' => 0, 'missing_pages' => ['ACF nie jest aktywne']];
    }

    $fp_id = (int) get_option('page_on_front');

    // Pomocnicza funkcja do pobierania ID strony po slugu
    $page = function (string $slug) use (&$missing_slugs): int {
        $p = get_page_by_path($slug);
        if (!$p) {
            $missing_slugs[] = $slug;
            return 0;
        }
        return (int) $p->ID;
    };

    $missing_slugs = [];

    $bpo     = $page('bpo');
    $kar     = $page('kariera');
    $onas    = $page('o-nas');
    $media   = $page('media');
    $kon     = $page('kontakt');
    $ri      = $page('relacje-inwestorskie');
    $uk      = $page('uslugi-ksiegowe');
    $kp      = $page('kadry-i-place');
    $fr      = $page('fundacje-rodzinne');
    $kupimy  = $page('kupimy-biuro-rachunkowe');
    $hk      = $page('historie-klientow');

    // [ post_id, field_key, default_value ]
    $definitions = [

        // ── Strona główna ─────────────────────────────────────────────────────────
        [$fp_id, 'hero_headline',        "Eksperci w księgowości.\nTechnologia i pewność\nw działaniu."],
        [$fp_id, 'hero_subheadline',     'Zapewniamy księgowość kadry i outsourcing procesów w standardzie, który daje firmom spokój i bezpieczeństwo.'],
        [$fp_id, 'hero_btn1_text',       'Poznaj ofertę'],
        [$fp_id, 'hero_btn1_url',        '#uslugi'],
        [$fp_id, 'hero_btn2_text',       'Porozmawiajmy'],
        [$fp_id, 'hero_btn2_url',        '#kontakt'],
        [$fp_id, 'hero_trust_text',      'Zaufało nam ponad <span class="text-white">1200 klientów</span>'],

        [$fp_id, 'values_label',         'Nasze Wartości'],
        [$fp_id, 'values_title',         "Dlaczego Meritoros to spokój\nw Twoim biznesie?"],
        [$fp_id, 'val_c1_icon',          'infinity'],
        [$fp_id, 'val_c1_title',         "Skala i ciągłość\nobsługi"],
        [$fp_id, 'val_c1_desc',          'Pracujemy zespołowo i procesowo, dzięki czemu obsługa nie zależy od jednej osoby. Zapewniamy zastępowalność i ciągłość pracy – bez przestojów.'],
        [$fp_id, 'val_img_hover_text',   'Współpracuj z profesjonalistami'],
        [$fp_id, 'val_c3_icon',          'shield-check'],
        [$fp_id, 'val_c3_title',         "Bezpieczeństwo\ni compliance"],
        [$fp_id, 'val_c3_desc',          'Działamy zgodnie z obowiązującymi regulacjami i standardami bezpieczeństwa danych. Dbamy o poufność informacji oraz jasne zasady współpracy - bez "skrótów" i ryzyk.'],
        [$fp_id, 'val_c4_icon',          'bot'],
        [$fp_id, 'val_c4_title',         "Technologia\ni automatyzacja"],
        [$fp_id, 'val_c4_desc',          'Wykorzystujemy narzędzia i automatyzację (RPA), które porządkują obieg dokumentów, ograniczają ryzyko błędów i usprawniają pracę zespołów.'],
        [$fp_id, 'val_c5_title',         'Nagrody i wyróżnienia'],
        [$fp_id, 'val_c5_desc',          'Wyróżnienia są efektem tego, jak rozwijamy Meritoros: konsekwentnie i procesowo. Trzymamy standard, który ma działać w praktyce - codziennie.'],
        [$fp_id, 'val_c6_icon',          'award'],
        [$fp_id, 'val_c6_title',         'Jakość potwierdzona standardami'],
        [$fp_id, 'val_c6_desc',          'Mamy wdrożone procedury kontroli jakości i weryfikacji danych. Dostarczamy spójne dane dla zarządu.'],
        [$fp_id, 'val_c6_cert_label',    'Certyfikat'],
        [$fp_id, 'val_c6_cert',          'ISO 9001:2015'],

        [$fp_id, 'services_label',       'Nasze Kompetencje'],
        [$fp_id, 'services_title',       'Obszary, w których przejmujemy odpowiedzialność'],
        [$fp_id, 'services_desc',        'Nasze doświadczenie obejmuje rozliczanie firm o różnorodnych profilach działalności, takich jak CIT Estoński, Fundacje Rodzinne, Spółki ASI, e-commerce, VAT OSS, Intrastat oraz rozliczenia delegacji pracowniczych.'],
        [$fp_id, 'services_cta_title',   'Zapytaj o ofertę'],
        [$fp_id, 'services_cta_sub',     'Skontaktuj się z nami'],

        [$fp_id, 'buyout_label',         'Dla biur rachunkowych'],
        [$fp_id, 'buyout_title',         "Kupimy Biuro\nRachunkowe"],
        [$fp_id, 'buyout_desc',          'Od lat współpracujemy z biurami rachunkowymi, które stoją przed decyzją o zmianie, sprzedaży lub dalszym rozwoju.'],
        [$fp_id, 'buyout_cta_text',      'Wyceń wartość biura'],
        [$fp_id, 'tech_label',           'Obsługujemy systemy ERP i finansowe wiodących dostawców'],
        [$fp_id, 'buyout_stat_1_icon',   'trending-up'],
        [$fp_id, 'buyout_stat_1_value',  '100%'],
        [$fp_id, 'buyout_stat_1_label',  'Przejrzystych warunków'],
        [$fp_id, 'buyout_stat_2_icon',   'handshake'],
        [$fp_id, 'buyout_stat_2_value',  '20+'],
        [$fp_id, 'buyout_stat_2_label',  'Przejętych biur'],
        [$fp_id, 'buyout_stat_3_icon',   'clock'],
        [$fp_id, 'buyout_stat_3_value',  '14 dni'],
        [$fp_id, 'buyout_stat_3_label',  'Do wstępnej wyceny'],
        [$fp_id, 'buyout_stat_4_icon',   'shield-check'],
        [$fp_id, 'buyout_stat_4_value',  'NDA'],
        [$fp_id, 'buyout_stat_4_label',  'Pełna poufność'],

        [$fp_id, 'cs_vid_general_text',  'Nasi klienci cenią nas za to, że dowozimy: jakość, terminowość i spójne dane. Jako partner w obszarze księgowości przejmujemy obszary, za które odpowiadamy, i pracujemy w standardzie, który daje spokój w codziennym prowadzeniu firmy.'],
        [$fp_id, 'cs_vid_general_url',   'https://www.youtube.com/watch?v=NKh2-7VGQbw'],

        [$fp_id, 'nav_cta_text',         'Skontaktuj się'],
        [$fp_id, 'nav_cta_url',          '#kontakt'],

        // ── BPO ───────────────────────────────────────────────────────────────────
        [$bpo, 'bpo_hero_title_normal',  'Rozwiązania BPO'],
        [$bpo, 'bpo_hero_title_green',   'dla większych organizacji'],
        [$bpo, 'bpo_hero_subtitle',      'Zapewniamy kompleksową obsługę kadrowo-płacową firm o różnej skali działalności. Przejmujemy odpowiedzialność za poprawność, terminowość i ciągłość procesów, aby organizacja mogła działać stabilnie i bez zakłóceń.'],
        [$bpo, 'bpo_hero_btn1_text',     'Poznaj ofertę'],
        [$bpo, 'bpo_hero_btn2_text',     'Porozmawiajmy'],
        [$bpo, 'bpo_hero_logos_title',   'Zaufało nam ponad 1200 klientów'],

        [$bpo, 'bpo_info_title',         "Stabilne procesy. Rzetelne\ndane. Spokój zarządu."],
        [$bpo, 'bpo_info_text',          'Wspieramy większe firmy w obszarze księgowości, kadr i płac, back-office, przejmując odpowiedzialność za jakość, terminowość i ciągłość działania. Dostarczamy dane i raporty w harmonogramie dopasowanym do zarządu – tak, żeby decyzje były oparte na spójnych informacjach, a nie „gaszeniu pożarów".'],
        [$bpo, 'bpo_info_items',         "raportowanie zarządcze i sprawozdawcze dopasowane do potrzeb organizacji\ncyfrowy obieg dokumentów i uporządkowane procesy\npełna zastępowalność i ciągłość obsługi oraz gotowość do skalowania"],
        [$bpo, 'bpo_awards_title',       'Nagrody i wyróżnienia'],
        [$bpo, 'bpo_awards_text',        'Wyróżnienia są efektem tego, jak rozwijamy Meritoros: konsekwentnie i procesowo. Trzymamy standard, który ma działać w praktyce - codziennie.'],
        [$bpo, 'bpo_stat1_text',         "Bezpieczeństwo\ni compliance"],
        [$bpo, 'bpo_stat2_text',         "Jakość potwierdzona\nstandardami"],
        [$bpo, 'bpo_stat3_text',         "Ponad 170\nexpertów"],

        [$bpo, 'bpo_ks_title_suffix',    'Rozwiązania księgowe'],
        [$bpo, 'bpo_ks_text',            'Outsourcing księgowości pozwala na znaczne obniżenie kosztów operacyjnych. Możemy dostarczyć wysokiej jakości usługi księgowe, eliminując potrzebę zatrudniania wewnętrznych ekspertów. Dzięki nowoczesnej technologii i dużej skali obsługiwanych przez nas operacji oszczędności sięgają 20-30% lub więcej w porównaniu do prowadzenia księgowości wewnętrznie. Dzięki digitalizacji obiegu dokumentów oraz sprawnym procesom możemy dostarczać raporty w czasie rzeczywistym.'],
        [$bpo, 'bpo_ks_btn_text',        'Dlaczego BPO z nami'],
        [$bpo, 'bpo_ks_items',           "Prowadzenie ksiąg rachunkowych\nObliczanie podatków i składanie deklaracji podatkowych\nBieżące rozliczanie wyciągów i kontrolowanie rozrachunków\nRaportowanie zarządcze i sprawozdawcze\nRaportowanie do instytucji publicznoprawnych, w tym NBP, GUS, INTRASTAT\nSporządzanie sprawozdań finansowych oraz deklaracji rocznych\nReprezentowanie podczas kontroli i czynności sprawdzających\nObsługa niestandardowych rozliczeń, w tym VAT OSS, CIT Estoński, SSE, VAT marża, itp.\nAsystowanie i wsparcie podczas audytu sprawozdania finansowego"],

        [$bpo, 'bpo_kad_title_suffix',   'Rozwiązania Kadrowe'],
        [$bpo, 'bpo_kad_text',           'Zapewniamy wsparcie w zakresie obsługi kadrowej i naliczania wynagrodzeń. Nasze kompleksowe rozwiązania w obszarze HR i payroll, dedykowane dla dużych przedsiębiorstw, zapewniają nie tylko zgodność z przepisami prawa, ale także optymalizację procesów kadrowych. Współpracujemy zarówno z firmami, które nie posiadają własnego działu HR, jak i z organizacjami potrzebującymi wsparcia przy wybranych procesach.'],
        [$bpo, 'bpo_kad_btn1_text',      'Dlaczego BPO z nami'],
        [$bpo, 'bpo_kad_btn2_text',      'Sprawdź rozwiązania kadrowe'],
        [$bpo, 'bpo_kad_items',          "Prowadzenie dokumentacji kadrowej\nNaliczanie wynagrodzeń i świadczeń\nObsługa umów o pracę i umów cywilnoprawnych\nRozliczenia z ZUS i instytucjami publicznymi\nSporządzanie deklaracji podatkowych\nKontrolowanie limitów urlopowych, terminów badań lekarskich, szkoleń BHP oraz wygasających umów\nReprezentowanie podczas kontroli i czynności sprawdzających\nZarządzanie programami PPK i PPE\nPlatforma pracownicza z dostępem do wniosków urlopowych i dokumentów online"],

        [$bpo, 'bpo_model_title',        'Model współpracy'],
        [$bpo, 'bpo_model_subtitle',     "Możesz powierzyć nam całość procesów księgowych lub wybrane obszary wymagające uporządkowania.\nDopasowujemy zakres wsparcia do realnej sytuacji Twojej firmy."],
        [$bpo, 'bpo_areas_title',        'Obszar współpracy'],
        [$bpo, 'bpo_sys_title',          "Obsługa wielu systemów\nksięgowych"],
        [$bpo, 'bpo_sys_text',           'Nasz zespół obsługuje wiele systemów księgowych, m.in. Comarch Optima, SAP czy Enova. Współpracę dostosowujemy do istniejących narzędzi i procesów oraz wymagań klienta. Istnieje także możliwość pracy na preferowanych przez klienta programach księgowych.'],
        [$bpo, 'bpo_td_title',           'Transformacja Cyfrowa'],
        [$bpo, 'bpo_td_text',            'Systematycznie rozwijamy i wdrażamy rozwiązania z zakresu robotyki (RPA) oraz automatyzacji. Wdrażamy najnowsze technologie, w tym Robotic Process Automation oraz AI, aby umożliwić klientom pełną kontrolę nad finansami. Działamy w modelu Lean, który zapewnia sprawność operacyjną i błyskawiczne dostosowanie się do potrzeb zmieniającego się rynku.'],
        [$bpo, 'bpo_td_items',           "Robotyzacja RPA\nE-teczki\nOptymalizacja procesów\nElektroniczny obieg dokumentów\nAutomatyzacja raportowania"],
        [$bpo, 'bpo_td_btn_text',        'Umów się na konsultacje'],
        [$bpo, 'bpo_wsp_title',          'Jak wygląda bieżąca współpraca'],
        [$bpo, 'bpo_wsp_btn_text',       'Poznaj więcej historii'],
        [$bpo, 'bpo_dlaczego_title',     'Dlaczego BPO z Meritoros?'],
        [$bpo, 'bpo_cta_title',          'Porozmawiajmy o obsłudze księgowej dla Twojej firmy'],
        [$bpo, 'bpo_cta_subtitle',       'Skontaktuj się z nami i dowiedz się, jak możemy wesprzeć Twoją organizację.'],
        [$bpo, 'bpo_cta_btn_text',       'Umów się na rozmowę'],

        // ── Kariera ───────────────────────────────────────────────────────────────
        [$kar, 'kar_hero_title',         "Dołącz do\nnaszego zespołu"],
        [$kar, 'kar_hero_text',          "Budujemy uporządkowane procesy i dobrą atmosferę.\nJeśli cenisz jasne zasady, rozwój i pracę zespołową – sprawdź,\nczy mamy ofertę dla Ciebie."],
        [$kar, 'kar_hero_btn_text',      'Aktualne oferty pracy'],
        [$kar, 'kar_jakosc_title',       'Twórz z nami jakość'],
        [$kar, 'kar_jakosc_green',       '#Meritoros'],
        [$kar, 'kar_jakosc_text1',       'W Meritoros wspieramy firmy w księgowości, kadrach i płacach oraz procesach back-office od 2004 roku. Pracujemy tak, żeby być dumni z jakości informacji, które dostarczamy.'],
        [$kar, 'kar_jakosc_text2',       'Jednocześnie wiemy, że dobre wyniki robią ludzie: dbamy o partnerską współpracę, szacunek i realne wsparcie w zespole. Pracujemy w zadaniowym z elastycznością, która działa wtedy, gdy idzie w parze z odpowiedzialnością i dotrzymywaniem ustaleń.'],
        [$kar, 'kar_dlaczego_title',     'Dlaczego warto do nas dołączyć?'],
        [$kar, 'kar_ben_title',          'Nasze benefity'],
        [$kar, 'kar_cult_title',         'Poznaj nasz Culturebook'],
        [$kar, 'kar_cult_text1',         'Culturebook powstał po to, żebyśmy wszyscy w Meritoros w ten sam sposób rozumieli, kim jesteśmy, dokąd zmierzamy i jakie wartości są dla nas ważne. Opisuje naszą misję, sposób działania i standard współpracy – wewnątrz zespołu i z klientami.'],
        [$kar, 'kar_cult_text2',         'Jeśli chcesz lepiej poznać nasz styl pracy, pobierz Culturebook i sprawdź, czy to podejście jest Ci bliskie'],
        [$kar, 'kar_cult_btn_text',      'Pobierz plik'],
        [$kar, 'kar_vid_title',          'Sprawdź jak się u nas pracuje'],
        [$kar, 'kar_opinie_title',       'Co mówią nasi pracownicy'],
        [$kar, 'kar_rek_title',          'Jak wygląda nasz proces rekrutacji'],
        [$kar, 'kar_rek_subtitle',       'Zależy nam na przejrzystości — dlatego chcemy, żebyś wiedział/-a, czego się spodziewać na każdym etapie.'],
        [$kar, 'kar_faq_title',          'Najczęściej zadawane pytania'],
        [$kar, 'kar_oferty_title',       'Aktualne oferty'],
        [$kar, 'kar_cv_title',           "Chcesz do nas dołączyć?\nZostaw swoje CV"],
        [$kar, 'kar_cv_tag_text',        'Dołącz do nas!'],
        [$kar, 'kar_pyt_title',          'Masz pytania? Chętnie odpowiemy'],
        [$kar, 'kar_pyt_name',           'Anna Kowalska'],
        [$kar, 'kar_pyt_role',           'Marketing manager'],
        [$kar, 'kar_pyt_phone',          '(+48) 12 423 32 99'],
        [$kar, 'kar_pyt_btn_text',       'Wyślij zapytanie'],

        // ── O nas ─────────────────────────────────────────────────────────────────
        [$onas, 'onas_hero_title',       'Poznaj nasze biuro rachunkowe i wartości, które stoją za naszą codzienną pasją.'],
        [$onas, 'onas_hero_sub',         'Pracujemy tak, by być dumni z jakości informacji dostarczanych naszym klientom.'],
        [$onas, 'onas_hero_btn1_text',   'Poznaj ofertę'],
        [$onas, 'onas_hero_btn2_text',   'Porozmawiamy'],
        [$onas, 'onas_kim_title',        'Kim jesteśmy'],
        [$onas, 'onas_kim_text',         'Od ponad 20 lat wspieramy firmy w prowadzeniu księgowości, kadr i procesów finansowych. Pracujemy w modelu zespołowym i procesowym, z jasno określoną odpowiedzialnością, standaryzacją działań i nadzorem nad jakością. Łączymy doświadczenie z nowoczesnymi technologiami oraz automatyzacją, aby zapewnić naszym klientom rzetelne dane, bezpieczeństwo operacyjne i stabilność, której potrzebują, by rozwijać swój biznes.'],
        [$onas, 'onas_jak_title',        'Jak pracujemy?'],
        [$onas, 'onas_mapa_title',       'Gdzie działamy'],
        [$onas, 'onas_mapa_text',        'Posiadamy 7 oddziałów stacjonarnych w miastach Polski oraz oddziały wirtualne, dzięki czemu obsługujemy firmy niezależnie od ich lokalizacji:'],
        [$onas, 'onas_mapa_cities',      "Kraków (siedziba główna oraz 3 oddziały)\nWarszawa\nKatowice\nRzeszów\nWrocław\nŁódź\nBytom\n2 oddziały wirtualne działające w pełni online"],
        [$onas, 'onas_team_title',       'Zespół'],
        [$onas, 'onas_w_label',          'Nasze Wartości'],
        [$onas, 'onas_w_title',          "Dlaczego Meritoros to spokój\nw Twoim biznesie?"],
        [$onas, 'onas_w1_icon',          'infinity'],
        [$onas, 'onas_w1_title',         "Skala i ciągłość\nobsługi"],
        [$onas, 'onas_w1_text',          'Pracujemy zespołowo i procesowo, dzięki czemu obsługa nie zależy od jednej osoby. Zapewniamy zastępowalność i ciągłość pracy – bez przestojów.'],
        [$onas, 'onas_w2_hover',         'Współpracuj z profesjonalistami'],
        [$onas, 'onas_w3_icon',          'shield-check'],
        [$onas, 'onas_w3_title',         "Bezpieczeństwo\ni compliance"],
        [$onas, 'onas_w3_text',          'Działamy zgodnie z obowiązującymi regulacjami i standardami bezpieczeństwa danych. Dbamy o poufność informacji oraz jasne zasady współpracy - bez "skrótów" i ryzyk.'],
        [$onas, 'onas_w4_icon',          'bot'],
        [$onas, 'onas_w4_title',         "Technologia\ni automatyzacja"],
        [$onas, 'onas_w4_text',          'Wykorzystujemy narzędzia i automatyzację (RPA), które porządkują obieg dokumentów, ograniczają ryzyko błędów i usprawniają pracę zespołów.'],
        [$onas, 'onas_w5_title',         'Nagrody i wyróżnienia'],
        [$onas, 'onas_w5_text',          'Wyróżnienia są efektem tego, jak rozwijamy Meritoros: konsekwentnie i procesowo. Trzymamy standard, który ma działać w praktyce - codziennie.'],
        [$onas, 'onas_w6_icon',          'award'],
        [$onas, 'onas_w6_title',         "Jakość potwierdzona\nstandardami"],
        [$onas, 'onas_w6_text',          'Mamy wdrożone procedury kontroli jakości i weryfikacji danych. Dostarczamy spójne dane dla zarządu.'],

        // ── Media ─────────────────────────────────────────────────────────────────
        [$media, 'media_hero_title',     'Media i informacje firmowe'],
        [$media, 'media_hero_text',      'Najważniejsze wydarzenia z życia firmy: rozwój, nowe inicjatywy, wyróżnienia i ogłoszenia.'],
        [$media, 'media_art_title',      'Maciej Paraszczak dla Pulsu Biznesu'],
        [$media, 'media_art_quote',      'Dla wielu naszych klientów jesteśmy nie tylko biurem rachunkowym, ale partnerem operacyjnym, który realnie usprawnia ich procesy biznesowe – podkreśla z Maciej Paraszczak, prezes zarządu spółki Meritoros.'],
        [$media, 'media_art_bold_text',  'Wywiad z Maciejem Paraszczakiem dla Pulsu Biznesu o tym, jak wygląda nowoczesna księgowość w praktyce i dlaczego standard oraz procesy mają dziś kluczowe znaczenie.'],
        [$media, 'media_art_btn_text',   'Czytaj więcej'],
        [$media, 'media_vid_title',      'Jak z MINIMALNYM ryzykiem zacząć własny biznes? Sebastian Rafalik wspomina Meritoros.'],
        [$media, 'media_vid_text',       'Sebastian Rafalik (POL–FRA) w wywiadzie dla „Zaprojektuj Swoje Życie" mówi o tym, jak uporządkowanie księgowości i kadr z Meritoros pomogło mu odblokować skalowanie biznesu i zdjąć z siebie „wąskie gardło".'],
        [$media, 'media_vid_btn_text',   'Posłuchaj wywiadu'],
        [$media, 'media_zap_title',      'Zapytania medialne'],
        [$media, 'media_zap_text',       'W sprawach publikacji, komentarzy eksperckich i współpracy medialnej prosimy o kontakt. Odpowiemy możliwie szybko i wrócimy z informacją, w jakiej formie możemy pomóc.'],
        [$media, 'media_zap_email',      'aleksandra.pawelec@meritoros.pl'],
        [$media, 'media_prz_title',      'Przeczytaj również'],

        // ── Kontakt ───────────────────────────────────────────────────────────────
        [$kon, 'kon_title_green',        'Umów rozmowę'],
        [$kon, 'kon_title_dark',         'i sprawdź, jak możemy pomóc'],
        [$kon, 'kon_subtitle',           'Wysłuchamy, przeanalizujemy sytuację i zaproponujemy kolejne kroki.'],
        [$kon, 'kon_phone_label',        'Zadzwoń do nas!'],
        [$kon, 'kon_phone',              '(+48) 12 423 52 99'],
        [$kon, 'kon_phone_tel',          '+48124235299'],
        [$kon, 'kon_phone_desc',         "Nasi specjaliści są do dyspozycji w godzinach pracy biura.\nOdpowiemy na wszystkie Twoje pytania."],
        [$kon, 'kon_company_name',       'Meritoros SA'],
        [$kon, 'kon_address',            "Aleja Pokoju 62/8\n31-564 Kraków"],
        [$kon, 'kon_email_admin',        'biuro@meritoros.pl'],
        [$kon, 'kon_email_offers',       'oferty@meritoros.pl'],
        [$kon, 'kon_edelivery',          'AE:PL-49846-54459-JWEFS-17'],
        [$kon, 'kon_nip',                'PL 6792963176'],
        [$kon, 'kon_regon',              '120618773'],
        [$kon, 'kon_krs_court',          "Sąd Rejonowy dla Krakowa-Śródmieścia w Krakowie\nWydział XI Gospodarczy Krajowego Rejestru Sądowego"],
        [$kon, 'kon_krs_number',         '0000935021'],
        [$kon, 'kon_offices_title',      "Miasta w których\nmamy oddziały"],
        [$kon, 'kon_virtual_label',      "Oddziały\nWirtualne"],
        [$kon, 'kon_virtual_desc',       'Obsługujemy klientów zdalnie w całej Polsce'],

        // ── Relacje inwestorskie ───────────────────────────────────────────────────
        [$ri, 'ri_hero_title',           'Relacje inwestorskie'],
        [$ri, 'ri_hero_text',            'Poniżej udostępniamy kluczowe informacje i dokumenty dotyczące Meritoros SA, w tym sprawozdania finansowe i raporty okresowe.'],
        [$ri, 'ri_info_title',           'O nas'],
        [$ri, 'ri_sub1_title',           'Profil działalności'],
        [$ri, 'ri_sub2_title',           'Skala działalności'],
        [$ri, 'ri_sub3_title',           'Zasięg i grupa kapitałowa'],
        [$ri, 'ri_sub4_title',           'Strategia rozwoju'],
        [$ri, 'ri_award_title',          'Nagrody i wyróżnienia'],
        [$ri, 'ri_award_text',           'Wyróżnienia są efektem tego, jak rozwijamy Meritoros: konsekwentnie i procesowo. Trzymamy standard, który ma działać w praktyce – codziennie.'],
        [$ri, 'ri_rosniemy_title',       'Rośniemy'],
        [$ri, 'ri_rosniemy_text',        'Rozwój Meritoros SA znajduje odzwierciedlenie w systematycznym wzroście skali działalności i przychodów na przestrzeni ostatnich lat.'],
        [$ri, 'ri_zarzad_title',         'Zarząd'],
        [$ri, 'ri_rada_title',           'Rada nadzorcza'],
        [$ri, 'ri_dane_title',           'Wybrane dane finansowe'],
        [$ri, 'ri_dane_years',           '2012,2013,2014,2015,2016,2017,2018,2019,2020,2021,2022,2023,2024'],
        [$ri, 'ri_lista_title',          'Lista nadzorcza'],
        [$ri, 'ri_akcjonariat_title',    'Informacje o strukturze akcjonariatu'],
        [$ri, 'ri_akcjonariat_subtitle', 'Kapitał zakładowy spółki wynosi 120 000 PLN i dzieli się na 1 200 000 akcji serii A o wartości nominalnej 0,10 PLN.'],
        [$ri, 'ri_akcjonariat_col1',     'Akcjonariusz'],
        [$ri, 'ri_akcjonariat_col2',     'Łączna liczba posiadanych akcji'],
        [$ri, 'ri_akcjonariat_col3',     'Udział w łącznej liczbie głosów'],
        [$ri, 'ri_spr_title',            'Sprawozdania finansowe spółki'],
        [$ri, 'ri_ogl_title',            'Ogłoszenia o zwołaniu Walnego Zgromadzenia Akcjonariuszy'],
        [$ri, 'ri_rew_title',            'Opinie biegłego rewidenta'],
        [$ri, 'ri_msg_title',            'Ogłoszenia w Monitorze Sądowym i Gospodarczym'],
        [$ri, 'ri_uch_title',            'Uchwały podejmowane przez Zgromadzenie Akcjonariuszy'],

        // ── Usługi księgowe ───────────────────────────────────────────────────────
        [$uk, 'uk_hero_title_before',    'Rozwiązania księgowe dla firm, które'],
        [$uk, 'uk_hero_title_green',     'chcą mieć porządek'],
        [$uk, 'uk_hero_title_after',     'i spokój w biznesie'],
        [$uk, 'uk_hero_subtitle',        'Zapewniamy kompleksową obsługę księgową firm o różnej skali działalności. Przejmujemy odpowiedzialność za poprawność, terminowość i ciągłość procesów księgowych, aby nasi klienci mogli skupić się na prowadzeniu i rozwoju biznesu.'],
        [$uk, 'uk_hero_btn1_text',       'Poznaj ofertę'],
        [$uk, 'uk_hero_btn2_text',       'Porozmawiajmy'],
        [$uk, 'uk_ks_title1',            'Twoja księgowość'],
        [$uk, 'uk_ks_title2',            'w'],
        [$uk, 'uk_ks_title_green',       'dobrych rękach'],
        [$uk, 'uk_ks_text1',             'Oferujemy kompleksową obsługę księgową działalności i spółek zarówno w zakresie prowadzenia pełnych ksiąg rachunkowych, jak i uproszczonych form ewidencji. Klienci mogą powierzyć nam całość procesów księgowych lub wybrane obszary wymagające wsparcia.'],
        [$uk, 'uk_ks_text2',             'Zakres współpracy dopasowujemy do skali działalności i stopnia złożoności operacji finansowych.'],
        [$uk, 'uk_ks_btn_text',          'Sprawdź jak wygląda współpraca'],
        [$uk, 'uk_oferta_title',         'Oferta rozwiązań księgowych'],
        [$uk, 'uk_oferta_sub_pre1',      'Obsługujemy firmy na różnych formach rozliczeń zarówno w'],
        [$uk, 'uk_oferta_sub_green1',    'pełnej księgowości (spółki)'],
        [$uk, 'uk_oferta_sub_pre2',      ', jak i w'],
        [$uk, 'uk_oferta_sub_green2',    'uproszczonych formach ewidencji (np. KPiR)'],
        [$uk, 'uk_oferta_sub_note',      'Poniżej pokazujemy przykładowy zakres działań. Jeśli potrzebujesz innej usługi chętnie porozmawiamy.'],
        [$uk, 'uk_oferta_btn1_text',     'Sprawdź również rozwiązania kadrowe'],
        [$uk, 'uk_oferta_btn2_text',     'Oszacuj wstępną wycenę'],
        [$uk, 'uk_oferta_items',         "Prowadzenie ksiąg rachunkowych\nObliczanie podatków i składanie deklaracji podatkowych\nBieżące rozliczanie wyciągów i kontrolowanie rozrachunków\nRaportowanie zarządcze i sprawozdawcze\nRaportowanie do instytucji publicznych\nSporządzanie sprawozdań finansowych oraz deklaracji rocznych\nReprezentowanie podczas kontroli i czynności sprawdzających\nObsługa niestandardowych rozliczeń\nAsystowanie i wsparcie podczas audytu"],
        [$uk, 'uk_model_title',          'Model współpracy'],
        [$uk, 'uk_model_subtitle',       "Możesz powierzyć nam całość procesów księgowych lub wybrane obszary wymagające uporządkowania.\nDopasowujemy zakres wsparcia do realnej sytuacji Twojej firmy."],
        [$uk, 'uk_sys_title',            "Obsługa wielu systemów\nksiągowych"],
        [$uk, 'uk_sys_text',             'Nasz zespół obsługuje wiele systemów księgowych, m.in. Comarch Optima, SAP czy Enova. Współpracę dostosowujemy do istniejących narzędzi i procesów oraz wymagań klienta. Istnieje także możliwość pracy na preferowanych przez klienta programach księgowych.'],
        [$uk, 'uk_dlaczego_title',       "Dlaczego firmy wybierają nasze\nrozwiązania księgowe"],
        [$uk, 'uk_kalk_title',           'Kalkulator – oszacuj wstępnie koszt obsługi'],
        [$uk, 'uk_kalk_desc',            'Oszacuj wstępny koszt usług księgowych w kilka chwil. Wprowadź podstawowe informacje o swojej działalności, a my przygotujemy orientacyjną wycenę dopasowaną do Twoich potrzeb i skali biznesu.'],
        [$uk, 'uk_kalk_disclaimer',      '* to jest wstępny szacunek, każda oferta jest jednak indywidualnie rozpatrywana i odpowiednio wyceniana.'],
        [$uk, 'uk_wsp_title',            'Jak wygląda bieżąca współpraca'],
        [$uk, 'uk_wsp_btn_text',         'Poznaj więcej historii'],
        [$uk, 'uk_cta_title',            'Porozmawiajmy o obsłudze księgowej dla Twojej firmy'],
        [$uk, 'uk_cta_text',             'Skontaktuj się z nami i dowiedz się, jak możemy wesprzeć Twoją firmę.'],
        [$uk, 'uk_cta_btn_text',         'Umów się na rozmowę'],

        // ── Kadry i płace ─────────────────────────────────────────────────────────
        [$kp, 'kp_hero_title_line1',     'Kadry i płace, które dają'],
        [$kp, 'kp_hero_title_green',     'spokój'],
        [$kp, 'kp_hero_title_line2',     'organizacji'],
        [$kp, 'kp_hero_subtitle',        'Zapewniamy kompleksową obsługę kadrowo-płacową firm o różnej skali działalności. Przejmujemy odpowiedzialność za poprawność, terminowość i ciągłość procesów, aby organizacja mogła działać stabilnie i bez zakłóceń.'],
        [$kp, 'kp_hero_btn1_text',       'Poznaj ofertę'],
        [$kp, 'kp_hero_btn2_text',       'Porozmawiajmy'],
        [$kp, 'kp_obs_title1',           'Twoje kadry'],
        [$kp, 'kp_obs_title2',           'i płace'],
        [$kp, 'kp_obs_title_green',      'pod kontrolą'],
        [$kp, 'kp_obs_text1',            'Oferujemy pełną obsługę kadrowo-płacową przedsiębiorstw – od prowadzenia dokumentacji pracowniczej po naliczanie wynagrodzeń i rozliczenia z instytucjami publicznymi. Klienci mogą powierzyć nam całość procesów kadrowych i płacowych lub wybrane obszary wymagające wsparcia.'],
        [$kp, 'kp_obs_text2',            'Zakres współpracy dopasowujemy do wielkości i struktury organizacji.'],
        [$kp, 'kp_obs_btn_text',         'Oszacuj wstępną wycenę'],
        [$kp, 'kp_oferta_title',         'Oferta rozwiązań kadrowych'],
        [$kp, 'kp_oferta_subtitle',      'Przejmujemy całość lub wybrane obszary, które wymagają uporządkowania i stałego nadzoru.'],
        [$kp, 'kp_oferta_btn1_text',     'Wyceń usługę'],
        [$kp, 'kp_oferta_btn2_text',     'Sprawdź również rozwiązania księgowe'],
        [$kp, 'kp_oferta_items',         "Prowadzenie dokumentacji kadrowej\nNaliczanie wynagrodzeń i świadczeń\nObsługa umów o pracę i umów cywilnoprawnych\nRozliczenia z ZUS i instytucjami publicznymi\nSporządzanie deklaracji podatkowych\nKontrolowanie limitów urlopowych, terminów badań lekarskich, szkoleń BHP oraz wygasających umów\nReprezentowanie podczas kontroli i czynności sprawdzających\nZarządzanie programami PPK i PPE\nPlatforma pracownicza z dostępem do wniosków urlopowych i dokumentów online"],
        [$kp, 'kp_model_title',          'Model współpracy'],
        [$kp, 'kp_model_subtitle',       "Możesz powierzyć nam całość procesów kadrowych lub wybrane obszary wymagające uporządkowania.\nDopasowujemy zakres wsparcia do realnej sytuacji Twojej firmy."],
        [$kp, 'kp_sys_title',            "Obsługa wielu systemów\nksiągowych"],
        [$kp, 'kp_sys_text',             'Nasz zespół obsługuje wiele systemów księgowych, m.in. Comarch Optima, SAP czy Enova. Współpracę dostosowujemy do istniejących narzędzi i procesów oraz wymagań klienta. Istnieje także możliwość pracy na preferowanych przez klienta programach księgowych.'],
        [$kp, 'kp_dlaczego_title',       "Dlaczego firmy wybierają nasze\nrozwiązania kadrowe"],
        [$kp, 'kp_kalk_title',           'Kalkulator – oszacuj wstępnie koszt obsługi'],
        [$kp, 'kp_kalk_desc',            'Oszacuj wstępny koszt obsługi kadrowo-płacowej w kilka chwil. Wprowadź podstawowe informacje o swojej działalności, a my przygotujemy orientacyjną wycenę dopasowaną do Twoich potrzeb i skali zatrudnienia.'],
        [$kp, 'kp_kalk_disclaimer',      '* to jest wstępny szacunek, każda oferta jest jednak indywidualnie rozpatrywana i odpowiednio wyceniana.'],
        [$kp, 'kp_wsp_title',            'Jak wygląda bieżąca współpraca'],
        [$kp, 'kp_wsp_btn_text',         'Poznaj więcej historii'],
        [$kp, 'kp_cta_title',            'Porozmawiajmy o obsłudze kadrowej dla Twojej firmy'],
        [$kp, 'kp_cta_text',             'Skontaktuj się z nami i dowiedz się, jak możemy wesprzeć Twój dział HR i płac.'],
        [$kp, 'kp_cta_btn_text',         'Umów się na rozmowę'],

        // ── Fundacje rodzinne ─────────────────────────────────────────────────────
        [$fr, 'fr_hero_title_normal',    'Fundacja rodzinna'],
        [$fr, 'fr_hero_title_green',     'bez stresu'],
        [$fr, 'fr_hero_title_line2',     'księgowość pod kontrolą'],
        [$fr, 'fr_hero_subtitle',        'Fundacja rodzinna wymaga szczególnej staranności w obszarze księgowości i podatków. Zapewniamy rozwiązania, które chronią interes fundatorów i wspierają długoterminową strukturę majątkową.'],
        [$fr, 'fr_hero_btn1_text',       'Poznaj ofertę'],
        [$fr, 'fr_hero_btn2_text',       'Porozmawiajmy'],
        [$fr, 'fr_obs_title',            'Obsługa księgowa fundacji rodzinnej dla właścicieli myślących długoterminowo'],
        [$fr, 'fr_obs_text',             'Prowadzimy księgowość fundacji rodzinnych dla przedsiębiorców, którzy chcą uporządkować kwestie majątku i sukcesji w sposób bezpieczny, transparentny i zgodny z przepisami. Bierzemy na siebie bieżącą obsługę, sprawozdawczość i kontrolę terminów, tak aby fundacja działała stabilnie.'],
        [$fr, 'fr_oferta_title',         'Poznaj naszą ofertę'],
        [$fr, 'fr_oferta_subtitle',      'Zapewniamy kompleksową obsługę księgową i podatkową, która porządkuje finanse fundacji i daje poczucie bezpieczeństwa jej fundatorom.'],
        [$fr, 'fr_oferta_btn_text',      'Wyceń usługę'],
        [$fr, 'fr_oferta_items',         "Prowadzenie ksiąg rachunkowych\nRozliczanie i składanie deklaracji podatkowych\nPrzygotowywanie sprawozdań finansowych\nAsystowanie podczas badania sprawozdania finansowego oraz kontroli urzędów\nRaportowanie na cele zarządcze\nSporządzanie polityki rachunkowości"],
        [$fr, 'fr_model_title',          'Model współpracy'],
        [$fr, 'fr_model_subtitle',       "Możesz powierzyć nam całość procesów księgowych lub wybrane obszary wymagające uporządkowania.\nDopasowujemy zakres wsparcia do realnej sytuacji Twojej firmy."],
        [$fr, 'fr_dlaczego_title',       'Dlaczego Meritoros'],
        [$fr, 'fr_d1_title',             "Bezpieczeństwo\ni compliance"],
        [$fr, 'fr_d1_text',              'Działamy zgodnie z obowiązującymi regulacjami i standardami bezpieczeństwa danych. Dbamy o poufność informacji oraz jasne zasady współpracy – bez „skrótów" i ryzyk.'],
        [$fr, 'fr_d2_title',             "Jakość potwierdzona\nstandardami"],
        [$fr, 'fr_d2_text',              'Mamy wdrożone procedury kontroli jakości i weryfikacji danych. Dostarczamy informacje finansowe kompletne, spójne i użyteczne dla zarządu.'],
        [$fr, 'fr_d3_title',             'Ponad 170 ekspertów'],
        [$fr, 'fr_d3_text',              'Jakość potwierdzona standardami. Mamy wdrożone procedury kontroli jakości i weryfikacji danych. Dostarczamy informacje finansowe kompletne, spójne i użyteczne dla zarządu.'],
        [$fr, 'fr_zysk_title',           "Co zyskujesz, gdy księgowość\nfundacji jest poukładana"],

        // ── Kupimy biuro rachunkowe ───────────────────────────────────────────────
        [$kupimy, 'kupimy_hero_heading',          'Myślisz o sprzedaży swojego biura rachunkowego?'],
        [$kupimy, 'kupimy_hero_subtitle',         'Oferujemy dwa modele współpracy: całkowitą sprzedaż biura rachunkowego albo partnerstwo kapitałowe z zachowaniem operacyjnej autonomii.'],
        [$kupimy, 'kupimy_hero_btn_text',         'Kontakt'],
        [$kupimy, 'kupimy_hero_intro',            'Właściciele biur rachunkowych zgłaszają się do nas z różnymi potrzebami. Jedni chcą całkowicie wyjść z biznesu i sprzedać firmę, inni szukają partnera, który pomoże im dalej rozwijać biuro. W Meritoros rozmawiamy o obu scenariuszach.'],
        [$kupimy, 'kupimy_modele_btn_text',       'Porozmawiajmy o możliwym modelu współpracy'],
        [$kupimy, 'kupimy_model1_title',          'Całkowita sprzedaż biura'],
        [$kupimy, 'kupimy_model1_desc',           'Jeśli planujesz wycofanie się z prowadzenia firmy, możemy rozmawiać o przejęciu całego przedsiębiorstwa — z uwzględnieniem klientów, zespołu i ciągłości działania.'],
        [$kupimy, 'kupimy_model2_title',          'Sprzedaż części udziałów'],
        [$kupimy, 'kupimy_model2_desc',           'Jeśli chcesz dalej prowadzić biuro, ale jednocześnie zyskać wsparcie większej organizacji, możemy rozmawiać o modelu partnerskim z częściowym wejściem kapitałowym Meritoros.'],
        [$kupimy, 'kupimy_kryt_label',            'Całkowita sprzedaż biura'],
        [$kupimy, 'kupimy_kryt_heading',          'Obecnie najczęściej rozmawiamy z biurami, które spełniają poniższe kryteria:'],
        [$kupimy, 'kupimy_kryt_subtitle',         'Przejmujemy całość lub wybrane obszary, które wymagają uporządkowania i stałego nadzoru.'],
        [$kupimy, 'kupimy_kryt_items',            "obrót roczny: od ok. 1,2 mln zł\noprogramowanie: Comarch Optima,\npreferowane lokalizacje: Warszawa, Kraków, Wrocław, Łódź, Górny Śląsk, Rzeszów,\nw przypadku większych podmiotów analizujemy także inne lokalizacje."],
        [$kupimy, 'kupimy_kryt_cta_pre',          'Spełniasz powyższe kryteria?'],
        [$kupimy, 'kupimy_kryt_btn_text',         'Umów się na rozmowę'],
        [$kupimy, 'kupimy_part_label',            'W przypadku modelu partnerskiego'],
        [$kupimy, 'kupimy_part_heading',          'Model partnerski kierujemy przede wszystkim do biur, które:'],
        [$kupimy, 'kupimy_part_banner_title',     'Spełniasz wszystkie kryteria?'],
        [$kupimy, 'kupimy_part_banner_desc',      'Warto się odezwać — chętnie sprawdzimy, czy widzimy przestrzeń do współpracy.'],
        [$kupimy, 'kupimy_part_banner_btn',       'Umów się na rozmowę'],
        [$kupimy, 'kupimy_wideo_heading',         'Jak wygląda sprzedaż biura rachunkowego w praktyce?'],
        [$kupimy, 'kupimy_wideo_desc',            'Jeśli chcesz lepiej zrozumieć kulisy takiego procesu, zobacz materiał, w którym omawiamy najważniejsze kwestie związane ze sprzedażą firmy usługowej i przejęciem biura rachunkowego.'],
        [$kupimy, 'kupimy_wycena_heading',        'Od czego zależy wycena biura rachunkowego?'],
        [$kupimy, 'kupimy_wycena_desc',           'Wartość biura rachunkowego nie zależy wyłącznie od przychodów. Znaczenie mają także m.in. struktura klientów, rentowność, organizacja procesów, używane systemy, stabilność zespołu oraz stopień zależności firmy od właściciela. Dlatego każdą rozmowę zaczynamy od zrozumienia realnej sytuacji biznesu.'],
        [$kupimy, 'kupimy_wycena_list_label',     'Na wycenę wpływają m.in.:'],
        [$kupimy, 'kupimy_form_heading',          'Porozmawiajmy'],
        [$kupimy, 'kupimy_form_subtitle',         'Pierwsza rozmowa jest niezobowiązująca. Ustalimy, jaki model ma sens i czy jest przestrzeń do współpracy.'],
        [$kupimy, 'kupimy_kalk_heading',          'Kalkulator orientacyjnej wyceny biura rachunkowego'],
        [$kupimy, 'kupimy_kalk_btn_text',         'Sprawdź wycenę'],

        // ── Historie klientów ─────────────────────────────────────────────────────
        [$hk, 'hk_hero_title',           'Historie klientów'],
        [$hk, 'hk_hero_text',            'Konkretne przypadki. Konkretny efekt. Zobacz, jak pomagamy firmom działać stabilnie i bezpiecznie.'],
        [$hk, 'hk_hero_btn_text',        'Poznaj więcej'],
        [$hk, 'hk_wsp_title_pre',        'Współpraca, która'],
        [$hk, 'hk_wsp_title_green',      'daje spokój operacyjny'],
        [$hk, 'hk_wsp_text',             'W Meritoros pracujemy tak, aby odciążyć zespół klienta i zapewnić ciągłość obsługi. Działamy elastycznie, dopasowując model współpracy do realiów organizacji, ale trzymamy stały standard jakości, terminowości i bezpieczeństwa danych.'],
        [$hk, 'hk_wsp_bold_text',        'Dzięki temu klienci mogą skupić się na biznesie, a nie na „gaszeniu tematów" w księgowości czy kadrach'],
        [$hk, 'hk_vid_load_more',        'Wczytaj więcej'],
    ];

    $updated = 0;
    $skipped = 0;
    $missing = 0;

    foreach ($definitions as [$post_id, $key, $default]) {
        if (!$post_id) {
            $missing++;
            continue;
        }
        $current = get_field($key, $post_id);
        $is_empty = ($current === null || $current === '' || $current === false);

        if ($is_empty || $overwrite) {
            update_field($key, $default, $post_id);
            $updated++;
        } else {
            $skipped++;
        }
    }

    return [
        'updated'       => $updated,
        'skipped'       => $skipped,
        'missing'       => $missing,
        'missing_pages' => array_unique($missing_slugs),
    ];
}
