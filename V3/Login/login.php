<?php require 'Connections/connections.php';?>
<?php

//check if form submitted
if(isset($_POST['login'])){
		session_start();
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		//Set Query
		$result = $con->query("select * from account where username = '$username' AND Password ='$password'");
		
		//$store query result 
		$row = mysqli_fetch_assoc($result);
		
		//Store variables needed in session variable(s). 
		$_SESSION['ACCOUNTNUMBER'] = $row['Accountnumber'];
		$_SESSION['ACCOUNTTYPE'] = $row['Accounttype'];	
		
		//login if account exists
		if(isset($_SESSION['ACCOUNTNUMBER'])){
			header('Location: index.php');
		} else {
			header('Location: access_denied.php');
		}
				
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
</head>

<body>
<h1>Login</h1>
<form name="login_form" method="post" action="">
<label:> Username:<br/> </label>
<input name="username" type="text" autofocus="autofocus" required="required"><br/>
<label> Password:<br/></label>
<input name="password" type="password" autofocus="autofocus" required="required"><br/>

<input name="login" type="submit" id="login" formmethod="POST" value="login"><br/>
</form>
</body>
</html>