<?php
/**
 * Media Mentions Custom Post Type
 *
 * @package Postali Child
 * @author Postali LLC
 */

function media_mentions() {
	$labels = array(
		'name'               => __( 'Media Mentions', 'post type general name' ),
		'singular_name'      => __( 'Media Mention', 'post type singular name' ),
		'add_new'            => __( 'Add New', 'book' ),
		'add_new_item'       => __( 'Add New Media Mention' ),
		'edit_item'          => __( 'Edit Media Mention' ),
		'new_item'           => __( 'New Media Mention' ),
		'all_items'          => __( 'All Media Mentions' ),
		'view_item'          => __( 'View Media Mentions' ),
		'search_items'       => __( 'Search Media Mentions' ),
		'not_found'          => __( 'No Media Mentions found' ),
		'not_found_in_trash' => __( 'No Media Mentions found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Media Mentions'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'All of my Media Mentions',
		'public'        => true,
		'menu_position' => 7,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
		'menu_icon'		=> 'dashicons-share',
	);
	register_post_type( 'media_mentions', $args );	
}
add_action( 'init', 'media_mentions' );