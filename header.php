<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package metric_av_main
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<?php do_action( 'before' ); ?>
		<div id="masthead-wrap">
			<header id="masthead" class="site-header" role="banner">
				<div class="nav-wrap">
					<nav role="navigation" class="site-navigation main-navigation">

            <div class="menu-logo-container">
              <div class="menu-logo">
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="menu-logo"><img src="<?php echo get_template_directory_uri(); ?>/images/metric_logo.png" class="size-full" alt="Metric Audio Video" width="134" height="40" /></a></div>



           <div class="menu-menu">
						<h1 class="assistive-text"><?php _e( 'Menu', 'metric_av_main' ); ?></h1>

						<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
            </div></div>
					</nav><!-- .site-navigation -->
				</div><!-- .nav-wrap -->
			</header><!-- #masthead -->
		</div><!-- #masthead-wrap -->
