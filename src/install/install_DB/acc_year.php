<?php

include '../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table acc_year.....<br>";

$data1="CREATE TABLE acc_year(acedemic_year varchar(16), starting_date date, ending_date date, current int(1), PRIMARY KEY(acedemic_year))";

$add=mysql_query($data1);
if($add){
echo "acc_year Table created successfully<br><br>";
}
else{
echo "Cannot create acc_year Table...<br> ";
}

?>