<?php
defined('ABSPATH') || exit;

// Stawki KP — te same co w section-kp-kalkulator.php
$rate_kp  = (float) mer_field('kp_kalk_rate_kp',  75);
$rate_k   = (float) mer_field('kp_kalk_rate_k',   52);
$rate_p   = (float) mer_field('kp_kalk_rate_p',   52);
$rate_sub = (float) mer_field('kp_kalk_rate_sub', 42);
?>

<section class="py-10 md:py-20 bg-[#00d084] relative overflow-hidden">

    <!-- Dekoracyjny okrąg -->
    <div class="absolute -left-24 top-1/2 -translate-y-1/2 w-[420px] h-[420px] rounded-full border-[52px] border-white/20 pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-lg mx-auto px-6 relative z-10">

        <!-- Nagłówek -->
        <div class="text-center mb-8">
            <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-white mb-3 leading-tight">
                <?php esc_html_e('Sprawdź orientacyjny koszt obsługi', 'meritoros'); ?>
            </h2>
            <p class="text-white/75 text-base leading-relaxed">
                <?php esc_html_e('Podaj kilka liczb — my podamy orientacyjną cenę.', 'meritoros'); ?>
            </p>
        </div>

        <!-- Karta kalkulatora -->
        <div class="bg-white rounded-2xl p-8 shadow-sm">

            <!-- Segmented control wewnątrz karty -->
            <div class="flex bg-slate-100 rounded-full p-1 mb-6">
                <button id="ktk-tab-kp" type="button"
                    class="flex-1 py-2.5 rounded-full text-sm font-semibold transition-all bg-white text-slate-900 shadow-sm">
                    <?php esc_html_e('Kadry i płace', 'meritoros'); ?>
                </button>
                <button id="ktk-tab-uk" type="button"
                    class="flex-1 py-2.5 rounded-full text-sm font-semibold transition-all text-slate-500 hover:text-slate-700">
                    <?php esc_html_e('Usługi księgowe', 'meritoros'); ?>
                </button>
            </div>

            <!-- Formularz KP -->
            <div id="ktk-form-kp">

                <div class="relative mb-4" id="ktk-kp-wrapper">
                    <button id="ktk-kp-btn"
                        class="w-full flex items-center justify-between px-5 py-4 border border-slate-200 rounded-xl text-slate-500 text-sm hover:border-slate-300 transition-colors bg-white"
                        aria-haspopup="listbox" aria-expanded="false" type="button">
                        <span id="ktk-kp-label"><?php esc_html_e('Wybierz zakres', 'meritoros'); ?></span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-slate-400 stroke-[1.5] shrink-0 transition-transform" id="ktk-kp-chevron"></i>
                    </button>
                    <div id="ktk-kp-list" class="absolute top-full left-0 right-0 mt-2 bg-white border border-slate-200 rounded-xl shadow-lg z-20 overflow-hidden hidden">
                        <button data-value="kadry-place"  class="ktk-kp-option w-full text-left px-5 py-4 text-sm text-slate-700 hover:bg-emerald-50 transition-colors border-b border-slate-100" type="button"><?php esc_html_e('Kadry i płace', 'meritoros'); ?></button>
                        <button data-value="kadry"        class="ktk-kp-option w-full text-left px-5 py-4 text-sm text-slate-700 hover:bg-emerald-50 transition-colors border-b border-slate-100" type="button"><?php esc_html_e('Same kadry', 'meritoros'); ?></button>
                        <button data-value="place"        class="ktk-kp-option w-full text-left px-5 py-4 text-sm text-slate-700 hover:bg-emerald-50 transition-colors border-b border-slate-100" type="button"><?php esc_html_e('Same płace', 'meritoros'); ?></button>
                        <button data-value="podwykonawcy" class="ktk-kp-option w-full text-left px-5 py-4 text-sm text-slate-700 hover:bg-emerald-50 transition-colors" type="button"><?php esc_html_e('Rozliczenie umów (podwykonawcy)', 'meritoros'); ?></button>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <input id="ktk-kp-pracownicy" type="number" min="1"
                        placeholder="<?php esc_attr_e('Liczba pracowników', 'meritoros'); ?>"
                        class="w-full px-5 py-4 border border-slate-200 rounded-xl text-slate-800 text-sm placeholder-slate-400 hover:border-slate-300 focus:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-100 transition-colors bg-white" />
                    <input id="ktk-kp-wyplaty" type="number" min="1"
                        placeholder="<?php esc_attr_e('Ilość wypłat / mies.', 'meritoros'); ?>"
                        class="w-full px-5 py-4 border border-slate-200 rounded-xl text-slate-800 text-sm placeholder-slate-400 hover:border-slate-300 focus:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-100 transition-colors bg-white" />
                </div>

            </div>

            <!-- Formularz UK -->
            <div id="ktk-form-uk" class="hidden">

                <div class="relative mb-4" id="ktk-uk-wrapper">
                    <button id="ktk-uk-btn"
                        class="w-full flex items-center justify-between px-5 py-4 border border-slate-200 rounded-xl text-slate-500 text-sm hover:border-slate-300 transition-colors bg-white"
                        aria-haspopup="listbox" aria-expanded="false" type="button">
                        <span id="ktk-uk-label"><?php esc_html_e('Wybierz typ księgowości', 'meritoros'); ?></span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-slate-400 stroke-[1.5] shrink-0 transition-transform" id="ktk-uk-chevron"></i>
                    </button>
                    <div id="ktk-uk-list" class="absolute top-full left-0 right-0 mt-2 bg-white border border-slate-200 rounded-xl shadow-lg z-20 overflow-hidden hidden">
                        <button data-value="uproszczona" class="ktk-uk-option w-full text-left px-5 py-4 text-sm text-slate-700 hover:bg-emerald-50 transition-colors border-b border-slate-100" type="button"><?php esc_html_e('Księgowość uproszczona (KPiR, ryczałt)', 'meritoros'); ?></button>
                        <button data-value="pelna"       class="ktk-uk-option w-full text-left px-5 py-4 text-sm text-slate-700 hover:bg-emerald-50 transition-colors" type="button"><?php esc_html_e('Pełna księgowość (KH)', 'meritoros'); ?></button>
                    </div>
                </div>

                <div class="mb-4">
                    <input id="ktk-uk-docs" type="number" min="1"
                        placeholder="<?php esc_attr_e('Liczba dokumentów miesięcznie', 'meritoros'); ?>"
                        class="w-full px-5 py-4 border border-slate-200 rounded-xl text-slate-800 text-sm placeholder-slate-400 hover:border-slate-300 focus:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-100 transition-colors bg-white" />
                </div>

            </div>

            <!-- Przycisk -->
            <button id="ktk-submit" class="w-full py-3.5 rounded-full bg-white text-slate-800 text-base font-semibold border border-slate-200 hover:bg-slate-50 hover:border-slate-300 transition-colors mb-5" type="button">
                <?php esc_html_e('Oblicz kwotę obsługi', 'meritoros'); ?>
            </button>

            <!-- Wynik -->
            <div>
                <p class="text-sm text-slate-400 mb-1"><?php esc_html_e('Orientacyjna cena netto', 'meritoros'); ?></p>
                <p class="text-4xl font-bold text-slate-900">
                    <span id="ktk-price">0,00 zł</span>
                    <span class="text-lg font-normal text-slate-400 ml-1">(netto)</span>
                </p>
            </div>

        </div>

        <p class="mt-4 text-xs text-white/55 leading-relaxed">
            <?php esc_html_e('* to jest wstępny szacunek, każda oferta jest indywidualnie rozpatrywana i odpowiednio wyceniana.', 'meritoros'); ?>
        </p>

    </div>
