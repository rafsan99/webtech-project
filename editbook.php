<?php

  include "includes/db_connect.inc.php";

  $bookID = $bookname = $status = $statusINdb =   $message =  "" ;

  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    if(!empty($_POST['book_id']))
    {
      $bookID = mysqli_real_escape_string($conn, $_POST['book_id']);
    }

    if(!empty($_POST['bookname']))
    {
      $bookname = mysqli_real_escape_string($conn, $_POST['bookname']);
    }

    if(!empty($_POST['availability']))
    {
      $status = mysqli_real_escape_string($conn, $_POST['availability']);
    }




    $sql = "UPDATE library
    SET book_name = '$bookname', book_status = '$status'
    WHERE book_id = '$bookID' ";

    mysqli_query($conn , $sql);


     $message =  "Book Info is Updated";


     if(empty($_POST['book_id']))
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
    <h1 align = "center"><u>Update Book Status</u></h1>
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

  <button style =" margin-right:10%; height:35px; width:154px" id = "button" onclick="window.location.href = 'managelibrary.html';">Back To Management</button>

  </div>
  <br>
  <br>
    <form action="editbook.php" method="post">
  <div align="left" style="margin-left: 20%;">
    <p><b>Book ID:</b>
    <input type="text" name ="book_id" id ="book_id" readonly>
     <b>Book Name:</b>
    <input type="text" name ="bookname" id ="bookname" readonly>
     <b>Book Status:</b>
     <input type="radio" id="available" name="availability" value="available">Available
     <input type="radio" id="NotAvailable" name="availability" value="NotAvailable">Not Available


      <button style ="height:30px; width:100px" type="submit" name="update" value="update" id="button">Update</button>
      <br>
      <br>
        <span style="color:red; margin-left:60%"><?php echo $message ?> </span>
        </p>

 </div>


   <div align="left"style="margin-left:23%; width:1000px">
     <div align="left" style="margin-left:50%; width:400px;">
   <p>
   <input type="text" name ="Search" placeholder="search by ID/Name" class="form-control" value="">
         <button style ="height:30px; width:100px; margin-left:75%;" type="search" class ="btn" id="Search">Search</button>
           </p>

    </div>
    <table id="table" border=".5" width = "30%" height = "50%">

      <tr>
<th style="text-align:center;">Book Id</th>
<th style="text-align:center;">Book Name</th>
<th style="text-align:center;">Status</th>
</tr>

<?php

if(isset($_POST['Search']))
{
 $searchkey = $_POST['Search'];
    $sql2 = "SELECT * FROM library WHERE book_id LIKE '%$searchkey%' OR book_name LIKE '%$searchkey%'";
 }

 else
 {
     $sql2 = "SELECT * FROM library";
}

    $result2 = mysqli_query($conn , $sql2);

  while( $row = mysqli_fetch_assoc($result2) ): ?>
  <tr>
              <td align="center"><?php echo $row['book_id'] ?></td>
              <td align="center"><?php echo $row['book_name'] ?></td>
              <td align="center"><?php echo $row['book_status'] ?></td>
          </tr>

<?php endwhile; ?>



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
                        document.getElementById("book_id").value = this.cells[0].innerHTML;
                        document.getElementById("bookname").value = this.cells[1].innerHTML;
                   };
               }

        </script>

      </form>

  </body>
</html>
