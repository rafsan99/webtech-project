<?php

include "includes/db_connect.inc.php";

  session_start();

  if(!isset($_SESSION["admin_name"]))
  {
    header("Location: admin.php");
  }

$admin_id = "";
$admin_name = $_SESSION["admin_name"];

  $sqlUserCheck = "SELECT admin_id FROM admin WHERE admin_name = '$admin_name' ";
	$result = mysqli_query($conn, $sqlUserCheck);

  while($row = mysqli_fetch_assoc($result))
  {
  $admin_id= $row["admin_id"];
}

?>



<html>
  <head>
    <title>International School Dhaka</title>
	<link rel="stylesheet" type="text/css" href="style1.css"/>
  </head>


    <style media="screen">

    #button {

  	background:linear-gradient(to bottom, #6495ED 5%, #6495ED 100%);
  	background-color:#6495ED;
  	border-radius:1px;
  	display:inline-block;
  	cursor:pointer;
  	color:#ffffff;
  	font-family:Arial;
  	font-size:15px;
  	font-weight:bold;
  	padding:9px 22px;
  	text-decoration:none;
  	text-shadow:0px 1px 0px #3d768a;
  }
  #button:hover {
  	background:linear-gradient(to bottom, #408c99 5%, #599bb3 100%);
  	background-color:#6495ED;
  }
  #button:active {
  	position:relative;
  	top:1px;
  }
    </style>


  <body>
    <img src="ISD.jpg" alt="ISD_logo" width="100px"></img>

	  <div id ="container">
	    <div id="header">
		 <h1>International School Dhaka</h1>
		 </div>
		 <div id="content">
		   <div id="nav">
		      <h3>Admin Information</h3>
          <br>
          <br>
          <p><b>ID: </b> <?php echo $admin_id ?> </p>
		    <p><b>Name: </b><?php echo $admin_name ?></p>

		   </div>
		   <div id="main">
		       <ul>
				<li><a href="addTeacher.php"><b>Add Teacher</b></a></li><br>
        <li><a href="editteacher.php"><b>Edit Teacher Info</b></a></li><br>
				<li><a href="removeTeacher.php"><b>Remove Teacher</b></a></li><br>
        <li><a href="manageconsulting.html"><b>Manage Consulting</b></a></li><br>
        <li><a href="editstudent.php"><b>Edit Student Info</b></a></li><br>
				<li><a href="removestudent.php"><b>Remove Student</b></a></li><br>
        <li><a href="addsubject.php"><b>Add Subject</b></a></li><br>
        <li><a href="removesubject.php"><b>Remove Subject</b></a></li><br>
				<li><a href="addnotice.php"><b>Add Notice</b></a></li><br>
        <li><a href="makeroutine.php"><b>Make Routine</b></a></li><br>
        <li><a href="editroutine.php"><b>Update Routine</b></a></li><br>
        <li><a href="managelibrary.html"><b>Manage Library</b></a></li><br>

			 </ul>

		   </div>
		 </div>

		  <div id="footer">

			<ul>
        <li><a href="editprofile.php"><b>Update Profile Info</b></a></li><br>

         <div align="right">
        <button style="margin-right:10%;" id = "button" onclick="window.location.href = 'home.html';">Logout</button>
      </div>


			 </ul>
		  </div>

	  </div>

  </body>
</html>
