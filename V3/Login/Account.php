<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set variables
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$account_type = $_SESSION['ACCOUNTTYPE'];
$username = $_SESSION['USERNAME'];

//check if account exists
if(isset($accountnumber)){
	//Set Query
	$sql = "select * from $account_type where Account_number = '$accountnumber'";
	$result = mysqli_query($con, $sql);
	
	//$store query result 
	$row = mysqli_fetch_assoc($result);
} else {
	header('Location: error_page.php');
}
?>
<!doctype html>
<html>
<head>
<link href="css/Master.css" rel="stylesheet" type="text/css" />
<link href="css/Menu.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Account</title>
</head>

<body>
<div class="Container">
    	<div align="center" class="Header"></div>
        <div class="Menu">
            <div id="tabs31">
            <?php if ($account_type == "member") { ?>
                <ul>
                    <li><a href="Account.php" title=""><span>Account</span></a></li>
                    <li><a href="Attending_events.php" title=""><span>Attending Events</span></a></li>
                    <li><a href="Donations.php" title=""><span>Donations</span></a></li>
                    <li><a href="Available_events.php" title=""><span>Available Events</span></a></li>
                </ul>
           	<?php } elseif ($account_type == "planner") { ?>
            	<ul>
                    <li><a href="Account.php" title=""><span>Account</span></a></li>
                    <li><a href="Planners_Events.php" title=""><span>Events</span></a></li>
                    <li><a href="Finances.php" title=""><span>Finances</span></a></li>
                    <li><a href="Sponsors.php" title=""><span>Sponsors</span></a></li>
                    <li><a href="Email.php" title=""><span>Email</span></a></li>
                </ul>
                <?php } elseif ($account_type == "volunteer") {?>
                <ul>
                    <li><a href="Account.php" title=""><span>Account</span></a></li>
                    <li><a href="Volunteers_Event.php" title=""><span>Events</span></a></li>
                    <li><a href="Planners.php" title=""><span>Planners</span></a></li>
                </ul>
                <?php } ?>
            </div>
        </div>
        <div class="LeftBody">
        <h1><?php echo ucfirst($account_type); ?>'s Account </h1>
        <p> Here are your account details:</p>
        <p>Account Number: <?php echo $row['Account_number'] ?></p>
        <p><?php echo ucfirst($account_type); ?>'s Account ID: <?php echo $row['ID'] ?></p>
        <p>Username: <?php echo $username ?></p>
        <p>Name: <?php echo $row['FirstName'] . " " . $row['LastName']; ?></p>
        <p>Email: <?php echo $row['Email'] ?> </p>
        <p><?php if ($account_type == 'planner' || $account_type == 'volunteer' ){ ?> Phonenumber: <?php echo $row['PhoneNumber']; } ?> </p>
          
  </div>
        <div class="RightBody">
       	  <p><a href="Verification_form.php"> Edit Login</a></p>
          <p><a href="Edit_Account_Details.php"> Edit Account Details</a></p>
          <p><a href="Login_form.php"> Logout </a></p>
        </div>
        <div class="Footer"></div>
</div>
</body>
</html>
