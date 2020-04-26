<?php

require get_template_directory() . '/inc/ajax.php';

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
      'key'   => 'event_timestamp',
      'value' => date('Ymd'),
      'compare' => '<='
    )
  ];
  return $query;
}

add_filter('manage_posts_columns', 'hs_post_table_head');

function hs_post_table_head( $columns ) {
    $columns['meta_event_date']  = 'Event Date';
    $columns['meta_event_host']  = 'Event Host';
    $columns['meta_event_url']  = 'Event URL';
    return $columns;

}
add_action( 'manage_posts_custom_column', 'hs_post_table_content', 10, 2 );

function hs_post_table_content( $column_name, $post_id ) {
    if( $column_name == 'meta_event_date' ) {
        echo get_post_meta( $post_id, 'event_date', true );
    }
    if( $column_name == 'meta_event_host' ) {
        echo get_post_meta( $post_id, 'event_host', true );
    }
    if( $column_name == 'meta_event_url' ) {
        echo get_post_meta( $post_id, 'event_url', true );
    }
}

add_filter('manage_posts_columns', 'remove_post_columns');

function remove_post_columns($defaults) {
  unset($defaults['comments']);
  unset($defaults['tags']);
  unset($defaults['author']);
  return $defaults;
}

add_filter('manage_posts_columns', 'column_order');

function column_order($columns) {
  $n_columns = array();
  $move = 'Date'; // what to move
  $before = 'Event URL'; // move before this
  foreach($columns as $key => $value) {
    if ($key==$before){
      $n_columns[$move] = $move;
    }
      $n_columns[$key] = $value;
  }
  return $n_columns;
}

?>
