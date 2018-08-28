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
get_header();
?>

<div id="colorlib-container">
    <div class="container">
        <div class="row">
            <?php $stuff_page_layout = Stuff_Helper::get_page_layout(); ?>
            <div class="<?php echo ( 1 === $stuff_page_layout['columnsCount'] && ! is_active_sidebar( 'main-sidebar' ) ) ? 'col-sm-12' : 'col-sm-' . esc_attr( $stuff_page_layout['columns']['content']['span'] ); ?>">
                <div class="row row-pb-lg">
                    <div class="col-xs-12">
                        <div class="page-entry">
                          <?php
                              while ( have_posts() ) : the_post();
                                the_content();
                              endwhile;
                           ?>
                        </div>
                                <div class="page-single-pagination">
                            <?php
                                wp_link_pages( array(
                                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'stuff' ),
                                        'after'  => '</div>',
                                    ) );
                                ?>
                        </div>
                    </div>
                </div>

                <?php
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }
                ?>
            </div>
            <?php if ( 'right-sidebar' === $stuff_page_layout['type'] && is_active_sidebar( 'main-sidebar' ) ) { ?>
                <div class="col-md-<?php echo esc_attr( $stuff_page_layout['columns']['sidebar']['span'] ); ?>">
				  <?php get_sidebar(); ?>
			</div>
            <?php } ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

