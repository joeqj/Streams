<?php

require_once(rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/wp-load.php');

if ($_POST['contact'] == '' && $_POST['email'] == 'your@email.com') {
  $host = $_POST['event_host'];
  $email =  $_POST['event_email'];
  $city = $_POST['event_city'];
  $country = $_POST['event_country'];
  $ip = $_SERVER['REMOTE_ADDR'];

  $datetime = $_POST['stream_datetime'];

  $title =  $_POST['event_name'];
  $url =  $_POST['event_url'];
  $language = $_POST['event_language'];

  $time = $_POST['event_time'];
  $date = $_POST['event_date'];

  $timestamp = $_POST['event_timestamp'];

  $description =  $_POST['event_description'];
  $category = $_POST['event_type'];
  $categoryId = get_cat_id($category);

  // Add the content of the form to $post as an array
  $post_information = array(
      'post_title'    => $title,
      'post_content'  => '<!-- wp:paragraph -->' . $description .'<!-- /wp:paragraph -->',
      'post_category' => array($categoryId),
      'meta_input' => array(
                        'event_host' => $host,
                        'user_email' => $email,
                        'user_ip' => $ip,
                        'event_url' => $url,
                        'event_city' => $city,
                        'event_country' => $country,
                        'event_time' => $time,
                        'event_date' => $date,
                        'event_timestamp' => $timestamp,
                        'event_language' => $language
                      ),
      'post_type' => 'post',
      'post_status'   => 'pending'
  );
  //save the new post and return its ID
  $post_id = wp_insert_post($post_information);
} else {
  die(header("HTTP/1.0 404 Not Found"));
}

?>
