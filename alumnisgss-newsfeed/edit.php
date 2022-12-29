<?php

// Add "Newsfeed" metabox in edit section
function asgssn_add_metaboxes()
{
    add_meta_box(
        'asgssn_timespan',
        'Periodo di evidenza',
        'asgssn_metabox_timespan_draw',
        'post',
        'side'
    );
}

add_action('add_meta_boxes', 'asgssn_add_metaboxes');

// Timespan meta box
function asgssn_metabox_timespan_draw($post)
{
    $prevStart = get_post_meta($post->ID, 'asgssn_timespan_start', true);
    $prevEnd = get_post_meta($post->ID, 'asgssn_timespan_end', true);

    // Add nonce
    wp_nonce_field('asgssn_metabox', 'asgssn_metabox_timespan_nonce');

?>
    <div>
        <small>Durante questo periodo, questo articolo verrà visualizzato all'interno del blocco <i>in evidenza</i>, tipicamente inserito nella homepage del sito.</i></small><br />
        Da:<br />
        <input type="date" id="asgssn_metabox_timespan_start" name="asgssn_metabox_timespan_start" style="width: full" value="<?php echo $prevStart; ?>" /><br />
        A:<br />
        <input type="date" id="asgssn_metabox_timespan_end" name="asgssn_metabox_timespan_end" style="width: full" value="<?php echo $prevEnd; ?>" /><br />
        <i>inclusi</i><br />
        <a onClick="jQuery('#asgssn_metabox_timespan_start').val(''); jQuery('#asgssn_metabox_timespan_end').val('');" href="#">Reset</a>
    </div>
<?php
}
function asgssn_metabox_timespan_save($post_id)
{
    // Check nonce
    if (!isset($_POST['asgssn_metabox_timespan_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['asgssn_metabox_timespan_nonce'], 'asgssn_metabox')) {
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
    $newStart = (isset($_POST['asgssn_metabox_timespan_start']) ? sanitize_text_field($_POST['asgssn_metabox_timespan_start']) : '');
    $newEnd = (isset($_POST['asgssn_metabox_timespan_end']) ? sanitize_text_field($_POST['asgssn_metabox_timespan_end']) : '');
    update_post_meta($post_id, 'asgssn_timespan_start', $newStart);
    update_post_meta($post_id, 'asgssn_timespan_end', $newEnd);
}
add_action('save_post', 'asgssn_metabox_timespan_save');
