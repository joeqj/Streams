</div>

<div class="form-bar">
  <div class="container">
    <form id="create_listing" class="create_listing" method="post" action="">
      <div class="columns m-0">
        <div class="column is-11-desktop">
          <div class="columns is-mobile">
            <div class="column is-4">
              <div class="columns">
                <div class="column is-4 is-hidden-mobile">
                  <a href="#" id="js-expand">+</a>
                </div>
                <div class="column is-6 is-offset-2-desktop pl-0">
                  <input type="text" class="form-bar-user" name="user_name" placeholder="User Name" autocomplete="off" required>
                </div>
              </div>

            </div>
            <div class="column">
              <div class="columns">
                <div class="column is-9-desktop is-offset-3-desktop">
                  <input type="text" name="user_email" placeholder="Email" autocomplete="off" required>
                </div>
              </div>
            </div>
            <div class="column">
              <input type="text" name="stream_url" placeholder="Stream URL" autocomplete="off" required>
            </div>
          </div>
        </div>
      </div>
      <div class="js-hidden-form">
        <div class="columns">
          <div class="column is-11-desktop">
            <div class="columns">
              <div class="column is-4 is-offset-2-desktop">
                <input type="text" name="stream_title" placeholder="Stream Title" required>
                <input type="datetime-local" name="stream_datetime" placeholder="Stream Date" required>
                <input type="text" name="stream_language" placeholder="Stream Country" required>
                <input type="text" name="tags" placeholder="Tags">
              </div>
              <div class="column">
                <textarea name="description" rows="8" cols="80" placeholder="Description (Optional - this will help get your stream approved quicker!)"></textarea>
              <div class="column">
                <button type="submit" class="btn btn-dark" name="button">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<?php wp_footer(); ?>
<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/pushy.min.js"></script>
<script src="https://kit.fontawesome.com/918d6a503e.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/lib/main.js?=<?=time();?>"></script>
</body>
</html>
