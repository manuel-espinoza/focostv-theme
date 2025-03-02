<?php
$subcategory_slug = 'columnas-de-opinion';
$not_subcategory_slug = 'editoriales';
$paged = isset($_POST['page']) ? $_POST['page'] : 1;

$args = array(
    'category_name' => $subcategory_slug,
    'category__not_in' => array(get_cat_ID($not_subcategory_slug)),
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $paged
);

$opiniones_query = new WP_Query($args);

if ($opiniones_query->have_posts()):
    while ($opiniones_query->have_posts()):
        $opiniones_query->the_post();
        ?>

        <div class="focostv-perspectives-page-post-item">
            <h6 class="focostv-perspectives-category perspectives-page-category">
                Columnas de opini&oacute;n
            </h6>
            <div class="focostv-perspectives-post">
                <h2 class="focostv-front-page-post-title focostv-perspectives-post-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
            </div>
            <?php
            $opinion_author = get_field('autor_opinion');
            $opinion_avatar_author = get_field('imagen_autor_opinion');
            if ($opinion_author && $opinion_avatar_author) {

                ?>
                <div class="focostv-perspectives-post-author">
                    <img src="<?php echo esc_url($opinion_avatar_author['url']); ?>" alt="<?php echo esc_attr($opinion_author); ?>"
                        width="60" height="60" class="focostv-perspectives-post-author-avatar">
                    <span class="focostv-perspectives-post-author-name"><?php echo esc_html($opinion_author); ?></span>
                </div>
                <?php
            } else {
                ?>
                <div class="focostv-perspectives-post-author">
                    <?php echo get_avatar(get_the_author_meta('ID'), 60); ?>
                    <span class="focostv-perspectives-post-author-name"><?php echo esc_html(get_the_author()); ?></span>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    endwhile;

    echo '<div class="focostv-pagination-container focostv-opinion-pagination">';
    $pagination = paginate_links(array(
        'total' => $opiniones_query->max_num_pages,
        'current' => $paged,
        'prev_text' => '<i class="fa-solid fa-angle-left"></i>',
        'next_text' => '<i class="fa-solid fa-angle-right"></i>',
        'format' => '?paged=%#%',
        'base' => add_query_arg('paged', '%#%'),
        'end_size' => 1,
        'mid_size' => 0,
        'type' => 'list'
    ));
    
    $pagination = str_replace('page-numbers', 'focostv-pagination', $pagination);
    $pagination = str_replace('prev', 'prev focostv-pagination-prev', $pagination);
    $pagination = str_replace('next', 'next focostv-pagination-next', $pagination);
    
    echo $pagination;
    echo '</div>';

else:
    echo 'No hay posts';
endif;
wp_reset_postdata();
?>