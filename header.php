<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <title><?php bloginfo('og:title'); ?></title>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body class="focostv-site">
    <header class="focostv-site-header">
        <div class="focostv-site-header-container">
            <div class="focostv-site-header-menu">
                <button class="focostv-site-header-button" id="focostv-toggle-button">
                    <i class="fa-solid fa-bars focostv-site-header-icon"></i>
                </button>
            </div>
            <div class="focostv-site-header-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/images/focostv-logo-black.svg'); ?>"
                        alt="Logo de Focos TV">
                </a>
            </div>
            <div class="focostv-site-header-search">
                <button class="focostv-site-header-button">
                    <i class="fa-solid fa-magnifying-glass focostv-site-header-icon"></i>
                </button>
            </div>
        </div>
    </header>
    <nav class="focostv-site-navigation">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'menu_principal',
            'container' => false,
            'menu_class' => 'focostv-site-navigation-menu',
            'fallback_cb' => false,
        ));
        ?>
    </nav>