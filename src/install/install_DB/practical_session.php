<?php

include '../admin/config.php';
//$host="localhost";  $db="sathiska";  $user="sathiska";  $pass="sathiska852";
$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table practical_session.....<br>";

$data1="CREATE TABLE practical_session(id INT UNSIGNED NOT NULL AUTO_INCREMENT, subject varchar(12),date date,time time,grouptype char(2),hours int(8), max_amount int(5),acc_year varchar(15),semester int(5),Venue varchar(50),PRIMARY KEY(id),UNIQUE KEY practical_group(subject,grouptype,acc_year,semester))";

$add=mysql_query($data1);
if($add){
echo "practical_session created successfully<br><br>";
}
else{
echo "Cannot create practical_session Table...<br> ";
}
mysql_close($con);

?>
