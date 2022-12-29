<?php

function asgssp_directory_tiles_renderer( $attr, $content ) {
    
    $directors = get_posts( array(
        'posts_per_page' => -1,
        'post_type' => 'asgssp_director'
    ));

    $roles = array(
        "Vicepresidente" =>     'b',
        "Presidente" => 'a',
        "Segretario" => 'c',
        "Tesoriere" => 'd'
    );

    foreach( $directors as $director ) {
        $director->role = get_post_meta( $director->ID, 'asgssp_role', true );
        $director->sort_id = "";
        foreach( $roles as $role => $prefix ) {
            if( strpos( strtolower( $director->role), strtolower( $role ) ) !== false )
                $director->sort_id .= $prefix;
        }
        $director->sort_id .= 'f' . strtolower( $director->post_title );
    }

    usort($directors, function($a, $b) {return strcmp($a->sort_id, $b->sort_id);});
    
    $output = '<div class="asgssp-row"><ul class="asgssp-ul">';

    foreach( $directors as $director ) {
        $output .= '<div class="asgssp-item group no-underline">';
        $output .= '<span class="asgssp-name">' . $director->post_title . '</span>';
        $output .= '<span class="asgssp-role">' . $director->role . '</span>';
        
        // Image
        $image = get_post_meta($director->ID, 'asgssp_image', true);
        if( $image ) {
            $url = wp_get_attachment_image_url( $image );
            $output .= '<img class="asgssp-image" src="' . $url . '" />';
        }
        
        $output .= '<span class="asgssp-content">' . $director->post_content . '</span>';
        
        // Curriculum
        $curriculum = get_post_meta($director->ID, 'asgssp_curriculum', true);
        if( $curriculum ) {
            $url = wp_get_attachment_url( $curriculum );
            $output .= '<a href="' . $url . '" class="asgssp-link"><span class="dashicons dashicons-media-document"></span> <span class="asgssp-curriculum">Curriculum</span></a>';
        }

        $output .= '</div>';
    }

    $output .= '</ul></div>';
    return $output;
}