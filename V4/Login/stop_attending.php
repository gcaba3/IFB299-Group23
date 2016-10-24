<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set Variables
$event_id = $_SESSION['EVENTID'];
$idnumber = $_SESSION['IDNUMBER'];

//Set sqli - delete the event from the attending events table
$sql = "DELETE FROM attending_events WHERE ID_number = '$idnumber' AND event_ID = '$event_id'";
mysqli_query($con, $sql);

//return to planners events
header('Location: Attending_events.php');

?>