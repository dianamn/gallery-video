<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$license = array(
    array(
        "title" => __('Load More And Pagination', 'gallery-video' ),
        "text" => __('This feature will allow to demonstrate only a part of your created videos, hiding the rest of them under “load more” button, or dividing all your projects into several pages.', 'gallery-video' ),
        "icon" => "-250px -465px"
    ),
    array(
        "title" => __('Custom URL For Each Video', 'gallery-video' ),
        "text" => __('When adding a Video to gallery, you can add a clickable link from it to a specific page or URL.', 'gallery-video' ),
        "icon" => "-335px -465px"
    ),
    array(
        "title" => __('Advanced View Customization', 'gallery-video' ),
        "text" => __('Unlock all the settings of gallery views, allowing to edit and customize the views, size, effects, buttons, navigation tools, colors and more.', 'gallery-video' ),
        "icon" => "-26px -290px"
    ),
    array(
        "title" => __('Full Video Configuration', 'gallery-video' ),
        "text" => __('Unlock the advanced configuration settings, so that you could use the plugin fully, configure all the corners of videos to your taste.', 'gallery-video' ),
        "icon" => "-132px -295px"
    ),
    array(
        "title" => __('Video Resizer Settings', 'gallery-video' ),
        "text" => __('Unlock the options allowing to play around videos, thumbs and edit all the corners of media using advanced resizer settings.', 'gallery-video' ),
        "icon" => "-229px -286px"
    ),
    array(
        "title" => __('Color and Text Styling', 'gallery-video' ),
        "text" => __('Unlock more options allowing to edit, add or customize every text and color of the plugin with multiple solutions', 'gallery-video' ),
        "icon" => "-315px -286px"
    ),
    array(
        "title" => __('YouTube Videos', 'gallery-video' ),
        "text" => __('Video Gallery can be used with the most popular video site -YouTube, Simply copy the link and add it to the Video Gallery gallery will bring the video in it.', 'gallery-video' ),
        "icon" => "-25px -386px"
    ),
    array(
        "title" => __('Lightbox Views Library', 'gallery-video' ),
        "text" => __('Some view types of our wonderful Gallery uses quite new designed Lightbox/Popup tool and additional 6 Styles for it.', 'gallery-video' ),
        "icon" => "-141px -383px"
    ),
    array(
        "title" => __('Advanced Lightbox Options', 'gallery-video' ),
        "text" => __('2 Type of Lightbox with tons of social sharing options, zooming, framing, navigation and sliding effects will make users love the plugin.', 'gallery-video' ),
        "icon" => "-243px -394px"
    ),
    array(
        "title" => __('Video slideshow', 'gallery-video' ),
        "text" => __('Showcase Videos in Stunning Slideshows with advanced options, styles and effects.', 'gallery-video' ),
        "icon" => "-335px -387px"
    ),
    array(
        "title" => __('vimeo Videos', 'gallery-video' ),
        "text" => __('The other source of adding videos in Video Gallery- Vimeo. Turn your gallery into Vimeo Gallery using your collection of vimeo videos.', 'gallery-video' ),
        "icon" => "-411px -320px"
    )
);
?>


<div class="responsive grid">
    <?php foreach ($license as $key => $val) { ?>
        <div class="col column_1_of_3">
            <div class="header">
                <div class="col-icon" style="background-position: <?php echo $val["icon"]; ?>; ">
                </div>
                <?php echo $val["title"]; ?>
            </div>
            <p><?php echo $val["text"]; ?></p>
            <div class="col-footer">
                <a href="http://huge-it.com/wordpress-video-gallery/" target="_blank" class="a-upgrate"><?php _e('Upgrade', 'gallery-video' ); ?></a>
            </div>
        </div>
    <?php } ?>
</div>


<div class="license-footer">
    <p class="footer-text">
        <?php _e('You are using the Lite version of the Video Gallery Plugin for WordPress. If you want to get more awesome options, advanced features, settings to customize every area of the plugin, then check out the Full License plugin. The full version of the plugin is available in 3 different packages of one-time payment.', 'gallery-video' ); ?>
    </p>
    <p class="this-steps max-width">
        <?php _e('After the purchasing the commercial version follow this steps', 'gallery-video' ); ?>
    </p>
    <ul class="steps">
        <li><?php _e('Deactivate Huge IT Video Gallery Plugin', 'gallery-video' ); ?></li>
        <li><?php _e('Delete Huge IT Video Gallery', 'gallery-video' ); ?></li>
        <li><?php _e('Install the downloaded commercial version of the plugin', 'gallery-video' ); ?></li>
    </ul>
    <a href="http://huge-it.com/wordpress-video-gallery/" target="_blank"><?php _e('Purchase a License', 'gallery-video' ); ?></a>
</div>
