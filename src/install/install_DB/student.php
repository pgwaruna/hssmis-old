<?php

include '../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table Student.....<br>";

$data1="CREATE TABLE student(id varchar(16) NOT NULL,l_name varchar(32),initials varchar(32),year varchar(4),stream varchar(3),combination int(2),PRIMARY KEY(id))";

$add=mysql_query($data1);
if($add){
echo "Student Table created successfully<br><br>";
}
else{
echo "Cannot create Student Table...<br> ";
}

?>