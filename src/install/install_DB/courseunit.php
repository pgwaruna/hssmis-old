<?php

include '../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table courseunit.....<br>";

$data1="CREATE TABLE courseunit(code varchar(7) NOT NULL ,name varchar(255),department varchar(32),credits double(2,1),core varchar(2),semister int(1),lecture varchar(64), level int(1),target_group int(1), availability int(1), requirment varchar(64),PRIMARY KEY(code))";

$add=mysql_query($data1);
if($add){
echo "Users courseunit created successfully<br><br>";
}
else{
echo "Cannot create courseunit Table...<br> ";
}
mysql_close($con);

?>