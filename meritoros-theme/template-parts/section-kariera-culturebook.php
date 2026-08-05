<?php
$title    = mer_field('kar_cult_title',    __('Poznaj nasz Culturebook', 'meritoros'));
$text1    = mer_field('kar_cult_text1',    __('Culturebook powstał po to, żebyśmy wszyscy w Meritoros w ten sam sposób rozumieli, kim jesteśmy, dokąd zmierzamy i jakie wartości są dla nas ważne. Opisuje naszą misję, sposób działania i standard współpracy – wewnątrz zespołu i z klientami.', 'meritoros'));
$text2    = mer_field('kar_cult_text2',    __('Jeśli chcesz lepiej poznać nasz styl pracy, pobierz Culturebook i sprawdź, czy to podejście jest Ci bliskie', 'meritoros'));
$btn_text = mer_field('kar_cult_btn_text', __('Pobierz plik', 'meritoros'));

$cover = get_field('kar_cult_cover');
if (empty($cover)) {
    $original_id = apply_filters('wpml_object_id', get_the_ID(), get_post_type(), true, apply_filters('wpml_default_language', null));
    if ($original_id && $original_id !== get_the_ID()) {
        $cover = get_field('kar_cult_cover', $original_id);
    }
}
$cover_url = is_array($cover) ? esc_url($cover['url']) : '';

$page_id  = get_queried_object_id();
$pdf      = get_field('kar_cult_pdf', $page_id);
$pdf_url  = is_array($pdf) ? ($pdf['url'] ?? '') : '';
?>

<section class="py-12 sm:py-16 px-6 lg:px-12 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="bg-[#00d084] rounded-3xl overflow-hidden lg:overflow-visible relative min-h-[340px] flex items-center">

            <div class="absolute right-[18%] top-1/2 -translate-y-1/2 w-72 h-72 rounded-full border-[40px] border-emerald-400/50 pointer-events-none"></div>

            <?php if ($cover_url) : ?>
            <img src="<?php echo $cover_url; ?>" alt="Culturebook"
                 class="hidden lg:block absolute right-0 bottom-0 h-[110%] w-auto object-contain object-bottom pointer-events-none z-20"
                 loading="lazy">
            <?php endif; ?>

            <div class="relative z-10 px-10 lg:px-16 py-12 max-w-xl">
                <h2 class="text-pretty text-3xl lg:text-4xl xl:text-5xl font-bold text-white tracking-tight mb-5"><?php echo mer_esc($title); ?></h2>
                <p class="text-white/85 text-lg font-light leading-relaxed mb-5"><?php echo mer_esc($text1); ?></p>
                <p class="text-white text-lg font-semibold leading-relaxed mb-8"><?php echo mer_esc($text2); ?></p>

                <?php if ($pdf_url) : ?>
                <a href="<?php echo esc_url($pdf_url); ?>" download
                   class="inline-flex items-center gap-2 bg-white text-slate-900 font-semibold text-base px-8 py-3.5 rounded-full hover:bg-slate-100 transition-colors duration-200">
                    <?php echo mer_esc($btn_text); ?>
                    <i data-lucide="download" class="w-5 h-5 stroke-[2]"></i>
                </a>
                <?php else : ?>
                <span class="inline-block bg-white/40 text-white/60 font-semibold text-base px-8 py-3.5 rounded-full cursor-default">
                    <?php echo mer_esc($btn_text); ?>
                </span>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>

