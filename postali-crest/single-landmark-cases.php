<?php get_header();

if( have_posts() ) :
    while( have_posts() ):
        the_post();
        $parent_page = get_page_by_path('landmark-cases');
        $parent_page_id = $parent_page ? $parent_page->ID : 0;
        $banner_image = get_field('banner_image', $parent_page_id);
                  
        $category = get_the_terms($post->ID, 'landmark_case_category');
        if( $category && !is_wp_error($category) ) {
            $category_name = $category[0]->name;
            $case_icon = get_field('case_icon', 'landmark_case_category_' . $category[0]->term_id);
            
        } else {
            $category_name = 'Uncategorized';
        }
        $cat_id = strtolower( str_replace(" ", "-", $category_name) );
					
?>

<section class="banner-block" id="banner-child-split">
    <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
    <div class="columns">
        <div class="column-66 block">
            <div class="container">
                <h1><?php echo get_the_title(); ?></h1>
                <p class="large-title">Landmark Cases & Notable Verdicts</p>
				<a href="tel:<?php echo get_field('phone_number', 'options'); ?>" class="btn"><span> <?php echo get_field('phone_number', 'options'); ?></span></a>
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
<section class="page-content-bottom wp-block-group clip-top-slant-lh">
    <div class="container">
        <div class="content">
            <div class="main-content">
                <div class="result-feed-single">
                        <div class="result">
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
                                        <?php echo wpautop(get_the_content($post->ID)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>

 
<?php endwhile;
endif; ?>

<?php get_footer(); ?>