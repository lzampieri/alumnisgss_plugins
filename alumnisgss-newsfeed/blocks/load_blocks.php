<?php

function asgssn_blocks_register() {
    require( __DIR__ . '/newsfeed/block.php' );
}
add_action( 'init', 'asgssn_blocks_register' );

function asgssn_blocks_css() {
    $plugin_uri = plugin_dir_url( __FILE__ );
    // Remove the '/blocks' part
    $plugin_uri = substr( $plugin_uri, 0, -7 );
    wp_enqueue_style(
        'asgssn-blocks-css',
        wp_enqueue_style( 'asgssn', $plugin_uri . '/assets/app.css' )
    );
}
add_action( 'enqueue_block_editor_assets', 'asgssn_blocks_css' );