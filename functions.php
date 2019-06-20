<?php
/**
 * Stuff functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Stuff
 * @since Stuff 1.0
 */

/**
 * Stuff only works in WordPress 4.4 or later.
 */



/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own stuff_setup() function to override in a child theme.
 *
 * @since Stuff 1.0
 */
/*-----------------------------------------------------
* 				Define Default Constants
*----------------------------------------------------*/

define( 'STUFF_THEME_DIR', get_template_directory() );
define( 'STUFF_THEME_URI', get_template_directory_uri() );
define( 'STUFF_THEME_SUB_DIR', STUFF_THEME_DIR.'/inc/' );
define( 'STUFF_CSS', STUFF_THEME_URI.'/css/' );
define( 'STUFF_JS', STUFF_THEME_URI.'/js/' );


/*-----------------------------------------------------
 * 				Load Require File
 *----------------------------------------------------*/
require_once STUFF_THEME_SUB_DIR . 'stuff-functions.php';
require_once STUFF_THEME_SUB_DIR . 'stuff-wp-navwalker.php';
require_once STUFF_THEME_SUB_DIR . 'stuff-user-profile.php';
require_once STUFF_THEME_SUB_DIR . 'widgets/stuff_widget.php';


/*-----------------------------------------------------
* 				Stuff Theme Setup
*----------------------------------------------------*/

if ( ! function_exists( 'stuff_setup' ) ) :
    function stuff_setup(){

        // Custom Header
        add_theme_support( 'custom-header', array(
                'default-text-color' => '#000',
                'width'              => 1920,
                'height'             => 180,
                'flex-width'         => true,
                'flex-height'        => true,
            )
        );

        // Custom Background
        add_theme_support( "custom-background" );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        //*set image size *//
        add_image_size('post-thumbnail',800,4000,false);
        add_image_size('post-thumbnail-small',70,60,true);

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for custom logo.
         *
         *  @since  Stuff 1.0
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 29,
            'width'       => 100,
            'flex-height' => true,
        ) );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 1200, 9999 );

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary Menu', 'stuff'),
        ) );
        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'status',
            'audio',
            'chat',
        ) );

        // Indicate widget sidebars can use selective refresh in the Customizer.
        add_theme_support( 'customize-selective-refresh-widgets' );
    }
endif; // stuff_setup
add_action( 'after_setup_theme', 'stuff_setup' );

/*-----------------------------------------------------
 * 				Load  Style And Script
 *----------------------------------------------------*/

function stuff_enqueue_styles_scripts(){

    //add style
    $googleFontOption = array(
        'family' => 'Roboto:300,400,700',
    );
    wp_enqueue_style( 'google_fonts', add_query_arg( $googleFontOption, "//fonts.googleapis.com/css" ) );

    wp_enqueue_style( 'animate', STUFF_CSS . 'animate.css' );
    wp_enqueue_style( 'icomoon', STUFF_CSS . 'icomoon.css' );
    wp_enqueue_style( 'bootstrap', STUFF_CSS . 'bootstrap.css' );
    wp_enqueue_style( 'magnific-popup', STUFF_CSS . 'magnific-popup.css' );
    wp_enqueue_style( 'flexslider', STUFF_CSS . 'flexslider.css' );
    wp_enqueue_style( 'owl-carousel', STUFF_CSS . 'owl.carousel.min.css' );
    wp_enqueue_style( 'owl-theme', STUFF_CSS . 'owl.theme.default.min.css' );
    wp_enqueue_style( 'theme-css', STUFF_CSS . 'style.css' );

    wp_enqueue_style('stuff',get_stylesheet_uri());

    //add script
    wp_enqueue_script('modernizr',STUFF_JS.'modernizr-2.6.2.min.js',array('jquery'), '2.6.2', false);
    wp_enqueue_script('respond',STUFF_JS.'respond.min.js',array('jquery'), '1.4.2', false);
    wp_enqueue_script('jquery-easing',STUFF_JS.'jquery.easing.1.3.js',array('jquery'), '1.3', true);
    wp_enqueue_script('bootstrap-js',STUFF_JS.'bootstrap.min.js',array('jquery'), '3.3.5',true);
    wp_enqueue_script('jquery-waypoints',STUFF_JS.'jquery.waypoints.min.js',array('jquery'), '4.0.0', true);
    wp_enqueue_script('jquery-flexslider',STUFF_JS.'jquery.flexslider-min.js',array('jquery'), '2.6.0', true);
    wp_enqueue_script('owl-carousel-js',STUFF_JS.'owl.carousel.min.js',array('jquery'), '2.0.6', true);
    wp_enqueue_script('jquery-magnific-js',STUFF_JS.'jquery.magnific-popup.min.js',array('jquery'), '0.9.9', true);
    wp_enqueue_script('magnific-popup-options',STUFF_JS.'magnific-popup-options.js',array('jquery'), '0.9.9',true);
    wp_enqueue_script('instagram-feed',STUFF_JS.'jquery.instagramFeed.min.js',array('jquery'), '1.0.0', true);
    wp_enqueue_script('stuff-main',STUFF_JS.'main.js',array('jquery'), '1.0.0', true);

    $string = '';
    $api    = get_theme_mod( 'stuff_google_api_key', 'AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA' );
    if ( ! empty( $api ) ) {
        $string = '?key=' . $api;
    }

    wp_enqueue_script( 'googlemaps', '//maps.googleapis.com/maps/api/js' . $string, array(), '1.0.0', true );
    wp_enqueue_script( 'map-function', STUFF_JS.'google_map.js', array('jquery'), '1.0.0', true);

    //reply comments
    if ( is_singular() && comments_open() && get_option('thread_comments') ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action('wp_enqueue_scripts','stuff_enqueue_styles_scripts');


/*-----------------------------------------------------
 * 				Define  Content Width
 *----------------------------------------------------*/
function stuff_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'stuff_content_width', 900 );
}
add_action( 'after_setup_theme', 'stuff_content_width', 0 );

