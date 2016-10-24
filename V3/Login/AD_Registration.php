<?php require 'Connections/connections.php';?>
<?php
session_start();
//set variables
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$error_message = FALSE;
$empty_field = FALSE;

//check if form has been submitted
if(isset($_POST['save'])){
	//set local variables
	$first_name = $_POST['f_name'];
	$last_name = $_POST['l_name'];
	$email = $_POST['email'];
	
	//Check if any field is empty. If not then create account.
	if($_POST['f_name'] == "" || $_POST['l_name'] == "" || $_POST['email'] == ""){
		$empty_field = TRUE;
	} else {
		$sql = "INSERT INTO member (Account_number, FirstName, LastName, Email)
			VALUES ('$accountnumber', '$first_name', '$last_name', '$email')";
		mysqli_query($con, $sql);
		header ("Location: Account_created.php");
	}
} elseif(isset($_POST['cancel'])){
	//Delete the newly created login account
	$sql2 = "DELETE FROM account 
			WHERE Account_number = '$accountnumber'";
	mysqli_query($con, $sql2);
	header ("Location: Login_form.php");
}
?>

<!doctype html>
<html>
<head>
<link href="css/Login.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Edit Login</title>
</head>

<body>
<div class="Login">
  <h1 align="center">Account Details</h1>
  <p align="center">Enter your account details below::</p>
  <div>
  <p align="center">
  <?php 
   if($empty_field == TRUE){
		echo "Please fill in all details. You can edit it later"; 
   }
  ?>
  </p>
  </div>
  <form action="" method="post" style="text-align:center;">
  <p>
    <label>Enter Firstname<br/>
    </label>
    <input name="f_name" type="text" autofocus id="f_name" placeholder="Enter here">
    <br/>
    <br/>
    <label>Enter Lastname<br/>
    </label>
    <input name="l_name" type="text" autofocus id="l_name" placeholder="Enter here">
  </p>
  <p>
    <label>Enter Email<br/>
    </label>
    <input name="email" type="email" autofocus id="email" placeholder="Enter here">
    <br/>
    <br/>
    <input name="save" type="submit" id="save" value="Confirm">	
    <input name="cancel" type="submit" id="cancel" value="Cancel">
  </p>
  </form>
</div>
</body>
</html>