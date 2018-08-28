<?php
/**
 * The main template file.
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
                <div class="row row-pb-md">
                    <?php
                    if ( have_posts() ) :
                        $column = 0;
                        while ( have_posts() ) : the_post();
                            managerow(get_the_ID(), $column, 3 );
                            get_template_part( 'template-parts/content', get_post_format());
                        endwhile;
                    else:
                        get_template_part( 'template-parts/content', 'none' );
                    endif;
                    ?>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <?php stuff_pagination(); ?>
                    </div>
                </div>
			</div>
		</div>

<?php get_footer(); ?>

