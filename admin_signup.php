
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
    echo "<li><a href=" . $menu_link[4] . " class='waves-effect blue-text'><i class='material-icons blue-text'>event_note</i>" . $menu_items[4] . "</a></li>";
    echo "<li><a href=" . $menu_link[5] . " class='waves-effect blue-text'><i class='material-icons blue-text'>account_balance</i>" . $menu_items[5] . "</a></li>";
    echo "<li><a href=" . $menu_link[6] . " class='waves-effect blue-text'><i class='material-icons blue-text'>subject</i>" . $menu_items[6] . "</a></li>";
    echo "<li  class='active blue lighten-4'><a href=" . $menu_link[7] . " class='waves-effect blue-text'><i class='material-icons blue-text'>account_box</i>" . $menu_items[7] . "</a></li>";

  echo "</ul>";
  //echo "<a href='#' data-activates='slide-out' class='button-collapse show-on-large'><i class='material-icons'>menu</i></a>";
  echo "</div>";

    if(isset($_POST["uname"]) && isset($_POST["pswd"]) && $_POST["uname"]!=" "&&$_POST["pswd"]!=" ")
    {
       $id=substr("adm".md5(uniqid(rand(),true)),0,7);
       $user=$_POST["uname"];
       $pass=$_POST["pswd"];
       $sql="INSERT INTO `admin_info`(`a_id`, `username`, `pswd`) VALUES('$id','$user','$pass')";

       if (mysqli_query($con, $sql)) {
       echo "New admin created successfully";
       header("refresh:1; url=welcome_admin.php");
       } else {
         echo "Error: " . $sql . "<br>" . mysqli_error($con);
       }

     mysqli_close($con);
    }
}
else {
  echo "No username found! Rederecting..";
  header("refresh:1; url=login_admin.php");
}

/*else {
  echo "some field is null";
}*/
?>


  <head>
    <meta charset="utf-8">
    <title>Add new admin</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
   <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <style type="text/css">
    .card{
      margin:0px auto;
      padding: 30px;

    }
    body
    {
      max-width:60rem;
      margin:0 auto;
      padding: 6px;
      padding-left: 270px;
      background-color:#99ccff;
      padding-top: 40px;

    }

    h4
    {
      font-family: "Georgia",serif;
      color: #2196f3;
    }
    </style>

  </head>
  <body>
    <div class="col s12 m12  l19">
    <div class="row">
    <div class="col s12">

    <div class="container ">

    <div class="card">
    <center><h4>REGISTER A NEW ADMIN</h4></center>
    <div class='card-content'>
    <form action="" method="post">

          <div class="row">
            <div class="input-field col s11">
              <i class="material-icons prefix blue-text">account_circle</i>
              <input type="text" name="uname" class="validate ">
              <label class="blue-text">Username</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s11">
              <i class="material-icons prefix blue-text">lock_outline</i>
              <input type="password" name="pswd" class="validate"><br><br>
              <label class='blue-text'>Password</label>
            </div>
          </div>

            <center><button type="submit" class="btn waves-effect blue white-text"><i class="large material-icons left white-text ">person_outline</i>Register</button></center>

    </form>
  </div>
    </div>
  </div>
  </div>
  </div>
  </div>
</div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript">
    $(".button-collapse").sideNav();
    </script>

  </body>
</html>
