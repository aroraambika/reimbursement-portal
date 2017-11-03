<?php

	require_once('config.php');
	session_start(); //starting a  new session on the login of user

	if(isset($_POST["emailid"]) && isset($_POST["password"]))
	{
		$emailid = $_POST["emailid"];
		$password = $_POST["password"];
		if(isset($_POST["remember_me"]))
		{
			setcookie("emailid",$emailid,time()+3600);
			setcookie("password",$password,time()+3600);
		}
		else{
			if(isset($_COOKIE["emailid"]))
			{
				setcookie("emailid","",time()-60);
			}
			if(isset($_COOKIE["password"]))
			{
				setcookie("password","",time()-60);
			}
		}

		$sql = "SELECT `eid`, `efname`, `elname`, `dept`, `type`, `dob`, `accno`, `bank_name`, `sal_per_ann`,
     `gender`, `mobno`, `emailid`, `doj`, `doc`, `street_addr`, `city`, `state`, `country`,
      `zipcode`, `pswd` FROM `emp_info` WHERE `emailid`='$emailid' AND `pswd`='$password'";

		$result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) >0) {
			echo "Success";
      $row=mysqli_fetch_assoc($result);
			$_SESSION["emailid"]=$row["emailid"];
      $_SESSION["fname"]=$row["efname"];
      $_SESSION["lname"]=$row["elname"];
      $_SESSION["eid"]=$row["eid"];
      $_SESSION["type"]=$row["type"];
					header("refresh:2; url=welcome_emp.php");

		} else {
			echo "Emaild or password is not correct! Please re enter!";
		}
	}
?>
<html>
<head>


	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
 <!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<style type="text/css">
		.card
		{
			margin: 0 auto;
			margin-top: 50px;
			border-radius: 25px;
		}
		body
		{
			margin: 0 auto;
			max-width:40rem;
			padding: 6px;
			background-color:#99ccff;
		}
		.cardheader
		{
			background-color:#2196f3;
			border-top-left-radius: 25px;
			border-top-right-radius: 25px;
			padding: 20px;


		}
		.centerofcard
		{
			padding: 50px;
			padding-top: 30px;
		}
		.material-icons.left
		{
						color: white;
		}

	</style>

	<title>Login page</title>

</head>
  <body>
    <?php
     if(isset($_SESSION["emailid"]))
      {
        header("refresh:1; url=welcome_emp.php");
      }
      else {

    ?>
		<div class="row">
			<div class="col s12">
				<div class="container">
				<div class="card">
					<div class="cardheader white-text">
			    <form method="POST">
								<center><h4> Welcome Back!</h4>
									<h6>Sign In</h6>
								</center>
						</div>

					<div class="centerofcard">
						<div class="row">
						 <div class="input-field col s12">
							 <i class="material-icons prefix blue-text">mail_outline</i>
							 <input type="email" name="emailid" class="validate" value="<?php if(isset($_COOKIE['emailid'])) echo $_COOKIE['emailid']; ?>" required/>
							 <label class="blue-text">EmailId</label>
						 </div>
						</div>

						<div class="row">
		 				 <div class="input-field col s12">
							 <i class="material-icons prefix blue-text">lock_outline</i>
							 <input type="password" name="password" class="validate" value="<?php if(isset($_COOKIE['password'])) echo $_COOKIE['password']; ?>"  required/>
							 <label class="blue-text">Password</label>
						 </div>
					 </div>

						<p>
							<input type="checkbox" name="remember_me" class="validate" id="remember_me" checked/>
							<label for="remember_me" class="blue-text">Remember Me</label>
						</p>

			    	<center><button type="submit" class="btn waves-effect blue "><i class="large material-icons left ">lock_open</i>Login</button></center>
					</div>
			    </form>
				</div>
				</div>
			</div>
		</div>
  <?php
   }
  ?>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  </body>
</html>
