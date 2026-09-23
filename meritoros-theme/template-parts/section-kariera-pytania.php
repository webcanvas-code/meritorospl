<?php
$title    = mer_field('kar_pyt_title',    __('Masz pytania? Chętnie odpowiemy', 'meritoros'));
$name     = mer_field('kar_pyt_name',     'Anna Kowalska');
$role     = mer_field('kar_pyt_role',     __('Marketing manager', 'meritoros'));
$phone    = mer_field('kar_pyt_phone',    '(+48) 12 423 32 99');
$phone_raw = mer_field('kar_pyt_phone',   '+48124233299');
$email    = mer_field('kar_pyt_email',    'monika.motyka@meritoros.pl');
$photo = get_field('kar_pyt_photo');
if (empty($photo)) {
    $original_id = apply_filters('wpml_object_id', get_the_ID(), get_post_type(), true, apply_filters('wpml_default_language', null));
    if ($original_id && $original_id !== get_the_ID()) {
        $photo = get_field('kar_pyt_photo', $original_id);
    }
}
$photo_url = is_array($photo) ? esc_url($photo['url']) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=600&h=700&fit=crop&crop=face';
$photo_alt = is_array($photo) ? esc_attr($photo['alt'] ?: $name) : $name;

$phone_clean = preg_replace('/[^0-9+]/', '', $phone);
?>

<section id="kariera-pytania" class="py-16 sm:py-20 md:py-24 px-6 lg:px-12 bg-white relative">
    <div class="absolute -right-28 top-1/2 -translate-y-1/2 w-[380px] h-[380px] rounded-full border-[55px] border-emerald-100 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto relative z-10">
        <h2 class="text-pretty text-3xl lg:text-4xl xl:text-5xl font-bold text-slate-900 mb-12"><?php echo mer_esc($title); ?></h2>

        <div class="flex flex-col md:flex-row md:items-center gap-8 md:gap-12 lg:gap-20">
            <div class="shrink-0 w-full max-w-[280px] mx-auto md:mx-0 md:w-64 lg:w-[380px]">
                <img src="<?php echo $photo_url; ?>" alt="<?php echo $photo_alt; ?>" class="w-full rounded-2xl object-cover object-top aspect-square md:aspect-[3/4]" loading="lazy">
            </div>
            <div class="flex flex-col gap-4">
                <div>
                    <p class="text-3xl font-bold text-slate-900"><?php echo mer_esc($name); ?></p>
                    <p class="text-slate-500 text-lg mt-1"><?php echo mer_esc($role); ?></p>
                </div>
                <a href="tel:<?php echo esc_attr($phone_clean); ?>" class="text-3xl font-semibold text-[#00d084] hover:text-[#00d084] transition-colors duration-200"><?php echo mer_esc($phone); ?></a>
                <?php if ($email) : ?>
                <a href="mailto:<?php echo esc_attr($email); ?>"
                   class="mer-btn mer-btn--dark inline-flex items-center px-7 py-4 rounded-full bg-slate-900 text-white text-base font-semibold hover:bg-slate-700 transition-colors">
                    <?php echo mer_esc($email); ?>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
