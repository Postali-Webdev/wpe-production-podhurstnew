<?php
/**
* Template Name: Our Team Archive
 * @package Postali Crest Controller Theme
 * @author Postali LLC
 */

$archive_id = get_queried_object()->ID;
$paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;

$args = [
    'post_type' => 'attorneys',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish',
];
$attorneys = new WP_Query($args);

$title = get_field('title', $archive_id);
$subtitle = get_field('subtitle', $archive_id);
$banner_img = get_field('banner_background_image', $archive_id);

get_header(); ?>

<section class="banner-block" id="banner-full-bg">
    <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
	<?php if($banner_img) {
		echo wp_get_attachment_image($banner_img['ID'], 'full', false, array('class' => 'banner-bg'));
	} ?>
    <div class="container">
		<div class="columns">
			<div class="column-75 block">
				<div class="container">
					<p class="paragraph-subtitle"><?php echo $subtitle; ?></p>
					<h1 class="large-title"><?php echo $title; ?></h1>
					<p><?php the_field('copy'); ?></p>
					<?php if (get_field('cta_button')): $cta_btn = get_field('cta_button'); ?>
						<a href="<?php echo $cta_btn['url']; ?>" class="btn"><span><?php echo $cta_btn['title']; ?></span></a>
					<?php endif; ?>

				</div>
			</div>
		</div>
	</div>
</section>
<span id="main-content"></span>
<section class="body-wrapper body-wrapper-1 wp-block-group clip-top-slant-hl">
	<div class="container">
		<div class="columns">
			<div class="column-full">
				<?php if( $attorneys->have_posts() ) : ?>
					<div class="attorneys-wrapper">
						<?php while( $attorneys->have_posts() ) : $attorneys->the_post(); 
						$ID = get_the_ID();
						$first_name = get_field('first_name', $ID);
						$middle_initial = get_field('middle_initial', $ID);
						$last_name = get_field('last_name', $ID);
						$full_name = $first_name . ' ' . $middle_initial . ' ' . $last_name;
						$image = get_the_post_thumbnail();
						?>
							<div class="attorney-card">
								<a href="<?php echo get_the_permalink(); ?>">
									<?php if ($image) echo $image; ?>
									<div class="copy">
										<h3><?php echo $full_name; ?></h3>
										<h4><?php the_field('attorney_title'); ?></h4>
									</div>
								</a>
							</div>
						<?php endwhile; ?>
					</div>
					<nav class="navigation pagination">
						<div class="nav-links">
							<?php
							echo paginate_links([
								'total' => $attorneys->max_num_pages,
								'current' => $paged,
								'prev_text' => '',
								'next_text' => '',
							]);
							?>
						</div>
					</nav>
				<?php endif; wp_reset_postdata();?>
			</div>
		</div>
		<div class="spacer-30"></div>
		<div class="columns">
			<div class="column-full block">
				<?php if( have_rows('attorneys') ) : ?>
					<h2>In Memoriam</h2>
					<div class="attorneys-wrapper in-memoriam">
						<?php while(have_rows('attorneys') ) : the_row(); 
							$image = get_sub_field('headshot');
							$name = get_sub_field('name');
						?>
							<div class="attorney-card">
								<?php if ($image) echo wp_get_attachment_image( $image['ID'], 'full', false, array('class' => 'attorney-headshot') ); ?>
								<h3><?php echo $name; ?></h3>
							</div>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
				<div class="spacer-30"></div>
				<a href="/in-memoriam/" class="btn"><span>Learn More</span></a>
			</div>
		</div>

	</div>
</section>

<?php get_footer(); ?>