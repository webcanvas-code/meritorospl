<?php
$title = __( mer_field('ri_zarzad_title', 'Zarząd'), 'meritoros' );

$img = get_template_directory_uri() . '/images/';
$member_defaults = [
    ['name' => 'Maciej Paraszczak',          'role' => __('prezes zarządu, CEO', 'meritoros'), 'bio' => __('Założyciel i główny udziałowiec Meritoros SA, certyfikowany księgowy (Certyfikat Min. Finansów nr 1840/2003). Absolwent kierunku Zarządzanie ze specjalnością Finanse i Rachunkowość.', 'meritoros'), 'photo' => $img . 'zarzad-maciej-paraszczak.png'],
    ['name' => 'Agnieszka Tomczyk-Pieniądz', 'role' => __('członek zarządu, COO', 'meritoros'), 'bio' => __('Udziałowiec Meritoros SA, certyfikowana księgowa (Certyfikat Min. Finansów nr 54055/2011). Absolwentka kierunku Zarządzania na AGH, swoje wykształcenie uzupełniła o studia podyplomowe.', 'meritoros'), 'photo' => $img . 'zarzad-agnieszka-tomczyk.png'],
    ['name' => 'Krzysztof Gargas',            'role' => __('członek zarządu, COO', 'meritoros'), 'bio' => __('Udziałowiec Meritoros SA, certyfikowany księgowy (Certyfikat Min. Finansów nr 62092/2013). Absolwent kierunku Finansów i Rachunkowości na UEK ze specjalnością finanse przedsiębiorstw.', 'meritoros'), 'photo' => $img . 'zarzad-krzysztof-gargas.png'],
    ['name' => 'Joanna Małek',                'role' => __('członek zarządu, COO', 'meritoros'), 'bio' => __('Księgowa (Certyfikat Min. Finansów 55068/2012) z wieloletnim doświadczeniem. Swoją karierę budowała w Biurach Rachunkowych oraz jako główna księgowa w jednej z międzynarodowych firm.', 'meritoros'), 'photo' => $img . 'zarzad-joanna-malek.png'],
];

$members = [];
for ($i = 1; $i <= 4; $i++) {
    $m   = get_field("ri_zarzad_member_{$i}");
    $def = $member_defaults[$i - 1];
    $members[] = [
        'photo' => is_array($m) && !empty($m['photo']) ? $m['photo']['url'] : $def['photo'],
        'name'  => is_array($m) && !empty($m['name'])  ? $m['name']  : $def['name'],
        'role'  => __( is_array($m) && !empty($m['role'])  ? $m['role']  : $def['role'], 'meritoros' ),
        'bio'   => __( is_array($m) && !empty($m['bio'])   ? $m['bio']   : $def['bio'],  'meritoros' ),
    ];
}
?>

<section id="ri-zarzad" class="py-10 md:py-14 bg-emerald-50">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-4xl md:text-5xl font-bold tracking-tight text-slate-900 text-center mb-14">
            <?php echo mer_esc($title); ?>
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach ($members as $member) :
                $photo_url = is_array($member['photo']) ? esc_url($member['photo']['url']) : '';
                $photo_alt = is_array($member['photo']) ? esc_attr($member['photo']['alt'] ?: $member['name']) : esc_attr($member['name']);
            ?>
            <div class="flex flex-col">
                <div class="rounded-2xl overflow-hidden mb-5 aspect-[3/4] bg-slate-200">
                    <?php if ($member['photo']) : ?>
                        <img src="<?php echo esc_url($member['photo']); ?>" alt="<?php echo $photo_alt; ?>"
                             class="w-full h-full object-cover object-top" loading="lazy">
                    <?php endif; ?>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2"><?php echo mer_esc($member['name']); ?></h3>
                <span class="mer-btn mer-btn--primary inline-flex w-fit items-center text-xs font-medium text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full mb-3">
                    <?php echo mer_esc($member['role']); ?>
                </span>
                <p class="text-base text-slate-600 leading-relaxed">
                    <?php echo mer_esc($member['bio']); ?>
                </p>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
