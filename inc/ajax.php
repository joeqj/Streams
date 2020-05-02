<?php

add_action( 'wp_ajax_nopriv_load_more_streams', 'load_more_streams');
add_action( 'wp_ajax_load_more_streams', 'load_more_streams');

function load_more_streams() {

  $paged = $_POST['page'] + 1;
  $today = $_POST['today'];

  $query = new WP_Query(
    array(
      'posts_per_page' => 4,
      'paged' => $paged,
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

  if ($query->have_posts()) :

    echo '<div class="page-limit" data-page="/page/' . $paged . '">';

    while ($query->have_posts()) : $query->the_post();
      get_template_part('template-parts/items', 'upcoming');
    endwhile;

    echo "</div>";

  endif;

  wp_reset_postdata();

  die();
}

add_action( 'wp_ajax_nopriv_load_less_streams', 'load_less_streams');
add_action( 'wp_ajax_load_less_streams', 'load_less_streams');

function load_less_streams() {

  $paged = $_POST['page'] + 1;
  $today = $_POST['today'];

  $query = new WP_Query(
    array(
      'posts_per_page' => 4,
      'paged' => $paged,
      'post_status' => 'publish',
      'meta_key' => 'event_timestamp',
      'orderby' => 'meta_value',
      'order' => 'DESC',
      'meta_query' => array(
          array(
              'key' => 'event_timestamp',
              'value' => $today,
              'compare' => '>='
          )
       )
    )
  );

  $array_rev = array_reverse($query->posts);
  $query->posts = $array_rev;

  if ($query->have_posts()) :

    echo '<div class="page-limit" data-page="/page/' . $paged . '">';

    while ($query->have_posts()) : $query->the_post();
      get_template_part('template-parts/items', 'upcoming');
    endwhile;

    echo "</div>";

  endif;

  wp_reset_postdata();

  die();
}


?>
