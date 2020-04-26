<?php

if ( have_posts() ) :
while ( have_posts() ) : the_post();
    set_query_var("post-class", "reveal");
    get_template_part( 'template-parts/items', 'search' );
  endwhile;
else :
  ?>
    <div class="search-error">
      <p class="title">Sorry no upcoming streams!</p>
    </div>
  <?php
endif;

?>
