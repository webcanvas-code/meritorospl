<?php
$title       = mer_field('kp_kalk_title',       'Kalkulator – oszacuj wstępnie koszt obsługi');
$description = mer_field('kp_kalk_desc',        'Oszacuj wstępny koszt obsługi kadrowo-płacowej w kilka chwil. Wprowadź podstawowe informacje o swojej działalności, a my przygotujemy orientacyjną wycenę dopasowaną do Twoich potrzeb i skali zatrudnienia.');
$disclaimer  = mer_field('kp_kalk_disclaimer',  '* to jest wstępny szacunek, każda oferta jest jednak indywidualnie rozpatrywana i odpowiednio wyceniana.');

$rate_kp  = (float) mer_field('kp_kalk_rate_kp',  75);
$rate_k   = (float) mer_field('kp_kalk_rate_k',   52);
$rate_p   = (float) mer_field('kp_kalk_rate_p',   52);
$rate_sub = (float) mer_field('kp_kalk_rate_sub', 42);
?>

<section id="kalkulator" class="py-10 md:py-20 bg-[#00d084] relative overflow-hidden">

    <!-- Dekoracyjne okręgi -->
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

                    <?php
                    $kp_ph_w   = esc_attr(__('Liczba pracowników', 'meritoros'));
                    $kp_ph_s   = esc_attr(__('Liczba podwykonawców', 'meritoros'));
                    $kp_ph_p   = esc_attr(__('Ilość wypłat na miesiąc', 'meritoros'));
                    ?>
                    <!-- Dropdown zakres -->
                    <div class="relative mb-4" id="kp-kalk-wrapper"
                         data-placeholder-workers="<?php echo $kp_ph_w; ?>"
                         data-placeholder-subs="<?php echo $kp_ph_s; ?>">
                        <button id="kp-kalk-btn"
                            class="mer-btn mer-btn--white w-full flex items-center justify-between px-5 py-4 border border-slate-200 rounded-xl text-slate-500 text-sm hover:border-slate-300 transition-colors bg-white"
                            aria-haspopup="listbox" aria-expanded="false">
                            <span id="kp-kalk-label"><?php echo esc_html(__('Wybierz z listy', 'meritoros')); ?></span>
                            <i data-lucide="chevron-down" class="w-5 h-5 text-slate-400 stroke-[1.5] shrink-0 transition-transform" id="kp-kalk-chevron"></i>
                        </button>
                        <div id="kp-kalk-list" class="absolute top-full left-0 right-0 mt-2 bg-white border border-slate-200 rounded-xl shadow-lg z-20 overflow-hidden hidden">
                            <button data-value="kadry-place"  data-label="<?php echo esc_attr(__('Kadry i płace', 'meritoros')); ?>"                     class="kp-kalk-option w-full text-left px-5 py-4 text-sm text-slate-700 hover:bg-emerald-50 transition-colors border-b border-slate-100"><?php echo esc_html(__('Kadry i płace', 'meritoros')); ?></button>
                            <button data-value="kadry"        data-label="<?php echo esc_attr(__('Same kadry', 'meritoros')); ?>"                         class="kp-kalk-option w-full text-left px-5 py-4 text-sm text-slate-700 hover:bg-emerald-50 transition-colors border-b border-slate-100"><?php echo esc_html(__('Same kadry', 'meritoros')); ?></button>
                            <button data-value="place"        data-label="<?php echo esc_attr(__('Same płace', 'meritoros')); ?>"                         class="kp-kalk-option w-full text-left px-5 py-4 text-sm text-slate-700 hover:bg-emerald-50 transition-colors border-b border-slate-100"><?php echo esc_html(__('Same płace', 'meritoros')); ?></button>
                            <button data-value="podwykonawcy" data-label="<?php echo esc_attr(__('Rozliczenie umów (podwykonawcy)', 'meritoros')); ?>"    class="kp-kalk-option w-full text-left px-5 py-4 text-sm text-slate-700 hover:bg-emerald-50 transition-colors"><?php echo esc_html(__('Rozliczenie umów (podwykonawcy)', 'meritoros')); ?></button>
                        </div>
                    </div>

                    <!-- Dwa inputy obok siebie -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <input id="kp-kalk-pracownicy" type="number" min="1" placeholder="<?php echo $kp_ph_w; ?>"
                            class="mer-btn mer-btn--white w-full px-5 py-4 border border-slate-200 rounded-xl text-slate-800 text-sm placeholder-slate-400 hover:border-slate-300 focus:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-100 transition-colors bg-white" />
                        <input id="kp-kalk-wyplaty" type="number" min="1" placeholder="<?php echo $kp_ph_p; ?>"
                            class="mer-btn mer-btn--white w-full px-5 py-4 border border-slate-200 rounded-xl text-slate-800 text-sm placeholder-slate-400 hover:border-slate-300 focus:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-100 transition-colors bg-white" />
                    </div>

                    <!-- Przycisk -->
                    <button id="kp-kalk-submit" class="w-full py-3.5 rounded-full bg-white text-slate-800 text-base font-semibold border border-slate-200 hover:bg-slate-50 hover:border-slate-300 transition-colors mb-5">
                        <?php echo esc_html(__('Oblicz kwotę obsługi', 'meritoros')); ?>
                    </button>

                    <!-- Wynik -->
                    <div>
                        <p class="text-sm text-slate-400 mb-1"><?php echo esc_html(__('Orientacyjna cena netto', 'meritoros')); ?></p>
                        <p class="text-4xl font-bold text-slate-900">
                            <span id="kp-kalk-price">0,00 zł</span>
                            <span id="kp-kalk-suffix" class="text-lg font-normal text-slate-400 ml-1">(netto)</span>
                        </p>
                    </div>

                </div>
                <p class="mt-4 text-xs text-white/55 leading-relaxed max-w-md"><?php echo mer_esc($disclaimer); ?></p>
            </div>

        </div>
    </div>
