<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set variables
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$account_type = $_SESSION['ACCOUNTTYPE'];
$username = $_SESSION['USERNAME'];

?>
<!doctype html>
<html>
<head>
<link href="css/Master.css" rel="stylesheet" type="text/css" />
<link href="css/Menu.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Member's Template</title>
</head>

<body>
<div class="Container">
    	<div align="center" class="Header"></div>
        <div class="Menu">
            <div id="tabs31">
            <ul>
                  <li><a href="Account.php" title=""><span>Account</span></a></li>
                  <li><a href="Attending_events.php" title=""><span>Attending Events</span></a></li>
                  <li><a href="Donations.php" title=""><span>Donations</span></a></li>
                  <li><a href="Available_events.php" title=""><span>Available Events</span></a></li>
            </ul>
            </div>
        </div>
        <div class="LeftBody">
        <h1>&nbsp;</h1>
          
  </div>
        <div class="RightBody">
       	  <p>&nbsp;</p>
        </div>
        <div class="Footer"></div>
</div>
</body>
</html>
