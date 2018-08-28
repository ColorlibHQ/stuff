<?php
/**
 * Stuff Theme Customizer Fields
 *
 * @package Stuff
 * @since   1.0
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Register customizer fields
 */

/**
 * Logo Dimension
 */

Epsilon_Customizer::add_field(
    'stuff_logo_dimensions',
    array(
        'type'           => 'epsilon-image-dimensions',
        'label'          => esc_html__( 'Logo Dimensions', 'stuff' ),
        'linked_control' => 'custom_logo',
        'section'        => 'title_tagline',
        'priority'       => 1,
    )
);

/**
 * Header Sticky Toggle
 */
Epsilon_Customizer::add_field(
    'stuff_fix_nav',
    array(
        'type'        => 'epsilon-toggle',
        'label'       => esc_html__( 'Sticky Navigation', 'stuff' ),
        'description' => esc_html__( 'Enable navigation to stay on top of viewport while you are scrolling', 'stuff' ),
        'section'     => 'header_image',
        'default'     => false,
    )
);

/**
 * Layout section options
 */
Epsilon_Customizer::add_field(
	'stuff_layout',
	array(
		'type'     => 'epsilon-layouts',
		'section'  => 'stuff_layout_section',
		'layouts'  => array(
			1 => get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/img/one-column.png',
			2 => get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/img/two-column.png',
		),
		'default'  => array(
			'columnsCount' => 2,
			'columns'      => array(
				1 => array(
					'index' => 1,
					'span'  => 8,
				),
				2 => array(
					'index' => 2,
					'span'  => 4,
				),
			),
		),
		'min_span' => 4,
		'fixed'    => true,
		'label'    => esc_html__( 'Blog Layout', 'stuff' ),
	)
);
Epsilon_Customizer::add_field(
	'stuff_page_layout',
	array(
		'type'     => 'epsilon-layouts',
		'section'  => 'stuff_layout_section',
		'layouts'  => array(
			1 => get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/img/one-column.png',
			2 => get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/img/two-column.png',
		),
		'default'  => array(
			'columnsCount' => 2,
			'columns'      => array(
				1 => array(
					'index' => 1,
					'span'  => 8,
				),
				2 => array(
					'index' => 2,
					'span'  => 4,
				),
			),
		),
		'min_span' => 4,
		'fixed'    => true,
		'label'    => esc_html__( 'Page Layout', 'stuff' ),
	)
);
/**
 * Typography section options
 */
Epsilon_Customizer::add_field(
	'stuff_typography_headings',
	array(
		'type'          => 'epsilon-typography',
		'transport'     => 'postMessage',
		'label'         => esc_html__( 'Headings', 'stuff' ),
		'section'       => 'stuff_layout_section',
		'description'   => esc_html__( 'Note: Current typography controls will only be affecting the blog.', 'stuff' ),
		'stylesheet'    => 'stuff-main',
		'choices'       => array(
			'font-family',
			'font-weight',
			'font-style',
			'letter-spacing',
		),
		'selectors'     => array(
			'#colorlib-breadcrumbs .breadcrumbs h2',
			'.sidebar-heading',
			'.heading-2',
			'h1',
			'h2',
			'h3',
			'h4',
			'h5',
			'h6',
			'.review .desc h4',
			'.comment-reply-title',
			'.colorlib-heading h2',
			'#colorlib-footer h2',
			'#colorlib-hero .flexslider .slider-text > .slider-text-inner h1',
			'.blog-entry .desc > h2',
		),
		'font_defaults' => array(
			'letter-spacing' => '0',
			'font-family'    => 'Roboto',
			'font-weight'    => '700',
			'font-style'     => 'normal',
		),
	)
);
Epsilon_Customizer::add_field(
	'stuff_paragraphs_typography',
	array(
		'type'          => 'epsilon-typography',
		'transport'     => 'postMessage',
		'section'       => 'stuff_layout_section',
		'label'         => esc_html__( 'Paragraphs', 'stuff' ),
		'description'   => esc_html__( 'Note: Current typography controls will only be affecting the blog.', 'stuff' ),
		'stylesheet'    => 'stuff-main',
		'choices'       => array(
			'font-family',
			'font-weight',
			'font-style',
		),
		'selectors'     => array(
			'body',
			'p',
			'#colorlib-breadcrumbs .breadcrumbs p',
			'.colorlib-nav ul li a',
			'.side #search',
			'.side.widget_categories ul li',
            '.side .category li',
			'.f-blog .desc h3',
			'.form-control',
			'.side .btn-subscribe',
			'.btn',
			'#colorlib-footer ul li',
			'#colorlib-footer .colorlib-footer-links li',
            '#colorlib-footer .tag-cloud-link',
            '#colorlib-footer .tags span a'
		),
		'font_defaults' => array(
			'font-family' => '',
			'font-weight' => '',
			'font-style'  => '',
		),
	)
);

/**
 * Blog section options
 */
