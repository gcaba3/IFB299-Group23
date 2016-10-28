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

$sql = "SELECT Event_ID ,  Event_Name
FROM event";



if (mysqli_query($conn, $sql)) {
    echo " Record Matched Successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	  
}

mysqli_close($conn);
?>
</body>
</html>

