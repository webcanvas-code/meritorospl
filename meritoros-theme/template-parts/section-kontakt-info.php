<?php
$_page_id = get_the_ID();
$_orig_id = apply_filters('wpml_object_id', $_page_id, get_post_type(), true, apply_filters('wpml_default_language', null));

$phone_label  = mer_field('kon_phone_label', __('Zadzwoń do nas!', 'meritoros'));
$phone        = mer_field('kon_phone', '(+48) 12 423 52 99');
$phone_tel    = mer_field('kon_phone_tel', '+48124235299');
$phone_desc   = mer_field('kon_phone_desc', __("Nasi specjaliści są do dyspozycji w godzinach pracy biura.\nOdpowiemy na wszystkie Twoje pytania.", 'meritoros'));
$company_name = mer_field('kon_company_name', 'Meritoros SA');
$address      = mer_field('kon_address', "Aleja Pokoju 62/8\n31-564 Kraków");
$email_admin  = mer_field('kon_email_admin', 'biuro@meritoros.pl');
$email_offers = mer_field('kon_email_offers', 'oferty@meritoros.pl');
$edelivery    = mer_field('kon_edelivery', 'AE:PL-49846-54459-JWEFS-17');
$nip          = mer_field('kon_nip', 'PL 6792963176');
$regon        = mer_field('kon_regon', '120618773');
$krs_court    = mer_field('kon_krs_court', "Sąd Rejonowy dla Krakowa-Śródmieścia w Krakowie\nWydział XI Gospodarczy Krajowego Rejestru Sądowego");
$krs_number   = mer_field('kon_krs_number', '0000935021');

$offices_title  = mer_field('kon_offices_title', __("Miasta w których\nmamy oddziały", 'meritoros'));
$map_img        = get_field('kon_map_image');
$virtual_label  = mer_field('kon_virtual_label', __("Oddziały\nWirtualne", 'meritoros'));
$virtual_desc   = mer_field('kon_virtual_desc', __('Obsługujemy klientów zdalnie w całej Polsce', 'meritoros'));

// Oddziały — 7 osobnych grup ACF
$offices = [];
for ($i = 1; $i <= 7; $i++) {
    $office = get_field("kon_office_{$i}") ?: ($_orig_id !== $_page_id ? get_field("kon_office_{$i}", $_orig_id) : null);
    $city   = !empty($office['city'])    ? $office['city']    : '';
    $addr   = !empty($office['address']) ? $office['address'] : '';
    if ($city) {
        $offices[] = ['city' => $city, 'address' => $addr];
    }
}
if (empty($offices)) {
    $offices = [
        ['city' => 'Kraków',   'address' => "Aleja Pokoju 62/8\n31-564 Kraków"],
        ['city' => 'Warszawa', 'address' => "ul. Złota 22 AR, 204\n00-400 Warszawa"],
        ['city' => 'Katowice', 'address' => "ul. Przykładowa 6/3\n40-002 Katowice"],
        ['city' => 'Rzeszów',  'address' => "Ulica Targowa 61\n38-025 Rzeszów"],
        ['city' => 'Wrocław',  'address' => "Rybnicka 77/34\n53-656 Wrocław"],
        ['city' => 'Łódź',     'address' => "Dębina 8\n92-014 Łódź"],
        ['city' => 'Bytom',    'address' => "Mazowieckiego 51\n41-900 Bytom"],
    ];
}
?>

