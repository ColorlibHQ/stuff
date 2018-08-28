<?php
/**
 * The sidebar containing the footer widget area.
 *
 * @package Stuff
 */

/**
 * The sidebars
 */
$mysidebars = array(
    'footer-sidebar-1',
    'footer-sidebar-2',
    'footer-sidebar-3',
    'footer-sidebar-4',
);

$sidebars = array();
foreach ( $mysidebars as $column ) {
    if ( is_active_sidebar( $column ) ) {
        $sidebars[] = $column;
    }
};

$footer_layout = get_theme_mod( 'stuff_footer_columns', false );
if ( ! $footer_layout ) {
    $footer_layout = Stuff_Helper::get_footer_default();
}
if ( ! is_array( $footer_layout ) ) {
    $footer_layout = json_decode( $footer_layout, true );
}

?>

<footer id="colorlib-footer" role="contentinfo">
    <div class="container">
        <?php if ( ! empty( $sidebars ) ) { ?>
            <div class="row row-pb-md">
                <?php foreach ( $footer_layout['columns'] as $sidebar ) : ?>

                    <?php if ( is_active_sidebar( 'footer-sidebar-' . $sidebar['index'] ) ) { ?>
                        <div id="footer-widget-area-<?php echo esc_attr( $sidebar['index'] ); ?>" class="col-sm-<?php echo esc_attr( $sidebar['span'] ); ?>">
						  <?php dynamic_sidebar( 'footer-sidebar-' . $sidebar['index'] ); ?>
					    </div>
                    <?php } ?>

                <?php endforeach; ?>
            </div>
        <?php } ?>

        <?php if( get_theme_mod('stuff_copyright_contents', true ) ){ ?>
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?php echo wp_kses_post( get_theme_mod('stuff_copyright_contents', '<small class="block">Copyright &copy;2018 All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="'.esc_url( 'https://colorlib.com' ).'" target="_blank">Colorlib</a></small> <small class="block">Demo Images: <a href="http://unsplash.co/" target="_blank">Unsplash</a></small>' )); ?>
                    </p>
                </div>
            </div>
        <?php } ?>
    </div>
</footer>