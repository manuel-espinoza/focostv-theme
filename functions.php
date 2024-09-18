<?php
function focostvtheme_setup_menus() {
    register_nav_menus(array(
        'menu_principal' => __('Principal', 'focostv'),
        'footer_menu_principal' => __('FooterPrincipal', 'focostv'),
        'footer_menu_secondary' => __('FooterSecundario','focostv'),
    ));
}

add_action('after_setup_theme', 'focostvtheme_setup_menus');
function focostvtheme_enqueue_styles()
{
    // google font: Inter
    wp_enqueue_style( 'preconnect-google-fonts', 'https://fonts.googleapis.com', array(), null, 'preconnect' );
    wp_enqueue_style( 'preconnect-gstatic', 'https://fonts.gstatic.com', array(), null, 'preconnect' );
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap', array(), null );
    // icons from FontAwesome
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css', array(), '6.5.0');
    // theme styles
    wp_enqueue_style('focostvtheme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'focostvtheme_enqueue_styles');
