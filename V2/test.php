<html>
	<head>
	<title>Retrieve data from database </title>
	</head>
	<body>

	<?php
	// Connect to database server
	$host = "localhost";
	$user = "root";
	$pass = "qwe";
	mysql_connect($host,$user,$pass);

	// Select database
	$db = "Test";
	mysql_select_db($db);

	// SQL query
	$strSQL = "SELECT * FROM users";

	// Execute the query (the recordset $rs contains the result)
	$rs = mysql_query($strSQL);
	
	// Loop the recordset $rs
	// Each row will be made into an array ($row) using mysql_fetch_array
	while($row = mysql_fetch_assoc($rs)) {

	   // Write the value of the column FirstName (which is now in the array $row)
	   echo $row['ID'] . " " . $row['UserName'] . " ". $row[Password] ."<br />";
	}

	// Close the database connection
	mysql_close();
	?>
	</body>
	</html>