<?php

include '../../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table call_exam_registration.....<br>";

$data1="CREATE TABLE call_exam_registration(semester int(1), acc_year varchar(16), closing_date varchar(16), status varchar(5))";

$add=mysql_query($data1);
if($add){
echo "call_exam_registration Table created successfully<br><br>";
}
else{
echo "Cannot create call_exam_registration Table...<br> ";
}

?>
