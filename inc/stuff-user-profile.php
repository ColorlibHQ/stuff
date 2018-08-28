<?php
/*-----------------------------------------------------
 * 				Author custom data
 *----------------------------------------------------*/

/**
 * Add Fields
 */

if(!function_exists('user_profile_extra')){
    add_action( 'show_user_profile', 'user_profile_extra' );

    function user_profile_extra( $user ) { ?>
        <h2><?php esc_html_e("Profile Information", "stuff"); ?></h2>
        <table class="form-table">
            <tr>
                <th><label for="user_profile_image"><?php esc_html_e('Profile Image', 'stuff'); ?></label></th>
                <td>
                    <input type="text" name="user_profile_image" id="user_profile_image" value="<?php echo esc_attr( get_the_author_meta( 'user_profile_image', $user->ID ) ); ?>" class="regular-text" placeholder="<?php esc_html_e('Click on upload', 'stuff'); ?>" />
                    <input type='button' class="button-primary" value="Upload Image" id="uploadimage"/><br />
                    <span class="description"><?php esc_html_e('Upload your image for your profile.', 'stuff'); ?></span><br/>
                    <img src="<?php echo esc_attr( get_the_author_meta( 'user_profile_image', $user->ID ) ); ?>" style="height:200px;margin-top: 20px">
                </td>
            </tr>
        </table>

        <h2><?php esc_html_e("Social Links", "stuff"); ?></h2>
        <table class="form-table">
            <tr>
                <th><label for="user_facebook"><?php esc_html_e('Facebook', 'stuff'); ?></label></th>
                <td>
                    <input type="text" name="user_facebook" id="user_facebook" value="<?php echo esc_attr( get_the_author_meta( 'user_facebook', $user->ID ) ); ?>" class="regular-text" placeholder="#" /><br />
                    <span class="description"><?php esc_html_e('Facebook link', 'stuff'); ?></span>
                </td>
            </tr>
            <tr>
                <th><label for="user_twitter"><?php esc_html_e('Twitter', 'stuff'); ?></label></th>
                <td>
                    <input type="text" name="user_twitter" id="user_twitter" value="<?php echo esc_attr( get_the_author_meta( 'user_twitter', $user->ID ) ); ?>" class="regular-text" placeholder="#" /><br />
                    <span class="description"><?php esc_html_e('Twitter link', 'stuff'); ?></span>
                </td>
            </tr>
            <tr>
                <th><label for="user_gplus"><?php esc_html_e('Google Plus', 'stuff'); ?></label></th>
                <td>
                    <input type="text" name="user_gplus" id="user_gplus" value="<?php echo esc_attr( get_the_author_meta( 'user_gplus', $user->ID ) ); ?>" class="regular-text" placeholder="#" /><br />
                    <span class="description"><?php esc_html_e('Google Plus link', 'stuff'); ?></span>
                </td>
            </tr>
            <tr>
                <th><label for="user_linkedin"><?php esc_html_e('Linkedin', 'stuff'); ?></label></th>
                <td>
                    <input type="text" name="user_linkedin" id="user_linkedin" value="<?php echo esc_attr( get_the_author_meta( 'user_linkedin', $user->ID ) ); ?>" class="regular-text" placeholder="#" /><br />
                    <span class="description"><?php esc_html_e('Linkedin link', 'stuff'); ?></span>
                </td>
            </tr>
            <tr>
                <th><label for="user_dribbble"><?php esc_html_e('Dribbble', 'stuff'); ?></label></th>
                <td>
                    <input type="text" name="user_dribbble" id="user_dribbble" value="<?php echo esc_attr( get_the_author_meta( 'user_dribbble', $user->ID ) ); ?>" class="regular-text" placeholder="#" /><br />
                    <span class="description"><?php esc_html_e('Dribbble link', 'stuff'); ?></span>
                </td>
            </tr>
            <tr>
                <th><label for="user_youtube"><?php esc_html_e('Youtube', 'stuff'); ?></label></th>
                <td>
                    <input type="text" name="user_youtube" id="user_youtube" value="<?php echo esc_attr( get_the_author_meta( 'user_youtube', $user->ID ) ); ?>" class="regular-text" placeholder="#" /><br />
                    <span class="description"><?php esc_html_e('Youtube link', 'stuff'); ?></span>
                </td>
            </tr>
            <tr>
                <th><label for="user_vimeo"><?php esc_html_e('Vimeo', 'stuff'); ?></label></th>
                <td>
                    <input type="text" name="user_vimeo" id="user_vimeo" value="<?php echo esc_attr( get_the_author_meta( 'user_vimeo', $user->ID ) ); ?>" class="regular-text" placeholder="#" /><br />
                    <span class="description"><?php esc_html_e('Vimeo link', 'stuff'); ?></span>
                </td>
            </tr>
        </table>
    <?php }
}

