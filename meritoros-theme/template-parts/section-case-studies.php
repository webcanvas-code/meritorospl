<?php
// Czytaj pola zawsze ze strony głównej — ACFML zwróci wersję w aktualnym języku
$_cs_id = (int) get_option('page_on_front');

$label    = (get_field('cs_label',    $_cs_id) ?: 'Case Studies');
$title    = (get_field('cs_title',    $_cs_id) ?: 'Historie naszych klientów');
$subtitle = (get_field('cs_subtitle', $_cs_id) ?: 'Krótkie historie firm, którym pomagamy uporządkować finanse i procesy. Przesuń palcem lub użyj strzałek.');

$historie_klientow_url = home_url('/historie-klientow/');

// Domyślne treści i grafiki zsynchronizowane z index.html (prototyp strony).
$cs_defaults = [
    1 => [
        'client_name' => 'HPC',
        'logo_html'   => '<span class="text-2xl lg:text-3xl font-bold tracking-tight text-[#0f4c81]">HPC</span><div class="flex gap-1.5 mt-1"><div class="w-4 h-4 bg-[#8cc63f] rounded-tl-full rounded-br-full"></div><div class="w-4 h-4 bg-[#1b75bc] rounded-tr-full rounded-bl-full"></div></div>',
        'industries'  => 'Geologia inżynierska, Ochrona środowiska',
        'scope_title' => 'Usługi rachunkowe, obszar kadr i płac, wsparcie w audytach',
        'scope_desc'  => 'Po kilku zmianach głównej księgowej spółka potrzebowała szybkiego uporządkowania księgowości i bezpiecznego zamknięcia roku obrotowego. Wdrożyliśmy usprawnienia procesowe.',
        'img_url'     => 'https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80',
        'video_label' => 'Nasz wpływ na operacje HPC',
        'video_dur'   => '03:45',
    ],
    2 => [
        'client_name' => 'Printbox',
        'logo_html'   => '<span class="text-2xl lg:text-3xl font-bold tracking-tight text-slate-900">Printbox</span><span class="bg-slate-100 text-slate-500 rounded-md px-2 py-1 text-xs font-bold uppercase tracking-wider">SaaS</span>',
        'industries'  => 'Technologia druku, E-commerce B2B',
        'scope_title' => 'Pełna obsługa BPO, rozliczenia międzynarodowe VAT OSS',
        'scope_desc'  => 'Przy dynamicznym wzroście sprzedaży cross-border firma potrzebowała partnera gotowego na złożone rozliczenia VAT OSS w wielu krajach UE. Przejęliśmy całość obsługi finansowej.',
        'img_url'     => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80',
        'video_label' => 'Jak Printbox skaluje finanse globalnie',
        'video_dur'   => '04:10',
    ],
    3 => [
        'client_name' => 'SITECH',
        'logo_html'   => '<span class="text-2xl lg:text-3xl font-bold tracking-tight text-slate-900">SITECH</span>',
        'industries'  => 'Budownictwo, Inżynieria',
        'scope_title' => 'Kadry, płace, Intrastat, rozliczenia delegacji zagranicznych',
        'scope_desc'  => 'Firma realizowała kontrakty w kilku krajach jednocześnie. Meritoros przejął obsługę kadrową i rozliczenia Intrastat, odciążając zarząd od złożoności administracyjnej.',
        'img_url'     => 'https://images.unsplash.com/photo-1560179707-f14e90ef3623?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80',
        'video_label' => 'Obsługa kadrowa na skalę międzynarodową',
        'video_dur'   => '05:22',
    ],
    4 => [
        'client_name' => 'ROFA',
        'logo_html'   => '<span class="text-2xl lg:text-3xl font-bold tracking-tight text-slate-900">ROFA</span><div class="w-5 h-5 rounded-full bg-slate-900 flex items-center justify-center"><i data-lucide="circle" class="w-3 h-3 fill-white stroke-[2] text-white"></i></div>',
        'industries'  => 'Produkcja przemysłowa, Eksport',
        'scope_title' => 'Pełna księgowość, fundacja rodzinna, compliance',
        'scope_desc'  => 'Właściciel grupy produkcyjnej chciał oddzielić majątek prywatny od firmowego poprzez fundację rodzinną. Meritoros poprowadził cały proces prawno-księgowy od podstaw.',
        'img_url'     => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80',
        'video_label' => 'Fundacja rodzinna krok po kroku',
        'video_dur'   => '06:08',
    ],
];

