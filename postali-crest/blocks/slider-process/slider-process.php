<?php 

/**
 * Banner Block template.
 *
 * @param array $block The block settings and attributes.
 */
    
?>

<div class="process-slider">
    <div class="columns">
        <div class="process-slider-nav">
            <div class="slick-custom-btn slick-custom-prev"></div>
            <div class="slick-custom-btn slick-custom-next"></div>
        </div>
        <div id="process-slider">
        <?php if( have_rows('process_slides') ): ?>
        <?php while( have_rows('process_slides') ): the_row(); 
        $image = get_sub_field('slide_image'); ?>  
            <div class="slide">
                <div class="column-left <?php echo !$image ? "column-full" : ""; ?>">
                    <h3><?php the_sub_field('slide_headline'); ?></h3>
                    <?php the_sub_field('slide_content'); ?>
                    <div class="dots"></div>
                </div>
                <div class="column-right <?php echo !$image ? "hide-right" : ""; ?>">
                    <div class="img-box">
                    <?php 
                    if( !empty( $image ) ): ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <?php endif; ?> 
        </div>
    </div>
</div>