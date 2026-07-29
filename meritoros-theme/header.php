<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-slate-50 text-slate-900 antialiased overflow-x-hidden'); ?>>
<?php wp_body_open(); ?>

<?php
$_fp_id       = (int) get_option('page_on_front');
$nav_cta_text = (get_field('nav_cta_text', $_fp_id) ?: __('Skontaktuj się', 'meritoros'));
$nav_cta_url  = (get_field('nav_cta_url',  $_fp_id) ?: '#kontakt');

do_action('wpml_register_single_string', 'meritoros-nav', 'panel_klienta_label', 'Panel klienta', 'pl');
$_panel_label = function_exists('icl_t') ? icl_t('meritoros-nav', 'panel_klienta_label', 'Panel klienta') : 'Panel klienta';

// Buduj nav_items z WordPress Nav Menu (WPML obsługuje tłumaczenia automatycznie)
$nav_items = [];
$_locations = get_nav_menu_locations();
$_menu_obj  = !empty($_locations['primary']) ? wp_get_nav_menu_object($_locations['primary']) : null;

if ($_menu_obj) {
    $_all_items = wp_get_nav_menu_items($_menu_obj->term_id) ?: [];
    $_top       = [];
    $_children  = [];
    foreach ($_all_items as $_mi) {
        if (!$_mi->menu_item_parent) {
            $_top[$_mi->ID] = ['label' => $_mi->title, 'url' => $_mi->url, 'dropdown_links' => []];
        } else {
            $_children[(int) $_mi->menu_item_parent][] = ['label' => $_mi->title, 'url' => $_mi->url];
        }
    }
    foreach ($_top as $_id => &$_t) {
        if (!empty($_children[$_id])) $_t['dropdown_links'] = $_children[$_id];
    }
    unset($_t);
    $nav_items = array_values($_top);
}

// Fallback gdy menu nie istnieje
if (empty($nav_items)) {
    $nav_items = [
        ['label' => __('Biuro rachunkowe', 'meritoros'), 'url' => '#', 'dropdown_links' => [
            ['label' => __('Usługi księgowe', 'meritoros'),   'url' => home_url('/uslugi-ksiegowe/')],
            ['label' => __('Kadry i płace', 'meritoros'),     'url' => home_url('/kadry-i-place/')],
            ['label' => __('Fundacje rodzinne', 'meritoros'), 'url' => home_url('/fundacje-rodzinne/')],
        ]],
        ['label' => __('BPO', 'meritoros'),     'url' => home_url('/bpo/'),     'dropdown_links' => []],
        ['label' => __('O nas', 'meritoros'),   'url' => home_url('/o-nas/'),   'dropdown_links' => [
            ['label' => __('Kupimy biuro rachunkowe', 'meritoros'), 'url' => home_url('/kupimy-biuro-rachunkowe/')],
            ['label' => __('Relacje inwestorskie', 'meritoros'),    'url' => home_url('/relacje-inwestorskie/')],
        ]],
        ['label' => __('Odkryj', 'meritoros'),  'url' => '#', 'dropdown_links' => [
            ['label' => __('Wiedza i poradniki', 'meritoros'), 'url' => home_url('/blog/')],
            ['label' => __('Media i newsroom', 'meritoros'),   'url' => home_url('/media/')],
            ['label' => __('Historie klientów', 'meritoros'),  'url' => home_url('/historie-klientow/')],
        ]],
        ['label' => __('Kariera', 'meritoros'), 'url' => home_url('/kariera/'), 'dropdown_links' => []],
    ];
}
unset($__item);
?>

