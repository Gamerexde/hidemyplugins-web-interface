<?php
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
