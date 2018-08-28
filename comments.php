<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package stuff
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<?php
if (number_format_i18n(get_comments_number()) != 0) {
    ?>
    <div class="row row-pb-lg">
        <div class="col-md-12">
            <h4 class="heading-2"><?php printf(_n('One Comment', '<span class="comment-count">%s</span> Comments', get_comments_number(), 'stuff'), number_format_i18n(get_comments_number())); ?></h4>
            <?php
            wp_list_comments(array(
                'style' => 'div',
                'callback' => 'stuff_comments',
                'short_ping' => true,
            ));
            ?>
        </div>
        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
            <nav id="comment-nav-below" class="comment-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'stuff'); ?></h1>
                <div class="col-sm-6"><div class="nav-previous"><?php previous_comments_link(esc_html__('&larr; Older Comments', 'stuff')); ?></div></div>
                <div class="col-sm-6"><div class="nav-next"><?php next_comments_link(esc_html__('Newer Comments &rarr;', 'stuff')); ?></div></div>
                <div class="clearfix"></div>
            </nav><!-- #comment-nav-below -->
        <?php endif; // check for comment navigation ?>
    </div>
    <?php
}
?>
    <!-- COMMENT REPLY -->
<?php if (!comments_open()) : ?>
    <p class="no-comments"><?php esc_html_e('Comments are closed', 'stuff'); ?></p>
<?php endif; ?>
<?php
$commenter = wp_get_current_commenter();
$req = get_option('require_name_email');
$aria_req = ($req ? " aria-required='true'" : '');
$required_text = '  ';
$args = array(
    'id_form' => 'comment-form',
    'class_form' => 'comment-form',
    'id_submit' => '',
    'class_submit' => '',
    'title_reply_to' => esc_html__('Say something', 'stuff'),
    'title_reply' => esc_html__('Say something', 'stuff'),
    'cancel_reply_link' => esc_html__('Cancel Reply', 'stuff'),
    'logged_in_as' => '',
    'submit_button' => '<div class="form-group"><button class="btn btn-primary" type="submit" name="comment-submit">' . esc_html__('Post Comment', 'stuff') . '</button></div>',

    'comment_notes_before' => '',

    'fields' => apply_filters('comment_form_default_fields', array(

        'author' => '<div class="row form-group"><div class="col-md-6"><input class="form-control" type="text" name="author" id="name" placeholder="' . esc_attr__('Your name', 'stuff') . '" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . '/></div>',
        'email' => '<div class="col-md-6"><input class="form-control" name="email" type="email" id="email" placeholder="' . esc_attr__('Email address', 'stuff') . '"  value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . '/></div></div>'

    )),

    'comment_field' => '<div class="row form-group"><div class="col-md-12"><textarea class="form-control" rows="10" cols="30" id="comment_message" name="comment" placeholder="' . esc_attr__('Your comment', 'stuff') . '"></textarea></div></div>'
);

comment_form($args);
?>