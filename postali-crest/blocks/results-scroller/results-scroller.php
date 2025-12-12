<?php 

/**
 * Banner Block template.
 *
 * @param array $block The block settings and attributes.
 */
$title = get_field('section_title') ? get_field('section_title') : get_field('cases_scroller_section_title', 'options');
$subtitle = get_field('section_subtitle') ? get_field('section_subtitle') : get_field('cases_scroller_section_subtitle', 'options');
$upper_copy = get_field('copy') ? get_field('copy') : get_field('cases_scroller_copy', 'options');
$lower_copy = get_field('section_lower_copy') ? get_field('section_lower_copy') : get_field('cases_scroller_lower_copy', 'options');
$cta_button = get_field('cta_button') ? get_field('cta_button') : get_field('cases_scroller_cta_button', 'options');
?>
<div class="wp-block-group content-wrapper">
    <div class="wp-block-group__inner-container is-layout-constrained wp-block-group-is-layout-constrained">
    <h2 class="wp-block-heading has-text-align-center"><?php echo $title; ?></h2>
    <p class="has-text-align-center paragraph-subtitle"><?php echo $subtitle; ?></p>
    <?php echo $upper_copy; ?>
    </div>
</div>

<div class="results-scroller">
    <div class="columns">
        <div class="column-full">
            <?php $total_results = count(get_field('results')); ?>
            <div class="results-wrapper results-wrapper-<?php echo $total_results; ?>">
            <?php if( have_rows('results') ): ?>
            <?php while( have_rows('results') ): the_row(); ?>
                <?php $post_object = get_sub_field('result'); ?>
                <?php if( $post_object ): ?>
                    <?php // override $post
                    $post = $post_object;
                    $post_type = $post->post_type;
                    setup_postdata( $post );
                    ?>
                    <div class="result">
                        <a href="<?php the_permalink($post->ID); ?>">
                            <div class="columns">

                                <div class="column-50 block">
                                    <?php $case_img = get_the_post_thumbnail( $post->ID, 'full', [ 'class' => 'case-img'] ); 
                                        if( $case_img ) {
                                            echo $case_img;
                                        } else {
                                            echo '<img src="/wp-content/uploads/2025/07/aviation-plane-in-the-air.jpg.webp" alt="' . esc_attr(get_the_title($post->ID)) . '" class="case-img" />';
                                        }
                                    ?>
                                </div>

                                <div class="column-50">
                                    <?php $case_icon = get_field('case_icon');
                                        if( !$case_icon ) {
                                            $case_icon = '/wp-content/uploads/2025/07/separators.svg';
                                        }

                                        if( $post_type == 'landmark-cases') {
                                            $category = get_the_terms($post->ID, 'landmark_case_category');
                                            $button_text = 'Read Case Details';
                                            if( $category && !is_wp_error($category) ) {
                                                $category = $category[0]->name;
                                            } else {
                                                $category = 'Uncategorized';
                                            }
                                        }

                                        if( $post_type == 'post') {
                                            $category = get_the_category($post->ID);
                                            $button_text = 'Read News Details';
                                            if( $category && !is_wp_error($category) ) {
                                                $category = $category[0]->name;
                                            } else {
                                                $category = 'Uncategorized';
                                            }
                                        }
      

                                        $assigned_attorneys = get_the_terms($post->ID, 'landmark_case_attorneys');
                                    ?>
                                    <div class="row row-1">
                                        <img src="<?php echo esc_url($case_icon); ?>" alt="<?php echo esc_attr(get_the_title($post->ID)); ?>" class="case-icon" />
                                        <span class="case-category"><?php echo esc_html($category); ?></span>
                                    </div>
                                    <div class="row row-2">
                                        <h3><?php echo get_the_title($post->ID); ?></h3>
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
                                                wp_reset_postdata();                                           
                                            } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row row-3">
                                        <p class="fake-btn btn"><span><?php echo esc_html($button_text); ?></span></p>
                                    </div>
                                </div>
                            </div>                        
                        </a>
                    </div>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            <?php endwhile; ?>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="wp-block-group content-wrapper">
    <div class="wp-block-group__inner-container is-layout-constrained wp-block-group-is-layout-constrained">
        <?php echo $lower_copy; ?>
        <?php if( $cta_button ) : ?>
        <a target="<?php echo $cta_button['target']; ?>" class="btn btn-center orange-btn" href="<?php echo esc_url($cta_button['url']); ?>" title="Explore More Of Our Landmark Cases"><span><?php echo esc_html($cta_button['title']); ?></span></a>
        <?php endif; ?>
    </div>
</div>