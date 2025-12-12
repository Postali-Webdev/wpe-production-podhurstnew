<?php 

/**
 * Banner Block template.
 *
 * @param array jQueryblock The block settings and attributes.
 */

?>


<div class="tabbed-content">    
    <div class="columns">
        <div class="column-75 center">
            <div class="tabs_wrapper"> 
                <ul class="tabs">
                <?php $n=1; ?>
                <?php if( have_rows('tab_content') ): ?>
                <?php while( have_rows('tab_content') ): the_row(); ?> 
                    <li <?php if($n==1) { ?>class="active"<?php } ?> rel="tab<?php echo $n; ?>"><?php the_sub_field('tab_title'); ?></li>
                    <?php $n++; ?>
                <?php endwhile; ?>
                <?php endif; ?> 
                </ul>
            
                <div class="tab_container">
                <?php $i=1; ?>
                <?php if( have_rows('tab_content') ): ?>
                <?php while( have_rows('tab_content') ): the_row(); ?> 
                    <div id="tab<?php echo $i; ?>" class="tab_content">
                        <div class="tab-contents">
                        <?php if (get_sub_field('add_image')) { ?>
                            <div class="tab-image">
                            <?php 
                            $image = get_sub_field('tab_image');
                            if( !empty( $image ) ): ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            <?php endif; ?>
                            </div>
                        <?php } ?>
                            <div class="tab-copy">
                                <p class="tab-headline"><?php the_sub_field('tab_content_headline'); ?></p>
                                <?php the_sub_field('tab_content_copy'); ?>
                                <?php if (get_sub_field('add_link')) { ?>
                                    <div class="spacer-30"></div>
                                    <a href="<?php the_sub_field('link_location'); ?>" class="btn"><span><?php the_sub_field('link_text'); ?></span> <span class="icon-crest-arrow-right"></span></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php $i++; ?>
                <?php endwhile; ?>
                <?php endif; ?> 
                </div>
            </div>
        </div>
        <?php if(get_field('button_text')) { ?>
            <div class="spacer-60"></div>
            <a href="<?php the_field('button_link'); ?>" class="btn"><span><?php the_field('button_text'); ?></span></a>
        <?php } ?>
    </div>
</div>