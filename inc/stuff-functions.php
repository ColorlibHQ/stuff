<?php

// There functions are goes here in this file

/*-----------------------------------------------------
 * 				Header
 *----------------------------------------------------*/
if (!function_exists('stuff_header')) {
    function stuff_header()
    {
        $affix_attr = (get_theme_mod('stuff_fix_nav', false) == true ? 'data-spy="affix" data-offset-top="90"' : '');
        ?>
        <nav class="colorlib-nav" role="navigation" <?php print $affix_attr; ?>>
            <div class="top-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-2">
                            <?php stuff_logo(); ?>
                        </div>
                        <div class="col-xs-10 text-right menu-1">
                            <?php
                            wp_nav_menu(array(
                                'theme_location'=> 'primary',
                                'menu_class' => '',
                                'menu_id' => '',
                                'container' => '',
                                'fallback_cb' => ' ',
                                'walker' => new stuff_wp_navwalker(),
                            ));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <?php
    }
}

/*-----------------------------------------------------
 * 				Sub header
 *----------------------------------------------------*/
if (!function_exists('stuff_subheader')) {
    function stuff_subheader()
    {
        ?>
        <aside id="colorlib-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 breadcrumbs text-center">
                        <h2><?php wp_title(' '); ?></h2>
                        <?php stuff_breadcrumbs(); ?>
                    </div>
                </div>
            </div>
        </aside>
        <?php
    }
}

/*-----------------------------------------------------
 * 				Breadcrumb
 *----------------------------------------------------*/

if (!function_exists('stuff_breadcrumbs')) :
    function stuff_breadcrumbs()
    {
        echo '<p>';
        $home = '<span><a href="' . esc_url(home_url()) . '" title="' . esc_html__('Home', 'stuff') . '">' . esc_html__('Home', 'stuff') . '</a></span>';
        $showCurrent = 1;

        global $post;
        $homeLink = esc_url(home_url());
        if (is_front_page()) {
            return;
        }    // don't display breadcrumbs on the homepage (yet)

        print $home;


        if (is_category()) {
            // category section
            $thisCat = get_category(get_query_var('cat'), false);
            if (!empty($thisCat->parent)) echo get_category_parents($thisCat->parent, TRUE, ' ' . '/' . ' ');
            echo '<span>' . esc_html__('Archive for category', 'stuff') . ' "' . single_cat_title('', false) . '"' . '</span>';
        } elseif (is_search()) {
            // search section
            echo '<span>' . esc_html__('Search results for', 'stuff') . ' "' . get_search_query() . '"' . '</span>';
        } elseif (is_day()) {
            echo '<span><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></span>';
            echo '<span><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> </span>';
            echo '<span>' . get_the_time('d') . '</span>';
        } elseif (is_month()) {
            // monthly archive
            echo '<span><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> </span>';
            echo '<span>' . get_the_time('F') . '</span>';
        } elseif (is_year()) {
            // yearly archive
            echo '<span>' . get_the_time('Y') . '</span>';
        } elseif (is_single() && !is_attachment()) {
            // single post or page
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<span><a href="' . $homeLink . '/?post_type=' . $slug['slug'] . '">' . $post_type->labels->singular_name . '</a></span>';
                if ($showCurrent) echo ' <span>' . get_the_title() . '</span>';
            } else {
                $cat = get_the_category();
                if (isset($cat[0])) {
                    $cat = $cat[0];
                } else {
                    $cat = false;
                }
                if ($cat) {
                    $cats = get_category_parents($cat, TRUE, ' ' . ' ' . ' ');
                } else {
                    $cats = false;
                }
                if (!$showCurrent && $cats) $cats = preg_replace("#^(.+)\s\s$#", "$1", $cats);
                echo '<span>' . $cats . '</span>';
                if ($showCurrent) echo '<span>' . get_the_title() . '</span>';
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            // some other single item
            $post_type = get_post_type_object(get_post_type());
            if (!empty($post_type)) {
                echo '<span>' . $post_type->labels->singular_name . '</span>';
            }
        } elseif (is_attachment()) {
            // attachment section
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            if (isset($cat[0])) {
                $cat = $cat[0];
            } else {
                $cat = false;
            }
            if ($cat) echo get_category_parents($cat, TRUE, ' ' . ' ' . ' ');
            echo '<span><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></span>';
            if ($showCurrent) echo '<span>' . get_the_title() . '</span>';
        } elseif (is_page() && !$post->post_parent) {
            if ($showCurrent) echo '<span>' . get_the_title() . '</span>';
        } elseif (is_page() && $post->post_parent) {
            // child page
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<span><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></span>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                print $breadcrumbs[$i];
                if ($i != count($breadcrumbs) - 1) ;
            }
            if ($showCurrent) echo '<span>' . get_the_title() . '</span>';
        } elseif (is_tag()) {
            // tags archive
            echo '<span>' . esc_html__('Posts tagged', 'stuff') . ' "' . single_tag_title('', false) . '"' . '</span>';
        } elseif (is_author()) {
            // author archive
            global $author;
            $userdata = get_userdata($author);
            echo '<span>' . $userdata->display_name . '</span>';
        } elseif (is_404()) {
            // 404
            echo '<span>' . esc_html__('Not Found', 'stuff') . '</span>';
        } elseif (is_home()) {
            if ($showCurrent) echo '<span>' . wp_title('', false) . '</span>';
        }

        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo '<li> (';
            echo '<span>' . esc_html__('Page', 'stuff') . ' ' . get_query_var('paged') . '</span>';;
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ')</li>';
        }

        echo '</p>';
    }
