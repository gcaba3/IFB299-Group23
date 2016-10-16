<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//set session variables
$senders_email = $_SESSION['EMAIL'];

//Set form variables
$error_event = $error_recipient = FALSE;
$email_address = ""; // the variable to fill the recipient text area
$event_ID = ""; // used for the textbox input

//Function to pull all the emails of the members
function email_members(){
	global $email_address;
	global $con;
	global $event_ID;
	//checks if the form is about a specific event.
	//If it is it only pulls the emails of the members attending the event.
	//ifs its not it pulls all the members emails.
	if($event_ID == ""){
		$sql = "select Email from member";
		$result = mysqli_query($con,$sql);
		while ($row = mysqli_fetch_assoc($result)){
			$email_address .= $row['Email'] . ", "; // add email(s) to email variable
		}
	} else {
		echo $event_ID;
		$sql = "select ID_number from attending_events where Event_ID = '$event_ID'";
		$result = mysqli_query($con, $sql);
		while($row = mysqli_fetch_assoc($result)){
			$member_id = $row['ID_number'];
			$sql2 = "select Email from member where ID = '$member_id'";
			$result2 = mysqli_query($con, $sql2);
			$row2 = mysqli_fetch_assoc($result2);
			$email_address .= $row2['Email'] . ", "; // add email(s) to email variable
		}
		
	}

}

//pulls all the emails of the volunteers
function email_volunteers(){
	global $email_address;
	global $con;
	global $event_ID;
	
	//if its not about a specific event it pulls all volunteer's emails
	// if it is it pulls only the volunteer's emails assigned to that event
	if($event_ID == ""){
		$sql = "select Email from volunteer";
	} else {
		$sql = "select Email from volunteer where Event_ID = '$event_ID'";
	}
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_assoc($result)){
		$email_address .= $row['Email'] . ", "; // add email(s) to email variable
	}
}

//pulls all the emails of the planners
function email_planners(){
	global $email_address;
	global $con;
	global $event_ID;
	
	//if its not about a specific event it pulls all the planners emails.
	//if it is about a specific event that only planners involved in that event is pulled
	if($event_ID == ""){
		//sql - pull all the emails from the planners table
		$sql = "select Email from planner";
		$result = mysqli_query($con,$sql);
		while($row = mysqli_fetch_assoc($result)){
			$email_address .= $row['Email'] . ", ";// add email(s) to email variable
		}
	} else {
		//select the planners id from event planners table about specific event
		$sql = "select planner_ID from event_planner where Event_ID = '$event_ID'";
		$result = mysqli_query($con, $sql);
		while($row = mysqli_fetch_assoc($result)){
			$planner_id = $row['planner_ID'];
			$sql2 = "select Email from planner where ID = '$planner_id'";
			$result2 = mysqli_query($con, $sql2);
			$row2 = mysqli_fetch_assoc($result2);
			$email_address .= $row2['Email'] . ", ";// add email(s) to email variable
		}
	}
}

//checks if the fill button has been pressed.
if(isset($_POST['fill'])){
	//checks if the textbox is empty. if its not save that input value as the event id. if it does
	if(!empty($_POST['eventID'])){
		global $event_ID;
		$event_ID = $_POST['eventID'];
		$sql = "select * FROM event where Event_ID = '$event_ID'";
		$result = mysqli_query($con, $sql);
		$num_results = mysqli_num_rows($result);
		//checks if that event exists. if it doesnt flag the error message
		if($num_results <= 0){
			$error_event = TRUE;
		} else { // saves the input as event id to be used later
			$event_ID = $_POST['eventID'];
		}
	}
	
	//checks if one or more of the checkboxes has been checked
	//if it has pull the email of that specific group or groups
	if(!empty($_POST['group'])){
		$email_address = ""; // resets the initial value. because emails are just added after it
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
	
// checks if the send button has been set.
// if it has and the recipients email text area is not empty 
// then it will send the email with the text areas as the inputs of the email
} elseif(isset($_POST['send'])){
	//checks if the recipient text area is empty.
	//if it s flag the error.
	// if its not setup and send the email
	if(!empty($_POST['recipient'])){
		$recipient_emails = $_POST['recipient']; // store all the text in the recipient text area as recipients email
		$email_subject = $_POST['subject']; 
		$email_message = $_POST['message'];
		$header = "From: " . $senders_email . "\r\n"; // uses the currently logged in email of the planner
		
		//send the email
		mail($recipient_emails,$email_subject,$email_message,$header);
	} else {
		//flag the error empty recipient text area
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
<title>Email </title>
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
    <!---script to check or uncheck the checkboxes--->
		<script language="JavaScript">
			function toggle(source) {
			  checkboxes = document.getElementsByName('group[]');
			  for(var i=0, n=checkboxes.length;i<n;i++) {
				checkboxes[i].checked = source.checked;
			  }
			}
        </script>
         <!--- Form about what emails to fill the recipient textbox--->       
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
        
         <!---Form holding the textareas for the email--->
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
