<?php
$is_frontpage = get_query_var('is_frontpage');
?>

<h3 class="focostv-sections-title">
    <a href="<?php echo get_permalink(get_page_by_path('investigacion')); ?>">Investigaciones
    </a>
    <div class="goto-page-icon"><!-- https://feathericons.dev/?search=arrow-up-right&iconset=feather -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon"
            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
            <line x1="7" x2="17" y1="17" y2="7" />
            <polyline points="7 7 17 7 17 17" />
        </svg>
    </div>
</h3>

<div class="focostv-research-carousel-container">
    <div class="focostv-research-carousel">
        <?php
        $args = array(
            'category_name' => 'investigacion',
            'orderby' => 'date',
            'order' => 'DESC'
        );

        if ($is_frontpage) {
            $args['posts_per_page'] = 3; // Revisar si se puede mantener esto para ambos diseños
        }

        $investigacion_query = new WP_Query($args);

        if ($investigacion_query->have_posts()):
            while ($investigacion_query->have_posts()):
                $investigacion_query->the_post();
                ?>
                <div class="focostv-research-carousel-card focostv-research-post-item">
                    <?php if (has_post_thumbnail()): ?>
                        <div class="focostv-research-post-thumbnail">
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
                    <h3 class="focostv-research-post-title focostv-front-page-post-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <p class="focostv-research-post-extract"><?php echo wp_trim_words(get_the_content(), 20, '...'); ?></p>
                    <div class="focostv-research-goto-post-container">
                        <?php
                        $permalink = get_permalink();
                        $custom_text = 'Leer investigación';
                        get_template_part('components/read-more-post', null, array('permalink' => $permalink, 'custom_text' => $custom_text));
                        ?>
                    </div>
                </div>
                <?php
            endwhile;
        else:
            echo '<p>No hay posts en la categoría INVESTIGACION.</p>';
        endif;

        wp_reset_postdata();
        ?>
    </div>

    <div class="focostv-research-carousel-buttons">
        <button class="focostv-research-carousel-prev">
            <div class="focostv-research-carousel-prev-container">
                <!-- https://feathericons.dev/?search=arrow-left-circle&iconset=feather -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                    class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <polyline points="12 8 8 12 12 16" />
                    <line x1="16" x2="8" y1="12" y2="12" />
                </svg>
            </div>
        </button>
        <div class="focostv-research-carousel-indicators">
            <?php
            for ($i = 1; $i <= $investigacion_query->post_count; $i++): ?>
                <span class="focostv-research-carousel-dot" onclick="currentSlide(<?php echo $i; ?>)"></span>
            <?php endfor; ?>
        </div>
        <button class="focostv-research-carousel-next">
            <div class="focostv-research-carousel-next-container">
                <!-- https://feathericons.dev/?search=arrow-right-circle&iconset=feather -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                    class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <polyline points="12 16 16 12 12 8" />
                    <line x1="8" x2="16" y1="12" y2="12" />
                </svg>
            </div>
        </button>
    </div>

</div>