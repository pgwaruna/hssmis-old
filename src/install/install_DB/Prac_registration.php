<?php

include '../admin/config.php';
//$host="localhost";  $db="sathiska";  $user="sathiska";  $pass="sathiska852";
$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table Prac_registration.....<br>";

$data1="CREATE TABLE Prac_registration(id INT UNSIGNED NOT NULL AUTO_INCREMENT, student varchar(16),acc_year varchar(15),semester int(2),subject varchar(12),prac_group varchar(2), date date,time time,hours int(8),choice int(5),status varchar(10),PRIMARY KEY(id),UNIQUE KEY student_pra_group (student,acc_year,semester,subject,prac_group))";

$add=mysql_query($data1);
if($add){
echo "Prac_registration created successfully<br><br>";
}
else{
echo "Cannot create Prac_registration Table...<br> ";
}
mysql_close($con);

?>
