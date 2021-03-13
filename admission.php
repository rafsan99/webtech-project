<?php
include "includes/db_connect.inc.php";



$stName = $stEmail = $stAdd = $stPhone = $stDob = $stDept = $stfName = $stfOccu = $stmName = $stmOccu= $stNt = $stage = $stgender = $stbGr = $stClass = $stNameInDB = $stAddInDB = $stfNameInDB = $stmNameInDB= $stPhoneInDB = $err = "" ;


  /* mysqli_real_escape_string() helps prevent sql injection */
if($_SERVER["REQUEST_METHOD"]=="POST")
{
  if(!empty($_POST['stname'])){
    $stName = mysqli_real_escape_string($conn, $_POST['stname']);
  }
  if(!empty($_POST['stemail'])){
    $stEmail = mysqli_real_escape_string($conn, $_POST['stemail']);
  }

  if(!empty($_POST['stadd'])){
    $stAdd = mysqli_real_escape_string($conn, $_POST['stadd']);
  }
  if(!empty($_POST['stphone'])){
    $stPhone = mysqli_real_escape_string($conn, $_POST['stphone']);

  }
  if(!empty($_POST['stdob'])){
    $stDob = mysqli_real_escape_string($conn, $_POST['stdob']);
  }

  if(!empty($_POST['stdept'])){
    $stDept = mysqli_real_escape_string($conn, $_POST['stdept']);
  }

  if(!empty($_POST['stfname'])){
    $stfName = mysqli_real_escape_string($conn, $_POST['stfname']);
  }
  if(!empty($_POST['stfoccu'])){
    $stfOccu = mysqli_real_escape_string($conn, $_POST['stfoccu']);

  }
  if(!empty($_POST['stmname'])){
    $stmName = mysqli_real_escape_string($conn, $_POST['stmname']);
  }
  if(!empty($_POST['stmoccu'])){
    $stmOccu = mysqli_real_escape_string($conn, $_POST['stmoccu']);
  }

  if(!empty($_POST['Nationality'])){
    $stNt = mysqli_real_escape_string($conn, $_POST['Nationality']);
  }
  if(!empty($_POST['st_age'])){
    $stage = mysqli_real_escape_string($conn, $_POST['st_age']);

  }
  if(!empty($_POST['stgender'])){
    $stgender = mysqli_real_escape_string($conn, $_POST['stgender']);
  }
  if(!empty($_POST['bldgr'])){
    $stbGr = mysqli_real_escape_string($conn, $_POST['bldgr']);

  }
  if(!empty($_POST['stclass'])){
    $stClass = mysqli_real_escape_string($conn, $_POST['stclass']);
  }


  $sqlUserCheck = "SELECT st_name,st_address,st_phone, f_name, m_name FROM student WHERE st_name = '$stName'";
  $result = mysqli_query($conn, $sqlUserCheck);



  while($row = mysqli_fetch_assoc($result))
  {
    $stNameInDB  = $row['stname'];
    $stAddInDB   = $row['stadd'];
    $stPhoneInDB = $row['stphone'];
    $stfNameInDB = $row['stfname'];
    $stmNameInDB = $row['stmname'];
  }

  if($stNameInDB == $stName && $stAddInDB == $stAdd && $stfNameInDB == $stfName && $stmNameInDB == $stmName && $stPhoneInDB == $stPhone)
  {
    $err = "Student already exists!";
  }

  else
{
    $sql = "INSERT INTO student (st_name,st_address ,st_email, st_phone, st_dob, st_dept, f_name, f_occu , m_name , m_occu , nationality, age , gender , blood_group, class)
            VALUES ('$stName','$stAdd', '$stEmail','$stPhone','$stDob' ,'$stDept','$stfName','$stfOccu' , '$stmName','$stmOccu','$stNt' , '$stage','$stgender','$stbGr' , '$stClass');";
    mysqli_query($conn, $sql);
  $err = "Student Added!!";
  }
}
?>

