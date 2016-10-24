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
	
	echo $regis_statues;
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
	header ("Location: Planners_Events.php");
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
<!doctype html>
<html>
<head>
<link href="css/Master.css" rel="stylesheet" type="text/css" />
<link href="css/Menu.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Edit Event Details</title>
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
                  <td width="100"><input value = "<?php echo $row2['Event_Name'];?>" name="event_name" type="text" required="required" id="start_time" placeholder="Enter Event Name"> </td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>Country:</label></td>
                  <td width="100"><input value = "<?php echo $row2['Country'];?>" name="country" type="text" required="required" id="country" placeholder="Enter Country"></td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>State:</label></td>
                  <td width="100"><input value = "<?php echo $row2['State'];?>" name="state" type="text" required="required" id="state" placeholder="Enter State"> </td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>Postcode:</label>
                  <label></label></td>
                  <td width="100"><input value = "<?php echo $row2['Postcode'];?>" name="postcode" type="number" required="required" id="postcode" placeholder="Enter Postcode" min="0"></td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>Address:</label></td>
                  <td width="100"><input value = "<?php echo $row2['Address'];?>" name="address" type="text" required="required" id="address" placeholder="Enter Address"> </td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>Start Date:</label></td>
                  <td width="100"><input value = "<?php echo $row2['Event_Date'];?>" name="start_date" type="date" required="required" id="start_date"placeholder="Enter Start Date"></td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>Start Time:</label></td>
                  <td width="100"> <input value = "<?php echo $row2['Event_Time'];?>"name="start_time" type="time" required="required" id="start_time" placeholder="Enter Start Time"> </td>
                </tr>
              </tbody>
            </table>
        </form>
        <form action="" method="post" id="cancel_form" style="margin-top:10px; margin-left:100px;">
        <input type="submit" name="cancel" id="cancel" value="Cancel">
        <input type="submit" name="delete" id="delete" value="Delete Event" style="margin-left:20px;">
        <input type="submit" name="submit" id="submit" value="Save" style="margin-left:20px;" form="entryfields">
        </form>
        </div>
</div>
</body>
</html>
