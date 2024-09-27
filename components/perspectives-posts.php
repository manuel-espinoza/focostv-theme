<?php $is_frontpage = get_query_var('is_frontpage');
$frontpage_perspectives_post_class = '';
$category_name = 'perspectivas'; ?>

<h3 class="focostv-sections-title"><a href="<?php echo get_permalink(get_page_by_path('perspectivas')); ?>">Perspectivas
    </a>
    <div class="goto-page-icon"><!-- https://feathericons.dev/?search=arrow-up-right&iconset=feather -->
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

    $args = array(
        'parent' => $category_id,
        'hide_empty' => false,
    );
    $subcategories = get_categories($args);

    if (!empty($subcategories)) {
        echo '<div class="focostv-perspectives-container">';
        foreach ($subcategories as $subcategory) {
            $post_pespective_title_class = strpos(strtolower($subcategory->name), 'entrevista') !== false ? ' focostv-interview-title' : '';
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
                            <?php if (has_post_thumbnail() && strpos(strtolower($subcategory->name), 'entrevista') !== false): ?>
                                <div class="focostv-perspectives-post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                        the_post_thumbnail('full', array(
                                            'srcset' => wp_get_attachment_image_srcset(get_post_thumbnail_id(), 'full'),
                                            'sizes' => '(max-width: 1023px) 300px, 9999',
                                            'alt' => get_the_title(),
                                        ));
                                        ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="focostv-perspectives-post">
                                <h2
                                    class="focostv-front-page-post-title focostv-perspectives-post-title<?php echo $post_pespective_title_class ?>">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <?php
                                if (strpos(strtolower($subcategory->name), 'entrevista') !== false) {
                                    $permalink = get_permalink();
                                    $custom_text = 'Ver entrevista';
                                    get_template_part('components/read-more-post', null, array('permalink' => $permalink, 'custom_text' => $custom_text));
                                } else if (strpos(strtolower($subcategory->name), 'opinion') !== false) {
                                    ?>
                                        <div class="focostv-perspectives-post-author">
                                        <?php echo get_avatar(get_the_author_meta('ID'), 60); ?>
                                            <span class="focostv-perspectives-post-author-name"><?php echo esc_html(get_the_author()); ?></span>
                                        </div>
                                        <?php
                                        $permalink = get_permalink();
                                        $custom_text = 'Ver editorial';
                                        get_template_part('components/read-more-post', null, array('permalink' => $permalink, 'custom_text' => $custom_text));
                                } else if (strpos(strtolower($subcategory->name), 'podcast') !== false) {
                                    ?>
                                            <div class="focostv-perspectives-podcasts-post-date">
                                                <span><?php echo get_the_date('j \d\e F'); ?></span>
                                            </div>
                                            <div class="focostv-perpesctives-podcasts-post-link focostv-front-page-post-link">
                                                <i class="fa-brands fa-spotify"></i> <a href="<?php echo esc_url($permalink); ?>"> Escuchar
                                                </a>
                                            </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    endwhile;
                else:
                    echo "No hay entradas para {$subcategory->name}";
                endif;
                ?>
            </div>
            <?php
        }
        echo '</div>';
    } else {
        echo '<p>No hay subcategorías disponibles.</p>';
    }
} else {
    echo '<p>La categoría "Perspectivas" no existe.</p>';
}
?>