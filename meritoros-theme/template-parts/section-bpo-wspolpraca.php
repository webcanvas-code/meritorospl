<?php
$_page_id = get_the_ID();
$_orig_id = apply_filters('wpml_object_id', $_page_id, get_post_type(), true, apply_filters('wpml_default_language', null));

$title   = mer_field('bpo_wsp_title', 'Jak wygląda bieżąca współpraca');
$btn_txt = mer_field('bpo_wsp_btn_text', 'Poznaj więcej historii');
$btn_url = mer_field('bpo_wsp_btn_url',  '#');

$step_defaults = [
    ['title' => 'Indywidualna organizacja pracy',
     'lead'  => 'W zależności od potrzeb możemy pracować:',
     'items' => "na bieżąco – obsługując codzienne procesy księgowe lub kadrowe\nw cyklach tygodniowych\nw innych ustalonych odstępach czasu"],
    ['title' => 'Elastyczne zamknięcie miesiąca',
     'lead'  => 'Terminy zamknięcia miesiąca ustalamy indywidualnie z każdą firmą, uwzględniając jej wewnętrzne potrzeby raportowe oraz obowiązujące terminy podatkowe.',
     'items' => "część firm potrzebuje raportów finansowych do 20. dnia miesiąca\ninne wymagają wyników już w 3. lub 4. dniu roboczym nowego miesiąca"],
    ['title' => 'Zakres i częstotliwość raportowania ustalamy indywidualnie z każdym klientem.',
     'lead'  => 'W standardzie klient otrzymuje:',
     'items' => "rachunek zysków i strat\nbilans\nzestawienie należności i zobowiązań"],
];

$steps = [];
for ($i = 1; $i <= 3; $i++) {
    $s = get_field("bpo_wsp_step_{$i}") ?: ($_orig_id !== $_page_id ? get_field("bpo_wsp_step_{$i}", $_orig_id) : null);
    $d = $step_defaults[$i - 1];
    $steps[] = [
        'title' => is_array($s) && !empty($s['title']) ? $s['title'] : $d['title'],
        'lead'  => is_array($s) && !empty($s['lead'])  ? $s['lead']  : $d['lead'],
        'items' => array_filter(array_map('trim', explode("\n", is_array($s) && !empty($s['items']) ? $s['items'] : $d['items']))),
    ];
}
?>

<section class="py-16 md:py-24 bg-emerald-50 relative">
    <div class="absolute top-0 left-0 w-96 h-96 border-[40px] border-emerald-200/40 rounded-full -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-[600px] h-[600px] border-[60px] border-emerald-200/30 rounded-full translate-x-1/4 translate-y-1/4 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-center mb-10 md:mb-24 text-slate-900"><?php echo mer_esc($title); ?></h2>

        <div class="relative w-full max-w-5xl mx-auto">

            <!-- Step 01 -->
            <div class="relative w-[95%] sm:w-[90%] ml-auto">
                <div class="border-t border-r border-b border-slate-300 rounded-r-[3rem] sm:rounded-r-[4rem] p-6 sm:p-14 md:p-20 flex flex-col md:flex-row items-center gap-6 md:gap-20">
                    <div class="hidden md:block absolute top-0 right-full w-screen h-px bg-slate-300"></div>
                    <div class="text-[5rem] sm:text-[8rem] md:text-[10rem] font-medium text-[#2d8650] leading-none shrink-0 tracking-tighter">01</div>
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold mb-5 text-slate-900"><?php echo mer_esc($steps[0]['title']); ?></h3>
                        <?php if ($steps[0]['lead']) : ?>
                            <p class="text-slate-700 font-medium mb-4"><?php echo mer_esc($steps[0]['lead']); ?></p>
                        <?php endif; ?>
                        <ul class="space-y-3 text-slate-600">
                            <?php foreach ($steps[0]['items'] as $item) : ?>
                                <li class="flex items-start gap-3"><i data-lucide="check-circle-2" class="w-5 h-5 text-[#2d8650] shrink-0 mt-0.5"></i> <?php echo mer_esc($item); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Step 02 -->
            <div class="relative w-[95%] sm:w-[90%] mr-auto">
                <div class="border-t border-l border-b border-slate-300 rounded-l-[3rem] sm:rounded-l-[4rem] p-6 sm:p-14 md:p-20 flex flex-col md:flex-row items-center gap-6 md:gap-20 mt-6 md:mt-[-1px]">
                    <div class="flex-1 order-2 md:order-1 pl-0 md:pl-10">
                        <h3 class="text-2xl font-bold mb-5 text-slate-900"><?php echo mer_esc($steps[1]['title']); ?></h3>
                        <?php if ($steps[1]['lead']) : ?>
                            <p class="text-slate-700 font-medium mb-4 max-w-lg"><?php echo mer_esc($steps[1]['lead']); ?></p>
                        <?php endif; ?>
                        <ul class="space-y-3 text-slate-600 max-w-lg">
                            <?php foreach ($steps[1]['items'] as $item) : ?>
                                <li class="flex items-start gap-3"><i data-lucide="check-circle-2" class="w-5 h-5 text-[#2d8650] shrink-0 mt-0.5"></i> <?php echo mer_esc($item); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="text-[5rem] sm:text-[8rem] md:text-[10rem] font-medium text-transparent [-webkit-text-stroke:2px_#10b981] leading-none shrink-0 tracking-tighter order-1 md:order-2">02</div>
                </div>
            </div>

            <!-- Step 03 -->
            <div class="relative w-[95%] sm:w-[90%] ml-auto">
                <div class="border-t border-r border-b border-slate-300 rounded-r-[3rem] sm:rounded-r-[4rem] p-6 sm:p-14 md:p-20 flex flex-col md:flex-row items-center gap-6 md:gap-20 mt-6 md:mt-[-1px]">
                    <div class="text-[5rem] sm:text-[8rem] md:text-[10rem] font-medium text-[#2d8650] leading-none shrink-0 tracking-tighter">03</div>
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold mb-5 text-slate-900 leading-snug"><?php echo mer_esc($steps[2]['title']); ?></h3>
                        <?php if ($steps[2]['lead']) : ?>
                            <p class="text-slate-700 font-medium mb-4"><?php echo mer_esc($steps[2]['lead']); ?></p>
                        <?php endif; ?>
                        <ul class="space-y-3 text-slate-600 mb-6">
                            <?php foreach ($steps[2]['items'] as $item) : ?>
                                <li class="flex items-start gap-3"><i data-lucide="check-circle-2" class="w-5 h-5 text-[#2d8650] shrink-0 mt-0.5"></i> <?php echo mer_esc($item); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-10 md:mt-20 text-center">
            <a href="<?php echo esc_url($btn_url); ?>" class="px-8 py-4 rounded-full bg-[#2d8650] text-white text-base md:text-lg font-medium hover:bg-[#246e41] transition-colors inline-block shadow-lg shadow-emerald-500/30">
                <?php echo mer_esc($btn_txt); ?>
            </a>
        </div>
    </div>
</section>
