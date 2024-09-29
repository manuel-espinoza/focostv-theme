<?php
/*
Template Name: Actualidad Page
*/
get_header(); ?>
<main class="focostv-site-actualidad">
    <div class="focostv-go-home-container">
        <i class="fa-solid fa-chevron-left"></i>
        <a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a>
    </div>
    <?php set_query_var('is_frontpage', (is_front_page() || is_home()));
    get_template_part('components/topicality-posts'); ?>
</main>
<?php get_footer(); ?>