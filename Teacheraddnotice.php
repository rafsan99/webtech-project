<?php

include "includes/db_connect.inc.php";

session_start();

if(!isset($_SESSION['t_id']))
{
  header("Location: Teacheraddnotice.php");
}

$tName = " ";
$tID = $_SESSION["t_id"];
$sID = $notice = $title = $message = $noticeInDB = "" ;

if($_SERVER["REQUEST_METHOD"] == "POST")
{
  if(!empty($_POST['sub_id']))
  {
    $sID = mysqli_real_escape_string($conn, $_POST['sub_id']);
  }

  if(!empty($_POST['noticetitle']))
  {
    $title = mysqli_real_escape_string($conn, $_POST['noticetitle']);
  }

if(!empty($_POST['description']))
{
  $notice = mysqli_real_escape_string($conn, $_POST['description']);
}


$sqlUserCheck = "SELECT description FROM notice";
$result = mysqli_query($conn, $sqlUserCheck) or die( mysqli_error($conn));


while($row = mysqli_fetch_assoc($result))
{
   $noticeInDB = $row['description'];
}

if($notice == $noticeInDB)
{
       $message = "Already given!!";
}
  else
  {
      $sql = "INSERT INTO `notice`(`sub_id`, `title`, `description`, `t_id`) VALUES ('$sID', '$title', '$notice', '$tID');";
      $result = mysqli_query($conn, $sql) or die( mysqli_error($conn));
          $message = "Notice Added";
}

}

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <h1 align ="center" >Add Notice</h1>
  </head>

    <style>

#table {
border-collapse: collapse;
width: 100%;
color: #000000;
font-family: monospace;
font-size: 25px;
text-align: left;
font-size: 20px;
text-align: left;
}
#th {
background-color: #588c7e;
color: white;
}
#tr:nth-child(even) {background-color: #f2f2f2}
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
  <div align = "right">
  <button style =" margin-right:3%; height:30px; width:105px" id = "button" onclick="window.location.href = 'teacher.php';">Back To Profile</button>
  </div>

<h3 style="margin-left:18%;"><u>Subject List</u></h3>

<table id="table" border=".5" height = "50%" style="float:left; width:45%;">
<tbody>
<br>
        <tr id= "tr">
  <th id= "th" align="center">Subject Id</th>
  <th id= "th" align="center">Subject Name</th>
  <th id= "th" align="center">Class</th>
  </tr>

        <?php

        $sql = "SELECT sub_id,sub_name,class FROM routine WHERE t_id = '$tID' ";
        $result = mysqli_query($conn,$sql);

        $numOFrow = mysqli_num_rows($result);

        if ($numOFrow > 0)
        {

        while($row = $result->fetch_assoc() )
            {
        echo '<tr id= "tr">
                    <td align="center">'.$row['sub_id'].'</td>
                    <td align="center">'.$row['sub_name'].'</td>
                    <td align="center">'.$row['class'].'</td>
                </tr>';
        }
        echo "</table>";
        }
        else
        {
           echo "0 results";
         }

          ?>
</tbody>
      </table>

              <table style="margin-left:60%; width:30%; float:left">

      <form action="Teacheraddnotice.php" method="post">

<div align="center">

<tr>
            <td><label for="sub_id">Subject ID :</label>
            <input type="text" name="sub_id" id ="sub_id" required></td>
            <br>
        </tr>

        <tr>
            <td><label for="noticetitle">Notice Title:</label>
            <input type="text" name="noticetitle"  required></td>
            <br>
        </tr>
        <tr>
            <td><label for="description">Description:</label>
            <textarea type="text" name="description" required></textarea></td>
            <br>
        </tr>


 </table>

<br>
<br>
<br>
<br>
<br>
<br>
<div align = "right" style="margin-right:15%;">
 <input style="margin-left:15%;" type="reset" name="btn_reset" id = "button" />
 <span style="color:red"><?php echo $message?></span>
 <button style ="height:30px; width:100px; margin-left:10%;" name = "add" id="button">Add</button>
</div>
</div>
      <script>

               var table1 = document.getElementById('table');

               for(var i = 0; i <= table.rows.length; i++)
               {
                   table.rows[i].onclick = function()
                   {
                        //rIndex = this.rowIndex;
                        document.getElementById("sub_id").value = this.cells[0].innerHTML;
                   };
               }

        </script>

      </form>

  </body>
</html>
