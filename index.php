<?php
    $host = "localhost";
    $user = "user";
    $password = "123";
    $database = "hidemyplugins";
    $sqltable = "hmp";

    $obj_conexion = 
    mysqli_connect($host,$user,$password,$database);

    if(isset($_post['sub'])) {
      function Redirect($new_link, $statusCode = 303) {
        $new_link = $_post['user'];
        header('Location: ?user=' .$new_link, true, $statusCode);
        die();
      }
    }

    $getUser = isset($_GET['user']) ? $_GET['user'] : '';
    if ($getUser == "") {
      $query_result = $obj_conexion->query("SELECT * FROM `" .$sqltable.  "` ORDER BY `DATE` ASC");
    } else {
      $query_result = $obj_conexion->query("SELECT * FROM `" .$sqltable.  "` WHERE `USER` LIKE '" .$getUser. "' ORDER BY `DATE` ASC");
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

    <link rel="stylesheet" href="inc/css/bootstrap-material-design.min.css">

    <link rel="stylesheet" href="inc/css/styles.css">

    <title>HideMyPlugins Web Interface</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">HideMyPlugins Web</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
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

      <div class="container">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">User</th>
                <th scope="col">UUID</th>
                <th scope="col">Executed Command</th>
                <th scope="col">Date</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php
                while ($var_table=$query_result->fetch_array()) {
                    echo "<tr>
                    <td>".$var_table["ID"]."</td>";
                    echo "<td>".$var_table["USER"]."</td>";
                    echo "<td>".$var_table["UUID"]."</td>";
                    echo "<td>".$var_table["EXECUTED_COMMAND"]."</td>";
                    echo "<td>".$var_table["DATE"]."</td></tr>";
                 }
                ?>
              </tr>
            </tbody>
          </table>
      </div>

    <script src="inc/js/jquery-3.2.1.slim.min.js"></script>
    <script src="inc/js/popper.js"></script>
    <script src="inc/js/bootstrap-material-design.js"></script>
    <script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>
  </body>
</html>