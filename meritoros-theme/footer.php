<?php
// Czytaj pola zawsze ze strony głównej — ACFML zwróci wersję w aktualnym języku
$_ft_id = (int) get_option('page_on_front');

// Pola tłumaczalne — czytaj ze strony głównej
$cta_label   = (get_field('footer_cta_label',  $_ft_id) ?: __('Zacznij teraz', 'meritoros'));
$cta_title   = (get_field('footer_cta_title',  $_ft_id) ?: __("Dołącz do grona naszych\nklientów i rozwijaj biznes", 'meritoros'));
$cta_accent  = (get_field('footer_cta_accent', $_ft_id) ?: __('bez stresu', 'meritoros'));
$btn1_text   = (get_field('footer_btn1_text',  $_ft_id) ?: __('Umów rozmowę', 'meritoros'));
$btn1_url    = (get_field('footer_btn1_url',   $_ft_id) ?: '#kontakt');
$btn2_text   = (get_field('footer_btn2_text',  $_ft_id) ?: __('Poznaj ofertę', 'meritoros'));
$btn2_url    = (get_field('footer_btn2_url',   $_ft_id) ?: '#uslugi');
$tagline     = (get_field('footer_tagline',    $_ft_id) ?: __('Profesjonalne biuro rachunkowe i BPO dla firm z ambicjami.', 'meritoros'));

// Pola wspólne dla wszystkich języków — dane kontaktowe i meta
$address     = mer_field('footer_address',   'Aleja Pokoju 62/8, Kraków');
$phone       = mer_field('footer_phone',     '+48 000 000 000');
$email       = mer_field('footer_email',     'biuro@meritoros.pl');
$copyright   = mer_field('footer_copyright', '© ' . date('Y') . ' Meritoros SA. Wszelkie prawa zastrzeżone.');
$credit_text = mer_field('footer_credit_text', 'Web-Canvas');
$credit_url  = mer_field('footer_credit_url',  '#');

$social_defaults = [
    1 => ['icon' => 'facebook',  'url' => 'https://www.facebook.com/Meritoros'],
    2 => ['icon' => 'instagram', 'url' => 'https://www.instagram.com/meritoros/'],
    3 => ['icon' => 'linkedin',  'url' => 'https://www.linkedin.com/company/meritoros/'],
    4 => ['icon' => 'youtube',   'url' => 'https://www.youtube.com/@Meritoros_outsourcing'],
];
$socials = [];
for ($i = 1; $i <= 4; $i++) {
    $def  = $social_defaults[$i];
    $icon = mer_field("footer_social_{$i}_icon", $def['icon']);
    $url  = mer_field("footer_social_{$i}_url",  $def['url']);
    // Jeśli ACF ma '#' lub pusty string — użyj prawdziwego domyślnego URL
    if (empty($url) || $url === '#') {
        $url = $def['url'];
    }
    if (!empty($icon)) {
        $socials[] = ['icon' => $icon, 'url' => $url];
    }
}
?>

