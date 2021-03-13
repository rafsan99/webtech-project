<?php

include "includes/db_connect.inc.php";

  session_start();

  if(!isset($_SESSION['st_id']))
  {
    header("Location: checknotice.php");
  }

$sName = $class = " ";
$sID = $_SESSION["st_id"];

  $sqlUserCheck = "SELECT class FROM student WHERE st_id = '$sID' ";
	$result = mysqli_query($conn, $sqlUserCheck);

  while($row = mysqli_fetch_assoc($result))
  {
  $class = $row["class"];
}

$sql = "SELECT sub_id FROM routine WHERE class = '$class' ";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result))
{
$subID = $row["sub_id"];
}

?>



<html>
<head>

<title> Notice Page</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
</head>

    <style>

table {
border-collapse: collapse;
width: 100%;
color: #000000;
font-family: monospace;
font-size: 25px;
text-align: left;
font-size: 20px;
text-align: left;
}
th {
background-color: #000000;
color: white;
align:center;
}
tr:nth-child(even) {background-color: #f2f2f2}
}

</style>


<body>


<h1 align = "center"><b><u>Notices</u></b> </h1><br>
<br>
<br>
    <div style=" margin-left: 5%; width:800px;">
     <table id="table" border=".5" width = "30%" height = "20%">
       <tr>
    <th style="text-align:center; width:100px;">Sub ID</th>
    <th style="text-align:center; width:130px;">Teacher ID</th>
    <th style="text-align:center; width:200px;">Title</th>
    <th style="text-align:center; width:370px;">Description</th>
    <th style="text-align:center; width:100px;">Time</th>
    </tr>




       <?php
 include "includes/db_connect.inc.php";

       $sql = "SELECT * FROM notice Where sub_id = '$subID' ORDER BY timing DESC";
       $result = mysqli_query($conn,$sql);

       $numOFrow = mysqli_num_rows($result);

       if ($numOFrow > 0)
       {
       while($row = $result->fetch_assoc() )
           {
       echo '<tr>
                   <td align="center">'.$row['sub_id'].'</td>
                   <td align="center">'.$row['t_id'].'</td>
                   <td align="center">'.$row['title'].'</td>
                   <td align="center">'.$row['description'].'</td>
                   <td align="center">'.$row['timing'].'</td>
               </tr>';
       }
       echo "</table>";
       }
       else
       {
          echo "No Notice For You";
        }

         ?>




       </div>


</body>
</html>