/*-----------------------------------------------------
 * 				Site Logo
 *----------------------------------------------------*/

function stuff_logo(){
    if ( function_exists( 'the_custom_logo' ) ) {
        if ( has_custom_logo() ) {
            Epsilon_Helper::get_image_with_custom_dimensions( 'stuff_logo_dimensions' );
        }
        else{
	        ?>
            <div id="colorlib-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('name')?></a></div>
            <span class="header_tagline"><?php echo esc_html( get_bloginfo('description') ) ?></span>
	        <?php
        }
    }
}

/*-----------------------------------------------------
 * 				Excerpt Length
 *----------------------------------------------------*/

if(!function_exists('stuff_excerpt')):
    function stuff_excerpt($limit) {
        $excerpt = explode(' ', get_the_excerpt(), $limit);
        if (count($excerpt)>=$limit) {
            array_pop($excerpt);
            $excerpt = implode(" ",$excerpt);
        } else {
            $excerpt = implode(" ",$excerpt);
        }
        $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
        return $excerpt;
    }
endif;

/*-----------------------------------------------------
 * 				Post Pagination
 *----------------------------------------------------*/

if(!function_exists('stuff_pagination')){
    function stuff_pagination(){
        return the_posts_pagination( array(
            'mid_size' => 3,
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;',
            'screen_reader_text' => esc_html__( '&nbsp;', 'stuff' ),
        ) );
    }
}

/**
 * Registers an editor stylesheet for the theme.
 */
function stuff_theme_add_editor_styles() {
	add_editor_style( get_template_directory_uri() . '/css/custom-editor-style.css' );
}
add_action( 'admin_init', 'stuff_theme_add_editor_styles' );

/*-----------------------------------------------------
 * 				Comments Function
 *----------------------------------------------------*/

if(!function_exists('stuff_comments')){
    function stuff_comments($comment,$args,$depth){
        $GLOBALS['comment'] = $comment;
        extract($args, EXTR_SKIP);

        ?>
    <div id="comment-<?php comment_ID(); ?>" class="review">
            <div class="user-img"><?php  echo get_avatar( $comment,80,null,null,array('class'=>array('comment-avatar img-responsive'))); ?></div>
            <div class="desc">
                <h4>
                    <span class="text-left"><?php comment_author_link(); ?></span>
                    <span class="text-right"><?php the_time(get_option( 'date_format' )); ?></span>
                </h4>
                <?php comment_text(); ?>
                <p class="star">
                    <span class="text-left">
                        <?php comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'],'reply_text'=>'<i class="icon-reply"></i>' ) ) ); ?>
                    </span>
                </p>
            </div>
        <?php
    }
}

