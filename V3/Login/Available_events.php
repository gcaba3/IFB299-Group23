<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set variables
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$account_type = $_SESSION['ACCOUNTTYPE'];
$username = $_SESSION['USERNAME'];

if(isset($_POST['view_event'])){
	$_SESSION['EVENTID'] = $_POST['event_id'];
	header ("Location: Event_page.php");
} else 
if(isset($_POST['regis_event'])){
	$_SESSION['EVENTID'] = $_POST['event_id'];
	header ("Location: Event_Registration.php");
}
?>
<!doctype html>
<html>
<head>
<link href="css/Master.css" rel="stylesheet" type="text/css" />
<link href="css/Menu.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Available Events</title>
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
        <div class="FullBody">
        <table style="width:100%" border="0"> 
        <tr>
        <th width="100">Event</th>
        <th width="100">Start Date</th>
        <th width="100">Start Time</th>
        <th width="72">View Event</th>
        <th width="72">Register</th>
        </tr>
		<?php
		//Set Query - select the events that is tied with the account number
		$sql_event_id = "select * from event where regis_statues = 'Open'";
		$result = mysqli_query($con, $sql_event_id);
		
		//if no result is found then echo an error message.
		if (mysqli_num_rows($result) == 0){
			echo "There are no events open. Sorry for the incovenience. You will be emailed when one is available.";	
		} else 
		{
			while ($row = mysqli_fetch_array($result)){
			$event_id = $row['Event_ID'];
				echo "<tr>";
			echo '<td style="text-align:center;">' . $row['Event_Name'] . '</td>';
			echo '<td style="text-align:center;">' . $row['Event_Date'] . '</td>';
			echo '<td style="text-align:center;">' . $row['Event_Time'] . '</td>';
			
			?> 
            
            <!-- The view button at each row-->
			<td style="text-align:center;">
				<form  action="" method="post"> 
                 <!-- Set the current event's id as the hidden input of the view button-->
				<input type="hidden" name="event_id" value = <?php echo  $event_id;?>>
				<input type="submit" value="View" name="view_event" id="view_event">
				</form>
			</td>
            
            <!-- The register button at each row-->
            <td style="text-align:center;">
				<form  action="" method="post"> 
                 <!-- Set the current event's id as the hidden input of the view button-->
				<input type="hidden" name="event_id" value = <?php echo  $event_id;?>>
				<input type="submit" value="Register" name="regis_event" id="regis_event">
				</form>
			</td>
			<?php
			}
		}
		?>
			
        </table>
        <p>Note Ticket Price(s) are only released after registration is closed. </p>
  </div>
</div>
</body>
</html>
