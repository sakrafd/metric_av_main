<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package metric_av_main
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function metric_av_main_infinite_scroll_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'content',
		'footer'    => 'page',
	) );

	// Add support for the Featured Content Plugin
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'metric_av_main_get_featured_posts',
		'description'             => __( 'The featured content section displays on the front page above the first post in the content area.', 'metric_av_main' ),
		'max_posts'               => 10,
	) );
}
add_action( 'after_setup_theme', 'metric_av_main_infinite_scroll_setup' );

/**
 * Featured Posts
 *
 * @since metric_av_main 1.0
 */
function metric_av_main_has_multiple_featured_posts() {
	$featured_posts = metric_av_main_get_featured_posts();
	return is_array( $featured_posts ) && 1 < count( $featured_posts );
}

function metric_av_main_get_featured_posts() {
	return apply_filters( 'metric_av_main_get_featured_posts', array() );
}
