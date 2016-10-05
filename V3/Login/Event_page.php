<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set variables
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$account_type = $_SESSION['ACCOUNTTYPE'];
$username = $_SESSION['USERNAME'];
$event_id = $_SESSION['EVENTID'];
$error_message = FALSE;

if($event_id != 0){
	//Set Query
	$sql = "select * from event where Event_ID = '$event_id'";
	$result = mysqli_query($con, $sql);
	
	//store query result 
	$event = mysqli_fetch_assoc($result);
} else {
	$error_message = TRUE;
}
?>
<!doctype html>
<html>
<head>
<link href="css/Master.css" rel="stylesheet" type="text/css" />
<link href="css/Menu.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Event</title>
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
                    <li><a href="Volunteers_Event.php" title=""><span>Event</span></a></li>
                    <li><a href="Planners.php" title=""><span>Planners</span></a></li>
                </ul>
                <?php } ?>
            </div>
        </div>
        <div class="LeftBody">
        <?php  if($error_message == FALSE) { ?>
            <h1><?php echo ucfirst($event['Event_Name']); ?></h1>
            <p>Country: <?php echo ucfirst($event['Country']); ?></p>
            <p>State: <?php echo ucfirst($event['State']); ?></p>
            <p>Postcode: <?php echo ucfirst($event['Postcode']); ?> </p>
            <p>Address:<?php echo ucfirst($event['Address']); ?></p>
            <p>Start date:<?php echo $event['Event_Date']; ?></p>
            <p>Start time:<?php echo $event['Event_Time']; ?></p>
            <?php 
			$full_address = $event['Address'] . ", " . $event['Postcode'] . ", " .$event['Country'];
			if ($event['regis_statues'] == 'Open' &&  $account_type == "member") {?>
            <a href="#" title=""><span>Register</span></a>
            <?php } ?>
            <a href="Account.php" title=""><span>Return to Account</span></a>
        <?php } else { ?>
        	<p> You currently have no events assigned to you. Please contact one of the planners.</p>
        
        <?php } ?>
  </div>
  <div class="RightBody">
       	  
		  <p>
		  <?php if($account_type == 'planner'){?>
          <a href="#" title=""><span> Edit Event</span></a>
          &nbsp;
          <a href="#" title=""><span> Stop Planning</span></a>
          <?php } ?>
          </p>
          <?php if($error_message == FALSE) {?>
       	  <iframe
              width="425"
              height="300"
              frameborder="0" style="border:0"
              src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBj8rAAP7pg_CUMypAErvj3Eb8hjsJDsTg
                &q=<?php echo urlencode($full_address); ?>">
        </iframe>
        <?php } ?>
  </div>
</div>
</body>
</html>
