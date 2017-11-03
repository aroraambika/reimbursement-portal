<html>
      <head>
      <style type="text/javascript">
      .material-icons.left
  		{
  			color:white;
  		}



      </style>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
     <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <title>
        Employee Homepage
      </title>

      </head>

<?php
session_start();
$menu_items_for_emp=array('HOME','EDIT PROFILE','MY CLAIMS','TRACK CLAIM','NEW CLAIM');
$menu_link_for_emp=array('welcome_emp.php','emp_profile.php','emp_claim.php','allclaimfrtrack.php','claimfremp.php');

$menu_items_for_mgr=array('HOME','EDIT PROFILE','MY CLAIMS','TRACK CLAIM','PENDING FOR APPROVAL','NEW CLAIM');
$menu_link_for_mgr=array('welcome_emp.php','emp_profile.php','emp_claim.php','allclaimfrtrack.php','claim_req.php','claimfremp.php');

    if(isset($_SESSION["emailid"]))
    {


        if(isset($_SESSION["fname"]) && isset($_SESSION["lname"]))
        {
          $fname = $_SESSION["fname"];
          $lname = $_SESSION["lname"];
          $type  = $_SESSION["type"];
          $emailid=$_SESSION["emailid"];
          echo "<center><h1>Welcome, ".$fname." ".$lname."</h1></center>";
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

                echo "<li class='active blue lighten-4'><a href=".$menu_link_for_emp[0]." class='waves-effect blue-text'><i class='material-icons blue-text'>home</i>".$menu_items_for_emp[0]."</li>";
                echo "<li><a href=".$menu_link_for_emp[1]." class='waves-effect blue-text'><i class='material-icons blue-text'>edit</i>".$menu_items_for_emp[1]."</li>";
                echo "<li><a href=".$menu_link_for_emp[2]." class='waves-effect blue-text'><i class='material-icons blue-text'>library_books</i>".$menu_items_for_emp[2]."</li>";
                echo "<li><a href=".$menu_link_for_emp[3]." class='waves-effect blue-text'><i class='material-icons blue-text'>directions_run</i>".$menu_items_for_emp[3]."</li>";
                echo "<li><a href=".$menu_link_for_emp[4]." class='waves-effect blue-text'><i class='material-icons blue-text'>subject</i>".$menu_items_for_emp[4]."</li>";

          }
          else {

                  echo "<li class='active blue lighten-4'><a href=".$menu_link_for_mgr[0]." class='waves-effect blue-text'><i class='material-icons blue-text'>home</i>".$menu_items_for_mgr[0]."</li>";
                  echo "<li><a href=".$menu_link_for_mgr[1]." class='waves-effect blue-text'><i class='material-icons blue-text'>edit</i>".$menu_items_for_mgr[1]."</li>";
                  echo "<li><a href=".$menu_link_for_mgr[2]." class='waves-effect blue-text'><i class='material-icons blue-text'>library_books</i>".$menu_items_for_mgr[2]."</li>";//notifications
                  echo "<li><a href=".$menu_link_for_mgr[3]." class='waves-effect blue-text'><i class='material-icons blue-text'>directions_run</i>".$menu_items_for_mgr[3]."</li>";
                  echo "<li><a href=".$menu_link_for_mgr[4]." class='waves-effect blue-text'><i class='material-icons blue-text'>notifications</i>".$menu_items_for_mgr[4]."</li>";
                  echo "<li><a href=".$menu_link_for_mgr[5]." class='waves-effect blue-text'><i class='material-icons blue-text'>subject</i>".$menu_items_for_mgr[5]."</li>";

          }
          echo "</ul>";
          echo "<a href=''#'' data-activates='slide-out' class='button-collapse show-on-large'><i class='material-icons brgrmenu'>menu</i></a>";

        } else {
          echo "No emailid found! Rederecting..";
          header("refresh:1; url=login_emp.php");
        }

      }

      else {
        echo "Please login first";
        header("refresh:1; url=login_emp.php");
      }
?>

  <body>
    <form method="POST" action="logout_emp.php">
    <center><button type="submit" class="btn waves-effect blue"><i class="material-icons white-text left">undo</i>Logout</button></center>
    </form>

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