endif;

/*-----------------------------------------------------
 * 				Blog Column Counter
 *----------------------------------------------------*/
function managerow($post_id, &$column, $per_row)
{
    if ($per_row == 2) {
        if ((get_post_format($post_id) == 'video') || (get_post_format($post_id) == 'image')) {
            $columnnow = 12;
        } else {
            $columnnow = 6;
        }

        if ($column < 12) {
            $column += $columnnow;
        } else {
            echo '</div><div class="row row-pb-md">';
            if ((get_post_format($post_id) == 'video') || (get_post_format($post_id) == 'image')) {
                $column = 12;
            } else {
                $column = 6;
            }
        }
    } else {
        if ((get_post_format($post_id) == 'video') || (get_post_format($post_id) == 'image')) {
            $columnnow = 8;
        } else {
            $columnnow = 4;
        }

        if ($column < 12) {
            $column += $columnnow;
        } else {
            echo '</div><div class="row row-pb-md">';
            if ((get_post_format($post_id) == 'video') || (get_post_format($post_id) == 'image')) {
                $column = 8;
            } else {
                $column = 4;
            }
        }
    }
}

/*-----------------------------------------------------
 * 			Gallery for gallery post format
 *----------------------------------------------------*/
function stuff_get_first_image($post_id)
{
    $attachment = get_children(
        array(
            'post_parent' => $post_id,
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'order' => 'DESC',
            'numberposts' => 1,
        )
    );
    if (!is_array($attachment) || empty($attachment)) {
        return;
    }
    $attachment = current($attachment);
    echo wp_get_attachment_image($attachment->ID, 'post-thumbnail', false, array('class' => 'img-responsive'));
}

/*-----------------------------------------------------
 * 			Post slider for front page
 *----------------------------------------------------*/
if (!function_exists('postSlider')) {

    function postSlider()
    {
        $sliderCat = get_theme_mod('stuff_slider_category', 'all');
        $sliderpostcount = get_theme_mod('slider_post_count', 5);

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $sliderpostcount,
            'meta_query' => array(
                array(
                    'key' => '_thumbnail_id',
                    'compare' => 'EXISTS'
                ),
            ),
        );

        if($sliderCat != '' && $sliderCat != 'all'){
            $args['category_name'] = $sliderCat;
        }

        $slide_query = new WP_Query($args);

        if ($slide_query->have_posts()) {
            echo '<aside id="colorlib-hero"><div class="flexslider"><ul class="slides">';
            while ($slide_query->have_posts()) {
                $slide_query->the_post();
                echo '<li style="background-image: url(';
                the_post_thumbnail_url('full');
                echo ')">';
                ?>
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-pull-3 col-sm-12 col-xs-12 col-md-offset-3 slider-text">
                            <div class="slider-text-inner">
                                <div class="desc">
                                    <p class="meta">
                                        <span class="cat"><?php the_category(', '); ?></span>
                                        <span class="date"><?php the_time(get_option('date_format')); ?></span>
                                        <span class="pos"><?php esc_html_e('By', 'stuff'); ?> <a
                                                    href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author_meta('display_name') ?></a></span>
                                    </p>
                                    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                echo '</li>';
            }
            echo '</ul></div></aside>';
            wp_reset_postdata();
        }
    }
}

/*-----------------------------------------------------
 * 				Custom Styling
 *----------------------------------------------------*/
