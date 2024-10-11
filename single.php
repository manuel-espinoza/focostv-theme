<?php get_header(); ?>

<?php
if (have_posts()):
    while (have_posts()):
        the_post();

        $categories = get_the_category();
        $category_link = '';

        if (!empty($categories)) {
            foreach ($categories as $category) {
                if ($category->slug !== 'portada' && strpos($category->slug, 'portada-') !== 0) {
                    $category_link = get_category_link($category->term_id);
                    $category_name = strtolower($category->name);
                    break;
                }
            }
        }
        ?>
        <article id="focostv-post-<?php the_ID(); ?>" class="focostv-single-post">
            <header class="focostv-post-header">
                <?php if (!empty($category_link)): ?>
                    <div class="focostv-go-home-container">
                        <i class="fa-solid fa-chevron-left"></i>
                        <a href="<?php echo esc_url($category_link); ?>"><?php echo ucwords($category_name); ?></a>
                    </div>
                <?php endif; ?>
                <h1 class="focostv-post-title"><?php the_title(); ?></h1>
                <?php
                $opinion_author = get_field('autor_opinion');
                $opinion_avatar_author = get_field('imagen_autor_opinion');
                if ($opinion_author && $opinion_avatar_author) {

                    ?>
                    <div class="focostv-perspectives-post-author">
                        <img src="<?php echo esc_url($opinion_avatar_author['url']); ?>"
                            alt="<?php echo esc_attr($opinion_author); ?>" width="60" height="60"
                            class="focostv-perspectives-post-author-avatar">
                        <span class="focostv-perspectives-post-by-author">Por</span>
                        <span class="focostv-perspectives-post-author-name"><?php echo esc_html($opinion_author); ?></span>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="focostv-perspectives-post-author">
                        <?php echo get_avatar(get_the_author_meta('ID'), 60); ?>
                        <span class="focostv-perspectives-post-by-author">Por&nbsp;</span>
                        <span class="focostv-perspectives-post-author-name"><?php echo esc_html(get_the_author()); ?></span>
                    </div>
                    <?php
                }
                $post_location = get_field('ubicacion_publicacion');
                ?>
                <div class="focostv-post-location-date-container">
                    <?php if ($post_location): ?><span class="focostv-post-location"><?php echo $post_location; ?>,</span>
                    <?php endif; ?>
                    <span class="focostv-post-date"><?php echo get_the_date('d \d\e F \d\e Y'); ?></span>
                </div>
            </header>
            <?php
            get_template_part('components/multimedia-elements-post');

            $subtitle = get_field('subtitulo');
            ?>
            <?php if ($subtitle): ?>
                <div class="focostv-post-subtitle-container">
                    <p class="focostv-post-subtitle">
                        <?php echo $subtitle; ?>
                    </p>
                </div>
            <?php endif; ?>
            <?php if (has_post_thumbnail()): ?>
                <div class="focostv-post-thumbnail">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <!-- FOCOSTV AD -->
            <div class="focostv-post-advertisement">
                <img src="https://stage.focostv.com/wp-content/uploads/2024/10/Group-6.png" alt="Anuncio">
            </div>
            <!-- FOCOSTV AD -->

            <div class="focostv-post-content">
                <?php the_content(); ?>
            </div>

            <div class="focostv-post-comments-container">
                <a href="#comments" id="focostsv-post-comments-button" class="focostsv-post-comments-button">
                    <?php
                    $comments_number = get_comments_number();
                    echo $comments_number . ' ' . _n('Comentario', 'Comentarios', $comments_number);
                    ?>
                </a>
            </div>

            <div class="focostv-post-author">
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
                        <span class="focostv-perspectives-post-author-name"><?php echo esc_html(get_the_author()); ?></span>
                    </div>
                    <div class="focostv-post-author-description">
                        <p><?php echo esc_html(get_the_author_meta('description')); ?></p>
                    </div>
                    <?php
                }
                ?>
            </div>

        </article>
        <?php
    endwhile;
else:
    echo '<p>No se encontró el post.</p>';
endif;
?>

<?php get_footer(); ?>