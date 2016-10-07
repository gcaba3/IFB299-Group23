<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set variables
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$account_type = $_SESSION['ACCOUNTTYPE'];
$username = $_SESSION['USERNAME'];
$Updated = FALSE;

//check if save button is set
if(isset($_POST['save'])){
	// Set query, to select everything from the volunteers table
	$sql_volunteer = "select * FROM volunteer";
	$v_result = mysqli_query($con, $sql_volunteer);
	$total_rows = mysqli_num_rows($v_result); 
	
	//Cycle through all the possible rows. Use each iteration as the volunteers id.
	for($int = 1; $int <= $total_rows; $int++){
		$volunteer_ID = $int;
		$event_ID = $_POST[$int];
		
		//Checks if the event to that volunteers event entry is set (0). if it is update the event column as null
		// if not then update the event column as the selected data from the list.
		if($event_ID == 0){
			$event_ID = NULL;
			$sql_assign_event = "UPDATE volunteer SET Event_ID = NULL WHERE ID = '$volunteer_ID'";
			mysqli_query($con, $sql_assign_event);
		} else {
			$sql_assign_event = "UPDATE volunteer SET Event_ID = '$event_ID' WHERE ID = '$volunteer_ID'";
			mysqli_query($con, $sql_assign_event);
		}
	}
	$Updated = TRUE;
} elseif(isset($_POST['add_new'])){
	//Open new register new volunteer page
	header('Location: new_volunteer.php');
}
?>
<!doctype html>
<html>
<head>
<link href="css/Master.css" rel="stylesheet" type="text/css" />
<link href="css/Menu.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Volunteer List</title>
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
        <?php
		if($Updated == TRUE){
			echo "Successfully Updated";
		}
		?>
        <table style="width:100%" border="0"> 
        <tr>
        <th width="150">ID</th>
        <th width="290">Name</th>
        <th width="290">Event</th>
        <th width="290">Phone number</th>
        <th width="290">Email</th>
        </tr>
        
        <?php
		//set query - select everything from volunteer table
		$sql_volunteer = "select * FROM volunteer";
		$v_result = mysqli_query($con, $sql_volunteer);
		
		//Select everything from the volunteers table. Then fill html table as necessary
		while($volunteer = mysqli_fetch_array($v_result)){
			echo "<tr>";
			echo '<td style="text-align:center;">' . $volunteer['ID'] . '</td>';
			echo '<td style="text-align:center;">' . $volunteer['FirstName'] . $volunteer['LastName'] . '</td>';
			?>
            
             <!--A drop down box with the all the available events loaded as options. 
             Set the selects name as the volunteers id-->
			<td style="text-align:center;">
            <select name=<?php echo $volunteer['ID'] ?> form="assign_event">
            
            <!--Load the already existing event if it is set. If not then set the first option to none-->
            	<?php if(isset($volunteer['Event_ID'])){?>
					<option value = <?php echo $volunteer['Event_ID']; ?> > <?php echo $volunteer['Event_ID']; ?></option>
                    <option value = 0 > None</option>
				<?php } else { ?>
                	<option value = 0 > None</option>
                <?php } ?>
            	
            	<?php
				// Set query - to select the all the events that are open
					$sql_events = "select Event_ID FROM event where regis_statues= 'Open'";
					$e_result = mysqli_query($con, $sql_events);
					
					//cycle through all the events from the result. 
					while($event = mysqli_fetch_assoc($e_result)){
						//set the events id as a local variable. Then set that as an option in the drop down box.
						$event_id = $event['Event_ID'];
						?> 
						<option value=<?php echo $event_id ?>> <?php echo $event_id ?></option>
						<?php
					}
				?>
            </select>
            </td>
			<?php
			
			echo '<td style="text-align:center;">' . $volunteer['PhoneNumber'] . '</td>';
			echo '<td style="text-align:center;">' . $volunteer['Email'] . '</td>';
		}
		?>
        </table>
   		
        <!--The form to submit the input from the page-->
        <form action = "" method= "post" id="assign_event">
        	<input type="submit" value = "Save" name="save" id="save" style="margin-top:10px; margin-left:50px;">
        	<input type="submit" name="add_new" id="add_new" value="Add new">
        </form>
  </div>
</div>
</body>
</html>
