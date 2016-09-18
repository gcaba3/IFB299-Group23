<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_User_login = "localhost";
$database_User_login = "thedatabase";
$username_User_login = "root";
$password_User_login = "";
$User_login = mysqli_connect($hostname_User_login, $username_User_login, $password_User_login, $database_User_login) or trigger_error(mysql_error(),E_USER_ERROR); 
?>