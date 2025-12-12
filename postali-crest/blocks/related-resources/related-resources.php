<?php 

/**
 * Banner Block template.
 *
 * @param array $block The block settings and attributes.
 */

    $related_block_headline = get_field('related_block_headline');

?>

<div class="related-resources">
    <div class="columns">
        <div class="column-full block">
            <?php if( have_rows('resources') ): ?>
            <?php $count = count(get_field('resources')); ?>   
            <div class="resources boxes-<?php echo $count; ?>">
            <?php while( have_rows('resources') ): the_row(); ?>  


            <?php $post_object = get_sub_field('resource'); ?>
            <?php if( $post_object ): ?>
                <?php // override $post
                $post = $post_object;
                setup_postdata( $post );
                ?>

                <div class="resource">
                    <?php if (has_post_thumbnail( $post->ID ) ): ?>
                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                    <div class="resource-image">
                        <img src="<?php echo $image[0]; ?>" alt="">
                    </div>
                    <?php endif; ?>
                    <div class="resource-copy">
                        <h3><?php the_title($post->post_title); ?></h3>
                        <a class="link-button" href="<?php the_permalink($post->ID); ?>" >
                            <?php $post_type = get_post_type( $post->ID );
                            if ($post_type == 'post') { 
                                $link_text = 'Read Article'; }
                            if ($post_type == 'page') { 
                                $link_text = 'Visit Page';
                            }
                            ?>
                            <span class="text"><?php echo $link_text; ?></span> <span class="icon-crest-arrow-right"></span>
                        </a>
                    </div>
                    
                </div>

                <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
            <?php endif; ?>
            <?php endwhile; ?>
            </div>
            <?php endif; ?> 

            <?php if(get_field('resources_button_text')) { ?>
            <div class="spacer-60"></div>
            <a href="<?php the_field('resources_button_link'); ?>" class="btn"><span><?php the_field('resources_button_text'); ?></span></a>
            <?php } ?>
        </div>
    </div>
</div>
