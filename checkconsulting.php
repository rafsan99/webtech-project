<?php

  include "includes/db_connect.inc.php";
$statusINdb = "" ;

if(isset($_POST['Search']))
{
 $searchkey = $_POST['Search'];
    $sql = "SELECT * FROM teachers_consulting WHERE t_id LIKE '%$searchkey%' OR t_name LIKE '%$searchkey%'";
 }

 else
     $sql = "SELECT * FROM teachers_consulting";
    $result = mysqli_query($conn , $sql);

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta charset="utf-8">
    <h1 align = "center"><u>Check Consulting</u></h1>
<br>
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
<br>
<br>
    <form action="" method="post">
  <div align="left" style="margin-left: 50%; width:400px;">
<p>
<input type="text" name ="Search" placeholder="search by ID/Name" class="form-control" value="">
      <button style ="height:30px; width:100px; margin-left:75%;"class ="btn" id="button">Search</button>
        </p>
   <br>
   <br>
 </div>
   <div align="left" style="margin-left: 25%; width:600px">
    <table id="table" border=".5" width = "30%" height = "50%">

      <tr>
<th style="text-align:center; width:120px;">Id</th>
<th style="text-align:center; width:350px;">Name</th>
<th style="text-align:center; width:120px;">Email</th>
<th style="text-align:center; width:100px;">Room</th>
<th style="text-align:center; width:120px;">Time</th>

</tr>

    <?php

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
      </div>

      </form>

  </body>
</html>
