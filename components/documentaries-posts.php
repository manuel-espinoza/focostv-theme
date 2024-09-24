<?php
$is_frontpage = get_query_var('is_frontpage');
$frontpage_documentaries_post_class = '';
?>

<h3 class="focostv-sections-title focostv-frontpage-documentaries-title"><a
        href="<?php echo get_permalink(get_page_by_path('documentales')); ?>">Documentales
    </a>
    <div class="goto-page-icon"><!-- https://feathericons.dev/?search=arrow-up-right&iconset=feather -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon"
            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
            <line x1="7" x2="17" y1="17" y2="7" />
            <polyline points="7 7 17 7 17 17" />
        </svg>
    </div>
</h3>

<?php
$args = array(
    'category_name' => 'documentales',
    'orderby' => 'date',
    'order' => 'DESC'
);

if ($is_frontpage) {
    $args['posts_per_page'] = 3;
    // $frontpage_topicality_post_class = 'focostv-front-page-topicality';
    // $frontpage_topicality_post_item_class = ' focostv-front-page-topicality-post-item';
}

$documentales_query = new WP_Query($args);

if ($documentales_query->have_posts()):
    $post_counter = 0;
    while ($documentales_query->have_posts()):
        $documentales_query->the_post();
        $post_counter++;
        $frontpage_post_class = ($post_counter == 1) ? ' full-width-front-page-documentaries-post front-page-documentaries-first-post' : ' half-width-front-page-documentaries-post';
        ?>
        <div class="focostv-documentaries-post-item<?php echo $frontpage_post_class; ?>">
            <?php if (has_post_thumbnail()): ?>
                <div class="focostv-documentaries-post-thumbnail">
                    <a href="<?php the_permalink(); ?>">
                        <?php
                        the_post_thumbnail('full', array(
                            'srcset' => wp_get_attachment_image_srcset(get_post_thumbnail_id(), 'full'),
                            'sizes' => '(max-width: 1023px) 300px, 9999',
                            'alt' => get_the_title(),
                        ));
                        ?>
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
                    60Min.
                </h6>
                <div class="focostv-documentaries-post-excerpt">
                    <?php the_excerpt(); ?>
                </div>
            </div>
        </div>
    <?php endwhile;
else:
    echo '<p>No hay posts en la categoría DOCUMENTALES.</p>';
endif;

// Resetear postdata
wp_reset_postdata();
?>