/*-----------------------------------------------------
 * 				Register widget area
 *----------------------------------------------------*/

if(!function_exists('stuff_register_sidebar')):

    function stuff_register_sidebar()
    {
        register_sidebar(
            array(
                'name' 			=> esc_html__( 'Main Sidebar', 'stuff' ),
                'id' 			=> 'main-sidebar',
                'class'         => 'stuff-main-sidebar',
                'description' 	=> esc_html__( 'Widgets in this area will be shown on Sidebar.', 'stuff' ),
                'before_title' 	=> '<h2 class="sidebar-heading">',
                'after_title' 	=> '</h2>',
                'before_widget' => '<div id="%1$s" class="%2$s side">',
                'after_widget' 	=> '</div>'
            )
        );

        register_sidebar(
            array(
                'name' 			=> esc_html__( '[Footer] Sidebar #1', 'stuff' ),
                'id' 			=> 'footer-sidebar-1',
                'class'         => 'stuff-footer-sidebar',
                'description' 	=> esc_html__( 'Widgets in this area will be shown on Footer.', 'stuff' ),
                'before_title' 	=> '<h2>',
                'after_title' 	=> '</h2>',
                'before_widget' => '<div id="%1$s" class="%2$s">',
                'after_widget' 	=> '</div>'
            )
        );

        register_sidebar(
            array(
                'name' 			=> esc_html__( '[Footer] Sidebar #2', 'stuff' ),
                'id' 			=> 'footer-sidebar-2',
                'class'         => 'stuff-footer-sidebar',
                'description' 	=> esc_html__( 'Widgets in this area will be shown on Footer.', 'stuff' ),
                'before_title' 	=> '<h2>',
                'after_title' 	=> '</h2>',
                'before_widget' => '<div id="%1$s" class="%2$s">',
                'after_widget' 	=> '</div>'
            )
        );

        register_sidebar(
            array(
                'name' 			=> esc_html__( '[Footer] Sidebar #3', 'stuff' ),
                'id' 			=> 'footer-sidebar-3',
                'class'         => 'stuff-footer-sidebar',
                'description' 	=> esc_html__( 'Widgets in this area will be shown on Footer.', 'stuff' ),
                'before_title' 	=> '<h2>',
                'after_title' 	=> '</h2>',
                'before_widget' => '<div id="%1$s" class="%2$s">',
                'after_widget' 	=> '</div>'
            )
        );

        register_sidebar(
            array(
                'name' 			=> esc_html__( '[Footer] Sidebar #4', 'stuff' ),
                'id' 			=> 'footer-sidebar-4',
                'class'         => 'stuff-footer-sidebar',
                'description' 	=> esc_html__( 'Widgets in this area will be shown on Footer.', 'stuff' ),
                'before_title' 	=> '<h2>',
                'after_title' 	=> '</h2>',
                'before_widget' => '<div id="%1$s" class="%2$s">',
                'after_widget' 	=> '</div>'
            )
        );
    }

    add_action('widgets_init','stuff_register_sidebar');

endif;

/*-----------------------------------------------------
 * 				Stuff Searchform
 *----------------------------------------------------*/

if(!function_exists('stuff_search_form')) {
    function stuff_search_form( $form ) {
        $form = '<form action="'. esc_url( home_url( '/' ) ).'" method="get" class="search-form">
                    <div class="form-group">
                        <input id="search" type="search" class="form-control" value="'.esc_attr( get_search_query() ).'" required name="s" placeholder="'.esc_attr__('Enter any key to search...','stuff').'">
						<button type="submit" class="btn btn-primary"><i class="icon-search3"></i></button>
                    </div>
					</form>';
        return $form;
    }
    add_filter( 'get_search_form','stuff_search_form');
}

/*-----------------------------------------------------
 * 				Customizer Sanitize
 *----------------------------------------------------*/

if(!function_exists('stuff_sanitize_integer')){
    function stuff_sanitize_integer($input) {
        return intval( $input );
    }
}

/**
 * Load Autoloader
 */
require_once 'inc/class-stuff-autoloader.php';
if(class_exists('Epsilon_Framework')){
    $stuff = Stuff::get_instance();
}