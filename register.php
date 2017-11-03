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
    echo "<li class='active blue lighten-4'><a href=" . $menu_link[1] . " class='waves-effect blue-text'><i class='material-icons blue-text'>add</i>" . $menu_items[1] . "</a></li>";
    echo "<li><a href=" . $menu_link[2] . " class='waves-effect blue-text'><i class='material-icons blue-text'>edit</i>" . $menu_items[2] . "</a></li>";
    echo "<li><a href=" . $menu_link[3] . " class='waves-effect blue-text'><i class='material-icons blue-text'>people</i>" . $menu_items[3] . "</a></li>";
    echo "<li><a href=" . $menu_link[4] . " class='waves-effect blue-text'><i class='material-icons blue-text'>event_note</i>" . $menu_items[4] . "</a></li>";
    echo "<li><a href=" . $menu_link[5] . " class='waves-effect blue-text'><i class='material-icons blue-text'>account_balance</i>" . $menu_items[5] . "</a></li>";
    echo "<li><a href=" . $menu_link[6] . " class='waves-effect blue-text'><i class='material-icons blue-text'>subject</i>" . $menu_items[6] . "</a></li>";
    echo "<li><a href=" . $menu_link[7] . " class='waves-effect blue-text'><i class='material-icons blue-text'>account_box</i>" . $menu_items[7] . "</a></li>";

  echo "</ul>";
  echo "</div>";

