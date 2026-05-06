<?php
/**
 * Template Name: Careers Archive
 * 
 * @package Postali Parent
 * @author Postali LLC
 */

$archive_id = get_queried_object()->ID;
$paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
$args = [
    'post_type' => 'careers',
    'posts_per_page' => 10,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish',
	'paged' => $paged
];

$careers = new WP_Query($args);

$title = get_field('title', $archive_id);
$subtitle = get_field('subtitle', $archive_id);
$banner_img = get_field('banner_background_image', $archive_id);

$block_content = do_blocks( '
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group">
<!-- wp:post-content /-->
</div>
<!-- /wp:group -->'
);


get_header(); ?>


<div class="body-container">
    <section class="banner-block" id="banner-standard-split">
        <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
        <div class="columns">
            <div class="column-50 block">
                <div class="container">
                    <h1>Careers</h1>    
                    <p class="large-title">Join Our Team</p>
                    <a href="/contact-us/" target="" class="btn"><span>Contact Us</span></a>
                </div>
            </div>
            <div class="column-50">
                <img src='/wp-content/uploads/2025/11/podhurst-orseck-office-frontdesk.jpg.webp' class='banner-img'/>
            </div>
        </div>
    </section>

    <div class="wp-block-group">
        <div class="wp-block-group">
            <div class="wp-block-group__inner-container is-layout-constrained wp-block-group-is-layout-constrained">
                <div class="entry-content wp-block-post-content is-layout-flow wp-block-post-content-is-layout-flow">
                    <div class="wp-block-group light-grey-bg clip-top-slant-lh"><div class="wp-block-group__inner-container is-layout-constrained wp-block-group-is-layout-constrained">
                        <div class="wp-block-columns alignwide justify-space-between is-layout-flex wp-container-core-columns-is-layout-9d6595d7 wp-block-columns-is-layout-flex">
                            <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:45%">
                                <h2 class="wp-block-heading">Current openings</h2>
                                <p class=" paragraph-subtitle">explore our current openings or submit your info using our general application below.</p>
                                <a href="/careers-apply?job=General Interest" class="btn" target=""><span>General Application</span></a>
                            </div>

                            <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:45%">
                                
                            <?php if( $careers->have_posts() ): ?>
                            <?php while( $careers->have_posts() ): $careers->the_post(); ?>   
                                <div class="career">
                                    <a href="<?php the_permalink(); ?>?job=<?php the_title(); ?>" class="post-title"><h3><?php the_title(); ?> </h3></a>
                                    <?php the_excerpt(); ?>
                                </div>
                                <?php wp_reset_postdata(); ?>
                            <?php endwhile; ?>
                            <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="wp-block-group dark-blue-bg"><div class="wp-block-group__inner-container is-layout-constrained wp-block-group-is-layout-constrained">
                    <div class="wp-block-columns alignwide justify-space-between is-layout-flex wp-container-core-columns-is-layout-9d6595d7 wp-block-columns-is-layout-flex">
                        <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:45%">
                                <h2 class="wp-block-heading heading-with-icon">About Our Firm</h2>
                            </div>
                            <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:45%">
                                <p class=" paragraph-subtitle">Renowned for landmark victories and trusted nationwide</p>
                                <p>Podhurst Orseck is a premier litigation firm with decades of experience in aviation law, catastrophic personal injury, class actions, complex commercial litigation, and appeals. Based in South Florida and offering boutique client attention, our precision, integrity, and record-setting results set us apart.</p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php get_footer(); ?>