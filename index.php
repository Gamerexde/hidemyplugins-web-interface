<?php
include './config/settings.php';
include './inc/connection.php';
error_reporting(0);
?>

<!doctype html>
<html lang="en">
  <head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
<link rel="stylesheet" href="inc/css/bootstrap.min.css">
<link rel="stylesheet" href="inc/css/styles.css">

<title><?php echo $web_name?></title>
  </head>
  <body>
  <?php require_once './inc/navbar.php'; print_navbar();?>

  <div class="container">
  <p class="spacer-1">.</p>
  </div>

  <?php require_once './inc/errors.php'; error();?>
  <?php require_once './inc/tables.php'; table();?>
  <?php require_once './inc/footer.php'; print_footer();?>

<script src="inc/js/jquery-3.2.1.slim.min.js"></script>
<script src="inc/js/popper.js"></script>
<script src="inc/js/bootstrap.min.js"></script>
  </body>
</html>
