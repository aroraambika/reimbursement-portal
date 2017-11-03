<?php
require_once("config.php");
session_start();
$updateid = $_GET["updateid"];

if (isset($_SESSION["username"])) {

    $sql_fr_cc    = "SELECT `cc_id`, `cc_name`, `appr1`, `appr2`, `appr3`, `doc` FROM `cc_info` WHERE `cc_id`='$updateid'";
    $result_fr_cc = mysqli_query($con, $sql_fr_cc);
    if (mysqli_num_rows($result_fr_cc) > 0) {
        $row_fr_cc = mysqli_fetch_assoc($result_fr_cc);
        echo "<h1>Edit a cost center</h1>";
        echo "<form method='post'>";
        echo "Cost Center Name:<input type='text' name='ccname' value='" . $row_fr_cc["cc_name"] . "'><br/><br/>
          Approvers Selection:<br/><br/>";

        $sql1    = "SELECT `eid`, `efname`, `elname`, `dept`, `type` FROM `emp_info`";
        $result1 = mysqli_query($con, $sql1);

        if (mysqli_num_rows($result1) > 0) {
            echo "Approver 1:";
            echo "<select name='app1'>";
            while ($row1 = mysqli_fetch_assoc($result1)) {

                if ($row1["type"] != 'emp') {
                  if ($row_fr_cc["appr1"] == $row1["eid"]) {
                      echo "<option value='" . $row1["eid"] . "'selected>" . $row1["efname"] . " " . $row1["elname"] . "(" . $row1["type"] . ")" . "</option>";
                  }else{
                    echo "<option value='" . $row1["eid"] . "'>" . $row1["efname"] . " " . $row1["elname"] . "(" . $row1["type"] . ")" . "</option>";
                  }
                }
            }
            echo "</select><br/><br/>";
        }

        $result2 = mysqli_query($con, $sql1);

        if (mysqli_num_rows($result2) > 0) {
            echo "Approver 2:";
            echo "<select name='app2'>";

            while ($row2 = mysqli_fetch_assoc($result2)) {

                if ($row2["type"] != 'emp' && $row2["type"] != 'ass_mgr') {
                  if ($row_fr_cc["appr2"] == $row2["eid"]) {
                      echo "<option value='" . $row2["eid"] . "'selected>" . $row2["efname"] . " " . $row2["elname"] . "(" . $row2["type"] . ")" . "</option>";
                  }else{
                      echo "<option value='" . $row2["eid"] . "'>" . $row2["efname"] . " " . $row2["elname"] . "(" . $row2["type"] . ")" . "</option>";
                  }
                }
            }

            echo "</select><br/><br/>";
        }

        $result3 = mysqli_query($con, $sql1);

        if (mysqli_num_rows($result3) > 0) {

            echo "Approver 3:";
            echo "<select name='app3'>";

            while ($row3 = mysqli_fetch_assoc($result3)) {

                if ($row3["type"] != 'emp' && $row3["type"] != 'ass_mgr' && $row3["type"] != 'mgr') {
                  if ($row_fr_cc["appr3"] == $row3["eid"]) {
                      echo "<option value='" . $row3["eid"] . "'selected>" . $row3["efname"] . " " . $row3["elname"] . "(" . $row3["type"] . ")" . "</option>";
                  }else{
                    echo "<option value='" . $row3["eid"] . "'>" . $row3["efname"] . " " . $row3["elname"] . "(" . $row3["type"] . ")" . "</option>";
                  }
                }
            }
            echo "</select><br/><br/>";

        }
        echo "<input type='submit' value='Update'>";
        echo "</form>";


        $check = isset($_POST["ccname"])&& isset($_POST["app1"])&& isset($_POST["app2"])&&isset($_POST["app3"])&&$_POST["ccname"]!=" "&&$_POST["app1"]!=" "&&$_POST["app2"]!=" "&&$_POST["app3"]!=" ";

        if($check)
        {
          $a=$_POST["ccname"];
          $b=$_POST["app1"];
          $c=$_POST["app2"];
          $d=$_POST["app3"];

            $sql="UPDATE `cc_info` SET `cc_name`='$a',`appr1`='$b',`appr2`='$c',`appr3`='$d' WHERE `cc_id`='$updateid'";
            if(mysqli_query($con,$sql))
            {
              echo "Record updated successfully";
              header("refresh:1;url=viewcc.php");
            }
            else {
              echo "Record not updated successfully";
            }
        }
    }
} else {
    echo "No username found! Rederecting..";
    header("refresh:1; url=login_admin.php");
}
?>
