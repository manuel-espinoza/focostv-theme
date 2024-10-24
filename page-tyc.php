<?php
/*
Template Name: T&C Page
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
        <h1 class="focostv-sections-title">
            <?php echo the_title(); ?>
        </h1>
        <section class="focostv-tc-content">
            <?php echo the_content(); ?>
        </section>
        <?php
    endwhile;
    ?>
</main>
<?php get_footer(); ?>