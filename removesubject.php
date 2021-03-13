<?php

  include "includes/db_connect.inc.php";

  $sID = $sName = $sclass = $message = "" ;

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
      $sclass = mysqli_real_escape_string($conn, $_POST['class']);
    }

    $sql = "DELETE FROM subjectS WHERE sub_id = '$sID' ";

    mysqli_query($conn , $sql);

     $message =  "Subject is Removed";


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
    <h1 align = "center"><u>Remove Subject</u></h1>
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

  <button style =" margin-right:10%; height:30px; width:110px" id = "button" onclick="window.location.href = 'admin.php';">Back To Profile</button>
  <br>
  <br>
  </div>
    <form action="removesubject.php" method="post">
  <div align="left" style="margin-left: 20%;">
    <p>Subject ID:
    <input type="text" name ="sub_id" id ="sub_id" readonly>
    Subject Name:
    <input type="text" name ="sub_name" id ="sub_name">
     Class:
    <input type="text" name ="class" id ="class">

      <button style ="height:30px; width:100px" type="submit" name="update" value="update" id="button">Remove</button>
      <br>
      <br>
        <span style="color:red; margin-left:60%;"><?php echo $message ?> </span>
        </p>
</div>
      <div align="left"style="margin-left: 17%; width:1000px">
      <br>

      <div align="left" style="margin-left: 50%; width:400px;">
    <p>
    <input type="text" name ="Search" placeholder="search by ID/Name" class="form-control" value="">
          <button style ="height:30px; width:100px; margin-left:75%;" type="search" class ="btn" id="Search">Search</button>
            </p>

     </div>

     <table id="table" border=".5" width = "30%" height = "50%">

      <tr>
<th style="text-align:center;">Subject Id</th>
<th style="text-align:center;">Subject Name</th>
<th style="text-align:center;">Class</th>
</tr>


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

      </form>

  </body>
</html>
