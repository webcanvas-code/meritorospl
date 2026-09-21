<?php
// Czytaj pola zawsze ze strony głównej — ACFML zwróci wersję w aktualnym języku
$_nl_id = (int) get_option('page_on_front');
$nl_label      = (get_field('nl_label',            $_nl_id) ?: __('Newsletter', 'meritoros'));
$nl_title      = (get_field('nl_title',            $_nl_id) ?: __('Bądź na bieżąco ze zmianami podatkowymi', 'meritoros'));
$nl_desc       = (get_field('nl_desc',             $_nl_id) ?: __('Interesują Cię zmiany podatkowe? Szukasz pracy w obszarze księgowości lub kadr? Zapisz się i otrzymuj to, co ważne.', 'meritoros'));
$sub_count     = (get_field('nl_subscriber_count', $_nl_id) ?: __('2 400+ czytelników', 'meritoros'));
$sub_label     = (get_field('nl_subscriber_label', $_nl_id) ?: __('dołączyło do naszego newslettera', 'meritoros'));
$form_title    = (get_field('nl_form_title',       $_nl_id) ?: __('Zapisz się bezpłatnie', 'meritoros'));
$form_sub      = (get_field('nl_form_sub',         $_nl_id) ?: __('Dołącz do ponad 2 400 specjalistów finansowych.', 'meritoros'));
$cf7_id        = intval(get_field('nl_cf7_id',     $_nl_id) ?: 0);

$benefit_defaults = [
    1 => __('Miesięczne podsumowania zmian podatkowych', 'meritoros'),
    2 => __('Aktualne oferty pracy z obszaru finansów i kadr', 'meritoros'),
    3 => __('Praktyczne wskazówki i komentarze ekspertów', 'meritoros'),
    4 => __('Możliwość wypisania się w dowolnym momencie', 'meritoros'),
];
$benefits = [];
for ($i = 1; $i <= 4; $i++) {
    $text = (get_field("nl_benefit_{$i}", $_nl_id) ?: $benefit_defaults[$i]);
    if (!empty($text)) {
        $benefits[] = ['text' => $text];
    }
}
?>

