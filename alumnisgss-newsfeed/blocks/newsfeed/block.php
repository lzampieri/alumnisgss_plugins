<?php

wp_enqueue_script(
    'block-asgssn-newsfeed-js',
    plugin_dir_url( __FILE__ ) . '/block.js',
    array( 'wp-blocks' )
);

require( __DIR__ . '/renderer.php' );
register_block_type(
    'asgssn/block-newsfeed',
    [
        'editor_script' => 'block-asgssn-newsfeed-js',
        'render_callback' => 'asgssn_newsfeed_renderer',
    ]
);