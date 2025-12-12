<?php
/**
 * Custom Case Results Custom Post Type
 *
 * @package Postali Parent
 * @author Postali LLC
 */

function create_custom_post_type_results() {

// set up labels
    $labels = array(
        'name' => 'Results',
        'singular_name' => 'Result',
        'add_new' => 'Add New Case Result',
        'add_new_item' => 'Add New Case Result',
        'edit_item' => 'Edit Results',
        'new_item' => 'New Results',
        'all_items' => 'All Results',
        'view_item' => 'View Results',
        'search_items' => 'Search Case Results',
        'not_found' =>  'No Results Found',
        'not_found_in_trash' => 'No Results found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Case Results',

    );
    //register post type
    register_post_type( 'Results', array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-analytics',
        'has_archive' => true,
        'public' => true,
        'supports' => array( 'title', 'editor', 'excerpt' ),  
        'exclude_from_search' => false,
        'capability_type' => 'post',
        'rewrite' => array( 'slug' => 'results', 'with_front' => false ), // Allows for /legal-blog/ to be the preface to non pages, but custom posts to have own root
        )
    );

}

// Register Custom Taxonomy
function result_category() {

	$labels = array(
		'name'                       => _x( 'Result Category', 'Result Categories' ),
		'singular_name'              => _x( 'Result Category', 'Result Category' ),
		'menu_name'                  => __( 'Result Category' ),
		'all_items'                  => __( 'All Result Categories' ),
		'new_item_name'              => __( 'New Result Category' ),
		'add_new_item'               => __( 'Add Result Category' ),
		'edit_item'                  => __( 'Edit Result Category' ),
		'update_item'                => __( 'Update Result Category' ),
		'view_item'                  => __( 'View Result Category' ),
		'separate_items_with_commas' => __( 'Separate Result Categories with commas' ),
		'add_or_remove_items'        => __( 'Add or remove Result Categories' ),
		'popular_items'              => __( 'Popular Result Categories' ),
		'search_items'               => __( 'Search Result Categories' ),
		'not_found'                  => __( 'Not Found' ),
		'no_terms'                   => __( 'No Result Categories' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'result_category', array( 'results' ), $args );

}
add_action( 'init', 'result_category', 0 );
add_action( 'init', 'create_custom_post_type_results' );