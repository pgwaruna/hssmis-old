<?php
// Test CVS

include '../../admin/config.php';


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
echo"<table border=1 cellspacing=0 cellspading=0>";
$tmprw=1;
for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) 
{

	$user_name=$data->sheets[0]['cells'][$i][2];

	$title=$data->sheets[0]['cells'][$i][3];

	$l_name=$data->sheets[0]['cells'][$i][4];

	$initials=$data->sheets[0]['cells'][$i][5];

	$designation=$data->sheets[0]['cells'][$i][6];

	$section=$data->sheets[0]['cells'][$i][7];

	$email=$data->sheets[0]['cells'][$i][8];

	$internal_no=$data->sheets[0]['cells'][$i][9];

	$residence=$data->sheets[0]['cells'][$i][10];

	$mobile=$data->sheets[0]['cells'][$i][11];

	if($user_name!=null){
	
	$queinsmentor="insert into mentor(user_name,title,l_name,initials,designation,section,email,internal_no,residence,mobile)
	values('$user_name','$title','$l_name','$initials','$designation','$section','$email','$internal_no','$residence','$mobile')";
	//echo$queinsmentor;
	$quinsmentor=mysql_query($queinsmentor);
	
	if($quinsmentor){
	
		echo"<tr><td>$tmprw";
		
			echo"<td>".$user_name;
			echo"<td>".$title;
			echo"<td>".$l_name;
			echo"<td>".$initials;	
			echo"<td>".$designation;	
			echo"<td>".$section;	
			echo"<td>".$email;	
			echo"<td>".$internal_no;	
			echo"<td>".$residence;	
			echo"<td>".$mobile;	
		$tmprw++;
				}
	}

	
}
echo"</table>";
?>
