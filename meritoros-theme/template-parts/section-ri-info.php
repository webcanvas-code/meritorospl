<?php
$_ri_pl   = get_page_by_path('relacje-inwestorskie');
$_ri_pid  = $_ri_pl ? (int) apply_filters('wpml_object_id', $_ri_pl->ID, 'page', true) : get_the_ID();

$title = get_field('ri_info_title', $_ri_pid) ?: __('O nas', 'meritoros');

$subs = [];
$sub_defaults = [
    ['title' => 'Profil działalności',       'text_field' => 'ri_sub1_text', 'title_field' => 'ri_sub1_title'],
    ['title' => 'Skala działalności',        'text_field' => 'ri_sub2_text', 'title_field' => 'ri_sub2_title'],
    ['title' => 'Zasięg i grupa kapitałowa', 'text_field' => 'ri_sub3_text', 'title_field' => 'ri_sub3_title'],
    ['title' => 'Strategia rozwoju',         'text_field' => 'ri_sub4_text', 'title_field' => 'ri_sub4_title'],
];
foreach ($sub_defaults as $idx => $sd) {
    $sub = [
        'title' => get_field($sd['title_field'], $_ri_pid) ?: __($sd['title'], 'meritoros'),
        'text'  => trim(str_replace("\r\n", "\n", get_field($sd['text_field'], $_ri_pid) ?: '')),
        'list'  => false,
    ];
    if ($idx === 2) {
        $companies_raw = str_replace("\r\n", "\n", get_field('ri_sub3_companies', $_ri_pid) ?: "Taxaide Sp. z o.o. z siedzibą we Wrocławiu, KRS: 0000811046\nBluematica Sp. z o.o. z siedzibą w Rzeszowie, KRS: 0000994219");
        $sub['companies'] = array_values(array_filter(array_map('trim', explode("\n", $companies_raw))));
    }
    $subs[] = $sub;
}

$photo     = get_field('ri_info_photo', $_ri_pid);
$photo_url = is_array($photo) ? esc_url($photo['url']) : 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&q=80&w=900';
$photo_alt = is_array($photo) ? esc_attr($photo['alt'] ?: 'Meritoros SA') : 'Meritoros SA';

$stat_defaults = [
    ['value' => '2004',  'label' => 'Początek działalności', 'sublabel' => ''],
    ['value' => '1200+', 'label' => 'Klientów',              'sublabel' => ''],
    ['value' => '180+',  'label' => 'Specjalistów',          'sublabel' => ''],
    ['value' => '7',     'label' => 'lokalizacji',           'sublabel' => '(ale ciągle rośniemy)'],
];
$stats_raw = [];
for ($i = 1; $i <= 4; $i++) {
    $s = get_field("ri_stat_{$i}", $_ri_pid);
    $d = $stat_defaults[$i - 1];
    $stats_raw[] = [
        'value'    => is_array($s) && !empty($s['value'])    ? $s['value']    : $d['value'],
        'label'    => is_array($s) && !empty($s['label'])    ? $s['label']    : $d['label'],
        'sublabel' => is_array($s) && !empty($s['sublabel']) ? $s['sublabel'] : $d['sublabel'],
    ];
}

$award_title = get_field('ri_award_title', $_ri_pid) ?: __('Nagrody i wyróżnienia', 'meritoros');
$award_text  = get_field('ri_award_text',  $_ri_pid) ?: __('Wyróżnienia są efektem tego, jak rozwijamy Meritoros: konsekwentnie i procesowo. Trzymamy standard, który ma działać w praktyce – codziennie.', 'meritoros');

?>

