<?php
// Czytaj pola zawsze ze strony głównej — ACFML zwróci wersję w aktualnym języku
$_test_id = (int) get_option('page_on_front');

$label = (get_field('testimonials_label', $_test_id) ?: 'Opinie klientów');
$title = (get_field('testimonials_title', $_test_id) ?: 'Sprawdź, co mówią o nas inni');

$test_defaults = [
    1 => ['company' => 'HPC',     'logo_html' => '<span class="text-xl font-bold tracking-tight text-[#5ba3d0]">HPC</span>',         'quote' => 'Mam księgowość w bezpiecznych rękach i wiem, że nie muszę się o to już martwić.',                                                         'author' => 'Sebastian Wiśniewski', 'role' => 'HP Cepolgol S.A.',              'initials' => 'SW', 'highlighted' => false],
    2 => ['company' => 'Printbox','logo_html' => '<span class="text-lg font-bold tracking-tight text-white">Printbox</span>',        'quote' => 'Meritoros dostarczył nam stabilność i pewność, w trudnych momentach zawsze mamy właściwe odpowiedzi.',                                'author' => 'Michał Czaicki',       'role' => 'CEO & Co-Founder, Printbox', 'initials' => 'MC', 'highlighted' => true],
    3 => ['company' => 'SITECH',  'logo_html' => '<span class="text-lg font-bold tracking-tight text-slate-900">SITECH</span>',      'quote' => 'Profesjonalizm na każdym kroku. Polecamy Meritoros każdej firmie, która ceni sobie bezpieczeństwo i jakość obsługi.',                  'author' => 'Anna Kowalczyk',       'role' => 'Dyrektor Finansowy, SITECH', 'initials' => 'AK', 'highlighted' => false],
];

$items = [];
for ($i = 1; $i <= 3; $i++) {
    $def          = $test_defaults[$i];
    $_company_acf = get_field("test_{$i}_company",  $_test_id);
    $_logo_acf    = get_field("test_{$i}_logo_html", $_test_id);
    $items[] = [
        'company'           => $_company_acf ?: $def['company'],
        'company_logo_html' => $_logo_acf ?: ($_company_acf ? esc_html($_company_acf) : $def['logo_html']),
        'quote'             => (get_field("test_{$i}_quote",        $_test_id) ?: $def['quote']),
        'author'            => (get_field("test_{$i}_author",       $_test_id) ?: $def['author']),
        'role'              => (get_field("test_{$i}_role",         $_test_id) ?: $def['role']),
        'initials'          => (get_field("test_{$i}_initials",     $_test_id) ?: $def['initials']),
        'highlighted'       => (bool) (get_field("test_{$i}_highlighted", $_test_id) ?: $def['highlighted']),
    ];
}

$stat_defaults = [
    1 => ['value' => '1200+', 'label' => 'Obsługiwanych klientów',   'accent' => false],
    2 => ['value' => '18+',   'label' => 'Lat na rynku',             'accent' => false],
    3 => ['value' => '98%',   'label' => 'Klientów poleca nas dalej', 'accent' => true],
    4 => ['value' => '35+',   'label' => 'Ekspertów w zespole',      'accent' => false],
];

$stats = [];
for ($i = 1; $i <= 4; $i++) {
    $def     = $stat_defaults[$i];
    $stats[] = [
        'value'  => (get_field("test_stat_{$i}_value",  $_test_id) ?: $def['value']),
        'label'  => (get_field("test_stat_{$i}_label",  $_test_id) ?: $def['label']),
        'accent' => (bool) (get_field("test_stat_{$i}_accent", $_test_id) ?: $def['accent']),
    ];
}
?>

