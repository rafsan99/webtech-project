<?php

  include "includes/db_connect.inc.php";

  $sID = $sName = $sclass = $message = $classInDB = "" ;

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

    $sqlUserCheck = "SELECT sub_class FROM subjects WHERE sub_name = '$sName'";
    $result = mysqli_query($conn, $sqlUserCheck) or die( mysqli_error($conn));


    while($row = mysqli_fetch_assoc($result))
    {
       $classInDB = $row['sub_class'];
    }
       if($classInDB == $sclass)
    {
           $message = "Already exists!!";
    }
      else
       {
    $sql = "UPDATE subjects
    SET sub_name = '$sName', sub_class = '$sclass'
    WHERE sub_id = '$sID' ";

    mysqli_query($conn , $sql);

     $message =  "Subject Info is Updated";
}
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <h1 align = "center"><u>Edit Subject Info</u></h1>
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

  <button style =" margin-right:3%; height:30px; width:105px" id = "button" onclick="window.location.href = 'admin.php';">Back To Profile</button>

  </div>
    <form action="updatesubject.php" method="post">
  <div align="left">
    <p>Subject ID:
    <input type="text" name ="sub_id" id ="sub_id" readonly>
    Subject Name:
    <input type="text" name ="sub_name" id ="sub_name">
     Class:
    <input type="text" name ="class" id ="class">

      <button style ="height:30px; width:100px" type="submit" name="update" value="update" id="button">Update</button>

        <span style="color:red"><?php echo $message ?> </span>
        </p>
   <br>
   <br>

   <div style="width:500px;">
    <table id="table" border=".5" width = "30%" height = "50%">

      <tr>
<th align="center" style="width:8px;">Subject Id</th>
<th align="center" style="width:60px;">Subject Name</th>
<th align="center" style="width:28px;">Class</th>
</tr>

      <?php

      $sql = "SELECT * FROM subjects";
      $result = mysqli_query($conn,$sql);

      $numOFrow = mysqli_num_rows($result);

      if ($numOFrow > 0)
      {
      while($row = $result->fetch_assoc() )
          {
      echo '<tr>
                  <td align="center">'.$row['sub_id'].'</td>
                  <td align="center">'.$row['sub_name'].'</td>
                  <td align="center">'.$row['sub_class'].'</td>
              </tr>';
      }
      echo "</table>";
      }
      else
      {
         echo "0 results";
       }

        ?>

    </table>
      </div>
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
