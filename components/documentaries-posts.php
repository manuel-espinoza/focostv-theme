<?php
$is_frontpage = get_query_var('is_frontpage');
$frontpage_documentaries_post_class = '';

function get_post_classes($is_frontpage, $post_counter)
{
    $base_class = $is_frontpage ? ' front-page-documentaries-' : ' documentaries-';
    $type_class = ($post_counter == 1) ? 'first-post' : 'secondary-post';
    return $base_class . $type_class;
}
?>

<h3
    class="focostv-sections-title<?php echo $is_frontpage ? ' focostv-frontpage-documentaries-title' : ' focostv-header-documentaries focostv-page-title' ?>">
    <a <?php echo $is_frontpage ? 'href="' . get_permalink(get_page_by_path('multimedia')) . '"' : ''; ?>>Multimedia
    </a>
    <?php if ($is_frontpage): ?>
        <div class="goto-page-icon"><!-- https://feathericons.dev/?search=arrow-up-right&iconset=feather -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon"
                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                <line x1="7" x2="17" y1="17" y2="7" />
                <polyline points="7 7 17 7 17 17" />
            </svg>
        </div>
    <?php endif; ?>
</h3>

<?php
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$args = array(
    'category_name' => 'multimedia',
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $paged
);

if ($is_frontpage) {
    $args['posts_per_page'] = 3;
    $frontpage_documentaries_post_class = 'focostv-front-page-documentaries';
} else {
    $args['posts_per_page'] = 10;
    $frontpage_documentaries_post_class = 'focostv-page-documentaries';
}

$documentales_query = new WP_Query($args);

echo "<div id='focostv-documentaries-posts-container' class='focostv-documentaries-post-container $frontpage_documentaries_post_class' data-max-pages='{$documentales_query->max_num_pages}'>";
if ($documentales_query->have_posts()):
    $post_counter = 0;
    while ($documentales_query->have_posts()):
        $documentales_query->the_post();
        $post_counter++;
        $post_item_class = $is_frontpage ? 'focostv-documentaries-post-item' : 'focostv-documentaries-page-post-item';
        $frontpage_post_class = get_post_classes($is_frontpage, $post_counter);
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
        if (!$is_frontpage && $post_counter == 1) {
            ?>
            <div class="focostv-main-advertisement-documentaries" style="display: none;">
                <?php echo do_shortcode('[focostv_ad type="mobile" location="pages"]'); ?>
            </div>
            <?php
        }
    endwhile;
else:
    echo '<p>No hay posts en la categoría MULTIMEDIA.</p>';
endif;
echo '</div>';

if (!$is_frontpage) {
    $pagination_args = array(
        'total' => $documentales_query->max_num_pages,
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
    <?php
}

// Resetear postdata
wp_reset_postdata();
?>