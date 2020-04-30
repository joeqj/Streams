<div class="js-search">
  <div class="container">
    <div class="columns is-centered">
      <div class="column is-6">
        <form class="menu-search" role="search" method="get" id="searchform" action="">
          <input type="text" name="s" id="searchfield" value="" placeholder="Search......." autocomplete="off">
          <span>x</span>
        </form>
        <div class="menu-categories">
          <?php
            $categories = get_categories(array (
              'orderby' => 'name'
            ));
            foreach ( $categories as $category ) {
              printf( '<a href="%1$s" class="btn category cat-filter">%2$s</a>',
                  esc_html($category->name),
                  esc_html($category->name)
              );
            }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
