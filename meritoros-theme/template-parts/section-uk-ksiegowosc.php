<?php
$title1       = mer_field('uk_ks_title1',       'Twoja księgowość');
$title2       = mer_field('uk_ks_title2',       'w');
$title_green  = mer_field('uk_ks_title_green',  'dobrych rękach');
$text1        = mer_field('uk_ks_text1',        'Oferujemy kompleksową obsługę księgową działalności i spółek zarówno w zakresie prowadzenia pełnych ksiąg rachunkowych, jak i uproszczonych form ewidencji. Klienci mogą powierzyć nam całość procesów księgowych lub wybrane obszary wymagające wsparcia.');
$text2        = mer_field('uk_ks_text2',        'Zakres współpracy dopasowujemy do skali działalności i stopnia złożoności operacji finansowych.');
$btn_text     = mer_field('uk_ks_btn_text',     'Sprawdź jak wygląda współpraca');
$btn_url      = mer_field('uk_ks_btn_url',      home_url('/kontakt/'));
$image        = get_field('uk_ks_image');

$img_url = is_array($image) ? esc_url($image['url']) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=900';
$img_alt = is_array($image) ? esc_attr($image['alt'] ?: 'Twoja księgowość') : 'Twoja księgowość';
?>

<section class="py-10 md:py-20 bg-white relative">
    <div class="absolute -right-32 top-1/2 -translate-y-1/2 w-[360px] h-[360px] rounded-full border-[50px] border-emerald-100 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            <div class="rounded-2xl overflow-hidden shadow-sm">
                <img src="<?php echo $img_url; ?>" alt="<?php echo $img_alt; ?>" class="w-full h-full object-cover aspect-[4/3]" loading="lazy">
            </div>

            <div>
                <h2 class="text-pretty text-4xl font-bold tracking-tight text-slate-900 mb-6 leading-tight">
                    <?php echo mer_esc($title1); ?><br>
                    <?php echo mer_esc($title2); ?> <span class="text-[#48c279]"><?php echo mer_esc($title_green); ?></span>
                </h2>
                <p class="text-base sm:text-lg text-slate-500 leading-relaxed mb-6">
                    <?php echo mer_esc($text1); ?>
                </p>
                <p class="text-base text-slate-800 font-semibold leading-relaxed mb-8">
                    <?php echo mer_esc($text2); ?>
                </p>
                <a href="#wspolpraca"
                   class="inline-flex px-7 py-3.5 rounded-full bg-[#48c279] text-white text-base font-semibold hover:bg-[#3ea868] transition-colors">
                    <?php echo mer_esc($btn_text); ?>
                </a>
            </div>

        </div>
    </div>
</section>
