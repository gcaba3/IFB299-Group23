<!DOCTYPE html>
<html>
<body>

<?php
echo "Log In Test:";
?>


<?php
$servername = "localhost";
$username = "root";
$password = "qwe";
$dbname = "Donations";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {    die("Connection failed: " . mysqli_connect_error());

}

$sql = "SELECT * 
FROM Donors
WHERE  `Email` LIKE '{$_POST[email]}' 
AND 'password' LIKE '{$_POST[Password]}';";




if (mysqli_query($conn, $sql)) {
    echo " Record Matched Successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	header('Location: donate.php');   
}

mysqli_close($conn);
?>
</body>
</html>

