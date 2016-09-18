<?php require 'Connections/connections.php';?>

<?php
//check if form submitted
if(isset($_POST['save'])){
		session_start();
		$accountnumber = $_SESSION['ACCOUNTNUMBER'];
		$accounttype = $_SESSION['ACCOUNTTYPE'];
		$ID = $_SESSION['ID'];
		
		if(!$_POST['New_FN'] == ""){
			$new_firstname = $_POST['New_FN'];
			$update_firstname = "UPDATE $accounttype SET firstName = '$new_firstname' where ID = $ID";
			mysqli_query($con, $update_firstname);
			$updated_FN == TRUE;
		} 
		
		if(!$_POST['New_LN'] == ""){
			$new_lastname = $_POST['New_LN'];
			$update_lastname = "UPDATE $accounttype SET lastName = '$new_lastname' where ID = $ID";
			mysqli_query($con, $update_lastname);
			$updated_LN == TRUE;
		}
		
		if(!$_POST['New_email'] == ""){
			$new_email = $_POST['New_email'];
			$update_email = "UPDATE $accounttype SET email = '$new_email' where ID = $ID";
			mysqli_query($con, $update_email);
			$updated_email == TRUE;
		}
		
		if ($new_firstname || $new_lastnam || $new_email){
			header('Location: profile_updated.php');
		} else {
			echo "Please fill in atleast one";
		}
				
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit details</title>
</head>

<body>
<h1> Edit details </h1>
<form name="edit_edails" method="post" action="">
<p>
  <label for="textfield">New first name: </label>
  <input type="text" name="New_FN" id="textfield">
</p>
<p>
  <label for="textfield2">New last name</label>
  :
  <input type="text" name="New_LN" id="textfield2">
  <label for="textfield3"><br>
    <br>
  New email: </label>
  <input type="text" name="New_email" id="textfield3">
</p>
<p>
  <input type="submit" name="save" id="save" value="save">
</p>
<form action = "index.php" method = "POST">
  <input type="submit" name="Cancel" id="Cancel" value="Cancel">
</form>
</p>
</form>
</body>
</html>