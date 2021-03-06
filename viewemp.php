
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
    echo "<li  class='active blue lighten-4'><a href=" . $menu_link[3] . " class='waves-effect blue-text'><i class='material-icons blue-text'>people</i>" . $menu_items[3] . "</a></li>";
    echo "<li><a href=" . $menu_link[4] . " class='waves-effect blue-text'><i class='material-icons blue-text'>event_note</i>" . $menu_items[4] . "</a></li>";
    echo "<li><a href=" . $menu_link[5] . " class='waves-effect blue-text'><i class='material-icons blue-text'>account_balance</i>" . $menu_items[5] . "</a></li>";
    echo "<li><a href=" . $menu_link[6] . " class='waves-effect blue-text'><i class='material-icons blue-text'>subject</i>" . $menu_items[6] . "</a></li>";
    echo "<li><a href=" . $menu_link[7] . " class='waves-effect blue-text'><i class='material-icons blue-text'>account_box</i>" . $menu_items[7] . "</a></li>";

  echo "</ul>";
  echo "</div>";

//  echo "<a href='#' data-activates='slide-out' class='button-collapse show-on-large'><i class='material-icons'>menu</i></a>";


    $sql = "SELECT `eid`, `efname`, `elname`, `dept`, `type`, `dob`, `accno`, `bank_name`, `sal_per_ann`,
     `gender`, `mobno`, `emailid`, `doj`, `doc`, `street_addr`, `city`, `state`, `country`, `zipcode`, `pswd` FROM `emp_info`";

    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<div class='col s12 m12  l19'>";
        echo "<div class='row'>";
        echo "<div class='col s12'>";
        echo "<div class='container'>";
        echo "<div class='card'>";
        echo "<div class='card blue tableheader white-text row'>";
        echo "<div><center><h5 class ='col s12'>List of all Employees</h5></center></div>";
        echo "</div>";

        echo "<table class='bordered highlight mytable responsive-table hoverable'>
            <tr  class='setcolor'>
            <th class='blue-text'>EID</th>
            <th class='blue-text'>FIRST NAME</th>
            <th class='blue-text'>LAST NAME</th>
            <th class='blue-text'>DEPT</th>
            <th class='blue-text'>DESG</th>
            <th class='blue-text'>GENDER</th>
            <th class='blue-text'>EMAILID</th>
            <th class='blue-text'>DELETE</th>
            </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr class='hover'>";
            echo "<td><a href='emp_detail.php?eid=".$row["eid"]."'>" . $row["eid"] . "</a></td>";
            //echo "<td class='blue-text'><a href='track_claim.php?clid=".$row["claimid"]."'>". $row["claimid"] ."</a></td>";
            echo "<td>" . $row["efname"]. "</td>";
            echo "<td>" . $row["elname"]. "</td>";
            echo "<td>" . $row["dept"]  . "</td>";
            echo "<td>" . $row["type"]  . "</td>";
            echo "<td>" . $row["gender"] . "</td>";
            echo "<td>" . $row["emailid"] . "</td>";
            //echo "<td><a href='remove_emp.php?deleteid=". $row["eid"]. "' onclick=\"return confirm('Are you sure?')\"><img src='images/delete.png'></a></td>";
            echo "<td><a href='remove_emp.php?deleteid=". $row["eid"]. "' onclick=\"return confirm('Are you sure?')\"><i class='material-icons red-text'>clear</i></a></td>";
            //echo "<td><a href='upd_emp.php?updateid=" . $row["id"]. "'>UPDATE</a></td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";//closing for responsive ow navigation bar
    } else {
        echo "0 results";
    }
} else {
    echo "Please login first";
    header("refresh:1;url=login_admin.php");
}
?>
<head>
  <title>View all Employees</title>

  <style type='text/css'>
    .mytable
    {
    font-size: 12px;
    }
    .card
    {

      width:50rem;

    }

    body
    {

      background-color:#99ccff;
      padding-top: 30px;
      padding-left: 270px;

    }
    .tableheader
    {
      background-color: #2196f3;
      padding: 5px;
      width: auto;
      font-size: 15px;
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
</html>
