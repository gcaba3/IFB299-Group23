<?php require 'Connections/connections.php';?>
<?php
session_start();
$accounttype = $_SESSION['ACCOUNTTYPE'];

//Set Query
$sql = "select * from member";
$result = mysqli_query($con, $sql);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Clients email</title>
</head>
<body>

<h1> Emails of clients</h1>
<p>Copy and paste into recipient address(s) to email all clients</p>
<p> <a href="index.php">Return to account</a></p>
<p>
<form action = "show_email.php" method = "POST">
  <input type="submit" name="submit" id="submit" value="Show all">
</form>
</p>
<figure>
  <textarea name="textarea" cols="100" rows="10" id="textarea">
  <?php
  while($row = mysqli_fetch_array($result)){
	  		echo "Name: " . $row['firstName'] . " ". $row['lastName']  ."\n";
			echo " Email: "  . $row['email'] ."\n" . "\n";
 		 }
  ?>
  </textarea>
  <figcaption></figcaption>
</figure>
</body>
</html>