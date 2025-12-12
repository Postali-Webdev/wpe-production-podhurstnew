<?php 

$pa_category = get_field('practice_area_category');

$args = array(
    'post_type' => 'page',
    'meta_query' => array(
        array(
            'key' => 'category',
            'value' => $pa_category,
            'compare' => '=',
            'type' => 'CHAR'
        )
    )
);

$query = new WP_Query($args);

if ($query->have_posts()) {
    echo '<ul>'; // Single ul for all parent pages
    while ($query->have_posts()) {
        $query->the_post();
        $parent_id = get_the_ID();
        $parent_title = get_field('banner_page_title', $parent_id);
        if (!$parent_title) {
            $parent_title = get_the_title($parent_id);
        }
        echo '<li><a href="' . get_permalink($parent_id) . '">' . esc_html($parent_title) . '</a>';

        // Get child pages
        $child_args = array(
            'post_type' => 'page',
            'post_parent' => $parent_id,
            'posts_per_page' => -1
        );
        $child_query = new WP_Query($child_args);

        if ($child_query->have_posts()) {
            echo '<ul>';
            while ($child_query->have_posts()) {
                $child_query->the_post();
                $child_id = get_the_ID();
                $child_title = get_field('banner_page_title', $child_id);
                if (!$child_title) {
                    $child_title = get_the_title($child_id);
                }
                echo '<li><a href="' . get_permalink($child_id) . '">' . esc_html($child_title) . '</a></li>';
            }
            echo '</ul>';
            wp_reset_postdata();
        }

        echo '</li>';
    }
    echo '</ul>'; // End single ul
    wp_reset_postdata();
}

?>