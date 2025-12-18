<?php 
$first_name = get_field('first_name');
$middle_initial = get_field('middle_initial');
$last_name = get_field('last_name');
$name = $first_name . ' ' . $middle_initial . ' ' . $last_name;
$title = get_field('attorney_title');
$office_location = get_field('office_location');
$bar_admissions = '';
if( have_rows('bar_admission') ) {
    $count = 0;
    $admission_total = count(get_field('bar_admission'));
    while( have_rows('bar_admission') ) {
        the_row();
        $count++;
        $bar_admissions .= get_sub_field('location');
        if($count < $admission_total ) {
            $bar_admissions .= ' | ';
        }
    }
}
$linkedin_url = get_field('linkedin_url');
$email = get_field('email_address');
$phone = get_field('phone_number');
$banner_image = get_the_post_thumbnail(null, 'full', array('class' => 'banner-img'));
$practice_areas = get_field('practice_areas');
$additional_bio = get_field('additional_bio');
$education = get_field('education');
$previous_jobs = get_field('previous_jobs');
$notable_achievements = get_field('notable_achievements');
$extra_copy = get_field('extra_copy');

get_header(); ?>

<section class="banner-block" id="banner-child-split">
    <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
    <div class="columns">
        <div class="column-50 block">
            <div class="container">
                <p class="paragraph-subtitle"><?php echo $title; ?></p>
                <h1 class="large-title"><?php echo $name; ?></h1>
                <div class="location-wrapper">
                    <p><strong>Based in: </strong><?php echo $office_location; ?></p>
                    <?php if( $bar_admissions ) : ?>
                    <p><strong>Bar Admissions: </strong><?php echo $bar_admissions; ?></p>
                    <?php endif; ?>
                </div>
                <div class="spacer-30"></div>
                <div class="cta-wrapper">
                    <a href="<?php echo $linkedin_url; ?>" class="btn"><span>LinkedIn</span></a>
                    <a href="mailto:<?php echo $email; ?>" class="btn orange-btn"><span>Email</span></a>
                    <?php if($phone ) : ?>
                    <a href="tel:<?php echo $phone ; ?>" class="btn orange-btn"><span><?php echo $phone ; ?></span></a>
                    <?php endif; ?>
                    <div class="spacer-30"></div>
                </div>
            </div>
        </div>
        <div class="column-50">
            <?php if( $banner_image ) {
                echo $banner_image;
            }  else {
                echo "<img src='/wp-content/uploads/2025/07/aviation-plane-in-the-air.jpg' class='banner-img'/>";
            } ?>
        </div>
    </div>
