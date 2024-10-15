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
                'callback' => 'my_custom_comments_callback'
            ));
            ?>
        </ol>

        <?php the_comments_navigation(); ?>

    <?php endif; ?>

    <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')):
        ?>
        <p class="no-comments"><?php _e('Comments are closed.', 'textdomain'); ?></p>
    <?php endif; ?>

    <?php comment_form(); ?>

</div>