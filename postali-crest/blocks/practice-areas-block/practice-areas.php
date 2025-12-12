<?php 

$section_title = get_field('pa_section_title');
$display_settings = get_field('pa_display_settings');

    if( $display_settings == 'full-img-bg' ) : 
    if( have_rows('practice_areas') ) : ?>
    <div class="practice-areas-section">
        <h2><?php echo $section_title; ?></h2>
        <div class="practice-areas-block">
            <?php while( have_rows('practice_areas') ) : the_row(); 
                $page = get_sub_field('page'); 
                $image = get_sub_field('image'); ?>

                <div class="practice-area">
                    <a href="<?php echo $page['url']; ?>">
                        <?php if( $image ) {
                            echo wp_get_attachment_image( $image['ID'], 'full', false, array('class' => 'practice-area-image') );
                        } ?>
                        <p class="pa-title"><span><?php echo $page['title']; ?></span></p>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php endif; 
endif; ?>

<?php if( $display_settings == 'no-img-bg' ) : 
    if( have_rows('practice_areas') ) : ?>
        <div class="practice-areas-section white-card-block-wrapper">
            <h2 class="align-left"><?php echo $section_title; ?></h2>
            <div class="practice-areas-block white-card-block">
            <?php while( have_rows('practice_areas') ) : the_row(); 
                $page = get_sub_field('page'); 
                $image = get_sub_field('practice_area_icon'); 
                $copy = get_sub_field('copy'); ?>
                <div class="practice-area white-card">
                    <a aria-label="Learn more about <?php echo esc_attr($page['title']); ?>" title="Learn more about <?php echo esc_attr($page['title']); ?>" href="<?php echo esc_url($page['url']); ?>">
                        <?php if( $image ) {
                            echo wp_get_attachment_image( $image['ID'], 'full', false, array('class' => 'practice-area-icon', 'alt' => esc_attr($page['title'])));
                        } ?>
                        <div class="copy-wrapper">
                            <p class="pa-title"><?php echo esc_html($page['title']); ?></p>
                            <img src="/wp-content/uploads/2025/07/separators.svg" alt="separator icon" class="case-icon" />
                            <p><?php echo esc_html($copy); ?></p>
                            <p class="fake-btn btn"><span>Learn More</span></p>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
