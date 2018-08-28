<?php if (get_theme_mod('stuff_enable_instagram_gallery', true)) { ?>
    <div id="colorlib-instagram">
        <div class="row">
            <div class="col-md-12 col-md-offset-0 colorlib-heading text-center">
                <h2><?php esc_html_e('Instagram', 'stuff'); ?></h2>
            </div>
        </div>
        <div class="row">
            <div class="instagram-entry"
                 data-username="<?php echo wp_kses_post(get_theme_mod('stuff_instagram_gallery_user', 'remonfoysal')); ?>"
                 data-items="<?php echo '8'; ?>"></div>
        </div>
    </div>
<?php } ?>
<?php get_sidebar('footer'); ?>
</div>

<?php
$showgototop = get_theme_mod('stuff_enable_go_top', true);
if ($showgototop == true) {
    ?>
    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
    </div>
    <?php
}
?>


<?php wp_footer(); ?>

</body>
</html>