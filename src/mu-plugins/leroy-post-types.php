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
                'add_new_item' => 'Add New Event',
                'edit_item' => 'Edit Event',
                'all_items' => 'All Events',
                'singular_name' => 'Event'
            ),
            'menu_icon' => 'dashicons-calendar-alt'
        ));
    }
    add_action('init', 'leroy_post_types');
    // Register custom post types


?>