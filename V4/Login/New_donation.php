<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set variables
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$idnumber = $_SESSION['IDNUMBER'];
$account_type = $_SESSION['ACCOUNTTYPE'];

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
<!DOCTYPE html>
<html class="nojs html css_verticalspacer" lang="en-US">
 <head>
  <title>Member's New Donation</title>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
  <meta name="generator" content="2015.2.1.352"/>
  
  <script type="text/javascript">
   // Update the 'nojs'/'js' class on the html node
document.documentElement.className = document.documentElement.className.replace(/\bnojs\b/g, 'js');

// Check that all required assets are uploaded and up-to-date
if(typeof Muse == "undefined") window.Muse = {}; window.Muse.assets = {"required":["jquery-1.8.3.min.js", "museutils.js", "museconfig.js", "jquery.musemenu.js", "jquery.musepolyfill.bgsize.js", "jquery.watch.js", "require.js", "faq.css"], "outOfDate":[]};
</script>
  
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
<h2 id="u2903-2"><span class="actAsDiv normal_text" id="u2904"><!-- content --><span class="actAsDiv" id="u2905"><!-- simple frame --></span></span><span id="u2903"> Add New Donation</span></h2>
     <p id="u2903-3">&nbsp;</p>
     <p id="u2903-4">&nbsp;</p>
     <p id="u2903-5">&nbsp;</p>
     <p id="content">
     
         <style>
		 
			 .bigger{margin-bottom:20px; font-size:150%}
		</style>
 <div class="FullBody" style="text-align:center;">
        <p class="larger">Which one of your events do you want to donate to?</p>
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
			
			//A bunch of code that checks which message(s) to output.
			if($error_message == TRUE){
				echo '<p class="larger">';
				echo 'Because you reserved: ' . $reserved_tickets . ' tickets to ' . event_name($chosen_event);
				echo '</p>';
				echo '<p>';
				echo 'Your minimun donation amount needs to be: $' . $min_donation;
				echo '</p>';
			}
			
			if($initial == TRUE){
				echo '<p class="larger">How much do you want to contribute? </p>';
			}
			
			if($no_donations_made == TRUE){
					echo '<p class="larger">';
					echo 'You have not made any donations to this event';
					echo '</p>';
			}
			
			if($show_donation == TRUE && $made_new_donation == FALSE){
					echo '<p class="larger">';
					echo 'Your donations for this event is: $' . $current_total_donations_made;
					echo '</p>';
			}
			
			if($made_new_donation == TRUE){
					echo '<p class="larger">';
					echo 'Your donations for this event was: $' . $current_total_donations_made;
					echo '</p>';
					
					echo '<p class="larger">' ;
					echo 'After your new $'. $new_donation_amount .' donation. Your new total is: $' . $new_total_donations_made;
					echo '</p>';
			} 
			?>
            <p class="larger"><input type="number" placeholder="Enter Value here" min="0" name="amount" id="amount"></p>
            <input  class="larger"type="submit" name="confirm" id="confirm" value="Confirm">
        </form>
        
        <p class="larger">Note: Leave blank to see your current donations for that event. </p>
          
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
