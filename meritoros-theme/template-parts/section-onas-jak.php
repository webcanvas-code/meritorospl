<?php
$_page_id = get_the_ID();
$_orig_id = apply_filters('wpml_object_id', $_page_id, get_post_type(), true, apply_filters('wpml_default_language', null));

$jak_title = mer_field('onas_jak_title', 'Jak pracujemy?');
$jak_photo = get_field('onas_jak_photo');

$jak_defaults = [
    ['icon' => 'users-round', 'title' => 'Dedykowany zespół',       'text' => 'Każdy klient współpracuje z przypisanym zespołem specjalistów oraz Liderem odpowiedzialnym za jakość i terminowość.'],
    ['icon' => 'workflow',    'title' => 'Podejście procesowe',      'text' => 'Wszystkie działania opieramy na udokumentowanych procesach z określonymi SLA, checklistami i punktami kontroli jakości — tak by każda operacja była przewidywalna i powtarzalna.'],
    ['icon' => 'repeat-2',   'title' => 'Pełna zastępowalność',      'text' => 'Procesy są tak zorganizowane, by urlopy i rotacja kadry nie wpływały na ciągłość obsługi. Klient zawsze ma kogoś do dyspozycji i nie odczuwa zmian personalnych.'],
    ['icon' => 'handshake',  'title' => 'Elastyczność współpracy',   'text' => 'Dopasowujemy zakres, terminy raportowania i sposób komunikacji do realnych potrzeb firmy — niezależnie od jej wielkości czy etapu rozwoju.'],
];

$jak_items = [];
for ($i = 1; $i <= 4; $i++) {
    $item = get_field("onas_jak_{$i}") ?: ($_orig_id !== $_page_id ? get_field("onas_jak_{$i}", $_orig_id) : null);
    if (!empty($item['title'])) {
        $jak_items[] = [
            'icon'  => !empty($item['icon'])  ? $item['icon']  : $jak_defaults[$i - 1]['icon'],
            'title' => $item['title'],
            'text'  => !empty($item['text'])  ? $item['text']  : '',
        ];
    } else {
        $jak_items[] = $jak_defaults[$i - 1];
    }
}

$photo_url = is_array($jak_photo) ? esc_url($jak_photo['url']) : '';
$photo_alt = is_array($jak_photo) ? esc_attr($jak_photo['alt'] ?: 'Zespół Meritoros przy pracy') : 'Zespół Meritoros przy pracy';
?>

<section class="py-14 bg-emerald-50">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-start">

            <!-- Left: accordion -->
            <div>
                <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 mb-6"><?php echo mer_esc($jak_title); ?></h2>

                <div id="jak-accordion">
                    <?php foreach ($jak_items as $idx => $item) : ?>
                        <div class="jak-item border-b border-slate-200 py-4 cursor-pointer" data-index="<?php echo $idx; ?>">
                            <div class="flex items-center gap-4">
                                <i data-lucide="<?php echo esc_attr($item['icon']); ?>" stroke-width="1" class="w-7 h-7 text-[#48c279] shrink-0"></i>
                                <h3 class="text-lg font-bold jak-title transition-colors duration-300"><?php echo mer_esc($item['title']); ?></h3>
                                <i data-lucide="chevron-down" class="jak-chevron ml-auto w-4 h-4 text-slate-400 shrink-0 transition-transform duration-300"></i>
                            </div>
                            <div class="jak-content overflow-hidden" style="max-height:0;transition:max-height .4s ease,opacity .3s ease;opacity:0;">
                                <p class="text-base text-slate-600 leading-relaxed pt-3 pl-11">
                                    <?php echo mer_esc($item['text']); ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Right: photo -->
            <div class="hidden lg:block rounded-2xl overflow-hidden shadow-lg shadow-slate-200/60 sticky top-24">
                <?php if ($photo_url) : ?>
                    <img src="<?php echo $photo_url; ?>" alt="<?php echo $photo_alt; ?>" class="w-full h-full object-cover aspect-[4/3]" loading="lazy">
                <?php else : ?>
                    <div class="w-full aspect-[4/3] bg-slate-200 rounded-2xl"></div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>

<script>
(function () {
    var items = document.querySelectorAll('.jak-item');
    if (!items.length) return;
    var activeIndex = 0;

    function activate(index) {
        activeIndex = index;
        items.forEach(function (item, i) {
            var content = item.querySelector('.jak-content');
            var title   = item.querySelector('.jak-title');
            var chevron = item.querySelector('.jak-chevron');
            if (i === index) {
                content.style.maxHeight = '500px';
                content.style.opacity   = '1';
                if (title)   { title.classList.add('text-[#48c279]'); title.classList.remove('text-slate-900'); }
                if (chevron) chevron.style.transform = 'rotate(180deg)';
            } else {
                content.style.maxHeight = '0';
                content.style.opacity   = '0';
                if (title)   { title.classList.remove('text-[#48c279]'); title.classList.add('text-slate-900'); }
                if (chevron) chevron.style.transform = '';
            }
        });
    }

    var isTouch = window.matchMedia('(hover: none)').matches;

    items.forEach(function (item) {
        if (!isTouch) {
            item.addEventListener('mouseenter', function () {
                activate(parseInt(item.dataset.index));
            });
        }
        item.addEventListener('click', function () {
            var idx = parseInt(item.dataset.index);
            if (isTouch && idx === activeIndex) {
                activeIndex = -1;
                var content = item.querySelector('.jak-content');
                var title   = item.querySelector('.jak-title');
                var chevron = item.querySelector('.jak-chevron');
                content.style.maxHeight = '0';
                content.style.opacity   = '0';
                if (title)   { title.classList.remove('text-[#48c279]'); title.classList.add('text-slate-900'); }
                if (chevron) chevron.style.transform = '';
            } else {
                activate(idx);
            }
        });
    });

    activate(0);
})();
</script>
