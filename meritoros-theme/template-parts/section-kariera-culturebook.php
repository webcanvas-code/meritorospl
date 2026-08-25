<?php
$title    = mer_field('kar_cult_title',    __('Poznaj nasz Culturebook', 'meritoros'));
$text1    = mer_field('kar_cult_text1',    __('Culturebook powstał po to, żebyśmy wszyscy w Meritoros w ten sam sposób rozumieli, kim jesteśmy, dokąd zmierzamy i jakie wartości są dla nas ważne. Opisuje naszą misję, sposób działania i standard współpracy – wewnątrz zespołu i z klientami.', 'meritoros'));
$text2    = mer_field('kar_cult_text2',    __('Jeśli chcesz lepiej poznać nasz styl pracy, pobierz Culturebook i sprawdź, czy to podejście jest Ci bliskie', 'meritoros'));
$btn_text = mer_field('kar_cult_btn_text', __('Pobierz plik', 'meritoros'));
$consent  = mer_field('kar_cult_consent',  __('Klikając przycisk, zgadzasz się, że Meritoros może wykorzystać te dane, aby kontaktować się z Tobą w związku z materiałami i usługami, które mogą Cię zainteresować. Możesz zrezygnować w każdej chwili. Więcej informacji znajdziesz w naszej Polityce Prywatności.', 'meritoros'));

$cover = get_field('kar_cult_cover');
if (empty($cover)) {
    $original_id = apply_filters('wpml_object_id', get_the_ID(), get_post_type(), true, apply_filters('wpml_default_language', null));
    if ($original_id && $original_id !== get_the_ID()) {
        $cover = get_field('kar_cult_cover', $original_id);
    }
}
$cover_url = is_array($cover) ? esc_url($cover['url']) : '';

$page_id = get_queried_object_id();
$pdf     = get_field('kar_cult_pdf', $page_id);
$has_pdf = is_array($pdf) && !empty($pdf['url']);

$nonce = wp_create_nonce('mer_culturebook_nonce');
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

                <?php if ($has_pdf) : ?>
                <form id="cult-form" class="flex flex-col gap-3" novalidate>
                    <input type="hidden" name="page_id" value="<?php echo esc_attr($page_id); ?>">
                    <input type="hidden" id="cult-nonce" value="<?php echo esc_attr($nonce); ?>">

                    <input type="email" id="cult-email" name="email" required
                           placeholder="<?php esc_attr_e('Adres e-mail', 'meritoros'); ?>"
                           class="mer-btn mer-btn--ghost w-full px-6 py-4 rounded-full border-2 border-white/30 bg-white/20 text-white placeholder:text-white/60 text-base focus:outline-none focus:border-white transition-colors duration-200">

                    <button type="submit" id="cult-submit"
                            class="mer-btn mer-btn--light inline-flex items-center justify-center gap-2 bg-white text-slate-900 font-semibold text-base px-8 py-3.5 rounded-full hover:bg-slate-100 transition-colors duration-200 w-fit">
                        <span id="cult-btn-label"><?php echo mer_esc($btn_text); ?></span>
                        <i data-lucide="download" class="w-5 h-5 stroke-[2]" id="cult-btn-icon"></i>
                        <svg id="cult-spinner" class="hidden animate-spin w-5 h-5" viewBox="0 0 24 24" fill="none">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                        </svg>
                    </button>

                    <?php if ($consent) : ?>
                    <p class="text-white/60 text-xs leading-relaxed max-w-sm"><?php echo mer_esc($consent); ?></p>
                    <?php endif; ?>

                    <p id="cult-error" class="mer-btn mer-btn--ghost hidden text-white font-semibold text-sm bg-white/20 rounded-xl px-4 py-2 w-fit"></p>
                </form>

                <p id="cult-success" class="hidden items-center gap-2 text-white font-semibold text-base">
                    <i data-lucide="check-circle" class="w-6 h-6 stroke-[2]"></i>
                    <?php esc_html_e('Wysłano! Sprawdź swoją skrzynkę e-mail.', 'meritoros'); ?>
                </p>
                <?php else : ?>
                <span class="mer-btn mer-btn--ghost inline-block bg-white/40 text-white/60 font-semibold text-base px-8 py-3.5 rounded-full cursor-default">
                    <?php echo mer_esc($btn_text); ?>
                </span>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>

<?php if ($has_pdf) : ?>
<script>
(function () {
    var form    = document.getElementById('cult-form');
    var emailEl = document.getElementById('cult-email');
    var submit  = document.getElementById('cult-submit');
    var icon    = document.getElementById('cult-btn-icon');
    var spinner = document.getElementById('cult-spinner');
    var success = document.getElementById('cult-success');
    var error   = document.getElementById('cult-error');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        error.classList.add('hidden');
        error.textContent = '';

        var email = emailEl.value.trim();
        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            error.textContent = 'Podaj prawidłowy adres e-mail.';
            error.classList.remove('hidden');
            return;
        }

        submit.disabled = true;
        icon.classList.add('hidden');
        spinner.classList.remove('hidden');

        var data = new FormData(form);
        data.set('action', 'mer_culturebook');
        data.set('nonce', document.getElementById('cult-nonce').value);

        fetch('<?php echo esc_url(admin_url('admin-ajax.php')); ?>', {
            method: 'POST', body: data, credentials: 'same-origin',
        })
        .then(function (r) { return r.json(); })
        .then(function (res) {
            if (res.success) {
                form.style.display = 'none';
                success.classList.remove('hidden');
                success.classList.add('flex');
            } else {
                error.textContent = res.data || 'Wystąpił błąd. Spróbuj ponownie.';
                error.classList.remove('hidden');
                submit.disabled = false;
                icon.classList.remove('hidden');
                spinner.classList.add('hidden');
            }
        })
        .catch(function () {
            error.textContent = 'Błąd połączenia. Spróbuj ponownie.';
            error.classList.remove('hidden');
            submit.disabled = false;
            icon.classList.remove('hidden');
            spinner.classList.add('hidden');
        });
    });
})();
</script>
<?php endif; ?>
