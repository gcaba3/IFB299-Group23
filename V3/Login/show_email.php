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
<form action = "email_individual.php" method = "POST">
  <input type="submit" name="show all" id="show all" value="Show individual emails">
</form>
</p>
<figure>
  <textarea name="textarea" cols="100" rows="10" id="textarea">
  <?php
  while($row = mysqli_fetch_array($result)){
	  		echo $row['email'] . ", ";
 		 }
  ?>
  </textarea>
  <figcaption></figcaption>
</figure>
</body>
</html>