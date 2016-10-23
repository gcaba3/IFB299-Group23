<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set variables
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$account_type = $_SESSION['ACCOUNTTYPE'];
$username = $_SESSION['USERNAME'];
$event_id = $_SESSION['EVENTID'];
$error_message = FALSE;

//checks if event id is not 0. If it is it flags the error message
if($event_id != 0){
	//Set Query
	$sql = "select * from event where Event_ID = '$event_id'";
	$result = mysqli_query($con, $sql);
	
	//store query result 
	$event = mysqli_fetch_assoc($result);
} else {
	$error_message = TRUE;
}
?>
<!DOCTYPE html>
<html class="nojs html css_verticalspacer" lang="en-US">
 <head>
  <title>Event Page</title>
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
    
     <p id="u2903-10">&nbsp;</p>
     <p id="u2903-3">&nbsp;</p>
     <p id="u2903-4">&nbsp;</p>
     <p id="u2903-5">&nbsp;</p>
     <p id="content">
     <p id="content">
     
	 <style>
        div.LeftBody p.bigger{margin-bottom:20px; font-size:150%};

        INPUT[type="submit"]
        {
            border : solid 2px #ffffff;
            border-radius : 5px;
            moz-border-radius : 3px;
            font-size : 15px;
            color : #000000;
            padding : 1px 10px;
            background-color : #bdb9bd;
        }
        
        INPUT[type="submit"]:hover
        {
            border: 1px solid #999;
            color: #000;
        }
    </style>
     
     <div class="LeftBody" style="margin-left:100px">
    
		<?php  
        //Checks if the error message is flagged. If not then it loads in the required information for the page. If it is it displayes the error message.
        if($error_message == FALSE) { ?>
        	<h1 style="font-size: 2em; margin-bottom:20px; font-weight: bold;"><?php echo $event['Event_Name']; ?></h1>
            <p class="bigger">Event ID: <?php echo $event['Event_ID']; ?></p>
            <p class="bigger">Country: <?php echo ucfirst($event['Country']); ?></p>
            <p class="bigger">State: <?php echo ucfirst($event['State']); ?></p>
            <p class="bigger">Postcode: <?php echo ucfirst($event['Postcode']); ?> </p>
            <p class="bigger">Address: <?php echo ucfirst($event['Address']); ?></p>
            <p class="bigger">Start date: <?php echo date('d-m-Y', strtotime($event['Event_Date'])); ?></p>
            <p class="bigger">Start time: <?php echo $event['Event_Time']; ?></p>
        <?php 
        //Full address to be used in the google maps api
        $full_address = $event['Address'] . ", " . $event['Postcode'] . ", " .$event['Country'];
        
        
        echo "<a href='Account.php'><span>Return to Account</span></a>";
        
        //members features - to register to event
        if ($event['regis_statues'] == 'Open' &&  $account_type == "member") {
            echo "<p> <a href='Event_Registration.php'><span>Register</span></a> </p>";
        }
        if ($account_type == "member") {
            echo "<p> <a href='stop_attending.php'><span>Stop Attending</span></a> </p> ";
        }
        } else {
        	echo "<p> You currently have no events assigned to you. Please contact one of the planners.</p>";
        
        } ?>
    </div>
    <div class="RightBody">
    <p>
    <?php if($account_type == 'planner'){?>
    <a href="Edit_Event.php" title=""><span> Edit Event</span></a>
    &nbsp;
    <a href="stop_planning.php" title=""><span> Stop Planning</span></a>
    <?php } ?>
    </p>
    <?php if($error_message == FALSE) {?>
        <iframe
        	
          width="425"
          height="300"
          frameborder="0" style="border:0; padding-top: 5px;"
          src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBj8rAAP7pg_CUMypAErvj3Eb8hjsJDsTg
            &q=<?php echo urlencode($full_address); ?>">
        </iframe>
        
    <!---Planner table under map--->
    <table style="width:100%; border:0; text-align:center;"> 
        <tr>
        <th width="150" style="text-align:center; padding-bottom: 5px;">Planner</th>
        <th width="290" style="text-align:left; padding-bottom: 5px;">Email</th>
        </tr>
        <p>
        <?php
        //set query
        $sql_eventplanners = "select * FROM event_planner where event_ID = '$event_id'";
        $ep_result = mysqli_query($con, $sql_eventplanners);
        
        
        //store each event planner, as an iteration of the while loop
        while($event_planner = mysqli_fetch_array($ep_result)){
        $planner_id = $event_planner['planner_ID'];
        
        //Select everything for that planner
        $sql_planner = "select * FROM planner where ID = '$planner_id'";
        $p_result = mysqli_query($con, $sql_planner);
        
        //Store each planner as a row for the table.
        //Then fill in the table with each row.
        $row = mysqli_fetch_array($p_result);
        echo '<tr>';
        echo '<td style="text-align:center; padding-bottom: 5px;">' . $row['FirstName'] . ' ' .$row['LastName'] . '</td>';
        echo '<td style="text-align:left; padding-bottom: 5px;">' . $row['Email'] . '</td>';
        }
        ?>
    </table> 
    <?php } ?>      
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
