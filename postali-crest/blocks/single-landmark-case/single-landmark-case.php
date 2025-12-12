<?php

$case = get_field('featured_case');

if( $case ) : 
$post_id = $case->ID;
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
                    <p class="paragraph-subtitle">Posted: <?php echo get_the_date("M, Y"); ?></p>
                    <h3><?php echo get_the_title($post_id) ?></h3>
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
                    <p class="fake-btn btn"><span>Read Case Details</span></p>
                </div>
            </div>
        </div>                        
    </a>
</div>

<?php endif; ?>