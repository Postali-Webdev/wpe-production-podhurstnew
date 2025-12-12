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
$attorney_id = get_field('attorney'); 
if( $attorney_id ) {
    $name = get_field('first_name', $attorney_id) . ' ' . get_field('middle_initial', $attorney_id) . ' ' . get_field('last_name', $attorney_id);
    $excerpt = get_field('excerpt', $attorney_id);
    $experience_years = get_field('years_of_experience', $attorney_id);
    $practice_areas = get_field('practice_areas', $attorney_id);
    $attorney_image = get_the_post_thumbnail( $attorney_id, 'full' );
    $attorney_link = get_permalink( $attorney_id );
    $attorney_title = get_field('attorney_title', $attorney_id);
}

if( !$banner_image ) {
    $active_category = null;      
    $categories = get_the_category(); 
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
}
?>

<section class="banner-block" id="banner-child-split">
    <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
    <div class="columns">
        <div class="column-66 block">
            <div class="container">
                <p class="paragraph-subtitle">Last Updated: <?php echo get_the_modified_date("M d, Y"); ?></p>
                <p class="original-publish-date">Originally Published: <?php echo get_the_date("M d, Y"); ?></p>
                <h1 class="large-title"><?php echo $title; ?></h1>
                <?php if( $attorney_id ) : ?>
                <div class="author-wrapper">
                    <div>
                        <p>Written By</p>
                        <img decoding="async" src="/wp-content/uploads/2025/07/separators.svg" alt="$30 Million Settlement in a Group of Cases Involving the Insurer of a Learjet" class="case-icon">
                    </div>
                    <p class="author-name"><?php echo esc_html( $name ); ?></p>
                </div>
                <?php endif; ?>
                <div class="categories-wrapper">
                    <?php $categories = get_the_category();
                    if ( ! empty( $categories ) ) {
                        foreach ( $categories as $category ) {
                            echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="post-category">' . esc_html( $category->name ) . '</a> ';
                        }
                    } else {
                        echo '<span class="post-category">Uncategorized</span>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="column-33">
            <?php if( $banner_image ) {
                echo $banner_image;
            }  else {
                echo wp_get_attachment_image($fallback_banner_img, 'full', false, ['class' => 'banner-img']);
            } ?>
        </div>
    </div>
</section>

<section class="body-container wp-block-group clip-top-slant-lh ltgrey-bg">
    <div class="container">
        <div class="wp-block-group content-wrapper">
            <div class="wp-block-group__inner-container">
                <?php echo $block_content; ?>
            </div>
        </div>
    </div>
</section>

<section class="body-container wp-block-group clip-top-slant-lh dkblue-bg">


    <?php if( $attorney_id ) : ?>
        <div class="container">
            <div class="wp-block-group">
                <div class="wp-block-group__inner-container">
                    <div class="author-block">
                        <div class="block-title">
                            <h2>About The Author</h2>
                            <img decoding="async" src="/wp-content/uploads/2025/07/separators.svg" alt="$30 Million Settlement in a Group of Cases Involving the Insurer of a Learjet" class="case-icon">
                        </div>
                        <div class="inner-wrapper">
                            <div class="attorney-img">
                                <?php if( $attorney_image ) {
                                    echo $attorney_image;
                                } ?>
                            </div>
                            <div class="content">
                                <p class="author-name"><?php echo esc_html( $name ); ?></p>
                                <p class="author-title"><?php echo $attorney_title; ?></p>
                                <?php echo $excerpt; ?>
                                <p class="author-experience"><strong>Experience:</strong> <?php echo esc_html( $experience_years ); ?>+ years</p>
                                <?php if( $practice_areas ) : $count = 0; $pa_length = count( $practice_areas ); ?>
                                <p class="author-practice-areas"><strong>Practice Areas:</strong> 
                                    <?php foreach( $practice_areas as $pa ) : ?>
                                        <a href="/<?php echo $pa['value']; ?>/" class="case-category"><?php echo $pa['label']; ?></a><?php if( $count < $pa_length - 1 ) echo ', '; $count++; ?>
                                    <?php endforeach; ?>
                                </p>
                                <?php endif; ?>
                                <a href="<?php echo esc_url( $attorney_link ); ?>" class="btn"><span>Read Bio</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>


    <div class="container">
        <div class="wp-block-group">
            <div class="wp-block-group__inner-container">
                <h2>Related Posts</h2>
                <div class="related-posts">
                    <?php
                    $current_post_id = get_the_ID();
                    $categories = get_the_category();
                    $category_ids = [];

                    if ( ! empty( $categories ) ) {
                        foreach ( $categories as $category ) {
                            $category_ids[] = $category->term_id;
                        }
                    }

                    $args = [
                        'posts_per_page' => 3,
                        'post__not_in'   => [ $current_post_id ],
                        'category__in'   => $category_ids,
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                    ];

                    $related_query = new WP_Query( $args );

                    if ( $related_query->have_posts() ) :
                        while ( $related_query->have_posts() ) : $related_query->the_post(); 
                        
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
                                        <?php foreach ($category_names as $cat_name): ?>
                                            <span class="case-category"><?php echo esc_html($cat_name); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="row row-2">
                                        <h3><?php echo get_the_title($post->ID); ?></h3>
                                        <img src="/wp-content/uploads/2025/07/separators.svg" alt="line separator icon" class="case-icon" />
                                        
                                        <?php if( strlen(get_the_content($post->ID)) > 300) : ?>
                                            <p class="fake-btn btn"><span>Read Blog</span></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>                        
							<?php if( strlen(get_the_content($post->ID)) > 300) : ?>
							</a>
							<?php endif; ?>
						</div>
                        <?php endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<p>No related posts found.</p>';
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>