<?php
/**
 * The page template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package stuff
 */
/**
 * Template Name: Contact Page
 */
get_header();
?>

<div id="colorlib-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if( get_theme_mod( 'stuff_contact_info_title', 'Contact Information' ) ){ ?>
                <h2 class="heading-2"><?php echo get_theme_mod( 'stuff_contact_info_title', esc_html__( 'Contact Information', 'stuff' ) ); ?></h2>
                <?php } ?>
                <div class="row contact-info-wrap row-pb-lg">
                    <?php if( get_theme_mod( 'stuff_contact_address', '198 West 21th Street, <br/>Suite 721 New York NY 10016' ) ) { ?>
                    <div class="col-md-3">
                        <p><span><i class="icon-location-2"></i></span> <?php echo get_theme_mod( 'stuff_contact_address', '198 West 21th Street, <br/>Suite 721 New York NY 10016' ); ?></p>
                    </div>
                    <?php } ?>
                    <?php if( get_theme_mod( 'stuff_contact_phone', '+ 1235 2355 98' )) { ?>
                    <div class="col-md-3">
                        <p><span><i class="icon-phone3"></i></span> <a href="tel:<?php echo get_theme_mod( 'stuff_contact_phone', '+ 1235 2355 98' ); ?>"><?php echo get_theme_mod( 'stuff_contact_phone', '+ 1235 2355 98' ); ?></a></p>
                    </div>
                    <?php } ?>
                    <?php if( get_theme_mod( 'stuff_contact_email', 'info@yoursite.com' ) ){ ?>
                    <div class="col-md-3">
                        <p><span><i class="icon-paperplane"></i></span> <a href="mailto:<?php echo get_theme_mod( 'stuff_contact_email', 'info@yoursite.com' )?>"><?php echo get_theme_mod( 'stuff_contact_email', 'info@yoursite.com' ); ?></a></p>
                    </div>
                    <?php } ?>
                    <?php if( get_theme_mod( 'stuff_contact_website', esc_url('yourwebsite.com', 'stuff' ) )){ ?>
                    <div class="col-md-3">
                        <p><span><i class="icon-globe"></i></span> <a href="<?php echo get_theme_mod('stuff_contact_website', esc_url('yourwebsite.com','stuff')); ?>"><?php echo get_theme_mod('stuff_contact_website', 'yourwebsite.com' ); ?></a></p>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div id="map" class="colorlib-map" data-lat="40.69847032728747" data-lng="-73.9514422416687" data-zoom="7" data-address="Brooklyn"></div>
                    </div>
	                <?php $cform = absint( get_theme_mod( 'stuff_contact_form', 0 ) ); ?>
	                <?php $cform_title = get_theme_mod( 'stuff_contact_title', esc_html__( 'Get In Touch', 'stuff' ) ); ?>
                    <div class="col-md-6">
                        <h2 class="heading-2"><?php echo esc_html( $cform_title ); ?></h2>
	                    <?php echo do_shortcode( '[contact-form-7 id="' . absint( $cform ) . '" title="Contact Form"]' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>

