<?php
if (is_single()) { ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('blog-entry'); ?>>
        <?php if (has_post_thumbnail()) {
            $stuff_thumb = get_theme_mod('stuff_show_post_thumbnail', true);
            if ($stuff_thumb) {
                ?>
                <div class="blog-img blog-detail">
                    <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
                </div>
            <?php }
        } ?>
        <div class="desc">
            <p class="meta">
                <?php
                if (get_theme_mod('stuff_show_post_categories', true)) { ?>
                    <span class="cat"><?php the_category(', '); ?></span>
                <?php } ?>
                <?php if (get_theme_mod('stuff_show_blog_date', true)) { ?>
                    <span class="date"><?php the_time(get_option('date_format')); ?></span>
                <?php } ?>
                <?php if (get_theme_mod('stuff_enable_author_meta', true)) { ?>
                    <span class="pos"><?php esc_html_e('By', 'stuff'); ?> <a
                                href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author_meta('display_name') ?></a></span>
                <?php } ?>
            </p>
            <h2><?php the_title(); ?></h2>
            <div class="single-post-entry">
                    <?php the_content(); ?>
                </div>
            <?php
            $showTag = get_theme_mod('stuff_show_post_tags', 'false');
            if($showTag == true){
                the_tags('<div class="post-tags">','','</div>');
            }
            ?>
        </div>
        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links"><label>' . esc_html__('Pages:', 'stuff') . '</label>',
            'after' => '</div>',
            'link_before' => '<span>',
            'link_after' => '</span>',
        ));
        ?>
    </div>
    <?php
} else {
    if (is_archive() || is_search()) {
        echo '<div class="col-md-12">';
    } else {
        echo '<div class="col-md-8">';
    }
    ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('blog-entry'); ?>>
        <?php
        $stuff_thumb = get_theme_mod('stuff_show_post_thumbnail', true);
        if ($stuff_thumb) {
            if (has_post_thumbnail()) {
                ?>
                <div class="blog-img">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('post-thumbnail', array('class' => 'img-responsive')); ?>
                    </a>
                </div>
                <?php
            } else { ?>
                <div class="blog-img">
                    <a href="<?php the_permalink(); ?>">
                        <?php stuff_get_first_image(); ?>
                    </a>
                </div>
            <?php }
        }
        ?>
        <div class="desc">
            <p class="meta">
                <?php
                if (get_theme_mod('stuff_show_post_categories', true)) { ?>
                    <span class="cat"><?php the_category(', '); ?></span>
                <?php } ?>
                <?php if (get_theme_mod('stuff_show_blog_date', true)) { ?>
                    <span class="date"><?php the_time(get_option('date_format')); ?></span>
                <?php } ?>
                <?php if (get_theme_mod('stuff_enable_author_meta', true)) { ?>
                    <span class="pos"><?php esc_html_e('By', 'stuff'); ?> <a
                                href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author_meta('display_name') ?></a></span>
                <?php } ?>
            </p>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p><?php print stuff_excerpt(15); ?></p>
        </div>
    </div>
    </div>
<?php } ?>