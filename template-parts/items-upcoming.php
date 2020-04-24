<?php

$today = date('Ymd');

// get variables
$title = get_the_title();
$host = get_post_meta(get_the_ID(), 'event_host', true);
$city = get_post_meta(get_the_ID(), 'event_city', true);
$country = get_post_meta(get_the_ID(), 'event_country', true);

$url = get_post_meta(get_the_ID(), 'event_url', true);

if (strpos($url,'https://') === false){
    $url = '//'.$url;
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

$time = preg_replace("/[^0-9:]/", "", $meta_time);
$date = explode("/", $meta_date);

$timestamp = $date[2] . "/" . $date[1] . "/" . $date[0] . " ";

$uid = $date[2] . $date[1] . $date[0]

?>

<!-- START list item -->
<div id="list-item" class="<?php echo $uid ?><?php if(date("d", strtotime($timestamp)) == date("d", strtotime($today))):?> is-live<?php endif; ?>">
  <div class="columns">
    <!-- date / title column -->
    <div class="column is-1-desktop is-hidden-mobile date">
      <p class="mt-1 is-5"><?php echo $date[0]; echo "/"; echo $date[1] ?></p>
    </div>
    <!-- language / time column -->
    <div class="column is-4-desktop">
      <div class="columns">
        <div class="column is-6-desktop">
          <div class="columns is-mobile">
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
        <div class="column is-hidden-mobile is-6-desktop pt-1 host">
          <a href="#" class="name title is-5"><span><?php echo $host ?></span></a>
          <p><?php echo $city ?></p>
        </div>
      </div>
    </div>

    <!-- description / link column -->
    <div class="column is-7-desktop">
      <div class="columns">
        <div class="column is-4-desktop">
          <p class="mt-1 title is-4"><?php echo $title ?></p>
        </div>
        <div class="column is-visible-mobile is-hidden-tablet host">
          <a href="#" class="name title is-5"><span><?php echo $host ?></span></a>
          <p class="city"><?php echo $city ?></p>

          <div class="mobile-language is-visible-mobile is-hidden-tablet">
            <p><?php echo $language ?></p>
          </div>
        </div>
        <div class="column is-6-desktop description">
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
    $('.<?php echo $uid ?>').on("mouseenter mouseleave", function(e) {
      var banner = $(this).find(".url-banner");
      var marqueeId = "list-marquee" + <?php echo $uid ?>;
      var marqueeEl;
      if(e.type == "mouseenter") {
        banner.html('<div id="list-marquee<?php echo $uid ?>" class="marquee listing active"><span>*** Watch Now On<?php echo $source ?>&nbsp;</span></div>');
        banner.slideDown(200);
        marqueeEl = new Marquee(marqueeId, { direction: 'ltr', speed: 0.2, offset: '400px' });
      } else {
        banner.slideUp(200, function() {
          banner.html("");
        });
        marqueeEl = null;
      }
    });
    $('.<?php echo $uid ?>').on("click", function() {
      window.open("<?php echo $url ?>", '_blank');
    })
  </script>

</div>
<!-- END list item -->
