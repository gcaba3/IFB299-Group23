<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set variables
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$account_type = $_SESSION['ACCOUNTTYPE'];
$username = $_SESSION['USERNAME'];
$idnumber = $_SESSION['IDNUMBER'];

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

if(isset($_POST['add_new'])){
	header('Location: New_donation.php');
}

?>
<!doctype html>
<html>
<head>
<link href="css/Master.css" rel="stylesheet" type="text/css" />
<link href="css/Menu.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Member's Donation</title>
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
        <th width="150">Donation ID</th>
        <th width="290">Event ID</th>
        <th width="290">Event Name</th>
        <th width="290">Amount</th>
        <th width="290">Date</th>
        </tr>
        <?php
		//sql - select all the donations for the members id
		$sql = "select * from members_donation where member_ID = '$idnumber' ORDER BY Date";
		$result = mysqli_query($con, $sql);
		
		while($row = mysqli_fetch_array($result)){
			//Set the event name for the current event id
			$event_name = event_name($row['Event_ID']);
			
			echo '<tr>';
			echo '<td style="text-align:center;">' . $row['ID'] . '</td>';
			echo '<td style="text-align:center;">' . $row['Event_ID'] . '</td>';
			echo '<td style="text-align:center;">' . $event_name . '</td>';
			echo '<td style="text-align:center;">' . '$'.$row['Amount'] . '</td>';
			echo '<td style="text-align:center;">' . date('d-m-Y', strtotime($row['Date'])) . '</td>';
		}
		?>
        </table>
        <div style="text-align:center">
            <form action = "" method= "post">
                <input  type="submit" name="add_new" id="add_new" value="Add new">
            </form>
        </div>
        
        </div>
</div>
</body>
</html>
