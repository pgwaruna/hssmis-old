<?php

include'../../admin/config.php';

mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);



require_once 'Excel/reader.php';

// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();

// Set output Encoding.
$data->setOutputEncoding('CP1251');

$data->read($target_path);
//$data->read($_FILES['uploadedfile']['name']);

error_reporting(E_ALL ^ E_NOTICE);

for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) 
{
//.........get student's tempory number...........
	$indexT=$data->sheets[0]['cells'][$i][2];
	$str_expT = explode("/", $indexT);
	$screT=$str_expT[0];
	$numT=$str_expT[2];
		$tmpno=$screT.$numT;
//.....get student's permanent number..............
	$indexP=$data->sheets[0]['cells'][$i][3];
	$str_expP = explode("/", $indexP);
	$screP=$str_expP[0];
	$numP=$str_expP[2];



//........get student full name......................
	$fulname=$data->sheets[0]['cells'][$i][4];
	$name_exp=explode("-",$fulname);
	$lname=$name_exp[0];
	$init=$name_exp[1];



//echo$screT.$numT."----".$numP."<br>";

$quetntopn_u="update users set user='$numP' where user='$tmpno' and l_name='$lname'";
//echo$quetntopn_u;
$qutntopn_u=mysql_query($quetntopn_u);

$quetntopn_pinf="update student_personal_detais set stno='$indexP' where stno='$tmpno' and lname='$lname'";
//echo$quetntopn_pinf;
$qutntopn_pinf=mysql_query($quetntopn_pinf);

$quetntopn_rcmb="update request_combination set stno='$numP' where stno='$tmpno'";
//echo$quetntopn_rcmb;
$qutntopn_rcmb=mysql_query($quetntopn_rcmb);

$quetntopn_std="update student set id='$numP' where id='$tmpno' and l_name='$lname'";
//echo$quetntopn_std;
$qutntopn_std=mysql_query($quetntopn_std);
}
echo"Student Users added successfully<br>";

?>
