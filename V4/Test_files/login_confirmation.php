<html>
<body>
<h1> Confirmation </h1>
<?php
//connect to and select database
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'qwe';
$dbname = 'thedatabase';
$GLOBALS['link'] = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

//Defining variables
$GLOBALS ['ACCOUNT_NUMBER'] = "";
$GLOBALS ['ACCOUNT_TYPE'] = "";
$GLOBALS ['ID'] = "";
$GLOBALS ['FIRSTNAME'] = "";
$GLOBALS ['LASTNAME'] = "";
$GLOBALS ['EMAIL'] = "";

//Defining functions
function set_accountdetails($AN, $account_type){
	global $link;
	global $ID;
	global $ACCOUNT_TYPE;
	global $FIRSTNAME;
	global $LASTNAME;
	global $EMAIL;
	
	$sql = "Select * FROM $account_type WHERE Accountnumber = $AN";
	$result = mysqli_query($link,$sql);
	$row = mysqli_fetch_assoc($result);
	$ID = $row['ID'];
	$FIRSTNAME = $row['firstName'];
	$LASTNAME = $row['lastName'];
	$EMAIL = $row['email'];
	
	session_start();
	$_SESSION['ID'] = $ID;
	$_SESSION['ACCOUNT_TYPE'] = $ACCOUNT_TYPE;
	$_SESSION['FIRSTNAME'] = $FIRSTNAME;
	$_SESSION['LASTNAME'] = $LASTNAME;
	$_SESSION['ID'] = $ID;
	$_SESSION['EMAIL'] = $EMAIL;
}

function login(){
	global $link;
	global $ACCOUNT_NUMBER;
	global $ACCOUNT_TYPE;
	
	//Input data
	$input_AN = $_POST["number"];
	$input_Pass = $_POST ["password"];
	echo "Account number put in: " . $input_AN . "<br />";
	echo "Account password put in: " . $input_Pass . "<br/>"."<br/>";
	
	//Set query
	$sql = "Select * FROM account";
	$result = mysqli_query($link,$sql);
	
	// Check connection
	if (!$result) {
		die("Connection failed: " . mysqli_connect_error());
	} else {
		echo "Connected successfully" . "<br/>"."<br/>";
	}
	
	//cycle through all accounts ands looks for a matching account number and password
	while ($row = mysqli_fetch_array ($result)){
	if ($input_AN == $row['Accountnumber'] && $input_Pass == $row['Password']){
		$ACCOUNT_NUMBER = $row['Accountnumber'];
		$ACCOUNT_TYPE = $row['Accounttype'];
		echo "Successfully logged in" . "<br/>" . "<br/>";
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
/*
function display_all(){
	global $ACCOUNT_TYPE;
	global $FIRSTNAME;
	global $LASTNAME;
	global $ID;
	global $EMAIL;
	
	echo "Your ". $ACCOUNT_TYPE . "'s " ."ID: " . $ID. "<br/>";
	echo "Your Account Type: " . $ACCOUNT_TYPE. "<br/>";
	echo "First Name: " . $FIRSTNAME . "<br/>";
	echo "Last Name: " . $LASTNAME . "<br/>";
	echo "Email: " . $EMAIL . "<br/>" . "<br/>";
}
*/

//Calling functions
if(login() == true){
	set_accountdetails($ACCOUNT_NUMBER, $ACCOUNT_TYPE);
	?>
	<form action = "display_account_details.php" method = "POST">
	<button name="subject" type="submit" value="HTML">View Account</button>
	</form> 
	<?php
	} else {
	echo "Failed to Login. Try Again ";
	?> 
	<form action = "login_form.html" method = "POST">
	<button name="subject" type="submit" value="HTML">Try Again</button>
	</form> 
	<?php
}
mysqli_close($link);
?>
</body>
</html>