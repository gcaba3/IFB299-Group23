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
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$phonenumber = $_POST['phonenumber'];
	
	
	echo $regis_statues;
	//insert inputs into the database
	$sql = "INSERT INTO volunteer (FirstName, LastName, Email, PhoneNumber)
		    VALUES ($firstname, $lastname, $email, $phonenumber";
	mysqli_query($con,$sql);

	//return to volunteer page
	header ("Location: Volunteer_list.php");	 
} else 
if(isset($_POST['cancel'])){
	//return to volunteer page
	header ("Location: Volunteer_list.php");
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
        <h1> Please enter your details below</h1>
        
        
        <form action="" method="post" id = "entryfields">
            <table width="50%" border="0">
              <tbody>
             
                <tr>
                  <td width="100" style="text-align: right"><label>First Name:</label></td>
                  <td width="100"><input value = "" name="firstname" type="text" required="required" id="firstname" placeholder="Enter First Name"> </td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>Last Name:</label></td>
                  <td width="100"><input value = "" name="lastname" type="text" required="required" id="lastname" placeholder="Enter Last Name"></td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>Email:</label></td>
                  <td width="100"><input value = "" name="email" type="text" required="required" id="email" placeholder="Enter Email"> </td>
                </tr>
                <tr>
                  <td width="100" style="text-align: right"><label>Phone Number:</label>
                  <label></label></td>
                  <td width="100"><input value = "" name="phonenumber" type="number" required="required" id="phonenumber" placeholder="Enter Phonenumber" min="0"></td>
                </tr>
             
              </tbody>
            </table>
        </form>
        <form action="" method="post" id="cancel_form" style="margin-top:10px; margin-left:100px;">
        <input type="submit" name="cancel" id="cancel" value="Cancel">
        <input type="submit" name="submit" id="submit" value="Save" style="margin-left:20px;" form="entryfields">
        </form>
        </div>
</div>
</body>
</html>
