<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set variables
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$account_type = $_SESSION['ACCOUNTTYPE'];
$username = $_SESSION['USERNAME'];
$idnumber = $_SESSION['IDNUMBER'];

if(isset($_POST['submit'])){
	//set the local variables from the form inputs
	$regis_statues = $_POST['regis_statues'];
	$event_name = $_POST['event_name'];
	$country = $_POST['country'];
	$state = $_POST['state'];
	$postcode = $_POST['postcode'];
	$address = $_POST['address'];
	$start_date = $_POST['start_date'];
	$start_time = $_POST['start_time'];
	
	//insert inputs into the database
	$sql = "INSERT INTO event(regis_statues, Event_Name, Country, State, Postcode, Address, Event_Date, Event_Time)
			VALUES ('$regis_statues','$event_name','$country','$state','$postcode','$address','$start_date','$start_time')";
	mysqli_query($con,$sql);
	
	//get the newest create event id
	$sql2 = "SELECT * FROM event 
			ORDER BY Event_ID DESC
			LIMIT 1";
	$result = mysqli_query($con, $sql2);
	$row = mysqli_fetch_assoc($result);
	$newest_eventID = $row['Event_ID'];
	
	//assign the current planner to the newest event id
	$sql3 = "INSERT INTO event_planner(planner_ID, event_ID)
			 VALUES ($idnumber, $newest_eventID)";
	mysqli_query($con,$sql3);
	
	//return to planners event
	header ("Location: Planners_Events.php");	 
} else 
if(isset($_POST['cancel'])){
	//return to planners event
	header ("Location: Planners_Events.php");
}
?>
<!DOCTYPE html>
<html class="nojs html css_verticalspacer" lang="en-US">
 <head>
  <title>Create Event</title>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
  <meta name="generator" content="2015.2.1.352"/>
  
  <script type="text/javascript">
   // Update the 'nojs'/'js' class on the html node
document.documentElement.className = document.documentElement.className.replace(/\bnojs\b/g, 'js');

// Check that all required assets are uploaded and up-to-date
if(typeof Muse == "undefined") window.Muse = {}; window.Muse.assets = {"required":["jquery-1.8.3.min.js", "museutils.js", "museconfig.js", "jquery.musemenu.js", "jquery.musepolyfill.bgsize.js", "jquery.watch.js", "require.js", "faq.css"], "outOfDate":[]};
</script>
  
  <title>Plan More Events</title>
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

     <h2 id="u2903-2"><span class="actAsDiv normal_text" id="u2904"><!-- content --><span class="actAsDiv" id="u2905"><!-- simple frame --></span></span><span id="u2903">Enter Event Details Below</span></h2>
     <p id="u2903-3">&nbsp;</p>
     <p id="u2903-4">&nbsp;</p>
     <p id="u2903-5">&nbsp;</p>
     <p id="content">
     
         <style>
		</style>
        <div class="FullBody" style="text-align:center; padding-left:25px">
  <form action="" method="post" id = "entryfields">
            <table width="50%" border="0" style="margin-left:30%">
              <tbody>
              <tr>
                  <td width="100" style="text-align: right"><label>Registration Statues:</label></td>
                  <td width="100" style="text-align: left"><select id="regis_statues" name="regis_statues" required>
                  <option value = "Open"> Open </option>
                  <option value = "Closed"> Closed </option>
                  </select></td>
                <tr>
                  <td width="100" style="text-align: right"><label>Event Name:</label></td>
                  <td width="100" style="text-align: left"><input name="event_name" type="text" required="required" id="start_time" placeholder="Enter Event Name"> </td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>Country:</label></td>
                  <td width="100" style="text-align: left"><input name="country" type="text" required="required" id="country" placeholder="Enter Country"></td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>State:</label></td>
                  <td width="100" style="text-align: left"><input name="state" type="text" required="required" id="state" placeholder="Enter State"> </td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>Postcode:</label>
                  <label></label></td>
                  <td width="100" style="text-align: left"><input  name="postcode" type="number" required="required" id="postcode" placeholder="Enter Postcode" min="0"></td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>Address:</label></td>
                  <td width="100" style="text-align: left"><input name="address" type="text" required="required" id="address" placeholder="Enter Address"> </td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>Start Date:</label></td>
                  <td width="100" style="text-align: left"><input name="start_date" type="date" required="required" id="start_date"placeholder="Enter Start Date"></td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>Start Time:</label></td>
                  <td width="100" style="text-align: left"> <input name="start_time" type="time" required="required" id="start_time" placeholder="Enter Start Time"> </td>
                </tr>
              </tbody>
            </table>
        </form>
        <form action="" method="post" id="cancel_form" style="margin-top:10px; margin-right:6%">
        <input type="submit" name="cancel" id="cancel" value="Cancel">
        <input type="submit" name="submit" id="submit" value="Create" form="entryfields">
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
