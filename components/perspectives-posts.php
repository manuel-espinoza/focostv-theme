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
        foreach ($subcategories as $subcategory) {
            ?>
            <div class="<?php echo $subcategory->slug ?>-container-perspective-posts">

                <?php
                $args_posts = array(
                    'cat' => $subcategory->term_id,
                );
                if ($is_frontpage) {
                    $args['posts_per_page'] = 3;
                }

                $perspectivas_query = new WP_Query($args_posts);

                if ($perspectivas_query->have_posts()):
                    while ($perspectivas_query->have_posts()):
                        $perspectivas_query->the_post();
                        ?>
                        <div class="focostv-perspectives-post-item">
                            <div class="focostv-perspectives-post">
                                <h6 class="focostv-perspectives-category">
                                    <?php echo esc_html(strtolower($subcategory->name)); ?>
                                </h6>
                                <h2 class="focostv-front-page-post-title focostv-perspectives-opinion-post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
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
    } else {
        echo '<p>No hay subcategorías disponibles.</p>';
    }
} else {
    echo '<p>La categoría "Perspectivas" no existe.</p>';
}
?>