<?php

add_action('add_meta_boxes', 'add_listing_details_meta');

function add_listing_details_meta() {
    add_meta_box('listing-meta-box-id', 'Submission Data', 'listing_form_meta_box', 'post', 'normal', 'low');
}

function listing_form_meta_box($post) {
    echo "<p>Host: " . get_post_meta($post->ID, 'event_host', true) . "</p>";
    echo "<p>Email: " . get_post_meta($post->ID, 'user_email', true) . "</p>";
    echo "<p>User IP: " . get_post_meta($post->ID, 'user_ip', true) . "</p>";
    echo "<p>City: " . get_post_meta($post->ID, 'event_city', true) . "</p>";
    echo "<p>Country: " . get_post_meta($post->ID, 'event_country', true) . "</p>";
    echo "<p>URL: " . get_post_meta($post->ID, 'event_url', true) . "</p>";
    echo "<p>Time: " . get_post_meta($post->ID, 'event_time', true) . "</p>";
    echo "<p>Date: " . get_post_meta($post->ID, 'event_date', true) . "</p>";
    echo "<p>Timestamp: " . get_post_meta($post->ID, 'event_timestamp', true) . "</p>";
    echo "<p>Language: " . get_post_meta($post->ID, 'event_language', true) . "</p>";
}

add_filter( 'pre_get_posts', 'modify_search_results_order', 10, 2 );

function modify_search_results_order($query) {
  if ( ! $query->is_main_query() || is_admin() || ! is_search() ) {
    return $query;
  }
  $query->query_vars['order'] = 'ASC';
  $query->query_vars['orderby']    = 'meta_value';
  $query->query_vars['meta_query'] = [
    array(
      'key'   => 'stream_time',
      'value' => date('Ymd'),
      'compare' => '<='
    )
  ];
  return $query;
}

?>
