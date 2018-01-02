<?php
/**
 * Custom post type for Timeline Events
 */

function timeline_slider_post_type() {
    // UI labels for Custom Post Type (CPT)
    $labels = array(
        'name'                => _x( 'Timeline Event', 'Post Type General Name', 'timeline_slider' ),
        'singular_name'       => _x( 'Timeline Event', 'Post Type Singular Name', 'timeline_slider' ),
        'menu_name'           => __( 'Timeline Event', 'timeline_slider' ),
        'parent_item_colon'   => __( 'Parent Timeline Event', 'timeline_slider' ),
        'all_items'           => __( 'All Timeline Events', 'timeline_slider' ),
        'view_item'           => __( 'View Timeline Event', 'timeline_slider' ),
        'add_new_item'        => __( 'Add New Timeline Event', 'timeline_slider' ),
        'add_new'             => __( 'Add New', 'timeline_slider' ),
        'edit_item'           => __( 'Edit Timeline Event', 'timeline_slider' ),
        'update_item'         => __( 'Update Timeline Event', 'timeline_slider' ),
        'search_items'        => __( 'Search Timeline Events', 'timeline_slider' ),
        'not_found'           => __( 'Not Found', 'timeline_slider' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'timeline_slider' ),
    );

    $args = array(
        'label'               => __( 'timeline', 'timeline_slider' ),
        'description'         => __( 'Listing of Timeline Event', 'timeline_slider' ),
        'labels'              => $labels,
        // features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', ),
        // associate CPT with taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'types', 'category', 'post_tag'),
        'menu_icon'           => 'dashicons-calendar-alt',
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'Timeline', $args );
}
add_action( 'init', 'timeline_slider_post_type', 0 );

// these taxonomies are used for masonry filtering
function create_timeline_tax() {
    register_taxonomy( "timeline-categories", 
        array( "timeline" ), 
        array( "hierarchical" => true,
               "labels" => array('name'=>"Timeline Categories",'add_new_item'=>"Add New Field"), 
               "singular_label" => __( "Field" ), 
               "rewrite" => array( 'slug' => 'fields', // controls base slug before each term 
                                   'with_front' => false)
        )
    );
}
add_action( 'init', 'create_timeline_tax' );