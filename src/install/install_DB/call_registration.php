<?php

include '../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table call_registration.....<br>";

$data1="CREATE TABLE call_registration(semister int(1), acedemic_year varchar(16), closing_date varchar(16), register varchar(5),PRIMARY KEY(acedemic_year))";

$add=mysql_query($data1);
if($add){
echo "call_registration Table created successfully<br><br>";
}
else{
echo "Cannot create call_registration Table...<br> ";
}

?>