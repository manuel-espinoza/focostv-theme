<?php
/*
Template Name: Documentales Page
*/
get_header(); ?>
<main class="focostv-site-documentaries">
    <div class="focostv-go-home-container focostv-header-documentaries">
        <i class="fa-solid fa-chevron-left"></i>
        <a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a>
    </div>
    <?php set_query_var('is_frontpage', (is_front_page() || is_home()));
    get_template_part('components/documentaries-posts'); ?>
</main>
<?php get_footer(); ?>