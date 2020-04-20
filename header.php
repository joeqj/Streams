<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo bloginfo( 'name' ) ?></title>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css?v=<?=time();?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@500&family=Raleway&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
  </head>
  <body>

    <a class="search-btn" id="menu-toggle">Search</a>

    <!-- Pushy Menu -->
    <nav class="pushy pushy-left" data-menu-btn-class=".search-btn">
        <div class="pushy-content">
            <form class="menu-search" role="search" method="get" id="searchform" action="">
              <input type="text" name="s" id="searchfield" value="" placeholder="Search.......">
            </form>
            <div class="menu-categories">
              <a href="#" class="btn">Talk</a>
              <a href="#" class="btn">Workshop</a>
              <a href="#" class="btn">Screening</a>
              <a href="#" class="btn">Performance</a>
            </div>
            <div class="menu-tags">
              <?php

                $wpdb->show_errors();
                global $wpdb;

                $term_ids = $wpdb->get_col("
                  SELECT term_id FROM $wpdb->term_taxonomy
                  INNER JOIN $wpdb->term_relationships ON $wpdb->term_taxonomy.term_taxonomy_id=$wpdb->term_relationships.term_taxonomy_id
                  INNER JOIN $wpdb->posts ON $wpdb->posts.ID = $wpdb->term_relationships.object_id
                  WHERE DATE_SUB(CURDATE(), INTERVAL 30 DAY) <= $wpdb->posts.post_date");

                if(count($term_ids) > 0){
                    $tags = get_tags(array(
                      'orderby' => 'count',
                      'order'   => 'DESC',
                      'number'  => 16,
                      'include' => $term_ids,
                    ));

                  $i = 0;
                  foreach ( (array) $tags as $tag ) {
                    echo '<a href="' . get_tag_link ($tag->term_id) . '" class="float-'.($i%2 ? 'right':'left').'" rel="tag">' . "#" . $tag->name . '</a>';
                    echo ($i%2 ? '<div class="is-clearfix"></div>':'');
                    $i++;
                  }
                }
              ?>
            </div>
        </div>
    </nav>

    <!-- <div class="site-overlay"></div> -->

    <!-- Your Content -->
    <div id="container">
        <!-- Menu Button -->
