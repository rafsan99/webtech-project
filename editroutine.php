<?php

  include "includes/db_connect.inc.php";

  $sID = $sName = $sday = $eday = $time = $class = $uID = $uName = $message =  "" ;

  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    if(!empty($_POST['sub_id']))
    {
      $sID = mysqli_real_escape_string($conn, $_POST['sub_id']);
    }
    if(!empty($_POST['sub_name']))
    {
      $sName = mysqli_real_escape_string($conn, $_POST['sub_name']);
    }

    if(!empty($_POST['class']))
    {
      $class = mysqli_real_escape_string($conn, $_POST['class']);
    }
    if(!empty($_POST['day']))
    {
      $sday = mysqli_real_escape_string($conn, $_POST['day']);
    }
    if(!empty($_POST['day1']))
    {
      $eday = mysqli_real_escape_string($conn, $_POST['day1']);
    }

    if(!empty($_POST['time']))
    {
      $time = mysqli_real_escape_string($conn, $_POST['time']);
    }
    if(!empty($_POST['t_id']))
    {
      $uID = mysqli_real_escape_string($conn, $_POST['t_id']);
    }
    if(!empty($_POST['t_name']))
    {
      $uName = mysqli_real_escape_string($conn, $_POST['t_name']);
    }


    $sql = "SELECT * FROM routine WHERE class = '$class' AND timing = '$time' AND sub_id != '$sID' ";
    $result = mysqli_query($conn, $sql);

    $rowCount = mysqli_num_rows($result) ;

            $sql2 = "SELECT timing FROM routine WHERE t_id = '$uID' AND timing = '$time' ";
            $result1 = mysqli_query($conn, $sql2);

            $rowCount2 = mysqli_num_rows($result1) ;


     if($rowCount > 0)
    {
      $message = "Time Clash!";
    }
    elseif($rowCount2 > 0)
    {
      $message = "Teacher's time clash!!";
    }
    else {

    $sql = "UPDATE routine
    SET start_day = '$sday', end_day = '$eday', timing = '$time' ,
    t_id = '$uID', t_name = '$uName'
    WHERE sub_id = '$sID' ";


    mysqli_query($conn , $sql);


     $message =  "Routine is Updated";
}
if(empty($_POST['sub_id']))
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
    <h1 align = "center"><u>Update Routine</u></h1>
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


  <div align = "right">

  <button style =" margin-right:3%; height:30px; width:110px" id = "button" onclick="window.location.href = 'admin.php';">Back To Profile</button>

  </div>



  <script>
       function validate()
       {

           var a = document.getElementById("day").value;
           var b = document.getElementById("day1").value;

           if (a==b)
           {
              alert(" Start & End Day same!!");
              return false;
           }
           else
           {
              return true;
           }
         }
</script>

<br>
<br>
    <form onsubmit="return validate()" action="editroutine.php" method="post" >
  <div align="left" style="margin-left:13%">
    <p>Subject ID:
    <input type="text" name ="sub_id" id ="sub_id" readonly>
    Subject Name:
    <input type="text" name ="sub_name" id ="sub_name" readonly>
    Class:
    <input type="text" name ="class" id ="class" readonly><br>
    Teacher ID:
    <input type="text" name ="t_id" id ="t_id">
    Teacher Name:
    <input type="text" name ="t_name" id ="t_name" >
    <b>Day Start</b><select name="day" id="day" >
             <option value="Saturday" selected>Saturday</option>
             <option value="Sunday">Sunday</option>
             <option value="Monday">Monday</option>
         <option value="Tuesday">Tuesday</option>
         <option value="Wednesday">Wednesday</option>
             <option value="Thursday">Thursday</option>
           </select>
   <b>To</b> <select name="day1" id="day1" >
             <option value="Saturday">Saturday</option>
             <option value="Sunday">Sunday</option>
             <option value="Monday">Monday</option>
         <option value="Tuesday">Tuesday</option>
         <option value="Wednesday">Wednesday</option>
             <option value="Thursday" selected>Thursday</option>
           </select>
           <b>Timing</b>
           <select name="time" id="time">
                     <option value="9:00-10:00AM" selected>9:00-10:00AM</option>
                     <option value="10:00-11:00AM">10:00-11:00AM</option>
                     <option value="11:00-12:00PM">11:00-12:00PM</option>
                 <option value="12:00-1:00PM">12:00-1:00PM</option>
                 <option value="1:00-2:00PM">1:00-2:00PM</option>
                     <option value="2:00-3:00PM">2:00-3:00PM</option>
                   </select>
                   <button style ="height:35px; width:100px" type="submit" name="update" value="update" id="button">Update</button>
                  <br>
                  <br>
                   <span style="color:red; margin-left:60%"><?php echo $message ?> </span>

                   </p>
   <br>
</div>

   <div align="left" style="margin-left: 60%; width:400px;">
 <p>
 <input type="text" name ="Search" placeholder="search by subject ID/Name" class="form-control" value="">
       <button style ="height:30px; width:100px; margin-left:75%;" type="search" class ="btn" id="Search">Search</button>
         </p>

  </div>
    <table id="table" border=".5" width = "30%" height = "50%">

      <tr>
<th style="text-align:center;">Subject Id</th>
<th style="text-align:center;">Subject Name</th>
<th style="text-align:center;">Class</th>
<th style="text-align:center;">Start Day</th>
<th style="text-align:center;">End Day</th>
<th style="text-align:center;">Time</th>
<th style="text-align:center;">Teacher Id</th>
<th style="text-align:center;">Teacher Name</th>
</tr>

      <?php
      if(isset($_POST['Search']))
      {
       $searchkey = $_POST['Search'];
          $sql2 = "SELECT * FROM routine WHERE sub_id LIKE '%$searchkey%' OR sub_name LIKE '%$searchkey%'";
    
       }

       else
       {
           $sql2 = "SELECT * FROM routine";
      }

          $result2 = mysqli_query($conn , $sql2);

        while( $row = mysqli_fetch_assoc($result2) ): ?>
        <tr>
                    <td align="center"><?php echo $row['sub_id'] ?></td>
                    <td align="center"><?php echo $row['sub_name'] ?></td>
                    <td align="center"><?php echo $row['class'] ?></td>
                    <td align="center"><?php echo $row['start_day'] ?></td>
                    <td align="center"><?php echo $row['end_day'] ?></td>
                    <td align="center"><?php echo $row['timing'] ?></td>
                    <td align="center"><?php echo $row['t_id'] ?></td>
                    <td align="center"><?php echo $row['t_name'] ?></td>
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
                        document.getElementById("sub_id").value = this.cells[0].innerHTML;
                        document.getElementById("sub_name").value = this.cells[1].innerHTML;
                        document.getElementById("class").value = this.cells[2].innerHTML;
                        document.getElementById("t_id").value = this.cells[6].innerHTML;
                        document.getElementById("t_name").value = this.cells[7].innerHTML
                   };
               }

        </script>

      </form>

  </body>
</html>