</section>

<script>
(function () {
    // Stawki KP
    var ratesKP = {
        'kadry-place':  <?php echo $rate_kp; ?>,
        'kadry':        <?php echo $rate_k; ?>,
        'place':        <?php echo $rate_p; ?>,
        'podwykonawcy': <?php echo $rate_sub; ?>
    };
    var labelsKP = {
        'kadry-place':  'Kadry i płace',
        'kadry':        'Same kadry',
        'place':        'Same płace',
        'podwykonawcy': 'Rozliczenie umów (podwykonawcy)'
    };

    // Progi UK
    var tiersKH = [
        {max: 20,       price: 730},
        {max: 50,       price: 1040},
        {max: 100,      price: 1870},
        {max: 200,      price: 2700},
        {max: 300,      price: 3540},
        {max: 400,      price: 4370},
        {max: 500,      price: 5200},
        {max: Infinity, rate: 7.30}
    ];
    var tiersUP = [
        {max: 10,       price: 370},
        {max: 20,       price: 440},
        {max: 50,       price: 590},
        {max: 100,      price: 850},
        {max: 150,      price: 1110},
        {max: 200,      price: 1370},
        {max: 250,      price: 1630},
        {max: 300,      price: 1890},
        {max: 350,      price: 2150},
        {max: 400,      price: 2410},
        {max: 450,      price: 2670},
        {max: Infinity, rate: 5.20}
    ];

    var tabKP     = document.getElementById('ktk-tab-kp');
    var tabUK     = document.getElementById('ktk-tab-uk');
    var formKP    = document.getElementById('ktk-form-kp');
    var formUK    = document.getElementById('ktk-form-uk');
    var submitBtn = document.getElementById('ktk-submit');
    var priceEl   = document.getElementById('ktk-price');
    if (!tabKP) return;

    var activeTab = 'kp';

    function setTab(tab) {
        activeTab = tab;
        priceEl.textContent = '0,00 zł';
        if (tab === 'kp') {
            tabKP.className = 'flex-1 py-2.5 rounded-full text-sm font-semibold transition-all bg-white text-slate-900 shadow-sm';
            tabUK.className = 'flex-1 py-2.5 rounded-full text-sm font-semibold transition-all text-slate-500 hover:text-slate-700';
            formKP.classList.remove('hidden');
            formUK.classList.add('hidden');
        } else {
            tabUK.className = 'flex-1 py-2.5 rounded-full text-sm font-semibold transition-all bg-white text-slate-900 shadow-sm';
            tabKP.className = 'flex-1 py-2.5 rounded-full text-sm font-semibold transition-all text-slate-500 hover:text-slate-700';
            formUK.classList.remove('hidden');
            formKP.classList.add('hidden');
        }
    }

    tabKP.addEventListener('click', function () { setTab('kp'); });
    tabUK.addEventListener('click', function () { setTab('uk'); });

    // Dropdown KP
    var kpBtn     = document.getElementById('ktk-kp-btn');
    var kpList    = document.getElementById('ktk-kp-list');
    var kpLabel   = document.getElementById('ktk-kp-label');
    var kpChevron = document.getElementById('ktk-kp-chevron');
    var kpScope   = null;

    kpBtn.addEventListener('click', function () {
        var isOpen = !kpList.classList.contains('hidden');
        kpList.classList.toggle('hidden', isOpen);
        kpChevron.style.transform = isOpen ? '' : 'rotate(180deg)';
        kpBtn.setAttribute('aria-expanded', String(!isOpen));
    });
    document.querySelectorAll('.ktk-kp-option').forEach(function (opt) {
        opt.addEventListener('click', function () {
            kpScope = opt.dataset.value;
            kpLabel.textContent = labelsKP[kpScope];
            kpLabel.classList.remove('text-slate-500');
            kpLabel.classList.add('text-slate-800');
            var inputP = document.getElementById('ktk-kp-pracownicy');
            if (inputP) inputP.placeholder = kpScope === 'podwykonawcy' ? 'Liczba podwykonawców' : 'Liczba pracowników';
            kpList.classList.add('hidden');
            kpChevron.style.transform = '';
            kpBtn.setAttribute('aria-expanded', 'false');
        });
    });
    document.addEventListener('click', function (e) {
        var w = document.getElementById('ktk-kp-wrapper');
        if (w && !w.contains(e.target)) {
            kpList.classList.add('hidden');
            kpChevron.style.transform = '';
            kpBtn.setAttribute('aria-expanded', 'false');
        }
    });

    // Dropdown UK
    var ukBtn     = document.getElementById('ktk-uk-btn');
    var ukList    = document.getElementById('ktk-uk-list');
    var ukLabel   = document.getElementById('ktk-uk-label');
    var ukChevron = document.getElementById('ktk-uk-chevron');
    var ukType    = null;
    var ukLabels  = { uproszczona: 'Księgowość uproszczona (KPiR, ryczałt)', pelna: 'Pełna księgowość (KH)' };

    ukBtn.addEventListener('click', function () {
        var isOpen = !ukList.classList.contains('hidden');
        ukList.classList.toggle('hidden', isOpen);
        ukChevron.style.transform = isOpen ? '' : 'rotate(180deg)';
        ukBtn.setAttribute('aria-expanded', String(!isOpen));
    });
    document.querySelectorAll('.ktk-uk-option').forEach(function (opt) {
        opt.addEventListener('click', function () {
            ukType = opt.dataset.value;
            ukLabel.textContent = ukLabels[ukType];
            ukLabel.classList.remove('text-slate-500');
            ukLabel.classList.add('text-slate-800');
            ukList.classList.add('hidden');
            ukChevron.style.transform = '';
            ukBtn.setAttribute('aria-expanded', 'false');
        });
    });
    document.addEventListener('click', function (e) {
        var w = document.getElementById('ktk-uk-wrapper');
        if (w && !w.contains(e.target)) {
            ukList.classList.add('hidden');
            ukChevron.style.transform = '';
            ukBtn.setAttribute('aria-expanded', 'false');
        }
    });

    // Oblicz
    submitBtn.addEventListener('click', function () {
        if (activeTab === 'kp') {
            var persons = parseInt(document.getElementById('ktk-kp-pracownicy').value, 10);
            var payouts = parseInt(document.getElementById('ktk-kp-wyplaty').value, 10);
            if (!kpScope || !persons || persons < 1 || !payouts || payouts < 1) {
                priceEl.textContent = '0,00 zł'; return;
            }
            var total = ratesKP[kpScope] * persons * payouts;
            priceEl.textContent = total.toLocaleString('pl-PL', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' zł';
        } else {
            var docs = parseInt(document.getElementById('ktk-uk-docs').value, 10);
            if (!ukType || !docs || docs < 1) { priceEl.textContent = '0,00 zł'; return; }
            var tiers = ukType === 'pelna' ? tiersKH : tiersUP;
            var result = null;
            for (var i = 0; i < tiers.length; i++) {
                if (docs <= tiers[i].max) {
                    result = typeof tiers[i].price !== 'undefined' ? tiers[i].price : docs * tiers[i].rate;
                    break;
                }
            }
            priceEl.textContent = result !== null
                ? result.toLocaleString('pl-PL', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' zł'
                : '0,00 zł';
        }
    });
})();
</script>
