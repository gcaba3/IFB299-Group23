<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set variables
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$account_type = $_SESSION['ACCOUNTTYPE'];
$username = $_SESSION['USERNAME'];
$idnumber = $_SESSION['IDNUMBER'];
$event_id = $_SESSION['EVENTID'];

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
	$sql = "UPDATE event
		    SET regis_statues = '$regis_statues', Event_Name = '$event_name', Country = '$country', State = '$state',
			Postcode = '$postcode', Address = '$address', Event_Date = '$start_date', Event_Time = '$start_time'
			WHERE Event_ID = '$event_id'";
	mysqli_query($con,$sql);

	//return to planners event
	header ("Location: Event_page.php");	 
} else 
if(isset($_POST['cancel'])){
	//return to planners event
	header ("Location: Event_page.php");
}else 
//Delete the event if button is clicked
if(isset($_POST['delete'])){
	//delete the event
	$sql= "DELETE FROM event WHERE Event_ID = '$event_id'";
	mysqli_query($con,$sql);
	header ("Location: Planners_Events.php");
}

//Select the current event details
$sql2 = "SELECT * FROM event where Event_ID = '$event_id'";
$result2 = mysqli_query($con, $sql2);
$row2 = mysqli_fetch_assoc($result2);

?>
<!DOCTYPE html>
<html class="nojs html css_verticalspacer" lang="en-US">
 <head>
  <title>Edit Event</title>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
  <meta name="generator" content="2015.2.1.352"/>
  
  <script type="text/javascript">
   // Update the 'nojs'/'js' class on the html node
document.documentElement.className = document.documentElement.className.replace(/\bnojs\b/g, 'js');

// Check that all required assets are uploaded and up-to-date
if(typeof Muse == "undefined") window.Muse = {}; window.Muse.assets = {"required":["jquery-1.8.3.min.js", "museutils.js", "museconfig.js", "jquery.musemenu.js", "jquery.musepolyfill.bgsize.js", "jquery.watch.js", "require.js", "faq.css"], "outOfDate":[]};
</script>
  
  <title>FAQ</title>
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
<h2 id="u2903-2"><span class="actAsDiv normal_text" id="u2904"><!-- content --><span class="actAsDiv" id="u2905"><!-- simple frame --></span></span><span id="u2903"> Edit Event</span></h2>
     <p id="u2903-3">&nbsp;</p>
     <p id="u2903-4">&nbsp;</p>
     <p id="u2903-5">&nbsp;</p>
     <p id="content">
     
         <style>
		 
			 .bigger{margin-bottom:20px; font-size:150%}
		</style>
 <div class="FullBody">
        <form action="" method="post" id = "entryfields">
            <table width="50%" border="0" style="margin-left:35%">
              <tbody>
              <tr>
              <!---Table containing the event's current detail(s)--->
                  <td width="100" style="text-align: right"><label>Registration Statues:</label></td>
                  <td width="100" style="text-align: left"><select id="regis_statues" name="regis_statues" required>
                  <?php 
				  if($row2['regis_statues'] == 'Open'){
					  echo "<option value = 'Open'>" .  $row2['regis_statues'] . "</option>";
					  echo "<option value = 'Closed'> Closed </option>";
				  } else {
					  echo "<option value = 'Closed'>" .  $row2['regis_statues'] . "</option>";
					  echo "<option value = 'Open'> Open </option>";
				  }
				  ?>
                  </select></td>
                <tr>
                  <td width="100" style="text-align: right"><label>Event Name:</label></td>
                  <td width="100" style="text-align: left"><input value = "<?php echo $row2['Event_Name'];?>" name="event_name" type="text" required="required" id="start_time" placeholder="Enter Event Name"> </td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>Country:</label></td>
                  <td width="100" style="text-align: left"><input value = "<?php echo $row2['Country'];?>" name="country" type="text" required="required" id="country" placeholder="Enter Country"></td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>State:</label></td>
                  <td width="100" style="text-align: left"><input value = "<?php echo $row2['State'];?>" name="state" type="text" required="required" id="state" placeholder="Enter State"> </td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>Postcode:</label>
                  <label></label></td>
                  <td width="100" style="text-align: left"><input value = "<?php echo $row2['Postcode'];?>" name="postcode" type="number" required="required" id="postcode" placeholder="Enter Postcode" min="0"></td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>Address:</label></td>
                  <td width="100" style="text-align: left"><input value = "<?php echo $row2['Address'];?>" name="address" type="text" required="required" id="address" placeholder="Enter Address"> </td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>Start Date:</label></td>
                  <td width="100" style="text-align: left"><input value = "<?php echo $row2['Event_Date'];?>" name="start_date" type="date" required="required" id="start_date"placeholder="Enter Start Date"></td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>Start Time:</label></td>
                  <td width="100" style="text-align: left"> <input value = "<?php echo $row2['Event_Time'];?>"name="start_time" type="time" required="required" id="start_time" placeholder="Enter Start Time"> </td>
                </tr>
              </tbody>
            </table>
        <!---Form for the the buttons on the buttom-->
        </form>
        <form action="" method="post" id="cancel_form" style="margin-top:10px; margin-left:35%">
        <input type="submit" name="cancel" id="cancel" value="Cancel">
        <input type="submit" name="delete" id="delete" value="Delete Event" style="margin-left:20px;">
        <input type="submit" name="submit" id="submit" value="Save" style="margin-left:20px;" form="entryfields">
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
