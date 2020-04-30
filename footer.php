<div class="bottom-bar">

  <div id="main-marquee" class="marquee main">
    <span> *** Todays Supply *** World Lockdown Livestreams&nbsp;</span>
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
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/dateformat.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/lib/main.js?=<?=time();?>"></script>
<script type="text/javascript">
  $(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
      loadMoreStreams("<?php date('Ymd') ?>", "<?php echo admin_url('admin-ajax.php') ?>");
    }
  });
</script>
</body>
</html>
