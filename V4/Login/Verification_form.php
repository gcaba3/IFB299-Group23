<?php require 'Connections/connections.php';?>
<?php
session_start();
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$account_type = $_SESSION['ACCOUNTTYPE'];
$error_message = FALSE;

//check if form submitted
if(isset($_POST['login'])){
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		//Set Query
		$result = $con->query("select * from account where Account_number = '$accountnumber'");
		
		//store query result 
		$row = mysqli_fetch_assoc($result);
		//Check if re-entered username and password is the the same.
		//login if account exists
		if ($username == $row['username'] && $password == $row['password']){
			header ('Location: Edit_Login.php');
		} else {
			$error_message = TRUE;
		}
				
	}elseif(isset($_POST['cancel'])) {
		header ('Location: Account.php');
	}
?>

<!doctype html>
<html>
<head>
<link href="css/Login.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Verification</title>
</head>

<body>
<div class="Login">
  <h1 align="center">Verfication</h1>
  <div>
    <p align="center">
      <?php 
   if($error_message == TRUE && isset($_POST['login'])){
		echo "Incorrect Login. Try Again.";   
   }
  ?>
    </p>
  </div>
  <p align="center">Please re-enter your credentials below:</p>
  <form action="" method="post" style="text-align:center;">
    <p>
  <label>Enter Username<br/> 
  </label>
  <input name="username" type="text" autofocus id="username" placeholder="Username"><br/><br/>
  <label>Enter Password<br/> 
  </label>
  <input name="password" type="password" autofocus id="password" placeholder="Password"><br/><br/>
  <input name="login" type="submit" id="login" value="Confirm">
   <input name="cancel" type="submit" id="cancel" value="Cancel"> </p>
  </form>
</div>
</body>
</html>