<?php 

/**
 * Banner Block template.
 *
 * @param array $block The block settings and attributes.
 */

    $map_block_layout = get_field('map_block_layout');
    $map_iframe = get_field('map_iframe');
    $map_headline = get_field('map_headline');
    $map_subheading = get_field('map_subheading');
    $map_address_block = get_field('map_address_block');
    $map_directions_link = get_field('map_directions_link');
    $map_content_block = get_field('map_content_block');
    $map_add_cta_button = get_field('map_add_cta_button');
    $map_button_cta_copy = get_field('map_button_cta_copy');
    $map_button_link = get_field('map_button');
?>

<?php if ($map_block_layout == 'left') { ?>

<div class="map-block" id="map-left">
    <div class="columns">
        <div class="column-50">
            <iframe src="<?php echo $map_iframe; ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="column-50 block">
        <?php echo $map_content_block; ?>
            <?php if ($map_add_cta_button) { ?> 
                <p><strong><?php echo $map_button_cta_copy; ?></strong></p>
                <a target="<?php echo $map_button_link['target']; ?>" href="<?php echo $map_button_link['url']; ?>" class="btn"><span><?php echo $map_button_link['title']; ?></span></a>
            <?php } ?>
        </div>
    </div>
</div>

<?php } ?>

<?php if ($map_block_layout == 'slim') { ?>

<section class="map-block" id="map-slim">
    <div class="columns">
        <div class="column-50 block centered address">
            <?php echo $map_address_block; ?>
            <?php if ($map_directions_link) { ?>
                <p class="directions"><a href="<?php echo $map_directions_link; ?>">Directions</a></p>
            <?php } ?>
        </div>
        <div class="column-50">
            <iframe src="<?php echo $map_iframe; ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>

<?php } ?>

<?php if ($map_block_layout == 'right') { ?>

<section class="map-block" id="map-right">
    <div class="columns">
        <div class="column-66">
            <h3><?php echo $map_headline; ?></h3>
            <p class="subhead"><?php echo $map_subheading; ?></p>
            <?php echo $map_content_block; ?>
            <div class="spacer-15"></div>
            <div class="contact-blocks">
                <div class="phone-block">
                    <p><a href="tel:<?php echo $map_phone_number; ?>"><?php echo $map_phone_number; ?></a></p>
                </div>
                <div class="address-block">
                    <p>OFFICE ADDRESS</p>
                    <?php echo $map_address_block; ?>
                </div>
            </div>
        </div>
        <div class="column-33">
            <iframe src="<?php echo $map_iframe; ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>

<?php } ?>

<?php if($map_block_layout == 'full-split') { ?>
<div class="map-block" id="map-full-split">
    <div class="columns">
        <div class="column-50">
            <?php if($map_iframe) { ?>
                <iframe src="<?php echo $map_iframe; ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <?php } ?>
        </div>
        <div class="column-50 block">
           <?php echo $map_content_block; ?>
        </div>
    </div>
</div>
<?php } ?>