<?php require 'Connections/connections.php';?>
<?php
session_start();
//set variables
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$account_type = $_SESSION['ACCOUNTTYPE'];
$username = $_SESSION['USERNAME'];

$empty_username = $empty_password = $password_mismatch = $account_exists = $updated_password = FALSE;
$updated_username = $empty_fields = FALSE;

//Checks if the input username already exists in the database. Then returns a boolean to indicate if it does
function username_exists($username){
	global $con;
	
	//sql Check if account already exists
	$sql = "SELECT * FROM account
	WHERE username = '$username'";
	$result = mysqli_query($con, $sql);
	$numrows = mysqli_num_rows($result);
	
	if( $numrows > 0){
		return TRUE;
	} else {
		return FALSE;	
	}
}

//save button has been clicked
if(isset($_POST['save'])){
	//set local variables
	$new_username = $_POST['username'];
	$new_password = $_POST['password'];
	$con_password = $_POST['con_password'];
	
	//checks if username input data is not empty. 
	//if not empty then update the database column
	if(!$_POST['username'] == ""){
		//checks if the new username is already taken. if its not then it creates the account
		if(username_exists($new_username) == FALSE){
			$sql = "UPDATE account SET username = '$new_username' where Account_number = '$accountnumber'";
			mysqli_query($con, $sql);
			$_SESSION['USERNAME'] = $new_username;
			$updated_username = TRUE;
		} else {
			$account_exists = TRUE;
		}
	} else {
		$empty_username = TRUE;
	}
	
	/*
	First it checks if the password input is not empty.
	If it is empty set empty password as true.
	If its not empty then check if the new password matches with the confirm password.
	If it does then update the account.
	If it doesnt set the mistmatch password as true.
	*/
	if(!$_POST['password'] == ""){
		if($new_password == $con_password){
			$sql = "UPDATE account SET password = '$new_password' where Account_number = '$accountnumber'";
			mysqli_query($con, $sql);
			$updated_password = TRUE;
		} else {
			$password_mismatch = TRUE;
		}
	} else {
		$empty_password = TRUE;
	}
	
	
	//Checks if the passwords match. IF they do check if either the user name or the password has been updated.
	if($password_mismatch == FALSE){
		// If either username or password has been updated. Change to succesfull update page.
		if ($updated_username == TRUE || $updated_password == TRUE){
			header ("Location: Successfull_update.php");	
		}
	}elseif($empty_password == TRUE && $empty_username == TRUE){
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
  //checks which error message to show.
   if($password_mismatch == TRUE){
		echo "Passwords dont match";   
   } elseif($empty_fields == TRUE){
		echo "Please fill atleast one. Or cancel."; 
   } elseif($account_exists == TRUE){
	   echo "Sorry but that username is already taken. Please choose another one.";
   }
  ?>
  </p>
  </div>
  <form action="" method="post" style="text-align:center;">
      <p>
      <label>New Username<br/></label>
      <input name="username" type="text" autofocus id="username" placeholder="Enter here"><br/><br/>
      <label>New  Password<br/> </label>
      <input name="password" type="password" autofocus id="password" placeholder="Enter here">
      </p>
      <p>
        <label>Re-Enter Password<br/></label>
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