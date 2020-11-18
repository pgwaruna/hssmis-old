<?php

include '../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table users.....<br>";

$data1="CREATE TABLE users(l_name varchar(32),initials varchar(32),occupation varchar(32),user varchar(32),pass varchar(32),role varchar(32),email varchar(32),section varchar(32),PRIMARY KEY(user))";

$add=mysql_query($data1);
if($add){
echo "Users Table created successfully<br><br>";
}
else{
echo "Cannot create Users Table...<br> ";
}

?>