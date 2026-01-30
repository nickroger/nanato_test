<?php

/**
 * Featured Case - Custom Post Type and Meta Fields
 */

/**
 * Register Custom Post Type
 */
function register_featured_case_cpt()
{
    register_post_type('featured_case', [
        'labels' => [
            'name'          => 'Featured Cases',
            'singular_name' => 'Featured Case',
        ],
        'public'       => true,
        'menu_icon'    => 'dashicons-portfolio',
        'supports'     => ['title'],
        'show_in_rest' => true, // REST-ready
    ]);
}
add_action('init', 'register_featured_case_cpt');

/**
 * Register Meta Box (Native WordPress)
 */
function featured_case_add_meta_boxes()
{
    add_meta_box(
        'featured_case_details',
        'Case Details',
        'featured_case_meta_box_callback',
        'featured_case',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'featured_case_add_meta_boxes');

/**
 * Meta Box HTML
 */
function featured_case_meta_box_callback($post)
{
    $case_type = get_post_meta($post->ID, 'case_type', true);
    $settlement_amount = get_post_meta($post->ID, 'settlement_amount', true);
?>

    // Campo nonce para segurança
    wp_nonce_field('featured_case_nonce', 'featured_case_nonce_field');

    ?>
    <p>
        <label for="case_type"><strong>Case Type</strong></label><br>
        <input
            type="text"
            id="case_type"
            name="case_type"
            value="<?php echo esc_attr($case_type); ?>"
            style="width:100%;" />
    </p>

    <p>
        <label for="settlement_amount"><strong>Settlement Amount</strong></label><br>
        <input
            type="text"
            id="settlement_amount"
            name="settlement_amount"
            value="<?php echo esc_attr($settlement_amount); ?>"
            style="width:100%;" />
    </p>

<?php

}

/**
 * Save Meta Box Data
 */
function featured_case_save_meta($post_id)
{
    // Autosave check
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Nonce check
    if (
        ! isset($_POST['featured_case_nonce_field']) ||
        ! wp_verify_nonce($_POST['featured_case_nonce_field'], 'featured_case_nonce')
    ) {
        return;
    }


    // Capability check
    if (! current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['case_type'])) {
        update_post_meta(
            $post_id,
            'case_type',
            sanitize_text_field($_POST['case_type'])
        );
    }

    if (isset($_POST['settlement_amount'])) {
        update_post_meta(
            $post_id,
            'settlement_amount',
            sanitize_text_field($_POST['settlement_amount'])
        );
    }
}
add_action('save_post_featured_case', 'featured_case_save_meta');
