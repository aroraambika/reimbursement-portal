<html>
<?php
require_once("config.php");
session_start();
$menu_items_for_emp=array('HOME','EDIT PROFILE','MY CLAIMS','TRACK CLAIM','NEW CLAIM');
$menu_link_for_emp=array('welcome_emp.php','emp_profile.php','emp_claim.php','allclaimfrtrack.php','claimfremp.php');


$menu_items_for_mgr=array('HOME','EDIT PROFILE','MY CLAIMS','TRACK CLAIM','PENDING FOR APPROVAL','NEW CLAIM');
$menu_link_for_mgr=array('welcome_emp.php','emp_profile.php','emp_claim.php','allclaimfrtrack.php','claim_req.php','claimfremp.php');

if (isset($_SESSION["emailid"]) && isset($_SESSION["eid"])) {

    $eid = $_SESSION["eid"];
    $fname = $_SESSION["fname"];
    $lname = $_SESSION["lname"];
    $type  = $_SESSION["type"];
    $emailid=$_SESSION["emailid"];

    echo "<ul id ='slide-out' class='side-nav fixed'>";
    echo "<li><div class='user-view'>";
    echo "<div class='background '>";
    echo "<img src='images/blue2.jpg'>";
    echo "</div>";
    echo "<h5 class='white-text'>Welcome !<i class='large material-icons left'>account_circle</i></h5>";
    echo "<a href='#'><span class='white-text name'>".$fname." ".$lname."</span></a>";
    echo  "<a href='#'><span class='white-text email'>".$emailid."</span></a>";
    echo "</div></li>";

    if($type=='emp')
    {

          echo "<li><a href=".$menu_link_for_emp[0]." class='waves-effect blue-text'><i class='material-icons blue-text'>home</i>".$menu_items_for_emp[0]."</li>";
          echo "<li ><a href=".$menu_link_for_emp[1]." class='waves-effect blue-text'><i class='material-icons blue-text'>edit</i>".$menu_items_for_emp[1]."</li>";
          echo "<li ><a href=".$menu_link_for_emp[2]." class='waves-effect blue-text'><i class='material-icons blue-text'>library_books</i>".$menu_items_for_emp[2]."</li>";
          echo "<li><a href=".$menu_link_for_emp[3]." class='waves-effect blue-text'><i class='material-icons blue-text'>directions_run</i>".$menu_items_for_emp[3]."</li>";
          echo "<li><a href=".$menu_link_for_emp[4]." class='waves-effect blue-text'><i class='material-icons blue-text'>subject</i>".$menu_items_for_emp[4]."</li>";

    }
    else {

      echo "<li><a href=".$menu_link_for_mgr[0]." class='waves-effect blue-text'><i class='material-icons blue-text'>home</i>".$menu_items_for_mgr[0]."</li>";
      echo "<li><a href=".$menu_link_for_mgr[1]." class='waves-effect blue-text'><i class='material-icons blue-text'>edit</i>".$menu_items_for_mgr[1]."</li>";
      echo "<li><a href=".$menu_link_for_mgr[2]." class='waves-effect blue-text'><i class='material-icons blue-text'>library_books</i>".$menu_items_for_mgr[2]."</li>";//notifications
      echo "<li><a href=".$menu_link_for_mgr[3]." class='waves-effect blue-text'><i class='material-icons blue-text'>directions_run</i>".$menu_items_for_mgr[3]."</li>";
      echo "<li  class='active blue lighten-4'><a href=".$menu_link_for_mgr[4]." class='waves-effect blue-text'><i class='material-icons blue-text'>notifications</i>".$menu_items_for_mgr[4]."</li>";
      echo "<li><a href=".$menu_link_for_mgr[5]." class='waves-effect blue-text'><i class='material-icons blue-text'>subject</i>".$menu_items_for_mgr[5]."</li>";
  }
    echo "</ul>";
    echo "<a href=''#'' data-activates='slide-out' class='button-collapse show-on-large'><i class='material-icons brgrmenu'>menu</i></a>";


    $clid=$_GET["clid"];
    $sql = "SELECT `claimid`, `emailid`, `billno`, `billtype`, `billamnt`, `billdate`, `cc_name`, `billpic`, `eid`, `doc`, `pending_with`, `final_status` FROM `claim_info` WHERE `final_status`='pending' AND `pending_with`='$eid'  AND `claimid`='$clid' ";

    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {


        echo "<center>";
        echo "<div class='container'>";
        echo "<div class='card c1'>";
        echo "<div class='card tableheader white-text row '>";
        echo "<div class='col s12 center'><h4>Claim Details</h4></div>";
        echo "</div>";

        echo "<table class='borderd highlight responsive-table centered'>";

            while ($row = mysqli_fetch_assoc($result)) {


            $_SESSION["claimid"] = $row["claimid"];
            $_SESSION["cc"]      = $row["cc_name"];
            echo "<tr>";
            echo "<th class='blue-text center'>CLAIM ID</th>";
            echo "<td>" . $row["claimid"] . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<th class='blue-text center'>EMAILID </th>";
            echo "<td>" . $row["emailid"] . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<th class='blue-text center'>BILL NO</th>";
            echo "<td>" . $row["billno"] . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<th class='blue-text center'>BILL TYPE</th>";
            echo "<td>" . $row["billtype"] . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<th class='blue-text center'>BILL AMOUNT</th>";
            echo "<td>" . $row["billamnt"] . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<th class='blue-text center'>BILL DATE</th>";
            echo "<td>" . $row["billdate"] . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<th class='blue-text center'>BILL PIC</th>";
            $pic=$row["billpic"];
            echo "<td><a href=$pic><u>" . $row["billpic"] . "</u></a></td>";
            echo "</tr>";
            echo "<tr>";
            echo "<th class='blue-text center'>CC NAME</th>";
            echo "<td>" . $row["cc_name"] . "</td>";
            echo "</tr>";
            echo "<tr>";
            //  echo "<td>".$row["eid"]."</td>";
            echo "<th class='blue-text center'>STATUS</th>";
            echo "<td>" . $row["final_status"] . "</td>";
            //echo "<td><a href='del_emp.php?deleteid=". $row["id"]. "' onclick=\"return confirm('Are you sure?')\">DEL</a></td>";
            //echo "<td><a href='upd_emp.php?updateid=" . $row["id"]. "'>UPDATE</a></td>";
            echo "</tr>";

          }
        echo "</table><br/>";

        ?><center><!--<input type="button" onclick="app_rej_claim('onapprove.php')" value="Approve" class='btn green darken-2 white-text'>
            </input>-->
            <button type="submit" class="btn waves-effect light-green accent-4 white-text waves-light z-depth-4" onclick="app_rej_claim('onapprove.php')"><i class="material-icons left">thumb_up</i>Approve</button>
            <tab></tab>
        <!--<input type="button" onclick="app_rej_claim('onreject.php')" value="Reject" class='btn red darken-2 white-text'></center>
        -->
          <button type="submit" class="btn waves-effect red accent-4 white-text waves-light z-depth-4" onclick="app_rej_claim('onreject.php')"><i class="material-icons left">thumb_down</i>Reject</button>
        <?php
        echo "</div>"; //for card ending
        echo "</div>";//for container ending
        echo "</center>";
        echo "<form id='form1'>";

        echo "<form>";
        echo "</center>";
    } else {
        echo "0 results";
    }
} else {
    echo "Please login first";
    header("refresh:1;url=login_emp.php");
}

?>


  <head>
    <title>List of pending requests</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
   <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <script type='text/javascript'>
      function app_rej_claim(action)
      {
        var form = document.getElementById('form1');
        form.action = action;
        form.submit();
      }

    </script>

    <style>
      .c1
      {
        height: 100%;
      }
      .card
      {
        width:70%;

      }

      body
      {
        padding-left: 270px;
        background-color: #99ccff;
      }
      .tableheader
      {
        background-color:#2196f3;
        padding: 6px;
        font-size: 20px;
        width: auto;
      }
      
      tab
      {
        padding-left: 50px;
      }



    </style>


  </head>

  <body>


    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript">

    // Initialize collapse button
    $(".button-collapse").sideNav();
    // Initialize collapsible (uncomment the line below if you use the dropdown variation)
    //$('.collapsible').collapsible();

    </script>
  </body>

</html>
