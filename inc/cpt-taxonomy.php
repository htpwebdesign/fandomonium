<?php

// // // // // START REGISTERING YOUR TAXONOMIES AND CPTS HERE!!! // // // // // 
// // // // /☆*: .｡. o(≧▽≦)o .｡.:*☆ // // // // // // // // // // // // // //

function fan_register_custom_post_types() {

    // ****** TEMPLATE THAT WE CAN ALL USE 
    $labels = array(
        'name'               => _x( 'Vendors', 'post type general name' ),
        'singular_name'      => _x( 'Vendor', 'post type singular name'),
        'menu_name'          => _x( 'Vendors', 'admin menu' ),
        'name_admin_bar'     => _x( 'Vendor', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'Vendor' ),
        'add_new_item'       => __( 'Add New Vendor' ),
        'new_item'           => __( 'New Vendor' ),
        'edit_item'          => __( 'Edit Vendor' ),
        'view_item'          => __( 'View Vendor' ),
        'all_items'          => __( 'All Vendors' ),
        'search_items'       => __( 'Search Vendors' ),
        'parent_item_colon'  => __( 'Parent Vendors:' ),
        'not_found'          => __( 'No Vendors found!' ),
        'not_found_in_trash' => __( 'No Vendors found in Trash.' ),
        'archives'           => __( 'Vendor Archives'),
        'insert_into_item'   => __( 'Insert into Vendor'),
        'uploaded_to_this_item' => __( 'Uploaded to this Vendor'),
        'filter_item_list'   => __( 'Filter Vendors list'),
        'items_list_navigation' => __( 'Vendors list navigation'),
        'items_list'         => __( 'Vendors list'),
        'featured_image'     => __( 'Vendor featured image'),
        'set_featured_image' => __( 'Set Vendor featured image'),
        'remove_featured_image' => __( 'Remove Vendor featured image'),
        'use_featured_image' => __( 'Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        // this makes it so that its name in the URL looks pretty!
        // right here, you can see it in /works
        'rewrite'            => array( 'slug' => 'vendors' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-store',
        'supports'           => array( 'title', 'thumbnail', 'editor' ),
    );
    register_post_type( 'fan-vendor', $args );

    
    // **************** EVENT CPT ********************//
    // ***********************************************//
    $labels = array(
        'name'                  => _x( 'Events', 'post type general name' ),
        'singular_name'         => _x( 'Event', 'post type singular name'),
        'menu_name'             => _x( 'Events', 'admin menu' ),
        'name_admin_bar'        => _x( 'Event', 'add new on admin bar' ),
        'add_new'               => _x( 'Add New', 'Event' ),
        'add_new_item'          => __( 'Add New Event' ),
        'new_item'              => __( 'New Event' ),
        'edit_item'             => __( 'Edit Event' ),
        'view_item'             => __( 'View Event' ),
        'all_items'             => __( 'All Events' ),
        'search_items'          => __( 'Search Events' ),
        'parent_item_colon'     => __( 'Parent Events:' ),
        'not_found'             => __( 'No Events found.' ),
        'not_found_in_trash'    => __( 'No Events found in Trash.' ),
        'archives'              => __( 'Event Archives'),
        'insert_into_item'      => __( 'Insert into Event'),
        'uploaded_to_this_item' => __( 'Uploaded to this Event'),
        'filter_item_list'      => __( 'Filter Events list'),
        'items_list_navigation' => __( 'Events list navigation'),
        'items_list'            => __( 'Events list'),
        'featured_image'        => __( 'Event featured image'),
        'set_featured_image'    => __( 'Set Event featured image'),
        'remove_featured_image' => __( 'Remove Event featured image'),
        'use_featured_image'    => __( 'Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'events' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-star-filled',
        'supports'           => array(  'title', 'thumbnail'),
    );
    register_post_type( 'fan-event', $args );

}
add_action( 'init', 'fan_register_custom_post_types' );


// guest custom post type - AK
function guest_register_custom_post_types() {

    // ****** TEMPLATE THAT WE CAN ALL USE 
    $labels = array(
        'name'               => _x( 'Guests', 'post type general name' ),
        'singular_name'      => _x( 'Guest', 'post type singular name'),
        'menu_name'          => _x( 'Guests', 'admin menu' ),
        'name_admin_bar'     => _x( 'Guest', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'guest' ),
        'add_new_item'       => __( 'Add New Guest' ),
        'new_item'           => __( 'New Guest' ),
        'edit_item'          => __( 'Edit Guest' ),
        'view_item'          => __( 'View Guest' ),
        'all_items'          => __( 'All Guests' ),
        'search_items'       => __( 'Search Guests' ),
        'parent_item_colon'  => __( 'Parent Guests:' ),
        'not_found'          => __( 'No guests found!' ),
        'not_found_in_trash' => __( 'No guests found in Trash.' ),
        'archives'           => __( 'Guest Archives'),
        'insert_into_item'   => __( 'Insert into guest'),
        'uploaded_to_this_item' => __( 'Uploaded to this guest'),
        'filter_item_list'   => __( 'Filter guests list'),
        'items_list_navigation' => __( 'Guests list navigation'),
        'items_list'         => __( 'Guests list'),
        'featured_image'     => __( 'Guest featured image'),
        'set_featured_image' => __( 'Set guest featured image'),
        'remove_featured_image' => __( 'Remove guest featured image'),
        'use_featured_image' => __( 'Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        // this makes it so that its name in the URL looks pretty!
        // right here, you can see it in /works
        'rewrite'            => array( 'slug' => 'guests' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-heart',
        'supports'           => array( 'title', 'thumbnail', 'editor' ),
    );
    register_post_type( 'fan-guest', $args );



}
add_action( 'init', 'guest_register_custom_post_types' );
// // // // // // // // REGISTER TAXONOMIES HERE // // // // // // / //

// taxonomies
function fan_register_taxonomies() {

    // Add Event Type Taxonomy
    $labels = array(
        'name'              => _x( 'Event Types', 'taxonomy general name' ),
        'singular_name'     => _x( 'Event Type', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Event Types' ),
        'all_items'         => __( 'All Event Types' ),
        'parent_item'       => __( 'Parent Event Type' ),
        'parent_item_colon' => __( 'Parent Event Type:' ),
        'edit_item'         => __( 'Edit Event Type' ),
        'view_item'         => __( 'View Event Type' ),
        'update_item'       => __( 'Update Event Type' ),
        'add_new_item'      => __( 'Add New Event Type' ),
        'new_item_name'     => __( 'New Event Type Name' ),
        'menu_name'         => __( 'Event Type' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'event-type' ),
    );
    register_taxonomy( 'fan-event-type', array( 'fan-event' ), $args );

    // Add Vendor Type Taxonomy
    $labels = array(
        'name'              => _x( 'Vendor Types', 'taxonomy general name' ),
        'singular_name'     => _x( 'Vendor Type', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Vendor Types' ),
        'all_items'         => __( 'All Vendor Types' ),
        'parent_item'       => __( 'Parent Vendor Type' ),
        'parent_item_colon' => __( 'Parent Vendor Type:' ),
        'edit_item'         => __( 'Edit Vendor Type' ),
        'view_item'         => __( 'View Vendor Type' ),
        'update_item'       => __( 'Update Vendor Type' ),
        'add_new_item'      => __( 'Add New Vendor Type' ),
        'new_item_name'     => __( 'New Vendor Type Name' ),
        'menu_name'         => __( 'Vendor Type' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'vendor-type' ),
    );
    register_taxonomy( 'fan-vendor-type', array( 'fan-vendor' ), $args );
}
add_action( 'init', 'fan_register_taxonomies');


function fan_rewrite_flush() {
    fan_register_custom_post_types();
    guest_register_custom_post_types();
    fan_register_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'fan_rewrite_flush' );