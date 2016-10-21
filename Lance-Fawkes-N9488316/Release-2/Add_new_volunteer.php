<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set variables
$account_type = $_SESSION['ACCOUNTTYPE'];
$senders_email = $_SESSION['EMAIL'];

$email_exists = $account_created = $sent_email = FALSE;

$v_password =  $v_username = "";

/*
check if email already exists in the database.
if there is flag the error message.
*/
function check_email($email){
	global $email_exists;
	global $con;
	
	$sql = "select * from volunteer where Email = '$email'";
	$result = mysqli_query($con, $sql);
	$numrows = mysqli_num_rows($result);
	
	if($numrows > 0){
		$email_exists = TRUE;	
	}
}

//Make the volunteer account
function generate_account(){
	global $con;
	global $account_created;
	global $v_username;
	global $v_password;
	
	//Creates randomized password and username. Which is sent to the volunteer.
	$v_password = uniqid('PW-');
	$v_username = uniqid('UN-');
	
	$sql = "INSERT INTO account (Account_type, username, password)
			VALUES ('volunteer','$v_username', '$v_password')";
	mysqli_query($con, $sql);
	
	$account_created = TRUE;
	
}

//Make the message to send to volunteer
function generate_message($username, $password){
	$message = 
	"
	Dear new volunteer,
				
	Here are your account credentials: 
	
	Username: $username
	Password: $password
				
	To finish your account. Login with these credentials. 
	
	If you have anymore questions reply to this email or contact one of the other planners.
	";
				
	return $message;
}

//send email to volunteer
function send_email($email, $message){
	global $senders_email; 
	global $sent_email;
	
	$recipient_email = $email;
	$subject = 'Event Organisation: Your account has been setup.'; 
	$message = $message;
	$header = "From: " . $senders_email . "\r\n"; // uses the currently logged in email of the planner
	
	//send the email
	mail($recipient_email,$subject,$message ,$header);
	
	$sent_email = TRUE;
}

if(isset($_POST['submit'])){
	$volunteer_email = $_POST['volunteeremail'];
	$_SESSION['v_accountnumber'] = $volunteer_email ;
	check_email($volunteer_email);
	if ($email_exists == FALSE) {
		generate_account();
		$message = generate_message($v_username, $v_password);
		send_email ($volunteer_email, $message);
	}
}

?>
<!DOCTYPE html>
<html class="nojs html css_verticalspacer" lang="en-US">
 <head>
  <title>Add new volunteer</title>
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
<h2 id="u2903-2"><span class="actAsDiv normal_text" id="u2904"><!-- content --><span class="actAsDiv" id="u2905"><!-- simple frame --></span></span><span id="u2903"> Add new volunteer </span></h2>
     <p id="u2903-3">&nbsp;</p>
     <p id="u2903-4">&nbsp;</p>
     <p id="u2903-5">&nbsp;</p>
     <p id="content">
     
         <style>
		 
			 .bigger{margin-bottom:20px; font-size:150%}
		</style>
 <div class="FullBody" style="text-align:center">
        <p>
        <?php
		if($email_exists == TRUE){
			echo ' <p class="larger" style="margin:10px"> Email address is already being used by another volunteer. </p>';	
		}
		
		if($account_created == TRUE){
			echo ' <p class="larger" style="margin:10px"> Account has been created. </p>';	
		}
		
		if($sent_email == TRUE){
			echo '<p class="larger" style="margin:10px" > The account details has been sent to:' . $volunteer_email .'</p>';
			echo '<p class="larger" style="margin:10px"> You cant assign this volunteer to events until he or she finishes her account registration</p>';		
		}
		
		?>
        </p>
        <form action="" method="post">
          <p class="larger">
          <label>Enter Volunteer's Email:</label> <br>
          <input style="margin:10px" name="volunteeremail" type="email" required="required" id="volunteeremail" placeholder="Enter email here">
          </p>
          <p> <input type="submit" id="submit" name="submit" value="Confirm"> </p>
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
