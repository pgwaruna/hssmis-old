<?php

include '../../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table call_combination.....<br>";

$data1="CREATE TABLE call_combination(acc_year varchar(16) NOT NULL, closing_date date NOT NULL, status int(1) NOT NULL)";

$add=mysql_query($data1);
if($add){
echo "call_combination Table created successfully<br><br>";
}
else{
echo "Cannot create call_combination Table...<br> ";
}

?>
