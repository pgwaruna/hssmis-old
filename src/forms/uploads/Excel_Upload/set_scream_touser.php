<?php

 
include  '../../admin/config.php';


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
	$index=$data->sheets[0]['cells'][$i][2];
	$str_exp = explode("/", $index);
	$scre=$str_exp[0];
	$num=$str_exp[2];
		
	if($scre=="PS"){
		$occu='phy_student';
			}
	elseif($scre=="BS"){
		$occu='bio_student';
			}
	elseif($scre=="CS"){
		$occu='bcs_student';
				}
	else{$occu='nd_student';}

			
	$indexpm=$data->sheets[0]['cells'][$i][3];
	$str_expp = explode("/", $indexpm);
	
	$pnum=$str_expp[2];
	
	$fulname=$data->sheets[0]['cells'][$i][4];
	$name_exp=explode("-",$fulname);

		$lname=$name_exp[0];
		$init=$name_exp[1];


	
//echo$st_tem_no." ".$lname."--".$init."<br>";
$queupdnew="update users set occupation='$occu' where user=$pnum and l_name='$lname'";
mysql_query($queupdnew);
//echo$queupdnew;
}
echo"Student Users added successfully<br>";

?>
