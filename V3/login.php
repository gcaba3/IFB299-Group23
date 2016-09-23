<?php require 'Connections/connections.php';?>
<?php

//check if form submitted
if(isset($_POST['login'])){
		session_start();
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		//Set Query
		$result = $con->query("select * from account where username = '$username' AND Password ='$password'");
		
		//$store query result 
		$row = mysqli_fetch_assoc($result);
		
		//Store variables needed in session variable(s). 
		$_SESSION['ACCOUNTNUMBER'] = $row['Accountnumber'];
		$_SESSION['ACCOUNTTYPE'] = $row['Accounttype'];	
		
		//login if account exists
		if(isset($_SESSION['ACCOUNTNUMBER'])){
			header('Location: index.php');
		} else {
			header('Location: access_denied.php');
		}
				
	}
?>
<!DOCTYPE html>
<html class="nojs html css_verticalspacer" lang="en-US">
 <head>

  <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
  <meta name="generator" content="2015.2.1.352"/>
  
  <script type="text/javascript">
   // Update the 'nojs'/'js' class on the html node
document.documentElement.className = document.documentElement.className.replace(/\bnojs\b/g, 'js');

// Check that all required assets are uploaded and up-to-date
if(typeof Muse == "undefined") window.Muse = {}; window.Muse.assets = {"required":["jquery-1.8.3.min.js", "museutils.js", "museconfig.js", "jquery.musemenu.js", "jquery.musepolyfill.bgsize.js", "jquery.watch.js", "require.js", "webpro.js", "login.css"], "outOfDate":[]};
</script>
  
  <title>Login</title>
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/site_global.css?crc=519376845"/>
  <link rel="stylesheet" type="text/css" href="css/master_a-master.css?crc=4132628846"/>
  <link rel="stylesheet" type="text/css" href="css/login.css?crc=426032099" id="pagesheet"/>
  <!-- JS includes -->
  <!--[if lt IE 9]>
  <script src="scripts/html5shiv.js?crc=4241844378" type="text/javascript"></script>
  <![endif]-->
  <script type="text/javascript">
   document.write('\x3Cscript src="' + (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//use.typekit.net/ik/o2WjVzmueu1wSwkyOJWZ_5NHWNfHtrKAEzXij-Ay_FbfezwgfOdoFUJ15QIhFRjkWDiRw2JaFhsRF2qXjDjhF2SDw2FqjQIX5QFRFQwXwQi8eTCgHKo8jDJlFQJlF2wlwRboOQJUFPouSkuaZWFXOQJ0jhNlSYmXZPoydABEdhoyiaw0jhNlOemRwKXuwKXXwkXkF2qlwRIuO1mDOWi8SablwKoRdhu3iWs8OcBljWTzdcBaSkoRdhXCiaiaOcmRwKXuwKXXwkXkF2qlwRIuO1mDOWi8SablwKoRdhu3iWs8OcBljWTzdcBaSkoRdhXK2AukOAmyicmDOWFyd1w7f6Kfa6IbMg6YJM4HgIuuShAbMdYO_dtB.js" type="text/javascript">\x3C/script>');
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
     <nav class="MenuBar clearfix grpelem" id="menuu1244"><!-- horizontal box -->
      <div class="MenuItemContainer clearfix grpelem" id="u1245"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u1248" href="index.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u1249-4"><!-- content --><p><span id="u1249">Home</span></p></div></a>
      </div>
      <div class="MenuItemContainer clearfix grpelem" id="u1252"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u1255" href="events.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u1258-4"><!-- content --><p><span id="u1258">Events</span></p></div><div class="grpelem" id="u1256"><!-- content --></div></a>
       <div class="SubMenu MenuLevel1 clearfix" id="u1253"><!-- vertical box -->
        <ul class="SubMenuView clearfix colelem" id="u1254"><!-- vertical box -->
         <li class="MenuItemContainer clearfix colelem" id="u1374"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u1376" href="dinner.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u1380-4"><!-- content --><p>Dinner</p></div></a></li>
         <li class="MenuItemContainer clearfix colelem" id="u1395"><!-- horizontal box --><a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix grpelem" id="u1396" href="show.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u1398-4"><!-- content --><p>Show</p></div></a></li>
        </ul>
       </div>
      </div>
      <div class="MenuItemContainer clearfix grpelem" id="u1290"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u1291" href="contact.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u1294-4"><!-- content --><p><span id="u1294">Contact</span></p></div></a>
      </div>
      <div class="MenuItemContainer clearfix grpelem" id="u1311"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u1312" href="faq.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u1314-4"><!-- content --><p><span id="u1314">FAQ</span></p></div></a>
      </div>
      <div class="MenuItemContainer clearfix grpelem" id="u1332"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u1333" href="donate.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u1335-4"><!-- content --><p><span id="u1335">Donate</span></p></div></a>
      </div>
      <div class="MenuItemContainer clearfix grpelem" id="u1353"><!-- vertical box -->
       <a class="nonblock nontext MenuItem MenuItemWithSubMenu MuseMenuActive clearfix colelem" id="u1356" href="login.php"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u1359-4"><!-- content --><p><span id="u1359">Login</span></p></div></a>
      </div>
     </nav>
    </div>
    <div class="clearfix colelem" id="pu1562-4"><!-- group -->
     <div class="clearfix grpelem" id="u1562-4"><!-- content -->
     <h1>Login</h1>
<form name="Login/Login_form.php" method="post" action="">
<label:> Username:<br/> </label>
<input name="username" type="text" autofocus="autofocus" required="required"><br/>
<label> Password:<br/></label>
<input name="password" type="password" autofocus="autofocus" required="required"><br/>

<input name="login" type="submit" id="login" formmethod="POST" value="login"><br/>
      </div>
     </div>
	 </div>
    </form>
    <form class="form-grp clearfix colelem" id="widgetu1731" method="post" enctype="multipart/form-data" action="scripts/form-u1731.php"><!-- none box -->
     <div class="fld-grp clearfix grpelem" id="widgetu1737" data-required="true" data-type="email"><!-- none box -->
      <label class="fld-label actAsDiv clearfix grpelem" id="u1738-4" for="widgetu1737_input"><!-- content --><span class="actAsPara">Email:</span></label>
      <span class="fld-input NoWrap actAsDiv clearfix grpelem" id="u1740-4"><!-- content --><input class="wrapped-input" type="email" spellcheck="false" id="widgetu1737_input" name="Email" tabindex="11"/><label class="wrapped-input fld-prompt" id="widgetu1737_prompt" for="widgetu1737_input"><span class="actAsPara">Enter Email</span></label></span>
      <div class="fld-message clearfix grpelem" id="u1739-4"><!-- content -->
       <p>Required</p>
      </div>
     </div>
     <div class="clearfix grpelem" id="u1771-4"><!-- content -->
      <p>Submitting Form...</p>
     </div>
     <div class="clearfix grpelem" id="u1749-4"><!-- content -->
      <p>The server encountered an error.</p>
     </div>
     <div class="clearfix grpelem" id="u1736-4"><!-- content -->
      <p>Form received.</p>
     </div>
     <input class="submit-btn NoWrap grpelem" id="u1770-17" type="submit" value="" tabindex="13"/><!-- state-based BG images -->
     <div class="fld-grp clearfix grpelem" id="widgetu1854" data-required="true"><!-- none box -->
      <label class="fld-label actAsDiv clearfix grpelem" id="u1855-4" for="widgetu1854_input"><!-- content --><span class="actAsPara">Password:</span></label>
      <span class="fld-input NoWrap actAsDiv clearfix grpelem" id="u1856-4"><!-- content --><input class="wrapped-input" type="text" id="widgetu1854_input" name="custom_U1854" tabindex="12"/><label class="wrapped-input fld-prompt" id="widgetu1854_prompt" for="widgetu1854_input"><span class="actAsPara">Enter Text</span></label></span>
      <div class="fld-message clearfix grpelem" id="u1857-4"><!-- content -->
       <p>Required</p>
      </div>
     </div>
    </form>
    <a class="nonblock nontext Button rounded-corners clearfix colelem" id="buttonu2655" href="admin-account.php"><!-- container box --><div class="clearfix grpelem" id="u2656-4"><!-- content --><p>Fake Login Button</p></div><div class="rounded-corners grpelem" id="u2657"><!-- simple frame --></div></a>
    <div class="verticalspacer" data-offset-top="858" data-content-above-spacer="938" data-content-below-spacer="125"></div>
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
  <div class="preload_images">
   <img class="preload" src="images/u1477-17-r.png?crc=256668400" alt=""/>
   <img class="preload" src="images/u1477-17-m.png?crc=4184806240" alt=""/>
   <img class="preload" src="images/u1477-17-fs.png?crc=119027808" alt=""/>
   <img class="preload" src="images/u1770-17-r.png?crc=256668400" alt=""/>
   <img class="preload" src="images/u1770-17-m.png?crc=4184806240" alt=""/>
   <img class="preload" src="images/u1770-17-fs.png?crc=119027808" alt=""/>
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
var muse_init=function(){require.config({baseUrl:""});require(["jquery","museutils","whatinput","jquery.musemenu","webpro","jquery.musepolyfill.bgsize","jquery.watch"],function(d){var $ = d;$(document).ready(function(){try{
window.Muse.assets.check($);/* body */
Muse.Utils.transformMarkupToFixBrowserProblemsPreInit();/* body */
Muse.Utils.prepHyperlinks(true);/* body */
Muse.Utils.fullPage('#page');/* 100% height page */
Muse.Utils.initWidget('.MenuBar', ['#bp_infinity'], function(elem) { return $(elem).museMenu(); });/* unifiedNavBar */
Muse.Utils.initWidget('#widgetu1438', ['#bp_infinity'], function(elem) { return new WebPro.Widget.Form(elem, {validationEvent:'submit',errorStateSensitivity:'high',fieldWrapperClass:'fld-grp',formSubmittedClass:'frm-sub-st',formErrorClass:'frm-subm-err-st',formDeliveredClass:'frm-subm-ok-st',notEmptyClass:'non-empty-st',focusClass:'focus-st',invalidClass:'fld-err-st',requiredClass:'fld-err-st',ajaxSubmit:true}); });/* #widgetu1438 */
Muse.Utils.initWidget('#widgetu1731', ['#bp_infinity'], function(elem) { return new WebPro.Widget.Form(elem, {validationEvent:'submit',errorStateSensitivity:'high',fieldWrapperClass:'fld-grp',formSubmittedClass:'frm-sub-st',formErrorClass:'frm-subm-err-st',formDeliveredClass:'frm-subm-ok-st',notEmptyClass:'non-empty-st',focusClass:'focus-st',invalidClass:'fld-err-st',requiredClass:'fld-err-st',ajaxSubmit:true}); });/* #widgetu1731 */
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
