<?php require 'Connections/connections.php';?>
<?php
session_start();
$accountnumber = $_SESSION['ACCOUNTNUMBER'];

if(isset($_POST['confirm'])){
	header ("Location: Login_form.php");
}
		
?>

<!doctype html>
<html>
<head>
<link href="css/Login.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Successful Update</title>
</head>

<body>
<div class="Login">
  <h1 align="center">Your Account has been created </h1>
  <form action="" method="post" style="text-align:center;">
    <p>Click button to return to login</p>
    <p>
      <input name="confirm" type="submit" id="confirm" value="Return">
    </p>	
  </form>
</div>
</body>
</html>