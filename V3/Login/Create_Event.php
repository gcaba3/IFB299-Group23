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
	
	//insert assign the current planner to the newest event id
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
<!doctype html>
<html>
<head>
<link href="css/Master.css" rel="stylesheet" type="text/css" />
<link href="css/Menu.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Create New Event</title>
</head>

<body>
<div class="Container">
    	<div align="center" class="Header"></div>
        <div class="Menu">
            <div id="tabs31">
            	<ul>
                    <li><a href="Account.php" title=""><span>Account</span></a></li>
                    <li><a href="Planners_Events.php" title=""><span>Events</span></a></li>
                    <li><a href="Volunteer_list.php" title=""><span>Volunteers</span></a></li>
                    <li><a href="Finances.php" title=""><span>Finances</span></a></li>
                    <li><a href="Sponsors.php" title=""><span>Sponsors</span></a></li>
                    <li><a href="Email.php" title=""><span>Email</span></a></li>
                </ul>
            </div>
        </div>
        <div class="FullBody">
        <h1> Enter the events detail below</h1>
        
        
        <form action="" method="post" id = "entryfields">
            <table width="50%" border="0">
              <tbody>
              <tr>
                  <td width="100" style="text-align: right"><label>Registration Statues:</label></td>
                  <td width="100"><select id="regis_statues" name="regis_statues" required>
                  <option value = "Open"> Open </option>
                  <option value = "Closed"> Closed </option>
                  </select></td>
                <tr>
                  <td width="100" style="text-align: right"><label>Event Name:</label></td>
                  <td width="100"><input name="event_name" type="text" required="required" id="start_time" placeholder="Enter Event Name"> </td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>Country:</label></td>
                  <td width="100"><input name="country" type="text" required="required" id="country" placeholder="Enter Country"></td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>State:</label></td>
                  <td width="100"><input name="state" type="text" required="required" id="state" placeholder="Enter State"> </td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>Postcode:</label>
                  <label></label></td>
                  <td width="100"><input  name="postcode" type="number" required="required" id="postcode" placeholder="Enter Postcode" min="0"></td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>Address:</label></td>
                  <td width="100"><input name="address" type="text" required="required" id="address" placeholder="Enter Address"> </td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>Start Date:</label></td>
                  <td width="100"><input name="start_date" type="date" required="required" id="start_date"placeholder="Enter Start Date"></td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>Start Time:</label></td>
                  <td width="100"> <input name="start_time" type="time" required="required" id="start_time" placeholder="Enter Start Time"> </td>
                </tr>
              </tbody>
            </table>
        </form>
        <form action="" method="post" id="cancel_form" style="margin-top:10px; margin-left:100px;">
        <input type="submit" name="cancel" id="cancel" value="Cancel">
        <input type="submit" name="submit" id="submit" value="Create" style="margin-left:20px;" form="entryfields">
        </form>
        </div>
</div>
</body>
</html>
