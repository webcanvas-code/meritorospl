<?php
$title = __( mer_field('fr_obs_title', 'Obsługa księgowa fundacji rodzinnej dla właścicieli myślących długoterminowo'), 'meritoros' );
$text  = __( mer_field('fr_obs_text',  'Prowadzimy księgowość fundacji rodzinnych dla przedsiębiorców, którzy chcą uporządkować kwestie majątku i sukcesji w sposób bezpieczny, transparentny i zgodny z przepisami. Bierzemy na siebie bieżącą obsługę, sprawozdawczość i kontrolę terminów, tak aby fundacja działała stabilnie.'), 'meritoros' );
$image = get_field('fr_obs_image');

$img_url = is_array($image) ? esc_url($image['url']) : 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&q=80&w=900';
$img_alt = is_array($image) ? esc_attr($image['alt'] ?: 'Obsługa księgowa fundacji rodzinnej') : 'Obsługa księgowa fundacji rodzinnej';
?>

<section class="py-10 md:py-20 bg-white overflow-hidden relative">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            <div class="rounded-2xl overflow-hidden shadow-sm">
                <img src="<?php echo $img_url; ?>" alt="<?php echo $img_alt; ?>" class="w-full h-full object-cover aspect-[4/3]" loading="lazy">
            </div>

            <div>
                <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 mb-6 leading-tight">
                    <?php echo nl2br(str_replace(
                        esc_html(__('myślących długoterminowo', 'meritoros')),
                        '<span class="text-[#00d084]">' . esc_html(__('myślących długoterminowo', 'meritoros')) . '</span>',
                        esc_html($title)
                    )); ?>
                </h2>
                <p class="text-base sm:text-lg text-slate-500 leading-relaxed">
                    <?php echo mer_esc($text); ?>
                </p>
            </div>

        </div>
    </div>
</section>
