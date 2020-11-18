<?php

include '../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table role.....<br>";

$data1="CREATE TABLE role(id INT UNSIGNED NOT NULL AUTO_INCREMENT,role varchar(32),PRIMARY KEY(id))";

$add=mysql_query($data1);
if($add){
echo "Role Table created successfully<br><br>";

echo "Adding Data into Role table<br><br>";
mysql_query("insert into role values(NULL,'administrator')");
mysql_query("insert into role values(NULL,'superadmin')");
mysql_query("insert into role values(NULL,'topadmin')");
mysql_query("insert into role values(NULL,'general')");
mysql_query("insert into role values(NULL,'lecturer')");
mysql_query("insert into role values(NULL,'student')");
echo "Data added successfully<br><br>";
}
else{
echo "Cannot create Users Table...<br> ";
}
mysql_close($con)
?>