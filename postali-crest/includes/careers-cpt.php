<?php
/**
 * Custom Careers 
 *
 * @package Postali Parent
 * @author Postali LLC
 */

function create_custom_post_type_careers() {

// set up labels
	$labels = array(
 		'name' => 'Careers',
    	'singular_name' => 'Careers',
    	'add_new' => 'Add New Career',
    	'add_new_item' => 'Add New Career',
    	'edit_item' => 'Edit Career',
    	'new_item' => 'New Career',
    	'all_items' => 'All careers',
    	'view_item' => 'View Career',
    	'search_items' => 'Search careers',
    	'not_found' =>  'No careers Found',
    	'not_found_in_trash' => 'No careers found in Trash', 
    	'parent_item_colon' => '',
    	'menu_name' => 'Careers',
    );
    //register post type
	register_post_type( 'Careers', array(
		'labels' => $labels,
        'menu_icon' => 'dashicons-businessperson',
		'has_archive' => false,
 		'public' => true,
		'supports' => array( 'title', 'editor', 'excerpt'),	
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'careers', 'with_front' => false ),
		)
	);

}

add_action( 'init', 'create_custom_post_type_careers' );