<?php

$today = date('Ymd h', time() + 3600);
$isLive = false;

// get variables
$title = get_the_title();
$host = get_post_meta(get_the_ID(), 'event_host', true);
$city = get_post_meta(get_the_ID(), 'event_city', true);
$country = get_post_meta(get_the_ID(), 'event_country', true);

$url = get_post_meta(get_the_ID(), 'event_url', true);

if (strpos($url,'https://') === false){
    $url = 'https://'.$url;
}

if (strpos($url, 'youtube') !== false) {
  $source = " YouTube";
} elseif (strpos($url, 'youtu.be') !== false) {
  $source = " YouTube";
} elseif (strpos($url, 'twitch.tv') !== false) {
  $source = " Twitch";
} elseif (strpos($url, 'facebook') !== false) {
  $source = " Facebook";
} elseif (strpos($url, 'pornhub') !== false) {
  $source = " Pornhub";
} else {
  $source = "line";
}

$language = get_post_meta(get_the_ID(), 'event_language', true);
$meta_time = get_post_meta(get_the_ID(), 'event_time', true);
$meta_date = get_post_meta(get_the_ID(), 'event_date', true);

$timestamp = get_post_meta(get_the_ID(), 'event_timestamp', true);

$time = preg_replace("/[^0-9:]/", "", $meta_time);
$date = explode("/", $meta_date);

$categories = get_the_category();

$calendarDate = explode(" ", $timestamp);
$calendarTime = preg_replace("/[: ]/", "", $calendarDate[1]);
$calendarString = '?action=TEMPLATE&text='.$title.'&dates='.$calendarDate[0].'T'.$calendarTime.'00/'.$calendarDate[0].'T'.$calendarTime.'00&ctz=London/England&details='.$url.'&location='.$city.', '.$country.'&trp=false&sprop=&sprop=name:';

if(date("Ymd h", strtotime($timestamp)) == $today) {
  $isLive = true;
}

?>
<div id="list-item" class="<?php the_ID(); ?> <?php echo get_query_var("post-class") ?><?php if($isLive == true):?> is-live<?php endif; ?>">
  <div class="columns">
    <!-- date / title column -->
    <div class="column is-1 is-hidden-mobile date">
      <p class="mt-1 is-5"><?php echo $date[0]; echo "/"; echo $date[1] ?></p>
    </div>
    <!-- language / time column -->
    <div class="column is-4-desktop">
      <div class="columns">
        <div class="column is-6-desktop">
          <div class="columns is-mobile countrytime">
            <div class="column is-2-mobile is-4-tablet">
              <div class="country"><span><?php echo $country ?></span></div>
            </div>
            <div class="column is-5-mobile is-8-desktop">
              <span class="time"><?php echo $time ?></span>
            </div>
            <div class="column is-4-mobile date is-visible-mobile is-hidden-tablet">
              <p class="mt-2 is-5"><?php echo $date[0]; echo "/"; echo $date[1] ?></p>
            </div>
          </div>
        </div>
        <div class="column is-hidden-mobile is-6-desktop host">
          <a href="#" class="name title is-5"><span><?php echo $host ?></span></a>
          <p><?php echo $city ?></p>
        </div>
      </div>
    </div>

    <!-- description / link column -->
    <div class="column is-7-desktop">
      <div class="columns">
        <div class="column is-5-desktop eventtitle">
          <p class="mt-1 title is-4"><?php echo $title ?></p>
          <?php
            foreach ($categories as $c) {
              echo '<span class="btn category">';
              echo $c->name;
              echo '</span>';
            }
          ?>
        </div>
        <div class="column is-visible-mobile is-hidden-tablet pl-2 host">
          <a href="#" class="name title is-5"><span><?php echo $host ?></span></a>
          <p class="city"><?php echo $city ?></p>

          <div class="mobile-language is-visible-mobile is-hidden-tablet">
            <p><?php echo $language ?></p>
          </div>
        </div>
        <div class="column is-5-desktop description">
          <p class="mt-1"><?php echo the_content(); ?></p>
        </div>
        <div class="column is-2 language is-hidden-mobile">
          <p><?php echo $language ?></p>
        </div>
      </div>
    </div>
  </div>

  <div class="url-banner">
    <!-- Content to go ere -->
  </div>

  <script type="text/javascript">
    $('.<?php the_ID(); ?>').on("click", function(e) {
      var banner = $(this).find(".url-banner");
      var marqueeId = "list-marquee" + <?php the_ID(); ?>;
      var marqueeEl;
      if(e.type == "click") {
        <?php if($isLive == true):?>banner.html('<a href="<?php echo $url ?>"><div id="list-marquee<?php the_ID(); ?>" class="marquee listing active"><span>*** Watch Now On<?php echo $source ?>&nbsp;</span></div></a>');<?php endif; ?>
        <?php if($isLive == false):?>banner.html('<a href="https://www.google.com/calendar/render<?php echo $calendarString ?>" target="_blank"><div id="list-marquee<?php the_ID(); ?>" class="marquee listing active"><span>*** Add to Calendar&nbsp;</span></div></a>');<?php endif; ?>
        banner.slideToggle(200);
        marqueeEl = new Marquee(marqueeId, { direction: 'ltr', speed: 0.1, offset: '400px' });
      }
    });

  </script>

</div>
<!-- END list item -->
