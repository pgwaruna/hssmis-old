<?php

include '../../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table notice.....<br>";

$data1="CREATE TABLE notice(Notice_ID INT(11) UNSIGNED NOT NULL AUTO_INCREMENT, Title varchar(250),File_Name varchar(250),date_time varchar(50),Status int(2), PRIMARY KEY(Notice_ID))";

$add=mysql_query($data1);
if($add){
echo "notice Table created successfully<br><br>";
}
else{
echo "Cannot create notice Table...<br> ";
}
mysql_close($con);

?>
