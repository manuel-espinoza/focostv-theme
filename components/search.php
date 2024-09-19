<div id="focostv-site-search" class="focostv-site-search">
    <div class="focostv-site-search-home">
        <a class="focostv-site-search-home-button" href="<?php echo esc_url(home_url('/')); ?>">
            <i class="fa-solid fa-chevron-left"></i> Regresar
        </a>
    </div>
    <div class="focostv-site-search-form">
        <div class="focostv-site-search-form-container">
            <i class="fa-solid fa-magnifying-glass focostv-site-search-icon"></i>
            <input type="text" placeholder="Buscar">
        </div>
    </div>
    <div class="focostv-site-search-topics">
        <h4 class="focostv-site-search-topics-title">
            Temas
        </h4>
        <?php

        $tags = get_tags(array(
            'orderby' => 'count',
            'order' => 'DESC',
            'number' => 10
        ));

        if ($tags) {
            echo '<ul class="focostv-topics-list">';

            foreach ($tags as $tag) {

                echo '<li>';
                echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No hay temas disponibles.</p>';
        }
        ?>
    </div>
</div>