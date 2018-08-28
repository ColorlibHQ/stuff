<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package stuff
 */
get_header();
?>

<div id="colorlib-container">
    <div class="container">
        <div class="row">
            <?php $stuff_layout = Stuff_Helper::get_layout(); ?>
            <div class="<?php echo ( 1 === $stuff_layout['columnsCount'] && ! is_active_sidebar( 'main-sidebar' ) ) ? 'col-sm-12' : 'col-sm-' . esc_attr( $stuff_layout['columns']['content']['span'] ); ?> content">
                <div class="row row-pb-lg">
                    <div class="col-md-12">
                        <?php
                        if (have_posts()) :
                            while (have_posts()) : the_post();
                                get_template_part('template-parts/content', get_post_format());
                            endwhile;
                        else:
                            get_template_part('template-parts/content', 'none');
                        endif;
                        ?>
                    </div>
                </div>
                <?php if(comments_open() || get_comments_number()) {  ?>
                    <?php comments_template();?>
                <?php }?>
            </div>
	        <?php if ( 'right-sidebar' === $stuff_layout['type'] && is_active_sidebar( 'main-sidebar' ) ) { ?>
            <div class="col-md-<?php echo esc_attr( $stuff_layout['columns']['sidebar']['span'] ); ?>">
				  <?php get_sidebar(); ?>
			</div>
            <?php } ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>

