<?php
/**
 * 404 — Nie znaleziono strony
 * WordPress automatycznie ustawia HTTP 404 przed załadowaniem tego szablonu.
 */
get_header();

$nav_cta_url = get_field('nav_cta_url', (int) get_option('page_on_front')) ?: home_url('/kontakt/');
?>

<main class="min-h-[70vh] flex items-center justify-center px-6 py-24">
    <div class="max-w-xl text-center">

        <p class="text-[8rem] font-bold leading-none text-slate-100 select-none" aria-hidden="true">404</p>

        <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-slate-900 -mt-4 mb-4">
            <?php esc_html_e('Strona nie istnieje', 'meritoros'); ?>
        </h1>

        <p class="text-lg text-slate-500 font-light leading-relaxed mb-10">
            <?php esc_html_e('Strona, której szukasz, mogła zostać przeniesiona lub usunięta. Wróć na stronę główną lub skontaktuj się z nami.', 'meritoros'); ?>
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="<?php echo esc_url(home_url('/')); ?>"
               class="bg-[#48c279] text-white px-8 py-3.5 rounded-full text-base font-semibold hover:bg-[#3ea868] transition-colors flex items-center gap-2">
                <i data-lucide="home" class="w-5 h-5 stroke-[1.5]"></i>
                <?php esc_html_e('Strona główna', 'meritoros'); ?>
            </a>
            <a href="<?php echo esc_url($nav_cta_url); ?>"
               class="border border-slate-200 text-slate-700 px-8 py-3.5 rounded-full text-base font-semibold hover:border-slate-300 hover:bg-slate-50 transition-colors">
                <?php esc_html_e('Kontakt', 'meritoros'); ?>
            </a>
        </div>

    </div>
</main>

<?php get_footer(); ?>
