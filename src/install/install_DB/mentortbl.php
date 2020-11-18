<?php

include '../../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table mentor.....<br>";

$data1="CREATE TABLE mentor(mentor_id int(12) NOT NULL AUTO_INCREMENT,
					  user_name varchar(32),
					  title varchar(12),
					  lname varchar(50),
					  initials varchar(50),
					  designation varchar(50),
					  department varchar(50),
					  email varchar(50),
					  Internal_no varchar(10),
					  residence varchar(16),
					  mobile varchar(16),
					  PRIMARY KEY(mentor_id))";
$add=mysql_query($data1);
if($add){
echo "Mentor Table created successfully<br><br>";
}
else{
echo "Cannot create mentor Table...<br> ";
}

?>




