<?php
$is_frontpage = get_query_var('is_frontpage');
$frontpage_perspectives_post_class = '';
$category_name = 'opinion';
?>

<h3 class="focostv-sections-title">
    <a href="<?php echo get_permalink(get_page_by_path($category_name)); ?>">Opini&oacute;n</a>
    <div class="goto-page-icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon"
            fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
            <line x1="7" x2="17" y1="17" y2="7" />
            <polyline points="7 7 17 7 17 17" />
        </svg>
    </div>
</h3>

<?php
$category = get_term_by('slug', $category_name, 'category');

if ($category) {
    $category_id = $category->term_id;

    // Obtener subcategorias
    $args = array(
        'parent' => $category_id,
        'hide_empty' => true,
    );
    $subcategories = get_categories($args);

    // Mostrar posts de la categoria principal si no hay subcategorias
    $args_general_posts = array(
        'cat' => $category_id,
        'posts_per_page' => $is_frontpage ? 3 : -1, // Mostrar 3 en la homepage y todos en otras paginas
        'category__not_in' => wp_list_pluck($subcategories, 'term_id'), // Excluir posts que ya estan en subcategorias
    );

    $general_query = new WP_Query($args_general_posts);
    echo '<div class="focostv-perspectives-container">';
    /************************POSTS CON SUBCATEGORIAS EN LA CATEGORIA OPINION **********************************************************/
    if (!empty($subcategories)) {
        foreach ($subcategories as $subcategory) {
            $post_pespective_title_class = strpos(strtolower($subcategory->name), 'editorial') !== false ? ' focostv-editorial-title' : '';
            ?>
            <div class="<?php echo $subcategory->slug ?>-container-perspective-posts">
                <?php
                $args_posts = array(
                    'cat' => $subcategory->term_id,
                );

                if ($is_frontpage) {
                    $args_posts['posts_per_page'] = 3;
                }

                $perspectivas_query = new WP_Query($args_posts);

                if ($perspectivas_query->have_posts()):
                    while ($perspectivas_query->have_posts()):
                        $perspectivas_query->the_post();
                        ?>
                        <div class="focostv-perspectives-post-item">
                            <h6 class="focostv-perspectives-category">
                                <?php echo strtolower($subcategory->name); ?>
                            </h6>
                            <?php if (has_post_thumbnail() && strpos(strtolower($subcategory->name), 'editorial') !== false): ?>
                                <div class="focostv-perspectives-post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <picture>
                                            <source media="(max-width: 639px)"
                                                srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'small'); ?>">
                                            <source media="(min-width: 640px) and (max-width: 1023px)"
                                                srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>">
                                            <source media="(min-width: 1024px) and (max-width: 1439px)"
                                                srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>">
                                            <source media="(min-width: 1440px)"
                                                srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>">
                                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>"
                                                alt="<?php the_title_attribute(); ?>" loading="eager">
                                        </picture>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="focostv-perspectives-post">
                                <h2
                                    class="focostv-front-page-post-title focostv-perspectives-post-title<?php echo $post_pespective_title_class ?>">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <?php
                                if (strpos(strtolower($subcategory->name), 'editorial') !== false) {
                                    $permalink = get_permalink();
                                    $custom_text = 'Ver editorial';
                                    get_template_part('components/read-more-post', null, array('permalink' => $permalink, 'custom_text' => $custom_text));
                                } else if (strpos(strtolower($subcategory->name), 'opiniones') !== false) {
                                    $opinion_author = get_field('autor_opinion');
                                    $opinion_avatar_author = get_field('imagen_autor_opinion');
                                    if ($opinion_author && $opinion_avatar_author) {

                                        ?>
                                            <div class="focostv-perspectives-post-author">
                                                <img src="<?php echo esc_url($opinion_avatar_author['url']); ?>"
                                                    alt="<?php echo esc_attr($opinion_author); ?>" width="60" height="60"
                                                    class="focostv-perspectives-post-author-avatar">
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
                                    $permalink = get_permalink();
                                    $custom_text = 'Ver opinión';
                                    get_template_part('components/read-more-post', null, array('permalink' => $permalink, 'custom_text' => $custom_text));
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    endwhile;
                endif;
                ?>
            </div>
            <?php
        }
    }
    /************************POSTS SIN SUBCATEGORIA EN LA CATEGORIA OPINION **********************************************************/
    echo '<div class="other-posts-container-perspective-posts">';
    if ($general_query->have_posts()):
        while ($general_query->have_posts()):
            $general_query->the_post();
            ?>
            <div class="focostv-perspectives-post-item focostv-editorial-opinion-post">
                <h6 class="focostv-perspectives-category">Otros</h6>
                <?php if (has_post_thumbnail()): ?>
                    <div class="focostv-perspectives-post-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <picture>
                                <source media="(max-width: 639px)"
                                    srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'small'); ?>">
                                <source media="(min-width: 640px) and (max-width: 1023px)"
                                    srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>">
                                <source media="(min-width: 1024px) and (max-width: 1439px)"
                                    srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>">
                                <source media="(min-width: 1440px)"
                                    srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>">
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>"
                                    alt="<?php the_title_attribute(); ?>" loading="eager">
                            </picture>
                        </a>
                    </div>
                <?php endif; ?>
                <div class="focostv-perspectives-post">
                    <h2 class="focostv-front-page-post-title focostv-perspectives-post-title focostv-editorial-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <?php
                    $permalink = get_permalink();
                    $custom_text = 'Ver contenido';
                    get_template_part('components/read-more-post', null, array('permalink' => $permalink, 'custom_text' => $custom_text));
                    ?>
                </div>
            </div>
            <?php
        endwhile;
    endif;
    echo '</div>';
    echo '</div>';
} else {
    echo '<p>La categoría "Opinión" no existe.</p>';
}
?>