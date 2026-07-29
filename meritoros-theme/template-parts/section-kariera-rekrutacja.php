<?php
$title    = mer_field('kar_rek_title',    __('Jak wygląda nasz proces rekrutacji', 'meritoros'));
$subtitle = mer_field('kar_rek_subtitle', __('Zależy nam na przejrzystości — dlatego chcemy, żebyś wiedział/-a, czego się spodziewać na każdym etapie.', 'meritoros'));

$step_defaults = [
    1 => ['img' => 'cv.svg',        'title' => __('Prześlij swoje CV', 'meritoros'),                      'text' => __('Po złożeniu aplikacji przeglądamy Twoje dokumenty pod kątem naszych kryteriów. Na odpowiedź możesz liczyć w ciągu 21 dni kalendarzowych.', 'meritoros')],
    2 => ['img' => 'tel.svg',       'title' => __('Krótka rozmowa telefoniczna z HR', 'meritoros'),        'text' => __('Jeśli Twój profil spełnia nasze oczekiwania, odezwie się do Ciebie przedstawiciel HR. Rozmowa trwa ok. 15–20 minut i pozwoli nam lepiej Cię poznać.', 'meritoros')],
    3 => ['img' => 'spotkanie.svg', 'title' => __('Spotkanie online z Hiring Managerem', 'meritoros'),     'text' => __('Kolejny etap to spotkanie online z bezpośrednim przełożonym. Porozmawiamy o roli, oczekiwaniach i Twoich dotychczasowych doświadczeniach.', 'meritoros')],
    4 => ['img' => 'oferta.svg',    'title' => __('Oferta i dołączenie do zespołu', 'meritoros'),          'text' => __('Jeśli zdecydujemy się na współpracę, skontaktujemy się z Tobą telefonicznie z ofertą. Witamy Cię w zespole Meritoros!', 'meritoros')],
];

$_kar_page_id = get_the_ID();
$_kar_orig_id = apply_filters('wpml_object_id', $_kar_page_id, get_post_type(), true, apply_filters('wpml_default_language', null));

$steps = [];
for ($i = 1; $i <= 4; $i++) {
    $g = get_field("kar_rek_{$i}") ?: ($_kar_orig_id !== $_kar_page_id ? get_field("kar_rek_{$i}", $_kar_orig_id) : null);
    $d = $step_defaults[$i];
    $steps[] = [
        'img'   => $d['img'],
        'title' => is_array($g) && !empty($g['title']) ? $g['title'] : $d['title'],
        'text'  => is_array($g) && !empty($g['text'])  ? $g['text']  : $d['text'],
    ];
}
?>

<section id="rekrutacja" class="py-16 sm:py-20 md:py-24 px-6 lg:px-12 bg-white">
    <div class="max-w-7xl mx-auto">

        <div class="mb-14">
            <h2 class="text-pretty text-3xl lg:text-4xl xl:text-5xl font-bold tracking-tight text-slate-900 mb-4"><?php echo mer_esc($title); ?></h2>
            <p class="text-slate-500 text-base font-light leading-relaxed max-w-2xl"><?php echo mer_esc($subtitle); ?></p>
        </div>

        <div class="relative">
            <div class="hidden lg:block absolute z-0" style="top:52px; left:calc(12.5% + 56px); right:calc(62.5% + 56px); border-top:2px solid #94a3b8;"></div>
            <div class="hidden lg:block absolute z-0" style="top:52px; left:calc(37.5% + 56px); right:calc(37.5% + 56px); border-top:2px solid #94a3b8;"></div>
            <div class="hidden lg:block absolute z-0" style="top:52px; left:calc(62.5% + 56px); right:calc(12.5% + 56px); border-top:2px solid #94a3b8;"></div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-6 relative z-10">
                <?php foreach ($steps as $num => $step) : ?>
                <div class="flex flex-col items-center text-center">
                    <div class="relative mb-6">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo esc_attr($step['img']); ?>" alt="" class="w-[104px] h-[104px] object-contain">
                        <div class="absolute -bottom-3 -right-3 w-8 h-8 rounded-full bg-[#2d8650] flex items-center justify-center shadow-md">
                            <span class="text-white text-xs font-bold"><?php echo $num + 1; ?></span>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-3 flex items-end justify-center" style="min-height:3.375rem"><?php echo mer_esc($step['title']); ?></h3>
                    <p class="text-lg text-slate-500 font-light leading-relaxed"><?php echo mer_esc($step['text']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>
