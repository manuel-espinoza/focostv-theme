<?php
/*
Template Name: Investigacion Page
*/
get_header(); ?>
<main class="focotv-site-investigacion">
    <div class="focostv-go-home-container">
        <i class="fa-solid fa-chevron-left"></i>
        <a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a>
    </div>
    <h3 class="focostv-sections-title"><a>Investigaci&oacute;n</a>
    </h3>
    <?php
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $args = array(
        'category_name' => 'investigacion',
        'orderby' => 'date',
        'order' => 'DESC',
        'paged' => $paged,
        'post_per_page' => 10,
    );

    $investigacion_query = new WP_Query($args);
    ?>

    <div id="focostv-research-posts-container" class="focostv-research-post-container">
        <?php
        if ($investigacion_query->have_posts()):
            $post_counter = 0;
            while ($investigacion_query->have_posts()):
                $investigacion_query->the_post();
                $post_counter++;
                $is_research_page = ($post_counter == 1 || $post_counter == 5);
                $first_post_research_class = $is_research_page ? " focostv-page-research-first-post" : "";
                ?>
                <div class="post-item"></div>
                <?php
            endwhile;
        else:
            echo '<p>No hay posts en la categoría INVESTIGACION.</p>';
        endif;
        ?>
    </div>
</main>
<?php get_footer();
?>