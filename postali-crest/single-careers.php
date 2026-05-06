<?php
/**
 * Single template
 *
 * @package Postali Parent
 * @author Postali LLC
 */

get_header();

$block_content = do_blocks( '
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group">
<!-- wp:post-content /-->
</div>
<!-- /wp:group -->'
);

$title = get_the_title();
$banner_image = get_the_post_thumbnail();
?>

<section class="banner-block" id="banner-child-split">
    <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
    <div class="columns">
        <div class="column-66 block">
            <div class="container">
                <h1 class="large-title"><?php echo $title; ?></h1>
                <a href="#apply" class="btn" target=""><span>Apply Now</span></a>
                <div class="spacer-60"></div>
            </div>
        </div>
        <div class="column-33">

        </div>
    </div>
</section>

<section class="body-container wp-block-group clip-top-slant-lh ltgrey-bg">
    <div class="container">
        <div class="wp-block-group content-wrapper">
            <div class="wp-block-group__inner-container">
                <?php echo $block_content; ?>

                <div class="wp-block-group__inner-container is-layout-constrained wp-block-group-is-layout-constrained">
                    <div class="entry-content wp-block-post-content is-layout-flow wp-block-post-content-is-layout-flow">
                        <a href="#apply" class="btn" target=""><span>Apply Now</span></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<div class="wp-block-group" id="apply">
    <div class="wp-block-group__inner-container is-layout-constrained wp-block-group-is-layout-constrained">
        <div class="entry-content wp-block-post-content is-layout-flow wp-block-post-content-is-layout-flow">
            <div class="wp-block-group dark-blue-bg clip-top-slant-lh">
                <div class="wp-block-group__inner-container is-layout-constrained wp-block-group-is-layout-constrained">
                    <div class="wp-block-columns alignwide is-layout-flex wp-container-core-columns-is-layout-9d6595d7 wp-block-columns-is-layout-flex">
                        
                        <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:23%"></div>

                        <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow form-column" style="flex-basis:45%">
                            <h2 class="wp-block-heading">Apply Below</h2>
                            <p class=" paragraph-subtitle">please submit the following materials:</p>
                            <ul class="wp-block-list">
                                <li>Cover letter</li>
                                <li>Resume</li>
                                <li>Law school transcript</li>
                                <li>Writing sample</li>
                            </ul>
                            <div class="contact-block form">
                                <div class="columns">
                                    <div class="column-full center">
                                        <?php echo do_shortcode('[gravityform id="4" title="false"]'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:23%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>