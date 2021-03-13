<?php

  include "includes/db_connect.inc.php";

 $tName = $tEmail = $tphone = $err = "" ;


  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    if(!empty($_POST['t_name'])){
      $tName = mysqli_real_escape_string($conn, $_POST['t_name']);
    }

    if(!empty($_POST['t_email'])){
      $tEmail = mysqli_real_escape_string($conn, $_POST['t_email']);
    }

    if(!empty($_POST['t_phone'])){
      $tphone = mysqli_real_escape_string($conn, $_POST['t_phone']);
    }


    $sqlUserCheck = "SELECT * FROM teacher WHERE t_email = '$tEmail' ";
    $result = mysqli_query($conn, $sqlUserCheck);

    $rowCount = mysqli_num_rows($result) ;

    if($rowCount > 0)
    {
      $err = "Teacher already exists!";
    }
    else {
      $sql = "INSERT INTO teacher(t_name,t_email,t_phone)
              VALUES ('$tName','$tEmail','$tphone');";

      mysqli_query($conn, $sql) or die( mysqli_error($conn));
       $err = "Teacher Added!";
    }
}
?>



<html>
  <head>
    <title>Add Teacher</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
  </head>

  <body style="background-color:lightblue">

    <form action="addTeacher.php" method="post">
     <br>
      <div align="center">
        <h1 style="color:Black"><u><b>Teacher's Info</b></u></h1>
		<table>
		<tr>
      <tr>
      <td> <br> </td>
      </tr>
      <tr>
      <td> <br> </td>
      </tr>
        <td><label for="t_name">Teacher's Name: <span style="color:red;">*</span> </label></td>
        <td><input type="text" name="t_name" class="form-control" required></td>
        <span style="color:red;"></span>
        <br>
		</tr>
    <tr>
    <td> <br> </td>
    </tr>

		<tr>
        <td><label for="t_email">Teacher's Email: <span style="color:red;">*</span> </label></td>
        <td><input type="email" name="t_email" class="form-control"  placeholder="@gmail.com" required></td>
        <span style="color:red;"> </span>
        <br>
		</tr>
<tr>
<td> <br> </td>
</tr>

		<tr>
        <td><label for="t_phone">Teacher's Phone: <span style="color:red;">*</span> </label></td>
        <td><input type="text" name="t_phone" class="form-control" required></td>
        <span style="color:red;"></span>
        <br>
		</tr>

		</table>
<br>
<br>

<input style="margin-left:100px;" type="reset" name="btn_reset" class="btn btn-info" value="Reset">


    <button style="margin-left:130px;" type="submit" name="button" id = "button" class="btn btn-info" value = "button">ADD</button>
    <span style="color:red"><?php echo $err; ?></span>
      </div>

</form>

<div align = "right">
<button style="margin:30px; margin-right:20%;" type="submit" name="button" class="btn btn-info" value = "button" onclick="window.location.href = 'admin.php';">Back To Profile</button>
  </div>


  </body>

  </html>
