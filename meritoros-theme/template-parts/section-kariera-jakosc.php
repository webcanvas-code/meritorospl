<?php
$_page_id = get_the_ID();
$_orig_id = apply_filters('wpml_object_id', $_page_id, get_post_type(), true, apply_filters('wpml_default_language', null));

$title  = mer_field('kar_jakosc_title',   __('Twórz z nami jakość', 'meritoros'));
$green  = mer_field('kar_jakosc_green',   '#Meritoros');
$text1  = mer_field('kar_jakosc_text1',   __('W Meritoros wspieramy firmy w księgowości, kadrach i płacach oraz procesach back-office od 2004 roku. Pracujemy tak, żeby być dumni z jakości informacji, które dostarczamy.', 'meritoros'));
$text2  = mer_field('kar_jakosc_text2',   __('Jednocześnie wiemy, że dobre wyniki robią ludzie: dbamy o partnerską współpracę, szacunek i realne wsparcie w zespole. Pracujemy w zadaniowym z elastycznością, która działa wtedy, gdy idzie w parze z odpowiedzialnością i dotrzymywaniem ustaleń.', 'meritoros'));

$slide_defaults = [
    'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&q=80',
    'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=800&q=80',
    'https://images.unsplash.com/photo-1515187029135-18ee286d815b?w=800&q=80',
    'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=800&q=80',
];
$slides = [];
for ($i = 1; $i <= 4; $i++) {
    $img = get_field("kar_jakosc_img{$i}") ?: ($_orig_id !== $_page_id ? get_field("kar_jakosc_img{$i}", $_orig_id) : null);
    $slides[] = is_array($img) ? ['url' => esc_url($img['url']), 'alt' => esc_attr($img['alt'] ?: '')] : ['url' => $slide_defaults[$i - 1], 'alt' => ''];
}

$card_defaults = [
    ['icon' => 'award',       'text' => __('Jakość i standard', 'meritoros')],
    ['icon' => 'handshake',   'text' => __('Szacunek i współpraca', 'meritoros')],
    ['icon' => 'users-round', 'text' => __('Elastyczność i odpowiedzialność', 'meritoros')],
];
$cards = [];
for ($i = 1; $i <= 3; $i++) {
    $g = get_field("kar_jakosc_card{$i}") ?: ($_orig_id !== $_page_id ? get_field("kar_jakosc_card{$i}", $_orig_id) : null);
    $d = $card_defaults[$i - 1];
    $cards[] = [
        'icon' => is_array($g) && !empty($g['icon']) ? $g['icon'] : $d['icon'],
        'text' => is_array($g) && !empty($g['text']) ? $g['text'] : $d['text'],
    ];
}
?>

<section class="py-16 md:py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center mb-16">
            <div class="relative">
                <div class="overflow-hidden rounded-2xl relative" id="jakosc-slider">
                    <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-emerald-400/50 to-transparent rounded-b-2xl pointer-events-none z-10"></div>
                    <div id="jakosc-track" class="flex transition-transform duration-500 ease-in-out">
                        <?php foreach ($slides as $slide) : ?>
                        <img src="<?php echo $slide['url']; ?>" alt="<?php echo $slide['alt']; ?>" class="w-full shrink-0 object-cover aspect-[4/3] rounded-2xl" loading="lazy">
                        <?php endforeach; ?>
                    </div>
                </div>
                <button id="jakosc-prev" class="absolute left-3 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full bg-white border border-slate-200 flex items-center justify-center shadow-sm hover:bg-slate-50 transition-colors" style="opacity:0.35;pointer-events:none" aria-label="<?php esc_attr_e('Poprzednie zdjęcie', 'meritoros'); ?>">
                    <i data-lucide="chevron-left" class="w-5 h-5 text-slate-700 stroke-[2]"></i>
                </button>
                <button id="jakosc-next" class="absolute right-3 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full bg-[#00d084] flex items-center justify-center shadow-md hover:bg-[#00b872] transition-colors" aria-label="<?php esc_attr_e('Następne zdjęcie', 'meritoros'); ?>">
                    <i data-lucide="chevron-right" class="w-5 h-5 text-white stroke-[2]"></i>
                </button>
                <div class="flex items-center justify-center gap-2 mt-5" id="jakosc-dots">
                    <?php foreach ($slides as $idx => $slide) : ?>
                    <button class="jakosc-dot <?php echo $idx === 0 ? 'w-2.5 h-2.5 bg-[#00d084]' : 'w-2 h-2 bg-slate-300 hover:bg-slate-400'; ?> rounded-full transition-all" data-idx="<?php echo $idx; ?>"></button>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="relative">
                <div class="absolute -right-32 top-1/2 -translate-y-1/2 w-72 h-72 rounded-full border-[40px] border-emerald-100 pointer-events-none hidden lg:block"></div>
                <div class="relative z-10">
                    <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight leading-tight mb-2 text-slate-900"><?php echo mer_esc($title); ?></h2>
                    <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight leading-tight mb-8 text-[#00d084]"><?php echo mer_esc($green); ?></h2>
                    <p class="text-base sm:text-lg text-slate-500 leading-relaxed mb-5"><?php echo mer_esc($text1); ?></p>
                    <p class="text-base sm:text-lg text-slate-500 leading-relaxed"><?php echo mer_esc($text2); ?></p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <?php foreach ($cards as $card) : ?>
            <div class="border border-emerald-200 rounded-2xl p-8 flex flex-col items-start gap-5 hover:shadow-sm transition-shadow">
                <i data-lucide="<?php echo esc_attr($card['icon']); ?>" stroke-width="1" class="w-12 h-12 text-[#00d084]"></i>
                <p class="text-lg font-semibold text-slate-900"><?php echo mer_esc($card['text']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<script>
(function () {
    var track   = document.getElementById('jakosc-track');
    var dots    = document.querySelectorAll('.jakosc-dot');
    var prevBtn = document.getElementById('jakosc-prev');
    var nextBtn = document.getElementById('jakosc-next');
    if (!track) return;
    var current = 0;
    var max     = dots.length - 1;
    function updateBtns() {
        if (prevBtn) { prevBtn.style.opacity = current === 0   ? '0.35' : '1'; prevBtn.style.pointerEvents = current === 0   ? 'none' : ''; }
        if (nextBtn) { nextBtn.style.opacity = current >= max  ? '0.35' : '1'; nextBtn.style.pointerEvents = current >= max  ? 'none' : ''; }
    }
    function goTo(idx) {
        current = idx;
        track.style.transform = 'translateX(-' + (idx * 100) + '%)';
        dots.forEach(function (d, i) {
            d.classList.toggle('bg-[#00d084]', i === idx);
            d.classList.toggle('w-2.5',          i === idx);
            d.classList.toggle('h-2.5',          i === idx);
            d.classList.toggle('bg-slate-300',   i !== idx);
            d.classList.toggle('w-2',            i !== idx);
            d.classList.toggle('h-2',            i !== idx);
        });
        updateBtns();
    }
    dots.forEach(function (d) {
        d.addEventListener('click', function () { goTo(parseInt(d.dataset.idx)); });
    });
    if (prevBtn) prevBtn.addEventListener('click', function () { if (current > 0)   goTo(current - 1); });
    if (nextBtn) nextBtn.addEventListener('click', function () { if (current < max) goTo(current + 1); });
    setInterval(function () { goTo((current + 1) % dots.length); }, 4000);
    updateBtns();
})();
</script>
