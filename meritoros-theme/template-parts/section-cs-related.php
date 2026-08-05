<?php
defined('ABSPATH') || exit;

$related = new WP_Query([
    'post_type'      => 'customer-story',
    'posts_per_page' => 8,
    'post__not_in'   => [get_the_ID()],
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

/* ── Demo data (fallback gdy brak wpisów) ────────────────────────── */
$_demo_cards = [
    ['thumb' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=800&q=80', 'tags' => ['Geologia inżynierska', 'Ochrona środowiska'], 'title' => 'Kadry i płace, wsparcie w procesie audytu kadrowego',   'desc' => 'Po kilku zmianach w dziale HR spółka potrzebowała szybkiego uporządkowania dokumentacji kadrowej i bezpiecznego zamknięcia roku.'],
    ['thumb' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80', 'tags' => ['E-commerce', 'Technologia'],              'title' => 'Pełna obsługa kadrowo-płacowa, raportowanie HR',           'desc' => 'Dynamicznie rosnąca spółka technologiczna potrzebowała partnera, który zapewni sprawne naliczanie płac.'],
    ['thumb' => 'https://images.unsplash.com/photo-1515187029135-18ee286d815b?w=800&q=80', 'tags' => ['Finanse', 'Bookkeeping'],               'title' => 'Obsługa księgowa i doradztwo podatkowe',                   'desc' => 'Firma potrzebowała stabilnego partnera do prowadzenia pełnej księgowości i optymalizacji podatkowej.'],
    ['thumb' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=800&q=80', 'tags' => ['Produkcja', 'Logistyka'],              'title' => 'Kadry, płace i obsługa audytu ZUS',                         'desc' => 'Klient wymagał kompleksowego wsparcia przy kontroli ZUS i bieżącej obsłudze kadrowo-płacowej.'],
    ['thumb' => 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=800&q=80', 'tags' => ['IT', 'SaaS'],                        'title' => 'Outsourcing księgowości dla spółki technologicznej',          'desc' => 'Startup potrzebował elastycznego modelu obsługi finansowej dopasowanego do dynamicznego wzrostu.'],
    ['thumb' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=800&q=80', 'tags' => ['Handel', 'Dystrybucja'],             'title' => 'Optymalizacja procesów finansowo-księgowych',                'desc' => 'Sieć handlowa potrzebowała zunifikowania procesów i raportowania w wielu oddziałach.'],
];

$use_demo = !$related->have_posts();
?>
<section class="py-14 md:py-20 bg-emerald-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Nagłówek z przyciskami nawigacji -->
        <div class="flex items-center justify-between mb-10">
            <h2 class="text-pretty text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-slate-900">Przeczytaj również</h2>
            <div class="flex items-center gap-2">
                <button id="cs-rel-prev"
                        class="w-11 h-11 rounded-full bg-white border border-slate-200 hover:border-emerald-400 hover:text-[#00d084] flex items-center justify-center text-slate-500 transition-colors duration-200 shadow-sm"
                        aria-label="Poprzedni">
                    <i data-lucide="chevron-left" class="w-5 h-5"></i>
                </button>
                <button id="cs-rel-next"
                        class="w-11 h-11 rounded-full bg-[#00d084] hover:bg-[#00b872] flex items-center justify-center text-white transition-colors duration-200 shadow-sm"
                        aria-label="Następny">
                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </button>
            </div>
        </div>

        <!-- Slider -->
        <div id="cs-rel-track"
             class="flex gap-6 overflow-x-auto snap-x snap-mandatory scroll-smooth pb-2"
             style="-ms-overflow-style:none; scrollbar-width:none;">

            <?php if ($use_demo) : ?>
            <?php foreach ($_demo_cards as $card) : ?>
            <article class="flex-shrink-0 w-[340px] sm:w-[400px] lg:w-[440px] snap-start">
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
                    <!-- Miniatura -->
                    <div class="relative aspect-video bg-slate-100 overflow-hidden">
                        <img src="<?php echo esc_url($card['thumb']); ?>" alt="<?php echo esc_attr($card['title']); ?>"
                             class="w-full h-full object-cover" loading="lazy">
                        <div class="absolute inset-0 bg-slate-900/30"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-14 h-14 rounded-full bg-[#00d084] flex items-center justify-center shadow-xl">
                                <i data-lucide="play" fill="#fff" class="w-5 h-5 text-white ml-0.5" stroke-width="0"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Treść -->
                    <div class="p-6">
                        <span class="text-base font-bold text-slate-800 mb-3 block">HPC+</span>
                        <div class="flex flex-wrap gap-1.5 mb-4">
                            <?php foreach ($card['tags'] as $tag) : ?>
                            <span class="text-sm text-slate-500 border border-slate-200 rounded-full px-3 py-1"><?php echo mer_esc($tag); ?></span>
                            <?php endforeach; ?>
                        </div>
                        <p class="text-sm font-bold text-slate-900 mb-1">Zakres współpracy:</p>
                        <p class="text-lg font-semibold text-slate-900 leading-snug mb-2"><?php echo mer_esc($card['title']); ?></p>
                        <p class="text-base sm:text-lg text-slate-500 leading-relaxed"><?php echo mer_esc($card['desc']); ?></p>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>

            <?php else : ?>
            <?php while ($related->have_posts()) : $related->the_post(); ?>
            <?php
            $r_tags      = array_values(array_filter(array_map('trim', explode("\n", get_field('cs_tags') ?: ''))));
            $r_logo      = get_field('cs_logo');
            $r_thumb     = get_field('cs_thumbnail');
            $r_thumb_url = is_array($r_thumb) ? $r_thumb['url'] : get_the_post_thumbnail_url(null, 'large');
            $r_client    = get_field('cs_client_info') ?: '';
            $r_desc      = wp_trim_words(strip_tags($r_client), 18, '…');
            $r_video_url = get_field('cs_video_url') ?: '';

            // Fallback: miniatura z YouTube gdy brak własnej miniatury
            if (!$r_thumb_url && $r_video_url) {
                preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|v\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $r_video_url, $_yt_m);
                if (!empty($_yt_m[1])) {
                    $r_thumb_url = 'https://img.youtube.com/vi/' . $_yt_m[1] . '/hqdefault.jpg';
                }
            }
            ?>
            <article class="flex-shrink-0 w-[340px] sm:w-[400px] lg:w-[440px] snap-start flex flex-col">
                <a href="<?php the_permalink(); ?>" class="group flex flex-col h-full bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200">
                    <!-- Miniatura -->
                    <div class="relative aspect-video bg-slate-100 overflow-hidden">
                        <?php if ($r_thumb_url) : ?>
                        <img src="<?php echo esc_url($r_thumb_url); ?>" alt="<?php the_title_attribute(); ?>"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                        <?php endif; ?>
                        <div class="absolute inset-0 bg-slate-900/30 group-hover:bg-slate-900/40 transition-colors"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-14 h-14 rounded-full bg-[#00d084] flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform duration-200">
                                <i data-lucide="play" fill="#fff" class="w-5 h-5 text-white ml-0.5" stroke-width="0"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Treść -->
                    <div class="p-6 flex flex-col flex-1">
                        <?php if ($r_logo) : ?>
                        <img src="<?php echo esc_url($r_logo['url']); ?>"
                             alt="<?php echo esc_attr($r_logo['alt'] ?: get_the_title()); ?>"
                             class="h-7 w-auto object-contain mb-3" loading="lazy">
                        <?php else : ?>
                        <span class="text-base font-bold text-slate-800 mb-3 block"><?php the_title(); ?></span>
                        <?php endif; ?>
                        <?php if ($r_tags) : ?>
                        <div class="flex flex-wrap gap-1.5 mb-4">
                            <?php foreach ($r_tags as $tag) : ?>
                            <span class="text-sm text-slate-500 border border-slate-200 rounded-full px-3 py-1"><?php echo mer_esc($tag); ?></span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                        <p class="text-sm font-bold text-slate-900 mb-1">Zakres współpracy:</p>
                        <p class="text-lg font-semibold text-slate-900 leading-snug mb-2"><?php the_title(); ?></p>
                        <?php if ($r_desc) : ?>
                        <p class="text-base sm:text-lg text-slate-500 leading-relaxed"><?php echo mer_esc($r_desc); ?></p>
                        <?php endif; ?>
                    </div>
                </a>
            </article>
            <?php endwhile; wp_reset_postdata(); ?>
            <?php endif; ?>

        </div>
    </div>
</section>

<script>
(function () {
    var track = document.getElementById('cs-rel-track');
    var prev  = document.getElementById('cs-rel-prev');
    var next  = document.getElementById('cs-rel-next');
    if (!track) return;
    var step = function () {
        var card = track.querySelector('article');
        return card ? card.offsetWidth + 24 : 344;
    };
    prev.addEventListener('click', function () { track.scrollBy({ left: -step(), behavior: 'smooth' }); });
    next.addEventListener('click', function () { track.scrollBy({ left:  step(), behavior: 'smooth' }); });
})();
</script>
