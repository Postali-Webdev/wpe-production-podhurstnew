<?php 

/**
 * Banner Block template.
 *
 * @param array $block The block settings and attributes.
 */

$page_custom_awards = get_field('add_custom_awards');
$awards_arr = get_field('awards','options');

if( $page_custom_awards ) {
    $awards_arr = get_field('awards');
}
?>

<section class="awards-block">
    <div class="columns">
        <div id="awards" class="slide">
            <?php $n=1 ?>
            <?php if( $awards_arr ): ?>
            <?php foreach( $awards_arr as $award ) : ?>  
                <div class="column-20" id="award_<?php echo $n; ?>">
                <?php 
                $image = $award['award']; 
                if( !empty( $image ) ): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                <?php endif; ?>
                </div>
                <?php $n++; ?>
            <?php endforeach; ?>
            <?php endif; ?> 
        </div>
    </div>
</section>