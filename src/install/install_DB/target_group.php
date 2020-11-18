<?php

include '../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table target_group.....<br>";

$data1="CREATE TABLE target_group(target_id int(2), subject varchar(20),name varchar(64),UNIQUE subject_acc_lect(target_id, subject))";

$add=mysql_query($data1);
if($add){
echo "target_group Table created successfully<br><br>";


}
else{
echo "Cannot create target_group Table...<br> ";
}

mysql_query("insert into target_group values(1,'zoology','All Students')");
mysql_query("insert into target_group values(1,'botany','All Students')");
mysql_query("insert into target_group values(1,'mathematics','All Students')");

mysql_query("insert into target_group values(2,'zoology','Biological Science Students')");
mysql_query("insert into target_group values(2,'botany','Biological Science Students')");

mysql_query("insert into target_group values(3,'botany','Botany Students')");

mysql_query("insert into target_group values(4,'zoology','Zoology Students')");

mysql_query("insert into target_group values(5,'chemistry','Chemistry Students')");

mysql_query("insert into target_group values(6,'physics','Physics Students')");

mysql_query("insert into target_group values(7,'computer_science','CS Students')");

mysql_query("insert into target_group values(8,'applied_mathematics','AM Students')");

mysql_query("insert into target_group values(9,'industrial_mathematics','IM Students')");

mysql_query("insert into target_group values(10,'mathematics','Mathematics Students')");

mysql_query("insert into target_group values(11,'applied_mathematics','AM and IM Students')");
mysql_query("insert into target_group values(11,'industrial_mathematics','AM and IM Students')");

mysql_query("insert into target_group values(12,'mathematics','Physical Science Students')");







mysql_close($con)
?>