<header id="mer-header" class="fixed top-0 left-0 right-0 z-50 px-6 lg:px-12 w-full max-w-[1400px] mx-auto" style="top:16px;">

    <?php
    $mer_langs   = apply_filters('wpml_active_languages', [], ['skip_missing' => 0, 'orderby' => 'code', 'order' => 'asc']);
    $mer_current = apply_filters('wpml_current_language', null);
    ?>

    <div id="mer-nav-pill" class="bg-[#f2f4f6]/70 backdrop-blur-md rounded-full px-6 py-3.5 flex items-center shadow-lg shadow-black/5 transition-[background-color,box-shadow] duration-300">

        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center shrink-0">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo.svg'); ?>" alt="<?php bloginfo('name'); ?>" class="h-9 w-auto block" loading="eager" width="160" height="36">
        </a>

        <!-- Desktop Nav -->
        <nav class="hidden lg:flex flex-1 items-center justify-center <?php echo ($mer_current === 'ru') ? 'gap-1.5 xl:gap-3 text-[15px]' : 'gap-4 xl:gap-7 text-[15px] xl:text-[17px]'; ?> text-slate-900 font-medium" aria-label="<?php esc_attr_e('Menu główne', 'meritoros'); ?>">
            <?php foreach ($nav_items as $item) :
                $label       = esc_html($item['label'] ?? '');
                $url         = esc_url($item['url'] ?? '#');
                $dropdown    = $item['dropdown_links'] ?? [];
            ?>
                <?php if (!empty($dropdown)) : ?>
                    <div class="relative group shrink-0">
                        <a href="<?php echo $url; ?>"
                           class="flex items-center gap-1.5 hover:text-slate-600 transition-colors py-4 -my-4 cursor-pointer whitespace-nowrap">
                            <?php echo $label; ?>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-[#2d8650] stroke-[1.5]"></i>
                        </a>
                        <div class="absolute top-full left-1/2 -translate-x-1/2 pt-6 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50 w-[260px]">
                            <div class="bg-[#f2f4f6] rounded-[2rem] p-7 flex flex-col gap-5 shadow-xl shadow-black/5 border border-white/60">
                                <?php foreach ($dropdown as $dd) : ?>
                                    <a href="<?php echo esc_url($dd['url'] ?? '#'); ?>"
                                       class="flex items-center justify-between text-slate-900 hover:text-slate-600 group/item transition-colors">
                                        <span class="text-[17px]"><?php echo mer_esc($dd['label'] ?? ''); ?></span>
                                        <i data-lucide="arrow-up-right" class="w-5 h-5 text-[#2d8650] stroke-[1.5] group-hover/item:translate-x-0.5 group-hover/item:-translate-y-0.5 transition-transform"></i>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <a href="<?php echo $url; ?>" class="flex items-center gap-1.5 hover:text-slate-600 transition-colors py-4 -my-4 whitespace-nowrap shrink-0">
                        <?php echo $label; ?>
                        <span class="w-4 h-4 shrink-0" aria-hidden="true"></span>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </nav>

        <!-- CTA + Panel klienta + Język -->
        <div class="hidden lg:flex items-center gap-3 shrink-0">
            <?php if (!empty($mer_langs) && count($mer_langs) > 1) :
                $mer_current_lang = null;
                foreach ($mer_langs as $l) {
                    if ($l['language_code'] === $mer_current) { $mer_current_lang = $l; break; }
                }
            ?>
            <div class="relative group/lang shrink-0">
                <!-- Trigger: flaga aktywnego języka -->
                <button type="button" class="flex items-center gap-2 px-3 py-2 rounded-full border border-slate-200 hover:border-slate-300 hover:bg-white transition-colors" aria-haspopup="true">
                    <?php if ($mer_current_lang && !empty($mer_current_lang['country_flag_url'])) : ?>
                        <img src="<?php echo esc_url($mer_current_lang['country_flag_url']); ?>"
                             alt="<?php echo esc_attr($mer_current_lang['native_name'] ?? $mer_current); ?>"
                             class="w-5 h-4 object-cover rounded-sm flex-shrink-0"
                             loading="lazy" width="20" height="16">
                    <?php else : ?>
                        <i data-lucide="globe" class="w-4 h-4 text-slate-500 stroke-[1.5]"></i>
                    <?php endif; ?>
                    <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-400 stroke-[2] group-hover/lang:rotate-180 transition-transform duration-200"></i>
                </button>
                <!-- Dropdown -->
                <div class="absolute top-full right-0 pt-3 opacity-0 invisible group-hover/lang:opacity-100 group-hover/lang:visible transition-all duration-200 z-50">
                    <div class="bg-[#f2f4f6] rounded-2xl p-2 flex flex-col gap-0.5 shadow-xl shadow-black/5 border border-white/60 min-w-[140px]">
                        <?php foreach ($mer_langs as $lang) :
                            $is_active = $lang['language_code'] === $mer_current;
                        ?>
                        <a href="<?php echo esc_url($lang['url']); ?>"
                           class="flex items-center gap-2.5 px-3 py-2 rounded-xl transition-colors <?php echo $is_active ? 'bg-white shadow-sm' : 'hover:bg-white'; ?>">
                            <?php if (!empty($lang['country_flag_url'])) : ?>
                                <img src="<?php echo esc_url($lang['country_flag_url']); ?>"
                                     alt="<?php echo esc_attr($lang['native_name'] ?? $lang['language_code']); ?>"
                                     class="w-5 h-4 object-cover rounded-sm flex-shrink-0"
                                     loading="lazy" width="20" height="16">
                            <?php endif; ?>
                            <span class="text-sm font-medium <?php echo $is_active ? 'text-slate-900' : 'text-slate-600'; ?>">
                                <?php echo mer_esc($lang['native_name'] ?? strtoupper($lang['language_code'])); ?>
                            </span>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <a href="https://pulpit.meritoros.pl/login" target="_blank" rel="noopener"
               class="hidden xl:flex items-center gap-2 px-5 py-3 rounded-full border border-slate-200 text-slate-700 text-base font-medium hover:border-slate-300 hover:bg-white transition-colors whitespace-nowrap">
                <i data-lucide="user" class="w-4 h-4 stroke-[1.5]"></i>
                <?php echo mer_esc($_panel_label); ?>
            </a>
            <a href="<?php echo esc_url($nav_cta_url); ?>"
               class="bg-[#2d8650] text-white <?php echo ($mer_current === 'ru') ? 'px-5' : 'px-7'; ?> py-3 rounded-full text-base font-medium hover:bg-[#246e41] transition-colors">
                <?php echo mer_esc($nav_cta_text); ?>
            </a>
        </div>

        <!-- Mobile menu button -->
        <button id="mobile-menu-btn" class="lg:hidden ml-auto text-slate-900" aria-expanded="false" aria-label="<?php esc_attr_e('Otwórz menu', 'meritoros'); ?>">
            <i data-lucide="menu" class="w-7 h-7 stroke-[1.5]"></i>
        </button>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden lg:hidden mt-3 bg-[#f2f4f6]/95 backdrop-blur-md rounded-3xl px-6 py-6 shadow-xl max-h-[80svh] overflow-y-auto">
        <!-- Close button -->
        <div class="flex items-center justify-between mb-4">
            <span class="text-xs uppercase tracking-widest font-bold text-slate-400"><?php esc_html_e('Menu', 'meritoros'); ?></span>
            <button id="mobile-close" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-200/70 hover:bg-slate-300 transition-colors" aria-label="<?php esc_attr_e('Zamknij menu', 'meritoros'); ?>">
                <i data-lucide="x" class="w-4 h-4 stroke-[2] text-slate-700"></i>
            </button>
        </div>
        <nav class="flex flex-col gap-1 text-slate-900 text-base font-medium">
            <?php foreach ($nav_items as $item) :
                $has_dropdown = !empty($item['dropdown_links']);
            ?>
                <?php if ($has_dropdown) : ?>
                    <!-- Accordion item -->
                    <div>
                        <button type="button" class="mobile-acc-btn w-full flex items-center justify-between py-2.5 px-2 rounded-xl hover:bg-white/60 transition-colors" aria-expanded="false">
                            <span><?php echo mer_esc($item['label'] ?? ''); ?></span>
                            <i data-lucide="chevron-down" class="mobile-acc-icon w-4 h-4 text-[#2d8650] stroke-[1.5] transition-transform duration-200"></i>
                        </button>
                        <div class="hidden pl-4 flex flex-col gap-1 mt-1 mb-2">
                            <?php foreach ($item['dropdown_links'] as $dd) : ?>
                                <a href="<?php echo esc_url($dd['url'] ?? '#'); ?>"
                                   class="py-2 px-2 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-white/60 transition-colors text-sm font-normal">
                                    <?php echo mer_esc($dd['label'] ?? ''); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else : ?>
                    <a href="<?php echo esc_url($item['url'] ?? '#'); ?>"
                       class="py-2.5 px-2 rounded-xl hover:bg-white/60 hover:text-slate-600 transition-colors">
                        <?php echo mer_esc($item['label'] ?? ''); ?>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>

            <div class="mt-3 pt-3 border-t border-slate-200 flex flex-col gap-3">
                <a href="https://pulpit.meritoros.pl/login" target="_blank" rel="noopener"
                   class="flex items-center justify-center gap-2 border border-slate-200 text-slate-700 px-6 py-3 rounded-full text-center font-medium hover:border-slate-300 transition-colors">
                    <i data-lucide="user" class="w-4 h-4 stroke-[1.5]"></i>
                    <?php echo mer_esc($_panel_label); ?>
                </a>
                <a href="<?php echo esc_url($nav_cta_url); ?>"
                   class="bg-[#2d8650] text-white px-6 py-3 rounded-full text-center font-medium hover:bg-[#246e41] transition-colors">
                    <?php echo mer_esc($nav_cta_text); ?>
                </a>
            </div>

            <?php if (!empty($mer_langs) && count($mer_langs) > 1) : ?>
            <?php
                $mer_current_lang_mob = null;
                foreach ($mer_langs as $_l) {
                    if ($_l['language_code'] === $mer_current) { $mer_current_lang_mob = $_l; break; }
                }
            ?>
            <div class="mt-3 pt-3 border-t border-slate-200">
                <button type="button" id="mobile-lang-btn"
                        class="w-full flex items-center justify-between py-2.5 px-2 rounded-xl hover:bg-white/60 transition-colors"
                        aria-expanded="false">
                    <span class="flex items-center gap-2 text-sm font-medium text-slate-700">
                        <?php if ($mer_current_lang_mob && !empty($mer_current_lang_mob['country_flag_url'])) : ?>
                            <img src="<?php echo esc_url($mer_current_lang_mob['country_flag_url']); ?>"
                                 alt="<?php echo esc_attr($mer_current_lang_mob['native_name'] ?? $mer_current); ?>"
                                 class="w-5 h-4 object-cover rounded-sm flex-shrink-0"
                                 loading="lazy" width="20" height="16">
                        <?php else : ?>
                            <i data-lucide="globe" class="w-4 h-4 text-slate-500 stroke-[1.5]"></i>
                        <?php endif; ?>
                        <?php echo mer_esc($mer_current_lang_mob['native_name'] ?? strtoupper($mer_current)); ?>
                    </span>
                    <i data-lucide="chevron-down" id="mobile-lang-icon" class="w-4 h-4 text-[#2d8650] stroke-[1.5] transition-transform duration-200"></i>
                </button>
                <div id="mobile-lang-dd" class="hidden pl-4 flex flex-col gap-1 mt-1 mb-2">
                    <?php foreach ($mer_langs as $lang) :
                        $is_active = $lang['language_code'] === $mer_current;
                        if ($is_active) continue;
                    ?>
                        <a href="<?php echo esc_url($lang['url']); ?>"
                           class="flex items-center gap-2.5 py-2 px-2 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-white/60 transition-colors text-sm font-normal">
                            <?php if (!empty($lang['country_flag_url'])) : ?>
                                <img src="<?php echo esc_url($lang['country_flag_url']); ?>"
                                     alt="<?php echo esc_attr($lang['native_name'] ?? $lang['language_code']); ?>"
                                     class="w-5 h-4 object-cover rounded-sm flex-shrink-0"
                                     loading="lazy" width="20" height="16">
                            <?php endif; ?>
                            <?php echo mer_esc($lang['native_name'] ?? strtoupper($lang['language_code'])); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </nav>
    </div>
    <!-- Mobile backdrop -->
    <div id="mobile-backdrop" class="hidden lg:hidden fixed inset-0 bg-black/20 backdrop-blur-[2px] z-[-1]"></div>
</header>

<script>
(function () {
    var pill      = document.getElementById('mer-nav-pill');
    var threshold = 60;
    var scrolled  = false;

    function onScroll() {
        var shouldScroll = window.scrollY > threshold;
        if (shouldScroll === scrolled) return;
        scrolled = shouldScroll;

        if (shouldScroll) {
            pill.style.backgroundColor = 'rgba(242,244,246,0.95)';
            pill.style.boxShadow       = '0 4px 24px 0 rgba(0,0,0,0.10)';
        } else {
            pill.style.backgroundColor = '';
            pill.style.boxShadow       = '';
        }
    }

    window.addEventListener('scroll', onScroll, { passive: true });
})();
</script>
