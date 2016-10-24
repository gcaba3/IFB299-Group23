<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set variables
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$account_type = $_SESSION['ACCOUNTTYPE'];
$username = $_SESSION['USERNAME'];
$idnumber = $_SESSION['IDNUMBER'];

$error_message = FALSE;

//Check if confirm button has been clicked
if(isset($_POST['confirm'])){
	$eventid = $_POST['Events'];
	
	//check if the planner is already planning that event.
	//if it does flag the error message.
	//if it doesnt then assign the planner to that event.
	$sql = "SELECT * FROM event_planner WHERE planner_ID = '$idnumber' AND event_ID = '$eventid'";
	$result = mysqli_query($con, $sql);
	$numrows = mysqli_num_rows($result);
	
	if($numrows > 0 ){
		$error_message = TRUE;
		
	} else {
		$sql_add = "INSERT INTO event_planner(planner_ID, event_ID)
					VALUES ('$idnumber', '$eventid')";
		mysqli_query($con, $sql_add);
		header ("Location: Planners_Events.php");
	}
} else
if(isset($_POST['create'])){
	//go to create event
	header ("Location: Create_Event.php");
} else
if(isset($_POST['cancel'])){
	//return to planners events
	header ("Location: Planners_Events.php");
} 
?>
<!doctype html>
<html>
<head>
<link href="css/Master.css" rel="stylesheet" type="text/css" />
<link href="css/Menu.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Plan more events</title>
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
        <?php
		if($error_message == TRUE){
			echo "You are already planning this event. Please choose another event." . "<br>". "<br>";	
		}
		?>
        <!--- select box to show all open events --->
        Choose one of the events: 
        <select name="Events" form="continue">
        <?php
		//select all the events that are open
		$sql = "select Event_ID FROM event where regis_statues= 'Open'";
		$result = mysqli_query($con, $sql);
		
		//set the results as the option fields for the select list
		while ($row = mysqli_fetch_assoc($result)){
			echo "<option value =".$row['Event_ID'].">". $row['Event_ID'] . "</option>";
		}
		?>
        </select>
        
        <!---Form for the buttons--->
        <form  action="" method="post" style="margin-top:20px;" id="continue"> 
        	  <input type="submit" value="Cancel" name="cancel" id="cancel" style="margin-right:10px;">
              <input type="submit" value="Create Event" name="create" id="create" style="margin-right:10px;">
        	  <input type="submit" value="Confirm" name="confirm" id="confirm" style="margin-right:10px;">
              
		</form>
  </div>
</div>
</body>
</html>
