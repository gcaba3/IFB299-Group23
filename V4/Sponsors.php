
<style>
button.accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
}

button.accordion.active, button.accordion:hover {
    background-color: #ddd;
}

div.panel {
    padding: 0 18px;
    display: none;
    background-color: white;
}

div.panel.show {
    display: block;
}
</style>

<!--header with style sheet-->
<?php
echo file_get_contents("http://ec2-52-43-249-215.us-west-2.compute.amazonaws.com/scripts/header.html");

?>
<!--Nav menue see Sitemap in the database to add new pages-->
<?php
echo '<nav class="MenuBar clearfix grpelem" id="menuu1244"><!-- horizontal box -->';
$servername = "localhost";
$username = "root";
$password = "qwe";
$dbname = "thedatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT  `PageName` ,  `Location` ,  `ParentID` 
FROM SiteMap
WHERE  `ParentID` <= 0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo'<div class="MenuItemContainer clearfix grpelem" id=""><!-- vertical box --> <a class="nonblock nontext MenuItem MenuItemWithSubMenu clearfix colelem" id="u1248" href="';
        echo  $row["Location"];
		echo '"><!-- horizontal box --><div class="MenuItemLabel NoWrap clearfix grpelem" id="u1249-4"><!-- content --> <p><span id="u1249">';
		echo $row["PageName"];
		echo '</span></p> </div></a> </div>';
		
    }
} else {
    echo "0 results";
}
$conn->close();
echo '</nav>';

?>
<!--site content bellow-->


      <div class="clearfix colelem" id="u2808-15"><!-- content -->
      <div> 
      <br>
<br>
<br>
<br>
<br>

 <?php

$servername = "localhost";
$username = "root";
$password = "qwe";
$dbname = "thedatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn1->connect_error) {
    die("Connection failed: " . $conn1->connect_error);
} 

$sql = "SELECT *  
FROM sponsors";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo '<button class="accordion">ID: '. $row['Sponsor_ID'] .' Name: '. $row['Sponsor_Name'] . ' Email: '.  $row['Email'] . '</button>';
			echo '<div class="panel">';
			echo '<p>Donations <br>';
			echo '"SELECT * FROM  `sponsors_donation` WHERE  `sponsor_ID` LIKE '.$row['Sponsor_ID']. '"';
			// Create connection
				$conn1 = new mysqli($servername, $username, $password, $dbname);
			// Check connection
				if ($conn1->connect_error) {
				die("Connection failed: " . $conn1->connect_error);
} 
				$sql1 = '"SELECT * FROM  `sponsors_donation` WHERE  `sponsor_ID` LIKE 1"';
				$result1 = $conn1->query($sql1);

				if ($result1->num_rows > 0) {
				// output data of each row
				while($row1 = $result1->fetch_assoc()) {
					echo '$'. $row1['amount']. '  ' .  $row1['date_donated'] . '<br>';
					
				}
				}				
			echo '</p>';
			echo '</div>';
    }
	
} else {
    echo "0 results";
}
$conn->close();

?>

</div>
 

       </div>
      </div>
      <div class="size_fixed colelem" id="u2813"><!-- custom html -->



<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
  }
}
</script>

<?php

echo file_get_contents("http://ec2-52-43-249-215.us-west-2.compute.amazonaws.com/scripts/footer.html");
?>

