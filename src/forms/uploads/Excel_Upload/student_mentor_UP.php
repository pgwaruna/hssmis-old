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
	
	$user_name=$data->sheets[0]['cells'][$i][1];
	
	$name=$data->sheets[0]['cells'][$i][2];
	
	$index=$data->sheets[0]['cells'][$i][4];
	$str_exp = explode("/", $index);
		$prefix=$str_exp[0];
		$byear=$str_exp[1];
		$stno=$str_exp[2];
	
	$stusername=strtolower($prefix).$stno;
		
		$quegetmntid="select  mentor_id from mentor where user_name='$user_name'";
		$qugetmntid=mysql_query($quegetmntid);
		if(mysql_num_rows($qugetmntid)!=0){
			$qgetmntid=mysql_fetch_array($qugetmntid);
			$menterID=$qgetmntid['mentor_id'];
				
				$queupdmid="update student set mentor_id='$menterID' where id='$stusername'";
				//echo$queupdmid;
				$quupdmid=mysql_query($queupdmid);
				if($quupdmid){
					echo"<tr><td>$tmprw";

					echo"<td>$user_name";
					
					echo"<td>$name";
					
					echo"<td>$index";
					
					$tmprw++;	
				}
			
			
		}
		
		
		


	
}
echo"</table>";
?>
