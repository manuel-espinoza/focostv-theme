<?php
function focostvtheme_setup_menus()
{
    add_theme_support('post-thumbnails');
    register_nav_menus(array(
        'menu_principal' => __('Principal', 'focostv'),
        'footer_menu_principal' => __('FooterPrincipal', 'focostv'),
        'footer_menu_secondary' => __('FooterSecundario', 'focostv'),
    ));
}

add_action('after_setup_theme', 'focostvtheme_setup_menus');
function focostvtheme_enqueue_styles()
{
    // google font: Inter
    wp_enqueue_style('preconnect-google-fonts', 'https://fonts.googleapis.com', array(), null, 'preconnect');
    wp_enqueue_style('preconnect-gstatic', 'https://fonts.gstatic.com', array(), null, 'preconnect');
    wp_enqueue_style('google-fonts-inter', 'https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap', array(), null);
    wp_enqueue_style('google-fonts-poppins', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', array(), null);
    // icons from FontAwesome
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css', array(), '6.5.0');
    // theme styles
    wp_enqueue_style('focostvtheme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'focostvtheme_enqueue_styles');

function focostvtheme_enqueue_scripts()
{
    wp_enqueue_script('focostv-scripts', get_template_directory_uri() . '/js/index.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'focostvtheme_enqueue_scripts');

/**
 * Summary of custom_excerpt_length
 * @param mixed $length
 * @return int
 */
function custom_excerpt_length($length)
{
    return 25;
}
add_filter('excerpt_length', 'custom_excerpt_length');