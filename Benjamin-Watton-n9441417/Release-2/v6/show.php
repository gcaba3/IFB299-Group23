<!DOCTYPE html>
<html class="nojs html css_verticalspacer" lang="en-US">
 <head>

  <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
  <meta name="generator" content="2015.2.1.352"/>
  
  <script type="text/javascript">
   // Update the 'nojs'/'js' class on the html node
document.documentElement.className = document.documentElement.className.replace(/\bnojs\b/g, 'js');

// Check that all required assets are uploaded and up-to-date
if(typeof Muse == "undefined") window.Muse = {}; window.Muse.assets = {"required":["jquery-1.8.3.min.js", "museutils.js", "museconfig.js", "jquery.musemenu.js", "jquery.musepolyfill.bgsize.js", "jquery.watch.js", "require.js", "webpro.js", "musewpslideshow.js", "jquery.museoverlay.js", "touchswipe.js", "show.css"], "outOfDate":[]};
</script>
  
  <title>Show</title>
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/site_global.css?crc=241806178"/>
  <link rel="stylesheet" type="text/css" href="css/master_a-master.css?crc=4160090698"/>
  <link rel="stylesheet" type="text/css" href="css/show.css?crc=3939835413" id="pagesheet"/>
  <!-- JS includes -->
  <!--[if lt IE 9]>
  <script src="scripts/html5shiv.js?crc=4241844378" type="text/javascript"></script>
  <![endif]-->
  <script type="text/javascript">
   document.write('\x3Cscript src="' + (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//use.typekit.net/ik/usD79u2NauoA2u6XNvGxk06uCs0QWsFvZeYw5ow_HXtfeGGffOdoFUJ15QIhFRjkWDiRw2JaFhsRF2qXjDjhF2SDw2FqjQIX5QFRFQwXwQi8eTCgHKo8jDJlFQJlF2wlwRboOQJUFPouSkuaZWFXOQJ0jhNlSYmXZPoydABEdhoyiaw0jhNlOemRwKXuwKXXwkXkF2qlwRIuO1mDOWi8SablwKoRdhu3iWs8OcBljWTzdcBaSkoRdhXCiaiaOcmRwKXuwKXXwkXkF2qlwRIuO1mDOWi8SablwKoRdhu3iWs8OcBljWTzdcBaSkoRdhXKfAukSku8jWZ8SkJFdWJlZABhZWwlShB0SkGHfwWpMsMMeMS6MKGHfJOpMsMgeMS6MqGIQWmDZZMgUNpm3M9.js" type="text/javascript">\x3C/script>');
</script>
  <!-- Other scripts -->
  <script type="text/javascript">
   try {Typekit.load();} catch(e) {}
</script>
    <!--HTML Widget code-->
  
<style>
	.fb-comments, .fb-comments * {
		width:100% !important;
	}
</style>

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
    <div class="SlideShowWidget clearfix colelem" id="slideshowu2782"><!-- none box -->
     <div class="popup_anchor" id="u2786popup">
      <div class="SlideShowContentPanel clearfix" id="u2786"><!-- stack box -->
       <div class="SSSlide clip_frame clearfix grpelem" id="u2787"><!-- image -->
        <img class="ImageInclude position_content" id="u2787_img" data-src="images/adds1.jpg?crc=3802105904" src="images/blank.gif?crc=4208392903" alt="" data-width="106" data-height="332"/>
       </div>
       <div class="SSSlide invi clip_frame clearfix grpelem" id="u2791"><!-- image -->
        <img class="ImageInclude position_content" id="u2791_img" data-src="images/adds2.jpg?crc=4177812691" src="images/blank.gif?crc=4208392903" alt="" data-width="106" data-height="332"/>
       </div>
       <div class="SSSlide invi clip_frame clearfix grpelem" id="u2789"><!-- image -->
        <img class="ImageInclude position_content" id="u2789_img" data-src="images/adds3.jpg?crc=530956457" src="images/blank.gif?crc=4208392903" alt="" data-width="106" data-height="332"/>
       </div>
      </div>
     </div>
     <div class="popup_anchor" id="u2794-4popup">
      <div class="SSPreviousButton clearfix" id="u2794-4"><!-- content -->
       <p><span id="u2794">&lt;</span></p>
      </div>
     </div>
     <div class="popup_anchor" id="u2806-4popup">
      <div class="SSNextButton clearfix" id="u2806-4"><!-- content -->
       <p>&gt;</p>
      </div>
     </div>
    </div>
    <div class="clearfix colelem" id="ppu2808-15"><!-- group -->
     <div class="clearfix grpelem" id="pu2808-15"><!-- column -->
      <div class="clearfix colelem" id="u2808-15"><!-- content -->
       <p>Show</p>
       <p>Dolor sit amet, consectetur adipiscing elit. Aliquam vitae fringilla augue. Maecenas in lectus lorem. In et accumsan mi. Aenean vestibulum nisl eu arcu viverra iaculis. In hac habitasse platea dictumst. In vehicula diam et mauris imperdiet aliquet.</p>
       <p>&nbsp;</p>
       <p>Dolor sit amet, consectetur adipiscing elit. Aliquam vitae fringilla augue. Maecenas in lectus lorem. In et accumsan mi. Aenean vestibulum nisl eu arcu viverra iaculis. In hac habitasse platea dictumst. In vehicula diam et mauris imperdiet aliquet.</p>
       <p>Dolor sit amet, consectetur adipiscing elit. Aliquam vitae fringilla augue. Maecenas in lectus lorem. In et accumsan mi. Aenean vestibulum nisl eu arcu viverra iaculis. In hac habitasse platea dictumst. In vehicula diam et mauris imperdiet aliquet.</p>
       <p>&nbsp;</p>
       <p><a class="nonblock" href="https://www.facebook.com/events/134929133624382/">RSVP on Event Page</a></p>
      </div>
      <div class="Button rounded-corners clearfix colelem" id="buttonu2810"><!-- container box -->
       <div class="clearfix grpelem" id="u2811-4"><!-- content -->
        <p>Buy</p>
       </div>
       <div class="rounded-corners grpelem" id="u2812"><!-- simple frame --></div>
      </div>
      <div class="size_fixed colelem" id="u2813"><!-- custom html -->
       
<div class="fb-comments" data-href="https://www.facebook.com/CommunityOrganisation/posts/1039874776097941" data-mobile="false" data-width="100%" data-colorscheme="light" data-action="comment" data-num-posts="5" data-order_by="reverse_time"></div>

      </div>
     </div>
     <div class="size_fixed grpelem" id="u2809"><!-- custom html -->
      
<iframe class="actAsDiv" style="width:100%;height:100%;" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;q=QUT%20Gradens%20Point&amp;aq=0&amp;ie=UTF8&amp;t=m&amp;z=12&amp;iwloc=A&amp;output=embed"></iframe>

     </div>
     <div class="grpelem" id="u2814"><!-- custom html -->
      <iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2FCommunityOrganisation%2Fposts%2F1039874776097941&width=400" width="400" height="476" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
     </div>
    </div>
    <div class="verticalspacer" data-offset-top="1516" data-content-above-spacer="1595" data-content-below-spacer="125"></div>
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
var muse_init=function(){require.config({baseUrl:""});require(["jquery","museutils","whatinput","jquery.musemenu","webpro","musewpslideshow","jquery.museoverlay","touchswipe","jquery.musepolyfill.bgsize","jquery.watch"],function(d){var $ = d;$(document).ready(function(){try{
window.Muse.assets.check($);/* body */
Muse.Utils.transformMarkupToFixBrowserProblemsPreInit();/* body */
Muse.Utils.prepHyperlinks(true);/* body */
Muse.Utils.fullPage('#page');/* 100% height page */
Muse.Utils.initWidget('.MenuBar', ['#bp_infinity'], function(elem) { return $(elem).museMenu(); });/* unifiedNavBar */
Muse.Utils.initWidget('#slideshowu2782', ['#bp_infinity'], function(elem) { var widget = new WebPro.Widget.ContentSlideShow(elem, {autoPlay:true,displayInterval:3500,slideLinkStopsSlideShow:false,transitionStyle:'fading',lightboxEnabled_runtime:false,shuffle:false,transitionDuration:500,enableSwipe:true,elastic:'off',resumeAutoplay:true,resumeAutoplayInterval:3000,playOnce:false,autoActivate_runtime:false}); $(elem).data('widget', widget); return widget; });/* #slideshowu2782 */
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
