<?php
$args = array(
    'category_name' => 'portada',
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order' => 'DESC'
);

$portada_query = new WP_Query($args);

if ($portada_query->have_posts()):
    $post_counter = 0;
    while ($portada_query->have_posts()):
        $portada_query->the_post();
        $post_counter++;
        ?>
        <div class="focostv-front-page-post-item">
            <?php if (has_post_thumbnail()): ?>
                <div class="focostv-front-page-post-thumbnail">
                    <a href="<?php the_permalink(); ?>"><?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'full'); ?></a>
                </div>
            <?php endif; ?>
            <div class="focostv-front-page-post">
                <h2 class="focostv-front-page-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php if ($post_counter == 1): ?>
                    <div class="focostv-front-page-post-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                <?php endif; ?>
                <div class="focostv-front-page-post-link">
                    <a href="<?php the_permalink(); ?>">Leer nota <i class="fa-solid fa-up-right-from-square"></i></a>
                </div>
            </div>
        </div>

    <?php endwhile;
else:
    echo '<p>No hay posts en la categoría PORTADA.</p>';
endif;

// Resetear postdata
wp_reset_postdata();
?>