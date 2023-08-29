<?php

wp_enqueue_script(
    'block-asgsss-sponsors-js',
    plugin_dir_url( __FILE__ ) . '/block.js',
    array( 'wp-blocks' )
);

register_block_type(
    'asgsss/block-sponsors',
    [
        'editor_script' => 'block-asgsss-sponsors-js',
        'attributes' => [ 'list' => [ 'type' => 'array', 'default' => [] ], ]
    ]
);