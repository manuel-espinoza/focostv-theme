<?php
/*
Template Name: Investigacion Page
*/
get_header(); ?>
<main class="focostv-site-page">
    <div class="focostv-go-home-container">
        <i class="fa-solid fa-chevron-left"></i>
        <a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a>
    </div>
    <h3 class="focostv-sections-title focostv-page-title"><a>Investigaci&oacute;n</a>
    </h3>
    <?php
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $args = array(
        'category_name' => 'investigacion',
        'orderby' => 'date',
        'order' => 'DESC',
        'paged' => $paged,
        'post_per_page' => 10,
    );

    $investigacion_query = new WP_Query($args);
    ?>

    <div id="focostv-research-posts-container" class="focostv-research-post-container" data-max-pages="<?php echo $investigacion_query->max_num_pages;?>">
        <?php
        if ($investigacion_query->have_posts()):
            $post_counter = 0;
            while ($investigacion_query->have_posts()):
                $investigacion_query->the_post();
                $post_counter++;
                $is_research_page = $post_counter == 1 || $post_counter == 6;
                $first_post_research_class = $is_research_page ? " focostv-basic-page-first-post" : "";
                ?>
                <div class="focostv-front-page-post-item focostv-basic-page-post-item<?php echo $first_post_research_class; ?>">
                    <div class="focostv-front-page-post">
                        <h2 class="focostv-front-page-post-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <?php if ($is_research_page): ?>
                            <div class="focostv-front-page-post-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        <?php endif; ?>
                        <?php
                        $permalink = get_permalink();
                        $custom_text = 'Leer nota';
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
                if ($post_counter == 1) {
                    ?>
                    <div class="focostv-main-advertisement">
                        <img src="https://stage.focostv.com/wp-content/uploads/2024/10/focostv_ad.png" alt="Anuncio">
                    </div>
                    <?php
                }
            endwhile;
        else:
            echo '<p>No hay posts en la categoría INVESTIGACION.</p>';
        endif;
        ?>
    </div>

    <?php
    $pagination_args = array(
        'total' => $investigacion_query->max_num_pages,
        'current' => $paged,
        'prev_text' => '<i class="fa-solid fa-angle-left"></i>',
        'next_text' => '<i class="fa-solid fa-angle-right"></i>',
        'end_size' => 2,
        'mid_size' => 1,
        'type' => 'list',
    );
    echo '<div class="focostv-pagination-container">';
    echo paginate_links($pagination_args);
    echo '</div>';
    ?>
    <div id="focostv-load-more-posts" style="display: none;">
        <i class="fa-solid fa-spinner fa-spin"></i>
    </div>
    <div class="focostv-footer-advetisement">
        <img src="https://stage.focostv.com/wp-content/uploads/2024/10/focostv_end_ad.png" alt="Anuncio">
    </div>
</main>
<?php get_footer();
?>