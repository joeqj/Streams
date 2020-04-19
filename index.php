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

<h1 class="title">Streams</h1>

<section id="main" class="section">
  <div class="container">
    <div class="columns">
      <div class="column is-11-desktop">

        <?php

        // $query = new WP_Query(
        //   array(
        //       'posts_per_page' => 10,
        //       'post_status' => 'publish',
        //       'post_type' => 'post',
        //       'meta_key' => 'stream_time',
        //       'orderby' => 'meta_value_num',
        //       'order' => 'ASC'
        //   )
        // );

        if ( have_posts() ) :
          while ( have_posts() ) : the_post();
            // get variables
            $timestamp = get_post_meta(get_the_ID(), 'stream_time', true);
            $title = get_the_title();
            $name = get_post_meta(get_the_ID(), 'user_name', true);
            $url = get_post_meta(get_the_ID(), 'stream_url', true);

            $tags = '<div class="post-tags">';
            $tagQuery = wp_get_post_tags(get_the_ID(), array('fields' => 'all'));
            foreach ( $tagQuery as $tag ) {
              $tag_link = get_tag_link( $tag->term_id );

              $tags .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
              $tags .= "{$tag->name}</a>";
            }
            $tags .= '</div>';
        ?>

        <!-- START list item -->
        <div id="list-item" class="columns is-live">
          <!-- language / time column -->
          <div class="column is-4-desktop">
            <div class="columns">
              <div class="column is-6-desktop">
                <div class="columns is-mobile">
                  <div class="column is-4">
                    <div class="country"><span>UK</span></div>
                  </div>
                  <div class="column is-8">
                    <span class="time"><?php echo date("H:i", strtotime($timestamp)); ?></span>
                  </div>
                </div>
              </div>
              <div class="column is-6-desktop pt-1">
                <a href="#" class="username title is-5"><span><?php echo $name ?></span></a>
              </div>
            </div>
          </div>
          <!-- date / title column -->
          <div class="column is-4-desktop">
            <div class="columns">
              <div class="column is-3-desktop">
                <p class="mt-1 title is-5"><?php echo date("d-M", strtotime($timestamp)); ?></p>
              </div>
              <div class="column is-9-desktop">
                <p class="mt-1 title is-4"><?php echo $title ?></p>
                <a href="#" class="btn">Talk</a>
              </div>
            </div>
          </div>
          <!-- description / link column -->
          <div class="column is-4-desktop">
            <div class="columns">
              <div class="column is-8-desktop description">
                <p class="mt-1">Facilisis dignissim rutrum sceler isque dis morbi ante vehicula euismod sodales feugiat suspen disse nullam massa suspendisse suspen disse nullam massa.</p>
              </div>
              <div class="column is-4">
                <a href="#" class="btn btn-dark mt-2">Watch</a>
              </div>
            </div>
          </div>

        </div>
        <!-- END list item -->

        <?php
            endwhile;
          endif;

          // wp_reset_query();
        ?>

      </div>
    </div>
  </div>
</section>

<hr>

<h2>Create Listing</h2>

<form id="create_listing" class="create_listing" method="post" action="">
  <input type="text" name="user_name" placeholder="Stream Name">
  <input type="email" name="user_email" placeholder="Your Email">
  <input type="datetime-local" name="stream_datetime" placeholder="Stream Date">
  <input type="url" name="stream_url" placeholder="Stream URL">
  <input type="text" name="stream_title" placeholder="Stream Title">
  <input type="text" name="stream_language" placeholder="Stream Language">
  <input type="text" name="tags" placeholder="Tags">
  <textarea name="description" rows="8" cols="80" placeholder="Description (Optional - this will help get your stream approved quicker!)"></textarea>
  <button type="submit" name="button">Submit</button>
</form>

<?php get_footer(); ?>
