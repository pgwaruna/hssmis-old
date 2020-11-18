<?php

include '../../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table exam_registration.....<br>";

$data1="CREATE TABLE exam_registration(id INT UNSIGNED NOT NULL AUTO_INCREMENT, student varchar(16),course varchar(16),acedemic_year varchar(16),semester int(1),degree varchar(12), confirm int(1),year varchar(8), Last_update varchar(50),PRIMARY KEY(id),UNIQUE KEY student_course (student,course,acedemic_year))";

$add=mysql_query($data1);
if($add){
echo "exam_registration created successfully<br><br>";
}
else{
echo "Cannot create exam_registration Table...<br> ";
}
mysql_close($con);

?>
