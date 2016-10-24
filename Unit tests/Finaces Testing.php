<?php require '../Connections/connections.php'; ?>
<?php
class Test {
	var $expected_value;
	var $output;
	var $result;
	var $testname;
	
	function passorfail($expected_value, $output){
		if($expected_value == $output){
			return 'pass';
		} else {
			return 'fail';	
		}
	}
	
	//Functions pulled from main project.
	
	//Returns the total of all the members donations for one specific event
	function total_members_donation($event_ID){
		global $con;
		
		// Set query - select the sum of all donations to one event
		$sql_members_donation = "select SUM(Amount) AS members_donations FROM members_donation where Event_ID = '$event_ID'";
		$md_result = mysqli_query($con, $sql_members_donation);
		$row = mysqli_fetch_assoc($md_result);
		$members_donations = $row['members_donations'];
		return $members_donations;
	}
	
	//Returns the total of all the sponsors donations for one specific event
	function total_sponsors_donation($event_ID){
		global $con;
		// Set query - select the sum of all donations to one event
		$sql_sponsors_donation = "select SUM(amount) AS sponsors_donations FROM sponsors_donation where Event_ID = '$event_ID'";
		$sd_result = mysqli_query($con, $sql_sponsors_donation);
		$row = mysqli_fetch_assoc($sd_result);
		$sponsors_donations = $row['sponsors_donations'];
		return $sponsors_donations;
	}
	
	//Adds the total of sponsors and members donations
	function calc_total_donations($event_ID){
		$members_donation = $this->total_members_donation($event_ID);
		$sponsors_donation = $this->total_sponsors_donation($event_ID);
		$total_donation = $members_donation + $sponsors_donation;
		return $total_donation;
	}
	
	//Calculates the rough cost, then returns the calculated value
	function calc_rough_cost($event_ID){
		global $con;
		// Set query - select the sum of all the tickets reserved for one event
		$sql_total_tickets = "select SUM(Reserved_tickets) AS total_tickets FROM attending_events where Event_ID = '$event_ID'";
		$tt_result = mysqli_query($con, $sql_total_tickets);
		$row = mysqli_fetch_assoc($tt_result);
		$total_tickets = $row['total_tickets'];
		
		//calculate rough cost
		$cost_of_ticket = 20;
		$rough_cost = $cost_of_ticket * $total_tickets;
		
		return $rough_cost;
	}
	
	//calculates the final cost by taking away the total donation from the rough cost. Then returns the final cost value
	function calc_final_cost($rough_cost, $total_donations){
		$final_cost = $rough_cost - $total_donations;
		return $final_cost;
	}
	
	//Returns the number of members attending one event
	function total_members_attending($event_ID){
		global $con;
		
		// Set query - select the registration statues of the event
		$sql = "select * FROM attending_events WHERE Event_ID = '$event_ID'";
		$result = mysqli_query($con, $sql);
		$total_members_attending = mysqli_num_rows($result);
		return $total_members_attending;
	}
	
	//returns the number of members that donated to one event
	function num_members_that_donated($event_ID){
		global $con;
		
		// Set query - select the registration statues of the event
		$sql = "select * FROM members_donation WHERE Event_ID = '$event_ID' GROUP BY member_ID";
		$result = mysqli_query($con, $sql);
		$members_that_donated = mysqli_num_rows($result);
		return $members_that_donated;
	}
	
	//Returns the registration statues of one event
	function registration_statues($event_ID){
		global $con;
		
		// Set query - select the registration statues of the event
		$sql = "select regis_statues FROM event WHERE Event_ID = '$event_ID'";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_assoc($result);
		$registration = $row['regis_statues'];
		
		return $registration;
	}
	
	//Returns the value of the ticket cost for the members that didnt donate
	function calc_ticket_cost($final_cost, $total_members_attending, $members_that_donated){
		global $con;
		
		$members_that_didnt_donate = $total_members_attending - $members_that_donated;
		
		//Checks if the calculated value is 0 or negative or else an error would pop up on runtime.
		if ($members_that_didnt_donate <= 0 ){
			$ticket_price = 0;
		} else {
			//Final calculation for the ticket price
			$ticket_price = $final_cost / $members_that_didnt_donate;
		}
	
		return $ticket_price;
	}
}

//Test Cases below. Inputs are derived by looking at local host databse of my home computer.
//Running this code will fail most of the test cases. Or even fail the as it cant find the connections folder.
//A copy of this can be found on: http://ec2-52-43-249-215.us-west-2.compute.amazonaws.com/Login/Unit%20tests/Testing.php

/*
Test Case: Testing the total sposnors donation

Input derived from test database of event id: 1

amount: 45
amount: 10
amount: 50
amount: 20
amount: 1
amount: 1

expected result = 127;
*/
$test = new Test;
$eventid = 1;

$test->testname = 'Total Sponsors Donation';
echo 'Testcase: ' . $test->testname . '<br>' . '<br>';

$test->expected_value = 127;
$test->output = $test->total_sponsors_donation($eventid);

echo 'Expected Value: ' .  $test->expected_value . '<br>';
echo 'Function Output: '. $test->output. '<br>';
echo 'Test Result: '. $test->passorfail($test->expected_value,$test->output) . '<br>' . '<br>';

/*
Test Case: Testing the total members donations

Input derived from test database of event id: 1

Amount: 100
Amount: 100
Amount: 10
Amount: 5

Expected result: 215

*/
$test = new Test;
$eventid = 1;

$test->testname = 'Total Members Donations';
echo 'Testcase: ' . $test->testname . '<br>' . '<br>';

