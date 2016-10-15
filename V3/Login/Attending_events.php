<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set variables
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$account_type = $_SESSION['ACCOUNTTYPE'];
$username = $_SESSION['USERNAME'];
$id = $_SESSION['IDNUMBER'];

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
<title>Attending Event</title>
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
        <th width="72">Event</th>
        <th width="71">Start Date</th>
        <th width="124">Start Time</th>
        <th width="124">Tickets Reserved</th>
        <th width="124">Ticket Price</th>
        <th width="124">View Event</th>
        </tr>
		<?php
		//Set Query - select the events that is tied with the account number
		$sql_event_id = "select * from attending_events where ID_number = '$id'";
		$result = mysqli_query($con, $sql_event_id);
		
		//if no result is found then echo an error message.
		if (mysqli_num_rows($result) == 0){
			echo "You Are not registered to any events. Please click on avaialble events. To register.";	
		} else 
		{
			//store each event as a row, for each while iteration
			while ($row_ID = mysqli_fetch_array($result))
			{
			$event_id = $row_ID['Event_ID'];
			$tickets_reserved = $row_ID['Reserved_tickets'];
			
			//select everything for that event
			$sql_event_details = "select * from event where Event_ID = '$event_id'";
			$result2 = mysqli_query($con, $sql_event_details);
			
			//Displays the ticket price
			$sql_ticket_price = "select Ticket_cost FROM finances WHERE Event_ID = '$event_id'";
			$tp_result = mysqli_query($con, $sql_ticket_price);
			$tp_row = mysqli_fetch_assoc($tp_result);
			$ticket_price = $tp_row['Ticket_cost'];
			
			//sql - see if the member donated to the event
			$sql_members_donations = "select * from members_donation where Event_ID = '$event_id' and Member_ID = '$id'";
			$md_result = mysqli_query($con, $sql_members_donations);
			$numrows = mysqli_num_rows($md_result); // used to indicate if member donated to event
			
			//If the ticket price hasnt been released. Flag error message
			if ($tp_row['Ticket_cost'] == NULL){
				$ticket_price = 'Not released';
			} else 
			if ($tp_row['Ticket_cost'] == 0){
				$ticket_price = 'Free';
			} else {
				$ticket_price = '$'.$tp_row['Ticket_cost'];
			}
			
			//check if the member donated to that event. If he/she did, make ticket price free.
			if ($numrows > 0){
				$ticket_price = 'Free';
			}

			//load the information for that event as a row for the table.
			//Then fill the table as necessary.
			$row = mysqli_fetch_array($result2);
			echo "<tr>";
			echo '<td style="text-align:center;">' . $row['Event_Name'] . '</td>';
			echo '<td style="text-align:center;">' . date('d-m-Y', strtotime($row['Event_Date'])) . '</td>';
			echo '<td style="text-align:center;">' . $row['Event_Time'] . '</td>';
			echo '<td style="text-align:center;">' . $tickets_reserved . '</td>';
			echo '<td style="text-align:center;">' . $ticket_price . '</td>';
			
			?> 
            
            <!-- The view button at each row-->
			<td style="text-align:center;">
				<form  action="" method="post"> 
                 <!-- Set the current event's id as the hidden input of the view button-->
				<input type="hidden" name="event_id" value = <?php echo  $event_id;?>>
				<input type="submit" value="View" name="view_event" id="view_event">
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
