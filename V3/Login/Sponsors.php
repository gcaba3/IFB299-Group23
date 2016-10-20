<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set variables
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$account_type = $_SESSION['ACCOUNTTYPE'];
$username = $_SESSION['USERNAME'];



//check if save button is set
if(isset($_POST['save'])){
	// Set query, to select everything from the volunteers table
	$sql_sponsor = "select * FROM Sponsors";
	$v_result = mysqli_query($con, $sql_sponsor);
	$total_rows = mysqli_num_rows($v_result); 
	
	//Cycle through all the possible rows. Use each iteration as the volunteers id.
	for($int = 1; $int <= $total_rows; $int++){
		$sponsor_ID = $int;
		$sponsor_ID = $_POST[$int];
		
		//Checks if the event to that volunteers event entry is set (0). if it is update the event column as null
		// if not then update the event column as the selected data from the list.
		if($sponsor_ID == 0){
			$sponsor_ID = NULL;
			$sql_assign_event = "UPDATE sponsor SET Event_ID = NULL WHERE ID = '$sponsor_ID'";
			mysqli_query($con, $sql_assign_event);
		} else {
			$sql_assign_event = "UPDATE sponsor SET Event_ID = '$event_ID' WHERE ID = 'sponsor_ID'";
			mysqli_query($con, $sql_assign_event);
		}
	}
	$Updated = TRUE;
} elseif(isset($_POST['add_new'])){
	//Open new register new volunteer page
	header('Location: Add_new_sponsor.php');
}
?>
<!doctype html>
<html>
<head>
<link href="css/Master.css" rel="stylesheet" type="text/css" />
<link href="css/Menu.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Sponsors</title>
</head>

<body>
<div class="Container">
    	<div align="center" class="Header"></div>
        <div class="Menu">
            <div id="tabs31">
                <ul>
                    <li><a href="Account.php" title=""><span>Account</span></a></li>
                    <li><a href="Event_page.php" title=""><span>Events</span></a></li>
                    <li><a href="Volunteer_list.php" title=""><span>Volunteers</span></a></li>
                    <li><a href="Finances.php" title=""><span>Finances</span></a></li>
                    <li><a href="Sponsors.php" title=""><span>Sponsors</span></a></li>
                    <li><a href="Email.php" title=""><span>Email</span></a></li>
                </ul>
            </div>
        </div>
        <div class="FullBody">
       <table width="100%" border="0" cellpadding="6">
       <tr>
        <th width="150">Sponsor ID</th>
        <th width="290">Sponsor Name</th>
        <th width="290">Email</th>
        <th width="290">Event Sponsoring</th>
        </tr>
        <?php
		//set query - select everything from sponsor table
		$sql_sponsor = "select * FROM sponsors";
		$v_result = mysqli_query($con, $sql_sponsor);
		
		//Select everything from the volunteers table. Then fill html table as necessary
		while($sponsor = mysqli_fetch_array($v_result)){
			echo "<tr>";
			echo '<td style="text-align:center;">' . $sponsor['Sponsor_ID'] . '</td>';
			echo '<td style="text-align:center;">' . $sponsor['Sponsor_Name'] . ' ' . '</td>';
			echo '<td style="text-align:center;">' . $sponsor['Email'] . ' ' . '</td>';
		}
		?>
      
       </table>
       
          
       <div class= "Footer">
       <input type="button" onClick="location.href='Add_New_Sponsor.php'">
     
       
       
       </div> 
       
  </div>
        
</div>
</body>
</html>
