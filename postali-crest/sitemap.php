<?php
/**
* Template Name: Sitemap
 * @package Postali Crest Controller Theme
 * @author Postali LLC
 */

get_header(); ?>

<div class="body-container">
    <section class="banner-block" id="banner-standard-split">
        <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
        <div class="columns">
            <div class="column-50 block">
                <div class="container">
                    <h1>Sitemap</h1>
                </div>
            </div>
            <div class="column-50">
                <img src='/wp-content/uploads/2025/11/podhurst-orseck-office-frontdesk.jpg.webp' class='banner-img'/>
            </div>
        </div>
    </section>

    <div class="wp-block-group">
        <div class="wp-block-group__inner-container is-layout-constrained wp-block-group-is-layout-constrained">
            <div class="entry-content wp-block-post-content is-layout-flow wp-block-post-content-is-layout-flow">
                <div class="wp-block-group content-wrapper light-grey-bg clip-top-slant-lh">
                    <div class="wp-block-group__inner-container is-layout-constrained wp-block-group-is-layout-constrained">
                        <div class="container">
                            <div class="columns">
                                <div class="column-50 block">
                                    <?php 

                                    $templates = array(
                                        'page-ppc-landing.php',
                                        'page-ppc-landing-options.php',
                                        'sitemap.php',
                                    );

                                    $args = array(
                                        'post_type' => 'page',
                                        'post_status' => 'publish',
                                        'posts_per_page' => -1,
                                        'post_parent' => 0,
                                        'meta_query' => array(
                                            'relation' => 'and',
                                            array(
                                                'key' => '_wp_page_template',
                                                'value' => $templates,
                                                'compare' => 'NOT IN'
                                            ),
                                            array(
                                                'relation' => 'OR',
                                                array(
                                                    'key'     => '_yoast_wpseo_meta-robots-noindex',
                                                    'value'   => '1',
                                                    'compare' => '!=',
                                                ),
                                                array(
                                                    'key'     => '_yoast_wpseo_meta-robots-noindex',
                                                    'compare' => 'NOT EXISTS',
                                                ),
                                            ),
                                            
                                        ),
                                                        
                                    );

                                    $the_query = new WP_Query( $args );

                                    if ( $the_query->have_posts() ) : ?> 
                                        <h2>Pages</h2>
                                        <ul class="parent">
                                            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                                                <?php 
                                                $has_children = get_pages(array('child_of' => get_the_ID()));
                                                if ($has_children) {
                                                    display_pages(get_the_ID());
                                                } else {
                                                    ?>
                                                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                                <?php } ?>
                                            <?php endwhile; ?>
                                        </ul>
                                    <?php endif;
                                    wp_reset_postdata(); ?>

                                    <?php
                                    function display_pages($parent_id) {
                                        ?>
                                        <li>
                                            <a href="<?php echo get_permalink($parent_id); ?>"><?php echo get_the_title($parent_id); ?></a>
                                            <ul class="child-posts">
                                                <?php 
                                                $args = array(
                                                    'post_type' => 'page',
                                                    'post_status' => 'publish',
                                                    'posts_per_page' => -1,
                                                    'post_parent' => $parent_id,
                                                );

                                                $children = new WP_Query( $args );

                                                if ( $children->have_posts() ) : ?>
                                                    <?php while ( $children->have_posts() ) : $children->the_post(); ?>
                                                        <?php 
                                                        $has_children = get_pages(array('child_of' => get_the_ID()));
                                                        if ($has_children) {
                                                            display_pages(get_the_ID());
                                                        } else {
                                                            ?>
                                                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                                        <?php } ?>
                                                    <?php endwhile; ?>
                                                <?php endif;
                                                wp_reset_postdata(); ?>
                                            </ul>
                                        </li>
                                    <?php }
                                    ?>

                                    
                                    <?php 
                                        $args = array(
                                            'post_type' => 'attorneys',
                                            'post_status' => 'publish',
                                            'posts_per_page' => -1        
                                        );                    

                                        $the_query = new WP_Query( $args ); 

                                        if ( $the_query->have_posts() ) : ?>
                                        <h2>Attorneys</h2>
                                        <ul class="links">
                                        <?php
                                            while ( $the_query->have_posts() ) : $the_query->the_post();                        
                                            ?> 
                                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                            
                                            <?php
                                            endwhile; ?> 
                                        </ul>
                                        <?php endif;
                                        wp_reset_postdata(); ?>
                                </div>
                                <div class="column-50 block">
                                        <?php 
                                        $args = array(
                                            'post_type' => 'post',
                                            'post_status' => 'publish',
                                            'posts_per_page' => -1        
                                        );                    

                                        $the_query = new WP_Query( $args ); 

                                        if ( $the_query->have_posts() ) : ?>
                                        <h2>Posts</h2>
                                        <ul class="links">
                                        <?php
                                            while ( $the_query->have_posts() ) : $the_query->the_post();                        
                                            ?> 
                                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                            
                                            <?php
                                            endwhile; ?> 
                                        </ul>
                                        <?php endif;
                                        wp_reset_postdata(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>