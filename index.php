<?php get_header(); ?>

<?php

$today = date('Ymd H:i', time() - 3600);
$atoday = date('Ymd H:i', time() - 7200);

?>

<section id="main">
  <div id="archive">
    <?php
      $query = new WP_Query(
        array(
          'posts_per_page' => 2,
          'post_status' => 'publish',
          'meta_key' => 'event_timestamp',
          'order' => 'DESC',
          'meta_query' => array(
              array(
                  'key' => 'event_timestamp',
                  'value' => $atoday,
                  'compare' => '<='
              )
           )
         )
      );
      // REVERSE POST ORDER
      // $array_rev = array_reverse($query->posts);
      // $query->posts = $array_rev;

      if ( $query->have_posts() ) :

        while ( $query->have_posts() ) : $query->the_post();
          set_query_var("post-class", "reveal");
          get_template_part( 'template-parts/items', 'archive' );
        endwhile;

      else :

        echo '<div class="no-archive"></div>';

      endif;

      wp_reset_postdata();
    ?>
  </div>
  <div id="upcoming-posts">
    <?php
      $query = new WP_Query(
        array(
          'posts_per_page' => 5,
          'post_status' => 'publish',
          'meta_key' => 'event_timestamp',
          'order' => 'ASC',
          'meta_query' => array(
              'relation' => 'AND',
              'date_query' => array(
                  'key' => 'event_timestamp',
                  'value' => $today,
                  'compare' => '>='
              ),
              'time_query' => array(
                  'key' => 'event_time'
              ),
          ),
          'orderby' => array(
              'date_query' => 'ASC',
              'time_query' => 'ASC',
          ),
         )
      );

      if ( $query->have_posts() ) :

        echo '<div class="page-limit" data-page="/">';

          while ( $query->have_posts() ) : $query->the_post();
            set_query_var("post-class", "reveal");
            get_template_part( 'template-parts/items', 'upcoming' );
          endwhile;

        echo '</div>';

      endif;

      wp_reset_postdata();
    ?>
  </div>
</section>

<?php get_footer(); ?>
