<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Stuff
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE HTML>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

<?php
    $preloader_on = get_theme_mod('stuff_enable_preloader', true);
    if($preloader_on){
        echo '<div class="colorlib-loader"></div>';
    }
?>

<div id="page">
		<?php stuff_header(); ?>
        <?php
            if(is_front_page() && is_home() && get_theme_mod('stuff_enable_front_slider', true)){
                echo postSlider();
            } else {
              stuff_subheader();
            }
        ?>