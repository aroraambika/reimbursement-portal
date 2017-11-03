<html>

<head>
  <title>New Cost Ceneter</title>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
 <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <style type="text/css">
       .card{
           margin: 50px;
           padding: 50px;
         }
         body
         {
          padding-left:  270px;
          background-color: #99ccff;
         }
         h4
         {
           font-family: "Georgia",serif;
           color: #2196f3;                       <!--#0099ff-->
         }
         .material-icons.right
         {
           color:white;
         }

  </style>

</head>

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
  echo "<h5 class='white-text'>Welcome !<i class='large material-icons left'>account_circle</i></h5>";
  echo "<a href='#'><span class='white-text name'>" . $username . "</span></a>";
  echo "<a href='#'><span class='white-text email'>Administrator</span></a>";
  echo "</div></li>";

    echo "<li><a href=" . $menu_link[0] . " class='waves-effect blue-text'><i class='material-icons blue-text'>home</i>" . $menu_items[0] . "</a></li>";
    echo "<li><a href=" . $menu_link[1] . " class='waves-effect blue-text'><i class='material-icons blue-text'>add</i>" . $menu_items[1] . "</a></li>";
    echo "<li  class='active blue lighten-4'><a href=" . $menu_link[2] . " class='waves-effect blue-text'><i class='material-icons blue-text'>edit</i>" . $menu_items[2] . "</a></li>";
    echo "<li><a href=" . $menu_link[3] . " class='waves-effect blue-text'><i class='material-icons blue-text'>people</i>" . $menu_items[3] . "</a></li>";
    echo "<li><a href=" . $menu_link[4] . " class='waves-effect blue-text'><i class='material-icons blue-text'>event_note</i>" . $menu_items[4] . "</a></li>";
    echo "<li><a href=" . $menu_link[5] . " class='waves-effect blue-text'><i class='material-icons blue-text'>account_balance</i>" . $menu_items[5] . "</a></li>";
    echo "<li><a href=" . $menu_link[6] . " class='waves-effect blue-text'><i class='material-icons blue-text'>subject</i>" . $menu_items[6] . "</a></li>";
    echo "<li><a href=" . $menu_link[7] . " class='waves-effect blue-text'><i class='material-icons blue-text'>account_box</i>" . $menu_items[7] . "</a></li>";

  echo "</ul>";
  echo "</div>";

  //echo "<a href='#' data-activates='slide-out' class='button-collapse show-on-large'><i class='material-icons'>menu</i></a>";

    $chk = isset($_POST["ccname"]) && isset($_POST["app1"])&& isset($_POST["app2"])&& isset($_POST["app3"]) && $_POST["ccname"] != " " && $_POST["app1"] != " "&&$_POST["app2"] != " "&&
    $_POST["app3"] != " ";
    if ($chk) {
        //catching the form data
        $a = substr("cc" . md5(uniqid(rand(), true)), 0, 6);
        $b = $_POST["ccname"];
        $c = $_POST["app1"];
        $d = $_POST["app2"];
        $e = $_POST["app3"];

        $sql = "INSERT INTO `cc_info`(`cc_id`, `cc_name`, `appr1`, `appr2`, `appr3`) VALUES('$a','$b','$c','$d','$e')";
        echo $a;
        if (mysqli_query($con, $sql)) {
            echo "Cost Center is created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }

        mysqli_close($con);

    }

} else {
    echo "Please login first";
    header("refresh:1;url=login_admin.php");
}

?>

  <body>
      <div class='col s12 m12  l19'>
      <div class="container">
        <div class="card row">
          <center><h4 class='col s12'><u>New Cost Center</u></h4></center><br/><br/>

      <form action="" method="post">

        <div class="row">
          <div class="input-field col s6">
            <input type="text" name="ccname" class="valildation">
            <label class="blue-text">  Cost Center Name</label><br><br>
          </div>
        </div>


        <div class="row">
          <div class="input-field col s6">

        <?php
        require_once('config.php');
        $sql    = "SELECT `eid`, `efname`, `elname`, `dept`, `type` FROM `emp_info`";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<select name='app1'>";
              echo "<option value='' disabled selected>Select Approver No.1</option>";
            while ($row = mysqli_fetch_assoc($result)) {

              if($row["type"]!='emp')
                echo "<option value='" . $row["eid"] . "'>" . $row["efname"] . " " . $row["elname"] . "(" . $row["type"] . ")" . "</option>";
            }
            echo "</select>";

        } else {
            echo "0 results";
        }
        ?>
          <label class="blue-text">Approver No.1</label>
          </div>
        </div>
        <br/><br/>

        <div class="row">
          <div class="input-field col s6">

        <?php
        require_once('config.php');
        $sql    = "SELECT `eid`, `efname`, `elname`, `dept`, `type` FROM `emp_info`";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {

            echo "<select name='app2'>";
          echo "<option value='' disabled selected>Select Approver No.2</option>";
            while ($row = mysqli_fetch_assoc($result)) {
                if($row["type"]!='emp'&& $row["type"]!='ass_mgr' )
                echo "<option value='" . $row["eid"] . "'>" . $row["efname"] . " " . $row["elname"] .  "(" . $row["type"] . ")" ."</option>";
            }
            echo "</select>";

        } else {
            echo "0 results";
        }
        ?>
        <label class="blue-text">Approver No.2</label>
          </div>
        </div>
        <br/><br/>


        <div class="row">
          <div class="input-field col s6">
        <?php
        require_once('config.php');
        $sql    = "SELECT `eid`, `efname`, `elname`, `dept`, `type` FROM `emp_info`";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<select name='app3'>";
              echo "<option value='' disabled selected>Select Approver No.3</option>";
            while ($row = mysqli_fetch_assoc($result)) {
                if($row["type"]!='emp'&& $row["type"]!='ass_mgr'&& $row["type"]!='mgr' )
                echo "<option value='" . $row["eid"] . "'>" . $row["efname"] . " " . $row["elname"] .   "(" . $row["type"] . ")" ."</option>";
            }
            echo "</select>";

        } else {
            echo "0 results";
        }
        ?>
        <label class="blue-text">Approver No.3</label>
          </div>
        </div>


        <center><button type="submit" class="btn waves-effect blue darken-2 white-text" ><i class="large material-icons right">send</i>Create</button></center>
      </form>
    </div>
  </div>

      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script type="text/javascript">
        $(document).ready(function() {
          $('select').material_select();
          });

            $(".button-collapse").sideNav();
      </script>


  </body>

</html>
