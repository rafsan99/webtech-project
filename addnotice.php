<?php

include "includes/db_connect.inc.php";

$notice = $title = $message = $noticeInDB = "" ;

if($_SERVER["REQUEST_METHOD"] =="POST")
{
if(!empty($_POST['notice']))
{
  $notice = mysqli_real_escape_string($conn, $_POST['notice']);
}
if(!empty($_POST['noticetitle']))
{
  $title = mysqli_real_escape_string($conn, $_POST['noticetitle']);
}

$sqlUserCheck = "SELECT description FROM school_notice";
$result = mysqli_query($conn, $sqlUserCheck) or die( mysqli_error($conn));


while($row = mysqli_fetch_assoc($result))
{
   $noticeInDB = $row['description'];
}
   if($noticeInDB == $notice)
{
       $message = "Already given!!";
}
  else
   {
      $sql = "INSERT INTO `school_notice`(`notice_title`,`description`) VALUES('$title','$notice');";
       mysqli_query($conn, $sql) or die( mysqli_error($conn));

          $message = "Notice Added";
}
}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <h1 align="center"><b><u>Add Notice</u></b></h1>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  </head>
 <br>
    <body style="background-color:lightblue">
      <br>
    <form action="addnotice.php" method="post">
      <div class="container" style="width:500px;">
        <br>
        <br>
        <br>
                   <label><b>Title</b></label>
                   <input type="text" name = "noticetitle" class="form-control" required />

                   <br>
                   <label><b>Description</b></label>
                   <textarea type="text" name = "notice" class="form-control" required></textarea>
                   <br>

    <input style="margin-left:20%;" type="reset" name="btn_reset" class="btn btn-info"/>
    <span style="color:red"><?php echo $message?></span>
    <button style="margin-left:30%;" type="submit" name="btn_submit" class="btn btn-info"/>Add</button>
     </div>
              </form>

         <div align = "right">
         <button style="margin:30px; margin-right:20%;" type="submit" name="button" class="btn btn-info" value = "button" onclick="window.location.href = 'admin.php';">Back To Profile</button>
           </div>
  </body>
</html>
