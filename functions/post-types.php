<?php
//Materials
add_action( 'init', 'clippingpath_type_init' );
function clippingpath_type_init() {
	$labels = array(
		'name'               => _x( 'Materials', 'post type general name', 'excavator-template' ),
		'singular_name'      => _x( 'Material', 'post type singular name', 'excavator-template' ),
		'menu_name'          => _x( 'Materials', 'admin menu', 'excavator-template' ),
		'name_admin_bar'     => _x( 'Material', 'add new on admin bar', 'excavator-template' ),
		'add_new'            => _x( 'Add New', 'material', 'excavator-template' ),
		'add_new_item'       => __( 'Add New Material', 'excavator-template' ),
		'new_item'           => __( 'New Material', 'excavator-template' ),
		'edit_item'          => __( 'Edit Material', 'excavator-template' ),
		'view_item'          => __( 'View Material', 'excavator-template' ),
		'all_items'          => __( 'All Materials', 'excavator-template' ),
		'search_items'       => __( 'Search Materials', 'excavator-template' ),
		'parent_item_colon'  => __( 'Parent Materials:', 'excavator-template' ),
		'not_found'          => __( 'No Materials found.', 'excavator-template' ),
		'not_found_in_trash' => __( 'No Materials found in Trash.', 'excavator-template' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'excavator-template' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'material' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'menu_icon' => 'dashicons-networking',
		'supports'           => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
	);

	register_post_type( 'material', $args );
}
add_action( 'after_switch_theme', 'flush_rewrite_rules' );
