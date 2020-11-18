<?php

include '../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table Results.....<br>";

$data1="CREATE TABLE results(id INT UNSIGNED NOT NULL AUTO_INCREMENT,index_number varchar(12),subject varchar(12),marks double(5,3),grade varchar(2),PRIMARY KEY(id),UNIQUE KEY student_course (index_number, subject))";

$add=mysql_query($data1);
if($add){
echo "Results Table created successfully<br><br>";
}
else{
echo "Cannot create Results Table...<br> ";
}

?>