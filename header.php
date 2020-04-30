<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo bloginfo( 'name' ) ?></title>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css?v=<?=time();?>">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/node_modules/@chenfengyuan/datepicker/dist/datepicker.min.css">
    <script src="//code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/jquery.marquee@1.5.0/jquery.marquee.min.js" type="text/javascript"></script>
    <?php wp_head(); ?>
  </head>
  <body>
