<?php 
/**
 * Banner Block template.
 *
 * @param array $block The block settings and attributes.
 */


$enable_faq_schema = get_field('enable_faq_schema');
?>

<div class="accordions-block">
    <?php if( have_rows('accordions') ): ?>
    <?php while( have_rows('accordions') ): the_row(); ?>  
    <div class="accordion">
        <div class="accordion_title">
            <h3><?php the_sub_field('accordion_title'); ?></h3><span></span>
        </div>
        <div class="accordion_content">
            <?php the_sub_field('accordion_content'); ?>
        </div>
    </div>
    <?php endwhile; ?>
    <?php endif; ?> 
</div>


<?php if( $enable_faq_schema && have_rows('accordions') ): ?>
    <?php while( have_rows('accordions') ) {
        the_row();
        $question = get_sub_field('accordion_title');
        $answer = get_sub_field('accordion_content');
        $single_schema[] = array(
            '@type' => 'Question',
            'name' => $question,
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text' => strip_tags($answer)
            )
        );
    } ?>
<script type="application/ld+json">
<?php echo json_encode(array(
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => $single_schema
), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?>
</script>
<?php endif; ?>