<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set variables
$senders_email = $_SESSION['EMAIL'];

$email_exists = $account_created = $sent_email = FALSE;

$v_password =  $v_username = "";

/*
check if email already exists in the database.
if there is flag the error message.
*/
function check_email($email){
	global $email_exists;
	global $con;
	
	$sql = "select * from volunteer where Email = '$email'";
	$result = mysqli_query($con, $sql);
	$numrows = mysqli_num_rows($result);
	
	if($numrows > 0){
		$email_exists = TRUE;	
	}
}

//Make the volunteer account
function generate_account(){
	global $con;
	global $account_created;
	global $v_username;
	global $v_password;
	
	$v_password = uniqid('PW-');
	$v_username = uniqid('UN-');
	
	$sql = "INSERT INTO account (Account_type, username, password)
			VALUES ('volunteer','$v_username', '$v_password')";
	mysqli_query($con, $sql);
	
	$account_created = TRUE;
	
}

//Make the message to send to volunteer
function generate_message($username, $password){
	$message = 
	"
	Dear new volunteer,
				
	Here are your account credentials: 
	
	Username: $username
	Password: $password
				
	To finish your account. Login with these credentials. 
	
	If you have anymore questions reply to this email or contact one of the other planners.
	";
				
	return $message;
}

//send email to volunteer
function send_email($email, $message){
	global $senders_email; 
	global $sent_email;
	
	$recipient_email = $email;
	$subject = 'Event Organisation: Your account has been setup.'; 
	$message = $message;
	$header = "From: " . $senders_email . "\r\n"; // uses the currently logged in email of the planner
	
	//send the email
	mail($recipient_email,$subject,$message ,$header);
	
	$sent_email = TRUE;
}

if(isset($_POST['submit'])){
	$volunteer_email = $_POST['volunteeremail'];
	$_SESSION['v_accountnumber'] = $volunteer_email ;
	check_email($volunteer_email);
	if ($email_exists == FALSE) {
		generate_account();
		$message = generate_message($v_username, $v_password);
		send_email ($volunteer_email, $message);
	}
}

?>
<!doctype html>
<html>
<head>
<link href="css/Master.css" rel="stylesheet" type="text/css" />
<link href="css/Menu.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Add new volunteer</title>
</head>

<body>
<div class="Container">
    	<div align="center" class="Header"></div>
        <div class="Menu">
            <div id="tabs31">
            	<ul>
                    <li><a href="Account.php" title=""><span>Account</span></a></li>
                    <li><a href="Planners_Events.php" title=""><span>Events</span></a></li>
                    <li><a href="Volunteer_list.php" title=""><span>Volunteers</span></a></li>
                    <li><a href="Finances.php" title=""><span>Finances</span></a></li>
                    <li><a href="Sponsors.php" title=""><span>Sponsors</span></a></li>
                    <li><a href="Email.php" title=""><span>Email</span></a></li>
                </ul>
            </div>
        </div>
        <div class="FullBody" style="text-align: center">
        <h1> Add new volunteer </h1>
        <p>
        <?php
		if($email_exists == TRUE){
			echo ' <p> Email address is already being used by another volunteer. </p>';	
		}
		
		if($account_created == TRUE){
			echo ' <p> Account has been created. </p>';	
		}
		
		if($sent_email == TRUE){
			echo "<p> The account details has been sent to: " . $volunteer_email ."</p>";
			echo '<p> You cant assign this volunteer to events until he or she finishes her account registration</p>';		
		}
		
		?>
        </p>
        <form action="" method="post">
          <p>
          <label>Enter Volunteer's Email:</label> <br>
          <input name="volunteeremail" type="email" id="volunteeremail" placeholder="Enter email here">
          </p>
          <p> <input type="submit" id="submit" name="submit" value="Confirm"> </p>
        </form>
        
  </div>
</div>
</body>
</html>
