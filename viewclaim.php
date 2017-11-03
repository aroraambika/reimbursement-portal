
<html>

<?php
require_once("config.php");
session_start();
$menu_items = array(
    'HOME',
    'ADD NEW EMP',
    'CREATE COST CENTER',
    'VIEW ALL EMP',
    'VIEW ALL CLAIMS',
    'VIEW ALL COST CENTERS',
    'NEW CLAIM',
    'CREATE NEW ADMIN'
);
$menu_link  = array(
    'welcome_admin.php',
    'register.php',
    'insertcc.php',
    'viewemp.php',
    'viewclaim.php',
    'viewcc.php',
    'claimfradmin.php',
    'admin_signup.php'
);

if (isset($_SESSION["username"])) {

  $username = $_SESSION["username"];
  echo "<div class='row'>";
  echo "<div class='col s12 m4 l13'>";
  echo "<ul id ='slide-out' class='side-nav fixed'>";
  echo "<li><div class='user-view'>";
  echo "<div class='background '>";
  echo "<img src='images/blue2.jpg'>";
  echo "</div>";
  echo "<h5 class='white-text'>Welcome !<i class='large material-icons left white-text'>account_circle</i></h5>";
  echo "<a href='#'><span class='white-text name'>" . $username . "</span></a>";
  echo "<a href='#'><span class='white-text email'>Administrator</span></a>";
  echo "</div></li>";

    echo "<li><a href=" . $menu_link[0] . " class='waves-effect blue-text'><i class='material-icons blue-text'>home</i>" . $menu_items[0] . "</a></li>";
    echo "<li><a href=" . $menu_link[1] . " class='waves-effect blue-text'><i class='material-icons blue-text'>add</i>" . $menu_items[1] . "</a></li>";
    echo "<li><a href=" . $menu_link[2] . " class='waves-effect blue-text'><i class='material-icons blue-text'>edit</i>" . $menu_items[2] . "</a></li>";
    echo "<li><a href=" . $menu_link[3] . " class='waves-effect blue-text'><i class='material-icons blue-text'>people</i>" . $menu_items[3] . "</a></li>";
    echo "<li   class='active blue lighten-4'><a href=" . $menu_link[4] . " class='waves-effect blue-text'><i class='material-icons blue-text'>event_note</i>" . $menu_items[4] . "</a></li>";
    echo "<li><a href=" . $menu_link[5] . " class='waves-effect blue-text'><i class='material-icons blue-text'>account_balance</i>" . $menu_items[5] . "</a></li>";
    echo "<li><a href=" . $menu_link[6] . " class='waves-effect blue-text'><i class='material-icons blue-text'>subject</i>" . $menu_items[6] . "</a></li>";
    echo "<li><a href=" . $menu_link[7] . " class='waves-effect blue-text'><i class='material-icons blue-text'>account_box</i>" . $menu_items[7] . "</a></li>";

  echo "</ul>";
  echo "</div>";

//  echo "<a href='#' data-activates='slide-out' class='button-collapse show-on-large'><i class='material-icons'>menu</i></a>";

    $sql = "SELECT `claimid`, `emailid`, `billno`, `billtype`, `billamnt`, `billdate`, `cc_name`, `billpic`, `eid`, `doc`, `pending_with`, `final_status` FROM `claim_info`";

    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {

        echo "<div class='col s12 m12  l19'>";
        echo "<div class='row'>";
        echo "<div class='col s12'>";
        echo "<div class='container'>";
        echo "<div class='card '>";
        echo "<div class='card tableheader blue white-text row'>";
        echo "<center><h5 class='col  s12'>List of all Claims</h5></center>";
        echo "</div>";

        echo "<table class='bordered highlight mytable responsive-table hoverable'>
            <tr class='setcolor'>
            <th class='blue-text'>CLAIM ID</th>
            <th class='blue-text'>EMAILID </th>
            <th class='blue-text'>BILL NO</th>
            <th class='blue-text'>BILL TYPE</th>
            <th class='blue-text'>BILL AMOUNT</th>
            <th class='blue-text'>BILL DATE</th>
            <th class='blue-text'>CC NAME</th>
            <th class='blue-text'>STATUS</th>
            <th class='blue-text'>PENDING WITH</th>
            <th class='blue-text'>BILL PIC</th>
            <th class='blue-text'>DOC</th>
            <th class='blue-text'>DELETE</th>
            </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["claimid"] . "</td>";
            echo "<td>" . $row["emailid"] . "</td>";
            echo "<td>" . $row["billno"] . "</td>";
            echo "<td>" . $row["billtype"] . "</td>";
            echo "<td>" . $row["billamnt"] . "</td>";
            echo "<td>" . $row["billdate"] . "</td>";
            echo "<td>" . $row["cc_name"] . "</td>";
            echo "<td>" . $row["final_status"] . "</td>";
            //  echo "<td>".$row["eid"]."</td>";
            echo "<td>" . $row["pending_with"] . "</td>";
            echo "<td><a href='".$row["billpic"]."'>" . $row["billpic"] . "</a></td>";
            echo "<td>" . $row["doc"] . "</td>";
            echo "<td><a href='remove_claim.php?deleteid=". $row["claimid"]. "' onclick=\"return confirm('Are you sure?')\"><i class='material-icons red-text'>clear</i></a></td>";
            //echo "<td><a href='del_emp.php?deleteid=". $row["id"]. "' onclick=\"return confirm('Are you sure?')\">DEL</a></td>";
            //echo "<td><a href='upd_emp.php?updateid=" . $row["id"]. "'>UPDATE</a></td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "0 results";
    }
} else {
    echo "Please login first";
    header("refresh:1;url=login_admin.php");
}

?>

<head>

  <title> View all Claims</title>

  <style type='text/css'>

  .mytable{
    font-size: 12px;
    }

  .card
  {
    width: 60rem;
  }

  body
  {
    margin: 0 auto;
    background-color:#99ccff;
    max-width:60rem;
    padding-left: 270px;
    padding-top: 30px;
  }
  .tableheader
  {
    background-color: #2196f3;
    font-size: 10px;
    width: auto;
  }

  .setcolor
  {
    background-color: #f2f2f2;
  }

  </style>

  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

</head>
<body>

  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script type="text/javascript">
  $(".button-collapse").sideNav();

  </script>
</body>
</html>
