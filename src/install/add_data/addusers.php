<?php

include '../../admin/config.php';

$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);


echo "Adding Users <br> <br>";

mysql_query("insert into users values('Wedagedara','J. R.','lecturer','janak',AES_ENCRYPT('123456',1000),'superadmin','janak@maths.ruh.ac.lk','Faculty Board')");
mysql_query("insert into users values('Board','Faculty','Board','board',AES_ENCRYPT('123456',1000),'superadmin','board@maths.ruh.ac.lk','Faculty Board')");

mysql_query("insert into users values('Jayantha','P. A.','dean','jayantha',AES_ENCRYPT('123456',1000),'topadmin','dean@office.ruh.ac.lk','deanoffice')");
mysql_query("insert into users values('Office','Deans','office','Dean,AES_ENCRYPT('123456',1000),'topadmin','office@science.ruh.ac.lk','deanoffice')");


mysql_query("insert into users values('Rathnayake','K. W.','head','maths',AES_ENCRYPT('123456',1000),'general','head@math.ruh.ac.lk','mathematics')");
mysql_query("insert into users values('Loronsuhewa','A.','head','cs',AES_ENCRYPT('123456',1000),'general','cs@math.ruh.ac.lk','computerscience')");
mysql_query("insert into users values('Abeyasinghe','S.','head','botany',AES_ENCRYPT('123456',1000),'general','head@math.ruh.ac.lk','botany')");
mysql_query("insert into users values('Saman','S.','head','zoo',AES_ENCRYPT('123456',1000),'general','head@math.ruh.ac.lk','zoology')");
mysql_query("insert into users values('Pathirana','H. M. K. K.','head','chemistry',AES_ENCRYPT('123456',1000),'general','head@math.ruh.ac.lk','chemistry')");
mysql_query("insert into users values('Yapa','K. A. S.','head','physics',AES_ENCRYPT('123456',1000),'general','head@math.ruh.ac.lk','physics')");


mysql_query("insert into users values('Saranapala','B. H.','lecturer','saranapala',AES_ENCRYPT('123456',1000),'lecturer','spala@cc.ruh.ac.lk','computerscience')");
mysql_query("insert into users values('Chandana','A.','lecturer','chandana',AES_ENCRYPT('123456',1000),'lecturer','chandana@cc.ruh.ac.lk','computerscience')");
mysql_query("insert into users values('Jayaweera','P.','lecturer','jayaweera',AES_ENCRYPT('123456',1000),'lecturer','jayaweera@cc.ruh.ac.lk','computerscience')");
mysql_query("insert into users values('Mabula','G.','lecturer','geethika',AES_ENCRYPT('123456',1000),'lecturer','spala@cc.ruh.ac.lk','computerscience')");
mysql_query("insert into users values('Kalyani','K.','lecturer','kalyani',AES_ENCRYPT('123456',1000),'lecturer','kalyani@cc.ruh.ac.lk','computerscience')");

mysql_query("insert into users values('Shanthidevi','S.','lecturer','shanthidevi',AES_ENCRYPT('123456',1000),'lecturer','sdv@maths.ruh.ac.lk','mathematics')");
mysql_query("insert into users values('Sampath','S.','lecturer','sampath',AES_ENCRYPT('123456',1000),'lecturer','sdv@maths.ruh.ac.lk','mathematics')");
mysql_query("insert into users values('Geganage','A. A.','lecturer','geganage',AES_ENCRYPT('123456',1000),'lecturer','sdv@maths.ruh.ac.lk','mathematics')");
mysql_query("insert into users values('Jayasekara','L.','lecturer','leslie',AES_ENCRYPT('123456',1000),'lecturer','sdv@maths.ruh.ac.lk','mathematics')");
mysql_query("insert into users values('Aberathna','V.','lecturer','aberathna',AES_ENCRYPT('123456',1000),'lecturer','sdv@maths.ruh.ac.lk','mathematics')");

