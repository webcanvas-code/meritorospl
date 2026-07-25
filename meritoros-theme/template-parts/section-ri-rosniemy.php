<?php
$title = mer_field('ri_rosniemy_title', 'Rośniemy');
$text  = mer_field('ri_rosniemy_text',  'Rozwój Meritoros SA znajduje odzwierciedlenie w systematycznym wzroście skali działalności i przychodów na przestrzeni ostatnich lat.');
$photo = get_field('ri_rosniemy_photo');
$photo_url = is_array($photo) ? esc_url($photo['url']) : esc_url(get_template_directory_uri() . '/images/przychody.png');
$photo_alt = is_array($photo) ? esc_attr($photo['alt'] ?: 'Wzrost przychodów Meritoros SA') : 'Wzrost przychodów Meritoros SA';
?>

<style>
.ri-rosniemy-col { width: 100%; }
@media (min-width: 1024px) {
    .ri-rosniemy-col { width: 660px; }
}
</style>

<section id="ri-rosniemy" class="py-10 md:py-14 bg-slate-50 border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-12 lg:gap-0">

            <!-- Lewa kolumna: nagłówek + tekst -->
            <div class="w-full lg:w-[380px] shrink-0">
                <h2 class="text-4xl md:text-5xl font-bold tracking-tight text-slate-900 mb-6 leading-tight">
                    <?php echo mer_esc($title); ?>
                </h2>
                <p class="text-base text-slate-500 leading-relaxed">
                    <?php echo mer_esc($text); ?>
                </p>
            </div>

            <!-- Prawa kolumna: zdjęcie -->
            <div class="ri-rosniemy-col shrink-0">
                <div class="rounded-[2rem] overflow-hidden shadow-sm bg-white">
                    <img src="<?php echo $photo_url; ?>" alt="<?php echo $photo_alt; ?>"
                         class="w-full h-auto object-contain" loading="lazy">
                </div>
            </div>

        </div>
    </div>
</section>
