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
        <div class="focostv-front-page-post-item focostv-multimedia-page-post-item<?php echo $multimedia_first_post; ?>">
            <div class="focostv-front-page-post focostv-documentaries-post">
                <h2 class="focostv-front-page-post-title focostv-documentaries-post-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <h6 class="focostv-documentaries-post-time">
                    <?php
                    $duracion = get_field('duracion_de_documental');
                    if ($duracion) {
                        echo esc_html($duracion) . ' Min.';
                    }
                    ?>
                </h6>
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
                <div class="focostv-front-page-post-thumbnail focostv-documentaries-post-thumbnail">
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
                        <div class="focostv-documentaries-play-icon-overlay">
                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="60" height="60" rx="30" fill="white" />
                                <path
                                    d="M30 40C35.5228 40 40 35.5228 40 30C40 24.4772 35.5228 20 30 20C24.4772 20 20 24.4772 20 30C20 35.5228 24.4772 40 30 40Z"
                                    stroke="#0F0F0F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M28 26L34 30L28 34V26Z" stroke="#0F0F0F" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <?php
    endwhile;
    echo '<div class="focostv-pagination-container focostv-multimedia-pagination">';
    $pagination = paginate_links(array(
        'total' => $multimedia_query->max_num_pages,
        'current' => $paged,
        'prev_text' => '<i class="fa-solid fa-angle-left"></i>',
        'next_text' => '<i class="fa-solid fa-angle-right"></i>',
        'format' => '?paged=%#%',
        'base' => add_query_arg('paged', '%#%'),
        'end_size' => 1,
        'mid_size' => 0,
        'type' => 'list'
    ));
    
    $pagination = str_replace('page-numbers', 'focostv-pagination', $pagination);
    $pagination = str_replace('prev', 'prev focostv-pagination-prev', $pagination);
    $pagination = str_replace('next', 'next focostv-pagination-next', $pagination);
    
    echo $pagination;
    echo '</div>';

else:
    echo '<span class="no-posts"></span>';
endif;

wp_reset_postdata();
?>