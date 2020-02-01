<?php
include 'config/settings.php';

if (isset($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;

$conn=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_database);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else {
  error_reporting(0);
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
  // $query_result = $mysql_connection->query("SELECT * FROM `" .$mysql_sqltable.  "` ORDER BY `DATE` ASC");
} else {
  $total_pages_sql = "SELECT * FROM `" .$mysql_sqltable.  "` WHERE `USER` LIKE '" .$safe_variable. "'ORDER BY `DATE` DESC";
  $result = mysqli_query($conn,$total_pages_sql);
  $total_rows = mysqli_fetch_array($result)[0];
  $total_pages = ceil($total_rows / $no_of_records_per_page);

  $sql = "SELECT * FROM `" .$mysql_sqltable.  "` WHERE `USER` LIKE '" .$safe_variable. "' ORDER BY `DATE` DESC LIMIT $offset,$no_of_records_per_page";
  $res_data = mysqli_query($conn,$sql);
  // $query_result = $mysql_connection->query("SELECT * FROM `" .$mysql_sqltable.  "` WHERE `USER` LIKE '" .$safe_variable. "' ORDER BY `DATE` ASC");
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
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
        <a class="navbar-brand" href="<?php echo $web_url?>"><?php echo $web_name?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link active" href="index.php">Home<span class="sr-only">(current)</span></a>
          </div>
        </div>
        <form class="form-inline">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" name="user" aria-label="Search">
          <button class="btn btn-outline-light my-2 my-sm-0" type="submit" name="sub">Search</button>
        </form>
    </nav>

      <div class="container">
          <p class="spacer-1">.</p>
      </div>

      <ul class="pagination">
          <li><a href="?pageno=1">First</a></li>
          <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
              <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?user=" .$unsafe_getUser. "&pageno=".($pageno - 1); } ?>">Prev</a>
          </li>
          <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
              <a href="<?php if($pageno <= $total_pages){ echo '#'; } else { echo "?user=" .$unsafe_getUser. "&pageno=".($pageno + 1); } ?>">Next</a>
          </li>
          <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
      </ul>

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

      <footer class="fixed-bottom footer">
            <div class="container">
              <span class="text-muted"><?php echo $web_footer?></span>
            </div>
      </footer>

    <script src="inc/js/jquery-3.2.1.slim.min.js"></script>
    <script src="inc/js/popper.js"></script>
    <script src="inc/js/bootstrap.min.js"></script>
    <script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
  </body>
</html>
