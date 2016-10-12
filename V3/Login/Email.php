<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//set session variables
$senders_email = $_SESSION['EMAIL'];

//Set form variables
$error_event = FALSE;
$email_address = $event_ID = "";
$error_recipient = FALSE;
function email_members(){
	global $email_address;
	global $con;
	global $event_ID;
	if($event_ID == ""){
		$sql = "select Email from member";
		$result = mysqli_query($con,$sql);
		while ($row = mysqli_fetch_assoc($result)){
			$email_address .= $row['Email'] . ", ";
		}
	} else {
		$sql = "select Account_number from attending_events where Event_ID = '$event_ID'";
		$result = mysqli_query($con, $sql);
		while($row = mysqli_fetch_assoc($result)){
			$member_id = $row['Account_number'];
			$sql2 = "select Email from member where ID = '$member_id'";
			$result2 = mysqli_query($con, $sql2);
			$row2 = mysqli_fetch_assoc($result2);
			$email_address .= $row2['Email'] . ", ";
		}
		
	}

}

function email_volunteers(){
	global $email_address;
	global $con;
	global $event_ID;
	if($event_ID == ""){
		$sql = "select Email from volunteer";
	} else {
		$sql = "select Email from volunteer where Event_ID = '$event_ID'";
	}
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_assoc($result)){
		$email_address .= $row['Email'] . ", ";
	}
}

function email_planners(){
	global $email_address;
	global $con;
	global $event_ID;
	if($event_ID == ""){
		$sql = "select Email from planner";
		$result = mysqli_query($con,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$email_address .= $row['Email'] . ", ";
		}
	} else {
		$sql = "select planner_ID from event_planner where Event_ID = '$event_ID'";
		$result = mysqli_query($con, $sql);
		while($row = mysqli_fetch_assoc($result)){
			$planner_id = $row['planner_ID'];
			$sql2 = "select Email from planner where ID = '$planner_id'";
			$result2 = mysqli_query($con, $sql2);
			$row2 = mysqli_fetch_assoc($result2);
			$email_address .= $row2['Email'] . ", ";
		}
	}
}

if(isset($_POST['fill'])){
	if(!empty($_POST['eventID'])){
		global $event_ID;
		$event_ID = $_POST['eventID'];
		$sql = "select * FROM event where Event_ID = '$event_ID'";
		$result = mysqli_query($con, $sql);
		$num_results = mysqli_num_rows($result);
		if($num_results <= 0){
			$error_event = TRUE;
		} else {
			$event_ID = $_POST['eventID'];
		}
	}
	
	if(!empty($_POST['group'])){
		$email_address = "";
		foreach($_POST['group'] as $group){
			if($group == 'members'){
				email_members();
			}
			if($group == 'volunteers'){
				email_volunteers();
			}
			if($group == 'planners'){
				email_planners();
			}
		}
	}
} elseif(isset($_POST['send'])){
	if(!empty($_POST['recipient'])){
			$recipient_emails = $_POST['recipient'];
		$email_subject = $_POST['subject'];
		$email_message = $_POST['message'];
		$header = "From: " . $senders_email;
	
		mail($recipient_emails,$email_subject,$email_message,$header);
	} else {
		$error_recipient = TRUE;
	}
}
?>
<!doctype html>
<html>
<head>
<link href="css/Master.css" rel="stylesheet" type="text/css" />
<link href="css/Menu.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Planner's template</title>
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
		<script language="JavaScript">
			function toggle(source) {
			  checkboxes = document.getElementsByName('group[]');
			  for(var i=0, n=checkboxes.length;i<n;i++) {
				checkboxes[i].checked = source.checked;
			  }
			}
        </script>
                
        <form action="" method="post" style="text-align:center; margin-bottom:10px;">
            <p> If about specific event:  
            <input type="text" placeholder="Enter ID number" name="eventID"> 
			<?php if($error_event == TRUE) { echo "Event doesn't exists";} ?>
            </p>
            <input type="checkbox" name="group[]" value="volunteers">Volunteers
            <input type="checkbox" name="group[]" value="members">Members
            <input type="checkbox" name="group[]" value="planners">Planners
            <input type="checkbox" onClick="toggle(this)">All<br>
            <input type="submit" name="fill" id="fill" value="Fill">
        </form>
        
        <form action="" method="post" style="text-align:center;">
            <textarea name = "recipient" style="margin-bottom:5px;  width:80%;" placeholder="Enter the recipients email(s)"><?php if($error_recipient){echo "Please fill in the receipient address"; }else{ echo rtrim($email_address, ", ");} ?></textarea>
            <textarea name = "subject" style="margin-bottom:5px;  width:80%; height:20px;" placeholder="Enter Subject"></textarea>
            <textarea name = "message" style="display:block; margin-left:auto; margin-right:auto; margin-bottom:10px; width:80%; height:170px;" placeholder="Enter message"></textarea>
            <input type="submit" name="send" id="send" value = "Send">
        </form>
    </div>
</div>
</body>
</html>