<!-- Contact info -->
<section class="py-16 md:py-20 bg-emerald-50 relative overflow-hidden">
    <div class="absolute inset-0 pointer-events-none opacity-5">
        <svg viewBox="0 0 800 500" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full" aria-hidden="true">
            <circle cx="650" cy="250" r="300" fill="#2d8650"/>
            <circle cx="750" cy="150" r="200" fill="#2d8650"/>
        </svg>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-10 items-start">

        <!-- Phone card -->
        <div class="bg-[#2d8650] rounded-2xl p-10 flex flex-col gap-6">
            <div class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center">
                <i data-lucide="phone" class="w-7 h-7 text-white stroke-[1.5]"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-white mb-2"><?php echo mer_esc($phone_label); ?></h3>
                <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="text-white text-lg font-medium hover:text-white/80 transition-colors">
                    <?php echo mer_esc($phone); ?>
                </a>
            </div>
            <p class="text-white text-base leading-relaxed">
                <?php echo nl2br(esc_html($phone_desc)); ?>
            </p>
        </div>

        <!-- Company details card -->
        <div class="bg-white rounded-2xl p-10 shadow-sm">
            <h3 class="text-xl font-bold text-slate-900 mb-6"><?php echo mer_esc($company_name); ?></h3>
            <div class="space-y-5 text-base text-slate-600">

                <div class="flex items-start gap-3">
                    <i data-lucide="map-pin" class="w-4 h-4 text-[#2d8650] mt-0.5 shrink-0 stroke-[1.5]"></i>
                    <div>
                        <p class="text-slate-400 text-xs mb-0.5"><?php esc_html_e('Adres', 'meritoros'); ?></p>
                        <p class="text-slate-700"><?php echo nl2br(esc_html($address)); ?></p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <i data-lucide="phone" class="w-4 h-4 text-[#2d8650] mt-0.5 shrink-0 stroke-[1.5]"></i>
                    <div>
                        <a href="tel:<?php echo esc_attr($phone_tel); ?>" class="text-slate-700 hover:text-[#2d8650] transition-colors">
                            <?php echo mer_esc($phone); ?>
                        </a>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <i data-lucide="mail" class="w-4 h-4 text-[#2d8650] mt-0.5 shrink-0 stroke-[1.5]"></i>
                    <div>
                        <p class="text-slate-400 text-xs mb-0.5"><?php esc_html_e('Administracja', 'meritoros'); ?></p>
                        <a href="mailto:<?php echo esc_attr($email_admin); ?>" class="text-slate-700 hover:text-[#2d8650] transition-colors">
                            <?php echo mer_esc($email_admin); ?>
                        </a>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <i data-lucide="mail" class="w-4 h-4 text-[#2d8650] mt-0.5 shrink-0 stroke-[1.5]"></i>
                    <div>
                        <p class="text-slate-400 text-xs mb-0.5"><?php esc_html_e('Zapytaj o ofertę', 'meritoros'); ?></p>
                        <a href="mailto:<?php echo esc_attr($email_offers); ?>" class="text-slate-700 hover:text-[#2d8650] transition-colors">
                            <?php echo mer_esc($email_offers); ?>
                        </a>
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-4 space-y-3">
                    <?php if ($edelivery) : ?>
                        <div>
                            <p class="text-slate-400 text-xs mb-0.5"><?php esc_html_e('Adres do e-doręczeń', 'meritoros'); ?></p>
                            <p class="text-slate-700 text-sm font-mono"><?php echo mer_esc($edelivery); ?></p>
                        </div>
                    <?php endif; ?>
                    <div>
                        <p class="text-slate-400 text-xs mb-0.5"><?php esc_html_e('Siedziba główna', 'meritoros'); ?></p>
                        <p class="text-slate-700 text-sm"><?php esc_html_e('Kraków', 'meritoros'); ?></p>
                        <p class="text-slate-700 text-sm">NIP: <?php echo mer_esc($nip); ?> &nbsp;/&nbsp; REGON: <?php echo mer_esc($regon); ?></p>
                    </div>
                    <?php if ($krs_court || $krs_number) : ?>
                        <div>
                            <p class="text-slate-400 text-xs mb-0.5"><?php esc_html_e('Krajowy Rejestr Sądowy (KRS)', 'meritoros'); ?></p>
                            <p class="text-slate-700 text-sm leading-relaxed">
                                <?php echo nl2br(esc_html($krs_court)); ?><br>
                                <?php esc_html_e('Nr KRS:', 'meritoros'); ?> <?php echo mer_esc($krs_number); ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Offices map -->
<section class="py-10 md:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 mb-12 leading-tight">
            <?php echo nl2br(esc_html($offices_title)); ?>
        </h2>

        <div class="grid lg:grid-cols-2 gap-12 items-center">

            <!-- Map -->
            <div class="flex items-center justify-center">
                <?php
                $map_url = is_array($map_img) ? esc_url($map_img['url']) : esc_url(get_template_directory_uri() . '/images/mapaPL.svg');
                $map_alt = is_array($map_img) ? esc_attr($map_img['title'] ?: __('Mapa Polski z oddziałami', 'meritoros')) : esc_attr(__('Mapa Polski z oddziałami', 'meritoros'));
                ?>
                <img src="<?php echo $map_url; ?>" alt="<?php echo $map_alt; ?>" class="w-full" loading="lazy">
            </div>

            <!-- City cards -->
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                <?php foreach ($offices as $office) :
                    if (!empty($office['virtual'])) continue;
                ?>
                    <div class="border border-slate-200 rounded-xl p-4 hover:border-emerald-300 hover:shadow-sm transition-all">
                        <p class="text-base font-semibold text-slate-900 mb-1.5"><?php echo mer_esc($office['city']); ?></p>
                        <p class="text-sm text-slate-500 leading-relaxed"><?php echo nl2br(esc_html($office['address'])); ?></p>
                    </div>
                <?php endforeach; ?>

                <!-- Virtual offices card -->
                <div class="border-2 border-emerald-400 bg-emerald-50 rounded-xl p-4 hover:bg-emerald-100 transition-all col-span-1">
                    <div class="flex items-center gap-2 mb-1.5">
                        <i data-lucide="monitor" class="w-4 h-4 text-[#2d8650] stroke-[1.5]"></i>
                        <p class="text-base font-semibold text-emerald-700"><?php echo nl2br(esc_html($virtual_label)); ?></p>
                    </div>
                    <p class="text-sm text-[#2d8650] leading-relaxed"><?php echo mer_esc($virtual_desc); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
