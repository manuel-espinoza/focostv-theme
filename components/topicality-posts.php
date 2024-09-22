<?php
$is_frontpage = get_query_var('is_frontpage');
$frontpage_topicality_post_class = ''
    ?>

<h3 class="focostv-sections-title"><a href="<?php echo get_permalink(get_page_by_path('actualidad')); ?>">Actualidad
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
    'category_name' => 'actualidad',
    'orderby' => 'date',
    'order' => 'DESC'
);

if ($is_frontpage) {
    $args['posts_per_page'] = 3;
    $frontpage_topicality_post_class = 'focostv-front-page-topicality';
    $frontpage_topicality_post_item_class = ' focostv-front-page-topicality-post-item';
}

$actualidad_query = new WP_Query($args);

echo "<div class='focostv-topicality-post-container " . $frontpage_topicality_post_class . "'>";
if ($actualidad_query->have_posts()):
    while ($actualidad_query->have_posts()):
        $actualidad_query->the_post();
        ?>
        <div class="focostv-front-page-post-item<?php echo $frontpage_topicality_post_item_class; ?>">
            <div class="focostv-front-page-post">
                <h2 class="focostv-front-page-post-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <div class="focostv-front-page-post-link">
                    <a href="<?php the_permalink(); ?>">Leer nota <i class="fa-solid fa-up-right-from-square"></i></a>
                </div>
            </div>
            <?php if (has_post_thumbnail()): ?>
                <div class="focostv-front-page-post-thumbnail">
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
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