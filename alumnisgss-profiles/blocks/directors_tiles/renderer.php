<?php

function category_carousel_renderer( $attr, $content ) {
    if( !array_key_exists( 'categoryId', $attr ) || $attr['categoryId'] == 0 ) {
        return " ";
    }

    $posts = get_posts( array(
        'posts_per_page' => -1,
        'category' => $attr['categoryId']
    ));
    
    $output = "";
    if( $posts ) {
        $output = <<<HTML
        <div class="carousel-row">
            <ul class="carousel-ul">
HTML;
        
        foreach( $posts as $post ) {
            $output .= '<a href="' .get_permalink( $post->ID ) . '" class="carousel-item group no-underline" >';
            
            $image = get_the_post_thumbnail_url( $post );
            if( $image ) {
                $output .= '<img class="w-1/3 md:w-full max-h-40 grayscale group-hover:grayscale-0" src="' . $image . '" />';
            } else  {
                $output .= '<img class="w-1/3 md:w-full max-h-40 block group-hover:hidden" src="' . get_template_directory_uri() . '/assets/logo_background.svg" />';
                $output .= '<img class="w-1/3 md:w-full max-h-40 hidden group-hover:block" src="' . get_template_directory_uri() . '/assets/logo_contrast.svg" />';
            }

            $output .= '<span class="carousel-title">' . apply_filters('the_title', $post->post_title ) . '</span>';
            $output .= '</a>';
        }
        $output .= '</ul></div>';
    }

    return $output;
}