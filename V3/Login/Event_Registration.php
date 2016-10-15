<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set variables
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$account_type = $_SESSION['ACCOUNTTYPE'];
$username = $_SESSION['USERNAME'];
$event_id = $_SESSION['EVENTID'];
$id = $_SESSION['IDNUMBER'];

$sql = "select Event_Name from event where Event_ID  = '$event_id'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);
$event_name = $row['Event_Name'];

if(isset($_POST['submit'])){
	$reservedtickets = $_POST['number'];
	$sql2 = "select * from attending_events where Event_ID = '$event_id' and ID_number = '$id'";
	$result2 = mysqli_query($con,$sql2);
	$row2 = mysqli_fetch_assoc($result2);
	$numrows = mysqli_num_rows($result2);
	if($numrows == 0){
		$sql3 = "INSERT INTO attending_events (Event_ID, ID_number,Reserved_tickets)
				 VALUES ('$event_id', '$id', '$reservedtickets')";
	} else {
		$sql3 = "UPDATE attending_events
				 SET Reserved_tickets = '$reservedtickets'
				 WHERE Event_ID = '$event_id' and ID_number = '$id'";
	}
	mysqli_query($con,$sql3);
	header ("Location: Attending_events.php");
}
?>
<!doctype html>
<html>
<head>
<link href="css/Master.css" rel="stylesheet" type="text/css" />
<link href="css/Menu.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Event Registration</title>
</head>

<body>
<div class="Container">
    	<div align="center" class="Header"></div>
        <div class="Menu">
            <div id="tabs31">
            <ul>
                  <li><a href="Account.php" title=""><span>Account</span></a></li>
                  <li><a href="Attending_events.php" title=""><span>Attending Events</span></a></li>
                  <li><a href="Donations.php" title=""><span>Donations</span></a></li>
                  <li><a href="Available_events.php" title=""><span>Available Events</span></a></li>
            </ul>
            </div>
        </div>
        <div class="FullBody" style="text-align:center;">
        <h1>Event Registration</h1>
        <p>Event: <?php echo $event_name ?></p>
        <p>How many people are you bringing? :</p>
        <form action="" method="post">
            <p>
              <input name="number" type="number" id="number" placeholder="Enter value here">
          </p>
            <p>
              <input type="submit" name="submit" id="submit" value="Confirm">
            </p>
        </form>
  </div>
</div>
</body>
</html>
