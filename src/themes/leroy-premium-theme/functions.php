<?php
    function leroy_files() {
        wp_enqueue_style('leroy_main_styles', get_stylesheet_uri());
    }

    add_action('wp_enqueue_scripts', 'leroy_files');

?>