<html>
  <head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
  </head>
  <body style="background-color:lightblue">
    <form action="admission.php" method="post">
      <div align="center">
          <h1 align = "center" style="color:blue"><b>Admission Form</b></h1>
		<table>
		<tr>
        <td><label for="s_name">Student's Name: <span style="color:red;">*</span> </label></td>
        <td><input type="text" name="stname" value="" required></td>

        <br>
		</tr>

		<tr>
        <td><label for="fa_name">Father's Name: <span style="color:red;">*</span> </label></td>
        <td><input type="text" name="stfname" value="" required></td>

        <br>
		</tr>

		<tr>
        <td><label for="fa_occupation">Father's Occupation: <span style="color:red;">*</span> </label></td>
        <td><input type="text" name="stfoccu" value="" required></td>

        <br>
		</tr>

		<tr>
        <td><label for="m_name">Mother's Name: <span style="color:red;">*</span> </label></td>
        <td><input type="text" name="stmname" value="" required></td>

        <br>
		</tr>

		<tr>
        <td><label for="ma_occupation">Mother's Occupation: <span style="color:red;">*</span> </label></td>
        <td><input type="text" name="stmoccu" value="" required></td>

        <br>
		</tr>

	    <tr>
        <td><label for="n_name">Nationality: <span style="color:red;">*</span> </label></td>
        <td><input type="text" name="Nationality" value="" required></td>

        <br>
		</tr>

		<tr>
        <td><label for="">Email: <span style="color:red;">*</span> </label></td>
        <td><input type="email" name="stemail" value="" required></td>
        <br>
		</tr>

		<tr>
        <td><label for="">Permanent Address: <span style="color:red;">*</span></label></td>
        <td><textarea name="stadd" rows="5" cols="60" required></textarea> <br></td>
        </tr>
		<tr>
		<td><label for="">Age: <span style="color:red;">*</span></label></td>
        <td><input type="text" name="st_age" value="" required> <br></td>
        </tr>

        <tr>

        <td><label for="">Phone: <span style="color:red;">*</span></label></td>
            <td><input type="tel" name="stphone" value="" required><br></td>
        </tr>
		<tr>

		<td><label for="">DOB: <span style="color:red;">*</span></label></td>
        <td><input type="date" name="stdob" value="" required> <br></td>
		</tr>
		<tr>
        <td><label for="">Gender: <span style="color:red;">*</span> </label></td>
        <td>
  <input type="radio" id="male" name="gender" value="male">Male
  <input type="radio" id="female" name="gender" value="female">Female
      </td>
		</tr>
		<tr>
        <td><label for="">Applying For: <span style="color:red;">*</span> </label></td>
        <td><select name="stclass" id="txt" onkeyup="manage(this)">
          <option value="" disabled selected>Select Class</option>
          <option value="6">6</option>
          <option value="7">7</option>
		  <option value="8">8</option>
		  <option value="9">9</option>
        </select>
        </td>
        </tr>

        <tr>
          <td><label for="">Department: <span style="color:red;">*</span> </label></td>
          <td>
            <select name="stdept" id ="stdept" disabled>
            <option value=""disabled selected>Select Department</option>
            <option value="0">Science</option>
            <option value="1">Commerce</option>
            <br>
              </select>

              <script type="text/javascript">
                  function manage(txt) {
                      var bt = document.getElementById('txt');
                      if (txt.value == 9) {
                          stdept.disabled = false;

                      }
                      else {
                          stdept.disabled = true;
                      }
                  }
              </script>
       </tr>
		<tr>
        <td><label for="">Blood Group: <span style="color:red;">*</span> </label></td>
        <td><input type="text" name="bldgr" value="" required></td>
        <br></tr>

		<tr>
        <td><br><input style="margin-left:100%;" type="reset" name="btn_reset" class = "btn btn-info" value="Reset"></td>
        <td><br><input style="margin-left:35%;" type="submit" name="btn_submit" class = "btn btn-info" value="Apply"></td>
          <span style="color:red"><?php echo $err ?> </span>
        <br>
		</tr>
		</table>
    <div align="right">
            <button style="margin-right:20%; margin-bottom:10%; height:35px; width:80px" class="btn btn-info" onclick="window.location.href='Home.html';">Home</button>
    </div>
      </div>
    </form>

 </body>

 </html>
