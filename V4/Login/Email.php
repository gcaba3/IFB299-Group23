<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//set session variables
$senders_email = $_SESSION['EMAIL'];
$account_type = $_SESSION['ACCOUNTTYPE'];

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
	// if it is it pulls only the volunteers emails assigned to that event
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
	//if it is about a specific event then only planners involved in that event is pulled
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
	//if it is flag the error.
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
<!DOCTYPE html>
<html class="nojs html css_verticalspacer" lang="en-US">
 <head>
  <title>Email</title>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
  <meta name="generator" content="2015.2.1.352"/>
  
  <script type="text/javascript">
   // Update the 'nojs'/'js' class on the html node
document.documentElement.className = document.documentElement.className.replace(/\bnojs\b/g, 'js');

// Check that all required assets are uploaded and up-to-date
if(typeof Muse == "undefined") window.Muse = {}; window.Muse.assets = {"required":["jquery-1.8.3.min.js", "museutils.js", "museconfig.js", "jquery.musemenu.js", "jquery.musepolyfill.bgsize.js", "jquery.watch.js", "require.js", "faq.css"], "outOfDate":[]};
</script>
  
  <title>Email </title>
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="../css/site_global.css?crc=241806178"/>
  <link rel="stylesheet" type="text/css" href="../css/master_a-master.css?crc=4160090698"/>
  <link rel="stylesheet" type="text/css" href="../css/faq.css?crc=4268844657" id="pagesheet"/>
  <link href="css/mystylings.css" rel="stylesheet" type="text/css" />
  
  <!-- JS includes -->
  <!--[if lt IE 9]>
  <script src="scripts/html5shiv.js?crc=4241844378" type="text/javascript"></script>
  <![endif]-->
  <script type="text/javascript">
   document.write('\x3Cscript src="' + (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//use.typekit.net/ik/7FWqgdrq1p7sDAxGUlKGxgVIWqvwQbtzeaaen5Q2jCtfeTjffOdoFUJ15QIhFRjkWDiRw2JaFhsRF2qXjDjhF2SDw2FqjQIX5QFRFQwXwQi8eTCgHKo8jDJlFQJlF2wlwRboOQJUFPouSkuaZWFXOQJ0jhNlSYmXZPoydABEdhoyiaw0jhNlOemRwKXuwKXXwkXkF2qlwRIuO1mDOWi8SablwKoRdhu3iWs8OcBljWTzdcBaSkoRdhXCiaiaOcmRwKXuwKXXwkXkF2qlwRIuO1mDOWi8SablwKoRdhu3iWs8OcBljWTzdcBaSkoRdhXKfAukSku8jWZ8SkJFdWJlZABhZWwlShB0SkGHfwWpMsMMeMS6MKGHfJOpMsMgeMS6MKGHfJYpMsMgeMb6MqGIQWmDZZMgkFpm3M9.js" type="text/javascript">\x3C/script>');
</script>
  <!-- Other scripts -->
  <script type="text/javascript">
   try {Typekit.load();} catch(e) {}
</script>
   </head>
 <body class="museBGSize">

  <!--HTML Widget code-->
  
<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
  <div class="shadow rounded-corners clearfix" id="page"><!-- column -->
   <div class="position_content" id="page_position_content">
    <div class="clearfix colelem" id="u107"><!-- group -->
     <div class="clearfix grpelem" id="u110"><!-- group -->
      <div class="clip_frame grpelem" id="u113"><!-- image -->
       <img class="block" id="u113_img" src="../images/logo.png?crc=4180727026" alt="" width="191" height="140"/>
      </div>
     </div>
     <?php
echo '<nav class="MenuBar clearfix grpelem" id="menuu1244"><!-- horizontal box -->';
$sql1 = "";
if($account_type == 'planner'){
	$sql1 = "SELECT  `PageName` ,  `Location` ,  `ParentID` 
			FROM SiteMap
			WHERE  `ParentID` = 1 OR `ParentID` = 2";
} else 
if($account_type == 'volunteer'){
	$sql1 = "SELECT  `PageName` ,  `Location` ,  `ParentID` 
			FROM SiteMap
			WHERE  `ParentID` = 1 OR `ParentID` = 3";
} else 
if($account_type == 'member'){
	$sql1 = "SELECT  `PageName` ,  `Location` ,  `ParentID` 
			FROM SiteMap
			WHERE  `ParentID` = 1 OR `ParentID` = 5";
}
$result1 = mysqli_query($con,$sql1);
$numrows1 = mysqli_num_rows($result1);

if ($numrows1 > 0) {
    // output data of each row
    while($row1 = mysqli_fetch_array($result1)) {
		echo'<div class="MenuItemContainer clearfix grpelem" id=""><!-- vertical box --> <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u1248" href="';
        echo  $row1["Location"];
		echo '"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u1249-4"><!-- content --> <p><span id="u1249">';
		echo str_replace(' ', '<br>', $row1['PageName']);
		echo '</span></p> </div></a> </div>';
		
    }
} else {
    echo "0 results";
}
echo "</nav> </div>";

?>
    </div>
    <div class="clearfix colelem" id="u2903-34"><!-- content -->

     <h2 id="u2903-2"><span class="actAsDiv normal_text" id="u2904"><!-- content --><span class="actAsDiv" id="u2905"><!-- simple frame --></span></span><span id="u2903">Email</span></h2>
     <p id="u2903-3">&nbsp;</p>
     <p id="u2903-4">&nbsp;</p>
     <p id="u2903-5">&nbsp;</p>
     <p id="content">
     <style>
	 </style>
	 <div class="FullBody" style="margin:20px">
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
            <input type="text" placeholder="Enter ID number" name="eventID" style="margin-bottom:10px;"> 
			<?php if($error_event == TRUE) { echo "Event doesn't exists";} ?>
            </p>
            <input type="checkbox" name="group[]" value="volunteers">Volunteers
            <input type="checkbox" name="group[]" value="members">Members
            <input type="checkbox" name="group[]" value="planners">Planners
            <input type="checkbox" onClick="toggle(this)">All<br>
            <input type="submit" name="fill" id="fill" value="Fill" style="margin-top:10px;">
        </form>
        
         <!---Form holding the textareas for the email--->
        <form action="" method="post" style="text-align:center;">
            <textarea name = "recipient" style=" height: 50px; margin-bottom:5px;  width:80%;" placeholder="Enter the recipients email(s)"><?php if($error_recipient){echo "Please fill in the receipient address"; }else{ echo rtrim($email_address, ", ");} ?></textarea>
            <textarea name = "subject" style="margin-bottom:5px;  width:80%; height:20px;" placeholder="Enter Subject"></textarea>
            <textarea name = "message" style="display:block; margin-left:auto; margin-right:auto; margin-bottom:10px; width:80%; height:250px;" placeholder="Enter message"></textarea>
            <input type="submit" name="send" id="send" value = "Send">
        </form>
        </div>
     </p> <!---End of Content--->
     
    </div>
    <div class="verticalspacer" data-offset-top="846" data-content-above-spacer="926" data-content-below-spacer="125"></div>
    <div class="colelem" id="u126"><!-- simple frame --></div>
    <div class="clearfix colelem" id="pu2664-3"><!-- group -->
     <div class="clearfix grpelem" id="u2664-3"><!-- content -->
      <p>&nbsp;</p>
     </div>
     <div class="clearfix grpelem" id="u135-6"><!-- content -->
      <p>Community Organisation Website ©<br/>&nbsp;Created in 2016 for IAB299</p>
     </div>
     <div class="size_fixed grpelem" id="u1429"><!-- custom html -->
      
<a href="https://twitter.com/Org_Community" class="twitter-follow-button" data-lang="en" data-show-screen-name="true" data-size="medium"></a>

     </div>
     <div class="size_fixed grpelem" id="u2894"><!-- custom html -->
      
<div class="fb-follow" data-href="https://www.facebook.com/CommunityOrganisation" data-width="281" data-height="32" data-show-faces="false" data-colorscheme="light" data-layout="standard" data-action="follow"></div>

     </div>
    </div>
   </div>
  </div>
  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
   </body>
</html>
