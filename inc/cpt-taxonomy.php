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


// // // // // // // // REGISTER TAXONOMIES HERE // // // // // // / //

function fan_register_taxonomies() {

     // Add Work Category taxonomy
     $labels = array(
        'name'              => _x( 'Work Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Work Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Work Categories' ),
        'all_items'         => __( 'All Work Category' ),
        'parent_item'       => __( 'Parent Work Category' ),
        'parent_item_colon' => __( 'Parent Work Category:' ),
        'edit_item'         => __( 'Edit Work Category' ),
        'view_item'         => __( 'View Work Category' ),
        'update_item'       => __( 'Update Work Category' ),
        'add_new_item'      => __( 'Add New Work Category' ),
        'new_item_name'     => __( 'New Work Category Name' ),
        'menu_name'         => __( 'Work Category' ),
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
        'rewrite'           => array( 'slug' => 'work-categories' ),
    );
    register_taxonomy( 'fan-work-category', array( 'fan-work' ), $args );
}
add_action( 'init', 'fan_register_taxonomies');


function fan_rewrite_flush() {
    fan_register_custom_post_types();
    fan_register_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'fan_rewrite_flush' );