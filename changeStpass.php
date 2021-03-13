<?php

include "includes/db_connect.inc.php";

session_start();

if(!isset($_SESSION['st_id']))
{
  header("Location: changeStpass.php");
}


$conPass = $uPass = $message = " ";

$olduName = $_SESSION["st_id"];


if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(!empty($_POST['u_pass']))
	{
		$uPass = mysqli_real_escape_string($conn, $_POST['u_pass']);
	}

  if(!empty($_POST['con_pass']))
  {
    $conPass = mysqli_real_escape_string($conn, $_POST['con_pass']);
  }


if($conPass == $uPass)
{
$sql = "UPDATE student
SET st_pass = '$conPass'
WHERE st_id = '$olduName' ";

mysqli_query($conn , $sql);

 $message = "Password changed";

}
else {
    $message = "Password does not match!!!";
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
  <img src="ISD.JPG" alt="ISD_logo" width="100px"></img><br><br>
  </div>


	<form action="changeStpass.php" method="post">
    <h1 align="center"><b>Change password</b></h1>
  		<br>
  <div class="container" style="width:380px;">
			<label for="u_name">New Password: </label>
			<input type="password" name="u_pass" class="form-control" value="" required>
      <br>
			<label for="u_pass">Confirm Password: </label>
			<input type="password" name="con_pass" class="form-control" value="" required><br>
      <span style="color:red; margin-left:30%">  <?php echo $message ?> </span>
      <br>
        <div align ="center">
          <input style="margin-left:15%;" type="reset" name="btn_reset" class="btn btn-info"/>
			<button style="margin-left:20%;" type="submit" name="login" class="btn btn-info">Change </button>
</div>
</div>

	</form>

  <br>
  <div align = "right">
         <button style="margin-right:16%;" class="btn btn-info" onclick="window.location.href = 'student.php';">Back to Profile</button>
  		</div>



  </body>
</html>
