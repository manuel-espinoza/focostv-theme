<?php
/* Template Name: Comments Page */

get_header();

$post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;

if ($post_id) {
    $post = get_post($post_id);
    setup_postdata($post);
    
    ?>
    <div class="focostv-comments-page-container">
        <h1>Comentarios para el post: <?php the_title(); ?></h1>

        <div class="focostv-comments-content">
            <?php
            // Mostrar la sección de comentarios para el post específico
            comments_template();
            ?>
        </div>
    </div>
    <?php
    wp_reset_postdata();
} else {
    echo '<p>No se encontró el post.</p>';
}

get_footer();
?>
