<?php
// Evitar el acceso directo al archivo
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if (have_comments()): ?>
        <h2 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ($comments_number === 1) {
                printf(
                    __('One Comment on "%s"', 'tu-tema'),
                    get_the_title()
                );
            } else {
                printf(
                    _n(
                        '%1$s Comment on "%2$s"',
                        '%1$s Comments on "%2$s"',
                        $comments_number,
                        'tu-tema'
                    ),
                    number_format_i18n($comments_number),
                    get_the_title()
                );
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style' => 'ol',
                'short_ping' => true,
                'avatar_size' => 60,
            ));
            ?>
        </ol><!-- .comment-list -->

        <?php
        // Si hay paginación de comentarios
        if (get_comment_pages_count() > 1 && get_option('page_comments')):
            ?>
            <nav class="comment-navigation" role="navigation">
                <div class="nav-previous"><?php previous_comments_link(__('Older Comments', 'tu-tema')); ?></div>
                <div class="nav-next"><?php next_comments_link(__('Newer Comments', 'tu-tema')); ?></div>
            </nav>
        <?php endif; ?>

    <?php endif; // have_comments() ?>

    <?php
    // Si los comentarios están cerrados pero aún hay comentarios, mostrar un mensaje.
    if (!comments_open() && get_comments_number()):
        ?>
        <p class="no-comments"><?php _e('Comments are closed.', 'tu-tema'); ?></p>
    <?php endif; ?>

    <?php
    // Mostrar el formulario para añadir nuevos comentarios
    comment_form();
    ?>

</div><!-- .comments-area -->
