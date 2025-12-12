<?php
/**
 * Custom Attorneys Custom Post Type
 *
 * @package Postali Child
 * @author Postali LLC
 */

function create_custom_post_type_attorneys() {

// set up labels
    $labels = array(
        'name' => 'Attorneys',
        'singular_name' => 'Attorney',
        'add_new' => 'Add New Attorney',
        'add_new_item' => 'Add New Attorney',
        'edit_item' => 'Edit Attorney',
        'new_item' => 'New Attorney',
        'all_items' => 'All Attorneys',
        'view_item' => 'View Attorneys',
        'search_items' => 'Search Attorneys',
        'not_found' =>  'No Attorneys Found',
        'not_found_in_trash' => 'No Attorneys found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Attorneys',

    );
    //register post type
    register_post_type( 'Attorneys', array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-businessman',
        'has_archive' => 169,
        'public' => true,
        'supports' => array( 'title', 'editor', 'thumbnail' ),  
        'exclude_from_search' => false,
        'capability_type' => 'post',
        'rewrite' => array( 'slug' => '/'),
        'rewrite' => array( 'slug' => 'our-team', 'with_front' => false ), // Has /about/ as pre front for the theme, if there are more then attorneys to be listed under here this need removed
        )
    );

}
add_action( 'init', 'create_custom_post_type_attorneys' );