<?php

include '../../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table request_combination.....<br>";

$data1="CREATE TABLE request_combination(id int(12) NOT NULL AUTO_INCREMENT,
					  stno varchar(12) NOT NULL,
					  acc_year varchar(16) NOT NULL,
					  combination varchar(50) NOT NULL,
					  priority int(11) NOT NULL,
					  status varchar(20) NOT NULL,
					  PRIMARY KEY(id),
					  UNIQUE KEY stcmb(stno,acc_year,combination,priority))";
$add=mysql_query($data1);
if($add){
echo "request_combination Table created successfully<br><br>";
}
else{
echo "Cannot create request_combination Table...<br> ";
}

?>




