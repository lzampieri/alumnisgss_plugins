<?php

function asgssp_blocks_register() {
    require( __DIR__ . '/directors_tiles/block.php' );
}
add_action( 'init', 'asgssp_blocks_register' );

function asgssp_blocks_css() {
    wp_enqueue_style(
        'asgssp-blocks-css',
        wp_enqueue_style( 'app', plugin_dir_url( __FILE__ ) . '/assets/app.css' );
    );
}
add_action( 'enqueue_block_editor_assets', 'asgssp_blocks_css' );