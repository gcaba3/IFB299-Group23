<?php require 'Connections/connections.php';?>
<?php

//check if form submitted
if(isset($_POST['login'])){
		session_start();
		$accountnumber = $_SESSION['ACCOUNTNUMBER'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		//Set Query
		$result = $con->query("select * from account where Accountnumber = '$accountnumber'");
		
		//$store query result 
		$row = mysqli_fetch_assoc($result);
		
		//Store variables needed in session variable(s). 
		$_SESSION['ACCOUNTNUMBER'] = $row['Accountnumber'];
		$_SESSION['ACCOUNTTYPE'] = $row['Accounttype'];	
		
		$correct_username = $username == $row['username'];
		$correct_password = $password == $row['Password'];
		
		//login if account exists
		if($correct_username && $correct_password){
			header('Location: edit_profile.php');
		} else {
			echo "Incorrect try again";
		}
				
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Confirmation</title>
</head>

<body>
<h1>Confirm Edit Account Details</h1>
<form name="login_form" method="post" action="">
<label:> Username:<br/> </label>
<input name="username" type="text" autofocus="autofocus" required="required"><br/>
<label> Password:<br/></label>
<input name="password" type="password" autofocus="autofocus" required="required"><br/>

<input name="login" type="submit" id="confirm" formmethod="POST" value="confirm"><br/>
</form>
</body>
</html>