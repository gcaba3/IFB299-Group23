<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set variables
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$account_type = $_SESSION['ACCOUNTTYPE'];
$username = $_SESSION['USERNAME'];
$Updated = FALSE;

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

//check if save button is set
if(isset($_POST['save'])){
	// Set query - to select all the volunteers from the volunteers table
	$sql_volunteer = "select * FROM volunteer";
	$v_result = mysqli_query($con, $sql_volunteer);
	$total_rows = mysqli_num_rows($v_result); // total number of volunteers
	
	//Cycle through all the volunteers. Use each for-iteration as the volunteer's id.
	for($int = 1; $int <= $total_rows; $int++){
		$volunteer_ID = $int;
		$event_ID = $_POST[$int];
		
		//Checks if the event to that volunteers event entry is set (0). if it is update the event column as null
		// if not then update the event column as the selected data from the list.
		if($event_ID == 0){
			$event_ID = NULL;
			$sql_assign_event = "UPDATE volunteer SET Event_ID = NULL WHERE ID = '$volunteer_ID'";
			mysqli_query($con, $sql_assign_event);
		} else {
			$sql_assign_event = "UPDATE volunteer SET Event_ID = '$event_ID' WHERE ID = '$volunteer_ID'";
			mysqli_query($con, $sql_assign_event);
		}
	}
	$Updated = TRUE;
} elseif(isset($_POST['add_new'])){
	//Open new register new volunteer page
	header('Location: Add_new_volunteer.php');
}
?>

<!DOCTYPE html>
<html class="nojs html css_verticalspacer" lang="en-US">
 <head>
  <title>Volunteers List</title>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
  <meta name="generator" content="2015.2.1.352"/>
  
  <script type="text/javascript">
   // Update the 'nojs'/'js' class on the html node
document.documentElement.className = document.documentElement.className.replace(/\bnojs\b/g, 'js');

// Check that all required assets are uploaded and up-to-date
if(typeof Muse == "undefined") window.Muse = {}; window.Muse.assets = {"required":["jquery-1.8.3.min.js", "museutils.js", "museconfig.js", "jquery.musemenu.js", "jquery.musepolyfill.bgsize.js", "jquery.watch.js", "require.js", "faq.css"], "outOfDate":[]};
</script>
  
  <title>Sponsors List</title>
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

     <h2 id="u2903-2"><span class="actAsDiv normal_text" id="u2904"><!-- content --><span class="actAsDiv" id="u2905"><!-- simple frame --></span></span><span id="u2903">Volunteers List</span></h2>
     <p id="u2903-3">&nbsp;</p>
     <p id="u2903-4">&nbsp;</p>
     <p id="u2903-5">&nbsp;</p>
     <p id="content">
     <style>
	 </style>
<div class="FullBody">
            <div style="text-align:center">
                <?php
                if($Updated == TRUE){
                    echo "Successfully Updated";
                }
                ?>
            </div>
            
        <table style="width:100%" border="0"> 
        <tr>
        <th width="150">ID</th>
        <th width="290">Name</th>
        <th width="290">Event</th>
        <th width="290">Phone number</th>
        <th width="290">Email</th>
        </tr>
        
        <?php
		//set query - select everything from volunteer table
		$sql_volunteer = "select * FROM volunteer";
		$v_result = mysqli_query($con, $sql_volunteer);
		
		//Select everything from the volunteers table. Then fill html table as necessary
		while($volunteer = mysqli_fetch_array($v_result)){
			echo "<tr>";
			echo '<td style="text-align:center;">' . $volunteer['ID'] . '</td>';
			echo '<td style="text-align:center;">' . $volunteer['FirstName'] . ' ' . $volunteer['LastName'] . '</td>';
			?>
            
             <!--A drop down box with the all the available events loaded as options. 
             Set the selects name as the volunteers id-->
			<td style="text-align:center;">
            <select name=<?php echo $volunteer['ID'] ?> form="assign_event">
            
            <?php
			//sql query to return all open events
			$sql_open_events = "SELECT * from event where regis_statues = 'Open'";
			$result_oe = mysqli_query($con,$sql_open_events);
			
			/*
			checks if the current volunteer is assigned an event.
			If it is it sets that event as the first option. Then load all the other open events after.
			If its not then load the first option as none. Then load all the other open events after.
			*/
            if(isset($volunteer['Event_ID'])){
				echo "<option value=".$volunteer['Event_ID'].">". event_name($volunteer['Event_ID'])."</option>";
				while($event = mysqli_fetch_array($result_oe)){
					if ($volunteer['Event_ID'] != $event['Event_ID']){
						echo "<option value=".$event['Event_ID'].">". event_name($event['Event_ID'])."</option>";
					}
				}
				echo "<option value=".'0'.">". 'None' ."</option>";
			} else {
				echo "<option value=".'0'.">". 'None' ."</option>";
				while($event = mysqli_fetch_array($result_oe)){
					echo "<option value=".$event['Event_ID'].">". event_name($event['Event_ID'])."</option>";
				}
			}
				
			?>
            </select>
            </td>
			<?php
			
			echo '<td style="text-align:center;">' . $volunteer['PhoneNumber'] . '</td>';
			echo '<td style="text-align:center;">' . $volunteer['Email'] . '</td>';
		}
		?>
        </table>
   		<div style="text-align:center">
            <!--The form to submit the input from the page-->
            <form action = "" method= "post" id="assign_event">
                <input type="submit" value = "Save" name="save" id="save" style="margin-top:10px; margin-left:50px;">
                &nbsp
                <input type="submit" name="add_new" id="add_new" value="Add new">
            </form>
        </div>
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
