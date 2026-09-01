<?php
$title = __( mer_field('ri_lista_title', 'Lista nadzorcza'), 'meritoros' );

// Karty – 9 osobnych grup ACF (ri_lista_card_1 … ri_lista_card_9)
$cards = [];
for ($i = 1; $i <= 9; $i++) {
    $c = get_field("ri_lista_card_{$i}");
    if (!empty($c['name'])) $cards[] = $c;
}
if (empty($cards)) {
    $cards = [
        [
            'name' => 'Lidia Olszowska',
            'role' => __('przewodnicząca rady nadzorczej', 'meritoros'),
            'desc' => "doradca podatkowy (certyfikat nr 00443)\nbył członek zarządu Małopolskiej Izby Doradców Podatkowych",
        ],
        [
            'name' => 'Maria Gargas',
            'role' => __('członek rady nadzorczej', 'meritoros'),
            'desc' => "przedsiębiorca\nprezes zarządu Emka Sp. z o.o.",
        ],
        [
            'name' => 'Jacek Pieniądz',
            'role' => __('członek rady nadzorczej', 'meritoros'),
            'desc' => "przedsiębiorca\nczłonek zarządu Chata Sp. z o.o.",
        ],
        [
            'name' => 'Dominik Jaskulski',
            'role' => __('członek rady nadzorczej', 'meritoros'),
            'desc' => "przedsiębiorca\nwiceprezes zarządu Office Samurai Sp. z o.o.",
        ],
        [
            'name' => 'Michał Czaicki',
            'role' => __('członek rady nadzorczej', 'meritoros'),
            'desc' => "przedsiębiorca\nprezes zarządu Printbox Sp. z o.o.",
        ],
    ];
}

?>

<section id="ri-lista" class="py-10 md:py-14 bg-white">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 mb-10">
            <?php echo mer_esc($title); ?>
        </h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            <?php foreach ($cards as $card) :
                $name = is_array($card) ? ($card['name'] ?? '') : '';
                $role = is_array($card) ? __($card['role'] ?? '', 'meritoros') : '';
                $desc = is_array($card) ? ($card['desc'] ?? '') : '';
            ?>
                <div class="border border-slate-200 rounded-2xl p-7 flex flex-col gap-4">
                    <div>
                        <p class="text-lg font-bold text-slate-900 mb-1"><?php echo mer_esc($name); ?></p>
                        <p class="text-sm text-slate-400"><?php echo mer_esc($role); ?></p>
                    </div>
                    <p class="text-base text-slate-600 leading-relaxed"><?php echo mer_esc($desc); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
