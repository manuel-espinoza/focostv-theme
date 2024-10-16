<?php

function my_custom_comments_callback($comment, $args, $depth)
{
    $author = get_comment_author($comment);
    $first_letter = strtoupper(substr($author, 0, 1));
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <div class="comment-body">
            <div class="comment-author vcard focostv-post-comment-author">
                <div class="focostv-comment-author-avatar"><?php echo esc_html($first_letter); ?></div>
                <?php printf('<span class="fn focostv-post-comment-author-name">%s</cite>', get_comment_author_link()); ?>
            </div>
            <div class="comment-meta commentmetadata focostv-post-comment-meta">
                <span>
                    <?php
                    $comment_date = get_comment_date('j \d\e F \d\e Y');
                    $comment_time = get_comment_time('h:iA');
                    printf('%s, %s', $comment_date, $comment_time);
                    ?>
                </span>
            </div>
            <div class="comment-content focostv-post-comment-content">
                <?php comment_text(); ?>
            </div>
        </div>
    </li>
    <?php
}
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="focostv-post-comments-area">

    <?php if (have_comments()): ?>
        <ol class="comment-list focostv-post-comments-list">
            <?php
            wp_list_comments(array(
                'style' => 'ol',
                'short_ping' => true,
                'avatar_size' => 50,
                'callback' => 'my_custom_comments_callback',
                'reverse_top_level' => true,
            ));
            ?>
        </ol>

        <?php the_comments_navigation(); ?>

    <?php else: ?>
        <div class="focostv-no-comments-container">
            <h3 class="focostv-no-comments-post-title">¡S&eacute; el primero en comentar!</h3>
        </div>
    <?php endif; ?>
    <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')):
        ?>
        <p class="no-comments"><?php _e('Comments are closed.', 'textdomain'); ?></p>

    <?php else: ?>
        <div class="focostv-post-comment-form">
            <?php
            $comment_form_args = array(
                'title_reply' => '',
                'label_submit' => 'Comentar',
                'class_submit' => 'focostv-comment-submit-button',
                'comment_notes_before' => '<p class="focostv-comment-note">Al comentar estas aceptado las <span>normas de convivencia</span> de la plataforma</p>',
                'comment_notes_after' => '',
                'fields' => array(
                    'author' => '<p class="comment-form-author focostv-comment-form-author"><input id="author" placeholder="Nombre" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" required/></p>',
                    'email' => '<p class="comment-form-email focostv-comment-form-email"><input id="email" placeholder="Email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" required/></p>',
                ),
                'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" class="focostv-comment-textarea" placeholder="Únete a la conversación..." rows="8" aria-required="true" required></textarea></p>',
            );

            comment_form($comment_form_args);
            ?>
        </div>
    <?php endif; ?>



</div>