$items = [];

// Dodanie wideo ogólnego jako pierwszy slajd
$general_url = mer_field('cs_vid_general_url', 'https://www.youtube.com/watch?v=NKh2-7VGQbw');
if ($general_url) {
    $yt_id = '';
    $thumb_url = '';
    if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $general_url, $m)) {
        $yt_id = $m[1];
        $play_src = 'https://www.youtube.com/embed/' . $yt_id . '?autoplay=1&rel=0';
        $thumb_url = 'https://img.youtube.com/vi/' . $yt_id . '/maxresdefault.jpg';
    } elseif (preg_match('/vimeo\.com\/(\d+)/', $general_url, $m)) {
        $play_src = 'https://player.vimeo.com/video/' . $m[1] . '?autoplay=1';
    } else {
        $play_src = $general_url;
    }

    $items[] = [
        'client_name'  => 'Wideo ogólne',
        'logo_html'    => '',
        'industries'   => [],
        'scope_title'  => '',
        'scope_desc'   => mer_field('cs_vid_general_text', 'Nasi klienci cenią nas za to, że dowozimy: jakość, terminowość i spójne dane. Jako partner w obszarze księgowości przejmujemy obszary, za które odpowiadamy, i pracujemy w standardzie, który daje spokój w codziennym prowadzeniu firmy.'),
        'img_url'      => mer_field('cs_vid_general_img', $thumb_url ?: 'https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80'),
        'img_alt'      => 'Wideo ogólne Meritoros',
        'video_label'  => 'Obejrzyj ogólne wideo',
        'video_dur'    => $yt_id ? mer_youtube_duration($yt_id) : '',
        'play_src'     => $play_src,
        'play_type'    => 'embed',
        'cta_url'      => $historie_klientow_url,
        'is_general'   => true,
    ];
}

for ($i = 1; $i <= 4; $i++) {
    $def         = $cs_defaults[$i];
    $client_name = (get_field("cs_{$i}_client_name", $_cs_id) ?: $def['client_name']);
    if (empty($client_name)) continue;

    $acf_img    = get_field("cs_{$i}_image", $_cs_id);
    $video_file = get_field("cs_{$i}_video_file", $_cs_id);
    $video_url  = (get_field("cs_{$i}_video_url", $_cs_id) ?: '');

    $play_src = '';
    $play_type = '';
    $yt_thumb = '';

    if (is_array($video_file) && !empty($video_file['url'])) {
        $play_src  = esc_url($video_file['url']);
        $play_type = 'file';
    } elseif ($video_url) {
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $video_url, $m)) {
            $yt_id = $m[1];
            $play_src = 'https://www.youtube.com/embed/' . $yt_id . '?autoplay=1&rel=0';
            $yt_thumb = 'https://img.youtube.com/vi/' . $yt_id . '/maxresdefault.jpg';
        } elseif (preg_match('/vimeo\.com\/(\d+)/', $video_url, $m)) {
            $play_src = 'https://player.vimeo.com/video/' . $m[1] . '?autoplay=1';
        } else {
            $play_src = $video_url;
        }
        $play_type = 'embed';
    }

    $img_raw = $acf_img ?: ($yt_thumb ?: $def['img_url']);

    $industries_raw = (get_field("cs_{$i}_industries", $_cs_id) ?: $def['industries']);
    $industries = is_string($industries_raw) && $industries_raw !== ''
        ? array_values(array_filter(array_map('trim', explode(',', $industries_raw))))
        : [];

    $img_arr = $img_raw;
    $cta_raw = (get_field("cs_{$i}_cta_url", $_cs_id) ?: '');
    $cta_raw = is_string($cta_raw) ? trim($cta_raw) : '';
    $cta_url = ($cta_raw === '' || $cta_raw === '#') ? $historie_klientow_url : $cta_raw;

    $items[] = [
        'client_name'  => $client_name,
        'logo_html'    => (get_field("cs_{$i}_logo_html",   $_cs_id) ?: ''),
        'industries'   => $industries,
        'scope_title'  => (get_field("cs_{$i}_scope_title", $_cs_id) ?: $def['scope_title']),
        'scope_desc'   => (get_field("cs_{$i}_scope_desc",  $_cs_id) ?: $def['scope_desc']),
        'img_url'      => is_array($img_arr) ? esc_url($img_arr['url'] ?? '') : esc_url($img_arr),
        'img_alt'      => is_array($img_arr) ? esc_attr($img_arr['alt'] ?? $client_name) : esc_attr($client_name),
        'video_label'  => (get_field("cs_{$i}_video_label", $_cs_id) ?: $def['video_label']),
        'video_dur'    => (get_field("cs_{$i}_video_dur",   $_cs_id) ?: ($yt_thumb ? mer_youtube_duration($yt_id) : $def['video_dur'])),
        'play_src'     => $play_src,
        'play_type'    => $play_type,
        'cta_url'      => $cta_url,
    ];
}
$total = count($items);
?>

