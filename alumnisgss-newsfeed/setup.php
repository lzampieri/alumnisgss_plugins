<?php

// Css and Js
function asgssn_add_scripts() {
    wp_enqueue_style( 'asgssn', plugin_dir_url( __FILE__ ) . '/assets/app.css' );
    wp_enqueue_script( 'asgssn', plugin_dir_url( __FILE__ ) . '/assets/app.js' );

    wp_enqueue_script( 'AlpineJS', "https://unpkg.com/alpinejs@3.9.0/dist/cdn.min.js" );
}
add_action( 'wp_enqueue_scripts', 'asgssn_add_scripts' );

// Defer loading of AlpineJS
function asgssn_defer_parsing_of_alpine($tag, $handle, $src) {
    if ( $handle == 'AlpineJS' ) {
        if( strpos( $tag, 'defer' ) === false ) {
            return str_replace(' src', ' defer src', $tag);
        }
    }

    // Return original tag
    return $tag;
}
add_filter('script_loader_tag', 'asgssn_defer_parsing_of_alpine', 10, 3);
