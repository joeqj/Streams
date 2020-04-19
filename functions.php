<?php

add_action('add_meta_boxes', 'add_listing_details_meta');

function add_listing_details_meta() {
    add_meta_box('listing-meta-box-id', 'Submission Data', 'listing_form_meta_box', 'post', 'normal', 'low');
}

function listing_form_meta_box($post) {
    echo "<p>User Name: " . get_post_meta($post->ID, 'user_name', true) . "</p>";
    echo "<p>User Email: " . get_post_meta($post->ID, 'user_email', true) . "</p>";
    echo "<p>User IP: " . get_post_meta($post->ID, 'user_ip', true) . "</p>";
    echo "<p>Stream Time: " . get_post_meta($post->ID, 'stream_time', true) . "</p>";
    echo "<p>Stream URL: " . get_post_meta($post->ID, 'stream_url', true) . "</p>";
    echo "<p>Stream Language: " . get_post_meta($post->ID, 'stream_language', true) . "</p>";
}

?>
