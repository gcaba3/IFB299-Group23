<?php require 'Connections/connections.php';?>
<?php
session_start();
//set variables
$error_message = FALSE;
$empty_fields = FALSE;
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$account_type = $_SESSION['ACCOUNTTYPE'];
$username = $_SESSION['USERNAME'];

//check if account exists
if(isset($_POST['save'])){
	//set local variables
	$new_username = $_POST['username'];
	$new_password = $_POST['password'];
	$con_password = $_POST['con_password'];
	$updated_username = FALSE;
	$updated_password = FALSE;
	
	//checks if username input data is not empty. 
	//if not empty then update the database column
	if(!$_POST['username'] == ""){
		$sql = "UPDATE account SET username = '$new_username' where Account_number = '$accountnumber'";
		mysqli_query($con, $sql);
		$_SESSION['USERNAME'] = $new_username;
		$updated_username = TRUE;
	} else {
		$updated_username = FALSE;
	}
	//checks if password input data is not empty. 
	//if not empty then check if the new password matches the confirm password
	//if it does update the password column
	if(!$_POST['password'] == ""){
		if($new_password == $con_password){
			$sql = "UPDATE account SET password = '$new_password' where Account_number = '$accountnumber'";
			mysqli_query($con, $sql);
			$updated_password = TRUE;
		} else {
			$error_message = TRUE;
			$updated_password = FALSE;
		}
	}
	// If either username or password has been updated. Change to succesfull update page.
	if ($updated_username == TRUE || $updated_password == TRUE){
		header ("Location: Successfull_update.php");	
	} elseif($updated_username == FALSE && $updated_password == FALSE){
		$empty_fields = TRUE;	
	}
} elseif(isset($_POST['cancel'])){
	header ("Location: Account.php");
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
  <h1 align="center">Edit Login</h1>
  <div>
  <p align="center">
  <?php 
   if($error_message == TRUE){
		echo "Passwords dont match";   
   } elseif($empty_fields == TRUE){
		echo "Please fill atleast one. Or cancel."; 
   }
  ?>
  </p>
  </div>
  <form action="" method="post" style="text-align:center;">
  <p>
  <label>New Username<br/> 
  </label>
  <input name="username" type="text" autofocus id="username" placeholder="Enter here"><br/><br/>
  <label>New  Password<br/> 
  </label>
  <input name="password" type="password" autofocus id="password" placeholder="Enter here">
  </p>
  <p>
    <label>Re-Enter Password<br/>
    </label>
    <input name="con_password" type="password" autofocus id="con_password" placeholder="Enter here">
    <br/>
    <br/>
    <input name="save" type="submit" id="save" value="Save">	
     <input name="cancel" type="submit" id="cancel" value="Cancel">
  </p>
  </form>
</div>
</body>
</html>