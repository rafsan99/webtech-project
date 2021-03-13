<?php
include "includes/db_connect.inc.php";

  session_start();

  if(!isset($_SESSION['t_id']))
  {
    header("Location: aboutteacher.php");
  }

$tName = " ";
$tID = $_SESSION["t_id"];

  $sqlUserCheck = "SELECT * FROM teacher WHERE t_id = '$tID' ";
	$result = mysqli_query($conn, $sqlUserCheck);

  while($row = mysqli_fetch_assoc($result))
  {
  $tName= $row["t_name"];
  $tNameInDB  = $row['t_name'];
  $emailInDB = $row['t_email'];
  $tPhoneInDB = $row['t_phone'];
}


?>

<html>
  <head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
  </head>
  <body style="background-color:lightblue">
    <form action="aboutstudent.php" method="post">
      <div align="center">
          <h1 align = "center" style="color:Red"><b>About You</b></h1>
		<table>

      <tr>
          <td><label for="t_id">ID:</label></td>
          <td><?php echo $tID ?> </td>
            </tr>
              <tr>
          <td><br></td>
        <td><br></td>
      </tr>

		<tr>
        <td><label for="t_name">Name:</label></td>
        <td><?php echo $tNameInDB ?> </td>
        <br>
		</tr>
    <tr>
<td><br></td>
<td><br></td>
</tr>
		<tr>
        <td><label for="">Email: </label></td>
        <td><?php echo $emailInDB ?></td>
        <br>
        <br>
		</tr>
    <tr>
<td><br></td>
<td><br></td>
</tr>
        <tr>

        <td><label for="">Phone: </label></td>
            <td><?php echo $tPhoneInDB ?><br></td>
            <br>
        </tr>

        <br>
		</tr>
		</table>
  </div>
</form>
    <div align="right">
            <button style =" margin-right:10%; height:35px; width:120px;" id = "button" onclick="window.location.href = 'teacher.php';">Back To Profile</button>
    </div>


 </body>

 </html>
