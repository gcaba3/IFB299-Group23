<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set variables
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$account_type = $_SESSION['ACCOUNTTYPE'];
$username = $_SESSION['USERNAME'];
$sponsorid = $_SESSION['SPONSORID'];

$sql = "select * from sponsors where Sponsor_ID = '$sponsorid'";
$result = mysqli_query($con,$sql);
$sponsor = mysqli_fetch_assoc($result);

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

//returns the date of the latest donation made to the event by the sponsor
function date_last_donated($sponsorID, $eventID){
	global $con;
	
	$sql = "select * from sponsors_donation WHERE sponsor_ID = '$sponsorID' and event_ID = '$eventID' order by date_donated DESC limit 1";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	return date('d-m-Y', strtotime($row['date_donated']));
}

//returns the sum of the sponsors donation made to one event
function total_donations($sponsorID, $eventID){
	global $con;
	
	$sql = "select SUM(amount) AS total_donations from sponsors_donation WHERE sponsor_ID = '$sponsorID' and event_ID = '$eventID'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	return $row['total_donations'];
}

if(isset($_POST['submit'])){
	header('Location: Log_sponsors_donation.php');
} else if(isset($_POST['viewdonations'])){
	header('Location: Sponsors_donation_history.php');
}

?>
<!doctype html>
<html>
<head>
<link href="css/Master.css" rel="stylesheet" type="text/css" />
<link href="css/Menu.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Sponsor's Account</title>
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
        <div class="LeftBody" style="height:100px">
        <p>Sponsor's ID: <?php echo $sponsorid ?></p>
        <p>Sponsor's Name: <?php echo $sponsor['Sponsor_Name']; ?></p>
        <p>Sponsor's Email: <?php echo $sponsor['Email']; ?></p>
        
        </div>
        <div class="RightBody" style="height:100px">
        		<!---Log new sponsors donation-->
                 <form  action="" method="post" style="margin-top:25px;"> 
                <p><input type="submit" value="Log new donation" name="submit" id="submit"></p>
                <p><input type="submit" value="View donation history" name="viewdonations" id="viewdonations"></p>
                </form>
        </div>
        <div class="FullBody" style="height:400px;">
        <p>Here are the events <?php echo "<strong>" . $sponsor['Sponsor_Name'] ."</strong>"; ?> is sponsoring: </p>
        
		<table style="width:100%; margin-top:10px;" border="0">
            <tr>
            <td style="text-align:center"> Event ID </td>
            <td style="text-align:center"> Event Name </td>
            <td style="text-align:center"> Total Amount </td>
            <td style="text-align:center"> Last Donation made </td>
            
           	<?php
			$sql = "select * from sponsors_donation WHERE sponsor_ID = '$sponsorid' GROUP BY event_ID";
			$result = mysqli_query($con, $sql);
			
			
			
			while ($row = mysqli_fetch_array($result)){
				echo '<tr>';
				echo '<td style="text-align:center">'. $row['event_ID'] .'</td>';
				echo '<td style="text-align:center">'. event_name($row['event_ID']) .'</td>';
				echo '<td style="text-align:center">'. total_donations($sponsorid, $row['event_ID']) .'</td>';
				echo '<td style="text-align:center">'. date_last_donated($sponsorid, $row['event_ID']) .'</td>';
				
			}
			?>            
        </table>
        </div>
</div>
</body>
</html>
