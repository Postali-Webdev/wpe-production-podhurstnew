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

<section class="banner-block" id="banner-full-bg">
    <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
	<?php if($banner_img) {
		echo wp_get_attachment_image($banner_img['ID'], 'full', false, array('class' => 'banner-bg'));
	} ?>
    <div class="container">
		<div class="columns">
			<div class="column-50 block">
				<div class="container">
					<p class="paragraph-subtitle"><?php echo $subtitle; ?></p>
					<h1 class="large-title"><?php echo $title; ?></h1>
					<p><?php the_field('copy'); ?></p>
					<?php if (get_field('cta_button')): $cta_btn = get_field('cta_button'); ?>
						<a href="<?php echo $cta_btn['url']; ?>" class="btn"><span><?php echo $cta_btn['title']; ?></span></a>
					<?php endif; ?>

				</div>
			</div>
			<div class="column-50">

			</div>
		</div>
	</div>
</section>
<span id="main-content"></span>
<section class="body-wrapper body-wrapper-1 wp-block-group clip-top-slant-hl dark-blue-bg">
    <div class="container">
		<div class="columns">
			<div class="column-66 center">

				<div id="careers">
						
                    <?php echo $block_content; ?>

				</div>
			</div>
		</div>
    </div>
</section>


<?php get_footer(); ?>
