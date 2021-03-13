<?php
include "includes/db_connect.inc.php";

session_start();
$uPass = $uName = "";


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

	$sqlUserCheck = "SELECT * FROM admin WHERE admin_name = '$uName'";
	$result = mysqli_query($conn, $sqlUserCheck)   or die( mysqli_error($conn));
	$rowCount = mysqli_num_rows($result) ;


	if($rowCount < 1)
	{
		$message = "User does not exist!";
	}
	else
{
		while($row = mysqli_fetch_assoc($result))
		{
			$uPassInDB = $row['admin_pass'];

			if($uPass == $uPassInDB)
			{
				$_SESSION['admin_name'] = $uName;
				header("Location: admin.php");
			}
			else{
				$message = "Wrong Password!";
			}
		}
	}
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

<form action="adminlogin.php" method="post">
	<h1 align="center"><b>Admin Login</b></h1>
		<br>
	<div class="container" style="width:380px;">
			<label for="u_name">Username: </label>
			<input type="text" name="u_name" class="form-control" value="" required><br>
			<label for="u_pass">Password: </label>
			<input type="password" name="u_pass" class="form-control" value="" required><br>
        <div align ="center">
<br>
<input style="margin-left:15%;" type="reset" name="btn_reset" class="btn btn-info"/>
			 	<button style="margin-left:20%;" type="submit" name="login" class="btn btn-info"> Login </button>
		</div>
				</div>

	</form>
	<div align="right">
						<button style="margin-right:20%; height:40px; width:80px" class="btn btn-info" onclick="window.location.href='Home.html';">Home</button>

		</div>


  </body>
</html>
