<?php

define("DBHOST","localhost");
define("DBUSERNAME", "root");
define("DBPASSWORD","");
define("DBNAME","reimbursement_system");

$con=mysqli_connect(DBHOST,DBUSERNAME,DBPASSWORD,DBNAME);

if(!$con)
{
  die("Connection Failed :".mysqli_connect_error());
}

?>
