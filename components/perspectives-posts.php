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

    $args = array(
        'cat' => $category_id,
        'posts_per_page' => 9,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<div class="focostv-perspectives-container">';
        $post_count = 0;

        while ($query->have_posts()) {
            $query->the_post();
            $post_count++;

            $subcategories = get_the_terms(get_the_ID(), 'category');
            $subcategory_name = 'Editorial'; // Valor por defecto

            if ($subcategories && !is_wp_error($subcategories)) {
                foreach ($subcategories as $subcategory) {
                    if ($subcategory->parent == $category_id) { // Verificar si es una subcategoría de "Opinion"
                        $subcategory_name = $subcategory->name;
                        break; // Tomar la primera subcategoría encontrada
                    }
                }
            }

            // Abrir una nueva fila cada 3 posts
            if ($post_count % 3 == 1) {
                echo '<div class="focostv-perspectives-row">';
            }

            echo '<div class="focostv-perspectives-column">';
            ?>
            <div class="focostv-perspectives-post-item">
            <h6 class="focostv-perspectives-category"><?php echo esc_html($subcategory_name); ?></h6>
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
                    <h2 class="focostv-front-page-post-title focostv-perspectives-post-title">
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
            echo '</div>'; // Cierre de columna

            if ($post_count % 3 == 0 || $post_count == $query->post_count) {
                echo '</div>'; // Cierre de fila
            }
        }

        echo '</div>'; // Cierre del contenedor principal
    } else {
        echo '<p>No hay posts en la categoría "Opinión".</p>';
    }

    wp_reset_postdata();
} else {
    echo '<p>La categoría "Opinión" no existe.</p>';
}
?>