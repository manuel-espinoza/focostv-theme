<?php
/*
Template Name: Noiz Page
*/
get_header(); ?>
<main class="focostv-site-page">
    <div class="focostv-go-home-container">
        <i class="fa-solid fa-chevron-left"></i>
        <a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a>
    </div>
    <?php
    while (have_posts()):
        the_post(); ?>
        <section class="focostv-noiz-content">
            <?php echo the_content(); ?>
        </section>
        <?php
    endwhile;
    ?>
</main>
<?php get_footer(); ?>