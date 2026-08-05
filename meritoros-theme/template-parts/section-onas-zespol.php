<?php
$_page_id = get_the_ID();
$_orig_id = apply_filters('wpml_object_id', $_page_id, get_post_type(), true, apply_filters('wpml_default_language', null));

$team_title = mer_field('onas_team_title', 'Zespół');

$member_defaults = [
    ['name' => 'Maciej Paraszczak',         'role' => 'prezes zarządu, CEO', 'bio' => 'Założyciel i główny udziałowiec Meritoros SA, certyfikowany księgowy (Certyfikat Min. Finansów nr 1840/2003). Absolwent kierunku Zarządzanie ze specjalnością Finanse i Rachunkowość.', 'url' => '#', 'photo' => null],
    ['name' => 'Agnieszka Tomczyk-Pieniądz', 'role' => 'członek zarządu, COO', 'bio' => 'Udziałowiec Meritoros SA, certyfikowana księgowa (Certyfikat Min. Finansów nr 54055/2011). Absolwentka kierunku Zarządzania na AGH, swoje wykształcenie uzupełniła o studia podyplomowe.', 'url' => '#', 'photo' => null],
    ['name' => 'Krzysztof Gargas',           'role' => 'członek zarządu, COO', 'bio' => 'Udziałowiec Meritoros SA, certyfikowany księgowy (Certyfikat Min. Finansów nr 62092/2013). Absolwent kierunku Finansów i Rachunkowości na UEK ze specjalnością finanse przedsiębiorstw.', 'url' => '#', 'photo' => null],
    ['name' => 'Joanna Małek',               'role' => 'członek zarządu, COO', 'bio' => 'Księgowa (Certyfikat Min. Finansów 55068/2012) z wieloletnim doświadczeniem. Swoją karierę budowała w Biurach Rachunkowych oraz jako główna księgowa w jednej z międzynarodowych firm.', 'url' => '#', 'photo' => null],
];

$members = [];
for ($i = 1; $i <= 4; $i++) {
    $m = get_field("onas_member_{$i}") ?: ($_orig_id !== $_page_id ? get_field("onas_member_{$i}", $_orig_id) : null);
    $def = $member_defaults[$i - 1];
    $members[] = [
        'photo' => is_array($m) && !empty($m['photo']) ? $m['photo'] : null,
        'name'  => is_array($m) && !empty($m['name'])  ? $m['name']  : $def['name'],
        'role'  => is_array($m) && !empty($m['role'])  ? $m['role']  : $def['role'],
        'bio'   => is_array($m) && !empty($m['bio'])   ? $m['bio']   : $def['bio'],
        'url'   => is_array($m) && !empty($m['url'])   ? $m['url']   : $def['url'],
    ];
}
?>

<section class="py-12 md:py-24 bg-emerald-50">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 text-center mb-14">
            <?php echo mer_esc($team_title); ?>
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach ($members as $member) :
                $photo_url = is_array($member['photo']) ? esc_url($member['photo']['url']) : '';
                $photo_alt = is_array($member['photo']) ? esc_attr($member['photo']['alt'] ?: $member['name']) : esc_attr($member['name']);
            ?>
                <div class="flex flex-col">
                    <div class="rounded-2xl overflow-hidden mb-5 aspect-[3/4] bg-slate-200">
                        <?php if ($photo_url) : ?>
                            <img src="<?php echo $photo_url; ?>" alt="<?php echo $photo_alt; ?>" class="w-full h-full object-cover object-top" loading="lazy">
                        <?php endif; ?>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2"><?php echo mer_esc($member['name']); ?></h3>
                    <span class="inline-flex w-fit items-center text-xs font-medium text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full mb-3">
                        <?php echo mer_esc($member['role']); ?>
                    </span>
                    <p class="text-base text-slate-600 leading-relaxed mb-4">
                        <?php echo mer_esc($member['bio']); ?>
                    </p>
                    <?php if ($member['url'] && $member['url'] !== '#') : ?>
                        <a href="<?php echo esc_url($member['url']); ?>" class="text-sm font-medium text-[#00d084] hover:text-emerald-700 transition-colors mt-auto">
                            <?php esc_html_e('Czytaj więcej...', 'meritoros'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
