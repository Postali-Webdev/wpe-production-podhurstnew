<?php
/**
 * Template Name: Testimonials Archive
 * 
 * @package Postali Parent
 * @author Postali LLC
 */

$archive_id = get_queried_object()->ID;
$paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
$args = [
    'post_type' => 'testimonial',
    'posts_per_page' => 10,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish',
	'paged' => $paged
];



$title = get_field('title', $archive_id);
$subtitle = get_field('subtitle', $archive_id);
$banner_img = get_field('banner_background_image', $archive_id);
$featured_testimonial = get_field('featured_testimonial', $archive_id);
$featured_testimonial_id = $featured_testimonial->ID;

if( $featured_testimonial_id ) {
	$args['post__not_in'] = array($featured_testimonial_id);
}

$testimonials = new WP_Query($args);

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
				<?php if( $featured_testimonial ) :  
					$author = get_the_title($featured_testimonial_id);
					$copy = get_the_content(null, false, $featured_testimonial_id);
				?>
					
				<div class="featured-success-box">
					<div class="row row-1">
						<p class="quote">“</p>
						<p class="copy"><?php echo $copy; ?></p>
						<p class="paragraph-subtitle"><?php echo $author; ?></p>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<span id="main-content"></span>
<section class="body-wrapper body-wrapper-1 wp-block-group clip-top-slant-hl ltgrey-bg">
	<div class="testimonials-scroller">
		<div class="columns">
			<div class="column-full">
				<div class="slider-arrow-wrapper">
						<div class="slick-custom-btn testimonial-slick-custom-prev"></div>
						<div class="slick-custom-btn testimonial-slick-custom-next"></div>
					</div>
				<div id="testimonials" class="slide">
				<?php if( $testimonials->have_posts() ): ?>
					<?php while( $testimonials->have_posts() ): $testimonials->the_post(); ?>
						
						
							<?php
							
							$ID = get_the_ID();
							$review_source = get_field('testimonial_source', $ID);
							switch( $review_source ) {
								case 'google':
									$review_badge = "/wp-content/uploads/2025/07/google-review-logo.png";
									break;
								case 'avvo':
									$review_badge = "/wp-content/uploads/2025/12/avvo-logo.png";
									break;
								case 'chambers':
									$review_badge = "/wp-content/uploads/2025/12/chambers-logo.png";
									break;
								default: 
									$review_badge = "/wp-content/uploads/2025/07/google-review-logo.png";
									break;
							}
							?>
							<div class="testimonial">
								<div>
									<div class="columns">
										<div class="column-full">
											<div class="row row-1">
												<div class="stars"></div>
											</div>
											<div class="row row-2">
												<p>“<?php echo get_the_content($ID); ?>”</p>
											</div>
											<div class="row row-3">
												<p class="author"><?php echo get_the_title($ID); ?></p>
												<img class="review-badge-icon" src="<?php echo $review_badge; ?>" alt="<?php echo $review_source; ?> review badge">

											</div>
										</div>
									</div>                        
								</div>
							</div>
							<?php wp_reset_postdata(); ?>
					<?php endwhile; ?>
				<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
