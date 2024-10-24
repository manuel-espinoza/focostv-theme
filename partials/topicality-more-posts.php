<?php
if (isset($args['actualidad_query'])) {
    $actualidad_query = $args['actualidad_query'];
}

if ($actualidad_query->have_posts()) {
    $post_counter = 0;
    while ($actualidad_query->have_posts()) {
        $actualidad_query->the_post();
        $post_counter++;
        $first_post_topicality_class = ($post_counter == 1 || $post_counter == 6) ? " focostv-basic-page-first-post" : "";
        ?>
        <div class="focostv-front-page-post-item focostv-basic-page-post-item <?php echo $first_post_topicality_class; ?>">
            <div class="focostv-front-page-post">
                <h2 class="focostv-front-page-post-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <?php if ($post_counter == 1 || $post_counter == 6): ?>
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
        <?php if ($post_counter == 1): ?>
            <div class="focostv-main-advertisement">
                <?php echo do_shortcode('[the_ad id="14655"]'); ?>
            </div>
        <?php endif; ?>
    <?php
    }
} else {
    echo '<span style="font-family: "Inter", sans-serif;">No hay mas publicaciones que mostrar</span>';
}
