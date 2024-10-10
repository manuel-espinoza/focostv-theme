<?php get_header(); ?>

<?php
if (have_posts()):
    while (have_posts()):
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <footer class="entry-footer">
                <span class="posted-on">Publicado el: <?php the_date(); ?></span>
                <span class="byline">Por: <?php the_author(); ?></span>
            </footer>
        </article>
        <?php
    endwhile;
else:
    echo '<p>No se encontró el post.</p>';
endif;
?>

<?php get_footer(); ?>