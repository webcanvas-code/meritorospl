<?php
$title = mer_field('kar_opinie_title', __('Co mówią nasi pracownicy', 'meritoros'));

$_kar_page_id = get_the_ID();
$_kar_orig_id = apply_filters('wpml_object_id', $_kar_page_id, get_post_type(), true, apply_filters('wpml_default_language', null));

$opinie = [];
for ($i = 1; $i <= 4; $i++) {
    $g = get_field("kar_opinia_{$i}") ?: ($_kar_orig_id !== $_kar_page_id ? get_field("kar_opinia_{$i}", $_kar_orig_id) : null);
    if (!is_array($g) || empty($g['quote'])) continue;
    $ph = !empty($g['photo']) ? $g['photo'] : null;
    $opinie[] = [
        'quote'     => $g['quote'],
        'name'      => $g['name'] ?? '',
        'role'      => $g['role'] ?? '',
        'photo_url' => is_array($ph) ? esc_url($ph['url']) : '',
        'photo_alt' => is_array($ph) ? esc_attr($ph['alt'] ?: ($g['name'] ?? '')) : ($g['name'] ?? ''),
    ];
}
?>

<?php if (empty($opinie)) return; ?>
<section class="py-16 sm:py-20 md:py-24 px-6 lg:px-12 bg-white relative">
    <div class="absolute -left-32 top-1/2 -translate-y-1/2 w-[420px] h-[420px] rounded-full border-[60px] border-emerald-100 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto relative z-10">
        <h2 class="text-pretty text-3xl lg:text-4xl xl:text-5xl font-bold tracking-tight text-slate-900 text-center mb-14"><?php echo mer_esc($title); ?></h2>

        <div class="relative flex items-center gap-4">
            <button id="opinie-prev" class="shrink-0 w-10 h-10 rounded-full border border-slate-200 bg-white flex items-center justify-center hover:bg-slate-50 transition z-10 shadow-sm">
                <i data-lucide="chevron-left" class="w-5 h-5 text-slate-600"></i>
            </button>

            <div class="overflow-hidden w-full">
                <div id="opinie-track" class="flex gap-6 transition-transform duration-500 ease-in-out">
                    <?php foreach ($opinie as $op) : ?>
                    <div class="opinia-card shrink-0 bg-white border border-slate-100 rounded-2xl p-5 sm:p-8 flex flex-col justify-between shadow-sm">
                        <p class="text-slate-600 text-base sm:text-lg italic leading-relaxed mb-5 sm:mb-8 line-clamp-5 sm:line-clamp-none">"<?php echo mer_esc($op['quote']); ?>"</p>
                        <div class="flex items-center gap-4">
                            <div>
                                <p class="font-bold text-slate-900 text-sm"><?php echo mer_esc($op['name']); ?></p>
                                <p class="text-slate-500 text-xs"><?php echo mer_esc($op['role']); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <button id="opinie-next" class="shrink-0 w-10 h-10 rounded-full border border-slate-200 bg-white flex items-center justify-center hover:bg-slate-50 transition z-10 shadow-sm">
                <i data-lucide="chevron-right" class="w-5 h-5 text-slate-600"></i>
            </button>
        </div>

        <div id="opinie-dots" class="flex justify-center gap-2 mt-8"></div>
    </div>
</section>

<script>
(function () {
    var track          = document.getElementById('opinie-track');
    var prevBtn        = document.getElementById('opinie-prev');
    var nextBtn        = document.getElementById('opinie-next');
    var dotsContainer  = document.getElementById('opinie-dots');
    if (!track) return;
    var cards   = track.querySelectorAll('.opinia-card');
    var total   = cards.length;
    var current = 0;

    function setCardWidths() {
        var containerWidth = track.parentElement.offsetWidth;
        var perView = window.innerWidth >= 640 ? 2 : 1;
        var gap = 24;
        var cardW = perView === 1 ? containerWidth : Math.floor((containerWidth - gap) / 2);
        cards.forEach(function (c) { c.style.width = cardW + 'px'; });
    }

    for (var i = 0; i < total; i++) {
        var dot = document.createElement('button');
        dot.className = 'rounded-full transition-all duration-300 ' + (i === 0 ? 'w-5 h-2 bg-[#2d8650]' : 'w-2 h-2 bg-slate-300');
        dot.setAttribute('data-i', i);
        dot.addEventListener('click', function () { goTo(parseInt(this.getAttribute('data-i'))); });
        dotsContainer.appendChild(dot);
    }

    function getCardWidth() { return cards[0].offsetWidth + 24; }

    function getMax() {
        var cw = track.parentElement.offsetWidth;
        var tw = cards.length * getCardWidth() - 24;
        return Math.max(0, tw - cw);
    }

    function updateDots() {
        dotsContainer.querySelectorAll('button').forEach(function (d, i) {
            d.className = 'rounded-full transition-all duration-300 ' + (i === current ? 'w-5 h-2 bg-[#2d8650]' : 'w-2 h-2 bg-slate-300');
        });
    }

    function goTo(index) {
        current = Math.max(0, Math.min(index, total - 1));
        var offset = Math.min(current * getCardWidth(), getMax());
        track.style.transform = 'translateX(-' + offset + 'px)';
        updateDots();
    }

    prevBtn.addEventListener('click', function () { goTo(current - 1); });
    nextBtn.addEventListener('click', function () { goTo(current + 1); });
    window.addEventListener('resize', function () { setCardWidths(); current = 0; goTo(0); });
    requestAnimationFrame(function () { setCardWidths(); goTo(0); });
})();
</script>
