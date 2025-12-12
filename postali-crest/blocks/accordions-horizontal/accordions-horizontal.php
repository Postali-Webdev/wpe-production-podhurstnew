<?php 

/**
 * Banner Block template.
 *
 * @param array $block The block settings and attributes.
 */

?>

<div class="accordions-block accordions-horizontal">
    <div class="columns pa-desktop">
        
        <div class="column-50 left">
            <ul class="acc_horiz">
                <?php $n = 1; ?>
                <?php if( have_rows('accordions') ): ?>
                <?php while( have_rows('accordions') ): the_row(); ?>  
                    <li rel="acc_horiz<?php echo $n; ?>" <?php if ($n == 1) { ?> class="active"<?php } ?>><h3><?php the_sub_field('accordion_title'); ?></h3></li>
                    <?php $n++; ?>
                <?php endwhile; ?>
                <?php endif; ?> 
            </ul>
        </div>
        <div class="column-50 right">
            <div class="acc_horiz_container">
                <?php $i = 1; ?>
                <?php if( have_rows('accordions') ): ?>
                <?php while( have_rows('accordions') ): the_row(); ?>
                    <div id="acc_horiz<?php echo $i; ?>" class="acc_horiz_content acc_horiz<?php echo $i; ?>">
                        <h3><?php the_sub_field('accordion_title'); ?></h3>
                        <?php the_sub_field('accordion_content'); ?>
                        <?php if(get_sub_field('add_button')) { ?>
                        <a href="<?php the_sub_field('button_link'); ?>" class="btn"><span><?php the_sub_field('button_text'); ?></span> <span class="icon-crest-arrow-right"></span></a>
                        <?php } ?>
                    </div>
                    <?php $i++; ?>
                <?php endwhile; ?>
                <?php endif; ?> 
            </div>
        </div>
    </div>

    <div class="columns pa-mobile">
        <?php if( have_rows('accordions') ): ?>
        <?php while( have_rows('accordions') ): the_row(); ?>  
        <div class="accordion-mobile">
            <div class="accordion_title">
                <h3><?php the_sub_field('accordion_title'); ?></h3><span></span>
            </div>
            <div class="accordion_content">
                <?php the_sub_field('accordion_content'); ?>
            </div>
        </div>
        <?php endwhile; ?>
        <?php endif; ?> 
    </div>
</div>



