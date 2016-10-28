<html>
<body>
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

$sql = "INSERT INTO  Donors (Name, email, Address1, Address2, City, Country, Postcode, Phone, Password)
VALUES ('{$_POST['name']}',
'{$_POST['email']}',
'{$_POST['Address1']}',
'{$_POST['Address2']}',
'{$_POST['City']}',
'{$_POST['Country']}',
'{$_POST['Postcode']}',
'{$_POST['Phone']}',
'{$_POST['Password']}');";


if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
</body>
</html>