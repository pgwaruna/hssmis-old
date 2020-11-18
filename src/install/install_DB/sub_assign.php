<?php

include '../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table sub_assign.....<br>";

$data1="CREATE TABLE sub_assign(subject varchar(7),lect_id varchar(32),acc_year varchar(16), tutor varchar(16),UNIQUE subject_acc_lect(subject,acc_year))";

$add=mysql_query($data1);
if($add){
echo "sub_assign Table created successfully<br><br>";


}
else{
echo "Cannot create sub_assign Table...<br> ";
}
mysql_close($con)
?>