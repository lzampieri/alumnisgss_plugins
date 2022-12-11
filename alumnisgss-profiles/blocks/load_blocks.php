<?php

function asgssp_blocks_register() {
    require( __DIR__ . '/directors-tiles/block.php' );
}
add_action( 'init', 'asgssp_blocks_register' );

function asgssp_blocks_css() {
    $plugin_uri = plugin_dir_url( __FILE__ );
    // Remove the '/blocks' part
    $plugin_uri = substr( $plugin_uri, 0, -7 );
    wp_enqueue_style(
        'asgssp-blocks-css',
        wp_enqueue_style( 'asgssp', $plugin_uri . '/assets/app.css' )
    );
}
add_action( 'enqueue_block_editor_assets', 'asgssp_blocks_css' );