<?php
function focostvtheme_setup_menus()
{
    add_theme_support('post-thumbnails');
    add_image_size('small', 360, 9999 );
    add_image_size('medium', 768, 9999);
    add_image_size('large', 1024, 9999);
    register_nav_menus(array(
        'menu_principal' => __('Principal', 'focostv'),
        'footer_menu_principal' => __('FooterPrincipal', 'focostv'),
        'footer_menu_secondary' => __('FooterSecundario', 'focostv'),
    ));
}

add_action('after_setup_theme', 'focostvtheme_setup_menus');
function focostvtheme_enqueue_styles()
{
    // google fonts
    wp_enqueue_style('google-fonts', get_template_directory_uri() . '/fonts/fonts.css', array(), null);
    // icons from FontAwesome
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/fontawesome/css/all.min.css', array(), '6.6.0');
    // theme styles
    wp_enqueue_style('focostvtheme-style', get_stylesheet_uri(), array(), '1.0.0');
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