<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set variables
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$idnumber = $_SESSION['IDNUMBER'];

$error_message = $show_donation = $made_new_donation = $no_donations_made = FALSE;
$initial = TRUE;

//return the event name of the given event id
function event_name($event_id){
	global $con;
	$event_name = "";
	
	$sql = "SELECT Event_Name from event where Event_ID = '$event_id'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($result);
	$event_name = $row['Event_Name'];
	
	return $event_name;
}

//Returns the total donations the member already made to the specific event.
function get_sum_of_donations($event_id, $member_id){
	global $con;
	
	$sql = "select SUM(Amount) AS total_donations FROM members_donation where Event_ID = '$event_id' and member_ID = '$member_id'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	$total_donation = $row['total_donations'];
	
	if(!isset($total_donation)){
		$total_donation = 0;
	}
	
	return $total_donation;
}

//Returns an integer of how many tickets that member reserved for the the given event
function calc_reserved_tickets($event_id, $member_id){
	global $con;
	
	$reserved_tickets = "";
	$sql = "select Reserved_tickets from attending_events where Event_ID = '$event_id' and ID_number = '$member_id'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	$reserved_tickets = $row['Reserved_tickets'];
	return $reserved_tickets;
}

//Returns the minimum donation amount depending on how many tickets the member reserved for that event
function calc_minimum_donation($reserved_tickets){
	$minimum_donation = $reserved_tickets * 20;
	return $minimum_donation;
}

//Update the members donation table with the event id and member id as inputs
function update_members_donation($event_id, $member_id, $amount){
	global $con;
	
	$current_date = date("Y-m-j");
	$sql = "INSERT INTO members_donation(member_ID, Event_ID, Amount, Date)
			VALUES ('$member_id','$event_id','$amount','$current_date')";
			
	mysqli_query($con,$sql);
	
}

if(isset($_POST['confirm'])){
	$chosen_event = $_POST['event'];
	$new_donation_amount = $_POST['amount'];
	
	$reserved_tickets = calc_reserved_tickets($chosen_event, $idnumber);
	$min_donation = calc_minimum_donation($reserved_tickets);
	$current_total_donations_made = get_sum_of_donations($chosen_event, $idnumber);
	
	$initial = false;
	
	if ($current_total_donations_made > 0){
		$show_donation = TRUE;
		if($new_donation_amount > 0){
			$new_total_donations_made = $current_total_donations_made + $new_donation_amount; 
			$made_new_donation = TRUE;
		}
		
	}else if ($current_total_donations_made <= 0 && $new_donation_amount <= 0){
		$no_donations_made = TRUE;
	}else if( $current_total_donations_made <= 0 && $new_donation_amount >= $min_donation){
		$new_total_donations_made = $current_total_donations_made + $new_donation_amount; 
		$made_new_donation = TRUE;
	} else {
		$error_message = TRUE;
	}
	
	if($made_new_donation == TRUE){
		update_members_donation($chosen_event, $idnumber, $new_donation_amount);
	}
	
}

?>
<!doctype html>
<html>
<head>
<link href="css/Master.css" rel="stylesheet" type="text/css" />
<link href="css/Menu.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Member's Template</title>
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
        <div class="FullBody" style="text-align:center">
        <h1>New Donation</h1>
        <p>Which one of your events do you want to donate to?</p>
        <form method= "post">
            <select name="event">
            	<?php
				$sql = "select * from attending_events where ID_number = '$idnumber'";
				$result = mysqli_query($con, $sql);
				
				if(isset($chosen_event)){
					echo "<option value=".$chosen_event.">". event_name($chosen_event)."</option>";
					while ($row = mysqli_fetch_array($result)){
						if($row['Event_ID'] != $chosen_event){
							echo "<option value=".$row['Event_ID'].">". event_name($row['Event_ID'])."</option>";
						}
					}
				} else {
					while ($row = mysqli_fetch_array($result)){
						echo "<option value=".$row['Event_ID'].">". event_name($row['Event_ID'])."</option>";
					}
				}
				?>
            </select>
            <?php
			
			//checks if the error message is true. 
			//If it is it shows the user the minimum donation amount.
			if($error_message == TRUE){
				echo '<p>';
				echo 'Because you reserved: ' . $reserved_tickets . ' tickets to ' . event_name($chosen_event);
				echo '</p>';
				echo '<p>';
				echo 'Your minimun donation amount needs to be: $' . $min_donation;
				echo '</p>';
			}
			
			if($initial == TRUE){
				echo '<p>How much do you want to contribute? </p>';
			}
			
			if($no_donations_made == TRUE){
					echo '<p>';
					echo 'You have not made any donations to this event';
					echo '</p>';
			}
			
			if($show_donation == TRUE && $made_new_donation == FALSE){
					echo '<p>';
					echo 'Your donations for this event is: $' . $current_total_donations_made;
					echo '</p>';
			}
			
			if($made_new_donation == TRUE){
					echo '<p>';
					echo 'Your donations for this event was: $' . $current_total_donations_made;
					echo '</p>';
					
					echo '<p>' ;
					echo 'After your new $'. $new_donation_amount .' donation. Your new total is: $' . $new_total_donations_made;
					echo '</p>';
			} 
			?>
            <p><input type="number" placeholder="Enter Value here" min="0" name="amount" id="amount"></p>
            <input type="submit" name="confirm" id="confirm" value="Confirm">
        </form>
        
        Note: Leave blank to see your current donations for that event.
          
  </div>

</div>
</body>
</html>
