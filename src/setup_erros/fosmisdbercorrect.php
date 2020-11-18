<?php
include'../connection/connection.php';



$upstudent="UPDATE `student` SET `id`= CONCAT_WS('', 'sc',id )";
mysql_query($upstudent);

$upresults="UPDATE `results` SET `index_number`= CONCAT_WS('', 'sc',index_number )";
mysql_query($upresults);

$uprequest_combination="UPDATE `request_combination` SET `stno`= CONCAT_WS('', 'sc',stno )";
mysql_query($uprequest_combination);

$upregistration="UPDATE `registration` SET `student`= CONCAT_WS('', 'sc',student )";
mysql_query($upregistration);

$upparticipation="UPDATE `participation` SET `student`= CONCAT_WS('', 'sc',student )";
mysql_query($upparticipation);

$upexam_registration="UPDATE `exam_registration` SET `student`= CONCAT_WS('', 'sc',student )";
mysql_query($upexam_registration);


echo"modify succsesfully";











?>