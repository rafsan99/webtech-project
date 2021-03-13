<html>
<head>

<title> Notice Page</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
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
background-color: #000000;
color: white;
}
tr:nth-child(even) {background-color: #f2f2f2}
}

</style>


<body>


<h1 align = "center"><b><u>Notice Board</u></b> </h1>


  <div align = "left">

    <button style = "margin-left:70%; height:30px; width:95px"  class = "btn btn-info" onclick="window.print()">Print Notice</button>
</div>

    <div style=" margin-left: 5%; width:1200px;">
     <table id="table" border=".5" width = "30%" height = "50%">
       <tr>
    <th style=" text-align:center; width:400px;">Notice Title</th>
    <th style="text-align:center; width:590px;">Description</th>
    <th style="text-align:center; width:210px;">DateTime</th>
    </tr>

       <?php
 include "includes/db_connect.inc.php";

       $sql = "SELECT * FROM school_notice ORDER BY notice_id DESC";
       $result = mysqli_query($conn,$sql);

       $numOFrow = mysqli_num_rows($result);

       if ($numOFrow > 0)
       {
       while($row = $result->fetch_assoc() )
           {
       echo '<tr>
                   <td align="center">'.$row['notice_title'].'</td>
                   <td align="left">'.$row['description'].'</td>
                   <td align="center">'.$row['datetime'].'</td>
               </tr>';
       }
       echo "</table>";
       }
       else
       {
          echo "0 results";
        }

         ?>

       </div>

<div align = "right">
<button style = "margin-right:10%; height:35px; width:120px"  class = "btn btn-info" onclick="window.location.href = 'Home.html';">Back To Home</button>
</div>

</body>
</html>