</section>

<script>
(function () {
    var btn          = document.getElementById('kp-kalk-btn');
    var list         = document.getElementById('kp-kalk-list');
    var labelEl      = document.getElementById('kp-kalk-label');
    var chevron      = document.getElementById('kp-kalk-chevron');
    var inputP       = document.getElementById('kp-kalk-pracownicy');
    var inputW       = document.getElementById('kp-kalk-wyplaty');
    var priceEl      = document.getElementById('kp-kalk-price');
    var submitBtn    = document.getElementById('kp-kalk-submit');
    if (!btn) return;

    var rates = {
        'kadry-place':  <?php echo $rate_kp; ?>,
        'kadry':        <?php echo $rate_k; ?>,
        'place':        <?php echo $rate_p; ?>,
        'podwykonawcy': <?php echo $rate_sub; ?>
    };
    var wrapper = document.getElementById('kp-kalk-wrapper');
    var selectedScope = null;

    function calcPrice() {
        var persons = parseInt(inputP.value, 10);
        var payouts = parseInt(inputW.value, 10);
        if (!selectedScope || !persons || persons < 1 || !payouts || payouts < 1) {
            priceEl.textContent = '0,00 zł';
            return;
        }
        var total = rates[selectedScope] * persons * payouts;
        priceEl.textContent = total.toLocaleString('pl-PL', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' zł';
    }

    btn.addEventListener('click', function () {
        var isOpen = !list.classList.contains('hidden');
        list.classList.toggle('hidden', isOpen);
        chevron.style.transform = isOpen ? '' : 'rotate(180deg)';
        btn.setAttribute('aria-expanded', String(!isOpen));
    });

    document.querySelectorAll('.kp-kalk-option').forEach(function (opt) {
        opt.addEventListener('click', function () {
            selectedScope = opt.dataset.value;
            labelEl.textContent = opt.dataset.label;
            labelEl.classList.remove('text-slate-500');
            labelEl.classList.add('text-slate-800');
            inputP.placeholder = selectedScope === 'podwykonawcy' ? wrapper.dataset.placeholderSubs : wrapper.dataset.placeholderWorkers;
            list.classList.add('hidden');
            chevron.style.transform = '';
            btn.setAttribute('aria-expanded', 'false');
        });
    });

    submitBtn.addEventListener('click', calcPrice);

    document.addEventListener('click', function (e) {
        if (!document.getElementById('kp-kalk-wrapper').contains(e.target)) {
            list.classList.add('hidden');
            chevron.style.transform = '';
            btn.setAttribute('aria-expanded', 'false');
        }
    });
})();
</script>
