<?php

include '../admin/config.php';
//$host="localhost";  $db="sathiska";  $user="sathiska";  $pass="sathiska852";
$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table call_prac_registration.....<br>";

$data1="CREATE TABLE call_prac_registration(semester int(1), accedamic_year varchar(16), end_date date, status int(1),PRIMARY KEY(accedamic_year))";

$add=mysql_query($data1);
if($add){
echo "call_prac_registration Table created successfully<br><br>";
}
else{
echo "Cannot create call_prac_registration Table...<br> ";
}

?>
