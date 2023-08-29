<?php

// Css and Js
function asgsss_add_scripts() {
    wp_enqueue_style( 'asgsss', plugin_dir_url( __FILE__ ) . '/assets/app.css' );
    wp_enqueue_script( 'asgsss', plugin_dir_url( __FILE__ ) . '/assets/app.js' );
}
add_action( 'wp_enqueue_scripts', 'asgsss_add_scripts' );