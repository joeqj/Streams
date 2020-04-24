<div class="bottom-bar">

  <!-- START Marquee -->
  <div class="marquee main active">
    <div class="left">
      <span> *** Todays Supply *** World Lockdown Livestreams&nbsp;</span>
    </div>
    <div class="right">
      <span> *** Todays Supply *** World Lockdown Livestreams&nbsp;</span>
    </div>
  </div>

  <!-- START Listing Form -->
  <?php get_template_part( 'template-parts/form', 'listing' ); ?>

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
          <div class="marquee navigation active">
            <!-- Content to go here -->
          </div>
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
<script src="//code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/node_modules/jquery-timepicker/jquery.timepicker.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/node_modules/@chenfengyuan/datepicker/dist/datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/dateformat.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/lib/main.js?=<?=time();?>"></script>
</body>
</html>
