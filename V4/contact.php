<?php require 'Login/Connections/connections.php'; ?>
<?php
?>
<!DOCTYPE html>
<html class="nojs html css_verticalspacer" lang="en-US">
 <head>
  <title>Account</title>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
  <meta name="generator" content="2015.2.1.352"/>
  
  <script type="text/javascript">
   // Update the 'nojs'/'js' class on the html node
document.documentElement.className = document.documentElement.className.replace(/\bnojs\b/g, 'js');

// Check that all required assets are uploaded and up-to-date
if(typeof Muse == "undefined") window.Muse = {}; window.Muse.assets = {"required":["jquery-1.8.3.min.js", "museutils.js", "museconfig.js", "jquery.musemenu.js", "jquery.musepolyfill.bgsize.js", "jquery.watch.js", "require.js", "faq.css"], "outOfDate":[]};
</script>
  
  <title>Contact us</title>
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/site_global.css?crc=241806178"/>
  <link rel="stylesheet" type="text/css" href="css/master_a-master.css?crc=4160090698"/>
  <link rel="stylesheet" type="text/css" href="css/faq.css?crc=4268844657" id="pagesheet"/>
  
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
       <img class="block" id="u113_img" src="images/logo.png?crc=4180727026" alt="" width="191" height="140"/>
      </div>
     </div>
    <?php
echo '<nav class="MenuBar clearfix grpelem" id="menuu1244"><!-- horizontal box -->';
$servername = "localhost";
$username = "root";
$password = "qwe";
$dbname = "thedatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT  `PageName` ,  `Location` ,  `ParentID` 
FROM SiteMap
WHERE  `ParentID` <= 0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo'<div class="MenuItemContainer clearfix grpelem" id=""><!-- vertical box --> <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u1248" href="';
        echo  $row["Location"];
		echo '"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u1249-4"><!-- content --> <p><span id="u1249">';
		echo $row["PageName"];
		echo '</span></p> </div></a> </div>';
		
    }
} else {
    echo "0 results";
}
$conn->close();
echo "</nav> </div>";

?>

    </div>
    <div class="clearfix colelem" id="u2903-34"><!-- content -->

     <h2 id="u2903-2"><span class="actAsDiv normal_text" id="u2904"><!-- content --><span class="actAsDiv" id="u2905"><!-- simple frame --></span></span><span id="u2903">Contact us</span></h2>
     <p id="u2903-3">&nbsp;</p>
     <p id="u2903-4">&nbsp;</p>
     <p id="u2903-5">&nbsp;</p>
     <p id="content">
     
         <style>
			div.LeftBody p{margin-bottom:10px; font-size:large};
		</style>
        <div class="FullBody" style="margin-left:60px">    
           <p>To get in contact with the community organization you can either get in contact with our main office: <br> <br></p>
           <p>
           QUT University, <br>
           Gardern's Point Campus,<br>
           S Block (S603) <br>
           2 George St, <br>
           Brisbane City QLD 4000. <br>
           
           Phone number:  (07) 3138 2000 
           
           </p>
           <p>
           <br>or email one of our planners: <br>
           <table style="width:100%; margin-top:10px" border="0"> 
        <tr>
        <th style="text-align:center;" width="150">Planner ID</th>
        <th style="text-align:center;" width="290">Name</th>
        <th style="text-align:center;" width="290">Email</th>
        <th style="text-align:center;" width="290">Phone number</th>
        </tr>
        
        <?php
		//set query - select everything from plannerr table
		$sql_planner = "select * FROM planner";
		$v_result = mysqli_query($con, $sql_planner);
		
		//Select everything from the planner table. Then fill html table as necessary
		while($planner = mysqli_fetch_array($v_result)){
			echo "<tr>";
			echo '<td style="text-align:center;">' . $planner['ID'] . '</td>';
			echo '<td style="text-align:center;">' . $planner['FirstName'] . ' ' . $planner['LastName'] . '</td>';
			echo '<td style="text-align:center;">' . $planner['Email'] . '</td>';
			echo '<td style="text-align:center;">' . $planner['PhoneNumber'] . '</td>';
		}
		?>
        </table>

           
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
