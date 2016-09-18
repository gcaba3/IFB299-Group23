<HTML>
<BODY>

<h1>Account details </h1>
<?php
session_start();
$ACCOUNT_TYPE = $_SESSION['ACCOUNT_TYPE'];
$FIRSTNAME = $_SESSION['FIRSTNAME'];
$LASTNAME = $_SESSION['LASTNAME'];
$ID = $_SESSION['ID'];
$EMAIL = $_SESSION['EMAIL'];

echo "Your ". $ACCOUNT_TYPE . "'s " ."ID: " . $ID. "<br/>";
echo "Your Account Type: " . $ACCOUNT_TYPE. "<br/>";
echo "First Name: " . $FIRSTNAME . "<br/>";
echo "Last Name: " . $LASTNAME . "<br/>";
echo "Email: " . $EMAIL . "<br/>" . "<br/>";

if ($ACCOUNT_TYPE == "planner"){
	?>
	<h1>Account Details</h1>
	<form action = "display_emails.php" method = "POST">
		<button name="all" type="click" value="HTML">Show all emails</button>
	</form> 
		
	<form action = "display_emails.php" method = "POST">
		<button name="idv" type="click" value="HTML">Show individuals email</button>
	</form> 
	
	<form action = "edit_account_details_form.html" method = "POST">
		<button name="subject" type="submit" value="HTML">EDIT</button>
	</form> 
	<?php
	} else { ?>
		<form action = "edit_account_details_form.html" method = "POST">
		<button name="subject" type="submit" value="HTML">EDIT</button>
		</form> 
	<?php } 
?>
</BODY>
</HTML>
