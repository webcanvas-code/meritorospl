<?php
$title = mer_field('kar_oferty_title', __('Aktualne oferty', 'meritoros'));

$cat_labels = [
    'ksiegowosc' => __('Księgowość', 'meritoros'),
    'kadry'      => __('Kadry', 'meritoros'),
    'it'         => 'IT',
    'inne'       => __('Inne', 'meritoros'),
    'praktyki'   => __('Praktyki i staże', 'meritoros'),
];

$_kar_page_id = get_the_ID();
$_kar_orig_id = apply_filters('wpml_object_id', $_kar_page_id, get_post_type(), true, apply_filters('wpml_default_language', null));

$oferty = [];
for ($i = 1; $i <= 6; $i++) {
    $g = get_field("kar_oferta_{$i}") ?: ($_kar_orig_id !== $_kar_page_id ? get_field("kar_oferta_{$i}", $_kar_orig_id) : null);
    if (!is_array($g) || empty($g['title'])) continue;
    $oferty[] = [
        'title'       => $g['title'],
        'salary'      => $g['salary'] ?? '',
        'cat'         => $g['cat']    ?? 'inne',
        'traffit_url' => $g['traffit_url'] ?? '',
        'url'         => $g['url']         ?? '',
    ];
}
?>

<?php if (empty($oferty)) return; ?>
<section id="oferty" class="py-16 md:py-24 bg-white relative">
    <div class="absolute -right-32 top-1/2 -translate-y-1/2 w-[480px] h-[480px] rounded-full border-[40px] border-emerald-100 pointer-events-none"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 mb-8"><?php echo mer_esc($title); ?></h2>

        <div class="flex flex-wrap gap-3 mb-10" id="oferty-filters">
            <button data-filter="all" class="oferty-filter px-5 py-2 rounded-full text-sm font-medium bg-[#2d8650] text-white transition-colors"><?php esc_html_e('Wszystkie', 'meritoros'); ?></button>
            <?php foreach ($cat_labels as $slug => $label) : ?>
            <button data-filter="<?php echo esc_attr($slug); ?>" class="oferty-filter px-5 py-2 rounded-full text-sm font-medium border border-slate-300 text-slate-700 hover:border-emerald-400 transition-colors"><?php echo mer_esc($label); ?></button>
            <?php endforeach; ?>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="oferty-grid">
            <?php foreach ($oferty as $o) : ?>
            <div class="oferta-card group border border-slate-200 rounded-2xl p-8 flex flex-col gap-5 bg-white hover:bg-[#2d8650] hover:border-transparent transition-all duration-300 cursor-pointer" data-cat="<?php echo esc_attr($o['cat']); ?>">
                <i data-lucide="file-text" stroke-width="1" class="w-10 h-10 text-[#2d8650] group-hover:text-white/80 transition-colors duration-300"></i>
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-slate-900 group-hover:text-white leading-snug mb-4 transition-colors duration-300"><?php echo mer_esc($o['title']); ?></h3>
                    <?php if (!empty($o['salary'])) : ?>
                    <div class="flex flex-wrap gap-2">
                        <?php foreach (array_filter(array_map('trim', explode('·', $o['salary']))) as $badge) : ?>
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-slate-100 text-slate-600 group-hover:bg-[#246e41] group-hover:text-white transition-colors duration-300"><?php echo mer_esc($badge); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="flex flex-wrap gap-2">
                    <?php if (!empty($o['traffit_url'])) : ?>
                    <a href="<?php echo esc_url($o['traffit_url']); ?>" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#2d8650] text-white group-hover:bg-white group-hover:text-slate-900 text-sm font-medium transition-all duration-300">
                        <?php esc_html_e('Aplikuj teraz', 'meritoros'); ?> <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                    <?php else : ?>
                    <button onclick="document.getElementById('zostaw-cv').scrollIntoView({behavior:'smooth'})"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#2d8650] text-white group-hover:bg-white group-hover:text-slate-900 text-sm font-medium transition-all duration-300">
                        <?php esc_html_e('Aplikuj teraz', 'meritoros'); ?> <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </button>
                    <?php endif; ?>
                    <?php if (!empty($o['url'])) : ?>
                    <a href="<?php echo esc_url($o['url']); ?>"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full border border-[#2d8650]/50 text-[#2d8650] group-hover:border-white/50 group-hover:text-white text-sm font-medium transition-all duration-300">
                        <?php esc_html_e('Zobacz szczegóły', 'meritoros'); ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-12 text-center">
            <a href="#rekrutacja"
               onclick="event.preventDefault();document.getElementById('rekrutacja').scrollIntoView({behavior:'smooth'})"
               class="inline-flex items-center gap-2 px-8 py-4 rounded-full border-2 border-[#2d8650] text-[#2d8650] font-semibold text-base hover:bg-[#2d8650] hover:text-white transition-colors duration-200">
                <?php esc_html_e('Sprawdź proces rekrutacyjny', 'meritoros'); ?>
                <i data-lucide="arrow-down" class="w-5 h-5 stroke-[2]"></i>
            </a>
        </div>

    </div>
</section>

<script>
(function () {
    var filters = document.querySelectorAll('.oferty-filter');
    var cards   = document.querySelectorAll('.oferta-card');
    filters.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var f = btn.dataset.filter;
            filters.forEach(function (b) {
                b.classList.remove('bg-[#2d8650]', 'text-white');
                b.classList.add('border', 'border-slate-300', 'text-slate-700');
            });
            btn.classList.add('bg-[#2d8650]', 'text-white');
            btn.classList.remove('border', 'border-slate-300', 'text-slate-700');
            cards.forEach(function (card) {
                card.style.display = (f === 'all' || card.dataset.cat === f) ? '' : 'none';
            });
        });
    });
})();
</script>
