<?php

$today = date('Ymd');

// get variables
$timestamp = get_post_meta(get_the_ID(), 'stream_time', true);
$title = get_the_title();
$name = get_post_meta(get_the_ID(), 'user_name', true);
$url = get_post_meta(get_the_ID(), 'stream_url', true);
$country = get_post_meta(get_the_ID(), 'stream_language', true);

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
<div id="list-item" class="columns <?php if(date("m", strtotime($timestamp)) == date("m", strtotime($today))):?>is-live <?php endif; ?>">
  <!-- language / time column -->
  <div class="column is-4-desktop">
    <div class="columns">
      <div class="column is-6-desktop">
        <div class="columns is-mobile">
          <div class="column is-2-mobile is-4-tablet">
            <div class="country"><span><?php echo $country ?></span></div>
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
        <p class="mt-1 is-5"><?php echo date("d-M", strtotime($timestamp)); ?></p>
      </div>
      <div class="column is-9-desktop item-title">
        <p class="mt-1 title is-4"><?php echo $title ?></p>
        <a href="#" class="btn">Talk</a>
      </div>
    </div>
  </div>
  <!-- description / link column -->
  <div class="column is-4-desktop">
    <div class="columns">
      <div class="column is-8-desktop description">
        <p class="mt-1"><?php echo the_content(); ?></p>
      </div>
      <div class="column is-4">
        <a href="<?php echo $url ?>" target="_blank" class="btn btn-dark mt-2">Watch</a>
      </div>
    </div>
  </div>

</div>
<!-- END list item -->
