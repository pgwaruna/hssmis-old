<?php

include '../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table login_info.....<br>";

$data1="CREATE TABLE login_info(id INT UNSIGNED NOT NULL AUTO_INCREMENT, user_id varchar(32),ip varchar(20),intime datetime,outtime datetime, primary key (id))";

$add=mysql_query($data1);
if($add){
echo "login_info created successfully<br><br>";
}
else{
echo "Cannot create login_info Table...<br> ";
}
mysql_close($con);

?>