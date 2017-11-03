<?php
require_once("config.php");
session_start();
$id_to_update = $_SESSION["eid"];
if (isset($_SESSION["emailid"])) {
    $check = isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["emailid"]) && isset($_POST["dept"]) && isset($_POST["desg"]) && isset($_POST["sal"]) && isset($_POST["dob"]) && isset($_POST["doj"]) && isset($_POST["accnum"]) && isset($_POST["bank_name"]) && isset($_POST["gender"]) && isset($_POST["street_addr"]) && isset($_POST["city"]) && isset($_POST["state"]) && isset($_POST["cntry"]) && isset($_POST["zcode"]) && isset($_POST["mobno"]) && $_POST["fname"] != " " && $_POST["lname"] != " " && $_POST["emailid"] != " " && $_POST["dept"] != " " && $_POST["desg"] != " " && $_POST["sal"] != " " && $_POST["dob"] != " " && $_POST["doj"] != " " && $_POST["accnum"] != " " && $_POST["bank_name"] != " " && $_POST["gender"] != " " && $_POST["street_addr"] != " " && $_POST["city"] != " " && $_POST["state"] != " " && $_POST["cntry"] != " " && $_POST["zcode"] != " ";

    if ($check) {

        $b = $_POST["fname"];
        $c = $_POST["lname"];
        $d = $_POST["emailid"];

        $f = $_POST["dept"];
        $g = $_POST["desg"];
        $h = $_POST["sal"];
        $i = $_POST["dob"];
        $j = $_POST["doj"];
        $k = $_POST["accnum"];
        $l = $_POST["bank_name"];
        $m = $_POST["gender"];
        $n = $_POST["street_addr"];
        $o = $_POST["city"];
        $p = $_POST["state"];
        $q = $_POST["cntry"];
        $r = $_POST["zcode"];
        $s = $_POST["mobno"];


        $sql = "UPDATE `emp_info` SET `efname`='$b',`elname`='$c',`dept`='$f',`type`='$g',`dob`='$i',`accno`='$k',`bank_name`='$l',`sal_per_ann`='$h',`gender`='$m',
    `mobno`='$s',`emailid`='$d',`doj`='$j',`street_addr`='$n',`city`='$o',`state`='$p',`country`='$q',`zipcode`='$r' WHERE eid = '" . $id_to_update . "' ";

        if (mysqli_query($con, $sql)) {
            echo "Record updated successfully";
            header("refresh:2; url=welcome_emp.php");
            die();
        } else {
            echo "Error updating record: " . $sql . "<br>" . mysqli_error($con);
        }

        mysqli_close($con);

    } else {
        echo "error ";
    }

}

else {
    echo "Please login first";
    header("refresh:2;url=login_emp.php");
}

?>
