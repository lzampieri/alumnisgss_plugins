<?php

wp_enqueue_script(
    'block-category-carousel-js',
    get_template_directory_uri() . '/blocks/category-carousel/block.js',
    array( 'wp-blocks' )
);

require( __DIR__ . '/renderer.php' );
register_block_type(
    'alumnisgss-theme/block-category-carousel',
    [
        'editor_script' => 'block-category-carousel-js',
        'render_callback' => 'category_carousel_renderer',
        'attributes' => [ 'categoryId' => [ 'type' => 'number' ], ]
    ]
);