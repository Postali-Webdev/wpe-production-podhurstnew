<?php
/**
 * Custom Case Results Custom Post Type
 *
 * @package Postali Parent
 * @author Postali LLC
 */

function create_custom_post_type_demo_layouts() {

// set up labels
    $labels = array(
        'name' => 'Demo Layouts',
        'singular_name' => 'Demo Layout',
        'add_new' => 'Add New Demo Layout',
        'add_new_item' => 'Add New Demo Layout',
        'edit_item' => 'Edit Demo Layouts',
        'new_item' => 'New Demo Layouts',
        'all_items' => 'All Demo Layouts',
        'view_item' => 'View Demo Layouts',
        'search_items' => 'Search Demo Layouts',
        'not_found' =>  'No Demo Layouts Found',
        'not_found_in_trash' => 'No Demo Layouts found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => 'Demo Layouts',
    );
    //register post type
    register_post_type( 'demo-layouts', array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-admin-page',
        'has_archive' => false,
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),  
        'exclude_from_search' => false,
        'capability_type' => 'post',
        'show_in_rest' => true,
        'rewrite' => array( 'slug' => 'demo-layouts', 'with_front' => false ), // Allows for /legal-blog/ to be the preface to non pages, but custom posts to have own root
        )
    );

}
add_action( 'init', 'create_custom_post_type_demo_layouts' );