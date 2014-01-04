<?php
/**
 * metric_av_main Theme Customizer
 *
 * @package metric_av_main
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 * @since metric_av_main 1.2
 */
function metric_av_main_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'metric_av_main_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since metric_av_main 1.2
 */
function metric_av_main_customize_preview_js() {
	wp_enqueue_script( 'metric_av_main_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20120827', true );
}
add_action( 'customize_preview_init', 'metric_av_main_customize_preview_js' );
