<?php
/**
 * metric_av_main functions and definitions
 *
 * @package metric_av_main
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since metric_av_main 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 700; /* pixels */

if ( ! function_exists( 'metric_av_main_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since metric_av_main 1.0
 */
function metric_av_main_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on metric_av_main, use a find and replace
	 * to change 'metric_av_main' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'metric_av_main', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
	set_post_thumbnail_size( 150, 150 );
	add_image_size( 'slider-img', 1440, 400, true );
	add_image_size( 'content-img', 300, 168, true );
	add_image_size( 'thumbnail-img', 62, 62, true );
	add_image_size( 'feat-img', 1000 );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'metric_av_main' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
endif; // metric_av_main_setup
add_action( 'after_setup_theme', 'metric_av_main_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Hooks into the after_setup_theme action.
 */
function metric_av_main_register_custom_background() {
	add_theme_support( 'custom-background', apply_filters( 'metric_av_main_custom_background_args', array(
		'default-color' => 'ffffff',
	) ) );
}
add_action( 'after_setup_theme', 'metric_av_main_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since metric_av_main 1.0
 */
function metric_av_main_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'metric_av_main' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'metric_av_main_widgets_init' );

/**
 * Enqueue Google Fonts
 */
function metric_av_main_fonts() {
	/*	translators: If there are characters in your language that are not supported
		by Raleway or Arvo, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Web font: on or off', 'metric_av_main' ) ) {
		$protocol = is_ssl() ? 'https' : 'http';
		wp_register_style( 'metric_av_main-webfont', "$protocol://fonts.googleapis.com/css?family=Raleway:400,600|Arvo:400,700" );
	}
}
add_action( 'init', 'metric_av_main_fonts' );

/**
 * Enqueue font styles in custom header admin
 */
function metric_av_main_admin_fonts( $hook_suffix ) {
	if ( 'appearance_page_custom-header' != $hook_suffix )
		return;

	wp_enqueue_style( 'metric_av_main-webfont' );
}
add_action( 'admin_enqueue_scripts', 'metric_av_main_admin_fonts' );

/**
 * Enqueue scripts and styles
 */
function metric_av_main_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'metric_av_main-webfont' );

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'metric_av_main-script', get_template_directory_uri() . '/js/metric_av_main.js', array( 'jquery', 'metric_av_main-flex-slider' ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

	wp_enqueue_style( 'metric_av_main-flex-slider-style', get_template_directory_uri() . '/js/flex-slider/flexslider.css', array(), '2.0' );
	wp_enqueue_script( 'metric_av_main-flex-slider', get_template_directory_uri() . '/js/flex-slider/jquery.flexslider-min.js', array( 'jquery' ), '2.1' );

}
add_action( 'wp_enqueue_scripts', 'metric_av_main_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Implement the Custom Header feature
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Load Jetpack compatibility file.
 */
if ( file_exists( get_template_directory() . '/inc/jetpack.php' ) )
	require get_template_directory() . '/inc/jetpack.php';

