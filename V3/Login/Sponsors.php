<?php require 'Connections/connections.php'; ?>
<?php
session_start();

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

//function return the name of the last event the sponsor donated to
function latest_event($sponsorid){
	global $con;
	
	$sql = "select * from sponsors_donation where Sponsor_ID = '$sponsorid' ORDER BY date_donated DESC limit 1";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($result);
	
	return event_name($row['event_ID']);
}

if(isset($_POST['submit'])){
	if(isset($_POST['id'])){
		$_SESSION['SPONSORID'] = $_POST['id'];
		header ("Location: Sponsor_account.php");
	}
} else if(isset($_POST['addnew'])){
	header('Location: Add_new_sponsor.php');
}


?>
<!doctype html>
<html>
<head>
<link href="css/Master.css" rel="stylesheet" type="text/css" />
<link href="css/Menu.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Sponsors </title>
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
        <div class="FullBody" >
            <table style="width:100%;" border="0">
            <tr>
            <td> Sponsor ID </td>
            <td> Sponsor Name </td>
            <td> Email </td>
            <td> Latest Event Sponsoring </td>
            <td> View </td>
            
           	<?php
			$sql = "select * from sponsors";
			$result = mysqli_query($con, $sql);
			
			while ($row = mysqli_fetch_array($result)){
				echo '<tr>';
				echo '<td>'. $row['Sponsor_ID'] .'</td>';
				echo '<td>'. $row['Sponsor_Name'] .'</td>';
				echo '<td>'. $row['Email'] .'</td>';
				echo '<td>'. latest_event($row['Sponsor_ID']) .'</td>';
				echo '<td>';
				?>
                <form  action="" method="post"> 
                 <!-- Set the current event's id as the hidden input of the view button-->
                <input type="hidden" name="id" value = <?php echo $row['Sponsor_ID'];?>>
                <input type="submit" value="View" name="submit" id="submit">
                </form>
				<?php
                echo '</td>';
			}
			?>            
            </table>
            
            <!---Add new Button-->
            <form  action="" method="post" style="text-align:center;"> 
            	<input type="submit" value="Add New Sponsor" name="addnew" id="addnew">
            </form>
            
        </div>
</div>
</body>
</html>
