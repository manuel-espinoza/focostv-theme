<?php
// entrevistas-perspectivas
$args = array(
    'category_name' => 'entrevistas-perspectivas',
    'posts_per_page' => 3, // TODO: pending load the correct number of posts
    'orderby' => 'date',
    'order' => 'DESC'
);

$entrevistas_query = new WP_Query($args);


if ($entrevistas_query->have_posts()):
    $post_counter = 0;
    while ($entrevistas_query->have_posts()):
        $entrevistas_query->the_post();
        $post_counter++;
        $first_interview_first_post = $post_counter == 1 ? ' pespectives-first-post-interview' : '';

        ?>
        <div class="focostv-front-page-post-item<?php echo $first_interview_first_post; ?>">
            <!-- <h6 class="focostv-perspectives-category perspectives-page-category">
                Entrevista
            </h6> -->
            <div class="focostv-front-page-post">
                <h2 class="focostv-front-page-post-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <?php if ($post_counter == 1): ?>
                    <div class="focostv-front-page-post-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                <?php endif; ?>
                <?php
                $permalink = get_permalink();
                $custom_text = 'Leer entrevista';
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
    echo 'NO hay posts';
endif;
?>