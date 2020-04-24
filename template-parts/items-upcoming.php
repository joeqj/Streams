<?php

$today = date('Ymd');

// get variables
$title = get_the_title();
$host = get_post_meta(get_the_ID(), 'event_host', true);
$city = get_post_meta(get_the_ID(), 'event_city', true);
$country = get_post_meta(get_the_ID(), 'event_country', true);

$url = get_post_meta(get_the_ID(), 'event_url', true);
$language = get_post_meta(get_the_ID(), 'event_language', true);
$meta_time = get_post_meta(get_the_ID(), 'event_time', true);
$meta_date = get_post_meta(get_the_ID(), 'event_date', true);

$time = preg_replace("/[^0-9:]/", "", $meta_time);
$date = explode("/", $meta_date);

$timestamp = $date[2] . "/" . $date[1] . "/" . $date[0] . " ";

?>

<!-- START list item -->
<div id="list-item" class="columns <?php if(date("d", strtotime($timestamp)) == date("d", strtotime($today))):?>is-live <?php endif; ?>">
  <!-- language / time column -->
  <div class="column is-4-desktop">
    <div class="columns">
      <div class="column is-6-desktop">
        <div class="columns is-mobile">
          <div class="column is-2-mobile is-4-tablet">
            <div class="country"><span><?php echo $country ?></span></div>
          </div>
          <div class="column is-8">
            <span class="time"><?php echo $time ?></span>
          </div>
        </div>
      </div>
      <div class="column is-6-desktop pt-1">
        <a href="#" class="username title is-5"><span><?php echo $host ?></span></a>
      </div>
    </div>
  </div>
  <!-- date / title column -->
  <div class="column is-4-desktop">
    <div class="columns">
      <div class="column is-3-desktop">
        <p class="mt-1 is-5"><?php echo $date[0]; echo "/"; echo $date[1] ?></p>
      </div>
      <div class="column is-9-desktop item-title">
        <p class="mt-1 title is-4"><?php echo $title ?></p>
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
        <p><?php echo $language ?></p>
      </div>
    </div>
  </div>

</div>
<!-- END list item -->
