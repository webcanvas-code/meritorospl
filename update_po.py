import sys, struct, os
sys.stdout.reconfigure(encoding='utf-8')

BASE = r'C:/Users/laptop/Desktop/projekty/meritoros.pl/meritoros-theme'
LANG = BASE + '/languages'

# ── Tłumaczenia 24 brakujących stringów ─────────────────────────────────────
TRANSLATIONS = {
    'en_US': {
        'Bezpieczeństwo\ni compliance':
            'Security\nand compliance',
        'Blog':
            'Blog',
        'Błąd połączenia. Spróbuj ponownie.':
            'Connection error. Please try again.',
        'Certyfikat':
            'Certificate',
        'Dlaczego BPO z Meritoros?':
            'Why BPO with Meritoros?',
        'Dlaczego Meritoros to spokój\nw Twoim biznesie?':
            'Why Meritoros means peace of mind\nfor your business?',
        'Działamy zgodnie z normami ISO 9001 i ISO/IEC 27001. Zapewniamy poufność danych, ciągłość obsługi i pełną zgodność z obowiązującymi przepisami prawa.':
            'We operate in accordance with ISO 9001 and ISO/IEC 27001 standards. We ensure data confidentiality, service continuity and full compliance with applicable regulations.',
        'Działamy zgodnie z obowiązującymi regulacjami i standardami bezpieczeństwa danych. Dbamy o poufność informacji oraz jasne zasady współpracy - bez "skrótów" i ryzyk.':
            'We operate in accordance with applicable data security regulations and standards. We care about information confidentiality and clear cooperation terms — without "shortcuts" or risks.',
        'Efektywność kosztowa':
            'Cost efficiency',
        'Elastyczność i indywidualne podejście pozwalają nam szybko dopasować się do zmieniających się potrzeb klientów i wspomóc ich na ścieżce skalowania swojej organizacji.':
            'Flexibility and individual approach allow us to quickly adapt to changing client needs and support them on their path to scaling their organisation.',
        'Elastyczność i skalowanie\noperacji':
            'Flexibility and scaling\noperations',
        'Jakość potwierdzona standardami':
            'Quality confirmed by standards',
        'Kompleksowa obsługa kadrowo-płacowa – od umów i list płac po rozliczenia z ZUS i US, z pełną zastępowalnością zespołu.':
            'Comprehensive HR and payroll services — from contracts and payrolls to ZUS and tax authority settlements, with full team substitutability.',
        'Mamy wdrożone procedury kontroli jakości i weryfikacji danych. Dostarczamy spójne dane dla zarządu.':
            'We have implemented quality control and data verification procedures. We deliver consistent data for management.',
        'Nagrody i wyróżnienia':
            'Awards and distinctions',
        'Nasze Wartości':
            'Our Values',
        'Obszar współpracy':
            'Scope of cooperation',
        'Outsourcing biznesowy pozwala na znaczne obniżenie kosztów operacyjnych. Dzięki nowoczesnej technologii i dużej skali obsługiwanych przez nas operacji oszczędności sięgają 20% lub więcej w porównaniu do obsługi procesów za pomocą własnych pracowników.':
            'Business process outsourcing enables significant reduction of operational costs. Thanks to modern technology and the large scale of operations we handle, savings reach 20% or more compared to handling processes with own employees.',
        'Pełna księgowość, raportowanie zarządcze i sprawozdawcze – terminowo i zgodnie ze standardami, bez zakłóceń operacyjnych.':
            'Full accounting, management and financial reporting — on time and in line with standards, without operational disruptions.',
        'Podaj prawidłowy adres e-mail.':
            'Please enter a valid email address.',
        'Porozmawiajmy o obsłudze księgowej dla Twojej firmy':
            "Let's talk about accounting services for your company",
        'Poznaj ofertę':
            'See our offer',
        'Pracujemy zespołowo i procesowo, dzięki czemu obsługa nie zależy od jednej osoby. Zapewniamy zastępowalność i ciągłość pracy – bez przestojów.':
            "We work as a team using defined processes, so service doesn't depend on a single person. We ensure substitutability and continuity — without downtime.",
        'Przekazując odpowiedzialność za pewne procesy wsparcia, Zarząd i kluczowi menedżerowie przedsiębiorstwa mogą skupić się na rozwoju rynkowym i strategicznym zarządzaniu swoim biznesem.':
            'By delegating responsibility for certain support processes, the Management Board and key managers can focus on market development and strategic management of their business.',
        'Pytania od kandydatów':
            'Questions from candidates',
        'Robotyzacja RPA\n\nE-teczki\n\nOptymalizacja procesów\n\nElektroniczny obieg dokumentów\n\nAutomatyzacja raportowania':
            'RPA Robotics\n\nE-files\n\nProcess optimization\n\nElectronic document workflow\n\nReporting automation',
        'Rozwiązania BPO':
            'BPO Solutions',
        'Rozwiązania kadrowe':
            'HR solutions',
        'Rozwiązania księgowe':
            'Accounting solutions',
        'Skala i ciągłość\nobsługi':
            'Scale and continuity\nof service',
        'Skontaktuj się z nami i dowiedz się, jak możemy wesprzeć Twoją organizację.':
            'Contact us and find out how we can support your organisation.',
        'Systematycznie rozwijamy i wdrażamy rozwiązania z zakresu robotyki (RPA) oraz automatyzacji. Wdrażamy najnowsze technologie, w tym Robotic Process Automation oraz AI, aby umożliwić klientom pełną kontrolę nad finansami. Działamy w modelu Lean, który zapewnia sprawność operacyjną i błyskawiczne dostosowanie się do potrzeb zmieniającego się rynku.':
            'We systematically develop and implement solutions in the field of robotics (RPA) and automation. We deploy the latest technologies, including Robotic Process Automation and AI, to give clients full control over their finances. We operate in a Lean model that ensures operational efficiency and rapid adaptation to a changing market.',
        'Technologia\ni automatyzacja':
            'Technology\nand automation',
        'Transformacja Cyfrowa':
            'Digital Transformation',
        'Transformacja cyfrowa':
            'Digital transformation',
        'Uwolnienie czasu\ni usprawnienie procesów':
            'Freeing up time\nand streamlining processes',
        'Wdrożenie RPA, e-teczek i elektronicznego obiegu dokumentów – automatyzujemy procesy, żeby organizacja działała sprawniej.':
            'Implementation of RPA, e-files and electronic document workflow — we automate processes so your organisation runs more efficiently.',
        'Wiedza i aktualności':
            'Knowledge and news',
        'Współpracuj z profesjonalistami':
            'Work with professionals',
        'Wszystkie wpisy':
            'All posts',
        'Wykorzystujemy narzędzia i automatyzację (RPA), które porządkują obieg dokumentów, ograniczają ryzyko błędów i usprawniają pracę zespołów.':
            'We use tools and automation (RPA) that streamline document flow, reduce the risk of errors and improve team efficiency.',
        'Wyróżnienia są efektem tego, jak rozwijamy Meritoros: konsekwentnie i procesowo. Trzymamy standard, który ma działać w praktyce - codziennie.':
            'The awards are the result of how we develop Meritoros: consistently and with a process-driven approach. We maintain a standard that works in practice — every day.',
        'Wystąpił błąd. Spróbuj ponownie.':
            'An error occurred. Please try again.',
        'Zapewniamy kompleksową obsługę kadrowo-płacową firm o różnej skali działalności. Przejmujemy odpowiedzialność za poprawność, terminowość i ciągłość procesów, aby organizacja mogła działać stabilnie i bez zakłóceń.':
            'We provide comprehensive HR and payroll services for companies of various sizes. We take responsibility for accuracy, timeliness and continuity of processes, so the organisation can operate stably and without disruptions.',
        'Zaufało nam ponad 1200 klientów':
            'Trusted by over 1,200 clients',
        'dla większych organizacji':
            'for larger organisations',
        'bez stresu':
            'stress-free',
        'Chcesz do nas dołączyć?\nZostaw swoje CV':
            'Want to join us?\nLeave your CV',
        'Ciągły Rozwój jest wpisany\nw nasze DNA':
            'Continuous Growth is embedded\nin our DNA',
        'Dołącz do grona naszych\nklientów i rozwijaj biznes':
            'Join our clients\nand grow your business',
        'Elastyczność dopasowana\ndo Twojego stylu pracy':
            'Flexibility tailored\nto your work style',
        'Informacje':
            'Information',
        'Menu':
            'Menu',
        'Menu główne':
            'Main menu',
        'Menu stopki':
            'Footer menu',
        'Miasta w których\nmamy oddziały':
            'Cities where\nwe have offices',
        'Nasi specjaliści są do dyspozycji w godzinach pracy biura.\nOdpowiemy na wszystkie Twoje pytania.':
            'Our specialists are available during business hours.\nWe will answer all your questions.',
        'Oddaj księgowość\nw ręce ekspertów':
            'Put your accounting\nin expert hands',
        'Oddziały\nWirtualne':
            'Virtual\nOffices',
        'Otwórz menu':
            'Open menu',
        'Polityka prywatności':
            'Privacy policy',
        'Praca w zgranym\nzespole specjalistów':
            'Working in a cohesive\nteam of specialists',
        'Profesjonalne biuro rachunkowe i BPO dla firm z ambicjami.':
            'Professional accounting firm and BPO for ambitious businesses.',
        'Projekt i realizacja:':
            'Design & development:',
        'Regulamin newslettera':
            'Newsletter terms',
        'Skup biur rachunkowych':
            'Acquisition of accounting firms',
        'Stabilne zatrudnienie\ni jasne zasady':
            'Stable employment\nand clear rules',
        'Usługi':
            'Services',
        'Zacznij teraz':
            'Get started',
        'Zamknij menu':
            'Close menu',
        # --- Nowe stringi: hero, case-studies, buyout ---
        'Eksperci w księgowości.\nTechnologia i pewność\nw działaniu.':
            'Accounting experts.\nTechnology and certainty\nin action.',
        'Zapewniamy księgowość kadry i outsourcing procesów w standardzie, który daje firmom spokój i bezpieczeństwo.':
            'We provide accounting, HR and process outsourcing to a standard that gives businesses peace of mind and security.',
        'Zaufało nam ponad <span class="text-white">1200 klientów</span>':
            'Trusted by over <span class="text-white">1,200 clients</span>',
        'Wideo ogólne':
            'General video',
        'Wideo ogólne Meritoros':
            'General Meritoros video',
        'Obejrzyj ogólne wideo':
            'Watch general video',
        'Nasi klienci cenią nas za to, że dowozimy: jakość, terminowość i spójne dane. Jako partner w obszarze księgowości przejmujemy obszary, za które odpowiadamy, i pracujemy w standardzie, który daje spokój w codziennym prowadzeniu firmy.':
            'Our clients value us for delivering: quality, timeliness and consistent data. As an accounting partner, we take ownership of the areas we are responsible for and work to a standard that brings peace of mind in day-to-day business operations.',
        'Dla biur rachunkowych':
            'For accounting firms',
        "Kupimy Biuro\nRachunkowe":
            "We'll Buy Your\nAccounting Firm",
        'Od lat współpracujemy z biurami rachunkowymi, które stoją przed decyzją o zmianie, sprzedaży lub dalszym rozwoju.':
            'For years we have worked with accounting firms facing a decision about change, sale or further growth.',
        'Wyceń wartość biura':
            'Value your firm',
        'Obsługujemy systemy ERP i finansowe wiodących dostawców':
            'We support ERP and financial systems from leading vendors',
        'Przejrzystych warunków':
            'Transparent terms',
        'Przejętych biur':
            'Acquired firms',
        'Do wstępnej wyceny':
            'To initial valuation',
        'Pełna poufność':
            'Full confidentiality',
        # --- Nowe stringi: bpo-info ---
        "Stabilne procesy. Rzetelne\ndane. Spokój zarządu.":
            "Stable processes. Reliable\ndata. Management peace of mind.",
        'Wspieramy większe firmy w obszarze księgowości, kadr i płac, back-office, przejmując odpowiedzialność za jakość, terminowość i ciągłość działania. Dostarczamy dane i raporty w harmonogramie dopasowanym do zarządu – tak, żeby decyzje były oparte na spójnych informacjach, a nie „gaszeniu pożarów".':
            'We support larger companies in accounting, HR and payroll, and back-office, taking responsibility for quality, timeliness and continuity of operations. We deliver data and reports on a schedule tailored to management — so decisions are based on consistent information, not firefighting.',
        "raportowanie zarządcze i sprawozdawcze dopasowane do potrzeb organizacji\n\ncyfrowy obieg dokumentów i uporządkowane procesy\n\npełna zastępowalność i ciągłość obsługi oraz gotowość do skalowania":
            "management and financial reporting tailored to the organisation's needs\n\ndigital document workflow and streamlined processes\n\nfull staff substitutability, service continuity and readiness to scale",
        "Jakość potwierdzona\nstandardami":
            "Quality confirmed\nby standards",
        "Ponad 170\nexpertów":
            "Over 170\nexperts",
        'Nagroda':
            'Award',
        # --- Nowe stringi: bpo-kadrowe ---
        'Rozwiązania Kadrowe':
            'HR Solutions',
        'Zapewniamy wsparcie w zakresie obsługi kadrowej i naliczania wynagrodzeń. Nasze kompleksowe rozwiązania w obszarze HR i payroll, dedykowane dla dużych przedsiębiorstw, zapewniają nie tylko zgodność z przepisami prawa, ale także optymalizację procesów kadrowych. Współpracujemy zarówno z firmami, które nie posiadają własnego działu HR, jak i z organizacjami potrzebującymi wsparcia przy wybranych procesach.':
            'We provide support in HR administration and payroll calculation. Our comprehensive HR and payroll solutions, dedicated to large enterprises, ensure not only compliance with legal regulations but also optimisation of HR processes. We work both with companies without their own HR department and with organisations needing support with selected processes.',
        'Dlaczego BPO z nami':
            'Why BPO with us',
        'Sprawdź rozwiązania kadrowe':
            'Explore HR solutions',
        "Prowadzenie dokumentacji kadrowej\n\nNaliczanie wynagrodzeń i świadczeń\n\nObsługa umów o pracę i umów cywilnoprawnych\n\nRozliczenia z ZUS i instytucjami publicznymi\n\nSporządzanie deklaracji podatkowych\n\nKontrolowanie limitów urlopowych, terminów badań lekarskich, szkoleń BHP oraz wygasających umów\n\nReprezentowanie podczas kontroli i czynności sprawdzających\n\nZarządzanie programami PPK i PPE\n\nPlatforma pracownicza z dostępem do wniosków urlopowych i dokumentów online":
            "Maintaining HR documentation\n\nPayroll and benefit calculation\n\nHandling employment contracts and civil law agreements\n\nSettlements with ZUS and public institutions\n\nPreparing tax declarations\n\nMonitoring leave limits, medical examination deadlines, H&S training and expiring contracts\n\nRepresentation during inspections and audit procedures\n\nManaging PPK and PPE schemes\n\nEmployee platform with access to leave requests and documents online",
        # --- Nowe stringi: bpo-ksiegowe ---
        'Outsourcing księgowości pozwala na znaczne obniżenie kosztów operacyjnych. Możemy dostarczyć wysokiej jakości usługi księgowe, eliminując potrzebę zatrudniania wewnętrznych ekspertów. Dzięki nowoczesnej technologii i dużej skali obsługiwanych przez nas operacji oszczędności sięgają 20-30% lub więcej w porównaniu do prowadzenia księgowości wewnętrznie. Dzięki digitalizacji obiegu dokumentów oraz sprawnym procesom możemy dostarczać raporty w czasie rzeczywistym.':
            'Accounting outsourcing enables significant reduction of operational costs. We can deliver high-quality accounting services, eliminating the need to hire internal experts. Thanks to modern technology and the large scale of operations we handle, savings reach 20–30% or more compared to in-house accounting. Through digitisation of document workflow and efficient processes, we can deliver reports in real time.',
        "Prowadzenie ksiąg rachunkowych\n\nObliczanie podatków i składanie deklaracji podatkowych\n\nBieżące rozliczanie wyciągów i kontrolowanie rozrachunków\n\nRaportowanie zarządcze i sprawozdawcze\n\nRaportowanie do instytucji publicznoprawnych, w tym NBP, GUS, INTRASTAT\n\nSporządzanie sprawozdań finansowych oraz deklaracji rocznych\n\nReprezentowanie podczas kontroli i czynności sprawdzających\n\nObsługa niestandardowych rozliczeń, w tym VAT OSS, CIT Estoński, SSE, VAT marża, itp.\n\nAsystowanie i wsparcie podczas audytu sprawozdania finansowego":
            "Maintaining accounting books\n\nCalculating taxes and filing tax returns\n\nOngoing reconciliation of bank statements and settlement control\n\nManagement and financial reporting\n\nReporting to public law institutions, including NBP, GUS, INTRASTAT\n\nPreparing financial statements and annual declarations\n\nRepresentation during inspections and audit procedures\n\nHandling non-standard settlements, including VAT OSS, Estonian CIT, SEZ, margin VAT, etc.\n\nAssisting and supporting during financial statement audits",
        # --- Nowe stringi: bpo-model ---
        'Model współpracy':
            'Cooperation model',
        "Możesz powierzyć nam całość procesów księgowych lub wybrane obszary wymagające uporządkowania.\nDopasowujemy zakres wsparcia do realnej sytuacji Twojej firmy.":
            "You can entrust us with all accounting processes or selected areas that need organising.\nWe tailor the scope of support to the actual situation of your business.",
        'Kompleksowa obsługa':
            'Comprehensive service',
        'Obsługujemy proces end-to-end: od bieżącej ewidencji po zamknięcie miesiąca i raporty. Pracujesz z zespołem, który zapewnia zastępowalność i stały standard.':
            'We manage the process end-to-end: from day-to-day bookkeeping to month-end closing and reports. You work with a team that ensures substitutability and consistent standards.',
        "Outsourcing wybranych\nprocesów":
            "Outsourcing of selected\nprocesses",
        'Przejmujemy konkretne procesy i dowozimy je w ustalonym standardzie i harmonogramie. To rozwiązanie dla firm, które chcą wzmocnić wewnętrzny dział finansów bez rozbudowy etatów.':
            'We take on specific processes and deliver them to an agreed standard and schedule. This is a solution for companies that want to strengthen their internal finance department without expanding headcount.',
        # --- Nowe stringi: bpo-wspolpraca ---
        'Jak wygląda bieżąca współpraca':
            'How does ongoing cooperation work',
        'Poznaj więcej historii':
            'See more stories',
        'Indywidualna organizacja pracy':
            'Individual work organisation',
        'W zależności od potrzeb możemy pracować:':
            'Depending on needs, we can work:',
        'na bieżąco – obsługując codzienne procesy księgowe lub kadrowe':
            'on an ongoing basis — handling day-to-day accounting or HR processes',
        'w cyklach tygodniowych':
            'in weekly cycles',
        'w innych ustalonych odstępach czasu':
            'at other agreed intervals',
        'Elastyczne zamknięcie miesiąca':
            'Flexible month-end closing',
        'Terminy zamknięcia miesiąca ustalamy indywidualnie z każdą firmą, uwzględniając jej wewnętrzne potrzeby raportowe oraz obowiązujące terminy podatkowe.':
            'Month-end closing deadlines are agreed individually with each company, taking into account its internal reporting needs and applicable tax deadlines.',
        'część firm potrzebuje raportów finansowych do 20. dnia miesiąca':
            'some companies need financial reports by the 20th of the month',
        'inne wymagają wyników już w 3. lub 4. dniu roboczym nowego miesiąca':
            'others require results as early as the 3rd or 4th working day of the new month',
        'Zakres i częstotliwość raportowania ustalamy indywidualnie z każdym klientem.':
            'The scope and frequency of reporting is agreed individually with each client.',
        'W standardzie klient otrzymuje:':
            'As standard, the client receives:',
        'rachunek zysków i strat':
            'profit and loss statement',
        'bilans':
            'balance sheet',
        'zestawienie należności i zobowiązań':
            'receivables and payables summary',
        # --- Nowe stringi: bpo-cyfrowa ---
        'Umów się na konsultacje':
            'Book a consultation',
        # --- Nowe stringi: kupimy ---
        'Myślisz o sprzedaży swojego biura rachunkowego?':
            'Thinking about selling your accounting firm?',
        'Oferujemy dwa modele współpracy: całkowitą sprzedaż biura rachunkowego albo partnerstwo kapitałowe z zachowaniem operacyjnej autonomii.':
            'We offer two models of cooperation: a full sale of the accounting firm, or a capital partnership with retention of operational autonomy.',
        'Właściciele biur rachunkowych zgłaszają się do nas z różnymi potrzebami. Jedni chcą całkowicie wyjść z biznesu i sprzedać firmę, inni szukają partnera, który pomoże im dalej rozwijać biuro. W Meritoros rozmawiamy o obu scenariuszach.':
            'Owners of accounting firms come to us with different needs. Some want to exit the business completely and sell the firm; others are looking for a partner to help them continue developing their office. At Meritoros, we discuss both scenarios.',
        'Kupimy biuro rachunkowe':
            "We'll buy an accounting firm",
        'Porozmawiajmy o możliwym modelu współpracy':
            "Let's talk about a possible cooperation model",
        'Całkowita sprzedaż biura':
            'Full sale of the firm',
        'Jeśli planujesz wycofanie się z prowadzenia firmy, możemy rozmawiać o przejęciu całego przedsiębiorstwa — z uwzględnieniem klientów, zespołu i ciągłości działania.':
            'If you are planning to exit from running the business, we can discuss taking over the entire enterprise — including clients, the team and continuity of operations.',
        'Sprzedaż części udziałów':
            'Sale of a stake',
        'Jeśli chcesz dalej prowadzić biuro, ale jednocześnie zyskać wsparcie większej organizacji, możemy rozmawiać o modelu partnerskim z częściowym wejściem kapitałowym Meritoros.':
            "If you want to continue running the firm but also gain the support of a larger organisation, we can discuss a partnership model with Meritoros's partial capital entry.",
        'Od czego zależy wycena biura rachunkowego?':
            'What determines the valuation of an accounting firm?',
        'Wartość biura rachunkowego nie zależy wyłącznie od przychodów. Znaczenie mają także m.in. struktura klientów, rentowność, organizacja procesów, używane systemy, stabilność zespołu oraz stopień zależności firmy od właściciela. Dlatego każdą rozmowę zaczynamy od zrozumienia realnej sytuacji biznesu.':
            'The value of an accounting firm does not depend solely on revenue. Also important are, among other things, client structure, profitability, process organisation, systems used, team stability and the degree of owner dependency. That is why we always begin each conversation by understanding the real situation of the business.',
        'Na wycenę wpływają m.in.:':
            'Factors affecting valuation include:',
        "poziom i powtarzalność przychodów,\n\nrentowność biura,\n\nstruktura klientów i ryzyko koncentracji,\n\norganizacja pracy, technologia i stopień poukładania procesów.":
            "level and repeatability of revenue,\n\nfirm profitability,\n\nclient structure and concentration risk,\n\nwork organisation, technology and degree of process maturity.",
        'W przypadku modelu partnerskiego':
            'In the case of the partnership model',
        'Model partnerski kierujemy przede wszystkim do biur, które:':
            'The partnership model is primarily aimed at firms that:',
        'mają obrót roczny <strong>powyżej 3 mln zł</strong>,':
            'have annual turnover <strong>above PLN 3 million</strong>,',
        'pracują na systemach innych niż <strong>Optima</strong>, np. Enova, Symfonia,':
            'work on systems other than <strong>Optima</strong>, e.g. Enova, Symfonia,',
        'chcą dalej rozwijać firmę, ale zyskać dostęp do większego zaplecza,':
            'want to continue growing the firm but gain access to greater resources,',
        'szukają wsparcia <strong>w obszarze technologii</strong>, procesów, HR, marketingu i rozwoju operacyjnego.':
            'are looking for support <strong>in the area of technology</strong>, processes, HR, marketing and operational development.',
        'Co zyskujesz jako Partner Meritoros?':
            'What do you gain as a Meritoros Partner?',
        "dostęp do automatyzacji i robotyzacji procesów\n\nwsparcie w digitalizacji i porządkowaniu operacji\n\ndostęp do wiedzy ekspertów i partnerów merytorycznych\n\nwsparcie HR i rekrutacyjne\n\nwsparcie marketingowe i sprzedażowe,\n\nwewnętrzne standardy jakości i audytu\n\nmożliwość dalszego rozwoju w strukturach większej organizacji":
            "access to process automation and robotics\n\nsupport in digitisation and streamlining operations\n\naccess to expert knowledge and substantive partners\n\nHR and recruitment support\n\nmarketing and sales support\n\ninternal quality and audit standards\n\nthe opportunity for further growth within the structures of a larger organisation",
        'Kalkulator orientacyjnej wyceny biura rachunkowego':
            'Indicative valuation calculator for an accounting firm',
        'Sprawdź wycenę':
            'Check valuation',
        'Spełniasz wszystkie kryteria?':
            'Do you meet all the criteria?',
        'Warto się odezwać — chętnie sprawdzimy, czy widzimy przestrzeń do współpracy.':
            "It is worth getting in touch — we will be happy to check whether we see scope for cooperation.",
        'Umów się na rozmowę':
            'Book a call',
        'Obecnie najczęściej rozmawiamy z biurami, które spełniają poniższe kryteria:':
            'We currently most often talk with firms that meet the following criteria:',
        'Przejmujemy całość lub wybrane obszary, które wymagają uporządkowania i stałego nadzoru.':
            'We take over all or selected areas that require organising and ongoing supervision.',
        "obrót roczny: od ok. 1,2 mln zł\n\noprogramowanie: Comarch Optima,\n\npreferowane lokalizacje: Warszawa, Kraków, Wrocław, Łódź, Górny Śląsk, Rzeszów,\n\nw przypadku większych podmiotów analizujemy także inne lokalizacje.":
            "annual revenue: from approx. PLN 1.2M\n\nsoftware: Comarch Optima,\n\npreferred locations: Warsaw, Kraków, Wrocław, Łódź, Upper Silesia, Rzeszów,\n\nfor larger entities we also analyse other locations.",
        'Spełniasz powyższe kryteria?':
            'Do you meet the above criteria?',
        'Spotkanie':
            'Meeting',
        'Nie spełniasz wszystkich kryteriów?':
            "Don't meet all the criteria?",
        'Jak wygląda sprzedaż biura rachunkowego w praktyce?':
            'What does selling an accounting firm look like in practice?',
        'Jeśli chcesz lepiej zrozumieć kulisy takiego procesu, zobacz materiał, w którym omawiamy najważniejsze kwestie związane ze sprzedażą firmy usługowej i przejęciem biura rachunkowego.':
            'If you would like to better understand the background of such a process, watch the material in which we discuss the most important issues related to selling a service firm and acquiring an accounting firm.',
        'Pierwsza rozmowa jest niezobowiązująca. Ustalimy, jaki model ma sens i czy jest przestrzeń do współpracy.':
            'The first conversation is non-binding. We will establish which model makes sense and whether there is scope for cooperation.',
        # --- Nowe stringi: hk-video, media-video, ebook ---
        'Wczytaj więcej':
            'Load more',
        'Historie klientów':
            "Clients' stories",
        'Posłuchaj, co mówią nasi klienci':
            'Hear what our clients say',
        'Czytaj historię':
            'Read story',
        'Jak z MINIMALNYM ryzykiem zacząć własny biznes? Sebastian Rafalik wspomina Meritoros.':
            'How to start your own business with MINIMAL risk? Sebastian Rafalik recalls Meritoros.',
        'Sebastian Rafalik (POL–FRA) w wywiadzie dla „Zaprojektuj Swoje Życie" mówi o tym, jak uporządkowanie księgowości i kadr z Meritoros pomogło mu odblokować skalowanie biznesu i zdjąć z siebie „wąskie gardło".':
            'Sebastian Rafalik (POL–FRA) in an interview for "Design Your Life" talks about how organising accounting and HR with Meritoros helped him unlock business scaling and remove the "bottleneck".',
        'Posłuchaj wywiadu':
            'Listen to the interview',
        'Obejrzyj materiał':
            'Watch the video',
        'Darmowy materiał':
            'Free resource',
        'Pobierz nasz darmowy Ebook':
            'Download our free Ebook',
        'Pobierz materiał':
            'Download resource',
        'Ebook został wysłany na podany adres e-mail!':
            'The ebook has been sent to the provided email address!',
        # --- Nowe stringi: fr-hero, fr-dlaczego, single ---
        'Fundacja rodzinna':
            'Family foundation',
        'księgowość pod kontrolą':
            'accounting under control',
        'Fundacja rodzinna wymaga szczególnej staranności w obszarze księgowości i podatków. Zapewniamy rozwiązania, które chronią interes fundatorów i wspierają długoterminową strukturę majątkową.':
            'A family foundation requires particular diligence in accounting and tax matters. We provide solutions that protect the interests of founders and support long-term asset structures.',
        'Dlaczego Meritoros':
            'Why Meritoros',
        'Mamy wdrożone procedury kontroli jakości i weryfikacji danych. Dostarczamy informacje finansowe kompletne, spójne i użyteczne dla zarządu.':
            'We have implemented quality control and data verification procedures. We deliver financial information that is complete, consistent and useful for management.',
        'Ponad 170 ekspertów':
            'Over 170 experts',
        'Jakość potwierdzona standardami. Mamy wdrożone procedury kontroli jakości i weryfikacji danych. Dostarczamy informacje finansowe kompletne, spójne i użyteczne dla zarządu.':
            'Quality confirmed by standards. We have implemented quality control and data verification procedures. We deliver financial information that is complete, consistent and useful for management.',
        'Powrót do':
            'Back to',
        # --- Case studies: industries, scope_title, scope_desc, video_label ---
        'Geologia inżynierska':
            'Engineering geology',
        'Ochrona środowiska':
            'Environmental protection',
        'Usługi rachunkowe, obszar kadr i płac, wsparcie w audytach':
            'Accounting services, HR & payroll, audit support',
        'Po kilku zmianach głównej księgowej spółka potrzebowała szybkiego uporządkowania księgowości i bezpiecznego zamknięcia roku obrotowego. Wdrożyliśmy usprawnienia procesowe.':
            'After several changes of the chief accountant, the company needed quick reorganization of accounting and safe closing of the financial year. We implemented process improvements.',
        'Nasz wpływ na operacje HPC':
            'Our impact on HPC operations',
        'Technologia druku':
            'Print technology',
        'E-commerce B2B':
            'E-commerce B2B',
        'Pełna obsługa BPO, rozliczenia międzynarodowe VAT OSS':
            'Full BPO service, international VAT OSS settlements',
        'Przy dynamicznym wzroście sprzedaży cross-border firma potrzebowała partnera gotowego na złożone rozliczenia VAT OSS w wielu krajach UE. Przejęliśmy całość obsługi finansowej.':
            'With dynamic growth of cross-border sales, the company needed a partner ready for complex VAT OSS settlements in multiple EU countries. We took over all financial operations.',
        'Jak Printbox skaluje finanse globalnie':
            'How Printbox scales finances globally',
        'Budownictwo':
            'Construction',
        'Inżynieria':
            'Engineering',
        'Kadry, płace, Intrastat, rozliczenia delegacji zagranicznych':
            'HR, payroll, Intrastat, foreign business travel settlements',
        'Firma realizowała kontrakty w kilku krajach jednocześnie. Meritoros przejął obsługę kadrową i rozliczenia Intrastat, odciążając zarząd od złożoności administracyjnej.':
            'The company was executing contracts in several countries simultaneously. Meritoros took over HR operations and Intrastat settlements, relieving management of administrative complexity.',
        'Obsługa kadrowa na skalę międzynarodową':
            'HR support at international scale',
        'Produkcja przemysłowa':
            'Industrial manufacturing',
        'Eksport':
            'Export',
        'Pełna księgowość, fundacja rodzinna, compliance':
            'Full accounting, family foundation, compliance',
        'Właściciel grupy produkcyjnej chciał oddzielić majątek prywatny od firmowego poprzez fundację rodzinną. Meritoros poprowadził cały proces prawno-księgowy od podstaw.':
            'The owner of a production group wanted to separate private assets from company assets through a family foundation. Meritoros led the entire legal and accounting process from scratch.',
        'Fundacja rodzinna krok po kroku':
            'Family foundation step by step',
        # --- section-hk-logos ---
        'Zaufało nam ponad': 'Trusted by over',
        'klientów': 'clients',
        'Logo klienta': 'Client logo',
        # --- section-media-mowia ---
        'Mówią o nas': 'They talk about us',
        'Przeczytaj artykuł': 'Read article',
        # --- section-hk-cta ---
        "Porozmawiajmy o rozwiązaniach\ndla Twojego biznesu": "Let's talk about solutions\nfor your business",
        'Wyślij zapytanie': 'Send enquiry',
        # --- section-wideoinstruktaze ---
        'Wideo': 'Video',
        'Wideoinstruktaże': 'Video tutorials',
        'Praktyczne instruktaże wideo z zakresu księgowości, podatków i kadr.': 'Practical video tutorials on accounting, taxes and HR.',
        # --- section-ri-lista ---
        'Lista nadzorcza': 'Supervisory board',
        'przewodnicząca rady nadzorczej': 'chairwoman of the supervisory board',
        'członek rady nadzorczej': 'member of the supervisory board',
        # --- section-ri-info ---
        'O nas': 'About us',
        'Profil działalności': 'Business profile',
        'Skala działalności': 'Scale of operations',
        'Zasięg i grupa kapitałowa': 'Reach and capital group',
        'Strategia rozwoju': 'Development strategy',
        'Początek działalności': 'Founded',
        'Klientów': 'Clients',
        'Specjalistów': 'Specialists',
        'lokalizacji': 'locations',
        '(ale ciągle rośniemy)': '(and still growing)',
        'Wyróżnienia są efektem tego, jak rozwijamy Meritoros: konsekwentnie i procesowo. Trzymamy standard, który ma działać w praktyce – codziennie.': 'The distinctions are the result of how we develop Meritoros: consistently and process-driven. We maintain a standard that is designed to work in practice — every day.',
        # --- section-onas-jak ---
        'Jak pracujemy?': 'How do we work?',
        'Dedykowany zespół': 'Dedicated team',
        'Każdy klient współpracuje z przypisanym zespołem specjalistów oraz Liderem odpowiedzialnym za jakość i terminowość.': 'Every client works with a dedicated team of specialists and a Leader responsible for quality and timeliness.',
        'Podejście procesowe': 'Process-based approach',
        'Wszystkie działania opieramy na udokumentowanych procesach z określonymi SLA, checklistami i punktami kontroli jakości — tak by każda operacja była przewidywalna i powtarzalna.': 'All actions are based on documented processes with defined SLAs, checklists and quality control points — so that every operation is predictable and repeatable.',
        'Pełna zastępowalność': 'Full substitutability',
        'Procesy są tak zorganizowane, by urlopy i rotacja kadry nie wpływały na ciągłość obsługi. Klient zawsze ma kogoś do dyspozycji i nie odczuwa zmian personalnych.': 'Processes are organised so that holidays and staff rotation do not affect continuity of service. The client always has someone available and does not feel personnel changes.',
        'Elastyczność współpracy': 'Flexibility of cooperation',
        'Dopasowujemy zakres, terminy raportowania i sposób komunikacji do realnych potrzeb firmy — niezależnie od jej wielkości czy etapu rozwoju.': 'We tailor the scope, reporting deadlines and communication method to the real needs of the company — regardless of its size or stage of development.',
        'Zespół Meritoros przy pracy': 'Meritoros team at work',
        # --- section-onas-kim ---
        'Kim jesteśmy': 'Who we are',
        'Od ponad 20 lat wspieramy firmy w prowadzeniu księgowości, kadr i procesów finansowych. Pracujemy w modelu zespołowym i procesowym, z jasno określoną odpowiedzialnością, standaryzacją działań i nadzorem nad jakością. Łączymy doświadczenie z nowoczesnymi technologiami oraz automatyzacją, aby zapewnić naszym klientom rzetelne dane, bezpieczeństwo operacyjne i stabilność, której potrzebują, by rozwijać swój biznes.': 'For over 20 years we have been supporting companies in accounting, HR and financial processes. We work in a team and process model, with clearly defined responsibility, standardisation of actions and quality oversight. We combine experience with modern technologies and automation to provide our clients with reliable data, operational security and stability they need to grow their business.',
        "Wewnętrzny\ndział IT i RPA": "In-house\nIT & RPA department",
        "Certyfikacja ISO\n9001 i ISO/IEC\n27001": "ISO 9001\nand ISO/IEC\n27001 certified",
        "Ubezpieczenie\ndo 3 mln PLN": "Insurance\nup to PLN 3M",
        "Ponad 170\nexpertów na\npokładzie": "Over 170\nexperts\non board",
        "Ponad 1200\nklientów": "Over 1,200\nclients",
        "7 oddziałów\nw Polsce oraz\noddziały wirtualne": "7 branches\nin Poland and\nvirtual offices",
        # --- section-onas-mapa ---
        'Gdzie działamy': 'Where we operate',
        'Posiadamy 7 oddziałów stacjonarnych w miastach Polski oraz oddziały wirtualne, dzięki czemu obsługujemy firmy niezależnie od ich lokalizacji:': 'We have 7 stationary branches in Polish cities and virtual branches, allowing us to serve companies regardless of their location:',
        "Kraków (siedziba główna oraz 3 oddziały)\nWarszawa\nKatowice\nRzeszów\nWrocław\nŁódź\nBytom\n2 oddziały wirtualne działające w pełni online": "Kraków (head office and 3 branches)\nWarsaw\nKatowice\nRzeszów\nWrocław\nŁódź\nBytom\n2 fully online virtual branches",
        'Mapa Polski z oddziałami': 'Map of Poland with branches',
        # --- section-onas-wartosci ---
        "Dlaczego Meritoros to spokój\nw Twoim biznesie?": "Why Meritoros means peace of mind\nfor your business?",
        "Skala i ciągłość\nobsługi": "Scale and continuity\nof service",
        "Jakość potwierdzona\nstandardami": "Quality confirmed\nby standards",
        'Zespół Meritoros': 'Meritoros team',
        # --- section-testimonials ---
        'Opinie klientów': 'Client testimonials',
        'Sprawdź, co mówią o nas inni': 'See what others say about us',
        'Mam księgowość w bezpiecznych rękach i wiem, że nie muszę się o to już martwić.': 'My accounting is in safe hands and I know I no longer need to worry about it.',
        'HP Cepolgol S.A.': 'HP Cepolgol S.A.',
        'Meritoros dostarczył nam stabilność i pewność, w trudnych momentach zawsze mamy właściwe odpowiedzi.': 'Meritoros provided us with stability and certainty — in difficult moments we always have the right answers.',
        'CEO & Co-Founder, Printbox': 'CEO & Co-Founder, Printbox',
        'Profesjonalizm na każdym kroku. Polecamy Meritoros każdej firmie, która ceni sobie bezpieczeństwo i jakość obsługi.': 'Professionalism at every step. We recommend Meritoros to every company that values security and quality of service.',
        'Dyrektor Finansowy, SITECH': 'Financial Director, SITECH',
        'Obsługiwanych klientów': 'Clients served',
        'Lat na rynku': 'Years on the market',
        'Klientów poleca nas dalej': 'Clients recommend us',
        'Ekspertów w zespole': 'Experts in the team',
        # --- section-fr-zyski ---
        "Co zyskujesz, gdy księgowość\nfundacji jest poukładana": "What you gain when the foundation's\naccounting is in order",
        "Bezpieczne zarządzanie\nmajątkiem": "Safe asset\nmanagement",
        'Porządek w danych i dokumentach, jasna sprawozdawczość i kontrola nad obowiązkami.': 'Order in data and documents, clear reporting and control over obligations.',
        "Sukcesja na trwałych\nregułach": "Succession on solid\nfoundations",
        'Przejrzyste zasady i przewidywalność – tak, aby rozwiązanie działało długoterminowo.': 'Transparent rules and predictability — so that the solution works in the long term.',
        "Spokój w kwestiach\nformalnych": "Peace of mind\nin formal matters",
        'Dopilnujemy terminów i obowiązków sprawozdawczych, żeby nic „nie wyskakiwało" w ostatniej chwili.': 'We will take care of deadlines and reporting obligations so that nothing "pops up" at the last moment.',
        "Mniej ryzyk,\nmniej poprawek": "Fewer risks,\nfewer corrections",
        'Praca procesowa, weryfikacja danych i standardy, które ograniczają błędy.': 'Process work, data verification and standards that limit errors.',
        # --- section-kp-dlaczego ---
        "Dlaczego firmy wybierają nasze\nrozwiązania kadrowe": "Why companies choose our\nHR solutions",
        'Realizujemy usługi w oparciu o certyfikat ISO 9001': 'We deliver services based on ISO 9001 certification',
        "Nowoczesne i elastyczne\npodejście": "Modern and flexible\napproach",
        'Przygotowujemy raporty finansowe dopasowane do potrzeb zarządu i wspierające podejmowanie decyzji biznesowych.': 'We prepare financial reports tailored to management needs and supporting business decision-making.',
        'Bezpieczeństwo danych': 'Data security',
        'Stosujemy rozwiązania zgodne z normą ISO/IEC 27001, zapewniające poufność, integralność i bezpieczeństwo danych pracowniczych.': 'We apply solutions compliant with ISO/IEC 27001 standard, ensuring confidentiality, integrity and security of employee data.',
        'Business continuity': 'Business continuity',
        'Usługi realizuje cały zespół specjalistów, dlatego urlopy i rotacja pracowników nie wpływają na terminowość i ciągłość obsługi Twojej firmy.': 'Services are delivered by a whole team of specialists, so holidays and staff rotation do not affect the timeliness and continuity of service for your company.',
        # --- section-kp-hero ---
        'Kadry i płace, które dają': 'HR and payroll that bring',
        'spokój': 'peace of mind',
        'organizacji': 'to your organisation',
        'Zapewniamy kompleksową obsługę kadrowo-płacową firm o różnej skali działalności. Przejmujemy odpowiedzialność za poprawność, terminowość i ciągłość procesów, aby organizacja mogła działać stabilnie i bez zakłóceń.': 'We provide comprehensive HR and payroll services for companies of various sizes. We take responsibility for accuracy, timeliness and continuity of processes, so the organisation can operate stably and without disruptions.',
        'Porozmawiajmy': "Let's talk",
        # --- section-kp-obsluga ---
        'Twoje kadry': 'Your HR',
        'i płace': 'and payroll',
        'pod kontrolą': 'under control',
        'Oferujemy pełną obsługę kadrowo-płacową przedsiębiorstw – od prowadzenia dokumentacji pracowniczej po naliczanie wynagrodzeń i rozliczenia z instytucjami publicznymi. Klienci mogą powierzyć nam całość procesów kadrowych i płacowych lub wybrane obszary wymagające wsparcia.': 'We offer comprehensive HR and payroll services for enterprises — from maintaining employee documentation to payroll calculation and settlements with public institutions. Clients can entrust us with all HR and payroll processes or selected areas requiring support.',
        'Zakres współpracy dopasowujemy do wielkości i struktury organizacji.': 'We tailor the scope of cooperation to the size and structure of the organisation.',
        'Oszacuj wstępną wycenę': 'Get an initial estimate',
        # --- section-kp-cta ---
        'Porozmawiajmy o obsłudze kadrowej dla Twojej firmy': "Let's talk about HR services for your company",
        'Skontaktuj się z nami i dowiedz się, jak możemy wesprzeć Twój dział HR i płac.': 'Contact us and find out how we can support your HR and payroll department.',
        # --- section-kp-kalkulator ---
        'Kalkulator – oszacuj wstępnie koszt obsługi': 'Calculator — get an initial cost estimate',
        'Oszacuj wstępny koszt obsługi kadrowo-płacowej w kilka chwil. Wprowadź podstawowe informacje o swojej działalności, a my przygotujemy orientacyjną wycenę dopasowaną do Twoich potrzeb i skali zatrudnienia.': 'Estimate the initial cost of HR and payroll services in a few moments. Enter basic information about your business and we will prepare an indicative quote tailored to your needs and employment scale.',
        '* to jest wstępny szacunek, każda oferta jest jednak indywidualnie rozpatrywana i odpowiednio wyceniana.': '* this is a preliminary estimate; each offer is individually reviewed and priced accordingly.',
        # --- section-kp-wspolpraca ---
        'na bieżąco – obsługując codzienne procesy kadrowe i płacowe': 'on an ongoing basis — handling day-to-day HR and payroll processes',
        'Terminowe naliczanie wynagrodzeń': 'Timely payroll processing',
        'Terminy przetwarzania listy płac ustalamy indywidualnie z każdą firmą, uwzględniając jej wewnętrzny harmonogram wypłat oraz terminy rozliczeń z ZUS i US.': 'Payroll processing deadlines are agreed individually with each company, taking into account its internal payment schedule and ZUS and tax authority settlement deadlines.',
        'listy płac gotowe z odpowiednim wyprzedzeniem przed dniem wypłaty': 'payrolls ready with adequate notice before the payment date',
        'terminowe przelewy składek ZUS i zaliczek PIT': 'timely transfers of ZUS contributions and PIT advance payments',
        'Zakres raportowania ustalamy\nindywidualnie z każdym klientem.': 'The scope of reporting is agreed\nindividually with each client.',
        'zestawienie listy płac': 'payroll summary',
        'paski wynagrodzeń dla pracowników': 'payslips for employees',
        'potwierdzenia rozliczeń ZUS i US': 'ZUS and tax authority settlement confirmations',
        'W zależności od potrzeb przygotowujemy również dodatkowe raporty kadrowe, płacowe i zarządcze.': 'Depending on needs, we also prepare additional HR, payroll and management reports.',
        # --- section-kp-oferta ---
        'Oferta rozwiązań kadrowych': 'HR solutions offer',
        'Wyceń usługę': 'Get a quote',
        'Sprawdź również rozwiązania księgowe': 'Also check our accounting solutions',
        'Prowadzenie dokumentacji kadrowej\n\nNaliczanie wynagrodzeń i świadczeń\n\nObsługa umów o pracę i umów cywilnoprawnych\n\nRozliczenia z ZUS i instytucjami publicznymi\n\nSporządzanie deklaracji podatkowych\n\nKontrolowanie limitów urlopowych, terminów badań lekarskich, szkoleń BHP oraz wygasających umów\n\nReprezentowanie podczas kontroli i czynności sprawdzających\n\nZarządzanie programami PPK i PPE\n\nPlatforma pracownicza z dostępem do wniosków urlopowych i dokumentów online': 'Maintaining HR documentation\n\nPayroll and benefit calculation\n\nHandling employment contracts and civil law agreements\n\nSettlements with ZUS and public institutions\n\nPreparing tax declarations\n\nMonitoring leave limits, medical examination deadlines, H&S training and expiring contracts\n\nRepresentation during inspections and audit procedures\n\nManaging PPK and PPE schemes\n\nEmployee platform with access to leave requests and documents online',
        # --- section-kp-systemy ---
        "Obsługa wielu systemów\nksiągowych": "Support for multiple\naccounting systems",
        # --- section-hk-hero ---
        'Historie klientów': "Clients' stories",
        'Konkretne przypadki. Konkretny efekt. Zobacz, jak pomagamy firmom działać stabilnie i bezpiecznie.': 'Concrete cases. Concrete results. See how we help companies operate stably and securely.',
        'Poznaj historie': 'Explore the stories',
        # --- section-hk-wspolpraca ---
        'Współpraca, która': 'Cooperation that',
        'daje spokój operacyjny': 'brings operational peace of mind',
        'W Meritoros pracujemy tak, aby odciążyć zespół klienta i zapewnić ciągłość obsługi. Działamy elastycznie, dopasowując model współpracy do realiów organizacji, ale trzymamy stały standard jakości, terminowości i bezpieczeństwa danych.': 'At Meritoros we work in a way that relieves the client\'s team and ensures continuity of service. We operate flexibly, adapting the cooperation model to the realities of the organisation, while maintaining a consistent standard of quality, timeliness and data security.',
        'Dzięki temu klienci mogą skupić się na biznesie, a nie na „gaszeniu tematów" w księgowości czy kadrach': 'As a result, clients can focus on business rather than "putting out fires" in accounting or HR',
        # --- section-fr-model ---
        "Możesz powierzyć nam całość procesów księgowych lub wybrane obszary wymagające uporządkowania.\nDopasowujemy zakres wsparcia do realnej sytuacji Twojej firmy.": "You can entrust us with all accounting processes or selected areas that need organising.\nWe tailor the scope of support to the actual situation of your business.",
        'Obsługujemy proces end-to-end: od bieżącej ewidencji po zamknięcie miesiąca i raporty. Pracujesz z zespołem, który zapewnia zastępowalność i stały standard.': 'We manage the process end-to-end: from day-to-day bookkeeping to month-end closing and reports. You work with a team that ensures substitutability and consistent standards.',
        # --- section-fr-obsluga ---
        'Obsługa księgowa fundacji rodzinnej dla właścicieli myślących długoterminowo': 'Accounting services for a family foundation for owners thinking long-term',
        'Prowadzimy księgowość fundacji rodzinnych dla przedsiębiorców, którzy chcą uporządkować kwestie majątku i sukcesji w sposób bezpieczny, transparentny i zgodny z przepisami. Bierzemy na siebie bieżącą obsługę, sprawozdawczość i kontrolę terminów, tak aby fundacja działała stabilnie.': 'We run the accounting of family foundations for entrepreneurs who want to organise matters of property and succession in a safe, transparent and compliant manner. We take on the ongoing service, reporting and deadline monitoring so that the foundation operates stably.',
        # --- section-fr-oferta ---
        'Poznaj naszą ofertę': 'See our offer',
        'Zapewniamy kompleksową obsługę księgową i podatkową, która porządkuje finanse fundacji i daje poczucie bezpieczeństwa jej fundatorom.': 'We provide comprehensive accounting and tax services that bring order to the foundation\'s finances and give its founders a sense of security.',
        'Prowadzenie ksiąg rachunkowych\n\nRozliczanie i składanie deklaracji podatkowych\n\nPrzygotowywanie sprawozdań finansowych\n\nAsystowanie podczas badania sprawozdania finansowego oraz kontroli urzędów\n\nRaportowanie na cele zarządcze\n\nSporządzanie polityki rachunkowości': 'Maintaining accounting books\n\nCalculating and filing tax returns\n\nPreparing financial statements\n\nAssisting during financial statement audits and regulatory inspections\n\nReporting for management purposes\n\nDrafting accounting policies',
        # --- section-media-artykul ---
        'Maciej Paraszczak dla Pulsu Biznesu': 'Maciej Paraszczak for Puls Biznesu',
        'Dla wielu naszych klientów jesteśmy nie tylko biurem rachunkowym, ale partnerem operacyjnym, który realnie usprawnia ich procesy biznesowe – podkreśla z Maciej Paraszczak, prezes zarządu spółki Meritoros.': 'For many of our clients we are not just an accounting firm, but an operational partner that genuinely improves their business processes — says Maciej Paraszczak, CEO of Meritoros.',
        'Wywiad z Maciejem Paraszczakiem dla Pulsu Biznesu o tym, jak wygląda nowoczesna księgowość w praktyce i dlaczego standard oraz procesy mają dziś kluczowe znaczenie.': 'An interview with Maciej Paraszczak for Puls Biznesu on what modern accounting looks like in practice and why standards and processes are of key importance today.',
        'Czytaj więcej': 'Read more',
        # --- section-media-hero ---
        'Media i informacje firmowe': 'Media and company news',
        'Najważniejsze wydarzenia z życia firmy: rozwój, nowe inicjatywy, wyróżnienia i ogłoszenia.': 'The most important events in the life of the company: development, new initiatives, awards and announcements.',
        # --- section-media-przeczytaj ---
        'Przeczytaj również': 'Read also',
        # --- section-media-zapytania ---
        'Zapytania medialne': 'Media enquiries',
        'W sprawach publikacji, komentarzy eksperckich i współpracy medialnej prosimy o kontakt. Odpowiemy możliwie szybko i wrócimy z informacją, w jakiej formie możemy pomóc.': 'For matters relating to publications, expert commentary and media cooperation, please get in touch. We will respond as quickly as possible and get back to you with information on how we can help.',
        # --- section-onas-hero ---
        'Poznaj nasze biuro rachunkowe i wartości, które stoją za naszą codzienną pasją.': 'Get to know our accounting firm and the values that underlie our daily passion.',
        'Pracujemy tak, by być dumni z jakości informacji dostarczanych naszym klientom.': 'We work in a way that makes us proud of the quality of information we deliver to our clients.',
        'Porozmawiamy': "Let's talk",
        # --- section-onas-zespol ---
        'Zespół': 'Team',
        'prezes zarządu, CEO': 'president of the management board, CEO',
        'Założyciel i główny udziałowiec Meritoros SA, certyfikowany księgowy (Certyfikat Min. Finansów nr 1840/2003). Absolwent kierunku Zarządzanie ze specjalnością Finanse i Rachunkowość.': 'Founder and main shareholder of Meritoros SA, certified accountant (Ministry of Finance Certificate No. 1840/2003). Graduate of Management with specialisation in Finance and Accounting.',
        'członek zarządu, COO': 'member of the management board, COO',
        'Udziałowiec Meritoros SA, certyfikowana księgowa (Certyfikat Min. Finansów nr 54055/2011). Absolwentka kierunku Zarządzania na AGH, swoje wykształcenie uzupełniła o studia podyplomowe.': 'Shareholder of Meritoros SA, certified accountant (Ministry of Finance Certificate No. 54055/2011). Graduate of Management at AGH, supplemented her education with postgraduate studies.',
        'Udziałowiec Meritoros SA, certyfikowany księgowy (Certyfikat Min. Finansów nr 62092/2013). Absolwent kierunku Finansów i Rachunkowości na UEK ze specjalnością finanse przedsiębiorstw.': 'Shareholder of Meritoros SA, certified accountant (Ministry of Finance Certificate No. 62092/2013). Graduate of Finance and Accounting at UEK with specialisation in corporate finance.',
        'Księgowa (Certyfikat Min. Finansów 55068/2012) z wieloletnim doświadczeniem. Swoją karierę budowała w Biurach Rachunkowych oraz jako główna księgowa w jednej z międzynarodowych firm.': 'Accountant (Ministry of Finance Certificate 55068/2012) with many years of experience. She built her career in accounting firms and as chief accountant at an international company.',
        # --- section-ri-akcjonariat ---
        'Informacje o strukturze akcjonariatu': 'Information on shareholder structure',
        'Kapitał zakładowy spółki wynosi 120 000 PLN i dzieli się na 1 200 000 akcji serii A o wartości nominalnej 0,10 PLN.': 'The share capital of the company is PLN 120,000 and is divided into 1,200,000 series A shares with a nominal value of PLN 0.10.',
        'Akcjonariusz': 'Shareholder',
        'Łączna liczba posiadanych akcji': 'Total number of shares held',
        'Udział w łącznej liczbie głosów': 'Share in the total number of votes',
        # --- section-ri-hero ---
        'Relacje inwestorskie': 'Investor relations',
        'Poniżej udostępniamy kluczowe informacje i dokumenty dotyczące Meritoros SA, w tym sprawozdania finansowe i raporty okresowe.': 'Below we share key information and documents relating to Meritoros SA, including financial statements and periodic reports.',
        # --- section-ri-msg ---
        'Ogłoszenia w Monitorze Sądowym i Gospodarczym': 'Announcements in the Court and Commercial Gazette',
        # --- section-ri-ogloszenia ---
        'Ogłoszenia o zwołaniu Walnego Zgromadzenia Akcjonariuszy': 'Notices of convening the General Meeting of Shareholders',
        # --- section-ri-rada ---
        'Rada nadzorcza': 'Supervisory board',
        'doradca podatkowy (certyfikat nr 00443)\nbył członek zarządu Małopolskiej Izby Doradców Podatkowych': 'tax adviser (certificate No. 00443)\nformer member of the board of the Małopolska Chamber of Tax Advisers',
        'przedsiębiorca\nprezes zarządu Emka Sp. z o.o.': 'entrepreneur\npresident of the management board of Emka Sp. z o.o.',
        'przedsiębiorca\nczłonek zarządu Chata Sp. z o.o.': 'entrepreneur\nmember of the management board of Chata Sp. z o.o.',
        'przedsiębiorca\nwiceprezes zarządu Office Samurai Sp. z o.o.': 'entrepreneur\nvice-president of the management board of Office Samurai Sp. z o.o.',
        'przedsiębiorca\nprezes zarządu Printbox Sp. z o.o.': 'entrepreneur\npresident of the management board of Printbox Sp. z o.o.',
        # --- section-ri-raporty ---
        'Raporty kwartalne spółki': 'Quarterly reports of the company',
        'Raporty EBI/ESPI': 'EBI/ESPI reports',
        'Animator Rynku': 'Market Maker',
        'Autoryzowany Doradca': 'Authorised Adviser',
        'Pytania i odpowiedzi': 'Questions and answers',
        # --- section-ri-rewident ---
        'Opinie biegłego rewidenta': 'Auditor\'s opinions',
        # --- section-ri-rosniemy ---
        'Rośniemy': 'We are growing',
        'Rozwój Meritoros SA znajduje odzwierciedlenie w systematycznym wzroście skali działalności i przychodów na przestrzeni ostatnich lat.': 'The development of Meritoros SA is reflected in the systematic growth of the scale of operations and revenues over recent years.',
        # --- section-ri-sprawozdania ---
        'Sprawozdania finansowe spółki': 'Financial statements of the company',
        # --- section-ri-sprawozdania-zarzadu ---
        'Sprawozdania z działalności zarządu spółki': 'Management board activity reports',
        # --- section-ri-uchwaly ---
        'Uchwały podejmowane przez Zgromadzenie Akcjonariuszy': 'Resolutions adopted by the General Meeting of Shareholders',
        # --- section-ri-zarzad ---
        'Zarząd': 'Management board',
        # --- section-uk-cta ---
        'Skontaktuj się z nami i dowiedz się, jak możemy wesprzeć Twoją firmę.': 'Contact us and find out how we can support your company.',
        # --- section-uk-dlaczego ---
        "Dlaczego firmy wybierają nasze\nrozwiązania księgowe": "Why companies choose our\naccounting solutions",
        "Jakość potwierdzona\nstandardami": "Quality confirmed\nby standards",
        'Pracujemy zgodnie z normą ISO 9001 — systematyczne procesy, kontrola jakości i ciągłe doskonalenie usług.': 'We work in accordance with ISO 9001 — systematic processes, quality control and continuous improvement of services.',
        "Nowoczesne i elastyczne podejście": "Modern and flexible approach",
        'Dopasowujemy narzędzia i zakres współpracy do realnych potrzeb Twojej firmy – bez zbędnej biurokracji.': 'We tailor the tools and scope of cooperation to the real needs of your company — without unnecessary bureaucracy.',
        'Zespołowy model pracy gwarantuje ciągłość obsługi — urlopy i rotacja pracowników nie wpływają na jakość Twojej księgowości.': 'A team-based work model guarantees continuity of service — holidays and staff rotation do not affect the quality of your accounting.',
        'Dane klientów chronimy zgodnie z normą ISO 27001 — wdrożone procedury, szyfrowanie i regularne audyty bezpieczeństwa.': 'We protect client data in accordance with ISO 27001 — implemented procedures, encryption and regular security audits.',
        # --- section-uk-hero ---
        'Rozwiązania księgowe dla firm, które': 'Accounting solutions for companies that',
        'chcą mieć porządek': 'want to have order',
        'i spokój w biznesie': 'and peace of mind in business',
        'Zapewniamy kompleksową obsługę księgową firm o różnej skali działalności. Przejmujemy odpowiedzialność za poprawność, terminowość i ciągłość procesów księgowych, aby nasi klienci mogli skupić się na prowadzeniu i rozwoju biznesu.': 'We provide comprehensive accounting services for companies of various sizes. We take responsibility for accuracy, timeliness and continuity of accounting processes, so our clients can focus on running and growing their business.',
        # --- section-uk-ksiegowosc ---
        'Twoja księgowość': 'Your accounting',
        'w': 'in',
        'dobrych rękach': 'good hands',
        'Oferujemy kompleksową obsługę księgową działalności i spółek zarówno w zakresie prowadzenia pełnych ksiąg rachunkowych, jak i uproszczonych form ewidencji. Klienci mogą powierzyć nam całość procesów księgowych lub wybrane obszary wymagające wsparcia.': 'We offer comprehensive accounting services for sole traders and companies, both in the area of maintaining full accounting books and simplified forms of records. Clients can entrust us with all accounting processes or selected areas requiring support.',
        'Zakres współpracy dopasowujemy do skali działalności i stopnia złożoności operacji finansowych.': 'We tailor the scope of cooperation to the scale of operations and the complexity of financial transactions.',
        'Sprawdź jak wygląda współpraca': 'See how cooperation works',
        # --- section-uk-oferta ---
        'Oferta rozwiązań księgowych': 'Accounting solutions offer',
        "Obsługujemy firmy na różnych formach rozliczeń zarówno w pełnej księgowości (spółki),\njak i w uproszczonych formach ewidencji (np. KPiR)": "We serve companies on various accounting forms, both in full accounting (companies),\nas well as simplified record forms (e.g. revenue and expense ledger)",
        'Poniżej pokazujemy przykładowy zakres działań. Jeśli potrzebujesz innej usługi chętnie porozmawiamy.': 'Below we show an example scope of activities. If you need a different service, we will be happy to talk.',
        'Sprawdź również rozwiązania kadrowe': 'Also check our HR solutions',
        'Prowadzenie ksiąg rachunkowych\n\nObliczanie podatków i składanie deklaracji podatkowych\n\nBieżące rozliczanie wyciągów i kontrolowanie rozrachunków\n\nRaportowanie zarządcze i sprawozdawcze\n\nRaportowanie do instytucji publicznych\n\nSporządzanie sprawozdań finansowych oraz deklaracji rocznych\n\nReprezentowanie podczas kontroli i czynności sprawdzających\n\nObsługa niestandardowych rozliczeń\n\nAsystowanie i wsparcie podczas audytu': 'Maintaining accounting books\n\nCalculating taxes and filing tax returns\n\nOngoing reconciliation of bank statements and settlement control\n\nManagement and financial reporting\n\nReporting to public institutions\n\nPreparing financial statements and annual declarations\n\nRepresentation during inspections and audit procedures\n\nHandling non-standard settlements\n\nAssisting and supporting during audits',
        # --- section-uk-wspolpraca ---
        'na bieżąco – obsługując codzienne procesy księgowe lub kadrowe': 'on an ongoing basis — handling day-to-day accounting or HR processes',
        'Zakres i częstotliwość raportowania\nustalamy indywidualnie z każdym klientem.': 'The scope and frequency of reporting\nis agreed individually with each client.',
        'W zależności od potrzeb przygotowujemy również dodatkowe raporty księgowe, finansowe lub kadrowo-płacowe.': 'Depending on needs, we also prepare additional accounting, financial or HR and payroll reports.',
        # --- section-uk-kalkulator ---
        'Oszacuj wstępny koszt usług księgowych w kilka chwil. Wprowadź podstawowe informacje o swojej działalności, a my przygotujemy orientacyjną wycenę dopasowaną do Twoich potrzeb i skali biznesu.': 'Estimate the initial cost of accounting services in a few moments. Enter basic information about your business and we will prepare an indicative quote tailored to your needs and business scale.',
        # --- section-bpo-systemy ---
        "Obsługa wielu systemów\nksięgowych": "Support for multiple\naccounting systems",
        # --- section-services ---
        'Nasze Kompetencje': 'Our Competencies',
        'Obszary, w których przejmujemy odpowiedzialność': 'Areas in which we take responsibility',
        'Nasze doświadczenie obejmuje rozliczanie firm o różnorodnych profilach działalności, takich jak CIT Estoński, Fundacje Rodzinne, Spółki ASI, e-commerce, VAT OSS, Intrastat oraz rozliczenia delegacji pracowniczych.': 'Our experience covers settlements for companies with diverse business profiles, such as Estonian CIT, Family Foundations, ASI companies, e-commerce, VAT OSS, Intrastat and employee travel settlements.',
        'Zapytaj o ofertę': 'Ask about our offer',
        'Usługi Rachunkowe': 'Accounting Services',
        'Kompleksowa obsługa księgowa firm o różnej skali działalności.': 'Comprehensive accounting services for companies of various sizes.',
        'BPO': 'BPO',
        'Outsourcing wybranych lub pełnych procesów finansowych i administracyjnych dla większych firm.': 'Outsourcing of selected or full financial and administrative processes for larger companies.',
        'Usługi Kadrowe': 'HR Services',
        'Obsługa kadrowo-płacowa dopasowana do potrzeb organizacji.': 'HR and payroll services tailored to the needs of the organisation.',
        'Fundacje rodzinne': 'Family foundations',
        'Obsługa rachunkowa fundacji z uwzględnieniem specyfiki regulacyjnej.': 'Accounting services for foundations taking into account regulatory specificities.',
        'Wsparcie we wdrażaniu narzędzi, automatyzacji i usprawnianiu procesów biznesowych.': 'Support in implementing tools, automation and streamlining business processes.',
        # --- section-oferta-kuk-info ---
        'Prowadzenie ksiąg rachunkowych i ewidencji podatkowych (PKPB)': 'Maintaining accounting books and tax records (PKPB)',
        'Sporządzanie deklaracji i sprawozdań finansowych (CIT, VAT, PIT)': 'Preparing financial declarations and statements (CIT, VAT, PIT)',
        'Przygotowywanie rocznych sprawozdań finansowych i analiz dla klientów': 'Preparing annual financial statements and analyses for clients',
        'Bezpośredni kontakt z klientami (telefon, e-mail) w sprawach rozliczeń': 'Direct contact with clients (phone, e-mail) on settlement matters',
        'Współpraca z urzędami skarbowymi, instytucjami finansowymi i podmiotami zewnętrznymi, w tym reprezentacja klientów': 'Cooperation with tax offices, financial institutions and external entities, including client representation',
        'Minimum 2 lata doświadczenia w samodzielnym prowadzeniu ksiąg rachunkowych w biurze rachunkowym; certyfikat MF mile widziany': 'Minimum 2 years of experience in independently maintaining accounting books in an accounting firm; Ministry of Finance certificate welcome',
        'Biegła znajomość języka ukraińskiego i rosyjskiego do komunikacji z klientami': 'Fluent knowledge of Ukrainian and Russian for client communication',
        'Doświadczenie w samodzielnym sporządzaniu sprawozdań finansowych': 'Experience in independently preparing financial statements',
        'Praktyczna znajomość przepisów rachunkowych, prawa podatkowego i przepisów VAT': 'Practical knowledge of accounting regulations, tax law and VAT regulations',
        'Biegłość w MS Office (szczególnie Excel) i oprogramowaniu księgowym Comarch Optima': 'Proficiency in MS Office (particularly Excel) and Comarch Optima accounting software',
        'Skrupulatność i wysokie zdolności organizacyjne': 'Meticulousness and high organisational skills',
        'Zdolności analitycznego myślenia': 'Analytical thinking skills',
        # --- section-kariera-hero ---
        "Dołącz do\nnaszego zespołu": "Join\nour team",
        "Budujemy uporządkowane procesy i dobrą atmosferę.\nJeśli cenisz jasne zasady, rozwój i pracę zespołową – sprawdź,\nczy mamy ofertę dla Ciebie.": "We build orderly processes and a good atmosphere.\nIf you value clear rules, development and teamwork — check\nwhether we have an offer for you.",
        'Aktualne oferty pracy': 'Current job offers',
        # --- fr-oferta / uk-oferta full item strings ---
        "Prowadzenie ksiąg rachunkowych\n\nRozliczanie i składanie deklaracji podatkowych\n\nPrzygotowywanie sprawozdań finansowych\n\nAsystowanie podczas badania sprawozdania finansowego oraz kontroli urzędów\n\nRaportowanie na cele zarządcze\n\nSporządzanie polityki rachunkowości":
            "Maintaining accounting books\n\nFiling and submitting tax declarations\n\nPreparing financial statements\n\nAssisting during financial statement audits and authority inspections\n\nManagement reporting\n\nDrafting accounting policies",
        "Prowadzenie ksiąg rachunkowych\n\nObliczanie podatków i składanie deklaracji podatkowych\n\nBieżące rozliczanie wyciągów i kontrolowanie rozrachunków\n\nRaportowanie zarządcze i sprawozdawcze\n\nRaportowanie do instytucji publicznych\n\nSporządzanie sprawozdań finansowych oraz deklaracji rocznych\n\nReprezentowanie podczas kontroli i czynności sprawdzających\n\nObsługa niestandardowych rozliczeń\n\nAsystowanie i wsparcie podczas audytu":
            "Maintaining accounting books\n\nCalculating taxes and submitting tax declarations\n\nReconciling account statements and monitoring settlements\n\nManagement and financial reporting\n\nReporting to public institutions\n\nPreparing financial statements and annual declarations\n\nRepresentation during inspections and audit procedures\n\nHandling non-standard settlements\n\nAssisting and supporting during audits",
    },
    'uk': {
        'Bezpieczeństwo\ni compliance':
            'Безпека\nта відповідність',
        'Blog':
            'Блог',
        'Błąd połączenia. Spróbuj ponownie.':
            "Помилка з'єднання. Спробуйте ще раз.",
        'Certyfikat':
            'Сертифікат',
        'Dlaczego BPO z Meritoros?':
            'Чому BPO з Meritoros?',
        'Dlaczego Meritoros to spokój\nw Twoim biznesie?':
            'Чому Meritoros — це спокій\nу вашому бізнесі?',
        'Działamy zgodnie z normami ISO 9001 i ISO/IEC 27001. Zapewniamy poufność danych, ciągłość obsługi i pełną zgodność z obowiązującymi przepisami prawa.':
            'Ми працюємо відповідно до стандартів ISO 9001 та ISO/IEC 27001. Забезпечуємо конфіденційність даних, безперервність обслуговування та повну відповідність чинному законодавству.',
        'Działamy zgodnie z obowiązującymi regulacjami i standardami bezpieczeństwa danych. Dbamy o poufność informacji oraz jasne zasady współpracy - bez "skrótów" i ryzyk.':
            'Ми працюємо відповідно до чинних норм та стандартів безпеки даних. Дбаємо про конфіденційність інформації та чіткі умови співпраці — без «скорочень» та ризиків.',
        'Efektywność kosztowa':
            'Економічна ефективність',
        'Elastyczność i indywidualne podejście pozwalają nam szybko dopasować się do zmieniających się potrzeb klientów i wspomóc ich na ścieżce skalowania swojej organizacji.':
            'Гнучкість та індивідуальний підхід дозволяють нам швидко адаптуватися до мінливих потреб клієнтів і підтримувати їх на шляху масштабування організації.',
        'Elastyczność i skalowanie\noperacji':
            'Гнучкість і масштабування\nоперацій',
        'Jakość potwierdzona standardami':
            'Якість, підтверджена стандартами',
        'Kompleksowa obsługa kadrowo-płacowa – od umów i list płac po rozliczenia z ZUS i US, z pełną zastępowalnością zespołu.':
            'Комплексне кадрово-бухгалтерське обслуговування — від договорів та відомостей до розрахунків із ZUS та органами ДПС, з повною взаємозамінністю команди.',
        'Mamy wdrożone procedury kontroli jakości i weryfikacji danych. Dostarczamy spójne dane dla zarządu.':
            'Ми впровадили процедури контролю якості та перевірки даних. Надаємо узгоджені дані для керівництва.',
        'Nagrody i wyróżnienia':
            'Нагороди та відзнаки',
        'Nasze Wartości':
            'Наші цінності',
        'Obszar współpracy':
            'Сфера співпраці',
        'Outsourcing biznesowy pozwala na znaczne obniżenie kosztów operacyjnych. Dzięki nowoczesnej technologii i dużej skali obsługiwanych przez nas operacji oszczędności sięgają 20% lub więcej w porównaniu do obsługi procesów za pomocą własnych pracowników.':
            'Аутсорсинг бізнес-процесів дозволяє суттєво знизити операційні витрати. Завдяки сучасним технологіям та великому масштабу операцій, що ми ведемо, економія сягає 20% і більше порівняно з обробкою процесів власними працівниками.',
        'Pełna księgowość, raportowanie zarządcze i sprawozdawcze – terminowo i zgodnie ze standardami, bez zakłóceń operacyjnych.':
            'Повний бухгалтерський облік, управлінська та фінансова звітність — вчасно і відповідно до стандартів, без операційних збоїв.',
        'Podaj prawidłowy adres e-mail.':
            'Введіть дійсну адресу електронної пошти.',
        'Porozmawiajmy o obsłudze księgowej dla Twojej firmy':
            'Поговоримо про бухгалтерське обслуговування вашої компанії',
        'Poznaj ofertę':
            'Дізнатися більше',
        'Pracujemy zespołowo i procesowo, dzięki czemu obsługa nie zależy od jednej osoby. Zapewniamy zastępowalność i ciągłość pracy – bez przestojów.':
            'Ми працюємо злагодженою командою за процесним підходом, тому обслуговування не залежить від однієї особи. Забезпечуємо взаємозамінність та безперервність роботи — без простоїв.',
        'Przekazując odpowiedzialność za pewne procesy wsparcia, Zarząd i kluczowi menedżerowie przedsiębiorstwa mogą skupić się na rozwoju rynkowym i strategicznym zarządzaniu swoim biznesem.':
            'Передаючи відповідальність за певні процеси підтримки, Рада директорів та ключові менеджери можуть зосередитися на розвитку ринку та стратегічному управлінні бізнесом.',
        'Pytania od kandydatów':
            'Запитання від кандидатів',
        'Robotyzacja RPA\n\nE-teczki\n\nOptymalizacja procesów\n\nElektroniczny obieg dokumentów\n\nAutomatyzacja raportowania':
            'Роботизація RPA\n\nЕлектронні досьє\n\nОптимізація процесів\n\nЕлектронний документообіг\n\nАвтоматизація звітності',
        'Rozwiązania BPO':
            'Рішення BPO',
        'Rozwiązania kadrowe':
            'Кадрові рішення',
        'Rozwiązania księgowe':
            'Бухгалтерські рішення',
        'Skala i ciągłość\nobsługi':
            'Масштаб та безперервність\nобслуговування',
        'Skontaktuj się z nami i dowiedz się, jak możemy wesprzeć Twoją organizację.':
            "Зв'яжіться з нами і дізнайтеся, як ми можемо підтримати вашу організацію.",
        'Systematycznie rozwijamy i wdrażamy rozwiązania z zakresu robotyki (RPA) oraz automatyzacji. Wdrażamy najnowsze technologie, w tym Robotic Process Automation oraz AI, aby umożliwić klientom pełną kontrolę nad finansami. Działamy w modelu Lean, który zapewnia sprawność operacyjną i błyskawiczne dostosowanie się do potrzeb zmieniającego się rynku.':
            'Ми систематично розробляємо та впроваджуємо рішення у сфері роботизації (RPA) та автоматизації. Впроваджуємо найновіші технології, зокрема Robotic Process Automation та ШІ, щоб надати клієнтам повний контроль над фінансами. Працюємо за моделлю Lean, яка забезпечує операційну ефективність і швидку адаптацію до мінливого ринку.',
        'Technologia\ni automatyzacja':
            'Технологія\nта автоматизація',
        'Transformacja Cyfrowa':
            'Цифрова трансформація',
        'Transformacja cyfrowa':
            'Цифрова трансформація',
        'Uwolnienie czasu\ni usprawnienie procesów':
            'Вивільнення часу\nта оптимізація процесів',
        'Wdrożenie RPA, e-teczek i elektronicznego obiegu dokumentów – automatyzujemy procesy, żeby organizacja działała sprawniej.':
            'Впровадження RPA, електронних досьє та електронного документообігу — автоматизуємо процеси, щоб організація працювала ефективніше.',
        'Wiedza i aktualności':
            'Знання та новини',
        'Współpracuj z profesjonalistami':
            'Співпрацюй з професіоналами',
        'Wszystkie wpisy':
            'Усі записи',
        'Wykorzystujemy narzędzia i automatyzację (RPA), które porządkują obieg dokumentów, ograniczają ryzyko błędów i usprawniają pracę zespołów.':
            'Ми використовуємо інструменти та автоматизацію (RPA), які впорядковують документообіг, зменшують ризик помилок та підвищують ефективність команд.',
        'Wyróżnienia są efektem tego, jak rozwijamy Meritoros: konsekwentnie i procesowo. Trzymamy standard, który ma działać w praktyce - codziennie.':
            'Нагороди є результатом того, як ми розвиваємо Meritoros: послідовно і за процесним підходом. Ми дотримуємося стандарту, який має працювати на практиці — щодня.',
        'Wystąpił błąd. Spróbuj ponownie.':
            'Сталася помилка. Спробуйте ще раз.',
        'Zapewniamy kompleksową obsługę kadrowo-płacową firm o różnej skali działalności. Przejmujemy odpowiedzialność za poprawność, terminowość i ciągłość procesów, aby organizacja mogła działać stabilnie i bez zakłóceń.':
            'Ми надаємо комплексні кадрові та бухгалтерські послуги компаніям різного масштабу. Беремо на себе відповідальність за точність, своєчасність та безперервність процесів, щоб організація могла стабільно працювати без збоїв.',
        'Zaufało nam ponad 1200 klientów':
            'Нам довіряють понад 1200 клієнтів',
        'dla większych organizacji':
            'для великих організацій',
        'bez stresu':
            'без стресу',
        'Chcesz do nas dołączyć?\nZostaw swoje CV':
            'Хочете приєднатися до нас?\nЗалиште своє резюме',
        'Ciągły Rozwój jest wpisany\nw nasze DNA':
            'Постійний розвиток закладений\nу нашій ДНК',
        'Dołącz do grona naszych\nklientów i rozwijaj biznes':
            'Приєднуйтесь до наших клієнтів\nта розвивайте бізнес',
        'Elastyczność dopasowana\ndo Twojego stylu pracy':
            'Гнучкість, адаптована\nдо вашого стилю роботи',
        'Informacje':
            'Інформація',
        'Menu':
            'Меню',
        'Menu główne':
            'Головне меню',
        'Menu stopki':
            'Меню підвалу',
        'Miasta w których\nmamy oddziały':
            'Міста, де\nми маємо офіси',
        'Nasi specjaliści są do dyspozycji w godzinach pracy biura.\nOdpowiemy na wszystkie Twoje pytania.':
            'Наші фахівці доступні в робочий час.\nВідповімо на всі ваші запитання.',
        'Oddaj księgowość\nw ręce ekspertów':
            'Передайте бухгалтерію\nв руки експертів',
        'Oddziały\nWirtualne':
            'Віртуальні\nвідділення',
        'Otwórz menu':
            'Відкрити меню',
        'Polityka prywatności':
            'Політика конфіденційності',
        'Praca w zgranym\nzespole specjalistów':
            'Робота у згуртованій\nкоманді фахівців',
        'Profesjonalne biuro rachunkowe i BPO dla firm z ambicjami.':
            'Професійне бухгалтерське бюро та BPO для компаній з амбіціями.',
        'Projekt i realizacja:':
            'Дизайн та розробка:',
        'Regulamin newslettera':
            'Умови розсилки',
        'Skup biur rachunkowych':
            'Придбання бухгалтерських бюро',
        'Stabilne zatrudnienie\ni jasne zasady':
            'Стабільна зайнятість\nта чіткі правила',
        'Usługi':
            'Послуги',
        'Zacznij teraz':
            'Розпочати',
        'Zamknij menu':
            'Закрити меню',
        # --- Нові рядки: hero, case-studies, buyout ---
        'Eksperci w księgowości.\nTechnologia i pewność\nw działaniu.':
            'Експерти з бухгалтерії.\nТехнології та впевненість\nу дії.',
        'Zapewniamy księgowość kadry i outsourcing procesów w standardzie, który daje firmom spokój i bezpieczeństwo.':
            'Ми надаємо бухгалтерські, кадрові та аутсорсингові послуги на рівні, що забезпечує компаніям спокій і безпеку.',
        'Zaufało nam ponad <span class="text-white">1200 klientów</span>':
            'Нам довіряють понад <span class="text-white">1200 клієнтів</span>',
        'Wideo ogólne':
            'Загальне відео',
        'Wideo ogólne Meritoros':
            'Загальне відео Meritoros',
        'Obejrzyj ogólne wideo':
            'Переглянути загальне відео',
        'Nasi klienci cenią nas za to, że dowozimy: jakość, terminowość i spójne dane. Jako partner w obszarze księgowości przejmujemy obszary, za które odpowiadamy, i pracujemy w standardzie, który daje spokój w codziennym prowadzeniu firmy.':
            'Наші клієнти цінують нас за те, що ми доставляємо: якість, вчасність і узгоджені дані. Як партнер у сфері бухгалтерії ми беремо відповідальність за підпорядковані нам ділянки й працюємо на стандарті, що забезпечує спокій у щоденному веденні бізнесу.',
        'Dla biur rachunkowych':
            'Для бухгалтерських бюро',
        "Kupimy Biuro\nRachunkowe":
            "Купимо бухгалтерське\nбюро",
        'Od lat współpracujemy z biurami rachunkowymi, które stoją przed decyzją o zmianie, sprzedaży lub dalszym rozwoju.':
            'Роками ми співпрацюємо з бухгалтерськими бюро, які стоять перед рішенням про зміну, продаж або подальший розвиток.',
        'Wyceń wartość biura':
            'Оцініть вартість бюро',
        'Obsługujemy systemy ERP i finansowe wiodących dostawców':
            'Ми обслуговуємо ERP та фінансові системи провідних постачальників',
        'Przejrzystych warunków':
            'Прозорих умов',
        'Przejętych biur':
            'Придбаних бюро',
        'Do wstępnej wyceny':
            'До попередньої оцінки',
        'Pełna poufność':
            'Повна конфіденційність',
        # --- Нові рядки: bpo-info ---
        "Stabilne procesy. Rzetelne\ndane. Spokój zarządu.":
            "Стабільні процеси. Достовірні\nдані. Спокій керівництва.",
        'Wspieramy większe firmy w obszarze księgowości, kadr i płac, back-office, przejmując odpowiedzialność za jakość, terminowość i ciągłość działania. Dostarczamy dane i raporty w harmonogramie dopasowanym do zarządu – tak, żeby decyzje były oparte na spójnych informacjach, a nie „gaszeniu pożarów".':
            'Ми підтримуємо великі компанії у сфері бухгалтерії, кадрів і нарахування заробітної плати, беручи відповідальність за якість, вчасність та безперервність роботи. Надаємо дані та звіти за графіком, погодженим з керівництвом, — щоб рішення ґрунтувалися на узгодженій інформації, а не на «гасінні пожеж».',
        "raportowanie zarządcze i sprawozdawcze dopasowane do potrzeb organizacji\n\ncyfrowy obieg dokumentów i uporządkowane procesy\n\npełna zastępowalność i ciągłość obsługi oraz gotowość do skalowania":
            "управлінська та фінансова звітність, адаптована до потреб організації\n\nцифровий документообіг і впорядковані процеси\n\nповна взаємозамінність і безперервність обслуговування та готовність до масштабування",
        "Jakość potwierdzona\nstandardami":
            "Якість, підтверджена\nстандартами",
        "Ponad 170\nexpertów":
            "Понад 170\nексперти",
        'Nagroda':
            'Нагорода',
        # --- Нові рядки: bpo-kadrowe ---
        'Rozwiązania Kadrowe':
            'Кадрові рішення',
        'Zapewniamy wsparcie w zakresie obsługi kadrowej i naliczania wynagrodzeń. Nasze kompleksowe rozwiązania w obszarze HR i payroll, dedykowane dla dużych przedsiębiorstw, zapewniają nie tylko zgodność z przepisami prawa, ale także optymalizację procesów kadrowych. Współpracujemy zarówno z firmami, które nie posiadają własnego działu HR, jak i z organizacjami potrzebującymi wsparcia przy wybranych procesach.':
            'Ми надаємо підтримку в галузі кадрового обліку та нарахування заробітної плати. Наші комплексні рішення в сфері HR та payroll, призначені для великих підприємств, забезпечують не лише відповідність законодавству, але й оптимізацію кадрових процесів. Ми співпрацюємо як з компаніями без власного відділу HR, так і з організаціями, що потребують підтримки в окремих процесах.',
        'Dlaczego BPO z nami':
            'Чому BPO з нами',
        'Sprawdź rozwiązania kadrowe':
            'Ознайомтесь з кадровими рішеннями',
        "Prowadzenie dokumentacji kadrowej\n\nNaliczanie wynagrodzeń i świadczeń\n\nObsługa umów o pracę i umów cywilnoprawnych\n\nRozliczenia z ZUS i instytucjami publicznymi\n\nSporządzanie deklaracji podatkowych\n\nKontrolowanie limitów urlopowych, terminów badań lekarskich, szkoleń BHP oraz wygasających umów\n\nReprezentowanie podczas kontroli i czynności sprawdzających\n\nZarządzanie programami PPK i PPE\n\nPlatforma pracownicza z dostępem do wniosków urlopowych i dokumentów online":
            "Ведення кадрової документації\n\nНарахування заробітної плати та пільг\n\nОбробка трудових та цивільно-правових договорів\n\nРозрахунки з ZUS та державними установами\n\nПідготовка податкових декларацій\n\nКонтроль лімітів відпусток, термінів медоглядів, охорони праці та закінчення договорів\n\nПредставництво під час перевірок та ревізійних дій\n\nУправління програмами PPK та PPE\n\nПлатформа для співробітників з доступом до заяв на відпустку та документів онлайн",
        # --- Нові рядки: bpo-ksiegowe ---
        'Outsourcing księgowości pozwala na znaczne obniżenie kosztów operacyjnych. Możemy dostarczyć wysokiej jakości usługi księgowe, eliminując potrzebę zatrudniania wewnętrznych ekspertów. Dzięki nowoczesnej technologii i dużej skali obsługiwanych przez nas operacji oszczędności sięgają 20-30% lub więcej w porównaniu do prowadzenia księgowości wewnętrznie. Dzięki digitalizacji obiegu dokumentów oraz sprawnym procesom możemy dostarczać raporty w czasie rzeczywistym.':
            'Аутсорсинг бухгалтерії дозволяє значно знизити операційні витрати. Ми можемо надавати високоякісні бухгалтерські послуги, виключаючи потребу у найманні внутрішніх фахівців. Завдяки сучасним технологіям і великому масштабу операцій, що ми ведемо, економія сягає 20–30% і більше порівняно з веденням бухгалтерії власними силами. Завдяки оцифруванню документообігу та ефективним процесам ми можемо надавати звіти в режимі реального часу.',
        "Prowadzenie ksiąg rachunkowych\n\nObliczanie podatków i składanie deklaracji podatkowych\n\nBieżące rozliczanie wyciągów i kontrolowanie rozrachunków\n\nRaportowanie zarządcze i sprawozdawcze\n\nRaportowanie do instytucji publicznoprawnych, w tym NBP, GUS, INTRASTAT\n\nSporządzanie sprawozdań finansowych oraz deklaracji rocznych\n\nReprezentowanie podczas kontroli i czynności sprawdzających\n\nObsługa niestandardowych rozliczeń, w tym VAT OSS, CIT Estoński, SSE, VAT marża, itp.\n\nAsystowanie i wsparcie podczas audytu sprawozdania finansowego":
            "Ведення бухгалтерських книг\n\nОбчислення податків та подання податкових декларацій\n\nПоточне узгодження виписок та контроль розрахунків\n\nУправлінська та фінансова звітність\n\nЗвітність перед публічно-правовими установами, зокрема NBP, GUS, INTRASTAT\n\nСкладання фінансових звітів та річних декларацій\n\nПредставництво під час перевірок та ревізійних дій\n\nОбробка нестандартних розрахунків, зокрема VAT OSS, Estonian CIT, SEZ, маржинальний VAT тощо\n\nДопомога та підтримка під час аудиту фінансових звітів",
        # --- Нові рядки: bpo-model ---
        'Model współpracy':
            'Модель співпраці',
        "Możesz powierzyć nam całość procesów księgowych lub wybrane obszary wymagające uporządkowania.\nDopasowujemy zakres wsparcia do realnej sytuacji Twojej firmy.":
            "Ви можете довірити нам усі бухгалтерські процеси або окремі ділянки, що потребують впорядкування.\nМи адаптуємо обсяг підтримки до реальної ситуації у вашій компанії.",
        'Kompleksowa obsługa':
            'Комплексне обслуговування',
        'Obsługujemy proces end-to-end: od bieżącej ewidencji po zamknięcie miesiąca i raporty. Pracujesz z zespołem, który zapewnia zastępowalność i stały standard.':
            'Ми ведемо процес від початку до кінця: від поточного обліку до закриття місяця та звітів. Ви працюєте з командою, яка забезпечує взаємозамінність та постійний стандарт.',
        "Outsourcing wybranych\nprocesów":
            "Аутсорсинг окремих\nпроцесів",
        'Przejmujemy konkretne procesy i dowozimy je w ustalonym standardzie i harmonogramie. To rozwiązanie dla firm, które chcą wzmocnić wewnętrzny dział finansów bez rozbudowy etatów.':
            'Ми беремо на себе конкретні процеси і виконуємо їх на погодженому стандарті та графіку. Це рішення для компаній, які хочуть зміцнити внутрішній фінансовий відділ без розширення штату.',
        # --- Нові рядки: bpo-wspolpraca ---
        'Jak wygląda bieżąca współpraca':
            'Як виглядає поточна співпраця',
        'Poznaj więcej historii':
            'Дізнайтесь більше історій',
        'Indywidualna organizacja pracy':
            'Індивідуальна організація роботи',
        'W zależności od potrzeb możemy pracować:':
            'Залежно від потреб ми можемо працювати:',
        'na bieżąco – obsługując codzienne procesy księgowe lub kadrowe':
            'на постійній основі — обслуговуючи щоденні бухгалтерські або кадрові процеси',
        'w cyklach tygodniowych':
            'у тижневих циклах',
        'w innych ustalonych odstępach czasu':
            'в інших погоджених проміжках часу',
        'Elastyczne zamknięcie miesiąca':
            'Гнучке закриття місяця',
        'Terminy zamknięcia miesiąca ustalamy indywidualnie z każdą firmą, uwzględniając jej wewnętrzne potrzeby raportowe oraz obowiązujące terminy podatkowe.':
            'Терміни закриття місяця встановлюються індивідуально з кожною компанією з урахуванням її внутрішніх потреб у звітності та чинних податкових термінів.',
        'część firm potrzebuje raportów finansowych do 20. dnia miesiąca':
            'деяким компаніям потрібні фінансові звіти до 20-го числа місяця',
        'inne wymagają wyników już w 3. lub 4. dniu roboczym nowego miesiąca':
            'інші вимагають результатів вже на 3-й або 4-й робочий день нового місяця',
        'Zakres i częstotliwość raportowania ustalamy indywidualnie z każdym klientem.':
            'Обсяг і частота звітності встановлюються індивідуально з кожним клієнтом.',
        'W standardzie klient otrzymuje:':
            'У стандартному пакеті клієнт отримує:',
        'rachunek zysków i strat':
            'звіт про прибутки та збитки',
        'bilans':
            'баланс',
        'zestawienie należności i zobowiązań':
            'відомість дебіторської та кредиторської заборгованості',
        # --- Нові рядки: bpo-cyfrowa ---
        'Umów się na konsultacje':
            'Запишіться на консультацію',
        # --- Нові рядки: kupimy ---
        'Myślisz o sprzedaży swojego biura rachunkowego?':
            'Думаєте про продаж вашого бухгалтерського бюро?',
        'Oferujemy dwa modele współpracy: całkowitą sprzedaż biura rachunkowego albo partnerstwo kapitałowe z zachowaniem operacyjnej autonomii.':
            'Ми пропонуємо дві моделі співпраці: повний продаж бухгалтерського бюро або капітальне партнерство зі збереженням операційної автономії.',
        'Właściciele biur rachunkowych zgłaszają się do nas z różnymi potrzebami. Jedni chcą całkowicie wyjść z biznesu i sprzedać firmę, inni szukają partnera, który pomoże im dalej rozwijać biuro. W Meritoros rozmawiamy o obu scenariuszach.':
            'Власники бухгалтерських бюро звертаються до нас з різними потребами. Одні хочуть повністю вийти з бізнесу і продати фірму, інші шукають партнера, який допоможе їм далі розвивати бюро. У Meritoros ми обговорюємо обидва сценарії.',
        'Kupimy biuro rachunkowe':
            'Купимо бухгалтерське бюро',
        'Porozmawiajmy o możliwym modelu współpracy':
            'Поговоримо про можливу модель співпраці',
        'Całkowita sprzedaż biura':
            'Повний продаж бюро',
        'Jeśli planujesz wycofanie się z prowadzenia firmy, możemy rozmawiać o przejęciu całego przedsiębiorstwa — z uwzględnieniem klientów, zespołu i ciągłości działania.':
            'Якщо ви плануєте вийти з ведення бізнесу, ми можемо обговорити придбання всього підприємства — з урахуванням клієнтів, команди та безперервності діяльності.',
        'Sprzedaż części udziałów':
            'Продаж частки',
        'Jeśli chcesz dalej prowadzić biuro, ale jednocześnie zyskać wsparcie większej organizacji, możemy rozmawiać o modelu partnerskim z częściowym wejściem kapitałowym Meritoros.':
            'Якщо ви хочете продовжувати вести бюро, але водночас отримати підтримку більшої організації, ми можемо обговорити партнерську модель з частковим капітальним входженням Meritoros.',
        'Od czego zależy wycena biura rachunkowego?':
            'Від чого залежить оцінка бухгалтерського бюро?',
        'Wartość biura rachunkowego nie zależy wyłącznie od przychodów. Znaczenie mają także m.in. struktura klientów, rentowność, organizacja procesów, używane systemy, stabilność zespołu oraz stopień zależności firmy od właściciela. Dlatego każdą rozmowę zaczynamy od zrozumienia realnej sytuacji biznesu.':
            'Вартість бухгалтерського бюро залежить не лише від доходів. Важливу роль відіграють також структура клієнтів, рентабельність, організація процесів, використовувані системи, стабільність команди та ступінь залежності фірми від власника. Тому кожну розмову ми починаємо з розуміння реального стану бізнесу.',
        'Na wycenę wpływają m.in.:':
            'На оцінку впливають, зокрема:',
        "poziom i powtarzalność przychodów,\n\nrentowność biura,\n\nstruktura klientów i ryzyko koncentracji,\n\norganizacja pracy, technologia i stopień poukładania procesów.":
            "рівень і повторюваність доходів,\n\nрентабельність бюро,\n\nструктура клієнтів і ризик концентрації,\n\nорганізація роботи, технологія та ступінь зрілості процесів.",
        'W przypadku modelu partnerskiego':
            'У випадку партнерської моделі',
        'Model partnerski kierujemy przede wszystkim do biur, które:':
            'Партнерська модель орієнтована перш за все на бюро, які:',
        'mają obrót roczny <strong>powyżej 3 mln zł</strong>,':
            'мають річний оборот <strong>понад 3 млн злотих</strong>,',
        'pracują na systemach innych niż <strong>Optima</strong>, np. Enova, Symfonia,':
            'працюють на системах, відмінних від <strong>Optima</strong>, наприклад Enova, Symfonia,',
        'chcą dalej rozwijać firmę, ale zyskać dostęp do większego zaplecza,':
            'хочуть і далі розвивати компанію, але отримати доступ до більших ресурсів,',
        'szukają wsparcia <strong>w obszarze technologii</strong>, procesów, HR, marketingu i rozwoju operacyjnego.':
            'шукають підтримки <strong>у сфері технологій</strong>, процесів, HR, маркетингу та операційного розвитку.',
        'Co zyskujesz jako Partner Meritoros?':
            'Що ви отримуєте як Партнер Meritoros?',
        "dostęp do automatyzacji i robotyzacji procesów\n\nwsparcie w digitalizacji i porządkowaniu operacji\n\ndostęp do wiedzy ekspertów i partnerów merytorycznych\n\nwsparcie HR i rekrutacyjne\n\nwsparcie marketingowe i sprzedażowe,\n\nwewnętrzne standardy jakości i audytu\n\nmożliwość dalszego rozwoju w strukturach większej organizacji":
            "доступ до автоматизації та роботизації процесів\n\nпідтримка в оцифровуванні та впорядкуванні операцій\n\nдоступ до знань експертів і предметних партнерів\n\nпідтримка HR та рекрутинг\n\nмаркетингова та збутова підтримка\n\nвнутрішні стандарти якості та аудиту\n\nможливість подальшого розвитку в структурах більшої організації",
        'Kalkulator orientacyjnej wyceny biura rachunkowego':
            'Орієнтовний калькулятор оцінки бухгалтерського бюро',
        'Sprawdź wycenę':
            'Перевірити оцінку',
        'Spełniasz wszystkie kryteria?':
            'Чи відповідаєте ви всім критеріям?',
        'Warto się odezwać — chętnie sprawdzimy, czy widzimy przestrzeń do współpracy.':
            "Варто зв'язатися — ми з радістю перевіримо, чи бачимо ми простір для співпраці.",
        'Umów się na rozmowę':
            'Запишіться на розмову',
        'Obecnie najczęściej rozmawiamy z biurami, które spełniają poniższe kryteria:':
            'Зараз ми найчастіше спілкуємось з бюро, що відповідають таким критеріям:',
        'Przejmujemy całość lub wybrane obszary, które wymagają uporządkowania i stałego nadzoru.':
            'Ми беремо на себе всі або вибрані ділянки, які потребують впорядкування та постійного контролю.',
        "obrót roczny: od ok. 1,2 mln zł\n\noprogramowanie: Comarch Optima,\n\npreferowane lokalizacje: Warszawa, Kraków, Wrocław, Łódź, Górny Śląsk, Rzeszów,\n\nw przypadku większych podmiotów analizujemy także inne lokalizacje.":
            "річний оборот: від прибл. 1,2 млн злотих\n\nпрограмне забезпечення: Comarch Optima,\n\nпріоритетні локації: Варшава, Краків, Вроцлав, Лодзь, Верхня Сілезія, Жешув,\n\nдля більших суб'єктів ми також аналізуємо інші локації.",
        'Spełniasz powyższe kryteria?':
            'Чи відповідаєте ви вказаним критеріям?',
        'Nie spełniasz wszystkich kryteriów?':
            'Не відповідаєте всім критеріям?',
        'Jak wygląda sprzedaż biura rachunkowego w praktyce?':
            'Як виглядає продаж бухгалтерського бюро на практиці?',
        'Jeśli chcesz lepiej zrozumieć kulisy takiego procesu, zobacz materiał, w którym omawiamy najważniejsze kwestie związane ze sprzedażą firmy usługowej i przejęciem biura rachunkowego.':
            'Якщо ви хочете краще зрозуміти закулісся такого процесу, перегляньте матеріал, у якому ми обговорюємо найважливіші питання, пов\u2019язані з продажем сервісної компанії та придбанням бухгалтерського бюро.',
        'Pierwsza rozmowa jest niezobowiązująca. Ustalimy, jaki model ma sens i czy jest przestrzeń do współpracy.':
            'Перша розмова є необов\u2019язковою. Ми визначимо, яка модель має сенс і чи є простір для співпраці.',
        # --- Нові рядки: hk-video, media-video, ebook ---
        'Wczytaj więcej':
            'Завантажити більше',
        'Historie klientów':
            'Історії клієнтів',
        'Posłuchaj, co mówią nasi klienci':
            'Послухайте, що кажуть наші клієнти',
        'Czytaj historię':
            'Читати історію',
        'Jak z MINIMALNYM ryzykiem zacząć własny biznes? Sebastian Rafalik wspomina Meritoros.':
            'Як розпочати власний бізнес з МІНІМАЛЬНИМ ризиком? Себастьян Рафалік згадує Meritoros.',
        'Sebastian Rafalik (POL–FRA) w wywiadzie dla „Zaprojektuj Swoje Życie" mówi o tym, jak uporządkowanie księgowości i kadr z Meritoros pomogło mu odblokować skalowanie biznesu i zdjąć z siebie „wąskie gardło".':
            'Себастьян Рафалік (POL–FRA) в інтерв\'ю для «Zaprojektuj Swoje Życie» розповідає про те, як впорядкування бухгалтерії та кадрів з Meritoros допомогло йому розблокувати масштабування бізнесу і позбутися «вузького місця».',
        'Posłuchaj wywiadu':
            'Послухати інтерв\u2019ю',
        'Obejrzyj materiał':
            'Переглянути матеріал',
        'Darmowy materiał':
            'Безкоштовний матеріал',
        'Pobierz nasz darmowy Ebook':
            'Завантажте наш безкоштовний Ebook',
        'Pobierz materiał':
            'Завантажити матеріал',
        'Ebook został wysłany na podany adres e-mail!':
            'Ebook надіслано на вказану адресу електронної пошти!',
        # --- Нові рядки: fr-hero, fr-dlaczego, single ---
        'Fundacja rodzinna':
            'Сімейний фонд',
        'księgowość pod kontrolą':
            'бухгалтерія під контролем',
        'Fundacja rodzinna wymaga szczególnej staranności w obszarze księgowości i podatków. Zapewniamy rozwiązania, które chronią interes fundatorów i wspierają długoterminową strukturę majątkową.':
            'Сімейний фонд вимагає особливої ретельності у сфері бухгалтерії та податків. Ми надаємо рішення, які захищають інтереси засновників і підтримують довгострокову майнову структуру.',
        'Dlaczego Meritoros':
            'Чому Meritoros',
        'Mamy wdrożone procedury kontroli jakości i weryfikacji danych. Dostarczamy informacje finansowe kompletne, spójne i użyteczne dla zarządu.':
            'Ми впровадили процедури контролю якості та перевірки даних. Надаємо фінансову інформацію, яка є повною, узгодженою та корисною для керівництва.',
        'Ponad 170 ekspertów':
            'Понад 170 експертів',
        'Jakość potwierdzona standardami. Mamy wdrożone procedury kontroli jakości i weryfikacji danych. Dostarczamy informacje finansowe kompletne, spójne i użyteczne dla zarządu.':
            'Якість, підтверджена стандартами. Ми впровадили процедури контролю якості та перевірки даних. Надаємо фінансову інформацію, яка є повною, узгодженою та корисною для керівництва.',
        'Powrót do':
            'Повернутися до',
        # --- Case studies: industries, scope_title, scope_desc, video_label ---
        'Geologia inżynierska':
            'Інженерна геологія',
        'Ochrona środowiska':
            'Охорона навколишнього середовища',
        'Usługi rachunkowe, obszar kadr i płac, wsparcie w audytach':
            'Бухгалтерські послуги, сфера кадрів і зарплат, підтримка аудитів',
        'Po kilku zmianach głównej księgowej spółka potrzebowała szybkiego uporządkowania księgowości i bezpiecznego zamknięcia roku obrotowego. Wdrożyliśmy usprawnienia procesowe.':
            'Після кількох змін головного бухгалтера компанія потребувала швидкого впорядкування бухгалтерії та безпечного закриття фінансового року. Ми впровадили процесові вдосконалення.',
        'Nasz wpływ na operacje HPC':
            'Наш вплив на операції HPC',
        'Technologia druku':
            'Технологія друку',
        'E-commerce B2B':
            'E-commerce B2B',
        'Pełna obsługa BPO, rozliczenia międzynarodowe VAT OSS':
            'Повне обслуговування BPO, міжнародні розрахунки VAT OSS',
        'Przy dynamicznym wzroście sprzedaży cross-border firma potrzebowała partnera gotowego na złożone rozliczenia VAT OSS w wielu krajach UE. Przejęliśmy całość obsługi finansowej.':
            'При динамічному зростанні крос-бордерних продажів компанія потребувала партнера, готового до складних розрахунків VAT OSS у багатьох країнах ЄС. Ми перебрали на себе все фінансове обслуговування.',
        'Jak Printbox skaluje finanse globalnie':
            'Як Printbox масштабує фінанси глобально',
        'Budownictwo':
            'Будівництво',
        'Inżynieria':
            'Інженерія',
        'Kadry, płace, Intrastat, rozliczenia delegacji zagranicznych':
            'Кадри, зарплати, Intrastat, розрахунки закордонних відряджень',
        'Firma realizowała kontrakty w kilku krajach jednocześnie. Meritoros przejął obsługę kadrową i rozliczenia Intrastat, odciążając zarząd od złożoności administracyjnej.':
            'Компанія виконувала контракти одночасно в кількох країнах. Meritoros перебрав кадрове обслуговування та розрахунки Intrastat, звільнивши керівництво від адміністративної складності.',
        'Obsługa kadrowa na skalę międzynarodową':
            'Кадрове обслуговування в міжнародному масштабі',
        'Produkcja przemysłowa':
            'Промислове виробництво',
        'Eksport':
            'Експорт',
        'Pełna księgowość, fundacja rodzinna, compliance':
            'Повна бухгалтерія, сімейний фонд, комплаєнс',
        'Właściciel grupy produkcyjnej chciał oddzielić majątek prywatny od firmowego poprzez fundację rodzinną. Meritoros poprowadził cały proces prawno-księgowy od podstaw.':
            'Власник виробничої групи хотів відокремити приватне майно від корпоративного через сімейний фонд. Meritoros провів весь юридично-бухгалтерський процес з нуля.',
        'Fundacja rodzinna krok po kroku':
            'Сімейний фонд крок за кроком',
        # --- section-hk-logos ---
        'Zaufało nam ponad': 'Нам довіряють понад',
        'klientów': 'клієнтів',
        'Logo klienta': 'Логотип клієнта',
        # --- section-media-mowia ---
        'Mówią o nas': 'Говорять про нас',
        'Przeczytaj artykuł': 'Читати статтю',
        # --- section-hk-cta ---
        "Porozmawiajmy o rozwiązaniach\ndla Twojego biznesu": "Поговорімо про рішення\nдля вашого бізнесу",
        'Wyślij zapytanie': 'Надіслати запит',
        # --- section-wideoinstruktaze ---
        'Wideo': 'Відео',
        'Wideoinstruktaże': 'Відеоінструкції',
        'Praktyczne instruktaże wideo z zakresu księgowości, podatków i kadr.': 'Практичні відеоінструкції з бухгалтерії, податків та кадрів.',
        # --- section-ri-lista ---
        'Lista nadzorcza': 'Наглядова рада',
        'przewodnicząca rady nadzorczej': 'голова наглядової ради',
        'członek rady nadzorczej': 'член наглядової ради',
        # --- section-ri-info ---
        'O nas': 'Про нас',
        'Profil działalności': 'Профіль діяльності',
        'Skala działalności': 'Масштаб діяльності',
        'Zasięg i grupa kapitałowa': 'Охоплення та група капіталу',
        'Strategia rozwoju': 'Стратегія розвитку',
        'Początek działalności': 'Заснована',
        'Klientów': 'Клієнтів',
        'Specjalistów': 'Фахівців',
        'lokalizacji': 'локацій',
        '(ale ciągle rośniemy)': '(і ми продовжуємо зростати)',
        'Wyróżnienia są efektem tego, jak rozwijamy Meritoros: konsekwentnie i procesowo. Trzymamy standard, który ma działać w praktyce – codziennie.': 'Відзнаки є результатом того, як ми розвиваємо Meritoros: послідовно та процесно. Ми дотримуємося стандарту, який має працювати на практиці — щодня.',
        # --- section-onas-jak ---
        'Jak pracujemy?': 'Як ми працюємо?',
        'Dedykowany zespół': 'Виділена команда',
        'Każdy klient współpracuje z przypisanym zespołem specjalistów oraz Liderem odpowiedzialnym za jakość i terminowość.': 'Кожен клієнт співпрацює з виділеною командою фахівців та Лідером, відповідальним за якість і своєчасність.',
        'Podejście procesowe': 'Процесний підхід',
        'Wszystkie działania opieramy na udokumentowanych procesach z określonymi SLA, checklistami i punktami kontroli jakości — tak by każda operacja była przewidywalna i powtarzalna.': 'Усі дії ґрунтуються на задокументованих процесах із визначеними SLA, чек-листами та точками контролю якості — щоб кожна операція була передбачуваною і відтворюваною.',
        'Pełna zastępowalność': 'Повна взаємозамінність',
        'Procesy są tak zorganizowane, by urlopy i rotacja kadry nie wpływały na ciągłość obsługi. Klient zawsze ma kogoś do dyspozycji i nie odczuwa zmian personalnych.': 'Процеси організовані так, щоб відпустки та ротація персоналу не впливали на безперервність обслуговування. Клієнт завжди має когось у розпорядженні і не відчуває кадрових змін.',
        'Elastyczność współpracy': 'Гнучкість співпраці',
        'Dopasowujemy zakres, terminy raportowania i sposób komunikacji do realnych potrzeb firmy — niezależnie od jej wielkości czy etapu rozwoju.': 'Ми підлаштовуємо обсяг, строки звітування та спосіб комунікації до реальних потреб компанії — незалежно від її розміру чи етапу розвитку.',
        'Zespół Meritoros przy pracy': 'Команда Meritoros за роботою',
        # --- section-onas-kim ---
        'Kim jesteśmy': 'Хто ми',
        'Od ponad 20 lat wspieramy firmy w prowadzeniu księgowości, kadr i procesów finansowych. Pracujemy w modelu zespołowym i procesowym, z jasno określoną odpowiedzialnością, standaryzacją działań i nadzorem nad jakością. Łączymy doświadczenie z nowoczesnymi technologiami oraz automatyzacją, aby zapewnić naszym klientom rzetelne dane, bezpieczeństwo operacyjne i stabilność, której potrzebują, by rozwijać swój biznes.': 'Понад 20 років ми підтримуємо компанії у веденні бухгалтерії, кадрів та фінансових процесів. Ми працюємо в командній та процесній моделі, з чітко визначеною відповідальністю, стандартизацією дій та контролем якості. Ми поєднуємо досвід із сучасними технологіями та автоматизацією, щоб забезпечити нашим клієнтам надійні дані, операційну безпеку та стабільність, необхідну для розвитку їхнього бізнесу.',
        "Wewnętrzny\ndział IT i RPA": "Внутрішній\nвідділ IT та RPA",
        "Certyfikacja ISO\n9001 i ISO/IEC\n27001": "Сертифікація\nISO 9001\nта ISO/IEC 27001",
        "Ubezpieczenie\ndo 3 mln PLN": "Страхування\nдо 3 млн злотих",
        "Ponad 170\nexpertów na\npokładzie": "Понад 170\nфахівців\nна борту",
        "Ponad 1200\nklientów": "Понад 1200\nклієнтів",
        "7 oddziałów\nw Polsce oraz\noddziały wirtualne": "7 відділень\nв Польщі та\nвіртуальні офіси",
        # --- section-onas-mapa ---
        'Gdzie działamy': 'Де ми працюємо',
        'Posiadamy 7 oddziałów stacjonarnych w miastach Polski oraz oddziały wirtualne, dzięki czemu obsługujemy firmy niezależnie od ich lokalizacji:': 'Ми маємо 7 стаціонарних відділень у містах Польщі та віртуальні відділення, завдяки чому обслуговуємо компанії незалежно від їхнього місцезнаходження:',
        "Kraków (siedziba główna oraz 3 oddziały)\nWarszawa\nKatowice\nRzeszów\nWrocław\nŁódź\nBytom\n2 oddziały wirtualne działające w pełni online": "Краків (головний офіс та 3 відділення)\nВаршава\nКатовіце\nЖешув\nВроцлав\nЛодзь\nБитом\n2 повністю онлайн-відділення",
        'Mapa Polski z oddziałami': 'Карта Польщі з відділеннями',
        # --- section-onas-wartosci ---
        "Dlaczego Meritoros to spokój\nw Twoim biznesie?": "Чому Meritoros — це спокій\nу вашому бізнесі?",
        "Skala i ciągłość\nobsługi": "Масштаб і безперервність\nобслуговування",
        "Jakość potwierdzona\nstandardami": "Якість підтверджена\nстандартами",
        'Zespół Meritoros': 'Команда Meritoros',
        # --- section-testimonials ---
        'Opinie klientów': 'Відгуки клієнтів',
        'Sprawdź, co mówią o nas inni': 'Перегляньте, що кажуть про нас інші',
        'Mam księgowość w bezpiecznych rękach i wiem, że nie muszę się o to już martwić.': 'Моя бухгалтерія в надійних руках, і я знаю, що мені більше не потрібно про це турбуватися.',
        'HP Cepolgol S.A.': 'HP Cepolgol S.A.',
        'Meritoros dostarczył nam stabilność i pewność, w trudnych momentach zawsze mamy właściwe odpowiedzi.': 'Meritoros забезпечив нам стабільність і впевненість — у важкі моменти у нас завжди є правильні відповіді.',
        'CEO & Co-Founder, Printbox': 'CEO & Co-Founder, Printbox',
        'Profesjonalizm na każdym kroku. Polecamy Meritoros każdej firmie, która ceni sobie bezpieczeństwo i jakość obsługi.': 'Професіоналізм на кожному кроці. Рекомендуємо Meritoros кожній компанії, яка цінує безпеку та якість обслуговування.',
        'Dyrektor Finansowy, SITECH': 'Фінансовий директор, SITECH',
        'Obsługiwanych klientów': 'Клієнтів на обслуговуванні',
        'Lat na rynku': 'Років на ринку',
        'Klientów poleca nas dalej': 'Клієнтів рекомендують нас',
        'Ekspertów w zespole': 'Експертів у команді',
        # --- section-fr-zyski ---
        "Co zyskujesz, gdy księgowość\nfundacji jest poukładana": "Що ви отримуєте, коли бухгалтерія\nфонду впорядкована",
        "Bezpieczne zarządzanie\nmajątkiem": "Безпечне управління\nмайном",
        'Porządek w danych i dokumentach, jasna sprawozdawczość i kontrola nad obowiązkami.': 'Порядок у даних і документах, чітка звітність та контроль над зобов\u2019язаннями.',
        "Sukcesja na trwałych\nregułach": "Спадкування на стійких\nзасадах",
        'Przejrzyste zasady i przewidywalność – tak, aby rozwiązanie działało długoterminowo.': 'Прозорі правила та передбачуваність — щоб рішення працювало в довгостроковій перспективі.',
        "Spokój w kwestiach\nformalnych": "Спокій у формальних\nпитаннях",
        'Dopilnujemy terminów i obowiązków sprawozdawczych, żeby nic „nie wyskakiwało" w ostatniej chwili.': 'Ми подбаємо про терміни та звітні зобов\u2019язання, щоб ніщо «не виринало» в останній момент.',
        "Mniej ryzyk,\nmniej poprawek": "Менше ризиків,\nменше виправлень",
        'Praca procesowa, weryfikacja danych i standardy, które ograniczają błędy.': 'Процесна робота, перевірка даних і стандарти, що обмежують помилки.',
        # --- section-kp-dlaczego ---
        "Dlaczego firmy wybierają nasze\nrozwiązania kadrowe": "Чому компанії обирають наші\nкадрові рішення",
        'Realizujemy usługi w oparciu o certyfikat ISO 9001': 'Надаємо послуги на основі сертифіката ISO 9001',
        "Nowoczesne i elastyczne\npodejście": "Сучасний і гнучкий\nпідхід",
        'Przygotowujemy raporty finansowe dopasowane do potrzeb zarządu i wspierające podejmowanie decyzji biznesowych.': 'Ми готуємо фінансові звіти, адаптовані до потреб керівництва та що підтримують прийняття бізнес-рішень.',
        'Bezpieczeństwo danych': 'Безпека даних',
        'Stosujemy rozwiązania zgodne z normą ISO/IEC 27001, zapewniające poufność, integralność i bezpieczeństwo danych pracowniczych.': 'Ми застосовуємо рішення відповідно до стандарту ISO/IEC 27001, що забезпечують конфіденційність, цілісність та безпеку даних працівників.',
        'Business continuity': 'Business continuity',
        'Usługi realizuje cały zespół specjalistów, dlatego urlopy i rotacja pracowników nie wpływają na terminowość i ciągłość obsługi Twojej firmy.': 'Послуги надає вся команда фахівців, тому відпустки та ротація працівників не впливають на своєчасність та безперервність обслуговування вашої компанії.',
        # --- section-kp-hero ---
        'Kadry i płace, które dają': 'Кадри та зарплата, що дають',
        'spokój': 'спокій',
        'organizacji': 'організації',
        'Zapewniamy kompleksową obsługę kadrowo-płacową firm o różnej skali działalności. Przejmujemy odpowiedzialność za poprawność, terminowość i ciągłość procesów, aby organizacja mogła działać stabilnie i bez zakłóceń.': 'Ми надаємо комплексні кадрові та бухгалтерські послуги компаніям різного масштабу. Беремо на себе відповідальність за точність, своєчасність та безперервність процесів, щоб організація могла стабільно працювати без збоїв.',
        'Porozmawiajmy': 'Поговоримо',
        # --- section-kp-obsluga ---
        'Twoje kadry': 'Ваші кадри',
        'i płace': 'та зарплата',
        'pod kontrolą': 'під контролем',
        'Oferujemy pełną obsługę kadrowo-płacową przedsiębiorstw – od prowadzenia dokumentacji pracowniczej po naliczanie wynagrodzeń i rozliczenia z instytucjami publicznymi. Klienci mogą powierzyć nam całość procesów kadrowych i płacowych lub wybrane obszary wymagające wsparcia.': 'Ми пропонуємо повне кадрове та бухгалтерське обслуговування підприємств — від ведення кадрової документації до нарахування заробітної плати та розрахунків з державними установами. Клієнти можуть довірити нам усі кадрові та бухгалтерські процеси або окремі ділянки, що потребують підтримки.',
        'Zakres współpracy dopasowujemy do wielkości i struktury organizacji.': 'Обсяг співпраці ми адаптуємо до розміру та структури організації.',
        'Oszacuj wstępną wycenę': 'Отримати попередню оцінку',
        # --- section-kp-cta ---
        'Porozmawiajmy o obsłudze kadrowej dla Twojej firmy': 'Поговоримо про кадрове обслуговування вашої компанії',
        'Skontaktuj się z nami i dowiedz się, jak możemy wesprzeć Twój dział HR i płac.': "Зв'яжіться з нами і дізнайтеся, як ми можемо підтримати ваш відділ кадрів та розрахунків.",
        # --- section-kp-kalkulator ---
        'Kalkulator – oszacuj wstępnie koszt obsługi': 'Калькулятор — попередня оцінка вартості обслуговування',
        'Oszacuj wstępny koszt obsługi kadrowo-płacowej w kilka chwil. Wprowadź podstawowe informacje o swojej działalności, a my przygotujemy orientacyjną wycenę dopasowaną do Twoich potrzeb i skali zatrudnienia.': 'Оцініть попередню вартість кадрово-бухгалтерського обслуговування за кілька хвилин. Введіть основну інформацію про вашу діяльність, і ми підготуємо орієнтовний кошторис, адаптований до ваших потреб та масштабу зайнятості.',
        '* to jest wstępny szacunek, każda oferta jest jednak indywidualnie rozpatrywana i odpowiednio wyceniana.': '* це попередній кошторис; кожна пропозиція розглядається індивідуально і відповідно оцінюється.',
        # --- section-kp-wspolpraca ---
        'na bieżąco – obsługując codzienne procesy kadrowe i płacowe': 'на постійній основі — обслуговуючи щоденні кадрові та бухгалтерські процеси',
        'Terminowe naliczanie wynagrodzeń': 'Своєчасне нарахування заробітної плати',
        'Terminy przetwarzania listy płac ustalamy indywidualnie z każdą firmą, uwzględniając jej wewnętrzny harmonogram wypłat oraz terminy rozliczeń z ZUS i US.': 'Терміни обробки відомостей встановлюємо індивідуально з кожною компанією, враховуючи її внутрішній графік виплат та терміни розрахунків з ZUS і органами ДПС.',
        'listy płac gotowe z odpowiednim wyprzedzeniem przed dniem wypłaty': 'відомості готові з достатнім випередженням до дня виплати',
        'terminowe przelewy składek ZUS i zaliczek PIT': 'своєчасні перекази внесків ZUS та авансів PIT',
        'Zakres raportowania ustalamy\nindywidualnie z każdym klientem.': 'Обсяг звітності встановлюємо\nіндивідуально з кожним клієнтом.',
        'zestawienie listy płac': 'відомість зарплатної відомості',
        'paski wynagrodzeń dla pracowników': 'розрахункові листки для працівників',
        'potwierdzenia rozliczeń ZUS i US': 'підтвердження розрахунків ZUS та органів ДПС',
        'W zależności od potrzeb przygotowujemy również dodatkowe raporty kadrowe, płacowe i zarządcze.': 'Залежно від потреб ми також готуємо додаткові кадрові, бухгалтерські та управлінські звіти.',
        # --- section-kp-oferta ---
        'Oferta rozwiązań kadrowych': 'Пропозиція кадрових рішень',
        'Wyceń usługę': 'Отримати кошторис',
        'Sprawdź również rozwiązania księgowe': 'Перегляньте також бухгалтерські рішення',
        'Prowadzenie dokumentacji kadrowej\n\nNaliczanie wynagrodzeń i świadczeń\n\nObsługa umów o pracę i umów cywilnoprawnych\n\nRozliczenia z ZUS i instytucjami publicznymi\n\nSporządzanie deklaracji podatkowych\n\nKontrolowanie limitów urlopowych, terminów badań lekarskich, szkoleń BHP oraz wygasających umów\n\nReprezentowanie podczas kontroli i czynności sprawdzających\n\nZarządzanie programami PPK i PPE\n\nPlatforma pracownicza z dostępem do wniosków urlopowych i dokumentów online': 'Ведення кадрової документації\n\nНарахування заробітної плати та пільг\n\nОбробка трудових та цивільно-правових договорів\n\nРозрахунки з ZUS та державними установами\n\nПідготовка податкових декларацій\n\nКонтроль лімітів відпусток, термінів медоглядів, охорони праці та закінчення договорів\n\nПредставництво під час перевірок та ревізійних дій\n\nУправління програмами PPK та PPE\n\nПлатформа для співробітників з доступом до заяв на відпустку та документів онлайн',
        # --- section-kp-systemy ---
        "Obsługa wielu systemów\nksiągowych": "Підтримка багатьох\nbухгалтерських систем",
        # --- section-hk-hero ---
        'Historie klientów': 'Історії клієнтів',
        'Konkretne przypadki. Konkretny efekt. Zobacz, jak pomagamy firmom działać stabilnie i bezpiecznie.': 'Конкретні випадки. Конкретний результат. Подивіться, як ми допомагаємо компаніям працювати стабільно та безпечно.',
        'Poznaj historie': 'Ознайомтеся з історіями',
        # --- section-hk-wspolpraca ---
        'Współpraca, która': 'Співпраця, яка',
        'daje spokój operacyjny': 'дає операційний спокій',
        'W Meritoros pracujemy tak, aby odciążyć zespół klienta i zapewnić ciągłość obsługi. Działamy elastycznie, dopasowując model współpracy do realiów organizacji, ale trzymamy stały standard jakości, terminowości i bezpieczeństwa danych.': 'У Meritoros ми працюємо так, щоб розвантажити команду клієнта та забезпечити безперервність обслуговування. Ми діємо гнучко, адаптуючи модель співпраці до реалій організації, але підтримуємо постійний стандарт якості, своєчасності та безпеки даних.',
        'Dzięki temu klienci mogą skupić się na biznesie, a nie na „gaszeniu tematów" w księgowości czy kadrach': 'Завдяки цьому клієнти можуть зосередитися на бізнесі, а не на «гасінні пожеж» у бухгалтерії чи кадрах',
        # --- section-fr-model ---
        "Możesz powierzyć nam całość procesów księgowych lub wybrane obszary wymagające uporządkowania.\nDopasowujemy zakres wsparcia do realnej sytuacji Twojej firmy.": "Ви можете довірити нам усі бухгалтерські процеси або окремі ділянки, що потребують впорядкування.\nМи адаптуємо обсяг підтримки до реальної ситуації у вашій компанії.",
        'Obsługujemy proces end-to-end: od bieżącej ewidencji po zamknięcie miesiąca i raporty. Pracujesz z zespołem, który zapewnia zastępowalność i stały standard.': 'Ми ведемо процес від початку до кінця: від поточного обліку до закриття місяця та звітів. Ви працюєте з командою, яка забезпечує взаємозамінність та постійний стандарт.',
        # --- section-fr-obsluga ---
        'Obsługa księgowa fundacji rodzinnej dla właścicieli myślących długoterminowo': 'Бухгалтерське обслуговування сімейного фонду для власників, які мислять довгостроково',
        'Prowadzimy księgowość fundacji rodzinnych dla przedsiębiorców, którzy chcą uporządkować kwestie majątku i sukcesji w sposób bezpieczny, transparentny i zgodny z przepisami. Bierzemy na siebie bieżącą obsługę, sprawozdawczość i kontrolę terminów, tak aby fundacja działała stabilnie.': 'Ми ведемо бухгалтерський облік сімейних фондів для підприємців, які хочуть впорядкувати питання майна та спадкування безпечно, прозоро та відповідно до законодавства. Ми беремо на себе поточне обслуговування, звітність та контроль термінів, щоб фонд працював стабільно.',
        # --- section-fr-oferta ---
        'Poznaj naszą ofertę': 'Ознайомтеся з нашою пропозицією',
        'Zapewniamy kompleksową obsługę księgową i podatkową, która porządkuje finanse fundacji i daje poczucie bezpieczeństwa jej fundatorom.': 'Ми надаємо комплексне бухгалтерське та податкове обслуговування, яке впорядковує фінанси фонду та дає відчуття безпеки його засновникам.',
        'Prowadzenie ksiąg rachunkowych\n\nRozliczanie i składanie deklaracji podatkowych\n\nPrzygotowywanie sprawozdań finansowych\n\nAsystowanie podczas badania sprawozdania finansowego oraz kontroli urzędów\n\nRaportowanie na cele zarządcze\n\nSporządzanie polityki rachunkowości': 'Ведення бухгалтерських книг\n\nОбчислення та подання податкових декларацій\n\nПідготовка фінансових звітів\n\nДопомога під час аудиту фінансових звітів та перевірок органів\n\nЗвітність для управлінських цілей\n\nСкладання облікової політики',
        # --- section-media-artykul ---
        'Maciej Paraszczak dla Pulsu Biznesu': 'Мачей Парасщак для Puls Biznesu',
        'Dla wielu naszych klientów jesteśmy nie tylko biurem rachunkowym, ale partnerem operacyjnym, który realnie usprawnia ich procesy biznesowe – podkreśla z Maciej Paraszczak, prezes zarządu spółki Meritoros.': 'Для багатьох наших клієнтів ми є не просто бухгалтерським бюро, а операційним партнером, який реально покращує їхні бізнес-процеси — підкреслює Мачей Парасщак, президент правління Meritoros.',
        'Wywiad z Maciejem Paraszczakiem dla Pulsu Biznesu o tym, jak wygląda nowoczesna księgowość w praktyce i dlaczego standard oraz procesy mają dziś kluczowe znaczenie.': 'Інтерв\u2019ю з Мачеєм Парасщаком для Puls Biznesu про те, як виглядає сучасна бухгалтерія на практиці і чому стандарти та процеси мають сьогодні ключове значення.',
        'Czytaj więcej': 'Читати більше',
        # --- section-media-hero ---
        'Media i informacje firmowe': 'Медіа та корпоративні новини',
        'Najważniejsze wydarzenia z życia firmy: rozwój, nowe inicjatywy, wyróżnienia i ogłoszenia.': 'Найважливіші події з життя компанії: розвиток, нові ініціативи, відзнаки та оголошення.',
        # --- section-media-przeczytaj ---
        'Przeczytaj również': 'Читайте також',
        # --- section-media-zapytania ---
        'Zapytania medialne': 'Медіа-запити',
        'W sprawach publikacji, komentarzy eksperckich i współpracy medialnej prosimy o kontakt. Odpowiemy możliwie szybko i wrócimy z informacją, w jakiej formie możemy pomóc.': 'У питаннях публікацій, експертних коментарів та медіаспівпраці просимо звертатися. Відповімо якнайшвидше та повернемося з інформацією, у якій формі можемо допомогти.',
        # --- section-onas-hero ---
        'Poznaj nasze biuro rachunkowe i wartości, które stoją za naszą codzienną pasją.': 'Ознайомтеся з нашим бухгалтерським бюро та цінностями, які лежать в основі нашої щоденної пристрасті.',
        'Pracujemy tak, by być dumni z jakości informacji dostarczanych naszym klientom.': 'Ми працюємо так, щоб пишатися якістю інформації, яку надаємо нашим клієнтам.',
        'Porozmawiamy': 'Поговоримо',
        # --- section-onas-zespol ---
        'Zespół': 'Команда',
        'prezes zarządu, CEO': 'президент правління, CEO',
        'Założyciel i główny udziałowiec Meritoros SA, certyfikowany księgowy (Certyfikat Min. Finansów nr 1840/2003). Absolwent kierunku Zarządzanie ze specjalnością Finanse i Rachunkowość.': 'Засновник та головний акціонер Meritoros SA, сертифікований бухгалтер (Сертифікат Міністерства фінансів № 1840/2003). Випускник спеціальності Управління зі спеціалізацією «Фінанси та бухгалтерський облік».',
        'członek zarządu, COO': 'член правління, COO',
        'Udziałowiec Meritoros SA, certyfikowana księgowa (Certyfikat Min. Finansów nr 54055/2011). Absolwentka kierunku Zarządzania na AGH, swoje wykształcenie uzupełniła o studia podyplomowe.': 'Акціонер Meritoros SA, сертифікована бухгалтер (Сертифікат Міністерства фінансів № 54055/2011). Випускниця спеціальності Управління в AGH, доповнила освіту аспірантськими студіями.',
        'Udziałowiec Meritoros SA, certyfikowany księgowy (Certyfikat Min. Finansów nr 62092/2013). Absolwent kierunku Finansów i Rachunkowości na UEK ze specjalnością finanse przedsiębiorstw.': 'Акціонер Meritoros SA, сертифікований бухгалтер (Сертифікат Міністерства фінансів № 62092/2013). Випускник спеціальності Фінанси та бухгалтерський облік в UEK зі спеціалізацією «Корпоративні фінанси».',
        'Księgowa (Certyfikat Min. Finansów 55068/2012) z wieloletnim doświadczeniem. Swoją karierę budowała w Biurach Rachunkowych oraz jako główna księgowa w jednej z międzynarodowych firm.': 'Бухгалтер (Сертифікат Міністерства фінансів 55068/2012) з багаторічним досвідом. Свою кар\u2019єру будувала в бухгалтерських бюро та як головний бухгалтер в одній з міжнародних компаній.',
        # --- section-ri-akcjonariat ---
        'Informacje o strukturze akcjonariatu': 'Інформація про структуру акціонерного капіталу',
        'Kapitał zakładowy spółki wynosi 120 000 PLN i dzieli się na 1 200 000 akcji serii A o wartości nominalnej 0,10 PLN.': 'Статутний капітал товариства становить 120 000 злотих і поділяється на 1 200 000 акцій серії A номінальною вартістю 0,10 злотих.',
        'Akcjonariusz': 'Акціонер',
        'Łączna liczba posiadanych akcji': 'Загальна кількість акцій',
        'Udział w łącznej liczbie głosów': 'Частка в загальній кількості голосів',
        # --- section-ri-hero ---
        'Relacje inwestorskie': 'Відносини з інвесторами',
        'Poniżej udostępniamy kluczowe informacje i dokumenty dotyczące Meritoros SA, w tym sprawozdania finansowe i raporty okresowe.': 'Нижче ми розміщуємо ключову інформацію та документи щодо Meritoros SA, включаючи фінансові звіти та періодичні звіти.',
        # --- section-ri-msg ---
        'Ogłoszenia w Monitorze Sądowym i Gospodarczym': 'Оголошення в Судово-господарському моніторі',
        # --- section-ri-ogloszenia ---
        'Ogłoszenia o zwołaniu Walnego Zgromadzenia Akcjonariuszy': 'Повідомлення про скликання Загальних зборів акціонерів',
        # --- section-ri-rada ---
        'Rada nadzorcza': 'Наглядова рада',
        'doradca podatkowy (certyfikat nr 00443)\nbył członek zarządu Małopolskiej Izby Doradców Podatkowych': 'податковий радник (сертифікат № 00443)\nколишній член правління Малопольської палати податкових радників',
        'przedsiębiorca\nprezes zarządu Emka Sp. z o.o.': 'підприємець\nпрезидент правління Emka Sp. z o.o.',
        'przedsiębiorca\nczłonek zarządu Chata Sp. z o.o.': 'підприємець\nчлен правління Chata Sp. z o.o.',
        'przedsiębiorca\nwiceprezes zarządu Office Samurai Sp. z o.o.': 'підприємець\nвіце-президент правління Office Samurai Sp. z o.o.',
        'przedsiębiorca\nprezes zarządu Printbox Sp. z o.o.': 'підприємець\nпрезидент правління Printbox Sp. z o.o.',
        # --- section-ri-raporty ---
        'Raporty kwartalne spółki': 'Квартальні звіти товариства',
        'Raporty EBI/ESPI': 'Звіти EBI/ESPI',
        'Animator Rynku': 'Маркет-мейкер',
        'Autoryzowany Doradca': 'Авторизований радник',
        'Pytania i odpowiedzi': 'Запитання та відповіді',
        # --- section-ri-rewident ---
        'Opinie biegłego rewidenta': 'Висновки аудитора',
        # --- section-ri-rosniemy ---
        'Rośniemy': 'Ми зростаємо',
        'Rozwój Meritoros SA znajduje odzwierciedlenie w systematycznym wzroście skali działalności i przychodów na przestrzeni ostatnich lat.': 'Розвиток Meritoros SA відображається в систематичному зростанні масштабів діяльності та доходів протягом останніх років.',
        # --- section-ri-sprawozdania ---
        'Sprawozdania finansowe spółki': 'Фінансові звіти товариства',
        # --- section-ri-sprawozdania-zarzadu ---
        'Sprawozdania z działalności zarządu spółki': 'Звіти про діяльність правління товариства',
        # --- section-ri-uchwaly ---
        'Uchwały podejmowane przez Zgromadzenie Akcjonariuszy': 'Рішення, прийняті Загальними зборами акціонерів',
        # --- section-ri-zarzad ---
        'Zarząd': 'Правління',
        # --- section-uk-cta ---
        'Skontaktuj się z nami i dowiedz się, jak możemy wesprzeć Twoją firmę.': "Зв'яжіться з нами і дізнайтеся, як ми можемо підтримати вашу компанію.",
        # --- section-uk-dlaczego ---
        "Dlaczego firmy wybierają nasze\nrozwiązania księgowe": "Чому компанії обирають наші\nбухгалтерські рішення",
        "Jakość potwierdzona\nstandardami": "Якість, підтверджена\nстандартами",
        'Pracujemy zgodnie z normą ISO 9001 — systematyczne procesy, kontrola jakości i ciągłe doskonalenie usług.': 'Ми працюємо відповідно до стандарту ISO 9001 — систематичні процеси, контроль якості та постійне вдосконалення послуг.',
        "Nowoczesne i elastyczne podejście": "Сучасний і гнучкий підхід",
        'Dopasowujemy narzędzia i zakres współpracy do realnych potrzeb Twojej firmy – bez zbędnej biurokracji.': 'Ми підбираємо інструменти та обсяг співпраці до реальних потреб вашої компанії — без зайвої бюрократії.',
        'Zespołowy model pracy gwarantuje ciągłość obsługi — urlopy i rotacja pracowników nie wpływają na jakość Twojej księgowości.': 'Командна модель роботи гарантує безперервність обслуговування — відпустки та ротація працівників не впливають на якість вашої бухгалтерії.',
        'Dane klientów chronimy zgodnie z normą ISO 27001 — wdrożone procedury, szyfrowanie i regularne audyty bezpieczeństwa.': 'Дані клієнтів ми захищаємо відповідно до стандарту ISO 27001 — впроваджені процедури, шифрування та регулярні аудити безпеки.',
        # --- section-uk-hero ---
        'Rozwiązania księgowe dla firm, które': 'Бухгалтерські рішення для компаній, які',
        'chcą mieć porządek': 'хочуть мати порядок',
        'i spokój w biznesie': 'та спокій у бізнесі',
        'Zapewniamy kompleksową obsługę księgową firm o różnej skali działalności. Przejmujemy odpowiedzialność za poprawność, terminowość i ciągłość procesów księgowych, aby nasi klienci mogli skupić się na prowadzeniu i rozwoju biznesu.': 'Ми надаємо комплексне бухгалтерське обслуговування компаніям різного масштабу. Беремо відповідальність за точність, своєчасність та безперервність бухгалтерських процесів, щоб наші клієнти могли зосередитися на веденні та розвитку бізнесу.',
        # --- section-uk-ksiegowosc ---
        'Twoja księgowość': 'Ваша бухгалтерія',
        'w': 'у',
        'dobrych rękach': 'надійних руках',
        'Oferujemy kompleksową obsługę księgową działalności i spółek zarówno w zakresie prowadzenia pełnych ksiąg rachunkowych, jak i uproszczonych form ewidencji. Klienci mogą powierzyć nam całość procesów księgowych lub wybrane obszary wymagające wsparcia.': 'Ми пропонуємо комплексне бухгалтерське обслуговування підприємців і компаній як у сфері ведення повних бухгалтерських книг, так і спрощених форм обліку. Клієнти можуть довірити нам усі бухгалтерські процеси або окремі ділянки, що потребують підтримки.',
        'Zakres współpracy dopasowujemy do skali działalności i stopnia złożoności operacji finansowych.': 'Обсяг співпраці ми адаптуємо до масштабу діяльності та ступеня складності фінансових операцій.',
        'Sprawdź jak wygląda współpraca': 'Подивіться, як виглядає співпраця',
        # --- section-uk-oferta ---
        'Oferta rozwiązań księgowych': 'Пропозиція бухгалтерських рішень',
        "Obsługujemy firmy na różnych formach rozliczeń zarówno w pełnej księgowości (spółki),\njak i w uproszczonych formach ewidencji (np. KPiR)": "Ми обслуговуємо компанії на різних формах обліку як у повній бухгалтерії (товариства),\nтак і в спрощених формах обліку (напр. книга доходів і витрат)",
        'Poniżej pokazujemy przykładowy zakres działań. Jeśli potrzebujesz innej usługi chętnie porozmawiamy.': 'Нижче ми показуємо приблизний обсяг дій. Якщо вам потрібна інша послуга, ми з радістю поговоримо.',
        'Sprawdź również rozwiązania kadrowe': 'Перегляньте також кадрові рішення',
        'Prowadzenie ksiąg rachunkowych\n\nObliczanie podatków i składanie deklaracji podatkowych\n\nBieżące rozliczanie wyciągów i kontrolowanie rozrachunków\n\nRaportowanie zarządcze i sprawozdawcze\n\nRaportowanie do instytucji publicznych\n\nSporządzanie sprawozdań finansowych oraz deklaracji rocznych\n\nReprezentowanie podczas kontroli i czynności sprawdzających\n\nObsługa niestandardowych rozliczeń\n\nAsystowanie i wsparcie podczas audytu': 'Ведення бухгалтерських книг\n\nОбчислення податків та подання податкових декларацій\n\nПоточне узгодження виписок та контроль розрахунків\n\nУправлінська та фінансова звітність\n\nЗвітність перед державними установами\n\nСкладання фінансових звітів та річних декларацій\n\nПредставництво під час перевірок та ревізійних дій\n\nОбробка нестандартних розрахунків\n\nДопомога та підтримка під час аудитів',
        # --- section-uk-wspolpraca ---
        'na bieżąco – obsługując codzienne procesy księgowe lub kadrowe': 'на постійній основі — обслуговуючи щоденні бухгалтерські або кадрові процеси',
        'Zakres i częstotliwość raportowania\nustalamy indywidualnie z każdym klientem.': 'Обсяг і частота звітності\nвстановлюються індивідуально з кожним клієнтом.',
        'W zależności od potrzeb przygotowujemy również dodatkowe raporty księgowe, finansowe lub kadrowo-płacowe.': 'Залежно від потреб ми також готуємо додаткові бухгалтерські, фінансові або кадрово-бухгалтерські звіти.',
        # --- section-uk-kalkulator ---
        'Oszacuj wstępny koszt usług księgowych w kilka chwil. Wprowadź podstawowe informacje o swojej działalności, a my przygotujemy orientacyjną wycenę dopasowaną do Twoich potrzeb i skali biznesu.': 'Оцініть попередню вартість бухгалтерських послуг за кілька хвилин. Введіть основну інформацію про вашу діяльність, і ми підготуємо орієнтовний кошторис, адаптований до ваших потреб та масштабу бізнесу.',
        # --- section-bpo-systemy ---
        "Obsługa wielu systemów\nksięgowych": "Підтримка багатьох\nбухгалтерських систем",
        # --- section-services ---
        'Nasze Kompetencje': 'Наші компетенції',
        'Obszary, w których przejmujemy odpowiedzialność': 'Сфери, в яких ми беремо відповідальність',
        'Nasze doświadczenie obejmuje rozliczanie firm o różnorodnych profilach działalności, takich jak CIT Estoński, Fundacje Rodzinne, Spółki ASI, e-commerce, VAT OSS, Intrastat oraz rozliczenia delegacji pracowniczych.': 'Наш досвід охоплює розрахунки компаній з різноманітними профілями діяльності, такими як естонський CIT, сімейні фонди, компанії ASI, e-commerce, VAT OSS, Intrastat та розрахунки відряджень працівників.',
        'Zapytaj o ofertę': 'Запитати про пропозицію',
        'Skontaktuj się z nami': 'Зв\u2019яжіться з нами',
        'Usługi Rachunkowe': 'Бухгалтерські послуги',
        'Kompleksowa obsługa księgowa firm o różnej skali działalności.': 'Комплексне бухгалтерське обслуговування компаній різного масштабу.',
        'BPO': 'BPO',
        'Outsourcing wybranych lub pełnych procesów finansowych i administracyjnych dla większych firm.': 'Аутсорсинг окремих або повних фінансових та адміністративних процесів для великих компаній.',
        'Usługi Kadrowe': 'Кадрові послуги',
        'Obsługa kadrowo-płacowa dopasowana do potrzeb organizacji.': 'Кадрово-бухгалтерське обслуговування, адаптоване до потреб організації.',
        'Fundacje rodzinne': 'Сімейні фонди',
        'Obsługa rachunkowa fundacji z uwzględnieniem specyfiki regulacyjnej.': 'Бухгалтерське обслуговування фондів з урахуванням регуляторної специфіки.',
        'Wsparcie we wdrażaniu narzędzi, automatyzacji i usprawnianiu procesów biznesowych.': 'Підтримка у впровадженні інструментів, автоматизації та оптимізації бізнес-процесів.',
        # --- section-oferta-kuk-info ---
        'Prowadzenie ksiąg rachunkowych i ewidencji podatkowych (PKPB)': 'Ведення бухгалтерських книг та податкового обліку (PKPB)',
        'Sporządzanie deklaracji i sprawozdań finansowych (CIT, VAT, PIT)': 'Складання фінансових декларацій та звітів (CIT, VAT, PIT)',
        'Przygotowywanie rocznych sprawozdań finansowych i analiz dla klientów': 'Підготовка річних фінансових звітів та аналізів для клієнтів',
        'Bezpośredni kontakt z klientami (telefon, e-mail) w sprawach rozliczeń': 'Безпосередній контакт з клієнтами (телефон, e-mail) у питаннях розрахунків',
        'Współpraca z urzędami skarbowymi, instytucjami finansowymi i podmiotami zewnętrznymi, w tym reprezentacja klientów': 'Співпраця з податковими органами, фінансовими установами та зовнішніми суб\u2019єктами, включаючи представництво клієнтів',
        'Minimum 2 lata doświadczenia w samodzielnym prowadzeniu ksiąg rachunkowych w biurze rachunkowym; certyfikat MF mile widziany': 'Мінімум 2 роки досвіду самостійного ведення бухгалтерських книг у бухгалтерському бюро; сертифікат МФ вітається',
        'Biegła znajomość języka ukraińskiego i rosyjskiego do komunikacji z klientami': 'Вільне володіння українською та російською мовами для спілкування з клієнтами',
        'Doświadczenie w samodzielnym sporządzaniu sprawozdań finansowych': 'Досвід самостійного складання фінансових звітів',
        'Praktyczna znajomość przepisów rachunkowych, prawa podatkowego i przepisów VAT': 'Практичне знання бухгалтерського законодавства, податкового права та норм VAT',
        'Biegłość w MS Office (szczególnie Excel) i oprogramowaniu księgowym Comarch Optima': 'Впевнене володіння MS Office (особливо Excel) та бухгалтерською програмою Comarch Optima',
        'Skrupulatność i wysokie zdolności organizacyjne': 'Скрупульозність та високі організаційні здібності',
        'Zdolności analitycznego myślenia': 'Здатність до аналітичного мислення',
        # --- section-kariera-hero ---
        "Dołącz do\nnaszego zespołu": "Приєднуйся до\nнашої команди",
        "Budujemy uporządkowane procesy i dobrą atmosferę.\nJeśli cenisz jasne zasady, rozwój i pracę zespołową – sprawdź,\nczy mamy ofertę dla Ciebie.": "Ми будуємо впорядковані процеси та гарну атмосферу.\nЯкщо ти цінуєш чіткі правила, розвиток і командну роботу — перевір,\nчи маємо ми пропозицію для тебе.",
        'Aktualne oferty pracy': 'Актуальні вакансії',
        # --- fr-oferta / uk-oferta full item strings ---
        "Prowadzenie ksiąg rachunkowych\n\nRozliczanie i składanie deklaracji podatkowych\n\nPrzygotowywanie sprawozdań finansowych\n\nAsystowanie podczas badania sprawozdania finansowego oraz kontroli urzędów\n\nRaportowanie na cele zarządcze\n\nSporządzanie polityki rachunkowości":
            "Ведення бухгалтерських книг\n\nРозрахунок і подання податкових декларацій\n\nПідготовка фінансових звітів\n\nАсистування під час аудиту фінансових звітів та перевірок органів\n\nЗвітність для управлінських цілей\n\nСкладання облікової політики",
        "Prowadzenie ksiąg rachunkowych\n\nObliczanie podatków i składanie deklaracji podatkowych\n\nBieżące rozliczanie wyciągów i kontrolowanie rozrachunków\n\nRaportowanie zarządcze i sprawozdawcze\n\nRaportowanie do instytucji publicznych\n\nSporządzanie sprawozdań finansowych oraz deklaracji rocznych\n\nReprezentowanie podczas kontroli i czynności sprawdzających\n\nObsługa niestandardowych rozliczeń\n\nAsystowanie i wsparcie podczas audytu":
            "Ведення бухгалтерських книг\n\nОбчислення податків та подання податкових декларацій\n\nПоточне узгодження виписок та контроль розрахунків\n\nУправлінська та фінансова звітність\n\nЗвітність перед державними установами\n\nСкладання фінансових звітів та річних декларацій\n\nПредставництво під час перевірок та ревізійних дій\n\nОбробка нестандартних розрахунків\n\nДопомога та підтримка під час аудиту",
    },
    'ru_RU': {
        'Bezpieczeństwo\ni compliance':
            'Безопасность\nи соответствие требованиям',
        'Blog':
            'Блог',
        'Błąd połączenia. Spróbuj ponownie.':
            'Ошибка соединения. Попробуйте ещё раз.',
        'Certyfikat':
            'Сертификат',
        'Dlaczego BPO z Meritoros?':
            'Почему BPO с Meritoros?',
        'Dlaczego Meritoros to spokój\nw Twoim biznesie?':
            'Почему Meritoros — это спокойствие\nв вашем бизнесе?',
        'Działamy zgodnie z normami ISO 9001 i ISO/IEC 27001. Zapewniamy poufność danych, ciągłość obsługi i pełną zgodność z obowiązującymi przepisami prawa.':
            'Мы работаем в соответствии со стандартами ISO 9001 и ISO/IEC 27001. Обеспечиваем конфиденциальность данных, непрерывность обслуживания и полное соответствие действующему законодательству.',
        'Działamy zgodnie z obowiązującymi regulacjami i standardami bezpieczeństwa danych. Dbamy o poufność informacji oraz jasne zasady współpracy - bez "skrótów" i ryzyk.':
            'Мы работаем в соответствии с действующими нормами и стандартами безопасности данных. Соблюдаем конфиденциальность информации и чёткие условия сотрудничества — без «сокращений» и рисков.',
        'Efektywność kosztowa':
            'Экономическая эффективность',
        'Elastyczność i indywidualne podejście pozwalają nam szybko dopasować się do zmieniających się potrzeb klientów i wspomóc ich na ścieżce skalowania swojej organizacji.':
            'Гибкость и индивидуальный подход позволяют нам быстро адаптироваться к изменяющимся потребностям клиентов и поддерживать их на пути масштабирования организации.',
        'Elastyczność i skalowanie\noperacji':
            'Гибкость и масштабирование\nопераций',
        'Jakość potwierdzona standardami':
            'Качество, подтверждённое стандартами',
        'Kompleksowa obsługa kadrowo-płacowa – od umów i list płac po rozliczenia z ZUS i US, z pełną zastępowalnością zespołu.':
            'Комплексное кадрово-бухгалтерское обслуживание — от договоров и ведомостей до расчётов с ZUS и налоговыми органами, с полной взаимозаменяемостью команды.',
        'Mamy wdrożone procedury kontroli jakości i weryfikacji danych. Dostarczamy spójne dane dla zarządu.':
            'Мы внедрили процедуры контроля качества и проверки данных. Предоставляем согласованные данные для руководства.',
        'Nagrody i wyróżnienia':
            'Награды и отличия',
        'Nasze Wartości':
            'Наши ценности',
        'Obszar współpracy':
            'Сфера сотрудничества',
        'Outsourcing biznesowy pozwala na znaczne obniżenie kosztów operacyjnych. Dzięki nowoczesnej technologii i dużej skali obsługiwanych przez nas operacji oszczędności sięgają 20% lub więcej w porównaniu do obsługi procesów za pomocą własnych pracowników.':
            'Аутсорсинг бизнес-процессов позволяет значительно снизить операционные затраты. Благодаря современным технологиям и большому масштабу обрабатываемых нами операций экономия достигает 20% и более по сравнению с обработкой процессов собственными сотрудниками.',
        'Pełna księgowość, raportowanie zarządcze i sprawozdawcze – terminowo i zgodnie ze standardami, bez zakłóceń operacyjnych.':
            'Полный бухгалтерский учёт, управленческая и финансовая отчётность — в срок и в соответствии со стандартами, без операционных сбоев.',
        'Podaj prawidłowy adres e-mail.':
            'Введите действительный адрес электронной почты.',
        'Porozmawiajmy o obsłudze księgowej dla Twojej firmy':
            'Поговорим о бухгалтерском обслуживании вашей компании',
        'Poznaj ofertę':
            'Узнать больше',
        'Pracujemy zespołowo i procesowo, dzięki czemu obsługa nie zależy od jednej osoby. Zapewniamy zastępowalność i ciągłość pracy – bez przestojów.':
            'Мы работаем командой по процессному подходу, поэтому обслуживание не зависит от одного человека. Обеспечиваем взаимозаменяемость и непрерывность работы — без простоев.',
        'Przekazując odpowiedzialność za pewne procesy wsparcia, Zarząd i kluczowi menedżerowie przedsiębiorstwa mogą skupić się na rozwoju rynkowym i strategicznym zarządzaniu swoim biznesem.':
            'Передавая ответственность за определённые вспомогательные процессы, Совет директоров и ключевые менеджеры могут сосредоточиться на развитии рынка и стратегическом управлении бизнесом.',
        'Pytania od kandydatów':
            'Вопросы от кандидатов',
        'Robotyzacja RPA\n\nE-teczki\n\nOptymalizacja procesów\n\nElektroniczny obieg dokumentów\n\nAutomatyzacja raportowania':
            'Роботизация RPA\n\nЭлектронные дела\n\nОптимизация процессов\n\nЭлектронный документооборот\n\nАвтоматизация отчётности',
        'Rozwiązania BPO':
            'Решения BPO',
        'Rozwiązania kadrowe':
            'Кадровые решения',
        'Rozwiązania księgowe':
            'Бухгалтерские решения',
        'Skala i ciągłość\nobsługi':
            'Масштаб и непрерывность\nобслуживания',
        'Skontaktuj się z nami i dowiedz się, jak możemy wesprzeć Twoją organizację.':
            'Свяжитесь с нами и узнайте, как мы можем поддержать вашу организацию.',
        'Systematycznie rozwijamy i wdrażamy rozwiązania z zakresu robotyki (RPA) oraz automatyzacji. Wdrażamy najnowsze technologie, w tym Robotic Process Automation oraz AI, aby umożliwić klientom pełną kontrolę nad finansami. Działamy w modelu Lean, który zapewnia sprawność operacyjną i błyskawiczne dostosowanie się do potrzeb zmieniającego się rynku.':
            'Мы систематически разрабатываем и внедряем решения в области роботизации (RPA) и автоматизации. Внедряем новейшие технологии, в том числе Robotic Process Automation и ИИ, чтобы дать клиентам полный контроль над финансами. Работаем по модели Lean, которая обеспечивает операционную эффективность и быструю адаптацию к меняющемуся рынку.',
        'Technologia\ni automatyzacja':
            'Технологии\nи автоматизация',
        'Transformacja Cyfrowa':
            'Цифровая трансформация',
        'Transformacja cyfrowa':
            'Цифровая трансформация',
        'Uwolnienie czasu\ni usprawnienie procesów':
            'Высвобождение времени\nи оптимизация процессов',
        'Wdrożenie RPA, e-teczek i elektronicznego obiegu dokumentów – automatyzujemy procesy, żeby organizacja działała sprawniej.':
            'Внедрение RPA, электронных дел и электронного документооборота — автоматизируем процессы, чтобы организация работала эффективнее.',
        'Wiedza i aktualności':
            'Знания и новости',
        'Współpracuj z profesjonalistami':
            'Сотрудничай с профессионалами',
        'Wszystkie wpisy':
            'Все записи',
        'Wykorzystujemy narzędzia i automatyzację (RPA), które porządkują obieg dokumentów, ograniczają ryzyko błędów i usprawniają pracę zespołów.':
            'Мы используем инструменты и автоматизацию (RPA), которые упорядочивают документооборот, снижают риск ошибок и повышают эффективность команд.',
        'Wyróżnienia są efektem tego, jak rozwijamy Meritoros: konsekwentnie i procesowo. Trzymamy standard, który ma działać w praktyce - codziennie.':
            'Награды — результат того, как мы развиваем Meritoros: последовательно и с процессным подходом. Мы поддерживаем стандарт, который должен работать на практике — каждый день.',
        'Wystąpił błąd. Spróbuj ponownie.':
            'Произошла ошибка. Попробуйте ещё раз.',
        'Zapewniamy kompleksową obsługę kadrowo-płacową firm o różnej skali działalności. Przejmujemy odpowiedzialność za poprawność, terminowość i ciągłość procesów, aby organizacja mogła działać stabilnie i bez zakłóceń.':
            'Мы предоставляем комплексные кадровые и бухгалтерские услуги компаниям различного масштаба. Берём на себя ответственность за точность, своевременность и непрерывность процессов, чтобы организация могла стабильно работать без сбоев.',
        'Zaufało nam ponad 1200 klientów':
            'Нам доверяют более 1200 клиентов',
        'dla większych organizacji':
            'для крупных организаций',
        'bez stresu':
            'без стресса',
        'Chcesz do nas dołączyć?\nZostaw swoje CV':
            'Хотите присоединиться к нам?\nОставьте своё резюме',
        'Ciągły Rozwój jest wpisany\nw nasze DNA':
            'Непрерывное развитие заложено\nв нашей ДНК',
        'Dołącz do grona naszych\nklientów i rozwijaj biznes':
            'Присоединяйтесь к нашим клиентам\nи развивайте бизнес',
        'Elastyczność dopasowana\ndo Twojego stylu pracy':
            'Гибкость, подстроенная\nпод ваш стиль работы',
        'Informacje':
            'Информация',
        'Menu':
            'Меню',
        'Menu główne':
            'Главное меню',
        'Menu stopki':
            'Меню подвала',
        'Miasta w których\nmamy oddziały':
            'Города, где\nу нас есть офисы',
        'Nasi specjaliści są do dyspozycji w godzinach pracy biura.\nOdpowiemy na wszystkie Twoje pytania.':
            'Наши специалисты доступны в рабочее время.\nМы ответим на все ваши вопросы.',
        'Oddaj księgowość\nw ręce ekspertów':
            'Передайте бухгалтерию\nв руки экспертов',
        'Oddziały\nWirtualne':
            'Виртуальные\nофисы',
        'Otwórz menu':
            'Открыть меню',
        'Polityka prywatności':
            'Политика конфиденциальности',
        'Praca w zgranym\nzespole specjalistów':
            'Работа в сплочённой\nкоманде специалистов',
        'Profesjonalne biuro rachunkowe i BPO dla firm z ambicjami.':
            'Профессиональное бухгалтерское бюро и BPO для компаний с амбициями.',
        'Projekt i realizacja:':
            'Дизайн и разработка:',
        'Regulamin newslettera':
            'Условия рассылки',
        'Skup biur rachunkowych':
            'Приобретение бухгалтерских фирм',
        'Stabilne zatrudnienie\ni jasne zasady':
            'Стабильная занятость\nи чёткие правила',
        'Usługi':
            'Услуги',
        'Zacznij teraz':
            'Начать',
        'Zamknij menu':
            'Закрыть меню',
        # --- Новые строки: hero, case-studies, buyout ---
        'Eksperci w księgowości.\nTechnologia i pewność\nw działaniu.':
            'Эксперты в бухгалтерии.\nТехнологии и уверенность\nв действии.',
        'Zapewniamy księgowość kadry i outsourcing procesów w standardzie, który daje firmom spokój i bezpieczeństwo.':
            'Мы предоставляем бухгалтерские, кадровые услуги и аутсорсинг процессов на уровне, который обеспечивает компаниям спокойствие и безопасность.',
        'Zaufało nam ponad <span class="text-white">1200 klientów</span>':
            'Нам доверяют более <span class="text-white">1200 клиентов</span>',
        'Wideo ogólne':
            'Общее видео',
        'Wideo ogólne Meritoros':
            'Общее видео Meritoros',
        'Obejrzyj ogólne wideo':
            'Посмотреть общее видео',
        'Nasi klienci cenią nas za to, że dowozimy: jakość, terminowość i spójne dane. Jako partner w obszarze księgowości przejmujemy obszary, za które odpowiadamy, i pracujemy w standardzie, który daje spokój w codziennym prowadzeniu firmy.':
            'Наши клиенты ценят нас за то, что мы доставляем: качество, своевременность и согласованные данные. Как партнёр в области бухгалтерии мы берём ответственность за подотчётные нам участки и работаем на стандарте, который обеспечивает спокойствие в повседневном ведении бизнеса.',
        'Dla biur rachunkowych':
            'Для бухгалтерских бюро',
        "Kupimy Biuro\nRachunkowe":
            "Купим бухгалтерское\nбюро",
        'Od lat współpracujemy z biurami rachunkowymi, które stoją przed decyzją o zmianie, sprzedaży lub dalszym rozwoju.':
            'На протяжении многих лет мы сотрудничаем с бухгалтерскими бюро, которые стоят перед решением об изменении, продаже или дальнейшем развитии.',
        'Wyceń wartość biura':
            'Оцените стоимость бюро',
        'Obsługujemy systemy ERP i finansowe wiodących dostawców':
            'Мы обслуживаем ERP и финансовые системы ведущих поставщиков',
        'Przejrzystych warunków':
            'Прозрачных условий',
        'Przejętych biur':
            'Приобретённых бюро',
        'Do wstępnej wyceny':
            'До предварительной оценки',
        'Pełna poufność':
            'Полная конфиденциальность',
        # --- Новые строки: bpo-info ---
        "Stabilne procesy. Rzetelne\ndane. Spokój zarządu.":
            "Стабильные процессы. Достоверные\nданные. Спокойствие руководства.",
        'Wspieramy większe firmy w obszarze księgowości, kadr i płac, back-office, przejmując odpowiedzialność za jakość, terminowość i ciągłość działania. Dostarczamy dane i raporty w harmonogramie dopasowanym do zarządu – tak, żeby decyzje były oparte na spójnych informacjach, a nie „gaszeniu pożarów".':
            'Мы поддерживаем крупные компании в области бухгалтерии, кадров и расчёта зарплаты, беря ответственность за качество, своевременность и непрерывность работы. Мы предоставляем данные и отчёты по графику, согласованному с руководством, — чтобы решения основывались на согласованной информации, а не на «тушении пожаров».',
        "raportowanie zarządcze i sprawozdawcze dopasowane do potrzeb organizacji\n\ncyfrowy obieg dokumentów i uporządkowane procesy\n\npełna zastępowalność i ciągłość obsługi oraz gotowość do skalowania":
            "управленческая и финансовая отчётность, адаптированная к потребностям организации\n\nцифровой документооборот и упорядоченные процессы\n\nполная взаимозаменяемость и непрерывность обслуживания, а также готовность к масштабированию",
        "Jakość potwierdzona\nstandardami":
            "Качество, подтверждённое\nстандартами",
        "Ponad 170\nexpertów":
            "Более 170\nэкспертов",
        'Nagroda':
            'Награда',
        # --- Новые строки: bpo-kadrowe ---
        'Rozwiązania Kadrowe':
            'Кадровые решения',
        'Zapewniamy wsparcie w zakresie obsługi kadrowej i naliczania wynagrodzeń. Nasze kompleksowe rozwiązania w obszarze HR i payroll, dedykowane dla dużych przedsiębiorstw, zapewniają nie tylko zgodność z przepisami prawa, ale także optymalizację procesów kadrowych. Współpracujemy zarówno z firmami, które nie posiadają własnego działu HR, jak i z organizacjami potrzebującymi wsparcia przy wybranych procesach.':
            'Мы оказываем поддержку в области кадрового учёта и расчёта заработной платы. Наши комплексные решения в сфере HR и payroll, предназначенные для крупных предприятий, обеспечивают не только соответствие законодательству, но и оптимизацию кадровых процессов. Мы сотрудничаем как с компаниями без собственного отдела HR, так и с организациями, нуждающимися в поддержке отдельных процессов.',
        'Dlaczego BPO z nami':
            'Почему BPO с нами',
        'Sprawdź rozwiązania kadrowe':
            'Изучите кадровые решения',
        "Prowadzenie dokumentacji kadrowej\n\nNaliczanie wynagrodzeń i świadczeń\n\nObsługa umów o pracę i umów cywilnoprawnych\n\nRozliczenia z ZUS i instytucjami publicznymi\n\nSporządzanie deklaracji podatkowych\n\nKontrolowanie limitów urlopowych, terminów badań lekarskich, szkoleń BHP oraz wygasających umów\n\nReprezentowanie podczas kontroli i czynności sprawdzających\n\nZarządzanie programami PPK i PPE\n\nPlatforma pracownicza z dostępem do wniosków urlopowych i dokumentów online":
            "Ведение кадровой документации\n\nНачисление заработной платы и льгот\n\nОбработка трудовых и гражданско-правовых договоров\n\nРасчёты с ZUS и государственными учреждениями\n\nПодготовка налоговых деклараций\n\nКонтроль лимитов отпусков, сроков медосмотров, охраны труда и истекающих договоров\n\nПредставительство при проверках и ревизионных действиях\n\nУправление программами PPK и PPE\n\nПлатформа для сотрудников с доступом к заявлениям на отпуск и документам онлайн",
        # --- Новые строки: bpo-ksiegowe ---
        'Outsourcing księgowości pozwala na znaczne obniżenie kosztów operacyjnych. Możemy dostarczyć wysokiej jakości usługi księgowe, eliminując potrzebę zatrudniania wewnętrznych ekspertów. Dzięki nowoczesnej technologii i dużej skali obsługiwanych przez nas operacji oszczędności sięgają 20-30% lub więcej w porównaniu do prowadzenia księgowości wewnętrznie. Dzięki digitalizacji obiegu dokumentów oraz sprawnym procesom możemy dostarczać raporty w czasie rzeczywistym.':
            'Аутсорсинг бухгалтерии позволяет значительно снизить операционные затраты. Мы можем предоставлять высококачественные бухгалтерские услуги, исключая необходимость найма внутренних специалистов. Благодаря современным технологиям и большому масштабу обрабатываемых нами операций экономия достигает 20–30% и более по сравнению с ведением бухгалтерии собственными силами. Благодаря оцифровке документооборота и эффективным процессам мы можем предоставлять отчёты в режиме реального времени.',
        "Prowadzenie ksiąg rachunkowych\n\nObliczanie podatków i składanie deklaracji podatkowych\n\nBieżące rozliczanie wyciągów i kontrolowanie rozrachunków\n\nRaportowanie zarządcze i sprawozdawcze\n\nRaportowanie do instytucji publicznoprawnych, w tym NBP, GUS, INTRASTAT\n\nSporządzanie sprawozdań finansowych oraz deklaracji rocznych\n\nReprezentowanie podczas kontroli i czynności sprawdzających\n\nObsługa niestandardowych rozliczeń, w tym VAT OSS, CIT Estoński, SSE, VAT marża, itp.\n\nAsystowanie i wsparcie podczas audytu sprawozdania finansowego":
            "Ведение бухгалтерских книг\n\nИсчисление налогов и подача налоговых деклараций\n\nТекущее согласование выписок и контроль расчётов\n\nУправленческая и финансовая отчётность\n\nОтчётность перед публично-правовыми учреждениями, включая NBP, GUS, INTRASTAT\n\nСоставление финансовой отчётности и годовых деклараций\n\nПредставительство при проверках и ревизионных действиях\n\nОбработка нестандартных расчётов, включая VAT OSS, Estonian CIT, SEZ, маржинальный VAT и т.д.\n\nАссистирование и поддержка при аудите финансовой отчётности",
        # --- Новые строки: bpo-model ---
        'Model współpracy':
            'Модель сотрудничества',
        "Możesz powierzyć nam całość procesów księgowych lub wybrane obszary wymagające uporządkowania.\nDopasowujemy zakres wsparcia do realnej sytuacji Twojej firmy.":
            "Вы можете доверить нам все бухгалтерские процессы или отдельные участки, требующие упорядочивания.\nМы адаптируем объём поддержки к реальной ситуации в вашей компании.",
        'Kompleksowa obsługa':
            'Комплексное обслуживание',
        'Obsługujemy proces end-to-end: od bieżącej ewidencji po zamknięcie miesiąca i raporty. Pracujesz z zespołem, który zapewnia zastępowalność i stały standard.':
            'Мы ведём процесс от начала до конца: от текущего учёта до закрытия месяца и отчётов. Вы работаете с командой, которая обеспечивает взаимозаменяемость и постоянный стандарт.',
        "Outsourcing wybranych\nprocesów":
            "Аутсорсинг отдельных\nпроцессов",
        'Przejmujemy konkretne procesy i dowozimy je w ustalonym standardzie i harmonogramie. To rozwiązanie dla firm, które chcą wzmocnić wewnętrzny dział finansów bez rozbudowy etatów.':
            'Мы берём на себя конкретные процессы и выполняем их в согласованном стандарте и графике. Это решение для компаний, которые хотят укрепить внутренний финансовый отдел без расширения штата.',
        # --- Новые строки: bpo-wspolpraca ---
        'Jak wygląda bieżąca współpraca':
            'Как выглядит текущее сотрудничество',
        'Poznaj więcej historii':
            'Узнайте больше историй',
        'Indywidualna organizacja pracy':
            'Индивидуальная организация работы',
        'W zależności od potrzeb możemy pracować:':
            'В зависимости от потребностей мы можем работать:',
        'na bieżąco – obsługując codzienne procesy księgowe lub kadrowe':
            'на постоянной основе — обслуживая ежедневные бухгалтерские или кадровые процессы',
        'w cyklach tygodniowych':
            'в недельных циклах',
        'w innych ustalonych odstępach czasu':
            'в других согласованных интервалах',
        'Elastyczne zamknięcie miesiąca':
            'Гибкое закрытие месяца',
        'Terminy zamknięcia miesiąca ustalamy indywidualnie z każdą firmą, uwzględniając jej wewnętrzne potrzeby raportowe oraz obowiązujące terminy podatkowe.':
            'Сроки закрытия месяца устанавливаются индивидуально с каждой компанией с учётом её внутренних потребностей в отчётности и действующих налоговых сроков.',
        'część firm potrzebuje raportów finansowych do 20. dnia miesiąca':
            'некоторым компаниям нужны финансовые отчёты до 20-го числа месяца',
        'inne wymagają wyników już w 3. lub 4. dniu roboczym nowego miesiąca':
            'другие требуют результатов уже на 3-й или 4-й рабочий день нового месяца',
        'Zakres i częstotliwość raportowania ustalamy indywidualnie z każdym klientem.':
            'Объём и частота отчётности устанавливаются индивидуально с каждым клиентом.',
        'W standardzie klient otrzymuje:':
            'В стандартном пакете клиент получает:',
        'rachunek zysków i strat':
            'отчёт о прибылях и убытках',
        'bilans':
            'баланс',
        'zestawienie należności i zobowiązań':
            'ведомость дебиторской и кредиторской задолженности',
        # --- Новые строки: bpo-cyfrowa ---
        'Umów się na konsultacje':
            'Запишитесь на консультацию',
        # --- Новые строки: kupimy ---
        'Myślisz o sprzedaży swojego biura rachunkowego?':
            'Думаете о продаже вашего бухгалтерского бюро?',
        'Oferujemy dwa modele współpracy: całkowitą sprzedaż biura rachunkowego albo partnerstwo kapitałowe z zachowaniem operacyjnej autonomii.':
            'Мы предлагаем две модели сотрудничества: полную продажу бухгалтерского бюро или капитальное партнёрство с сохранением операционной автономии.',
        'Właściciele biur rachunkowych zgłaszają się do nas z różnymi potrzebami. Jedni chcą całkowicie wyjść z biznesu i sprzedać firmę, inni szukają partnera, który pomoże im dalej rozwijać biuro. W Meritoros rozmawiamy o obu scenariuszach.':
            'Владельцы бухгалтерских бюро обращаются к нам с разными потребностями. Одни хотят полностью выйти из бизнеса и продать фирму, другие ищут партнёра, который поможет им продолжать развивать бюро. В Meritoros мы обсуждаем оба сценария.',
        'Kupimy biuro rachunkowe':
            'Купим бухгалтерское бюро',
        'Porozmawiajmy o możliwym modelu współpracy':
            'Поговорим о возможной модели сотрудничества',
        'Całkowita sprzedaż biura':
            'Полная продажа бюро',
        'Jeśli planujesz wycofanie się z prowadzenia firmy, możemy rozmawiać o przejęciu całego przedsiębiorstwa — z uwzględnieniem klientów, zespołu i ciągłości działania.':
            'Если вы планируете выйти из ведения бизнеса, мы можем обсудить приобретение всего предприятия — с учётом клиентов, команды и непрерывности деятельности.',
        'Sprzedaż części udziałów':
            'Продажа доли',
        'Jeśli chcesz dalej prowadzić biuro, ale jednocześnie zyskać wsparcie większej organizacji, możemy rozmawiać o modelu partnerskim z częściowym wejściem kapitałowym Meritoros.':
            'Если вы хотите продолжать вести бюро, но при этом получить поддержку более крупной организации, мы можем обсудить партнёрскую модель с частичным капитальным вхождением Meritoros.',
        'Od czego zależy wycena biura rachunkowego?':
            'От чего зависит оценка бухгалтерского бюро?',
        'Wartość biura rachunkowego nie zależy wyłącznie od przychodów. Znaczenie mają także m.in. struktura klientów, rentowność, organizacja procesów, używane systemy, stabilność zespołu oraz stopień zależności firmy od właściciela. Dlatego każdą rozmowę zaczynamy od zrozumienia realnej sytuacji biznesu.':
            'Стоимость бухгалтерского бюро зависит не только от доходов. Важную роль играют также структура клиентов, рентабельность, организация процессов, используемые системы, стабильность команды и степень зависимости фирмы от владельца. Поэтому каждый разговор мы начинаем с понимания реального положения дел в бизнесе.',
        'Na wycenę wpływają m.in.:':
            'На оценку влияют, в частности:',
        "poziom i powtarzalność przychodów,\n\nrentowność biura,\n\nstruktura klientów i ryzyko koncentracji,\n\norganizacja pracy, technologia i stopień poukładania procesów.":
            "уровень и повторяемость доходов,\n\nрентабельность бюро,\n\nструктура клиентов и риск концентрации,\n\nорганизация работы, технологии и степень зрелости процессов.",
        'W przypadku modelu partnerskiego':
            'В случае партнёрской модели',
        'Model partnerski kierujemy przede wszystkim do biur, które:':
            'Партнёрская модель ориентирована прежде всего на бюро, которые:',
        'mają obrót roczny <strong>powyżej 3 mln zł</strong>,':
            'имеют годовой оборот <strong>свыше 3 млн злотых</strong>,',
        'pracują na systemach innych niż <strong>Optima</strong>, np. Enova, Symfonia,':
            'работают на системах, отличных от <strong>Optima</strong>, например Enova, Symfonia,',
        'chcą dalej rozwijać firmę, ale zyskać dostęp do większego zaplecza,':
            'хотят продолжать развивать компанию, но получить доступ к большим ресурсам,',
        'szukają wsparcia <strong>w obszarze technologii</strong>, procesów, HR, marketingu i rozwoju operacyjnego.':
            'ищут поддержки <strong>в области технологий</strong>, процессов, HR, маркетинга и операционного развития.',
        'Co zyskujesz jako Partner Meritoros?':
            'Что вы получаете как Партнёр Meritoros?',
        "dostęp do automatyzacji i robotyzacji procesów\n\nwsparcie w digitalizacji i porządkowaniu operacji\n\ndostęp do wiedzy ekspertów i partnerów merytorycznych\n\nwsparcie HR i rekrutacyjne\n\nwsparcie marketingowe i sprzedażowe,\n\nwewnętrzne standardy jakości i audytu\n\nmożliwość dalszego rozwoju w strukturach większej organizacji":
            "доступ к автоматизации и роботизации процессов\n\nподдержка в оцифровке и упорядочивании операций\n\nдоступ к знаниям экспертов и предметных партнёров\n\nHR и рекрутинговая поддержка\n\nмаркетинговая и сбытовая поддержка\n\nвнутренние стандарты качества и аудита\n\nвозможность дальнейшего развития в структурах более крупной организации",
        'Kalkulator orientacyjnej wyceny biura rachunkowego':
            'Ориентировочный калькулятор оценки бухгалтерского бюро',
        'Sprawdź wycenę':
            'Проверить оценку',
        'Spełniasz wszystkie kryteria?':
            'Соответствуете ли вы всем критериям?',
        'Warto się odezwać — chętnie sprawdzimy, czy widzimy przestrzeń do współpracy.':
            'Стоит обратиться — мы с удовольствием проверим, видим ли мы пространство для сотрудничества.',
        'Umów się na rozmowę':
            'Запишитесь на разговор',
        'Obecnie najczęściej rozmawiamy z biurami, które spełniają poniższe kryteria:':
            'В настоящее время мы чаще всего разговариваем с бюро, которые соответствуют следующим критериям:',
        'Przejmujemy całość lub wybrane obszary, które wymagają uporządkowania i stałego nadzoru.':
            'Мы берём на себя все или выбранные участки, которые требуют упорядочивания и постоянного контроля.',
        "obrót roczny: od ok. 1,2 mln zł\n\noprogramowanie: Comarch Optima,\n\npreferowane lokalizacje: Warszawa, Kraków, Wrocław, Łódź, Górny Śląsk, Rzeszów,\n\nw przypadku większych podmiotów analizujemy także inne lokalizacje.":
            "годовой оборот: от прибл. 1,2 млн злотых\n\nпрограммное обеспечение: Comarch Optima,\n\nпредпочтительные локации: Варшава, Краков, Вроцлав, Лодзь, Верхняя Силезия, Жешув,\n\nдля более крупных субъектов мы также анализируем другие локации.",
        'Spełniasz powyższe kryteria?':
            'Соответствуете ли вы указанным критериям?',
        'Nie spełniasz wszystkich kryteriów?':
            'Не соответствуете всем критериям?',
        'Jak wygląda sprzedaż biura rachunkowego w praktyce?':
            'Как выглядит продажа бухгалтерского бюро на практике?',
        'Jeśli chcesz lepiej zrozumieć kulisy takiego procesu, zobacz materiał, w którym omawiamy najważniejsze kwestie związane ze sprzedażą firmy usługowej i przejęciem biura rachunkowego.':
            'Если вы хотите лучше понять закулисье такого процесса, посмотрите материал, в котором мы обсуждаем наиболее важные вопросы, связанные с продажей сервисной компании и приобретением бухгалтерского бюро.',
        'Pierwsza rozmowa jest niezobowiązująca. Ustalimy, jaki model ma sens i czy jest przestrzeń do współpracy.':
            'Первый разговор ни к чему не обязывает. Мы установим, какая модель имеет смысл и есть ли пространство для сотрудничества.',
        # --- Новые строки: hk-video, media-video, ebook ---
        'Wczytaj więcej':
            'Загрузить ещё',
        'Historie klientów':
            'Истории клиентов',
        'Posłuchaj, co mówią nasi klienci':
            'Послушайте, что говорят наши клиенты',
        'Czytaj historię':
            'Читать историю',
        'Jak z MINIMALNYM ryzykiem zacząć własny biznes? Sebastian Rafalik wspomina Meritoros.':
            'Как начать собственный бизнес с МИНИМАЛЬНЫМ риском? Себастьян Рафалик вспоминает Meritoros.',
        'Sebastian Rafalik (POL–FRA) w wywiadzie dla „Zaprojektuj Swoje Życie" mówi o tym, jak uporządkowanie księgowości i kadr z Meritoros pomogło mu odblokować skalowanie biznesu i zdjąć z siebie „wąskie gardło".':
            'Себастьян Рафалик (POL–FRA) в интервью для «Zaprojektuj Swoje Życie» рассказывает о том, как упорядочение бухгалтерии и кадров с Meritoros помогло ему разблокировать масштабирование бизнеса и снять с себя «узкое место».',
        'Posłuchaj wywiadu':
            'Послушать интервью',
        'Obejrzyj materiał':
            'Смотреть материал',
        'Darmowy materiał':
            'Бесплатный материал',
        'Pobierz nasz darmowy Ebook':
            'Скачайте наш бесплатный Ebook',
        'Pobierz materiał':
            'Скачать материал',
        'Ebook został wysłany na podany adres e-mail!':
            'Ebook отправлен на указанный адрес электронной почты!',
        # --- Новые строки: fr-hero, fr-dlaczego, single ---
        'Fundacja rodzinna':
            'Семейный фонд',
        'księgowość pod kontrolą':
            'бухгалтерия под контролем',
        'Fundacja rodzinna wymaga szczególnej staranności w obszarze księgowości i podatków. Zapewniamy rozwiązania, które chronią interes fundatorów i wspierają długoterminową strukturę majątkową.':
            'Семейный фонд требует особой тщательности в области бухгалтерии и налогов. Мы предоставляем решения, которые защищают интересы учредителей и поддерживают долгосрочную имущественную структуру.',
        'Dlaczego Meritoros':
            'Почему Meritoros',
        'Mamy wdrożone procedury kontroli jakości i weryfikacji danych. Dostarczamy informacje finansowe kompletne, spójne i użyteczne dla zarządu.':
            'У нас внедрены процедуры контроля качества и проверки данных. Мы предоставляем финансовую информацию, которая является полной, согласованной и полезной для руководства.',
        'Ponad 170 ekspertów':
            'Более 170 экспертов',
        'Jakość potwierdzona standardami. Mamy wdrożone procedury kontroli jakości i weryfikacji danych. Dostarczamy informacje finansowe kompletne, spójne i użyteczne dla zarządu.':
            'Качество, подтверждённое стандартами. У нас внедрены процедуры контроля качества и проверки данных. Мы предоставляем финансовую информацию, которая является полной, согласованной и полезной для руководства.',
        'Powrót do':
            'Вернуться к',
        # --- Case studies: industries, scope_title, scope_desc, video_label ---
        'Geologia inżynierska':
            'Инженерная геология',
        'Ochrona środowiska':
            'Охрана окружающей среды',
        'Usługi rachunkowe, obszar kadr i płac, wsparcie w audytach':
            'Бухгалтерские услуги, сфера кадров и зарплат, поддержка аудитов',
        'Po kilku zmianach głównej księgowej spółka potrzebowała szybkiego uporządkowania księgowości i bezpiecznego zamknięcia roku obrotowego. Wdrożyliśmy usprawnienia procesowe.':
            'После нескольких смен главного бухгалтера компания нуждалась в быстром упорядочивании бухгалтерии и безопасном закрытии финансового года. Мы внедрили процессные улучшения.',
        'Nasz wpływ na operacje HPC':
            'Наше влияние на операции HPC',
        'Technologia druku':
            'Технология печати',
        'E-commerce B2B':
            'E-commerce B2B',
        'Pełna obsługa BPO, rozliczenia międzynarodowe VAT OSS':
            'Полное обслуживание BPO, международные расчёты VAT OSS',
        'Przy dynamicznym wzroście sprzedaży cross-border firma potrzebowała partnera gotowego na złożone rozliczenia VAT OSS w wielu krajach UE. Przejęliśmy całość obsługi finansowej.':
            'При динамичном росте трансграничных продаж компания нуждалась в партнёре, готовом к сложным расчётам VAT OSS в нескольких странах ЕС. Мы взяли на себя всё финансовое обслуживание.',
        'Jak Printbox skaluje finanse globalnie':
            'Как Printbox масштабирует финансы глобально',
        'Budownictwo':
            'Строительство',
        'Inżynieria':
            'Инженерия',
        'Kadry, płace, Intrastat, rozliczenia delegacji zagranicznych':
            'Кадры, зарплаты, Intrastat, расчёты зарубежных командировок',
        'Firma realizowała kontrakty w kilku krajach jednocześnie. Meritoros przejął obsługę kadrową i rozliczenia Intrastat, odciążając zarząd od złożoności administracyjnej.':
            'Компания выполняла контракты одновременно в нескольких странах. Meritoros взял на себя кадровое обслуживание и расчёты Intrastat, освободив руководство от административной сложности.',
        'Obsługa kadrowa na skalę międzynarodową':
            'Кадровое обслуживание в международном масштабе',
        'Produkcja przemysłowa':
            'Промышленное производство',
        'Eksport':
            'Экспорт',
        'Pełna księgowość, fundacja rodzinna, compliance':
            'Полная бухгалтерия, семейный фонд, комплаенс',
        'Właściciel grupy produkcyjnej chciał oddzielić majątek prywatny od firmowego poprzez fundację rodzinną. Meritoros poprowadził cały proces prawno-księgowy od podstaw.':
            'Владелец производственной группы хотел отделить частное имущество от корпоративного через семейный фонд. Meritoros провёл весь юридически-бухгалтерский процесс с нуля.',
        'Fundacja rodzinna krok po kroku':
            'Семейный фонд шаг за шагом',
        # --- section-hk-logos ---
        'Zaufało nam ponad': 'Нам доверяют более',
        'klientów': 'клиентов',
        'Logo klienta': 'Логотип клиента',
        # --- section-media-mowia ---
        'Mówią o nas': 'Говорят о нас',
        'Przeczytaj artykuł': 'Читать статью',
        # --- section-hk-cta ---
        "Porozmawiajmy o rozwiązaniach\ndla Twojego biznesu": "Поговорим о решениях\nдля вашего бизнеса",
        'Wyślij zapytanie': 'Отправить запрос',
        # --- section-wideoinstruktaze ---
        'Wideo': 'Видео',
        'Wideoinstruktaże': 'Видеоинструкции',
        'Praktyczne instruktaże wideo z zakresu księgowości, podatków i kadr.': 'Практические видеоинструкции по бухгалтерии, налогам и кадрам.',
        # --- section-ri-lista ---
        'Lista nadzorcza': 'Наблюдательный совет',
        'przewodnicząca rady nadzorczej': 'председатель наблюдательного совета',
        'członek rady nadzorczej': 'член наблюдательного совета',
        # --- section-ri-info ---
        'O nas': 'О нас',
        'Profil działalności': 'Профиль деятельности',
        'Skala działalności': 'Масштаб деятельности',
        'Zasięg i grupa kapitałowa': 'Охват и группа капитала',
        'Strategia rozwoju': 'Стратегия развития',
        'Początek działalności': 'Основана',
        'Klientów': 'Клиентов',
        'Specjalistów': 'Специалистов',
        'lokalizacji': 'локаций',
        '(ale ciągle rośniemy)': '(и мы продолжаем расти)',
        'Wyróżnienia są efektem tego, jak rozwijamy Meritoros: konsekwentnie i procesowo. Trzymamy standard, który ma działać w praktyce – codziennie.': 'Отличия являются результатом того, как мы развиваем Meritoros: последовательно и процессно. Мы придерживаемся стандарта, который должен работать на практике — каждый день.',
        # --- section-onas-jak ---
        'Jak pracujemy?': 'Как мы работаем?',
        'Dedykowany zespół': 'Выделенная команда',
        'Każdy klient współpracuje z przypisanym zespołem specjalistów oraz Liderem odpowiedzialnym za jakość i terminowość.': 'Каждый клиент сотрудничает с выделенной командой специалистов и Лидером, ответственным за качество и своевременность.',
        'Podejście procesowe': 'Процессный подход',
        'Wszystkie działania opieramy na udokumentowanych procesach z określonymi SLA, checklistami i punktami kontroli jakości — tak by każda operacja była przewidywalna i powtarzalna.': 'Все действия основаны на задокументированных процессах с определёнными SLA, чек-листами и точками контроля качества — чтобы каждая операция была предсказуемой и воспроизводимой.',
        'Pełna zastępowalność': 'Полная взаимозаменяемость',
        'Procesy są tak zorganizowane, by urlopy i rotacja kadry nie wpływały na ciągłość obsługi. Klient zawsze ma kogoś do dyspozycji i nie odczuwa zmian personalnych.': 'Процессы организованы так, чтобы отпуска и ротация кадров не влияли на непрерывность обслуживания. Клиент всегда имеет кого-то в распоряжении и не ощущает кадровых изменений.',
        'Elastyczność współpracy': 'Гибкость сотрудничества',
        'Dopasowujemy zakres, terminy raportowania i sposób komunikacji do realnych potrzeb firmy — niezależnie od jej wielkości czy etapu rozwoju.': 'Мы подстраиваем объём, сроки отчётности и способ коммуникации к реальным потребностям компании — независимо от её размера или этапа развития.',
        'Zespół Meritoros przy pracy': 'Команда Meritoros за работой',
        # --- section-onas-kim ---
        'Kim jesteśmy': 'Кто мы',
        'Od ponad 20 lat wspieramy firmy w prowadzeniu księgowości, kadr i procesów finansowych. Pracujemy w modelu zespołowym i procesowym, z jasno określoną odpowiedzialnością, standaryzacją działań i nadzorem nad jakością. Łączymy doświadczenie z nowoczesnymi technologiami oraz automatyzacją, aby zapewnić naszym klientom rzetelne dane, bezpieczeństwo operacyjne i stabilność, której potrzebują, by rozwijać swój biznes.': 'Более 20 лет мы поддерживаем компании в ведении бухгалтерии, кадров и финансовых процессов. Мы работаем в командной и процессной модели, с чётко определённой ответственностью, стандартизацией действий и контролем качества. Мы сочетаем опыт с современными технологиями и автоматизацией, чтобы обеспечить нашим клиентам достоверные данные, операционную безопасность и стабильность, необходимые для развития их бизнеса.',
        "Wewnętrzny\ndział IT i RPA": "Внутренний\nотдел IT и RPA",
        "Certyfikacja ISO\n9001 i ISO/IEC\n27001": "Сертификация\nISO 9001\nи ISO/IEC 27001",
        "Ubezpieczenie\ndo 3 mln PLN": "Страхование\nдо 3 млн злотых",
        "Ponad 170\nexpertów na\npokładzie": "Более 170\nэкспертов\nна борту",
        "Ponad 1200\nklientów": "Более 1200\nклиентов",
        "7 oddziałów\nw Polsce oraz\noddziały wirtualne": "7 отделений\nв Польше и\nвиртуальные офисы",
        # --- section-onas-mapa ---
        'Gdzie działamy': 'Где мы работаем',
        'Posiadamy 7 oddziałów stacjonarnych w miastach Polski oraz oddziały wirtualne, dzięki czemu obsługujemy firmy niezależnie od ich lokalizacji:': 'У нас есть 7 стационарных отделений в городах Польши и виртуальные отделения, благодаря чему мы обслуживаем компании независимо от их местонахождения:',
        "Kraków (siedziba główna oraz 3 oddziały)\nWarszawa\nKatowice\nRzeszów\nWrocław\nŁódź\nBytom\n2 oddziały wirtualne działające w pełni online": "Краков (головной офис и 3 отделения)\nВаршава\nКатовице\nРжешув\nВроцлав\nЛодзь\nБытом\n2 полностью онлайн-отделения",
        'Mapa Polski z oddziałami': 'Карта Польши с отделениями',
        # --- section-onas-wartosci ---
        "Dlaczego Meritoros to spokój\nw Twoim biznesie?": "Почему Meritoros — это спокойствие\nв вашем бизнесе?",
        "Skala i ciągłość\nobsługi": "Масштаб и непрерывность\nобслуживания",
        "Jakość potwierdzona\nstandardami": "Качество подтверждено\nстандартами",
        'Zespół Meritoros': 'Команда Meritoros',
        # --- section-testimonials ---
        'Opinie klientów': 'Отзывы клиентов',
        'Sprawdź, co mówią o nas inni': 'Посмотрите, что говорят о нас другие',
        'Mam księgowość w bezpiecznych rękach i wiem, że nie muszę się o to już martwić.': 'Моя бухгалтерия в надёжных руках, и я знаю, что мне больше не нужно об этом беспокоиться.',
        'HP Cepolgol S.A.': 'HP Cepolgol S.A.',
        'Meritoros dostarczył nam stabilność i pewność, w trudnych momentach zawsze mamy właściwe odpowiedzi.': 'Meritoros обеспечил нам стабильность и уверенность — в трудные моменты у нас всегда есть правильные ответы.',
        'CEO & Co-Founder, Printbox': 'CEO & Co-Founder, Printbox',
        'Profesjonalizm na każdym kroku. Polecamy Meritoros każdej firmie, która ceni sobie bezpieczeństwo i jakość obsługi.': 'Профессионализм на каждом шагу. Рекомендуем Meritoros каждой компании, которая ценит безопасность и качество обслуживания.',
        'Dyrektor Finansowy, SITECH': 'Финансовый директор, SITECH',
        'Obsługiwanych klientów': 'Обслуживаемых клиентов',
        'Lat na rynku': 'Лет на рынке',
        'Klientów poleca nas dalej': 'Клиентов рекомендуют нас',
        'Ekspertów w zespole': 'Экспертов в команде',
        # --- section-fr-zyski ---
        "Co zyskujesz, gdy księgowość\nfundacji jest poukładana": "Что вы получаете, когда бухгалтерия\nфонда упорядочена",
        "Bezpieczne zarządzanie\nmajątkiem": "Безопасное управление\nимуществом",
        'Porządek w danych i dokumentach, jasna sprawozdawczość i kontrola nad obowiązkami.': 'Порядок в данных и документах, чёткая отчётность и контроль над обязательствами.',
        "Sukcesja na trwałych\nregułach": "Наследование на прочных\nправилах",
        'Przejrzyste zasady i przewidywalność – tak, aby rozwiązanie działało długoterminowo.': 'Прозрачные правила и предсказуемость — чтобы решение работало в долгосрочной перспективе.',
        "Spokój w kwestiach\nformalnych": "Спокойствие в формальных\nвопросах",
        'Dopilnujemy terminów i obowiązków sprawozdawczych, żeby nic „nie wyskakiwało" w ostatniej chwili.': 'Мы позаботимся о сроках и отчётных обязательствах, чтобы ничто не «выскакивало» в последний момент.',
        "Mniej ryzyk,\nmniej poprawek": "Меньше рисков,\nменьше исправлений",
        'Praca procesowa, weryfikacja danych i standardy, które ograniczają błędy.': 'Процессная работа, проверка данных и стандарты, ограничивающие ошибки.',
        # --- section-kp-dlaczego ---
        "Dlaczego firmy wybierają nasze\nrozwiązania kadrowe": "Почему компании выбирают наши\nкадровые решения",
        'Realizujemy usługi w oparciu o certyfikat ISO 9001': 'Оказываем услуги на основе сертификата ISO 9001',
        "Nowoczesne i elastyczne\npodejście": "Современный и гибкий\nподход",
        'Przygotowujemy raporty finansowe dopasowane do potrzeb zarządu i wspierające podejmowanie decyzji biznesowych.': 'Мы готовим финансовые отчёты, адаптированные к потребностям руководства и поддерживающие принятие бизнес-решений.',
        'Bezpieczeństwo danych': 'Безопасность данных',
        'Stosujemy rozwiązania zgodne z normą ISO/IEC 27001, zapewniające poufność, integralność i bezpieczeństwo danych pracowniczych.': 'Мы применяем решения в соответствии со стандартом ISO/IEC 27001, обеспечивающие конфиденциальность, целостность и безопасность данных сотрудников.',
        'Business continuity': 'Business continuity',
        'Usługi realizuje cały zespół specjalistów, dlatego urlopy i rotacja pracowników nie wpływają na terminowość i ciągłość obsługi Twojej firmy.': 'Услуги оказывает вся команда специалистов, поэтому отпуска и ротация сотрудников не влияют на своевременность и непрерывность обслуживания вашей компании.',
        # --- section-kp-hero ---
        'Kadry i płace, które dają': 'Кадры и зарплата, которые дают',
        'spokój': 'спокойствие',
        'organizacji': 'организации',
        'Zapewniamy kompleksową obsługę kadrowo-płacową firm o różnej skali działalności. Przejmujemy odpowiedzialność za poprawność, terminowość i ciągłość procesów, aby organizacja mogła działać stabilnie i bez zakłóceń.': 'Мы предоставляем комплексные кадровые и бухгалтерские услуги компаниям различного масштаба. Берём на себя ответственность за точность, своевременность и непрерывность процессов, чтобы организация могла стабильно работать без сбоев.',
        'Porozmawiajmy': 'Поговорим',
        # --- section-kp-obsluga ---
        'Twoje kadry': 'Ваши кадры',
        'i płace': 'и зарплата',
        'pod kontrolą': 'под контролем',
        'Oferujemy pełną obsługę kadrowo-płacową przedsiębiorstw – od prowadzenia dokumentacji pracowniczej po naliczanie wynagrodzeń i rozliczenia z instytucjami publicznymi. Klienci mogą powierzyć nam całość procesów kadrowych i płacowych lub wybrane obszary wymagające wsparcia.': 'Мы предлагаем полное кадровое и бухгалтерское обслуживание предприятий — от ведения кадровой документации до расчёта заработной платы и расчётов с государственными учреждениями. Клиенты могут доверить нам все кадровые и бухгалтерские процессы или отдельные участки, требующие поддержки.',
        'Zakres współpracy dopasowujemy do wielkości i struktury organizacji.': 'Объём сотрудничества мы адаптируем к размеру и структуре организации.',
        'Oszacuj wstępną wycenę': 'Получить предварительную оценку',
        # --- section-kp-cta ---
        'Porozmawiajmy o obsłudze kadrowej dla Twojej firmy': 'Поговорим о кадровом обслуживании вашей компании',
        'Skontaktuj się z nami i dowiedz się, jak możemy wesprzeć Twój dział HR i płac.': 'Свяжитесь с нами и узнайте, как мы можем поддержать ваш отдел кадров и расчётов.',
        # --- section-kp-kalkulator ---
        'Kalkulator – oszacuj wstępnie koszt obsługi': 'Калькулятор — предварительная оценка стоимости обслуживания',
        'Oszacuj wstępny koszt obsługi kadrowo-płacowej w kilka chwil. Wprowadź podstawowe informacje o swojej działalności, a my przygotujemy orientacyjną wycenę dopasowaną do Twoich potrzeb i skali zatrudnienia.': 'Оцените предварительную стоимость кадрово-бухгалтерского обслуживания за несколько минут. Введите основную информацию о вашей деятельности, и мы подготовим ориентировочную смету, адаптированную к вашим потребностям и масштабу занятости.',
        '* to jest wstępny szacunek, każda oferta jest jednak indywidualnie rozpatrywana i odpowiednio wyceniana.': '* это предварительная смета; каждое предложение рассматривается индивидуально и оценивается соответственно.',
        # --- section-kp-wspolpraca ---
        'na bieżąco – obsługując codzienne procesy kadrowe i płacowe': 'на постоянной основе — обслуживая ежедневные кадровые и бухгалтерские процессы',
        'Terminowe naliczanie wynagrodzeń': 'Своевременное начисление заработной платы',
        'Terminy przetwarzania listy płac ustalamy indywidualnie z każdą firmą, uwzględniając jej wewnętrzny harmonogram wypłat oraz terminy rozliczeń z ZUS i US.': 'Сроки обработки ведомостей устанавливаем индивидуально с каждой компанией, учитывая её внутренний график выплат и сроки расчётов с ZUS и налоговыми органами.',
        'listy płac gotowe z odpowiednim wyprzedzeniem przed dniem wypłaty': 'ведомости готовы с достаточным опережением до дня выплаты',
        'terminowe przelewy składek ZUS i zaliczek PIT': 'своевременные переводы взносов ZUS и авансов PIT',
        'Zakres raportowania ustalamy\nindywidualnie z każdym klientem.': 'Объём отчётности устанавливаем\nиндивидуально с каждым клиентом.',
        'zestawienie listy płac': 'сводная ведомость',
        'paski wynagrodzeń dla pracowników': 'расчётные листки для сотрудников',
        'potwierdzenia rozliczeń ZUS i US': 'подтверждения расчётов ZUS и налоговых органов',
        'W zależności od potrzeb przygotowujemy również dodatkowe raporty kadrowe, płacowe i zarządcze.': 'В зависимости от потребностей мы также готовим дополнительные кадровые, бухгалтерские и управленческие отчёты.',
        # --- section-kp-oferta ---
        'Oferta rozwiązań kadrowych': 'Предложение кадровых решений',
        'Wyceń usługę': 'Получить смету',
        'Sprawdź również rozwiązania księgowe': 'Ознакомьтесь также с бухгалтерскими решениями',
        'Prowadzenie dokumentacji kadrowej\n\nNaliczanie wynagrodzeń i świadczeń\n\nObsługa umów o pracę i umów cywilnoprawnych\n\nRozliczenia z ZUS i instytucjami publicznymi\n\nSporządzanie deklaracji podatkowych\n\nKontrolowanie limitów urlopowych, terminów badań lekarskich, szkoleń BHP oraz wygasających umów\n\nReprezentowanie podczas kontroli i czynności sprawdzających\n\nZarządzanie programami PPK i PPE\n\nPlatforma pracownicza z dostępem do wniosków urlopowych i dokumentów online': 'Ведение кадровой документации\n\nНачисление заработной платы и льгот\n\nОбработка трудовых и гражданско-правовых договоров\n\nРасчёты с ZUS и государственными учреждениями\n\nПодготовка налоговых деклараций\n\nКонтроль лимитов отпусков, сроков медосмотров, охраны труда и истекающих договоров\n\nПредставительство при проверках и ревизионных действиях\n\nУправление программами PPK и PPE\n\nПлатформа для сотрудников с доступом к заявлениям на отпуск и документам онлайн',
        # --- section-kp-systemy ---
        "Obsługa wielu systemów\nksiągowych": "Поддержка множества\nбухгалтерских систем",
        # --- section-hk-hero ---
        'Historie klientów': 'Истории клиентов',
        'Konkretne przypadki. Konkretny efekt. Zobacz, jak pomagamy firmom działać stabilnie i bezpiecznie.': 'Конкретные случаи. Конкретный результат. Посмотрите, как мы помогаем компаниям работать стабильно и безопасно.',
        'Poznaj historie': 'Ознакомьтесь с историями',
        # --- section-hk-wspolpraca ---
        'Współpraca, która': 'Сотрудничество, которое',
        'daje spokój operacyjny': 'даёт операционное спокойствие',
        'W Meritoros pracujemy tak, aby odciążyć zespół klienta i zapewnić ciągłość obsługi. Działamy elastycznie, dopasowując model współpracy do realiów organizacji, ale trzymamy stały standard jakości, terminowości i bezpieczeństwa danych.': 'В Meritoros мы работаем так, чтобы разгрузить команду клиента и обеспечить непрерывность обслуживания. Действуем гибко, адаптируя модель сотрудничества к реалиям организации, но поддерживаем постоянный стандарт качества, своевременности и безопасности данных.',
        'Dzięki temu klienci mogą skupić się na biznesie, a nie na „gaszeniu tematów" w księgowości czy kadrach': 'Благодаря этому клиенты могут сосредоточиться на бизнесе, а не на «тушении пожаров» в бухгалтерии или кадрах',
        # --- section-fr-model ---
        "Możesz powierzyć nam całość procesów księgowych lub wybrane obszary wymagające uporządkowania.\nDopasowujemy zakres wsparcia do realnej sytuacji Twojej firmy.": "Вы можете доверить нам все бухгалтерские процессы или отдельные участки, требующие упорядочивания.\nМы адаптируем объём поддержки к реальной ситуации в вашей компании.",
        'Obsługujemy proces end-to-end: od bieżącej ewidencji po zamknięcie miesiąca i raporty. Pracujesz z zespołem, który zapewnia zastępowalność i stały standard.': 'Мы ведём процесс от начала до конца: от текущего учёта до закрытия месяца и отчётов. Вы работаете с командой, которая обеспечивает взаимозаменяемость и постоянный стандарт.',
        # --- section-fr-obsluga ---
        'Obsługa księgowa fundacji rodzinnej dla właścicieli myślących długoterminowo': 'Бухгалтерское обслуживание семейного фонда для владельцев, мыслящих долгосрочно',
        'Prowadzimy księgowość fundacji rodzinnych dla przedsiębiorców, którzy chcą uporządkować kwestie majątku i sukcesji w sposób bezpieczny, transparentny i zgodny z przepisami. Bierzemy na siebie bieżącą obsługę, sprawozdawczość i kontrolę terminów, tak aby fundacja działała stabilnie.': 'Мы ведём бухгалтерский учёт семейных фондов для предпринимателей, которые хотят упорядочить вопросы имущества и наследования безопасно, прозрачно и в соответствии с законодательством. Мы берём на себя текущее обслуживание, отчётность и контроль сроков, чтобы фонд работал стабильно.',
        # --- section-fr-oferta ---
        'Poznaj naszą ofertę': 'Ознакомьтесь с нашим предложением',
        'Zapewniamy kompleksową obsługę księgową i podatkową, która porządkuje finanse fundacji i daje poczucie bezpieczeństwa jej fundatorom.': 'Мы предоставляем комплексное бухгалтерское и налоговое обслуживание, которое упорядочивает финансы фонда и даёт его учредителям ощущение безопасности.',
        'Prowadzenie ksiąg rachunkowych\n\nRozliczanie i składanie deklaracji podatkowych\n\nPrzygotowywanie sprawozdań finansowych\n\nAsystowanie podczas badania sprawozdania finansowego oraz kontroli urzędów\n\nRaportowanie na cele zarządcze\n\nSporządzanie polityki rachunkowości': 'Ведение бухгалтерских книг\n\nИсчисление и подача налоговых деклараций\n\nПодготовка финансовой отчётности\n\nАссистирование при аудите финансовой отчётности и проверках органов\n\nОтчётность для управленческих целей\n\nСоставление учётной политики',
        # --- section-media-artykul ---
        'Maciej Paraszczak dla Pulsu Biznesu': 'Мацей Парасщак для Puls Biznesu',
        'Dla wielu naszych klientów jesteśmy nie tylko biurem rachunkowym, ale partnerem operacyjnym, który realnie usprawnia ich procesy biznesowe – podkreśla z Maciej Paraszczak, prezes zarządu spółki Meritoros.': 'Для многих наших клиентов мы являемся не просто бухгалтерским бюро, а операционным партнёром, который реально улучшает их бизнес-процессы — подчёркивает Мацей Парасщак, президент правления Meritoros.',
        'Wywiad z Maciejem Paraszczakiem dla Pulsu Biznesu o tym, jak wygląda nowoczesna księgowość w praktyce i dlaczego standard oraz procesy mają dziś kluczowe znaczenie.': 'Интервью с Мацеем Парасщаком для Puls Biznesu о том, как выглядит современная бухгалтерия на практике и почему стандарты и процессы имеют сегодня ключевое значение.',
        'Czytaj więcej': 'Читать больше',
        # --- section-media-hero ---
        'Media i informacje firmowe': 'Медиа и корпоративные новости',
        'Najważniejsze wydarzenia z życia firmy: rozwój, nowe inicjatywy, wyróżnienia i ogłoszenia.': 'Важнейшие события из жизни компании: развитие, новые инициативы, отличия и объявления.',
        # --- section-media-przeczytaj ---
        'Przeczytaj również': 'Читайте также',
        # --- section-media-zapytania ---
        'Zapytania medialne': 'Медиа-запросы',
        'W sprawach publikacji, komentarzy eksperckich i współpracy medialnej prosimy o kontakt. Odpowiemy możliwie szybko i wrócimy z informacją, w jakiej formie możemy pomóc.': 'По вопросам публикаций, экспертных комментариев и медиасотрудничества просим обращаться. Ответим как можно быстрее и вернёмся с информацией, в какой форме можем помочь.',
        # --- section-onas-hero ---
        'Poznaj nasze biuro rachunkowe i wartości, które stoją za naszą codzienną pasją.': 'Познакомьтесь с нашим бухгалтерским бюро и ценностями, которые лежат в основе нашей ежедневной страсти.',
        'Pracujemy tak, by być dumni z jakości informacji dostarczanych naszym klientom.': 'Мы работаем так, чтобы гордиться качеством информации, предоставляемой нашим клиентам.',
        'Porozmawiamy': 'Поговорим',
        # --- section-onas-zespol ---
        'Zespół': 'Команда',
        'prezes zarządu, CEO': 'президент правления, CEO',
        'Założyciel i główny udziałowiec Meritoros SA, certyfikowany księgowy (Certyfikat Min. Finansów nr 1840/2003). Absolwent kierunku Zarządzanie ze specjalnością Finanse i Rachunkowość.': 'Основатель и главный акционер Meritoros SA, сертифицированный бухгалтер (Сертификат Министерства финансов № 1840/2003). Выпускник специальности Управление со специализацией «Финансы и бухгалтерский учёт».',
        'członek zarządu, COO': 'член правления, COO',
        'Udziałowiec Meritoros SA, certyfikowana księgowa (Certyfikat Min. Finansów nr 54055/2011). Absolwentka kierunku Zarządzania na AGH, swoje wykształcenie uzupełniła o studia podyplomowe.': 'Акционер Meritoros SA, сертифицированный бухгалтер (Сертификат Министерства финансов № 54055/2011). Выпускница специальности Управление в AGH, дополнила образование аспирантскими студиями.',
        'Udziałowiec Meritoros SA, certyfikowany księgowy (Certyfikat Min. Finansów nr 62092/2013). Absolwent kierunku Finansów i Rachunkowości na UEK ze specjalnością finanse przedsiębiorstw.': 'Акционер Meritoros SA, сертифицированный бухгалтер (Сертификат Министерства финансов № 62092/2013). Выпускник специальности Финансы и бухгалтерский учёт в UEK со специализацией «Корпоративные финансы».',
        'Księgowa (Certyfikat Min. Finansów 55068/2012) z wieloletnim doświadczeniem. Swoją karierę budowała w Biurach Rachunkowych oraz jako główna księgowa w jednej z międzynarodowych firm.': 'Бухгалтер (Сертификат Министерства финансов 55068/2012) с многолетним опытом. Строила карьеру в бухгалтерских бюро и в качестве главного бухгалтера в одной из международных компаний.',
        # --- section-ri-akcjonariat ---
        'Informacje o strukturze akcjonariatu': 'Информация о структуре акционерного капитала',
        'Kapitał zakładowy spółki wynosi 120 000 PLN i dzieli się na 1 200 000 akcji serii A o wartości nominalnej 0,10 PLN.': 'Уставный капитал общества составляет 120 000 злотых и делится на 1 200 000 акций серии A номинальной стоимостью 0,10 злотых.',
        'Akcjonariusz': 'Акционер',
        'Łączna liczba posiadanych akcji': 'Общее количество акций',
        'Udział w łącznej liczbie głosów': 'Доля в общем количестве голосов',
        # --- section-ri-hero ---
        'Relacje inwestorskie': 'Отношения с инвесторами',
        'Poniżej udostępniamy kluczowe informacje i dokumenty dotyczące Meritoros SA, w tym sprawozdania finansowe i raporty okresowe.': 'Ниже мы размещаем ключевую информацию и документы, касающиеся Meritoros SA, включая финансовую отчётность и периодические отчёты.',
        # --- section-ri-msg ---
        'Ogłoszenia w Monitorze Sądowym i Gospodarczym': 'Объявления в Судебно-хозяйственном мониторе',
        # --- section-ri-ogloszenia ---
        'Ogłoszenia o zwołaniu Walnego Zgromadzenia Akcjonariuszy': 'Уведомления о созыве Общего собрания акционеров',
        # --- section-ri-rada ---
        'Rada nadzorcza': 'Наблюдательный совет',
        'doradca podatkowy (certyfikat nr 00443)\nbył członek zarządu Małopolskiej Izby Doradców Podatkowych': 'налоговый советник (сертификат № 00443)\nбывший член правления Малопольской палаты налоговых советников',
        'przedsiębiorca\nprezes zarządu Emka Sp. z o.o.': 'предприниматель\nпрезидент правления Emka Sp. z o.o.',
        'przedsiębiorca\nczłonek zarządu Chata Sp. z o.o.': 'предприниматель\nчлен правления Chata Sp. z o.o.',
        'przedsiębiorca\nwiceprezes zarządu Office Samurai Sp. z o.o.': 'предприниматель\nвице-президент правления Office Samurai Sp. z o.o.',
        'przedsiębiorca\nprezes zarządu Printbox Sp. z o.o.': 'предприниматель\nпрезидент правления Printbox Sp. z o.o.',
        # --- section-ri-raporty ---
        'Raporty kwartalne spółki': 'Квартальные отчёты общества',
        'Raporty EBI/ESPI': 'Отчёты EBI/ESPI',
        'Animator Rynku': 'Маркет-мейкер',
        'Autoryzowany Doradca': 'Авторизованный советник',
        'Pytania i odpowiedzi': 'Вопросы и ответы',
        # --- section-ri-rewident ---
        'Opinie biegłego rewidenta': 'Заключения аудитора',
        # --- section-ri-rosniemy ---
        'Rośniemy': 'Мы растём',
        'Rozwój Meritoros SA znajduje odzwierciedlenie w systematycznym wzroście skali działalności i przychodów na przestrzeni ostatnich lat.': 'Развитие Meritoros SA отражается в систематическом росте масштабов деятельности и доходов на протяжении последних лет.',
        # --- section-ri-sprawozdania ---
        'Sprawozdania finansowe spółki': 'Финансовая отчётность общества',
        # --- section-ri-sprawozdania-zarzadu ---
        'Sprawozdania z działalności zarządu spółki': 'Отчёты о деятельности правления общества',
        # --- section-ri-uchwaly ---
        'Uchwały podejmowane przez Zgromadzenie Akcjonariuszy': 'Решения, принятые Общим собранием акционеров',
        # --- section-ri-zarzad ---
        'Zarząd': 'Правление',
        # --- section-uk-cta ---
        'Skontaktuj się z nami i dowiedz się, jak możemy wesprzeć Twoją firmę.': 'Свяжитесь с нами и узнайте, как мы можем поддержать вашу компанию.',
        # --- section-uk-dlaczego ---
        "Dlaczego firmy wybierają nasze\nrozwiązania księgowe": "Почему компании выбирают наши\nбухгалтерские решения",
        "Jakość potwierdzona\nstandardami": "Качество, подтверждённое\nстандартами",
        'Pracujemy zgodnie z normą ISO 9001 — systematyczne procesy, kontrola jakości i ciągłe doskonalenie usług.': 'Мы работаем в соответствии со стандартом ISO 9001 — систематические процессы, контроль качества и постоянное совершенствование услуг.',
        "Nowoczesne i elastyczne podejście": "Современный и гибкий подход",
        'Dopasowujemy narzędzia i zakres współpracy do realnych potrzeb Twojej firmy – bez zbędnej biurokracji.': 'Мы подбираем инструменты и объём сотрудничества под реальные потребности вашей компании — без лишней бюрократии.',
        'Zespołowy model pracy gwarantuje ciągłość obsługi — urlopy i rotacja pracowników nie wpływają na jakość Twojej księgowości.': 'Командная модель работы гарантирует непрерывность обслуживания — отпуска и ротация сотрудников не влияют на качество вашей бухгалтерии.',
        'Dane klientów chronimy zgodnie z normą ISO 27001 — wdrożone procedury, szyfrowanie i regularne audyty bezpieczeństwa.': 'Данные клиентов мы защищаем в соответствии со стандартом ISO 27001 — внедрённые процедуры, шифрование и регулярные аудиты безопасности.',
        # --- section-uk-hero ---
        'Rozwiązania księgowe dla firm, które': 'Бухгалтерские решения для компаний, которые',
        'chcą mieć porządek': 'хотят иметь порядок',
        'i spokój w biznesie': 'и спокойствие в бизнесе',
        'Zapewniamy kompleksową obsługę księgową firm o różnej skali działalności. Przejmujemy odpowiedzialność za poprawność, terminowość i ciągłość procesów księgowych, aby nasi klienci mogli skupić się na prowadzeniu i rozwoju biznesu.': 'Мы предоставляем комплексное бухгалтерское обслуживание компаниям различного масштаба. Берём ответственность за точность, своевременность и непрерывность бухгалтерских процессов, чтобы наши клиенты могли сосредоточиться на ведении и развитии бизнеса.',
        # --- section-uk-ksiegowosc ---
        'Twoja księgowość': 'Ваша бухгалтерия',
        'w': 'в',
        'dobrych rękach': 'надёжных руках',
        'Oferujemy kompleksową obsługę księgową działalności i spółek zarówno w zakresie prowadzenia pełnych ksiąg rachunkowych, jak i uproszczonych form ewidencji. Klienci mogą powierzyć nam całość procesów księgowych lub wybrane obszary wymagające wsparcia.': 'Мы предлагаем комплексное бухгалтерское обслуживание предпринимателей и компаний как в сфере ведения полных бухгалтерских книг, так и упрощённых форм учёта. Клиенты могут доверить нам все бухгалтерские процессы или отдельные участки, требующие поддержки.',
        'Zakres współpracy dopasowujemy do skali działalności i stopnia złożoności operacji finansowych.': 'Объём сотрудничества мы адаптируем к масштабу деятельности и степени сложности финансовых операций.',
        'Sprawdź jak wygląda współpraca': 'Посмотрите, как выглядит сотрудничество',
        # --- section-uk-oferta ---
        'Oferta rozwiązań księgowych': 'Предложение бухгалтерских решений',
        "Obsługujemy firmy na różnych formach rozliczeń zarówno w pełnej księgowości (spółki),\njak i w uproszczonych formach ewidencji (np. KPiR)": "Мы обслуживаем компании на различных формах учёта как в полной бухгалтерии (общества),\nтак и в упрощённых формах учёта (напр. книга доходов и расходов)",
        'Poniżej pokazujemy przykładowy zakres działań. Jeśli potrzebujesz innej usługi chętnie porozmawiamy.': 'Ниже мы показываем примерный объём действий. Если вам нужна другая услуга, мы с удовольствием поговорим.',
        'Sprawdź również rozwiązania kadrowe': 'Ознакомьтесь также с кадровыми решениями',
        'Prowadzenie ksiąg rachunkowych\n\nObliczanie podatków i składanie deklaracji podatkowych\n\nBieżące rozliczanie wyciągów i kontrolowanie rozrachunków\n\nRaportowanie zarządcze i sprawozdawcze\n\nRaportowanie do instytucji publicznych\n\nSporządzanie sprawozdań finansowych oraz deklaracji rocznych\n\nReprezentowanie podczas kontroli i czynności sprawdzających\n\nObsługa niestandardowych rozliczeń\n\nAsystowanie i wsparcie podczas audytu': 'Ведение бухгалтерских книг\n\nИсчисление налогов и подача налоговых деклараций\n\nТекущее согласование выписок и контроль расчётов\n\nУправленческая и финансовая отчётность\n\nОтчётность перед государственными учреждениями\n\nСоставление финансовой отчётности и годовых деклараций\n\nПредставительство при проверках и ревизионных действиях\n\nОбработка нестандартных расчётов\n\nАссистирование и поддержка при аудитах',
        # --- section-uk-wspolpraca ---
        'na bieżąco – obsługując codzienne procesy księgowe lub kadrowe': 'на постоянной основе — обслуживая ежедневные бухгалтерские или кадровые процессы',
        'Zakres i częstotliwość raportowania\nustalamy indywidualnie z każdym klientem.': 'Объём и частота отчётности\nустанавливаются индивидуально с каждым клиентом.',
        'W zależności od potrzeb przygotowujemy również dodatkowe raporty księgowe, finansowe lub kadrowo-płacowe.': 'В зависимости от потребностей мы также готовим дополнительные бухгалтерские, финансовые или кадрово-бухгалтерские отчёты.',
        # --- section-uk-kalkulator ---
        'Oszacuj wstępny koszt usług księgowych w kilka chwil. Wprowadź podstawowe informacje o swojej działalności, a my przygotujemy orientacyjną wycenę dopasowaną do Twoich potrzeb i skali biznesu.': 'Оцените предварительную стоимость бухгалтерских услуг за несколько минут. Введите основную информацию о вашей деятельности, и мы подготовим ориентировочную смету, адаптированную к вашим потребностям и масштабу бизнеса.',
        # --- section-bpo-systemy ---
        "Obsługa wielu systemów\nksięgowych": "Поддержка множества\nбухгалтерских систем",
        # --- section-services ---
        'Nasze Kompetencje': 'Наши компетенции',
        'Obszary, w których przejmujemy odpowiedzialność': 'Сферы, в которых мы берём ответственность',
        'Nasze doświadczenie obejmuje rozliczanie firm o różnorodnych profilach działalności, takich jak CIT Estoński, Fundacje Rodzinne, Spółki ASI, e-commerce, VAT OSS, Intrastat oraz rozliczenia delegacji pracowniczych.': 'Наш опыт охватывает расчёты компаний с разнообразными профилями деятельности, такими как эстонский CIT, семейные фонды, компании ASI, e-commerce, VAT OSS, Intrastat и расчёты командировок сотрудников.',
        'Zapytaj o ofertę': 'Запросить предложение',
        'Skontaktuj się z nami': 'Свяжитесь с нами',
        'Usługi Rachunkowe': 'Бухгалтерские услуги',
        'Kompleksowa obsługa księgowa firm o różnej skali działalności.': 'Комплексное бухгалтерское обслуживание компаний различного масштаба.',
        'BPO': 'BPO',
        'Outsourcing wybranych lub pełnych procesów finansowych i administracyjnych dla większych firm.': 'Аутсорсинг отдельных или полных финансовых и административных процессов для крупных компаний.',
        'Usługi Kadrowe': 'Кадровые услуги',
        'Obsługa kadrowo-płacowa dopasowana do potrzeb organizacji.': 'Кадрово-бухгалтерское обслуживание, адаптированное к потребностям организации.',
        'Fundacje rodzinne': 'Семейные фонды',
        'Obsługa rachunkowa fundacji z uwzględnieniem specyfiki regulacyjnej.': 'Бухгалтерское обслуживание фондов с учётом регуляторной специфики.',
        'Wsparcie we wdrażaniu narzędzi, automatyzacji i usprawnianiu procesów biznesowych.': 'Поддержка во внедрении инструментов, автоматизации и оптимизации бизнес-процессов.',
        # --- section-oferta-kuk-info ---
        'Prowadzenie ksiąg rachunkowych i ewidencji podatkowych (PKPB)': 'Ведение бухгалтерских книг и налогового учёта (PKPB)',
        'Sporządzanie deklaracji i sprawozdań finansowych (CIT, VAT, PIT)': 'Составление финансовых деклараций и отчётности (CIT, VAT, PIT)',
        'Przygotowywanie rocznych sprawozdań finansowych i analiz dla klientów': 'Подготовка годовой финансовой отчётности и аналитики для клиентов',
        'Bezpośredni kontakt z klientami (telefon, e-mail) w sprawach rozliczeń': 'Прямой контакт с клиентами (телефон, e-mail) по вопросам расчётов',
        'Współpraca z urzędami skarbowymi, instytucjami finansowymi i podmiotami zewnętrznymi, w tym reprezentacja klientów': 'Сотрудничество с налоговыми органами, финансовыми учреждениями и внешними субъектами, включая представительство клиентов',
        'Minimum 2 lata doświadczenia w samodzielnym prowadzeniu ksiąg rachunkowych w biurze rachunkowym; certyfikat MF mile widziany': 'Минимум 2 года опыта самостоятельного ведения бухгалтерских книг в бухгалтерском бюро; сертификат МФ приветствуется',
        'Biegła znajomość języka ukraińskiego i rosyjskiego do komunikacji z klientami': 'Свободное владение украинским и русским языками для общения с клиентами',
        'Doświadczenie w samodzielnym sporządzaniu sprawozdań finansowych': 'Опыт самостоятельного составления финансовой отчётности',
        'Praktyczna znajomość przepisów rachunkowych, prawa podatkowego i przepisów VAT': 'Практическое знание бухгалтерского законодательства, налогового права и норм VAT',
        'Biegłość w MS Office (szczególnie Excel) i oprogramowaniu księgowym Comarch Optima': 'Уверенное владение MS Office (особенно Excel) и бухгалтерской программой Comarch Optima',
        'Skrupulatność i wysokie zdolności organizacyjne': 'Скрупулёзность и высокие организационные способности',
        'Zdolności analitycznego myślenia': 'Способности к аналитическому мышлению',
        # --- section-kariera-hero ---
        "Dołącz do\nnaszego zespołu": "Присоединяйся к\nнашей команде",
        "Budujemy uporządkowane procesy i dobrą atmosferę.\nJeśli cenisz jasne zasady, rozwój i pracę zespołową – sprawdź,\nczy mamy ofertę dla Ciebie.": "Мы строим упорядоченные процессы и хорошую атмосферу.\nЕсли ты ценишь чёткие правила, развитие и командную работу — проверь,\nесть ли у нас предложение для тебя.",
        'Aktualne oferty pracy': 'Актуальные вакансии',
        # --- fr-oferta / uk-oferta full item strings ---
        "Prowadzenie ksiąg rachunkowych\n\nRozliczanie i składanie deklaracji podatkowych\n\nPrzygotowywanie sprawozdań finansowych\n\nAsystowanie podczas badania sprawozdania finansowego oraz kontroli urzędów\n\nRaportowanie na cele zarządcze\n\nSporządzanie polityki rachunkowości":
            "Ведение бухгалтерских книг\n\nРасчёт и подача налоговых деклараций\n\nПодготовка финансовых отчётов\n\nАссистирование при аудите финансовых отчётов и проверках органов\n\nУправленческая отчётность\n\nСоставление учётной политики",
        "Prowadzenie ksiąg rachunkowych\n\nObliczanie podatków i składanie deklaracji podatkowych\n\nBieżące rozliczanie wyciągów i kontrolowanie rozrachunków\n\nRaportowanie zarządcze i sprawozdawcze\n\nRaportowanie do instytucji publicznych\n\nSporządzanie sprawozdań finansowych oraz deklaracji rocznych\n\nReprezentowanie podczas kontroli i czynności sprawdzających\n\nObsługa niestandardowych rozliczeń\n\nAsystowanie i wsparcie podczas audytu":
            "Ведение бухгалтерских книг\n\nВычисление налогов и подача налоговых деклараций\n\nТекущее согласование выписок и контроль расчётов\n\nУправленческая и финансовая отчётность\n\nОтчётность перед государственными учреждениями\n\nСоставление финансовых отчётов и годовых деклараций\n\nПредставительство при проверках и ревизионных действиях\n\nОбработка нестандартных расчётов\n\nАссистирование и поддержка при аудите",
    },
}

