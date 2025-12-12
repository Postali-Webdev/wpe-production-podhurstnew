<?php
/**
 * Custom Case Results Custom Post Type
 *
 * @package Postali Parent
 * @author Postali LLC
 */

function create_custom_post_type_landmark_cases() {

// set up labels
    $labels = array(
        'name' => 'Landmark Cases',
        'singular_name' => 'Landmark Case',
        'add_new' => 'Add New Landmark Case',
        'add_new_item' => 'Add New Landmark Case',
        'edit_item' => 'Edit Landmark Cases',
        'new_item' => 'New Landmark Cases',
        'all_items' => 'All Landmark Cases',
        'view_item' => 'View Landmark Cases',
        'search_items' => 'Search Landmark Cases',
        'not_found' =>  'No Landmark Cases Found',
        'not_found_in_trash' => 'No Landmark Cases found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Landmark Cases',

    );
    //register post type
    register_post_type( 'landmark-cases', array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-feedback',
        'has_archive' => 235,
        'public' => true,
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),  
        'exclude_from_search' => false,
        'capability_type' => 'post',
        'rewrite' => array( 'slug' => 'landmark-cases', 'with_front' => false ), // Allows for /legal-blog/ to be the preface to non pages, but custom posts to have own root
        )
    );

}

// Register Custom Taxonomy
function landmark_case_category() {

	$labels = array(
		'name'                       => _x( 'Landmark Case Category', 'Landmark Case Categories' ),
		'singular_name'              => _x( 'Landmark Case Category', 'Landmark Case Category' ),
		'menu_name'                  => __( 'Landmark Case Category' ),
		'all_items'                  => __( 'All Landmark Case Categories' ),
		'new_item_name'              => __( 'New Landmark Case Category' ),
		'add_new_item'               => __( 'Add Landmark Case Category' ),
		'edit_item'                  => __( 'Edit Landmark Case Category' ),
		'update_item'                => __( 'Update Landmark Case Category' ),
		'view_item'                  => __( 'View Landmark Case Category' ),
		'separate_items_with_commas' => __( 'Separate Landmark Case Categories with commas' ),
		'add_or_remove_items'        => __( 'Add or remove Landmark Case Categories' ),
		'popular_items'              => __( 'Popular Landmark Case Categories' ),
		'search_items'               => __( 'Search Landmark Case Categories' ),
		'not_found'                  => __( 'Not Found' ),
		'no_terms'                   => __( 'No Landmark Case Categories' ),
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
	register_taxonomy( 'landmark_case_category', array( 'landmark-cases' ), $args );
}
add_action( 'init', 'landmark_case_category', 0 );

// Register Custom Taxonomy
function landmark_case_attorneys() {

	$labels = array(
		'name'                       => _x( 'Landmark Case Attorney', 'Landmark Case Attorneys' ),
		'singular_name'              => _x( 'Landmark Case Attorney', 'Landmark Case Attorney' ),
		'menu_name'                  => __( 'Landmark Case Attorney' ),
		'all_items'                  => __( 'All Landmark Case Attorneys' ),
		'new_item_name'              => __( 'New Landmark Case Attorney' ),
		'add_new_item'               => __( 'Add Landmark Case Attorney' ),
		'edit_item'                  => __( 'Edit Landmark Case Attorney' ),
		'update_item'                => __( 'Update Landmark Case Attorney' ),
		'view_item'                  => __( 'View Landmark Case Attorney' ),
		'separate_items_with_commas' => __( 'Separate Landmark Case Attorneys with commas' ),
		'add_or_remove_items'        => __( 'Add or remove Landmark Case Attorneys' ),
		'popular_items'              => __( 'Popular Landmark Case Attorneys' ),
		'search_items'               => __( 'Search Landmark Case Attorneys' ),
		'not_found'                  => __( 'Not Found' ),
		'no_terms'                   => __( 'No Landmark Case Attorneys' ),
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
	register_taxonomy( 'landmark_case_attorneys', array( 'landmark-cases' ), $args );
}
add_action( 'init', 'landmark_case_attorneys', 0 );


add_action( 'init', 'create_custom_post_type_landmark_cases' );