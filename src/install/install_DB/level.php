<?php

include '../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table Level.....<br>";

$data1="CREATE TABLE level(year int(4) NOT NULL,semister int(1),level int(1),PRIMARY KEY(year))";

$add=mysql_query($data1);
if($add){
echo "Level Table created successfully<br><br>";
}
else{
echo "Cannot create Level Table...<br> ";
}

?>