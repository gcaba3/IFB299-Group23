<?php require 'Connections/connections.php'; ?>
<?php
session_start();
$account_type = $_SESSION['ACCOUNTTYPE'];
//Returns the total of all the members donations for one specific event
function total_members_donation($event_ID){
	global $con;
	// Set query - select the sum of all donations to one event
	$sql_members_donation = "select SUM(Amount) AS members_donations FROM members_donation where Event_ID = '$event_ID'";
	$md_result = mysqli_query($con, $sql_members_donation);
	$row = mysqli_fetch_assoc($md_result);
	$members_donations = $row['members_donations'];
	return $members_donations;
}

//Returns the total of all the sponsors donations for one specific event
function total_sponsors_donation($event_ID){
	global $con;
	// Set query - select the sum of all donations to one event
	$sql_sponsors_donation = "select SUM(amount) AS sponsors_donations FROM sponsors_donation where Event_ID = '$event_ID'";
	$sd_result = mysqli_query($con, $sql_sponsors_donation);
	$row = mysqli_fetch_assoc($sd_result);
	$sponsors_donations = $row['sponsors_donations'];
	return $sponsors_donations;
}

//Adds the total of sponsors and members donations
function calc_total_donations($event_ID){
	$members_donation = total_members_donation($event_ID);
	$sponsors_donation = total_sponsors_donation($event_ID);
	$total_donation = $members_donation + $sponsors_donation;
	return $total_donation;
}

//Calculates the rough cost, then returns the calculated value
function calc_rough_cost($event_ID){
	global $con;
	// Set query - select the sum of all the tickets reserved for one event
	$sql_total_tickets = "select SUM(Reserved_tickets) AS total_tickets FROM attending_events where Event_ID = '$event_ID'";
	$tt_result = mysqli_query($con, $sql_total_tickets);
	$row = mysqli_fetch_assoc($tt_result);
	$total_tickets = $row['total_tickets'];
	
	//calculate rough cost
	$cost_of_ticket = 20;
	$rough_cost = $cost_of_ticket * $total_tickets;
	
	return $rough_cost;
}

//calculates the final cost by taking away the total donation from the rough cost. Then returns the final cost value
function calc_final_cost($rough_cost, $total_donations){
	$final_cost = $rough_cost - $total_donations;
	return $final_cost;
}

//Returns the number of members attending one event
function total_members_attending($event_ID){
	global $con;
	
	// Set query - select the registration statues of the event
	$sql = "select * FROM attending_events WHERE Event_ID = '$event_ID'";
	$result = mysqli_query($con, $sql);
	$total_members_attending = mysqli_num_rows($result);
	return $total_members_attending;
}

//returns the number of members that donated to one event
function num_members_that_donated($event_ID){
	global $con;
	
	// Set query - select the registration statues of the event
	$sql = "select * FROM members_donation WHERE Event_ID = '$event_ID' GROUP BY member_ID";
	$result = mysqli_query($con, $sql);
	$members_that_donated = mysqli_num_rows($result);
	return $members_that_donated;
}

//Returns the registration statues of one event
function registration_statues($event_ID){
	global $con;
	
	// Set query - select the registration statues of the event
	$sql = "select regis_statues FROM event WHERE Event_ID = '$event_ID'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	$registration = $row['regis_statues'];
	
	return $registration;
}

//Returns the value of the ticket cost for the members that didnt donate
function calc_ticket_cost($final_cost, $total_members_attending, $members_that_donated){
	global $con;
	
	$members_that_didnt_donate = $total_members_attending - $members_that_donated;
	
	//Checks if the calculated value is 0 or negative or an error would pop up.
	if ($members_that_didnt_donate <= 0 ){
		$ticket_price = 0;
	} else {
		//Final calculation for the ticket price
		$ticket_price = $final_cost / $members_that_didnt_donate;
	}

	return $ticket_price;
}

//Updates the finances table
function update_table($event_id, $rough_cost, $total_donation, $final_cost, $total_members, $total_members_donated, $ticket_price){
	global $con;
	$total_tickets = $rough_cost / 20;
	
	//SQL - checks if an event id exists in the table
	$sql = "select * FROM finances where Event_ID = '$event_id'";
	$result = mysqli_query($con, $sql);
	$num_rows = mysqli_num_rows($result); // stores the number of results from query
	
	//Checks if the query returned any results.
	//If there are any results it updates that row on the table. OR else it makes a new row
	if($num_rows > 0){
		$sql2 = "UPDATE finances 
		SET Total_tickets = '$total_tickets' , Rough_cost = '$rough_cost', Total_donation = '$total_donation', 
			Final_cost = '$final_cost', Total_members = '$total_members', Total_members_that_donated = '$total_members_donated',
			Ticket_cost = '$ticket_price'
		WHERE Event_ID = '$event_id'";
		mysqli_query($con, $sql2);
		} else {
			$sql2 = 
			"INSERT INTO finances (Event_ID, Total_tickets, Rough_cost, Total_donation, Final_cost,Total_members, Total_members_that_donated, Ticket_cost)
				VALUES ('$event_id', '$total_tickets' ,'$rough_cost', '$total_donation', '$final_cost', '$total_members', '$total_members_donated', '$ticket_price')";
		mysqli_query($con, $sql2);
		}
	
}
 //Deletes the row if the registration statues has been changed
