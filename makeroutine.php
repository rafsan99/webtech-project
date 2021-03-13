<?php

  include "includes/db_connect.inc.php";

  $uID = $uName = $sID = $sName = $sclass = $message = $sday = $eday = $time = $sNameInDB = $classInDB = "" ;

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
      $sclass = mysqli_real_escape_string($conn, $_POST['class']);
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


        $sqlUserCheck = "SELECT sub_name,class FROM routine WHERE sub_id = '$sID'";
        $result = mysqli_query($conn, $sqlUserCheck);

        $sql = "SELECT * FROM routine WHERE class = '$sclass' AND timing = '$time' ";
        $result1 = mysqli_query($conn, $sql);

        $rowCount = mysqli_num_rows($result1) ;


        $sql2 = "SELECT timing FROM routine WHERE t_id = '$uID'";
        $result2 = mysqli_query($conn, $sql2);

        $rowCount2 = mysqli_num_rows($result2) ;


        while($row = mysqli_fetch_assoc($result))
        {
          $sNameInDB = $row['sub_name'];
          $classInDB = $row['class'];
        }

        if($sNameInDB == $sName && $classInDB == $sclass)
        {
          $message = "Already made!";
        }
        elseif($rowCount > 0)
        {
          $message = "Time Clash!";
        }
        elseif($rowCount2 > 0)
        {
          $message = "Change Teacher!!";
        }

        else {
          $sql = "INSERT INTO routine(sub_id,sub_name,class,start_day,end_day,timing,t_id,t_name)
                  VALUES('$sID','$sName','$sclass','$sday','$eday','$time','$uID','$uName');";

          mysqli_query($conn, $sql) or die( mysqli_error($conn));

          $message = "Routine made!!";

        }

        if(empty($_POST['sub_id']))
        {
          if(empty($_POST['user_id']))
          {
          $message = "Search results!!";
        }
      }
        elseif(empty($_POST['user_id']))
        {
          if(empty($_POST['sub_id']))
          {
          $message = "Search results!!";
        }

        }
}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <meta charset="utf-8">
    <h1 align = "center"><u>Make Routine</u></h1>
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

  <button style =" margin-right:3%; height:35px; width:110px" id = "button" onclick="window.location.href = 'admin.php';">Back To Profile</button>

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


    <form onsubmit="return validate()" action="makeroutine.php" method="post" >

    <p><b>Subject ID:</b>
    <input type="text" name ="sub_id" id ="sub_id" required readonly/>
    <b>Subject Name:</b>
    <input type="text" name ="sub_name" id ="sub_name" required readonly/>
    <b>Class:</b>
    <input type="text" name ="class" id = "class" required readonly/><br><br>
    <b>Teacher ID:</b>
    <input type="text" name ="user_id" id ="user_id" required readonly/>
    <b>Teacher Name:</b>
    <input type="text" name ="user_name" id ="user_name" required readonly><br><br>
     <b>Day Start</b><select name="day" id="day" required>
              <option value="" disabled selected>Select Day</option>
              <option value="Saturday"selected>Saturday</option>
              <option value="Sunday">Sunday</option>
              <option value="Monday">Monday</option>
    		  <option value="Tuesday">Tuesday</option>
    		  <option value="Wednesday">Wednesday</option>
              <option value="Thursday">Thursday</option>
            </select>
    <b>To</b> <select name="day1" id="day1" required>
              <option value="" disabled selected>Select Day</option>
              <option value="Saturday">Saturday</option>
              <option value="Sunday">Sunday</option>
              <option value="Monday">Monday</option>
    		  <option value="Tuesday">Tuesday</option>
    		  <option value="Wednesday">Wednesday</option>
              <option value="Thursday" selected>Thursday</option>
            </select>

    <b>Timing</b>
    <select name="time" id="time" required>
              <option value="" disabled selected>Select Time</option>
              <option value="9:00-10:00AM" selected>9:00-10:00AM</option>
              <option value="10:00-11:00AM">10:00-11:00AM</option>
              <option value="11:00-12:00PM">11:00-12:00PM</option>
          <option value="12:00-1:00PM">12:00-1:00PM</option>
          <option value="1:00-2:00PM">1:00-2:00PM</option>
              <option value="2:00-3:00PM">2:00-3:00PM</option>
            </select>
            <button style ="height:30px; width:90px" type="submit" name="make" value="make" id="button">Make</button>
<br>
            <span style="color:red; margin-left:40%"><?php echo $message ?> </span>
            </p>
 <div>

   <table id="table4"  height = "20%" style="width:50%; float:left">
   <tr>
     <td>
   <div align="left" style="margin-left: 53%; width:400px;">
   <p>
   <input type="text" name ="Search" placeholder="search book by ID/Name" class="form-control" value="">
       <button style ="height:30px; width:100px; margin-left:75%;" type="search" class ="btn" id="Search">Search</button>
         </p>
       </div></td>
   </tr>
  </table>


   <table id="table3"  height = "20%" style="width:50%; float:left">
   <tr>
     <td>  <div align="right" style="margin-left:52%; width:400px;">
     <p>
     <input type="text" name ="Search1" placeholder="search by teacher ID/Name" class="form-control" value="">
         <button style ="height:30px; width:100px; margin-left:75%;" type="search" class ="btn" id="Search1">Search</button>
           </p>

     </div></td>
 </tr>

</table>


    <table id="table" border=".5" height = "50%" style="width:50%; float:left">

      <tr>
<th align="center" style="width:100px;">Subject Id</th>
<th align="center" style="width:100px;">Subject Name</th>
<th align="center" style="width:100px;">Class</th>

</tr>
<tbody>
  <?php

  if(isset($_POST['Search']))
  {
   $searchkey = $_POST['Search'];
      $sql2 = "SELECT * FROM subjects WHERE sub_id LIKE '%$searchkey%' OR sub_name LIKE '%$searchkey%'";
   }

   else
   {
       $sql2 = "SELECT * FROM subjects";
  }

      $result2 = mysqli_query($conn , $sql2);

    while( $row = mysqli_fetch_assoc($result2) ): ?>
    <tr>
                <td align="center"><?php echo $row['sub_id'] ?></td>
                <td align="center"><?php echo $row['sub_name'] ?></td>
                <td align="center"><?php echo $row['sub_class'] ?></td>
            </tr>

  <?php endwhile; ?>


</tbody>

    </table>


    <table id="table1" border=".5" height = "50%" style="width:50%; float:left">
      <tr>
  <th align="center" style="width:100px;">Teacher Id</th>
  <th align="center" style="width:100px;">Teacher Name</th>

  </tr>

  <?php

  if(isset($_POST['Search1']))
  {
   $searchkey = $_POST['Search1'];
      $sql2 = "SELECT * FROM teacher WHERE t_id LIKE '%$searchkey%' OR t_name LIKE '%$searchkey%'";
   }

   else
   {
       $sql2 = "SELECT * FROM teacher";
  }

      $result2 = mysqli_query($conn , $sql2);

    while( $row = mysqli_fetch_assoc($result2) ): ?>
    <tr>
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
                   };
            }
               </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

                  <script>
                      $( document ).ready(function()
                       {

                        $("#table1 tbody").on('click', 'tr', function()
                        {
                            //get row contents into an array
                            var rowData = $(this).children("td").map(function() {
                                           return $(this).text();
                            }).get();
                            $("#user_id").val(rowData[0])
                            $("#user_name").val(rowData[1])

                        });

                      });

                  </script>


      </form>

  </body>
</html>
