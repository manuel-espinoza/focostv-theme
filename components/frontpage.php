<?php
// Consulta para obtener el post con la subcategoría 'portada-principal'
$args_principal = array(
    'category_name' => 'portada',
    'posts_per_page' => 1,
    'orderby' => 'date',
    'order' => 'DESC',
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => 'portada-principal',
        ),
    ),
);

$principal_query = new WP_Query($args_principal);

// Consulta para obtener los otros posts en la categoría 'portada', excluyendo el de 'portada-principal'
$args_others = array(
    'category_name' => 'portada',
    'posts_per_page' => 2,  // Ya que el primero será el de 'portada-principal'
    'orderby' => 'date',
    'order' => 'DESC',
    'post__not_in' => wp_list_pluck($principal_query->posts, 'ID'),  // Excluir el post de 'portada-principal'
);

$portada_query = new WP_Query($args_others);

// Mostrar el post con la subcategoría 'portada-principal' primero
if ($principal_query->have_posts()):
    while ($principal_query->have_posts()):
        $principal_query->the_post();
        ?>
        <div class="focostv-front-page-post-item full-width-front-page-post front-page-first-post">
            <div class="focostv-front-page-post">
                <h2 class="focostv-front-page-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="focostv-front-page-post-excerpt">
                    <?php the_excerpt(); ?>
                </div>
                <?php
                $permalink = get_permalink();
                $custom_text = 'Leer nota';
                get_template_part('components/read-more-post', null, array('permalink' => $permalink, 'custom_text' => $custom_text));
                ?>
            </div>
            <?php if (has_post_thumbnail()): ?>
                <div class="focostv-front-page-post-thumbnail">
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
        </div>
    <?php endwhile;
endif;

// Mostrar los otros posts de la categoría 'portada'
if ($portada_query->have_posts()):
    while ($portada_query->have_posts()):
        $portada_query->the_post();
        ?>
        <div class="focostv-front-page-post-item half-width-front-page-post">
            <div class="focostv-front-page-post">
                <h2 class="focostv-front-page-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php
                $permalink = get_permalink();
                $custom_text = 'Leer nota';
                get_template_part('components/read-more-post', null, array('permalink' => $permalink, 'custom_text' => $custom_text));
                ?>
            </div>
            <?php if (has_post_thumbnail()): ?>
                <div class="focostv-front-page-post-thumbnail">
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
        </div>
    <?php endwhile;
else:
    echo '<p>No hay posts en la categoría PORTADA.</p>';
endif;

// Resetear postdata
wp_reset_postdata();
?>
