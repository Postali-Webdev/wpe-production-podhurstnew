<?php if( have_rows('cards') ) : ?>
    <div class="copy-cards-wrapper">
        <?php while( have_rows('cards') ) : the_row(); ?>
            <div class="card">
                <p class="paragraph-subtitle"><?php the_sub_field('title'); ?></p>
                <?php the_sub_field('copy'); ?>
            </div>
        <?php endwhile; ?>
    </div>
<?php endif; ?>