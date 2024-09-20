<?php get_header(); ?>
<main>
    <section class="focostv-section-front-page">
        <?php get_template_part('components/frontpage'); ?>
    </section>
    <section class="focostv-section-topicality">
        <?php
        set_query_var('is_frontpage', (is_front_page() || is_home()));
        get_template_part('components/topicality-posts');
        ?>
    </section>
    <section class="focostv-section-research"></section>
    <section class="focostv-section-documentaries"></section>
    <section class="focostv-section-perspectives"></section>
</main>
<?php get_footer(); ?>