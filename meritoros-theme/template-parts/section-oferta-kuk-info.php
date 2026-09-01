<?php
$intro     = mer_field('op_intro', '');
$team_info = mer_field('op_team_info', '');

// Obowiązki – do 12 pól ACF; jeśli puste, fallback dla oferty Księgowej z j. ukraińskim
$duty_fallbacks = [
    1 => __('Prowadzenie ksiąg rachunkowych i ewidencji podatkowych (PKPB)', 'meritoros'),
    2 => __('Sporządzanie deklaracji i sprawozdań finansowych (CIT, VAT, PIT)', 'meritoros'),
    3 => __('Przygotowywanie rocznych sprawozdań finansowych i analiz dla klientów', 'meritoros'),
    4 => __('Bezpośredni kontakt z klientami (telefon, e-mail) w sprawach rozliczeń', 'meritoros'),
    5 => __('Współpraca z urzędami skarbowymi, instytucjami finansowymi i podmiotami zewnętrznymi, w tym reprezentacja klientów', 'meritoros'),
    6 => '', 7 => '', 8 => '', 9 => '', 10 => '', 11 => '', 12 => '',
];

// Wymagania – do 12 pól ACF; fallback dla oferty Księgowej z j. ukraińskim
$req_fallbacks = [
    1 => __('Minimum 2 lata doświadczenia w samodzielnym prowadzeniu ksiąg rachunkowych w biurze rachunkowym; certyfikat MF mile widziany', 'meritoros'),
    2 => __('Biegła znajomość języka ukraińskiego i rosyjskiego do komunikacji z klientami', 'meritoros'),
    3 => __('Doświadczenie w samodzielnym sporządzaniu sprawozdań finansowych', 'meritoros'),
    4 => __('Praktyczna znajomość przepisów rachunkowych, prawa podatkowego i przepisów VAT', 'meritoros'),
    5 => __('Biegłość w MS Office (szczególnie Excel) i oprogramowaniu księgowym Comarch Optima', 'meritoros'),
    6 => __('Skrupulatność i wysokie zdolności organizacyjne', 'meritoros'),
    7 => __('Zdolności analitycznego myślenia', 'meritoros'),
    8 => '', 9 => '', 10 => '', 11 => '', 12 => '',
];

$obowiazki = [];
$wymagania = [];
$technologie = [];
$mile_widziane = [];
for ($i = 1; $i <= 12; $i++) {
    $d = __( mer_field("op_duty_{$i}", $duty_fallbacks[$i]), 'meritoros' );
    if ($d !== '') $obowiazki[] = $d;

    $r = __( mer_field("op_req_{$i}", $req_fallbacks[$i]), 'meritoros' );
    if ($r !== '') $wymagania[] = $r;
}
for ($i = 1; $i <= 6; $i++) {
    $t = mer_field("op_tech_{$i}", '');
    if ($t !== '') $technologie[] = $t;

    $n = mer_field("op_nice_{$i}", '');
    if ($n !== '') $mile_widziane[] = $n;
}
?>

<section class="py-16 md:py-24 bg-white relative overflow-hidden">
    <div class="absolute -right-32 top-1/4 w-[420px] h-[420px] rounded-full border-[40px] border-[#00d084]/20 pointer-events-none"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">

        <?php if ($intro || $team_info) : ?>
        <div class="mb-12 max-w-5xl space-y-6">
            <?php if ($intro) : ?>
            <div class="text-lg text-slate-600 leading-relaxed">
                <?php echo wp_kses_post($intro); ?>
            </div>
            <?php endif; ?>
            <?php if ($team_info) : ?>
            <div>
                <h3 class="text-base font-semibold text-slate-400 uppercase tracking-wider mb-2">Informacje o zespole</h3>
                <div class="text-lg text-slate-600 leading-relaxed">
                    <?php echo wp_kses_post($team_info); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20">

            <!-- Zakres obowiązków -->
            <?php if ($obowiazki) : ?>
            <div>
                <div class="flex items-center gap-3 mb-8">
                    <span class="w-10 h-10 rounded-xl bg-[#00d084]/10 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="list-checks" class="w-5 h-5 text-[#00d084]"></i>
                    </span>
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-900">Zakres obowiązków</h2>
                </div>
                <ul class="space-y-4">
                    <?php foreach ($obowiazki as $item) : ?>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-[#00d084]/15 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i data-lucide="check" class="w-3.5 h-3.5 text-[#00d084]"></i>
                        </span>
                        <span class="text-lg text-slate-700 leading-relaxed"><?php echo mer_esc($item); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <!-- Wymagania -->
            <?php if ($wymagania) : ?>
            <div>
                <div class="flex items-center gap-3 mb-8">
                    <span class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="user-check" class="w-5 h-5 text-slate-600"></i>
                    </span>
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-900">Wymagania</h2>
                </div>
                <ul class="space-y-4">
                    <?php foreach ($wymagania as $item) : ?>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-500"></i>
                        </span>
                        <span class="text-lg text-slate-700 leading-relaxed"><?php echo mer_esc($item); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>

                <?php if ($mile_widziane) : ?>
                <div class="mt-8 pt-8 border-t border-slate-100">
                    <h3 class="text-lg font-semibold text-slate-600 mb-4">Mile widziane</h3>
                    <ul class="space-y-4">
                        <?php foreach ($mile_widziane as $item) : ?>
                        <li class="flex items-start gap-3">
                            <span class="w-6 h-6 rounded-full bg-amber-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i data-lucide="plus" class="w-3.5 h-3.5 text-amber-500"></i>
                            </span>
                            <span class="text-lg text-slate-700 leading-relaxed"><?php echo mer_esc($item); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

        </div>

        <?php if ($technologie) : ?>
        <div class="mt-16 pt-16 border-t border-slate-100">
            <div class="flex items-center gap-3 mb-8">
                <span class="w-10 h-10 rounded-xl bg-[#00d084]/10 flex items-center justify-center flex-shrink-0">
                    <i data-lucide="cpu" class="w-5 h-5 text-[#00d084]"></i>
                </span>
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900">Nasze środowisko technologiczne</h2>
            </div>
            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <?php foreach ($technologie as $item) : ?>
                <li class="flex items-start gap-3">
                    <span class="w-6 h-6 rounded-full bg-[#00d084]/15 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-[#00d084]"></i>
                    </span>
                    <span class="text-lg text-slate-700 leading-relaxed"><?php echo mer_esc($item); ?></span>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>


    </div>
</section>
