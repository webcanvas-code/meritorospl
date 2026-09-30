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
$cf7_id        = trim(get_field('nl_cf7_id',     $_nl_id) ?: '');

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

            <!-- Right: Mailchimp Form -->
            <div class="bg-white p-7 sm:p-10 lg:p-12 flex flex-col justify-center rounded-b-2xl md:rounded-b-[3rem] lg:rounded-b-none lg:rounded-r-[3rem]">
                <h3 class="text-2xl font-bold tracking-tight text-slate-900 mb-1">
                    <?php echo mer_esc($form_title); ?>
                </h3>
                <p class="text-slate-500 text-sm font-light mb-6">
                    <?php echo mer_esc($form_sub); ?>
                </p>

                <form action="https://meritoros.us12.list-manage.com/subscribe/post-json?u=8e5ab8b1fb114de4f9ec692f5&amp;id=655a19d89a&amp;f_id=0024b7e0f0" method="post" id="mer-mc-form" novalidate>

                    <!-- Checkboxes zainteresowań -->
                    <div class="flex flex-col gap-2 mb-5">
                        <label class="flex items-center gap-2.5 cursor-pointer">
                            <input type="checkbox" value="1" name="group[53955][1]" id="mc-interest-tax" class="w-4 h-4 rounded" style="accent-color:#00d084">
                            <span class="text-sm text-slate-700 font-medium"><?php esc_html_e('Chcę otrzymywać miesięczne podsumowania zmian podatkowych', 'meritoros'); ?></span>
                        </label>
                        <label class="flex items-center gap-2.5 cursor-pointer">
                            <input type="checkbox" value="2" name="group[53955][2]" id="mc-interest-jobs" class="w-4 h-4 rounded" style="accent-color:#00d084">
                            <span class="text-sm text-slate-700 font-medium"><?php esc_html_e('Chcę otrzymywać oferty pracy', 'meritoros'); ?></span>
                        </label>
                    </div>

                    <!-- Email -->
                    <div class="flex gap-2 mb-4">
                        <input type="email" name="EMAIL" id="mer-mc-email" placeholder="<?php esc_attr_e('Twój adres e-mail', 'meritoros'); ?>" required
                            class="flex-1 px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#00d084] focus:border-transparent">
                        <button type="submit" id="mer-mc-submit"
                            class="px-5 py-3 bg-[#00d084] hover:bg-[#00b872] text-white text-sm font-semibold rounded-xl transition-colors whitespace-nowrap">
                            <?php esc_html_e('Zapisz się', 'meritoros'); ?>
                        </button>
                    </div>

                    <!-- Honeypot -->
                    <div style="position:absolute;left:-5000px" aria-hidden="true">
                        <input type="text" name="b_8e5ab8b1fb114de4f9ec692f5_655a19d89a" tabindex="-1" value="">
                    </div>

                    <!-- Status -->
                    <div id="mer-mc-status" class="hidden text-sm rounded-lg px-4 py-3 mb-4"></div>

                    <!-- RODO -->
                    <p class="text-slate-400 text-xs leading-relaxed">
                        <?php esc_html_e('Administratorem danych jest Meritoros SA, Aleja Pokoju 62/8, Kraków. Dane przetwarzane są w celu wysyłki newslettera. Więcej informacji w', 'meritoros'); ?>
                        <a href="https://meritoros.pl/wp-content/uploads/2025/07/Polityka-prywatnosci-1.pdf" class="underline" target="_blank" rel="nofollow"><?php esc_html_e('Polityce Prywatności', 'meritoros'); ?></a>
                        <?php esc_html_e('i', 'meritoros'); ?>
                        <a href="https://meritoros.pl/wp-content/uploads/2025/07/Polityka-prywatnosci-1.pdf" class="underline" target="_blank" rel="nofollow"><?php esc_html_e('Regulaminie Newslettera', 'meritoros'); ?></a>.
                    </p>

                </form>

                <script>
                (function () {
                    var form   = document.getElementById('mer-mc-form');
                    var status = document.getElementById('mer-mc-status');
                    var btn    = document.getElementById('mer-mc-submit');
                    if (!form) return;

                    form.addEventListener('submit', function (e) {
                        e.preventDefault();

                        var email = document.getElementById('mer-mc-email').value.trim();
                        if (!email) return;

                        btn.disabled = true;
                        btn.textContent = '...';
                        status.className = 'hidden text-sm rounded-lg px-4 py-3 mb-4';

                        var url = form.action.replace('/post-json?', '/post-json?c=mcCallback&') + '&EMAIL=' + encodeURIComponent(email);
                        // dodaj checkboxy
                        form.querySelectorAll('input[type=checkbox]:checked').forEach(function(cb) {
                            url += '&' + encodeURIComponent(cb.name) + '=' + encodeURIComponent(cb.value);
                        });
                        // honeypot
                        var hp = form.querySelector('input[name^="b_"]');
                        if (hp) url += '&' + encodeURIComponent(hp.name) + '=';

                        var script = document.createElement('script');
                        window.mcCallback = function (data) {
                            script.parentNode && script.parentNode.removeChild(script);
                            btn.disabled = false;
                            btn.textContent = '<?php esc_html_e('Zapisz się', 'meritoros'); ?>';
                            status.classList.remove('hidden');
                            if (data.result === 'success') {
                                status.className = 'text-sm rounded-lg px-4 py-3 mb-4 bg-green-50 text-green-700';
                                status.textContent = '<?php esc_html_e('Prawie gotowe! Sprawdź skrzynkę e-mail i potwierdź subskrypcję.', 'meritoros'); ?>';
                                form.reset();
                            } else {
                                status.className = 'text-sm rounded-lg px-4 py-3 mb-4 bg-red-50 text-red-700';
                                status.textContent = data.msg ? data.msg.replace(/<[^>]+>/g, '') : '<?php esc_html_e('Wystąpił błąd. Spróbuj ponownie.', 'meritoros'); ?>';
                            }
                        };
                        script.src = url;
                        document.head.appendChild(script);
                    });
                })();
                </script>
            </div>

        </div>
    </div>
</section>