# ── Pomocnicze: escapeuj string do formatu .po ───────────────────────────────
def po_escape(s):
    return s.replace('\\', '\\\\').replace('"', '\\"').replace('\n', '\\n"\n"')

# ── Dodaj wpisy do .po ───────────────────────────────────────────────────────
def append_to_po(path, new_entries):
    with open(path, 'a', encoding='utf-8', newline='\n') as f:
        for msgid, msgstr in new_entries.items():
            f.write(f'\nmsgid "{po_escape(msgid)}"\n')
            f.write(f'msgstr "{po_escape(msgstr)}"\n')
    print(f'  Dodano {len(new_entries)} wpisów do {os.path.basename(path)}')

# ── Kompiluj .po → .mo ───────────────────────────────────────────────────────
def compile_mo(po_path, mo_path):
    entries = {}
    cur_id = cur_str = None
    in_id = in_str = False

    for line in open(po_path, encoding='utf-8'):
        line = line.rstrip('\n')
        if line.startswith('msgid "'):
            if cur_id is not None and cur_str is not None:
                entries[cur_id] = cur_str
            cur_id = line[7:-1].replace('\\n', '\n').replace('\\"', '"')
            cur_str = None
            in_id, in_str = True, False
        elif line.startswith('msgstr "'):
            cur_str = line[8:-1].replace('\\n', '\n').replace('\\"', '"')
            in_id, in_str = False, True
        elif line.startswith('"'):
            chunk = line[1:-1].replace('\\n', '\n').replace('\\"', '"')
            if in_id and cur_id is not None:
                cur_id += chunk
            elif in_str and cur_str is not None:
                cur_str += chunk
        elif line == '':
            in_id = in_str = False

    if cur_id is not None and cur_str is not None:
        entries[cur_id] = cur_str

    entries.pop('', None)
    entries = {k: v for k, v in entries.items() if v}
    keys = sorted(entries.keys())
    n = len(keys)

    orig_offset = 28
    trans_offset = 28 + n * 8
    strings_data = b''
    orig_table = []
    trans_table = []
    cur_off = 28 + n * 16

    for key in keys:
        orig = key.encode('utf-8')
        trans = entries[key].encode('utf-8')
        orig_table.append((len(orig), cur_off))
        strings_data += orig + b'\x00'
        cur_off += len(orig) + 1
        trans_table.append((len(trans), cur_off))
        strings_data += trans + b'\x00'
        cur_off += len(trans) + 1

    header = struct.pack('<IIIIIII', 0x950412de, 0, n, orig_offset, trans_offset, 0, 0)
    tables = b''
    for length, offset in orig_table:
        tables += struct.pack('<II', length, offset)
    for length, offset in trans_table:
        tables += struct.pack('<II', length, offset)

    with open(mo_path, 'wb') as f:
        f.write(header + tables + strings_data)

    print(f'  Skompilowano {os.path.basename(mo_path)} ({n} wpisów)')

# ── Główna pętla ─────────────────────────────────────────────────────────────
for lang, trans in TRANSLATIONS.items():
    print(f'\n[{lang}]')
    po_path = f'{LANG}/{lang}.po'
    mo_path = f'{LANG}/{lang}.mo'
    append_to_po(po_path, trans)
    compile_mo(po_path, mo_path)

print('\nGotowe.')
