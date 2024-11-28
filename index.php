<?php get_header(); ?>
<main>
    <?php
    if (is_search()):
        $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
        ?>

        <section class="focostv-site-search-results">
            <h3 class="focostv-sections-title focostv-search-result-title">
                <span class="search-result-description">Resultados
                    de&nbsp;</span><?php echo esc_html(get_search_query()); ?>
            </h3>
            <?php if (have_posts()): ?>
                <div class="focostv-search-results-post-container">
                    <?php while (have_posts()):
                        the_post(); ?>
                        <div class="focostv-front-page-post-item">
                            <div class="focostv-front-page-post">
                                <h2 class="focostv-front-page-post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
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
                    <?php endwhile; ?>
                </div>
                <?php
                $pagination_args = array(
                    'total' => $wp_query->max_num_pages,
                    'current' => $paged,
                    'prev_text' => '<i class="fa-solid fa-angle-left"></i>',
                    'next_text' => '<i class="fa-solid fa-angle-right"></i>',
                    'end_size' => 2,
                    'mid_size' => 1,
                    'type' => 'list',
                );
                echo '<div class="focostv-pagination-container focostv-search-pagination">';
                echo paginate_links($pagination_args);
                echo '</div>';
                ?>
            <?php else: ?>
                <p class="focostv-no-search-description">No se encontraron resultados.</p>
            <?php endif; ?>
        </section>
    <?php else: ?>
        <section class="focostv-section-front-page focostv-section-container">
            <?php get_template_part('components/frontpage'); ?>
        </section>
        <section class="focostv-section-topicality focostv-section-container">
            <?php
            set_query_var('is_frontpage', (is_front_page() || is_home()));
            get_template_part('components/topicality-posts');
            ?>
        </section>
        <section class="focostv-section-research focostv-section-container">
            <?php
            set_query_var('is_frontpage', (is_front_page() || is_home()));
            get_template_part('components/research-posts');
            ?>
        </section>
        <section class="focostv-section-documentaries focostv-section-container">
            <?php
            set_query_var('is_frontpage', (is_front_page() || is_home()));
            get_template_part('components/documentaries-posts');
            ?>
        </section>
        <section class="focostv-section-perspectives focostv-section-container">
            <?php
            set_query_var('is_frontpage', (is_front_page() || is_home()));
            get_template_part('components/perspectives-posts');
            ?>
        </section>
    <?php endif; ?>
</main>
<?php get_footer(); ?>