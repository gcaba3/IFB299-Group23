<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set variables
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$account_type = $_SESSION['ACCOUNTTYPE'];
$username = $_SESSION['USERNAME'];
$idnumber = $_SESSION['IDNUMBER'];

//Set the session variable of event as the selected event
if(isset($_POST['view_event'])){
	$_SESSION['EVENTID'] = $_POST['event_id'];
	header ("Location: Event_page.php");
}
?>
<!doctype html>
<html>
<head>
<link href="css/Master.css" rel="stylesheet" type="text/css" />
<link href="css/Menu.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Planner's Events</title>
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
        <div class="FullBody">
        <table style="width:100%" border="0"> 
        <tr>
        <th width="290">Event ID</th>
        <th width="290">Name</th>
        <th width="290">View</th>
        </tr>
        <?php
		//select all the events the planenr is planning
		$sql = "select event_ID FROM event_planner WHERE planner_ID = '$idnumber'";
		$result = mysqli_query($con, $sql);
		$moreevents = 3 - mysqli_num_rows($result); // use to check how many events the planner is planning
		
		//cycle through all the events. Display them as a row in the table.
		while ($row = mysqli_fetch_array($result)){
			echo "<tr>";
			echo '<td style="text-align:center;">' . $row['event_ID'] . '</td>'; // display event id
			
			$eventid = $row['event_ID'];
			
			//select the current event to pull the name from the events table
			$sql2 = "select * FROM event WHERE Event_ID = '$eventid'";
			$result2 = mysqli_query($con, $sql2);
			$row2 = mysqli_fetch_array($result2);
			
			//display event name
			echo '<td style="text-align:center;">' . $row2['Event_Name'] . '</td>';
			?>
			<!-- The view button at each row-->
			<td style="text-align:center;">
				<form  action="" method="post"> 
                 <!-- Set the current event's id as the hidden input of the view button-->
				<input type="hidden" name="event_id" value = <?php echo  $eventid;?>>
				<input type="submit" value="View" name="view_event" id="view_event">
				</form>
			</td>
		<?php }
		//used to show how many plan more events links are displayed depending on how many events the planner is planning.
		for ($int = 1; $int <= $moreevents; $int++){
			echo "<tr>";
			echo '<td style="text-align:center;">'.'</td>';
			echo '<td style="text-align:center;">';
			echo '<a href="Plan_More_Events.php" title="" style="text-decoration:none;"><span>Plan more events</span></a>';
			echo '</td>';
			echo "</tr>";
		}
		
		//error message to show that the planner is planning to many.
		if($moreevents < 0){
			echo 'You are planning more events than allowed. You are only allowed to plan up to three events';
		}
		?>
        </table>
        </div>
</div>
</body>
</html>
