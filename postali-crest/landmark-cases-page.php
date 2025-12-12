<?php
/**
* Template Name: Landmark Cases Archive
 * @package Postali Crest Controller Theme
 * @author Postali LLC
 */
$archive_id = get_queried_object()->ID;
$manual_override = get_field('manual_override_featured_cases');
$title = get_field('title');
$subtitle = get_field('subtitle');
$banner_image = get_field('banner_image');
$cta_link = get_field('cta_button');

$featured_args = [
    'post_type' => 'landmark-cases',
    'posts_per_page' => 4,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish',
	'paged' => get_query_var('paged')
];
$featured_cases = new WP_Query($featured_args);

$excluded_cases = [];
$archive_id = get_queried_object()->ID;
$args = [
    'post_type' => 'landmark-cases',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish',
	'paged' => get_query_var('paged')
];

if( $manual_override ) {
	if( have_rows('featured_cases') ) {
		while( have_rows('featured_cases') ) {
			the_row();
			$case = get_sub_field('case');
			if (!in_array($case->ID, $excluded_cases)) {
				$excluded_cases[] = $case->ID;
			}
		}
		// $args['post__not_in'] = $excluded_cases;
	}
} else {
	if( $featured_cases->have_posts() ) {
		while( $featured_cases->have_posts() ) {
			$featured_cases->the_post();
			$excluded_cases[] .= get_the_ID();
		}
	} wp_reset_postdata();
	// $args['post__not_in'] = $excluded_cases;
}

$cases = new WP_Query($args);

get_header(); ?>

<section class="banner-block" id="banner-child-split">
    <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
    <div class="columns">
        <div class="column-66 block">
            <div class="container">
                <h1><?php echo $title; ?></h1>
                <p class="large-title"><?php echo $subtitle; ?></p>
				<a href="<?php echo $cta_link['url']; ?>" target="<?php echo $cta_link['target']; ?>" class="btn"><span><?php echo $cta_link['title']; ?></span></a>
            </div>
        </div>
        <div class="column-33">
            <?php if( $banner_image ) {
                echo wp_get_attachment_image($banner_image['ID'], 'full', false, ['class' => 'banner-img']);
            } ?>
        </div>
    </div>
</section>
<span id="main-content"></span>
<section class="page-content wp-block-group clip-top-slant-lh dark-blue-bg">
	<div class="results-scroller">
		<div class="columns">
			<div class="column-full">
				<div class="container">
					<h2 class="wp-block-heading heading-with-icon">Latest Cases</h2>
					<div class="spacer-30"></div>
				</div>
				<?php 			
				if( ( $manual_override ? have_rows('featured_cases') : $featured_cases->have_posts() ) ) : ?>
				<div class="results-wrapper">
					<?php 
					
					while( ( $manual_override ? have_rows('featured_cases') : $featured_cases->have_posts() ) ) : 
					
					if( $manual_override ) {
						the_row(); 
						$case = get_sub_field('case');
						$post_id = $case->ID; 
					} else {
						$featured_cases->the_post();
						$post_id = get_the_ID();
					}
					?>
					<div class="result">
						<a href="<?php the_permalink($post_id); ?>">
							<div class="columns">

								<div class="column-50 block">
									<?php $case_img = get_the_post_thumbnail( $post_id, 'full', [ 'class' => 'case-img'] ); 
										if( $case_img ) {
											echo $case_img;
										}
									?>
								</div>

								<div class="column-50 block">
									<?php $case_icon = get_field('case_icon');
										if( !$case_icon ) {
											$case_icon = '/wp-content/uploads/2025/07/separators.svg';
										}

										$category = get_the_terms($post_id, 'landmark_case_category');
										if( $category && !is_wp_error($category) ) {
											$category = $category[0]->name;
										} else {
											$category = 'Uncategorized';
										}

										$assigned_attorneys = get_the_terms($post_id, 'landmark_case_attorneys');
									?>
									<div class="row row-1">
										<img src="<?php echo esc_url($case_icon); ?>" alt="<?php echo esc_attr(get_the_title($post_id)); ?>" class="case-icon" />
										<span class="case-category"><?php echo esc_html($category); ?></span>
									</div>
									<div class="row row-2">
										<h3><?php echo get_the_title($post_id); ?></h3>
										<?php if( $assigned_attorneys ) { ?>
											<p>Attorneys on the Case:</p>
											<div class="img-wrapper">
											<?php foreach( $assigned_attorneys as $attorney ) {

												$attorney_query = new WP_Query([          
													'post_type' => 'attorneys', 
													'offset' => 0,  
													'posts_per_page' => 1,
													'post_status'    => 'publish',
													'name' => $attorney->slug,
												]);

												if( $attorney_query->have_posts() ) {
													while( $attorney_query->have_posts() ) {
														$attorney_query->the_post();
														$attorney_img = get_the_post_thumbnail( get_the_ID(), 'full', [ 'class' => 'attorney-img'] );
														if( $attorney_img ) {
															echo $attorney_img;
														}
													}
												}                                         
											} ?>
											</div>
										<?php } wp_reset_postdata(); ?>
									</div>
									<div class="row row-3">
										<p class="fake-btn btn"><span>Read Case Details</span></p>
									</div>
								</div>
							</div>                        
						</a>
					</div>
					<?php endwhile; ?>
				</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
</section>

<section class="page-content-bottom">
	<div class="container">
		<div class="wp-block-group content-wrapper dark-blue-bg">
			<div class="columns">
				<div class="column-full">
					<div class="column-33">
						<h2 class="wp-block-heading heading-with-icon"><?php the_field('section_title'); ?></h2>
					</div>
					<div class="column-66">
						<p><?php the_field('section_copy'); ?></p>
						<div class="filters">
							<?php
							$categories = get_terms([
								'taxonomy' => 'landmark_case_category',
								'hide_empty' => true,
							]);
							if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
								echo '<div class="filter-btn btn active-filter" data-filter="all"><span>View All</span></div>';
								foreach ( $categories as $category ) {
									$cat_id = strtolower( str_replace(" ", "-", $category->name) );
									echo '<div class="filter-btn btn" data-filter="' .$cat_id.'"><span>' . esc_html( $category->name ) . '</span></div>';
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="content">
			<div class="main-content">
				<div class="result-feed">
					<?php while( $cases->have_posts() ) : $cases->the_post(); 
						$category = get_the_terms($post->ID, 'landmark_case_category');
						if( $category && !is_wp_error($category) ) {
							$category_name = $category[0]->name;
							$case_icon = get_field('case_icon', 'landmark_case_category_' . $category[0]->term_id);
							
						} else {
							$category_name = 'Uncategorized';
						}
						$cat_id = strtolower( str_replace(" ", "-", $category_name) );
					?>
						<div class="result <?php echo $cat_id; ?>">
							<div class="columns">
								<div class="column-full block">
									<div class="row row-1">
										<?php if( $case_icon ) : ?>
											<img src="<?php echo $case_icon['url']; ?>" alt="<?php echo $case_icon['alt'] ?>" class="case-icon" />
										<?php endif; ?>
										<span class="case-category"><?php echo esc_html($category_name); ?></span>
									</div>
									<div class="row row-2">
										<h3><?php echo get_the_title($post->ID); ?></h3>
										<img src="/wp-content/uploads/2025/07/separators.svg" alt="line separator icon" class="case-icon" />
										<div class="spacer-30"></div>
										<?php echo '<a href="' . get_permalink($post->ID) . '" class="btn"><span>Read More</span></a>'; ?>
									</div>
								</div>
							</div>                        
						</div>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
			<?php the_posts_pagination(); ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>