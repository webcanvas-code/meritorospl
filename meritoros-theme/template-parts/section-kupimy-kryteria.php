<?php
defined('ABSPATH') || exit;

$banner_title   = mer_field('kupimy_part_banner_title',   'Spełniasz wszystkie kryteria?');
$banner_desc    = mer_field('kupimy_part_banner_desc',    'Warto się odezwać — chętnie sprawdzimy, czy widzimy przestrzeń do współpracy.');
$banner_btn     = mer_field('kupimy_part_banner_btn',     'Umów się na rozmowę');
$banner_btn_url = mer_field('kupimy_part_banner_btn_url', get_permalink(get_page_by_path('kontakt')));

$label    = mer_field('kupimy_kryt_label',    'Całkowita sprzedaż biura');
$heading  = mer_field('kupimy_kryt_heading',  'Obecnie najczęściej rozmawiamy z biurami, które spełniają poniższe kryteria:');
$subtitle = mer_field('kupimy_kryt_subtitle', 'Przejmujemy całość lub wybrane obszary, które wymagają uporządkowania i stałego nadzoru.');
$items    = array_values(array_filter(array_map('trim', preg_split('/(\r?\n){2,}/', mer_field('kupimy_kryt_items', "obrót roczny: od ok. 1,2 mln zł\n\noprogramowanie: Comarch Optima,\n\npreferowane lokalizacje: Warszawa, Kraków, Wrocław, Łódź, Górny Śląsk, Rzeszów,\n\nw przypadku większych podmiotów analizujemy także inne lokalizacje.")))));
$cta_pre  = mer_field('kupimy_kryt_cta_pre',  'Spełniasz powyższe kryteria?');
$btn_text = mer_field('kupimy_kryt_btn_text', 'Umów się na rozmowę');
$btn_url  = mer_field('kupimy_kryt_btn_url',  get_permalink(get_page_by_path('kontakt')));
$photo    = mer_field('kupimy_kryt_photo');
$photo_url = is_array($photo) ? $photo['url'] : 'https://images.unsplash.com/photo-1515187029135-18ee286d815b?w=900&q=80';
$photo_alt = is_array($photo) ? ($photo['alt'] ?: $heading) : 'Spotkanie';
?>

<section class="py-14 md:py-20 bg-white relative">

    <!-- Dekoracyjny okrąg po lewej -->
    <div class="absolute -left-48 top-1/2 -translate-y-1/2 w-[500px] h-[500px] rounded-full border-[48px] border-emerald-100 pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

            <!-- Lewa kolumna: treść -->
            <div>
                <?php if ( $label ) : ?>
                <p class="text-[#2d8650] uppercase tracking-widest text-base font-bold mb-4 block">
                    <?php echo mer_esc($label); ?>
                </p>
                <?php endif; ?>

                <h2 class="text-pretty text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 leading-snug mb-5">
                    <?php echo mer_esc($heading); ?>
                </h2>

                <?php if ( $subtitle ) : ?>
                <p class="text-base sm:text-lg text-slate-500 leading-relaxed mb-7">
                    <?php echo mer_esc($subtitle); ?>
                </p>
                <?php endif; ?>

                <?php if ( $items ) : ?>
                <ul class="space-y-4">
                    <?php foreach ( $items as $item ) : ?>
                    <li class="flex items-start gap-3">
                        <span class="flex-shrink-0 mt-0.5 w-5 h-5 rounded-full bg-[#2d8650] flex items-center justify-center">
                            <i data-lucide="check" class="w-3 h-3 text-white" stroke-width="3"></i>
                        </span>
                        <span class="text-base text-slate-700 leading-relaxed"><?php echo mer_esc($item); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>

            <!-- Prawa kolumna: zdjęcie -->
            <div class="rounded-3xl overflow-hidden shadow-sm">
                <img src="<?php echo esc_url($photo_url); ?>"
                     alt="<?php echo esc_attr($photo_alt); ?>"
                     class="w-full object-cover aspect-[4/5]" loading="lazy">
            </div>

        </div>

        <!-- Banner CTA -->
        <div class="mt-10 rounded-3xl bg-[#2d8650] px-8 py-8 flex flex-col sm:flex-row items-center gap-6">
            <div class="flex-shrink-0 w-16 h-16 flex items-center justify-center">
                <i data-lucide="users" class="w-12 h-12 text-white" stroke-width="1"></i>
            </div>
            <div class="flex-1 text-center sm:text-left">
                <p class="text-2xl sm:text-3xl font-bold text-white leading-snug mb-1">
                    <?php echo mer_esc($banner_title); ?>
                </p>
                <p class="text-lg text-white/80 leading-relaxed">
                    <?php echo mer_esc($banner_desc); ?>
                </p>
            </div>
            <a href="<?php echo esc_url($banner_btn_url ?: '#'); ?>"
               class="flex-shrink-0 inline-flex items-center justify-center px-6 py-3 rounded-full bg-white text-emerald-700 text-base font-semibold hover:bg-emerald-50 transition-colors duration-200 whitespace-nowrap">
                <?php echo mer_esc($banner_btn); ?>
            </a>
        </div>

        <!-- Tekst pod bannerem -->
        <div class="mt-6">
            <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 leading-snug mb-3">Nie spełniasz wszystkich kryteriów?</h2>
            <p class="text-base sm:text-lg text-slate-600 leading-relaxed">Warto się odezwać — chętnie sprawdzimy, czy widzimy przestrzeń do współpracy.</p>
        </div>

    </div>
</section>