<section id="ri-info" class="py-10 md:py-14 bg-white relative overflow-hidden">
    <!-- Dekoracyjny okrąg prawy górny -->
    <div class="absolute -right-32 -top-32 w-[500px] h-[500px] rounded-full border-[60px] border-emerald-100 pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="flex flex-col lg:flex-row lg:justify-between gap-12 lg:gap-0">

            <!-- Lewa kolumna: 579×755px, wyśrodkowana względem prawej -->
            <div class="w-full lg:w-[579px] lg:self-end">
                <h2 class="text-4xl md:text-5xl font-bold tracking-tight text-slate-900 mb-10 leading-tight">
                    <?php echo mer_esc($title); ?>
                </h2>

                <div class="space-y-8">
                    <?php foreach ($subs as $sub) : ?>
                    <div class="pt-10">
                        <h3 class="text-xl font-bold tracking-tight text-slate-900 mb-2">
                            <?php echo mer_esc($sub['title']); ?>
                        </h3>
                        <?php if ($sub['text'] && empty($sub['companies'])) : ?>
                        <?php if (!empty($sub['list'])) :
                            $lines = array_values(array_filter(array_map('trim', preg_split('/\r?\n/', $sub['text']))));
                        ?>
                        <div class="space-y-2 text-base text-slate-500 leading-relaxed">
                            <?php foreach ($lines as $line) :
                                // akceptuj: "- ", "– ", "— " jako marker punktora
                                if (preg_match('/^[-–—]\s/', $line)) :
                                    $text = preg_replace('/^[-–—]\s/', '', $line);
                                ?>
                                <div class="flex items-start gap-2 mt-1">
                                    <span class="mt-2 w-1.5 h-1.5 rounded-full bg-[#00d084] shrink-0"></span>
                                    <span><?php echo esc_html($text); ?></span>
                                </div>
                                <?php else : ?>
                                <p><?php echo esc_html($line); ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <?php else : ?>
                        <div class="space-y-3 text-base text-slate-500 leading-relaxed">
                            <?php foreach (array_values(array_filter(array_map('trim', explode("\n\n", $sub['text'])))) as $p) : ?>
                                <p><?php echo nl2br(esc_html($p)); ?></p>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if (!empty($sub['companies'])) : ?>
                        <ul class="space-y-2 text-base text-slate-500 leading-relaxed mt-2">
                            <?php foreach ($sub['companies'] as $company) : ?>
                                <li class="flex items-start gap-2">
                                    <span class="mt-2 w-1.5 h-1.5 rounded-full bg-[#00d084] shrink-0"></span>
                                    <span><?php echo esc_html($company); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Prawa kolumna: 547×775px -->
            <div class="w-full lg:w-[547px] flex flex-col gap-6">

                <!-- Zdjęcie: 543×375px -->
                <div class="w-full lg:w-[543px] lg:h-[375px] lg:mx-auto rounded-[2rem] overflow-hidden shadow-sm">
                    <img src="<?php echo $photo_url; ?>" alt="<?php echo $photo_alt; ?>"
                         class="w-full h-full object-cover" loading="lazy">
                </div>

                <!-- Statystyki: szerokość zdjęcia -->
                <div class="w-full lg:w-[543px] lg:mx-auto grid grid-cols-2 sm:grid-cols-4 gap-4 text-center">
                    <?php foreach ($stats_raw as $stat) : ?>
                    <div>
                        <div class="text-2xl font-bold text-slate-900"><?php echo mer_esc($stat['value']); ?></div>
                        <div class="text-xs text-slate-500 leading-tight mt-1"><?php echo mer_esc($stat['label']); ?></div>
                        <?php if (!empty($stat['sublabel'])) : ?>
                        <div class="text-xs text-slate-400 leading-tight"><?php echo mer_esc($stat['sublabel']); ?></div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Karta nagród: 543×248px -->
                <div class="w-full lg:w-[543px] lg:min-h-[248px] lg:mx-auto bg-white border border-emerald-300 rounded-[2rem] p-8 flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-bold tracking-tight mb-4 text-slate-900">
                            <?php echo mer_esc($award_title); ?>
                        </h3>
                        <p class="text-base text-slate-600 leading-relaxed font-light">
                            <?php echo mer_esc($award_text); ?>
                        </p>
                    </div>
                    <div class="flex flex-wrap items-center gap-6 mt-6">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/images/forbes.png'); ?>" alt="Diamenty Forbes" class="object-contain" style="width:150px;height:130px;" loading="lazy">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo_gazele.png'); ?>" alt="Gazele Biznesu" class="h-16 w-auto object-contain" loading="lazy">
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
