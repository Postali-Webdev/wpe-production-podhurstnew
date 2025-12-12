<?php
$link = get_field('theme_button_link');
$alignment = get_field('alignment');
$alt_color = get_field('change_button_color');
$mobile_btn_only = get_field('enable_mobile_only');
$desktop_btn_only = get_field('enable_desktop_only');
$button_type = get_field('button_type');

switch($button_type) {
    case 'phone':
        $btn_link = 'tel:' . get_field('phone_number', 'options');
        $btn_text = get_field('phone_number', 'options');
        $btn_target = '';
        break;
    case 'email':
        $btn_link = 'mailto:' . get_field('email_address', 'options');
        $btn_text = get_field('email_address', 'options');
        $btn_target = '';
        break;
    case 'other':
        $btn_link = $link['url'];
        $btn_text = $link['title'];
        $btn_target = $link['target'];
        break;
    default:
        $btn_link = $link['url'];
        $btn_text = $link['title'];
        $btn_target = $link['target'];
}
?>

<a target="<?php echo $btn_target; ?>" class="btn btn-<?php echo $alignment; echo $alt_color ? " orange-btn" : ""; echo $desktop_btn_only ? " desktop-only-btn" : ""; echo $mobile_btn_only ? " mobile-only-btn" : ""; ?>" href="<?php echo $btn_link; ?>" title="<?php echo $btn_text; ?>" class="btn"><span><?php echo $btn_text; ?></span></a>