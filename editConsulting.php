<?php

  include "includes/db_connect.inc.php";

  $uID = $uName = $uEmail = $room = $time = $message =  "" ;

  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    if(!empty($_POST['user_id']))
    {
      $uID = mysqli_real_escape_string($conn, $_POST['user_id']);
    }

    if(!empty($_POST['user_name']))
    {
      $uName = mysqli_real_escape_string($conn, $_POST['user_name']);
    }

    if(!empty($_POST['user_email']))
    {
      $uEmail = mysqli_real_escape_string($conn, $_POST['user_email']);
    }

    if(!empty($_POST['room']))
    {
      $room = mysqli_real_escape_string($conn, $_POST['room']);
    }
    if(!empty($_POST['time']))
    {
      $time = mysqli_real_escape_string($conn, $_POST['time']);
    }

    $sqlUserCheck = "SELECT * FROM teachers_consulting WHERE room = '$room' AND t_id != '$uID' ";
  	$result = mysqli_query($conn, $sqlUserCheck) or die( mysqli_error($conn));
  	$rowCount = mysqli_num_rows($result) ;

  	if($rowCount > 0)
  	{
      $message = "Change room no!";
    }

    else {
      $sql = "UPDATE `teachers_consulting`
      SET t_id = '$uID', t_name = '$uName', email = '$uEmail', room = '$room' ,time = '$time' WHERE t_id = '$uID' ";

      mysqli_query($conn, $sql) or die( mysqli_error($conn));

      $message = "Consulting updated!!";

    }

    if(empty($_POST['user_id']))
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
    <h1 align = "center"><u>Edit Consulting</u></h1>
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



<body style="background-color:lightblue">

<br>
<br>
  <div align = "right">

  <button style =" margin-right:3%; height:35px; width:153px" id = "button" onclick="window.location.href = 'manageconsulting.html';">Back To Management</button>
  <br>
  <br>
  </div>
    <form action="editConsulting.php" method="post">
  <div align="left" style="margin-left: 10%;">
    <p>Teacher ID:
    <input type="text" name ="user_id" id ="user_id" readonly>
    Teacher Name:
    <input type="text" name ="user_name" id ="user_name" readonly>
    Teacher Email:
    <input type="text" name ="user_email" id ="user_email" readonly>
    Room:
    <input type="text" name ="room" id ="room">
    Time:
    <select name="time" id="time" >
             <option value="8:00-9:00AM" selected>8:00-9:00AM</option>
             <option value="3:00-4:00PM">3:00-4:00PM</option>
      </select>
      <button style ="height:30px; width:100px" type="submit" name="set" value="set" id="button">Update</button>
<br>
<br>
        <span style="margin-left:80%; color:red"><?php echo $message ?> </span>
        </p>
   <br>
 </div>

 <div align="left" style="margin-left: 50%; width:400px;">
<p>
<input type="text" name ="Search" placeholder="search by ID/Name" class="form-control" value="">
     <button style ="height:30px; width:100px; margin-left:75%;" type="search" class ="btn" id="Search">Search</button>
       </p>
</div>

   <div align="left"style="margin-left: 10%; width:1200px">
    <table id="table" border=".5" width = "30%" height = "50%">

      <tr>
<th style="text-align:center;">Teacher Id</th>
<th style="text-align:center;">Teacher Name</th>
<th style="text-align:center;">Teacher Email</th>
<th style="text-align:center;">Room</th>
<th style="text-align:center;">Time</th>
</tr>

<?php

if(isset($_POST['Search']))
{
 $searchkey = $_POST['Search'];
    $sql = "SELECT * FROM teachers_consulting WHERE t_id LIKE '%$searchkey%' OR t_name LIKE '%$searchkey%'";
 }

 else
 {
     $sql = "SELECT * FROM teachers_consulting";
}

    $result = mysqli_query($conn , $sql);

  while( $row = mysqli_fetch_assoc($result) ): ?>
  <tr>
              <td align="center"><?php echo $row['t_id'] ?></td>
              <td align="center"><?php echo $row['t_name'] ?></td>
              <td align="center"><?php echo $row['email'] ?></td>
              <td align="center"><?php echo $row['room'] ?></td>
              <td align="center"><?php echo $row['time'] ?></td>
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
                        document.getElementById("user_id").value = this.cells[0].innerHTML;
                        document.getElementById("user_name").value = this.cells[1].innerHTML;
                        document.getElementById("user_email").value = this.cells[2].innerHTML;
                        document.getElementById("room").value = this.cells[3].innerHTML;
                   };
               }

        </script>

      </form>

  </body>
</html>
