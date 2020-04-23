<div class="bottom-bar">

  <!-- START Marquee -->
  <div class="marquee">
    <div class="left">
      <span> *** Todays Supply *** World Lockdown Livestreams Son!&nbsp;</span>
    </div>
    <div class="right">
      <span> *** Todays Supply *** World Lockdown Livestreams Son!&nbsp;</span>
    </div>
  </div>

  <!-- START Listing Form -->
  <div class="js-listing-form">
    <div class="container">
      <div class="columns">
        <div class="column is-3">
          <input type="text" class="form-bar-user" name="user_name" placeholder="Host" autocomplete="off" required>
          <input type="text" name="user_email" placeholder="Your Email" autocomplete="off" required>
          <input type="text" name="event_city" placeholder="City">
          <input type="text" name="event_country" placeholder="Country">
        </div>
        <div class="column is-5">
          <input type="text" name="stream_title" placeholder="Event Name" required>
          <div class="columns datetimecol">
            <div class="column is-3">
              <input type="text" name="time" placeholder="19 : 00">
            </div>
            <div class="column is-4">
              <input type="text" name="event_datetime" placeholder="11/05/<?php echo date("Y"); ?>" required>
            </div>
            <div class="column is-5">
              <input type="text" name="" placeholder="Event Type">
            </div>
          </div>
          <input type="text" name="stream_url" placeholder="Stream URL" autocomplete="off" required>
          <input type="text" name="stream_language" placeholder="Event Language" required>
        </div>
        <div class="column is-4">
          <textarea name="description" rows="6" placeholder="Tell us about your event"></textarea>
          <button type="submit">Submit</button>
        </div>
      </div>
    </div>
  </div>

  <!-- START Search -->
  <div class="js-search">
    <div class="container">
      <form class="menu-search" role="search" method="get" id="searchform" action="">
        <input type="text" name="s" id="searchfield" value="" placeholder="Search.......">
      </form>
      <div class="menu-categories">
        <a href="#" class="btn">Talk</a>
        <a href="#" class="btn">Workshop</a>
        <a href="#" class="btn">Screening</a>
        <a href="#" class="btn">Performance</a>
      </div>
    </div>
  </div>

  <!-- START Navigation -->
  <div class="columns navigation">
    <div class="column is-8">
      <div class="columns">
        <div class="column is-4">
          <p id="create-listing">
            (+) Online Event
          </p>
        </div>
        <div class="column is-8">

        </div>
      </div>
    </div>
    <div class="column is-2">
      <p>
        Info
      </p>
    </div>
    <div class="column is-2">
      <p>
        Search
      </p>
    </div>
  </div>
</div>

<?php wp_footer(); ?>
<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/918d6a503e.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/lib/main.js?=<?=time();?>"></script>
</body>
</html>
