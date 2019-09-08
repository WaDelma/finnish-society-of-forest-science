<?php
/**
 * Finnish Society of Forest Science Theme Customizer
 *
 * @package Finnish_Society_of_Forest_Science
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function finnish_society_of_forest_science_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'finnish_society_of_forest_science_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'finnish_society_of_forest_science_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'finnish_society_of_forest_science_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function finnish_society_of_forest_science_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function finnish_society_of_forest_science_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function finnish_society_of_forest_science_customize_preview_js() {
	wp_enqueue_script( 'finnish-society-of-forest-science-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'finnish_society_of_forest_science_customize_preview_js' );
