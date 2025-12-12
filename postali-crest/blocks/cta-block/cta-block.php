<?php 

/**
 * Banner Block template.
 *
 * @param array $block The block settings and attributes.
 */

    $cta_layout = get_field('cta_layout');
    $cta_pre_headline = get_field('cta_pre_headline');
    $cta_headline = get_field('cta_headline');
    $cta_sub_headline = get_field('cta_sub_headline');
    $cta_body_copy = get_field('cta_body_copy');
    $cta_page_link = get_field('cta_page_link');
    $hide_phone_number = get_field('remove_phone_number');
?>

<?php if ($cta_layout == 'slim') { ?>

<div class="cta-block" id="slim">
    <div class="columns">
        <div class="column-75 block">
            <?php if(get_field('cta_pre_headline')) { ?>
            <p class="pre-headline"><?php echo $cta_pre_headline; ?></p>
            <?php } ?>
            <h2><?php echo $cta_headline; ?></h2>
        </div>
        <div class="column-25">
       <?php if( $cta_page_link ) : ?>
            <a href="<?php echo $cta_page_link['url']; ?>" class="btn" target="<?php echo $cta_page_link['target']; ?>"><span><?php echo $cta_page_link['title']; ?></span></a>
        <?php endif; ?>
        </div>
    </div>
</div>

<?php } ?>

<?php if ($cta_layout == 'full') { ?>

<div class="cta-block" id="full">
    <div class="columns">
        <div class="column-75 block centered center">
            <?php if(get_field('cta_pre_headline')) { ?>
            <p class="pre-headline"><?php echo $cta_pre_headline; ?></p>
            <?php } ?>
            <h2><?php echo $cta_headline; ?></h2>
            <?php if(get_field('cta_sub_headline')) { ?>
            <p class="sub-headline"><?php echo $cta_sub_headline; ?></p>
            <?php } ?>
            <?php if(get_field('cta_body_copy')) { ?>
            <?php echo $cta_body_copy; ?>
            <?php } ?>
            <?php if( $cta_page_link ) : ?>
                <a href="<?php echo $cta_page_link['url']; ?>" class="btn" target="<?php echo $cta_page_link['target']; ?>"><span><?php echo $cta_page_link['title']; ?></span></a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php } ?>

<?php if ($cta_layout == 'split') { ?>

<div class="cta-block" id="split">
    <div class="columns">
        <div class="column-66">
            <?php if(get_field('cta_pre_headline')) { ?>
            <p class="pre-headline"><?php echo $cta_pre_headline; ?></p>
            <?php } ?>
            <h2><?php echo $cta_headline; ?></h2>
        </div>
        <div class="column-33">
            <?php if(get_field('cta_body_copy')) { ?>
            <?php echo $cta_body_copy; ?>
            <?php } ?>
            <?php if( $cta_page_link ) : ?>
                <a href="<?php echo $cta_page_link['url']; ?>" class="btn" target="<?php echo $cta_page_link['target']; ?>"><span><?php echo $cta_page_link['title']; ?></span></a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php } ?>

<?php if( $cta_layout == "split-image") : 
    $image = get_field('cta_right_column_image');
    ?>
<div class="cta-block-split-image">
    <div class="columns">
        <div class="column-50">
            <?php if($image) {
                echo wp_get_attachment_image( $image['ID'], 'full', false, ['class' => 'cta-image'] );
            } ?>
        </div>
        <div class="column-50 block">
            <h2><?php echo $cta_headline; ?></h2>
            <?php if(get_field('cta_sub_headline')) { ?>
                <p class="paragraph-subtitle"><?php echo $cta_sub_headline; ?></p>
            <?php } ?>
            
            <?php echo $cta_body_copy; ?>

            <p><strong><?php echo get_field('cta_copy'); ?></strong></p>
            
            <div class="cta-wrapper">
                <?php if( get_field('phone_number', 'options') && !$hide_phone_number ) : ?>
                    <a class="btn" href="tel:<?php echo get_field('phone_number', 'options'); ?>"><span><?php echo get_field('phone_number', 'options'); ?></span></a>
                <?php endif; ?>
                <?php if( $cta_page_link ) : ?>
                    <a href="<?php echo $cta_page_link['url']; ?>" target="<?php echo $cta_page_link['target']; ?>"><?php echo $cta_page_link['title']; ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>