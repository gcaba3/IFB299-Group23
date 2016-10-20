<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set variables
$sponsorid = $_SESSION['SPONSORID'];

if(isset($_POST['submit'])){
	$chosen_eventid = $_POST['event'];
	$currentdate = date("Y-m-d",time());
	$amount = $_POST['amount'];
	
	$sql = "INSERT INTO sponsors_donation(sponsor_ID, event_ID, amount, date_donated)
			VALUES ('$sponsorid','$chosen_eventid','$amount','$currentdate')";
	mysqli_query($con,$sql);
	header('Location: Sponsors.php');
}
?>
<!doctype html>
<html>
<head>
<link href="css/Master.css" rel="stylesheet" type="text/css" />
<link href="css/Menu.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>New Sponsor Donation</title>
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
        <div class="FullBody" style="text-align:center;">
        <h1>Log Sponsor's Donation</h1>
        
        <form method="post" action="">
            <p> Choose which event the sponsor donated to: </p>
            <p>
            <select name="event">
                <?php
                    $sql = "select * from event";
                    $result = mysqli_query($con, $sql);
                    
                    
                    while ($event = mysqli_fetch_array($result)){
                        echo "<option value=".$event['Event_ID'].">". $event['Event_Name']."</option>";
                    }
                ?>
            </select>
            </p>
            
            <p>Enter the value of the donation</p>
            <p><input name="amount" type="number" id="amount" placeholder="Enter Amount here" min='1'></p>
            <p><input type="submit" value="Confirm" name="submit" id="submit"></p>
        </form>
        </div>
</div>
</body>
</html>
