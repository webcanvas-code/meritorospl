<?php
$title = mer_field('fr_dlaczego_title', 'Dlaczego Meritoros');

$d1_title = mer_field('fr_d1_title', "Bezpieczeństwo\ni compliance");
$d1_text  = mer_field('fr_d1_text',  'Działamy zgodnie z obowiązującymi regulacjami i standardami bezpieczeństwa danych. Dbamy o poufność informacji oraz jasne zasady współpracy – bez „skrótów" i ryzyk.');
$d1_logo  = get_field('fr_d1_logo');

$d2_title = mer_field('fr_d2_title', "Jakość potwierdzona\nstandardami");
$d2_text  = mer_field('fr_d2_text',  'Mamy wdrożone procedury kontroli jakości i weryfikacji danych. Dostarczamy informacje finansowe kompletne, spójne i użyteczne dla zarządu.');
$d2_logo  = get_field('fr_d2_logo');

$d3_title = mer_field('fr_d3_title', 'Ponad 170 ekspertów');
$d3_text  = mer_field('fr_d3_text',  'Jakość potwierdzona standardami. Mamy wdrożone procedury kontroli jakości i weryfikacji danych. Dostarczamy informacje finansowe kompletne, spójne i użyteczne dla zarządu.');
?>

<section class="py-10 md:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 mb-12">
            <?php echo nl2br(str_replace('Meritoros', '<span class="text-[#00d084]">Meritoros</span>', esc_html($title))); ?>
        </h2>

        <div class="grid md:grid-cols-3 gap-6">

            <!-- Card 1 -->
            <div class="bg-[#00d084] rounded-3xl p-8 flex flex-col min-h-[380px] relative overflow-hidden">
                <?php
                $raw1 = $d1_title;
                if (strpos($raw1, "\n") !== false) {
                    $d1_parts = explode("\n", $raw1, 2);
                } else {
                    $mid1 = (int) ceil(mb_strlen($raw1) / 2);
                    $pos1 = mb_strrpos(mb_substr($raw1, 0, $mid1 + 6), ' ');
                    $d1_parts = $pos1 !== false
                        ? [mb_substr($raw1, 0, $pos1), mb_substr($raw1, $pos1 + 1)]
                        : [$raw1, ''];
                }
                ?>
                <h3 class="text-xl font-bold text-white mb-4 leading-snug">
                    <span class="block"><?php echo mer_esc($d1_parts[0]); ?></span>
                    <?php if (!empty($d1_parts[1])) : ?>
                    <span class="block text-white/80 font-medium"><?php echo mer_esc($d1_parts[1]); ?></span>
                    <?php endif; ?>
                </h3>
                <p class="text-white/85 text-base leading-relaxed"><?php echo mer_esc($d1_text); ?></p>
                <div class="mt-auto pt-8">
                    <?php if (is_array($d1_logo)) : ?>
                        <img src="<?php echo esc_url($d1_logo['url']); ?>" alt="<?php echo esc_attr($d1_logo['alt'] ?: 'ISO 27001'); ?>" class="h-16 w-auto object-contain brightness-0 invert opacity-90" loading="lazy">
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/ISO_27001.svg" alt="ISO 27001" class="h-20 w-auto object-contain opacity-90" loading="lazy">
                    <?php endif; ?>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-[#00d084] rounded-3xl p-8 flex flex-col min-h-[380px] relative overflow-hidden">
                <?php
                $raw2 = $d2_title;
                if (strpos($raw2, "\n") !== false) {
                    $d2_parts = explode("\n", $raw2, 2);
                } else {
                    $mid2 = (int) ceil(mb_strlen($raw2) / 2);
                    $pos2 = mb_strrpos(mb_substr($raw2, 0, $mid2 + 6), ' ');
                    $d2_parts = $pos2 !== false
                        ? [mb_substr($raw2, 0, $pos2), mb_substr($raw2, $pos2 + 1)]
                        : [$raw2, ''];
                }
                ?>
                <h3 class="text-xl font-bold text-white mb-4 leading-snug">
                    <span class="block"><?php echo mer_esc($d2_parts[0]); ?></span>
                    <?php if (!empty($d2_parts[1])) : ?>
                    <span class="block text-white/80 font-medium"><?php echo mer_esc($d2_parts[1]); ?></span>
                    <?php endif; ?>
                </h3>
                <p class="text-white/85 text-base leading-relaxed"><?php echo mer_esc($d2_text); ?></p>
                <div class="mt-auto pt-8">
                    <?php if (is_array($d2_logo)) : ?>
                        <img src="<?php echo esc_url($d2_logo['url']); ?>" alt="<?php echo esc_attr($d2_logo['alt'] ?: 'ISO 9001'); ?>" class="h-16 w-auto object-contain brightness-0 invert opacity-90" loading="lazy">
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/ISO9001.png" alt="ISO 9001" class="h-20 w-auto object-contain opacity-90" loading="lazy">
                    <?php endif; ?>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-[#00d084] rounded-3xl p-8 flex flex-col min-h-[380px] relative overflow-hidden">
                <div class="absolute -bottom-4 -right-4 opacity-10">
                    <i data-lucide="users" class="w-48 h-48 text-white stroke-[0.5]"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-4 leading-snug"><?php echo mer_esc($d3_title); ?></h3>
                <p class="text-white/85 text-base leading-relaxed relative z-10"><?php echo mer_esc($d3_text); ?></p>
                <div class="mt-auto pt-8 relative z-10">
                    <i data-lucide="user-check" stroke-width="1" class="w-14 h-14 text-white opacity-90"></i>
                </div>
            </div>

        </div>
    </div>
</section>
