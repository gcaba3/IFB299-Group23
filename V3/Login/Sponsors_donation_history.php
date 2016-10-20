<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set variables
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

//return the sponsor name of the given sponsor id
function sponsor_name($sponsor_id){
	global $con;
	$event_name = "";
	
	$sql = "SELECT Sponsor_Name from sponsors where Sponsor_ID = '$sponsor_id'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($result);
	$sponsor_name = $row['Sponsor_Name'];
	
	return $sponsor_name;
}

?>
<!doctype html>
<html>
<head>
<link href="css/Master.css" rel="stylesheet" type="text/css" />
<link href="css/Menu.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Sponsors Donation History</title>
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
        <div class="FullBody" style="margin-top:15px; height:400px;">
       <p style="text-align:center"> Here is the donation history of: <?php echo sponsor_name($sponsorid); ?> </p>
        
		<table style="width:100%;" border="0">
            <tr>
            <td style="text-align:center"> Donation ID </td>
            <td style="text-align:center"> Event ID </td>
            <td style="text-align:center"> Event Name </td>
            <td style="text-align:center"> Amount </td>
            <td style="text-align:center"> Date Donated</td>
            
           	<?php
			$sql = "select * from sponsors_donation WHERE sponsor_ID = '$sponsorid' order by date_donated DESC";
			$result = mysqli_query($con, $sql);

			while ($row = mysqli_fetch_array($result)){
				echo '<tr>';
				echo '<td style="text-align:center">'. $row['ID'] .'</td>';
				echo '<td style="text-align:center">'. $row['event_ID'] .'</td>';
				echo '<td style="text-align:center">'. event_name($row['event_ID']) .'</td>';
				echo '<td style="text-align:center">'. $row['amount'] .'</td>';
				echo '<td style="text-align:center">'.  date('d-m-Y', strtotime($row['date_donated'])) .'</td>';
				
			}
			?>          
        </table>
        
        <p style="text-align:center"><a href="Sponsor_account.php"> Return to sponsor's account </a></p>  
        </div>
</div>
</body>
</html>