/**
 * Update extra social link field
 */
add_action( 'personal_options_update', 'save_user_profile_extra' );
add_action( 'edit_user_profile_update', 'save_user_profile_extra' );

function save_user_profile_extra( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) {
        return false;
    }
    update_user_meta( $user_id, 'user_profile_image', $_POST['user_profile_image'] );
    update_user_meta( $user_id, 'user_facebook', $_POST['user_facebook'] );
    update_user_meta( $user_id, 'user_twitter', $_POST['user_twitter'] );
    update_user_meta( $user_id, 'user_gplus', $_POST['user_gplus'] );
    update_user_meta( $user_id, 'user_linkedin', $_POST['user_linkedin'] );
    update_user_meta( $user_id, 'user_dribbble', $_POST['user_dribbble'] );
    update_user_meta( $user_id, 'user_youtube', $_POST['user_youtube'] );
    update_user_meta( $user_id, 'user_vimeo', $_POST['user_vimeo'] );
}



//Adding image upload js
add_action('admin_head','stuff_user_profile_extra_js');
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_enqueue_style('thickbox');

function stuff_user_profile_extra_js() { ?>

    <script type="text/javascript">
        jQuery(document).ready(function() {

            jQuery(document).find("input[id^='uploadimage']").live('click', function(){
                //var num = this.id.split('-')[1];
                formfield = jQuery('#user_profile_image').attr('name');
                tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

                window.send_to_editor = function(html) {
                    imgurl = jQuery(html).attr('src');
                    jQuery('#user_profile_image').val(imgurl);
                    tb_remove();
                }

                return false;
            });
        });
    </script>

<?php }


/**
 * Visual biography editor
 */
if ( !class_exists('StuffVisualBiographyEditor') ):

    class StuffVisualBiographyEditor {

        private $name = 'Visual Biography Editor';

        /**
         * Setup WP hooks
         */
        public function __construct() {

            // Add a visual editor if the current user is an Author role or above and WordPress is v3.3+
            if ( function_exists('wp_editor') ) {

                // Add the WP_Editor
                add_action( 'show_user_profile', array($this, 'visual_editor') );
                add_action( 'edit_user_profile', array($this, 'visual_editor') );

                // Don't sanitize the data for display in a textarea
                add_action( 'admin_init', array($this, 'save_filters') );

                // Load required JS
                add_action( 'admin_enqueue_scripts', array($this, 'load_javascript'), 10, 1 );

                // Add content filters to the output of the description
                add_filter( 'get_the_author_description', 'wptexturize' );
                add_filter( 'get_the_author_description', 'convert_chars' );
                add_filter( 'get_the_author_description', 'wpautop' );
            }
        }


        /**
         *	Create Visual Editor
         *
         *	Add TinyMCE editor to replace the "Biographical Info" field in a user profile
         *
         * @uses wp_editor() http://codex.wordpress.org/Function_Reference/wp_editor
         * @param $user An object with details about the current logged in user
         */
        public function visual_editor( $user ) {

            // Contributor level user or higher required
            if ( !current_user_can('edit_posts') )
                return;
            ?>
            <table class="form-table">
                <tr>
                    <th><label for="description"><?php esc_html_e('Biographical Info', 'stuff'); ?></label></th>
                    <td>
                        <?php
                        $description = get_user_meta( $user->ID, 'description', true);
                        wp_editor( $description, 'description' );
                        ?>
                        <p class="description"><?php esc_html_e('Share a little biographical information to fill out your profile. This may be shown publicly.', 'stuff'); ?></p>
                    </td>
                </tr>
            </table>
            <?php
        }

        /**
         * Admin JS customizations to the footer
         *
         */
        public function load_javascript( $hook ) {

            // Contributor level user or higher required
            if ( !current_user_can('edit_posts') )
                return;

            // Load JavaScript only on the profile and user edit pages
            if ( $hook == 'profile.php' || $hook == 'user-edit.php' ) {
                wp_enqueue_script(
                    'visual-editor-biography',
                    get_template_directory_uri() . 'inc/js/visual-editor-biography.js',
                    array('jquery'),
                    false,
                    true
                );
            }
        }

        /**
         * Remove textarea filters from description field
         */
        public function save_filters() {

            // Contributor level user or higher required
            if ( !current_user_can('edit_posts') )
                return;

            remove_all_filters('pre_user_description');
        }
    }

    new StuffVisualBiographyEditor();

endif;