<?php

	session_start();

	session_unset();

	session_destroy();

	echo "Successfully Logged Out!";

	header("refresh:1; url=login_admin.php");
?>
