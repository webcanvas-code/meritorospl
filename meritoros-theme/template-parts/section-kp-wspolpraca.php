<?php
$_page_id = get_the_ID();
$_orig_id = apply_filters('wpml_object_id', $_page_id, get_post_type(), true, apply_filters('wpml_default_language', null));

$title = mer_field('kp_wsp_title', 'Jak wygląda bieżąca współpraca');

$s1 = get_field('kp_wsp_step1') ?: ($_orig_id !== $_page_id ? get_field('kp_wsp_step1', $_orig_id) : null);
$s1_title     = is_array($s1) && !empty($s1['title']) ? $s1['title'] : 'Indywidualna organizacja pracy';
$s1_lead      = is_array($s1) && !empty($s1['lead'])  ? $s1['lead']  : 'W zależności od potrzeb możemy pracować:';
$s1_items_raw = is_array($s1) && !empty($s1['items']) ? $s1['items'] : "na bieżąco – obsługując codzienne procesy kadrowe i płacowe\nw cyklach tygodniowych\nw innych ustalonych odstępach czasu";

$s2 = get_field('kp_wsp_step2') ?: ($_orig_id !== $_page_id ? get_field('kp_wsp_step2', $_orig_id) : null);
$s2_title     = is_array($s2) && !empty($s2['title']) ? $s2['title'] : 'Terminowe naliczanie wynagrodzeń';
$s2_lead      = is_array($s2) && !empty($s2['lead'])  ? $s2['lead']  : 'Terminy przetwarzania listy płac ustalamy indywidualnie z każdą firmą, uwzględniając jej wewnętrzny harmonogram wypłat oraz terminy rozliczeń z ZUS i US.';
$s2_items_raw = is_array($s2) && !empty($s2['items']) ? $s2['items'] : "listy płac gotowe z odpowiednim wyprzedzeniem przed dniem wypłaty\nterminowe przelewy składek ZUS i zaliczek PIT";

$s3 = get_field('kp_wsp_step3') ?: ($_orig_id !== $_page_id ? get_field('kp_wsp_step3', $_orig_id) : null);
$s3_title     = is_array($s3) && !empty($s3['title']) ? $s3['title'] : "Zakres raportowania ustalamy\nindywidualnie z każdym klientem.";
$s3_lead      = is_array($s3) && !empty($s3['lead'])  ? $s3['lead']  : 'W standardzie klient otrzymuje:';
$s3_items_raw = is_array($s3) && !empty($s3['items']) ? $s3['items'] : "zestawienie listy płac\npaski wynagrodzeń dla pracowników\npotwierdzenia rozliczeń ZUS i US";
$s3_note      = is_array($s3) && !empty($s3['note'])  ? $s3['note']  : 'W zależności od potrzeb przygotowujemy również dodatkowe raporty kadrowe, płacowe i zarządcze.';

$btn_text = mer_field('kp_wsp_btn_text', 'Poznaj więcej historii');
$btn_url  = mer_field('kp_wsp_btn_url',  home_url('/blog/'));

$s1_items = array_values(array_filter(array_map('trim', explode("\n", $s1_items_raw))));
$s2_items = array_values(array_filter(array_map('trim', explode("\n", $s2_items_raw))));
$s3_items = array_values(array_filter(array_map('trim', explode("\n", $s3_items_raw))));
?>

