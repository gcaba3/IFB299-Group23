<html>
<body>

<?PHP
//connect to and select database
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'qwe';
$dbname = 'TheDatabase';
$GLOBALS['link'] = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

session_start();
$ID = $_SESSION['ID'];
$ACCOUNT_TYPE = $_SESSION['ACCOUNT_TYPE'];

//Set query
$sql = "Select * FROM $ACCOUNT_TYPE WHERE ID = $ID";
$result = mysqli_query($link,$sql);

$row = mysqli_fetch_assoc($result);
$new_firstname = $_POST["new_firstname"];
$new_lastname = $_POST["new_lastname"];
$new_email = $_POST["new_email"];

$update_firstname = "UPDATE $ACCOUNT_TYPE SET firstName = '$new_firstname' where ID = $ID";
$update_lastname = "UPDATE $ACCOUNT_TYPE SET lastName = '$new_lastname' where ID = $ID";
$update_email = "UPDATE $ACCOUNT_TYPE SET email = '$new_email' where ID = $ID";

function login(){
	global $link;
	
	//Input data
	$input_AN = $_POST["number"];
	$input_Pass = $_POST ["password"];
	
	//Set query
	$sql = "Select * FROM account";
	$result = mysqli_query($link,$sql);
	
	//cycle through all accounts ands looks for a matching account number and password
	while ($row = mysqli_fetch_array ($result)){
	if ($input_AN == $row['Accountnumber'] && $input_Pass == $row['Password']){
		return true;
		break;
	} elseif (!($input_AN == $row['Accountnumber']) && !($input_Pass == $row['Password'])) {
		continue;
	} else {
		return false;
		break;
	}
}
}
if (login()==true){
	if(!$new_firstname == ""){
		mysqli_query($link, $update_firstname);
		$_SESSION['FIRSTNAME'] = $new_firstname;
		echo "Successfully Updated First Name" . "<br/>". "<br/>";
		} 

	if (!$new_lastname == ""){
		mysqli_query($link, $update_lastname);
		$_SESSION['LASTNAME'] = $new_lastname;
		echo "Successfully Updated Last Name" . "<br/>". "<br/>";
	}
	if (!$new_email == ""){
		mysqli_query($link, $update_email);
		$_SESSION['EMAIL'] = $new_email;
		echo "Successfully Updated Email" . "<br/>". "<br/>";
	}

	if($new_firstname == "" && $new_lastname == "" && $new_email == ""){
		echo "Please fill at least one" . "<br/>" . "<br/>";
		?>
		<form action = "edit_account_details_form.html" method = "POST">
			<button name="subject" type="submit" value="HTML">Try Again</button>
		</form> 
	<?php
	} else {
		?>
		<form action = "display_account_details.php" method = "POST">
			<button name="subject" type="submit" value="HTML">Return to account</button>
		</form> 
	<?php
	}
} else {?>
Please re-enter password or login
	<form action = "edit_account_details_form.html" method = "POST">
		<button name="subject" type="submit" value="HTML">Return</button>
	</form> 
<?php
}
?>
</body>
</html>