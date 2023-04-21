<?php

function asgssn_newsfeed_renderer( $attr, $content ) {

    $output  = '<div class="asgssn_titles">';
    
    $posts = get_posts( array(
        'posts_per_page' => -1,
        'post_type' => 'post'
    ));

    $today = strtotime("0 day");
    $count = 0;

    foreach( $posts as $post ) {
        $start = strtotime( get_post_meta($post->ID, 'asgssn_timespan_start', true) );
        $end = strtotime( get_post_meta($post->ID, 'asgssn_timespan_end', true) . " + 1 day" );
        $title = get_post_meta($post->ID, 'asgssn_newsfeed_title', true);
        if( !$title )
            $title = $post->post_title;
        
        if( !$start )
            continue;
        if( !$end )
            continue;

        if( $start > $today )
            continue;

        if( $end < $today )
            continue;

        $output .= '<div class="asgssn_newsfeed" x-show="shown == ' . $count . '" x-transition x-transition.scale.origin.right x-transition.duration.500ms>';
        $output .= '<span class="asgssn_title">' . $title . '</span>';
        $output .= '<a class="abutton" href="' . get_permalink( $post ) . '">Scopri di più</a>';
        $output .= "</div>";
        $count += 1;
    }
    $output .= "</div>";
    
    if( $count > 1 ) {
        $output .= '<div class="asgssn_bullets">';
        for ($i = 0; $i < $count; $i++) {
            $output .= '<div :class="shown == ' . $i . ' ? \'bullet-full\' : \'bullet-empty\'" @click="shown = ' . $i . '; clearInterval( window.intCont ); window.intCont = false; start();"></div>';
        }
        $output .= "</div>";
    
        $output = '<div class="asgssn_container" x-data="{
            shown : 0,
            total : ' . $count . ', 
            log() { $data.shown = ( $data.shown + 1 ) % $data.total; console.log( $data.shown ); },
            start() { if( ! window.intCont ) window.intCont = setInterval( $data.log, 5000 ); }
        }" x-init="start()">' . $output . '</div>';
    } else {
        $output = '<div class="asgssn_container" x-data="{ shown: 0 }">' . $output . '</div>';

    }

    if( $count == 0 ) return "";
    return $output;
}