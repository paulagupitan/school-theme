<!-- Register CPT and Taxonomy -->

<?php
function van_register_custom_post_types() {
    $labels = array(
        'name'               => _x( 'Staffs', 'post type general name'  ),
        'singular_name'      => _x( 'Staff', 'post type singular name'  ),
        'menu_name'          => _x( 'Staffs', 'admin menu'  ),
        'name_admin_bar'     => _x( 'Staff', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New', 'staff' ),
        'add_new_item'       => __( 'Add New Staff' ),
        'new_item'           => __( 'New Staff' ),
        'edit_item'          => __( 'Edit Staff' ),
        'view_item'          => __( 'View Staff'  ),
        'all_items'          => __( 'All Staffs' ),
        'search_items'       => __( 'Search Staffs' ),
        'parent_item_colon'  => __( 'Parent Staffs:' ),
        'not_found'          => __( 'No staffs found.' ),
        'not_found_in_trash' => __( 'No staffs found in Trash.' ),
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'staffs' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-forms',
        'supports'           => array( 'title' ),
    );
    register_post_type( 'van-staff', $args );

}
add_action( 'init', 'van_register_custom_post_types' );

function van_register_taxonomies() {

    // Add Staff Category taxonomy
    $labels = array(
        'name'              => _x( 'Staff Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Staff Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Staff Categories' ),
        'all_items'         => __( 'All Staff Category' ),
        'parent_item'       => __( 'Parent Staff Category' ),
        'parent_item_colon' => __( 'Parent Staff Category:' ),
        'edit_item'         => __( 'Edit Staff Category' ),
        'view_item'         => __( 'Vview Staff Category' ),
        'update_item'       => __( 'Update Staff Category' ),
        'add_new_item'      => __( 'Add New Staff Category' ),
        'new_item_name'     => __( 'New Staff Category Name' ),
        'menu_name'         => __( 'Staff Category' ),
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
        'rewrite'           => array( 'slug' => 'staff-type' ),
    );
    register_taxonomy( 'van-staff-type', array( 'van-staff' ), $args );

    
}
add_action( 'init', 'van_register_taxonomies');

function van_rewrite_flush() {
    van_register_custom_post_types();
    van_register_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'van_rewrite_flush' );
?>