<?php
defined('ABSPATH') || exit;
get_header();

if ( ! have_posts() ) { get_footer(); exit; }
the_post();

$photo      = get_field('ma_photo');
$source     = get_field('ma_source') ?: '';
$intro      = get_field('ma_text') ?: '';
$author     = get_field('ma_author') ?: '';
$date_label = get_field('ma_date_label') ?: get_the_date('j F Y');
$sections = [];
for ( $i = 1; $i <= 8; $i++ ) {
    $s = get_field( 'ma_section_' . $i );
    if ( ! empty( $s['body'] ) || ! empty( $s['heading'] ) ) {
        $sections[] = $s;
    }
}

$photo_url = is_array($photo) ? ($photo['url'] ?? '') : '';
$photo_alt = is_array($photo) ? ($photo['alt'] ?? get_the_title()) : get_the_title();

$media_page = get_page_by_path('media');
$media_url  = $media_page ? get_permalink($media_page) : home_url('/media/');

/* ── Budujemy HTML sekcji i parsujemy nagłówki do TOC ── */
$toc          = [];
$used_ids     = [];
$sections_html = '';

$inject_toc = function (string $html) use (&$toc, &$used_ids): string {
    return preg_replace_callback(
        '/<(h[234])([^>]*)>(.*?)<\/h[234]>/is',
        function ($m) use (&$toc, &$used_ids) {
            $tag   = $m[1];
            $attrs = $m[2];
            $inner = $m[3];
            $text  = wp_strip_all_tags($inner);
            $base  = sanitize_title($text);
            $id    = $base;
            $n     = 1;
            while (isset($used_ids[$id])) { $id = $base . '-' . $n++; }
            $used_ids[$id] = true;
            if (strpos($attrs, 'id=') === false) {
                $attrs .= ' id="' . esc_attr($id) . '"';
            }
            $toc[] = ['level' => $tag, 'text' => $text, 'id' => $id];
            return '<' . $tag . $attrs . '>' . $inner . '</' . $tag . '>';
        },
        $html
    );
};

foreach ($sections as $sec) {
    $chunk = '';
    if (!empty($sec['heading'])) {
        $lvl    = in_array($sec['heading_level'], ['h2', 'h3', 'h4']) ? $sec['heading_level'] : 'h2';
        $chunk .= '<' . $lvl . '>' . esc_html($sec['heading']) . '</' . $lvl . '>';
    }
    if (!empty($sec['body'])) {
        $chunk .= wp_kses_post($sec['body']);
    }
    $sections_html .= $inject_toc($chunk);
}
?>