//  echo "<a href='#' data-activates='slide-out' class='button-collapse show-on-large'><i class=' medium material-icons white-text'>menu</i></a>";



   $chk = isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["emailid"]) && isset($_POST["pswd"]) && isset($_POST["dept"]) && isset($_POST["desg"]) && isset($_POST["sal"]) && isset($_POST["dob"]) && isset($_POST["doj"]) && isset($_POST["accnum"]) && isset($_POST["bank_name"]) && isset($_POST["gender"]) && isset($_POST["street_addr"]) && isset($_POST["city"]) && isset($_POST["state"]) && isset($_POST["cntry"]) && isset($_POST["zcode"]) && isset($_POST["mobno"]) && $_POST["fname"] != " " && $_POST["lname"] != " " && $_POST["emailid"] != " " && $_POST["pswd"] != " " && $_POST["dept"] != " " && $_POST["desg"] != " " && $_POST["sal"] != " " && $_POST["dob"] != " " && $_POST["doj"] != " " && $_POST["accnum"] != " " && $_POST["bank_name"] != " " && $_POST["gender"] != " " && $_POST["street_addr"] != " " && $_POST["city"] != " " && $_POST["state"] != " " && $_POST["cntry"] != " " && $_POST["zcode"] != " ";
   if ($chk) {
       //catching the form data
       $a = substr("emp" . md5(uniqid(rand(), true)), 0, 7);

       $b = $_POST["fname"];
       $c = $_POST["lname"];
       $d = $_POST["emailid"];
       $e = $_POST["pswd"];
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
       $sql = "INSERT INTO `emp_info`(`eid`, `efname`, `elname`, `dept`, `type`, `dob`, `accno`, `bank_name`, `sal_per_ann`, `gender`, `mobno`, `emailid`, `doj`, `street_addr`, `city`, `state`, `country`, `zipcode`, `pswd`) VALUES('$a','$b','$c','$f','$g','$i','$k','$l','$h','$m','$s','$d','$j','$n','$o','$p','$q','$r','$e')";
       echo $a;
       if (mysqli_query($con, $sql)) {
           echo "You are registered successfully";
       } else {
           echo "Error: " . $sql . "<br>" . mysqli_error($con);
       }

       mysqli_close($con);
   }

   else {
       //echo "Some fied is null";
   }
} else {
   echo "Please login first";
   header("refresh:1;url=login_admin.php");
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registeration Of Employee</title>

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
      background-color:	#99ccff;
      padding-left: 270px;
     }
     .colorchnge
     {
       color: blue;
     }
     h4
     {
       font-family: "Georgia",serif;
       color: #2196f3;
     }
     /*.header
     {  padding-left: 270px;

        background-color:#2196f3;
        height:5rem;
     }*/
   </style>

  </head>


  <body>
    <!-- <div class='header white-text'>

        <h5 class="center-align">ADD NEW EMPLOYEE</h5>

    </div> -->
    <div class='col s12 m12  l19'>
    <div class="container">
      <div class="card row">
    <center><h4 class="col s12"><u>REGISTER AN EMPLOYEE</u></h4></center><br/><br/>

    <form action="register.php" method="POST">

        <div class="row">
          <div class="input-field col s6">
           <input type="text" name="fname" class="validate">
           <label for="fname" class="blue-text">First Name</label>
          </div>

          <div class="input-field col s6">
            <input type="text" name="lname" class="validate">
            <label for="lname" class="blue-text">Last Name</label>
          </div>

        </div>

          <div class="row">
            <div class="input-field col s6">
            <input type="email" name="emailid" class ="validate" required>
            <label for="emailid" class="blue-text">Email Id</label>

            </div>
          </div>


        <div class="row">
          <div class="input-field col s6">
          <input type="password" name="pswd">
         <label for="pswd" class="blue-text">Password</label>
         </div>
       </div>



      <div class="row">
        <div class="input-field col s6">
           <select name="dept">
             <option value="" disabled selected>Select your department</option>
             <option value="prod">Production</option>
             <option value="rnd">Research and Development</option>
             <option value="purchase">Purchasing</option>
             <option value="mktg">Marketing</option>
             <option value="hr">Human Resource Management</option>
             <option value="acc_n_fin">Accounting and Finance</option>
           </select>
            <label for="dept" class="blue-text">Department</label>
         </div>
     </div>


     <div class="row">
       <div class="input-field col s6">
         <select name="desg">
           <option class="colorchnge" value="" disabled selected>Select your designation</option>
           <option class="colorchnge" value="emp">Employee</option>
           <option class="colorchnge" value="ass_mgr">Assistant Manager</option>
           <option class="colorchnge" value="mgr">Manager</option>
           <option class="colorchnge" value="fin_mgr">Finance Manager</option>
         </select>
          <label for="desg" class="blue-text">Designation</label>
        </div>
    </div>

        <div class="row">
          <div class="input-field col s6">
            <input type="text" name="sal">
            <label for="sal" class="blue-text">Salary per Annum</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s6">
           <input type="text" name="dob" class="datepicker">
           <label for="dob" class="blue-text">DOB</label>
          </div>
        </div>

         <div class="row">
           <div class="input-field col s6">
             <input type="date" name="doj" class="datepicker">
             <label for="doj" class="blue-text">Date of joining</label>
           </div>
         </div>

     <div class="row">
       <div class="input-field col s6">
         <input type="text" name="accnum" class="validate">
         <label class="blue-text">Account Number</label>
       </div>
     </div>

     <div class="row">
       <div class="input-field col s6">
        <input type="text" name="bank_name" class="validate">
        <label class="blue-text">Bank Name</label>
       </div>
     </div>


         <label class="left blue-text">Gender</label><br/>
         <p>
           <input type="radio" name="gender" value="Male" class="with-gap" id="g1">
           <label for="g1" class="blue-text">Male</label>
         </p>
         <p>
          <input type="radio" name="gender" value="Female" class="with-gap" id="g2">
          <label for="g2"  class="blue-text">Female</label><br/><br/>
        </p>

    <div class="row">
       <div class="input-field col s6">
         <input type="text" name="street_addr" class="validate">
          <label class="blue-text">Street Address</label>
      </div>
    </div>

    <div class="row">
       <div class="input-field col s6">
         <input type="text" name="city" class="validate">
         <label class="blue-text">City</label>
       </div>
    </div>


     <div class="row">
        <div class="input-field col s6">
          <input type="text" name="state" class="validate">
          <label class="blue-text">State</label>
        </div>
    </div>

      <div class="row">
         <div class="input-field col s6">
           <input type="text" name="cntry" class="validate">
           <label class="blue-text">Country</label>
         </div>
       </div>

       <div class="row">
          <div class="input-field col s6">
             <input type="text" name="zcode"class="validate">
             <label class="blue-text">Zip Code</label>
          </div>
        </div>

        <div class="row">
           <div class="input-field col s6">
              <input type="text" name="mobno"class="validate">
              <label class="blue-text">Mobile No.</label>
           </div>
         </div>

       <center><button type="submit"  class="btn waves-effect blue"><i class="large material-icons left">person_outline</i>Register</button>
       </center>

    </form>
  </div>
  </div>
</div>
</div>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script type="text/javascript">
  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year,
     today: 'Today',
     clear: 'Clear',
     close: 'Ok',
    // closeOnSelect: false // Close upon selecting a date,
  });

  $(document).ready(function() {
    $('select').material_select();
    });

    $(".button-collapse").sideNav();

  </script>


  </body>
</html>
