<?php

/**
 * Template Name: Edit Template
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

get_header();

if (isset($_GET['id'])) {
  $post_to_edit = get_post($_GET["id"]);
}

if (isset($_GET['email'])) {
  $verify_email = $_GET['email'];
}

if ($post_to_edit && $verify_email == get_post_meta( $post_to_edit->ID, 'user_email', true)) {
  $username = get_post_meta( $post_to_edit->ID, 'user_name', true);
  $useremail = get_post_meta( $post_to_edit->ID, 'user_email', true);
  $streamtime = get_post_meta( $post_to_edit->ID, 'stream_time', true);
  $streamurl = get_post_meta( $post_to_edit->ID, 'stream_url', true);
  $streamtitle = $post_to_edit->post_title;
  $streamlanguage = get_post_meta( $post_to_edit->ID, 'stream_language', true);
  $description = strip_tags(apply_filters('the_content', get_post_field('post_content', $post_to_edit->ID)));
  $taglist = wp_get_post_tags( $post_to_edit->ID, array('fields' => 'names'));
} else {
  echo "no!!";
}

// handle form
if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['pid'])) {
  $id = $_POST['pid'];

  // get fields
  $name = $_POST['user_name'];
  $email =  $_POST['user_email'];
  $ip = $_SERVER['REMOTE_ADDR'];

  $datetime = $_POST['stream_datetime'];

  $url =  $_POST['stream_url'];
  $title =  wp_strip_all_tags( $_POST['stream_title']);
  $language = $_POST['stream_language'];
  $tags =  $_POST['tags'];
  $description =  $_POST['description'];

  // set information from form
  $post_information = array(
    'ID' => $id,
    'post_title' =>  $title,
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
    'post_status' => 'pending'
  );
  // update post
  $post_id = wp_update_post( $post_information );
}

?>

<!-- content before form -->
<?php
while ( have_posts() ) : the_post(); ?>
  <div class="entry-content-page">
    <?php the_content(); ?>
  </div>
<?php
endwhile;
wp_reset_query();
?>

<!-- edit form -->
<div id="postbox">
    <form id="edit_post" name="edit_post" method="post" action="">
      <input type="text" name="user_name" value="<?php echo $username ?>">
      <input type="hidden" name="user_email" value="<?php echo $useremail ?>">
      <input type="datetime-local" name="stream_datetime" value="<?php echo $streamtime ?>">
      <input type="url" name="stream_url" value="<?php echo $streamurl ?>">
      <input type="text" name="stream_title" value="<?php echo $streamtitle ?>">
      <input type="text" name="stream_language" value="<?php echo $streamlanguage ?>">
      <input type="text" name="tags" placeholder="Tags" value="<?php echo implode(', ', $taglist); ?>">
      <textarea name="description" rows="8" cols="80"><?php echo $description ?></textarea>
      <button type="submit" name="button">Update</button>

      <input type="hidden" name="action" value="f_edit_post" />
      <input type="hidden" name="pid" value="<?php echo $post_to_edit->ID; ?>" />
      <?php wp_nonce_field( 'new-post' ); ?>
    </form>
</div>

<?php get_footer() ?>
