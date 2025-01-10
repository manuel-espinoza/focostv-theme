<?php
$categories = get_the_category();
$category_link = '';
$category_slug = '';

if (!empty($categories)) {
    foreach ($categories as $category) {
        if ($category->slug !== 'portada' && strpos($category->slug, 'portada-') !== 0) {
            $category_name = strtolower($category->name);
            $category_link = home_url("/$category_name");
            $category_slug = $category->slug;
            break;
        }
    }
}
?>

<article id="focostv-post-<?php the_ID(); ?>" class="focostv-single-documentaries-post">
    <header class="focostv-documentaries-post-header">
        <?php if (!empty($category_link)): ?>
            <div class="focostv-go-home-container focostv-go-home-container-documentaries">
                <i class="fa-solid fa-chevron-left"></i>
                <a href="<?php echo esc_url($category_link); ?>"><?php echo ucwords($category_name); ?></a>
            </div>
        <?php endif; ?>
        <h1 class="focostv-post-title focostv-post-documentaries-title"><?php the_title(); ?></h1>
    </header>

    <div class="focostv-post-content focostv-documentaries-post-content">
        <?php the_content(); ?>
    </div>
    <section class="documentaries-post-footer">
        <div class="focostv-post-author focostv-documentaries-post-authors">
            <h3 class="focostv-documentaries-posts-authors-title">Cr&eacute;ditos</h3>
            <?php
            $opinion_author = get_field('autor_opinion');
            $opinion_avatar_author = get_field('imagen_autor_opinion');
            $opinion_author_description = get_field('descripcion_autor');
            if ($opinion_author && $opinion_avatar_author) {

                ?>
                <div class="focostv-perspectives-post-author">
                    <img src="<?php echo esc_url($opinion_avatar_author['url']); ?>"
                        alt="<?php echo esc_attr($opinion_author); ?>" width="60" height="60"
                        class="focostv-perspectives-post-author-avatar">
                    <span class="focostv-perspectives-post-author-name"><?php echo esc_html($opinion_author); ?></span>
                </div>
                <div class="focostv-post-author-description">
                    <p><?php echo $opinion_author_description; ?></p>
                </div>
                <?php
            } else {
                ?>
                <div class="focostv-perspectives-post-author">
                    <?php echo get_avatar(get_the_author_meta('ID'), 60); ?>
                    <span class="focostv-perspectives-post-author-name">
                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                            <?php echo esc_html(get_the_author()); ?>
                        </a>
                    </span>
                </div>
                <div class="focostv-post-author-description">
                    <p><?php echo esc_html(get_the_author_meta('description')); ?></p>
                </div>
                <?php
            }
            ?>
        </div>

        <div class="focostv-coffee-donations-container">
        </div>
    </section>
</article>