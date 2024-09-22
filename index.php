<?php get_header(); ?>
<main>
    <section class="focostv-section-front-page focostv-section-container">
        <?php get_template_part('components/frontpage'); ?>
    </section>
    <section class="focostv-section-topicality focostv-section-container">
        <?php
        set_query_var('is_frontpage', (is_front_page() || is_home()));
        get_template_part('components/topicality-posts');
        ?>
    </section>
    <section class="focostv-section-research focostv-section-container">
        <?php
        set_query_var('is_frontpage', (is_front_page() || is_home()));
        get_template_part('components/research-posts');
        ?>
    </section>
    <section class="focostv-section-documentaries focostv-section-container"></section>
    <section class="focostv-section-perspectives focostv-section-container"></section>
</main>
<?php get_footer(); ?>