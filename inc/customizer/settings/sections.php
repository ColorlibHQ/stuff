<?php
/**
 * Stuff Theme Customizer Panels & Sections
 *
 * @package Stuff
 * @since   1.0
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Register customizer panels
 */
$panels = array(
	/**
	 * Theme panel
	 */
	array(
		'id'   => 'stuff_panel_general',
		'args' => array(
			'priority'       => 0,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Theme Options', 'stuff' ),
		),
	),
);

/**
 * Register sections
 */
$sections = array(
	/**
	 * General section
	 */
	array(
		'id'   => 'stuff_layout_section',
		'args' => array(
			'title'    => esc_html__( 'Layout & Typography', 'stuff' ),
			'panel'    => 'stuff_panel_general',
		),
	),
    array(
        'id'   => 'stuff_blog_section',
        'args' => array(
            'title'    => esc_html__( 'Blog Options', 'stuff' ),
            'panel'    => 'stuff_panel_general',
        ),
    ),
	array(
		'id'   => 'stuff_footer_section',
		'args' => array(
			'title'    => esc_html__( 'Footer Options', 'stuff' ),
			'panel'    => 'stuff_panel_general',
		),
	),
	array(
		'id'   => 'stuff_contact_section',
		'args' => array(
			'title'    => esc_html__( 'Contact Page', 'stuff' ),
			'panel'    => 'stuff_panel_general',
		),
	),
    array(
        'id'   => 'stuff_misc_section',
        'args' => array(
            'title'    => esc_html__( 'Misc Options', 'stuff' ),
            'panel'    => 'stuff_panel_general',
        ),
    ),
);

$visible_recommended = get_option( 'stuff_recommended_actions', false );
if ( $visible_recommended ) {
	unset( $sections[0] );
}

$collection = array(
	'panel'   => $panels,
	'section' => $sections,
);

Epsilon_Customizer::add_multiple( $collection );
