<?php

$testimonial_args = [
    'post_type' => 'reviews',
    'posts_per_page' => 1,
    'order' => 'rand',
    'orderby' => 'rand',
    'post_status' => 'publish',
    'ignore_sticky_posts' => true,
    'cache_results' => false,
    'no_found_rows' => true,
    'update_post_meta_cache' => false,
];

$testimonial_query = new WP_Query( $testimonial_args );



if( $testimonial_query->have_posts() ) {
    while( $testimonial_query->have_posts() ) {
        $testimonial_query->the_post();
        $single_testimonial_el = "";
        $star_rating = "4.9/5.0";
        $copy = get_the_content();
        $author = get_the_title();
        $review_source_image = get_field('review_source');
        $review_badge = "/wp-content/uploads/2025/04/google-review-logo.png";
        
        // switch( $review_source ) {
        //     case 'google':
        //         $review_badge = "/wp-content/uploads/2025/04/google-review-logo.png";
        //         break;
        //     case 'avvo':
        //         $review_badge = "/wp-content/uploads/2025/04/avvo-logo.png";
        //         break;
        //     default: 
        //         $review_badge = "/wp-content/uploads/2025/04/google-review-logo.png";
        //         break;
        // }
        
        $locations = get_field('locations', 'options');
        $show_default_gbp = true;
        $gbp_url = get_field('global_gbp_url', 'options');	
        
        if( $copy ) {
            $single_testimonial_el .= "<div id='single-testimonial'>";
        
            if( $star_rating) {
                $single_testimonial_el .= "<div class='star-rating'><p>$star_rating</p></div>";
            }
        
            $single_testimonial_el .= "<p class='copy'>" . substr($copy, 0, 300);

            if( strlen(get_the_content()) > 300) {
                $single_testimonial_el .= "[...]</p>";
            } else {
                $single_testimonial_el .= "</p>";
            }
        
            if( $author ) {
                $single_testimonial_el .= "<p class='testimonial-author'>$author</p>";
            }
        
            if( $review_source_image ) {
                if( $gbp_url ) {
                    $single_testimonial_el .= "<a href='$gbp_url' target='_blank'>" . $review_badge . "</a>";
                } else {
                    $single_testimonial_el .= "<img src='$review_badge' alt='$review_source review of Breeden Law Firm' />";
                }
            }
        
            $single_testimonial_el .= "</div>";
            echo $single_testimonial_el;
        }
        




    }
}





?>