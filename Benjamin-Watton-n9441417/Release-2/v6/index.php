<?php
echo file_get_contents("scripts/header.html");

?>
<link rel="stylesheet" type="text/css" href="css/index.css?crc=74646006" id="pagesheet"/>
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
echo "</nav> </div>";

?>
<!---body content------>
    <div class="clearfix colelem" id="pu141-20"><!-- group -->
     <div class="clearfix grpelem" id="u141-20"><!-- content -->
      <h2 id="u141-2"><span class="actAsDiv normal_text" id="u149"><!-- content --><span class="actAsDiv" id="u147"><!-- simple frame --></span></span><span id="u141">Who Are We?</span></h2>
      <p id="u141-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vel velit vel massa feugiat posuere. Duis aliquet sem massa, nec lobortis nunc volutpat nec. Praesent ultricies posuere laoreet. Sed a neque lorem. Phasellus a urna nec dolor auctor finibus. Nulla in dignissim nisl. Etiam vulputate massa vitae mi pellentesque, sed venenatis mauris laoreet. Mauris feugiat vel ante quis iaculis. Quisque elementum libero a mauris malesuada dapibus.</p>
      <p id="u141-5">&nbsp;</p>
      <p id="u141-7">Praesent scelerisque at felis ut venenatis. Praesent ac bibendum nisl. Sed convallis sagittis urna, at porttitor ex volutpat eu. Proin nunc orci, vestibulum ut libero vitae, fermentum finibus lacus. Phasellus tristique ornare nisl in blandit. Morbi lobortis cursus mollis. Donec vel mauris ullamcorper sapien tristique pulvinar eget sit amet risus. Vivamus mollis est vitae sapien cursus ornare. Etiam sodales sollicitudin sapien at dictum. Pellentesque nec magna ut leo varius auctor at sit amet erat. Sed at felis semper dui scelerisque egestas in interdum dui. Ut vel ullamcorper augue.</p>
      <p id="u141-8">&nbsp;</p>
      <p id="u141-10">Nam et urna egestas mi tempus laoreet ac ac magna. Nunc consequat, dolor eget lobortis vehicula, risus purus eleifend tellus, consequat condimentum tellus purus nec sapien. Sed et aliquet leo, vel egestas metus. Aliquam ac aliquam libero, nec fermentum leo. Vestibulum ut massa ante. Ut ullamcorper nunc mi, quis tincidunt sem rhoncus non. Ut et hendrerit nisl.</p>
      <p id="u141-11">&nbsp;</p>
      <p id="u141-13">Praesent vel porttitor risus. Curabitur non velit suscipit, ornare justo bibendum, lacinia nisl. Nam eleifend mi ut nisl vestibulum posuere. Curabitur facilisis est imperdiet dui lacinia viverra. Etiam nec risus erat. Suspendisse fringilla in leo vel dictum. Etiam sit amet neque tempus, lacinia justo quis, molestie ante. Morbi et nisi ligula. Praesent iaculis justo quis magna pharetra posuere. In nec fringilla erat. Vivamus bibendum vitae nulla eleifend finibus. Vivamus consectetur tempus arcu vel tincidunt. Nunc pharetra malesuada ullamcorper. Donec ac dolor in felis pulvinar pellentesque.</p>
      <p id="u141-14">&nbsp;</p>
      <p id="u141-16">Donec posuere justo tincidunt convallis vulputate. Mauris ac lorem tristique, cursus purus ac, aliquam sem. Morbi ultrices quis erat ut pellentesque. Nunc purus est, ultricies id tristique sed, tempor in tortor. Cras at mauris eu orci egestas molestie. Pellentesque non pretium magna, a imperdiet mi. Donec erat tellus, lobortis eu ex eget, volutpat tincidunt arcu. Vestibulum posuere at enim non fringilla. Maecenas id congue lacus. Mauris laoreet ornare orci sit amet elementum. Morbi commodo suscipit nisi ut consectetur.</p>
      <p id="u141-17">&nbsp;</p>
      <p id="u141-18">&nbsp;</p>
     </div>
     <div class="clearfix grpelem" id="u184"><!-- group -->
      <div class="rounded-corners clip_frame grpelem" id="u156"><!-- image -->
       <img class="block" id="u156_img" src="images/istock_000022123478_medium.jpg?crc=4233723034" alt="" width="368" height="281"/>
      </div>
      <div class="rounded-corners clearfix grpelem" id="u153"><!-- group -->
       <div class="rgba-background rounded-corners clearfix grpelem" id="u181"><!-- group -->
        <div class="clearfix grpelem" id="u172-6"><!-- content -->
         <p>A Organization</p>
         <p>In YOUR Community</p>
        </div>
       </div>
      </div>
     </div>
  <!---End content------>
  <?php

echo file_get_contents("scripts/footer.html");
?>
