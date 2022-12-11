<?php

function asgssp_add_metaboxes()
{
    add_meta_box(
        'asgssp_role',
        'Ruolo',
        'global_notice_meta_box_callback',
        'asgssp_director',
        'upstream',
        'high'
    );
}

add_action('add_meta_boxes', 'asgssp_add_metaboxes');

// Move all the 'upstream' metaboxes before tytle
add_action('edit_form_after_title', function() {
    global $post, $wp_meta_boxes;
    do_meta_boxes(get_current_screen(), 'upstream', $post);
    unset($wp_meta_boxes[get_post_type($post)]['upstream']);
});

