<div class="multimedia-podcasts-posts-container">
    <div class="multimedia-podcasts-title-container">
        <div class="multimedia-podcasts-title-icon">
            <i class="fa-brands fa-spotify"></i>
        </div>
        <h2 class="podcasts-posts-container-title">
            Podcast
        </h2>
    </div>
    <?php
    $principal_category_id = get_cat_ID('multimedia');
    $subcategory_id = get_cat_ID('podcasts'); // slug de la subcategoria para el estilo de opiniones
    
    $args = array(
        'category__in' => [$subcategory_id],
        'posts_per_page' => 5,
        'orderby' => 'date',
        'order' => 'DESC',
    );

    $multimedia_podcast_query = new WP_Query($args);

    if ($multimedia_podcast_query->have_posts()):
        while ($multimedia_podcast_query->have_posts()):
            $multimedia_podcast_query->the_post();
            ?>
            <div class="focostv-podcast-post-item">
                <?php if (has_post_thumbnail()): ?>
                    <div class="focostv-podcast-post-thumbnail-image">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                <?php endif; ?>
                <div class="focostv-podcast-post-thumbnail-legend">
                    <h3 class="focostv-podcast-post-title"><?php the_title(); ?></h3>
                    <?php
                    $podcast_duration = get_field('duracion_podcast');
                    if ($podcast_duration):
                        ?>
                        <p class="focostv-podcast-post-duration"><?php echo "{$podcast_duration}min."; ?> </p>
                        <?php
                    endif;
                    $permalink = get_permalink();
                    $custom_text = 'Escuchar';
                    get_template_part('components/read-more-post', null, array('permalink' => $permalink, 'custom_text' => $custom_text));
                    ?>
                </div>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
    else:
        echo '<span class="no-posts"></span>';
    endif;
    ?>
</div>