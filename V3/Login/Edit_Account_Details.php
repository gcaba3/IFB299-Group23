<?php require 'Connections/connections.php';?>
<?php
session_start();
$updated = FALSE;
$accountnumber = $_SESSION['ACCOUNTNUMBER'];
$account_type = $_SESSION['ACCOUNTTYPE'];

//check if account exists
if(isset($_POST['save'])){
	$new_f_name = $_POST['f_name'];
	$new_l_name = $_POST['l_name'];
	$new_email = $_POST['email'];
	$new_p_number = $_POST['p_number'];
	
	/*
	Checks if any of the input fields has been field.
	If one field is filled it updates that input field's correseponding database column.
	
	*/
	if(!$_POST['f_name'] == ""){
		$sql = "UPDATE $account_type SET FirstName = '$new_f_name' where Account_number = '$accountnumber'";
		mysqli_query($con, $sql);
		$updated = TRUE;
	}
	
	if(!$_POST['l_name'] == ""){
		$sql = "UPDATE $account_type SET LastName = '$new_l_name' where Account_number = '$accountnumber'";
		mysqli_query($con, $sql);
		$updated = TRUE;
	}
	
	if(!$_POST['email'] == ""){
		$sql = "UPDATE $account_type SET Email = '$new_email' where Account_number = '$accountnumber'";
		mysqli_query($con, $sql);
		$updated = TRUE;
	}
	
	if(!$_POST['p_number'] == ""){
		$sql = "UPDATE $account_type SET PhoneNumber = '$new_p_number' where Account_number = '$accountnumber'";
		mysqli_query($con, $sql);
		$updated = TRUE;
	}
	
	// if any info is updated it sends it to successfull page
	if($updated == TRUE){
		header ("Location: 	Successfull_update.php");
	}
	
} elseif(isset($_POST['cancel'])){
	header ("Location: Account.php");
}
?>

<!doctype html>
<html>
<head>
<link href="css/Login.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Edit Login</title>
</head>

<body>
<div class="Login">
  <h1 align="center">Edit Login</h1>
  <div>
  <p align="center">
  <?php 
   if($updated == FALSE && isset($_POST['save'])){
		echo "Please fill atleast one. Or cancel."; 
   }
  ?>
  </p>
  </div>
  <form action="" method="post" style="text-align:center;">
  <p>
  <label>New Firstname<br/> 
  </label>
  <input name="f_name" type="text" autofocus id="f_name" placeholder="Enter here"><br/><br/>
  <label>New Lastname<br/> 
  </label>
  <input name="l_name" type="text" autofocus id="l_name" placeholder="Enter here">
  </p>
  <p>
    <label>New Email<br/>
    </label>
    <input name="email" type="email" autofocus id="email" placeholder="Enter here">
    </p>
  <p>
  <?php if($account_type == 'planner' || $account_type == 'volunteer'){ ?>
    <label>New Phonenumber<br/>
    </label>
    <input name="p_number" type="text" autofocus id="p_number" placeholder="Enter here">
    <?php } ?>
<br/>
    <br/>
    <input name="save" type="submit" id="save" value="Save">	
    <input name="cancel" type="submit" id="cancel" value="Cancel">
  </p>
  </form>
</div>
</body>
</html>