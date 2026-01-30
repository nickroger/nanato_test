<?php

/**
 * Template Name: Featured Cases
 */

get_header();

$query = new WP_Query([
    'post_type'      => 'featured_case',
    'posts_per_page' => 3,
]);

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();

        // Default: Native meta fields
        $case_type = get_post_meta(get_the_ID(), 'case_type', true);
        $settlement_amount = get_post_meta(get_the_ID(), 'settlement_amount', true);

        // Optional: ACF support
        if (function_exists('get_field')) {
            $case_type = get_field('case_type') ?: $case_type;
            $settlement_amount = get_field('settlement_amount') ?: $settlement_amount;
        }
?>

        <article>
            <h2><?php the_title(); ?></h2>
            <p><strong>Case Type:</strong> <?php echo esc_html($case_type); ?></p>
            <p><strong>Settlement Amount:</strong> <?php echo esc_html($settlement_amount); ?></p>
        </article>

<?php
    endwhile;
    wp_reset_postdata();
else :
    echo '<p>No featured cases found.</p>';
endif;

get_footer();
