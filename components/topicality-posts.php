<?php
$is_frontpage = get_query_var('is_frontpage');
$frontpage_topicality_post_class = '';
?>

<h3 class="focostv-sections-title"><a <?php echo $is_frontpage ? 'href="' . get_permalink(get_page_by_path('actualidad')) . '"' : ''; ?>>Actualidad</a>
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
    'category_name' => 'actualidad',
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $paged
);

if ($is_frontpage) {
    $args['posts_per_page'] = 3;
    $frontpage_topicality_post_class = 'focostv-front-page-topicality';
    $frontpage_topicality_post_item_class = ' focostv-front-page-topicality-post-item';
} else {
    $args['posts_per_page'] = 10;
    $frontpage_topicality_post_item_class = ' focostv-page-topicality-post-item';
}

$actualidad_query = new WP_Query($args);

echo "<div class='focostv-topicality-post-container " . $frontpage_topicality_post_class . "'>";
if ($actualidad_query->have_posts()):
    $post_counter = 0;
    while ($actualidad_query->have_posts()):
        $actualidad_query->the_post();
        $post_counter++;
        $is_topicality_page = ($post_counter == 1 || $post_counter == 5) && !$is_frontpage;
        $first_post_topicality_class = $is_topicality_page ? " focostv-page-topicality-first-post" : "";
        ?>
        <div
            class="focostv-front-page-post-item<?php echo $frontpage_topicality_post_item_class . $first_post_topicality_class; ?>">
            <div class="focostv-front-page-post">
                <h2 class="focostv-front-page-post-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <?php if ($is_topicality_page): ?>
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
        if (!$is_frontpage && $post_counter == 1) {
            ?>
            <div class="focostv-main-advertisement">
                <img src="https://stage.focostv.com/wp-content/uploads/2024/10/focostv_ad.png" alt="Anuncio">
            </div>
            <?php
        }
    endwhile;
    if (!$is_frontpage) {
        $pagination_args = array(
            'total' => $actualidad_query->max_num_pages,
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
        <div class="focostv-footer-advetisement">
            <img src="https://stage.focostv.com/wp-content/uploads/2024/10/focostv_end_ad.png" alt="Anuncio">
        </div>
        <?php
    }
    echo '</div>';
else:
    echo '<p>No hay posts en la categoría ACTUALIDAD.</p>';
endif;
echo '</div>';

// Resetear postdata
wp_reset_postdata();

?>