function delete_event($event_ID){
	global $con;
	$sql = "DELETE FROM finances WHERE Event_ID = '$event_ID'";
	mysqli_query($con, $sql);
}
?>
<!DOCTYPE html>
<html class="nojs html css_verticalspacer" lang="en-US">
 <head>
  <title>Finances</title>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
  <meta name="generator" content="2015.2.1.352"/>
  
  <script type="text/javascript">
   // Update the 'nojs'/'js' class on the html node
document.documentElement.className = document.documentElement.className.replace(/\bnojs\b/g, 'js');

// Check that all required assets are uploaded and up-to-date
if(typeof Muse == "undefined") window.Muse = {}; window.Muse.assets = {"required":["jquery-1.8.3.min.js", "museutils.js", "museconfig.js", "jquery.musemenu.js", "jquery.musepolyfill.bgsize.js", "jquery.watch.js", "require.js", "faq.css"], "outOfDate":[]};
</script>
  
  <title>Planners Events</title>
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

     <h2 id="u2903-2"><span class="actAsDiv normal_text" id="u2904"><!-- content --><span class="actAsDiv" id="u2905"><!-- simple frame --></span></span><span id="u2903">Finances</span></h2>
     <p id="u2903-3">&nbsp;</p>
     <p id="u2903-4">&nbsp;</p>
     <p id="u2903-5">&nbsp;</p>
     <p id="content">
     <style>
	 td,th{
		 text-align:center;
		 
	 }
	 </style>
<div class="FullBody" style="margin-left:10px; margin-right:auto;">
       <table style="width:100%" border="0"> 
        <tr>
        <th width="150">Event ID</th>
        <th width="150">Registration</th>
        <th width="290">Rough Cost</th>
        <th width="290">Donations</th>
        <th width="290">Final Cost</th>
        <th width="290">Total Members Attending</th>
        <th width="290">Members That Donated</th>
        <th width="290">Ticket Price</th>
        </tr>
        <?php
		//SQL - Select all the events
		$sql = 'Select * FROM event ORDER BY regis_statues ASC';
		$result = mysqli_query($con, $sql);
		
		//cycle through all the events.
		//With each event stored as while iteration
		while ($row = mysqli_fetch_array($result)){
			$event_ID = $row['Event_ID'];
			$registration = registration_statues($event_ID);
			
			echo "<tr>";
			echo '<td style="text-align:center;">' . $event_ID . '</td>';
			echo '<td style="text-align:center;">' . $registration . '</td>';
			
			//Checks if the registration is closed.
			//If it is then it shows the calculations
			//If it is open then it doesnt show the calculations. As all tickets haven been reserved.
			if($registration == 'Closed'){
				$rough_cost = calc_rough_cost($event_ID);
				$total_donations =  calc_total_donations($event_ID);
				
				if(is_null($total_donations)){
					$total_donations =  0;
				}
				$final_cost = calc_final_cost($rough_cost,$total_donations);
				$total_members_attending = total_members_attending($event_ID);
				$members_that_donated = num_members_that_donated($event_ID);
				$ticket_price = calc_ticket_cost($final_cost, $total_members_attending, $members_that_donated);
				
				//Fill the rest of the table with the proper values
				echo '<td style="text-align:center;">' . '$'.$rough_cost . '</td>';
				echo '<td style="text-align:center;">' . '$'.$total_donations . '</td>';
				echo '<td style="text-align:center;">' . '$'.$final_cost . '</td>';
				echo '<td style="text-align:center;">' . $total_members_attending . '</td>';
				echo '<td style="text-align:center;">' . $members_that_donated . '</td>';
				if ($ticket_price <= 0){
					echo '<td style="text-align:center;">' . 'Free' . '</td>';
				} else {
					echo '<td style="text-align:center;">' . '$' . round($ticket_price,2) . '</td>';
				}
				echo "</tr>";
				
				update_table($event_ID, $rough_cost, $total_donations, $final_cost, $total_members_attending, $members_that_donated, $ticket_price);
			} else {
				// if the registration of the statues has been changed then it deletes that row from the finances table.
				delete_event($event_ID);
				echo "</tr>";
			}
		}
		?>
        </table>
        <p style="text-align:center; margin-top:20px">
        Note: Ticket price is only for the members that didnt donate to the event. 
        </p>
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
