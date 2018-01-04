<?php
/**
* Plugin Name:  Timeline Slider
* Plugin URI:   https://github.com/mikejandreau/timeline-slider
* Description:  Plugin to display recent Timeline excerpts as a slideshow. Simply add [timeline_slider] to the content area in WordPress.
* Version:      1.0
* Author:       Mike Jandreau
* Author URI:   https://www.mikejandreau.net/
* Text Domain:  timeline slider
* Licence:      GNU General Public License v2
*
*/

// Custom post type for Portfolio Items 
require plugin_dir_path( __FILE__ ) . '/inc/custom-post-timeline-event.php';

// Register styles and scripts
function timeline_slider_assets() {
    wp_register_style('timeline_slider_styles', plugins_url('css/timeline.css',__FILE__ ));
    wp_enqueue_style('timeline_slider_styles');

    wp_register_script( 'timeline_slider_mobile', plugins_url('js/jquery.mobile.custom.min.js', __FILE__), array('jquery'),'1.1', true);
    wp_enqueue_script('timeline_slider_mobile');

    wp_register_script( 'timeline_slider_scripts', plugins_url('js/timeline.js', __FILE__), array('jquery'),'1.1', true);
    wp_enqueue_script('timeline_slider_scripts');
}
add_action( 'wp_enqueue_scripts','timeline_slider_assets');

// Shortcode to display slider on any page or post
function timeline_slider(){
    ob_start(); ?> 

        <section class="horizontal-timeline">
            <div class="timeline">
                <div class="events-wrapper">
                    <div class="events">
                        <ol>

                            <?php
                                $counter = 0; // Counter for posts
                                $getThisMany = -1; // Number of posts to pull
                                $recentPosts = new WP_Query(array(
                                    'post_type' => 'Timeline',
                                    'showposts' => $getThisMany, 
                                    'offset' => 0,  // Set this to 1 to skip over first post, 2 to skip the first two, etc.
                                    'order' => 'ASC', // Puts new posts first, to put oldest posts first, change to 'ASC'
                                    'post__not_in' => get_option("sticky_posts"), // Ignore sticky posts for this particular query
                                ));
                            ?>

                            <?php while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
                                <li><a class="timeline-links-<?php echo $counter++; ?> <?php if ($counter == 1) echo 'selected'; ?>" href="#0" data-date="<?php echo get_the_date('j/m/Y'); ?>"><?php echo get_the_date('j M'); ?></a></li>
                            <?php endwhile; wp_reset_postdata(); ?>

                        </ol>

                        <span class="filling-line" aria-hidden="true"></span>
                    </div>
                </div>
                    
                <ul class="timeline-navigation">
                    <li><a href="#0" class="prev inactive">Prev</a></li>
                    <li><a href="#0" class="next">Next</a></li>
                </ul>
            </div><?php /* /timeline */ ?>

            <div class="events-content">
                <ol>

                    <?php
                        $timelineCounter = 0; // Counter for posts
                        $timelineGetThisMany = -1; // Number of posts to pull
                        $timelineRecentPosts = new WP_Query(array(
                            'post_type' => 'Timeline',
                            'showposts' => $timelineGetThisMany, 
                            'offset' => 0,  // Set this to 1 to skip over first post, 2 to skip the first two, etc.
                            'order' => 'ASC', // Puts new posts first, to put oldest posts first, change to 'ASC'
                            'post__not_in' => get_option("sticky_posts"), // Ignore sticky posts for this particular query
                        ));
                    ?>

                    <?php while ($timelineRecentPosts->have_posts()) : $timelineRecentPosts->the_post(); ?>
                        <li class="timeline-content-<?php echo $timelineCounter++; ?> <?php if ($timelineCounter == 1) echo 'selected'; ?>" data-date="<?php echo get_the_date('j/m/Y'); ?>">
                            <?php /* <h2><a href="<?php echo get_permalink( get_the_ID() );?>"><?php echo get_the_title(); ?></a></h2> */ ?>
                            <h2><?php echo get_the_title(); ?></h2>
                            <em><?php echo get_the_date('M j, Y'); ?></em>
                            <?php the_content(); ?>
                            <a class="button" href="<?php echo get_permalink( get_the_ID() );?>">Read More</a>
                        </li>
                    <?php endwhile; wp_reset_postdata(); ?>

                </ol>

            </div><?php /* /events-content */ ?>
        </section><?php /* /horizontal-timeline */ ?>

    <?php return ob_get_clean();
}
add_shortcode('timeline_slider', 'timeline_slider');
?>