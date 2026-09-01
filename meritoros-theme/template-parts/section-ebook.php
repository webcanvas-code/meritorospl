<?php
/**
 * Sekcja: Ebook  (page-blog.php)
 * Pola ACF z group_mer_blog_page (functions.php), zakładka "Sekcja Ebook":
 * ebook_label, ebook_title, ebook_subtitle, ebook_desc, ebook_btn_text,
 * ebook_mockup (image, return_format:array), ebook_pdf (file, return_format:array)
 */
$pid = $args['pid'] ?? get_the_ID();

$label    = __( get_field('ebook_label',    $pid) ?: 'Darmowy materiał', 'meritoros' );
$title    = __( get_field('ebook_title',    $pid) ?: 'Pobierz nasz darmowy Ebook', 'meritoros' );
$subtitle_raw = get_field('ebook_subtitle', $pid) ?: '';
$subtitle = $subtitle_raw ? __($subtitle_raw, 'meritoros') : '';
$desc_raw = get_field('ebook_desc', $pid) ?: '';
$desc     = $desc_raw ? __($desc_raw, 'meritoros') : '';
$btn      = __( get_field('ebook_btn_text', $pid) ?: 'Pobierz materiał', 'meritoros' );

$mockup     = get_field('ebook_mockup', $pid);
$mockup_url = is_array($mockup) ? ($mockup['url'] ?? '') : '';
$mockup_alt = is_array($mockup) ? ($mockup['alt'] ?? 'Ebook') : 'Ebook';

$pdf     = get_field('ebook_pdf', $pid);
$has_pdf = is_array($pdf) && !empty($pdf['url']);

$nonce = wp_create_nonce('mer_ebook_nonce');
?>

<section class="py-16 md:py-24 bg-[#f0faf4] overflow-hidden">
    <div class="max-w-[1400px] mx-auto px-6 lg:pl-12 lg:pr-0">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16">

            <!-- Lewa: treść + formularz -->
            <div class="flex-1 max-w-xl">
                <span class="text-[#00d084] uppercase tracking-widest text-base font-bold mb-4 block">
                    <?php echo mer_esc($label); ?>
                </span>
                <h2 class="text-pretty text-4xl md:text-5xl font-bold tracking-tight text-slate-900 leading-tight mb-5">
                    <?php echo mer_esc($title); ?>
                </h2>
                <?php if ($subtitle) : ?>
                    <p class="text-lg font-semibold text-slate-800 leading-snug mb-3">
                        <?php echo mer_esc($subtitle); ?>
                    </p>
                <?php endif; ?>
                <?php if ($desc) : ?>
                    <p class="text-base sm:text-lg text-slate-500 leading-relaxed mb-8">
                        <?php echo mer_esc($desc); ?>
                    </p>
                <?php endif; ?>

                <?php if ($has_pdf) : ?>
                <form id="ebook-form" class="flex flex-col gap-4" novalidate>
                    <?php wp_nonce_field('mer_ebook_nonce', 'ebook_nonce_field'); ?>
                    <input type="hidden" name="page_id" value="<?php echo esc_attr($pid); ?>">

                    <input type="email" id="ebook-email" name="email" required
                           placeholder="<?php esc_attr_e('Adres e-mail', 'meritoros'); ?>"
                           class="mer-btn mer-btn--primary w-full px-6 py-4 rounded-full border border-slate-200 bg-white text-slate-900 text-base placeholder:text-slate-400 focus:outline-none focus:border-[#00d084] transition-colors duration-200 shadow-sm">

                    <button type="submit" id="ebook-submit"
                            class="mer-btn mer-btn--primary inline-flex items-center justify-center gap-2 bg-[#00d084] text-white px-8 py-4 rounded-full text-base font-bold hover:bg-[#00b872] transition-colors duration-200 w-fit">
                        <span id="ebook-btn-label"><?php echo mer_esc($btn); ?></span>
                        <i data-lucide="download" class="w-5 h-5 stroke-[2]" id="ebook-btn-icon"></i>
                        <svg id="ebook-spinner" class="hidden animate-spin w-5 h-5" viewBox="0 0 24 24" fill="none">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                        </svg>
                    </button>

                    <p id="ebook-success" class="hidden items-center gap-2 text-[#00d084] font-semibold text-sm">
                        <i data-lucide="check-circle" class="w-5 h-5 stroke-[2]"></i>
                        <?php esc_html_e('Ebook został wysłany na podany adres e-mail!', 'meritoros'); ?>
                    </p>
                    <p id="ebook-error" class="hidden text-red-500 text-sm"></p>
                </form>
                <?php else : ?>
                    <p class="text-slate-400 text-sm italic">Brak przypisanego pliku PDF. Wgraj plik w zakładce "Sekcja Ebook" w ustawieniach strony.</p>
                <?php endif; ?>
            </div>

            <!-- Prawa: mockup -->
            <?php if ($mockup_url) : ?>
            <div class="flex-1 hidden lg:flex items-center justify-center lg:justify-end"
                 style="margin-right: calc(-1 * (max(0px, (100vw - 1400px) / 2) + 8rem))">
                <img src="<?php echo esc_url($mockup_url); ?>"
                     alt="<?php echo esc_attr($mockup_alt); ?>"
                     class="ebook-mockup-img object-contain drop-shadow-2xl"
                     style="transform: rotate(6deg)" loading="lazy">
            </div>
            <?php endif; ?>

        </div>
    </div>
</section>

<?php if ($has_pdf) : ?>
<script>
var merEbookL10n = {
    emailInvalid: <?php echo json_encode(__('Podaj prawidłowy adres e-mail.', 'meritoros')); ?>,
    errorGeneric: <?php echo json_encode(__('Wystąpił błąd. Spróbuj ponownie.', 'meritoros')); ?>,
    errorNetwork: <?php echo json_encode(__('Błąd połączenia. Spróbuj ponownie.', 'meritoros')); ?>,
};
</script>
<script>
(function () {
    var form    = document.getElementById('ebook-form');
    var emailEl = document.getElementById('ebook-email');
    var submit  = document.getElementById('ebook-submit');
    var icon    = document.getElementById('ebook-btn-icon');
    var spinner = document.getElementById('ebook-spinner');
    var success = document.getElementById('ebook-success');
    var error   = document.getElementById('ebook-error');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        error.classList.add('hidden');
        error.textContent = '';

        var email = emailEl.value.trim();
        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            error.textContent = merEbookL10n.emailInvalid;
            error.classList.remove('hidden');
            return;
        }

        submit.disabled = true;
        icon.classList.add('hidden');
        spinner.classList.remove('hidden');

        var data = new FormData(form);
        data.set('action', 'mer_ebook');
        data.set('nonce', document.getElementById('ebook_nonce_field').value);

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
                error.textContent = res.data || merEbookL10n.errorGeneric;
                error.classList.remove('hidden');
                submit.disabled = false;
                icon.classList.remove('hidden');
                spinner.classList.add('hidden');
            }
        })
        .catch(function () {
            error.textContent = merEbookL10n.errorNetwork;
            error.classList.remove('hidden');
            submit.disabled = false;
            icon.classList.remove('hidden');
            spinner.classList.add('hidden');
        });
    });
})();
</script>
<?php endif; ?>
