<section class="focostv-multimedia-posts-container">
    <h3 class="focostv-sections-title focostv-header-documentaries focostv-page-title">
        <a>Multimedia</a>
    </h3>
    <div class="focostv-multimedia-container">
        <div class="multimedia-video-posts-container">
            <?php get_template_part('components/multimedia-video-posts') ?>
        </div>
        <section class="focostv-main-advertisement focostv-ad-multimedia-page">
            <div id="dynamic-advertisement">
                <?php echo do_shortcode('[focostv_advertising group="mobile_page"]'); ?>
            </div>
        </section>
        <?php get_template_part('components/multimedia-podcasts-posts') ?>
    </div>
</section>