<html>
<body>
<?PHP
//connect to and select database
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'qwe';
$GLOBALS['link'] = mysqli_connect($dbhost, $dbuser, $dbpass, 'test');

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


if(!$new_firstname == "" && !$new_lastname == "" && !$new_email == ""){
	mysqli_query($link, $update_firstname);
	mysqli_query($link, $update_lastname);
	mysqli_query($link, $update_email);
	echo "Successfully Update";
} else {
	echo "Please fill in all details";
}
?>
</body>
</html>
