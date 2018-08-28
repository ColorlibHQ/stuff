<?php
/**
 * The 404 template file.
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
get_header();
?>

<div id="colorlib-container">
    <div class="container">
        <div class="row row-pb-lg">
            <div class="col-xs-12">
                <div class="page-entry">
                    <h2><?php esc_html_e('404 Error! Page Not Found', 'stuff'); ?></h2>
                    <p><?php esc_html_e('The page you are looking for may be deleted or not available','stuff'); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>

