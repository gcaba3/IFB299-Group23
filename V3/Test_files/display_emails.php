<HTML>
<BODY>
<?php
//connect to and select database
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'qwe';
$dbname = 'TheDatabase';
$GLOBALS['link'] = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

session_start();

//Set query
$sql = "Select * FROM member";
$GLOBALS['result'] = mysqli_query($link,$sql);

function idv_emails(){
	global $result;
	while ($row = mysqli_fetch_array ($result)){
	echo "Name: " . $row['firstName'] . " ". $row['lastName']  ."<br/>";
	echo " Email: "  . $row['email'] ."<br/>" . "<br/>";
	}
}

function all_emails(){
	global $result;
	while ($row = mysqli_fetch_array ($result)){
	echo $row['email'] . ", ";
	}
	echo "<br/>" . "<br/>";
}

if(isset($_POST['all'])){
	all_emails();
	?>
	<form action = "display_emails.php" method = "POST">
	<button name="idv" type="click" value="HTML">Show individuals email</button>
	</form> 
	<form action = "display_account_details.php" method = "POST">
		<button name="subject" type="submit" value="HTML">Return to account</button>
	</form> 
	<?php
} elseif (isset($_POST['idv'])){
	idv_emails();
	?>
	<form action = "display_emails.php" method = "POST">
	<button name="all" type="click" value="HTML">Show all emails</button>
	</form> 
	<form action = "display_account_details.php" method = "POST">
		<button name="subject" type="submit" value="HTML">Return to account</button>
	</form> 
	<?php
}
?>

</BODY>
</HTML>