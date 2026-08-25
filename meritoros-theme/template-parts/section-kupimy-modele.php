<?php
defined('ABSPATH') || exit;

$btn_text = mer_field('kupimy_modele_btn_text', 'Porozmawiajmy o możliwym modelu współpracy');
$btn_url  = mer_field('kupimy_modele_btn_url',  get_permalink(get_page_by_path('kontakt')));

$cards = [
    [
        'number' => '01',
        'title'  => mer_field('kupimy_model1_title', 'Całkowita sprzedaż biura'),
        'desc'   => mer_field('kupimy_model1_desc',  'Jeśli planujesz wycofanie się z prowadzenia firmy, możemy rozmawiać o przejęciu całego przedsiębiorstwa — z uwzględnieniem klientów, zespołu i ciągłości działania.'),
        'image'  => mer_field('kupimy_model1_image'),
        'img_default' => 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=900&q=80',
    ],
    [
        'number' => '02',
        'title'  => mer_field('kupimy_model2_title', 'Sprzedaż części udziałów'),
        'desc'   => mer_field('kupimy_model2_desc',  'Jeśli chcesz dalej prowadzić biuro, ale jednocześnie zyskać wsparcie większej organizacji, możemy rozmawiać o modelu partnerskim z częściowym wejściem kapitałowym Meritoros.'),
        'image'  => mer_field('kupimy_model2_image'),
        'img_default' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=900&q=80',
    ],
];
?>

<section class="py-12 md:py-16 bg-white relative">
    <div class="absolute -right-40 bottom-0 w-[480px] h-[480px] rounded-full border-[40px] border-emerald-100 pointer-events-none" aria-hidden="true"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative">

        <!-- Dwa kafelki -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
            <?php foreach ( $cards as $card ) :
                $img_src = is_array($card['image']) ? $card['image']['url'] : $card['img_default'];
                $img_alt = is_array($card['image']) ? ($card['image']['alt'] ?: $card['title']) : $card['title'];
            ?>
            <div class="relative bg-white rounded-3xl border border-slate-100 shadow-sm p-10 flex flex-col">

                <!-- Numer dekoracyjny w tle (lewa strona) -->
                <span class="absolute top-4 left-6 text-9xl font-bold leading-none select-none pointer-events-none" style="color: #f1f5f9;" aria-hidden="true">
                    <?php echo mer_esc($card['number']); ?>
                </span>

                <!-- Treść -->
                <h2 class="text-pretty relative text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 leading-snug mb-4 mt-16">
                    <?php echo mer_esc($card['title']); ?>
                </h2>

                <p class="relative text-base sm:text-lg text-slate-500 leading-relaxed mb-8">
                    <?php echo mer_esc($card['desc']); ?>
                </p>

                <!-- Zdjęcie -->
                <div class="relative rounded-2xl overflow-hidden mt-auto">
                    <img src="<?php echo esc_url($img_src); ?>"
                         alt="<?php echo esc_attr($img_alt); ?>"
                         class="w-full h-64 object-cover" loading="lazy">
                </div>

            </div>
            <?php endforeach; ?>
        </div>

        <!-- Przycisk CTA -->
        <div class="flex justify-center">
            <a href="<?php echo esc_url($btn_url ?: '#'); ?>"
               class="mer-btn mer-btn--primary inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-[#00d084] hover:bg-[#00b872] text-white text-base font-semibold transition-colors duration-200">
                <?php echo mer_esc($btn_text); ?>
            </a>
        </div>

    </div>
</section>
