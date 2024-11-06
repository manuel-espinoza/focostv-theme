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
    <div class="opinion-page-container">
        <div class="opinion-sections-container">
            <section class="perspectives-editorial" id="perspectives-editorial">
                <?php
                get_template_part('components/perspectives-editorial-posts');
                ?>
            </section>
            <section class="perspectives-opinion" id="perspectives-opinion">
                <?php
                get_template_part('components/perspectives-opinion-posts');
                ?>
            </section>
        </div>
        <section class="focostv-advertisement-opinion">
            <div id="dynamic-advertisement">
                <?php echo do_shortcode('[focostv_advertising group="desktop_page"]'); ?>
            </div>
        </section>
    </div>
</main>
<?php get_footer(); ?>