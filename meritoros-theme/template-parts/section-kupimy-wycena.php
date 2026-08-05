<?php
defined('ABSPATH') || exit;

$heading  = mer_field('kupimy_wycena_heading',  'Od czego zależy wycena biura rachunkowego?');
$desc     = mer_field('kupimy_wycena_desc',     'Wartość biura rachunkowego nie zależy wyłącznie od przychodów. Znaczenie mają także m.in. struktura klientów, rentowność, organizacja procesów, używane systemy, stabilność zespołu oraz stopień zależności firmy od właściciela. Dlatego każdą rozmowę zaczynamy od zrozumienia realnej sytuacji biznesu.');
$list_label = mer_field('kupimy_wycena_list_label', 'Na wycenę wpływają m.in.:');
$items    = array_values(array_filter(array_map('trim', preg_split('/(\r?\n){2,}/', mer_field('kupimy_wycena_items',
    "poziom i powtarzalność przychodów,\n\nrentowność biura,\n\nstruktura klientów i ryzyko koncentracji,\n\norganizacja pracy, technologia i stopień poukładania procesów.")))));
?>

<section class="py-14 md:py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-start">

            <!-- Lewa: nagłówek + opis -->
            <div>
                <h2 class="text-pretty text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 leading-snug mb-6">
                    <?php echo mer_esc($heading); ?>
                </h2>
                <p class="text-base sm:text-lg text-slate-500 leading-relaxed">
                    <?php echo mer_esc($desc); ?>
                </p>
            </div>

            <!-- Prawa: lista -->
            <div>
                <?php if ( $list_label ) : ?>
                <p class="text-lg font-bold text-slate-900 mb-5"><?php echo mer_esc($list_label); ?></p>
                <?php endif; ?>

                <?php if ( $items ) : ?>
                <ul class="space-y-4">
                    <?php foreach ( $items as $item ) : ?>
                    <li class="flex items-start gap-3">
                        <span class="flex-shrink-0 mt-0.5 w-5 h-5 rounded-full bg-[#00d084] flex items-center justify-center">
                            <i data-lucide="check" class="w-3 h-3 text-white" stroke-width="3"></i>
                        </span>
                        <span class="text-lg text-slate-700 leading-relaxed"><?php echo mer_esc($item); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
