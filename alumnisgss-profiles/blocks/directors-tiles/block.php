<?php

wp_enqueue_script(
    'block-asgssp-directors-tiles-js',
    plugin_dir_url( __FILE__ ) . '/block.js',
    array( 'wp-blocks' )
);

require( __DIR__ . '/renderer.php' );
register_block_type(
    'asgssp/block-directors-tiles',
    [
        'editor_script' => 'block-asgssp-directors-tiles-js',
        'render_callback' => 'asgssp_directory_tiles_renderer',
    ]
);