<section class="overflow-hidden px-6 lg:px-12 bg-slate-50 flex flex-col justify-center py-14 sm:py-16 lg:py-0 lg:h-screen lg:min-h-[700px]">
    <div class="max-w-[1400px] mx-auto w-full">

        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
            <div>
                <span class="text-[#48c279] uppercase tracking-widest text-base font-bold mb-4 block">
                    <?php echo mer_esc($label); ?>
                </span>
                <h2 class="text-3xl lg:text-4xl xl:text-5xl font-bold tracking-tight text-slate-900 whitespace-nowrap">
                    <?php echo mer_esc($title); ?>
                </h2>
            </div>
            <a href="<?php echo esc_url(home_url('/historie-klientow/')); ?>"
               class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-900 transition-colors group text-base font-medium shrink-0">
                <?php esc_html_e('Historie klientów', 'meritoros'); ?>
                <i data-lucide="arrow-up-right" class="w-5 h-5 stroke-[1.5] group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php foreach ($items as $item) :
                $highlighted = !empty($item['highlighted']);
                $logo_html   = wp_kses($item['company_logo_html'] ?? esc_html($item['company'] ?? ''), [
                    'span' => ['class' => []],
                    'div'  => ['class' => []],
                ]);
                $quote    = esc_html($item['quote'] ?? '');
                $author   = esc_html($item['author'] ?? '');
                $role     = esc_html($item['role'] ?? '');
                $initials = esc_html($item['initials'] ?? mb_substr($item['author'] ?? 'XX', 0, 2));
            ?>
                <?php if ($highlighted) : ?>
                    <div class="bg-[#48c279] rounded-[2rem] p-5 lg:p-6 flex flex-col justify-between hover:-translate-y-1 hover:shadow-xl hover:shadow-[#48c279]/30 transition-all duration-300">
                        <div>
                            <div class="flex items-center gap-1 mb-4">
                                <?php for ($s = 0; $s < 5; $s++) : ?>
                                    <i data-lucide="star" class="w-5 h-5 fill-white text-white stroke-none"></i>
                                <?php endfor; ?>
                            </div>
                            <p class="text-lg italic font-light text-white/90 leading-relaxed mb-4">
                                &ldquo;<?php echo $quote; ?>&rdquo;
                            </p>
                        </div>
                        <div class="flex items-center gap-3 pt-4 border-t border-white/20">
                            <div>
                                <p class="text-white font-semibold text-sm"><?php echo $author; ?></p>
                                <?php if ($role) : ?>
                                    <p class="text-white/70 text-xs mt-0.5"><?php echo $role; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="bg-white border border-slate-200 rounded-[2rem] p-5 sm:p-6 lg:p-8 flex flex-col justify-between hover:-translate-y-1 hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300">
                        <div>
                            <div class="flex items-center gap-1 mb-6">
                                <?php for ($s = 0; $s < 5; $s++) : ?>
                                    <i data-lucide="star" class="w-5 h-5 fill-[#48c279] text-[#48c279] stroke-none"></i>
                                <?php endfor; ?>
                            </div>
                            <p class="text-lg italic font-light text-slate-600 leading-relaxed mb-5">
                                &ldquo;<?php echo $quote; ?>&rdquo;
                            </p>
                        </div>
                        <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                            <div>
                                <p class="text-slate-900 font-semibold text-sm"><?php echo $author; ?></p>
                                <?php if ($role) : ?>
                                    <p class="text-slate-500 text-xs mt-0.5"><?php echo $role; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Stats bar -->
        <?php if (!empty($stats)) : ?>
            <div class="mt-8 pt-6 border-t border-slate-200 grid grid-cols-2 md:grid-cols-4 gap-6">
                <?php foreach ($stats as $stat) :
                    $val    = esc_html($stat['value'] ?? '');
                    $slabel = esc_html($stat['label'] ?? '');
                    $accent = !empty($stat['accent']);
                ?>
                    <div class="text-center">
                        <p class="text-4xl font-bold <?php echo $accent ? 'text-[#48c279]' : 'text-slate-900'; ?> mb-1">
                            <?php echo $val; ?>
                        </p>
                        <p class="text-slate-500 text-base font-medium"><?php echo $slabel; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