Epsilon_Customizer::add_field(
    'stuff_enable_front_slider',
    array(
        'type'        => 'epsilon-toggle',
        'label'       => esc_html__( 'Frontpage Slider', 'stuff' ),
        'description' => esc_html__( 'Enable if you like to show recent post slider on front page', 'stuff' ),
        'section'     => 'stuff_blog_section',
        'default'     => true,
    )
);

//Get all categories
function get_all_categories(){
    $cat = array('all'=>'All');
    $categories = get_categories();
    foreach ($categories as $category){
        $cat[$category->slug] = $category->name;
    }
    return $cat;
}

/**
 * Slider category select
 */
Epsilon_Customizer::add_field(
    'stuff_slider_category',
    array(
        'type'        => 'select',
        'section'     => 'stuff_blog_section',
        'label'       => esc_html__('Slider post from category', 'stuff'),
        'default'     => 'all',
        'choices'     => get_all_categories(),
    )
);

/**
 * Post count on slider
 */
Epsilon_Customizer::add_field(
    'slider_post_count',
    array(
        'type'        => 'epsilon-slider',
        'section'     => 'stuff_blog_section',
        'label'       => esc_html__('Slider post count', 'stuff'),
        'default'     => 5,
        'choices'     => array(
            'min' => 2,
            'max' => 20,
        ),
    )
);


Epsilon_Customizer::add_field(
	'stuff_show_post_thumbnail',
	array(
		'type'        => 'epsilon-toggle',
		'label'       => esc_html__( 'Post Meta: Thumbnail', 'stuff' ),
		'description' => esc_html__( 'This option will disable the post thumbnail from the beginning of the post content.', 'stuff' ),
		'section'     => 'stuff_blog_section',
		'default'     => true,
	)
);

Epsilon_Customizer::add_field(
	'stuff_show_post_categories',
	array(
		'type'        => 'epsilon-toggle',
		'label'       => esc_html__( 'Post Meta: Categories', 'stuff' ),
		'description' => esc_html__( 'This will disable the category section at the beggining of the post.', 'stuff' ),
		'section'     => 'stuff_blog_section',
		'default'     => true,
	)
);


Epsilon_Customizer::add_field(
	'stuff_enable_author_meta',
	array(
		'type'        => 'epsilon-toggle',
		'label'       => esc_html__( 'Post meta: Author', 'stuff' ),
		'description' => esc_html__( 'Toggle the display of the author box, at the left side of the post. Will only display if the author has a description defined.', 'stuff' ),
		'section'     => 'stuff_blog_section',
		'default'     => true,
	)
);

Epsilon_Customizer::add_field(
	'stuff_show_post_tags',
	array(
		'type'        => 'epsilon-toggle',
		'label'       => esc_html__( 'Post Meta: Tags', 'stuff' ),
		'description' => esc_html__( 'This will disable the tags zone at the end of the post.', 'stuff' ),
		'section'     => 'stuff_blog_section',
		'default'     => false,
	)
);

Epsilon_Customizer::add_field(
	'stuff_show_blog_date',
	array(
		'type'        => 'epsilon-toggle',
		'label'       => esc_html__( 'Post Date', 'stuff' ),
		'description' => esc_html__( 'This will disable the post date from blog post', 'stuff' ),
		'section'     => 'stuff_blog_section',
		'default'     => true,
	)
);


/**
 * Footer section options
 */
Epsilon_Customizer::add_field(
	'stuff_enable_instagram_gallery',
	array(
		'type'        => 'epsilon-toggle',
		'label'       => esc_html__( 'Instagram Gallery', 'stuff' ),
		'description' => esc_html__( 'This will disable the instagram image gallery', 'stuff' ),
		'section'     => 'stuff_footer_section',
		'default'     => true,
	)
);
Epsilon_Customizer::add_field(
	'stuff_instagram_gallery_user',
	array(
		'type'        => 'text',
		'label'       => esc_html__( 'Instagram Gallery User', 'stuff' ),
		'section'     => 'stuff_footer_section',
		'sanitize_callback' => 'sanitize_text_field',
		'default'     => 'remonfoysal',
	)
);
Epsilon_Customizer::add_field(
	'stuff_footer_columns',
	array(
		'type'     => 'epsilon-layouts',
		'section'  => 'stuff_footer_section',
		'layouts'  => array(
			1 => get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/img/one-column.png',
			2 => get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/img/two-column.png',
			3 => get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/img/three-column.png',
			4 => get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/img/four-column.png',
		),
		'default'  => array(
			'columnsCount' => 4,
			'columns'      => array(
				array(
					'index' => 1,
					'span'  => 3,
				),
				array(
					'index' => 2,
					'span'  => 3,
				),
				array(
					'index' => 3,
					'span'  => 3,
				),
				array(
					'index' => 4,
					'span'  => 3,
				),
			),
		),
		'min_span' => 2,
		'label'    => esc_html__( 'Footer Columns', 'stuff' ),
	)
);

/**
 * Contact information title
 */
