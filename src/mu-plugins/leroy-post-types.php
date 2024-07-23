<?php
// Register custom post types
    function leroy_post_types() {
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
    }
    add_action('init', 'leroy_post_types');
    // Register custom post types


?>