$test->expected_value = 215;
$test->output = $test->total_members_donation($eventid);
echo 'Expected Value: ' .  $test->expected_value . '<br>';
echo 'Function Output: '. $test->output. '<br>';

echo 'Test Result: '. $test->passorfail($test->expected_value,$test->output) . '<br>' . '<br>';

/*
Testcase: Testing the calc_total_donations.
This function simply adds the results of the total members donations and sponsors donation.
Since the calculated totals before were:

Total members donations = 215
Sponsors donations = 127;

The expected value is: 342.
*/
$test = new Test;
$eventid = 1;

$test->testname = 'Total Donations';
echo 'Testcase: ' . $test->testname . '<br>' . '<br>';

$test->expected_value = 342;
$test->output = $test->calc_total_donations($eventid);
echo 'Expected Value: ' .  $test->expected_value . '<br>';
echo 'Function Output: '. $test->output. '<br>';

echo 'Test Result: '. $test->passorfail($test->expected_value,$test->output) . '<br>' . '<br>';

/*
Testcase: Tests the rough cost calculation.

Input derived from database of event id: 1;

Resereved Tickets: 5
Resereved Tickets: 5
Resereved Tickets: 5

Sum of input = 15;

With each input worth 20 the

expected outcome = 300.

*/

$test = new Test;
$eventid = 1;

$test->testname = 'Rough Cost';
echo 'Testcase: ' . $test->testname . '<br>' . '<br>';

$test->expected_value = 300;
$test->output = $test->calc_rough_cost($eventid);
echo 'Expected Value: ' .  $test->expected_value . '<br>';
echo 'Function Output: '. $test->output. '<br>';

echo 'Test Result: '. $test->passorfail($test->expected_value,$test->output) . '<br>' . '<br>';

/*
Testcase: tests the cal_final_cost function
The function expects two ($roughcost,$totaldonations) then takes away $rough cost from totaldonations

Input: 
$roughcost = 300
$totaldonations = 342.

Expected output: -42
*/

$test = new Test;
$roughcost = 300;
$totaldonations = 342;

$test->testname = 'Final Cost';
echo 'Testcase: ' . $test->testname . '<br>' . '<br>';

$test->expected_value = -42;
$test->output = $test->calc_final_cost($roughcost,$totaldonations);
echo 'Expected Value: ' .  $test->expected_value . '<br>';
echo 'Function Output: '. $test->output. '<br>';

echo 'Test Result: '. $test->passorfail($test->expected_value,$test->output) . '<br>' . '<br>';


/*
Test case: tests total_members_attending function
This function returns a number of all members attending of the given event id

Input derived from localhost database of event id 1:

EventID			Id nunmber			Rserved tickets
1				1					5
1				2					5
1				3					5

Expected value: 3

*/

$test = new Test;
$eventid = 1;

$test->testname = 'Total Members Attending';
echo 'Testcase: ' . $test->testname . '<br>' . '<br>';
$test->expected_value = 3;
$test->output = $test->total_members_attending($eventid);
echo 'Expected Value: ' .  $test->expected_value . '<br>';
echo 'Function Output: '. $test->output. '<br>';

echo 'Test Result: '. $test->passorfail($test->expected_value,$test->output) . '<br>' . '<br>';

/*
Test case: tests num_members_that_donated function
This function returns a number of all the members that donated to the given event id

Input derived from localhost database of event id 1:

Event_ID		Member_ID			Amount
1				1					100
1				2					100
1				1					5
1				1					10

Expected value: 2

*/

$test = new Test;
$eventid = 1;

$test->testname = 'Number of members that donated';
echo 'Testcase: ' . $test->testname . '<br>' . '<br>';
$test->expected_value = 2;
$test->output = $test->num_members_that_donated($eventid);
echo 'Expected Value: ' .  $test->expected_value . '<br>';
echo 'Function Output: '. $test->output. '<br>';

echo 'Test Result: '. $test->passorfail($test->expected_value,$test->output) . '<br>' . '<br>';

/*
Test case: tests calc_ticket_cost function
This function returns the calculated ticket price from three inputs ($final_cost, $total_members_attending, $members_that_donated)

Input (based from previous tests):
$final_cost = -43;
$total_members_attending = 3;
$members_that_donated = 2;

Expected value: -43

*/

$test = new Test;
$final_cost = -43;
$total_members_attending = 3;
$members_that_donated = 2;

$test->testname = 'Calculate ticket prices';
echo 'Testcase: ' . $test->testname . '<br>' . '<br>';
$test->expected_value = -43;
$test->output = $test->calc_ticket_cost($final_cost,$total_members_attending,$members_that_donated);
echo 'Expected Value: ' .  $test->expected_value . '<br>';
echo 'Function Output: '. $test->output. '<br>';

echo 'Test Result: '. $test->passorfail($test->expected_value,$test->output) . '<br>' . '<br>';

/*
Test case: tests calc_ticket_cost function
This function returns the calculated ticket price from three inputs ($final_cost, $total_members_attending, $members_that_donated)

Input (Random numbers with positive output):
$final_cost = 500;
$total_members_attending = 10;
$members_that_donated = 5;

Expected value: 100

*/

$test = new Test;
$final_cost = 500;
$total_members_attending = 10;
$members_that_donated = 5;

$test->testname = 'Calculate ticket prices';
echo 'Testcase: ' . $test->testname . '<br>' . '<br>';
$test->expected_value = 100;
$test->output = $test->calc_ticket_cost($final_cost,$total_members_attending,$members_that_donated);
echo 'Expected Value: ' .  $test->expected_value . '<br>';
echo 'Function Output: '. $test->output. '<br>';

echo 'Test Result: '. $test->passorfail($test->expected_value,$test->output) . '<br>' . '<br>';
?>