<footer class="bg-slate-900 text-white px-6 lg:px-12 pt-0 pb-0">
    <div class="max-w-[1400px] mx-auto">

        <!-- Footer CTA Banner -->
        <div class="border-b border-white/10 py-12 sm:py-16 lg:py-20 flex flex-col lg:flex-row lg:items-center justify-between gap-8 sm:gap-10">
            <div class="max-w-2xl">
                <span class="text-[#00d084] uppercase tracking-widest text-base font-bold mb-4 block">
                    <?php echo mer_esc($cta_label); ?>
                </span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight leading-tight">
                    <?php echo nl2br(esc_html($cta_title)); ?><br>
                    <span class="text-[#00d084]"><?php echo mer_esc($cta_accent); ?></span>
                </h2>
            </div>
            <div class="flex flex-col sm:flex-row gap-5 shrink-0">
                <a href="<?php echo esc_url($btn1_url); ?>"
                   class="inline-flex items-center gap-3 bg-[#00d084] text-white px-9 py-4 rounded-full text-lg font-bold hover:bg-[#00b872] hover:shadow-lg hover:shadow-[#00d084]/30 transition-all duration-300 group">
                    <?php echo mer_esc($btn1_text); ?>
                    <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="<?php echo esc_url($btn2_url); ?>"
                   class="inline-flex items-center gap-3 border border-white/20 text-white px-9 py-4 rounded-full text-lg font-semibold hover:bg-white/10 transition-all duration-300">
                    <?php echo mer_esc($btn2_text); ?>
                </a>
            </div>
        </div>

        <!-- Footer Links Grid -->
        <div class="py-10 sm:py-12 lg:py-14 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 sm:gap-8 lg:gap-10">

            <!-- Brand column -->
            <div class="col-span-2 md:col-span-3 lg:col-span-1 flex flex-col gap-6">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/images/logo.svg'); ?>" alt="<?php bloginfo('name'); ?>" class="h-8 w-auto brightness-0 invert" loading="lazy" width="160" height="32">
                </a>
                <p class="text-slate-400 text-base font-light leading-relaxed max-w-[250px]">
                    <?php echo mer_esc($tagline); ?>
                </p>
                <!-- Social icons -->
                <?php
                $social_svgs = [
                    'facebook'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>',
                    'instagram' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>',
                    'linkedin'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>',
                    'youtube'   => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"><path fill="#FF0000" d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="white"/></svg>',
                ];
                $social_labels = [
                    'facebook'  => 'Facebook',
                    'instagram' => 'Instagram',
                    'linkedin'  => 'LinkedIn',
                    'youtube'   => 'YouTube',
                ];
                ?>
                <div class="flex items-center gap-2">
                    <?php foreach ($socials as $social) :
                        $icon  = $social['icon'] ?? '';
                        $url   = esc_url($social['url'] ?? '#');
                        $svg   = $social_svgs[$icon]   ?? '';
                        $label = $social_labels[$icon] ?? esc_attr($icon);
                        if (!$svg || !$url || $url === '#') continue;
                    ?>
                        <a href="<?php echo $url; ?>" rel="noopener noreferrer" target="_blank"
                           class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-[#00d084] transition-colors duration-300 text-white"
                           aria-label="<?php echo esc_attr($label); ?>">
                            <?php echo $svg; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Services column -->
            <div>
                <h4 class="text-xs uppercase tracking-widest font-bold text-slate-400 mb-5">
                    <?php esc_html_e('Usługi', 'meritoros'); ?>
                </h4>
                <ul class="space-y-3 text-sm text-slate-300">
                    <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('uslugi-ksiegowe'))); ?>" class="hover:text-white hover:translate-x-0.5 transition-all inline-block"><?php esc_html_e('Usługi księgowe', 'meritoros'); ?></a></li>
                    <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('kadry-i-place'))); ?>" class="hover:text-white hover:translate-x-0.5 transition-all inline-block"><?php esc_html_e('Kadry i płace', 'meritoros'); ?></a></li>
                    <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('fundacje-rodzinne'))); ?>" class="hover:text-white hover:translate-x-0.5 transition-all inline-block"><?php esc_html_e('Fundacje rodzinne', 'meritoros'); ?></a></li>
                    <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('kupimy-biuro-rachunkowe'))); ?>" class="hover:text-white hover:translate-x-0.5 transition-all inline-block"><?php esc_html_e('Skup biur rachunkowych', 'meritoros'); ?></a></li>
                </ul>
            </div>

            <!-- Info column -->
            <div>
                <h4 class="text-xs uppercase tracking-widest font-bold text-slate-400 mb-5">
                    <?php esc_html_e('Informacje', 'meritoros'); ?>
                </h4>
                <ul class="space-y-3 text-sm text-slate-300">
                    <li><a href="<?php echo esc_url(MER_PRIVACY_PDF); ?>" target="_blank" rel="noopener" class="hover:text-white hover:translate-x-0.5 transition-all inline-block"><?php esc_html_e('Polityka prywatności', 'meritoros'); ?></a></li>
                    <li><a href="<?php echo esc_url(MER_TERMS_PDF); ?>" target="_blank" rel="noopener" class="hover:text-white hover:translate-x-0.5 transition-all inline-block"><?php esc_html_e('Regulamin newslettera', 'meritoros'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/blog/')); ?>" class="hover:text-white hover:translate-x-0.5 transition-all inline-block"><?php esc_html_e('Wiedza i poradniki', 'meritoros'); ?></a></li>
                </ul>
            </div>

            <!-- Contact column -->
            <div>
                <h4 class="text-xs uppercase tracking-widest font-bold text-slate-400 mb-5">
                    <?php esc_html_e('Kontakt', 'meritoros'); ?>
                </h4>
                <ul class="space-y-3 text-sm text-slate-300">
                    <?php if ($address) : ?>
                        <li class="flex items-start gap-2">
                            <i data-lucide="map-pin" class="w-4 h-4 text-[#00d084] mt-0.5 shrink-0 stroke-[1.5]"></i>
                            <span><?php echo nl2br(esc_html($address)); ?></span>
                        </li>
                    <?php endif; ?>
                    <?php if ($phone) : ?>
                        <li class="flex items-center gap-2">
                            <i data-lucide="phone" class="w-4 h-4 text-[#00d084] shrink-0 stroke-[1.5]"></i>
                            <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone)); ?>" class="hover:text-white transition-colors">
                                <?php echo mer_esc($phone); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if ($email) : ?>
                        <li class="flex items-center gap-2">
                            <i data-lucide="mail" class="w-4 h-4 text-[#00d084] shrink-0 stroke-[1.5]"></i>
                            <a href="mailto:<?php echo esc_attr($email); ?>" class="hover:text-white transition-colors">
                                <?php echo mer_esc($email); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <!-- Bottom bar -->
        <div class="flex flex-col md:flex-row items-center justify-between text-sm text-slate-500 py-8 border-t border-white/10 gap-4">
            <p><?php echo mer_esc($copyright); ?></p>
            <p><?php esc_html_e('Projekt i realizacja:', 'meritoros'); ?>
                <a href="<?php echo esc_url($credit_url); ?>" class="text-slate-400 hover:text-white transition-colors ml-1">
                    <?php echo mer_esc($credit_text); ?>
                </a>
            </p>
        </div>
    </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('a[href^="#"]').forEach(function (a) {
        a.addEventListener('click', function (e) {
            var id = a.getAttribute('href').slice(1);
            if (!id) return;
            var target = document.getElementById(id);
            if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); }
        });
    });
});
</script>

<?php wp_footer(); ?>
</body>
</html>
