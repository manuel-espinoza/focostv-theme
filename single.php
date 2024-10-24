<?php get_header(); ?>

<?php
if (have_posts()):
    while (have_posts()):
        the_post();

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
        if ($category_slug === 'documentales'):
            get_template_part('components/documentaries-single-post');
        else:
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
                    <div class="focostv-post-header-information">
                        <?php
                        $opinion_author = get_field('autor_opinion');
                        $opinion_avatar_author = get_field('imagen_autor_opinion');
                        if ($opinion_author && $opinion_avatar_author) {

                            ?>
                            <div class="focostv-perspectives-post-author">
                                <img src="<?php echo esc_url($opinion_avatar_author['url']); ?>"
                                    alt="<?php echo esc_attr($opinion_author); ?>" width="60" height="60"
                                    class="focostv-perspectives-post-author-avatar">
                                <span class="focostv-perspectives-post-by-author">Por&nbsp;</span>
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
                    </div>
                </header>
                <?php
                get_template_part('components/multimedia-elements-post');

                // for legacy support
                $tie_post_subtitle = get_post_meta(get_the_ID(), 'tie_post_sub_title', true);
                $subtitle = !empty($tie_post_subtitle) ? $tie_post_subtitle : get_field('subtitulo');
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
                    <?php echo do_shortcode('[focostv_ad type="mobile" location="posts"]'); ?>
                </div>
                <!-- FOCOSTV AD -->

                <div class="focostv-post-content">
                    <?php the_content(); ?>
                </div>

                <div class="focostv-post-comments-container">
                    <a href="<?php echo get_permalink(get_page_by_path('comentarios')); ?>?post_id=<?php echo get_the_ID(); ?>"
                        id="focostsv-post-comments-button" class="focostsv-post-comments-button">
                        <!-- https://feathericons.dev/?search=message-circle&iconset=feather -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                            class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2">
                            <path
                                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" />
                        </svg>
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
                            <span class="focostv-perspectives-post-author-name">&nbsp;<?php echo esc_html($opinion_author); ?></span>
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
                        $author_id = get_the_author_meta('ID');
                        $instagram = get_the_author_meta('instagram', $author_id);
                        $twitter = get_the_author_meta('twitter', $author_id);
                        $youtube = get_the_author_meta('youtube', $author_id);
                        ?>
                        <div class="focostv-post-author-social-media">
                            <?php if ($instagram): ?>
                                <a href="<?php echo esc_url($instagram); ?>" target="_blank"
                                    class="focostv-author-social-media-button instagram-author">
                                    Instagram
                                </a>
                            <?php endif; ?>

                            <?php if ($twitter): ?>
                                <a href="<?php echo esc_url($twitter); ?>" target="_blank"
                                    class="focostv-author-social-media-button twitter-author">
                                    X
                                </a>
                            <?php endif; ?>

                            <?php if ($youtube): ?>
                                <a href="<?php echo esc_url($youtube); ?>" target="_blank"
                                    class="focostv-author-social-media-button youtube-author">
                                    YouTube
                                </a>
                            <?php endif; ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <div class="focostv-post-whatsapp-subscription">
                    <?php echo do_shortcode('[focostv_whatsapp_subscription]'); ?>
                </div>

                <div class="focostv-related-posts">
                    <h3 class="focostv-related-posts-title">Notas Relacionadas</h3>
                    <?php

                    $categories = wp_get_post_categories(get_the_ID());

                    if ($categories) {

                        $related_args = array(
                            'category__in' => $categories,
                            'post__not_in' => array(get_the_ID()),
                            'posts_per_page' => 3,
                            'ignore_sticky_posts' => 1,
                        );


                        $related_query = new WP_Query($related_args);

                        if ($related_query->have_posts()) {
                            echo '<ul class="focostv-related-posts-list">';
                            while ($related_query->have_posts()) {
                                $related_query->the_post();
                                ?>
                                <li>
                                    <a href="<?php the_permalink(); ?>" class="focostv-related-post-link">
                                        <div class="focostv-related-post-content">
                                            <h4 class="focostv-related-post-title"><?php the_title(); ?></h4>
                                        </div>
                                        <?php if (has_post_thumbnail()): ?>
                                            <div class="focostv-related-post-thumbnail">
                                                <?php the_post_thumbnail('thumbnail'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                </li>
                                <?php
                            }
                            echo '</ul>';
                        }
                        wp_reset_postdata();
                    }
                    ?>
                </div>
            </article>
            <?php
        endif;
    endwhile;
else:
    echo '<p>No se encontró el post.</p>';
endif;
?>
<?php get_footer(); ?>