<?php
/*
Template Name: Actualidad Page
*/
get_header(); ?>
<main class="focotv-site-actualidad">
    <h1>FOCOS TV Actualidad</h1>
    <?php set_query_var('is_frontpage', (is_front_page() || is_home()));
    get_template_part('components/topicality-posts'); ?>
</main>
<?php get_footer(); ?>