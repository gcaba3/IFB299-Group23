<!DOCTYPE html>
<html class="nojs html css_verticalspacer" lang="en-US">
 <head>

  <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
  <meta name="generator" content="2015.2.1.352"/>
  
  <script type="text/javascript">
   // Update the 'nojs'/'js' class on the html node
document.documentElement.className = document.documentElement.className.replace(/\bnojs\b/g, 'js');

// Check that all required assets are uploaded and up-to-date
if(typeof Muse == "undefined") window.Muse = {}; window.Muse.assets = {"required":["jquery-1.8.3.min.js", "museutils.js", "museconfig.js", "jquery.musemenu.js", "jquery.musepolyfill.bgsize.js", "jquery.watch.js", "require.js", "webpro.js", "musewpdisclosure.js", "events.css"], "outOfDate":[]};
</script>
  
  <title>Events</title>
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/site_global.css?crc=241806178"/>
  <link rel="stylesheet" type="text/css" href="css/master_a-master.css?crc=4160090698"/>
  <link rel="stylesheet" type="text/css" href="css/events.css?crc=510948091" id="pagesheet"/>
  <!-- JS includes -->
  <!--[if lt IE 9]>
  <script src="scripts/html5shiv.js?crc=4241844378" type="text/javascript"></script>
  <![endif]-->
  <script type="text/javascript">
   document.write('\x3Cscript src="' + (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//use.typekit.net/ik/la9sBhnPbK-oQAzChITse-2StO7ElFv3rGUUVYEVRIvfeGGffOdoFUJ15QIhFRjkWDiRw2JaFhsRF2qXjDjhF2SDw2FqjQIX5QFRFQwXwQi8eTCgHKo8jDJlFQJlF2wlwRboOQJUFPouSkuaZWFXOQJ0jhNlSYmXZPoydABEdhoyiaw0jhNlOemRwKXuwKXXwkXkF2qlwRIuO1mDOWi8SablwKoRdhu3iWs8OcBljWTzdcBaSkoRdhXCiaiaOcmRwKXuwKXXwkXkF2qlwRIuO1mDOWi8SablwKoRdhu3iWs8OcBljWTzdcBaSkoRdhXKfAukSku8jWZ8SkJFdWJlZABhZWwlShB0SkGHfwWpMsMMeMS6MKGHfJOpMsMgeMS6MqGIQWmDZZMgUipm3M9.js" type="text/javascript">\x3C/script>');
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
    <div class="clearfix colelem" id="pmenuu1884"><!-- group -->
     <nav class="MenuBar clearfix grpelem" id="menuu1884"><!-- vertical box -->
      <div class="MenuItemContainer clearfix colelem" id="u1892"><!-- horizontal box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u1895" href="dinner.php"><!-- horizontal box --><div class="MenuItemLabel clearfix grpelem" id="u1896-4"><!-- content --><p><span id="u1896">Dinner</span></p></div></a>
      </div>
      <div class="MenuItemContainer clearfix colelem" id="u2055"><!-- horizontal box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u2056" href="show.php"><!-- horizontal box --><div class="MenuItemLabel clearfix grpelem" id="u2059-4"><!-- content --><p><span id="u2059">Show</span></p></div></a>
      </div>
     </nav>
     <ul class="AccordionWidget clearfix grpelem" id="accordionu2076"><!-- vertical box -->
      <li class="AccordionPanel clearfix colelem" id="u2077"><!-- vertical box --><div class="AccordionPanelTab clearfix colelem" id="u2080-4"><!-- content --><p><span id="u2080">Our Events</span></p></div><div class="AccordionPanelContent clearfix colelem" id="u2078"><!-- group --><div class="clearfix grpelem" id="u2079-7"><!-- content --><p>Dolor sit amet, consectetur adipiscing elit. Aliquam vitae fringilla augue. Maecenas in lectus lorem. In et accumsan mi. Aenean vestibulum nisl eu arcu viverra iaculis. In hac habitasse platea dictumst. In vehicula diam et mauris imperdiet aliquet.</p><p>&nbsp;</p><p>Dolor sit amet, consectetur adipiscing elit. Aliquam vitae fringilla augue. Maecenas in lectus lorem. In et accumsan mi. Aenean vestibulum nisl eu arcu viverra iaculis. In hac habitasse platea dictumst. In vehicula diam et mauris imperdiet aliquet.</p></div><div class="grpelem" id="u2165"><!-- content --></div></div></li>
      <li class="AccordionPanel clearfix colelem" id="u2085"><!-- vertical box --><div class="AccordionPanelTab clearfix colelem" id="u2088-4"><!-- content --><p>Dinner</p></div><div class="AccordionPanelContent disn clearfix colelem" id="u2086"><!-- group --><div class="clearfix grpelem" id="u2087-6"><!-- content --><p>Sed velit congue viverra. Sed porta mattis luctus. Curabitur feugiat pharetra sem eu iaculis. Phasellus venenatis volutpat arcu id placerat. Aliquam fringilla ligula eu purus lacinia at volutpat nunc malesuada. Nunc a augue ac orci tempus commodo. <a class="nonblock" href="dinner.php">Click Here</a></p></div><div class="grpelem" id="u2168"><!-- content --></div></div></li>
      <li class="AccordionPanel clearfix colelem" id="u2081"><!-- vertical box --><div class="AccordionPanelTab clearfix colelem" id="u2082-4"><!-- content --><p>Show</p></div><div class="AccordionPanelContent disn clearfix colelem" id="u2083"><!-- group --><div class="clearfix grpelem" id="u2084-6"><!-- content --><p>Tortor, eget ornare urna. Duis varius tellus eros. Donec odio arcu, rutrum ac rutrum eget, bibendum ac enim. Phasellus hendrerit iaculis purus. Aliquam sit amet molestie odio. Sed commodo dictum consequat aenean in est. Donec odio arcu, rutrum. <a class="nonblock" href="show.php">Click Here</a></p></div><div class="grpelem" id="u2171"><!-- content --></div></div></li>
     </ul>
    </div>
    <div class="verticalspacer" data-offset-top="498" data-content-above-spacer="578" data-content-below-spacer="125"></div>
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
  <!-- JS includes -->
  <script type="text/javascript">
   if (document.location.protocol != 'https:') document.write('\x3Cscript src="http://musecdn2.businesscatalyst.com/scripts/4.0/jquery-1.8.3.min.js" type="text/javascript">\x3C/script>');
</script>
  <script type="text/javascript">
   window.jQuery || document.write('\x3Cscript src="scripts/jquery-1.8.3.min.js" type="text/javascript">\x3C/script>');
</script>
  <!-- Other scripts -->
  <script type="text/javascript">
   window.Muse.assets.check=function(d){if(!window.Muse.assets.checked){window.Muse.assets.checked=!0;var b={},c=function(a,b){if(window.getComputedStyle){var c=window.getComputedStyle(a,null);return c&&c.getPropertyValue(b)||c&&c[b]||""}if(document.documentElement.currentStyle)return(c=a.currentStyle)&&c[b]||a.style&&a.style[b]||"";return""},a=function(a){if(a.match(/^rgb/))return a=a.replace(/\s+/g,"").match(/([\d\,]+)/gi)[0].split(","),(parseInt(a[0])<<16)+(parseInt(a[1])<<8)+parseInt(a[2]);if(a.match(/^\#/))return parseInt(a.substr(1),
16);return 0},g=function(g){for(var f=document.getElementsByTagName("link"),i=0;i<f.length;i++)if("text/css"==f[i].type){var h=(f[i].href||"").match(/\/?css\/([\w\-]+\.css)\?crc=(\d+)/);if(!h||!h[1]||!h[2])break;b[h[1]]=h[2]}f=document.createElement("div");f.className="version";f.style.cssText="display:none; width:1px; height:1px;";document.getElementsByTagName("body")[0].appendChild(f);for(i=0;i<Muse.assets.required.length;){var h=Muse.assets.required[i],l=h.match(/([\w\-\.]+)\.(\w+)$/),k=l&&l[1]?
l[1]:null,l=l&&l[2]?l[2]:null;switch(l.toLowerCase()){case "css":k=k.replace(/\W/gi,"_").replace(/^([^a-z])/gi,"_$1");f.className+=" "+k;k=a(c(f,"color"));l=a(c(f,"backgroundColor"));k!=0||l!=0?(Muse.assets.required.splice(i,1),"undefined"!=typeof b[h]&&(k!=b[h]>>>24||l!=(b[h]&16777215))&&Muse.assets.outOfDate.push(h)):i++;f.className="version";break;case "js":k.match(/^jquery-[\d\.]+/gi)&&d&&d().jquery=="1.8.3"?Muse.assets.required.splice(i,1):i++;break;default:throw Error("Unsupported file type: "+
l);}}f.parentNode.removeChild(f);if(Muse.assets.outOfDate.length||Muse.assets.required.length)f="Some files on the server may be missing or incorrect. Clear browser cache and try again. If the problem persists please contact website author.",g&&Muse.assets.outOfDate.length&&(f+="\nOut of date: "+Muse.assets.outOfDate.join(",")),g&&Muse.assets.required.length&&(f+="\nMissing: "+Muse.assets.required.join(",")),alert(f)};location&&location.search&&location.search.match&&location.search.match(/muse_debug/gi)?setTimeout(function(){g(!0)},5E3):g()}};
var muse_init=function(){require.config({baseUrl:""});require(["jquery","museutils","whatinput","jquery.musemenu","webpro","musewpdisclosure","jquery.musepolyfill.bgsize","jquery.watch"],function(d){var $ = d;$(document).ready(function(){try{
window.Muse.assets.check($);/* body */
Muse.Utils.transformMarkupToFixBrowserProblemsPreInit();/* body */
Muse.Utils.prepHyperlinks(true);/* body */
Muse.Utils.fullPage('#page');/* 100% height page */
Muse.Utils.initWidget('.MenuBar', ['#bp_infinity'], function(elem) { return $(elem).museMenu(); });/* unifiedNavBar */
Muse.Utils.initWidget('#accordionu2076', ['#bp_infinity'], function(elem) { return new WebPro.Widget.Accordion(elem, {canCloseAll:false,defaultIndex:0}); });/* #accordionu2076 */
Muse.Utils.showWidgetsWhenReady();/* body */
Muse.Utils.transformMarkupToFixBrowserProblems();/* body */
}catch(b){if(b&&"function"==typeof b.notify?b.notify():Muse.Assert.fail("Error calling selector function: "+b),false)throw b;}})})};

</script>
  <!-- RequireJS script -->
  <script src="scripts/require.js?crc=4108833657" type="text/javascript" async data-main="scripts/museconfig.js?crc=169177150" onload="if (requirejs) requirejs.onError = function(requireType, requireModule) { if (requireType && requireType.toString && requireType.toString().indexOf && 0 <= requireType.toString().indexOf('#scripterror')) window.Muse.assets.check(); }" onerror="window.Muse.assets.check();"></script>
  
  <!--HTML Widget code-->
  
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

   </body>
</html>