<section class="py-16 md:py-24 bg-emerald-50 relative">
    <div class="absolute top-0 left-0 w-96 h-96 border-[40px] border-emerald-200/40 rounded-full -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-[600px] h-[600px] border-[60px] border-emerald-200/30 rounded-full translate-x-1/4 translate-y-1/4 pointer-events-none"></div>
    <div class="absolute top-1/2 left-0 w-[500px] h-[500px] border-[50px] border-emerald-200/40 rounded-full -translate-x-1/2 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-center mb-10 md:mb-24 text-slate-900"><?php echo mer_esc($title); ?></h2>

        <div class="relative w-full max-w-5xl mx-auto">

            <!-- Krok 01 -->
            <div class="relative w-[95%] sm:w-[90%] ml-auto">
                <div class="border-t border-r border-b border-slate-300 rounded-r-[3rem] sm:rounded-r-[4rem] p-10 sm:p-14 md:p-20 flex flex-col md:flex-row items-center gap-10 md:gap-20">
                    <div class="hidden md:block absolute top-0 right-full w-screen h-px bg-slate-300"></div>
                    <div class="text-[5rem] sm:text-[8rem] md:text-[10rem] font-medium text-[#2d8650] leading-none shrink-0 tracking-tighter">01</div>
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold mb-5 text-slate-900"><?php echo mer_esc($s1_title); ?></h3>
                        <?php if ($s1_lead) : ?><p class="text-slate-700 font-medium mb-4 text-lg"><?php echo mer_esc($s1_lead); ?></p><?php endif; ?>
                        <ul class="space-y-3 text-slate-600">
                            <?php foreach ($s1_items as $item) : ?>
                            <li class="flex items-start gap-3"><i data-lucide="check-circle-2" class="w-5 h-5 text-[#2d8650] shrink-0 mt-0.5"></i> <?php echo mer_esc($item); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Krok 02 -->
            <div class="relative w-[95%] sm:w-[90%] mr-auto">
                <div class="border-t border-l border-b border-slate-300 rounded-l-[3rem] sm:rounded-l-[4rem] p-10 sm:p-14 md:p-20 flex flex-col md:flex-row items-center gap-10 md:gap-20 mt-[-1px]">
                    <div class="flex-1 order-2 md:order-1 pl-0 md:pl-10">
                        <h3 class="text-2xl font-bold mb-5 text-slate-900"><?php echo mer_esc($s2_title); ?></h3>
                        <?php if ($s2_lead) : ?><p class="text-slate-700 font-medium mb-4 max-w-lg text-lg"><?php echo mer_esc($s2_lead); ?></p><?php endif; ?>
                        <ul class="space-y-3 text-slate-600 max-w-lg">
                            <?php foreach ($s2_items as $item) : ?>
                            <li class="flex items-start gap-3"><i data-lucide="check-circle-2" class="w-5 h-5 text-[#2d8650] shrink-0 mt-0.5"></i> <?php echo mer_esc($item); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="text-[5rem] sm:text-[8rem] md:text-[10rem] font-medium text-transparent [-webkit-text-stroke:2px_#10b981] leading-none shrink-0 tracking-tighter order-1 md:order-2">02</div>
                </div>
            </div>

            <!-- Krok 03 -->
            <div class="relative w-[95%] sm:w-[90%] ml-auto">
                <div class="border-t border-r border-b border-slate-300 rounded-r-[3rem] sm:rounded-r-[4rem] p-10 sm:p-14 md:p-20 flex flex-col md:flex-row items-center gap-10 md:gap-20 mt-[-1px]">
                    <div class="text-[5rem] sm:text-[8rem] md:text-[10rem] font-medium text-[#2d8650] leading-none shrink-0 tracking-tighter">03</div>
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold mb-5 text-slate-900 leading-snug"><?php echo mer_esc($s3_title); ?></h3>
                        <?php if ($s3_lead) : ?><p class="text-slate-700 font-medium mb-4 text-lg"><?php echo mer_esc($s3_lead); ?></p><?php endif; ?>
                        <ul class="space-y-3 text-slate-600 mb-6">
                            <?php foreach ($s3_items as $item) : ?>
                            <li class="flex items-start gap-3"><i data-lucide="check-circle-2" class="w-5 h-5 text-[#2d8650] shrink-0 mt-0.5"></i> <?php echo mer_esc($item); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php if ($s3_note) : ?><p class="text-slate-600 text-lg"><?php echo mer_esc($s3_note); ?></p><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-20 text-center">
            <a href="<?php echo esc_url($btn_url); ?>" class="px-7 py-3.5 rounded-full bg-[#2d8650] text-white text-base font-semibold hover:bg-[#246e41] transition-colors inline-block shadow-lg shadow-emerald-500/30">
                <?php echo mer_esc($btn_text); ?>
            </a>
        </div>
    </div>
</section>
