<?php

include "includes/db_connect.inc.php";

$subname = $sclass = $message = $classInDB = "" ;

if($_SERVER["REQUEST_METHOD"] =="POST")
{
if(!empty($_POST['subname'])){
  $subname = mysqli_real_escape_string($conn, $_POST['subname']);
}
if(!empty($_POST['subclass']))
{
  $sclass = mysqli_real_escape_string($conn, $_POST['subclass']);
}

$sqlUserCheck = "SELECT sub_class FROM subjects WHERE sub_name = '$subname'";
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
      $sql =   "INSERT INTO `subjects` (`sub_id`, `sub_name`, `sub_class`) VALUES (NULL,'$subname','$sclass');";
       mysqli_query($conn, $sql) or die( mysqli_error($conn));

          $message = "Added";
}
}
?>

<!DOCTYPE html>
 <html>
      <head>
           <h1 align ="center"><u>Add Subject</u></h1>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
      </head>
      <body style="background-color:lightblue">
        <br>
        <br>
      <form action="addsubject.php" method="post">
        <div class="container" style="width:380px;">
          <br>
          <br>
                     <label>Subject Name</label>
                     <input type="text" name="subname" class="form-control" required/>
                     <br>
                     <label>Class</label>
                     <input type="text" name = "subclass" class="form-control" required/>
                     <br>

      <input style="margin-left:15%;" type="reset" name="btn_reset" class="btn btn-info"/>
      <span style="color:red"><?php echo $message?></span>
      <button style="margin-left:20%;" type="submit" name="btn_submit" class="btn btn-info"/>Add</button>
       </div>
                </form>

           <div align = "right">
           <button style="margin:30px; margin-right:20%;" type="submit" name="button" class="btn btn-info" value = "button" onclick="window.location.href = 'admin.php';">Back To Profile</button>
             </div>
      </body>
 </html>
