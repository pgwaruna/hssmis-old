<?php

include '../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table permission.....<br>";

$data1="CREATE TABLE permission(id INT(5) not null,role_id INT(5),description varchar(52))";

$add=mysql_query($data1);
if($add){
echo "permission Table created successfully<br><br>";

echo "Adding Data into permission table <br> Defining Privileges of Users <br>";

mysql_query("insert into permission values(1,6,'Register to a course Unit')");

mysql_query("insert into permission values(2,3,'Modify student registration')");
mysql_query("insert into permission values(2,1,'Modify student registration')");

mysql_query("insert into permission values(3,3,'View and confirm registration')");
mysql_query("insert into permission values(3,1,'View and confirm registration')");

mysql_query("insert into permission values(4,3,'Notice for register a course unit')");
mysql_query("insert into permission values(4,1,'Notice for register a course unit')");

mysql_query("insert into permission values(5,3,'Notice current Level and Semister')");
mysql_query("insert into permission values(5,1,'Notice current Level and Semister')");

mysql_query("insert into permission values(6,3,'Submit / Modify Student Details')");
mysql_query("insert into permission values(6,1,'Submit / Modify Student Details')");

mysql_query("insert into permission values(7,4,'Add / Remove Course units')");
mysql_query("insert into permission values(7,3,'Add / Remove Course units')");

mysql_query("insert into permission values(8,3,'Find Student information')");
mysql_query("insert into permission values(8,5,'Find Student information')");
mysql_query("insert into permission values(8,4,'Find Student information')");
mysql_query("insert into permission values(8,1,'Find Student information')");

mysql_query("insert into permission values(9,2,'Submit student results')");
mysql_query("insert into permission values(9,1,'Submit student results')");

mysql_query("insert into permission values(10,2,'Modify Student results')");
mysql_query("insert into permission values(10,1,'Modify Student results')");

mysql_query("insert into permission values(11,6,'View results')");
mysql_query("insert into permission values(11,1,'View results')");

mysql_query("insert into permission values(12,4,'Find Student Results in Department')");
mysql_query("insert into permission values(12,5,'Find Student Results in Department')");

mysql_query("insert into permission values(13,3,'Find all Student Results')");
mysql_query("insert into permission values(13,1,'Find all Student Results')");

mysql_query("insert into permission values(14,3,'Find any Student all Results')");
mysql_query("insert into permission values(14,4,'Find any Student all Results')");
mysql_query("insert into permission values(14,1,'Find any Student all Results')");

mysql_query("insert into permission values(15,3,'Add / Remove Announcements')");
mysql_query("insert into permission values(15,1,'Add / Remove Announcements')");

mysql_query("insert into permission values(16,6,'View my Exam Eligibility')");

mysql_query("insert into permission values(17,4,'View and Modify Department Exam Eligibility')");

mysql_query("insert into permission values(18,3,'View and Modify all Exam Eligibility')");
mysql_query("insert into permission values(18,1,'View and Modify all Exam Eligibility')");

mysql_query("insert into permission values(19,5,'Add student Exam Eligibility')");

mysql_query("insert into permission values(20,1,'Mange User Accounts')");

mysql_query("insert into permission values(21,5,'Submit Student daily Attendence')");

mysql_query("insert into permission values(22,6,'View own daily Attendence')");

mysql_query("insert into permission values(23,3,'View and Add Medical to Attendence')");
mysql_query("insert into permission values(23,1,'View and Add Medical to Attendence')");

mysql_query("insert into permission values(24,1,'Submit Course Units to the System')");

mysql_query("insert into permission values(25,5,'View Attendences')");

mysql_query("insert into permission values(26,4,'View Attendences')");

echo "Previleges added successfully<br><br>";
}
else{
echo "Cannot create permission Table...<br> ";
}
mysql_close($con)
?>