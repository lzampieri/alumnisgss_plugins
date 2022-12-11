<?php

function asgssp_add_metaboxes()
{
    add_meta_box(
        'asgssp_role',
        'Ruolo',
        'asgssp_metabox_role_draw',
        'asgssp_director',
        'upstream',
        'high'
    );

    add_meta_box(
        'asgssp_curriculum',
        'Curriculum',
        'asgssp_metabox_curriculum_draw',
        'asgssp_director'
    );

    add_meta_box(
        'asgssp_image',
        'Immagine',
        'asgssp_metabox_image_draw',
        'asgssp_director',
        'upstream',
        'high'
    );
}

add_action('add_meta_boxes', 'asgssp_add_metaboxes');

// Move all the 'upstream' metaboxes before tytle
add_action('edit_form_after_title', function () {
    global $post, $wp_meta_boxes;
    do_meta_boxes(get_current_screen(), 'upstream', $post);
    unset($wp_meta_boxes[get_post_type($post)]['upstream']);
});

// Replace "Aggiungi titolo" with "Inserisci Nome e Cognome"
function asgssp_enter_title($input)
{

    global $post_type;

    if (is_admin() && 'Aggiungi titolo' == $input && 'asgssp_director' == $post_type)
        return 'Inserisci Nome e Cognome';

    return $input;
}
add_filter('gettext', 'asgssp_enter_title');


