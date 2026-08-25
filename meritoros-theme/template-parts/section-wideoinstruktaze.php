<?php
/**
 * Sekcja: Wideoinstruktaże  (page-blog.php)
 * Pola ACF z group_mer_blog_page (functions.php), zakładka "Wideoinstruktaże":
 * wi_label, wi_title, wi_desc, wi_1_title, wi_1_url … wi_10_title, wi_10_url
 */
$pid = $args['pid'] ?? get_the_ID();

$label = get_field('wi_label', $pid) ?: 'Wideo';
$title = get_field('wi_title', $pid) ?: 'Wideoinstruktaże';
$desc  = get_field('wi_desc',  $pid) ?: 'Praktyczne instruktaże wideo z zakresu księgowości, podatków i kadr.';

$cards    = [];
$per_page = 3;

for ($i = 1; $i <= 10; $i++) {
    $t = trim((string) get_field("wi_{$i}_title", $pid));
    $u = trim((string) get_field("wi_{$i}_url",   $pid));
    if (!$t && !$u) continue;

    $yt = '';
    if ($u && preg_match(
        '/(?:youtube\.com\/(?:watch\?(?:.*&)?v=|shorts\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/',
        $u, $m
    )) {
        $yt = $m[1];
    }

    $cards[] = [
        'title' => $t ?: "Film {$i}",
        'embed' => $yt ? "https://www.youtube.com/embed/{$yt}?autoplay=1&rel=0" : $u,
        'thumb' => $yt ? "https://img.youtube.com/vi/{$yt}/maxresdefault.jpg"   : '',
    ];
}

$total = count($cards);
?>
<section class="py-14 md:py-20 bg-slate-50 border-t border-slate-100">
    <div class="max-w-[1400px] mx-auto px-6 lg:px-12">

        <div class="mb-10">
            <span class="text-[#00d084] uppercase tracking-widest text-base font-bold mb-4 block">
                <?php echo mer_esc($label); ?>
            </span>
            <h2 class="text-pretty text-3xl lg:text-5xl font-bold tracking-tight text-slate-900">
                <?php echo mer_esc($title); ?>
            </h2>
            <?php if ($desc) : ?>
                <p class="text-slate-500 text-base leading-relaxed mt-4 max-w-2xl">
                    <?php echo mer_esc($desc); ?>
                </p>
            <?php endif; ?>
        </div>

        <?php if (empty($cards)) : ?>
            <p class="text-slate-400 text-sm italic">Brak filmów. Dodaj linki YouTube w zakładce "Wideoinstruktaże" w ustawieniach strony.</p>
        <?php else : ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="wi-grid">
            <?php foreach ($cards as $idx => $card) : ?>
                <div class="wi-card group bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-200 flex flex-col"
                     <?php echo $idx >= $per_page ? 'style="display:none"' : ''; ?>>

                    <div class="wi-play relative aspect-video overflow-hidden bg-slate-900 cursor-pointer"
                         data-src="<?php echo esc_attr($card['embed']); ?>">

                        <?php if ($card['thumb']) : ?>
                            <img src="<?php echo esc_url($card['thumb']); ?>"
                                 alt="<?php echo esc_attr($card['title']); ?>"
                                 class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300">
                            <div class="absolute inset-0 bg-slate-900/20 group-hover:bg-slate-900/10 transition-colors duration-300"></div>
                        <?php else : ?>
                            <div class="w-full h-full bg-slate-800 flex items-center justify-center">
                                <i data-lucide="youtube" class="w-12 h-12 text-white/20"></i>
                            </div>
                        <?php endif; ?>

                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <span class="flex h-14 w-14 items-center justify-center rounded-full bg-white/90 text-[#00d084] shadow-lg ring-4 ring-white/20 group-hover:scale-105 transition-transform duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current ml-0.5" viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                            </span>
                        </div>
                    </div>

                    <div class="px-5 py-4 flex items-center gap-3">
                        <i data-lucide="youtube" class="w-5 h-5 shrink-0 text-red-500 stroke-[1.5]"></i>
                        <p class="text-sm font-semibold text-slate-800 leading-snug group-hover:text-[#00d084] transition-colors">
                            <?php echo mer_esc($card['title']); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($total > $per_page) : ?>
        <div id="wi-load-more-wrap" class="mt-10 text-center">
            <button id="wi-load-more"
                    class="mer-btn mer-btn--primary inline-flex items-center gap-2 border border-slate-300 text-slate-700 rounded-full px-8 py-3.5 text-sm font-semibold hover:border-[#00d084] hover:text-[#00d084] transition-colors duration-200">
                <?php esc_html_e('Załaduj więcej', 'meritoros'); ?>
                <i data-lucide="chevron-down" class="w-4 h-4 stroke-[2.5]"></i>
            </button>
        </div>
        <?php endif; ?>

        <?php endif; ?>
    </div>
</section>

<div id="wi-modal" class="fixed inset-0 z-[110] hidden items-center justify-center p-4 md:p-10">
    <div id="wi-backdrop" class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm"></div>
    <div class="relative w-full max-w-4xl z-10">
        <button id="wi-close" class="absolute -top-10 right-0 text-white/80 hover:text-white transition-colors flex items-center gap-1.5 text-sm">
            <i data-lucide="x" class="w-5 h-5"></i> <?php esc_html_e('Zamknij', 'meritoros'); ?>
        </button>
        <div class="relative w-full" style="padding-bottom:56.25%">
            <iframe id="wi-iframe" class="absolute inset-0 w-full h-full rounded-2xl"
                    src="" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
        </div>
    </div>
</div>

<script>
(function () {
    var modal    = document.getElementById('wi-modal');
    var backdrop = document.getElementById('wi-backdrop');
    var closeBtn = document.getElementById('wi-close');
    var iframe   = document.getElementById('wi-iframe');

    function openModal(src) {
        if (!src) return;
        iframe.src = src;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        iframe.src = '';
        document.body.style.overflow = '';
    }

    document.querySelectorAll('.wi-play').forEach(function (el) {
        el.addEventListener('click', function () { openModal(el.dataset.src); });
    });
    if (backdrop) backdrop.addEventListener('click', closeModal);
    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModal(); });

    var allCards = Array.from(document.querySelectorAll('.wi-card'));
    var loadBtn  = document.getElementById('wi-load-more');
    var loadWrap = document.getElementById('wi-load-more-wrap');
    var shown    = <?php echo (int) $per_page; ?>;
    var pp       = <?php echo (int) $per_page; ?>;

    if (loadBtn) {
        loadBtn.addEventListener('click', function () {
            allCards.slice(shown, shown + pp).forEach(function (c) { c.style.display = ''; });
            shown += pp;
            if (shown >= allCards.length) loadWrap.style.display = 'none';
            if (typeof lucide !== 'undefined') lucide.createIcons();
        });
    }
})();
</script>
