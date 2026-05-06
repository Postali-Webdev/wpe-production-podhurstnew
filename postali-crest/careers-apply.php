<?php
/**
 * Template Name: Careers - Apply
 * @package Postali Crest Controller Theme
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

?>

<?php 
    if(!empty( $_SERVER['QUERY_STRING']) ) {
        $job = str_replace("job=", "", $_SERVER['QUERY_STRING']); 
    } else {
        $job = "General";
    }
?>

<div class="body-container">

    <section class="banner-block" id="banner-child-split">
        <p id="breadcrumbs"><span><span><a href="https://podhurstnew.local/">Home</a></span> › <span class="breadcrumb_last" aria-current="page">Term-Time Law Clerk</span></span></p> 
        <div class="columns">
            <div class="column-66 block">
                <div class="container">
                    <h1 class="large-title">Application - <?php echo urldecode($job); ?></h1>
                    <div class="spacer-90"></div>
                </div>
            </div>
            <div class="column-33">

            </div>
        </div>
    </section>


    <?php echo $block_content; ?>

</div>

<?php get_footer(); ?>