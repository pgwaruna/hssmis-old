<?php

include '../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table Announcements.....<br>";

$data1="CREATE TABLE announcement(id INT UNSIGNED NOT NULL AUTO_INCREMENT,title varchar(55),description varchar(240),PRIMARY KEY(id))";

$add=mysql_query($data1);
if($add){
echo "Announcements Table created successfully<br><br>";
}
else{
echo "Cannot create Announcements Table...<br> ";
}
mysql_close($con)
?>