<?php
$title = mer_field('kar_ben_title', __('Nasze benefity', 'meritoros'));

$ben_defaults = [
    ['icon' => 'clock',          'title' => __('Elastyczny czas pracy sam wybierasz o jakiej porze pracujesz', 'meritoros'),       'text' => __('Zadaniowy tryb pracy: możesz dopasować start i przerwy do swojego dnia', 'meritoros')],
    ['icon' => 'dumbbell',       'title' => __('Kartę Multisport', 'meritoros'),                                                    'text' => ''],
    ['icon' => 'heart-pulse',    'title' => __('Prywatną opiekę zdrowotną', 'meritoros'),                                          'text' => ''],
    ['icon' => 'sun',            'title' => __('Dodatkowe dni płatnego urlopu wypoczynkowego', 'meritoros'),                        'text' => __('razem z urlopem ustawowym jest to aż do 41 dni w roku!', 'meritoros')],
    ['icon' => 'presentation',   'title' => __('Szkolenia wewnętrzne', 'meritoros'),                                               'text' => ''],
    ['icon' => 'home',           'title' => __('Atrakcyjny system dodatkowych premii', 'meritoros'),                                'text' => ''],
    ['icon' => 'languages',      'title' => __('Nauka języków', 'meritoros'),                                                      'text' => ''],
    ['icon' => 'heart-handshake','title' => __('Inicjatywy dobroczynne', 'meritoros'),                                             'text' => __('Dzień Ziemi, Poland Business Run, Dzień Kundelka i Szlachetna Paczka', 'meritoros')],
];

$_kar_page_id = get_the_ID();
$_kar_orig_id = apply_filters('wpml_object_id', $_kar_page_id, get_post_type(), true, apply_filters('wpml_default_language', null));

$bens = [];
for ($i = 1; $i <= 8; $i++) {
    $g = get_field("kar_ben_{$i}") ?: ($_kar_orig_id !== $_kar_page_id ? get_field("kar_ben_{$i}", $_kar_orig_id) : null);
    $d = $ben_defaults[$i - 1];
    $img = is_array($g) && !empty($g['image']) ? $g['image'] : null;
    $bens[] = [
        'icon'      => is_array($g) && !empty($g['icon'])  ? $g['icon']  : $d['icon'],
        'img_url'   => is_array($img) ? esc_url($img['url']) : '',
        'img_alt'   => is_array($img) ? esc_attr($img['alt'] ?: '') : '',
        'title'     => is_array($g) && !empty($g['title']) ? $g['title'] : $d['title'],
        'text'      => is_array($g) && isset($g['text'])   ? $g['text']  : $d['text'],
    ];
}

?>

<section class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 text-center mb-12"><?php echo mer_esc($title); ?></h2>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
            <?php foreach ($bens as $ben) : ?>
            <div class="group flex flex-col items-center text-center p-6 md:p-8 rounded-2xl border border-slate-100 bg-slate-50 hover:border-emerald-200 hover:bg-emerald-50/40 transition-all duration-300">
                <div class="w-14 h-14 rounded-2xl bg-white border border-slate-100 shadow-sm flex items-center justify-center shrink-0 mb-5 group-hover:border-emerald-200 group-hover:shadow-emerald-100/50 group-hover:shadow-md transition-all duration-300">
                    <?php if (!empty($ben['img_url'])) : ?>
                    <img src="<?php echo $ben['img_url']; ?>" alt="<?php echo $ben['img_alt']; ?>" class="w-7 h-7 object-contain">
                    <?php else : ?>
                    <i data-lucide="<?php echo esc_attr($ben['icon']); ?>" stroke-width="1.5" class="w-7 h-7 text-[#48c279]"></i>
                    <?php endif; ?>
                </div>
                <p class="text-sm md:text-base font-semibold text-slate-900 leading-snug <?php echo $ben['text'] ? 'mb-2' : ''; ?>"><?php echo mer_esc($ben['title']); ?></p>
                <?php if ($ben['text']) : ?>
                <p class="text-xs md:text-sm text-slate-400 leading-relaxed"><?php echo mer_esc($ben['text']); ?></p>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
