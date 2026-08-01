<?php
defined('ABSPATH') || exit;

$label   = mer_field('kupimy_part_label',   'W przypadku modelu partnerskiego');
$heading = mer_field('kupimy_part_heading', 'Model partnerski kierujemy przede wszystkim do biur, które:');
$items   = array_values(array_filter(array_map('trim', preg_split('/(\r?\n){2,}/', mer_field('kupimy_part_items',
    "mają obrót roczny <strong>powyżej 3 mln zł</strong>,\n\npracują na systemach innych niż <strong>Optima</strong>, np. Enova, Symfonia,\n\nchcą dalej rozwijać firmę, ale zyskać dostęp do większego zaplecza,\n\nszukają wsparcia <strong>w obszarze technologii</strong>, procesów, HR, marketingu i rozwoju operacyjnego.")))));

$photo     = mer_field('kupimy_part_photo');
$photo_url = is_array($photo) ? $photo['url'] : 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=900&q=80';
$photo_alt = is_array($photo) ? ($photo['alt'] ?: 'Zespół') : 'Zespół';

$benefits_title = mer_field('kupimy_part_benefits_title', 'Co zyskujesz jako Partner Meritoros?');
$benefits = array_values(array_filter(array_map('trim', preg_split('/(\r?\n){2,}/', mer_field('kupimy_part_benefits',
    "dostęp do automatyzacji i robotyzacji procesów\n\nwsparcie w digitalizacji i porządkowaniu operacji\n\ndostęp do wiedzy ekspertów i partnerów merytorycznych\n\nwsparcie HR i rekrutacyjne\n\nwsparcie marketingowe i sprzedażowe,\n\nwewnętrzne standardy jakości i audytu\n\nmożliwość dalszego rozwoju w strukturach większej organizacji")))));
?>

<section class="py-14 md:py-20 bg-emerald-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Górna część: zdjęcie + treść -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center mb-16">

            <!-- Zdjęcie -->
            <div class="rounded-3xl overflow-hidden shadow-sm">
                <img src="<?php echo esc_url($photo_url); ?>"
                     alt="<?php echo esc_attr($photo_alt); ?>"
                     class="w-full object-cover aspect-[4/3]" loading="lazy">
            </div>

            <!-- Treść -->
            <div>
                <?php if ( $label ) : ?>
                <p class="text-[#2d8650] uppercase tracking-widest text-base font-bold mb-4 block">
                    <?php echo mer_esc($label); ?>
                </p>
                <?php endif; ?>

                <h2 class="text-pretty text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 leading-snug mb-7">
                    <?php echo mer_esc($heading); ?>
                </h2>

                <?php if ( $items ) : ?>
                <ul class="space-y-4">
                    <?php foreach ( $items as $item ) : ?>
                    <li class="flex items-start gap-3">
                        <span class="flex-shrink-0 mt-0.5 w-5 h-5 rounded-full bg-[#2d8650] flex items-center justify-center">
                            <i data-lucide="check" class="w-3 h-3 text-white" stroke-width="3"></i>
                        </span>
                        <span class="text-base text-slate-700 leading-relaxed"><?php echo wp_kses($item, ['strong' => [], 'b' => []]); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>

        </div>

        <!-- Dolna część: siatka korzyści -->
        <?php if ( $benefits ) : ?>
        <h3 class="text-2xl md:text-3xl font-bold text-slate-900 mb-8">
            <?php echo mer_esc($benefits_title); ?>
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <?php foreach ( $benefits as $benefit ) : ?>
            <div class="bg-white rounded-2xl border border-slate-100 p-6 flex flex-col gap-4">
                <span class="w-10 h-10 rounded-full bg-[#2d8650] flex items-center justify-center flex-shrink-0">
                    <i data-lucide="check" class="w-5 h-5 text-white" stroke-width="2.5"></i>
                </span>
                <p class="text-lg text-slate-700 leading-relaxed">
                    <?php echo mer_esc($benefit); ?>
                </p>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </div>
</section>
