<?php
$principal_category_id = get_cat_ID('multimedia');
$not_subcategory_id = get_cat_ID('podcasts'); // slug de la subcategoria para el estilo de opiniones

$paged = isset($_POST['page']) ? $_POST['page'] : 1;

$args = array(
    'category__in' => [$principal_category_id],
    'category__not_in' => [$not_subcategory_id],
    'posts_per_page' => 5,
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $paged
);

$multimedia_query = new WP_Query($args);

if ($multimedia_query->have_posts()):
    $post_counter = 0;
    while ($multimedia_query->have_posts()):
        $multimedia_query->the_post();
        $post_counter++;
        $multimedia_first_post = $post_counter == 1 ? ' multimedia-first-post-video' : '';

        ?>
        <div class="focostv-front-page-post-item<?php echo $multimedia_first_post; ?>">
            <div class="focostv-front-page-post focostv-documentaries-post">
                <h2 class="focostv-front-page-post-title focostv-documentaries-post-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <?php if ($post_counter == 1): ?>
                    <div class="focostv-front-page-post-excerpt focostv-documentaries-post-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                <?php endif; ?>
                <?php
                $permalink = get_permalink();
                $custom_text = 'Ver contenido';
                get_template_part('components/read-more-post', null, array('permalink' => $permalink, 'custom_text' => $custom_text));
                ?>
            </div>
            <?php if (has_post_thumbnail()): ?>
                <div class="focostv-front-page-post-thumbnail">
                    <a href="<?php the_permalink(); ?>">
                        <picture>
                            <source media="(max-width: 639px)"
                                srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'small'); ?>">
                            <source media="(min-width: 640px) and (max-width: 1023px)"
                                srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>">
                            <source media="(min-width: 1024px) and (max-width: 1439px)"
                                srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>">
                            <source media="(min-width: 1440px)"
                                srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>">
                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>"
                                alt="<?php the_title_attribute(); ?>" loading="eager">
                        </picture>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <?php
    endwhile;

else:
    echo '<span class="no-posts"></span>';
endif;

wp_reset_postdata();
?>