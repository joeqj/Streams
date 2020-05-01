<div class="js-listing-form">
  <div class="container">
    <div class="form-wrap">
      <form name="listing-form" action="<?php echo get_template_directory_uri(); ?>/createListing.php" method="post">
        <div class="columns">
          <div class="column is-3">
            <input type="text" name="event_host" placeholder="Host" maxlength="40" required>
            <input type="text" name="event_email" placeholder="Your Email" required>
            <input type="text" name="event_loc_c" id="gLoc" maxlength="30">
            <input type="hidden" name="event_country">
            <input type="hidden" name="event_city">
          </div>
          <div class="column is-5">
            <input type="text" name="event_name" placeholder="Event Name" maxlength="70">
            <div class="columns is-mobile datetimecol">
              <div class="column is-3">
                <input type="text" class="timepicker" placeholder="12:00" name="frontend_time" autocomplete="off">
                <input type="hidden" name="event_time" value="">
              </div>
              <div class="column is-4">
                <input type="text" class="datepicker" name="frontend_date" placeholder="<?php echo date("d/m/Y"); ?>" autocomplete="off">
                <input type="hidden" name="event_date" value="">
                <input type="hidden" name="event_timestamp" id="timestamp-h" value="">
              </div>
              <div class="column is-5">
                <select name="event_type">
                  <option value="" disabled selected hidden>Event Type</option>
                  <option value="talk">Talk</option>
                  <option value="workshop">Workshop</option>
                  <option value="screening">Screening</option>
                </select>
              </div>
            </div>
            <input type="text" name="event_url" placeholder="Stream URL / Event page" autocomplete="off" required>
            <input type="text" name="event_language" placeholder="Event Language" required>
          </div>
          <div class="column is-4">
            <textarea name="event_description" rows="6" maxlength="260" placeholder="Tell us about your event"></textarea>
            <div class="input-field">
              Please leave this blank
              <input type="text" name="contact" value="" />
            </div>
            <div class="text-field">
              Please do not change this field
              <input type="text" name="email" value="your@email.com" />
            </div>
            <button type="submit">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
