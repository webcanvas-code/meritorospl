<?php
$title    = mer_field('bpo_td_title', 'Transformacja Cyfrowa');
$text     = mer_field('bpo_td_text',  'Systematycznie rozwijamy i wdrażamy rozwiązania z zakresu robotyki (RPA) oraz automatyzacji. Wdrażamy najnowsze technologie, w tym Robotic Process Automation oraz AI, aby umożliwić klientom pełną kontrolę nad finansami. Działamy w modelu Lean, który zapewnia sprawność operacyjną i błyskawiczne dostosowanie się do potrzeb zmieniającego się rynku.');
$bg_img   = get_field('bpo_td_bg');
$items_r  = mer_field('bpo_td_items', "Robotyzacja RPA\n\nE-teczki\n\nOptymalizacja procesów\n\nElektroniczny obieg dokumentów\n\nAutomatyzacja raportowania");
$items    = array_filter(array_map('trim', preg_split('/(\r?\n){2,}/', $items_r)));

$bg_url = is_array($bg_img) ? esc_url($bg_img['url']) : 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&q=80&w=2000';
?>

<section id="bpo-cyfrowa" class="py-16 md:py-24 bg-slate-900 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-65">
        <img src="<?php echo $bg_url; ?>" alt="" class="w-full h-full object-cover" loading="lazy">
        <div class="absolute inset-0 bg-slate-900/30 mix-blend-multiply"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10 grid lg:grid-cols-2 gap-16">
        <div>
            <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight mb-6"><?php echo mer_esc($title); ?></h2>
            <p class="text-lg text-slate-300 mb-10 leading-relaxed"><?php echo mer_esc($text); ?></p>
            <ul class="space-y-5">
                <?php foreach ($items as $item) : ?>
                    <li class="flex items-center gap-4">
                        <i data-lucide="check-circle-2" stroke-width="1.5" class="w-6 h-6 text-[#00d084] shrink-0"></i>
                        <span class="text-xl font-medium"><?php echo mer_esc($item); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="flex items-center justify-center">
            <?php
            $btn_text = mer_field('bpo_td_btn_text', 'Umów się na konsultacje');
            $btn_url  = mer_field('bpo_td_btn_url',  home_url('/kontakt/'));
            ?>
            <a href="<?php echo esc_url($btn_url); ?>"
               class="mer-btn mer-btn--primary inline-flex items-center gap-2 px-8 py-4 rounded-full bg-[#00d084] text-white text-base font-medium hover:bg-[#00b872] transition-colors">
                <?php echo mer_esc($btn_text); ?>
            </a>
        </div>
    </div>
</section>
