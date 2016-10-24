<?php

$servername = "localhost";
$username = "root";
$password = "qwe";
$dbname = "thedatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

			$sql1 = '"SELECT * FROM  `sponsors_donation` WHERE  `sponsor_ID` LIKE '.$row['Sponsor_ID']. '"';
				$result1 = $conn->query($sql1);

				if ($result1->num_rows > 0) {
				// output data of each row
				while($row1 = $result1->fetch_assoc()) {
					echo '<p>' . '$'. $row1['amount']. '  ' .  $row1['date_donated'] . '</p> <br>';
					
				}
				}				
    }
	
} else {
    echo "0 results";
}
$conn->close();
?>