// Role meta box
function asgssp_metabox_role_draw($post)
{
    $roles = array("Presidente", "Vicepresidente", "Segretario", "Tesoriere", "Consigliere");

    $prevValue = get_post_meta($post->ID, 'asgssp_role', true);
    if (empty($prevValue)) $prevValue = end($roles);
    wp_nonce_field('asgssp_metabox', 'asgssp_metabox_role_nonce');

    $other = !in_array($prevValue, $roles);

?>
    <div x-data="{other: <?php echo $other ? 'true' : 'false'; ?>}">
        <?php
        foreach ($roles as $role) {
        ?>
            <input type="radio" name="asgssp_metabox_role" value="<?php echo $role; ?>" <?php echo $role == $prevValue ? 'checked' : '' ?> @click="other = false" />
            <?php echo $role; ?>
            <br />
        <?php
        }
        ?>
        <input type="radio" name="asgssp_metabox_role" value="other" <?php echo $other ? 'checked' : '' ?> @click="other = true" />
        <input type="text" name="asgssp_metabox_role_other" value="<?php echo $other ? $prevValue : "Altro..."; ?>" :disabled="!other" />
        <br />
    </div>
<?php
}
function asgssp_metabox_role_save($post_id)
{
    // Check nonce
    if (!isset($_POST['asgssp_metabox_role_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['asgssp_metabox_role_nonce'], 'asgssp_metabox')) {
        return;
    }

    // Do not save at autosave.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions.
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save
    $new_role = (isset($_POST['asgssp_metabox_role']) ? sanitize_text_field($_POST['asgssp_metabox_role']) : '');
    if ($new_role == 'other') {
        $new_role = (isset($_POST['asgssp_metabox_role_other']) ? sanitize_text_field($_POST['asgssp_metabox_role_other']) : '');
    }
    update_post_meta($post_id, 'asgssp_role', $new_role);
}
add_action('save_post', 'asgssp_metabox_role_save');



// Image meta box
function asgssp_metabox_image_draw($post)
{
?>
    <script type="text/javascript">
        function asgssp_metabox_image_openframe(e) {
            e.preventDefault();

            // If the media frame already exists, reopen it.
            if ( window.asgssp_image_frame ) {
                window.asgssp_image_frame.open();
                return;
            }

            window.asgssp_image_frame = wp.media({
                title: 'Seleziona immagine',
                library: { type: 'image' }
            });

            window.asgssp_image_frame.open();

            window.asgssp_image_frame.on('select', function() {
                let selected = window.asgssp_image_frame.state().get('selection').first().attributes
                jQuery('#asgssp_metabox_image').val(selected.id)
                jQuery('#asgssp_metabox_image_src').attr('src',selected.url)
                jQuery('#asgssp_metabox_image_delete').css('visibility','visible')
            });

        }
        function asgssp_metabox_image_delete(e) {
            e.preventDefault()
            jQuery('#asgssp_metabox_image').val("")
            jQuery('#asgssp_metabox_image_src').attr('src',"")
            jQuery('#asgssp_metabox_image_delete').css('visibility','hidden')
        }
    </script>
    <?php
    
    $prevValue = get_post_meta($post->ID, 'asgssp_image', true);
    $prevURL = "";
    if( $prevValue )
        $prevURL = wp_get_attachment_image_url( $prevValue );
    wp_nonce_field('asgssp_metabox', 'asgssp_metabox_image_nonce');

    ?>
    <div>
        <img src="" id="asgssp_metabox_image_src" style="max-width: 10rem;" />
        <input type="hidden" id="asgssp_metabox_image" name="asgssp_metabox_image" value="<?php echo $prevValue; ?>" />
        <button type="button" onclick="asgssp_metabox_image_openframe(event)">Seleziona immagine</button>
        <a id="asgssp_metabox_image_delete" onclick="asgssp_metabox_image_delete(event)" href="#" style="color: red; visibility: <?php echo $prevValue ? 'visible' : 'hidden'; ?>">Cancella</a>
    </div>
<?php
}
function asgssp_metabox_image_save($post_id)
{
    // Check nonce
    if (!isset($_POST['asgssp_metabox_image_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['asgssp_metabox_image_nonce'], 'asgssp_metabox')) {
        return;
    }

    // Do not save at autosave.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions.
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save
    $new_image = isset($_POST['asgssp_metabox_image']) ? intval($_POST['asgssp_metabox_image']) : '';
    update_post_meta($post_id, 'asgssp_metabox_image', $new_image);
}
add_action('save_post', 'asgssp_metabox_image_save');



// Curriculum meta box
function asgssp_metabox_curriculum_draw($post)
{
?>
    <script type="text/javascript">
        function asgssp_metabox_curriculum_openframe(e) {
            e.preventDefault();

            // If the media frame already exists, reopen it.
            if ( window.asgssp_curriculum_frame ) {
                window.asgssp_curriculum_frame.open();
                return;
            }

            window.asgssp_curriculum_frame = wp.media({
                title: 'Seleziona curriculum'
            });

            window.asgssp_curriculum_frame.open();

            window.asgssp_curriculum_frame.on('select', function() {
                let selected = window.asgssp_curriculum_frame.state().get('selection').first().attributes
                jQuery('#asgssp_metabox_curriculum').val(selected.id)
                jQuery('#asgssp_metabox_curriculum_filename').text(selected.title)
                jQuery('#asgssp_metabox_curriculum_delete').css('visibility','visible')
            });

        }
        function asgssp_metabox_curriculum_delete(e) {
            e.preventDefault()
            jQuery('#asgssp_metabox_curriculum').val("")
            jQuery('#asgssp_metabox_curriculum_filename').text("")
            jQuery('#asgssp_metabox_curriculum_delete').css('visibility','hidden')
        }
    </script>
    <?php
    
    $prevValue = get_post_meta($post->ID, 'asgssp_curriculum', true);
    $prevTitle = "";
    if( $prevValue )
        $prevTitle = get_the_title( $prevValue );
    wp_nonce_field('asgssp_metabox', 'asgssp_metabox_curriculum_nonce');

    ?>
    <div>
        <i>Facoltativo</i><br />
        <input type="hidden" id="asgssp_metabox_curriculum" name="asgssp_metabox_curriculum" value="<?php echo $prevValue; ?>" />
        <button type="button" onclick="asgssp_metabox_curriculum_openframe(event)">Seleziona curriculum</button>
        <span id="asgssp_metabox_curriculum_filename"><?php echo $prevTitle; ?></span>
        &nbsp;<a id="asgssp_metabox_curriculum_delete" onclick="asgssp_metabox_curriculum_delete(event)" href="#" style="color: red; visibility: <?php echo $prevValue ? 'visible' : 'hidden'; ?>">Cancella</a>
    </div>
<?php
}
function asgssp_metabox_curriculum_save($post_id)
{
    // Check nonce
    if (!isset($_POST['asgssp_metabox_curriculum_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['asgssp_metabox_curriculum_nonce'], 'asgssp_metabox')) {
        return;
    }

    // Do not save at autosave.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check the user's permissions.
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save
    $new_curriculum = isset($_POST['asgssp_metabox_curriculum']) ? intval($_POST['asgssp_metabox_curriculum']) : '';
    update_post_meta($post_id, 'asgssp_curriculum', $new_curriculum);
}
add_action('save_post', 'asgssp_metabox_curriculum_save');
