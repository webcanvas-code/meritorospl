<?php
$cv_url = mer_field('op_cv_url', home_url('/kariera/#zostaw-cv'));

$kroki = [
    ['icon' => 'file-text',   'label' => __('Wyślij CV', 'meritoros'),               'desc' => __('Prześlij swoje CV przez formularz na stronie Kariery.', 'meritoros')],
    ['icon' => 'phone',       'label' => __('Rozmowa kwalifikacyjna', 'meritoros'),  'desc' => __('Skontaktujemy się z Tobą, by lepiej się poznać.', 'meritoros')],
    ['icon' => 'handshake',   'label' => __('Decyzja i oferta', 'meritoros'),        'desc' => __('Otrzymasz informację zwrotną i – mamy nadzieję – ofertę współpracy.', 'meritoros')],
];
?>

<section id="aplikuj" class="py-16 md:py-24 bg-white relative overflow-hidden">
    <div class="absolute -left-32 top-1/2 -translate-y-1/2 w-72 h-72 rounded-full border-[40px] border-emerald-100 pointer-events-none"></div>
    <div class="absolute right-0 bottom-0 w-96 h-96 rounded-full bg-[#48c279]/4 pointer-events-none"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            <!-- Lewa kolumna – treść -->
            <div>
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#48c279]/10 text-[#48c279] text-sm font-semibold mb-6">
                    <i data-lucide="send" class="w-4 h-4"></i>
                    <?php esc_html_e('Rekrutacja', 'meritoros'); ?>
                </span>

                <h2 class="text-pretty text-3xl md:text-4xl font-bold text-slate-900 mb-4">
                    <?php esc_html_e('Zainteresowana / Zainteresowany?', 'meritoros'); ?><br>
                    <?php esc_html_e('Wyślij nam swoje CV', 'meritoros'); ?>
                </h2>

                <p class="text-slate-600 text-lg leading-relaxed mb-10">
                    <?php esc_html_e('Prześlij swoje CV przez formularz na stronie Kariery. Rekrutacja odbywa się w kilku prostych krokach – skontaktujemy się z Tobą tak szybko, jak to możliwe.', 'meritoros'); ?>
                </p>

                <div class="flex flex-wrap gap-4">
                    <a href="<?php echo esc_url($cv_url); ?>" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-[#48c279] text-white text-base font-semibold hover:bg-[#3ea868] transition-colors">
                        <?php esc_html_e('Wyślij CV', 'meritoros'); ?>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                    <a href="<?php echo esc_url(home_url('/kariera/')); ?>"
                       class="inline-flex items-center gap-2 px-8 py-4 rounded-full border border-slate-300 text-slate-700 text-base font-medium hover:border-slate-400 transition-colors">
                        <?php esc_html_e('Inne oferty pracy', 'meritoros'); ?>
                    </a>
                </div>
            </div>

            <!-- Prawa kolumna – kroki rekrutacji -->
            <div class="flex flex-col gap-4">
                <?php foreach ($kroki as $idx => $krok) : ?>
                <div class="flex items-start gap-5 bg-slate-50 rounded-2xl p-6 border border-slate-100">
                    <div class="flex-shrink-0 flex flex-col items-center gap-2">
                        <span class="w-12 h-12 rounded-xl bg-[#48c279]/10 flex items-center justify-center">
                            <i data-lucide="<?php echo esc_attr($krok['icon']); ?>" class="w-6 h-6 text-[#48c279]"></i>
                        </span>
                        <span class="text-xs font-bold text-[#48c279]/60">0<?php echo $idx + 1; ?></span>
                    </div>
                    <div>
                        <p class="text-lg font-bold text-slate-900 mb-1"><?php echo mer_esc($krok['label']); ?></p>
                        <p class="text-base text-slate-500 leading-relaxed"><?php echo mer_esc($krok['desc']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>
