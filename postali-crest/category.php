<?php
/**
*
 * @package Postali Crest Controller Theme
 * @author Postali LLC
 */

$archive_id = 227;
$manual_override = get_field('manual_override_featured_posts', $archive_id, $archive_id);
$title = get_field('title', $archive_id);
$subtitle = get_field('subtitle', $archive_id);
$banner_image = get_field('banner_image', $archive_id);
$cta_link = get_field('cta_button', $archive_id);


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

<section class="page-content-bottom">
	<div class="container">
		<div class="wp-block-group content-wrapper dark-blue-bg">
			<div class="columns">
				<div class="column-full">
					<div class="column-33">
						<h2 class="wp-block-heading heading-with-icon"><?php echo single_cat_title(); ?></h2>
					</div>
					<div class="column-66">
						<p><?php the_field('section_copy'); ?></p>
						<div class="filters">
							<?php
							$categories = get_terms([
								'taxonomy' => 'category',
								'hide_empty' => true,
                                'exclude' => array( 35 )
							]);
							if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
								echo '<a href="/news/" class="filter-btn btn" data-filter="all"><span>View All</span></a>';
								foreach ( $categories as $category ) {
									$cat_id = strtolower( str_replace(" ", "-", $category->name) );
									echo '<a href="/news/category/'. $category->slug .'/" class="filter-btn btn'. ($category->name == single_cat_title('', false) ? ' active-filter' : '') .'" data-filter="' .$cat_id.'"><span>' . esc_html( $category->name ) . '</span></a>';
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
					<?php while( have_posts() ) : the_post(); 
						$categories = get_the_terms($post->ID, 'category');
						$category_names = [];
						$category_icons = [];

						if( $categories && !is_wp_error($categories) ) {
							foreach ( $categories as $cat ) {
								$category_names[] = $cat->name;
								$icon = get_field('case_icon', 'category_' . $cat->term_id, $archive_id);
								$category_icons[] = $icon;
							}
							$cat_classes = implode(' ', array_map(function($cat) {
								return strtolower(str_replace(" ", "-", $cat->name));
							}, $categories));
						} else {
							$category_names[] = 'Uncategorized';
							$category_icons[] = false;
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
											<?php foreach ($category_names as $cat_name): ?>
												<span class="case-category"><?php echo esc_html($cat_name); ?></span>
											<?php endforeach; ?>
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
			<?php the_posts_pagination(); ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>