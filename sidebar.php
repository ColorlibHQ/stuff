<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package stuff
 */

if ( ! is_active_sidebar( 'main-sidebar' ) ) {
    return;
}
?>
<div class="sidebar">
	<?php
		dynamic_sidebar('main-sidebar');
	?>
</div>