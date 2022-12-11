<?php

// Register directors post type
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

// Register meta on list
add_filter('manage_asgssp_director_posts_columns', function($columns) {
    unset( $columns );
    $columns['image'] = 'Immagine';
    $columns['title'] = 'Nome';
    $columns['role'] = 'Ruolo';
    return $columns;
});
add_action('manage_asgssp_director_posts_custom_column',  function($column_key, $post_id) {
	if ($column_key == 'role') {
		$role = get_post_meta($post_id, 'asgssp_role', true);
        echo $role;
	}
    if ($column_key == 'image') {
        $img = get_post_meta($post_id, 'asgssp_image', true);
        $url = $img;
        if( $img ) {
            $url = wp_get_attachment_image_url( $img );
            echo "<img src=\"" . $url . "\" style=\"max-width: 8rem;\" />";
        }
    }
}, 10, 2);

// Load AlpineJS
function asgssp_load_alpineJS() {
    wp_enqueue_script(
        'AlpineJS',
        "https://unpkg.com/alpinejs@3.9.0/dist/cdn.min.js"
        );

};
add_action( 'admin_head', 'asgssp_load_alpineJS' );

// Css and Js
function asgssp_add_plugin_scripts() {
    wp_enqueue_style( 'app', plugin_dir_url( __FILE__ ) . '/assets/app.css' );
    wp_enqueue_script( 'app', plugin_dir_url( __FILE__ ) . '/assets/app.js' );
}
add_action( 'wp_enqueue_scripts', 'asgssp_add_plugin_scripts' );