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
echo '</nav> </div>
<div class="verticalspacer" data-offset-top="0" data-content-above-spacer="229" data-content-below-spacer="463"></div>
    <div class="colelem" id="u126"><!-- simple frame --></div>';

?>
<!--site content bellow-->


<!--footer-->
<?php

echo file_get_contents("http://ec2-52-43-249-215.us-west-2.compute.amazonaws.com/scripts/footer.html");
?>