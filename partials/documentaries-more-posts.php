<?php
if (isset($args['documentales_query'])) {
    $documentales_query = $args['documentales_query'];
}
function get_post_classes($is_frontpage, $post_counter)
{
    $base_class = $is_frontpage ? ' front-page-documentaries-' : ' documentaries-';
    $type_class = ($post_counter == 1) ? 'first-post' : 'secondary-post';
    return $base_class . $type_class;
}

if ($documentales_query->have_posts()):
    $post_counter = 0;
    while ($documentales_query->have_posts()):
        $documentales_query->the_post();
        $post_counter++;
        $post_item_class = 'focostv-documentaries-page-post-item';
        $frontpage_post_class = get_post_classes(false, $post_counter);
        ?>
        <div class="<?php echo $post_item_class . $frontpage_post_class; ?>">
            <?php if (has_post_thumbnail()): ?>
                <div class="focostv-documentaries-post-thumbnail">
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
            <div class="focostv-documentaries-post">
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
                <div class="focostv-documentaries-post-excerpt">
                    <?php the_excerpt(); ?>
                </div>
                <div class="focostv-documentaries-post-link">
                    <a href="<?php the_permalink(); ?>">Reproducir</a>
                    <div class="goto-documentarie-icon">
                        <!-- https://feathericons.dev/?search=play-circle&iconset=feather -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                            class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <polygon points="10 8 16 12 10 16 10 8" />
                        </svg>

                    </div>
                </div>
            </div>
        </div>
        <?php
        if ($post_counter == 1) {
            ?>
            <div class="focostv-main-advertisement-documentaries">
                <?php echo do_shortcode('[focostv_ad type="mobile" location="pages"]'); ?>
            </div>
            <?php
        }
    endwhile;
else:
    echo '<span style="font-family: "Inter", sans-serif;">No hay mas publicaciones que mostrar</span>';
    ;
endif;