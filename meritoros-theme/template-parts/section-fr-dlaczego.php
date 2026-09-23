<?php
$title = __( mer_field('fr_dlaczego_title', 'Dlaczego Meritoros'), 'meritoros' );

$card_defaults = [
    1 => ['title' => "Bezpieczeństwo\ni compliance", 'text' => 'Działamy zgodnie z obowiązującymi regulacjami i standardami bezpieczeństwa danych. Dbamy o poufność informacji oraz jasne zasady współpracy – bez „skrótów" i ryzyk.', 'fallback_img' => 'ISO_27001.svg'],
    2 => ['title' => "Jakość potwierdzona\nstandardami", 'text' => 'Mamy wdrożone procedury kontroli jakości i weryfikacji danych. Dostarczamy informacje finansowe kompletne, spójne i użyteczne dla zarządu.', 'fallback_img' => 'ISO9001.png'],
    3 => ['title' => 'Ponad 170 ekspertów', 'text' => 'Jakość potwierdzona standardami. Mamy wdrożone procedury kontroli jakości i weryfikacji danych. Dostarczamy informacje finansowe kompletne, spójne i użyteczne dla zarządu.'],
];

$cards = [];
for ($i = 1; $i <= 6; $i++) {
    $d = $card_defaults[$i] ?? null;
    $card_title = __( mer_field("fr_d{$i}_title", $d['title'] ?? ''), 'meritoros' );
    if (empty(trim($card_title))) continue;
    $cards[] = [
        'title'        => $card_title,
        'text'         => __( mer_field("fr_d{$i}_text", $d['text'] ?? ''), 'meritoros' ),
        'logo'         => get_field("fr_d{$i}_logo"),
        'fallback_img' => $d['fallback_img'] ?? '',
    ];
}
?>

<section id="fr-dlaczego" class="py-10 md:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 mb-12">
            <?php echo nl2br(str_replace('Meritoros', '<span class="text-[#00d084]">Meritoros</span>', esc_html($title))); ?>
        </h2>

        <div class="grid md:grid-cols-3 gap-6">
            <?php foreach ($cards as $idx => $card) :
                $raw = $card['title'];
                if (strpos($raw, "\n") !== false) {
                    $parts = explode("\n", $raw, 2);
                } else {
                    $mid = (int) ceil(mb_strlen($raw) / 2);
                    $pos = mb_strrpos(mb_substr($raw, 0, $mid + 6), ' ');
                    $parts = $pos !== false
                        ? [mb_substr($raw, 0, $pos), mb_substr($raw, $pos + 1)]
                        : [$raw, ''];
                }
            ?>
            <div class="bg-[#00d084] rounded-3xl p-8 flex flex-col min-h-[380px] relative overflow-hidden">
                <h3 class="text-xl font-bold text-white mb-4 leading-snug">
                    <span class="block"><?php echo mer_esc($parts[0]); ?></span>
                    <?php if (!empty($parts[1])) : ?>
                    <span class="block"><?php echo mer_esc($parts[1]); ?></span>
                    <?php endif; ?>
                </h3>
                <p class="text-white/85 text-base leading-relaxed"><?php echo mer_esc($card['text']); ?></p>
                <?php if (is_array($card['logo']) || !empty($card['fallback_img'])) : ?>
                <div class="mt-auto pt-8">
                    <?php if (is_array($card['logo'])) : ?>
                        <img src="<?php echo esc_url($card['logo']['url']); ?>" alt="<?php echo esc_attr($card['logo']['alt'] ?: ''); ?>" class="h-14 w-auto object-contain brightness-0 invert opacity-90" loading="lazy">
                    <?php elseif (!empty($card['fallback_img'])) : ?>
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/images/' . $card['fallback_img']); ?>" alt="" class="h-14 w-auto object-contain brightness-0 invert opacity-90" loading="lazy">
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
