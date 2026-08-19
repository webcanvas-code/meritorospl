<?php
$title       = mer_field('uk_kalk_title', 'Kalkulator – oszacuj wstępnie koszt obsługi');
$description = mer_field('uk_kalk_desc',  'Oszacuj wstępny koszt usług księgowych w kilka chwil. Wprowadź podstawowe informacje o swojej działalności, a my przygotujemy orientacyjną wycenę dopasowaną do Twoich potrzeb i skali biznesu.');
$disclaimer  = mer_field('uk_kalk_disclaimer', '* to jest wstępny szacunek, każda oferta jest jednak indywidualnie rozpatrywana i odpowiednio wyceniana.');
?>

<section id="kalkulator" class="py-10 md:py-20 bg-[#00d084] relative overflow-hidden">

    <!-- Dekoracyjny okrąg -->
    <div class="absolute -right-24 top-1/2 -translate-y-1/2 w-[420px] h-[420px] rounded-full border-[52px] border-white/20 pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid lg:grid-cols-2 gap-16 items-start">

            <div class="lg:pt-8">
                <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-white mb-6 leading-tight">
                    <?php echo mer_esc($title); ?>
                </h2>
                <p class="text-base sm:text-lg text-white/75 leading-relaxed max-w-sm">
                    <?php echo mer_esc($description); ?>
                </p>
            </div>

            <div>
                <div class="bg-white rounded-2xl p-8 shadow-sm">

                    <!-- Dropdown typ księgowości -->
                    <div class="relative mb-4" id="uk-kalk-wrapper">
                        <button id="uk-kalk-btn"
                            class="w-full flex items-center justify-between px-5 py-4 border border-slate-200 rounded-xl text-slate-500 text-sm hover:border-slate-300 transition-colors bg-white"
                            aria-haspopup="listbox" aria-expanded="false">
                            <span id="uk-kalk-label">Wybierz z listy</span>
                            <i data-lucide="chevron-down" class="w-5 h-5 text-slate-400 stroke-[1.5] shrink-0 transition-transform" id="uk-kalk-chevron"></i>
                        </button>
                        <div id="uk-kalk-list" class="absolute top-full left-0 right-0 mt-2 bg-white border border-slate-200 rounded-xl shadow-lg z-20 overflow-hidden hidden">
                            <button data-value="uproszczona" class="uk-kalk-option w-full text-left px-5 py-4 text-sm text-slate-700 hover:bg-emerald-50 transition-colors border-b border-slate-100">Księgowość uproszczona (KPiR, ewidencja ryczałtowa)</button>
                            <button data-value="pelna"       class="uk-kalk-option w-full text-left px-5 py-4 text-sm text-slate-700 hover:bg-emerald-50 transition-colors">Pełna księgowość (KH)</button>
                        </div>
                    </div>

                    <!-- Input liczba dokumentów -->
                    <div class="mb-4">
                        <input id="uk-kalk-docs" type="number" min="1" placeholder="Liczba dokumentów miesięcznie"
                            class="w-full px-5 py-4 border border-slate-200 rounded-xl text-slate-800 text-sm placeholder-slate-400 hover:border-slate-300 focus:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-100 transition-colors bg-white" />
                    </div>

                    <!-- Przycisk -->
                    <button id="uk-kalk-submit" class="w-full py-3.5 rounded-full bg-white text-slate-800 text-base font-semibold border border-slate-200 hover:bg-slate-50 hover:border-slate-300 transition-colors mb-5">
                        Oblicz kwotę obsługi
                    </button>

                    <!-- Wynik -->
                    <div>
                        <p class="text-sm text-slate-400 mb-1">Orientacyjna cena netto</p>
                        <p class="text-4xl font-bold text-slate-900">
                            <span id="uk-kalk-price">0,00 zł</span>
                            <span class="text-lg font-normal text-slate-400 ml-1">(netto)</span>
                        </p>
                    </div>

                </div>

                <p class="mt-4 text-xs text-white/55 leading-relaxed max-w-md">
                    <?php echo mer_esc($disclaimer); ?>
                </p>
            </div>

        </div>
    </div>
</section>

<script>
(function () {
    var btn      = document.getElementById('uk-kalk-btn');
    var list     = document.getElementById('uk-kalk-list');
    var labelEl  = document.getElementById('uk-kalk-label');
    var chevron  = document.getElementById('uk-kalk-chevron');
    var inputD   = document.getElementById('uk-kalk-docs');
    var priceEl  = document.getElementById('uk-kalk-price');
    var submitBtn = document.getElementById('uk-kalk-submit');
    if (!btn) return;

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

    var selectedType = null;
    var typeLabels = {
        uproszczona: 'Księgowość uproszczona (KPiR, ewidencja ryczałtowa)',
        pelna: 'Pełna księgowość (KH)'
    };

    function calcPrice() {
        var docs = parseInt(inputD.value, 10);
        if (!selectedType || !docs || docs < 1) {
            priceEl.textContent = '0,00 zł';
            return;
        }
        var tiers = selectedType === 'pelna' ? tiersKH : tiersUP;
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

    btn.addEventListener('click', function () {
        var isOpen = !list.classList.contains('hidden');
        list.classList.toggle('hidden', isOpen);
        chevron.style.transform = isOpen ? '' : 'rotate(180deg)';
        btn.setAttribute('aria-expanded', String(!isOpen));
    });

    document.querySelectorAll('.uk-kalk-option').forEach(function (opt) {
        opt.addEventListener('click', function () {
            selectedType = opt.dataset.value;
            labelEl.textContent = typeLabels[selectedType];
            labelEl.classList.remove('text-slate-500');
            labelEl.classList.add('text-slate-800');
            list.classList.add('hidden');
            chevron.style.transform = '';
            btn.setAttribute('aria-expanded', 'false');
        });
    });

    submitBtn.addEventListener('click', calcPrice);

    document.addEventListener('click', function (e) {
        if (!document.getElementById('uk-kalk-wrapper').contains(e.target)) {
            list.classList.add('hidden');
            chevron.style.transform = '';
            btn.setAttribute('aria-expanded', 'false');
        }
    });
})();
</script>
