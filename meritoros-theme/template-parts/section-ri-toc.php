<?php
$links = [
    ['href' => '#ri-info',                 'label' => __('O nas',                 'meritoros')],
    ['href' => '#ri-rosniemy',             'label' => __('Rośniemy',              'meritoros')],
    ['href' => '#ri-zarzad',               'label' => __('Zarząd',                'meritoros')],
    ['href' => '#ri-dane',                 'label' => __('Dane finansowe',        'meritoros')],
    ['href' => '#ri-lista',                'label' => __('Lista nadzorcza',       'meritoros')],
    ['href' => '#ri-akcjonariat',          'label' => __('Akcjonariat',           'meritoros')],
    ['href' => '#ri-sprawozdania',         'label' => __('Sprawozdania',          'meritoros')],
    ['href' => '#ri-sprawozdania-zarzadu', 'label' => __('Sprawozdania zarządu', 'meritoros')],
    ['href' => '#ri-rewident',             'label' => __('Rewident',              'meritoros')],
    ['href' => '#ri-uchwaly',              'label' => __('Uchwały',               'meritoros')],
];
?>

<style>
#ri-toc-bar .overflow-x-auto::-webkit-scrollbar { display: none; }
</style>

<nav id="ri-toc-bar"
     class="sticky z-40 bg-white border-b border-slate-200 shadow-sm"
     style="top:96px;"
     aria-label="<?php esc_attr_e('Spis treści', 'meritoros'); ?>">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center gap-1 overflow-x-auto py-4"
             style="-ms-overflow-style:none; scrollbar-width:none;">

            <span class="shrink-0 text-xs font-bold text-slate-400 uppercase tracking-widest pr-5 border-r border-slate-200 mr-2 whitespace-nowrap hidden sm:inline-block">
                <?php esc_html_e('Spis treści', 'meritoros'); ?>
            </span>

            <?php foreach ($links as $link) : ?>
            <a href="<?php echo esc_attr($link['href']); ?>"
               data-ri-toc
               style="display:inline-block; padding:8px 20px; font-size:15px; font-weight:500; color:#64748b; white-space:nowrap; border-bottom:3px solid transparent; text-decoration:none; transition:color .15s,border-color .15s; border-radius:4px; cursor:pointer;">
                <?php echo esc_html($link['label']); ?>
            </a>
            <?php endforeach; ?>

        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function () {
(function () {
    var bar   = document.getElementById('ri-toc-bar');
    var links = Array.from(document.querySelectorAll('#ri-toc-bar [data-ri-toc]'));

    var sectionIds = [<?php foreach ($links as $link) { echo '"' . esc_js(ltrim($link['href'], '#')) . '",'; } ?>];
    var sections   = sectionIds.map(function (id) { return document.getElementById(id); }).filter(Boolean);

    if (!links.length || !sections.length) return;

    function setActive(el, active) {
        if (active) {
            el.style.color        = '#48c279';
            el.style.fontWeight   = '700';
            el.style.borderBottomColor = '#48c279';
            el.style.borderRadius = '4px 4px 0 0';
        } else {
            el.style.color        = '#64748b';
            el.style.fontWeight   = '500';
            el.style.borderBottomColor = 'transparent';
            el.style.borderRadius = '4px';
        }
    }

    function activate(id) {
        links.forEach(function (a) {
            setActive(a, a.getAttribute('href') === '#' + id);
        });
        /* Auto-scroll aktywnego linku do widoku */
        var activeLink = links.find(function (a) { return a.getAttribute('href') === '#' + id; });
        if (activeLink) {
            var inner = bar.querySelector('.overflow-x-auto');
            if (inner) {
                inner.scrollTo({ left: activeLink.offsetLeft - inner.offsetWidth / 2 + activeLink.offsetWidth / 2, behavior: 'smooth' });
            }
        }
    }

    function getActive() {
        var offset = bar.offsetHeight + 96 + 8;
        var active = sections[0].id;
        sections.forEach(function (s) {
            if (s.getBoundingClientRect().top <= offset) active = s.id;
        });
        return active;
    }

    window.addEventListener('scroll', function () { activate(getActive()); }, { passive: true });

    /* Kliknięcie: aktywuj natychmiast, potem scrolluj */
    links.forEach(function (a) {
        a.addEventListener('mouseenter', function () {
            if (!a.style.borderBottomColor || a.style.borderBottomColor === 'transparent') {
                a.style.backgroundColor = '#f1f5f9';
            }
        });
        a.addEventListener('mouseleave', function () {
            a.style.backgroundColor = '';
        });
        a.addEventListener('click', function (e) {
            e.preventDefault();
            var id = this.getAttribute('href').slice(1);
            activate(id);
            var target = document.getElementById(id);
            if (!target) return;
            var offset = bar.offsetHeight + 96 + 8;
            window.scrollTo({ top: target.getBoundingClientRect().top + window.scrollY - offset, behavior: 'smooth' });
        });
    });

    /* Inicjalizacja */
    activate(getActive());
})();
});
</script>
