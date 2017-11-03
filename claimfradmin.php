<html>


<?php
include 'config.php';
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
    echo "<li ><a href=" . $menu_link[4] . " class='waves-effect blue-text'><i class='material-icons blue-text'>event_note</i>" . $menu_items[4] . "</a></li>";
    echo "<li><a href=" . $menu_link[5] . " class='waves-effect blue-text'><i class='material-icons blue-text'>account_balance</i>" . $menu_items[5] . "</a></li>";
    echo "<li  class='active blue lighten-4'><a href=" . $menu_link[6] . " class='waves-effect blue-text'><i class='material-icons blue-text'>subject</i>" . $menu_items[6] . "</a></li>";
    echo "<li><a href=" . $menu_link[7] . " class='waves-effect blue-text'><i class='material-icons blue-text'>account_box</i>" . $menu_items[7] . "</a></li>";

  echo "</ul>";
  echo "</div>";

  //echo "<a href='#' data-activates='slide-out' class='button-collapse show-on-large'><i class='material-icons'>menu</i></a>";
    $chk = isset($_POST["billno"]) && isset($_SESSION["emailid"]) && isset($_SESSION["eid"]) && isset($_POST["billtype"]) && isset($_POST["bdate"]) && isset($_POST["bamnt"]) && isset($_POST["cc"]) && isset($_FILES["billpic"]) && $_POST["billno"] != " " && $_POST["billtype"] != " " && $_POST["bdate"] != " " && $_POST["bamnt"] != " " && $_POST["cc"] != " ";

    if ($chk) {

        //catching the form data
        $a = substr("clm" . md5(uniqid(rand(), true)), 0, 7);
        $b = $_POST["billno"];
        $c = "pending";
        $d = $_POST["billtype"];
        $e = $_POST["bdate"];
        $f = $_POST["bamnt"];
        $g = $_POST["cc"];
        $h = $_SESSION["emailid"];
        $i = $_SESSION["eid"];

        $sql1   = "SELECT `cc_id`, `cc_name`, `appr1`, `appr2`, `appr3`, `doc` FROM `cc_info` WHERE `cc_id` = '$g' ";
        $result = mysqli_query($con, $sql1);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo "able to fetch approver id";
            $j   = $row["appr1"];
            $k   = $row["cc_name"];


            $errors     = array();
            $file_name  = trim(str_replace(" ","_",$_FILES['billpic']['name']));
            //$file_name  = $_FILES['billpic']['name'];
            $file_size  = $_FILES['billpic']['size'];
            $file_tmp   = $_FILES['billpic']['tmp_name'];
            $file_type  = $_FILES['billpic']['type'];
            $file_ext   = strtolower(end(explode('.', $_FILES['billpic']['name'])));
            $extensions = array(
                "pdf",
                "PDF"
            );

            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "extension not allowed, please choose a PDF file.";
            }

            if ($file_size > 2097152) {
                $errors[] = 'File size must be exactly 2MB';
            }



            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, "images/" . $file_name);
                echo "Bill is uploaded and your claim is submitted";
            } else {
                print_r($errors);
            }
            $n = "images/".$file_name;

            $sql = "INSERT INTO `claim_info`(`claimid`, `emailid`, `billno`, `billtype`, `billamnt`, `billdate`,`billpic`, `cc_name`, `eid`, `pending_with`,`final_status`) VALUES('$a','$h','$b','$d','$f','$e','$n','$k','$i','$j','$c')";


            if (mysqli_query($con, $sql)) {
                echo "Inserted record in claim";
            } else {
                echo "i m else part";
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }


            //inserting data into claim tracker to insert claim data into the table
            //in order to track the claim
            $k = substr("clt" . md5(uniqid(rand(), true)), 0, 7);

            $p    = date("Y-m-d");
            $sql1 = "INSERT INTO `claim_tracker`(`id`, `claimid`, `appid`, `status`, `updated_date`) VALUES ('$k','$a','$j','$c','$p')";
            if (mysqli_query($con, $sql1)) {
                echo "Claim tracker updated successfully";
            } else {
                echo "Claim tracker is not updated ";
            }

            mysqli_close($con);

        } else {
            echo "not able to fetch approver id";
        }

    }
} else {
    echo "Please login first";
    header("refresh:2;url=login_emp.php");
}
?>


  <head>
    <meta charset="utf-8">
    <title>Claim form</title>
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
       h4
       {
         font-family: "Georgia",serif;
         color: #2196f3;
       }
     </style>

  </head>




  <body>
    <div class="col s12 m12  l19">
    <div class="container">
    <div class="card row">
    <center><h4 class="col s12"><u>Claim Form</u></h4></center><br/><br/>
    <form action="" method="post" enctype="multipart/form-data">


      <div class="row">
        <div class="input-field col s6">
          <input type="text" name="billno" class="vaidate">
          <label class="blue-text">Bill No</label>
        </div>
      </div>


      <div class="row">
        <div class="input-field col s6">
        <select name="billtype">
            <option value="" disabled selected>Select your Bill Type</option>
            <option value="medical">Medical Allowance</option>
            <option value="phone">Phone Allowance</option>
            <option value="travel">Travel Allowance</option>
            <option value="house_rent">House Rent Allowance</option>
            <option value="conveyance">Conveyance Allowance</option>
        </select>
        <label class="blue-text">Bill Type</label>
    </div>
  </div>

      <div class="row">
        <div class="input-field col s6">
              <input type="date" name="bdate" class="validate datepicker">
              <label class="blue-text">Bill Date</label>
        </div>
      </div>


        <div class="row">
          <div class="input-field col s6">
              <input type="text" name="bamnt" class="validate">
              <label class="blue-text">Bill Amount</label>
          </div>
        </div>

    <div class="row">
    <div class="input-field col s6">

      <?php
      $sql    = "SELECT `cc_id`, `cc_name` FROM `cc_info`";
      $result = mysqli_query($con, $sql);

      if (mysqli_num_rows($result) > 0) {
          echo "<select name='cc' required>";
          echo "<option value='' disabled selected>Select Cost Center</option>";
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value='" . $row["cc_id"] . "'>" . $row["cc_name"] . "</option>";
          }
          echo "</select>";
      } else {
          echo "0 results";
      }
      ?>
      <label class="blue-text">Cost Center Name</label>
    </div>
  </div>

    <div class="file-field input-field">
      <div class="btn blue white-text">
        <span>Upload Bill Picture(PDF)</span>
        <input type="file" name="billpic" required>
      </div>
      <div class="file-path-wrapper">
        <input type="text" class="file-path validate">
      </div>
    </div>

      <br/><br/>
      <center><button type="submit" class="btn waves-effect blue white-text	darken-1"><i class="large material-icons right ">send</i>Submit</button>



    </form>
      </div>
    </div>
    </div>
  </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script>
    $(document).ready(function() {
      $('select').material_select();
      });
      $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year,
         today: 'Today',
         clear: 'Clear',
         close: 'Ok',
        // closeOnSelect: false // Close upon selecting a date,
      });

      $(".button-collapse").sideNav();



    </script>
  </body>
</html>
