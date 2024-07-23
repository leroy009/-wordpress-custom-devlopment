<?php
// Register custom post types
    function leroy_post_types() {
        // event post type
        register_post_type('event', array(
            'supports' => array('title', 'editor', 'excerpt'), // add excerpts and things which this post should support
            'rewrite' => array('slug' => 'events'), //Giving the post its own custom slug name
            'has_archive' => true, // make this have archives or be in the archive page
            'public' => true,
            'show_in_rest' => true,
            'labels' => array(
                'name' => 'Events',
                'singular_name' => 'Event',
                'menu_name' => 'Events',
                'name_admin_bar' => 'Event',
                'add_new' => 'Add New Event',
                'add_new_item' => 'Add New Event',
                'new_item' => 'New Event',
                'edit_item' => 'Edit Event',
                'view_item' => 'View Event',
                'all_items' => 'All Events',
                'search_items' => 'Search Events',
                'parent_item_colon' => 'Parent Events:',
                'not_found' => 'No events found.',
                'not_found_in_trash' => 'No events found in Trash.',
            ),
            'menu_icon' => 'dashicons-calendar-alt'
        ));

        // Program post type
        register_post_type('program', array(
            'supports' => array('title', 'editor'), // add excerpts and things which this post should support
            'rewrite' => array('slug' => 'programs'), //Giving the post its own custom slug name
            'has_archive' => true, // make this have archives or be in the archive page
            'public' => true,
            'show_in_rest' => true,
            'labels' => array(
                'name' => 'Programs',
                'singular_name' => 'Program',
                'menu_name' => 'Programs',
                'name_admin_bar' => 'Program',
                'add_new' => 'Add New Program',
                'add_new_item' => 'Add New Program',
                'new_item' => 'New Program',
                'edit_item' => 'Edit Program',
                'view_item' => 'View Program',
                'all_items' => 'All Programs',
                'search_items' => 'Search Programs',
                'parent_item_colon' => 'Parent Programs:',
                'not_found' => 'No Programs found.',
                'not_found_in_trash' => 'No Programs found in Trash.',
            ),
            'menu_icon' => 'dashicons-awards'
        ));
    }
    add_action('init', 'leroy_post_types');
    // Register custom post types


?>