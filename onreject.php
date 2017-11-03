<?php
require_once("config.php");
session_start();
if (isset($_SESSION["emailid"]) && isset($_SESSION["claimid"]) && isset($_SESSION["eid"]) && isset($_SESSION["cc"])) {
    //update the claim tracker
    $cid      = $_SESSION["claimid"];
    $eid      = $_SESSION["eid"];
    $upd_date = date("Y-m-d");
    $status   = 'rejected';
    $sql      = "UPDATE `claim_tracker` SET `status`='$status',`updated_date`='$upd_date' WHERE `claimid`='$cid' AND `appid`='$eid'";
    if (mysqli_query($con, $sql)) {
        echo "Record rejected successfully";
?><script>alert("Record is rejected successfully");</script><?php
          header("refresh:1;url=welcome_emp.php");
    } else {
        echo "Error updating record: " . $sql . "<br>" . mysqli_error($con);
    }


    //updating the claim info status


    $sql_upd_claim = "UPDATE `claim_info` SET `pending_with`='null',`final_status`='rejected' WHERE `claimid`='$cid'";

    if (mysqli_query($con, $sql_upd_claim)) {
        echo "Record updated successfully in claim_info";

    } else {
        echo "Error updating record: " . $sql_upd_claim . "<br>" . mysqli_error($con);
    }



} else {
    echo "Please login first";
    header("refresh:1;url=login_emp.php");
}


?>
