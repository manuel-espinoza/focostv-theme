<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <title><?php bloginfo('name'); ?> &raquo; <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
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
                <a href="<?php echo esc_url(home_url('/')); ?>"></a>
            </div>
            <div class="focostv-site-header-search">
                <button class="focostv-site-header-button">
                    <i class="fa-solid fa-magnifying-glass focostv-site-header-icon"></i>
                </button>
            </div>
        </div>
    </header>