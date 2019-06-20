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
                    <?php $stuff_layout = Stuff_Helper::get_layout(); ?>
                    <div class="<?php echo ( 1 === $stuff_layout['columnsCount'] && ! is_active_sidebar( 'main-sidebar' ) ) ? 'col-sm-12' : 'col-sm-' . esc_attr( $stuff_layout['columns']['content']['span'] ); ?> content">
                        <div class="row">
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
                    echo '</div></div>';

                    if ( 'right-sidebar' === $stuff_layout['type'] && is_active_sidebar( 'main-sidebar' ) ) { ?>
                        <div class="col-md-<?php echo esc_attr( $stuff_layout['columns']['sidebar']['span'] ); ?>">
                            <?php get_sidebar(); ?>
                        </div>
                    <?php } ?>
                    
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <?php stuff_pagination(); ?>
                    </div>
                </div>

			</div>
		</div>

<?php get_footer(); ?>

