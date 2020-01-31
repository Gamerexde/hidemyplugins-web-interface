<?php
include 'config/database.php';
$mysql_connection = mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_database);
if ($mysql_connection->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else {

  error_reporting(0);
}
?>
