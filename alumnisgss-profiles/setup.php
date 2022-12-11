<?php

function asgssp_register_director_type()
{

    $labels = array(
        'name' => 'Consiglieri',
        'singular_name' => 'Consigliere',
        'add_new' => 'Nuovo consigliere',
        'add_new_item' => 'Aggiungi nuovo consigliere',
        'edit_item' => 'Modifica consigliere',
        'new_item' => 'Nuovo consigliere',
        'view_item' => 'Visualizza consiglieri',
        'search_items' => 'Cerca',
        'not_found' => 'Consiglieri non trovati',
        'not_found_in_trash' => 'Consiglieri non trovati nel cestino',
    );

    $args = array(
        'labels' => $labels,
        'has_archive' => false,
        'public' => true,
        'hierarchical' => false,
        'supports' => array(
            // 'title',
            // 'editor',
            // 'excerpt',
            // 'custom-fields',
            // 'thumbnail',
            // 'page-attributes'
        ),
        'show_in_rest' => false
    );

    register_post_type( 'asgssp_director', $args );

}

add_action('init', 'asgssp_register_director_type');
