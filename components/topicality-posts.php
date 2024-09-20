<?php
$is_frontpage = get_query_var('is_frontpage');
?>

<h3 class="focostv-topicality-title"><a
        href="<?php echo get_permalink(get_page_by_path('actualidad')); ?>">Actualidad</a></h3>

<?php
$args = array(
    'category_name' => 'actualidad',
    'orderby' => 'date',
    'order' => 'DESC'
);

if ($is_frontpage) {
    $args['posts_per_page'] = 3;
}

$actualidad_query = new WP_Query($args);

if ($actualidad_query->have_posts()):
    while ($actualidad_query->have_posts()):
        $actualidad_query->the_post();
        ?>
        <div class="focostv-front-page-post-item">
            <!-- Aquí el contenido de cada post -->
            <h2 class="focostv-front-page-post-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <!-- Mostrar la imagen destacada -->
            <?php if (has_post_thumbnail()): ?>
                <div class="focostv-front-page-post-thumbnail">
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
                </div>
            <?php endif; ?>
        </div>
        <?php
    endwhile;
else:
    echo '<p>No hay posts en la categoría PORTADA.</p>';
endif;

// Resetear postdata
wp_reset_postdata();

?>