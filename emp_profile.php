<html>
<head>

  <title>Your Profile </title>

        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
       <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <style type="text/css">
        .card
        {
          margin: 50px;
          padding: 50px;
        }
        body
        {
          padding-left: 270px;
         background-color:#99ccff;
        }

        h4
        {
          font-family: "Georgia",serif;
          color: #2196f3;
        }
    </style>

</head>

<?php
require_once("config.php");
session_start();
$menu_items_for_emp=array('HOME','EDIT PROFILE','MY CLAIMS','TRACK CLAIM','NEW CLAIM');
$menu_link_for_emp=array('welcome_emp.php','emp_profile.php','emp_claim.php','allclaimfrtrack.php','claimfremp.php');

$menu_items_for_mgr=array('HOME','EDIT PROFILE','MY CLAIMS','TRACK CLAIM','PENDING FOR APPROVAL','NEW CLAIM');
$menu_link_for_mgr=array('welcome_emp.php','emp_profile.php','emp_claim.php','allclaimfrtrack.php','claim_req.php','claimfremp.php');

if (isset($_SESSION["emailid"])) {

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
          echo "<li class='active blue lighten-4'><a href=".$menu_link_for_emp[1]." class='waves-effect blue-text'><i class='material-icons blue-text'>edit</i>".$menu_items_for_emp[1]."</li>";
          echo "<li><a href=".$menu_link_for_emp[2]." class='waves-effect blue-text'><i class='material-icons blue-text'>library_books</i>".$menu_items_for_emp[2]."</li>";
          echo "<li><a href=".$menu_link_for_emp[3]." class='waves-effect blue-text'><i class='material-icons blue-text'>directions_run</i>".$menu_items_for_emp[3]."</li>";
          echo "<li><a href=".$menu_link_for_emp[4]." class='waves-effect blue-text'><i class='material-icons blue-text'>subject</i>".$menu_items_for_emp[4]."</li>";


    }
    else {

      echo "<li><a href=".$menu_link_for_mgr[0]." class='waves-effect blue-text'><i class='material-icons blue-text'>home</i>".$menu_items_for_mgr[0]."</li>";
      echo "<li class='active blue lighten-4'><a href=".$menu_link_for_mgr[1]." class='waves-effect blue-text'><i class='material-icons blue-text'>edit</i>".$menu_items_for_mgr[1]."</li>";
      echo "<li ><a href=".$menu_link_for_mgr[2]." class='waves-effect blue-text'><i class='material-icons blue-text'>library_books</i>".$menu_items_for_mgr[2]."</li>";//notifications
      echo "<li><a href=".$menu_link_for_mgr[3]." class='waves-effect blue-text'><i class='material-icons blue-text'>directions_run</i>".$menu_items_for_mgr[3]."</li>";
      echo "<li><a href=".$menu_link_for_mgr[4]." class='waves-effect blue-text'><i class='material-icons blue-text'>notifications</i>".$menu_items_for_mgr[4]."</li>";
      echo "<li><a href=".$menu_link_for_mgr[5]." class='waves-effect blue-text'><i class='material-icons blue-text'>subject</i>".$menu_items_for_mgr[5]."</li>";    }
    echo "</ul>";
    echo "<a href=''#'' data-activates='slide-out' class='button-collapse show-on-large'><i class='material-icons brgrmenu'>menu</i></a>";

    $sql     = "SELECT `eid`, `efname`, `elname`, `dept`, `type`, `dob`, `accno`, `bank_name`, `sal_per_ann`,
     `gender`, `mobno`, `emailid`, `doj`, `doc`, `street_addr`, `city`, `state`, `country`, `zipcode`, `pswd` FROM `emp_info`
      WHERE  `emailid`='$emailid'";

    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        echo "<div class='container'>";
        echo "<div class='card row'>";
        echo "<center><h4 class='col s12'><u>MY PROFILE</u></h4></center><br/><br/><br/><br/><br/>";
        echo "<form method='post' action='update.php'><center>";

        echo "<div class='row'>";
        echo "<div class='input-field col s6'>";
        echo "<input type='text' name='fname' value='" . $row["efname"] . "' class='validate'>";
        echo "<label class='blue-text'>First Name</label><br/><br/>";
        echo "</div>";
        echo "<div class='input-field col s6'>";
        echo "<input type='text' name='lname' value='" . $row["elname"] . "'>";
        echo "<label class='blue-text'>Last Name</label><br/><br/>";
        echo "</div>";
        echo "</div>";


        echo "<div class='row'>";
        echo "<div class='input-field col s6'>";
        echo "<input type='email' name='emailid' value='" . $row["emailid"] . "' class='validate'>";
        echo "<label class='blue-text'>Email Id</label><br/><br/>";
        echo "</div>";
        echo "</div>";

        echo "<div class='row'>";
        echo "<div class='input-field col s6'>";
        echo "<select name='dept'>";
        switch($row["dept"])
        {
            case "prod":
              echo "<option value='' disabled selected>Select your Department</option>
                    <option value='prod' selected>Production</option>
                    <option value='rnd'>Research and Development</option>
                    <option value='purchase'>Purchasing</option>
                    <option value='mktg'>Marketing</option>
                    <option value='hr'>Human Resource Management</option>
                    <option value='acc_n_fin'>Accounting and Finance</option>
                    </select>";
              break;

            case "rnd":
              echo "<option value='' disabled selected>Select your Department</option>
                    <option value='prod'>Production</option>
                    <option value='rnd' selected>Research and Development</option>
                    <option value='purchase'>Purchasing</option>
                    <option value='mktg'>Marketing</option>
                    <option value='hr'>Human Resource Management</option>
                    <option value='acc_n_fin'>Accounting and Finance</option>
                    </select>";
              break;

            case "purchase":
              echo "<option value='' disabled selected>Select your Department</option>
                    <option value='prod'>Production</option>
                    <option value='rnd'>Research and Development</option>
                    <option value='purchase' selected>Purchasing</option>
                    <option value='mktg'>Marketing</option>
                    <option value='hr'>Human Resource Management</option>
                    <option value='acc_n_fin'>Accounting and Finance</option>
                    </select>";
              break;

            case "mktg":
              echo "<option value='' disabled selected>Select your Department</option>
                    <option value='prod'>Production</option>
                    <option value='rnd'>Research and Development</option>
                    <option value='purchase'>Purchasing</option>
                    <option value='mktg' selected>Marketing</option>
                    <option value='hr'>Human Resource Management</option>
                    <option value='acc_n_fin'>Accounting and Finance</option>
                    </select>";
              break;

            case "hr":
              echo "<option value='' disabled selected>Select your Department</option>
                    <option value='prod'>Production</option>
                    <option value='rnd'>Research and Development</option>
                    <option value='purchase'>Purchasing</option>
                    <option value='mktg'>Marketing</option>
                    <option value='hr' selected>Human Resource Management</option>
                    <option value='acc_n_fin'>Accounting and Finance</option>
                    </select>";
              break;

            case "acc_n_fin":
              echo "<option value='' disabled selected>Select your Department</option>
                    <option value='prod'>Production</option>
                    <option value='rnd'>Research and Development</option>
                    <option value='purchase'>Purchasing</option>
                    <option value='mktg'>Marketing</option>
                    <option value='hr'>Human Resource Management</option>
                    <option value='acc_n_fin' selected>Accounting and Finance</option>
                    </select>";
              break;
        }

        echo "<label class='blue-text'>Department</label><br/><br/>";
        echo "</div>";
        echo "</div>";




        echo "<div class='row'>";
        echo "<div class='input-field col s6'>";
        echo "<select name='desg'>";
        switch ($row["type"]) {
          case "emp":
            echo  "<option value='' disabled selected>Select your Designation</option>
                   <option value='emp' selected>Employee</option>
                   <option value='ass_mgr'>Assistant Manager</option>
                   <option value='mgr'>Manager</option>
                   <option value='fin_mgr'>Finance Manager</option>
                 </select>";
            break;

          case "ass_mgr":
            echo  "<option value='' disabled selected>Select your Designation</option>
                   <option value='emp' selected>Employee</option>
                   <option value='ass_mgr' selected>Assistant Manager</option>
                   <option value='mgr'>Manager</option>
                   <option value='fin_mgr'>Finance Manager</option>
                 </select>";
            break;


          case "mgr":
            echo  "<option value='' disabled selected>Select your Designation</option>
                   <option value='emp' selected>Employee</option>
                   <option value='ass_mgr' selected>Assistant Manager</option>
                   <option value='mgr' selected>Manager</option>
                   <option value='fin_mgr'>Finance Manager</option>
                  </select>";
            break;


          case "fin_mgr":
            echo  "<option value='' disabled selected>Select your Designation</option>
                   <option value='emp' selected>Employee</option>
                   <option value='ass_mgr' selected>Assistant Manager</option>
                   <option value='mgr'>Manager</option>
                   <option value='fin_mgr' selected>Finance Manager</option>
                  </select>";
            break;
        }
        echo "<label class='blue-text'>Designation</label><br/><br/>";
        echo "</div>";
        echo "</div>";

        echo "<div class='row'>";
        echo "<div class='input-field col s6'>";
        echo "<input type='date' name='dob' value='" . $row["dob"] . "' class='validate datepicker'>";
        echo "<label class='blue-text'>DOB</label><br/><br/>";
        echo "</div>";
        echo "</div>";

        echo "<div class='row'>";
        echo "<div class='input-field col s6'>";
        echo "<input type='text' name='accnum' value='" . $row["accno"] . "' class='validate'>";
        echo "<label class='blue-text'>Account No.</label><br/><br/>";
        echo "</div>";
        echo "</div>";

        echo "<div class='row'>";
        echo "<div class='input-field col s6'>";
        echo "<input type='text' name='bank_name' value='" . $row["bank_name"] . "' class='validate'><br/><br/>";
        echo "<label class='blue-text'>Bank Name</label>";
        echo "</div>";
        echo "</div>";

        echo "<div class='row'>";
        echo "<div class='input-field col s6'>";
        echo "<input type='text' name='sal' value='" . $row["sal_per_ann"] . "' class='validate'>";
        echo "<label class='blue-text'>Salary per annum</label><br/><br/>";
        echo "</div>";
        echo "</div>";

        echo "<label class='left blue-text'>Gender</label><br/>";

        switch ($row["gender"]) {
          case 'Male':
            echo "<p>";
            echo "<input type='radio' name='gender' value='" . $row["gender"] . "' class='validate with-gap' id='r1' checked  >";
            echo "<label for='r1' class='blue-text'>Male</label>";
            echo "</p>";
            echo "<p>";
            echo "<input type='radio' name='gender' value='" . $row["gender"] . "' class='validate with-gap' id='r2'>";
            echo "<label for='r2' class='blue-text'>Female</label>";
            echo "</p><br/><br/>";
            break;

          case 'Female':
              echo "<p>";
              echo "<input type='radio' name='gender' value='" . $row["gender"] . "' class='validate with-gap' id='r1' checked  >";
              echo "<label for='r1' class='blue-text'>Male</label>";
              echo "</p>";
              echo "<p>";
              echo "<input type='radio' name='gender' value='" . $row["gender"] . "' class='validate with-gap' id='r2' checked>";
              echo "<label for='r2' class='blue-text'>Female</label>";
              echo "</p><br/><br/>";
              break;
      }

        echo "<div class='row'>";
        echo "<div class='input-field col s6'>";
        echo "<input type='text' name='mobno' value='" . $row["mobno"] . "' class='validate'>";
        echo "<label class='blue-text'>Mobile No</label><br/><br/>";
        echo "</div>";
        echo "</div>";


        echo "<div class='row'>";
        echo "<div class='input-field col s6'>";
        echo "<input type='date' name='doj' value='" . $row["doj"] . "' class='validate datepicker'>";
        echo "<label class='blue-text'>Date of joining</label><br/><br/>";
        echo "</div>";
        echo "</div>";

        echo "<div class='row'>";
        echo "<div class='input-field col s6'>";
        echo "<input type='text' name='street_addr' value='" . $row["street_addr"] . "' class='validate'>";
        echo "<label class='blue-text'>Street Address</label><br/><br/>";
        echo "</div>";
        echo "</div>";

        echo "<div class='row'>";
        echo "<div class='input-field col s6'>";
        echo "<input type='text' name='city' value='" . $row["city"] . "' class='validate'>";
        echo "<label class='blue-text'>City</label><br/><br/>";
        echo "</div>";
        echo "</div>";

        echo "<div class='row'>";
        echo "<div class='input-field col s6'>";
        echo "<input type='text' name='state' value='" . $row["state"] . "' class='validate'>";
        echo "<label class='blue-text'>State</label><br/><br/>";
        echo "</div>";
        echo "</div>";

        echo "<div class='row'>";
        echo "<div class='input-field col s6'>";
        echo "<input type='text' name='cntry' value='" . $row["country"] . "' class='validate'>";
        echo "<label class='blue-text'>Country</label><br/><br/>";
        echo "</div>";
        echo "</div>";

        echo "<div class='row'>";
        echo "<div class='input-field col s6'>";
        echo "<input type='text' name='zcode' value='" . $row["zipcode"] . "' class='validate'>";
        echo "<label class='blue-text'>Zip Code</label><br/><br/>";
        echo "</div>";
        echo "</div>";



        echo "<center><button type='submit'  class='btn waves-effect blue'><i class='large material-icons left'>person_outline</i>Update</button></center>";
        echo "</form>";

        echo "</div>"; //card class ends here
        echo "</div>";//container class  ends here
    }
    else {
      echo "0 results";
    }
}

else {
    echo "Please login first";
    header("refresh:2;url=login_emp.php");
}

?>


<body>

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
