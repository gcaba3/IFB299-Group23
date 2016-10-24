<?php require 'Connections/connections.php';?>
<?php
//set variables
$error_message = FALSE;
$empty_fields = FALSE;
$account_exists = FALSE;

//check if account exists
if(isset($_POST['save'])){
	//set local variables
	$username = $_POST['username'];
	$password = $_POST['password'];
	$con_password = $_POST['con_password'];
	
	//Check if fields are not empty
	if(!$_POST['password'] == "" && !$_POST['username'] == ""){
		//check if both passwords match
		if($password == $con_password){
			//Check if account already exists
			$sql = "SELECT * FROM account
			WHERE username = '$username'";
			$result = mysqli_query($con, $sql);
			$row = mysqli_fetch_assoc($result);
			
			if($row){
				$account_exists = TRUE;
			} else {
				//Query to set insert new account into the database. Then run that query.
				$sql1 = "INSERT INTO account (Account_type, username, password)
				VALUES ('volunteer', '$username', '$password')";
				mysqli_query($con, $sql1);
				session_start();
				
				//Select newest created account. And set store that account's account number
				$sql2 = "SELECT * FROM account 
						ORDER BY Account_number DESC
						LIMIT 1";
				$result = mysqli_query($con, $sql2);
				$row = mysqli_fetch_assoc($result);
				//$_SESSION['ACCOUNTNUMBER'] = $row['Account_number'];
				header ("Location: AD_Registration.php");
			}
		} else {
			$error_message = TRUE;
		}
	} else {
		$empty_fields = TRUE;
	}
} elseif(isset($_POST['cancel'])){
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
  <h1 align="center">Login Registration</h1>
  <p align="center">Enter your chosen credentials below:</p>
  <div>
  <p align="center">
  <?php 
   if($error_message == TRUE){
		echo "Passwords dont match. Try Again";   
   } elseif($empty_fields == TRUE){
		echo "Please fill in all fields. Or cancel."; 
   }	elseif($account_exists == TRUE){
		echo "Username already taken. Please select another username."; 
   }
  ?>
  </p>
  </div>
  <form action="" method="post" style="text-align:center;">
  <p>
  <label>Enter Username<br/> 
  </label>
  <input name="username" type="text" autofocus id="username" placeholder="Enter here"><br/><br/>
  <label>Enter Password<br/> 
  </label>
  <input name="password" type="password" autofocus id="password" placeholder="Enter here">
  </p>
  <p>
    <label>Re-Enter Password<br/>
    </label>
    <input name="con_password" type="password" autofocus id="con_password" placeholder="Enter here">
    <br/>
    <br/>
    <input name="save" type="submit" id="save" value="Continue">	
     <input name="cancel" type="submit" id="cancel" value="Cancel">
  </p>
  </form>
</div>
</body>
</html>