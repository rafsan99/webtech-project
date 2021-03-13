<?php
include "includes/db_connect.inc.php";

session_start();
$uPass = $uID = "";


if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(!empty($_POST['user_id']))
	{
		$uID = mysqli_real_escape_string($conn, $_POST['user_id']);
	}
	if(!empty($_POST['u_pass']))
	{
		$uPass = mysqli_real_escape_string($conn, $_POST['u_pass']);
	}

	$sqlUserCheck = "SELECT * FROM teacher WHERE t_id = '$uID'";
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
			$uPassInDB = $row['t_pass'];
			//$uName = $row['st_name'];;

			if($uPass == $uPassInDB)
			{
				$_SESSION['t_id'] = $uID;
				header("Location: teacher.php");
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


<form action="teacherlogin.php" method="post">
<div class="container" style="width:380px;">
	  <h1 align="center"><b>Teacher Login</b></h1>
		<br>
			<label for="user_id">UserID: </label>
			<input type="text" name="user_id" class="form-control" required><br>
			<label for="u_pass">Password: </label>
			<input type="password" name="u_pass" class="form-control" required><br>
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
