<?php require 'Connections/connections.php'; ?>
<?php
session_start();

//Set Variables
$event_id = $_SESSION['EVENTID'];
$idnumber = $_SESSION['IDNUMBER'];

//Set sqli - delete the event from the event planner table
$sql = "DELETE FROM event_planner WHERE planner_ID = '$idnumber' AND event_ID = '$event_id'";
mysqli_query($con, $sql);

//return to planners events
header('Location: Planners_Events.php');

?>