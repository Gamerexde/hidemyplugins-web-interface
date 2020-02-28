<?php
function table() {
  include './config/settings.php';
  include './inc/connection.php';

  if (isset($_GET['pageno'])) {
$pageno = $_GET['pageno'];
  } else {
$pageno = 1;
  }
  $no_of_records_per_page = 10;
  $offset = ($pageno-1) * $no_of_records_per_page;

  if(isset($_post['sub'])) {
$new_link = $_post['user'];
echo '?user=' .$new_link;
  }

  $unsafe_getUser = isset($_GET['user']) ? $_GET['user'] : '';
  $safe_variable = mysqli_real_escape_string($conn, $unsafe_getUser);

  include './inc/sql/query_search.php';

  if ($conn) {
?>
<?php require_once './inc/notice.php'; print_notice();?>
<div class="container">
<p class="spacer-1">.</p>
</div>
<div class="container">
  <div class="row">
<div class="col-sm">
  <a class="btn btn-info" href="<?php echo "?user=" .$unsafe_getUser. "&pageno=1";?>" role="button">First</a>
  <a class="btn btn-info" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?user=" .$unsafe_getUser. "&pageno=".($pageno - 1); } ?>">Prev</a>
  <a class="btn btn-info" role="button" href="<?php echo "?user=" .$unsafe_getUser. "&pageno=".($pageno + 1);?>">Next</a>
</div>
<div class="col-sm">
  <h1 class="text-center">Page: <strong><?php echo $pageno?></strong></h1>
</div>
<div class="col-sm">
  <div class="input-group mb-3">
<form class="form-inline">
  <input type="text" class="form-control" placeholder="Search Username" name="user" aria-describedby="button-addon2">
  <div class="input-group-append">
<button class="btn btn-outline-primary" type="submit" name="sub">Search</button>
  </div>
</form>
  </div>
</div>
  </div>
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
  echo '<td><a class="btn btn-primary" href="profile.php?id=' .$row["ID"].'" role="button">'.$row["USER"].'</a></td>';
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
  require_once './inc/errors.php';
  mysql_connection_exeption();
}
?>
<?php
}
?>
