<?php
include "includes/db_connect.inc.php";

  session_start();

  if(!isset($_SESSION['st_id']))
  {
    header("Location: aboutstudent.php");
  }

$sID = $_SESSION["st_id"];


$sqlUserCheck = "SELECT * FROM student WHERE st_id = '$sID'";
$result = mysqli_query($conn, $sqlUserCheck);


while($row = mysqli_fetch_assoc($result))
{
  $stNameInDB  = $row['st_name'];
  $emailInDB = $row['st_email'];
  $stAddInDB   = $row['st_address'];
  $stPhoneInDB = $row['st_phone'];
  $sDOBinDB = $row['st_dob'];
  $sDeptInDB = $row['st_dept'];
  $stfNameInDB = $row['f_name'];
  $sfOccuInDB = $row['f_occu'];
  $stmNameInDB = $row['m_name'];
  $stmOccuInDB = $row['m_occu'];
  $sNationInDB = $row['nationality'];
  $sageInDB = $row['age'];
  $sgenderInDB = $row['gender'];
  $sbldInDB = $row['blood_group'];
  $sClassInDB = $row['class'];

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
          <td><label for="">ID:</label></td>
          <td><?php echo $sID ?> </td>
          <br>
      </tr>
		<tr>
        <td><label for="">Name:</label></td>
        <td><?php echo $stNameInDB ?> </td>

        <br>
		</tr>

		<tr>
        <td><label for="fa_name">Father's Name: </label></td>
        <td><?php echo $stfNameInDB ?></td>

        <br>
		</tr>

		<tr>
        <td><label for="fa_occupation">Father's Occupation:</label></td>
        <td><?php echo $sfOccuInDB ?></td>

        <br>
		</tr>

		<tr>
        <td><label for="m_name">Mother's Name:</label></td>
        <td><?php echo $stmNameInDB ?></td>

        <br>
		</tr>

		<tr>
        <td><label for="ma_occupation">Mother's Occupation:</label></td>
        <td><?php echo $stmOccuInDB ?></td>

        <br>
		</tr>

	    <tr>
        <td><label for="n_name">Nationality:</label></td>
        <td><?php echo $sNationInDB ?></td>

        <br>
		</tr>

		<tr>
        <td><label for="">Email: </label></td>
        <td><?php echo $emailInDB ?></td>
        <br>
		</tr>

		<tr>
        <td><label for="">Permanent Address:</label></td>
        <td><?php echo $stAddInDB ?><br></td>
        </tr>
		<tr>
		<td><label for="">Age:</label></td>
        <td><?php echo $sageInDB ?> <br></td>
        </tr>

        <tr>

        <td><label for="">Phone:</label></td>
            <td><?php echo $stPhoneInDB ?><br></td>
        </tr>
		<tr>

		<td><label for="">DOB:</label></td>
        <td><?php echo $sDOBinDB ?><br></td>
		</tr>
		<tr>
        <td><label for="">Gender:</label></td>
        <td><?php echo $sgenderInDB ?></td>
		</tr>
		<tr>
        <td><label for="">Class: </label></td>
        <td><?php echo $sClassInDB ?></td>
        </tr>

        <tr>
          <td><label for="">Department:</label></td>
          <td><?php echo $sDeptInDB ?> </td>
       </tr>
		<tr>
        <td><label for="">Blood Group:</label></td>
        <td><?php echo $sbldInDB ?></td>
        <br></tr>

		<tr>
        <br>
		</tr>
		</table>
  </div>
</form>
    <div align="right">
            <button style =" margin-right:10%; height:35px; width:120px;" id = "button" onclick="window.location.href = 'student.php';">Back To Profile</button>
    </div>


 </body>

 </html>
