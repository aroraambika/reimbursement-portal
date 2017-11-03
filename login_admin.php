<?php

	require_once('config.php');
	session_start(); //starting a  new session on the login of user

	if(isset($_POST["username"]) && isset($_POST["password"]))
	{
		$username = $_POST["username"];
		$password = $_POST["password"];

		$sql = "SELECT `a_id`, `username`, `pswd` FROM `admin_info` WHERE `username` = '$username' AND `pswd` = '$password' ";

		$result = mysqli_query($con, $sql);

		if (mysqli_num_rows($result) > 0) {
			echo "Success";
			$_SESSION["username"] = $username;
			header("refresh:2; url=welcome_admin.php");
		} else {
			echo "Username or password is not correct! Please re enter!";
		}
	}
?>
<html>

<head>
	<title>Admin login</title>
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
	}
	.material-icons.left
	{
					color: white;
	}

	</style>
</head>

  <body>
    <?php
      if(isset($_SESSION["username"]))
      {
        header("refresh:1; url=welcome_admin.php");
      }
      else {

    ?>

    <form method="POST">


			<div class="row">
				<div class="col s12">
					<div class="container">
					<div class="card">
						<div class="cardheader white-text">
				    <form method="POST">
									<center><h4> Welcome Back!</h4>
										Administrator Login
									</center>
							</div>

				<div class="centerofcard">

								<div class="row">
									<div class="input-field col s12">
											<i class="material-icons prefix blue-text">account_circle</i>
											<input type="text" name="username" class="validate">
											<label class="blue-text">Username</label>
									</div>
								</div>

								<div class="row">
									<div class="input-field col s12">
											<i class="material-icons prefix blue-text">lock_outline</i>
												<input type="password" name="password" class="validate">
											<label class="blue-text">Password</label><br><br>
									</div>
								</div>



				<center><button type="submit" class="btn waves-effect blue "><i class="large material-icons left ">lock_open</i>Login</button></center>

		</div>

		</form>
	</div>
	</div>
	</div>
	</div>

  </center>
  <?php
    }
  ?>
</body>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
	
</html>
