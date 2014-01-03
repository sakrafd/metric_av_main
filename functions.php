<?php
/**
 * metric_av_main functions and definitions
 *
 * @package metric_av_main
 * @since metric_av_main 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since metric_av_main 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 750; /* pixels */

if ( ! function_exists( 'book_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since metric_av_main 1.0
 */
function book_lite_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on metric_av_main, use a find and replace
	 * to change 'book-lite' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'book-lite', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'featured-thumbnail', 1440, 500, true );

	/**
	 * Enable support for Infinite Scroll
	 */
	add_theme_support( 'infinite-scroll', array(
		'type'           => 'scroll',
		'footer_widgets' => array( 'footer-1', 'footer-2', 'footer-3' ),
		'container'      => 'content',
		'footer'		 => 'main',
	) );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'book-lite' ),
	) );

	/**
	 * Add support for required post formats
	 */

	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Add support for custom backgrounds
	 */

	add_theme_support( 'custom-background' );
}
endif; // book_lite_setup
add_action( 'after_setup_theme', 'book_lite_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since metric_av_main 1.0
 */
function book_lite_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer One', 'booklite' ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Two', 'booklite' ),
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Three', 'booklite' ),
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'book_lite_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function book_lite_scripts() {
	wp_enqueue_style( 'book-lite-style', get_stylesheet_uri() );

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	if ( is_singular() && wp_attachment_is_image() )
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
}
add_action( 'wp_enqueue_scripts', 'book_lite_scripts' );


/**
 * Enqueue sidebar styles, which change widths depending on the number of sidebars present
 */

function book_lite_sidebar_styles() {

	if ( ! is_active_sidebar( 'footer-1' ) && ! is_active_sidebar( 'footer-2' ) && ! is_active_sidebar( 'footer-3' ) )
		return;

	$num_sidebars = 0;

	if ( is_active_sidebar( 'footer-1' ) )
		$num_sidebars++;

	if ( is_active_sidebar( 'footer-2' ) )
		$num_sidebars++;

	if ( is_active_sidebar( 'footer-3' ) )
		$num_sidebars++;

	switch( $num_sidebars ) :

		case 1:
			$width = '100%';
			break;

		case 2:
			$width = '49%';
			break;

		default:
			$width = '32%';

	endswitch; ?>

	<style type="text/css">
		 .widget-area {
		 	width: <?php echo esc_html( $width ); ?>;
		 }
	</style>
<?php }
add_action( 'wp_enqueue_scripts', 'book_lite_sidebar_styles' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';


// updater for WordPress.com themes
if ( is_admin() )
	include dirname( __FILE__ ) . '/inc/updater.php';