if (!function_exists('stuff_custom_css')) {
    function stuff_custom_css()
    {
        $theme_color = get_theme_mod('stuff_theme_color');
        $theme_secondary_color = get_theme_mod('stuff_secondary_color');
        $title_color = get_theme_mod('stuff_title_color');
        $text_color = get_theme_mod('stuff_text_color');

        $custom_css = '<style type="text/css">';

        if ($theme_color != '') {
            $custom_css .= '
                a, 
                a:hover, 
                a:active, 
                a:focus,
                .colorlib-nav ul li a:hover,
                .colorlib-nav ul li.has-dropdown:hover a, 
                .colorlib-nav ul li.has-dropdown:focus a,
                .colorlib-video a i,
                #colorlib-hero .flexslider .slider-text > .slider-text-inner h1 a:hover,
                .colorlib-social-icons li a,
                #colorlib-footer ul a:hover,
                #colorlib-footer .colorlib-footer-links li a:hover,
                .btn-primary.btn-outline{
                    color: ' . $theme_color . ';
                }
                .colorlib-nav ul li.active > a {
                    color: ' . $theme_color . ' !important;
                }
                .colorlib-nav ul li.btn-cta a span,
                .side button,
                #colorlib-container .owl-theme .owl-controls .owl-nav [class*=owl-]:hover,
                .pagination .nav-links .page-numbers:hover, 
                .pagination .nav-links .page-numbers:focus,
                .pagination li a:hover, .pagination li a:focus,
                .pagination .nav-links .current.page-numbers,
                .pagination li.active a,
                .pagination .nav-links .current.page-numbers:hover, 
                .pagination .nav-links .current.page-numbers:focus,
                .pagination li.active a:hover, .pagination li.active a:focus,
                .post-tags a:hover,
                .tag-cloud-link:hover,
                #colorlib-footer .tag-cloud-link:hover,
                #colorlib-footer .tags span a:hover,
                .gototop a,
                .btn-primary,
                .btn-primary.btn-outline:hover, 
                .btn-primary.btn-outline:focus, 
                .btn-primary.btn-outline:active{
                    background: ' . $theme_color . ';
                }
                .pagination .nav-links .page-numbers:hover, 
                .pagination .nav-links .page-numbers:focus,
                .pagination li a:hover, .pagination li a:focus,
                .pagination .nav-links .current.page-numbers,
                .pagination li.active a,
                .pagination .nav-links .current.page-numbers:hover, 
                .pagination .nav-links .current.page-numbers:focus,
                .pagination li.active a:hover, .pagination li.active a:focus,
                .post-tags a:hover,
                .tag-cloud-link:hover,
                #colorlib-footer .tag-cloud-link:hover,
                #colorlib-footer .tags span a:hover,
                .btn-primary,
                .btn-primary.btn-outline,
                .form-control:active, 
                .form-control:focus{
                    border-color: ' . $theme_color . ';
                }
                blockquote{
                    border-left-color: ' . $theme_color . ';
                }
                ::-webkit-selection{
                    background: ' . $theme_color . ';
                }
                ::-moz-selection {
                    background: ' . $theme_color . ';
                }
                ::selection{
                    background: ' . $theme_color . ';
                }
            ';
        }

        if ($theme_secondary_color) {
            $custom_css .= '
                .btn-primary:hover, 
                .btn-primary:focus, 
                .btn-primary:active{
                    background: ' . $theme_secondary_color . ' !important;
                    border-color: ' . $theme_secondary_color . ' !important;
                }
            ';
        }

        if ($title_color != '') {
            $custom_css .= '
                h1, h2, h3, h4, h5, h6, figure,
                .colorlib-nav #colorlib-logo a,
                #colorlib-hero .flexslider .slider-text > .slider-text-inner .meta span a,
                #colorlib-breadcrumbs .breadcrumbs h2,
                .blog-entry .desc h2 a,
                .blog-entry .desc .meta span a,
                .colorlib-heading h2{
                    color: ' . $title_color . ';
                }
            ';
        }

        if ($text_color != '') {
            $custom_css .= '
                body,
                #colorlib-footer ul a i,
                #colorlib-footer .colorlib-footer-links li a i,
                #colorlib-footer ul a:before{
                    color: ' . $text_color . ';
                }
                
            ';
        }

        if (get_header_image() != '') {
            $custom_css .= '
				#colorlib-breadcrumbs {
					background-image: url(' . get_header_image() . ') !important;
					background-size: cover;
					background-position: center center;
				}
				#colorlib-breadcrumbs:before {
                    content: "";
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(255, 255, 255, 0.80);
                }
			';
        }

        $custom_css . '</style>';
        print $custom_css;
    }
    add_action('wp_head', 'stuff_custom_css');
}

/*-----------------------------------------------------
 * 				Header
 *----------------------------------------------------*/
if (!function_exists('stuff_custom_js')) {
    function stuff_custom_js()
    {

        $custom_js = 'var themedir = \'' . get_template_directory_uri() . '\';';

        wp_enqueue_script(
            'page-setted-js',
            get_template_directory_uri() . '/js/custom_script.js'
        );
        wp_add_inline_script('page-setted-js', $custom_js);
    }

    add_action('wp_enqueue_scripts', 'stuff_custom_js');
}


