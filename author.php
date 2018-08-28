<?php
/**
 * The author template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package stuff
 */
get_header();
?>

<div id="colorlib-container">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-entry">
                    <?php
                    $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <img class="img-responsive" src="<?php print $curauth->user_profile_image; ?>" alt="<?php print $curauth->display_name;  ?>">
                        </div>
                        <div class="col-md-6">
                            <div class="author-entry">
                                <?php print wpautop($curauth->user_description); ?>
                            </div>
                            <ul class="colorlib-social-icons">
                                <?php
                                    $twitterlink = $curauth->user_twitter;
                                    $facebooklink = $curauth->user_facebook;
                                    $linkedinlink = $curauth->user_linkedin;
                                    $gpluslink = $curauth->user_gplus;
                                    $dribbblelink = $curauth->user_dribbble;
                                    $youtubelink = $curauth->user_youtube;
                                    $vimeolink = $curauth->user_vimeo;

                                    if($twitterlink != ''){
                                        echo '<li><a href="'.$twitterlink.'"><i class="icon-twitter"></i></a></li>';
                                    }
                                    if($facebooklink != ''){
                                        echo '<li><a href="'.$facebooklink.'"><i class="icon-facebook"></i></a></li>';
                                    }
                                    if($linkedinlink != ''){
                                        echo '<li><a href="'.$linkedinlink.'"><i class="icon-linkedin"></i></a></li>';
                                    }
                                    if($gpluslink != ''){
                                        echo '<li><a href="'.$gpluslink.'"><i class="icon-google-plus"></i></a></li>';
                                    }
                                    if($dribbblelink != ''){
                                        echo '<li><a href="'.$dribbblelink.'"><i class="icon-dribbble"></i></a></li>';
                                    }
                                    if($youtubelink != ''){
                                        echo '<li><a href="'.$youtubelink.'"><i class="icon-youtube"></i></a></li>';
                                    }
                                    if($vimeolink != ''){
                                        echo '<li><a href="'.$vimeolink.'"><i class="icon-vimeo"></i></a></li>';
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>

