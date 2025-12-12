<?php
/**
 * Custom Testimonials 
 *
 * @package Postali Parent
 * @author Postali LLC
 */

function create_custom_post_type_testimonials() {

// set up labels
	$labels = array(
 		'name' => 'Testimonials',
    	'singular_name' => 'Testimonial',
    	'add_new' => 'Add New Testimonial',
    	'add_new_item' => 'Add New Testimonial',
    	'edit_item' => 'Edit Testimonial',
    	'new_item' => 'New Testimonial',
    	'all_items' => 'All Testimonials',
    	'view_item' => 'View Testimonials',
    	'search_items' => 'Search Testimonials',
    	'not_found' =>  'No Testimonials Found',
    	'not_found_in_trash' => 'No Testimonials found in Trash', 
    	'parent_item_colon' => '',
    	'menu_name' => 'Testimonials',
    );
    //register post type
	register_post_type( 'testimonial', array(
		'labels' => $labels,
        'menu_icon' => 'dashicons-format-quote',
		'has_archive' => 237,
 		'public' => true,
		'supports' => array( 'title', 'editor', 'excerpt'),	
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'testimonials', 'with_front' => false ),
		)
	);

}

// Register Custom Taxonomy
function testimonial_topic() {

	$labels = array(
		'name'                       => _x( 'Testimonial Topic', 'Testimonial Topics' ),
		'singular_name'              => _x( 'Testimonial Topic', 'Testimonial Topic' ),
		'menu_name'                  => __( 'Testimonial Topic' ),
		'all_items'                  => __( 'All Testimonial Topics' ),
		'new_item_name'              => __( 'New Testimonial Topic' ),
		'add_new_item'               => __( 'Add Testimonial Topic' ),
		'edit_item'                  => __( 'Edit Testimonial Topic' ),
		'update_item'                => __( 'Update Testimonial Topic' ),
		'view_item'                  => __( 'View Testimonial Topic' ),
		'separate_items_with_commas' => __( 'Separate Testimonial Topics with commas' ),
		'add_or_remove_items'        => __( 'Add or remove Testimonial Topics' ),
		'popular_items'              => __( 'Popular Testimonial Topics' ),
		'search_items'               => __( 'Search Testimonial Topics' ),
		'not_found'                  => __( 'Not Found' ),
		'no_terms'                   => __( 'No Testimonial Topics' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'testimonial_topic', array( 'testimonials' ), $args );

}
add_action( 'init', 'testimonial_topic', 0 );
add_action( 'init', 'create_custom_post_type_testimonials' );