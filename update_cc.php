<?php
require_once("config.php");
session_start();
if (isset($_SESSION["username"])) {

    // $cc_id=$_GET["updateid"];
    // $sql_fr_cc_update="SELECT `cc_id`, `cc_name`, `appr1`, `appr2`, `appr3`, `doc` FROM `cc_info` WHERE `cc_id`='$cc_id'";
    // $result_fr_cc = mysqli_query($con, $sql_fr_cc_update);
    //
    // if (mysqli_num_rows($result_fr_cc) > 0) {
    //     echo "<center><h1>Edit the Cost Center</h1></center>";
    //     echo "<form>";
    //
    //         $row_fr_cc = mysqli_fetch_assoc($result_fr_cc)
    //         echo "Cost Center Name:<input type='text' name='ccname' value= '". $row_fr_cc["cc_name"] . "'/><br><br>";
    //         echo "Approver 1:" . $row["appr1"] . "</td>";
    //         echo "<td>" . $row["appr2"] . "</td>";
    //         echo "<td>" . $row["appr3"] . "</td>";
    //         echo "<td>" . $row["doc"] . "</td>";
    //         echo "<td><a href='remove_cc.php?deleteid=".$row["cc_id"]."' onclick=\"return confirm('Are you sure?')\"><img src='images/delete.png'></a></td>";
    //         echo "<td><a href='update_cc.php?updateid=" . $row["cc_id"]. "'><img src='images/update.png'></a></td>";
    //         echo "</tr>";
    //
    //
    //     echo "</table>";

    $cc_id            = $_GET["updateid"];
    $sql_fr_cc_update = "SELECT `cc_id`, `cc_name`, `appr1`, `appr2`, `appr3`, `doc` FROM `cc_info` WHERE `cc_id`='$cc_id'";
    $result_fr_cc     = mysqli_query($con, $sql_fr_cc_update);

    if (mysqli_num_rows($result_fr_cc) > 0) {
        echo "<center><h1>Edit the Cost Center</h1></center>";
        echo "<form method='POST'>";
        $row_fr_cc = mysqli_fetch_assoc($result_fr_cc);
        echo "Cost Center Name:<input type='text' name='ccname' value= '" . $row_fr_cc["cc_name"] . "'/><br><br>";
        $sql    = "SELECT `eid`, `efname`, `elname`, `dept`, `type` FROM `emp_info`";
        $result = mysqli_query($con, $sql);
        if(mysqli_num_rows($result)>0){
          echo "Approver 1:";
          echo "<select name='app1'>";
          while ($row = mysqli_fetch_assoc($result)) {


              if ($row["type"] != 'emp') {
                if ($row["eid"] == $row_fr_cc["appr1"]) {
                    echo "<option value='" . $row["eid"] . "'selected>" . $row["efname"] . " " . $row["elname"] . "(" . $row["type"] . ")" . "</option>";
                }else{
                  echo "<option value='" . $row["eid"] . "'>" . $row["efname"] . " " . $row["elname"] . "(" . $row["type"] . ")" . "</option>";
                }
              }
          }
          echo "</select><br/><br/>";
          $result = mysqli_query($con, $sql);
          echo "Approver 2:";
          echo "<select name='app2'>";
          echo "<option value='" . $row_fr_cc["appr2"] . "'>" . $row_fr_cc["appr2"] . "</<option>";

          while ($row2 = mysqli_fetch_assoc($result)) {

              if ($row2["type"] != 'emp' && $row2["type"] != 'ass_mgr') {
                if ($row_fr_cc["appr2"] == $row2["eid"]) {
                    echo "<option value='" . $row2["eid"] . "'selected>" . $row2["efname"] . " " . $row2["elname"] . "(" . $row2["type"] . ")" . "</option>";
                }
                else {
                  echo "<option value='" . $row2["eid"] . "'>" . $row2["efname"] . " " . $row2["elname"] . "(" . $row2["type"] . ")" . "</option>";
                }

              }
          }
          echo "</select><br/><br/>";
          $result = mysqli_query($con, $sql);
          echo "Approver 3:";
          echo "<select name='app3'>";
          echo "<option value='" . $row_fr_cc["appr3"] . "'>" . $row_fr_cc["appr3"] . "</<option>";
          while ($row = mysqli_fetch_assoc($result)) {

              if ($row["type"] != 'emp' && $row["type"] != 'ass_mgr' && $row["type"] != 'mgr') {
                if ($row_fr_cc["appr3"] == $row["eid"]) {
                    echo "<option value='" . $row["eid"] . "'selected>" . $row["efname"] . " " . $row["elname"] . "(" . $row["type"] . ")" . "</option>";
                }
                else{echo "<option value='" . $row["eid"] . "'>" . $row["efname"] . " " . $row["elname"] . "(" . $row["type"] . ")" . "</option>";
                }
              }
          }
          echo "</select><br/><br/>";
        }echo "<input type='submit' value='Update'><br>";
        echo "</form>";



        $check = isset($_POST["ccname"]) && isset($_POST["app1"]) && isset($_POST["app2"]) && isset($_POST["app3"]) && $_POST["ccname"] != " " && $_POST["app1"] != " " && $_POST["app2"] != " " && $_POST["app3"] != " ";

        if ($check) {
            //catching the form data
            //$a = substr("cc" . md5(uniqid(rand(), true)), 0, 6);
            $b        = $_POST["ccname"];
            $c        = $_POST["app1"];
            $d        = $_POST["app2"];
            $e        = $_POST["app3"];
            $upd_date = date("Y-m-d");

            $sql_fin_upd = "UPDATE `cc_info` SET `cc_name`='$b',`appr1`='$c',`appr2`='$d',`appr3`='$e',`doc`='$upd_date' WHERE `cc_id`='$cc_id'";

            if (mysqli_query($con, $sql_fin_upd)) {
                echo "Cost Center is updated successfully";
            } else {
                echo "Error in updating : " . $sql_fin_upd . "<br>" . mysqli_error($con);
            }

            mysqli_close($con);
        }

        else {
            echo "hi";
            echo "0 results";
        }
    } else {
        echo "Inner aprover query is not working";
    }


} else {
    echo "No username found! Rederecting..";
    header("refresh:1; url=login_admin.php");
}
?>
