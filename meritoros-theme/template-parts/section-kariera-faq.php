<?php
$title = mer_field('kar_faq_title', __('Najczęściej zadawane pytania', 'meritoros'));

$_kar_page_id = get_the_ID();
$_kar_orig_id = apply_filters('wpml_object_id', $_kar_page_id, get_post_type(), true, apply_filters('wpml_default_language', null));

$items = [];
for ($i = 1; $i <= 8; $i++) {
    $item = get_field("kar_faq_{$i}");
    if (!empty($item['question'])) {
        $items[] = [
            'question' => __($item['question'], 'meritoros'),
            'answer'   => __($item['answer'] ?? '', 'meritoros'),
        ];
    }
}

// Domyślne pytania jeśli brak danych w ACF
if (empty($items)) {
    $items = [
        ['question' => __('Jak wygląda proces rekrutacji w Meritoros?', 'meritoros'),    'answer' => __('Nasz proces rekrutacji składa się z kilku etapów: przeglądu CV, rozmowy telefonicznej, spotkania rekrutacyjnego i decyzji. Staramy się, aby cały proces trwał nie dłużej niż 2–3 tygodnie.', 'meritoros')],
        ['question' => __('Czy oferujecie pracę zdalną lub hybrydową?', 'meritoros'),    'answer' => __('Pracujemy w modelu hybrydowym – część tygodnia w biurze, część zdalnie. Dokładny podział zależy od stanowiska i jest ustalany indywidualnie.', 'meritoros')],
        ['question' => __('Jakie są możliwości rozwoju zawodowego?', 'meritoros'),       'answer' => __('Stawiamy na ciągły rozwój naszych pracowników. Oferujemy szkolenia wewnętrzne, dofinansowanie kursów zewnętrznych oraz możliwość awansu wewnątrz organizacji.', 'meritoros')],
        ['question' => __('Czy potrzebuję doświadczenia, żeby aplikować?', 'meritoros'), 'answer' => __('Zależy od stanowiska – część ofert skierowana jest do osób bez doświadczenia, które chcą się uczyć. Każdą ofertę pracy opisujemy dokładnie pod kątem wymagań.', 'meritoros')],
    ];
}
?>

<section class="py-16 md:py-24 bg-[#f8f9fa]" id="faq">
    <div class="max-w-7xl mx-auto px-6">

        <div class="max-w-3xl mx-auto">
            <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 mb-12 text-center">
                <?php echo mer_esc($title); ?>
            </h2>

            <div class="divide-y divide-slate-200">
                <?php foreach ($items as $i => $item) : ?>
                <div class="py-5">
                    <button
                        class="faq-btn w-full flex items-center justify-between gap-4 text-left group"
                        aria-expanded="false"
                        aria-controls="faq-ans-<?php echo $i; ?>">
                        <span class="text-lg sm:text-xl font-semibold text-slate-900 leading-snug group-hover:text-[#00d084] transition-colors duration-200">
                            <?php echo mer_esc($item['question']); ?>
                        </span>
                        <i data-lucide="plus"
                           class="w-5 h-5 text-[#00d084] shrink-0"
                           style="transition: transform .25s ease"></i>
                    </button>
                    <div id="faq-ans-<?php echo $i; ?>"
                         style="max-height:0;overflow:hidden;transition:max-height .3s ease">
                        <p class="pt-4 pb-1 text-lg text-slate-500 leading-relaxed">
                            <?php echo mer_esc($item['answer']); ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>

<script>
(function () {
    var btns = document.querySelectorAll('.faq-btn');
    btns.forEach(function (btn) {
        var answerId = btn.getAttribute('aria-controls');
        var answer   = document.getElementById(answerId);
        var icon     = btn.querySelector('[data-lucide]');

        btn.addEventListener('click', function () {
            var isOpen = btn.getAttribute('aria-expanded') === 'true';

            // Zamknij wszystkie
            btns.forEach(function (b) {
                b.setAttribute('aria-expanded', 'false');
                document.getElementById(b.getAttribute('aria-controls')).style.maxHeight = '0';
                b.querySelector('[data-lucide]').style.transform = '';
            });

            // Otwórz kliknięty (jeśli był zamknięty)
            if (!isOpen) {
                btn.setAttribute('aria-expanded', 'true');
                answer.style.maxHeight = answer.scrollHeight + 'px';
                icon.style.transform   = 'rotate(45deg)';
            }
        });
    });
})();
</script>
