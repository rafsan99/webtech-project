<?php

  include "includes/db_connect.inc.php";

  $uID = $uName = $uEmail = $uPhone =  $message =  "" ;

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

    if(!empty($_POST['user_phone']))
    {
      $uPhone = mysqli_real_escape_string($conn, $_POST['user_phone']);
    }




        $sqlUserCheck = "SELECT t_email FROM teacher WHERE t_id != '$uID' AND t_email = '$uEmail'";
        $result = mysqli_query($conn, $sqlUserCheck);

        $rowCount = mysqli_num_rows($result) ;

        if($rowCount > 0)
        {
          $message = "Gmail clash!!";
        }

        else {

    $sql = "UPDATE teacher
    SET t_name = '$uName', t_email = '$uEmail', t_phone = '$uPhone'
    WHERE t_id = '$uID' ";

    mysqli_query($conn , $sql);


     $message =  "Teacher Info is Updated";
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
    <h1 align = "center"><u>Edit Teacher Info</u></h1>
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
    <form action="" method="post">

  <div align="left" style="margin-left: 10%;">
<br>
<br>
<br>
<br>
    <p>Teacher ID:
    <input type="text" name ="user_id" id ="user_id" readonly>
    Teacher Name:
    <input type="text" name ="user_name" id ="user_name">
    Teacher Email:
    <input type="text" name ="user_email" id ="user_email">
    Teacher Phone:
    <input type="text" name ="user_phone" id ="user_phone">

      <button style ="height:30px; width:100px" type="submit" name="update" value="update" id="button">Update</button>
<br>
<br>
        <span style="color:red; margin-left:67%"><?php echo $message ?> </span>
        </p>
 </div>


   <div align="left"style="margin-left: 10%; width:1200px">

   <div align="left" style="margin-left: 50%; width:400px;">
 <p>
 <input type="text" name ="Search" placeholder="search by ID/Name" class="form-control" value="">
       <button style ="height:30px; width:100px; margin-left:75%;" type="search" class ="btn" id="Search">Search</button>
         </p>

  </div>

    <table id="table" border=".5" width = "30%" height = "50%">

      <tr>
<th style="text-align:center;">Teacher Id</th>
<th style="text-align:center;">Teacher Name</th>
<th style="text-align:center;">Teacher Email</th>
<th style="text-align:center;">Teacher Phone</th>
</tr>

      <?php

      if(isset($_POST['Search']))
      {
       $searchkey = $_POST['Search'];
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
                    <td align="center"><?php echo $row['t_email'] ?></td>
                    <td align="center"><?php echo $row['t_phone'] ?></td>
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
                        document.getElementById("user_phone").value = this.cells[3].innerHTML;
                   };
               }

        </script>

      </form>

  </body>
</html>
