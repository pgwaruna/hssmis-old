<?php

include '../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table participation.....<br>";

$data1="CREATE TABLE participation(student varchar(16), lect_id int(16),status varchar(12),UNIQUE KEY student_lecture (student,lect_id))";

$add=mysql_query($data1);
if($add){
echo "participation created successfully<br><br>";
}
else{
echo "Cannot create participation Table...<br> ";
}
mysql_close($con);

?>