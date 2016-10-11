<?php require 'Connections/connections.php'; ?>
<?php
session_start();

function total_members_donation($event_ID){
	global $con;
	// Set query - select the sum of all donations to one event
	$sql_members_donation = "select SUM(Amount) AS members_donations FROM members_donation where Event_ID = '$event_ID'";
	$md_result = mysqli_query($con, $sql_members_donation);
	$row = mysqli_fetch_assoc($md_result);
	$members_donations = $row['members_donations'];
	return $members_donations;
}

function total_sponsors_donation($event_ID){
	global $con;
	// Set query - select the sum of all donations to one event
	$sql_sponsors_donation = "select SUM(amount) AS sponsors_donations FROM sponsors_donation where Event_ID = '$event_ID'";
	$sd_result = mysqli_query($con, $sql_sponsors_donation);
	$row = mysqli_fetch_assoc($sd_result);
	$sponsors_donations = $row['sponsors_donations'];
	return $sponsors_donations;
}

function calc_total_donations($event_ID){
	$members_donation = total_members_donation($event_ID);
	$sponsors_donation = total_sponsors_donation($event_ID);
	$total_donation = $members_donation + $sponsors_donation;
	return $total_donation;
}

function calc_rough_cost($event_ID){
	global $con;
	// Set query - select the sum of all the tickets reserved for one event
	$sql_total_tickets = "select SUM(Reserved_tickets) AS total_tickets FROM attending_events where Event_ID = '$event_ID'";
	$tt_result = mysqli_query($con, $sql_total_tickets);
	$row = mysqli_fetch_assoc($tt_result);
	$total_tickets = $row['total_tickets'];
	
	//calculate rough cost
	$cost_of_ticket = 20;
	$rough_cost = $cost_of_ticket * $total_tickets;
	
	return $rough_cost;
}

function calc_final_cost($rough_cost, $total_donations){
	$final_cost = $rough_cost - $total_donations;
	return $final_cost;
}

function total_members_attending($event_ID){
	global $con;
	
	// Set query - select the registration statues of the event
	$sql = "select * FROM attending_events WHERE Event_ID = '$event_ID'";
	$result = mysqli_query($con, $sql);
	$total_members_attending = mysqli_num_rows($result);
	return $total_members_attending;
}

function num_members_that_donated($event_ID){
	global $con;
	
	// Set query - select the registration statues of the event
	$sql = "select * FROM members_donation WHERE Event_ID = '$event_ID'";
	$result = mysqli_query($con, $sql);
	$members_that_donated = mysqli_num_rows($result);
	return $members_that_donated;
}

function registration_statues($event_ID){
	global $con;
	
	// Set query - select the registration statues of the event
	$sql = "select regis_statues FROM event WHERE Event_ID = '$event_ID'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	$registration = $row['regis_statues'];
	
	return $registration;
}

function calc_ticket_cost($final_cost, $total_members_attending, $members_that_donated){
	global $con;
	
	$members_that_didnt_donate = $total_members_attending - $members_that_donated;
	
	if ($members_that_didnt_donate <= 0 ){
		$ticket_price = 0;
	} else {
		$ticket_price = $final_cost / $members_that_didnt_donate;
	}

	
	return $ticket_price;
}

function update_table($event_id, $rough_cost, $total_donation, $final_cost, $total_members, $total_members_donated, $ticket_price){
	global $con;
	$total_tickets = $rough_cost / 20;
	$sql = "select * FROM finances where Event_ID = '$event_id'";
	$result = mysqli_query($con, $sql);
	$num_rows = mysqli_num_rows($result);
	if($num_rows > 0){
		$sql2 = "UPDATE finances 
		SET Total_tickets = '$total_tickets' , Rough_cost = '$rough_cost', Total_donation = '$total_donation', 
			Final_cost = '$final_cost', Total_members = '$total_members', Total_members_that_donated = '$total_members_donated',
			Ticket_cost = '$ticket_price'
		WHERE Event_ID = '$event_id'";
		mysqli_query($con, $sql2);
		} else {
			$sql2 = 
			"INSERT INTO finances (Event_ID, Total_tickets, Rough_cost, Total_donation, Final_cost,Total_members, Total_members_that_donated, Ticket_cost)
				VALUES ('$event_id', '$total_tickets' ,'$rough_cost', '$total_donation', '$final_cost', '$total_members', '$total_members_donated', '$ticket_price')";
		mysqli_query($con, $sql2);
		}
	
}

function delete_event($event_ID){
	global $con;
	$sql = "DELETE FROM finances WHERE Event_ID = '$event_ID'";
	mysqli_query($con, $sql);
}
?>
<!doctype html>
<html>
<head>
<link href="css/Master.css" rel="stylesheet" type="text/css" />
<link href="css/Menu.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Finances</title>
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
        <th width="150">Event ID</th>
        <th width="150">Registration</th>
        <th width="290">Rough Cost</th>
        <th width="290">Donations</th>
        <th width="290">Final Cost</th>
        <th width="290">Total Members Attending</th>
        <th width="290">Members That Donated</th>
        <th width="290">Ticket Price</th>
        </tr>
        <?php
		
		$sql = 'Select * FROM event ORDER BY regis_statues ASC';
		$result = mysqli_query($con, $sql);
		
		
		while ($row = mysqli_fetch_array($result)){
			$event_ID = $row['Event_ID'];
			$registration = registration_statues($event_ID);
			
			echo "<tr>";
			echo '<td style="text-align:center;">' . $event_ID . '</td>';
			echo '<td style="text-align:center;">' . $registration . '</td>';
			
			if($registration == 'Closed'){
				$rough_cost = calc_rough_cost($event_ID);
				$total_donations =  calc_total_donations($event_ID);
				
				if(is_null($total_donations)){
					$total_donations =  0;
				}
				$final_cost = calc_final_cost($rough_cost,$total_donations);
				$total_members_attending = total_members_attending($event_ID);
				$members_that_donated = num_members_that_donated($event_ID);
				$ticket_price = calc_ticket_cost($final_cost, $total_members_attending, $members_that_donated);
				
				echo '<td style="text-align:center;">' . '$'.$rough_cost . '</td>';
				echo '<td style="text-align:center;">' . '$'.$total_donations . '</td>';
				echo '<td style="text-align:center;">' . '$'.$final_cost . '</td>';
				echo '<td style="text-align:center;">' . $total_members_attending . '</td>';
				echo '<td style="text-align:center;">' . $members_that_donated . '</td>';
				if ($ticket_price <= 0){
					echo '<td style="text-align:center;">' . 'Free' . '</td>';
				} else {
					echo '<td style="text-align:center;">' . '$' . $ticket_price . '</td>';
				}
				echo "</tr>";
				
				update_table($event_ID, $rough_cost, $total_donations, $final_cost, $total_members_attending, $members_that_donated, $ticket_price);
			} else {
				delete_event($event_ID);
				echo "</tr>";
			}
		}
		?>
        </table>
        Note Ticket price is only for the members that didnt donate to the event.
        
        </div>
</div>
</body>
</html>
