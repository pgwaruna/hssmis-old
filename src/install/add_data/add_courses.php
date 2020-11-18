<?php

include '../../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);


echo "Adding Courses <br> <br>";

mysql_query("insert into courseunit values('com1111','Basic Concept of IT','computerscience',1.5,'co',1,'kalyani',1)");
mysql_query("insert into courseunit values('com1123','Programing Techniques','computerscience',3,'co',1,'geethika',1)");
mysql_query("insert into courseunit values('com1132','Internet Programing','computerscience',2,'co',1,'jayaweera',1)");

mysql_query("insert into courseunit values('com1213','Data & Algorithm','computerscience',3,'co',2,'kalyani',1)");
mysql_query("insert into courseunit values('com1223','DBMS and File Org','computerscience',3,'co',2,'chandana',1)");

mysql_query("insert into courseunit values('com2123','OOSD','computerscience',3,'co',1,'saranapala',2)");
mysql_query("insert into courseunit values('com2122','Operating System','computerscience',2,'co',1,'geethika',2)");
mysql_query("insert into courseunit values('com2141','Computer Architechture','computerscience',1,'co',1,'anusha',2)");

mysql_query("insert into courseunit values('com2213','Networking','computerscience',3,'co',2,'chandana',2)");
mysql_query("insert into courseunit values('com2223','Multimedia Techniques','computerscience',3,'co',2,'jayaweera',2)");

mysql_query("insert into courseunit values('com3123','System Administrator','computerscience',3,'op',1,'saranapala',3)");
mysql_query("insert into courseunit values('com3113','PHP and MySQL','computerscience',3,'co',1,'jeewani',3)");
mysql_query("insert into courseunit values('com3b33','Project','computerscience',3,'co',1,'deepani',3)");

mysql_query("insert into courseunit values('com3213','Protocals','computerscience',3,'op',2,'chandana',3)");
mysql_query("insert into courseunit values('com3222','Visual Basic','computerscience',2,'op',2,'kokila',3)");
mysql_query("insert into courseunit values('com3212','Software Eng','computerscience',2,'op',2,'deepani',3)");
mysql_query("insert into courseunit values('com3242','Design Implentation','computerscience',2,'op',2,'kalyani',3)");
mysql_query("insert into courseunit values('com3252','Ecommerse','computerscience',2,'op',2,'saranapala',3)");


mysql_query("insert into courseunit values('mpm111x','Differential Equation','mathematics',1.5,'co',1,'sampath',1)");
mysql_query("insert into courseunit values('mas112x','Mathematical Statistics','mathematics',1.5,'co',1,'leslie',1)");
mysql_query("insert into courseunit values('mam1113','Vector Analysis','mathematics',3,'co',1,'rathnayake',1)");
mysql_query("insert into courseunit values('mam1133','Classical mechanics','mathematics',3,'co',1,'somathilaka',1)");
mysql_query("insert into courseunit values('mma1113','Logics','mathematics',3,'co',1,'jayantha',1)");
mysql_query("insert into courseunit values('mma1b23','mathematical computing','mathematics',3,'co',1,'janak',1)");

mysql_query("insert into courseunit values('mpm1213','Algebra','mathematics',3,'co',2,'rathnayake',1)");
mysql_query("insert into courseunit values('mpm1223','Real Analysis','mathematics',3,'co',2,'shanthidevi',1)");
mysql_query("insert into courseunit values('mam1223','Mathematical Modaling','mathematics',3,'co',2,'janak',1)");
mysql_query("insert into courseunit values('mam1213','Classical mechanics','mathematics',3,'co',2,'aberathna',1)");

mysql_query("insert into courseunit values('mpm2113','Lenear Algebra','mathematics',3,'co',1,'geeganage',2)");
mysql_query("insert into courseunit values('mpm2123','Real Analysis','mathematics',3,'co',1,'shanthidevi',2)");
mysql_query("insert into courseunit values('mam2113','Fluid Dayanamics','mathematics',3,'co',2,'rathnayake',1)");
mysql_query("insert into courseunit values('mam2123','Computational','mathematics',3,'co',2,'sampath',1)");
mysql_query("insert into courseunit values('mam2b13','Mathematical Computing','mathematics',3,'co',2,'janak',1)");

mysql_query("insert into courseunit values('mpm2213','Number theory','mathematics',3,'co',2,'vijayasiri',2)");
mysql_query("insert into courseunit values('mpm222x','Real Analysis','mathematics',1.5,'co',2,'shanthidevi',2)");
mysql_query("insert into courseunit values('mpm224x','Geometry','mathematics',1.5,'co',2,'sampath',2)");
mysql_query("insert into courseunit values('mam2213','Mathematical Modaling','mathematics',3,'co',2,'sampath',2)");
mysql_query("insert into courseunit values('mam2233','Information Theory','mathematics',3,'co',2,'janak',2)");
mysql_query("insert into courseunit values('mms2213','Statictics','mathematics',3,'co',2,'leslie',2)");
mysql_query("insert into courseunit values('mas2213','Aplied Statictics','mathematics',3,'co',2,'geeganage',2)");
 
