<?php
/**
 * Stuff Theme Customizer repeatable sections
 *
 * @package Stuff
 * @since   1.0
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class Stuff_Repeatable_Sections
 */
class Stuff_Repeatable_Sections {
	/**
	 * Holds the sections
	 *
	 * @var array
	 */
	public $sections = array();

	/**
	 * Stuff_Repeatable_Sections constructor.
	 */
	public function __construct() {
		$this->collect_sections();
	}

	/** 
	 * Grab an instance of the sections
	 *
	 * @return Stuff_Repeatable_Sections
	 */
	public static function get_instance() {
		static $inst;
		if ( ! $inst ) {
			$inst = new Stuff_Repeatable_Sections();
		}

		return $inst;
	}

	/**
	 * Create the section array
	 */
	public function collect_sections() {
		$methods = get_class_methods( 'Stuff_Repeatable_Sections' );
		foreach ( $methods as $method ) {
			if ( false !== strpos( $method, 'repeatable_' ) ) {
				$section = $this->$method();

				if ( ! empty( $section ) ) {
					$this->sections[ $section['id'] ] = $section;
				}
			}
		}

		$this->sections = apply_filters( 'stuff_section_collection', $this->sections );
	}

	/**
	 * Repeatable about section
	 *
	 * @return array
	 */
	private function repeatable_about() {
		return array(
			'id'            => 'about',
			'title'         => esc_html__( 'About Section', 'stuff' ),
			'description'   => esc_html__( 'About section. It retrieves content from Theme Content / Services', 'stuff' ),
			'image'         => esc_url( get_template_directory_uri() . '/assets/images/sections/ewf-icon-section-about-pt.png' ),
			'customization' => array(
				'enabled' => true,
				'layout'  => array(
					'row-title-align'           => array(
						'default' => 'right',
						'choices' => array( 'left', 'right', ),
					),
					'column-stretch'            => array(
						'default' => 'boxedin',
						'choices' => array( 'boxedcenter', 'boxedin', 'fullwidth', ),
					),
					'row-spacing-top'           => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none', ),
					),
					'row-spacing-bottom'        => array(
						'default' => 'md',
						'choices' => array( 'lg', 'md', 'sm', 'none', ),
					),
					'column-alignment'          => array(
						'default' => 'left',
						'choices' => array( 'left', 'center', 'right', ),
					),
					'column-vertical-alignment' => array(
						'default' => 'middle',
						'choices' => array( 'top', 'middle', 'bottom', ),
					),
				),
				'styling' => array(
					'background-color'         => array(
						'default' => false,
					),
					'background-color-opacity' => array(
						'default' => 1,
					),
					'background-image'         => array(
						'default' => false,
					),
					'background-position'      => array(
						'default' => 'center',
					),
					'background-size'          => array(
						'default' => 'initial',
					),
					'background-repeat'        => array(
						'default' => 'repeat'
					),
					'background-parallax'      => array(
						'default' => false,
					),
					'background-video'         => array(
						'default' => '',
					),
				),
				'colors'  => array(
					'heading-color' => array(
						'selectors' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.headline span', ),
						'default'   => '',
					),
					'text-color'    => array(
						'selectors' => array( 'p', ),
						'default'   => '',
					),
				),
			),
			'fields'        => array(
				'about_title'             => array(
					'label'             => esc_html__( 'Title', 'stuff' ),
					'type'              => 'text',
					'default'           => esc_html__( 'Learn more about us and how can we help you:', 'stuff' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'about_subtitle'          => array(
					'label'             => esc_html__( 'Subtitle', 'stuff' ),
					'type'              => 'text',
					'default'           => wp_kses_post( 'ABOUT' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'about_text'              => array(
					'label'             => esc_html__( 'Information', 'stuff' ),
					'type'              => 'epsilon-text-editor',
					'default'           => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lacinia velit quis sem dignissim porta. Aliquam risus lorem, ornare sed diam at, ultrices vehicula enim. Morbi pharetra ligula nulla, non blandit velit tempor vel.', 'stuff' ),
					'sanitize_callback' => 'wp_kses_post',
				),
				'about_image'             => array(
					'label'   => esc_html__( 'Image', 'stuff' ),
					'type'    => 'epsilon-image',
					'size'    => 'large',
					'default' => esc_url( get_template_directory_uri() . '/assets/images/01_about.png' ),
				),
				'about_section_unique_id' => array(
					'label'             => esc_html__( 'Section ID', 'stuff' ),
					'type'              => 'text',
					'sanitize_callback' => 'sanitize_key',
				),
			),
		);
	}


}
