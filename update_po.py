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
