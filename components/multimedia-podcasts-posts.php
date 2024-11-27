<div class="multimedia-podcasts-posts-container">
    <div class="multimedia-podcasts-title-container">
        <div class="multimedia-podcasts-title-icon">
            <i class="fa-brands fa-spotify"></i>
        </div>
        <h2 class="podcasts-posts-container-title">
            Podcast
        </h2>
    </div>

    <div class="focostv-podcast-carousel-container">
        <div class="focostv-podcast-carousel">
            <?php
            $principal_category_id = get_cat_ID('multimedia');
            $subcategory_id = get_cat_ID('podcasts'); // slug de la subcategoria para el estilo de opiniones
            
            $args = array(
                'category__in' => [$subcategory_id],
                'posts_per_page' => 5,
                'orderby' => 'date',
                'order' => 'DESC',
            );

            $multimedia_podcast_query = new WP_Query($args);

            if ($multimedia_podcast_query->have_posts()):
                while ($multimedia_podcast_query->have_posts()):
                    $multimedia_podcast_query->the_post();
                    ?>
                    <div class="focostv-podcast-post-item focostv-podcast-card">
                        <?php if (has_post_thumbnail()): ?>
                            <div class="focostv-podcast-post-thumbnail-image">
                                <?php the_post_thumbnail('full'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="focostv-podcast-post-thumbnail-legend">
                            <h3 class="focostv-podcast-post-title"><?php the_title(); ?></h3>
                            <?php
                            $podcast_duration = get_field('duracion_podcast');
                            if ($podcast_duration):
                                ?>
                                <p class="focostv-podcast-post-duration"><?php echo "{$podcast_duration}min."; ?> </p>
                                <?php
                            endif;
                            $permalink = get_permalink();
                            $custom_text = 'Escuchar';
                            get_template_part('components/read-more-post', null, array('permalink' => $permalink, 'custom_text' => $custom_text));
                            ?>
                        </div>
                    </div>
                    <?php
                endwhile;
            else:
                echo '<span class="no-posts"></span>';
            endif;
            wp_reset_postdata();
            ?>
        </div>
        <div class="focostv-podcast-carousel-buttons">
            <button class="focostv-podcast-carousel-prev">
                <div class="focostv-podcast-carousel-prev-container">
                    <!-- https://feathericons.dev/?search=arrow-left-circle&iconset=feather -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                        class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 8 8 12 12 16" />
                        <line x1="16" x2="8" y1="12" y2="12" />
                    </svg>
                </div>
            </button>
            <div class="focostv-podcast-carousel-indicators">
                <?php
                for ($i = 1; $i <= $multimedia_podcast_query->post_count; $i++): ?>
                    <span class="focostv-podcast-carousel-dot" onclick="currentPodcastSlide(<?php echo $i; ?>)"></span>
                <?php endfor; ?>
            </div>
            <button class="focostv-podcast-carousel-next">
                <div class="focostv-podcast-carousel-next-container">
                    <!-- https://feathericons.dev/?search=arrow-right-circle&iconset=feather -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                        class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 16 16 12 12 8" />
                        <line x1="8" x2="16" y1="12" y2="12" />
                    </svg>
                </div>
            </button>
        </div>
    </div>
    <div class="go-to-focostv-spotify-container">
        <?php
        $permalink = 'https://open.spotify.com/show/2wVYsSbTxf1cvXlMmVmsYW?si=9710488683bd4a7a'; // url FOCOSTV PODCASTS 
        ?>
        <a href="<?php echo $permalink; ?>" class="go-to-focostv-spotify-link">M&aacute;s episodios en Spotify</a>
    </div>
</div>