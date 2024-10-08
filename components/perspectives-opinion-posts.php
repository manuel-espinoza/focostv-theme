<?php
$args = array(
    'category_name' => 'opiniones',
    'posts_per_page' => 3, // TODO: pending load the correct number of posts
    'orderby' => 'date',
    'order' => 'DESC'
);

$opiniones_query = new WP_Query($args);

if ($opiniones_query->have_posts()):
    while ($opiniones_query->have_posts()):
        $opiniones_query->the_post();
        ?>
        <div class="focostv-perspectives-page-post-item">
            <h6 class="focostv-perspectives-category perspectives-page-category">
                Opini&oacute;n
            </h6>
            <div class="focostv-perspectives-post">
                <h2 class="focostv-front-page-post-title focostv-perspectives-post-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
            </div>
            <?php
            $opinion_author = get_field('autor_opinion');
            $opinion_avatar_author = get_field('imagen_autor_opinion');
            if ($opinion_author && $opinion_avatar_author) {

                ?>
                <div class="focostv-perspectives-post-author">
                    <img src="<?php echo esc_url($opinion_avatar_author['url']); ?>" alt="<?php echo esc_attr($opinion_author); ?>"
                        width="60" height="60" class="focostv-perspectives-post-author-avatar">
                    <span class="focostv-perspectives-post-author-name"><?php echo esc_html($opinion_author); ?></span>
                </div>
                <?php
            } else {
                ?>
                <div class="focostv-perspectives-post-author">
                    <?php echo get_avatar(get_the_author_meta('ID'), 60); ?>
                    <span class="focostv-perspectives-post-author-name"><?php echo esc_html(get_the_author()); ?></span>
                </div>
                <?php
            }
            ?>
        </div>

        <?php
    endwhile;
else:
    echo 'NO hay posts';
endif;
?>