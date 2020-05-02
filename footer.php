<div class="bottom-bar">

  <div id="main-marquee" class="marquee main">
    <span>*** Todays Supply *** World Lockdown Livestreams</span>
  </div>

  <?php get_template_part( 'template-parts/form', 'listing' ); ?>
  <?php get_template_part( 'template-parts/info' ); ?>
  <?php get_template_part( 'template-parts/form', 'search' ); ?>

  <div class="columns navigation is-mobile">
    <div class="column is-6-mobile is-8-desktop parent">
      <div class="columns">
        <div class="column is-4-desktop">
          <p id="js-open-create-listing">
            (+) Online Event
          </p>
        </div>
        <div class="column is-8 is-hidden-mobile">
          <div class="marquee navigation active">
            <!-- Content goes ere -->
          </div>
        </div>
      </div>
    </div>
    <div class="column is-3-mobile is-2-desktop">
      <p id="js-open-info">
        Info
      </p>
    </div>
    <div class="column is-3-mobile is-2-desktop">
      <p id="js-open-search">Search</p>
    </div>
  </div>
</div>

<?php wp_footer(); ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/node_modules/jquery-timepicker/jquery.timepicker.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/node_modules/@chenfengyuan/datepicker/dist/datepicker.min.js"></script>
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDrdLG5bzCHkIkIfkGfva3M2-i0OBOFlkQ"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/lib/main.js?=<?=time();?>"></script>
<script type="text/javascript">
  $(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
      loadMoreStreams("<?php date('Y-m-d') ?>", "<?php echo admin_url('admin-ajax.php') ?>");
    }
    setTimeout(function() {
      if($(window).scrollTop() < 150) {
        loadLessStreams("<?php date('Y-m-d H:i', time() - 86400) ?>", "<?php echo admin_url('admin-ajax.php') ?>");
      }
    }, 2500);
  });
</script>
</body>
</html>
