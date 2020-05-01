<?php
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

$newDate = str_replace('/', '-', $meta_date );
$date = date("d M", strtotime($newDate));

$categories = get_the_category();

$calendarDate = explode(" ", $timestamp);
$calendarTime = preg_replace("/[: ]/", "", $calendarDate[1]);
$calendarString = '?action=TEMPLATE&text='.$title.'&dates='.$calendarDate[0].'T'.$calendarTime.'00/'.$calendarDate[0].'T'.$calendarTime.'00&ctz=London/England&details='.$url.'&location='.$city.', '.$country.'&trp=false&sprop=&sprop=name:';

?>

<div id="list-item" class="<?php the_ID(); ?> <?php echo get_query_var("post-class") ?>">
  <div class="columns">
    <!-- date / title column -->
    <div class="column is-1 is-hidden-mobile date">
      <p class="mt-1 is-5"><span id="js-date-<?php the_ID(); ?>"></span></p>
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
              <span class="time" id="js-time-<?php the_ID(); ?>"></span>
            </div>
            <div class="column is-4-mobile date is-visible-mobile is-hidden-tablet">
              <p class="mt-2 is-5"><?php echo $date[0]; echo "/"; echo $date[1] ?></p>
            </div>
          </div>
        </div>
        <div class="column is-hidden-mobile is-6-desktop host">
          <p class="name title is-5"><?php echo $host ?></p>
          <p><?php echo $city ?></p>
        </div>
      </div>
    </div>

    <!-- description / link column -->
    <div class="column is-7-desktop">
      <div class="columns">
        <div class="column is-5-desktop eventtitle">
          <p class="mt-1 title is-4"><span><?php echo $title ?></span></p>
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
    <div id="list-marquee<?php the_ID(); ?>" class="marquee listing active">

    </div>
  </div>

  <script type="text/javascript">
    var timestamp<?php the_ID(); ?> = "<?php echo $timestamp ?>";
    var local<?php the_ID(); ?> = moment.utc(timestamp<?php the_ID(); ?>).local().format('YYYY-MM-DD HH:mm');
    var d<?php the_ID(); ?> = new Date(local<?php the_ID(); ?>);
    var date<?php the_ID(); ?> = moment(d<?php the_ID(); ?>).format("DD-MMM");

    var s<?php the_ID(); ?> = d<?php the_ID(); ?>.toLocaleTimeString();
    var t<?php the_ID(); ?> = s<?php the_ID(); ?>.split(":");
    var time<?php the_ID(); ?> = t<?php the_ID(); ?>[0] + ":" + t<?php the_ID(); ?>[1];

    $("#js-date-<?php the_ID(); ?>").html(date<?php the_ID(); ?>);
    $("#js-time-<?php the_ID(); ?>").html(time<?php the_ID(); ?>);

    var localDate<?php the_ID(); ?> = new moment().format("YYYY-MM-DD HH");
    var serverDate<?php the_ID(); ?> = new moment(local<?php the_ID(); ?>).format("YYYY-MM-DD HH");

    if (localDate<?php the_ID(); ?> == serverDate<?php the_ID(); ?>) {
      $("#list-item.<?php the_ID(); ?>").addClass("is-live");
    }
    if (localDate<?php the_ID(); ?> > serverDate<?php the_ID(); ?>) {
      $("#list-item.<?php the_ID(); ?>").addClass("archive");
    }

    $('.<?php the_ID(); ?>').on("click", function(e) {
      e.preventDefault();
      var that = $(this);
      var banner = $(this).find(".url-banner");
      var marquee = $("#list-marquee<?php the_ID(); ?>");
      if (!banner.hasClass("open")) {
        banner.addClass("open");
        if (that.hasClass("is-live")) {
          marquee.html('<a href="<?php echo $url ?>"><span>*** Watch Now On<?php echo $source ?>&nbsp;</span></a><a href="<?php echo $url ?>"><span>*** Watch Now On<?php echo $source ?>&nbsp;</span></a>');
        } else if (that.hasClass("archive")) {
          marquee.html('<a href="<?php echo $url ?>"><span>*** Watch Now On<?php echo $source ?>&nbsp;</span></a><a href="<?php echo $url ?>"><span>*** Watch Now On<?php echo $source ?>&nbsp;</span></a>');
        } else {
          marquee.html('<a href="https://www.google.com/calendar/render<?php echo $calendarString ?>" target="_blank"><span>*** Add to Calendar&nbsp;</span></a><a href="https://www.google.com/calendar/render<?php echo $calendarString ?>" target="_blank"><span>*** Add to Calendar&nbsp;</span></a>');
        }
        banner.slideDown(200);
        $(marquee).marquee({
          duration: 40000,
          gap: 0,
          delayBeforeStart: 0,
          direction: 'right',
          duplicated: true,
          startVisible: true
        });
      } else {
        banner.removeClass("open");
        banner.slideUp(200);
        $(marquee).marquee("DESTROY");
      }

    });

  </script>

</div>
<!-- END list item -->
