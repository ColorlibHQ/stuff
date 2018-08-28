<?php
add_action('widgets_init', 'stuff_recent_post');

function stuff_recent_post()
{
    register_widget('stuff_recent_post');
}

class stuff_recent_post extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('stuff_recent_post', esc_html__('Stuff Recent Posts', 'stuff'), array(
            'description' => esc_html__('Add Recent Post Widget', 'stuff'),
        ));
    }

    public function widget($args, $instance)
    {
        print $args['before_widget'];

        $title = $args['before_title'];
        $title .= $instance['title'];
        $title .= $args['after_title'];

        print $title;
        ?>
        <?php
        $data = array('post_type' => 'post', 'numberposts' => $instance['posts']);
        $recentPost = wp_get_recent_posts($data);
        foreach ($recentPost as $recentPosts) {
            $image = '';
            ?>
            <div class="f-blog">
                <?php
                if (has_post_thumbnail($recentPosts['ID'])) {
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($recentPosts['ID']), 'post-thumbnail-small');
                    ?>
                    <a href="<?php echo esc_url($recentPosts['guid']) ?>" class="blog-img">
                        <img class="img-responsive" src="<?php echo esc_url($image[0]); ?>" alt="<?php print $recentPosts['post_title']; ?>">
                    </a>
                <?php } ?>
                <div class="desc">
                    <h3><a href="<?php echo esc_url($recentPosts['guid']) ?>"><?php print $recentPosts['post_title']; ?></a></h3>
                    <p class="admin"><span><?php echo date(get_option('date_format'), strtotime($recentPosts['post_date'])); ?></span></p>
                </div>
            </div>
        <?php } ?>

        <?php
        print $args['after_widget'];

    }

    public function form($instance)
    {
        $title = isset($instance['title']) ? $instance['title'] : 'Recent Posts';
        $posts = !empty($instance['posts']) ? $instance['posts'] : 3;

        ?>
        <p>
            <label for="title"><?php echo esc_html("Title:") ?></label>
        </p>
        <input type="text" id="<?php print $this->get_field_id('title'); ?>"
               name="<?php print $this->get_field_name('title'); ?>" value="<?php print $title; ?>">
        <p>
            <label for="posts"><?php echo esc_html("Number of posts to show:") ?></label>
        </p>
        <input type="text" id="<?php print $this->get_field_id('posts'); ?>"
               name="<?php print $this->get_field_name('posts'); ?>" value="<?php print $posts; ?>">

        <?php
    }
}
