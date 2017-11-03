<?php
require_once("config.php");
session_start();
if (isset($_SESSION["emailid"]) && isset($_SESSION["claimid"]) && isset($_SESSION["eid"]) && isset($_SESSION["cc"])) {
    //update the claim tracker
    $cid      = $_SESSION["claimid"];
    $eid      = $_SESSION["eid"];
    $upd_date = date("Y-m-d");
    $status   = 'approved';
    $sql      = "UPDATE `claim_tracker` SET `status`='$status',`updated_date`='$upd_date' WHERE `claimid`='$cid' AND `appid`='$eid'";
    if (mysqli_query($con, $sql)) {
        echo "Record approved successfully";
        ?><script>alert("Record is approved");</script><?php
              header("refresh:1;url=welcome_emp.php");
    } else {
        echo "Error updating record: " . $sql . "<br>" . mysqli_error($con);
    }


    //updating the claim info with next APPROVAL
    $cc_name = $_SESSION["cc"];

    $sql_get_cc = "SELECT `cc_id`, `cc_name`, `appr1`, `appr2`, `appr3`, `doc` FROM `cc_info` WHERE `cc_name`='$cc_name'";
    $result     = mysqli_query($con, $sql_get_cc);

    if (mysqli_num_rows($result) > 0) {

        $row   = mysqli_fetch_assoc($result);
        $appr1 = $row["appr1"];
        $appr2 = $row["appr2"];
        $appr3 = $row["appr3"];

        if ($appr1 == $eid) {
            $pending_with  = $appr2;
            $sql_upd_claim = "UPDATE `claim_info` SET `pending_with`='$pending_with' WHERE `claimid`='$cid'";

        } else if ($appr2 == $eid) {
            $pending_with  = $appr3;
            $sql_upd_claim = "UPDATE `claim_info` SET `pending_with`='$pending_with' WHERE `claimid`='$cid'";

        } else if ($appr3 == $eid || $appr2 == ' ' || $appr3 == ' ') {
            $sql_upd_claim = "UPDATE `claim_info` SET `pending_with`='null',`final_status`='paid and closed' WHERE `claimid`='$cid'";
        } else {
            echo "Not able to make a query for claim_info";
        }
        if (mysqli_query($con, $sql_upd_claim)) {
            echo "Record updated successfully in claim_info";

        } else {
            echo "Error updating record: " . $sql_upd_claim . "<br>" . mysqli_error($con);
        }

    } else {
        echo "string";
    }



    //inserting record into claim tracker for next approver
    $k = substr("clt" . md5(uniqid(rand(), true)), 0, 7);
    $c = 'pending';


    if (($appr1 == $eid) || ($appr2 == $eid)) {
        $sql_upd_clm_trker = "INSERT INTO `claim_tracker`(`id`, `claimid`, `appid`, `status`, `updated_date`) VALUES ('$k','$cid','$pending_with','$c','$upd_date')";
        echo $sql_upd_clm_trker;
        if (mysqli_query($con, $sql_upd_clm_trker)) {
            echo "Record in claim tracker is inserted successfully";
        } else {
            echo "Record in claim tracker is not inserted";
        }
    }
    mysqli_close($con);

} else {
    echo "Please login first";
    header("refresh:1;url=login_emp.php");
}


?>
