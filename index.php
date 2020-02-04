<?php
include 'config/settings.php';
error_reporting(0);

if (isset($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;

$conn = mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_database);

if (mysqli_connect_errno()){
} else {
}


if(isset($_post['sub'])) {
  $new_link = $_post['user'];

  echo '?user=' .$new_link;
}
$unsafe_getUser = isset($_GET['user']) ? $_GET['user'] : '';
$safe_variable = mysqli_real_escape_string($conn, $unsafe_getUser);

if ($unsafe_getUser == "") {
  $total_pages_sql = "SELECT * FROM `" .$mysql_sqltable.  "` ORDER BY `DATE` DESC";
  $result = mysqli_query($conn,$total_pages_sql);
  $total_rows = mysqli_fetch_array($result)[0];
  $total_pages = ceil($total_rows / $no_of_records_per_page);

  $sql = "SELECT * FROM `" .$mysql_sqltable.  "` ORDER BY `DATE` DESC LIMIT $offset,$no_of_records_per_page";
  $res_data = mysqli_query($conn,$sql);
} else {
  $total_pages_sql = "SELECT * FROM `" .$mysql_sqltable.  "` WHERE `USER` LIKE '" .$safe_variable. "'ORDER BY `DATE` DESC";
  $result = mysqli_query($conn,$total_pages_sql);
  $total_rows = mysqli_fetch_array($result)[0];
  $total_pages = ceil($total_rows / $no_of_records_per_page);

  $sql = "SELECT * FROM `" .$mysql_sqltable.  "` WHERE `USER` LIKE '" .$safe_variable. "' ORDER BY `DATE` DESC LIMIT $offset,$no_of_records_per_page";
  $res_data = mysqli_query($conn,$sql);
}

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

      <?php
      if (mysqli_connect_errno()) {
        $error = mysqli_connect_error();
      ?>
      <div class="container">
        <p class="spacer-1">.</p>
        <div class="alert alert-danger alert-dismissible fade <?php if (mysqli_connect_errno()){ echo "show"; }?>" role="alert">
          <strong>Damn son!</strong> We cannot connect to the MySQL Server: <strong><?php echo $error;?></strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
      <?php
      }
      ?>

      <?php
      if ($conn) {
      ?>
      <?php require_once './inc/notice.php'; print_notice();?>
      <div class="container">
          <p class="spacer-1">.</p>
          <a class="btn btn-info" href="<?php echo "?user=" .$unsafe_getUser. "&pageno=1";?>" role="button">First</a>
          <a class="btn btn-info" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?user=" .$unsafe_getUser. "&pageno=".($pageno - 1); } ?>">Prev</a>
          <a class="btn btn-info" role="button" href="<?php echo "?user=" .$unsafe_getUser. "&pageno=".($pageno + 1);?>">Next</a>
          <h6><strong>Page: <?php echo $pageno?></strong></h6>
      </div>

      <div class="container">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">User</th>
                <th scope="col">Skin</th>
                <th scope="col">UUID</th>
                <th scope="col">Executed Command</th>
                <th scope="col">Date</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php
                while($row = mysqli_fetch_array($res_data)){
                    echo "<tr>
                    <td>".$row["ID"]."</td>";
                    echo "<td>".$row["USER"]."</td>";
                    echo '<td><img src="https://minotar.net/helm/'.$row["USER"].'/50.png"style="width:50px;height:50px;"></td>';
                    echo "<td>".$row["UUID"]."</td>";
                    echo "<td>".$row["EXECUTED_COMMAND"]."</td>";
                    echo "<td>".$row["DATE"]."</td></tr>";
                 }
                 mysqli_close($conn);
                ?>
              </tr>
            </tbody>
          </table>
      </div>
      <?php
    } else {
      ?>
      <div class="container">
        <h2 class="text-center">You maybe set up your database the wrong way...</h2>
        <p class="text-center">Go to my <a href="https://github.com/Gamerexde/hidemyplugins-web-interface/wiki/Setup">github guide</a> to learn how to set up your database correctly.</p>
      </div>
      <?php
    }
      ?>

      <?php require_once './inc/footer.php'; print_footer();?>

    <script src="inc/js/jquery-3.2.1.slim.min.js"></script>
    <script src="inc/js/popper.js"></script>
    <script src="inc/js/bootstrap.min.js"></script>
    <script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
  </body>
</html>
