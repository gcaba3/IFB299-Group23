<?php require 'Connections/connections.php';?>
<?php
session_start();
$_SESSION['ACCOUNTNUMBER'] = "";	
$error_message = FALSE;

//check if form submitted
if(isset($_POST['login'])){
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		//Set Query
		$result = $con->query("select * from account where username = '$username' AND password ='$password'");
		
		
		//$store query result 
		$row = mysqli_fetch_assoc($result);
		
		//Store variables needed in session variable(s). 
		$_SESSION['ACCOUNTNUMBER'] = $row['Account_number'];
		$_SESSION['ACCOUNTTYPE'] = $row['Account_type'];	
		$_SESSION['USERNAME'] = $row['username'];
		
		//login if account exists
		if(isset($_SESSION['ACCOUNTNUMBER'])){
			header('Location: Account.php');
		} else { 
			$error_message = TRUE;
		}
				
	}
?>

<!doctype html>
<html>
<head>
<link href="css/Login.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Login</title>
</head>

<body>
<div class="Login">
  <h1 align="center">Login</h1>
  <div>
    <p align="center">
      <?php 
   if($error_message == TRUE){
		echo "Incorrect Login. Try Again.";   
   }
  ?>
    </p>
  </div>
  <form action="" method="post" style="text-align:center;">
    <p>
  <label>Enter Username<br/> 
  </label>
  <input name="username" type="text" autofocus id="username" placeholder="Username"><br/><br/>
  <label>Enter Password<br/> 
  </label>
  <input name="password" type="password" autofocus id="password" placeholder="Password"><br/><br/>
  <input name="login" type="submit" id="login" value="Login">
  </p>
  <p>Register</p>
</form>
</div>
</body>
</html>