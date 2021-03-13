<?php
include "includes/db_connect.inc.php";



$sID = $stName = $stEmail = $stAdd = $stPhone = $stDob = $stfName = $stfOccu = $stmName = $stmOccu = $stClass = $message = "" ;



if($_SERVER["REQUEST_METHOD"]=="POST")
{
  if(!empty($_POST['st_id']))
  {
    $sID = mysqli_real_escape_string($conn, $_POST['st_id']);
  }

  if(!empty($_POST['stname'])){
    $stName = mysqli_real_escape_string($conn, $_POST['stname']);
  }
  if(!empty($_POST['stemail'])){
    $stEmail = mysqli_real_escape_string($conn, $_POST['stemail']);
  }
  if(!empty($_POST['stadd'])){
    $stAdd = mysqli_real_escape_string($conn, $_POST['stadd']);
  }
  if(!empty($_POST['stphone'])){
    $stPhone = mysqli_real_escape_string($conn, $_POST['stphone']);
  }
  if(!empty($_POST['stdob'])){
    $stDob = mysqli_real_escape_string($conn, $_POST['stdob']);
  }
  if(!empty($_POST['stfname'])){
    $stfName = mysqli_real_escape_string($conn, $_POST['stfname']);
  }
  if(!empty($_POST['stfoccu'])){
    $stfOccu = mysqli_real_escape_string($conn, $_POST['stfoccu']);
  }
  if(!empty($_POST['stmname'])){
    $stmName = mysqli_real_escape_string($conn, $_POST['stmname']);
  }
  if(!empty($_POST['stmoccu'])){
    $stmOccu = mysqli_real_escape_string($conn, $_POST['stmoccu']);
  }

  if(!empty($_POST['stclass'])){
    $stClass = mysqli_real_escape_string($conn, $_POST['stclass']);
  }

  $sqlUserCheck = "SELECT * FROM student WHERE st_email = '$stEmail' AND st_phone = '$stPhone' AND st_id != '$sID' ";
  $result = mysqli_query($conn, $sqlUserCheck) or die( mysqli_error($conn));
  $rowCount = mysqli_num_rows($result) ;

  if($rowCount > 0)
  {
    $message = "Recheck Email & Phone!";
  }

  else {

      $sql = "UPDATE student
      SET st_name = '$stName', st_email = '$stEmail', st_address = '$stAdd', st_phone = '$stPhone', st_dob = '$stDob', f_name = '$stfName',
      f_occu = '$stfOccu', m_name = '$stmName', m_occu = '$stmOccu', class = '$stClass'
      WHERE st_id = '$sID' ";

      mysqli_query($conn , $sql);

       $message =  "Student Info is Updated";

}

if(empty($_POST['st_id']))
  {
    $message = "Search results!!";
  }
}
?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta charset="utf-8">
    <h1 align = "center"><u>Edit Student Info</u></h1>
 </head>

    <style>

table {
border-collapse: collapse;
width: 100%;
color: #588c7e;
font-family: monospace;
font-size: 25px;
text-align: left;
font-size: 20px;
text-align: left;
}
th {
background-color: #588c7e;
color: white;
}
tr:nth-child(even) {background-color: #f2f2f2}
}

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
  <div align = "right">

  <button style =" margin-right:3%; height:30px; width:153px" id = "button" onclick="window.location.href = 'admin.php';">Back To Profile</button>
<br>
<br>

  </div>
    <form action="editstudent.php" method="post">
  <div align="left">
<p>
Student's ID:
<input type="text" name="st_id" id="st_id" readonly>
Student's Name:
<input type="text" name="stname" id="stname">
Father's Name:
<input type="text" name="stfname" id="stfname">
Father's Occupation:
<input type="text" name="stfoccu"id="stfoccu" >
Mother's Name:
<input type="text" name="stmname" id="stmname" >
Mother's Occupation:
<input type="text" name="stmoccu"id="stmoccu"  >
Email:
<input type="email" name="stemail" id="stemail" >
Permanent Address:
<textarea name="stadd" id="stadd" rows="2" cols="20" ></textarea>
Phone:
<input type="text" name="stphone" id="stphone"  >
DOB:
<input type="date" name="stdob" id="stdob" >
Class:
<input type="text" name="stclass" id="stclass" >

<button style ="height:26px; width:80px" type="submit" name="update" value="update" id="button">Update</button>
<br>
<br>
  <span style="color:red; margin-left:80%"><?php echo $message ?> </span>
</p>

<br>


<div align="left" style="margin-left: 50%; width:400px;">
<p>
<input type="text" name ="Search" placeholder="search by ID/Name" class="form-control" value="">
    <button style ="height:30px; width:100px; margin-left:75%;" type="search" class ="btn" id="Search">Search</button>
      </p>
</div>

 <table id="table" border=".5" width = "30%" height = "50%">

   <tr>
<th style="text-align:center;">Student Id</th>
<th style="text-align:center;">Student Name</th>
<th style="text-align:center;">Father's Name</th>
<th style="text-align:center;">Father's Occupation</th>
<th style="text-align:center;">Mother's Name</th>
<th style="text-align:center;">Mother's Occupation</th>
<th style="text-align:center;">Email</th>
<th style="text-align:center;">Address</th>
<th style="text-align:center;">Phone</th>
<th style="text-align:center;">DOB</th>
<th style="text-align:center;">Class</th>
</tr>


<?php

if(isset($_POST['Search']))
{
 $searchkey = $_POST['Search'];
    $sql2 = "SELECT * FROM student WHERE st_id LIKE '%$searchkey%' OR st_name LIKE '%$searchkey%'";
 }

 else
 {
     $sql2 = "SELECT * FROM student";
}

    $result2 = mysqli_query($conn , $sql2);

  while( $row = mysqli_fetch_assoc($result2) ): ?>
  <tr>
              <td align="center"><?php echo $row['st_id'] ?></td>
              <td align="center"><?php echo $row['st_name'] ?></td>
              <td align="center"><?php echo $row['f_name'] ?></td>
              <td align="center"><?php echo $row['f_occu'] ?></td>
              <td align="center"><?php echo $row['m_name'] ?></td>
              <td align="center"><?php echo $row['m_occu'] ?></td>
              <td align="center"><?php echo $row['st_email'] ?></td>
              <td align="center"><?php echo $row['st_address'] ?></td>
              <td align="center"><?php echo $row['st_phone'] ?></td>
              <td align="center"><?php echo $row['st_dob'] ?></td>
              <td align="center"><?php echo $row['class'] ?></td>

          </tr>

<?php endwhile; ?>

 </table>
   </div>
   <script>
            var table = document.getElementById('table');
            for(var i = 0; i <= table.rows.length; i++)
            {
                table.rows[i].onclick = function()
                {
                     //rIndex = this.rowIndex;
                     document.getElementById("st_id").value = this.cells[0].innerHTML;
                     document.getElementById("stname").value = this.cells[1].innerHTML;
                     document.getElementById("stfname").value = this.cells[2].innerHTML;
                     document.getElementById("stfoccu").value = this.cells[3].innerHTML;
                      document.getElementById("stmname").value = this.cells[4].innerHTML;
                       document.getElementById("stmoccu").value = this.cells[5].innerHTML;
                        document.getElementById("stemail").value = this.cells[6].innerHTML;
                         document.getElementById("stadd").value = this.cells[7].innerHTML;
                         document.getElementById("stphone").value = this.cells[8].innerHTML;
                         document.getElementById("stdob").value = this.cells[9].innerHTML;
                         document.getElementById("stclass").value = this.cells[10].innerHTML;
                };
            }

     </script>

   </form>

</body>
</html>
