<?php

// show only most recent podcast publication
$args = array(
    'category_name' => 'podcasts',
    'posts_per_page' => 1,
    'orderby' => 'date',
    'order' => 'DESC'
);

$podcasts_query = new WP_Query($args);

if ($podcasts_query->have_posts()) {
    while ($podcasts_query->have_posts()) {
        $podcasts_query->the_post();

        echo '<div class="focostv-perspectives-podcast-spotify">';
        echo the_content();
        echo '</div>';
    }
    ?>
    <div class="focostv-main-advertisement">
        <img src="https://stage.focostv.com/wp-content/uploads/2024/10/focostv_ad.png" alt="Anuncio">
    </div>
    <div class="perspectives-all-podcasts-container">
        <h6 class="focostv-perspectives-category perspectives-page-category">
            Podcasts
        </h6>
        <h3 class="perspectives-all-podcasts-title">
            Mira todos nuestros podcasts
        </h3>
        <?php
        $permalink = 'https://open.spotify.com/show/2wVYsSbTxf1cvXlMmVmsYW?si=9710488683bd4a7a'; // url FOCOSTV PODCASTS
        $custom_text = 'Ver playlist';
        get_template_part('components/read-more-post', null, array('permalink' => $permalink, 'custom_text' => $custom_text));
        ?>
    </div>
    <?php

}


?>