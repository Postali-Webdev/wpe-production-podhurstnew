<?php 

/**
 * Banner Block template.
 *
 * @param array $block The block settings and attributes.
 */

    $testimonials_block_layout = get_field('testimonials_block_layout');
    $testimonial = get_field('single_testimonial');
    $testimonials = get_field('testimonials');
    $google_rating_logo = get_field('google_rating_logo');
    $google_rating_average = get_field('google_rating_average');
    $google_rating_total_reviews = get_field('google_rating_total_reviews');

    $cta_block_headline = get_field('cta_block_headline');
    $cta_block_copy = get_field('cta_block_copy');
    $cta_block_button = get_field('cta_block_button');

    $more_testimonials_button = get_field('more_testimonials_button');
    
?>

<?php if ($testimonials_block_layout == 'three') { ?>

<div class="testimonials-block testimonials-three">
    <div class="columns">
        <div class="reviews-block">
            <div class="rating">
                <div class="average"><?php echo $google_rating_average; ?></div>
                <div class="total"><?php echo $google_rating_total_reviews; ?> reviews</div>
            </div>
            <div class="logo">
            <?php 
            if( !empty( $google_rating_logo ) ): ?>
                <img src="<?php echo esc_url($google_rating_logo['url']); ?>" alt="<?php echo esc_attr($google_rating_logo['alt']); ?>" />
            <?php endif; ?>
            </div>
        </div>
        <div class="spacer-30"></div>
        <div class="column-full">
        <?php if( have_rows('testimonials') ): ?>
        <?php while( have_rows('testimonials') ): the_row(); ?>
            <?php $post_object = get_sub_field('testimonial'); ?>
            <?php if( $post_object ): ?>
                <?php // override $post
                $post = $post_object;
                setup_postdata( $post );
                ?>
                <div class="testimonial column-33">
                    <div class="stars"></div>
                    <p><?php the_content($post->ID); ?></p>
                    <p class="author"><?php echo get_the_title($post->ID); ?></p>
                </div>
                <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
            <?php endif; ?>
        <?php endwhile; ?>
        <?php endif; ?>
        </div>
        <div class="spacer-60"></div>
        <div class="column-full centered">
            <?php if( $more_testimonials_button ) : ?>
                <a href="<?php echo $more_testimonials_button['url']; ?>" class="more"><?php echo $more_testimonials_button['title']; ?> </a><span class="icon-crest-arrow-right"></span>    
            <?php else : ?>
                <a href="/reviews/" class="more">More Reviews </a><span class="icon-crest-arrow-right"></span>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php } ?>

<?php if ($testimonials_block_layout == 'one') { ?>

<div class="testimonials-block" id="testimonials-one">
    <div class="columns">
        <div class="column-66">
            <?php
            $featured_post = get_field('single_testimonial');
            if( $featured_post ): ?>
            <div class="rating-details-block">
                <div class="logo-block">
                <?php 
                if( !empty( $google_rating_logo ) ): ?>
                    <img src="<?php echo esc_url($google_rating_logo['url']); ?>" alt="<?php echo esc_attr($google_rating_logo['alt']); ?>" />
                <?php endif; ?>
                <div class="stars"></div>
                </div>
                <div class="name-date">
                    <?php
                    $date = $featured_post->post_date;
                    $date = date("F Y",strtotime($date));
                    ?>
                    <p><?php echo esc_html( $featured_post->post_title ); ?> | <?php echo esc_html( $date ); ?></p>
                </div>
            </div>
            <p><?php echo esc_html( $featured_post->post_content ); ?></p>
            <div class="spacer-30"></div>
            <div class="more">
            <?php if( $more_testimonials_button ) : ?>
                <a href="<?php echo $more_testimonials_button['url']; ?>" class="more"><?php echo $more_testimonials_button['title']; ?> </a><span class="icon-crest-arrow-right"></span>    
            <?php else : ?>
                <a href="/reviews/" class="more">More Reviews </a><span class="icon-crest-arrow-right"></span>
            <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>

        <div class="column-33 cta-block">
            <p class="lrg"><?php echo $cta_block_headline; ?></p>
            <p><?php echo $cta_block_copy; ?></p>
            <?php if( $cta_block_button ) : ?>
                <a href="<?php echo $cta_block_button['url']; ?>" class="btn"><span><?php echo $cta_block_button['title']; ?></span></a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php } ?>

<?php if ($testimonials_block_layout == 'slider') : ?>

<div class="testimonials-scroller">
    <div class="columns">
        <div class="column-full">
            <div class="slider-arrow-wrapper">
                    <div class="slick-custom-btn testimonial-slick-custom-prev"></div>
                    <div class="slick-custom-btn testimonial-slick-custom-next"></div>
                </div>
            <div id="testimonials" class="slide">
            <?php if( have_rows('slider_testimonials') ): ?>
            <?php while( have_rows('slider_testimonials') ): the_row(); ?>
                <?php $post_object = get_sub_field('testimonial'); ?>
                <?php if( $post_object ): ?>
                    <?php // override $post
                    $post = $post_object;
                    setup_postdata( $post );
                    $review_source = get_field('review_source', $post->ID);
                    switch( $review_source ) {
                        case 'google':
                            $review_badge = "/wp-content/uploads/2025/07/google-review-logo.png";
                            break;
                        case 'avvo':
                            $review_badge = "/wp-content/uploads/2025/07/avvo-review-logo.png";
                            break;
                        default: 
                            $review_badge = "/wp-content/uploads/2025/07/google-review-logo.png";
                            break;
                    }
                    ?>
                    <div class="testimonial">
                        <div>
                            <div class="columns">
                                <div class="column-full">
                                    <div class="row row-1">
                                        <div class="stars"></div>
                                    </div>
                                    <div class="row row-2">
                                        <p>“<?php echo get_the_content($post->ID); ?>”</p>
                                    </div>
                                    <div class="row row-3">
                                        <p class="author"><?php echo get_the_title($post->ID); ?></p>
                                        <img class="review-badge-icon" src="<?php echo $review_badge; ?>" alt="<?php echo $review_source; ?> review badge">

                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </div>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            <?php endwhile; ?>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>