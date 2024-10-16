<?php
/* Template Name: Comments Page */

get_header();

$post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;

if ($post_id) {
    $post = get_post($post_id);
    setup_postdata($post);

    ?>
    <main class="focostv-comments-page-container">
        <div class="focostv-go-home-container">
            <i class="fa-solid fa-chevron-left"></i>
            <a href="<?php echo esc_url(get_permalink($post_id)); ?>">Regresar a la nota</a>
        </div>


        <h2 class="focostv-comments-page-title">Comentarios</h2>

        <div class="focostv-comments-content-container">
            <div class="focostv-comments-content">
                <?php
                // Mostrar la sección de comentarios para el post específico
                comments_template();
                ?>
            </div>
            <div class="focostv-comments-ad">

            </div>
        </div>
    </main>
    <?php
    wp_reset_postdata();
} else {
    echo '<p>No se encontró el post.</p>';
}

get_footer();
?>