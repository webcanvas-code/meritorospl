<?php
$info_title   = __( mer_field('bpo_info_title',   "Stabilne procesy. Rzetelne\ndane. Spokój zarządu."), 'meritoros' );
$info_text    = __( mer_field('bpo_info_text',    'Wspieramy większe firmy w obszarze księgowości, kadr i płac, back-office, przejmując odpowiedzialność za jakość, terminowość i ciągłość działania. Dostarczamy dane i raporty w harmonogramie dopasowanym do zarządu – tak, żeby decyzje były oparte na spójnych informacjach, a nie „gaszeniu pożarów".'), 'meritoros' );
$info_items_r = __( str_replace("\r\n", "\n", mer_field('bpo_info_items', "raportowanie zarządcze i sprawozdawcze dopasowane do potrzeb organizacji\n\ncyfrowy obieg dokumentów i uporządkowane procesy\n\npełna zastępowalność i ciągłość obsługi oraz gotowość do skalowania")), 'meritoros' );
$info_items   = array_filter(array_map('trim', preg_split('/(\r?\n){2,}/', $info_items_r)));

$awards_title = __( mer_field('bpo_awards_title', 'Nagrody i wyróżnienia'), 'meritoros' );
$awards_text  = __( mer_field('bpo_awards_text',  'Wyróżnienia są efektem tego, jak rozwijamy Meritoros: konsekwentnie i procesowo. Trzymamy standard, który ma działać w praktyce - codziennie.'), 'meritoros' );
$_img         = get_template_directory_uri() . '/images/';
$awards_logo1 = get_field('bpo_awards_logo1') ?: ['url' => $_img . 'forbes.png',      'alt' => 'Forbes'];
$awards_logo2 = get_field('bpo_awards_logo2') ?: ['url' => $_img . 'logo_gazele.png', 'alt' => 'Gazele Biznesu'];

$stat1_image = get_field('bpo_stat1_image') ?: ['url' => $_img . 'ISO27001.png', 'alt' => 'ISO 27001'];
$stat1_text  = __( mer_field('bpo_stat1_text', "Bezpieczeństwo\ni compliance"), 'meritoros' );
$stat2_image = get_field('bpo_stat2_image') ?: ['url' => $_img . 'ISO9001.png',  'alt' => 'ISO 9001'];
$stat2_text  = __( mer_field('bpo_stat2_text', "Jakość potwierdzona\nstandardami"), 'meritoros' );
$stat3_text  = __( mer_field('bpo_stat3_text', "Ponad 170\nexpertów"), 'meritoros' );
?>

<section class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 w-full">
        <div class="grid lg:grid-cols-2 gap-16 lg:gap-24">
            <div>
                <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight mb-6 leading-tight">
                    <?php echo mer_esc($info_title); ?>
                </h2>
                <p class="text-lg text-slate-500 mb-8 leading-relaxed">
                    <?php echo mer_esc($info_text); ?>
                </p>
                <ul class="space-y-4">
                    <?php foreach ($info_items as $item) : ?>
                        <li class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" stroke-width="1.5" class="w-6 h-6 text-[#00d084] shrink-0 mt-0.5"></i>
                            <span class="text-lg text-slate-700"><?php echo mer_esc($item); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="flex flex-col justify-center">
                <div class="bg-slate-50 border border-slate-100 rounded-2xl p-8">
                    <h3 class="text-2xl font-bold tracking-tight mb-4"><?php echo mer_esc($awards_title); ?></h3>
                    <p class="text-lg text-slate-500 leading-relaxed mb-6"><?php echo mer_esc($awards_text); ?></p>
                    <div class="flex items-center gap-6 flex-wrap">
                        <?php if (is_array($awards_logo1)) : ?>
                            <img src="<?php echo esc_url($awards_logo1['url']); ?>" alt="<?php echo esc_attr($awards_logo1['alt'] ?: __('Nagroda', 'meritoros')); ?>" class="object-contain" style="width:120px;height:100px;" loading="lazy">
                        <?php endif; ?>
                        <?php if (is_array($awards_logo2)) : ?>
                            <img src="<?php echo esc_url($awards_logo2['url']); ?>" alt="<?php echo esc_attr($awards_logo2['alt'] ?: __('Nagroda', 'meritoros')); ?>" class="h-16 w-auto object-contain" loading="lazy">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-6 mt-24">
            <div class="bg-[#00d084] text-white p-8 rounded-2xl flex items-center justify-start text-left min-h-[160px] gap-6">
                <?php if (is_array($stat1_image)) : ?>
                    <img src="<?php echo esc_url($stat1_image['url']); ?>" alt="<?php echo esc_attr($stat1_image['alt']); ?>" class="h-14 w-auto shrink-0 object-contain opacity-90" loading="lazy">
                <?php else : ?>
                    <i data-lucide="shield-check" stroke-width="1.5" class="h-12 w-12 shrink-0 opacity-80"></i>
                <?php endif; ?>
                <h4 class="text-xl font-medium tracking-tight"><?php echo mer_esc($stat1_text); ?></h4>
            </div>
            <div class="bg-[#00d084] text-white p-8 rounded-2xl flex items-center justify-start text-left min-h-[160px] gap-6">
                <?php if (is_array($stat2_image)) : ?>
                    <img src="<?php echo esc_url($stat2_image['url']); ?>" alt="<?php echo esc_attr($stat2_image['alt']); ?>" class="h-14 w-auto shrink-0 object-contain opacity-90" loading="lazy">
                <?php else : ?>
                    <i data-lucide="award" stroke-width="1.5" class="h-12 w-12 shrink-0 opacity-80"></i>
                <?php endif; ?>
                <h4 class="text-xl font-medium tracking-tight"><?php echo mer_esc($stat2_text); ?></h4>
            </div>
            <div class="bg-[#00d084] text-white p-8 rounded-2xl flex items-center justify-start text-left min-h-[160px] gap-6">
                <i data-lucide="users" stroke-width="1.5" class="h-12 w-12 shrink-0 opacity-80"></i>
                <h4 class="text-xl font-medium tracking-tight"><?php echo mer_esc($stat3_text); ?></h4>
            </div>
        </div>
    </div>
</section>
