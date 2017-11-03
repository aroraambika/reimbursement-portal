<?php
require_once('config.php');
session_start();
if (isset($_SESSION["username"])) {

$deleteid = $_GET["deleteid"];

$sql = "DELETE FROM `cc_info` WHERE  `cc_id` = '" . $deleteid . "' ";

if (mysqli_query($con, $sql)) {
    echo "Cost center deleted successfully";
      header("refresh:1;url=viewcc.php");
} else {
    echo "Error deleting record: " . mysqli_error($con);
}

mysqli_close($con);

}else {
  echo "Please login first";
  header("refresh:1;url=login_admin.php");
}

?>
