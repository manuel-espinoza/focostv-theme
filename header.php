<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body class="<?php echo (is_front_page() || is_home()) ? 'focostv-home' : 'focostv-site'; ?>">
    <header class="focostv-site-header">
        <div class="focostv-site-header-container">
            <div class="focostv-site-header-menu">
                <button class="focostv-site-header-button" id="focostv-toggle-button">
                    <i id="focostv-toggle-icon" class="fa-solid fa-bars focostv-site-header-icon"></i>
                </button>
            </div>
            <div class="focostv-site-header-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/images/focostv-logo-black.svg'); ?>"
                        alt="Logo de Focos TV" loading="eager">
                </a>
            </div>
            <?php if (!is_front_page() && !is_home()): ?>
                <div class="focostv-site-header-navigation-menu">
                    <nav class="focostv-site-header-navigation">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'menu_principal',
                            'container' => false,
                            'menu_class' => 'focostv-site-navigation-menu focostv-header-menu',
                            'fallback_cb' => false,
                        ));
                        ?>
                    </nav>
                </div>
            <?php endif; ?>
            <div class="focostv-site-header-search">
                <button class="focostv-site-header-button" id="focostv-toggle-search">
                    <i class="fa-solid fa-magnifying-glass focostv-site-header-icon"></i>
                </button>
            </div>
        </div>
    </header>
    <nav id="focostv-site-toggle-navigation" class="focostv-site-toggle-navigation">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'menu_principal',
            'container' => false,
            'menu_class' => 'focostv-site-toggle-navigation-menu',
            'fallback_cb' => false,
        ));
        wp_nav_menu(array(
            'theme_location' => 'footer_menu_secondary',
            'container' => false,
            'menu_class' => 'focostv-site-toggle-navigation-menu secondary',
            'fallback_cb' => false,
        ));
        ?>
    </nav>
    <!-- Search Component -->
    <?php get_template_part('components/search'); ?>
    <!--  -->
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