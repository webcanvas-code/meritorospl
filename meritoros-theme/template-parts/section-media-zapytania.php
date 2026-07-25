<?php
$title    = mer_field('media_zap_title', 'Zapytania medialne');
$text     = mer_field('media_zap_text',  'W sprawach publikacji, komentarzy eksperckich i współpracy medialnej prosimy o kontakt. Odpowiemy możliwie szybko i wrócimy z informacją, w jakiej formie możemy pomóc.');
$email    = mer_field('media_zap_email', 'aleksandra.pawelec@meritoros.pl');
$photo     = get_field('media_zap_photo');
$photo_url = is_array($photo) ? ($photo['url'] ?? '') : '';
$photo_alt = is_array($photo) ? ($photo['alt'] ?? $title) : $title;
?>

<section class="py-16 md:py-24 bg-white relative" id="zapytania-medialne">

    <!-- Dekoracyjne okręgi -->
    <div class="absolute -right-24 top-1/2 -translate-y-1/2 w-72 h-72 rounded-full border-[48px] border-emerald-100/60 pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16">

            <!-- Formularz -->
            <div class="flex-1 max-w-lg w-full">
                <h2 class="text-pretty text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-slate-900 mb-4">
                    <?php echo mer_esc($title); ?>
                </h2>
                <p class="text-base sm:text-lg text-slate-500 leading-relaxed mb-8">
                    <?php echo mer_esc($text); ?>
                </p>

                <?php if ($email) : ?>
                <a href="mailto:<?php echo esc_attr($email); ?>"
                   class="inline-flex items-center gap-3 px-7 py-4 rounded-full bg-[#48c279] text-white text-base font-semibold hover:bg-[#3ea868] transition-colors">
                    <i data-lucide="mail" class="w-5 h-5 flex-shrink-0"></i>
                    <?php echo mer_esc($email); ?>
                </a>
                <?php endif; ?>
            </div>

            <!-- Zdjęcie -->
            <div class="relative z-10 w-full lg:w-[480px] xl:w-[520px] flex-shrink-0">
                <?php if ($photo_url) : ?>
                    <img src="<?php echo esc_url($photo_url); ?>"
                         alt="<?php echo esc_attr($photo_alt); ?>"
                         class="w-full aspect-[4/3] object-cover rounded-3xl" loading="lazy">
                <?php else : ?>
                    <div class="w-full aspect-[4/3] rounded-3xl bg-emerald-50 border-2 border-emerald-100"></div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
