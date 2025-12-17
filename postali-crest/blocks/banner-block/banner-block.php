<?php 

/**
 * Banner Block template.
 *
 * @param array $block The block settings and attributes.
 */

    $banner_block_layout = get_field('banner_block_layout');
    $banner_page_title = get_field('banner_page_title');
    $banner_subtitle = get_field('banner_subtitle');
    $banner_intro_copy = get_field('banner_intro_copy');
    $banner_cta_text = get_field('banner_cta_text');
    $banner_cta_button_text = get_field('banner_cta_button_text');
    $banner_cta_link = get_field('banner_cta_link_page');
    $banner_cta_form_contact = get_field('banner_cta_form_contact');
    $banner_background_image = get_field('banner_background_image');
    $banner_foreground_image = get_field('banner_foreground_image');
    $intro_block_headline = get_field('intro_block_headline');
    $intro_block_subheadline = get_field('intro_block_subheadline');
    $intro_block_copy = get_field('intro_block_copy');
    $intro_cta_link = get_field('intro_cta_link_page');
    $banner_hp_mobile_img = get_field('mobile_image');

?>

<?php if( $banner_background_image ) : ?>
    <link rel="preload" fetchpriority="high" as="image" href="<?php echo $banner_background_image; ?>"/>
<?php endif; ?>

<?php if( $banner_hp_mobile_img ) : ?>
    <link rel="preload" fetchpriority="high" as="image" href="<?php echo $banner_hp_mobile_img['url']; ?>"/>
<?php endif; ?>

<?php if( $banner_block_layout == 'homepage') { ?>

    <section class="banner-block" id="homepage-banner">
        <div class="columns">
            <div class="column-50 block">
                <div class="container">
                    <h1><?php echo $banner_page_title; ?></h1>
                    <p class="large-title"><?php echo $banner_subtitle;  ?></p>
                    <?php if( $banner_hp_mobile_img ) echo wp_get_attachment_image( $banner_hp_mobile_img['ID'], 'full', false, array('class' => 'mobile-hp-image') ); ?>
                    <div class="cta-wrapper">
                        <p><?php echo $banner_intro_copy; ?></p>
                        <a href="tel:<?php the_field('phone_number', 'options'); ?>" class="btn"><span><?php the_field('phone_number', 'options'); ?></span></a>
                        <?php if( $banner_cta_link ) : ?>
                            <a href="<?php echo $banner_cta_link['url']; ?>" target="<?php echo $banner_cta_link['target']; ?>"><span><?php echo $banner_cta_link['title']; ?></span></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="column-50 block">
                <?php if( have_rows('banner_image_carousel') ) : ?>
                    <div class="hp-banner-carousel">
                        <?php while( have_rows('banner_image_carousel') ) : the_row(); 
                            $image = get_sub_field('image'); 
                            ?>
                            <div class="img-wrapper">
                                <?php
                                    echo wp_get_attachment_image( $image['ID'], 'full', false, array('alt' => $image['alt'], 'class' => 'carousel-image') );
                                ?>
                            </div>
                            
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <span id="main-content"></span>
<?php } ?>



<?php if ($banner_block_layout == 'child-full') { 
    $intro_cta_copy = get_field('intro_cta_copy');
    $intro_cta_simple_link = get_field('intro_cta_link');
    $related_topics = get_field('related_topics');
    ?>

<section class="banner-block" id="banner-child-full" style="background-image:url('<?php echo $banner_background_image; ?>');">
    <div class="container">
    <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
    <div class="spacer-60"></div>
    <div class="columns">
        <div class="column-50 block title-wrapper">
            <p class="subtitle">Podhurst / Orseck</p>
            <h1><?php echo $banner_page_title; ?></h1>
        </div>
    </div>
</section>

<section class="banner-block-intro">
    <div class="container">
        <div class="columns">
            <div class="column-full block centered center <?php echo $related_topics ? "two-col" : ""; ?>">
                <div class="col1">
                    <h2><?php echo $intro_block_headline; ?></h2>
                    <?php echo $intro_block_copy; ?>
                    <div class="intro-cta">
                        <p><strong><?php echo $intro_cta_copy; ?></strong></p>
                        <div class="links-wrapper">
                            <?php if( $intro_cta_link ) : ?>
                                <a href="<?php echo $intro_cta_link['url']; ?>" class="btn" target="<?php echo $intro_cta_link['target']; ?>"><span><?php echo $intro_cta_link['title']; ?></span></a>
                            <?php endif; ?>            
                            <?php if( $intro_cta_simple_link ) : ?>
                                <a href="<?php echo $intro_cta_simple_link['url']; ?>" target="<?php echo $intro_cta_simple_link['target']; ?>"><?php echo $intro_cta_simple_link['title']; ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php if( have_rows('related_topics') ) : ?>
                <div class="col2">
                    <p class="related-title">Related Topics:</p>
                    <div class="link-list">
                        <?php while( have_rows('related_topics') ) : the_row(); 
                        $page = get_sub_field('page'); ?>
                            <a href="<?php echo $page['url']; ?>" target="<?php echo $page['target']; ?>"><?php echo $page['title']; ?></a>
                        <?php endwhile; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<span id="main-content"></span>
<?php } ?>


