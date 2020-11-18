<?php

include '../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table registration.....<br>";

$data1="CREATE TABLE registration(id INT UNSIGNED NOT NULL AUTO_INCREMENT, student varchar(16),course varchar(16),acedemic_year varchar(16),semister int(1),degree varchar(12), confirm int(1),PRIMARY KEY(id),UNIQUE KEY student_course (student,course))";

$add=mysql_query($data1);
if($add){
echo "registration created successfully<br><br>";
}
else{
echo "Cannot create registration Table...<br> ";
}
mysql_close($con);

?>
