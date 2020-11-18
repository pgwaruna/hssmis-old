<?php

include '../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table attendence.....<br>";

$data1="CREATE TABLE attendence(id INT UNSIGNED NOT NULL AUTO_INCREMENT, student varchar(16),course varchar(16),eligibility int(1) default 0,PRIMARY KEY(id),UNIQUE KEY student_course (student, course))";

$add=mysql_query($data1);
if($add){
echo "attendence created successfully<br><br>";
}
else{
echo "Cannot create attendence Table...<br> ";
}
mysql_close($con);

?>