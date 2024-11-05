<?php
$principal_category_id = get_cat_ID('opinion');
$subcategory_id = get_cat_ID('editorial');
$not_subcategory_id = get_cat_ID('opiniones'); // slug de la subcategoria para el estilo de opiniones

$paged = isset($_POST['page']) ? $_POST['page'] : 1;

$args = array(
    'category__in' => [$principal_category_id, $subcategory_id],
    'category__not_in' => [$not_subcategory_id],
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $paged
);

$editorial_query = new WP_Query($args);


if ($editorial_query->have_posts()):
    $post_counter = 0;
    while ($editorial_query->have_posts()):
        $editorial_query->the_post();
        $post_counter++;
        $first_interview_first_post = $post_counter == 1 ? ' pespectives-first-post-interview' : '';

        ?>
        <h6 class="focostv-perspectives-category perspectives-page-category">
            Editorial
        </h6>
        <div class="focostv-front-page-post-item<?php echo $first_interview_first_post; ?>">
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
                $custom_text = 'Leer editorial';
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

    echo '<div class="focostv-pagination-container focostv-opinion-pagination">';
    $pagination = paginate_links(array(
        'total' => $editorial_query->max_num_pages,
        'current' => $paged,
        'prev_text' => '<i class="fa-solid fa-angle-left"></i>',
        'next_text' => '<i class="fa-solid fa-angle-right"></i>',
        'format' => '?paged=%#%',
        'base' => add_query_arg('paged', '%#%'),
        'end_size' => 2,
        'mid_size' => 1,
        'type' => 'list'
    ));
    
    $pagination = str_replace('page-numbers', 'focostv-pagination', $pagination);
    $pagination = str_replace('prev', 'prev focostv-pagination-prev', $pagination);
    $pagination = str_replace('next', 'next focostv-pagination-next', $pagination);
    
    echo $pagination;
    echo '</div>';

else:
    echo 'NO hay posts';
endif;

wp_reset_postdata();
?>