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
$args = array(
    'category_name' => 'actualidad',
    'orderby' => 'date',
    'order' => 'DESC'
);

if ($is_frontpage) {
    $args['posts_per_page'] = 3;
    $frontpage_topicality_post_class = 'focostv-front-page-topicality';
    $frontpage_topicality_post_item_class = ' focostv-front-page-topicality-post-item';
} else {
    $frontpage_topicality_post_item_class = ' focostv-page-topicality-post-item';
}

$actualidad_query = new WP_Query($args);

echo "<div class='focostv-topicality-post-container " . $frontpage_topicality_post_class . "'>";
if ($actualidad_query->have_posts()):
    $post_counter = 0;
    while ($actualidad_query->have_posts()):
        $actualidad_query->the_post();
        $post_counter++;

        $first_post_topicality_class = ($post_counter == 1 || $post_counter % 8 == 0) ? " focostv-page-topicality-first-post" : "";
        ?>
        <div class="focostv-front-page-post-item<?php echo $frontpage_topicality_post_item_class . $first_post_topicality_class;?>">
            <div class="focostv-front-page-post">
                <h2 class="focostv-front-page-post-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <?php if ($post_counter == 1 && !$is_frontpage): ?>
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
                        <?php
                        the_post_thumbnail('full', array(
                            'srcset' => wp_get_attachment_image_srcset(get_post_thumbnail_id(), 'full'),
                            'sizes' => '(max-width: 1023px) 300px, 9999',
                            'alt' => get_the_title(),
                        ));
                        ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <?php
    endwhile;
else:
    echo '<p>No hay posts en la categoría ACTUALIDAD.</p>';
endif;
echo '</div>';

// Resetear postdata
wp_reset_postdata();

?>