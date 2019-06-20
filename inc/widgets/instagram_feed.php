<?php
add_action('widgets_init', 'stuff_instagram_feed');

function stuff_instagram_feed()
{
    register_widget('stuff_instagram_feed');
}

class stuff_instagram_feed extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('stuff_instagram_feed', esc_html__('Stuff Instagram Images', 'stuff'), array(
            'description' => esc_html__('Add Instagram Image Widget', 'stuff'),
        ));
    }

    public function widget($args,$instance){

        $title = $args['before_title'];
        $title .= $instance['title'];
        $title .=$args['after_title'];
        $insta_user = esc_html($instance['insta_user']);
        $insta_items = esc_html($instance['insta_items']);
        ?>

        <?php
        print $args['before_widget'];
        print($title); ?>
        <div class="instagram-entry" data-username="<?php print $insta_user ?>" data-items="<?php print $insta_items ?>"></div>
        <?php print $args['after_widget'];
    }

    public function form($instance){
        $data = array(
            'title' => isset($instance['title'])?$instance['title']:esc_html('Instagram', 'stuff'),
            'insta_user' => isset($instance['insta_user'])?$instance['insta_user']:'ajanta91',
            'insta_items' => isset($instance['insta_items'])?$instance['insta_items']:'8',
        );

        foreach($data as $key =>$value){
            if($key=='insta_user') {
                echo '<p><label for="insta_user">'.esc_html__('Instagram Username','stuff').'</label></p>
						<input type="text" id="insta_user"  name="'.$this->get_field_name($key).'" value="'.$value.'">';
            }
            else if($key == 'insta_items'){
                echo '<p><label for="insta_items">'.esc_html__('Show Items','stuff').'</label></p>
						<input type="number" id="insta_items"  name="'.$this->get_field_name($key).'" value="'.$value.'">';
            }
            else{
                echo '<p><label for="title">'.ucfirst($key).'</label></p>
						<input type="text" id="'.$this->get_field_id($key).'"  name="'.$this->get_field_name($key).'" value="'.$value.'">';
            }

        }
    }
}
