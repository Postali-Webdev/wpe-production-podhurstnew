<?php get_header(); ?>


<section class="banner-block" id="banner-standard-split">
    <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?> 
    <div class="columns">
        <div class="column-50 block">
            <div class="container">
                <h1>Search Results</h1>
                <p class="large-title">You Searched For "<?php echo get_search_query(); ?>"</p>
            </div>
        </div>
        <div class="column-50">
            <img src='/wp-content/uploads/2025/11/podhurst-orseck-office-frontdesk.jpg' class='banner-img'/>
        </div>
    </div>
</section>

<div class="wp-block-group">
    <div class="wp-block-group__inner-container is-layout-constrained wp-block-group-is-layout-constrained">
        <div class="entry-content wp-block-post-content is-layout-flow wp-block-post-content-is-layout-flow">
            <div class="wp-block-group content-wrapper light-grey-bg clip-slant-hl clip-top-slant-lh">
                <div class="wp-block-group__inner-container is-layout-constrained wp-block-group-is-layout-constrained">
                    <div class="container">
                        <?php if(have_posts()) : ?>
                            <?php while(have_posts()) : the_post(); ?>
                                <div class="search-result-item">
                                    <a href="<?php the_permalink(); ?>">
                                    <h2><?php the_title(); ?></h2>
                                    <p><?php echo wp_trim_words( get_the_excerpt(), 300, '...' ); ?></p>
                                    <div class="btn fake-btn"><span>More Info</span></div>
                                    </a>
                                </div>
                            <?php endwhile; ?>
                            <div class="pagination">
                                <?php
                                    the_posts_pagination( array(
                                        'mid_size'  => 2,
                                        'prev_text' => __( 'Previous', 'textdomain' ),
                                        'next_text' => __( 'Next', 'textdomain' ),
                                    ) );
                                ?>
                            </div>
                            <?php else : ?>
                                <h3>No results found. Please try another search.</h3>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>