mysql_query("insert into courseunit values('mpm3113','Lenear Algebra','mathematics',3,'co',1,'shanthidevi',3)");
mysql_query("insert into courseunit values('mpm3123','Real Analysis','mathematics',3,'co',1,'janak',3)");
mysql_query("insert into courseunit values('mam3123','Numerical Analysis','mathematics',3,'co',1,'aberathna',3)");
mysql_query("insert into courseunit values('mma3123','Physics & Eng','mathematics',3,'co',1,'vijayasiri',3)");
mysql_query("insert into courseunit values('mam3133','Mathematical Modaling',3,'co',1,'sampath',3)");
mysql_query("insert into courseunit values('mms3113','Statistics','mathematics',3,'co',1,'leslie',3)");
mysql_query("insert into courseunit values('mas3113','Aplied Statictics','mathematics',3,'co',1,'geeganage',3)");

mysql_query("insert into courseunit values('mpm3223','Complex Analysis','mathematics',3,'op',2,'geganage',3)");
mysql_query("insert into courseunit values('mma3223','Ecology','mathematics',3,'op',2,'shanthidevi',3)");
mysql_query("insert into courseunit values('mpm3213','Functional Analysis','mathematics',3,'op',2,'janak',3)");
mysql_query("insert into courseunit values('mma3233','Economics','mathematics',3,'op',2,'aberathna',3)");
mysql_query("insert into courseunit values('mam3213','Aplied Algebra','mathematics',3,'op',2,'geganage',3)");


mysql_query("insert into courseunit values('fsc32p2','Project','deanoffice',2,'op',2,'Santha',3)");
mysql_query("insert into courseunit values('fsc3112','Accounting','deanoffice',2,'op',1,'Nimal',3)");
mysql_query("insert into courseunit values('fsc3133','COM skills','deanoffice',3,'op',1,'Santha',3)");
mysql_query("insert into courseunit values('fsc3122','Managament','deanoffice',2,'op',1,'Nimal',3)");


mysql_query("insert into courseunit values('phy1114','Genaral Physics','physics',4,'co',1,'lecture',1)");
mysql_query("insert into courseunit values('phy1b24','Practical','physics',4,'co',1,'lecture',1)");

mysql_query("insert into courseunit values('phy1214','Genaral Physics','physics',4,'co',2,'lecture',1)");

mysql_query("insert into courseunit values('phy2114','Genaral Physics','physics',4,'co',1,'lecture',2)");
mysql_query("insert into courseunit values('phy2b24','Practical','physics',4,'co',1,'lecture',2)");
mysql_query("insert into courseunit values('phy3212','Electronics','physics',2,'op',1,'lecture',2)");
mysql_query("insert into courseunit values('phy3122','Electronic Practical','physics',2,'op',1,'lecture',2)");

mysql_query("insert into courseunit values('phy2214','Genaral Physics ','physics',4,'co',1,'lecture',3)");

mysql_query("insert into courseunit values('phy3114','Genaral Physics (Quantom)','physics',4,'co',1,'lecture',3)");
mysql_query("insert into courseunit values('phy3122','Practical','physics',4,'co',1,'lecture',3)");

mysql_query("insert into courseunit values('phy3232','Astronomy','physics',2,'op',2,'lecture',3)");


mysql_query("insert into courseunit values('che1114','Genaral Chemistry','chemistry',4,'co',1,'lecture',1)");
mysql_query("insert into courseunit values('che1b24','Practical','chemistry',4,'co',1,'lecture',1)");

mysql_query("insert into courseunit values('che1214','Genaral Chemistry','chemistry',4,'co',2,'lecture',1)");

mysql_query("insert into courseunit values('che2114','Genaral Chemistry','chemistry',4,'co',1,'lecture',2)");
mysql_query("insert into courseunit values('che2b24','Practical','chemistry',4,'co',1,'lecture',2)");

mysql_query("insert into courseunit values('che2214','Genaral Chemistry','chemistry',4,'co',2,'lecture',2)");

mysql_query("insert into courseunit values('che3114','Genaral Chemistry','chemistry',4,'co',1,'lecture',3)");
mysql_query("insert into courseunit values('che3122','Practical','chemistry',2,'co',1,'lecture',3)");

mysql_query("insert into courseunit values('che3213','Genaral Chemistry','chemistry',3,'op',2,'lecture',3)");


echo "Courses added successfully<br><br>";
mysql_close($con)
?>