<style>
.prose h2[id], .prose h3[id], .prose h4[id] { scroll-margin-top: 6rem; }
.prose h2, .prose h3, .prose h4 {
    font-weight: 700;
    margin-top: 2.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e2e8f0;
}
.toc-link { border-left: 2px solid transparent; margin-left: -2px; }
.toc-link.is-active { border-left-color: #00d084; color: #16a34a; font-weight: 600; }
</style>

<main class="bg-white text-slate-900 antialiased">

    <!-- Hero -->
    <section class="pt-32 md:pt-44 pb-16 md:pb-20 bg-white relative">

        <div class="absolute -right-32 top-0 w-[560px] h-[560px] rounded-full border-[48px] border-emerald-100/60 pointer-events-none" aria-hidden="true"></div>

        <div class="max-w-4xl mx-auto px-6 relative z-10">

            <nav class="flex items-center gap-2 text-sm text-slate-400 mb-10 flex-wrap">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-slate-600 transition-colors"><?php esc_html_e('Strona główna', 'meritoros'); ?></a>
                <span>/</span>
                <a href="<?php echo esc_url($media_url); ?>" class="hover:text-slate-600 transition-colors"><?php esc_html_e('Media i newsroom', 'meritoros'); ?></a>
                <span>/</span>
                <span class="text-slate-600"><?php the_title(); ?></span>
            </nav>

            <div class="flex items-center gap-3 mb-6">
                <?php if ($source) : ?>
                    <span class="mer-btn mer-btn--primary text-xs font-semibold text-white bg-[#00d084] px-3 py-1 rounded-full">
                        <?php echo mer_esc($source); ?>
                    </span>
                <?php endif; ?>
                <span class="text-sm text-slate-400">
                    <?php echo mer_esc($date_label); ?>
                </span>
            </div>

            <h1 class="text-pretty text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-slate-900 leading-[1.1] mb-10">
                <?php the_title(); ?>
            </h1>

            <?php if ($intro) : ?>
                <p class="text-xl text-slate-500 leading-relaxed border-l-4 border-emerald-400 pl-6 max-w-2xl">
                    <?php echo mer_esc($intro); ?>
                </p>
            <?php endif; ?>

        </div>
    </section>

    <!-- Treść + sidebar -->
    <section class="pb-16 md:pb-24">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-12 xl:gap-16">

                <!-- Treść -->
                <div class="flex-1 min-w-0">
                    <?php if ($sections_html) : ?>
                    <div class="prose prose-slate prose-lg max-w-none
                                prose-headings:tracking-tight
                                prose-a:text-[#00d084] prose-a:no-underline hover:prose-a:underline
                                prose-strong:text-slate-900">
                        <?php echo $sections_html; ?>
                    </div>
                    <?php endif; ?>

                    <!-- Powrót -->
                    <div class="border-t border-slate-100 mt-12 pt-10">
                        <a href="<?php echo esc_url($media_url); ?>"
                           class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-slate-900 transition-colors">
                            <i data-lucide="arrow-left" class="w-4 h-4 stroke-[1.5]"></i>
                            <?php esc_html_e('Powrót do Media i newsroom', 'meritoros'); ?>
                        </a>
                    </div>
                </div>

                <!-- Sidebar — zawsze widoczny -->
                <aside class="hidden lg:block w-52 xl:w-60 flex-shrink-0">
                    <div class="sticky top-24">

                        <!-- Meta artykułu -->
                        <div class="mb-8 pb-8 border-b border-slate-100">
                            <?php if ($source) : ?>
                                <span class="mer-btn mer-btn--primary inline-block text-xs font-semibold text-white bg-[#00d084] px-3 py-1 rounded-full mb-3">
                                    <?php echo mer_esc($source); ?>
                                </span>
                            <?php endif; ?>
                            <p class="text-xs text-slate-400"><?php echo mer_esc($date_label); ?></p>
                            <?php if ($author) : ?>
                                <p class="text-xs text-slate-500 mt-2 font-medium"><?php echo mer_esc($author); ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- TOC (jeśli są nagłówki) -->
                        <?php if (!empty($toc)) : ?>
                        <div>
                            <p class="text-xs uppercase tracking-widest font-bold text-slate-400 mb-4">
                                <?php esc_html_e('Spis treści', 'meritoros'); ?>
                            </p>
                            <nav class="border-l-2 border-slate-100 flex flex-col gap-0.5">
                                <?php foreach ($toc as $item) :
                                    $lvl = $item['level'];
                                    if ($lvl === 'h2')      $cls = 'pl-4 text-sm text-slate-500';
                                    elseif ($lvl === 'h3')  $cls = 'pl-8 text-xs text-slate-400';
                                    else                    $cls = 'pl-10 text-xs text-slate-400';
                                ?>
                                    <a href="#<?php echo esc_attr($item['id']); ?>"
                                       data-id="<?php echo esc_attr($item['id']); ?>"
                                       class="toc-link block py-1.5 hover:text-slate-800 transition-colors leading-snug <?php echo $cls; ?>">
                                        <?php echo mer_esc($item['text']); ?>
                                    </a>
                                <?php endforeach; ?>
                            </nav>
                        </div>
                        <?php endif; ?>

                    </div>
                </aside>

            </div>
        </div>
    </section>

</main>

<?php if (!empty($toc)) : ?>
<script>
(function () {
    var links = Array.from(document.querySelectorAll('.toc-link'));
    if (!links.length) return;

    var headings = links.map(function (l) {
        return document.getElementById(l.dataset.id);
    }).filter(Boolean);

    function activate(id) {
        links.forEach(function (l) {
            l.classList.toggle('is-active', l.dataset.id === id);
        });
    }

    if (headings[0]) activate(headings[0].id);

    if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) activate(e.target.id);
            });
        }, { rootMargin: '-80px 0px -55% 0px', threshold: 0 });

        headings.forEach(function (h) { observer.observe(h); });
    } else {
        window.addEventListener('scroll', function () {
            var active = headings[0] ? headings[0].id : '';
            headings.forEach(function (h) {
                if (h.getBoundingClientRect().top <= 100) active = h.id;
            });
            activate(active);
        }, { passive: true });
    }
})();
</script>
<?php endif; ?>

<?php get_footer(); ?>
