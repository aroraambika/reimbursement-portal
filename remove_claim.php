<?php
require_once('config.php');
session_start();
if (isset($_SESSION["username"])) {

$deleteid = $_GET["deleteid"];

$sql = "DELETE FROM  `claim_info` WHERE  `claimid` = '" . $deleteid . "' ";

if (mysqli_query($con, $sql)) {
    echo "Claim record deleted successfully";
      header("refresh:1;url=viewclaim.php");
} else {
    echo "Error deleting record: " . mysqli_error($con);
}

mysqli_close($con);

}else {
  echo "Please login first";
  header("refresh:1;url=login_admin.php");
}

?>
