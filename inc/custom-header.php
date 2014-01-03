<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php $header_image = get_header_image();
	if ( ! empty( $header_image ) ) { ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		</a>
	<?php } // if ( ! empty( $header_image ) ) ?>

 *
 * @package metric_av_main
 * @since metric_av_main 1.0
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses book_lite_header_style()
 * @uses book_lite_admin_header_style()
 * @uses book_lite_admin_header_image()
 *
 * @package metric_av_main
 */
function book_lite_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'book_lite_custom_header_args', array(
		'default-image'          => get_template_directory_uri() . '/images/default-header.jpg',
		'default-text-color'     => 'ffffff',
		'width'                  => 1440,
		'height'                 => 500,
		'wp-head-callback'       => 'book_lite_header_style',
		'admin-head-callback'    => 'book_lite_admin_header_style',
		'admin-preview-callback' => 'book_lite_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'book_lite_custom_header_setup' );

if ( ! function_exists( 'book_lite_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see book_lite_custom_header_setup().
 *
 * @since metric_av_main 1.0
 */
function book_lite_header_style() {

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() )
		return;

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		.site-title,
		.site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
		.site-title a:hover {
			opacity: 0.7;
		}
	<?php endif; ?>

	</style>
	<?php
}
endif; // book_lite_header_style

if ( ! function_exists( 'book_lite_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see book_lite_custom_header_setup().
 *
 * @since metric_av_main 1.0
 */
function book_lite_admin_header_style() {

	$header_image = get_header_image();

?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		<?php if ( ! empty( $header_image ) ) : ?>
			background: url(<?php echo esc_url( $header_image ); ?>) center 0 no-repeat;
			background-attachment: fixed;
			height: 500px;
			margin-top: 0;
			padding-bottom: 0;
			position: relative;
		<?php endif; ?>
		border: none;
	}
	#headimg h1,
	#desc {
		font-family: 'Century Schoolbook', Century, Garamond, serif;
	}
	#headimg h1 {
		font-size: 48px;
		padding-bottom: 28.796875px;
		padding-left: 0;
		padding-right: 0;
		padding-top: 144px;
		text-align: center;
		font-weight: bold;
		line-height: 1.2;
		margin: 0 auto;
		max-width: 750px;
		position: relative;
		text-transform: uppercase
	}
	#headimg h1 a {
		text-decoration: none;
	}
	#headimg h1 a:hover {
		opacity: .7;
	}
	#desc {
		font-style: italic;
		padding: 0 0 34.1875px;
		max-width: 70%;
		margin: 0 auto;
		text-align: center;
		font-size: 17px;
	}
	#headimg img {
	}
	</style>
<?php
}
endif; // book_lite_admin_header_style

if ( ! function_exists( 'book_lite_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see book_lite_custom_header_setup().
 *
 * @since metric_av_main 1.0
 */
function book_lite_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_header_textcolor() || '' == get_header_textcolor() )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_header_textcolor() . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
	</div>
<?php }
endif; // book_lite_admin_header_image


if ( ! function_exists( 'book_lite_custom_header_image' ) ) :
/**
 * Header image styles for custom header and featured images
 *
 * @since metric_av_main 1.0
 */
function book_lite_custom_header_image() {

	$header_image = get_header_image();
	global $content_width;
?>

	<style type="text/css">

	<?php

	if ( ! empty( $header_image ) ) :

		$textcolor = "#fff";
		$background = "rgba(0,0,0,.7)"; ?>

		#masthead {
			background: url( <?php echo esc_url( $header_image ); ?> ) center 0 no-repeat;
			margin-top: 0;
			padding-bottom: 0;
			max-width: 100%;
			height: <?php echo get_custom_header()->height; ?>px;
			position: relative;
			background-attachment: fixed;
		}
		.admin-bar #masthead {
			background-position: center 28px;
		}
		hgroup {
			position: absolute;
			bottom: 50px;
			width: 100%;
		}
		.site-title {
			max-width: <?php echo $content_width; ?>px;
			margin: auto;
		}
		h2.site-description {
			max-width: <?php echo ( $content_width - 200 ); ?>px;
		}
		#page {
			max-width: 100%;
		}
		#main,
		#colophon {
			max-width: <?php echo $content_width; ?>px;
			margin: 0 auto;
		}
		.main-navigation {
			background: <?php echo $background; ?>;
		}
		.main-navigation ul a {
			color: #ccc;
		}
		.main-navigation ul li:after {
			color: #ccc;
		}
		.main-navigation li.current_page_item a,
		.main-navigation li.current-menu-item a {
			color: #888;
		}
		.main-navigation ul li:first-child {
			background: none;
		}

	<?php endif; // !empty header_image()

	if ( is_single() || is_page() ) :

		if ( '' != get_the_post_thumbnail() ) :

			$featured_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'featured-thumbnail' );
			$header_image = "background: url(" . $featured_image_url[0] . ") center 0 no-repeat; background-attachment: fixed;";
			$menubackground = "rgba(0,0,0,.7)";
			$mastheadbackground = "#111";
			$mastheadheight = "500px";
			$paddingbottom = "0"; ?>

			hgroup {
				position: absolute;
				bottom: 50px;
				width: 100%;
			}
			#masthead {
				<?php echo $header_image; ?>
				margin-top: 0;
				padding-bottom: <?php echo $paddingbottom; ?>;
				max-width: 100%;
				height: <?php echo $mastheadheight; ?>;
				position: relative;
				background-color: <?php echo $mastheadbackground; ?>;
			}
			.admin-bar.custom-header #masthead {
				background-position: center 28px;
			}
			#page {
				max-width: 100%;
			}
			#main,
			#colophon {
				max-width: <?php echo $content_width; ?>px;
				margin: 0 auto;
			}
			.main-navigation {
				background: <?php echo $menubackground; ?>;
			}
			.main-navigation ul a {
				color: #ccc;
			}
			.main-navigation ul li:after {
				color: #ccc;
			}
			.main-navigation ul li:last-child:after {
				content: "";
				margin: 0;
			}
			.main-navigation li.current_page_item a,
			.main-navigation li.current-menu-item a {
				color: #888;
			}

		<?php endif; //'' != get_the_post_thumbnail() ?>
	<?php endif; //is_single() && ! is_attachment() ?>
	</style>
<?php
}
endif; // book_lite_custom_header_image

add_action( 'wp_head', 'book_lite_custom_header_image' );
