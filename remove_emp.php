<?php
require_once('config.php');
session_start();
if (isset($_SESSION["username"])) {

$deleteid = $_GET["deleteid"];

$sql = "DELETE FROM `emp_info` WHERE  `eid` = '" . $deleteid . "' ";

if (mysqli_query($con, $sql)) {
    echo "Employee record deleted successfully";
      header("refresh:1;url=viewemp.php");
} else {
    echo "Error deleting record: " . mysqli_error($con);
}

mysqli_close($con);

}else {
  echo "Please login first";
  header("refresh:1;url=login_admin.php");
}

?>
