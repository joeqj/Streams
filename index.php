<?php get_header(); ?>

<?php

// handle listing create form
if( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
  // get fields
  $name = $_POST['user_name'];
  $email =  $_POST['user_email'];
  $ip = $_SERVER['REMOTE_ADDR'];

  $datetime = $_POST['stream_datetime'];

  $url =  $_POST['stream_url'];
  $title =  $_POST['stream_title'];
  $language = $_POST['stream_language'];
  $tags =  $_POST['tags'];
  $description =  $_POST['description'];

  // Add the content of the form to $post as an array
  $post_information = array(
      'post_title'    => $title,
      'post_content'  => '<!-- wp:paragraph -->' . $description .'<!-- /wp:paragraph -->',
      'tags_input'    => explode(', ', $tags),
      'meta_input' => array(
                        'user_name' => $name,
                        'user_email' => $email,
                        'user_ip' => $ip,
                        'stream_time' => $datetime,
                        'stream_url' => $url,
                        'stream_language' => $language,
                      ),
      'post_type' => 'post',
      'post_status'   => 'pending'
  );
  //save the new post and return its ID
  $post_id = wp_insert_post($post_information);
}

?>

<section id="main">
  <div class="container">
    <div class="columns">
      <div class="column is-11-desktop">
        <div class="archive-fade">
          <?php
            $today = date('Ymd');
            $query = new WP_Query(
              array(
                'posts_per_page' => 2,
                'post_status' => 'publish',
                'meta_key' => 'stream_time',
                'orderby' => 'meta_value',
                'order' => 'ASC',
                'meta_query' => array(
                    array(
                        'key' => 'stream_time',
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
            $today = date('Ymd');
            $query = new WP_Query(
              array(
                'posts_per_page' => 10,
                'post_status' => 'publish',
                'meta_key' => 'stream_time',
                'orderby' => 'meta_value',
                'order' => 'ASC',
                'meta_query' => array(
                    array(
                        'key' => 'stream_time',
                        'value' => $today, // date format error
                        'compare' => '<='
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
    </div>
  </div>
</section>

<?php get_footer(); ?>