<section id="newsletter" class="py-16 md:py-24 px-6 lg:px-12 bg-white border-t border-slate-100">
    <div class="max-w-[1400px] mx-auto">
        <div class="bg-slate-900 rounded-2xl md:rounded-[3rem] overflow-hidden grid grid-cols-1 lg:grid-cols-2">

            <!-- Left: Branding + Benefits -->
            <div class="relative p-7 sm:p-10 lg:p-12 flex flex-col justify-between overflow-hidden">
                <div class="absolute -bottom-16 -left-16 w-72 h-72 rounded-full bg-[#00d084]/10 blur-3xl pointer-events-none"></div>
                <div class="absolute top-8 right-8 w-40 h-40 rounded-full bg-[#00d084]/5 blur-2xl pointer-events-none"></div>

                <div class="relative z-10">
                    <div class="flex items-center mb-6 lg:mb-8">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo.svg'); ?>" alt="<?php bloginfo('name'); ?>" class="h-8 w-auto brightness-0 invert" loading="lazy">
                    </div>

                    <span class="text-[#00d084] uppercase tracking-widest text-sm font-bold mb-3 block">
                        <?php echo mer_esc($nl_label); ?>
                    </span>
                    <h2 class="text-pretty text-3xl lg:text-4xl font-bold tracking-tight text-white leading-snug mb-4">
                        <?php echo mer_esc($nl_title); ?>
                    </h2>
                    <p class="text-slate-400 text-base font-light leading-relaxed mb-6 max-w-sm">
                        <?php echo mer_esc($nl_desc); ?>
                    </p>

                    <div class="flex flex-col gap-2.5">
                        <?php foreach ($benefits as $benefit) : ?>
                            <div class="flex items-center gap-2.5">
                                <div class="w-6 h-6 rounded-full bg-[#00d084]/20 flex items-center justify-center shrink-0">
                                    <i data-lucide="check" class="w-3.5 h-3.5 text-[#00d084] stroke-[2.5]"></i>
                                </div>
                                <span class="text-slate-300 text-sm font-medium">
                                    <?php echo mer_esc($benefit['text'] ?? ''); ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="relative z-10 mt-8 flex items-center gap-4">
                    <div class="flex -space-x-2">
                        <?php
                        $avatar_colors   = ['bg-[#00d084]', 'bg-blue-500', 'bg-purple-500', 'bg-slate-600'];
                        $avatar_initials = ['AK', 'MC', 'SW', '+'];
                        foreach ($avatar_colors as $i => $color) : ?>
                            <div class="w-9 h-9 rounded-full <?php echo $color; ?> border-2 border-slate-900 flex items-center justify-center text-white text-xs font-bold">
                                <?php echo mer_esc($avatar_initials[$i]); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div>
                        <p class="text-white font-bold text-sm"><?php echo mer_esc($sub_count); ?></p>
                        <p class="text-slate-500 text-xs"><?php echo mer_esc($sub_label); ?></p>
                    </div>
                </div>
            </div>

            <!-- Right: CF7 Form -->
            <div class="bg-white p-7 sm:p-10 lg:p-12 flex flex-col justify-center rounded-b-2xl md:rounded-b-[3rem] lg:rounded-b-none lg:rounded-r-[3rem]">
                <h3 class="text-2xl font-bold tracking-tight text-slate-900 mb-1">
                    <?php echo mer_esc($form_title); ?>
                </h3>
                <p class="text-slate-500 text-sm font-light mb-4">
                    <?php echo mer_esc($form_sub); ?>
                </p>

                <!-- Checkboxy zainteresowań -->
                <div style="display:flex;flex-wrap:wrap;align-items:center;gap:6px 24px;margin-bottom:12px">
                    <label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer">
                        <input type="checkbox" id="nl-interest-tax" style="width:16px;height:16px;accent-color:#00d084">
                        <span style="font-size:0.8125rem;color:#334155;font-weight:500"><?php esc_html_e('Informacje podatkowo-księgowe', 'meritoros'); ?></span>
                    </label>
                    <label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer">
                        <input type="checkbox" id="nl-interest-jobs" style="width:16px;height:16px;accent-color:#00d084">
                        <span style="font-size:0.8125rem;color:#334155;font-weight:500"><?php esc_html_e('Oferty pracy', 'meritoros'); ?></span>
                    </label>
                </div>

                <div class="mer-nl-form">
                    <?php if ($cf7_id) : ?>
                        <?php echo do_shortcode('[contact-form-7 id="' . $cf7_id . '"]'); ?>
                    <?php else : ?>
                        <p class="text-slate-400 text-sm italic"><?php esc_html_e('Przypisz formularz CF7 w ustawieniach strony głównej (zakładka Newsletter → ID formularza CF7).', 'meritoros'); ?></p>
                    <?php endif; ?>
                </div>

                <script>
                (function () {
                    var cbTax  = document.getElementById('nl-interest-tax');
                    var cbJobs = document.getElementById('nl-interest-jobs');
                    var wrapper = cbTax && cbTax.closest('.mer-nl-form') ? cbTax.closest('.mer-nl-form') : document.querySelector('.mer-nl-form');

                    function getForm() {
                        return document.querySelector('.mer-nl-form form');
                    }

                    function injectHidden(form) {
                        ['nl_interest_tax', 'nl_interest_jobs'].forEach(function (name) {
                            var old = form.querySelector('input[name="' + name + '"]');
                            if (old) old.parentNode.removeChild(old);
                        });
                        var t = document.createElement('input');
                        t.type = 'hidden'; t.name = 'nl_interest_tax';
                        t.value = (cbTax && cbTax.checked) ? '1' : '';
                        form.appendChild(t);

                        var j = document.createElement('input');
                        j.type = 'hidden'; j.name = 'nl_interest_jobs';
                        j.value = (cbJobs && cbJobs.checked) ? '1' : '';
                        form.appendChild(j);
                    }

                    // CF7 ładuje formularz przez AJAX — czekamy na niego
                    var observer = new MutationObserver(function () {
                        var form = getForm();
                        if (!form) return;
                        observer.disconnect();
                        form.addEventListener('submit', function () { injectHidden(form); });
                    });
                    var nlWrap = document.querySelector('.mer-nl-form');
                    if (nlWrap) observer.observe(nlWrap, { childList: true, subtree: true });

                    // Jeśli formularz już jest w DOM
                    var form = getForm();
                    if (form) {
                        observer.disconnect();
                        form.addEventListener('submit', function () { injectHidden(form); });
                    }
                })();
                </script>
            </div>

        </div>
    </div>
</section>