<section class="relative overflow-hidden bg-gradient-to-b from-slate-50 to-white px-6 lg:px-12 py-16 sm:py-20 lg:py-24" aria-labelledby="cs-section-title">
    <div class="pointer-events-none absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-slate-200 to-transparent"></div>

    <div class="max-w-[1400px] mx-auto w-full">
        <!-- Nagłówek: tylko kontekst — nawigacja slajdera jest pod kartą (lepszy UX na mobile) -->
        <header class="mb-8 lg:mb-10 text-center lg:text-left">
            <span class="text-[#2d8650] uppercase tracking-widest text-base font-bold mb-4 block">
                <?php echo mer_esc($label); ?>
            </span>
            <h2 id="cs-section-title" class="text-pretty text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-slate-900 max-w-3xl mx-auto lg:mx-0">
                <?php echo mer_esc($title); ?>
            </h2>
            <p class="mt-3 text-base sm:text-lg text-slate-500 max-w-2xl mx-auto lg:mx-0">
                <?php echo mer_esc($subtitle); ?>
            </p>
        </header>

        <div id="cs-viewport" class="relative overflow-hidden rounded-2xl sm:rounded-3xl bg-white">
            <div id="cs-track" class="flex transition-transform duration-500 ease-out will-change-transform">

                <?php
                $slide_i = 0;
                foreach ($items as $item) :
                    $slide_i++;
                    $logo_html = wp_kses(!empty($item['logo_html']) ? $item['logo_html'] : esc_html($item['client_name']), [
                        'span' => ['class' => []],
                        'div'  => ['class' => []],
                        'img'  => ['src' => [], 'alt' => [], 'class' => []],
                        'i'    => ['data-lucide' => [], 'class' => [], 'stroke-width' => []],
                    ]);
                ?>
                <article class="cs-slide min-w-full flex flex-col lg:grid lg:grid-cols-12 lg:min-h-[min(520px,70vh)]" aria-roledescription="slide">

                    <!-- Media: na mobile na górze, na desktop po prawej -->
                    <div class="group/media relative order-1 lg:order-2 lg:col-span-7 aspect-[16/10] sm:aspect-[2/1] lg:aspect-auto lg:min-h-[320px] overflow-hidden bg-slate-900">
                        <?php if ($item['img_url']) : ?>
                            <img src="<?php echo $item['img_url']; ?>" alt="<?php echo $item['img_alt']; ?>"
                                 class="absolute inset-0 h-full w-full object-contain transition-transform duration-700 ease-out group-hover/media:scale-[1.02]" loading="<?php echo $slide_i === 1 ? 'eager' : 'lazy'; ?>">
                        <?php endif; ?>
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/70 via-slate-900/15 to-transparent lg:bg-gradient-to-r lg:from-transparent lg:via-slate-900/10 lg:to-slate-900/35 pointer-events-none"></div>

                        <?php if ($item['play_src']) : ?>
                            <button type="button"
                                    class="cs-play-btn absolute inset-0 flex flex-col items-center justify-center gap-3 bg-transparent border-0 p-0 cursor-pointer group/play"
                                    data-src="<?php echo esc_attr($item['play_src']); ?>"
                                    data-type="<?php echo esc_attr($item['play_type']); ?>"
                                    aria-label="<?php esc_attr_e('Odtwórz wideo', 'meritoros'); ?>">
                                <span class="flex h-16 w-16 sm:h-[4.5rem] sm:w-[4.5rem] items-center justify-center rounded-full bg-white/95 text-[#2d8650] shadow-lg shadow-black/15 ring-4 ring-white/30 transition-transform duration-300 group-hover/play:scale-105">
                                    <i data-lucide="play" class="w-7 h-7 sm:w-8 sm:h-8 fill-current ml-0.5"></i>
                                </span>
                                <span class="rounded-full bg-black/35 px-3 py-1 text-xs font-medium text-white backdrop-blur-sm">
                                    <?php esc_html_e('Obejrzyj materiał', 'meritoros'); ?>
                                </span>
                            </button>
                        <?php else : ?>
                            <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-90">
                                <span class="flex h-16 w-16 items-center justify-center rounded-full bg-white/90 text-slate-500 shadow-lg">
                                    <i data-lucide="images" class="w-7 h-7 stroke-[1.5]"></i>
                                </span>
                            </div>
                        <?php endif; ?>

                        <?php if ($item['video_label']) : ?>
                            <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-6 flex items-end justify-between gap-3 text-left pointer-events-none">
                                <p class="text-sm sm:text-base font-medium text-white drop-shadow max-w-[75%] leading-snug">
                                    <?php echo mer_esc($item['video_label']); ?>
                                </p>
                                <?php if ($item['video_dur']) : ?>
                                    <span class="shrink-0 rounded-md bg-white/15 px-2 py-1 text-xs font-semibold tabular-nums text-white backdrop-blur-sm">
                                        <?php echo mer_esc($item['video_dur']); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Treść -->
                    <div class="order-2 lg:order-1 lg:col-span-5 flex flex-col justify-center p-6 sm:p-8 lg:p-10 xl:p-12">
                        <?php if (empty($item['is_general'])) : ?>
                            <p class="text-[11px] uppercase tracking-[0.2em] font-semibold text-[#2d8650] mb-2">
                                <?php esc_html_e('Case study', 'meritoros'); ?>
                            </p>
                            <div class="flex flex-wrap items-center gap-3 mb-5">
                                <?php echo $logo_html; ?>
                            </div>

                            <?php if (!empty($item['industries'])) : ?>
                                <div class="mb-5">
                                    <p class="text-xs font-semibold text-slate-400 mb-2">
                                        <?php esc_html_e('Branża', 'meritoros'); ?>
                                    </p>
                                    <div class="flex flex-wrap gap-2">
                                        <?php foreach ($item['industries'] as $ind) : ?>
                                            <span class="inline-flex rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-700">
                                                <?php echo mer_esc($ind); ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="rounded-2xl bg-slate-50 p-4 sm:p-5 mb-6">
                                <p class="text-xs font-semibold text-slate-400 mb-1.5">
                                    <?php esc_html_e('Zakres współpracy', 'meritoros'); ?>
                                </p>
                                <h3 class="text-lg sm:text-xl font-bold text-slate-900 leading-snug mb-2">
                                    <?php echo mer_esc($item['scope_title']); ?>
                                </h3>
                                <p class="text-sm text-slate-600 leading-relaxed">
                                    <?php echo mer_esc($item['scope_desc']); ?>
                                </p>
                            </div>
                        <?php else : ?>
                            <div class="rounded-2xl bg-slate-50 p-6 sm:p-8 mb-6 flex-grow flex flex-col justify-center">
                                <p class="text-base sm:text-lg text-slate-800 leading-relaxed font-medium">
                                    <?php echo mer_esc($item['scope_desc']); ?>
                                </p>
                            </div>
                        <?php endif; ?>

                        <a href="<?php echo esc_url($item['cta_url']); ?>"
                           class="inline-flex w-full sm:w-auto min-h-[48px] items-center justify-center gap-2 rounded-full bg-[#2d8650] px-5 py-3.5 text-sm font-semibold text-white shadow-md shadow-[#2d8650]/25 transition hover:bg-[#246e41] hover:shadow-lg hover:shadow-[#2d8650]/30 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#2d8650] group/cta">
                            <?php esc_html_e('Poznaj więcej historii', 'meritoros'); ?>
                            <i data-lucide="arrow-right" class="w-4 h-4 transition group-hover/cta:translate-x-0.5"></i>
                        </a>
                    </div>

                </article>
                <?php endforeach; ?>

            </div>
        </div>

        <!-- Pasek nawigacji -->
        <div class="mt-6 flex flex-col items-stretch gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center justify-center gap-2 sm:justify-start">
                <button type="button" id="cs-prev"
                        class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 hover:text-slate-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#2d8650]"
                        aria-label="<?php esc_attr_e('Poprzednia historia', 'meritoros'); ?>">
                    <i data-lucide="chevron-left" class="w-5 h-5 stroke-[2]"></i>
                </button>
                <span id="cs-counter" class="min-w-[4.5rem] text-center text-sm font-semibold tabular-nums text-slate-600" aria-live="polite">
                    <?php echo $total > 0 ? '1 / ' . (int) $total : '0 / 0'; ?>
                </span>
                <button type="button" id="cs-next"
                        class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-[#2d8650] text-white shadow-md shadow-[#2d8650]/25 transition hover:bg-[#246e41] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#2d8650]"
                        aria-label="<?php esc_attr_e('Następna historia', 'meritoros'); ?>">
                    <i data-lucide="chevron-right" class="w-5 h-5 stroke-[2]"></i>
                </button>
            </div>

            <div id="cs-dots" class="flex flex-wrap justify-center gap-2 sm:justify-end" aria-label="<?php esc_attr_e('Nawigacja slajdów', 'meritoros'); ?>">
                <?php for ($i = 0; $i < $total; $i++) : ?>
                    <button type="button" data-index="<?php echo $i; ?>"
                            class="cs-dot h-2 rounded-full transition-all duration-300 <?php echo $i === 0 ? 'w-8 bg-[#2d8650] ring-2 ring-[#2d8650]/25' : 'w-2 bg-slate-200 hover:bg-slate-300'; ?>"
                            aria-label="<?php printf(esc_attr__('Historia %d z %d', 'meritoros'), $i + 1, $total); ?>"
                            aria-current="<?php echo $i === 0 ? 'true' : 'false'; ?>">
                    </button>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</section>

<!-- Modal wideo -->
<div id="cs-vid-modal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 md:p-10">
    <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm" id="cs-vid-backdrop"></div>
    <div class="relative w-full max-w-4xl z-10">
        <button id="cs-vid-close" class="absolute -top-10 right-0 text-white/80 hover:text-white transition-colors flex items-center gap-1.5 text-sm">
            <i data-lucide="x" class="w-5 h-5"></i> Zamknij
        </button>
        <div id="cs-vid-embed-wrap" class="relative w-full hidden" style="padding-bottom:56.25%">
            <iframe id="cs-vid-iframe" class="absolute inset-0 w-full h-full rounded-2xl" src="" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
        </div>
        <div id="cs-vid-file-wrap" class="hidden">
            <video id="cs-vid-file" controls autoplay playsinline class="w-full rounded-2xl bg-black max-h-[80vh]" src=""></video>
        </div>
    </div>
</div>
