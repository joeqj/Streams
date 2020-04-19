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
        <div class="columns">

          <div class="column is-4-desktop">
            <div class="columns">
              <div class="column is-6-desktop">
                <div class="columns is-mobile">
                  <div class="column is-4">
                    <div class="country"><span>UK</span></div>
                  </div>
                  <div class="column is-8">
                    <span class="time">19:30</span>
                  </div>
                </div>
              </div>
              <div class="column is-6-desktop">
                <a href="#" class="title">Inter / Access</a>
              </div>
            </div>
          </div>

          <div class="column is-4-desktop">
            <div class="columns">
              <div class="column is-4-desktop">
                <p>24 May</p>
              </div>
              <div class="column is-8-desktop">
                <p>A pretentious art title goes here</p>
                <span class="category">Talk</span>
              </div>
            </div>
          </div>

          <div class="column is-4-desktop">
            <div class="columns">
              <div class="column is-9-desktop">
                <p>Facilisis dignissim rutrum scelerisque dis morbi ante vehicula euismod sodales feugiat suspendisse nullam massa suspendisse a ipsum iaculis ullamcorper integer rutrum cras curae in cum urna.</p>
              </div>
              <div class="column is-3">
                <a href="#" class="btn">Watch</a>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<table>
  <tr>
    <th>Date</th>
    <th>Title</th>
    <th>Name</th>
    <th>Tags</th>
    <th>URL</th>
  </tr>
<?php
if ( have_posts() ) :
    while ( have_posts() ) : the_post();
      // get variables
      $time = get_post_meta(get_the_ID(), 'stream_time', true);
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

      // print that shit to table
      echo '<tr>';
        echo '<td>' . $time . '</td>';
        echo '<td>' . $title . '</td>';
        echo '<td>' . $name . '</td>';
        echo '<td>' . $tags . '</td>';
        echo '<td>' . '<a href="' . $url . '">' . $url . '</a>' . '</td>';
      echo '</tr>';
    endwhile;
endif;
?>
</table>

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
