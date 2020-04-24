<?php get_header(); ?>

<?php

$today = date('Y-m-d');

// handle listing create form
if( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
  // get fields
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

  // Add the content of the form to $post as an array
  $post_information = array(
      'post_title'    => $title,
      'post_content'  => '<!-- wp:paragraph -->' . $description .'<!-- /wp:paragraph -->',
      'post_category' => $category,
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
}

?>

<section id="main">
  <div id="archive">
    <?php
      $query = new WP_Query(
        array(
          'posts_per_page' => 2,
          'post_status' => 'publish',
          'meta_key' => 'event_timestamp',
          'orderby' => 'meta_value',
          'order' => 'ASC',
          'meta_query' => array(
              array(
                  'key' => 'event_timestamp',
                  'value' => $today, // date format error
                  'compare' => '<='
              )
           )
         )
      );

      if ( $query->have_posts() ) :
      while ( $query->have_posts() ) : $query->the_post();

          get_template_part( 'template-parts/items', 'archive' );

        endwhile;
      endif;

      wp_reset_postdata();
    ?>
  </div>
  <div id="upcoming-posts">
    <?php
      $query = new WP_Query(
        array(
          'posts_per_page' => 10,
          'post_status' => 'publish',
          'meta_key' => 'event_timestamp',
          'orderby' => 'meta_value',
          'order' => 'ASC',
          'meta_query' => array(
              array(
                  'key' => 'event_timestamp',
                  'value' => $today,
                  'compare' => '>='
              )
           )
         )
      );

      if ( $query->have_posts() ) :
      while ( $query->have_posts() ) : $query->the_post();
          get_template_part( 'template-parts/items', 'upcoming' );

        endwhile;
      endif;

      wp_reset_postdata();
    ?>
  </div>
  </div>
</section>

<?php get_footer(); ?>
