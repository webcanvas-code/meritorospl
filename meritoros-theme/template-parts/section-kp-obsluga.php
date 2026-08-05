<?php
$title1       = mer_field('kp_obs_title1',      'Twoje kadry');
$title2       = mer_field('kp_obs_title2',      'i płace');
$title_green  = mer_field('kp_obs_title_green', 'pod kontrolą');
$text1        = mer_field('kp_obs_text1',       'Oferujemy pełną obsługę kadrowo-płacową przedsiębiorstw – od prowadzenia dokumentacji pracowniczej po naliczanie wynagrodzeń i rozliczenia z instytucjami publicznymi. Klienci mogą powierzyć nam całość procesów kadrowych i płacowych lub wybrane obszary wymagające wsparcia.');
$text2        = mer_field('kp_obs_text2',       'Zakres współpracy dopasowujemy do wielkości i struktury organizacji.');
$btn_text     = mer_field('kp_obs_btn_text',    'Oszacuj wstępną wycenę');
$btn_url      = mer_field('kp_obs_btn_url',     '#kalkulator');
$image        = get_field('kp_obs_image');

$img_url = is_array($image) ? esc_url($image['url']) : 'https://images.unsplash.com/photo-1521737711867-e3b97375f902?auto=format&fit=crop&q=80&w=900';
$img_alt = is_array($image) ? esc_attr($image['alt'] ?: 'Obsługa kadrowo-płacowa') : 'Obsługa kadrowo-płacowa';
?>

<section class="py-10 md:py-20 bg-white relative">
    <div class="absolute -right-32 top-1/2 -translate-y-1/2 w-[360px] h-[360px] rounded-full border-[50px] border-emerald-100 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            <div class="rounded-2xl overflow-hidden shadow-sm">
                <img src="<?php echo $img_url; ?>" alt="<?php echo $img_alt; ?>" class="w-full h-full object-cover aspect-[4/3]" loading="lazy">
            </div>

            <div>
                <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 mb-6 leading-tight">
                    <?php echo mer_esc($title1); ?><br>
                    <?php echo mer_esc($title2); ?> <span class="text-[#00d084]"><?php echo mer_esc($title_green); ?></span>
                </h2>
                <p class="text-base sm:text-lg text-slate-500 leading-relaxed mb-6">
                    <?php echo mer_esc($text1); ?>
                </p>
                <p class="text-base text-slate-900 font-semibold leading-relaxed mb-8">
                    <?php echo mer_esc($text2); ?>
                </p>
                <a href="#kalkulator"
                   class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-[#00d084] text-white text-base font-semibold hover:bg-[#00b872] transition-colors">
                    <?php echo mer_esc($btn_text); ?>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

        </div>
    </div>
</section>
