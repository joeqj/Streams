<?php get_header(); ?>

<?php $today = date('Y-m-d H:i', time() - 86400); ?>

<section id="main">
  <div id="upcoming-posts">
    <?php
      $query = new WP_Query(
        array(
          'posts_per_page' => 10,
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
