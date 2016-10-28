<?php require 'Connections/connections.php';?>
<?php
session_start();
$_SESSION['ACCOUNTNUMBER'] = "";	
$error_message = FALSE;

/*
Check's if the volunteer's account is new, as in there's no entry in volunteer table.
If it is the user is redirected to the volunteers account detail registration.
If its not then the user is logged into the account.
*/
function check_volunteer_account($account_number){
	global $con;
	
	$sql = "select * from volunteer where Account_number ='$account_number'";
	$result = mysqli_query($con,$sql);
	$numrows = mysqli_num_rows($result);
	if($numrows > 0){
		header('Location: Account.php');
	} else {
		header('Location: Volunteer_account_details.php');
	}
}

//check if form submitted
if(isset($_POST['login'])){
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		//Set Query
		$result = $con->query("select * from account where username = '$username' AND password ='$password'");
		
		
		//store query result 
		$row = mysqli_fetch_assoc($result);
		
		//Store variables needed in session variable(s). 
		$_SESSION['ACCOUNTNUMBER'] = $row['Account_number'];
		$_SESSION['ACCOUNTTYPE'] = $row['Account_type'];	
		$_SESSION['USERNAME'] = $row['username'];
		
		//login if account exists
		if(isset($_SESSION['ACCOUNTNUMBER'])){
			
			if ($row['Account_type'] == 'volunteer'){
			check_volunteer_account($row['Account_number']);
			} else {
				header('Location: Account.php');
			}
		} else { 
			$error_message = TRUE;
		}
				
	}
?>

<?php
echo file_get_contents("scripts/header.html");

?>
<link href="css/Login.css" rel="stylesheet" type="text/css" />

<title>Login</title>

<?php
echo '<nav class="MenuBar clearfix grpelem" id="menuu1244"><!-- horizontal box -->';
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

$sql = "SELECT  `PageName` ,  `Location` ,  `ParentID` 
FROM SiteMap
WHERE  `ParentID` <= 0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo'<div class="MenuItemContainer clearfix grpelem" id=""><!-- vertical box --> <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u1248" href="';
        echo  $row["Location"];
		echo '"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u1249-4"><!-- content --> <p><span id="u1249">';
		echo $row["PageName"];
		echo '</span></p> </div></a> </div>';
		
    }
} else {
    echo "0 results";
}
$conn->close();
echo "</nav> </div>";

?>
<div class="Login">
  <h1 align="center">Login</h1>
  <div>
    <p align="center">
      <?php 
   if($error_message == TRUE){
		echo "Incorrect Login. Try Again.";   
   }
  ?>
    </p>
  </div>
  <form action="" method="post" style="text-align:center;">
    <p>
  <label>Enter Username<br/> 
  </label>
  <input name="username" type="text" autofocus id="username" placeholder="Username"><br/><br/>
  <label>Enter Password<br/> 
  </label>
  <input name="password" type="password" autofocus id="password" placeholder="Password"><br/><br/>
  <input name="login" type="submit" id="login" value="Login">
  </p>
    <p>Dont have an account? <a href="Login_Registration.php"> Register </a></p>
</form>
</div>
<?php

echo file_get_contents("scripts/footer.html");
?>
