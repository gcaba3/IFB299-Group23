<?php require 'Connections/connections.php';?>
<?php
session_start();
$plannersaccountnumber = $_SESSION['ACCOUNTNUMBER'];
//set variables
$error_message = FALSE;
$empty_fields = FALSE;
$account_exists = FALSE;

//check if account exists
if(isset($_POST['save'])){
	//set local variables
	$name = $_POST['name'];
	$email = $_POST['email'];
	
	//Check if fields are not empty
	if(!$_POST['name'] == "" && !$_POST['email'] == "")
			//Check if account already exists
			$sql = "SELECT * FROM sponsors
			WHERE Sponsor_Name = '$name'";
			$result = mysqli_query($con, $sql);
			$row = mysqli_fetch_assoc($result);
			
			if($row){
				$account_exists = TRUE;
			} else {
				//Query to set insert new account into the database. Then run that query.
				$sql1 = "INSERT INTO sponsors (Sponsor_Name, Email)
				VALUES ('$name', '$email')";
				mysqli_query($con, $sql1);
				session_start();
				
				//Select newest created account. And set store that account's account number
				$sql2 = "SELECT * FROM sponsors 
						ORDER BY Sponsor_ID DESC
						LIMIT 1";
				$result = mysqli_query($con, $sql2);
				$row = mysqli_fetch_assoc($result);
				//$_SESSION['ACCOUNTNUMBER'] = $row['Sponsor_ID'];
				header ("Location: Sponsors.php");
	}
} elseif(isset($_POST['cancel'])){
	header ("Location: Sponsors.php");
}
?>

<!doctype html>
<html>
<head>
<link href="css/Login.css" rel="stylesheet" type="text/css" />
<meta charset="utf-8">
<title>Sponsor Registration</title>
<script type="text/javascript">
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
</script>
</head>

<body>
<div class="Login">
  <h1 align="center">Sponsor Registration</h1>
  <p align="center">Enter your chosen credentials below:</p>
  <form action="" method="post" style="text-align:center;">
    <p>
  <label>Enter Name<br/> 
  </label>
  <input name="name" type="text" autofocus id="name" placeholder="Enter here"><br/><br/>
  
  <label>Enter Email<br/> 
  </label>
  <input name="email" type="text" autofocus id="email" placeholder="Enter here">
  </p>
  
  <input name="save" type="submit" id="save" onClick="MM_validateForm('name','','R','email','','RisEmail');return document.MM_returnValue" value="Save">	
     <input name="cancel" type="submit" id="cancel" value="Cancel">
  
</form>
</div>
</body>
</html>