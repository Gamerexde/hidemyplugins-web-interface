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
  <div class="row">
    <div class="col-md-4">
    <img src="<?php echo "https://minotar.net/armor/body/".$user."/200.png" ?>">
    </div>

    <div class="col-md-6">
      <h1><?php echo $user; ?> <span class="badge badge-danger"><?php echo $executed_command?></span></h1>
      <div class="nav-custom">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">User</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Command Used</a>
          </li>
        </ul>
      </div>
      <div class="tab-content profile-tab" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <div class="row">
            <div class="col-md-6">
              <label>Name</label>
            </div>
            <div class="col-md-6">
              <h6><strong><?php echo $user?></strong></h6>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label>UUID</label>
            </div>
            <div class="col-md-6">
              <h6><strong><?php echo $uuid?></strong></h6>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label>NameMC</label>
            </div>
            <div class="col-md-6">
              <h6><a href="http://mine.ly/<?php echo $user?>.2"><strong>http://mine.ly/<?php echo $user?>.2</strong></a></h6>
            </div>
          </div>
        </div>
        <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <div class="row">
            <div class="col-md-6">
              <label>Executed Command</label>
            </div>
            <div class="col-md-6">
              <h6><strong><?php echo $executed_command?></strong></h6>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label>DATE</label>
            </div>
            <div class="col-md-6">
              <h6><strong><?php echo $date?></strong></h6>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label>ID</label>
            </div>
            <div class="col-md-6">
              <h6><strong><?php echo $id?></strong></h6>
            </div>
          </div>
        </div>
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
