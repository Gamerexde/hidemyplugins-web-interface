<?php
function error(){
  include './config/settings.php';
  include './inc/connection.php';
  

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
}

function mysql_connection_exeption(){
?>
<div class="container">
  <h2 class="text-center">You maybe set up your database the wrong way...</h2>
  <p class="text-center">Go to my <a href="https://github.com/Gamerexde/hidemyplugins-web-interface/wiki/Setup">github guide</a> to learn how to set up your database correctly.</p>
</div>
<?php
}
?>
