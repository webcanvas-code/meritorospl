<?php
/**
 * Sekcja: Ebook  (page-blog.php)
 * Pola ACF z group_mer_blog_page (functions.php), zakładka "Sekcja Ebook":
 * ebook_label, ebook_title, ebook_subtitle, ebook_desc, ebook_btn_text,
 * ebook_mockup (image, return_format:array), ebook_pdf (file, return_format:array)
 */
$pid = $args['pid'] ?? get_the_ID();

$label    = __( get_field('ebook_label',    $pid) ?: 'Darmowy materiał', 'meritoros' );
$title    = __( get_field('ebook_title',    $pid) ?: 'Pobierz nasz darmowy Ebook', 'meritoros' );
$subtitle_raw = get_field('ebook_subtitle', $pid) ?: '';
$subtitle = $subtitle_raw ? __($subtitle_raw, 'meritoros') : '';
$desc_raw = get_field('ebook_desc', $pid) ?: '';
$_desc_norm = $desc_raw ? preg_replace('/[ \t]+/', ' ', preg_replace('/\r?\n/', ' ', $desc_raw)) : '';
$desc     = $_desc_norm ? __($_desc_norm, 'meritoros') : '';
$btn      = __( get_field('ebook_btn_text', $pid) ?: 'Pobierz materiał', 'meritoros' );

$mockup     = get_field('ebook_mockup', $pid);
$mockup_url = is_array($mockup) ? ($mockup['url'] ?? '') : '';
$mockup_alt = is_array($mockup) ? ($mockup['alt'] ?? 'Ebook') : 'Ebook';

$pdf     = get_field('ebook_pdf', $pid);
$has_pdf = is_array($pdf) && !empty($pdf['url']);
?>

<section id="ebook" class="py-16 md:py-24 bg-[#f0faf4]">
    <div class="max-w-[1400px] mx-auto px-6 lg:px-12">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16">

            <!-- Lewa: treść + formularz -->
            <div class="flex-1 max-w-xl">
                <span class="text-[#00d084] uppercase tracking-widest text-base font-bold mb-4 block">
                    <?php echo mer_esc($label); ?>
                </span>
                <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 leading-tight mb-5">
                    <?php echo mer_esc($title); ?>
                </h2>
                <?php if ($subtitle) : ?>
                    <p class="text-lg font-semibold text-slate-800 leading-snug mb-3">
                        <?php echo mer_esc($subtitle); ?>
                    </p>
                <?php endif; ?>
                <?php if ($desc) : ?>
                    <p class="text-base sm:text-lg text-slate-500 leading-relaxed mb-8">
                        <?php echo mer_esc($desc); ?>
                    </p>
                <?php endif; ?>

                <?php if ($has_pdf) : ?>
                    <a href="<?php echo esc_url($pdf['url']); ?>" target="_blank" rel="noopener"
                       class="mer-btn mer-btn--dark inline-flex items-center justify-center bg-slate-900 text-white px-8 py-4 rounded-full text-base font-bold hover:bg-slate-700 transition-colors duration-200 w-fit">
                        <?php echo mer_esc($btn); ?>
                    </a>
                <?php else : ?>
                    <p class="text-slate-400 text-sm italic">Brak przypisanego pliku PDF. Wgraj plik w zakładce "Sekcja Ebook" w ustawieniach strony.</p>
                <?php endif; ?>
            </div>

            <!-- Prawa: mockup -->
            <?php if ($mockup_url) : ?>
            <div class="flex-1 hidden lg:flex items-center justify-center">
                <img src="<?php echo esc_url($mockup_url); ?>"
                     alt="<?php echo esc_attr($mockup_alt); ?>"
                     class="max-h-[480px] w-auto object-contain drop-shadow-2xl" loading="lazy">
            </div>
            <?php endif; ?>

        </div>
    </div>
</section>

