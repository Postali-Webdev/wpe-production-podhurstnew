<?php 

/**
 * Banner Block template.
 *
 * @param array $block The block settings and attributes.
 */

    $panel = get_field('panel_layout');
    $layout = get_field('columns_layout');
    if ($layout == '2575') {
        $column1 = '25';
        $column2 = '75';
    }
    if ($layout == '3366') {
        $column1 = '33';
        $column2 = '66';
    }
    if ($layout == '5050') {
        $column1 = '50';
        $column2 = '50';
    }
    if ($layout == '6633') {
        $column1 = '66';
        $column2 = '33';
    }
    if ($layout == '7525') {
        $column1 = '75';
        $column2 = '25';
    }

    if ($layout == '333333') {
        $column1 = '33';
        $column2 = '33';
        $column3 = '33';
    }

    $columns_panel_headline = get_field('columns_panel_headline');
    $column1_content = get_field('column_1_content');
    $column2_content = get_field('column_2_content');
    $column3_content = get_field('column_3_content');
?>

<div class="columns-layout <?php if ($layout == '333333') { ?>three-column<?php } ?> <?php echo $panel; ?>">
    <div class="columns">
        <?php if(!empty($columns_panel_headline)) { ?>
        <div class="column-full block">
            <h2><?php echo $columns_panel_headline; ?></h2>
            <div class="spacer-30"></div>
        </div>
        <?php } ?>

        <!-- both columns, full-left -->
        <?php if($panel == 'full-left') { ?>
        <?php $image_left = get_field('column_1_left_image'); ?>
        <div class="column-<?php echo $column1; ?> block left-image">
            <?php echo wp_get_attachment_image($image_left['ID'], 'full'); ?>
        </div>
        <div class="column-<?php echo $column2; ?> block">
            <?php echo $column2_content; ?>
        </div>
        <?php } ?>
        

        <!-- both columns, full-right -->
        <?php if($panel == 'full-right') { ?>
        <?php $image_right = get_field('column_2_right_image'); ?>
        <div class="column-<?php echo $column1; ?> block">
            <?php echo $column1_content; ?>
        </div>
        <div class="column-<?php echo $column2; ?> block right-image">
            <?php echo wp_get_attachment_image($image_right['ID'], 'full'); ?>
        </div>
        <?php } ?>


        <!-- normal container -->
        <?php if($panel == 'contained' || $panel == 'contained-pad') { ?>
        <div class="column-<?php echo $column1; ?> block">
            <?php echo $column1_content; ?>
        </div>
        <div class="column-<?php echo $column2; ?> block">
            <?php echo $column2_content; ?>
        </div>
        <?php if ($layout == '333333') { ?>
        <div class="column-<?php echo $column3; ?> block <?php if($panel == 'full-right') { ?> right-image <?php } ?>">
            <?php echo $column3_content; ?>
        </div>
        <?php } ?>
        <?php } ?>
    </div>
</div>