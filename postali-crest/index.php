<?php
/**
* Template Name: Blog
 * @package Postali Crest Controller Theme
 * @author Postali LLC
 */

$archive_id = get_queried_object()->ID;

$manual_override = get_field('manual_override_featured_posts', $archive_id, $archive_id);
$title = get_field('title', $archive_id);
$subtitle = get_field('subtitle', $archive_id);
$banner_image = get_field('banner_image', $archive_id);
$cta_link = get_field('cta_button', $archive_id);

$featured_args = [
    'post_type' => 'post',
    'posts_per_page' => 4,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish',
	'paged' => get_query_var('paged')
];
$featured_posts = new WP_Query($featured_args);

$excluded_posts = [];

$args = [
    'post_type' => 'post',
    'posts_per_page' => 10,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish',
	'paged' => get_query_var('paged')
];

if( $manual_override ) {
	if( have_rows('featured_posts') ) {
		while( have_rows('featured_posts') ) {
			the_row();
			$post = get_sub_field('post');
			if (!in_array($post->ID, $excluded_posts)) {
				$excluded_posts[] = $post->ID;
			}
		}
		//$args['post__not_in'] = $excluded_posts;
	}
} else {
	if( $featured_posts->have_posts() ) {
		while( $featured_posts->have_posts() ) {
			$featured_posts->the_post();
			$excluded_posts[] .= get_the_ID();
			
		}
	} wp_reset_postdata();
	// $args['post__not_in'] = $excluded_posts;
}

$posts = new WP_Query($args);



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

<section class="page-content wp-block-group clip-top-slant-lh dark-blue-bg">
	<div class="results-scroller">
		<div class="columns">
			<div class="column-full">
				<div class="container">
					<h2 class="wp-block-heading heading-with-icon"><?php the_field('featured_posts_title', $archive_id); ?></h2>
					<div class="spacer-30"></div>
				</div>
				<?php 
				if( ( $manual_override ? have_rows('featured_posts') : $featured_posts->have_posts() ) ) : ?>
				<div class="results-wrapper">
					<?php 
					
					while( ( $manual_override ? have_rows('featured_posts') : $featured_posts->have_posts() ) ) : 
					
					if( $manual_override ) {
						the_row(); 
						$post = get_sub_field('post');
						$post_id = $post->ID; 
					} else {
						$featured_posts->the_post();
						$post_id = get_the_ID();
					}
					?>
					<div class="result">
						<a href="<?php the_permalink($post_id); ?>">
							<div class="columns">

								<div class="column-50 block">
									<?php $post_img = get_the_post_thumbnail($post_id);
										if( $post_img ) {
											echo $post_img;
										} else {
											$active_category = null;      
											$categories = get_the_category($post_id); 
											if ( $categories ) {
												foreach($categories as $key => $category) {
													if( $key === 0 ) {
														$active_category = $category->name;
													}
												}
											}
											switch( $active_category ) {
												case "Accolades" :
													$fallback_banner_img = '2061';
													break;
												case "Appellate" :
													$fallback_banner_img = '2062';
													break;
												case "Aviation" :
													$fallback_banner_img = '525';
													break;
												case "Business Litigation" :
													$fallback_banner_img = '2063';
													break;
												case "Class Action" :
													$fallback_banner_img = '2064';
													break;
												case "Complex Commercial" :
													$fallback_banner_img = '2065';
													break;
												case "Defamation" :
													$fallback_banner_img = '2066';
													break;
												case "News" :
													$fallback_banner_img = '2067';
													break;
												case "Personal Injury" :
													$fallback_banner_img = '2068';
													break;
												case "Wrongul Death" :
													$fallback_banner_img = '2069';
													break;
												default: 
													$fallback_banner_img = '2067';
													break;
											}
											echo wp_get_attachment_image($fallback_banner_img, 'full', false, ['class' => 'case-img']);
										}
									?>
								</div>

								<div class="column-50 block">
									<?php $post_icon = get_field('case_icon', $archive_id);
										if( !$post_icon ) {
											$post_icon = '/wp-content/uploads/2025/07/separators.svg';
										}

										$category = get_the_terms($post_id, 'category');
										if( $category && !is_wp_error($category) ) {
											$category = $category[0]->name;
										} else {
											$category = 'Uncategorized';
										}

										$assigned_attorneys = get_the_terms($post_id, 'landmark_case_attorneys');
									?>
									<div class="row row-1">
										<img src="<?php echo esc_url($post_icon); ?>" alt="<?php echo esc_attr(get_the_title($post_id)); ?>" class="case-icon" />
										<span class="case-category"><?php echo esc_html($category); ?></span>
									</div>
									<div class="row row-2">
										<h3><?php echo get_the_title($post_id); ?></h3>
									</div>
									<div class="row row-3">
										<p class="fake-btn btn"><span>Read More</span></p>
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
						<h2 class="wp-block-heading heading-with-icon"><?php the_field('section_title', $archive_id); ?></h2>
					</div>
					<div class="column-66">
						<p><?php the_field('section_copy', $archive_id); ?></p>
						<div class="filters">
							<?php
							$categories = get_terms([
								'taxonomy' => 'category',
								'hide_empty' => true,
                                'exclude' => array( 35 )
							]);
							if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
								echo '<a href="/news/" class="filter-btn btn active-filter" data-filter="all"><span>View All</span></a>';
								foreach ( $categories as $category ) {
									$cat_id = strtolower( str_replace(" ", "-", $category->name) );
									echo '<a href="/news/category/'. $category->slug .'" class="filter-btn btn" data-filter="' .$cat_id.'"><span>' . esc_html( $category->name ) . '</span></a>';
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
					<?php while( $posts->have_posts() ) : $posts->the_post(); 
						$post_categories = get_the_terms($post->ID, 'category');
						$category_names = [];
						$cat_classes = '';

						if( $post_categories && !is_wp_error($post_categories) ) {
							foreach ( $post_categories as $cat ) {
								$category_names[] = $cat->name;
							}
							$cat_classes = implode(' ', array_map(function($cat) {
								return strtolower(str_replace(" ", "-", $cat->name));
							}, $post_categories));
						} else {
							$category_names[] = 'Uncategorized';
							$cat_classes = 'uncategorized';
						}
					?>
						<div class="result <?php echo esc_attr($cat_classes); ?>">
							<?php if( strlen(get_the_content($post->ID)) > 300) : ?>
							<a href="<?php the_permalink($post->ID); ?>">
							<?php endif; ?>
								<div class="columns">

									<div class="column-full block">
										<div class="row row-1">
											<div class="category-wrapper">
												<?php foreach ($category_names as $cat_name): ?>
													<span class="case-category"><?php echo esc_html($cat_name); ?></span>
												<?php endforeach; ?>
											</div>
										</div>
										<div class="row row-2">
											<h3><?php echo get_the_title($post->ID); ?></h3>
											<img src="/wp-content/uploads/2025/07/separators.svg" alt="line separator icon" class="case-icon" />
											
											<?php if( strlen(get_the_content($post->ID)) > 300) : ?>
												<p class="fake-btn btn"><span>Read More</span></p>
											<?php endif; ?>
										</div>
									</div>
								</div>                        
							<?php if( strlen(get_the_content($post->ID)) > 300) : ?>
							</a>
							<?php endif; ?>
						</div>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
			<?php
			the_posts_pagination([
				'total'     => $posts->max_num_pages,
				'prev_text' => '',
				'next_text' => '',
			]);
			?>
		</div>
	</div>
</section>

<?php get_footer(); ?>