</section>
<span id="main-content"></span>
<section class="body-container body-container-1 wp-block-group clip-top-slant-hl">
    <div class="container">
        <div class="columns">
            <div class="column-full">
                <div class="content-wrapper">
                    <?php the_field('bio'); ?>
                    <div class="spacer-30"></div>
                    <?php if( $practice_areas ) : ?>
                    <h2><?php echo $first_name; ?>'s Practice Areas</h2>
                        <div class="practice-areas">
                            <?php foreach( $practice_areas as $pa ) : ?>
                                <a href="/<?php echo $pa['value']; ?>/" class="case-category"><?php echo $pa['label']; ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="body-container body-container-2 wp-block-group clip-top-slant-lh dkblue-bg">
    <div class="container">
        <div class="columns">
            <div class="column-full justify-center">
                <?php if( $additional_bio || $education || $previous_jobs ) : ?>
                <div class="whitebox">
                    <?php if( $additional_bio ) : ?> 
                        <h3>In the Community</h3>
                        <img src="/wp-content/uploads/2025/07/separators.svg" alt="line separator icon" class="case-icon" />
                        <div class="spacer-30"></div>
                        <?php echo $additional_bio; ?>
                    <?php endif; ?>
                    <div class="columns">
                    <?php if( $education && $previous_jobs ) : ?>
                        <div class="column-50">
                    <?php else : ?>
                        <div class="column-full">    
                    <?php endif; ?>
                            <?php if( $education ) : ?>
                                <h4><?php the_field('education_section_title'); ?></h4>
                                <ul>
                                <?php foreach( $education as $edu ) : ?>
                                    <li><strong><?php echo $edu['title']; ?></strong> - <?php echo $edu['details']; ?></li>
                                <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    <?php if( $education && $previous_jobs ) : ?>
                        <div class="column-50">
                    <?php else : ?>
                        <div class="column-full">
                    <?php endif; ?>
                            <?php if( $previous_jobs ) : ?>
                                <h4><?php the_field('roles_section_title'); ?></h4>
                                <ul>
                                <?php foreach( $previous_jobs as $job ) : ?>
                                    <li><strong><?php echo $job['title']; ?></strong> - <?php echo $job['details']; ?></li>
                                <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="content-wrapper">
                    <?php if( $notable_achievements ) : ?>
                        <h3>Notable Achievements</h3>
                        <img src="/wp-content/uploads/2025/07/separators.svg" alt="line separator icon" class="case-icon" />
                        <div class="spacer-30"></div>
                        <?php echo $notable_achievements; ?>
                    <?php endif; ?>
                    <?php if( $notable_achievements && $extra_copy )  : ?>
                        <div class="spacer-15"></div>
                    <?php endif; ?>
                    <?php if( $extra_copy ) echo $extra_copy; ?>
                </div>
                <div class="awards-outer-wrapper">
                    <?php if( have_rows('honors_awards') ) : 
                        $count = 0;
                        $max_visible = 8;
                        $total = count(get_field('honors_awards'));
                        ?>
                        <div class="spacer-30"></div>
                        
                        <h3>Honors & Awards</h3>
                        <div class="awards-wrapper awards-wrapper-<?php echo $total; ?>">
                            <?php
                            $award_index = 0;
                            while( have_rows('honors_awards') ) :
                                the_row();
                                $logo = get_sub_field('logo');
                                $copy = get_sub_field('copy');
                                $link_url = get_sub_field('link_url');
                                $award_index++;
                                if ($award_index > $max_visible) {
                                    // Skip rendering here, will render in hidden-awards below
                                    continue;
                                }
                                ?>
                                <div class="award-block <?php echo !$link_url ? 'no-link' : ''; ?>">
                                    <?php if( $link_url ) : ?>
                                    <a href="<?php echo $link_url; ?>" target="_blank">
                                    <?php endif; ?>
                                    <?php if( $logo ) : ?>
                                        <div class="award-logo">
                                            <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" />
                                        </div>
                                    <?php endif; ?>
                                    <?php if( $copy ) : ?>
                                        <div class="award-copy">
                                            <p><?php echo $copy; ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if( $link_url ) : ?>
                                    </a>         
                                    <?php endif; ?>
                                </div>
                                <?php
                            endwhile;
                            ?>
                        </div>
                        <?php
                        // Render hidden awards as sibling
                        if ($total > $max_visible) :
                            $award_index = 0;
                            reset_rows(); // Reset the have_rows() loop
                            ?>
                            <div class="hidden-awards">
                                <?php
                                while( have_rows('honors_awards') ) :
                                    the_row();
                                    $award_index++;
                                    if ($award_index <= $max_visible) {
                                        continue;
                                    }
                                    $logo = get_sub_field('logo');
                                    $copy = get_sub_field('copy');
                                    $link_url = get_sub_field('link_url');
                                    ?>
                                    <div class="award-block <?php echo !$link_url ? 'no-link' : ''; ?>">
                                        <?php if( $link_url ) : ?>
                                        <a href="<?php echo $link_url; ?>" target="_blank">
                                        <?php endif; ?>
                                        <?php if( $logo ) : ?>
                                            <div class="award-logo">
                                                <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" />
                                            </div>
                                        <?php endif; ?>
                                        <?php if( $copy ) : ?>
                                            <div class="award-copy">
                                                <p><?php echo $copy; ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if( $link_url ) : ?>
                                        </a>         
                                        <?php endif; ?>
                                    </div>
                                    <?php
                                endwhile;
                                ?>
                            </div>
                            <div class="btn view-all-awards"><span>View All Honors & Awards</span></div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>