<?php if ($banner_block_layout == 'child-split') { 
    $title = get_field('banner_page_title');
    $intro_copy = get_field('banner_intro_copy');
    $banner_image = get_field('banner_foreground_image');
    $cta_title = get_field('intro_cta_title');
    $cta_copy = get_field('intro_cta_copy');
    $cta_link = get_field('intro_cta_link');
    ?>
<section class="banner-block" id="banner-child-split">
    <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
    <div class="columns<?php if ( have_rows('on-page_link') ) { echo ' has-on-page-links'; } ?>">
        <div class="column-66 block">
            <div class="container">
                <h1><?php echo $title; ?></h1>
                <p><?php echo $intro_copy; ?></p>
                <div class="cta-wrapper">
                    <a href="tel:<?php the_field('phone_number', 'options'); ?>" class="btn"><span><?php the_field('phone_number', 'options'); ?></span></a>
                    <?php if( $cta_link ) : ?>
                        <a href="<?php echo $cta_link['url']; ?>" target="<?php echo $cta_link['target']; ?>"><?php echo $cta_link['title']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="column-33">
            <?php if( $banner_image ) {
                echo wp_get_attachment_image($banner_image['ID'], 'full', false, ['class' => 'banner-img']);
            } ?>
        </div>
        <?php if( have_rows('on-page_link') ) : ?>
        <div class="bordered-box on-page-navigation">
            <div class="row1">
                <p class="paragraph-subtitle">On This Page</p>
                <ul>
                    <?php while( have_rows('on-page_link') ) : the_row(); $anchor_link = get_sub_field('anchor_link'); ?>
                        <li><a href="<?php echo $anchor_link['url']; ?>"><?php echo esc_html($anchor_link['title']); ?></a></li>
                    <?php endwhile; ?>
                </ul>
                
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
<span id="main-content"></span>
<?php } ?>

<?php if ($banner_block_layout == 'standard-split') { 
    $title = get_field('banner_page_title');
    $subtitle = get_field('banner_subtitle');
    $intro_copy = get_field('banner_intro_copy');
    $banner_image = get_field('banner_foreground_image');
    $cta_link = get_field('banner_cta_link_page');
    $blue_title = get_field('blue_title');
    ?>
<section class="banner-block" id="banner-standard-split">
    
    <div class="columns">
        <div class="column-50 block">
            <div class="container">
                <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
                <h1><?php echo $title; ?></h1>
                <h4><?php echo $subtitle; ?></h4>
                <p><?php echo $intro_copy; ?></p>
                <?php if( $cta_link ) : ?>
                    <a href="<?php echo $cta_link['url']; ?>" class="btn" target="<?php echo $cta_link['target']; ?>"><span><?php echo $cta_link['title']; ?></span></a>
                <?php endif; ?>
                <?php if( $blue_title ) : ?>
                    <div class="blue-title-wrapper">
                        <p class="blue-title"><?php echo $blue_title; ?></p>
                        <a href="#main-content" class="anchor-main-content"></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="column-50">
            <?php if( $banner_image ) {
                echo wp_get_attachment_image($banner_image['ID'], 'full', false, ['class' => 'banner-img']);
            }  else {
                echo "<img src='/wp-content/uploads/2025/07/aviation-plane-in-the-air.jpg' class='banner-img'/>";
            } ?>
        </div>
    </div>
</section>
<span id="main-content"></span>
<?php } ?>