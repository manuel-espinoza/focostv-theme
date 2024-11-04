<?php
/*
Template Name: Perspectivas Page
*/
get_header(); ?>
<main class="focostv-site-page">
    <div class="focostv-go-home-container">
        <i class="fa-solid fa-chevron-left"></i>
        <a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a>
    </div>
    <h3 class="focostv-sections-title focostv-page-title"><a><?php the_title(); ?></a>
    </h3>
    <section class="perspectives-editorial" id="pespectives-editorial">
        <?php
        get_template_part('components/perspectives-editorial-posts');
        ?>
        <div class="load-more-container-opinion">
            <button id="load-more-editorial" class="load-more-opinion-button">Cargar m&aacute;s editoriales</button>
        </div>
    </section>
    <section class="perspectives-opinion" id="perspectives-opinion">
        <?php
        get_template_part('components/perspectives-opinion-posts');
        ?>
        <div class="load-more-container-opinion">
            <button id="load-more-opinion" class="load-more-opinion-button">Cargar m&aacute;s opiniones</button>
        </div>
    </section>
</main>
<?php get_footer(); ?>