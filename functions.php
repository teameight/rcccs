<?php

define("THEME_DIR", get_template_directory_uri());
/*--- REMOVE GENERATOR META TAG ---*/
remove_action('wp_head', 'wp_generator');

// ENQUEUE STYLES

function enqueue_styles() {

    /** REGISTER css/screen.cs **/
    wp_register_style( 'screen-style', THEME_DIR . '/scss/style.css', array(), '1', 'all' );
    wp_enqueue_style( 'screen-style' );

}
add_action( 'wp_enqueue_scripts', 'enqueue_styles' );

// ENQUEUE SCRIPTS

function enqueue_scripts() {

    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'jquery-effects-core' );
    wp_enqueue_script( 'modernizr', THEME_DIR . '/js/modernizr.js', 'jquery' );
    wp_enqueue_script( 'cycle2', THEME_DIR . '/js/cycle2.js', 'jquery' );
    wp_enqueue_script( 'cycle2-center', THEME_DIR . '/js/cycle2.center.js', 'jquery' );
    wp_enqueue_script( 'carousel', THEME_DIR . '/js/carousel.js', 'jquery' );
    wp_enqueue_script( 'scrollto', THEME_DIR . '/js/jquery-scrollto.js', 'jquery' );
    wp_enqueue_script( 'acf-map', THEME_DIR . '/js/acf-map.js', 'google-maps' );
    wp_enqueue_script( 'rcccs', THEME_DIR . '/js/rcccs.js', 'jquery', true );
    wp_enqueue_script( 'google-maps', "https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false", 'jquery' );

}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );

// ADD WP NAV MENUS

function rcccs_extra_setup() {
    register_nav_menu('primary', 'Main Nav');
    add_image_size( 'blog-feat', 635, 9999 );
    add_image_size( 'staff', 138, 138, true );
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'rcccs_extra_setup' );

// ADD SIDEBAR

function rcs_widgets_init() {

    register_sidebar( array(
        'name' => 'Services right sidebar',
        'id' => 'serv_right_1',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ) );
}
add_action( 'widgets_init', 'rcs_widgets_init' );

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

//toggle shortcode
function toggle_shortcode( $atts, $content = null ) {
    extract( shortcode_atts(
        array(
            'title' => 'Click To Open'
        ),
        $atts ) );
        $content = apply_filters('the_content', $content);
    return '<h2 class="trigger"><a href="#">'. $title .'</a></h2><div class="toggle_container">' . do_shortcode($content) . '</div>';
}
add_shortcode('toggle', 'toggle_shortcode');

// theme customizer
add_action('customize_register', 'rcccs_customize');
function rcccs_customize($wp_customize) {

    $wp_customize->add_section( 'contact_settings', array(
        'title'          => 'Contact Info'
    ) );

    $wp_customize->add_setting( 'contact_text', array(
        'default'        => 'We’re here to answer any questions you have. Send us an email or give us a call.',
    ) );

    $wp_customize->add_control( 'contact_text', array(
        'label'   => 'Contact Text',
        'section' => 'contact_settings',
        'type'    => 'text'
    ) );

    $wp_customize->add_setting( 'email_address', array(
        'default'        => 'hello@rivercityccs.com',
    ) );

    $wp_customize->add_control( 'email_address', array(
        'label'   => 'Email Address',
        'section' => 'contact_settings',
        'type'    => 'text'
    ) );

    $wp_customize->add_setting( 'phone_number', array(
        'default'        => '(804) 230-0999',
    ) );

    $wp_customize->add_control( 'phone_number', array(
        'label'   => 'Phone Number',
        'section' => 'contact_settings',
        'type'    => 'text'
    ) );

    $wp_customize->add_setting( 'facebook', array(
        'default'        => 'https://www.facebook.com/RiverCityCCS',
    ) );

    $wp_customize->add_control( 'facebook', array(
        'label'   => 'Facebook URL',
        'section' => 'contact_settings',
        'type'    => 'text'
    ) );
    $wp_customize->add_setting( 'twitter', array(
        'default'        => 'https://www.twitter.com/RiverCityCCS',
    ) );

    $wp_customize->add_control( 'twitter', array(
        'label'   => 'Twitter URL',
        'section' => 'contact_settings',
        'type'    => 'text'
    ) );

}

// GET POST ID BY SLUG
function get_ID_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

function my_acf_google_map_api( $api ){

    $api['key'] = 'AIzaSyBXMxOB-arIAIN3yo6XYc5o42n5vmluhao';

    return $api;

}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');