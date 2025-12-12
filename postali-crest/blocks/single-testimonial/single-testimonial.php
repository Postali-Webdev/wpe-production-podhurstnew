<?php 

$star_rating = get_field('star_rating');
$copy = get_field('copy');
$author = get_field('author');
$review_source_image = get_field('review_source_image');
$single_testimonial_el = "";
$gbp_url = get_field('global_gbp_url', 'options');	





if( $copy ) {
    $single_testimonial_el .= "<div id='single-testimonial'>";

    if( $star_rating) {
        $single_testimonial_el .= "<div class='star-rating'><p>$star_rating</p></div>";
    }

    $single_testimonial_el .= "<p class='copy'>$copy</p>";

    if( $author ) {
        $single_testimonial_el .= "<p class='testimonial-author'>$author</p>";
    }

    if( $review_source_image ) {
        if( $gbp_url ) {
            $single_testimonial_el .= "<a href='$gbp_url' target='_blank'>" . wp_get_attachment_image($review_source_image['ID'], 'full') . "</a>";
        } else {
            $single_testimonial_el .= wp_get_attachment_image($review_source_image['ID'], 'full');
        }
    }

    $single_testimonial_el .= "</div>";
    echo $single_testimonial_el;
}



?>