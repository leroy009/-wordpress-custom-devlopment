<?php
    function leroy_files() {
        wp_enqueue_script('leroy-main-script-js', get_theme_file_uri('/build/index.js'), array('jquery'), '3.7.1', true);
        wp_enqueue_style('leroy_main_styles', get_theme_file_uri('/build/style-index.css'));
        wp_enqueue_style('leroy_extra_styles', get_theme_file_uri('/build/index.css')); 
        wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_enqueue_style('font-roboto-google', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    }

    add_action('wp_enqueue_scripts', 'leroy_files');

    function leroy_features() {
        add_theme_support('title-tag');
        register_nav_menu('headerMenuLocation', 'Header Menu Location');
        register_nav_menu('footerMenuLocationOne', 'Footer Menu Location One');
        register_nav_menu('footerMenuLocationTwo', 'Footer Menu Location Two');
    }

    add_action('after_setup_theme', 'leroy_features')


    // I am removing them here to the must use plugins so they are not disabled.
    // Register custom post types
    // function leroy_post_types() {
    //     register_post_type('event', array(
    //         'public' => true,
    //         'labels' => array(
    //             'name' => 'Events'
    //         ),
    //         'menu_icon' => 'dashicons-calendar-alt'
    //     ));
    // }
    // add_action('init', 'leroy_post_types');
    // Register custom post types

?>
