<?php
include './config/settings.php';
include './inc/connection.php';

$getID = isset($_GET['id']) ? $_GET['id'] : '';

$secureGetID = mysqli_real_escape_string($conn, $getID);

$query = "SELECT * FROM `hmp` WHERE `ID` LIKE '$secureGetID' ORDER BY `DATE` DESC";
$result = mysqli_query($conn,$query);

while($row = mysqli_fetch_array($result)){
  $user = $row['USER'];
  $uuid = $row['UUID'];
  $id = $row['ID'];

  $executed_command = $row['EXECUTED_COMMAND'];
  $date = $row['DATE'];
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
        <p class="spacer-1">.</p>
    </div>

    <?php
    if ($id == $getID) {
    ?>

    <div class="container">
      <h1><?php echo $user; ?></h1>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm">
          <img src="<?php echo "https://minotar.net/armor/body/".$user."/200.png" ?>">
        </div>
        <div class="col-sm">
          <div class="card" style="width: 18rem;">
            <div class="card-header">
              General Info
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Executed Command: <strong><?php echo $executed_command?></strong></li>
              <li class="list-group-item">DATE: <strong><?php echo $date?></strong></li>
              <li class="list-group-item">ID: <strong><?php echo $id?></strong></li>
            </ul>
          </div>
        </div>
        </div>
        <div class="col-sm">
          <p class="spacer-1">.</p>
          <div class="card" style="width: 18rem;">
            <div class="card-header">
              User Info
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Name: <strong><?php echo $user?></strong></li>
              <li class="list-group-item">UUID: <strong><?php echo $uuid?></strong></li>
              <li class="list-group-item">NameMC: <a href="http://mine.ly/<?php echo $user?>.2"><strong>http://mine.ly/<?php echo $user?>.2</strong></li>
            </ul>
          </div>
        </div>
    </div>
  </div>
  <?php
  } else {
  ?>

  <div class="container">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Damn son!</strong> The ID you enter is invalid or dosen't exist...</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>

  <?php
  }
  ?>
    <?php require_once './inc/footer.php'; print_footer();?>
    <script src="inc/js/jquery-3.2.1.slim.min.js"></script>
    <script src="inc/js/popper.js"></script>
    <script src="inc/js/bootstrap.min.js"></script>
  </body>
</html>