mysql_query("insert into users values('Chathuranga','H. V.','student','6210',AES_ENCRYPT('123456',1000),'student','vc@edulanka.com','unchecked')");
mysql_query("insert into users values('Perera','A. B.','student','6211',AES_ENCRYPT('123456',1000),'student','vc@edulanka.com','unchecked')");
mysql_query("insert into users values('Saman','N. C.','student','6212',AES_ENCRYPT('123456',1000),'student','vc@edulanka.com','unchecked')");
mysql_query("insert into users values('Sampath','S. S.','student','6213',AES_ENCRYPT('123456',1000),'student','vc@edulanka.com','unchecked')");
mysql_query("insert into users values('Nimal','S.','student','6214',AES_ENCRYPT('123456',1000),'student','vc@edulanka.com','unchecked')");
mysql_query("insert into users values('Kamal','Y.','student','6215',AES_ENCRYPT('123456',1000),'student','vc@edulanka.com','unchecked')");

mysql_query("insert into users values('Sampath','H. V.','student','5210',AES_ENCRYPT('123456',1000),'student','vc@edulanka.com','unchecked')");
mysql_query("insert into users values('Chaminda','A. B.','student','5211',AES_ENCRYPT('123456',1000),'student','vc@edulanka.com','unchecked')");
mysql_query("insert into users values('Weerasinghe','N. C.','student','5212',AES_ENCRYPT('123456',1000),'student','vc@edulanka.com','unchecked')");
mysql_query("insert into users values('Gunawardana','S. S.','student','5213',AES_ENCRYPT('123456',1000),'student','vc@edulanka.com','unchecked')");
mysql_query("insert into users values('Srilal','S.','student','5214',AES_ENCRYPT('123456',1000),'student','vc@edulanka.com','unchecked')");
mysql_query("insert into users values('Sangeeth','Y.','student','5215',AES_ENCRYPT('123456',1000),'student','vc@edulanka.com','unchecked')");

mysql_query("insert into users values('Weejepala','H. V.','student','7210',AES_ENCRYPT('123456',1000),'student','vc@edulanka.com','unchecked')");
mysql_query("insert into users values('Saman','A. B.','student','7211',AES_ENCRYPT('123456',1000),'student','vc@edulanka.com','unchecked')");
mysql_query("insert into users values('Niluka','N. C.','student','7212',AES_ENCRYPT('123456',1000),'student','vc@edulanka.com','unchecked')");
mysql_query("insert into users values('Liyanage','S. S.','student','7213',AES_ENCRYPT('123456',1000),'student','vc@edulanka.com','unchecked')");
mysql_query("insert into users values('Rathnayake','S.','student','7214',AES_ENCRYPT('123456',1000),'student','vc@edulanka.com','unchecked')");
mysql_query("insert into users values('Nimal','Y.','student','7215',AES_ENCRYPT('123456',1000),'student','vc@edulanka.com','unchecked')");

mysql_query("insert into users values('Warnapala','H. V.','student','7710',AES_ENCRYPT('123456',1000),'student','vc@edulanka.com','unchecked')");
mysql_query("insert into users values('Seethawaka','A. B.','student','7711',AES_ENCRYPT('123456',1000),'student','vc@edulanka.com','unchecked')");
mysql_query("insert into users values('Saminda','N. C.','student','7712',AES_ENCRYPT('123456',1000),'student','vc@edulanka.com','unchecked')");
mysql_query("insert into users values('Waralath','S. S.','student','7713',AES_ENCRYPT('123456',1000),'student','vc@edulanka.com','unchecked')");
mysql_query("insert into users values('Hitiwana','S.','student','7714',AES_ENCRYPT('123456',1000),'student','vc@edulanka.com','unchecked')");
mysql_query("insert into users values('Sambodigama','Y.','student','7715',AES_ENCRYPT('123456',1000),'student','vc@edulanka.com','unchecked')");




echo "Users added successfully<br><br>";
mysql_close($con)
?>