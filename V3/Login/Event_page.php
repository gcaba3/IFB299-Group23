<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set variables
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$account_type = $_SESSION['ACCOUNTTYPE'];
$username = $_SESSION['USERNAME'];
$event_id = $_SESSION['EVENTID'];
$error_message = FALSE;

//checks if event id is not 0. If it is it flags the error message
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
                    <li><a href="Volunteer_list.php" title=""><span>Volunteers</span></a></li>
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
        
        <?php  
		//Checks if the error message is flagged true. If not then it loads in the required information for the page. If it is it displayes the error message.
		if($error_message == FALSE) { ?>
            <h1><?php echo ucfirst($event['Event_Name']); ?></h1>
            <p>Event ID: <?php echo $event['Event_ID']; ?></p>
            <p>Country: <?php echo ucfirst($event['Country']); ?></p>
            <p>State: <?php echo ucfirst($event['State']); ?></p>
            <p>Postcode: <?php echo ucfirst($event['Postcode']); ?> </p>
            <p>Address: <?php echo ucfirst($event['Address']); ?></p>
            <p>Start date: <?php echo date('d-m-Y', strtotime($event['Event_Date'])); ?></p>
            <p>Start time: <?php echo $event['Event_Time']; ?></p>
            <?php 
			//Full address to be used in the google maps api
			$full_address = $event['Address'] . ", " . $event['Postcode'] . ", " .$event['Country'];
			
			
			echo "<a href='Account.php'><span>Return to Account</span></a>";
			
			//members features - to register to event
			if ($event['regis_statues'] == 'Open' &&  $account_type == "member") {
            	echo "<p> <a href='Event_Registration.php'><span>Register</span></a> </p>";
            }
			if ($account_type == "member") {
            	echo "<p> <a href='stop_attending.php'><span>Stop Attending</span></a> </p> ";
            }
        } else {
        	echo "<p> You currently have no events assigned to you. Please contact one of the planners.</p>";
        
        } ?>
  </div>
  <div class="RightBody">
       	  
		  <p>
		  <?php if($account_type == 'planner'){?>
          <a href="Edit_Event.php" title=""><span> Edit Event</span></a>
          &nbsp;
          <a href="stop_planning.php" title=""><span> Stop Planning</span></a>
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
   	    <table style="width:100%" border="0"> 
        <tr>
        <th width="150">Planner</th>
        <th width="290" style="text-align:left;">Email</th>
        </tr>
        <p>
        <?php
		//set query
		$sql_eventplanners = "select * FROM event_planner where event_ID = '$event_id'";
		$ep_result = mysqli_query($con, $sql_eventplanners);
		
		
		//store each event planner, as an iteration of the while loop
		while($event_planner = mysqli_fetch_array($ep_result)){
			$planner_id = $event_planner['planner_ID'];
			
			//Select everything for that planner
			$sql_planner = "select * FROM planner where ID = '$planner_id'";
			$p_result = mysqli_query($con, $sql_planner);
			
			//Store each planner as a row for the table.
			//Then fill in the table with each row.
			$row = mysqli_fetch_array($p_result);
			echo "<tr>";
			echo '<td style="text-align:center;">' . $row['FirstName'] . $row['LastName'] . '</td>';
			echo '<td style="text-align:left;">' . $row['Email'] . '</td>';
		}
		?>
    </table> 
    <?php } ?>      
        </p>
  </div>
</div>
</body>
</html>
