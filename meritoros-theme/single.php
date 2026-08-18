<?php
defined('ABSPATH') || exit;
get_header();

if ( ! have_posts() ) { get_footer(); exit; }
the_post();

$blog_page = get_page_by_path('wiedza-i-poradniki') ?: get_page_by_path('blog');
$blog_url  = $blog_page ? get_permalink($blog_page) : home_url('/wiedza-i-poradniki/');
$blog_label = $blog_page ? get_the_title($blog_page) : 'Wiedza i poradniki';

$categories = get_the_category();
$first_cat  = ! empty($categories) ? $categories[0] : null;
?>

<style>
.post-content h1,
.post-content h2,
.post-content h3,
.post-content h4,
.post-content h5,
.post-content h6 {
    font-weight: 700;
    letter-spacing: -0.02em;
    color: #0f172a;
    line-height: 1.25;
    margin-top: 2.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e2e8f0;
}
.post-content h2 { font-size: 1.5rem; }
.post-content h3 { font-size: 1.25rem; }
.post-content h4 { font-size: 1.125rem; }
.post-content p  { margin-top: 1.25rem; line-height: 1.8; color: #334155; }
.post-content a  { color: #00d084; text-decoration: none; }
.post-content a:hover { text-decoration: underline; }
.post-content strong { color: #0f172a; font-weight: 600; }
.post-content blockquote {
    border-left: 4px solid #00d084;
    padding: 0.75rem 0 0.75rem 1.5rem;
    margin: 2rem 0;
    color: #475569;
    font-style: italic;
}
.post-content img {
    border-radius: 0.75rem;
    max-width: 100%;
    height: auto;
    margin: 2rem auto;
    display: block;
}
.post-content ol { list-style: decimal; padding-left: 1.5rem; }
.post-content ul { list-style: disc; padding-left: 1.5rem; }
.post-content li { margin-top: 0.375rem; margin-bottom: 0.375rem; color: #334155; line-height: 1.7; }
.post-content li::marker { color: #00d084; }
.post-content table { width: 100%; border-collapse: collapse; margin: 2rem 0; font-size: 0.9rem; }
.post-content th { background: #f1f5f9; font-weight: 600; text-align: left; padding: 0.625rem 0.875rem; color: #0f172a; border: 1px solid #e2e8f0; }
.post-content td { padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; color: #334155; }
.post-content pre { background: #1e293b; color: #e2e8f0; padding: 1.25rem 1.5rem; border-radius: 0.75rem; overflow-x: auto; font-size: 0.875rem; margin: 2rem 0; }
.post-content code { background: #f1f5f9; color: #0f172a; padding: 0.15em 0.4em; border-radius: 0.25rem; font-size: 0.875em; }
.post-content pre code { background: none; color: inherit; padding: 0; border-radius: 0; }
.post-content > *:first-child { margin-top: 0; padding-top: 0; border-top: none; }
</style>

<main class="bg-white text-slate-900 antialiased">

    <!-- Hero -->
    <section class="pt-32 md:pt-44 pb-16 bg-white relative">

        <div class="absolute -right-32 top-0 w-[560px] h-[560px] rounded-full border-[48px] border-emerald-100/60 pointer-events-none" aria-hidden="true"></div>

        <div class="max-w-2xl mx-auto px-6 relative z-10">

            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-sm text-slate-400 mb-10 flex-wrap">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-slate-600 transition-colors">Strona główna</a>
                <span>/</span>
                <a href="<?php echo esc_url($blog_url); ?>" class="hover:text-slate-600 transition-colors"><?php echo esc_html($blog_label); ?></a>
                <span>/</span>
                <span class="text-slate-600"><?php the_title(); ?></span>
            </nav>

            <!-- Meta -->
            <div class="flex items-center gap-3 mb-6 flex-wrap">
                <?php if ($first_cat) : ?>
                    <span class="text-xs font-semibold text-white bg-[#00d084] px-3 py-1 rounded-full">
                        <?php echo esc_html($first_cat->name); ?>
                    </span>
                <?php endif; ?>
                <span class="text-sm text-slate-400"><?php the_date('j F Y'); ?></span>
                <?php
                $author_name = get_the_author();
                if ($author_name) :
                ?>
                    <span class="text-slate-300">·</span>
                    <span class="text-sm text-slate-400"><?php echo esc_html($author_name); ?></span>
                <?php endif; ?>
            </div>

            <!-- Tytuł -->
            <h1 class="text-pretty text-4xl sm:text-5xl font-bold tracking-tight text-slate-900 leading-[1.15] mb-8">
                <?php the_title(); ?>
            </h1>

            <!-- Excerpt / lead -->
            <?php if (has_excerpt()) : ?>
                <p class="text-xl text-slate-500 leading-relaxed border-l-4 border-emerald-400 pl-6">
                    <?php echo wp_kses_post(get_the_excerpt()); ?>
                </p>
            <?php endif; ?>

        </div>
    </section>

    <!-- Featured image -->
    <?php if (has_post_thumbnail()) : ?>
    <div class="max-w-3xl mx-auto px-6 mb-12">
        <?php the_post_thumbnail('large', [
            'class' => 'w-full rounded-2xl object-cover',
            'style' => 'max-height: 480px;',
        ]); ?>
    </div>
    <?php endif; ?>

    <!-- Treść -->
    <section class="pb-20 md:pb-28">
        <div class="max-w-2xl mx-auto px-6">

            <div class="post-content text-base">
                <?php the_content(); ?>
            </div>

            <!-- Tagi -->
            <?php
            $tags = get_the_tags();
            if ($tags) :
            ?>
            <div class="flex flex-wrap gap-2 mt-12 pt-8 border-t border-slate-100">
                <?php foreach ($tags as $tag) : ?>
                    <a href="<?php echo esc_url(get_tag_link($tag)); ?>"
                       class="text-xs font-medium text-slate-500 bg-slate-100 hover:bg-emerald-50 hover:text-emerald-700 px-3 py-1.5 rounded-full transition-colors">
                        #<?php echo esc_html($tag->name); ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- Powrót -->
            <div class="<?php echo $tags ? 'mt-8' : 'border-t border-slate-100 mt-12 pt-10'; ?>">
                <a href="<?php echo esc_url($blog_url); ?>"
                   class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-slate-900 transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4 stroke-[1.5]"></i>
                    Powrót do <?php echo esc_html($blog_label); ?>
                </a>
            </div>

        </div>
    </section>

</main>

<?php get_footer(); ?>
