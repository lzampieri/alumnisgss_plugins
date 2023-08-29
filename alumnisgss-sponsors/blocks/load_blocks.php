<?php

function asgsss_blocks_register() {
    require( __DIR__ . '/sponsors/block.php' );
}
add_action( 'init', 'asgsss_blocks_register' );

function asgsss_blocks_css() {
    $plugin_uri = plugin_dir_url( __FILE__ );
    // Remove the '/blocks' part
    $plugin_uri = substr( $plugin_uri, 0, -7 );
    wp_enqueue_style(
        'asgsss-blocks-css',
        wp_enqueue_style( 'asgsss', $plugin_uri . '/assets/app.css' )
    );
}
add_action( 'enqueue_block_editor_assets', 'asgsss_blocks_css' );