<?php

include '../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table Lecture.....<br>";

$data1="CREATE TABLE lecture(lecture_id INT UNSIGNED NOT NULL AUTO_INCREMENT, course varchar(16),date varchar(16),hours int(1),lecturer varchar(12),time time not null, UNIQUE KEY course_date_time (course,date,hours),PRIMARY KEY(lecture_id))";

$add=mysql_query($data1);
if($add){
echo "Lecture created successfully<br><br>";
}
else{
echo "Cannot create Lecture Table...<br> ";
}
mysql_close($con);

?>