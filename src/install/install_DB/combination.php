<?php

include '../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table Combination.....<br>";

$data1="CREATE TABLE combination(id INT ,department varchar(32),subject varchar(32))";

$add=mysql_query($data1);
if($add){
echo "combination Table created successfully<br><br>";

mysql_query("insert into combination values(1,'computerscience','computer_science')");
mysql_query("insert into combination values(2,'computerscience','computer_science')");
mysql_query("insert into combination values(3,'computerscience','computer_science')");
mysql_query("insert into combination values(1,'mathematics','mathematics')");
mysql_query("insert into combination values(1,'mathematics','applied_mathematics')");
mysql_query("insert into combination values(2,'mathematics','mathematics')");
mysql_query("insert into combination values(3,'mathematics','mathematics')");
mysql_query("insert into combination values(4,'mathematics','mathematics')");
mysql_query("insert into combination values(4,'mathematics','indrustial_mathematics')");
mysql_query("insert into combination values(5,'mathematics','mathematics')");
mysql_query("insert into combination values(5,'mathematics','indrustial_mathematics')");
mysql_query("insert into combination values(6,'mathematics','mathematics')");
mysql_query("insert into combination values(6,'mathematics','applied_mathematics')");
mysql_query("insert into combination values(7,'mathematics','mathematics')");
mysql_query("insert into combination values(7,'mathematics','applied_mathematics')");
mysql_query("insert into combination values(8,'mathematics','mathematics')");
mysql_query("insert into combination values(3,'chemistry','chemistry')");
mysql_query("insert into combination values(4,'chemistry','chemistry')");
mysql_query("insert into combination values(7,'chemistry','chemistry')");
mysql_query("insert into combination values(8,'chemistry','chemistry')");
mysql_query("insert into combination values(9,'chemistry','chemistry')");
mysql_query("insert into combination values(10,'chemistry','chemistry')");
mysql_query("insert into combination values(2,'physics','physics')");
mysql_query("insert into combination values(5,'physics','physics')");
mysql_query("insert into combination values(6,'physics','physics')");
mysql_query("insert into combination values(8,'physics','physics')");
mysql_query("insert into combination values(10,'physics','physics')");
mysql_query("insert into combination values(9,'zoology','zoology')");
mysql_query("insert into combination values(9,'botany','botany')");
mysql_query("insert into combination values(10,'botany','botany')");
mysql_query("insert into combination values(11,'chemistry','chemistry')");
mysql_query("insert into combination values(11,'physics','physics')");
mysql_query("insert into combination values(11,'zoology','zoology')");
mysql_query("insert into combination values(12,'physics','physics')");
mysql_query("insert into combination values(12,'zoology','zoology')");
mysql_query("insert into combination values(12,'botany','botany')");


/* Index to Add Combonation

1 	CS + Maths + AM
2	CS + Maths + Physics
3 	CS + Chemistry + Maths
4 	IM + Maths + Chemistry
5 	IM + Maths + Physics
6 	Maths + AM + Physics
7 	Maths + AM + Chemistry
8 	Maths + Physics + Chemistry
9 	Zoo + Bot + Chemistry
10 	Chemistry + Botany + Physics
11 	Chemistry + Zoo + Physics
12 	Botany + Zoo + Physics
0 	Not Available

*/



}
else{
echo "Cannot create combination Table...<br> ";

}

?>