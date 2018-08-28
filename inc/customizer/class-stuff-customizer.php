<?php
/**
 * Stuff Theme Customizer settings
 *
 * @package Stuff
 * @since   1.0
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class Stuff_Customizer
 */
class Stuff_Customizer {

	/**
	 * The basic constructor of the helper
	 * It changes the default panels of the customizer
	 *
	 * Stuff_Customizer_Helper constructor.
	 */
	public function __construct() {
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'customizer_enqueue_scripts' ) );
		add_action( 'customize_preview_init', array( $this, 'customize_preview_js' ) );
		/**
		 * Customizer enqueues & controls
		 */
		add_action( 'customize_register', array( $this, 'add_theme_options' ), 99 );
		$this->change_default_panels();
	}

	/**
	 * Loads the settings for the panels
	 */
	public function add_theme_options() {
		$path = get_template_directory() . '/inc/customizer/settings';

		require_once $path . '/sections.php';
		require_once $path . '/fields.php';
	}

	/**
	 * Runs on initialization, changes the default panels to the Theme options
	 */
	public function change_default_panels() {
		global $wp_customize;

		/**
		 * Change transports
		 */
		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		$wp_customize->get_setting( 'custom_logo' )->transport     = 'refresh';

		/**
		 * Change panels
		 */
		$wp_customize->get_section( 'header_image' )->panel      = 'stuff_panel_general';
		$wp_customize->get_section( 'background_image' )->panel  = 'stuff_panel_general';
		$wp_customize->get_section( 'colors' )->panel            = 'stuff_panel_general';
		$wp_customize->get_section( 'title_tagline' )->panel     = 'stuff_panel_general';

		/**
		 * Change priorities
		 */
		$wp_customize->get_section( 'title_tagline' )->priority     = 0;
		$wp_customize->get_control( 'custom_logo' )->priority       = 0;
		$wp_customize->get_control( 'blogname' )->priority          = 2;
		$wp_customize->get_section( 'header_image' )->priority      = 4;
		$wp_customize->get_control( 'blogdescription' )->priority   = 17;
		$wp_customize->get_control( 'header_textcolor' )->priority  = 15;
		$wp_customize->get_section( 'static_front_page' )->priority = 0;
		/**
		 * Change labels
		 */
		$wp_customize->get_control( 'custom_logo' )->description   = esc_html__( 'The image logo, if set, will override the text logo. You can not have both at the same time. A tagline can be displayed under the text logo.', 'stuff' );
		$wp_customize->get_section( 'header_image' )->title        = esc_html__( 'Header options', 'stuff' );
		$wp_customize->get_section( 'colors' )->title        = esc_html__( 'Color options', 'stuff' );
        $wp_customize->remove_control( 'header_textcolor' );
		$wp_customize->get_control( 'page_on_front' )->description = esc_html__( 'If you have front-end sections, those will be displayed instead. Consider adding a "Content Section" if you need to display the page content as well.', 'stuff' );

        //Add settings
        $wp_customize->add_setting( 'stuff_theme_color', array(
            'default'        => '#F6490D',
            'sanitize_js_callback' => 'maybe_hash_hex_color',
        ) );

        $wp_customize->add_setting( 'stuff_secondary_color', array(
            'default'        => '#f75b26',
            'sanitize_js_callback' => 'maybe_hash_hex_color',
        ) );

        $wp_customize->add_setting( 'stuff_title_color', array(
            'default'        => '#000000',
            'sanitize_js_callback' => 'maybe_hash_hex_color',
        ) );

        $wp_customize->add_setting( 'stuff_text_color', array(
            'default'        => '#666666',
            'sanitize_js_callback' => 'maybe_hash_hex_color',
        ) );

		//Add control
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'stuff_theme_color', array(
            'label'   => esc_html__( 'Theme Color', 'stuff' ),
            'section' => 'colors',
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'stuff_secondary_color', array(
            'label'   => esc_html__( 'Theme Secondary Color', 'stuff' ),
            'section' => 'colors',
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'stuff_title_color', array(
            'label'   => esc_html__( 'Title Color', 'stuff' ),
            'section' => 'colors',
        ) ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'stuff_text_color', array(
            'label'   => esc_html__( 'Text Color', 'stuff' ),
            'section' => 'colors',
        ) ) );


		if ( ! isset( $wp_customize->selective_refresh ) ) {
			return;
		}

		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title',
			'render_callback' => function () {
				bloginfo( 'name' );
			},
		) );

		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => function () {
				bloginfo( 'description' );
			},
		) );
	}

	/**
	 * Our Customizer script
	 *
	 * Dependencies: Customizer Controls script (core)
	 */
	public function customizer_enqueue_scripts() {
		wp_enqueue_script( 'stuff-customizer-scripts', get_template_directory_uri() . '/inc/customizer/assets/js/customizer.js', array( 'customize-controls' ) );

		wp_localize_script(
			'stuff-customizer-scripts',
			'stuffCustomizer',
			array(
				'templateDirectory' => esc_url( get_template_directory_uri() ),
				'ajaxNonce'         => wp_create_nonce( 'stuff_nonce' ),
				'siteUrl'           => esc_url( get_site_url() ),
				'blogPage'          => esc_url( get_permalink( get_option( 'page_for_posts', false ) ) ),
				'frontPage'         => esc_url( get_permalink( get_option( 'page_on_front', false ) ) ),
			)
		);
	}

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 */
	public function customize_preview_js() {
		wp_enqueue_script( 'stuff-previewer', get_template_directory_uri() . '/inc/customizer/assets/js/previewer.js', array( 'customize-preview' ), '211215', true );
	}

	/**
	 * Active Callback for copyright
	 */
	public static function copyright_enabled_callback( $control ) {
		if ( $control->manager->get_setting( 'stuff_enable_copyright' )->value() == true ) {
			return true;
		}

		return false;
	}

	/**
	 * Active callback for stuff_header_top_bar
	 */
	public static function header_top_bar_enabled_callback( $control ) {
		if ( $control->manager->get_setting( 'stuff_header_top_bar' )->value() == true ) {
			return true;
		}

		return false;
	}
}
