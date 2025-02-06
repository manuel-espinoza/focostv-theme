<?php
/**
 * The template for displaying 404 pages (Not Found)
 */
get_header();
?>
<main class="focostv-site-page">
    <h1 class="focostv-404-title">Error 404</h1>
    <h2 class="focostv-404-subtitle">Este expendiente est&aacute; archivado o bajo investigaci&oacute;n</h2>
    <p class="focostv-404-text">Mientras nuestro equipo resuelve el caso, te invitamos a explorar otras historias</p>

    <section class="focostv-go-to-frontpage">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="focostv-go-to-frontpage-link">
            <h1 class="focostv-go-to-frontpage-title">Portada</h1>
        </a>
    </section>
    <section class="focostv-go-to-multimedia">
        <a href="<?php echo esc_url(home_url('/multimedia')); ?>" class="focostv-go-to-multimedia-link">
        <h1 class="focostv-go-to-multimedia-title">Multimedia</h1>
        </a>
    </section>
</main>

<?php get_footer(); ?>