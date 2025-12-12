<?php 

/**
 * Banner Block template.
 *
 * @param array $block The block settings and attributes.
 */

    $contact_panel_layout = get_field('contact_panel_layout');
    $form_shortcode = get_field('form_shortcode');
    $contact_panel_headline = get_field('contact_panel_headline');
    $contact_panel_copy = get_field('contact_panel_copy');
    $contact_button_type = get_field('contact_button_type');
    $contact_button_text = get_field('contact_button_text');
    $contact_phone_number = get_field('contact_phone_number');
    $contact_page_link = get_field('contact_page_link');
?>

<?php if($contact_panel_layout == 'form') { ?>

<div class="contact-block form">
    
    <div class="columns">
        <div class="column-full center">
            <?php echo do_shortcode('' . $form_shortcode . ''); ?>
        </div>
    </div>
    
</div>

<?php } ?>

<?php if($contact_panel_layout == 'split') { ?>

<div class="contact-block split">
    <div class="columns">
        <div class="column-50 block">
            <h2><?php echo $contact_panel_headline; ?></h2>
            <div class="spacer-15"></div>
            <p><?php echo $contact_panel_copy; ?></p>
            <?php if ($contact_button_type == 'tel') { ?>
            <a href="tel:<?php echo $contact_phone_number; ?>" class="btn"><span><?php echo $contact_button_text; ?></span></a>
            <?php } elseif($contact_button_type == 'page') { ?>
            <a href="<?php echo $contact_page_link; ?>" class="btn"><span><?php echo $contact_button_text; ?></span></a>
            <?php } ?>
        </div>
        <div class="column-50">
            <?php echo do_shortcode('' . $form_shortcode . ''); ?>
        </div>
    </div>
</div>

<?php } ?>