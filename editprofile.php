<?php

include "includes/db_connect.inc.php";

session_start();

if(!isset($_SESSION["admin_name"]))
{
  header("Location: admin.php");
}


$uName = $uPass = $message = " ";

$olduName = $_SESSION["admin_name"];


if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(!empty($_POST['u_name']))
	{
		$uName = mysqli_real_escape_string($conn, $_POST['u_name']);
	}
	if(!empty($_POST['u_pass']))
	{
		$uPass = mysqli_real_escape_string($conn, $_POST['u_pass']);
	}

$sql = "UPDATE admin
SET admin_name = '$uName', admin_pass = '$uPass'
WHERE admin_name = '$olduName' ";

mysqli_query($conn , $sql);


 echo "Profile is Updated";



}




?>

<html>
  <head>
    <br>
    <br>
    <br>
    <br>
    <br>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
  </head>

  <body style="background-color:lightblue">
    <div align="center">
  <img src="ISD.jpg" alt="ISD_logo" width="100px"></img><br><br>
  </div>


	<form action="editprofile.php" method="post">
    <h1 align="center"><b>Update Profile</b></h1>
  		<br>
  <div class="container" style="width:380px;">
			<label for="u_name">New Username: </label>
			<input type="text" name="u_name" class="form-control" value="" required>
      <br>
			<label for="u_pass">New Password: </label>
			<input type="password" name="u_pass" class="form-control" value="" required><br>
      <br>
        <div align ="center">
          <input style="margin-left:15%;" type="reset" name="btn_reset" class="btn btn-info"/>
			<button style="margin-left:20%;" type="submit" name="login" class="btn btn-info">Update </button>
</div>
</div>

	</form>

  <br>
  <div align = "right">
         <button style="margin-right:16%;" class="btn btn-info" onclick="window.location.href = 'admin.php';">Back to Profile</button>
  		</div>



  </body>
</html>
