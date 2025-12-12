<?php
/**
 * 404 Page Not Found.
 *
 * @package Postali Parent
 * @author Postali LLC
 */

get_header(); ?>

<section class="banner-block" id="banner-standard-split">
    <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
    <div class="columns">
        <div class="column-50 block">
            <div class="container">
                <h1>Error 404</h1>
                <p class="large-title">we were unable to find that page.</p>
                <p>The page you’re trying to visit has either been removed or doesn’t exist. Please click below to return to the homepage or use the menu options above.</p>           
                <a href="/" class="btn" target="<?php echo $cta_link['target']; ?>"><span>Back To Home</span></a>
            </div>
        </div>
        <div class="column-50">
            <img src='/wp-content/uploads/2025/08/man-looking-in-binoculars.jpg' class='banner-img'/>
        </div>
    </div>
</section>

<div class="ltgrey-bg grey-spacer"></div>
<?php get_footer();