Epsilon_Customizer::add_field(
	'stuff_contact_info_title',
	array(
		'type'              => 'text',
		'section'           => 'stuff_contact_section',
		'sanitize_callback' => 'sanitize_text_field',
		'default'    		=> esc_html__( 'Contact Information', 'stuff' ),
		'label'             => esc_html__( 'Information Label', 'stuff' ),
	)
);

/**
 * Contact address
 */
Epsilon_Customizer::add_field(
    'stuff_contact_address',
    array(
        'type'              => 'textarea',
        'section'           => 'stuff_contact_section',
        'sanitize_callback' => 'wp_kses_post',
        'default'    		=> __( '198 West 21th Street, <br/>Suite 721 New York NY 10016', 'stuff' ),
        'label'             => esc_html__( 'Address', 'stuff' ),
    )
);

/**
 * Contact phone
 */
Epsilon_Customizer::add_field(
    'stuff_contact_phone',
    array(
        'type'              => 'text',
        'section'           => 'stuff_contact_section',
        'sanitize_callback' => 'sanitize_text_field',
        'default'    		=> esc_html__( '+ 1235 2355 98', 'stuff' ),
        'label'             => esc_html__( 'Phone', 'stuff' ),
    )
);

/**
 * Contact email
 */
Epsilon_Customizer::add_field(
    'stuff_contact_email',
    array(
        'type'              => 'text',
        'section'           => 'stuff_contact_section',
        'sanitize_callback' => 'sanitize_email',
        'default'    		=> esc_html__( 'info@yoursite.com', 'stuff' ),
        'label'             => esc_html__( 'Email', 'stuff' ),
    )
);

/**
 * Contact website
 */
Epsilon_Customizer::add_field(
    'stuff_contact_website',
    array(
        'type'              => 'text',
        'section'           => 'stuff_contact_section',
        'sanitize_callback' => 'sanitize_text_field',
        'default'    		=> esc_html__( 'yourwebsite.com', 'stuff' ),
        'label'             => esc_html__( 'Website', 'stuff' ),
    )
);

/**
 * Google Api KEY
 */
Epsilon_Customizer::add_field(
	'stuff_google_api_key',
	array(
		'type'              => 'text',
		'section'           => 'stuff_contact_section',
		'sanitize_callback' => 'sanitize_text_field',
		'label'             => esc_html__( 'Google Map API', 'stuff' ),
        'default'    		=> 'AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA',
	)
);

//Translators: Contact forms not found label
$forms[0] = esc_html__( '-- No Contact Forms --', 'stuff' );
if ( defined( 'WPCF7_VERSION' ) ) {
	$args = array(
		'post_type' => 'wpcf7_contact_form',
	);

	$posts = new WP_Query( $args );
	wp_reset_postdata();
	if ( $posts->have_posts() ) {
		//Translators: Select contact form label
		$forms[0] = esc_html__( '-- Select a Contact Form --', 'stuff' );

		while ( $posts->have_posts() ) {
			$posts->the_post();

			$forms[ get_the_ID() ] = get_the_title();
		}
	}
}

/**
 * Contact Form
 */
Epsilon_Customizer::add_field(
	'stuff_contact_form',
	array(
		'type'        => 'select',
		'section'     => 'stuff_contact_section',
		'label'       => 'Contact Form',
		'description' => 1 === count( $forms ) ? esc_html__( 'To use this section you need to create a contact form with CF7', 'stuff' ) : null,
		'default'     => 'no-forms',
		'choices'     => $forms,
	)
);

/**
 * Contact form title
 */
Epsilon_Customizer::add_field(
    'stuff_contact_title',
    array(
        'type'              => 'text',
        'section'           => 'stuff_contact_section',
        'sanitize_callback' => 'sanitize_text_field',
        'default'    		=> esc_html__( 'Get In Touch', 'stuff' ),
        'label'             => esc_html__( 'Contact form Title', 'stuff' ),
    )
);

/**
 * Copyright contents
 */
Epsilon_Customizer::add_field(
	'stuff_copyright_contents',
	array(
		'type'    => 'epsilon-text-editor',
		'default' => 'Stuff Themes &copy; 2018. All rights reserved.',
		'label'   => esc_html__( 'Copyright Text', 'stuff' ),
		'section' => 'stuff_footer_section',
	)
);

/**
 * Preloader
 */
Epsilon_Customizer::add_field(
    'stuff_enable_preloader',
    array(
        'type'        => 'epsilon-toggle',
        'label'       => esc_html__( 'Enable Preloader', 'stuff' ),
        'description' => esc_html__( 'Enable or disable preloader to show when site pages are loading', 'stuff' ),
        'section'     => 'stuff_misc_section',
        'default'     => true,
    )
);

/**
 * Go to top button
 */
Epsilon_Customizer::add_field(
    'stuff_enable_go_top',
    array(
        'type'        => 'epsilon-toggle',
        'label'       => esc_html__( 'Go to top button', 'stuff' ),
        'description' => esc_html__( 'Toggle the display of the go to top button.', 'stuff' ),
        'section'     => 'stuff_misc_section',
        'default'     => true,
    )
);
