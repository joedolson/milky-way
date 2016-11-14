<?php
/**
 *  Milky Way Theme Customizer
 *
 * @package milky-way
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
 
 /* .header, .sidebar, .content, .wrapper, .page-wrapper  */
add_action( 'customize_register', 'milky_way_customize_register' );
function milky_way_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport  = 'postMessage';
	// Add Sections
	$wp_customize->add_section( 'milky_way_colors' , array(
		'title' => __( 'Milky Way Colors', 'milky-way' ),
		'priority' => 201,
		'description' => __( 'Modify selected background colors. Text colors are automatically adjusted for you.', 'milky-way' ),
	) );
	$wp_customize->add_section( 'milky_way_content' , array(
		'title' => __( 'Milky Way Settings', 'milky-way' ),
		'priority' => 202,
		'description' => __( 'Additional content & display options.', 'milky-way' ),
	) );		
	//Add Settings
	$wp_customize->add_setting( 'milky_way_header_bg', array( 
		'default' => '#222222',
		'sanitize_callback' => 'sanitize_hex_color', 
	));
	$wp_customize->add_setting( 'milky_way_sidebar_bg', array( 
		'default' => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color', 
	));
	$wp_customize->add_setting( 'milky_way_content_bg', array( 
		'default' => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color', 
	));
	$wp_customize->add_setting( 'milky_way_footer_bg', array( 
		'default' => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color', 
	));	
	$wp_customize->add_setting( 'milky_way_menu_bg', array( 
		'default' => '#111111',
		'sanitize_callback' => 'sanitize_hex_color', 
	));		
	$wp_customize->add_setting( 'milky_way_content_display', array( 
		'default' => 'full',
		'sanitize_callback' => 'milky_way_sanitize_content_display', 
	));
	$wp_customize->add_setting( 'milky_way_sm_alignment', array( 
		'default' => 'center',
		'sanitize_callback' => 'milky_way_sanitize_sm_alignment', 
	));	
	$wp_customize->add_setting( 'milky_way_text_position', array( 
		'default' => '2em',
		'sanitize_callback' => 'sanitize_text_field', 
	));		
	$wp_customize->add_setting( 'milky_way_ajax_comments', array( 
		'default' => '1',
		'sanitize_callback' => 'milky_way_sanitize_checkbox', 
	));	
	// Header Background
	$wp_customize->add_control( 
	    new WP_Customize_Color_Control(
			$wp_customize,
			'milky_way_header_bg',
			array(
				'label' => __( 'Header Background', 'milky-way' ),
				'section' => 'milky_way_colors',
				'settings' => 'milky_way_header_bg',
			)
		)
	);
		
	// Menu Background
	$wp_customize->add_control( 
	    new WP_Customize_Color_Control(
			$wp_customize,
			'milky_way_menu_bg',
			array(
				'label' => __( 'Menu Background', 'milky-way' ),
				'section' => 'milky_way_colors',
				'settings' => 'milky_way_menu_bg',
			)
		)
	);	
	// Sidebar Background
	$wp_customize->add_control( 
	    new WP_Customize_Color_Control(
			$wp_customize,
			'milky_way_sidebar_bg',
			array(
				'label' => __( 'Sidebar Background', 'milky-way' ),
				'section' => 'milky_way_colors',
				'settings' => 'milky_way_sidebar_bg',
			)
		)
	);
	// Content Background
	$wp_customize->add_control(
	    new WP_Customize_Color_Control(
			$wp_customize,
			'milky_way_content_bg',
			array(
				'label' => __( 'Content Background', 'milky-way' ),
				'section' => 'milky_way_colors',
				'settings' => 'milky_way_content_bg',
			)
		)
	);

	// Page-Wrapper Background
	$wp_customize->add_control( 
	    new WP_Customize_Color_Control(
			$wp_customize,
			'milky_way_footer_bg',
			array(
				'label' => __( 'Footer Background', 'milky-way' ),
				'section' => 'milky_way_colors',
				'settings' => 'milky_way_footer_bg',
			)
		)
	);	
	
	// Content Display
	$wp_customize->add_control( 
		'milky_way_control_content', 
		array(
			'label'    => __( 'Display archive and home page content as', 'milky-way' ),
			'section'  => 'milky_way_content',
			'settings' => 'milky_way_content_display',
			'type'     => 'select',
			'choices'  => array(
				'full'    => __( 'Full Content', 'milky-way' ),
				'excerpt' => __( 'Excerpt', 'milky-way' ),
			),
		)
	);	
	
	// Content Display
	$wp_customize->add_control( 
		'milky_way_sm_alignment', 
		array(
			'label'    => __( 'Align Social Media', 'milky-way' ),
			'section'  => 'milky_way_content',
			'settings' => 'milky_way_sm_alignment',
			'type'     => 'select',
			'choices'  => array(
				'center' => __( 'Center', 'milky-way' ),
				'left'   => __( 'Left', 'milky-way' ),
				'right'  => __( 'Right', 'milky-way' ),
			),
		)
	);	

	$wp_customize->add_control( 
		'milky_way_text_position', 
		array(
			'label'    => __( 'Header text (distance from top)', 'milky-way' ),
			'section'  => 'milky_way_content',
			'settings' => 'milky_way_text_position',
			'type'     => 'text',
		)
	);	
	
	// Content Display
	$wp_customize->add_control( 
		'milky_way_ajax_comments', 
		array(
			'label'    => __( 'Use AJAX Comments', 'milky-way' ),
			'section'  => 'milky_way_content',
			'settings' => 'milky_way_ajax_comments',
			'type'     => 'checkbox'
		)
	);		
}

/**
 * Sanitize setting saved for content display. Only two values allowed.
*/
function milky_way_sanitize_content_display( $value ) {
	if ( $value == 'full' || $value == 'excerpt' ) {
		return $value;
	}
	return false;
}

/**
 * Sanitize setting saved for social network menu alignment. Only three values allowed.
*/
function milky_way_sanitize_sm_alignment( $value ) {
	if ( $value == 'center' || $value == 'left' || $value == 'right' ) {
		return $value;
	}
	
	return false;
}

/**
 * Sanitize the checkbox.
 *
 * @param boolean $input.
 * @return boolean (true|false).
 */
function milky_way_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function milky_way_customize_preview_js() {
	wp_enqueue_script( 'milky_way_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'milky_way_customize_preview_js' );