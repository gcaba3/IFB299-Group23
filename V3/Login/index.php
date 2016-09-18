<?php require 'Connections/connections.php';?>
<?php
session_start();

//Set variables
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$accounttype = $_SESSION['ACCOUNTTYPE'];

//check if account exists
if(isset($accounttype) && isset($accountnumber)){
	
	//Set Query
	$sql = "select * from $accounttype where Accountnumber = $accountnumber";
	$result = mysqli_query($con, $sql);
	
	//$store query result 
	$row = mysqli_fetch_assoc($result);
	
	$_SESSION['ID'] =  $row['ID'];
} else {
	echo "bad login";
	header('Location: access_denied.php');	
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Successfull Login</title>
</head>

<body>
<h1> <span style="color:#1EF306">Successfully logged in</span> </h1>
<p>Account Details:</p>
<table width="279" height="171" border="1">
  <tbody>
    <tr>
      <td width="213"><?php echo $accounttype?>'s&nbsp; ID </td>
      <td width="50"><?php echo $row['ID']?>&nbsp;</td>
    </tr>
    <tr>
      <td>Account number</td>
      <td><?php echo $accountnumber?>&nbsp;</td>
    </tr>
    <tr>
      <td>Account type</td>
      <td><?php echo $accounttype?>&nbsp;</td>
    </tr>
    <tr>
      <td>First name</td>
      <td><?php echo $row['firstName']?>&nbsp;</td>
    </tr>
    <tr>
      <td>Last name</td>
      <td><?php echo $row['lastName']?>&nbsp;</td>
    </tr>
    <tr>
      <td>Email</td>
      <td><?php echo $row['email']?>&nbsp;</td>
    </tr>
  </tbody>
</table>
<p>
<?php
if ($accounttype == 'planner'){
	?>
    <a href ="show_email.php"> Show email </a>
	<?php
}
?><br/>
<a href="reenter.php"> Edit </a> <br/>
<a href ="login.php"> Logout </a>
<br/>
</body>
</html>
