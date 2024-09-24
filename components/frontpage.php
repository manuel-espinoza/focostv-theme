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

        $frontpage_post_class = ($post_counter == 1) ? ' full-width-front-page-post front-page-first-post' : ' half-width-front-page-post';
        ?>
        <div class="focostv-front-page-post-item<?php echo $frontpage_post_class; ?>">
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
            <?php if (has_post_thumbnail()): ?>
                <div class="focostv-front-page-post-thumbnail">
                    <a href="<?php the_permalink(); ?>">
                        <?php
                        the_post_thumbnail('full', array(
                            'srcset' => wp_get_attachment_image_srcset(get_post_thumbnail_id(), 'full'),
                            'sizes' => '(max-width: 1023px) 300px, 9999',
                            'alt' => get_the_title(),
                        ));
                        ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>

    <?php endwhile;
else:
    echo '<p>No hay posts en la categoría PORTADA.</p>';
endif;

// Resetear postdata
wp_reset_postdata();
?>